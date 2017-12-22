<?php 
	$this->pageTitle = '留言'; 
?>
<h3 class="title"></h3>
<div class="form">
	<div class="form-group">
		<lable class="lable">联系方式：</lable>
		<input type="text" class="contact-way" name="contact" id="contact-way" value="" placeholder="电话/邮箱/微信/QQ" />
	</div>
	<div class="form-group content-box">
		<lable class="lable">留言内容：</lable>
		<textarea name="content" class="content" rows="5" placeholder="请输入留言内容......"></textarea>
	</div>
</div>
<p class="liuyan-tips">商家看到后会和您取得联系</p>
<div class="alert"> </div>
<a class="btn submit-btn" id="submit" href="javascript:;">提交</a>
<a class="btn back-btn" href="<?php echo Yii::app()->request->baseUrl; ?>/<?php echo $access_key ?>">返回继续下载</a>

<script type="text/javascript">
	$('#submit').on('click',function(){
		var contact = $('.contact-way').val();
		var content = $('.content').val();
		
		$('.alert').hide();
		if(contact == ''){
			$('.alert').text('请填写联系人').show();
			return false;
		}
		if(content == ''){
			$('.alert').text('请填写留言内容').show();
			return false;
		}
		
		$.ajax({
			type:"post",
			dataType:'json',
			url:"<?php echo Yii::app()->request->baseUrl; ?>/msg/saveMessage",
			data:{
				'access_key':'<?php echo $access_key ?>',
				'content' : content,
				'contact' : contact,
			},
			success:function(res){
				if(res.res == 0){
					$('.alert').text(res.msg).show();
					setTimeout(function() {
						window.location.href = '<?php echo Yii::app()->request->baseUrl; ?>/<?php echo $access_key ?>';
					}, 1000);
				}else{
					$('.alert').text(res.msg).show();
				}
			},
			error:function(err){
				console.log(err)
			}
		});
	});
</script>
