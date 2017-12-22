<!DOCTYPE html>
<html>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <meta name="language" content="zh_CN">
  <meta name="description" content="<?php echo $model['app_title'] ?>" />
  <meta name="keywords" content="<?php echo $model['app_desc'] ?>" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0">
  <meta content="email=no" name="format-detection">
  <meta name="apple-mobile-web-app-capable" content="yes">
  <meta name="apple-mobile-web-app-status-bar-style" content="black">
  <meta name="format-detection" content="telephone=no">
  <link rel="shortcut icon" type="image/x-icon" href="<?php echo Yii::app()->request->baseUrl; ?>/static/scan/images/favicon.ico?v=20170320">
  <title><?php echo $model['app_title'] ?></title>
</head>

<body>
  <input type="hidden" name="packname" id="packname" value="<?php echo $model['packname'] ?>" />
  <input type="hidden" name="xiaomi_url" id="xiaomi_url" value="<?php echo $model['xiaomi_url'] ?>" />
  <input type="hidden" name="huawei_url" id="huawei_url" value="<?php echo $model['huawei_url'] ?>" />
  <input type="hidden" name="oppo_url" id="oppo_url" value="<?php echo $model['oppo_url'] ?>" />
  <input type="hidden" name="xiaomi_status" id="xiaomi_status" value="<?php echo $model['xiaomi_status'] ?>" />
  <input type="hidden" name="huawei_status" id="huawei_status" value="<?php echo $model['huawei_status'] ?>" />
  <input type="hidden" name="oppo_status" id="oppo_status" value="<?php echo $model['oppo_status'] ?>" />
  <input type="hidden" name="android_url" id="android_url" value="<?php echo $model['android_url'] ?>" />
  <input type="hidden" name="ios_url" id="ios_url" value="<?php echo $model['ios_url'] ?>" />
  <script src="/static/scan/js/appMarket.js?v=10" type="text/javascript" charset="utf-8"></script>
</body>
</html>