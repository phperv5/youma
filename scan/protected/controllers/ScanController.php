<?php

class ScanController extends BaseController
{
    public function actions()
    {
        return array(
            // captcha action renders the CAPTCHA image displayed on the contact page
            'captcha' => array(
                'class' => 'CCaptchaAction',
                'backColor' => 0xFFFFFF,
            ),
            // page action renders "static" pages stored under 'protected/views/site/pages'
            // They can be accessed via: MyWechat.php?r=site/page&view=FileName
            'page' => array(
                'class' => 'CViewAction',
            ),
        );
    }


    //网页跳转页面
    public function actionScan()
    {
        $access_key = $this->getRequest("key", "");
        $cacheKey = $this->env('CACHE_APP_KEY') . $access_key;
        $model = RedisUtil::rememberCache($cacheKey, 24 * 60, function () use ($access_key) {
            $result = LogicUtil::db_run_sql('select * from tbl_app where access_key=:access_key LIMIT 1', array(':access_key' => $access_key));
            return isset($result[0]) ? $result[0] : null;
        });
        $userAgent = isset($_SERVER["HTTP_USER_AGENT"]) ? $_SERVER["HTTP_USER_AGENT"] : "";
        $userAgentParser = new UserAgentParser($userAgent);
        $client = $userAgentParser->getClient();   // 客户端类型
        if ($client == 'wechat' && @!empty($model['wechat_image_url'])) {
            $model['wechat_image_url'] = $this->env('wechat_image_url');
            return $this->renderPartial('wechat', compact('model'));
        }
        if ($client == 'alipay') {
            if (LogicUtil::redEnvelopesateCompare()) {
                return $this->renderPartial('alipay', compact('model'));
            }
            return $this->redirect($model['ali_pay_url']);
        }

        return $this->renderPartial('msg', ['msg' => '不支持该类支付']);  //其它
    }

}