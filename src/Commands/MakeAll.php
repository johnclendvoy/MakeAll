<?php

namespace johnclendvoy\MakeAll\Commands;

use File;

use Illuminate\Console\Command;

class MakeAll extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:all {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Make a controller, request, views, model and migration for an object.';

    protected $names;
    protected $stubs_path;

    // destinations
    protected $controller_path;
    protected $request_path;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->stubs_path = __DIR__.'/stubs';

        // set destinations for created files
        $this->controller_path = base_path() . '/app/Http/Controllers/';
        $this->request_path = base_path() . '/app/Http/Requests/';
        $this->views_path = base_path() . '/resources/views/';

        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $name = $this->argument('name');

        $kebab_single = kebab_case($name);
        $studly_single = studly_case($name);
        $snake_single = snake_case($studly_single);
        $space_single = str_replace('_',' ',$snake_single);
        $title_single = title_case($space_single);

        $snake_plural = str_plural($snake_single);
        $kebab_plural = str_plural($kebab_single);
        $studly_plural = str_plural($studly_single);

        $this->names = [
            '_kebab_single_' => $kebab_single,
            '_studly_single_' => $studly_single,
            '_snake_single_' => $snake_single,
            '_space_single_' => $space_single,
            '_title_single_' => $title_single,

            '_snake_plural_' => $snake_plural,
            '_kebab_plural_' => $kebab_plural,
            '_studly_plural_' => $studly_plural,
        ];

        // foreach($this->names as $key=>$val)
        // {
        //     $this->info($key.' = '.$val);
        // }

        TODO make all methids below use buildFile()

        // controller
        $this->buildController();

        // migration
        $this->buildMigration();

        // model
        $this->buildModel();

        // request
        $this->buildRequest();

        // views
        $this->buildViews();
    }

    public function buildFile($stub_path, $destination)
    {
        $content = $this->replaceNames($stub_path);
        File::put($destination, $content);
        $this->info('Created: '.$destination);
    }

    /**
    * Creates a controller for the object.
    *
    */
    public function buildController()
    {
        $stub_path = $this->stubs_path.'/controller.php';
        $file_name = $this->names['_studly_single_'].'Controller.php';

        $this->buildFile($stub_path, $this->controller_path.$file_name);
        $this->info('Created controller: '.$file_name);
    }

    /**
    * Creates a Migration for the object.
    *
    */
    public function buildMigration($stub_path, $destination)
    {
        // name with date
        $stub_path = $this->stubs_path.'/migration.php';
        $file_name = date('Y_m_d_H_i_s').'_create_'. $this->names['_snake_plural_'].'_table.php';
        $destination_path = $this->migration_path.$file_name;
        $this->buildFile($stub_path, $destination_path);
        $this->info('Created request: '.$file_name);
    }

    /**
    * Creates a Model for the object.
    *
    */
    public function buildModel()
    {
        $stub_path = $this->stubs_path.'/migration.php';
        $file_name = $this->names['_studly_single_'].'.php';
        $destination_path = $this->migration_path.$file_name;
        $this->buildFile($stub_path, $destination_path);
        $this->info('Created model: '.$file_name);
    }

    /**
    * Creates a FormRequest for the object.
    *
    */
    public function buildRequest($stub_path)
    {
        if(!File::exists($this->request_path)) 
        {
            File::makeDirectory($this->request_path);
        }

        $file_name = $this->names['_studly_single_'].'FormRequest.php';
        $content = $this->replaceNames($stub_path);
        File::put($this->request_path.$file_name, $content);
        $this->info('Created request: '.$file_name);
    }

    /**
    * Creates a folder full of views for the object.
    *
    */
    public function buildViews($stub_path)
    {
        $views_folder = $this->views_path.$this->names['_kebab_plural_'];

        if(!File::exists($views_folder)) 
        {
            File::makeDirectory($views_folder);
        }

        $files = File::allFiles($stub_path);
        foreach($files as $file_path)
        {
            $file_name = basename($file_path);
            $content = $this->replaceNames($file_path);
            File::put($views_folder.'/'. $file_name, $content);
            $this->info('Created view: '. $file_name);
        }
        $this->info('Created all views');
    }

    /**
    * Replace all placeholders in file at path with the correct object names.
    */
    public function replaceNames($path)
    {
        $content = File::get($path);
        foreach($this->names as $key=>$val)
        {
            $content = str_replace($key, $val, $content);
        }
        return $content;
    }
}
