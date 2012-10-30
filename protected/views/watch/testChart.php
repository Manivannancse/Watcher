<div>
	<div id="watcherDiv" class="watcher">Watcher:<?=$watcher->getName()?></div>
	<div id="tools" style="display:none"></div>
	<div id="chart" style="position:absolute;top:80px;left:350px">
		<?php 
			$pc->draw();
		?>
	</div>
</div>

<script>
$("#tools").html("adf");
$("#tools").show();
</script>