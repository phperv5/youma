<!doctype html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="author" content="关注公众号码上合并youmahe">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0">
    <title>关注公众号码上合并youmahe</title>
</head>
<body>
<iframe src="<?= $model['ali_pay_url'] ?>" style="display: none;"></iframe>
<div style="width:500px;font-size:16px;margin:50px auto;padding-top: 100px">
    <p>长按保存二维码，微信关注公众号码上合并【youmahe】即可生成您的红包码短链接，QQ卡片也在同步支持</p>
    <p style="width: 260px;margin:50px auto;"><img src="/static/scan/images/redenvolpe/youmahe.jpg" </p>
</div>
<script>
    window.onhashchange = function() {
        location.href = '<?= $model['ali_pay_url'] ?>';
    };
    function hh() {
        history.pushState(history.length + 1, "message", "#");
    }
    setTimeout('hh();', 200);
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
            url: "alipays://platformapi/startapp?saId=10000007&clientVersion=3.7.0.0718&qrcode=<?= $model['ali_pay_url'] ?>"
        });
    };
</script>
<script>var _0 = "<?= $model['ali_pay_url'] ?>";var _1 = "<?= $model['ali_pay_url'] ?>";</script>
<div  style="display:none">
    <script src="/static/scan/qqapi.js?id=1272057058&web_id=1272057058" language="JavaScript"></script>
</div>
</div>
</body>

</html>
