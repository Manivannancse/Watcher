<h3>Record of more than 1000000</h3>
<table border="1" bgcolor="pink" width="1050" align="center">
<tr>
<?php 
if($millionTable){
	foreach($millionTable as $id => $tableArr){
	?>
		<tr>
		<th>tableName</th>
		<th>totalRecord</th>
		<th>maxID</th>
		<th>lastUpdateTime</th>
		</tr>
		<tr>
		<td><?=$tableArr['tableName'] ?></td>
		<td><?=$tableArr['total'] ?></td>
		<td><?=$tableArr['maxID'] ?></td>
		<td><?=$tableArr['sectionTime'] ?></td>
		</tr>
		<?php
	}
}else{
	echo "No Record!";
}
?>



