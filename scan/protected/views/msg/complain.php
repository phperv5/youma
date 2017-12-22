<?php
$this->pageTitle = '投诉应用';
?>
<h3 class="title">投诉</h3>
<div class="form">
	<div class="form-group content-box">
		<lable class="lable">投诉描述：</lable>
		<textarea name="content" class="content" rows="5" placeholder="请输入投诉的描述......"></textarea>
	</div>
</div>
<div class="alert"> </div>
<a class="btn submit-btn" id="submit" href="javascript:;">提交</a>
<a class="btn back-btn" href="<?php echo Yii::app()->request->baseUrl; ?>/<?php echo $access_key ?>">返回继续下载</a>
<script type="text/javascript">
	$('#submit').on('click',function(){
		var content = $('.content').val();
		
		$('.alert').hide();
		if(content == ''){
			$('.alert').text('请输入投诉的描述').show();
			return false;
		}
		
		$.ajax({
			type:"post",
			dataType:'json',
			url:"<?php echo Yii::app()->request->baseUrl; ?>/msg/saveComplain",
			data:{
				'access_key':'<?php echo $access_key ?>',
				'content' : content,
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