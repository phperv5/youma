<?php

class JSSDK
{
    private $appId;
    private $appSecret;
    const SIGN_PACKAGE_REOM_REDIS = 1;

    public function __construct($appId, $appSecret)
    {
        $this->appId = $appId;
        $this->appSecret = $appSecret;
    }

    public function getSignPackage()
    {
        if (self::SIGN_PACKAGE_REOM_REDIS) {
            $jsapiTicket = $this->getJsApiTicketFromRedis();
        } else {
            $jsapiTicket = $this->getJsApiTicketFromFile();
        }
        $url = UrlUtil::httpType()."$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
        $timestamp = time();
        $nonceStr = $this->createNonceStr();

        // 这里参数的顺序要按照 key 值 ASCII 码升序排序
        $string = "jsapi_ticket=$jsapiTicket&noncestr=$nonceStr&timestamp=$timestamp&url=$url";

        $signature = sha1($string);

        $signPackage = array(
            "appId" => $this->appId,
            "nonceStr" => $nonceStr,
            "timestamp" => $timestamp,
            "url" => $url,
            "signature" => $signature,
            "rawString" => $string
        );
        return $signPackage;
    }

    private function createNonceStr($length = 16)
    {
        $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
        $str = "";
        for ($i = 0; $i < $length; $i++) {
            $str .= substr($chars, mt_rand(0, strlen($chars) - 1), 1);
        }
        return $str;
    }

    private function getJsApiTicketFromFile()
    {
        // jsapi_ticket 应该全局存储与更新，以下代码以写入到文件中做示例
        if (file_exists('jsapi_ticket.json')) {
            $file_exist = true;
            $data = json_decode(file_get_contents("jsapi_ticket.json"));
        } else {
            $file_exist = false;
        }

        if (!$file_exist || $data->expire_time < time()) {
            $accessToken = $this->getAccessTokenFromFile();
            $url = "https://api.weixin.qq.com/cgi-bin/ticket/getticket?type=jsapi&access_token=$accessToken";
            $res = json_decode($this->httpGet($url));
            $ticket = $res->ticket;
            $data = $res;

            if ($ticket) {
                $data->expire_time = time() + 7000;
                $data->jsapi_ticket = $ticket;
                $fp = fopen("jsapi_ticket.json", "w");
                fwrite($fp, json_encode($data));
                fclose($fp);
            }
        } else {
            $ticket = $data->jsapi_ticket;
        }

        return $ticket;
    }

    private function getJsApiTicketFromRedis()
    {

        $ticket_redis_key = 'yii_jsapi_ticket_scan';
        if (Yii::app()->cache->exists($ticket_redis_key)) {
            $data = json_decode(Yii::app()->cache->get($ticket_redis_key));
        }
        // 生成新的ticket
        if (!isset($data) || $data->expire_time < time()) {
            $accessToken = $this->getAccessTokenFromRedis();
            $url = "https://api.weixin.qq.com/cgi-bin/ticket/getticket?type=jsapi&access_token=$accessToken";
            $res = json_decode($this->httpGet($url));
            $ticket = $res->ticket;
            $data = $res;
            if ($ticket) {
                $data->expire_time = time() + 7000;
                $data->jsapi_ticket = $ticket;
                Yii::app()->cache->set($ticket_redis_key, json_encode($data));
            }
        } else {
            $ticket = $data->jsapi_ticket;
        }
        return $ticket;
    }

    private function getAccessTokenFromFile()
    {
        if (file_exists('access_token.json')) {
            $file_exist = true;
            $data = json_decode(file_get_contents("access_token.json"));
        } else {
            $file_exist = false;
        }

        if (!$file_exist || $data->expire_time < time()) {
            $url = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=$this->appId&secret=$this->appSecret";
            $res = json_decode($this->httpGet($url));
            $access_token = $res->access_token;
            if ($access_token) {
                $res->expire_time = time() + 7000;
                $res->access_token = $access_token;
                $fp = fopen("access_token.json", "w");
                fwrite($fp, json_encode($res));
                fclose($fp);
            }
        } else {
            $access_token = $data->access_token;
        }
        return $access_token;
    }

    private function getAccessTokenFromRedis()
    {

        $access_token_redis_key = 'yii_access_token_scan';
        if (Yii::app()->cache->exists($access_token_redis_key)) {
            $data = json_decode(Yii::app()->cache->get($access_token_redis_key));
        }
        // 生成新的token
        if (!isset($data) || $data->expire_time < time()) {
            $url = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=$this->appId&secret=$this->appSecret";
            $res = json_decode($this->httpGet($url));
            $access_token = $res->access_token;
            if ($access_token) {
                $res->expire_time = time() + 7000;
                $res->access_token = $access_token;
                Yii::app()->cache->set($access_token_redis_key, json_encode($res));
            }
        } else {
            $access_token = $data->access_token;
        }
        return $access_token;
    }

    private function httpGet($url)
    {
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_TIMEOUT, 500);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        $res = curl_exec($curl);
        curl_close($curl);
        return $res;
    }
}