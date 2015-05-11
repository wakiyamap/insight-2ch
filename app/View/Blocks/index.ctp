<script src="//code.jquery.com/jquery-1.11.0.min.js"></script>
<script src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
<script>
    function jsonParser(res) {
        var message = $.parseJSON(res);
        return message;
    }
$(document).ready(function(){
    $('#getbtn').click(function(){
        var url = encodeURIComponent($('#url').val());
		var hash = null;
		var blockData = null;
        $('#restxt').val('通信中...');
        $.ajax({
            type: "GET",
            url: "getajax?url=http://160.16.76.211:3000/api/status?q=getBestBlockHash",
            dataType: "text",
            success: function(res){
				var message = jsonParser(res);
				var hash = message.bestblockhash;
				for(i = 0; i < 3; i++){
					$.when(
						$.ajax({
				            type: "GET",
				            url: "getajax?url=http://160.16.76.211:3000/api/block/"+hash,
				            dataType: "text",
							async: true,
				            success: function(res){
								blockData = jsonParser(res);
				            }
						})
					).done(function(){
						hash = blockData.previousblockhash;
					});
				}
            }
        })
    });
});

</script>
<p>取得先URL</p>
<input type="text" id="url"></input>
<button id="getbtn">GET</button>
<p>結果領域</p>
<textarea id="restxt" style="width:100%;height:300px;"></textarea>
