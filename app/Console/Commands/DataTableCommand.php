<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class DataTableCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:datatable {name : The name of the datatable - singular}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new datatable';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    protected $name;
    protected $path;

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->name = ucfirst($this->argument('name'));
        $this->path = 'app/Http/DataTables';
        if(!File::isDirectory($this->path)) {
            File::makeDirectory($this->path, 0777, true, true);
        }

        $result = File::put(
            $file = $this->path . '/' . $this->name . 'DataTable' . '.php',
            $this->replaceStub('DataTable')
        );
        $this->printMessage($result, $file);
    }

    /**
     * Print message after run this command
     *
     * @param        $result
     * @param        $filepath
     * @param string $success
     * @param string $warning
     */
    private function printMessage($result, $filepath, $success = 'Created file:', $warning = 'Failed to create file:') {
        $result ? $this->info($success . '' . $filepath) : $this->warn($warning . '' . $filepath);
    }

    /**
     * Replace stub to php file and move to App\Trait
     *
     * @param string $stub
     * @return mixed
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    private function replaceStub($stub) {
        return str_replace(
            ['{{MODEL_NAME}}'],
            [$this->name],
            File::get(base_path('stubs/' . $stub))
        );
    }
}
