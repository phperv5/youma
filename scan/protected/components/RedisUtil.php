<?php

/*
 * redis调用
 */

class RedisUtil
{
    //缓存时间单位
    const UNIT_NUM = 60;
    //默认两周
    const EXPIRE = 2 * 7 * 24 * 60;

    const SWOOLE_KEY = 'com.2bai.swoole_id';

    /*
     * param $key键值，$second,$func匿名方法；扩展缓存的存取，当$key对应的值存在时，取缓存的，没有，就调用回调函数的，并且存入缓存
     */
    public static function rememberCache($key, $expire = self::EXPIRE, $func)
    {
        $res = self::get($key);
        //存在返回数据
        if ($res) return $res;
        $data = call_user_func($func);
        if (empty($data)) return false;
        $flag = self::set($key, $data);
        return $flag ? $data : false;
    }

    /*
     * set数据
     */
    public static function set($key, $data, $expire = self::EXPIRE)
    {
        //如果是对象和数组,serialize
        if (is_array($data) || is_object($data)) {
            $data = serialize($data);
        }
        return Yii::app()->cache->setValue($key, $data, $expire * self::UNIT_NUM);
    }

    /*
     * get数据
     */
    public static function get($key)
    {
        $res = Yii::app()->cache->getValue($key);
        if (self::is_serialized($res)) {
            $res = unserialize($res);
        }
        return $res;
    }

    /*
     * 创建集合
     */
    public static function sadd($key, $data, $expire = self::EXPIRE)
    {
        $cache = Yii::app()->cache;
        $flag = !$cache->scard($key) ? true : false;
        $res = $cache->sadd($key, $data);
        if ($flag && !empty($res)) {
            $cache->expire($key, $expire * self::UNIT_NUM);
        }
    }

    public static function smembers($key, $member = null)
    {
        if (is_null($member)) {
            $res = Yii::app()->cache->smembers($key);
        } else {
            $res = Yii::app()->cache->sismember($key, $member);
        }
        return $res;
    }

    /*
     * 检查是否序列化
     */
    protected static function is_serialized($data)
    {
        $data = trim($data);
        if ('N;' == $data)
            return true;
        if (!preg_match('/^([adObis]):/', $data, $badions))
            return false;
        switch ($badions[1]) {
            case 'a' :
            case 'O' :
            case 's' :
                if (preg_match("/^{$badions[1]}:[0-9]+:.*[;}]\$/s", $data))
                    return true;
                break;
            case 'b' :
            case 'i' :
            case 'd' :
                if (preg_match("/^{$badions[1]}:[0-9.E-]+;\$/", $data))
                    return true;
                break;
        }
        return false;
    }
}

