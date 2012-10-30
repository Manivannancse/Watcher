<form method="post" name="conditionForm" action="index.php?r=watch/tableGrow">
	<div id="conditionDiv">
		<div>
			<span>select Table:</span>
			<select name="tableName">
				<?php 
				$watchList = Util::loadconfig('watchList');
				if ($watchList) {
					foreach ($watchList as $tableName => $conf) {
						echo "<option value='{$tableName}'>{$tableName}</option>";
					}
				}
				?>
			</select>
		</div>
		<div>
			<span>start time:</span>
			<input type="text" name="startTime">
		</div>
		<div>
			<span>end time:</span>
			<input type="text" name="endTime">
		</div>
		<div>
			<input type="submit" value="watch table grow...">
		</div>
	</div>
</form>
<?php 
	$pc->draw();
?>