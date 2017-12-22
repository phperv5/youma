<?php
/**
 * Created by PhpStorm.
 * User: tuomingyao
 * Date: 2017/4/7
 * Time: 20:06
 */
class Globals
{
    public static function env($key)
    {
        return Yii::app()->params[$key];
    }
}

