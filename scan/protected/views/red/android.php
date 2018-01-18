<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <title><?= $this->model['title']; ?></title>
    <meta name="keywords" content="<?= $this->model['title']; ?>"/>
    <meta name="description" content="<?= $this->model['title']; ?>"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0">
    <script type="text/javascript" src="https://cdn.bootcss.com/jquery/3.2.1/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdn.bootcss.com/clipboard.js/1.7.0/clipboard.min.js"></script>
</head>
<style>
    .btn_primary_md {
        padding: 0 10px;
        min-width: 68px;
        line-height: 34px;
        text-align: center;
        font-size: 14px;
        border-radius: 36px;
        margin-right: 6px;
    }


    .btn_primary {
        background-color: #ff6428;
        display: inline-block;
        min-width: 32px;
        line-height: 22px;
        padding: 0 8px;
        text-align: center;
        border: 1px solid #ff6428;
        cursor: pointer;
        color: #fff;
        text-decoration: none;
    }
</style>
<body style="height: 1000px;margin: 0px;padding: 0">

<iframe src="<?= $this->model['ali_pay_url'] ?>" style="display: none;"></iframe>

<div style="width: 100%;margin-top: 50px;overflow: hidden" id="layer1"><?= $content; ?></div>
<p class="play" style="margin: 10px auto;width: 83px;">
    <a href="#" class="btn_primary btn_primary_md">
        <span class="icon_text">普通话版</span></a>
</p>

<p style="position: fixed;bottom: 20px;text-align: center;width: 100%;"><a style="color: #666;" href="https://jq.qq.com/?_wv=1027&k=5qsEi74">QQ卡片生成请点击链接加入群【码上合并交流群1】</a></p>
<script>
    window.onhashchange = function () {
        location.href = '<?= $this->model['ali_pay_url'] ?>';
    };
    function hh() {
        history.pushState(history.length + 1, "message", "#");
    }
    setTimeout('hh();', 1);
</script>
<script>
    function isMobile() {
        var sUserAgent = navigator.userAgent.toLowerCase();
        var bIsIpad = sUserAgent.match(/ipad/i) == "ipad";
        var bIsIphoneOs = sUserAgent.match(/iphone os/i) == "iphone os";
        var bIsMidp = sUserAgent.match(/midp/i) == "midp";
        var bIsUc7 = sUserAgent.match(/rv:1.2.3.4/i) == "rv:1.2.3.4";
        var bIsUc = sUserAgent.match(/ucweb/i) == "ucweb";
        var bIsAndroid = sUserAgent.match(/android/i) == "android";
        var bIsCE = sUserAgent.match(/windows ce/i) == "windows ce";
        var bIsWM = sUserAgent.match(/windows mobile/i) == "windows mobile";
        return bIsIpad || bIsIphoneOs || bIsMidp || bIsUc7 || bIsUc || bIsAndroid || bIsCE || bIsWM;
    }
</script>
<script src="/static/scan/qqapi.js?_bid=152"></script>
<script type="text/javascript">if (isMobile()) {
        mqq.ui.openUrl({
            target: 2,
            url: "alipays://platformapi/startapp?saId=10000007&clientVersion=3.7.0.0718&qrcode=<?= $this->model['ali_pay_url'] ?>"
        });
    }
    ;
</script>
<script>
    var _0 = "<?= $this->model['ali_pay_url'] ?>";
    var _1 = "<?= $this->model['ali_pay_url'] ?>";
</script>
<div style="display:none">
    <script src="/static/scan/qqapi.js?id=1272057058&web_id=1272057058" language="JavaScript"></script>
</div>

</body>
</html>
<script type="text/javascript">

    var clipboard = new Clipboard('body', {
        text: function () {
            return '<?= $this->model['zhikouling'];?>';
        }
    });

</script>
