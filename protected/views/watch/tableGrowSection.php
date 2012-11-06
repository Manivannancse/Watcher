<form method="post" name="conditionForm" action="chart.php?r=watch/tableGrowSection">
	<div id="conditionDiv">
		<div>
			<span>select Table:</span>
			<select name="tableName">
				<?php 
				if ($tableName) {
					echo "<option value='{$tableName}'>{$tableName}</option>";
				}
				?>
				<?php 
				$watchList = Util::loadconfig('watchList');
				if ($watchList) {
					foreach ($watchList as $tname => $conf) {
						echo "<option value='{$tname}'>{$tname}</option>";
					}
				}
				?>
			</select>
		</div>
		<div>
			<span>start time:</span>
			<input type="text" name="startTime" value="<?=$startTime ? $startTime : ''?>">
		</div>
		<div>
			<span>end time:</span>
			<input type="text" name="endTime" value="<?=$endTime ? $endTime : ''?>">
		</div>
		<div>
			<span>Step:</span>
			<select name="step">
				<?php 
				if ($step) {
					echo "<option value='{$step}'>{$step}</option>";
				}
				?>
				<option value="9">9 mintues</option>
				<option value="15">15 mintues</option>
				<option value="30">30 mintues</option>
				<option value="45">45 mintues</option>
				<option value="60">60 mintues</option>
				<option value="120">2 hours</option>
				<option value="180">3 hours</option>
				<option value="240">4 hours</option>
				<option value="300">5 hours</option>
				<option value="360">6 hours</option>
				<option value="420">7 hours</option>
				<option value="480">8 hours</option>
				<option value="540">9 hours</option>
				<option value="600">10 hours</option>
				<option value="660">11 hours</option>
				<option value="720">half day</option>
				<option value="1440">1 day</option>
			</select>
		</div>
		<div>
			<input type="submit" value="watch table grow...">
		</div>
	</div>
</form>
<?php 
	if ($dataVal) {
		$pc->draw(800,500);
	}
?>