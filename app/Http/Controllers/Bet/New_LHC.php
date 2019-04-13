<?php
/**
 * Created by PhpStorm.
 * User: vincent
 * Date: 2018/7/11
 * Time: 下午10:59
 */

namespace App\Http\Controllers\Bet;

use App\Excel;
use App\ExcelLotteryLHC;
use App\Http\Controllers\Job\AgentBackwaterJob;
use Illuminate\Support\Facades\DB;

class New_LHC extends Excel
{
    protected $arrPlay_id = array(70641359,70641360,70641361,70641362,70641363,70641364,70641365,70641366,70641367,70641368,70641369,70641370,70641371,70641372,70641373,70641374,70641375,70641376,70641377,70641378,70641379,70641380,70641381,70641382,70641383,70641384,70641385,70641386,70641387,70641388,70641389,70641390,70641391,70641392,70641393,70641394,70641395,70641396,70641397,70641398,70641399,70641400,70641401,70641402,70641403,70641404,70641405,70641406,70641407,70641408,70641409,70641410,70641411,70641412,70641413,70641414,70641415,70641416,70641417,70641418,70641419,70641420,70641421,70641422,70641423,70641424,70641425,70641426,70641427,70641428,70641429,70641430,70641431,70641432,70641433,70641434,70641435,70641436,70641437,70641438,70641439,70641440,70641441,70641442,70641443,70641444,70641445,70641446,70641447,70641448,70641449,70641450,70641451,70641452,70641453,70641454,70641455,70641456,70651457,70651458,70651459,70651460,70651461,70651462,70651463,70651464,70651465,70651466,70651467,70651468,70651469,70651470,70651471,70651472,70651473,70651474,70651475,70651476,70651477,70651478,70651479,70651480,70661481,70661482,70661483,70661484,70661485,70661486,70661487,70661488,70661489,70661490,70661491,70661492,70661493,70661494,70661495,70661496,70661497,70661498,70661499,70661500,70661501,70661502,70661503,70661504,70661505,70661506,70661507,70671508,70671509,70671510,70671511,70671512,70671513,70671514,70671515,70671516,70671517,70671518,70671519,70681520,70681521,70681522,70681523,70681524,70681525,70681526,70681527,70681528,70681529,70691530,70691531,70691532,70691533,70691534,70691535,70691536,70691537,70691538,70691539,70691540,70691541,70691542,70691543,70691544,70701545,70701546,70701547,70701548,70701549,70701550,70701551,70701552,70701553,70701554,70701555,70701556,70701557,70701558,70701559,70701560,70701561,70701562,70701563,70701564,70701565,70701566,70701567,70701568,70701569,70701570,70701571,70701572,70701573,70701574,70701575,70701576,70701577,70701578,70701579,70701580,70701581,70701582,70701583,70701584,70701585,70701586,70701587,70701588,70701589,70701590,70701591,70701592,70701593,70721594,70721595,70721596,70721597,70721598,70731599,70731600,70731601,70731602,70731603,70731604,70731605,70731606,70731607,70731608,70731609,70731610,70731611,70731612,70731613,70731614,70731615,70731616,70731617,70731618,70731619,70731620,70741621,70741622,70741623,70741624,70741625,70741626,70741627,70741628,70741629,70741630,70741631,70741632,70751633,70751634,70751635,70751636,70761637,70761638,70761639,70761640,70761641,70761642,70761643,70761644,70771645,70771646,70771647,70771648,70771649,70771650,70771651,70771652,70781653,70781654,70781655,70781656,70781657,70781658,70781659,70781660,70781661,70781662,70781663,70781664,70781665,70781666,70781667,70781668,70781669,70781670,70781671,70781672,70781673,70781674,70781675,70781676,70781677,70781678,70781679,70781680,70781681,70781682,70781683,70781684,70781685,70781686,70781687,70781688,70781689,70781690,70781691,70781692,70781693,70781694,70781695,70781696,70781697,70781698,70781699,70781700,70781701,70781702,70781703,70781704,70781705,70781706,70781707,70781708,70781709,70781710,70781711,70781712,70781713,70781714,70781715,70781716,70781717,70781718,70781719,70781720,70781721,70781722,70781723,70781724,70781725,70781726,70781727,70781728,70781729,70781730,70781731,70781732,70781733,70781734,70781735,70781736,70781737,70781738,70781739,70781740,70791783,70791784,70791785,70791786,70791787,70791788,70791789,70791790,70711791,70711792,70711793,70711794,70711795,70711796,70711797,70711798,70711799,70711800,70711801,70711802,70711803,70711804,70711805,70711806,70711807,70711808,70711809,70711810,70711811,70711812,70711813,70711814,70711815,70711816,70711817,70711818,70711819,70711820,70711821,70711822,70711823,70711824,70711825,70711826,70711827,70711828,70711829,70711830,70711831,70711832,70711833,70711834,70711835,70711836,70711837,70711838,70711839,70711840,70711841,70711842,70711843,70711844,70711845,70711846,70711847,70711848,70711849,70711850,70711851,70711852,70711853,70711854,70711855,70711856,70711857,70711858,70711859,70711860,70711861,70711862,70711863,70711864,70711865,70711866,70711867,70711868,70711869,70711870,70711871,70711872,70711873,70711874,70711875,70711876,70711877,70711878,70711879,70711880,70711881,70711882,70711883,70711884,70711885,70711886,70711887,70711888,70711889,70711890,70711891,70711892,70711893,70711894,70711895,70711896,70711897,70711898,70711899,70711900,70711901,70711902,70711903,70711904,70711905,70711906,70711907,70711908,70711909,70711910,70711911,70711912,70711913,70711914,70711915,70711916,70711917,70711918,70711919,70711920,70711921,70711922,70711923,70711924,70711925,70711926,70711927,70711928,70711929,70711930,70711931,70711932,70711933,70711934,70711935,70711936,70711937,70711938,70711939,70711940,70711941,70711942,70711943,70711944,70711945,70711946,70711947,70711948,70711949,70711950,70711951,70711952,70711953,70711954,70711955,70711956,70711957,70711958,70711959,70711960,70711961,70711962,70711963,70711964,70711965,70711966,70711967,70711968,70711969,70711970,70711971,70711972,70711973,70711974,70711975,70711976,70711977,70711978,70711979,70711980,70711981,70711982,70711983,70711984,70711985,70711986,70711987,70711988,70711989,70711990,70711991,70711992,70711993,70711994,70711995,70711996,70711997,70711998,70711999,70712000,70712001,70712002,70712003,70712004,70712005,70712006,70712007,70712008,70712009,70712010,70712011,70712012,70712013,70712014,70712015,70712016,70712017,70712018,70712019,70712020,70712021,70712022,70712023,70712024,70712025,70712026,70712027,70712028,70712029,70712030,70712031,70712032,70712033,70712034,70712035,70712036,70712037,70712038,70712039,70712040,70712041,70712042,70712043,70712044,70712045,70712046,70712047,70712048,70712049,70712050,70712051,70712052,70712053,70712054,70712055,70712056,70712057,70712058,70712059,70712060,70712061,70712062,70712063,70712064,70712065,70712066,70712067,70712068,70712069,70712070,70712071,70712072,70712073,70712074,70712075,70712076,70712077,70712078,70712079,70712080,70712081,70712082,70712083,70712084,70712085,70712086,70712087,70712088,70712089,70712090,70712091,70712092,70712093,70712094,70712095,70712096,70712097,70712098,70712099,70712100,70712101,70712102,70712103,70712104,70712105,70712106,70712107,70712108,70712109,70712110,70712111,70712112,70712113,70712114,70712115,70712116,70712117,70712118,70712119,70712120,70712121,70712122,70712123,70712124,70712125,70712126,70712127,70712128,70712129,70712130,70712131,70712132,70712133,70712134,70712135,70712136,70712137,70712138,70712139,70712140,70712141,70712142,70712143,70712144,70712145,70712146,70712147,70712148,70712149,70712150,70712151,70712152,70712153,70712154,70712155,70712156,70712157,70712158,70712159,70712160,70712161,70712162);
    protected $arrPlayCate = array(
        'TEMA' => 64,
        'LIANGMIAN' => 65,
        'SEBO' => 66,
        'TEXIAO' => 67,
        'HEXIAO' => 68,
        'TOUWEISHU' => 69,
        'ZHENGMA' => 70,
        'ZHENGMATE' => 71,
        'WUHANG' => 72,
        'PINGTEYIXIAOWEISHU' => 73,
        'ZHENGXIAO' => 74,
        'QISEBO' => 75,
        'ZONGXIAO' => 76,
        'ZIXUANBUZHONG' => 77,
        'LIANXIAOLIANWEI' => 78,
        'LIANMA' => 79
    );
    protected $arrPlayId = array(
        'TMA_01' => 1359,
        'TMA_02' => 1360,
        'TMA_03' => 1361,
        'TMA_04' => 1362,
        'TMA_05' => 1363,
        'TMA_06' => 1364,
        'TMA_07' => 1365,
        'TMA_08' => 1366,
        'TMA_09' => 1367,
        'TMA_10' => 1368,
        'TMA_11' => 1369,
        'TMA_12' => 1370,
        'TMA_13' => 1371,
        'TMA_14' => 1372,
        'TMA_15' => 1373,
        'TMA_16' => 1374,
        'TMA_17' => 1375,
        'TMA_18' => 1376,
        'TMA_19' => 1377,
        'TMA_20' => 1378,
        'TMA_21' => 1379,
        'TMA_22' => 1380,
        'TMA_23' => 1381,
        'TMA_24' => 1382,
        'TMA_25' => 1383,
        'TMA_26' => 1384,
        'TMA_27' => 1385,
        'TMA_28' => 1386,
        'TMA_29' => 1387,
        'TMA_30' => 1388,
        'TMA_31' => 1389,
        'TMA_32' => 1390,
        'TMA_33' => 1391,
        'TMA_34' => 1392,
        'TMA_35' => 1393,
        'TMA_36' => 1394,
        'TMA_37' => 1395,
        'TMA_38' => 1396,
        'TMA_39' => 1397,
        'TMA_40' => 1398,
        'TMA_41' => 1399,
        'TMA_42' => 1400,
        'TMA_43' => 1401,
        'TMA_44' => 1402,
        'TMA_45' => 1403,
        'TMA_46' => 1404,
        'TMA_47' => 1405,
        'TMA_48' => 1406,
        'TMA_49' => 1407,
        'TMB_01' => 1408,
        'TMB_02' => 1409,
        'TMB_03' => 1410,
        'TMB_04' => 1411,
        'TMB_05' => 1412,
        'TMB_06' => 1413,
        'TMB_07' => 1414,
        'TMB_08' => 1415,
        'TMB_09' => 1416,
        'TMB_10' => 1417,
        'TMB_11' => 1418,
        'TMB_12' => 1419,
        'TMB_13' => 1420,
        'TMB_14' => 1421,
        'TMB_15' => 1422,
        'TMB_16' => 1423,
        'TMB_17' => 1424,
        'TMB_18' => 1425,
        'TMB_19' => 1426,
        'TMB_20' => 1427,
        'TMB_21' => 1428,
        'TMB_22' => 1429,
        'TMB_23' => 1430,
        'TMB_24' => 1431,
        'TMB_25' => 1432,
        'TMB_26' => 1433,
        'TMB_27' => 1434,
        'TMB_28' => 1435,
        'TMB_29' => 1436,
        'TMB_30' => 1437,
        'TMB_31' => 1438,
        'TMB_32' => 1439,
        'TMB_33' => 1440,
        'TMB_34' => 1441,
        'TMB_35' => 1442,
        'TMB_36' => 1443,
        'TMB_37' => 1444,
        'TMB_38' => 1445,
        'TMB_39' => 1446,
        'TMB_40' => 1447,
        'TMB_41' => 1448,
        'TMB_42' => 1449,
        'TMB_43' => 1450,
        'TMB_44' => 1451,
        'TMB_45' => 1452,
        'TMB_46' => 1453,
        'TMB_47' => 1454,
        'TMB_48' => 1455,
        'TMB_49' => 1456,
        'LMTD' => 1457,
        'LMTX' => 1458,
        'LMTDAN' => 1459,
        'LMTS' => 1460,
        'LMTHD' => 1461,
        'LMTHEX' => 1462,
        'LMTHDAN' => 1463,
        'LMTHSHUANG' => 1464,
        'LMTWD' => 1465,
        'LMTWX' => 1466,
        'LMTDDAN' => 1467,
        'LMTDSHUANG' => 1468,
        'LMTXDAN' => 1469,
        'LMTXS' => 1470,
        'LMTTX' => 1471,
        'LMTDX' => 1472,
        'LMTQX' => 1473,
        'LMTHOUX' => 1474,
        'LMTJX' => 1475,
        'LMTYX' => 1476,
        'LMZHD' => 1477,
        'LMZHS' => 1478,
        'LMZHDA' => 1479,
        'LMZHXIAO' => 1480,
        'HONGBO' => 1481,
        'LANBO' => 1482,
        'LUBO' => 1483,
        'HONGDAN' => 1484,
        'HONGSHUANG' => 1485,
        'HONGDA' => 1486,
        'HONGXIAO' => 1487,
        'LANDAN' => 1488,
        'LANSHUANG' => 1489,
        'LANDA' => 1490,
        'LANXIAO' => 1491,
        'LUDAN' => 1492,
        'LUSHUANG' => 1493,
        'LUDA' => 1494,
        'LUAXIAO' => 1495,
        'HONGDADAN' => 1496,
        'HONGDASHUANG' => 1497,
        'HONGXIAODAN' => 1498,
        'HONGXIAOSHUANG' => 1499,
        'LANDADAN' => 1500,
        'LANDASHUANG' => 1501,
        'LANXIAODAN' => 1502,
        'LANXIAOSHUANG' => 1503,
        'LUDADAN' => 1504,
        'LUDASHUANG' => 1505,
        'LUXIAODAN' => 1506,
        'LUXIAOSHUANG' => 1507,
        'TXSHU' => 1508,
        'TXNIU' => 1509,
        'TXHU' => 1510,
        'TXTU' => 1511,
        'TXLONG' => 1512,
        'TXSHE' => 1513,
        'TXMA' => 1514,
        'TXYANG' => 1515,
        'TXHOU' => 1516,
        'TXJI' => 1517,
        'TXGOU' => 1518,
        'TXZHU' => 1519,
        'HEXIAO2' => 1520,
        'HEXIAO3' => 1521,
        'HEXIAO4' => 1522,
        'HEXIAO5' => 1523,
        'HEXIAO6' => 1524,
        'HEXIAO7' => 1525,
        'HEXIAO8' => 1526,
        'HEXIAO9' => 1527,
        'HEXIAO10' => 1528,
        'HEXIAO11' => 1529,
        'TOUT0' => 1530,
        'TOUT1' => 1531,
        'TOUT2' => 1532,
        'TOUT3' => 1533,
        'TOUT4' => 1534,
        'WEIW1' => 1535,
        'WEIW2' => 1536,
        'WEIW3' => 1537,
        'WEIW4' => 1538,
        'WEIW5' => 1539,
        'WEIW6' => 1540,
        'WEIW7' => 1541,
        'WEIW8' => 1542,
        'WEIW9' => 1543,
        'WEIW0' => 1544,
        'ZM01' => 1545,
        'ZM02' => 1546,
        'ZM03' => 1547,
        'ZM04' => 1548,
        'ZM05' => 1549,
        'ZM06' => 1550,
        'ZM07' => 1551,
        'ZM08' => 1552,
        'ZM09' => 1553,
        'ZM10' => 1554,
        'ZM11' => 1555,
        'ZM12' => 1556,
        'ZM13' => 1557,
        'ZM14' => 1558,
        'ZM15' => 1559,
        'ZM16' => 1560,
        'ZM17' => 1561,
        'ZM18' => 1562,
        'ZM19' => 1563,
        'ZM20' => 1564,
        'ZM21' => 1565,
        'ZM22' => 1566,
        'ZM23' => 1567,
        'ZM24' => 1568,
        'ZM25' => 1569,
        'ZM26' => 1570,
        'ZM27' => 1571,
        'ZM28' => 1572,
        'ZM29' => 1573,
        'ZM30' => 1574,
        'ZM31' => 1575,
        'ZM32' => 1576,
        'ZM33' => 1577,
        'ZM34' => 1578,
        'ZM35' => 1579,
        'ZM36' => 1580,
        'ZM37' => 1581,
        'ZM38' => 1582,
        'ZM39' => 1583,
        'ZM40' => 1584,
        'ZM41' => 1585,
        'ZM42' => 1586,
        'ZM43' => 1587,
        'ZM44' => 1588,
        'ZM45' => 1589,
        'ZM46' => 1590,
        'ZM47' => 1591,
        'ZM48' => 1592,
        'ZM49' => 1593,
        'WXJIN' => 1594,
        'WXMU' => 1595,
        'WXSHUI' => 1596,
        'WXHUO' => 1597,
        'WXTU' => 1598,
        'PTYXSHU' => 1599,
        'PTYXNIU' => 1600,
        'PTYXHU' => 1601,
        'PTYXTU' => 1602,
        'PTYXLONG' => 1603,
        'PTYXSHE' => 1604,
        'PTYXMA' => 1605,
        'PTYXYANG' => 1606,
        'PTYXHOU' => 1607,
        'PTYXJI' => 1608,
        'PTYXGOU' => 1609,
        'PTYXZHU' => 1610,
        'PTYXW0' => 1611,
        'PTYXW1' => 1612,
        'PTYXW2' => 1613,
        'PTYXW3' => 1614,
        'PTYXW4' => 1615,
        'PTYXW5' => 1616,
        'PTYXW6' => 1617,
        'PTYXW7' => 1618,
        'PTYXW8' => 1619,
        'PTYXW9' => 1620,
        'ZXIAOSHU' => 1621,
        'ZXIAONIU' => 1622,
        'ZXIAOHU' => 1623,
        'ZXIAOTU' => 1624,
        'ZXIAOLONG' => 1625,
        'ZXIAOSHE' => 1626,
        'ZXIAOMA' => 1627,
        'ZXIAOYANG' => 1628,
        'ZXIAOHOU' => 1629,
        'ZXIAOJI' => 1630,
        'ZXIAOGOU' => 1631,
        'ZXIAOZHU' => 1632,
        'QISBHONG' => 1633,
        'QISBLANBO' => 1634,
        'QISBLUBO' => 1635,
        'QISBHJ' => 1636,
        'ZONGXIAO2X2' => 1637,
        'ZONGXIAO3X3' => 1638,
        'ZONGXIAO4X4' => 1639,
        'ZONGXIAO5X5' => 1640,
        'ZONGXIAO6X6' => 1641,
        'ZONGXIAO7X7' => 1642,
        'ZONGXIAODAN' => 1643,
        'ZONGXIAOS' => 1644,
        'ZXBZ5' => 1645,
        'ZXBZ6' => 1646,
        'ZXBZ7' => 1647,
        'ZXBZ8' => 1648,
        'ZXBZ9' => 1649,
        'ZXBZ10' => 1650,
        'ZXBZ11' => 1651,
        'ZXBZ12' => 1652,
        'ELXSHU' => 1653,
        'ELXNIU' => 1654,
        'ELXHU' => 1655,
        'ELXTU' => 1656,
        'ELXLONG' => 1657,
        'ELXSHE' => 1658,
        'ELXMA' => 1659,
        'ELXYANG' => 1660,
        'ELXHOU' => 1661,
        'ELXJI' => 1662,
        'ELXGOU' => 1663,
        'ELXZHU' => 1664,
        'SLXSHU' => 1665,
        'SLXNIU' => 1666,
        'SLXHU' => 1667,
        'SLXTU' => 1668,
        'SLXLONG' => 1669,
        'SLXSHE' => 1670,
        'SLXMA' => 1671,
        'SLXYANG' => 1672,
        'SLXHOU' => 1673,
        'SLXJI' => 1674,
        'SLXGOU' => 1675,
        'SLXZHU' => 1676,
        'SILXSHU' => 1677,
        'SILXNIU' => 1678,
        'SILXHU' => 1679,
        'SILXTU' => 1680,
        'SILXLONG' => 1681,
        'SILXSHE' => 1682,
        'SILXMA' => 1683,
        'SILXYANG' => 1684,
        'SILXHOU' => 1685,
        'SILXJI' => 1686,
        'SILXGOU' => 1687,
        'SILXZHU' => 1688,
        'WLXSHU' => 1689,
        'WLXNIU' => 1690,
        'WLXHU' => 1691,
        'WLXTU' => 1692,
        'WLXLONG' => 1693,
        'WLXSHE' => 1694,
        'WLXMA' => 1695,
        'WLXYANG' => 1696,
        'WLXHOU' => 1697,
        'WLXJI' => 1698,
        'WLXGOU' => 1699,
        'WLXZHU' => 1700,
        'EELW0' => 1701,
        'EELW1' => 1702,
        'EELW2' => 1703,
        'EELW3' => 1704,
        'EELW4' => 1705,
        'EELW5' => 1706,
        'EELW6' => 1707,
        'EELW7' => 1708,
        'EELW8' => 1709,
        'EELW9' => 1710,
        'SSLW0' => 1711,
        'SSLW1' => 1712,
        'SSLW2' => 1713,
        'SSLW3' => 1714,
        'SSLW4' => 1715,
        'SSLW5' => 1716,
        'SSLW6' => 1717,
        'SSLW7' => 1718,
        'SSLW8' => 1719,
        'SSLW9' => 1720,
        'SILW0' => 1721,
        'SILW1' => 1722,
        'SILW2' => 1723,
        'SILW3' => 1724,
        'SILW4' => 1725,
        'SILW5' => 1726,
        'SILW6' => 1727,
        'SILW7' => 1728,
        'SILW8' => 1729,
        'SILW9' => 1730,
        'WULW0' => 1731,
        'WULW1' => 1732,
        'WULW2' => 1733,
        'WULW3' => 1734,
        'WULW4' => 1735,
        'WULW5' => 1736,
        'WULW6' => 1737,
        'WULW7' => 1738,
        'WULW8' => 1739,
        'WULW9' => 1740,
        'SANZHONGERZHONGER' => 1783,
        'SANZHONGERZHONGSAN' => 1784,
        'SANQUANZHONG' => 1785,
        'ERQUANZHONG' => 1786,
        'ERZHONGTEZHONGTE' => 1787,
        'ERZHONGTEZHONGER' => 1788,
        'TECHUAN' => 1789,
        'SIQUANZHONG' => 1790,
        'ZHENGYITE01' => 1791,
        'ZHENGYITE02' => 1792,
        'ZHENGYITE03' => 1793,
        'ZHENGYITE04' => 1794,
        'ZHENGYITE05' => 1795,
        'ZHENGYITE06' => 1796,
        'ZHENGYITE07' => 1797,
        'ZHENGYITE08' => 1798,
        'ZHENGYITE09' => 1799,
        'ZHENGYITE10' => 1800,
        'ZHENGYITE11' => 1801,
        'ZHENGYITE12' => 1802,
        'ZHENGYITE13' => 1803,
        'ZHENGYITE14' => 1804,
        'ZHENGYITE15' => 1805,
        'ZHENGYITE16' => 1806,
        'ZHENGYITE17' => 1807,
        'ZHENGYITE18' => 1808,
        'ZHENGYITE19' => 1809,
        'ZHENGYITE20' => 1810,
        'ZHENGYITE21' => 1811,
        'ZHENGYITE22' => 1812,
        'ZHENGYITE23' => 1813,
        'ZHENGYITE24' => 1814,
        'ZHENGYITE25' => 1815,
        'ZHENGYITE26' => 1816,
        'ZHENGYITE27' => 1817,
        'ZHENGYITE28' => 1818,
        'ZHENGYITE29' => 1819,
        'ZHENGYITE30' => 1820,
        'ZHENGYITE31' => 1821,
        'ZHENGYITE32' => 1822,
        'ZHENGYITE33' => 1823,
        'ZHENGYITE34' => 1824,
        'ZHENGYITE35' => 1825,
        'ZHENGYITE36' => 1826,
        'ZHENGYITE37' => 1827,
        'ZHENGYITE38' => 1828,
        'ZHENGYITE39' => 1829,
        'ZHENGYITE40' => 1830,
        'ZHENGYITE41' => 1831,
        'ZHENGYITE42' => 1832,
        'ZHENGYITE43' => 1833,
        'ZHENGYITE44' => 1834,
        'ZHENGYITE45' => 1835,
        'ZHENGYITE46' => 1836,
        'ZHENGYITE47' => 1837,
        'ZHENGYITE48' => 1838,
        'ZHENGYITE49' => 1839,
        'ZHENGYITEDANM' => 1840,
        'ZHENGYITESM' => 1841,
        'ZHENGYITEDAM' => 1842,
        'ZHENGYITEXM' => 1843,
        'ZHENGYITEHDAN' => 1844,
        'ZHENGYITEHS' => 1845,
        'ZHENGYITEHDA' => 1846,
        'ZHENGYITEHX' => 1847,
        'ZHENGYITEHONGBO' => 1848,
        'ZHENGYITELANBO' => 1849,
        'ZHENGYITELUBO' => 1850,
        'ZHENGYITEWEIDA' => 1851,
        'ZHENGYITEWEIXIAO' => 1852,
        'ZHENGERTE01' => 1853,
        'ZHENGERTE02' => 1854,
        'ZHENGERTE03' => 1855,
        'ZHENGERTE04' => 1856,
        'ZHENGERTE05' => 1857,
        'ZHENGERTE06' => 1858,
        'ZHENGERTE07' => 1859,
        'ZHENGERTE08' => 1860,
        'ZHENGERTE09' => 1861,
        'ZHENGERTE10' => 1862,
        'ZHENGERTE11' => 1863,
        'ZHENGERTE12' => 1864,
        'ZHENGERTE13' => 1865,
        'ZHENGERTE14' => 1866,
        'ZHENGERTE15' => 1867,
        'ZHENGERTE16' => 1868,
        'ZHENGERTE17' => 1869,
        'ZHENGERTE18' => 1870,
        'ZHENGERTE19' => 1871,
        'ZHENGERTE20' => 1872,
        'ZHENGERTE21' => 1873,
        'ZHENGERTE22' => 1874,
        'ZHENGERTE23' => 1875,
        'ZHENGERTE24' => 1876,
        'ZHENGERTE25' => 1877,
        'ZHENGERTE26' => 1878,
        'ZHENGERTE27' => 1879,
        'ZHENGERTE28' => 1880,
        'ZHENGERTE29' => 1881,
        'ZHENGERTE30' => 1882,
        'ZHENGERTE31' => 1883,
        'ZHENGERTE32' => 1884,
        'ZHENGERTE33' => 1885,
        'ZHENGERTE34' => 1886,
        'ZHENGERTE35' => 1887,
        'ZHENGERTE36' => 1888,
        'ZHENGERTE37' => 1889,
        'ZHENGERTE38' => 1890,
        'ZHENGERTE39' => 1891,
        'ZHENGERTE40' => 1892,
        'ZHENGERTE41' => 1893,
        'ZHENGERTE42' => 1894,
        'ZHENGERTE43' => 1895,
        'ZHENGERTE44' => 1896,
        'ZHENGERTE45' => 1897,
        'ZHENGERTE46' => 1898,
        'ZHENGERTE47' => 1899,
        'ZHENGERTE48' => 1900,
        'ZHENGERTE49' => 1901,
        'ZHENGERTEDANM' => 1902,
        'ZHENGERTESM' => 1903,
        'ZHENGERTEDAM' => 1904,
        'ZHENGERTEXM' => 1905,
        'ZHENGERTEHDAN' => 1906,
        'ZHENGERTEHS' => 1907,
        'ZHENGERTEHDA' => 1908,
        'ZHENGERTEHX' => 1909,
        'ZHENGERTEHONGBO' => 1910,
        'ZHENGERTELANBO' => 1911,
        'ZHENGERTELUBO' => 1912,
        'ZHENGERTEWEIDA' => 1913,
        'ZHENGERTEWEIXIAO' => 1914,
        'ZHENGSANTE01' => 1915,
        'ZHENGSANTE02' => 1916,
        'ZHENGSANTE03' => 1917,
        'ZHENGSANTE04' => 1918,
        'ZHENGSANTE05' => 1919,
        'ZHENGSANTE06' => 1920,
        'ZHENGSANTE07' => 1921,
        'ZHENGSANTE08' => 1922,
        'ZHENGSANTE09' => 1923,
        'ZHENGSANTE10' => 1924,
        'ZHENGSANTE11' => 1925,
        'ZHENGSANTE12' => 1926,
        'ZHENGSANTE13' => 1927,
        'ZHENGSANTE14' => 1928,
        'ZHENGSANTE15' => 1929,
        'ZHENGSANTE16' => 1930,
        'ZHENGSANTE17' => 1931,
        'ZHENGSANTE18' => 1932,
        'ZHENGSANTE19' => 1933,
        'ZHENGSANTE20' => 1934,
        'ZHENGSANTE21' => 1935,
        'ZHENGSANTE22' => 1936,
        'ZHENGSANTE23' => 1937,
        'ZHENGSANTE24' => 1938,
        'ZHENGSANTE25' => 1939,
        'ZHENGSANTE26' => 1940,
        'ZHENGSANTE27' => 1941,
        'ZHENGSANTE28' => 1942,
        'ZHENGSANTE29' => 1943,
        'ZHENGSANTE30' => 1944,
        'ZHENGSANTE31' => 1945,
        'ZHENGSANTE32' => 1946,
        'ZHENGSANTE33' => 1947,
        'ZHENGSANTE34' => 1948,
        'ZHENGSANTE35' => 1949,
        'ZHENGSANTE36' => 1950,
        'ZHENGSANTE37' => 1951,
        'ZHENGSANTE38' => 1952,
        'ZHENGSANTE39' => 1953,
        'ZHENGSANTE40' => 1954,
        'ZHENGSANTE41' => 1955,
        'ZHENGSANTE42' => 1956,
        'ZHENGSANTE43' => 1957,
        'ZHENGSANTE44' => 1958,
        'ZHENGSANTE45' => 1959,
        'ZHENGSANTE46' => 1960,
        'ZHENGSANTE47' => 1961,
        'ZHENGSANTE48' => 1962,
        'ZHENGSANTE49' => 1963,
        'ZHENGSANTEDANM' => 1964,
        'ZHENGSANTESM' => 1965,
        'ZHENGSANTEDAM' => 1966,
        'ZHENGSANTEXM' => 1967,
        'ZHENGSANTEHDAN' => 1968,
        'ZHENGSANTEHS' => 1969,
        'ZHENGSANTEHDA' => 1970,
        'ZHENGSANTEHX' => 1971,
        'ZHENGSANTEHONGBO' => 1972,
        'ZHENGSANTELANBO' => 1973,
        'ZHENGSANTELUBO' => 1974,
        'ZHENGSANTEWEIDA' => 1975,
        'ZHENGSANTEWEIXIAO' => 1976,
        'ZHENGSITE01' => 1977,
        'ZHENGSITE02' => 1978,
        'ZHENGSITE03' => 1979,
        'ZHENGSITE04' => 1980,
        'ZHENGSITE05' => 1981,
        'ZHENGSITE06' => 1982,
        'ZHENGSITE07' => 1983,
        'ZHENGSITE08' => 1984,
        'ZHENGSITE09' => 1985,
        'ZHENGSITE10' => 1986,
        'ZHENGSITE11' => 1987,
        'ZHENGSITE12' => 1988,
        'ZHENGSITE13' => 1989,
        'ZHENGSITE14' => 1990,
        'ZHENGSITE15' => 1991,
        'ZHENGSITE16' => 1992,
        'ZHENGSITE17' => 1993,
        'ZHENGSITE18' => 1994,
        'ZHENGSITE19' => 1995,
        'ZHENGSITE20' => 1996,
        'ZHENGSITE21' => 1997,
        'ZHENGSITE22' => 1998,
        'ZHENGSITE23' => 1999,
        'ZHENGSITE24' => 2000,
        'ZHENGSITE25' => 2001,
        'ZHENGSITE26' => 2002,
        'ZHENGSITE27' => 2003,
        'ZHENGSITE28' => 2004,
        'ZHENGSITE29' => 2005,
        'ZHENGSITE30' => 2006,
        'ZHENGSITE31' => 2007,
        'ZHENGSITE32' => 2008,
        'ZHENGSITE33' => 2009,
        'ZHENGSITE34' => 2010,
        'ZHENGSITE35' => 2011,
        'ZHENGSITE36' => 2012,
        'ZHENGSITE37' => 2013,
        'ZHENGSITE38' => 2014,
        'ZHENGSITE39' => 2015,
        'ZHENGSITE40' => 2016,
        'ZHENGSITE41' => 2017,
        'ZHENGSITE42' => 2018,
        'ZHENGSITE43' => 2019,
        'ZHENGSITE44' => 2020,
        'ZHENGSITE45' => 2021,
        'ZHENGSITE46' => 2022,
        'ZHENGSITE47' => 2023,
        'ZHENGSITE48' => 2024,
        'ZHENGSITE49' => 2025,
        'ZHENGSITEDANM' => 2026,
        'ZHENGSITESM' => 2027,
        'ZHENGSITEDAM' => 2028,
        'ZHENGSITEXM' => 2029,
        'ZHENGSITEHDAN' => 2030,
        'ZHENGSITEHS' => 2031,
        'ZHENGSITEHDA' => 2032,
        'ZHENGSITEHX' => 2033,
        'ZHENGSITEHONGBO' => 2034,
        'ZHENGSITELANBO' => 2035,
        'ZHENGSITELUBO' => 2036,
        'ZHENGSITEWEIDA' => 2037,
        'ZHENGSITEWEIXIAO' => 2038,
        'ZHENGWUTE01' => 2039,
        'ZHENGWUTE02' => 2040,
        'ZHENGWUTE03' => 2041,
        'ZHENGWUTE04' => 2042,
        'ZHENGWUTE05' => 2043,
        'ZHENGWUTE06' => 2044,
        'ZHENGWUTE07' => 2045,
        'ZHENGWUTE08' => 2046,
        'ZHENGWUTE09' => 2047,
        'ZHENGWUTE10' => 2048,
        'ZHENGWUTE11' => 2049,
        'ZHENGWUTE12' => 2050,
        'ZHENGWUTE13' => 2051,
        'ZHENGWUTE14' => 2052,
        'ZHENGWUTE15' => 2053,
        'ZHENGWUTE16' => 2054,
        'ZHENGWUTE17' => 2055,
        'ZHENGWUTE18' => 2056,
        'ZHENGWUTE19' => 2057,
        'ZHENGWUTE20' => 2058,
        'ZHENGWUTE21' => 2059,
        'ZHENGWUTE22' => 2060,
        'ZHENGWUTE23' => 2061,
        'ZHENGWUTE24' => 2062,
        'ZHENGWUTE25' => 2063,
        'ZHENGWUTE26' => 2064,
        'ZHENGWUTE27' => 2065,
        'ZHENGWUTE28' => 2066,
        'ZHENGWUTE29' => 2067,
        'ZHENGWUTE30' => 2068,
        'ZHENGWUTE31' => 2069,
        'ZHENGWUTE32' => 2070,
        'ZHENGWUTE33' => 2071,
        'ZHENGWUTE34' => 2072,
        'ZHENGWUTE35' => 2073,
        'ZHENGWUTE36' => 2074,
        'ZHENGWUTE37' => 2075,
        'ZHENGWUTE38' => 2076,
        'ZHENGWUTE39' => 2077,
        'ZHENGWUTE40' => 2078,
        'ZHENGWUTE41' => 2079,
        'ZHENGWUTE42' => 2080,
        'ZHENGWUTE43' => 2081,
        'ZHENGWUTE44' => 2082,
        'ZHENGWUTE45' => 2083,
        'ZHENGWUTE46' => 2084,
        'ZHENGWUTE47' => 2085,
        'ZHENGWUTE48' => 2086,
        'ZHENGWUTE49' => 2087,
        'ZHENGWUTEDANM' => 2088,
        'ZHENGWUTESM' => 2089,
        'ZHENGWUTEDAM' => 2090,
        'ZHENGWUTEXM' => 2091,
        'ZHENGWUTEHDAN' => 2092,
        'ZHENGWUTEHS' => 2093,
        'ZHENGWUTEHDA' => 2094,
        'ZHENGWUTEHX' => 2095,
        'ZHENGWUTEHONGBO' => 2096,
        'ZHENGWUTELANBO' => 2097,
        'ZHENGWUTELUBO' => 2098,
        'ZHENGWUTEWEIDA' => 2099,
        'ZHENGWUTEWEIXIAO' => 2100,
        'ZHENGLIUTE01' => 2101,
        'ZHENGLIUTE02' => 2102,
        'ZHENGLIUTE03' => 2103,
        'ZHENGLIUTE04' => 2104,
        'ZHENGLIUTE05' => 2105,
        'ZHENGLIUTE06' => 2106,
        'ZHENGLIUTE07' => 2107,
        'ZHENGLIUTE08' => 2108,
        'ZHENGLIUTE09' => 2109,
        'ZHENGLIUTE10' => 2110,
        'ZHENGLIUTE11' => 2111,
        'ZHENGLIUTE12' => 2112,
        'ZHENGLIUTE13' => 2113,
        'ZHENGLIUTE14' => 2114,
        'ZHENGLIUTE15' => 2115,
        'ZHENGLIUTE16' => 2116,
        'ZHENGLIUTE17' => 2117,
        'ZHENGLIUTE18' => 2118,
        'ZHENGLIUTE19' => 2119,
        'ZHENGLIUTE20' => 2120,
        'ZHENGLIUTE21' => 2121,
        'ZHENGLIUTE22' => 2122,
        'ZHENGLIUTE23' => 2123,
        'ZHENGLIUTE24' => 2124,
        'ZHENGLIUTE25' => 2125,
        'ZHENGLIUTE26' => 2126,
        'ZHENGLIUTE27' => 2127,
        'ZHENGLIUTE28' => 2128,
        'ZHENGLIUTE29' => 2129,
        'ZHENGLIUTE30' => 2130,
        'ZHENGLIUTE31' => 2131,
        'ZHENGLIUTE32' => 2132,
        'ZHENGLIUTE33' => 2133,
        'ZHENGLIUTE34' => 2134,
        'ZHENGLIUTE35' => 2135,
        'ZHENGLIUTE36' => 2136,
        'ZHENGLIUTE37' => 2137,
        'ZHENGLIUTE38' => 2138,
        'ZHENGLIUTE39' => 2139,
        'ZHENGLIUTE40' => 2140,
        'ZHENGLIUTE41' => 2141,
        'ZHENGLIUTE42' => 2142,
        'ZHENGLIUTE43' => 2143,
        'ZHENGLIUTE44' => 2144,
        'ZHENGLIUTE45' => 2145,
        'ZHENGLIUTE46' => 2146,
        'ZHENGLIUTE47' => 2147,
        'ZHENGLIUTE48' => 2148,
        'ZHENGLIUTE49' => 2149,
        'ZHENGLIUTEDANM' => 2150,
        'ZHENGLIUTESM' => 2151,
        'ZHENGLIUTEDAM' => 2152,
        'ZHENGLIUTEXM' => 2153,
        'ZHENGLIUTEHDAN' => 2154,
        'ZHENGLIUTEHS' => 2155,
        'ZHENGLIUTEHDA' => 2156,
        'ZHENGLIUTEHX' => 2157,
        'ZHENGLIUTEHONGBO' => 2158,
        'ZHENGLIUTELANBO' => 2159,
        'ZHENGLIUTELUBO' => 2160,
        'ZHENGLIUTEWEIDA' => 2161,
        'ZHENGLIUTEWEIXIAO' => 2162
    );

