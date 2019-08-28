<!--  
Niktech software Solutions,niktechsoftware.com,schoolerp-niktech.in
  <meta name="description" content="Welcome to niktech software School business ERP . we proving school management erp software. we including online attendance with biometric attendance machine and tracking student with GPS technology & many other facilities in our school management erp system">
  <meta name="keywords" content="Enterprise resource planning,school,ERP,system software,attendance,biometric,online, school management,gps,niktech software solution, online result, online admit card,omr">
  <meta name="author" content="School management System software">
-->
 <!-- <input type="hidden" name="section" id ="section" value="<?php echo $sec;?>"/>
 -->		<input type="hidden" name="classv" id = "classv" value="<?php echo $cla;?>"/>
		<?php $i=1;
		
	if($check->num_rows() > 0){
	$school_code = $this->session->userdata('school_code');?>
			<table class="table table-bordered table-hover" id="sample-table-1">
		 			<thead>
			 			<tr>
							<td> S.No. </td>
							<td> Student ID </td>
							
							<td> Student Name</td>
							<td> Father Name</td>
							<td> Mobile</td>
							<td>stream</td>
							<td>section</td>
							<td> Select Class </td>
							
							
							<td> Pramote </td>
							<td> Status </td>
						</tr>
					</thead>
				<tbody>
			
			<?php foreach ($check->result() as $row){
				//$this->db->where("school_code",$this->session->userdata('school_code'));	
				$this->db->where("id",$row->id);
				$this->db->where("status",1);
				$this->db->where("fsd <",$this->session->userdata('fsd'));
				if($this->db->get("student_info")->row())
				{
				$this->db->where("school_code",$this->session->userdata('school_code'));
				$this->db->where("student_id",$row->id);
				$ginfo = $this->db->get("guardian_info")->row();
				if($ginfo){
				$fname = $ginfo->father_full_name;
				}
					$this->db->where("id",$row->class_id);
					$oldv=	$this->db->get("class_info")->row();
				?>
				<tr>
				<td><?php echo $i;?></td>
				<td><input type="hidden" id="stuID<?php echo $i;?>" name="stuID<?php echo $i;?>" value="<?php echo $row->id;?>" /> <?php echo $row->username;?> </td>
				<!-- <td><input type="hidden" id="schno<?php echo $i;?>" name="schno<?php echo $i;?>" value="<?php echo $row->scholer_no;?>"/> <?php echo $row->scholer_no;?></td> -->
														<td> <?php echo $row->name;?></td>
														<td><?php echo $fname;?></td>
														<td> <?php echo $row->mobile;?></td>
														<td><select id="clname<?php echo $i;?>" class="form-control">
															<option value="">Select Stream</option>
                                                            <?php 
                                                            $school_code = $this->session->userdata("school_code");
		$StreamList = $this->db->query("SELECT DISTINCT stream from class_info where school_code='$school_code' ORDER BY id");
                                                            ?>


															<?php if(isset($StreamList)){?>
															<?php foreach ($StreamList->result() as $row2){
																 
																 
																
															
                                                                ?>
															<option value="<?php echo $row2->stream;?>" <?php if($row2->stream==$oldv->stream){echo 'selected="selected"';}?>><?php $this->db->where("id",$row2->stream);
														$sname=	$this->db->get("stream")->row()->stream;echo $sname;?></option>
															<?php } }?>
														</select></td>
                                                      
														<td>
															
														<select id="sectionList<?php echo $i;?>" class="form-control">
														
                                                            <?php 
                                                            $school_code = $this->session->userdata("school_code");
						$SectionList = $this->db->query("SELECT DISTINCT section from class_info where school_code='$school_code' ORDER BY id");
                                                            ?>


															<?php if(isset($SectionList)){?>
															<?php foreach ($SectionList->result() as $row7){
																 
																  $sectionid=$row7->section;
																 $this->db->where('id',$sectionid);
																$row2=$this->db->get('class_section')->row(); 
                                                                ?>
															<option value="<?php echo $row2->id;?>" <?php if($row2->section == $oldv->section){echo 'selected="selected"';}?>><?php echo $row2->section;?></option>
															<?php } }?>
														</select> 
													

														</td>
																	
														<td> <?php $classname = $this->db->query("SELECT * FROM class_info where section= '$oldv->section' and stream='$oldv->stream'")->result();
																	 ?>
													<select class="form-control" id="changeClass<?php echo $i;?>" name="class<?php echo $i;?>" style="width: 90px;">
											
												<?php 
												
												foreach($classname as $row7):?>
													<option value="<?php echo $row7->id;?>"><?php echo $row7->class_name;?></option>
													<?php endforeach;  ?> 
												</select>		
														</td>
														
														<td>
														




															<button id = "pro<?php echo $i;?>" class="btn btn-dark-purple">
				 												Pramote <i class="fa fa-arrow-circle-right"></i>
				 											</button>
				 											
														</td>
														 <td>
														<input type ="button" value = "Good Day" class="btn btn-success btn-sm" id="msg1<?php echo $i;?>">
								                    		
														</td>
													</tr>

								<?php 



												$i++;?>

												<!-- <div type="button" id="pro<?php echo $i;?>" class="btn btn-success btn-sm"></div> -->
										<?php	}}?></tbody>
				</table><?php 
												
												
	}?>
	<script> 
	<?php for($j=1;$j<=$i;$j++){?>
		$("#pro<?php echo $j;?>").click(function(){
			
			var student_id = $("#stuID<?php echo $j;?>").val();
		
			var changeClass = $("#changeClass<?php echo $j;?>").val();
			console.log(changeClass);
			if(changeClass==null){
				alert("Please select a Valid stream section and class to pramot");
			}else{
				$.post("<?php echo site_url("index.php/promotionControler/pramoteClass") ?>",{student_id : student_id, changeClass : changeClass}, function(data){
				$("#msg1<?php echo $j;?>").html(data);
				});
			}
		});

		  $("#clname<?php echo $j;?>").change(function(){
            var streamid = $("#clname<?php echo $j;?>").val();
            //alert(clname);
            $.post("<?php echo site_url('index.php/promotionControler/getpromoteSection') ?>", {streamid : streamid}, function(data){
                $("#sectionList<?php echo $j;?>").html(data);
                //alert(data);
    		});
        });

		 $("#sectionList<?php echo $j;?>").change(function(){
            var sectionid = $("#sectionList<?php echo $j;?>").val();
            var streamid = $("#clname<?php echo $j;?>").val();
           // alert(sectionid);
            $.post("<?php echo site_url('index.php/promotionControler/getpramoteClass') ?>", {sectionid : sectionid , streamid : streamid}, function(data){
                $("#changeClass<?php echo $j;?>").html(data);
                //alert(data);
    		});
        });



		<?php }
		?>
	</script>
