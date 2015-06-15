$(function(){
    setInterval(function(){
		$.getJSON("/blocks/getblockdetaildata/"+ hash, function(Data){
				$('<a href="/blocks/detail/'+Data.nextblockhash+'">次のブロック</a>').appendTo('#block_next_hash');
			$('<a href="/blocks/detail/'+Data.previousblockhash+'">前のブロック</a>').appendTo('#block_prev_hash');
		})
	},10000);
	$.getJSON("/blocks/getblockdetaildata/"+ hash, function(Data){
		$('<a href="/blocks/detail/'+Data.nextblockhash+'">次のブロック</a>').appendTo('#block_next_hash');
		$('<a href="/blocks/detail/'+Data.previousblockhash+'">前のブロック</a>').appendTo('#block_prev_hash');
	})
});
