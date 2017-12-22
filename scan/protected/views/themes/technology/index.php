<!DOCTYPE html>
<html>
<head>
    <title><?php echo $model['app_title'] ?></title>
    <meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="chrome=1,IE=edge" />
    <meta name="keywords" content="<?php echo $model['app_title'] ?>">
    <meta name="description" content="<?php echo $model['app_title'] ?>">
    <link rel="shortcut icon" type="image/x-icon" href="/static/scan/images/favicon.ico?v=20170320">
    <link rel="stylesheet" type="text/css" href="/static/themes/technology/css/style.css?v=2017051001">
</head>
<body>
	<?php if($model['check_status'] == $model['newQrCode']) { ?>
	<div class="app-top" style="text-align: center;height: 30px;line-height: 30px;background: #fff;font-size: 12px;color: #f00;">
		<?php  if(isset($model['leftTimes'])) echo '试用，剩余扫描次数：'.$model['leftTimes']; ?>
	</div>
	<?php } ?>
	<div id="main">
		<div class="banner" id="banner">
			<img class="bd_img" src="/static/themes/technology/images/banner.jpg"/>
			<div class="phone_warp" id="phone">
				<div class="phone_box">
					<img src="/static/themes/technology/images/phone_bg.png"/>
					<div class="app_logo_box">
						<div class="content">
							<img class="app_logo" src="<?php echo $model['app_img']; ?>"/>
							<div class="app_name">
								<?php
									$content = strip_tags($model['app_title']);
									$pattern = "/&[a-zA-Z]+;/";
									$content = preg_replace($pattern,'', $content);
									$content = mb_strimwidth($content, 0, 26, '...','UTF-8'); 
									echo  $content;
								?>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="app_item" id="item">
				<div class="app_name" id="app-name">
					<?php echo $model['app_title']; ?>
				</div>
				<div class="android" id="android">
					<a href="javascript:;" onclick="download_android()">Android</a>
				</div>
				<div class="ios" id="ios">
					<a href="javascript:;" onclick="download_ios()">iPhone</a>
				</div>
				<div class="app_qrcode" id="app-qrcode">
					<img src="<?php echo $model['qr_img_file']; ?>"/>
					<div class="install_tips">
						扫一扫下载安装
					</div>
				</div>
			</div>
		</div>
		<div class="content" id="content">
			<div class="score-warp">
				<div class="lable">应用评分</div>
				<div class="score-box">
					<span class="real_star star"></span>
					<span class="real_star star"></span>
					<span class="real_star star"></span>
					<span class="real_star star"></span>
					<span class="<?php if($model['isVip']){ echo 'real_star';}else{ echo 'empty_star';}?> star"></span>
				</div>
			</div>
			<div class="app_details">
				<h3 class="lable">应用信息</h3>
				<div class="text">
                    <?php echo $model['app_detail'];?>
				</div>
			</div>
		</div>
		<?php if(!$model['isVip']) { ?>
		<!--底部-->
		<div id="footer">
			<div class="line"></div>
			<div class="link">
				<a target="_blank" href="http://www.hotapp.cn/app">该页面由芝麻二维码APP官网工具一键生成 </a>
			</div>
		</div>
		<?php } ?>
	</div>
	<input type="hidden" name="origin_ios_url" id="origin_ios_url" value="<?php echo $model['origin_ios_url']; ?>" />
	<input type="hidden" name="ios_url" id="ios_url" value="<?php echo $model['ios_url']; ?>" />
	<input type="hidden" name="origin_android_url" id="origin_android_url" value="<?php echo $model['origin_android_url']; ?>" />
	<input type="hidden" name="android_url" id="android_url" value="<?php echo $model['android_url']; ?>" />
	<script type="text/javascript">
		function download_ios(){
			var origin_ios_url = document.getElementById('origin_ios_url').value;
			var ios_url = document.getElementById('ios_url').value;
			
			if(origin_ios_url){
				window.open(ios_url);
			}else{
				alert('该应用暂不支持苹果应用下载，请用安卓手机访问');
			}
		}
		function download_android(){
			var origin_android_url = document.getElementById('origin_android_url').value;
			var android_url = document.getElementById('android_url').value;
			
			if(origin_android_url){
				window.open(android_url);
			}else{
				alert('该应用暂不支持安卓应用下载，请用苹果手机访问');
			}
		}
	</script>
    <!-- //接入百度统计-->
    <script type="text/javascript">
    	var _hmt = _hmt || [];
		(function() {
		    var hm = document.createElement("script");
		    hm.src = "//hm.baidu.com/hm.js?3d3e8edb7bcc47a5be2981b6a877ca99";
		    var s = document.getElementsByTagName("script")[0];
		    s.parentNode.insertBefore(hm, s);
		})();
    </script>
</body>
</html>