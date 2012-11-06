<html>
<body>
<h3>Record of more than 100W order by Total DESC ~~</h3>
<table cellpadding="1" cellspacing="0"  border="1" bgcolor="#F3F3FA" width="1050" align="center">
<tr>
<?php 
$num = 0;
if($millionTable){
	?>
		<tr>
		<th bgcolor="#d0d0d0"><font size="3" color="">tableName</font></th>
		<th bgcolor="#d0d0d0"><font size="3" color="">totalRecord</font></th>
		<th bgcolor="#d0d0d0"><font size="3" color="">TlastUpdateTime</font></th>
		<th bgcolor="#d0d0d0"><font size="3" color="">recordTime</font></th>
		</tr>
	<?php 
	foreach($millionTable as $id => $tableArr){
		$num++;
	?>
		<tr>
		<td><font color="#484891"><?=$tableArr['tableName'] ?></font></td>
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
<h4><?=$num?> Records</h4>
<p>&nbsp;</p>
</body>
</html>



