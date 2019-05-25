<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class clear_file_lock extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'clear_file_lock';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '清除文件锁的文件';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    protected $aFileName = [
        'clearing.txt','clearBet.txt','clearBetHis.txt','clearElse.txt','clearJqBet.txt','clearJqBetHis.txt'
    ];

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $path = storage_path('clear_data');
        foreach ($this->aFileName as $fileName){
            @unlink($path.'/'.$fileName);
        }
    }
}
