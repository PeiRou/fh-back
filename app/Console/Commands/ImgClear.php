<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class ImgClear extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'img:clear';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'upload img clear';

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
        $handle = opendir(public_path('chat/uploads'));
        while (($file=readdir($handle))) {
            if($file!=='.' && $file!=='..'){
                if(is_file(public_path('chat/uploads').DIRECTORY_SEPARATOR.$file)){
                    unlink(public_path('chat/uploads').DIRECTORY_SEPARATOR.$file);
                }
            }
        }
        closedir($handle);
    }
}
