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

}