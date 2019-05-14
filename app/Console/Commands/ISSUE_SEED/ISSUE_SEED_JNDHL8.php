<?php

namespace App\Console\Commands\ISSUE_SEED;

use App\Issue_seed_jnd;
use Illuminate\Support\Facades\DB;

class ISSUE_SEED_JNDHL8 extends Issue_seed_jnd
{
    protected $signature = 'ISSUE_SEED_JNDHL8';
    protected $code = 'jndhl8';
    protected $description = '加拿大欢乐8期数生成';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $this->main();
    }
}
