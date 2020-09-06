
<table class="table-striped table bordered">
<?php 
$sno = 1;
foreach($student as $data)
{
	

	?>

<tr>	<td><?php echo $sno; ?></td>
	<td><?php echo $data->username; ?></td>
<td><a href="#"><?php echo $data->name; ?></a></td></tr>
<!--<td><a href="<?php //echo base_url();?>index.php/exampanel/admitCardReports"><?php echo $data->name; ?></a></td></tr>-->
</tr>

	<?php
$sno++;
}

	

 ?>
</table>