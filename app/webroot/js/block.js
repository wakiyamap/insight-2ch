$(function(){
    setInterval(function(){
			$.getJSON("/blocks/getblockdata", function(Data){
				var removeBlock = Data[5].Block.height -6;
				if(document.getElementById('block'+Data[5].Block.height) != null){}else{
					$(Data).each(function(){
						if(document.getElementById('block'+this.Block.height) != null){
							return true;
						}else{
							$(
								'<div id="block'+this.Block.height+'">'+this.Block.time+'　'+
								'<a href="/blocks/detail/' + this.Block.height + '">' + this.Block.height + '</a>'+
								'　'+this.Block.tx_count+
								'　'+this.Block.size+
							'</div>').appendTo('#blockdata').remove('#block'+removeBlock);
						}
					})
				}
			})
		},10000);
		$.getJSON("/blocks/getblockdata", function(Data){
			$(Data).each(function(){
				$(
					'<div id="block'+this.Block.height+'">'+this.Block.time+'　'+
					'<a href="/blocks/detail/' + this.Block.height + '">' + this.Block.height + '</a>'+
					'　'+this.Block.tx_count+
					'　'+this.Block.size+
				'</div>').appendTo('#blockdata');
				})
		})
});
