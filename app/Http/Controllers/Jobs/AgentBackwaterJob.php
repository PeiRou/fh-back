<?php
/**
 * Created by PhpStorm.
 * User: ashen
 * Date: 18-11-8
 * Time: 下午12:11
 */

namespace App\Http\Controllers\Jobs;

class AgentBackwaterJob {

    private $gameId;

    private $issue;

    function __construct($gameId,$issue)
    {
        $this->gameId = $gameId;

        $this->issue = $issue;
    }

    public function addQueue(){
        \App\Jobs\AgentBackwaterSettlement::dispatch($this->gameId,$this->issue)->onQueue($this->setQueueRealName('agentBackwaterSettlement'));
    }

    //队列真实名
    public function setQueueRealName($queue){
        return config('prefix')['queue'] . $queue;
    }
}