<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class MsgClear extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'msg:clear';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'msg record clear';

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
        $file_arr = file(base_path('messages.txt'));
        if(count($file_arr)>50){
            $_arr       = array_slice($file_arr, -50);;
            $_file      = fopen(base_path('messages.txt'), "w") or die("Unable to open file!");
            $content    = implode('',$_arr);
            fwrite($_file, $content);
            fclose($_file);
        }
    }
}
