<?php
/**
 * Created by PhpStorm.
 * User: jeremy
 * Date: 2019/3/14
 * Time: 下午20:01
 */

namespace App\Http\Controllers\Bet;

use App\Excel;
use App\ExcelLotteryLHC;
use App\Http\Controllers\Job\AgentBackwaterJob;
use Illuminate\Support\Facades\DB;

class New_Shflhc extends Excel
{
    protected $arrPlay_id = array(91960914340,91960914341,91960914342,91960914343,91960914344,91960914345,91960914346,91960914347,91960914348,91960914349,91960914350,91960914351,91960914352,91960914353,91960914354,91960914355,91960914356,91960914357,91960914358,91960914359,91960914360,91960914361,91960914362,91960914363,91960914364,91960914365,91960914366,91960914367,91960914368,91960914369,91960914370,91960914371,91960914372,91960914373,91960914374,91960914375,91960914376,91960914377,91960914378,91960914379,91960914380,91960914381,91960914382,91960914383,91960914384,91960914385,91960914386,91960914387,91960914388,91960914389,91960914390,91960914391,91960914392,91960914393,91960914394,91960914395,91960914396,91960914397,91960914398,91960914399,91960914400,91960914401,91960914402,91960914403,91960914404,91960914405,91960914406,91960914407,91960914408,91960914409,91960914410,91960914411,91960914412,91960914413,91960914414,91960914415,91960914416,91960914417,91960914418,91960914419,91960914420,91960914421,91960914422,91960914423,91960914424,91960914425,91960914426,91960914427,91960914428,91960914429,91960914430,91960914431,91960914432,91960914433,91960914434,91960914435,91960914436,91960914437,91961014438,91961014439,91961014440,91961014441,91961014442,91961014443,91961014444,91961014445,91961014446,91961014447,91961014448,91961014449,91961014450,91961014451,91961014452,91961014453,91961014454,91961014455,91961014456,91961014457,91961014458,91961014459,91961014460,91961014461,91961114462,91961114463,91961114464,91961114465,91961114466,91961114467,91961114468,91961114469,91961114470,91961114471,91961114472,91961114473,91961114474,91961114475,91961114476,91961114477,91961114478,91961114479,91961114480,91961114481,91961114482,91961114483,91961114484,91961114485,91961114486,91961114487,91961114488,91961214489,91961214490,91961214491,91961214492,91961214493,91961214494,91961214495,91961214496,91961214497,91961214498,91961214499,91961214500,91961314501,91961314502,91961314503,91961314504,91961314505,91961314506,91961314507,91961314508,91961314509,91961314510,91961414511,91961414512,91961414513,91961414514,91961414515,91961414516,91961414517,91961414518,91961414519,91961414520,91961414521,91961414522,91961414523,91961414524,91961414525,91961514526,91961514527,91961514528,91961514529,91961514530,91961514531,91961514532,91961514533,91961514534,91961514535,91961514536,91961514537,91961514538,91961514539,91961514540,91961514541,91961514542,91961514543,91961514544,91961514545,91961514546,91961514547,91961514548,91961514549,91961514550,91961514551,91961514552,91961514553,91961514554,91961514555,91961514556,91961514557,91961514558,91961514559,91961514560,91961514561,91961514562,91961514563,91961514564,91961514565,91961514566,91961514567,91961514568,91961514569,91961514570,91961514571,91961514572,91961514573,91961514574,91961714575,91961714576,91961714577,91961714578,91961714579,91961814580,91961814581,91961814582,91961814583,91961814584,91961814585,91961814586,91961814587,91961814588,91961814589,91961814590,91961814591,91961814592,91961814593,91961814594,91961814595,91961814596,91961814597,91961814598,91961814599,91961814600,91961814601,91961914602,91961914603,91961914604,91961914605,91961914606,91961914607,91961914608,91961914609,91961914610,91961914611,91961914612,91961914613,91962014614,91962014615,91962014616,91962014617,91962114618,91962114619,91962114620,91962114621,91962114622,91962114623,91962114624,91962114625,91962214626,91962214627,91962214628,91962214629,91962214630,91962214631,91962214632,91962214633,91962314634,91962314635,91962314636,91962314637,91962314638,91962314639,91962314640,91962314641,91962314642,91962314643,91962314644,91962314645,91962314646,91962314647,91962314648,91962314649,91962314650,91962314651,91962314652,91962314653,91962314654,91962314655,91962314656,91962314657,91962314658,91962314659,91962314660,91962314661,91962314662,91962314663,91962314664,91962314665,91962314666,91962314667,91962314668,91962314669,91962314670,91962314671,91962314672,91962314673,91962314674,91962314675,91962314676,91962314677,91962314678,91962314679,91962314680,91962314681,91962314682,91962314683,91962314684,91962314685,91962314686,91962314687,91962314688,91962314689,91962314690,91962314691,91962314692,91962314693,91962314694,91962314695,91962314696,91962314697,91962314698,91962314699,91962314700,91962314701,91962314702,91962314703,91962314704,91962314705,91962314706,91962314707,91962314708,91962314709,91962314710,91962314711,91962314712,91962314713,91962314714,91962314715,91962314716,91962314717,91962314718,91962314719,91962314720,91962314721,91962414722,91962414723,91962414724,91962414725,91962414726,91962414727,91962414728,91962414729,91961614730,91961614731,91961614732,91961614733,91961614734,91961614735,91961614736,91961614737,91961614738,91961614739,91961614740,91961614741,91961614742,91961614743,91961614744,91961614745,91961614746,91961614747,91961614748,91961614749,91961614750,91961614751,91961614752,91961614753,91961614754,91961614755,91961614756,91961614757,91961614758,91961614759,91961614760,91961614761,91961614762,91961614763,91961614764,91961614765,91961614766,91961614767,91961614768,91961614769,91961614770,91961614771,91961614772,91961614773,91961614774,91961614775,91961614776,91961614777,91961614778,91961614779,91961614780,91961614781,91961614782,91961614783,91961614784,91961614785,91961614786,91961614787,91961614788,91961614789,91961614790,91961614791,91961614792,91961614793,91961614794,91961614795,91961614796,91961614797,91961614798,91961614799,91961614800,91961614801,91961614802,91961614803,91961614804,91961614805,91961614806,91961614807,91961614808,91961614809,91961614810,91961614811,91961614812,91961614813,91961614814,91961614815,91961614816,91961614817,91961614818,91961614819,91961614820,91961614821,91961614822,91961614823,91961614824,91961614825,91961614826,91961614827,91961614828,91961614829,91961614830,91961614831,91961614832,91961614833,91961614834,91961614835,91961614836,91961614837,91961614838,91961614839,91961614840,91961614841,91961614842,91961614843,91961614844,91961614845,91961614846,91961614847,91961614848,91961614849,91961614850,91961614851,91961614852,91961614853,91961614854,91961614855,91961614856,91961614857,91961614858,91961614859,91961614860,91961614861,91961614862,91961614863,91961614864,91961614865,91961614866,91961614867,91961614868,91961614869,91961614870,91961614871,91961614872,91961614873,91961614874,91961614875,91961614876,91961614877,91961614878,91961614879,91961614880,91961614881,91961614882,91961614883,91961614884,91961614885,91961614886,91961614887,91961614888,91961614889,91961614890,91961614891,91961614892,91961614893,91961614894,91961614895,91961614896,91961614897,91961614898,91961614899,91961614900,91961614901,91961614902,91961614903,91961614904,91961614905,91961614906,91961614907,91961614908,91961614909,91961614910,91961614911,91961614912,91961614913,91961614914,91961614915,91961614916,91961614917,91961614918,91961614919,91961614920,91961614921,91961614922,91961614923,91961614924,91961614925,91961614926,91961614927,91961614928,91961614929,91961614930,91961614931,91961614932,91961614933,91961614934,91961614935,91961614936,91961614937,91961614938,91961614939,91961614940,91961614941,91961614942,91961614943,91961614944,91961614945,91961614946,91961614947,91961614948,91961614949,91961614950,91961614951,91961614952,91961614953,91961614954,91961614955,91961614956,91961614957,91961614958,91961614959,91961614960,91961614961,91961614962,91961614963,91961614964,91961614965,91961614966,91961614967,91961614968,91961614969,91961614970,91961614971,91961614972,91961614973,91961614974,91961614975,91961614976,91961614977,91961614978,91961614979,91961614980,91961614981,91961614982,91961614983,91961614984,91961614985,91961614986,91961614987,91961614988,91961614989,91961614990,91961614991,91961614992,91961614993,91961614994,91961614995,91961614996,91961614997,91961614998,91961614999,91961615000,91961615001,91961615002,91961615003,91961615004,91961615005,91961615006,91961615007,91961615008,91961615009,91961615010,91961615011,91961615012,91961615013,91961615014,91961615015,91961615016,91961615017,91961615018,91961615019,91961615020,91961615021,91961615022,91961615023,91961615024,91961615025,91961615026,91961615027,91961615028,91961615029,91961615030,91961615031,91961615032,91961615033,91961615034,91961615035,91961615036,91961615037,91961615038,91961615039,91961615040,91961615041,91961615042,91961615043,91961615044,91961615045,91961615046,91961615047,91961615048,91961615049,91961615050,91961615051,91961615052,91961615053,91961615054,91961615055,91961615056,91961615057,91961615058,91961615059,91961615060,91961615061,91961615062,91961615063,91961615064,91961615065,91961615066,91961615067,91961615068,91961615069,91961615070,91961615071,91961615072,91961615073,91961615074,91961615075,91961615076,91961615077,91961615078,91961615079,91961615080,91961615081,91961615082,91961615083,91961615084,91961615085,91961615086,91961615087,91961615088,91961615089,91961615090,91961615091,91961615092,91961615093,91961615094,91961615095,91961615096,91961615097,91961615098,91961615099,91961615100,91961615101);
    protected $arrPlayCate = array(
        'TEMA' => 609,
        'LIANGMIAN' => 610,
        'SEBO' => 611,
        'TEXIAO' => 612,
        'HEXIAO' => 613,
        'TOUWEISHU' => 614,
        'ZHENGMA' => 615,
        'ZHENGMATE' => 616,
        'WUHANG' => 617,
        'PINGTEYIXIAOWEISHU' => 618,
        'ZHENGXIAO' => 619,
        'QISEBO' => 620,
        'ZONGXIAO' => 621,
        'ZIXUANBUZHONG' => 622,
        'LIANXIAOLIANWEI' => 623,
        'LIANMA' => 624
    );
    protected $arrPlayId = array(
        'TMA_01' => 14340,
        'TMA_02' => 14341,
        'TMA_03' => 14342,
        'TMA_04' => 14343,
        'TMA_05' => 14344,
        'TMA_06' => 14345,
        'TMA_07' => 14346,
        'TMA_08' => 14347,
        'TMA_09' => 14348,
        'TMA_10' => 14349,
        'TMA_11' => 14350,
        'TMA_12' => 14351,
        'TMA_13' => 14352,
        'TMA_14' => 14353,
        'TMA_15' => 14354,
        'TMA_16' => 14355,
        'TMA_17' => 14356,
        'TMA_18' => 14357,
        'TMA_19' => 14358,
        'TMA_20' => 14359,
        'TMA_21' => 14360,
        'TMA_22' => 14361,
        'TMA_23' => 14362,
        'TMA_24' => 14363,
        'TMA_25' => 14364,
        'TMA_26' => 14365,
        'TMA_27' => 14366,
        'TMA_28' => 14367,
        'TMA_29' => 14368,
        'TMA_30' => 14369,
        'TMA_31' => 14370,
        'TMA_32' => 14371,
        'TMA_33' => 14372,
        'TMA_34' => 14373,
        'TMA_35' => 14374,
        'TMA_36' => 14375,
        'TMA_37' => 14376,
        'TMA_38' => 14377,
        'TMA_39' => 14378,
        'TMA_40' => 14379,
        'TMA_41' => 14380,
        'TMA_42' => 14381,
        'TMA_43' => 14382,
        'TMA_44' => 14383,
        'TMA_45' => 14384,
        'TMA_46' => 14385,
        'TMA_47' => 14386,
        'TMA_48' => 14387,
        'TMA_49' => 14388,
        'TMB_01' => 14389,
        'TMB_02' => 14390,
        'TMB_03' => 14391,
        'TMB_04' => 14392,
        'TMB_05' => 14393,
        'TMB_06' => 14394,
        'TMB_07' => 14395,
        'TMB_08' => 14396,
        'TMB_09' => 14397,
        'TMB_10' => 14398,
        'TMB_11' => 14399,
        'TMB_12' => 14400,
        'TMB_13' => 14401,
        'TMB_14' => 14402,
        'TMB_15' => 14403,
        'TMB_16' => 14404,
        'TMB_17' => 14405,
        'TMB_18' => 14406,
        'TMB_19' => 14407,
        'TMB_20' => 14408,
        'TMB_21' => 14409,
        'TMB_22' => 14410,
        'TMB_23' => 14411,
        'TMB_24' => 14412,
        'TMB_25' => 14413,
        'TMB_26' => 14414,
        'TMB_27' => 14415,
        'TMB_28' => 14416,
        'TMB_29' => 14417,
        'TMB_30' => 14418,
        'TMB_31' => 14419,
        'TMB_32' => 14420,
        'TMB_33' => 14421,
        'TMB_34' => 14422,
        'TMB_35' => 14423,
        'TMB_36' => 14424,
        'TMB_37' => 14425,
        'TMB_38' => 14426,
        'TMB_39' => 14427,
        'TMB_40' => 14428,
        'TMB_41' => 14429,
        'TMB_42' => 14430,
        'TMB_43' => 14431,
        'TMB_44' => 14432,
        'TMB_45' => 14433,
        'TMB_46' => 14434,
        'TMB_47' => 14435,
        'TMB_48' => 14436,
        'TMB_49' => 14437,
        'LMTD' => 14438,
        'LMTX' => 14439,
        'LMTDAN' => 14440,
        'LMTS' => 14441,
        'LMTHD' => 14442,
        'LMTHEX' => 14443,
        'LMTHDAN' => 14444,
        'LMTHSHUANG' => 14445,
        'LMTWD' => 14446,
        'LMTWX' => 14447,
        'LMTDDAN' => 14448,
        'LMTDSHUANG' => 14449,
        'LMTXDAN' => 14450,
        'LMTXS' => 14451,
        'LMTTX' => 14452,
        'LMTDX' => 14453,
        'LMTQX' => 14454,
        'LMTHOUX' => 14455,
        'LMTJX' => 14456,
        'LMTYX' => 14457,
        'LMZHD' => 14458,
        'LMZHS' => 14459,
        'LMZHDA' => 14460,
        'LMZHXIAO' => 14461,
        'HONGBO' => 14462,
        'LANBO' => 14463,
        'LUBO' => 14464,
        'HONGDAN' => 14465,
        'HONGSHUANG' => 14466,
        'HONGDA' => 14467,
        'HONGXIAO' => 14468,
        'LANDAN' => 14469,
        'LANSHUANG' => 14470,
        'LANDA' => 14471,
        'LANXIAO' => 14472,
        'LUDAN' => 14473,
        'LUSHUANG' => 14474,
        'LUDA' => 14475,
        'LUAXIAO' => 14476,
        'HONGDADAN' => 14477,
        'HONGDASHUANG' => 14478,
        'HONGXIAODAN' => 14479,
        'HONGXIAOSHUANG' => 14480,
        'LANDADAN' => 14481,
        'LANDASHUANG' => 14482,
        'LANXIAODAN' => 14483,
        'LANXIAOSHUANG' => 14484,
        'LUDADAN' => 14485,
        'LUDASHUANG' => 14486,
        'LUXIAODAN' => 14487,
        'LUXIAOSHUANG' => 14488,
        'TXSHU' => 14489,
        'TXNIU' => 14490,
        'TXHU' => 14491,
        'TXTU' => 14492,
        'TXLONG' => 14493,
        'TXSHE' => 14494,
        'TXMA' => 14495,
        'TXYANG' => 14496,
        'TXHOU' => 14497,
        'TXJI' => 14498,
        'TXGOU' => 14499,
        'TXZHU' => 14500,
        'HEXIAO2' => 14501,
        'HEXIAO3' => 14502,
        'HEXIAO4' => 14503,
        'HEXIAO5' => 14504,
        'HEXIAO6' => 14505,
        'HEXIAO7' => 14506,
        'HEXIAO8' => 14507,
        'HEXIAO9' => 14508,
        'HEXIAO10' => 14509,
        'HEXIAO11' => 14510,
        'TOUT0' => 14511,
        'TOUT1' => 14512,
        'TOUT2' => 14513,
        'TOUT3' => 14514,
        'TOUT4' => 14515,
        'WEIW1' => 14516,
        'WEIW2' => 14517,
        'WEIW3' => 14518,
        'WEIW4' => 14519,
        'WEIW5' => 14520,
        'WEIW6' => 14521,
        'WEIW7' => 14522,
        'WEIW8' => 14523,
        'WEIW9' => 14524,
        'WEIW0' => 14525,
        'ZM01' => 14526,
        'ZM02' => 14527,
        'ZM03' => 14528,
        'ZM04' => 14529,
        'ZM05' => 14530,
        'ZM06' => 14531,
        'ZM07' => 14532,
        'ZM08' => 14533,
        'ZM09' => 14534,
        'ZM10' => 14535,
        'ZM11' => 14536,
        'ZM12' => 14537,
        'ZM13' => 14538,
        'ZM14' => 14539,
        'ZM15' => 14540,
        'ZM16' => 14541,
        'ZM17' => 14542,
        'ZM18' => 14543,
        'ZM19' => 14544,
        'ZM20' => 14545,
        'ZM21' => 14546,
        'ZM22' => 14547,
        'ZM23' => 14548,
        'ZM24' => 14549,
        'ZM25' => 14550,
        'ZM26' => 14551,
        'ZM27' => 14552,
        'ZM28' => 14553,
        'ZM29' => 14554,
        'ZM30' => 14555,
        'ZM31' => 14556,
        'ZM32' => 14557,
        'ZM33' => 14558,
        'ZM34' => 14559,
        'ZM35' => 14560,
        'ZM36' => 14561,
        'ZM37' => 14562,
        'ZM38' => 14563,
        'ZM39' => 14564,
        'ZM40' => 14565,
        'ZM41' => 14566,
        'ZM42' => 14567,
        'ZM43' => 14568,
        'ZM44' => 14569,
        'ZM45' => 14570,
        'ZM46' => 14571,
        'ZM47' => 14572,
        'ZM48' => 14573,
        'ZM49' => 14574,
        'WXJIN' => 14575,
        'WXMU' => 14576,
        'WXSHUI' => 14577,
        'WXHUO' => 14578,
        'WXTU' => 14579,
        'PTYXSHU' => 14580,
        'PTYXNIU' => 14581,
        'PTYXHU' => 14582,
        'PTYXTU' => 14583,
        'PTYXLONG' => 14584,
        'PTYXSHE' => 14585,
        'PTYXMA' => 14586,
        'PTYXYANG' => 14587,
        'PTYXHOU' => 14588,
        'PTYXJI' => 14589,
        'PTYXGOU' => 14590,
        'PTYXZHU' => 14591,
        'PTYXW0' => 14592,
        'PTYXW1' => 14593,
        'PTYXW2' => 14594,
        'PTYXW3' => 14595,
        'PTYXW4' => 14596,
        'PTYXW5' => 14597,
        'PTYXW6' => 14598,
        'PTYXW7' => 14599,
        'PTYXW8' => 14600,
        'PTYXW9' => 14601,
        'ZXIAOSHU' => 14602,
        'ZXIAONIU' => 14603,
        'ZXIAOHU' => 14604,
        'ZXIAOTU' => 14605,
        'ZXIAOLONG' => 14606,
        'ZXIAOSHE' => 14607,
        'ZXIAOMA' => 14608,
        'ZXIAOYANG' => 14609,
        'ZXIAOHOU' => 14610,
        'ZXIAOJI' => 14611,
        'ZXIAOGOU' => 14612,
        'ZXIAOZHU' => 14613,
        'QISBHONG' => 14614,
        'QISBLANBO' => 14615,
        'QISBLUBO' => 14616,
        'QISBHJ' => 14617,
        'ZONGXIAO2X2' => 14618,
        'ZONGXIAO3X3' => 14619,
        'ZONGXIAO4X4' => 14620,
        'ZONGXIAO5X5' => 14621,
        'ZONGXIAO6X6' => 14622,
        'ZONGXIAO7X7' => 14623,
        'ZONGXIAODAN' => 14624,
        'ZONGXIAOS' => 14625,
        'ZXBZ5' => 14626,
        'ZXBZ6' => 14627,
        'ZXBZ7' => 14628,
        'ZXBZ8' => 14629,
        'ZXBZ9' => 14630,
        'ZXBZ10' => 14631,
        'ZXBZ11' => 14632,
        'ZXBZ12' => 14633,
        'ELXSHU' => 14634,
        'ELXNIU' => 14635,
        'ELXHU' => 14636,
        'ELXTU' => 14637,
        'ELXLONG' => 14638,
        'ELXSHE' => 14639,
        'ELXMA' => 14640,
        'ELXYANG' => 14641,
        'ELXHOU' => 14642,
        'ELXJI' => 14643,
        'ELXGOU' => 14644,
        'ELXZHU' => 14645,
        'SLXSHU' => 14646,
        'SLXNIU' => 14647,
        'SLXHU' => 14648,
        'SLXTU' => 14649,
        'SLXLONG' => 14650,
        'SLXSHE' => 14651,
        'SLXMA' => 14652,
        'SLXYANG' => 14653,
        'SLXHOU' => 14654,
        'SLXJI' => 14655,
        'SLXGOU' => 14656,
        'SLXZHU' => 14657,
        'SILXSHU' => 14658,
        'SILXNIU' => 14659,
        'SILXHU' => 14660,
        'SILXTU' => 14661,
        'SILXLONG' => 14662,
        'SILXSHE' => 14663,
        'SILXMA' => 14664,
        'SILXYANG' => 14665,
        'SILXHOU' => 14666,
        'SILXJI' => 14667,
        'SILXGOU' => 14668,
        'SILXZHU' => 14669,
        'WLXSHU' => 14670,
        'WLXNIU' => 14671,
        'WLXHU' => 14672,
        'WLXTU' => 14673,
        'WLXLONG' => 14674,
        'WLXSHE' => 14675,
        'WLXMA' => 14676,
        'WLXYANG' => 14677,
        'WLXHOU' => 14678,
        'WLXJI' => 14679,
        'WLXGOU' => 14680,
        'WLXZHU' => 14681,
        'EELW0' => 14682,
        'EELW1' => 14683,
        'EELW2' => 14684,
        'EELW3' => 14685,
        'EELW4' => 14686,
        'EELW5' => 14687,
        'EELW6' => 14688,
        'EELW7' => 14689,
        'EELW8' => 14690,
        'EELW9' => 14691,
        'SSLW0' => 14692,
        'SSLW1' => 14693,
        'SSLW2' => 14694,
        'SSLW3' => 14695,
        'SSLW4' => 14696,
        'SSLW5' => 14697,
        'SSLW6' => 14698,
        'SSLW7' => 14699,
        'SSLW8' => 14700,
        'SSLW9' => 14701,
        'SILW0' => 14702,
        'SILW1' => 14703,
        'SILW2' => 14704,
        'SILW3' => 14705,
        'SILW4' => 14706,
        'SILW5' => 14707,
        'SILW6' => 14708,
        'SILW7' => 14709,
        'SILW8' => 14710,
        'SILW9' => 14711,
        'WULW0' => 14712,
        'WULW1' => 14713,
        'WULW2' => 14714,
        'WULW3' => 14715,
        'WULW4' => 14716,
        'WULW5' => 14717,
        'WULW6' => 14718,
        'WULW7' => 14719,
        'WULW8' => 14720,
        'WULW9' => 14721,
        'SANZHONGERZHONGER' => 14722,
        'SANZHONGERZHONGSAN' => 14723,
        'SANQUANZHONG' => 14724,
        'ERQUANZHONG' => 14725,
        'ERZHONGTEZHONGTE' => 14726,
        'ERZHONGTEZHONGER' => 14727,
        'TECHUAN' => 14728,
        'SIQUANZHONG' => 14729,
        'ZHENGYITE01' => 14730,
        'ZHENGYITE02' => 14731,
        'ZHENGYITE03' => 14732,
        'ZHENGYITE04' => 14733,
        'ZHENGYITE05' => 14734,
        'ZHENGYITE06' => 14735,
        'ZHENGYITE07' => 14736,
        'ZHENGYITE08' => 14737,
        'ZHENGYITE09' => 14738,
        'ZHENGYITE10' => 14739,
        'ZHENGYITE11' => 14740,
        'ZHENGYITE12' => 14741,
        'ZHENGYITE13' => 14742,
        'ZHENGYITE14' => 14743,
        'ZHENGYITE15' => 14744,
        'ZHENGYITE16' => 14745,
        'ZHENGYITE17' => 14746,
        'ZHENGYITE18' => 14747,
        'ZHENGYITE19' => 14748,
        'ZHENGYITE20' => 14749,
        'ZHENGYITE21' => 14750,
        'ZHENGYITE22' => 14751,
        'ZHENGYITE23' => 14752,
        'ZHENGYITE24' => 14753,
        'ZHENGYITE25' => 14754,
        'ZHENGYITE26' => 14755,
        'ZHENGYITE27' => 14756,
        'ZHENGYITE28' => 14757,
        'ZHENGYITE29' => 14758,
        'ZHENGYITE30' => 14759,
        'ZHENGYITE31' => 14760,
        'ZHENGYITE32' => 14761,
        'ZHENGYITE33' => 14762,
        'ZHENGYITE34' => 14763,
        'ZHENGYITE35' => 14764,
        'ZHENGYITE36' => 14765,
        'ZHENGYITE37' => 14766,
        'ZHENGYITE38' => 14767,
        'ZHENGYITE39' => 14768,
        'ZHENGYITE40' => 14769,
        'ZHENGYITE41' => 14770,
        'ZHENGYITE42' => 14771,
        'ZHENGYITE43' => 14772,
        'ZHENGYITE44' => 14773,
        'ZHENGYITE45' => 14774,
        'ZHENGYITE46' => 14775,
        'ZHENGYITE47' => 14776,
        'ZHENGYITE48' => 14777,
        'ZHENGYITE49' => 14778,
        'ZHENGYITEDANM' => 14779,
        'ZHENGYITESM' => 14780,
        'ZHENGYITEDAM' => 14781,
        'ZHENGYITEXM' => 14782,
        'ZHENGYITEHDAN' => 14783,
        'ZHENGYITEHS' => 14784,
        'ZHENGYITEHDA' => 14785,
        'ZHENGYITEHX' => 14786,
        'ZHENGYITEHONGBO' => 14787,
        'ZHENGYITELANBO' => 14788,
        'ZHENGYITELUBO' => 14789,
        'ZHENGYITEWEIDA' => 14790,
        'ZHENGYITEWEIXIAO' => 14791,
        'ZHENGERTE01' => 14792,
        'ZHENGERTE02' => 14793,
        'ZHENGERTE03' => 14794,
        'ZHENGERTE04' => 14795,
        'ZHENGERTE05' => 14796,
        'ZHENGERTE06' => 14797,
        'ZHENGERTE07' => 14798,
        'ZHENGERTE08' => 14799,
        'ZHENGERTE09' => 14800,
        'ZHENGERTE10' => 14801,
        'ZHENGERTE11' => 14802,
        'ZHENGERTE12' => 14803,
        'ZHENGERTE13' => 14804,
        'ZHENGERTE14' => 14805,
        'ZHENGERTE15' => 14806,
        'ZHENGERTE16' => 14807,
        'ZHENGERTE17' => 14808,
        'ZHENGERTE18' => 14809,
        'ZHENGERTE19' => 14810,
        'ZHENGERTE20' => 14811,
        'ZHENGERTE21' => 14812,
        'ZHENGERTE22' => 14813,
        'ZHENGERTE23' => 14814,
        'ZHENGERTE24' => 14815,
        'ZHENGERTE25' => 14816,
        'ZHENGERTE26' => 14817,
        'ZHENGERTE27' => 14818,
        'ZHENGERTE28' => 14819,
        'ZHENGERTE29' => 14820,
        'ZHENGERTE30' => 14821,
        'ZHENGERTE31' => 14822,
        'ZHENGERTE32' => 14823,
        'ZHENGERTE33' => 14824,
        'ZHENGERTE34' => 14825,
        'ZHENGERTE35' => 14826,
        'ZHENGERTE36' => 14827,
        'ZHENGERTE37' => 14828,
        'ZHENGERTE38' => 14829,
        'ZHENGERTE39' => 14830,
        'ZHENGERTE40' => 14831,
        'ZHENGERTE41' => 14832,
        'ZHENGERTE42' => 14833,
        'ZHENGERTE43' => 14834,
        'ZHENGERTE44' => 14835,
        'ZHENGERTE45' => 14836,
        'ZHENGERTE46' => 14837,
        'ZHENGERTE47' => 14838,
        'ZHENGERTE48' => 14839,
        'ZHENGERTE49' => 14840,
        'ZHENGERTEDANM' => 14841,
        'ZHENGERTESM' => 14842,
        'ZHENGERTEDAM' => 14843,
        'ZHENGERTEXM' => 14844,
        'ZHENGERTEHDAN' => 14845,
        'ZHENGERTEHS' => 14846,
        'ZHENGERTEHDA' => 14847,
        'ZHENGERTEHX' => 14848,
        'ZHENGERTEHONGBO' => 14849,
        'ZHENGERTELANBO' => 14850,
        'ZHENGERTELUBO' => 14851,
        'ZHENGERTEWEIDA' => 14852,
        'ZHENGERTEWEIXIAO' => 14853,
        'ZHENGSANTE01' => 14854,
        'ZHENGSANTE02' => 14855,
        'ZHENGSANTE03' => 14856,
        'ZHENGSANTE04' => 14857,
        'ZHENGSANTE05' => 14858,
        'ZHENGSANTE06' => 14859,
        'ZHENGSANTE07' => 14860,
        'ZHENGSANTE08' => 14861,
        'ZHENGSANTE09' => 14862,
        'ZHENGSANTE10' => 14863,
        'ZHENGSANTE11' => 14864,
        'ZHENGSANTE12' => 14865,
        'ZHENGSANTE13' => 14866,
        'ZHENGSANTE14' => 14867,
        'ZHENGSANTE15' => 14868,
        'ZHENGSANTE16' => 14869,
        'ZHENGSANTE17' => 14870,
        'ZHENGSANTE18' => 14871,
        'ZHENGSANTE19' => 14872,
        'ZHENGSANTE20' => 14873,
        'ZHENGSANTE21' => 14874,
        'ZHENGSANTE22' => 14875,
        'ZHENGSANTE23' => 14876,
        'ZHENGSANTE24' => 14877,
        'ZHENGSANTE25' => 14878,
        'ZHENGSANTE26' => 14879,
        'ZHENGSANTE27' => 14880,
        'ZHENGSANTE28' => 14881,
        'ZHENGSANTE29' => 14882,
        'ZHENGSANTE30' => 14883,
        'ZHENGSANTE31' => 14884,
        'ZHENGSANTE32' => 14885,
        'ZHENGSANTE33' => 14886,
        'ZHENGSANTE34' => 14887,
        'ZHENGSANTE35' => 14888,
        'ZHENGSANTE36' => 14889,
        'ZHENGSANTE37' => 14890,
        'ZHENGSANTE38' => 14891,
        'ZHENGSANTE39' => 14892,
        'ZHENGSANTE40' => 14893,
        'ZHENGSANTE41' => 14894,
        'ZHENGSANTE42' => 14895,
        'ZHENGSANTE43' => 14896,
        'ZHENGSANTE44' => 14897,
        'ZHENGSANTE45' => 14898,
        'ZHENGSANTE46' => 14899,
        'ZHENGSANTE47' => 14900,
        'ZHENGSANTE48' => 14901,
        'ZHENGSANTE49' => 14902,
        'ZHENGSANTEDANM' => 14903,
        'ZHENGSANTESM' => 14904,
        'ZHENGSANTEDAM' => 14905,
        'ZHENGSANTEXM' => 14906,
        'ZHENGSANTEHDAN' => 14907,
        'ZHENGSANTEHS' => 14908,
        'ZHENGSANTEHDA' => 14909,
        'ZHENGSANTEHX' => 14910,
        'ZHENGSANTEHONGBO' => 14911,
        'ZHENGSANTELANBO' => 14912,
        'ZHENGSANTELUBO' => 14913,
        'ZHENGSANTEWEIDA' => 14914,
        'ZHENGSANTEWEIXIAO' => 14915,
        'ZHENGSITE01' => 14916,
        'ZHENGSITE02' => 14917,
        'ZHENGSITE03' => 14918,
        'ZHENGSITE04' => 14919,
        'ZHENGSITE05' => 14920,
        'ZHENGSITE06' => 14921,
        'ZHENGSITE07' => 14922,
        'ZHENGSITE08' => 14923,
        'ZHENGSITE09' => 14924,
        'ZHENGSITE10' => 14925,
        'ZHENGSITE11' => 14926,
        'ZHENGSITE12' => 14927,
        'ZHENGSITE13' => 14928,
        'ZHENGSITE14' => 14929,
        'ZHENGSITE15' => 14930,
        'ZHENGSITE16' => 14931,
        'ZHENGSITE17' => 14932,
        'ZHENGSITE18' => 14933,
        'ZHENGSITE19' => 14934,
        'ZHENGSITE20' => 14935,
        'ZHENGSITE21' => 14936,
        'ZHENGSITE22' => 14937,
        'ZHENGSITE23' => 14938,
        'ZHENGSITE24' => 14939,
        'ZHENGSITE25' => 14940,
        'ZHENGSITE26' => 14941,
        'ZHENGSITE27' => 14942,
        'ZHENGSITE28' => 14943,
        'ZHENGSITE29' => 14944,
        'ZHENGSITE30' => 14945,
        'ZHENGSITE31' => 14946,
        'ZHENGSITE32' => 14947,
        'ZHENGSITE33' => 14948,
        'ZHENGSITE34' => 14949,
        'ZHENGSITE35' => 14950,
        'ZHENGSITE36' => 14951,
        'ZHENGSITE37' => 14952,
        'ZHENGSITE38' => 14953,
        'ZHENGSITE39' => 14954,
        'ZHENGSITE40' => 14955,
        'ZHENGSITE41' => 14956,
        'ZHENGSITE42' => 14957,
        'ZHENGSITE43' => 14958,
        'ZHENGSITE44' => 14959,
        'ZHENGSITE45' => 14960,
        'ZHENGSITE46' => 14961,
        'ZHENGSITE47' => 14962,
        'ZHENGSITE48' => 14963,
        'ZHENGSITE49' => 14964,
        'ZHENGSITEDANM' => 14965,
        'ZHENGSITESM' => 14966,
        'ZHENGSITEDAM' => 14967,
        'ZHENGSITEXM' => 14968,
        'ZHENGSITEHDAN' => 14969,
        'ZHENGSITEHS' => 14970,
        'ZHENGSITEHDA' => 14971,
        'ZHENGSITEHX' => 14972,
        'ZHENGSITEHONGBO' => 14973,
        'ZHENGSITELANBO' => 14974,
        'ZHENGSITELUBO' => 14975,
        'ZHENGSITEWEIDA' => 14976,
        'ZHENGSITEWEIXIAO' => 14977,
        'ZHENGWUTE01' => 14978,
        'ZHENGWUTE02' => 14979,
        'ZHENGWUTE03' => 14980,
        'ZHENGWUTE04' => 14981,
        'ZHENGWUTE05' => 14982,
        'ZHENGWUTE06' => 14983,
        'ZHENGWUTE07' => 14984,
        'ZHENGWUTE08' => 14985,
        'ZHENGWUTE09' => 14986,
        'ZHENGWUTE10' => 14987,
        'ZHENGWUTE11' => 14988,
        'ZHENGWUTE12' => 14989,
        'ZHENGWUTE13' => 14990,
        'ZHENGWUTE14' => 14991,
        'ZHENGWUTE15' => 14992,
        'ZHENGWUTE16' => 14993,
        'ZHENGWUTE17' => 14994,
        'ZHENGWUTE18' => 14995,
        'ZHENGWUTE19' => 14996,
        'ZHENGWUTE20' => 14997,
        'ZHENGWUTE21' => 14998,
        'ZHENGWUTE22' => 14999,
        'ZHENGWUTE23' => 15000,
        'ZHENGWUTE24' => 15001,
        'ZHENGWUTE25' => 15002,
        'ZHENGWUTE26' => 15003,
        'ZHENGWUTE27' => 15004,
        'ZHENGWUTE28' => 15005,
        'ZHENGWUTE29' => 15006,
        'ZHENGWUTE30' => 15007,
        'ZHENGWUTE31' => 15008,
        'ZHENGWUTE32' => 15009,
        'ZHENGWUTE33' => 15010,
        'ZHENGWUTE34' => 15011,
        'ZHENGWUTE35' => 15012,
        'ZHENGWUTE36' => 15013,
        'ZHENGWUTE37' => 15014,
        'ZHENGWUTE38' => 15015,
        'ZHENGWUTE39' => 15016,
        'ZHENGWUTE40' => 15017,
        'ZHENGWUTE41' => 15018,
        'ZHENGWUTE42' => 15019,
        'ZHENGWUTE43' => 15020,
        'ZHENGWUTE44' => 15021,
        'ZHENGWUTE45' => 15022,
        'ZHENGWUTE46' => 15023,
        'ZHENGWUTE47' => 15024,
        'ZHENGWUTE48' => 15025,
        'ZHENGWUTE49' => 15026,
        'ZHENGWUTEDANM' => 15027,
        'ZHENGWUTESM' => 15028,
        'ZHENGWUTEDAM' => 15029,
        'ZHENGWUTEXM' => 15030,
        'ZHENGWUTEHDAN' => 15031,
        'ZHENGWUTEHS' => 15032,
        'ZHENGWUTEHDA' => 15033,
        'ZHENGWUTEHX' => 15034,
        'ZHENGWUTEHONGBO' => 15035,
        'ZHENGWUTELANBO' => 15036,
        'ZHENGWUTELUBO' => 15037,
        'ZHENGWUTEWEIDA' => 15038,
        'ZHENGWUTEWEIXIAO' => 15039,
        'ZHENGLIUTE01' => 15040,
        'ZHENGLIUTE02' => 15041,
        'ZHENGLIUTE03' => 15042,
        'ZHENGLIUTE04' => 15043,
        'ZHENGLIUTE05' => 15044,
        'ZHENGLIUTE06' => 15045,
        'ZHENGLIUTE07' => 15046,
        'ZHENGLIUTE08' => 15047,
        'ZHENGLIUTE09' => 15048,
        'ZHENGLIUTE10' => 15049,
        'ZHENGLIUTE11' => 15050,
        'ZHENGLIUTE12' => 15051,
        'ZHENGLIUTE13' => 15052,
        'ZHENGLIUTE14' => 15053,
        'ZHENGLIUTE15' => 15054,
        'ZHENGLIUTE16' => 15055,
        'ZHENGLIUTE17' => 15056,
        'ZHENGLIUTE18' => 15057,
        'ZHENGLIUTE19' => 15058,
        'ZHENGLIUTE20' => 15059,
        'ZHENGLIUTE21' => 15060,
        'ZHENGLIUTE22' => 15061,
        'ZHENGLIUTE23' => 15062,
        'ZHENGLIUTE24' => 15063,
        'ZHENGLIUTE25' => 15064,
        'ZHENGLIUTE26' => 15065,
        'ZHENGLIUTE27' => 15066,
        'ZHENGLIUTE28' => 15067,
        'ZHENGLIUTE29' => 15068,
        'ZHENGLIUTE30' => 15069,
        'ZHENGLIUTE31' => 15070,
        'ZHENGLIUTE32' => 15071,
        'ZHENGLIUTE33' => 15072,
        'ZHENGLIUTE34' => 15073,
        'ZHENGLIUTE35' => 15074,
        'ZHENGLIUTE36' => 15075,
        'ZHENGLIUTE37' => 15076,
        'ZHENGLIUTE38' => 15077,
        'ZHENGLIUTE39' => 15078,
        'ZHENGLIUTE40' => 15079,
        'ZHENGLIUTE41' => 15080,
        'ZHENGLIUTE42' => 15081,
        'ZHENGLIUTE43' => 15082,
        'ZHENGLIUTE44' => 15083,
        'ZHENGLIUTE45' => 15084,
        'ZHENGLIUTE46' => 15085,
        'ZHENGLIUTE47' => 15086,
        'ZHENGLIUTE48' => 15087,
        'ZHENGLIUTE49' => 15088,
        'ZHENGLIUTEDANM' => 15089,
        'ZHENGLIUTESM' => 15090,
        'ZHENGLIUTEDAM' => 15091,
        'ZHENGLIUTEXM' => 15092,
        'ZHENGLIUTEHDAN' => 15093,
        'ZHENGLIUTEHS' => 15094,
        'ZHENGLIUTEHDA' => 15095,
        'ZHENGLIUTEHX' => 15096,
        'ZHENGLIUTEHONGBO' => 15097,
        'ZHENGLIUTELANBO' => 15098,
        'ZHENGLIUTELUBO' => 15099,
        'ZHENGLIUTEWEIDA' => 15100,
        'ZHENGLIUTEWEIXIAO' => 15101
    );

