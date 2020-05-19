<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Services\DataTable;

class DataTableController extends DataTable
{

    protected $parameters = [
        'dom'   => 'Bfrtip',
        'buttons' => ['excel', 'csv', 'reload'],
        'columnDefs' => [
            [
                'defaultContent' => '-',
                'targets' => '_all'
            ]
        ],
        'scrollX' => true
    ];

    protected $order = [0, 'asc'];

    protected $model = '';
    protected $columns = [];
    protected $image_columns = [];
    protected $boolean_columns = [];
    protected $eager_columns =  [];
    protected $count_columns = [];
    protected $count_join_columns = [];
    protected $ops = true;
    protected $common_columns = ['created_at', 'updated_at'];
    protected $raw_columns = [];

    public function ajax() {
        [$model, $datatables] = $this->getAjaxParameters();

        collect($this->image_columns)->each(function($image_column) use (&$datatables) {
            return $datatables->editColumn($image_column, function($model) use ($image_column) {
                return $this->wrapImage($model, $image_column);
            });
        })->recollect($this->boolean_columns)->each(function($boolean_column) use (&$datatables) {
            return $datatables->editColumn($boolean_column, function($model) use (&$datatables) {
                return $model->boolean_column ? __('datatables.fields.yes') : __('datatables.fields.no');
            });
        })->recollect($this->eager_columns)->each(function($eager_column) use (&$datatables) {
            $column = implode('.', [$relation, $eager_column]);

            return $datatables->editColumn($column, function($model) use ($relation, $eager_column) {
                return !empty($model->$relation->$eager_column) ? $model->$relation->$eager_column : '';
            });
        })->recollect($this->count_columns)->eact(function($count_column) use (&$datatables) {
            return $datatables->editColumn($count_column, function($model) use ($count_column) {
                return count($model->$count_column);
            });
        });

        $datatables = $this->setRawColumns($this->pushOps($datatables, $model));

        return $datatables->make(true);
    }

    public function html() {
        return $this->builder()->columns($this->getColumns())->parameters($this->getParameters());
    }

    protected function getAjaxParameters() {
        return [
            $this->getModelName(),
            new EloquentDataTable($this->query())
        ];
    }

    protected function getColumns(array $result = []) {
        [$columns, $countColumnsPosition, $model, $table] = $this->getColumnParameters();

        collect($columns)->each(function($column, $key) use ($model, $table, $countColumnsPosition, &$result) {
            $orderAndSearch = $key < $countColumnsPosition;
            $this->pushColumns($result, [
                'data'  => $column,
                'name'  => implode('.', [$table, $column]),
                'title' => __('datatables.fields.' . implode('.', [$model, $column]))
            ], $orderAndSearch, $orderAndSearch);
        })->recollect($this->eager_columns)->each(function($column, $key) use (&$result) {
            $name = implode('.', [$key, $column]);
            $this->pushColumns($result, [
                'data'  => $name,
                'name'  => $name,
                'title' => __('datatables.fields.' . $name)
            ]);
        })->recollect($this->count_join_columns)->each(function($column) use (&$result, $model) {
            $this->pushColumns($result, [
                'data'  => $column,
                'name'  => $column,
                'title' => __('datatables.fields.' . implode('.', [$model, $column]))
            ]);
        })->recollect($this->common_columns)->each(function($column) use ($table, &$result) {
            $name = implode('.', [$table, $column]);
            $this->pushColumns($result, [
                'data'  => $column,
                'name'  => $name,
                'title' => __('datatables.fields.' . $column)
            ]);
        });
    }

    protected function pushColumns(&$result, $data, $order = true, $search = true) {
        $result[] = array_merge($data, [
            'orderable' => $order,
            'searchable' => $search
        ]);
        return $result;
    }

    protected function pushOps($datatables, $model = '') {
        if($this->ops === true) {
            if(empty($model)) {
                $this->pushColumns($datatables, [
                    'data'      => 'ops',
                    'name'      => 'ops',
                    'title'     => __('datatables.ops.name'),
                    'exportable'=> false,
                ], false, false);
            } else {
                $datatables = $datatables->addColumn('ops', function($data) use ($model) {
                    return view('partials.admin.options', [
                        'resource' => $model,
                        'id' => $data->id
                    ]);
                });
            }
            $this->raw_columns[] = 'ops';
        }
        return $datatables;
    }

    protected function getColumnParameters() {
        return [
            $columns = array_merge(
                $this->image_columns,
                $this->columns,
                $this->boolean_columns,
                $this->count_columns
            ),
            count($columns) - count($this->count_columns),
            $this->getModelName(),
            $this->getTableName()
        ];
    }

    protected function getTableName() {
        return (new $this->model)->getTable();
    }

    protected function getModelName() {
        return Str::snake(class_basename($this->model));
    }

    protected function wrapImage($model, $image_column, $path = '') {
        $url = asset($path . $model->$image_column);
        return "<a target='_blank' href='{$url}'><img alt='Image' style='max-height:50px' src='{$url}' /></a>";
    }

    protected function getParameters() {
        return array_merge(
            $this->parameters,
            ['order' => [$this->order]],
            ['oLanguage' => __('datatables.menu')]
        );
    }

    protected function setRawColumns($datatables) {
        return $datatables->rawColumns(array_merge(
            $this->raw_columns,
            $this->image_columns
        ));
    }

}
