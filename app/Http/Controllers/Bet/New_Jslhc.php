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

class New_Jslhc extends Excel
{
    protected $arrPlay_id = array(9033776028,9033776029,9033776030,9033776031,9033776032,9033776033,9033776034,9033776035,9033776036,9033776037,9033776038,9033776039,9033776040,9033776041,9033776042,9033776043,9033776044,9033776045,9033776046,9033776047,9033776048,9033776049,9033776050,9033776051,9033776052,9033776053,9033776054,9033776055,9033776056,9033776057,9033776058,9033776059,9033776060,9033776061,9033776062,9033776063,9033776064,9033776065,9033776066,9033776067,9033776068,9033776069,9033776070,9033776071,9033776072,9033776073,9033776074,9033776075,9033776076,9033776077,9033776078,9033776079,9033776080,9033776081,9033776082,9033776083,9033776084,9033776085,9033776086,9033776087,9033776088,9033776089,9033776090,9033776091,9033776092,9033776093,9033776094,9033776095,9033776096,9033776097,9033776098,9033776099,9033776100,9033776101,9033776102,9033776103,9033776104,9033776105,9033776106,9033776107,9033776108,9033776109,9033776110,9033776111,9033776112,9033776113,9033776114,9033776115,9033776116,9033776117,9033776118,9033776119,9033776120,9033776121,9033776122,9033776123,9033776124,9033776125,9033786126,9033786127,9033786128,9033786129,9033786130,9033786131,9033786132,9033786133,9033786134,9033786135,9033786136,9033786137,9033786138,9033786139,9033786140,9033786141,9033786142,9033786143,9033786144,9033786145,9033786146,9033786147,9033786148,9033786149,9033796150,9033796151,9033796152,9033796153,9033796154,9033796155,9033796156,9033796157,9033796158,9033796159,9033796160,9033796161,9033796162,9033796163,9033796164,9033796165,9033796166,9033796167,9033796168,9033796169,9033796170,9033796171,9033796172,9033796173,9033796174,9033796175,9033796176,9033806177,9033806178,9033806179,9033806180,9033806181,9033806182,9033806183,9033806184,9033806185,9033806186,9033806187,9033806188,9033816189,9033816190,9033816191,9033816192,9033816193,9033816194,9033816195,9033816196,9033816197,9033816198,9033826199,9033826200,9033826201,9033826202,9033826203,9033826204,9033826205,9033826206,9033826207,9033826208,9033826209,9033826210,9033826211,9033826212,9033826213,9033836214,9033836215,9033836216,9033836217,9033836218,9033836219,9033836220,9033836221,9033836222,9033836223,9033836224,9033836225,9033836226,9033836227,9033836228,9033836229,9033836230,9033836231,9033836232,9033836233,9033836234,9033836235,9033836236,9033836237,9033836238,9033836239,9033836240,9033836241,9033836242,9033836243,9033836244,9033836245,9033836246,9033836247,9033836248,9033836249,9033836250,9033836251,9033836252,9033836253,9033836254,9033836255,9033836256,9033836257,9033836258,9033836259,9033836260,9033836261,9033836262,9033856263,9033856264,9033856265,9033856266,9033856267,9033866268,9033866269,9033866270,9033866271,9033866272,9033866273,9033866274,9033866275,9033866276,9033866277,9033866278,9033866279,9033866280,9033866281,9033866282,9033866283,9033866284,9033866285,9033866286,9033866287,9033866288,9033866289,9033876290,9033876291,9033876292,9033876293,9033876294,9033876295,9033876296,9033876297,9033876298,9033876299,9033876300,9033876301,9033886302,9033886303,9033886304,9033886305,9033896306,9033896307,9033896308,9033896309,9033896310,9033896311,9033896312,9033896313,9033906314,9033906315,9033906316,9033906317,9033906318,9033906319,9033906320,9033906321,9033916322,9033916323,9033916324,9033916325,9033916326,9033916327,9033916328,9033916329,9033916330,9033916331,9033916332,9033916333,9033916334,9033916335,9033916336,9033916337,9033916338,9033916339,9033916340,9033916341,9033916342,9033916343,9033916344,9033916345,9033916346,9033916347,9033916348,9033916349,9033916350,9033916351,9033916352,9033916353,9033916354,9033916355,9033916356,9033916357,9033916358,9033916359,9033916360,9033916361,9033916362,9033916363,9033916364,9033916365,9033916366,9033916367,9033916368,9033916369,9033916370,9033916371,9033916372,9033916373,9033916374,9033916375,9033916376,9033916377,9033916378,9033916379,9033916380,9033916381,9033916382,9033916383,9033916384,9033916385,9033916386,9033916387,9033916388,9033916389,9033916390,9033916391,9033916392,9033916393,9033916394,9033916395,9033916396,9033916397,9033916398,9033916399,9033916400,9033916401,9033916402,9033916403,9033916404,9033916405,9033916406,9033916407,9033916408,9033916409,9033926410,9033926411,9033926412,9033926413,9033926414,9033926415,9033926416,9033926417,9033846418,9033846419,9033846420,9033846421,9033846422,9033846423,9033846424,9033846425,9033846426,9033846427,9033846428,9033846429,9033846430,9033846431,9033846432,9033846433,9033846434,9033846435,9033846436,9033846437,9033846438,9033846439,9033846440,9033846441,9033846442,9033846443,9033846444,9033846445,9033846446,9033846447,9033846448,9033846449,9033846450,9033846451,9033846452,9033846453,9033846454,9033846455,9033846456,9033846457,9033846458,9033846459,9033846460,9033846461,9033846462,9033846463,9033846464,9033846465,9033846466,9033846467,9033846468,9033846469,9033846470,9033846471,9033846472,9033846473,9033846474,9033846475,9033846476,9033846477,9033846478,9033846479,9033846480,9033846481,9033846482,9033846483,9033846484,9033846485,9033846486,9033846487,9033846488,9033846489,9033846490,9033846491,9033846492,9033846493,9033846494,9033846495,9033846496,9033846497,9033846498,9033846499,9033846500,9033846501,9033846502,9033846503,9033846504,9033846505,9033846506,9033846507,9033846508,9033846509,9033846510,9033846511,9033846512,9033846513,9033846514,9033846515,9033846516,9033846517,9033846518,9033846519,9033846520,9033846521,9033846522,9033846523,9033846524,9033846525,9033846526,9033846527,9033846528,9033846529,9033846530,9033846531,9033846532,9033846533,9033846534,9033846535,9033846536,9033846537,9033846538,9033846539,9033846540,9033846541,9033846542,9033846543,9033846544,9033846545,9033846546,9033846547,9033846548,9033846549,9033846550,9033846551,9033846552,9033846553,9033846554,9033846555,9033846556,9033846557,9033846558,9033846559,9033846560,9033846561,9033846562,9033846563,9033846564,9033846565,9033846566,9033846567,9033846568,9033846569,9033846570,9033846571,9033846572,9033846573,9033846574,9033846575,9033846576,9033846577,9033846578,9033846579,9033846580,9033846581,9033846582,9033846583,9033846584,9033846585,9033846586,9033846587,9033846588,9033846589,9033846590,9033846591,9033846592,9033846593,9033846594,9033846595,9033846596,9033846597,9033846598,9033846599,9033846600,9033846601,9033846602,9033846603,9033846604,9033846605,9033846606,9033846607,9033846608,9033846609,9033846610,9033846611,9033846612,9033846613,9033846614,9033846615,9033846616,9033846617,9033846618,9033846619,9033846620,9033846621,9033846622,9033846623,9033846624,9033846625,9033846626,9033846627,9033846628,9033846629,9033846630,9033846631,9033846632,9033846633,9033846634,9033846635,9033846636,9033846637,9033846638,9033846639,9033846640,9033846641,9033846642,9033846643,9033846644,9033846645,9033846646,9033846647,9033846648,9033846649,9033846650,9033846651,9033846652,9033846653,9033846654,9033846655,9033846656,9033846657,9033846658,9033846659,9033846660,9033846661,9033846662,9033846663,9033846664,9033846665,9033846666,9033846667,9033846668,9033846669,9033846670,9033846671,9033846672,9033846673,9033846674,9033846675,9033846676,9033846677,9033846678,9033846679,9033846680,9033846681,9033846682,9033846683,9033846684,9033846685,9033846686,9033846687,9033846688,9033846689,9033846690,9033846691,9033846692,9033846693,9033846694,9033846695,9033846696,9033846697,9033846698,9033846699,9033846700,9033846701,9033846702,9033846703,9033846704,9033846705,9033846706,9033846707,9033846708,9033846709,9033846710,9033846711,9033846712,9033846713,9033846714,9033846715,9033846716,9033846717,9033846718,9033846719,9033846720,9033846721,9033846722,9033846723,9033846724,9033846725,9033846726,9033846727,9033846728,9033846729,9033846730,9033846731,9033846732,9033846733,9033846734,9033846735,9033846736,9033846737,9033846738,9033846739,9033846740,9033846741,9033846742,9033846743,9033846744,9033846745,9033846746,9033846747,9033846748,9033846749,9033846750,9033846751,9033846752,9033846753,9033846754,9033846755,9033846756,9033846757,9033846758,9033846759,9033846760,9033846761,9033846762,9033846763,9033846764,9033846765,9033846766,9033846767,9033846768,9033846769,9033846770,9033846771,9033846772,9033846773,9033846774,9033846775,9033846776,9033846777,9033846778,9033846779,9033846780,9033846781,9033846782,9033846783,9033846784,9033846785,9033846786,9033846787,9033846788,9033846789);
    protected $arrPlayCate = array(
        'TEMA' =>377,
        'LIANGMIAN' =>378,
        'SEBO' =>379,
        'TEXIAO' =>380,
        'HEXIAO' =>381,
        'TOUWEISHU' =>382,
        'ZHENGMA' =>383,
        'ZHENGMATE' =>384,
        'WUHANG' =>385,
        'PINGTEYIXIAOWEISHU' =>386,
        'ZHENGXIAO' =>387,
        'QISEBO' =>388,
        'ZONGXIAO' =>389,
        'ZIXUANBUZHONG' =>390,
        'LIANXIAOLIANWEI' =>391,
        'LIANMA' =>392
    );
    protected $arrPlayId = array(
        'TMA_01' => 6028,
        'TMA_02' => 6029,
        'TMA_03' => 6030,
        'TMA_04' => 6031,
        'TMA_05' => 6032,
        'TMA_06' => 6033,
        'TMA_07' => 6034,
        'TMA_08' => 6035,
        'TMA_09' => 6036,
        'TMA_10' => 6037,
        'TMA_11' => 6038,
        'TMA_12' => 6039,
        'TMA_13' => 6040,
        'TMA_14' => 6041,
        'TMA_15' => 6042,
        'TMA_16' => 6043,
        'TMA_17' => 6044,
        'TMA_18' => 6045,
        'TMA_19' => 6046,
        'TMA_20' => 6047,
        'TMA_21' => 6048,
        'TMA_22' => 6049,
        'TMA_23' => 6050,
        'TMA_24' => 6051,
        'TMA_25' => 6052,
        'TMA_26' => 6053,
        'TMA_27' => 6054,
        'TMA_28' => 6055,
        'TMA_29' => 6056,
        'TMA_30' => 6057,
        'TMA_31' => 6058,
        'TMA_32' => 6059,
        'TMA_33' => 6060,
        'TMA_34' => 6061,
        'TMA_35' => 6062,
        'TMA_36' => 6063,
        'TMA_37' => 6064,
        'TMA_38' => 6065,
        'TMA_39' => 6066,
        'TMA_40' => 6067,
        'TMA_41' => 6068,
        'TMA_42' => 6069,
        'TMA_43' => 6070,
        'TMA_44' => 6071,
        'TMA_45' => 6072,
        'TMA_46' => 6073,
        'TMA_47' => 6074,
        'TMA_48' => 6075,
        'TMA_49' => 6076,
        'TMB_01' => 6077,
        'TMB_02' => 6078,
        'TMB_03' => 6079,
        'TMB_04' => 6080,
        'TMB_05' => 6081,
        'TMB_06' => 6082,
        'TMB_07' => 6083,
        'TMB_08' => 6084,
        'TMB_09' => 6085,
        'TMB_10' => 6086,
        'TMB_11' => 6087,
        'TMB_12' => 6088,
        'TMB_13' => 6089,
        'TMB_14' => 6090,
        'TMB_15' => 6091,
        'TMB_16' => 6092,
        'TMB_17' => 6093,
        'TMB_18' => 6094,
        'TMB_19' => 6095,
        'TMB_20' => 6096,
        'TMB_21' => 6097,
        'TMB_22' => 6098,
        'TMB_23' => 6099,
        'TMB_24' => 6100,
        'TMB_25' => 6101,
        'TMB_26' => 6102,
        'TMB_27' => 6103,
        'TMB_28' => 6104,
        'TMB_29' => 6105,
        'TMB_30' => 6106,
        'TMB_31' => 6107,
        'TMB_32' => 6108,
        'TMB_33' => 6109,
        'TMB_34' => 6110,
        'TMB_35' => 6111,
        'TMB_36' => 6112,
        'TMB_37' => 6113,
        'TMB_38' => 6114,
        'TMB_39' => 6115,
        'TMB_40' => 6116,
        'TMB_41' => 6117,
        'TMB_42' => 6118,
        'TMB_43' => 6119,
        'TMB_44' => 6120,
        'TMB_45' => 6121,
        'TMB_46' => 6122,
        'TMB_47' => 6123,
        'TMB_48' => 6124,
        'TMB_49' => 6125,
        'LMTD' => 6126,
        'LMTX' => 6127,
        'LMTDAN' => 6128,
        'LMTS' => 6129,
        'LMTHD' => 6130,
        'LMTHEX' => 6131,
        'LMTHDAN' => 6132,
        'LMTHSHUANG' => 6133,
        'LMTWD' => 6134,
        'LMTWX' => 6135,
        'LMTDDAN' => 6136,
        'LMTDSHUANG' => 6137,
        'LMTXDAN' => 6138,
        'LMTXS' => 6139,
        'LMTTX' => 6140,
        'LMTDX' => 6141,
        'LMTQX' => 6142,
        'LMTHOUX' => 6143,
        'LMTJX' => 6144,
        'LMTYX' => 6145,
        'LMZHD' => 6146,
        'LMZHS' => 6147,
        'LMZHDA' => 6148,
        'LMZHXIAO' => 6149,
        'HONGBO' => 6150,
        'LANBO' => 6151,
        'LUBO' => 6152,
        'HONGDAN' => 6153,
        'HONGSHUANG' => 6154,
        'HONGDA' => 6155,
        'HONGXIAO' => 6156,
        'LANDAN' => 6157,
        'LANSHUANG' => 6158,
        'LANDA' => 6159,
        'LANXIAO' => 6160,
        'LUDAN' => 6161,
        'LUSHUANG' => 6162,
        'LUDA' => 6163,
        'LUAXIAO' => 6164,
        'HONGDADAN' => 6165,
        'HONGDASHUANG' => 6166,
        'HONGXIAODAN' => 6167,
        'HONGXIAOSHUANG' => 6168,
        'LANDADAN' => 6169,
        'LANDASHUANG' => 6170,
        'LANXIAODAN' => 6171,
        'LANXIAOSHUANG' => 6172,
        'LUDADAN' => 6173,
        'LUDASHUANG' => 6174,
        'LUXIAODAN' => 6175,
        'LUXIAOSHUANG' => 6176,
        'TXSHU' => 6177,
        'TXNIU' => 6178,
        'TXHU' => 6179,
        'TXTU' => 6180,
        'TXLONG' => 6181,
        'TXSHE' => 6182,
        'TXMA' => 6183,
        'TXYANG' => 6184,
        'TXHOU' => 6185,
        'TXJI' => 6186,
        'TXGOU' => 6187,
        'TXZHU' => 6188,
        'HEXIAO2' => 6189,
        'HEXIAO3' => 6190,
        'HEXIAO4' => 6191,
        'HEXIAO5' => 6192,
        'HEXIAO6' => 6193,
        'HEXIAO7' => 6194,
        'HEXIAO8' => 6195,
        'HEXIAO9' => 6196,
        'HEXIAO10' => 6197,
        'HEXIAO11' => 6198,
        'TOUT0' => 6199,
        'TOUT1' => 6200,
        'TOUT2' => 6201,
        'TOUT3' => 6202,
        'TOUT4' => 6203,
        'WEIW1' => 6204,
        'WEIW2' => 6205,
        'WEIW3' => 6206,
        'WEIW4' => 6207,
        'WEIW5' => 6208,
        'WEIW6' => 6209,
        'WEIW7' => 6210,
        'WEIW8' => 6211,
        'WEIW9' => 6212,
        'WEIW0' => 6213,
        'ZM01' => 6214,
        'ZM02' => 6215,
        'ZM03' => 6216,
        'ZM04' => 6217,
        'ZM05' => 6218,
        'ZM06' => 6219,
        'ZM07' => 6220,
        'ZM08' => 6221,
        'ZM09' => 6222,
        'ZM10' => 6223,
        'ZM11' => 6224,
        'ZM12' => 6225,
        'ZM13' => 6226,
        'ZM14' => 6227,
        'ZM15' => 6228,
        'ZM16' => 6229,
        'ZM17' => 6230,
        'ZM18' => 6231,
        'ZM19' => 6232,
        'ZM20' => 6233,
        'ZM21' => 6234,
        'ZM22' => 6235,
        'ZM23' => 6236,
        'ZM24' => 6237,
        'ZM25' => 6238,
        'ZM26' => 6239,
        'ZM27' => 6240,
        'ZM28' => 6241,
        'ZM29' => 6242,
        'ZM30' => 6243,
        'ZM31' => 6244,
        'ZM32' => 6245,
        'ZM33' => 6246,
        'ZM34' => 6247,
        'ZM35' => 6248,
        'ZM36' => 6249,
        'ZM37' => 6250,
        'ZM38' => 6251,
        'ZM39' => 6252,
        'ZM40' => 6253,
        'ZM41' => 6254,
        'ZM42' => 6255,
        'ZM43' => 6256,
        'ZM44' => 6257,
        'ZM45' => 6258,
        'ZM46' => 6259,
        'ZM47' => 6260,
        'ZM48' => 6261,
        'ZM49' => 6262,
        'WXJIN' => 6263,
        'WXMU' => 6264,
        'WXSHUI' => 6265,
        'WXHUO' => 6266,
        'WXTU' => 6267,
        'PTYXSHU' => 6268,
        'PTYXNIU' => 6269,
        'PTYXHU' => 6270,
        'PTYXTU' => 6271,
        'PTYXLONG' => 6272,
        'PTYXSHE' => 6273,
        'PTYXMA' => 6274,
        'PTYXYANG' => 6275,
        'PTYXHOU' => 6276,
        'PTYXJI' => 6277,
        'PTYXGOU' => 6278,
        'PTYXZHU' => 6279,
        'PTYXW0' => 6280,
        'PTYXW1' => 6281,
        'PTYXW2' => 6282,
        'PTYXW3' => 6283,
        'PTYXW4' => 6284,
        'PTYXW5' => 6285,
        'PTYXW6' => 6286,
        'PTYXW7' => 6287,
        'PTYXW8' => 6288,
        'PTYXW9' => 6289,
        'ZXIAOSHU' => 6290,
        'ZXIAONIU' => 6291,
        'ZXIAOHU' => 6292,
        'ZXIAOTU' => 6293,
        'ZXIAOLONG' => 6294,
        'ZXIAOSHE' => 6295,
        'ZXIAOMA' => 6296,
        'ZXIAOYANG' => 6297,
        'ZXIAOHOU' => 6298,
        'ZXIAOJI' => 6299,
        'ZXIAOGOU' => 6300,
        'ZXIAOZHU' => 6301,
        'QISBHONG' => 6302,
        'QISBLANBO' => 6303,
        'QISBLUBO' => 6304,
        'QISBHJ' => 6305,
        'ZONGXIAO2X2' => 6306,
        'ZONGXIAO3X3' => 6307,
        'ZONGXIAO4X4' => 6308,
        'ZONGXIAO5X5' => 6309,
        'ZONGXIAO6X6' => 6310,
        'ZONGXIAO7X7' => 6311,
        'ZONGXIAODAN' => 6312,
        'ZONGXIAOS' => 6313,
        'ZXBZ5' => 6314,
        'ZXBZ6' => 6315,
        'ZXBZ7' => 6316,
        'ZXBZ8' => 6317,
        'ZXBZ9' => 6318,
        'ZXBZ10' => 6319,
        'ZXBZ11' => 6320,
        'ZXBZ12' => 6321,
        'ELXSHU' => 6322,
        'ELXNIU' => 6323,
        'ELXHU' => 6324,
        'ELXTU' => 6325,
        'ELXLONG' => 6326,
        'ELXSHE' => 6327,
        'ELXMA' => 6328,
        'ELXYANG' => 6329,
        'ELXHOU' => 6330,
        'ELXJI' => 6331,
        'ELXGOU' => 6332,
        'ELXZHU' => 6333,
        'SLXSHU' => 6334,
        'SLXNIU' => 6335,
        'SLXHU' => 6336,
        'SLXTU' => 6337,
        'SLXLONG' => 6338,
        'SLXSHE' => 6339,
        'SLXMA' => 6340,
        'SLXYANG' => 6341,
        'SLXHOU' => 6342,
        'SLXJI' => 6343,
        'SLXGOU' => 6344,
        'SLXZHU' => 6345,
        'SILXSHU' => 6346,
        'SILXNIU' => 6347,
        'SILXHU' => 6348,
        'SILXTU' => 6349,
        'SILXLONG' => 6350,
        'SILXSHE' => 6351,
        'SILXMA' => 6352,
        'SILXYANG' => 6353,
        'SILXHOU' => 6354,
        'SILXJI' => 6355,
        'SILXGOU' => 6356,
        'SILXZHU' => 6357,
        'WLXSHU' => 6358,
        'WLXNIU' => 6359,
        'WLXHU' => 6360,
        'WLXTU' => 6361,
        'WLXLONG' => 6362,
        'WLXSHE' => 6363,
        'WLXMA' => 6364,
        'WLXYANG' => 6365,
        'WLXHOU' => 6366,
        'WLXJI' => 6367,
        'WLXGOU' => 6368,
        'WLXZHU' => 6369,
        'EELW0' => 6370,
        'EELW1' => 6371,
        'EELW2' => 6372,
        'EELW3' => 6373,
        'EELW4' => 6374,
        'EELW5' => 6375,
        'EELW6' => 6376,
        'EELW7' => 6377,
        'EELW8' => 6378,
        'EELW9' => 6379,
        'SSLW0' => 6380,
        'SSLW1' => 6381,
        'SSLW2' => 6382,
        'SSLW3' => 6383,
        'SSLW4' => 6384,
        'SSLW5' => 6385,
        'SSLW6' => 6386,
        'SSLW7' => 6387,
        'SSLW8' => 6388,
        'SSLW9' => 6389,
        'SILW0' => 6390,
        'SILW1' => 6391,
        'SILW2' => 6392,
        'SILW3' => 6393,
        'SILW4' => 6394,
        'SILW5' => 6395,
        'SILW6' => 6396,
        'SILW7' => 6397,
        'SILW8' => 6398,
        'SILW9' => 6399,
        'WULW0' => 6400,
        'WULW1' => 6401,
        'WULW2' => 6402,
        'WULW3' => 6403,
        'WULW4' => 6404,
        'WULW5' => 6405,
        'WULW6' => 6406,
        'WULW7' => 6407,
        'WULW8' => 6408,
        'WULW9' => 6409,
        'SANZHONGERZHONGER' => 6410,
        'SANZHONGERZHONGSAN' => 6411,
        'SANQUANZHONG' => 6412,
        'ERQUANZHONG' => 6413,
        'ERZHONGTEZHONGTE' => 6414,
        'ERZHONGTEZHONGER' => 6415,
        'TECHUAN' => 6416,
        'SIQUANZHONG' => 6417,
        'ZHENGYITE01' => 6418,
        'ZHENGYITE02' => 6419,
        'ZHENGYITE03' => 6420,
        'ZHENGYITE04' => 6421,
        'ZHENGYITE05' => 6422,
        'ZHENGYITE06' => 6423,
        'ZHENGYITE07' => 6424,
        'ZHENGYITE08' => 6425,
        'ZHENGYITE09' => 6426,
        'ZHENGYITE10' => 6427,
        'ZHENGYITE11' => 6428,
        'ZHENGYITE12' => 6429,
        'ZHENGYITE13' => 6430,
        'ZHENGYITE14' => 6431,
        'ZHENGYITE15' => 6432,
        'ZHENGYITE16' => 6433,
        'ZHENGYITE17' => 6434,
        'ZHENGYITE18' => 6435,
        'ZHENGYITE19' => 6436,
        'ZHENGYITE20' => 6437,
        'ZHENGYITE21' => 6438,
        'ZHENGYITE22' => 6439,
        'ZHENGYITE23' => 6440,
        'ZHENGYITE24' => 6441,
        'ZHENGYITE25' => 6442,
        'ZHENGYITE26' => 6443,
        'ZHENGYITE27' => 6444,
        'ZHENGYITE28' => 6445,
        'ZHENGYITE29' => 6446,
        'ZHENGYITE30' => 6447,
        'ZHENGYITE31' => 6448,
        'ZHENGYITE32' => 6449,
        'ZHENGYITE33' => 6450,
        'ZHENGYITE34' => 6451,
        'ZHENGYITE35' => 6452,
        'ZHENGYITE36' => 6453,
        'ZHENGYITE37' => 6454,
        'ZHENGYITE38' => 6455,
        'ZHENGYITE39' => 6456,
        'ZHENGYITE40' => 6457,
        'ZHENGYITE41' => 6458,
        'ZHENGYITE42' => 6459,
        'ZHENGYITE43' => 6460,
        'ZHENGYITE44' => 6461,
        'ZHENGYITE45' => 6462,
        'ZHENGYITE46' => 6463,
        'ZHENGYITE47' => 6464,
        'ZHENGYITE48' => 6465,
        'ZHENGYITE49' => 6466,
        'ZHENGYITEDANM' => 6467,
        'ZHENGYITESM' => 6468,
        'ZHENGYITEDAM' => 6469,
        'ZHENGYITEXM' => 6470,
        'ZHENGYITEHDAN' => 6471,
        'ZHENGYITEHS' => 6472,
        'ZHENGYITEHDA' => 6473,
        'ZHENGYITEHX' => 6474,
        'ZHENGYITEHONGBO' => 6475,
        'ZHENGYITELANBO' => 6476,
        'ZHENGYITELUBO' => 6477,
        'ZHENGYITEWEIDA' => 6478,
        'ZHENGYITEWEIXIAO' => 6479,
        'ZHENGERTE01' => 6480,
        'ZHENGERTE02' => 6481,
        'ZHENGERTE03' => 6482,
        'ZHENGERTE04' => 6483,
        'ZHENGERTE05' => 6484,
        'ZHENGERTE06' => 6485,
        'ZHENGERTE07' => 6486,
        'ZHENGERTE08' => 6487,
        'ZHENGERTE09' => 6488,
        'ZHENGERTE10' => 6489,
        'ZHENGERTE11' => 6490,
        'ZHENGERTE12' => 6491,
        'ZHENGERTE13' => 6492,
        'ZHENGERTE14' => 6493,
        'ZHENGERTE15' => 6494,
        'ZHENGERTE16' => 6495,
        'ZHENGERTE17' => 6496,
        'ZHENGERTE18' => 6497,
        'ZHENGERTE19' => 6498,
        'ZHENGERTE20' => 6499,
        'ZHENGERTE21' => 6500,
        'ZHENGERTE22' => 6501,
        'ZHENGERTE23' => 6502,
        'ZHENGERTE24' => 6503,
        'ZHENGERTE25' => 6504,
        'ZHENGERTE26' => 6505,
        'ZHENGERTE27' => 6506,
        'ZHENGERTE28' => 6507,
        'ZHENGERTE29' => 6508,
        'ZHENGERTE30' => 6509,
        'ZHENGERTE31' => 6510,
        'ZHENGERTE32' => 6511,
        'ZHENGERTE33' => 6512,
        'ZHENGERTE34' => 6513,
        'ZHENGERTE35' => 6514,
        'ZHENGERTE36' => 6515,
        'ZHENGERTE37' => 6516,
        'ZHENGERTE38' => 6517,
        'ZHENGERTE39' => 6518,
        'ZHENGERTE40' => 6519,
        'ZHENGERTE41' => 6520,
        'ZHENGERTE42' => 6521,
        'ZHENGERTE43' => 6522,
        'ZHENGERTE44' => 6523,
        'ZHENGERTE45' => 6524,
        'ZHENGERTE46' => 6525,
        'ZHENGERTE47' => 6526,
        'ZHENGERTE48' => 6527,
        'ZHENGERTE49' => 6528,
        'ZHENGERTEDANM' => 6529,
        'ZHENGERTESM' => 6530,
        'ZHENGERTEDAM' => 6531,
        'ZHENGERTEXM' => 6532,
        'ZHENGERTEHDAN' => 6533,
        'ZHENGERTEHS' => 6534,
        'ZHENGERTEHDA' => 6535,
        'ZHENGERTEHX' => 6536,
        'ZHENGERTEHONGBO' => 6537,
        'ZHENGERTELANBO' => 6538,
        'ZHENGERTELUBO' => 6539,
        'ZHENGERTEWEIDA' => 6540,
        'ZHENGERTEWEIXIAO' => 6541,
        'ZHENGSANTE01' => 6542,
        'ZHENGSANTE02' => 6543,
        'ZHENGSANTE03' => 6544,
        'ZHENGSANTE04' => 6545,
        'ZHENGSANTE05' => 6546,
        'ZHENGSANTE06' => 6547,
        'ZHENGSANTE07' => 6548,
        'ZHENGSANTE08' => 6549,
        'ZHENGSANTE09' => 6550,
        'ZHENGSANTE10' => 6551,
        'ZHENGSANTE11' => 6552,
        'ZHENGSANTE12' => 6553,
        'ZHENGSANTE13' => 6554,
        'ZHENGSANTE14' => 6555,
        'ZHENGSANTE15' => 6556,
        'ZHENGSANTE16' => 6557,
        'ZHENGSANTE17' => 6558,
        'ZHENGSANTE18' => 6559,
        'ZHENGSANTE19' => 6560,
        'ZHENGSANTE20' => 6561,
        'ZHENGSANTE21' => 6562,
        'ZHENGSANTE22' => 6563,
        'ZHENGSANTE23' => 6564,
        'ZHENGSANTE24' => 6565,
        'ZHENGSANTE25' => 6566,
        'ZHENGSANTE26' => 6567,
        'ZHENGSANTE27' => 6568,
        'ZHENGSANTE28' => 6569,
        'ZHENGSANTE29' => 6570,
        'ZHENGSANTE30' => 6571,
        'ZHENGSANTE31' => 6572,
        'ZHENGSANTE32' => 6573,
        'ZHENGSANTE33' => 6574,
        'ZHENGSANTE34' => 6575,
        'ZHENGSANTE35' => 6576,
        'ZHENGSANTE36' => 6577,
        'ZHENGSANTE37' => 6578,
        'ZHENGSANTE38' => 6579,
        'ZHENGSANTE39' => 6580,
        'ZHENGSANTE40' => 6581,
        'ZHENGSANTE41' => 6582,
        'ZHENGSANTE42' => 6583,
        'ZHENGSANTE43' => 6584,
        'ZHENGSANTE44' => 6585,
        'ZHENGSANTE45' => 6586,
        'ZHENGSANTE46' => 6587,
        'ZHENGSANTE47' => 6588,
        'ZHENGSANTE48' => 6589,
        'ZHENGSANTE49' => 6590,
        'ZHENGSANTEDANM' => 6591,
        'ZHENGSANTESM' => 6592,
        'ZHENGSANTEDAM' => 6593,
        'ZHENGSANTEXM' => 6594,
        'ZHENGSANTEHDAN' => 6595,
        'ZHENGSANTEHS' => 6596,
        'ZHENGSANTEHDA' => 6597,
        'ZHENGSANTEHX' => 6598,
        'ZHENGSANTEHONGBO' => 6599,
        'ZHENGSANTELANBO' => 6600,
        'ZHENGSANTELUBO' => 6601,
        'ZHENGSANTEWEIDA' => 6602,
        'ZHENGSANTEWEIXIAO' => 6603,
        'ZHENGSITE01' => 6604,
        'ZHENGSITE02' => 6605,
        'ZHENGSITE03' => 6606,
        'ZHENGSITE04' => 6607,
        'ZHENGSITE05' => 6608,
        'ZHENGSITE06' => 6609,
        'ZHENGSITE07' => 6610,
        'ZHENGSITE08' => 6611,
        'ZHENGSITE09' => 6612,
        'ZHENGSITE10' => 6613,
        'ZHENGSITE11' => 6614,
        'ZHENGSITE12' => 6615,
        'ZHENGSITE13' => 6616,
        'ZHENGSITE14' => 6617,
        'ZHENGSITE15' => 6618,
        'ZHENGSITE16' => 6619,
        'ZHENGSITE17' => 6620,
        'ZHENGSITE18' => 6621,
        'ZHENGSITE19' => 6622,
        'ZHENGSITE20' => 6623,
        'ZHENGSITE21' => 6624,
        'ZHENGSITE22' => 6625,
        'ZHENGSITE23' => 6626,
        'ZHENGSITE24' => 6627,
        'ZHENGSITE25' => 6628,
        'ZHENGSITE26' => 6629,
        'ZHENGSITE27' => 6630,
        'ZHENGSITE28' => 6631,
        'ZHENGSITE29' => 6632,
        'ZHENGSITE30' => 6633,
        'ZHENGSITE31' => 6634,
        'ZHENGSITE32' => 6635,
        'ZHENGSITE33' => 6636,
        'ZHENGSITE34' => 6637,
        'ZHENGSITE35' => 6638,
        'ZHENGSITE36' => 6639,
        'ZHENGSITE37' => 6640,
        'ZHENGSITE38' => 6641,
        'ZHENGSITE39' => 6642,
        'ZHENGSITE40' => 6643,
        'ZHENGSITE41' => 6644,
        'ZHENGSITE42' => 6645,
        'ZHENGSITE43' => 6646,
        'ZHENGSITE44' => 6647,
        'ZHENGSITE45' => 6648,
        'ZHENGSITE46' => 6649,
        'ZHENGSITE47' => 6650,
        'ZHENGSITE48' => 6651,
        'ZHENGSITE49' => 6652,
        'ZHENGSITEDANM' => 6653,
        'ZHENGSITESM' => 6654,
        'ZHENGSITEDAM' => 6655,
        'ZHENGSITEXM' => 6656,
        'ZHENGSITEHDAN' => 6657,
        'ZHENGSITEHS' => 6658,
        'ZHENGSITEHDA' => 6659,
        'ZHENGSITEHX' => 6660,
        'ZHENGSITEHONGBO' => 6661,
        'ZHENGSITELANBO' => 6662,
        'ZHENGSITELUBO' => 6663,
        'ZHENGSITEWEIDA' => 6664,
        'ZHENGSITEWEIXIAO' => 6665,
        'ZHENGWUTE01' => 6666,
        'ZHENGWUTE02' => 6667,
        'ZHENGWUTE03' => 6668,
        'ZHENGWUTE04' => 6669,
        'ZHENGWUTE05' => 6670,
        'ZHENGWUTE06' => 6671,
        'ZHENGWUTE07' => 6672,
        'ZHENGWUTE08' => 6673,
        'ZHENGWUTE09' => 6674,
        'ZHENGWUTE10' => 6675,
        'ZHENGWUTE11' => 6676,
        'ZHENGWUTE12' => 6677,
        'ZHENGWUTE13' => 6678,
        'ZHENGWUTE14' => 6679,
        'ZHENGWUTE15' => 6680,
        'ZHENGWUTE16' => 6681,
        'ZHENGWUTE17' => 6682,
        'ZHENGWUTE18' => 6683,
        'ZHENGWUTE19' => 6684,
        'ZHENGWUTE20' => 6685,
        'ZHENGWUTE21' => 6686,
        'ZHENGWUTE22' => 6687,
        'ZHENGWUTE23' => 6688,
        'ZHENGWUTE24' => 6689,
        'ZHENGWUTE25' => 6690,
        'ZHENGWUTE26' => 6691,
        'ZHENGWUTE27' => 6692,
        'ZHENGWUTE28' => 6693,
        'ZHENGWUTE29' => 6694,
        'ZHENGWUTE30' => 6695,
        'ZHENGWUTE31' => 6696,
        'ZHENGWUTE32' => 6697,
        'ZHENGWUTE33' => 6698,
        'ZHENGWUTE34' => 6699,
        'ZHENGWUTE35' => 6700,
        'ZHENGWUTE36' => 6701,
        'ZHENGWUTE37' => 6702,
        'ZHENGWUTE38' => 6703,
        'ZHENGWUTE39' => 6704,
        'ZHENGWUTE40' => 6705,
        'ZHENGWUTE41' => 6706,
        'ZHENGWUTE42' => 6707,
        'ZHENGWUTE43' => 6708,
        'ZHENGWUTE44' => 6709,
        'ZHENGWUTE45' => 6710,
        'ZHENGWUTE46' => 6711,
        'ZHENGWUTE47' => 6712,
        'ZHENGWUTE48' => 6713,
        'ZHENGWUTE49' => 6714,
        'ZHENGWUTEDANM' => 6715,
        'ZHENGWUTESM' => 6716,
        'ZHENGWUTEDAM' => 6717,
        'ZHENGWUTEXM' => 6718,
        'ZHENGWUTEHDAN' => 6719,
        'ZHENGWUTEHS' => 6720,
        'ZHENGWUTEHDA' => 6721,
        'ZHENGWUTEHX' => 6722,
        'ZHENGWUTEHONGBO' => 6723,
        'ZHENGWUTELANBO' => 6724,
        'ZHENGWUTELUBO' => 6725,
        'ZHENGWUTEWEIDA' => 6726,
        'ZHENGWUTEWEIXIAO' => 6727,
        'ZHENGLIUTE01' => 6728,
        'ZHENGLIUTE02' => 6729,
        'ZHENGLIUTE03' => 6730,
        'ZHENGLIUTE04' => 6731,
        'ZHENGLIUTE05' => 6732,
        'ZHENGLIUTE06' => 6733,
        'ZHENGLIUTE07' => 6734,
        'ZHENGLIUTE08' => 6735,
        'ZHENGLIUTE09' => 6736,
        'ZHENGLIUTE10' => 6737,
        'ZHENGLIUTE11' => 6738,
        'ZHENGLIUTE12' => 6739,
        'ZHENGLIUTE13' => 6740,
        'ZHENGLIUTE14' => 6741,
        'ZHENGLIUTE15' => 6742,
        'ZHENGLIUTE16' => 6743,
        'ZHENGLIUTE17' => 6744,
        'ZHENGLIUTE18' => 6745,
        'ZHENGLIUTE19' => 6746,
        'ZHENGLIUTE20' => 6747,
        'ZHENGLIUTE21' => 6748,
        'ZHENGLIUTE22' => 6749,
        'ZHENGLIUTE23' => 6750,
        'ZHENGLIUTE24' => 6751,
        'ZHENGLIUTE25' => 6752,
        'ZHENGLIUTE26' => 6753,
        'ZHENGLIUTE27' => 6754,
        'ZHENGLIUTE28' => 6755,
        'ZHENGLIUTE29' => 6756,
        'ZHENGLIUTE30' => 6757,
        'ZHENGLIUTE31' => 6758,
        'ZHENGLIUTE32' => 6759,
        'ZHENGLIUTE33' => 6760,
        'ZHENGLIUTE34' => 6761,
        'ZHENGLIUTE35' => 6762,
        'ZHENGLIUTE36' => 6763,
        'ZHENGLIUTE37' => 6764,
        'ZHENGLIUTE38' => 6765,
        'ZHENGLIUTE39' => 6766,
        'ZHENGLIUTE40' => 6767,
        'ZHENGLIUTE41' => 6768,
        'ZHENGLIUTE42' => 6769,
        'ZHENGLIUTE43' => 6770,
        'ZHENGLIUTE44' => 6771,
        'ZHENGLIUTE45' => 6772,
        'ZHENGLIUTE46' => 6773,
        'ZHENGLIUTE47' => 6774,
        'ZHENGLIUTE48' => 6775,
        'ZHENGLIUTE49' => 6776,
        'ZHENGLIUTEDANM' => 6777,
        'ZHENGLIUTESM' => 6778,
        'ZHENGLIUTEDAM' => 6779,
        'ZHENGLIUTEXM' => 6780,
        'ZHENGLIUTEHDAN' => 6781,
        'ZHENGLIUTEHS' => 6782,
        'ZHENGLIUTEHDA' => 6783,
        'ZHENGLIUTEHX' => 6784,
        'ZHENGLIUTEHONGBO' => 6785,
        'ZHENGLIUTELANBO' => 6786,
        'ZHENGLIUTELUBO' => 6787,
        'ZHENGLIUTEWEIDA' => 6788,
        'ZHENGLIUTEWEIXIAO' => 6789
    );

    protected function exc_play($openCode,$gameId){
        $win = collect([]);
        $ids_he = collect([]);
        $LHC = new ExcelLotteryLHC();
        $LHC->setArrPlay($openCode,$this->arrPlayCate,$this->arrPlayId);
        $LHC->LHC_TM($openCode,$gameId,$win);
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
        $table = 'game_jslhc';
        $gameName = '极速六合彩';
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
                    writeLog('New_Kill', 'jslhc killing...');
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
                        \Log::info($gameName.$issue.'退水前失败！');
                        return 0;
                    }
                    //退水
                    $res = $this->reBackUser($gameId, $issue, $gameName);
                    if(!$res){
                        $res = DB::table($table)->where('id',$id)->where('returnwater',2)->update(['returnwater' => 1]);
                        if(empty($res)){
                            \Log::info($gameName.$issue.'退水中失败！');
                            return 0;
                        }
                    }else
                        \Log::info($gameName.$issue.'退水前失败！');
                }else{//代理退水
                    $agentJob = new AgentBackwaterJob($gameId,$issue);
                    $agentJob->addQueue();
                }
            }
        }
    }
}