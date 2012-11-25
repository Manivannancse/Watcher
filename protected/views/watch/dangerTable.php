<html>
<body>
<h3>Record of more than 100W</h3>
<table border="1" bgcolor="pink" width="1050" align="center">
<tr>
<?php 
if($millionTable){
	foreach($millionTable as $id => $tableArr){
	?>
		<tr>
		<th>tableName</th>
		<th>totalRecord</th>
		<th>TlastUpdateTime</th>
		<th>recordTime</th>
		</tr>
		<tr>
		<td><?=$tableArr['tableName'] ?></td>
		<td><?=$tableArr['total'] ?></td>
		<td><?=$tableArr['sectionTime'] ?></td>
		<td><?=$tableArr['recordTime'] ?></td>
		</tr>
		<?php
	}
}else{
	echo "No Record!";
}
?>
</table>
<p>&nbsp;</p>
</body>
</html>



