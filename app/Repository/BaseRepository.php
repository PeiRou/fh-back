<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/11/12
 * Time: 12:14
 */

namespace App\Repository;

use Illuminate\Container\Container;

class BaseRepository
{
    use \Illuminate\Routing\RouteDependencyResolverTrait;

    public function  __construct(Container $container)
    {
        $this->container = $container;
    }

    public static function __callStatic ($name, $arguments)
    {
        if(method_exists(static::class, $name)){
            $instance = app(static::class);
            $arguments = $instance->resolveClassMethodDependencies($arguments, $instance, $name);//dependencies参数
            return call_user_func([$instance,$name], ...$arguments);//处理返回数据
        }
    }

}