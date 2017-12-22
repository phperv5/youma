<!DOCTYPE html>
<html>
<head lang="zh_CN">
    <title>错误提示</title>
    <meta http-equiv="X-UA-Compatible" content="chrome=1,IE=edge" />
    <meta name="description" content="芝麻二维码将苹果应用安卓应用合成一个下载二维码,二维码生成器,原好推二维码" />
    <meta name="keywords" content="app二维码,应用二维码,芝麻二维码,二维码合成,苹果安卓二维码,安卓苹果二维码整合,安卓苹果一个二维码,iOS安卓合成二维码,二维码合成,二维码合成工具,app二维码,应用短网址,二逼二维码,二维码,二维码应用下载,二维码营销,二维码图片,二维码制作,QR code,二维码是什么,二维码生成,二维码论坛,二维条码,微信二维码" />
    <link rel="shortcut icon" type="image/x-icon" href="/static/scan/images/favicon.ico?v=20170320">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0">
    <meta content="email=no" name="format-detection">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="format-detection" content="telephone=no">
	<link rel="stylesheet" type="text/css" href="/static/scan/css/error.css">
</head>
	<body>
		<div class="content">
			<div class="icon_touxiang">
				<img src="/static/scan/images/error/error_img.jpg" alt="">
			</div>
	<!--		<div class="icon_error"><img src="/static/scan/images/error/error_img.jpg" alt=""></div>-->
			<div class="errTips-box">
				<div class="icon_logo">
                    <?php
                    if(isset($msg) && $msg['type'] == 'domain'){
                        echo '';
                    }else{
                        echo '<img src="/static/scan/images/error/logo.png" alt="">';
                    };
                    ?>
				</div>
				<div class="err-text">
					<div>
                        <?php
                            if(isset($msg)){
                                echo $msg['msg'];
                            }else{
                                echo '该二维码内容已被作者删除或审核未通过';
                            };
                        ?>
                    </div>
				</div>
			</div>
			<div id="baidu-ad">
				<!--<a href="http://2bai.co/13194780" class="ad-link"><img class="ad-img" src="/static/scan/ad/ad_201703211515.jpg"/></a>-->
				<!--<script type="text/javascript">
				    /*20:2 创建于 2017/2/4*/
				    var cpro_id = "u2886313";
				</script>
				<script type="text/javascript" src="https://cpro.baidustatic.com/cpro/ui/cm.js"></script>-->
			</div>
		</div>
		<script src="/static/scan/js/baidu.js"></script>
	</body>
</html>