<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class CreateFolders extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:folder {folder}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create new folders';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $folder = $this->argument('folder');
        $this->info('Creating folder '. $folder);
        mkdir($folder);
        chgrp($folder, 'www');
        chmod($folder, 0777);
        $this->info('Folder ' . $folder . ' Created');
    }
}
