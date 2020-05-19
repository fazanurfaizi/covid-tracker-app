<?php

namespace App\Http\DataTables;

use App\Http\Controllers\DataTableController;
use App\Models\Post;

class PostDataTable extends DataTableController {

    /**
     * @var string model
     */
    protected $model = Post::class;

    /**
     * Columns to show
     * @var array
     */
    protected $columns = [];

    /**
     * @var bool options
     */
    protected $ops = true;

     /**
      * @return \Illuminate\Database\Query\Builder|\Illuminate\Database\Eloquent\Builder
      */
    public function query() {
        return $this->applyScopes(Post::query());
    }

}

?>
