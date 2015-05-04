<script type="text/javascript" src="/js/prototype.js"></script>
<script type="text/javascript">
window.onload = function() {
	Event.observe("sample","click",function() {
		new Ajax.Request(
			'http://160.16.76.211:3000/api/tx/af80db376f9eaba8020e973181df6434f52c4acdda990195e14d03a50ff4e194' , 
			{
				method:		"get" , 
				onSuccess: function (req) {
					var res;
					eval("res = "+ req.responseText );
					// res.result という値があればalertで表示
					if (res.result) { 
						alert(res.result);
					}
				} , 
				onFailure: function(req) { 
					alert('読み込みに失敗しました'); 
				}, 
				onException: function (req) { 
					alert('不正な値を取得しました。'); 
				} 
			}
		);
	});
}


</script>
<a href="javascript:void(0);" id="sample">sample</a>