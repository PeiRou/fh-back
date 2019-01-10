<?php
/**
 * 后台的一些操作
 */

namespace App\Repository;

class BackActionRepository extends BaseRepository
{
    /**
     * 清除所有在线的状态
     * @param array $except 白名单id
     */
    public static function clearAccount ($except = [1])
    {
        $redis = \Illuminate\Support\Facades\Redis::connection();
        $redis->select(4);           //后台
        $keys = $redis->keys('sa:'.'*');

        while ($keys) {
            $key = array_pop($keys);
            while ($except) {
                $v = array_pop($except);
                if($key == ('sa:'.md5($v)))
                    continue 2;
            }
            $redis->del($key);
        }

    }

    /**
     * 获取平台状态
     * @return  true 开启
     */
    public static function getStatus ()
    {
        if (\Illuminate\Support\Facades\DB::table('system_setting')->value('back_switch') == 1)
            return true;

        return false;
    }
}