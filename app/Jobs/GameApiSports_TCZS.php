<?php
/* 获取体彩指数 */
namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Http\Controllers\GamesApi\Sports\PrivodeController;

class GameApiSports_TCZS implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $g_id;
    private $action;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($g_id, $action)
    {
        $this->g_id = $g_id;
        $this->action = $action;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        (new PrivodeController())->action($this->g_id, $this->action);
    }
}
