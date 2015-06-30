<div id="txdata">
	<div id="tx_time">
		取引時間: <?php echo $TxData['time']; ?>
	</div>
	<div id="tx_confirm">
		承認確認数: <?php echo $TxData['confirmations']; ?>
	</div>
	<div id="tx_content" class="panel panel-default">
		<div id="tx_in">
		<div class="panel panel-default">
		<?php if(isset($TxData['vin'][0]['addr'])): ?>
			<?php foreach ($TxData['vin'] as $TxDataIn['vin']): ?>
				<?php echo $TxDataIn['vin']['addr']; ?>
				<?php echo $TxDataIn['vin']['value']; ?>
				<br>
			<?php endforeach ?>
		<?php else: ?>
		採掘報酬
		<?php endif; ?>
		</div>
		<div id="tx_out">
		<div class="panel panel-default">
		<?php foreach ($TxData['vout'] as $TxDataOut['vout']): ?>
			<?php foreach ($TxDataOut['vout']['scriptPubKey']['addresses'] as $TxDataOutAd['vout']['scriptPubKey']['addresses']): ?>
				<?php echo $TxDataOutAd['vout']['scriptPubKey']['addresses']; ?>
			<?php endforeach ?>
			<?php echo $TxDataOut['vout']['value']; ?>
			<br>
		<?php endforeach ?>
		</div>
	</div>
</div>