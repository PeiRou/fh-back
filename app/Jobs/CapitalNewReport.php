<?php

namespace App\Jobs;

use App\Capital;
use App\CapitalNew;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use SameClass\Model\CapitalNewModel;

class CapitalNewReport implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $aDateTime;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($aParam)
    {
        $this->aDateTime = $aParam;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        ini_set('memory_limit','2048M');
        $iList = Capital::capitalNew($this->aDateTime,$this->aDateTime.' 23:59:59')[0] ?? [];
        $aTypeField = CapitalNewModel::$aTypeField;
        $aArray = [];
        $iTime = date('Y-m-d H:i:s');
        foreach ($aTypeField as $iTypeField){
            $iField = $iTypeField['field'];
            if(!empty($iList->$iField)) {
                $aArray[] = [
                    'fieldId' => $iTypeField['id'],
                    'field' => $iTypeField['field'],
                    'filedTitle' => $iTypeField['title'],
                    'cateId' => $iTypeField['cateId'],
                    'add' => $iTypeField['add'],
                    'money' => abs($iList->$iField),
                    'date' => $this->aDateTime,
                    'created_at' => $iTime,
                    'updated_at' => $iTime,
                ];
            }
        }
        CapitalNew::where('date',$this->aDateTime)->delete();
        CapitalNew::insert($aArray);
    }
}
