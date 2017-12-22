window.onload = function(){
	var phoneModel = getPhoneModel();
	var packname = el('packname').value;
	switch(phoneModel)
	{
	case 'xiaomi' :
		if(el('xiaomi_status').value == '1'){
			openMarket("market://details?id="+packname+"&back=true&&startDownload=true", el('xiaomi_url').value)
		}else{
			window.location.href = el('android_url').value;
		}
	  	break;
	case 'huawei' :
		if(el('huawei_status').value == '1'){
			openMarket("appmarket://details?id="+packname, el('huawei_url').value);
		}else{
			window.location.href = el('android_url').value;
		}
	  	break;
	case 'oppo' :
		if(el('oppo_status').value == '1'){
			openMarket("softmarket://market_appdetail?pn=com.oppo.market&out_package_name="+packname+"&out_start_download=true", el('oppo_url').value);
		}else{
			window.location.href = el('android_url').value;
		}
		break;
	default:
	  	window.location.href = el('android_url').value;
	}
}
// 匹配手机型号
function getPhoneModel(){
	var ua = window.navigator.userAgent.toLowerCase();
	// 小米
	if( ua.indexOf("xiaomi") != -1 || ua.indexOf("hm") !=-1 || ua.indexOf("redmi")!=-1  || ua.indexOf("mi") != -1 ){
		return 'xiaomi';
	}
	// 华为
	if( ua.indexOf("hw-") != -1 || ua.indexOf("huawei") != -1 || ua.indexOf("honor") != -1 || ua.indexOf("h60-") != -1 ){
		return 'huawei';
	}
	
	// oppo
	if( ua.indexOf("oppobrowser") != -1 || ua.indexOf("oppo") != -1 ){
		return 'oppo';
	}
}



function openMarket(market, src){
	var iframe = document.createElement('iframe')
    iframe.src = market;
    iframe.style.display = 'none';
	document.body.appendChild(iframe);
	setTimeout(function(){
		window.location.href = src;
	}, 500)
}

function el(id) {
    return document.getElementById(id);
}