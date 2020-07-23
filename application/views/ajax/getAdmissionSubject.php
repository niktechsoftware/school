<!--  
Niktech software Solutions,niktechsoftware.com,schoolerp-niktech.in
  <meta name="description" content="Welcome to niktech software School business ERP . we proving school management erp software. we including online attendance with biometric attendance machine and tracking student with GPS technology & many other facilities in our school management erp system">
  <meta name="keywords" content="Enterprise resource planning,school,ERP,system software,attendance,biometric,online, school management,gps,niktech software solution, online result, online admit card,omr">
  <meta name="author" content="School management System software">
-->
<?php 

	$this->db->where("class_id",$className);
	
	$res = $this->db->get("subject");
	$i = 1;
	foreach ($res->result() as $row1):
?>
<div class="col-md-3">
	<div class="form-group">
		<label class="control-label">
			Subject <?php echo $i; ?>
		</label>
		<select class="form-control" id="subject" name="subject<?php echo $i;?>">
			<option> Select Subject <?php echo $i; ?></option>
			<?php
			foreach($res->result() as $row):
				echo '<option value="'.$row->subject.'">'.$row->subject.'</option>';
			endforeach;
			?>
		</select>
	</div>
</div>

<?php $i++; endforeach; ?>
<input type="hidden" value="<?php echo $i--;?>" name="subVal" />