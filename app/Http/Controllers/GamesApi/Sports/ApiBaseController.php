<?php

namespace App\Http\Controllers\GamesApi\Sports;

class ApiBaseController extends BaseController
{
    public function __construct(){
        parent::__construct();
        $repoName = 'App\\Repository\\GamesApi\\Sports\\ApiBaseRepository';
        $this->repository = new $repoName();
    }
    public function createData(){

        $data = json_decode('{
              "jczq": [
                {
                  "id": 1805056001,
                  "event": "日本职业联赛",
                  "home": "札幌冈萨多",
                  "away": "大阪钢巴",
                  "issue": "180505",
                  "issue_num": "6001",
                  "sell_status": "1,1,2,2,2",
                  "matchtime": 1525539600,
                  "spf": "1.81,3.60,3.35",
                  "rq": "-1,3.42,3.55,1.80",
                  "bf":"6.00,8.50,7.50,18.00,18.00,29.00,50.00,39.00,80.00,150.0,150.0,250.0,80.00,8.00,5.60,15.00,70.00,500.0,7.25,13.00,9.00,39.00,28.00,39.00,100.0,80.00,120.0,400.0,300.0,400.0,150.0",
                  "jq": "12.00,4.70,3.25,3.60,5.00,8.50,14.00,23.00",
                  "bqc": "2.80,13.00,34.00,4.20,5.50,7.80,24.00,13.00,5.50"
                }
              ],
              "jclq": [
                {
                  "id": 1805045301,
                  "event": "美国职业篮球联盟",
                  "home": "金州勇士",
                  "away": "新奥尔良鹈鹕",
                  "issue": "180504",
                  "issue_num": "5301",
                  "sell_status": "1,1,1,2",
                  "matchtime": 1525539600,
                  "sf": "1.32,2.55",
                  "rf": "5.50,1.75,1.75",
                  "sfc": "4.15,3.65,5.55,9.70,18.50,20.00,5.00,5.70,11.00,22.00,39.00,50.00",
                  "dxf": "231.50,1.75,1.75"
                }
              ]
            }',true);

        $this->repository->createData($data);
    }
}
