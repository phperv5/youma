<?php

/**
 * Created by PhpStorm.
 * User: jhwang
 * Date: 14-10-7
 * Time: 下午8:41
 */
class LogicUtil
{

    public static function db_run_sql($sql, $params = array(), $db = null)
    {
        $params_clean = array();
        if (empty($db)) {
            $db = Yii::app()->db;
        }

        foreach ($params as $key => $value) {
            if (strpos($sql, $key) > 0) {
                $params_clean[$key] = $value;
            }
        }

        $cmd = $db->createCommand($sql);

        return $cmd->queryAll(true, $params_clean);
    }

    public static function db_run_update($sql, $params = array(), $db = null)
    {
        if (empty($db)) {
            $db = Yii::app()->db;
        }

        $cmd = $db->createCommand($sql, $params);

        return $cmd->execute();
    }


    /*
    *时间比对
 * return true没有领过红包,false已领
 */
    public static function redEnvelopesateCompare()
    {
        $date = isset($_COOKIE['redEnvelopes']) ? $_COOKIE['redEnvelopes'] : '';
        $now_date = date('Y-m-d', time());
        echo $date;
        echo $now_date;
        return $date == $now_date ? false : true;
    }

}