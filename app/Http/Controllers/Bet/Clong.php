<?php
    /**
     * User: rouli
     * Date: 2018/5/8
     * Time: 下午7:20
     */

    namespace App\Http\Controllers\Bet;

    use App\Http\Controllers\Controller;
    use Illuminate\Support\Facades\DB;

    class Clong extends Controller
    {
        //彩种id
        private $clong_lottery = array(
            'mssc' => array('id'=>80,'type'=>'car'),     //秒速赛车
            'pk10' => array('id'=>50,'type'=>'car'),     //北京pk10
            'msft' => array('id'=>82,'type'=>'car'),     //秒速飞艇
            'msssc' => array('id'=>81,'type'=>'ssc'),    //秒速时时彩
            'cqssc' => array('id'=>1,'type'=>'ssc'),    //重庆时时彩
            'qqffc' => array('id'=>113,'type'=>'ssc'),    //QQ分分彩
            'xjssc' => array('id'=>4,'type'=>'ssc'),    //新疆时时彩
            'paoma' => array('id'=>99,'type'=>'car'),  //跑马
            'pcdd' => array('id'=>66,'type'=>'pcdd'),    //PC蛋蛋
            'bjkl8' => array('id'=>65,'type'=>'bjkl8'),    //北京快乐8
            'cqxync' => array('id'=>61,'type'=>'xync'),    //重庆幸运农场
            'gd11x5' => array('id'=>21,'type'=>'SEX5'),    //广东11选5
            'gdklsf' => array('id'=>60,'type'=>'xync'),    //广东快乐十分
            'kssc' => array('id'=>801,'type'=>'car'),     //快速赛车
            'ksft' => array('id'=>802,'type'=>'car'),     //快速飞艇
            'ksssc' => array('id'=>803,'type'=>'ssc'),    //快速时时彩
        );
        //开奖第一行
        private $clong_kaijian1 = array(
            'car'=> array(
                'code' => array('GJ','YJ','TSM','TSIM','TWM','DLM','DQM','DBM','DJM','DSHIM'),	//位数的code
                'chname' => array('冠军','亚军','第三名','第四名','第五名','第六名','第七名','第八名','第九名','第十名'),	//类型的中文显示
                'value' => array('1','2','3','4','5','6','7','8','9','10')),					//开奖的数字范围
            'ssc'=> array(
                'code' => array('QIU1','QIU2','QIU3','QIU4','QIU5'),	                        //位数的code
                'chname' => array('第一球','第二球','第三球','第四球','第五球'),                   	//类型的中文显示
                'value' => array('0','1','2','3','4','5','6','7','8','9')),						//开奖的数字范围
            'xync'=> array(
                'code' => array('QIU1','QIU2','QIU3','QIU4','QIU5','QIU6','QIU7','QIU8'),	                                        //位数的code
                'chname' => array('第一球','第二球','第三球','第四球','第五球','第六球','第七球','第八球'),                   	            //类型的中文显示
                'value' => array('1','2','3','4','5','6','7','8','9','10','11','12','13','14','15','16','17','18','19','20')),		//开奖的数字范围
            'SEX5'=> array(
                'code' => array('QIU1','QIU2','QIU3','QIU4','QIU5'),	                        //位数的code
                'chname' => array('第一球','第二球','第三球','第四球','第五球'),                   	//类型的中文显示
                'value' => array('0','1','2','3','4','5','6','7','8','9')),						//开奖的数字范围
        );
        //开奖第二行
        private $clong_kaijian2 = array(
            'car'=> array(
                'code' => array('GJ','YJ','TSM','TSIM','TWM','DLM','DQM','DBM','DJM','DSHIM',           //定位数字长龙
                    'GJDX','YJDX','TSMDX','TSIMDX','TWMDX','DLMDX','DQMDX','DBMDX','DJMDX','DSHIMDX',   //大小
                    'GJDS','YJDS','TSMDS','TSIMDS','TWMDS','DLMDS','DQMDS','DBMDS','DJMDS','DSHIMDS',   //单双
                    'GJLH','YJLH','TSMLH','TSIMLH','TWMLH',                                             //龙虎
                    'GYH','GYHDX','GYHDS')),                                                            //冠亚和
            'ssc'=> array(
                'code' => array('QIU1','QIU2','QIU3','QIU4','QIU5',                     //定位数字长龙
                    'QIU1DX','QIU2DX','QIU3DX','QIU4DX','QIU5DX',                       //定位大小
                    'QIU1DS','QIU2DS','QIU3DS','QIU4DS','QIU5DS',                       //定位单双
                    'ZHDX','ZHDS','ZHLHH')),                                        //总和
            'pcdd'=> array(
                'code' => array(
                    'PCDDZHDX','PCDDZHDS','PCDDZHJDX','PCDDBZ','PCDDZHPS')),                             //PC蛋蛋总和混合波色
            'bjkl8'=> array(
                'code' => array(
                    'bjkl8ZH','bjkl8ZHDX','bjkl8ZHDS','bjkl8ZHDXDS','bjkl8QHH','bjkl8DSH','bjkl8WH')),      //北京快乐八总和长龙
            'xync'=> array(
                'code' => array(
                    'QIU1','QIU2','QIU3','QIU4','QIU5','QIU6','QIU7','QIU8',                                                        //定位数字长龙
                    'NCQIU1DX','NCQIU2DX','NCQIU3DX','NCQIU4DX','NCQIU5DX','NCQIU6DX','NCQIU7DX','NCQIU8DX',                        //大小
                    'NCQIU1DS','NCQIU2DS','NCQIU3DS','NCQIU4DS','NCQIU5DS','NCQIU6DS','NCQIU7DS','NCQIU8DS',                        //单双
                    'NCQIU18LH','NCQIU27LH','NCQIU36LH','NCQIU45LH',                                                                //龙虎
                    'NCQIU1WSDX','NCQIU2WSDX','NCQIU3WSDX','NCQIU4WSDX','NCQIU5WSDX','NCQIU6WSDX','NCQIU7WSDX','NCQIU8WSDX',        //尾数大小
                    'NCQIU1HSDS','NCQIU2HSDS','NCQIU3HSDS','NCQIU4HSDS','NCQIU5HSDS','NCQIU6HSDS','NCQIU7HSDS','NCQIU8HSDS',        //合数单双
                    'NCZHDX','NCZHDS','NCZHWSDX')),                                                                                 //总和
            'SEX5'=> array(
                'code' => array('QIU1','QIU2','QIU3','QIU4','QIU5',                     //定位数字长龙
                    'SEX5-QIU1DX','SEX5-QIU2DX','SEX5-QIU3DX','SEX5-QIU4DX','SEX5-QIU5DX',                       //定位大小
                    'QIU1DS','QIU2DS','QIU3DS','QIU4DS','QIU5DS',                       //定位单双
                    'SEX5-ZHDX','ZHDS','SEX5ZHWSDX','ZHLHH')),                                            //总和
        );

        private $clong_kaijian2_type = array(
            //===== PK10的定位数字
            'GJ'=>array('type'=>'DW','seq'=>'0','chname'=>'冠军'),			//冠军
            'YJ'=>array('type'=>'DW','seq'=>'1','chname'=>'亚军'),			//亚军
            'TSM'=>array('type'=>'DW','seq'=>'2','chname'=>'第三名'),		//第三名
            'TSIM'=>array('type'=>'DW','seq'=>'3','chname'=>'第四名'),		//第四名
            'TWM'=>array('type'=>'DW','seq'=>'4','chname'=>'第五名'),		//第五名
            'DLM'=>array('type'=>'DW','seq'=>'5','chname'=>'第六名'),		//第六名
            'DQM'=>array('type'=>'DW','seq'=>'6','chname'=>'第七名'),		//第七名
            'DBM'=>array('type'=>'DW','seq'=>'7','chname'=>'第八名'),		//第八名
            'DJM'=>array('type'=>'DW','seq'=>'8','chname'=>'第九名'),		//第九名
            'DSHIM'=>array('type'=>'DW','seq'=>'9','chname'=>'第十名'),		//第十名
            //===== PK10的定位大小
            'GJDX'=>array('type'=>'CARDWDX','seq'=>'0','chname'=>'冠军'),		//冠军-大小
            'YJDX'=>array('type'=>'CARDWDX','seq'=>'1','chname'=>'亚军'),		//亚军-大小
            'TSMDX'=>array('type'=>'CARDWDX','seq'=>'2','chname'=>'第三名'),	    //第三名-大小
            'TSIMDX'=>array('type'=>'CARDWDX','seq'=>'3','chname'=>'第四名'),	//第四名-大小
            'TWMDX'=>array('type'=>'CARDWDX','seq'=>'4','chname'=>'第五名'),	    //第五名-大小
            'DLMDX'=>array('type'=>'CARDWDX','seq'=>'5','chname'=>'第六名'),	    //第六名-大小
            'DQMDX'=>array('type'=>'CARDWDX','seq'=>'6','chname'=>'第七名'),	    //第七名-大小
            'DBMDX'=>array('type'=>'CARDWDX','seq'=>'7','chname'=>'第八名'),	    //第八名-大小
            'DJMDX'=>array('type'=>'CARDWDX','seq'=>'8','chname'=>'第九名'),	    //第九名-大小
            'DSHIMDX'=>array('type'=>'CARDWDX','seq'=>'9','chname'=>'第十名'),	//第十名-大小
            //===== PK10的定位龙虎
            'GJLH'=>array('type'=>'LHH','seq'=>'','nseq'=>'0,9','ishe'=>'0','chname'=>'冠军'),		//冠军-龙虎
            'YJLH'=>array('type'=>'LHH','seq'=>'','nseq'=>'1,8','ishe'=>'0','chname'=>'亚军'),		//亚军-龙虎
            'TSMLH'=>array('type'=>'LHH','seq'=>'','nseq'=>'2,7','ishe'=>'0','chname'=>'第三名'),	//第三名-龙虎
            'TSIMLH'=>array('type'=>'LHH','seq'=>'','nseq'=>'3,6','ishe'=>'0','chname'=>'第四名'),	//第四名-龙虎
            'TWMLH'=>array('type'=>'LHH','seq'=>'','nseq'=>'4,5','ishe'=>'0','chname'=>'第五名'),	//第五名-龙虎
            //===== PK10的定位单双
            'GJDS'=>array('type'=>'DWDS','seq'=>'0','chname'=>'冠军'),		//冠军-单双
            'YJDS'=>array('type'=>'DWDS','seq'=>'1','chname'=>'亚军'),		//亚军-单双
            'TSMDS'=>array('type'=>'DWDS','seq'=>'2','chname'=>'第三名'),	//第三名-单双
            'TSIMDS'=>array('type'=>'DWDS','seq'=>'3','chname'=>'第四名'),	//第四名-单双
            'TWMDS'=>array('type'=>'DWDS','seq'=>'4','chname'=>'第五名'),	//第五名-单双
            'DLMDS'=>array('type'=>'DWDS','seq'=>'5','chname'=>'第六名'),	//第六名-单双
            'DQMDS'=>array('type'=>'DWDS','seq'=>'6','chname'=>'第七名'),	//第七名-单双
            'DBMDS'=>array('type'=>'DWDS','seq'=>'7','chname'=>'第八名'),	//第八名-单双
            'DJMDS'=>array('type'=>'DWDS','seq'=>'8','chname'=>'第九名'),	//第九名-单双
            'DSHIMDS'=>array('type'=>'DWDS','seq'=>'9','chname'=>'第十名'),	//第十名-单双
            //===== PK10的冠亚和
            'GYH'=>array('type'=>'GYH','seq'=>'','nseq'=>'0,1','ishe'=>'1','chname'=>'冠、亚军和'),		    //冠亚军和
            'GYHDX'=>array('type'=>'GYHDX','seq'=>'','nseq'=>'0,1','ishe'=>'1','chname'=>'冠、亚军和'),		//冠亚军和-大小
            'GYHDS'=>array('type'=>'GYHDS','seq'=>'','nseq'=>'0,1','ishe'=>'1','chname'=>'冠、亚军和'),		//冠亚军和-单双
            //===== 时时彩的定位数字
            'QIU1'=>array('type'=>'DW','seq'=>'0','chname'=>'第一球'),			//第一球
            'QIU2'=>array('type'=>'DW','seq'=>'1','chname'=>'第二球'),			//第二球
            'QIU3'=>array('type'=>'DW','seq'=>'2','chname'=>'第三球'),		    //第三球
            'QIU4'=>array('type'=>'DW','seq'=>'3','chname'=>'第四球'),		    //第四球
            'QIU5'=>array('type'=>'DW','seq'=>'4','chname'=>'第五球'),		    //第五球
            'QIU6'=>array('type'=>'DW','seq'=>'5','chname'=>'第六球'),		    //第六球
            'QIU7'=>array('type'=>'DW','seq'=>'6','chname'=>'第七球'),		    //第七球
            'QIU8'=>array('type'=>'DW','seq'=>'7','chname'=>'第八球'),		    //第八球
            //===== 时时彩的定位大小
            'QIU1DX'=>array('type'=>'SSCDWDX','seq'=>'0','chname'=>'第一球'),		//第一球-大小
            'QIU2DX'=>array('type'=>'SSCDWDX','seq'=>'1','chname'=>'第二球'),		//第二球-大小
            'QIU3DX'=>array('type'=>'SSCDWDX','seq'=>'2','chname'=>'第三球'),	    //第三球-大小
            'QIU4DX'=>array('type'=>'SSCDWDX','seq'=>'3','chname'=>'第四球'),	    //第四球-大小
            'QIU5DX'=>array('type'=>'SSCDWDX','seq'=>'4','chname'=>'第五球'),	    //第五球-大小
            //===== 时时彩的定位单双
            'QIU1DS'=>array('type'=>'DWDS','seq'=>'0','chname'=>'第一球'),		//第一球-单双
            'QIU2DS'=>array('type'=>'DWDS','seq'=>'1','chname'=>'第二球'),		//第二球-单双
            'QIU3DS'=>array('type'=>'DWDS','seq'=>'2','chname'=>'第三球'),	    //第三球-单双
            'QIU4DS'=>array('type'=>'DWDS','seq'=>'3','chname'=>'第四球'),	    //第四球-单双
            'QIU5DS'=>array('type'=>'DWDS','seq'=>'4','chname'=>'第五球'),	    //第五球-单双
            //===== 时时彩的总和
            'ZH'=>array('type'=>'ZH','seq'=>'','nseq'=>'0,1,2,3,4','ishe'=>'1','chname'=>'总和'),		    //总和
            'ZHDX'=>array('type'=>'ZHDX','seq'=>'','nseq'=>'0,1,2,3,4','ishe'=>'1','chname'=>'总和'),		//总和-大小
            'ZHDS'=>array('type'=>'ZHDS','seq'=>'','nseq'=>'0,1,2,3,4','ishe'=>'1','chname'=>'总和'),		//总和-单双
            'ZHLHH'=>array('type'=>'LHH','seq'=>'','nseq'=>'0,4','ishe'=>'0','chname'=>'总和'),		        //总和-龙虎和
            //===== PC蛋蛋的混合.波色
            'PCDDZHDX'=>array('type'=>'PCDDZHDX','seq'=>'','nseq'=>'0,1,2','ishe'=>'1','chname'=>'混合'),		//混合-大小
            'PCDDZHDS'=>array('type'=>'ZHDS','seq'=>'','nseq'=>'0,1,2','ishe'=>'1','chname'=>'混合'),		    //混合-单双
            'PCDDZHJDX'=>array('type'=>'PCDDZHJDX','seq'=>'','nseq'=>'0,1,2','ishe'=>'1','chname'=>'混合'),		//混合-极大极小
            'PCDDBZ'=>array('type'=>'PCDDBZ','seq'=>'','nseq'=>'0,1,2','ishe'=>'0','chname'=>'混合'),		    //混合-豹子
            'PCDDZHPS'=>array('type'=>'PCDDZHPS','seq'=>'','nseq'=>'0,1,2','ishe'=>'1','chname'=>'波色'),		//波色-红波.蓝波.绿波
            //===== 北京快乐8 总和、总和过关
            'bjkl8ZH'=>array('type'=>'ZH','seq'=>'','nseq'=>'0,1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19','ishe'=>'1','chname'=>'总和'),		            //总和
            'bjkl8ZHDX'=>array('type'=>'bjkl8ZHDX','seq'=>'','nseq'=>'0,1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19','ishe'=>'1','chname'=>'总和大小'),		    //总和-大小810
            'bjkl8ZHDS'=>array('type'=>'ZHDS','seq'=>'','nseq'=>'0,1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19','ishe'=>'1','chname'=>'总和单双'),		        //总和-单双
            'bjkl8ZHDXDS'=>array('type'=>'bjkl8ZHDXDS','seq'=>'','nseq'=>'0,1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19','ishe'=>'1','chname'=>''),		//总和大小-单双
            'bjkl8QHH'=>array('type'=>'bjkl8QHH','seq'=>'','nseq'=>'0,1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19','ishe'=>'0','chname'=>'前后和'),		    //前后和
            'bjkl8DSH'=>array('type'=>'bjkl8DSH','seq'=>'','nseq'=>'0,1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19','ishe'=>'0','chname'=>'单双和'),		    //单双和
            'bjkl8WH'=>array('type'=>'bjkl8WH','seq'=>'','nseq'=>'0,1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19','ishe'=>'1','chname'=>'总和'),		        //总和-五行
            //===== 重庆幸运农场 定位大小
            'NCQIU1DX'=>array('type'=>'NCDWDX','seq'=>'0','chname'=>'第一球'),		//第一球-大小
            'NCQIU2DX'=>array('type'=>'NCDWDX','seq'=>'1','chname'=>'第二球'),		//第二球-大小
            'NCQIU3DX'=>array('type'=>'NCDWDX','seq'=>'2','chname'=>'第三球'),	    //第三球-大小
            'NCQIU4DX'=>array('type'=>'NCDWDX','seq'=>'3','chname'=>'第四球'),	    //第四球-大小
            'NCQIU5DX'=>array('type'=>'NCDWDX','seq'=>'4','chname'=>'第五球'),	    //第五球-大小
            'NCQIU6DX'=>array('type'=>'NCDWDX','seq'=>'5','chname'=>'第六球'),	    //第六球-大小
            'NCQIU7DX'=>array('type'=>'NCDWDX','seq'=>'6','chname'=>'第七球'),	    //第七球-大小
            'NCQIU8DX'=>array('type'=>'NCDWDX','seq'=>'7','chname'=>'第八球'),	    //第八球-大小
            //===== 重庆幸运农场 定位单双
            'NCQIU1DS'=>array('type'=>'DWDS','seq'=>'0','chname'=>'第一球'),		//第一球-单双
            'NCQIU2DS'=>array('type'=>'DWDS','seq'=>'1','chname'=>'第二球'),		//第二球-单双
            'NCQIU3DS'=>array('type'=>'DWDS','seq'=>'2','chname'=>'第三球'),	    //第三球-单双
            'NCQIU4DS'=>array('type'=>'DWDS','seq'=>'3','chname'=>'第四球'),	    //第四球-单双
            'NCQIU5DS'=>array('type'=>'DWDS','seq'=>'4','chname'=>'第五球'),	    //第五球-单双
            'NCQIU6DS'=>array('type'=>'DWDS','seq'=>'5','chname'=>'第六球'),	    //第六球-单双
            'NCQIU7DS'=>array('type'=>'DWDS','seq'=>'6','chname'=>'第七球'),	    //第七球-单双
            'NCQIU8DS'=>array('type'=>'DWDS','seq'=>'7','chname'=>'第八球'),	    //第八球-单双
            //===== 重庆幸运农场 定位龙虎
            'NCQIU18LH'=>array('type'=>'LHH','seq'=>'','nseq'=>'0,7','ishe'=>'0','chname'=>'第一球'),		//第一球-龙虎
            'NCQIU27LH'=>array('type'=>'LHH','seq'=>'','nseq'=>'1,6','ishe'=>'0','chname'=>'第二球'),		//第二球-龙虎
            'NCQIU36LH'=>array('type'=>'LHH','seq'=>'','nseq'=>'2,5','ishe'=>'0','chname'=>'第三球'),	    //第三球-龙虎
            'NCQIU45LH'=>array('type'=>'LHH','seq'=>'','nseq'=>'3,4','ishe'=>'0','chname'=>'第四球'),	    //第四球-龙虎
            //===== 重庆幸运农场 定位尾数大小
            'NCQIU1WSDX'=>array('type'=>'WSDX','seq'=>'0','chname'=>'第一球尾数'),		//第一球-单双
            'NCQIU2WSDX'=>array('type'=>'WSDX','seq'=>'1','chname'=>'第二球尾数'),		//第二球-单双
            'NCQIU3WSDX'=>array('type'=>'WSDX','seq'=>'2','chname'=>'第三球尾数'),	    //第三球-单双
            'NCQIU4WSDX'=>array('type'=>'WSDX','seq'=>'3','chname'=>'第四球尾数'),	    //第四球-单双
            'NCQIU5WSDX'=>array('type'=>'WSDX','seq'=>'4','chname'=>'第五球尾数'),	    //第五球-单双
            'NCQIU6WSDX'=>array('type'=>'WSDX','seq'=>'5','chname'=>'第六球尾数'),	    //第六球-单双
            'NCQIU7WSDX'=>array('type'=>'WSDX','seq'=>'6','chname'=>'第七球尾数'),	    //第七球-单双
            'NCQIU8WSDX'=>array('type'=>'WSDX','seq'=>'7','chname'=>'第八球尾数'),	    //第八球-单双
            //===== 重庆幸运农场 定位合数单双
            'NCQIU1HSDS'=>array('type'=>'HSDS','seq'=>'0','chname'=>'第一球合数'),		//第一球-单双
            'NCQIU2HSDS'=>array('type'=>'HSDS','seq'=>'1','chname'=>'第二球合数'),		//第二球-单双
            'NCQIU3HSDS'=>array('type'=>'HSDS','seq'=>'2','chname'=>'第三球合数'),	    //第三球-单双
            'NCQIU4HSDS'=>array('type'=>'HSDS','seq'=>'3','chname'=>'第四球合数'),	    //第四球-单双
            'NCQIU5HSDS'=>array('type'=>'HSDS','seq'=>'4','chname'=>'第五球合数'),	    //第五球-单双
            'NCQIU6HSDS'=>array('type'=>'HSDS','seq'=>'5','chname'=>'第六球合数'),	    //第六球-单双
            'NCQIU7HSDS'=>array('type'=>'HSDS','seq'=>'6','chname'=>'第七球合数'),	    //第七球-单双
            'NCQIU8HSDS'=>array('type'=>'HSDS','seq'=>'7','chname'=>'第八球合数'),	    //第八球-单双
            //===== 重庆幸运农场 总和
            'NCZHDX'=>array('type'=>'NCZHDX','seq'=>'','nseq'=>'0,1,2,3,4,5,6,7','ishe'=>'1','chname'=>'总和'),		            //总和-大小
            'NCZHDS'=>array('type'=>'ZHDS','seq'=>'','nseq'=>'0,1,2,3,4,5,6,7','ishe'=>'1','chname'=>'总和'),		            //总和-单双
            'NCZHWSDX'=>array('type'=>'WSDX','seq'=>'','nseq'=>'0,1,2,3,4,5,6,7','ishe'=>'1','chname'=>'总和尾数'),		            //总和-尾数大小
            //===== 11选5 定位大小
            'SEX5-QIU1DX'=>array('type'=>'NDWDX','seq'=>'0','bech'=>'6','chname'=>'第一球'),		//第一球-大小
            'SEX5-QIU2DX'=>array('type'=>'NDWDX','seq'=>'1','bech'=>'6','chname'=>'第二球'),		//第二球-大小
            'SEX5-QIU3DX'=>array('type'=>'NDWDX','seq'=>'2','bech'=>'6','chname'=>'第三球'),	    //第三球-大小
            'SEX5-QIU4DX'=>array('type'=>'NDWDX','seq'=>'3','bech'=>'6','chname'=>'第四球'),	    //第四球-大小
            'SEX5-QIU5DX'=>array('type'=>'NDWDX','seq'=>'4','bech'=>'6','chname'=>'第五球'),	    //第五球-大小
            //===== 11选5 总和大小
            'SEX5-ZHDX'=>array('type'=>'NZHDXH','seq'=>'','nseq'=>'0,1,2,3,4','bech'=>'31','bechH'=>'30','ishe'=>'1','chname'=>'总和'),		//总和-大小和
            //===== 11选5 总和尾数大小
            'SEX5ZHWSDX'=>array('type'=>'WSDX','seq'=>'','nseq'=>'0,1,2,3,4','ishe'=>'1','chname'=>'总和尾数'),		            //总和-尾数大小
        );
        /**
         * 长龙榜特殊处理
         * 执行步骤
         * 1. setKaijian('mssc',1,"3,3,10,9,1,8,6,5,2,7")
         *    type 1 将值塞到定位的累积统计
         * 2. setKaijian('mssc',2,"3,3,10,9,1,8,6,5,2,7")
         *    type 2 将值塞到长龙排行统计
         */
        public function setKaijian($lottery='mssc',$kaijianType=1,$number="3,4,10,9,1,8,6,5,2,7"){
            $clong_lottery = $this->clong_lottery;
            $clong_kaijian2_type = $this->clong_kaijian2_type;
            $lotteryId = $clong_lottery[$lottery]['id'];				//id
            $lotteryType = $clong_lottery[$lottery]['type'];			//类型
            $numberArray = explode(',',$number);		//开奖号码转数组
            if($kaijianType==1){
                $clong_kaijian1 = $this->clong_kaijian1[$lotteryType];	//开奖第一行
                switch($lotteryType){
                    case 'car':		//赛车
                    case 'ssc':		//时时彩
                    case 'xync':    //重庆幸运农场
                    case 'SEX5':    //广东11选5
                        foreach($numberArray as $key => $val){
                            $code = $clong_kaijian1['code'][$key];
                            $chname = $clong_kaijian1['chname'][$key];
                            $val = intval($val);
                            $hadValue = DB::table('clong_kaijian1')->select('num')->where('lotteryid',$lotteryId)->where('code',$code)->where('value',$val)->first();
                            if(empty($hadValue))    //数据库没值则新增，有值则更新数量
                                DB::table('clong_kaijian1')->insert(['lotteryid' => $lotteryId,'code' => $code,'chname' => $chname,'value' => $val,'num' => 1]);
                            else
                                DB::table('clong_kaijian1')->where('lotteryid',$lotteryId)->where('code',$code)->where('value',$val)->increment('num');
                        }
                        break;
                }
            } else if($kaijianType==2){
                $clong_kaijian2 = $this->clong_kaijian2[$lotteryType];	//开奖第二行						//开奖第二行
                foreach($clong_kaijian2['code'] as $key => $val){
                    $type = $clong_kaijian2_type[$val]['type'];													//kaijian2的型别
                    $seq = $clong_kaijian2_type[$val]['seq'];													//kaijian2的连续
                    $bech = isset($clong_kaijian2_type[$val]['bech'])?$clong_kaijian2_type[$val]['bech']:'';    //kaijian2的比数的基准值-大
                    $bechH = isset($clong_kaijian2_type[$val]['bechH'])?$clong_kaijian2_type[$val]['bechH']:''; //kaijian2的比数的基准值-和
                    $chname = $clong_kaijian2_type[$val]['chname'];												//kaijian2的中文显示
                    $nseq = isset($clong_kaijian2_type[$val]['nseq'])?$clong_kaijian2_type[$val]['nseq']:'';	//kaijian2的不连续
                    $ishe = isset($clong_kaijian2_type[$val]['ishe'])?$clong_kaijian2_type[$val]['ishe']:'0';	//kaijian2的是否有和值

                    if($seq!='')									//如果kaijian2有指定顺序
                        $num_val = (int)$numberArray[$seq];
                    else if(!empty($nseq)){			                //不连续
                        $seq_array = explode(',',$nseq);
                        $num_val = 0;
                        $num_array = array();
                        if($ishe == 1){						//计算和值
                            foreach($seq_array as&$val1){
                                $num_val += intval($numberArray[$val1]);
                            }
                        }else{
                            foreach($seq_array as&$val1){
                                $num_array[] = $numberArray[$val1];
                            }
                        }
                    }

                    switch($type){
                        case 'DW':                      //---指定单一位
                        case 'GYH':                     //---指定多位的和值-前二-冠亚军和值
                        case 'ZH':                      //---指定多位的和值-总和
                            break;
                        case 'CARDWDX':                 //---指定单一位-赛车类型的大小
                            $num_val = $num_val >= 6?"大":"小";
                            break;
                        case 'NDWDX':                 //---指定单一位-时时彩类型的大小  (新的带基准值)
                            $tmp = explode('-',$val);
                            $val = $tmp[1];
                            $num_val = $num_val >= $bech?"大":"小";
                            break;
                        case 'SSCDWDX':                 //---指定单一位-时时彩类型的大小
                            $num_val = $num_val >= 5?"大":"小";
                            break;
                        case 'NCDWDX':                   //---指定单一位-重庆幸运农场类型的大小
                            $num_val = $num_val >= 11?"大":"小";
                            break;
                        case 'GYHDX':                   //---指定多位的和值-前二-冠亚军和值大小
                            $num_val = $num_val >= 12?"大":"小";
                            break;
                        case 'ZHDX':                    //---指定多位的和值-总和大小
                            $num_val = $num_val >= 23?"大":"小";
                            break;
                        case 'NCZHDX':                    //---指定多位的和值-总和大小
                            $num_val = $num_val >= 85?"大":($num_val <= 83?"小":"和");
                            break;
                        case 'NZHDXH':                    //---指定多位的和值-总和大小和  (新的带基准值)
                            $tmp = explode('-',$val);
                            $val = $tmp[1];
                            $num_val = $num_val >= $bech?"大":($num_val == $bechH?"和":"小");
                            break;
                        case 'DWDS':                    //---指定单一位-单双
                        case 'GYHDS':                   //---指定多位的和值-前二-冠亚军和值单双
                        case 'ZHDS':                    //---指定多位的和值-总和单双
                            $num_val = $num_val%2==1 ?"单":"双";
                            break;
                        case 'WSDX':                    //---指定单一位-尾数大小
                            $num_val = $num_val%10>=5 ?"大":"小";
                            break;
                        case 'HSDS':                    //---指定单一位-合数单双
                            $num_val = (string)$num_val;
                            if(strlen($num_val)==1)
                                $num_val = '0'.$num_val;
                            $splNum = str_split($num_val);
                            $num_val = ($splNum[0] + $splNum[1])%2 == 1 ?"单":"双";
                            break;
                        case 'LHH':                     //---指定多位-龙虎和
                            if( $num_array[0]>$num_array[1]){
                                $num_val = '龙';
                            }else if( $num_array[0]<$num_array[1]){
                                $num_val = '虎';
                            }else{
                                $num_val = '和';
                            }
                            break;
                        case 'PCDDZHDX':                //---指定多位的和值-PC蛋蛋总和大小
                            $num_val = $num_val >= 14?"大":"小";
                            break;
                        case 'PCDDZHJDX':               //---指定多位的和值-PC蛋蛋总和极大极小
                            if($num_val >= 23)
                                $num_val = "极大";
                            else if($num_val <= 4)
                                $num_val = "极小";
                            else
                                $num_val = "";
                            break;
                        case 'PCDDBZ':                  //---指定多位-PC蛋蛋豹子
                            if($num_array[0]==$num_array[1] && $num_array[1]==$num_array[2])
                                $num_val = "豹子";
                            else
                                $num_val = "";
                            break;
                        case 'PCDDZHPS':                //---指定多位的和值-PC蛋蛋总和 红波.蓝波.绿波
                            if(in_array($num_val,array(3,6,9,12,15,18,21,24)))
                                $num_val = "红波";
                            else if(in_array($num_val,array(1,4,7,10,16,19,22,25)))
                                $num_val = "蓝波";
                            else if(in_array($num_val,array(2,5,8,11,17,20,23,26)))
                                $num_val = "绿波";
                            else
                                $num_val = "";
                            break;
                        case 'bjkl8ZHDX':                    //---指定多位的和值-总和-大小810
                            if($num_val > 810)
                                $num_val = "大";
                            else if($num_val < 810)
                                $num_val = "小";
                            else
                                $num_val = "810";
                            break;
                        case 'bjkl8ZHDXDS':                    //---指定多位的和值-总和-总和大小-单双
                            if($num_val > 810)
                                $num_val = $num_val%2==1 ?"总大单":"总大双";
                            else if($num_val < 810)
                                $num_val = $num_val%2==1 ?"总小单":"总小双";
                            else
                                $num_val = "";
                            break;
                        case 'bjkl8QHH':                        //---指定多位-前后和
                            sort($num_array);       //先由小到大排序
                            $smallNum = 0;
                            foreach ($num_array as $key2 => $val2){
                                if($val2<=40)
                                    $smallNum++;
                                else
                                    break;
                            }
                            $num_val = $smallNum==10?"和":($smallNum>10?"前":"后");
                            break;
                        case 'bjkl8DSH':                        //---指定多位-单双和
                            sort($num_array);       //先由小到大排序
                            $dNum = 0;
                            foreach ($num_array as $key2 => $val2){
                                if($val2%2==1)
                                    $dNum++;
                            }
                            $num_val = $dNum==10?"和":($dNum>10?"单":"双");
                            break;
                        case 'bjkl8WH':                         //---指定多位-总和-五行
                            if($num_val >= 210 && $num_val<=695)
                                $num_val = "金";
                            else if($num_val >= 696 && $num_val<=763)
                                $num_val = "木";
                            else if($num_val >= 764 && $num_val<=855)
                                $num_val = "水";
                            else if($num_val >= 856 && $num_val<=923)
                                $num_val = "火";
                            else if($num_val >= 924 && $num_val<=1410)
                                $num_val = "土";
                            else
                                $num_val = "";
                            break;
                    }
                    //删除当日用不到的数据
                    $aTmp = DB::select(" select id from clong_kaijian2 WHERE lotteryid = :lotteryid and code = :code and clong_num =((SELECT max(clong_num) FROM `clong_kaijian2` WHERE lotteryid = :lotteryid1 and code = :code1 ) -51)",
                        ['lotteryid' => $lotteryId,'code' => $val,'lotteryid1' => $lotteryId,'code1' => $val]);
                    if(!empty($aTmp)) {
                        $aTmp = $aTmp[0];
                        DB::table('clong_kaijian2')->where('lotteryid', $lotteryId)->where('code', $val)->where('id', "<=", $aTmp->id)->delete();
                    }
                    $aTmp = DB::select("select clong_num as max_num ,value from clong_kaijian2 where clong_num = (
                    select max(clong_num) as max_num from clong_kaijian2 where lotteryid = :lotteryid and code =:code ) and lotteryid =:lotteryid1 and code =:code1 ",
                        ['lotteryid' => $lotteryId,'code' => $val,'lotteryid1' => $lotteryId,'code1' => $val]);
                    if(empty($aTmp)){                    //如果库里没数据，则新增index 1，数量 1
                        DB::table('clong_kaijian2')->insert([
                            'lotteryid'=> $lotteryId,
                            'code'=> $val,
                            'chname' => $chname,        //中文显示
                            'clong_num'=> 1,            //index 1
                            'value'=> $num_val,
                            'num'=> 1
                        ]);
                    }else {
                        $aTmp = $aTmp[0];
                        if($aTmp->value == $num_val){             //如果库里最大数据跟现在一样，则直接加1
                            DB::table('clong_kaijian2')->where('lotteryid',$lotteryId)->where('clong_num',$aTmp->max_num)->where('code',$val)
                                ->increment('num');
                        }else{
                            DB::table('clong_kaijian2')->insert([    //如果库里最大数据跟现在不一样，则新增一笔，index +1
                                'lotteryid'=> $lotteryId,
                                'code'=> $val,
                                'chname' => $chname,        //中文显示
                                'clong_num'=> $aTmp->max_num + 1,
                                'value'=> $num_val,
                                'num'=> 1
                            ]);
                        }
                    }
                }
            }
        }
    }
