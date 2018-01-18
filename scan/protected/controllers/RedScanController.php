<?php

class RedScanController extends BaseController
{
    public $layout = '//red/android';

    public $model = null;

    //网页跳转页面
    public function actionScan()
    {
        $access_key = $this->getRequest("key", "");
        $cacheKey = $this->env('CACHE_APP_KEY') . $access_key;
        $model = RedisUtil::rememberCache($cacheKey, 24 * 60, function () use ($access_key) {
            $result = LogicUtil::db_run_sql('select * from tbl_red_envelope where access_key=:access_key LIMIT 1', array(':access_key' => $access_key));
            return isset($result[0]) ? $result[0] : null;
        });
        $userAgent = isset($_SERVER["HTTP_USER_AGENT"]) ? $_SERVER["HTTP_USER_AGENT"] : "";
        $userAgentParser = new UserAgentParser($userAgent);
        $client = $userAgentParser->getClient();   // 客户端类型
        $os = $userAgentParser->getOS();   // 客户端类型

        $model['ali_pay_url'] = isset($model['alipay_short_url']) ? $model['alipay_short_url'] : $model['ali_pay_url'];

        $model['zhikouling'] = isset($model['zhikouling']) ? $model['zhikouling'] : '';

        $template = isset($model['template']) ? $model['template'] : '01';

        $model['title'] = $this->getTitle($template);

        $view = '/red/template/' . $template;

        $this->model = $model;
        return $this->render($view);

    }

    public function getTitle($template_id)
    {
        switch ($template_id) {
            case 01:
                $title = '前任3：再见前任';
                break;
            case 02:
                $title = '小猪佩奇';
                break;
            default:
                $title = '关注公众号码上合并youmahe';
        }
        return $title;
    }

}