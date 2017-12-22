<!DOCTYPE html>
<html lang="zh">
<head>
	<meta charset="UTF-8" />
	<meta http-equiv="X-UA-Compatible" content="ie=edge" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0">
	<title><?php echo $model['app_title']; ?></title>
	<meta name="description" content="<?php echo strip_tags($model['app_desc']) ?>" />
    <meta name="keywords" content="<?php echo $model['app_title']; ?>" />
    <meta content="email=no" name="format-detection">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="format-detection" content="telephone=no">
	<link rel="stylesheet" type="text/css" href="/static/wechat/vip/css/css.css?v=20170915"/>
	<link rel="stylesheet" type="text/css" href="/static/wechat/vip/css/swiper-3.4.2.min.css"/>
</head>
<body>
	<div class="browser_warp" onclick="browserHide()">
		<div class="browser_bg"></div>
		<div class="open_browser_tips">
                <img src="/static/wechat/vip/images/ios_browser_tips.png?v=2017052201"/>
		</div>
	</div>
	<div class="head ios_head">
    <!--    头部背景    -->
        <?php if(isset($model['is_customize_domain']) && !empty($model['is_customize_domain'])) { ?>
            <img class="head_bg" src="/static/wechat/vip/images/domain_ios_head.png"/>
        <?php }else { ?>
            <img class="head_bg" src="/static/wechat/vip/images/ios_head.png"/>
        <?php } ?>
    <!--  头部logo  -->
        <?php
        $preg = '/.*?(itunes\.apple\.com.*)/i';
        if (preg_match($preg, $model['ios_url'])){ ?>
            <img class="logo radius" src="<?php echo $model['app_img'];?>?v=2017052201" />
        <?php }else{ ?>
            <img class="logo" src="<?php echo $model['app_img'];?>?v=2017052201" />
        <?php } ?>
    </div>
	<div id="app">
		<div class="main_bg">
			<div class="main">
				<div class="logo_box">
					<?php 
						$preg = '/.*?(itunes\.apple\.com.*)/i';
	        			if (preg_match($preg, $model['ios_url'])){ ?>
						<img class="logo radius" width="80" src="<?php echo $model['app_img'];?>" />
					<?php }else{ ?>
						<img class="logo"  width="80" src="<?php echo $model['app_img'];?>" />
					<?php } ?>	
					<p class="app_name"><?php echo $model['app_title']; ?></p>
				</div>
				<div class="level_warp">
					<div class="star_warp">
						<span class="star"><img src="/static/wechat/vip/images/star.png"/></span>
						<span class="star"><img src="/static/wechat/vip/images/star.png"/></span>
						<span class="star"><img src="/static/wechat/vip/images/star.png"/></span>
						<span class="star"><img src="/static/wechat/vip/images/star.png"/></span>
	                     <?php if($model['isVip']){ ?>
	                         <span class="hollow"><img src="/static/wechat/vip/images/star.png"/></span>
	                     <?php }else{?>
	                         <span class="star"><img src="/static/wechat/vip/images/star_0.png"/></span>
	                     <?php } ?>
					</div>
				</div>
				<!--截图-->
				<div class="screenshot">
					<div class="swiper-container">
					    <div class="swiper-wrapper">
	                        <?php
	                        if(!empty($snapshots)){
	                            foreach ($snapshots as $v){ ?>
	                            	<div class="swiper-slide">
	                            		<img src="<?php echo $v['url']; ?>?v=2017052201"/>
	                            	</div>
	                        <?php }} ?>
					    </div>
					    <!-- 如果需要滚动条 -->
					    <div class="swiper-scrollbar"></div>
					</div>
				</div>
				<?php if(!empty($model['app_detail'])){?>
				<div class="app-info">
					<div class="app_detail" id="app-detail">
                        <div class="desc">
                            <?php echo $model['app_detail'] ?>
                        </div>
                    </div>
					<div class="more-link-box">
						<a href="javascript:;" class="more_info showMore" onclick="showMore()">更多</a>
						<a href="javascript:;" class="more_info hideMore" onclick="hideMore()" style="display: none;">收起</a>
					</div>
				</div>
				<?php }?>
                <?php if(isset($model['is_customize_domain']) && !empty($model['is_customize_domain'])) { ?>
                    <a href="javascript:;" class="download domain-download" onclick="browserShow()"><img src="/static/wechat/major/images/ios_icon.png?v=2017052201" class="ios_icon" /><span class="text">立即下载</span></a>
                <?php }else{ ?>
                    <a href="javascript:;" class="download" onclick="browserShow()"><img src="/static/wechat/vip/images/ios_icon.png?v=2017052201" class="ios_icon" /><span class="text">立即下载</span></a>
                <?php }?>
                <div class="func_box">
					<ul>
						<li class="zan">
							<span <?php if($type!='preview'){ ?>onclick="tapLike()" <?php }?>>
								<img class="icon" src="/static/wechat/vip/images/zan.png?v=2017052201"/>
								<span class="text" id="like_num">赞（<?php echo $model['like_num']; ?>）</span>
							</span>
						</li>
						<li class="comment">
							<a <?php if($type!='preview'){ ?> href="<?php echo Yii::app()->request->baseUrl; ?>/msg/message/?access_key=<?php echo $model['access_key']; ?>"<?php }?>>
								<img class="icon" src="/static/wechat/vip/images/msg.png?v=2017052201"/> 
								<span class="text">评论</span>
							</a>
						</li>
					</ul>
				</div>
			</div>
		</div>
	</div>
	<div class="bottom">
        <?php if(!isset($model['is_customize_domain']) || empty($model['is_customize_domain'])) { ?>
            <?php if(!$model['isVip']){?> <a class="powered"  href="https://www.hotapp.cn/?src=weixin">Powered By  芝麻二维码  HotApp.cn  </a> <?php }?> 
            <?php if($type!='preview'){ ?> 
                <a class="complaint" href="<?php echo Yii::app()->request->baseUrl; ?>/msg/complain/?access_key=<?php echo $model['access_key']; ?>">投诉应用</a>
            <?php }?>
        <?php }?>
	</div>
	<input id="app_title" type="hidden" name="app_title" value="<?php echo $model['app_title']; ?>" />
    <textarea id="app_desc" type="hidden" hidden="hidden" name="app_desc" value=""><?php echo $model['app_desc']; ?></textarea>
	<textarea id="app_detail" type="hidden" hidden="hidden" name="app_detail" value=""><?php echo $model['app_detail']; ?></textarea>
    <input id="app_link" type="hidden" name="app_link" value="<?php echo $model['app_link']; ?>" />
    <input id="app_imgUrl" type="hidden" name="app_imgUrl" value="<?php echo $model['app_img']; ?>" />
	<input id="access_key" type="hidden" name="access_key" value="<?php echo $model['access_key']; ?>" />
    <input id="baseUrl" type="hidden" name="baseUrl" value="<?php echo Yii::app()->request->baseUrl; ?>" />
    <!--高速下载-->
    <input type="hidden" name="appstore" id="appstore" value="<?php if(isset($model['direct_download_url'])) {echo $model['direct_download_url'];}  ?>" />
    <input type="hidden" name="andorid_download_url" id="andorid_download_url" value="<?php if(isset($model['andorid_download_url'])) {echo $model['andorid_download_url'];}  ?>" />
    <!--微信-->
    <input type="hidden" name="appId" id="appId" value="<?php echo $signPackage['appId'] ?>" />
    <input type="hidden" name="timestamp" id="timestamp" value="<?php echo $signPackage['timestamp'] ?>" />
    <input type="hidden" name="nonceStr" id="nonceStr" value="<?php echo $signPackage['nonceStr'] ?>" />
    <input type="hidden" name="signature" id="signature" value="<?php echo $signPackage['signature'] ?>" />
    <!--js-->
	<script src="/static/wechat/major/js/jquery/jquery.min.js" type="text/javascript" charset="utf-8"></script>
	<script src="/static/wechat/vip/js/swiper-3.4.2.jquery.min.js"></script>
	<script src="/static/scan/js/scan.js?v=20170915"></script>
	<script src="/static/wechat/vip/js/index.js?v=20170915" type="text/javascript" charset="utf-8"></script>
</body>
</html>