    protected function exc_play($openCode,$gameId){
        $win = collect([]);
        $ids_he = collect([]);
        $LHC = new ExcelLotteryLHC();
        $LHC->setArrPlay($openCode,$this->arrPlayCate,$this->arrPlayId);
        $LHC->LHC_TM($gameId,$win);
        $LHC->LHC_LM($openCode,$gameId,$win,$ids_he);
        $LHC->LHC_SB($openCode,$gameId,$win,$ids_he);
        $LHC->LHC_TX($openCode,$gameId,$win);
        $LHC->LHC_TMTWS($openCode,$gameId,$win,$ids_he);
        $LHC->LHC_ZM($openCode,$gameId,$win);
        $LHC->LHC_ZMT($openCode,$gameId,$win,$ids_he);
        $LHC->LHC_WX($openCode,$gameId,$win);
        $LHC->LHC_QSB($openCode,$gameId,$win,$ids_he);
        $LHC->LHC_PTYXWS($openCode,$gameId,$win);
        $LHC->LHC_ZONGXIAO($gameId,$win);
        return array('win'=>$win,'ids_he'=>$ids_he,'LHC'=>$LHC);
    }

    public function all($openCode,$issue,$gameId,$id,$excel)
    {
        $table = 'game_shflhc';
        $gameName = '十分六合彩';
        $betCount = DB::connection('mysql::write')->table('bet')->where('status',0)->where('game_id',$gameId)->where('issue',$issue)->where('bunko','=',0.00)->count();

        if($betCount > 0){
            $exeIssue = $this->getNeedKillIssue($table,2);
            $exeBase = $this->getNeedKillBase($gameId);
            if(isset($exeIssue->excel_num) && $exeBase->excel_num > 0 && $excel){
                $update = DB::table($table)->where('id',$id)->where('excel_num',2)->update([
                    'excel_num' => 3
                ]);
                writeLog('New_Kill', 'excel_num:'.$update);
                if($update == 1) {
                    writeLog('New_Kill', 'shflhc killing...');
                    $this->excel($openCode, $exeBase, $issue, $gameId, $table,'lhc');
                }
            }
            if(!$excel){
                $resData = $this->exc_play($openCode,$gameId);
                $win = @$resData['win'];
                $he = isset($resData['ids_he'])?$resData['ids_he']:array();
                $LHC = isset($resData['LHC'])?$resData['LHC']:null;
                try {
                    $bunko = $this->BUNKO_LHC($openCode, $win, $gameId, $issue, $he, $excel,$LHC);
                }catch (\exception $exception){
                    writeLog('New_Bet', __CLASS__ . '->' . __FUNCTION__ . ' Line:' . $exception->getLine() . ' ' . $exception->getMessage());
                    DB::table('bet')->where('issue',$issue)->where('game_id',$gameId)->update(['status' => 0,'bunko' => 0]);
                }
                $this->bet_total($issue,$gameId);
                if(isset($bunko) && $bunko == 1){
                    $updateUserMoney = $this->updateUserMoney($gameId,$issue,$gameName,$table,$id,true);
                    if($updateUserMoney == 1){
                        writeLog('New_Bet', $gameName . $issue . "结算出错");
                    }
                }
            }
        }
        if($excel){
            $update = DB::table($table)->where('id',$id)->whereIn('excel_num',[2,3])->update([
                'excel_num' => 1
            ]);
            if ($update !== 1) {
                writeLog('New_Kill', $gameName . $issue . "杀率not Finshed");
            }else
                $this->stopBunko($gameId,1,'Kill');
        }else{
            $update = DB::table($table)->where('id',$id)->update([
                'bunko' => 1
            ]);
            if ($update !== 1) {
                writeLog('New_Bet', $gameName . $issue . "结算not Finshed");
            }else{
                $this->stopBunko($gameId,1);
                //玩法退水
                if(env('AGENT_MODEL',1) == 1) {
                    $res = DB::table($table)->where('id',$id)->where('returnwater',0)->update(['returnwater' => 2]);
                    if(!$res){
                        writeLog('New_Bet', $gameName . $issue . "退水前失败！");
                        return 0;
                    }
                    //退水
                    $res = $this->reBackUser($gameId, $issue, $gameName);
                    if(!$res){
                        $res = DB::table($table)->where('id',$id)->where('returnwater',2)->update(['returnwater' => 1]);
                        if(empty($res)){
                            writeLog('New_Bet',$gameName.$issue.'退水中失败！');
                            return 0;
                        }
                    }else
                        writeLog('New_Bet', $gameName . $issue . "退水前失败！");
                }else{//代理退水
                    $agentJob = new AgentBackwaterJob($gameId,$issue);
                    $agentJob->addQueue();
                }
            }
        }
    }
}