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
    <script type="text/javascript">
        window.location.href = "<?php echo($url) ?>";
    </script>
</body>
</html>