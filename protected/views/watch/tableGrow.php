<form method="post" name="conditionForm" action="index.php?r=watch/tableGrow">
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
			<input type="submit" value="watch table grow...">
		</div>
	</div>
</form>
<?php 
	if ($dataVal) {
		$pc->draw(800,500);
	}
?>