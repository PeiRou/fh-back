<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/5/11
 * Time: 21:18
 */

namespace App\Http\Services;


use App\GamesApi;

trait Cache
{
    /**
     * 获取缓存的实例-没用到laravel的cache辅助函数是为了删除这些缓存的时候分了文件夹方便
     * @return mixed
     */
    public static function CaCheInstance()
    {
        return GamesApi::getCaCheInstance('DataCache/'.str_replace('\\','_',get_class()));
    }
    /**
     * 缓存
     * @param \Closure $closure 如果没有缓存执行的回调
     * @param int $time 缓存时间
     * @param mixed ...$args 附加参数
     */
    public static function HandleCacheData(\Closure $closure, $time = 1, ...$args)
    {
        $res = new \ReflectionFunction ($closure);
        $key = md5((string)$res . $time . json_encode($res->getStaticVariables()) . json_encode($args));
        $cache = self::CaCheInstance();
        if(!($val = $cache->get($key, false))){
            $val = call_user_func($closure, ...$args);
            $cache->put($key, $val, $time);
        }
        return $val;
    }


}