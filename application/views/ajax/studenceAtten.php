<!--  
Niktech software Solutions,niktechsoftware.com,schoolerp-niktech.in
  <meta name="description" content="Welcome to niktech software School business ERP . we proving school management erp software. we including online attendance with biometric attendance machine and tracking student with GPS technology & many other facilities in our school management erp system">
  <meta name="keywords" content="Enterprise resource planning,school,ERP,system software,attendance,biometric,online, school management,gps,niktech software solution, online result, online admit card,omr">
  <meta name="author" content="School management System software">
-->
<input type="hidden" name="section" value="<?php echo $sec;?>"/>
		<!-- //<input type="hidden" name="classv" value="<?php echo $cla;?>"/> -->
	<!-- 	<input type="hidden" name="date1" value="<?php echo $date1;?>"/> -->
		<?php $i=1;
		if($check > 0)
		{
			?><div class="alert alert-danger">
		     <?php  echo "<h4>Attendance is Done for [ ".date("d-m-Y",strtotime($date1))."]</h4>";?>
			</div><?php 
		}
		else {	
	
		if($var->num_rows() > 0){?>
		
			<?php foreach ($var->result() as $row){	
				?>
				  <?php if($i%2==0){$rowcss="danger";}else{$rowcss ="warning";}?>
	            <tr class="<?php echo $rowcss;?>">
				<td> <?php echo $i;?> </td>
				<td><input type="hidden" name="stuID<?php echo $i;?>" value="<?php echo $row->id;?>" /> <?php echo $row->username;?> </td>
				<!--<td><input type="hidden" name="schno<?php //echo $i;?>" value="<?php //echo $row->scholer_no;?>"/> <?php //echo $row->scholer_no;?></td>-->
														<td> <strong><?php echo strtoupper($row->name);?></strong></td>
														<?php $this->db->where('student_id',$row->id);
													$gr=	$this->db->get('guardian_info');
													if($gr->num_rows()>0){
														?>
														<td> <strong><?php echo strtoupper($gr->row()->father_full_name);?></strong></td>
													<?php	}?>
														<!--<td> <?php //echo $row->mobile;?></td>-->
														<td> <div class="form-group">
														
														
															<label class="radio-inline">
																<input type="radio" class="grey" value="1" name="gender<?php echo $i; ?>" id="gender_female" checked="checked">
																p
															</label>
															<label class="radio-inline">
																<input type="radio" class="grey" value="0" name="gender<?php echo $i; ?>"  id="gender_male">
																A
															</label>
														<!--	<label class="radio-inline">
																<input type="radio" class="grey" value="L" name="gender<?php echo $i; ?>"  id="gender_male">
																L
															</label>-->
													
														</div></td>	
													</tr><?php 
												$i++;}
												
				 	?><input type="hidden" value="<?php echo $i;?>" name="rows"/>
				 	<tr><td colspan="2">
				 	<button id="sonu" class="btn btn-blue next-step btn-block">
				 	Submit <i class="fa fa-arrow-circle-right"></i>
				 	</button>
				 	</td></tr><?php 
		}
		
	}