<?php

namespace App\Console\Commands\ISSUE_SEED;

use App\Issue_seed_jnd;
use Illuminate\Support\Facades\DB;

class ISSUE_SEED_JND28 extends Issue_seed_jnd
{
    protected $signature = 'ISSUE_SEED_JND28';
    protected $code = 'jnd28';
    protected $description = '加拿大28期数生成';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $this->main();
    }
}
