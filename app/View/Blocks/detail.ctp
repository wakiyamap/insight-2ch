<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
<script type="text/javascript">
var hash = "<?php echo $dbBlockData[0]['Block']['block_hash']; ?>";
</script>


<div id="blockdata">
	<div id="block_height">
		ブロック: <?php echo $dbBlockData[0]['Block']['height']; ?>
	</div>
	<div id="block_time">
		採掘日時: <?php echo $dbBlockData[0]['Block']['time']; ?>
	</div>
	<div id="block_difficulty">
		採掘難易度: <?php echo $dbBlockData[0]['Block']['difficulty']; ?>
	</div>
	<div id="block_tx_count">
		取引数: <?php echo $dbBlockData[0]['Block']['tx_count']-1; ?>
	</div>
	<div id="block_size">
		ブロックサイズ: <?php echo $dbBlockData[0]['Block']['size']; ?>
	</div>
	<div id="block_hash">
		ブロックハッシュ: <?php echo $dbBlockData[0]['Block']['block_hash']; ?>
	</div>
	<div id="block_next_hash">
	<?php if (!empty($nextBlockData)): ?>
		<a href="/blocks/detail/<?php echo $dbBlockData['0']['Block']['id']+1 ?>">次のブロック</a>
	<?php else: ?>
		最新のブロック
	<?php endif; ?>
	</div>
	<div id="block_prev_hash">
	<?php if (!empty($prevBlockData)): ?>
		<a href="/blocks/detail/<?php echo $dbBlockData['0']['Block']['id']-1 ?>">前のブロック</a>
	<?php else: ?>
		最古のブロック
	<?php endif; ?>
	</div>
</div>
