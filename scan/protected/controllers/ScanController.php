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
        $model['duration'] = isset($model['duration']) ? $model['duration'] : 5;
        $model['prev_duration'] = $model['duration'] - 1;

        $userAgent = isset($_SERVER["HTTP_USER_AGENT"]) ? $_SERVER["HTTP_USER_AGENT"] : "";
        $userAgentParser = new UserAgentParser($userAgent);
        $client = $userAgentParser->getClient();   // 客户端类型
        $os = $userAgentParser->getOS();

        if ($client == 'wechat' && @!empty($model['wechat_image_url'])) {
            $model['wechat_image_url'] = $this->env('IMAGE_HOST_URL') . $model['wechat_image_url'];
            $model['os'] = $os == 'ios' ? true : false;
            return $this->renderPartial('wechat', compact('model'));
        } elseif ($client == 'alipay') {
//            if (LogicUtil::redEnvelopesateCompare() && @!empty($model['shang_ali_pay_url'])) {
//                return $this->renderPartial('alipay', compact('model'));
//            }
            return $this->redirect($model['ali_pay_url']);
        } elseif ($client == 'qq' && @!empty($model['qq_pay_url'])) {
            //return $this->renderPartial('qq', compact('model'));
            return $this->redirect($model['qq_pay_url']);
        }
        return $this->renderPartial('msg', ['msg' => '不支持该类支付']);  //其它
    }

}