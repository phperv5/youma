// 微信接口
// wx.config({!! $js->config(['onMenuShareTimeline', 'onMenuShareAppMessage', 'onMenuShareQQ'], false) !!});
wx.ready(function () {
    var app_title = $('#app_title').val();
    var app_desc = $('#app_desc').val();
    var app_link = $('#app_link').val();
    var app_imgUrl = $('#app_imgUrl').val();
    var access_key = $('#access_key').val();
    wx.onMenuShareAppMessage({
        title: app_title + " - 芝麻",
        desc: app_desc,
        link: app_link,
        imgUrl: app_imgUrl
    });
    
    wx.onMenuShareTimeline({
        title: app_title + " - 芝麻",
        link: app_link,
        imgUrl: app_imgUrl
    });
    wx.onMenuShareQQ({
        title: app_title + " - 芝麻",
        desc: app_desc,
        link: app_link,
        imgUrl: app_imgUrl
    });
});