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
    protected $stub_path;

    // destinations
    protected $controller_path;
    protected $model_path;
    protected $request_path;
    protected $migration_path;
    protected $views_path;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->stub_path = __DIR__.'/stubs/';

        // set destinations for created files
        $this->controller_path = base_path() . '/app/Http/Controllers/';
        $this->model_path = base_path() . '/app/';
        $this->migration_path = base_path() . '/database/migrations/';
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
        $name = str_singular(studly_case($this->argument('name')));

        $kebab_single = kebab_case($name); // object-name
        $studly_single = studly_case($name); // ObjectName
        $snake_single = snake_case($studly_single); // object_name
        $space_single = str_replace('_',' ',$snake_single); // object name
        $title_single = title_case($space_single); // Object Name
        $snake_plural = str_plural($snake_single); // object_names
        $kebab_plural = str_plural($kebab_single); // object-names
        $studly_plural = studly_case($snake_plural); // ObjectNames

        $this->names = [
            'object-name' => $kebab_single,
            'ObjectName' => $studly_single,
            'object_name' => $snake_single,
            'object name' => $space_single,
            'Object Name' => $title_single,
            'object_names' => $snake_plural,
            'object-names' => $kebab_plural,
            'ObjectNames' => $studly_plural,
        ];

        // foreach($this->names as $key=>$val)
        // {
        //     $this->line( $key . ' = '. $val);
        // }

        // controller
        $filename = $this->names['ObjectName'] . 'Controller.php';
        $this->buildFile('controller.php', $this->controller_path . $filename);
        $this->info('Created Controller: app/Http/Controllers/'. $filename);

        // migration
        $filename = date('Y_m_d_H_i_s').'_create_' . $this->names['object_names'] . '_table.php';
        $destination_path = $this->migration_path . $filename;
        $this->buildFile('migration.php', $destination_path);
        $this->info('Created Migration: database/migrations/'. $filename);

        // model
        $filename = $this->names['ObjectName'] . '.php';
        $destination_path = $this->model_path . $filename;
        $this->buildFile('model.php', $destination_path);
        $this->info('Created Model: app/'. $filename);

        // request
        if(!File::exists($this->request_path)) 
        {
            File::makeDirectory($this->request_path);
        }
        $filename = $this->names['ObjectName'] . 'FormRequest.php';
        $destination_path = $this->request_path . $filename;
        $this->buildFile('request.php', $destination_path);
        $this->info('Created Request: app/Http/Requests/'. $filename);

        // views
        $views_folder = $this->views_path.$this->names['object-names'];
        if(!File::exists($views_folder)) 
        {
            File::makeDirectory($views_folder);
        }
        // make each view
        foreach(File::allFiles($this->stub_path . '/views') as $file_path)
        {
            $filename = basename($file_path);
            $destination_path = $views_folder.'/'. $filename;
            $this->buildFile('views/'. $filename, $destination_path);
            $this->info('Created View: resources/views/'.$this->names['object-names'] .'/'. $filename);
        }
    }

    /**
    * Replace all words in a file with the new object name and save the file in the correct destination
    * @param $stub_name the relative path to the file to use as a template
    * @param $destination the path to the new saved file after replacing the words
    */
    public function buildFile($stub_name, $destination)
    {
        $stub_path = $this->stub_path.'/'.$stub_name;
        $content = $this->replaceNames($stub_path);
        File::put($destination, $content);
        // $this->info('Created: '.$destination);
    }

    /**
    * Find a file at $path and for each item in the $this->names array, replace the key with the value.
    * @param $path the full path of the file to replace the words
    * @return the text content of that file after the repacement has been done
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