    protected function exc_play($openCode,$gameId){
        $win = collect([]);
        $ids_he = collect([]);
        $LHC = new ExcelLotteryLHC();
        $LHC->setArrPlay($openCode,$this->arrPlayCate,$this->arrPlayId);
        $LHC->LHC_TM($openCode,$gameId,$win);
        $LHC->LHC_LM($openCode,$gameId,$win,$ids_he);
        $LHC->LHC_SB($openCode,$gameId,$win);
        $LHC->LHC_TX($openCode,$gameId,$win);
        $LHC->LHC_TMTWS($openCode,$gameId,$win);
        $LHC->LHC_ZM($openCode,$gameId,$win);
        $LHC->LHC_ZMT($openCode,$gameId,$win,$ids_he);
        $LHC->LHC_WX($openCode,$gameId,$win);
        $LHC->LHC_QSB($openCode,$gameId,$win,$ids_he);
        $LHC->LHC_PTYXWS($openCode,$gameId,$win);
        $LHC->LHC_ZONGXIAO($gameId,$win);
        return array('win'=>$win,'ids_he'=>$ids_he,'LHC'=>$LHC);
    }

    public function all($openCode,$issue,$gameId,$id)
    {
        $table = 'game_lhc';
        $gameName = '六合彩';
        $betCount = DB::table('bet')->where('status',0)->where('game_id',$gameId)->where('issue',$issue)->where('bunko','=',0.00)->count();
        if($betCount > 0){
            $bunko = 0;
            $resData = $this->exc_play($openCode,$gameId);
            $win = @$resData['win'];
            $he = isset($resData['ids_he'])?$resData['ids_he']:array();
            $LHC = isset($resData['LHC'])?$resData['LHC']:null;
            try{
                $bunko = $this->BUNKO_LHC($openCode,$win,$gameId,$issue,$he,false,$LHC);
            }catch (\exception $exception){
                writeLog('New_Bet', __CLASS__ . '->' . __FUNCTION__ . ' Line:' . $exception->getLine() . ' ' . $exception->getMessage());
                DB::table('bet')->where('issue',$issue)->where('game_id',$gameId)->update(['status' => 0,'bunko' => 0]);
            }
            if($bunko == 1){
                $updateUserMoney = $this->updateUserMoney($gameId,$issue,$gameName,$table,$id);
                if($updateUserMoney == 1){
                    writeLog('New_Bet', $gameName . $issue . "结算出错");
                }
            }
        }
        $update = DB::table($table)->where('id',$id)->update([
            'bunko' => 1
        ]);
        if ($update !== 1) {
            writeLog('New_Bet', $gameName . $issue . "结算not Finshed");
        }else{
            $this->stopBunko($gameId,1);
            $agentJob = new AgentBackwaterJob($gameId,$issue);
            $agentJob->addQueue();
        }
    }
}