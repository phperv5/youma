$(window).ready(function(){
	// ios高速下载
	var appstore = $('#appstore').val();
	if(appstore){
		window.location.href = appstore;
	}
	// andorid高速下载
	var andorid_download_url = $('#andorid_download_url').val();
	if(andorid_download_url){
		window.location.href = andorid_download_url;
	}
});

//打开分享
function fenxiangOpen(){
    $('.page-warp').show();
    $('.fenxiang-tips').show();
}
//关闭分享
function fenxiangHide(){
    $('.page-warp').hide();
    $('.fenxiang-tips').hide();
}

//点赞
function setLike(cb) {
    $.ajax({
        type: "POST",
        url: "/like/SetLikesAjax",
        dataType: "json",
        data: {
            'access_key' : $('#access_key').val()
        },
        success: function(data) {
        	if(cb && (typeof cb == 'function')){
        		cb(data)
        	}
        },
        error: function(err) {
            console.log(err);
        }
    });
};

//alertTip提示动画
function alertTip(msg){
	var odiv = "<div class='alert-tips' id='alert-tips'>" + msg + "</div>";
    $('body').append(odiv);
    setTimeout(function(){
            $('#alert-tips').remove();
    },1600)
}

// 百度统计
var _hmt = _hmt || [];
(function() {
    var hm = document.createElement("script");
    hm.src = "//hm.baidu.com/hm.js?3d3e8edb7bcc47a5be2981b6a877ca99";
    var s = document.getElementsByTagName("script")[0];
    s.parentNode.insertBefore(hm, s);
})();