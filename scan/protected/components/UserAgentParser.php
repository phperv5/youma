<?php
class UserAgentParser
{
    private $os;       // 手机系统

    private $brand;    // 品牌

    private $client;   // 客户端类型 todo: 缺少默认类型

    public function __construct($userAgent)
    {
        $this->parse($userAgent);
    }

    /**
     * 解析userAgent
     * @return void
     */
    public function parse($userAgent)
    {
        // 判断os类型
        $iosKeywords = ['Mac OS', 'iPhone', 'iPad'];
        $androidKeywords = ['Android', 'Linux'];
        $desktopKeywords = ['Windows NT', 'Macintosh'];

        if (self::has_substr($userAgent, $iosKeywords)) {
            $this->os = 'ios';
        }
        if (self::has_substr($userAgent, $androidKeywords)) {
            $this->os = 'android';
        }
        if (self::has_substr($userAgent, $desktopKeywords)) {
            $this->os = 'desktop';
        }

        // 判断手机品牌
        $huaweiKeywords = ['huawei'];
        $xiaomiKeywords = ['mi', 'mi 4c', 'mi 5','redmi'];

        if (self::has_substr($userAgent, $huaweiKeywords)) {
            $this->brand = 'huawei';
        } elseif (self::has_substr($userAgent, $xiaomiKeywords)) {
            $this->brand = 'xiaomi';
        }

        // 判断客户端类型
        if (self::has_substr($userAgent, 'micromessenger')) {
            $this->client = 'wechat';
        }

        if (self::has_substr($userAgent, 'weibo')) {
            $this->client = 'weibo';
        }

        //增加支付宝判断
        if (self::has_substr($userAgent, 'alipay')) {
            $this->client = 'alipay';
        }

        if(preg_match('/QQ\/([\d\.]+)/i', $userAgent)){
            $this->client ='qq';
        }
    }

    /**
     * 是否是桌面端
     * @return bool
     */
    public function isDesktop()
    {
        return $this->os == 'desktop' ? true : false;
    }

    /**
     * 获取系统类型 android, ios, pc, mac
     * @return string
     */
    public function getOS()
    {
        return $this->os;
    }

    /**
     * 获取手机品牌 huawei, xiaomi等
     * @return string
     */
    public function getBrand()
    {
        return $this->brand;
    }

    /**
     * 获取客户端类型 ucbrowser, qqbrowser, weibo, wechat等
     * @return string
     */
    public function getClient()
    {
        return $this->client;
    }

    public static function has_substr($str, $subs)
    {
        if (!is_array($subs)) {
            $subs = array($subs);
        }

        foreach ($subs as $sub) {
            if (stripos($str, $sub) !== false) {
                return true;
            }
        }

        return false;
    }
}
