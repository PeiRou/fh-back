<?php

namespace App;


class Excel
{
    public function opennum($type){
        switch ($type){
            case 'game_msjsk3':
                return $this->opennum_k3();
                break;
            case 'game_msft':
            case 'game_mssc':
                return $this->opennum_pk10();
                break;
            case 'game_msssc':
                return $this->opennum_ssc();
                break;
        }
        return false;
    }
    private function opennum_pk10(){
        $tmpArray = [0=>1,1=>2,2=>3,3=>4,4=>5,5=>6,6=>7,7=>8,8=>9,9=>10];
        for ($i=0;$i<10;$i++){
            $tmpLegth = count($tmpArray);
            $tmpRand = rand(0,$tmpLegth-1);
            $res[] = $tmpArray[$tmpRand];
            unset($tmpArray[$tmpRand]);
            $tmpArray2 = [];
            foreach ($tmpArray as&$value)
                $tmpArray2[] = $value;
            $tmpArray = $tmpArray2;
        }
        return implode(',',$res);
    }
    private function opennum_k3(){
        $postArray['n1'] = rand(1,6);
        $postArray['n2'] = rand(1,6);
        $postArray['n3'] = rand(1,6);
        asort($postArray);
        foreach ($postArray as&$v)
            $tmpArray1[] = $v;
        return implode(',',$tmpArray1);
    }
    private function opennum_ssc(){
        return rand(0,9).','.rand(0,9).','.rand(0,9).','.rand(0,9).','.rand(0,9);
    }
}