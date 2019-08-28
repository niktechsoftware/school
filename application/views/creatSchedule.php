<script src="<?php echo base_url(); ?>assets/plugins/jQuery/jquery-2.1.1.min.js"></script>
<div class="row"> 
<?php $school_code = $this->session->userdata("school_code");?>
	<div class="col-sm-15">		
		<div class="panel panel-calendar">
			<div class="panel-heading panel-blue border-light">
				<?php 
				     $this->db->where('school_code',$school_code);
				      $this->db->where('id',$exam_name);
                        $exam=$this->db->get('exam_name')->row();
				     ?>
				            
				<h4 class="panel-title">Scheduling For-Exam Name:<?php echo $exam->exam_name;?> </h4>
			</div>	
			<div class="row">
			<input type="hidden" name="exam_name" value="<?php echo $exam_name;?>"/>
			<!-- <input type="hidden" name="edate" value="<?php// echo $edate;?>"/>-->
			<input type="hidden" name="nod" value="<?php echo $nod;?>"/>
				<table class="table table-responsive">
					<thead>
					 <?php $i=1; if($i%2==0){$rowcss="danger";}else{$rowcss ="warning";}?>
                                 <tr class="<?php echo $rowcss;?>">
							<th class="center"style="width: 130px;">
									Date & Day<br>
									Class[Section] & Shift
							</th>
						<?php $j=1; foreach($days as $col):?>
							<th style="width: 100px;"><?php echo date('d-F-Y', strtotime($col->date1));?>
							<input type="hidden" id="date<?php echo $j ?>" style="width: 90px;" name="date<?php echo $j ?>" value="<?php echo $col->id;?>"/><br>
							 <?php //echo $col->id;?></th>
							<?php $j++; endforeach;?>
						</tr>	
					</thead>
					<tbody>
						<?php $i=1; $j=1; foreach ($classes as $row):

						?>
							<?php foreach ($shift as $sh):
							
							?>
					   <?php  if($i%2==0){$rowcss="warning";}else{$rowcss ="danger";}?>
                                 <tr class="<?php echo $rowcss;?>">
							<td class="center"> <?php $classid=$row->id;
								$this->db->where('id',$row->section);
							$section=$this->db->get('class_section')->row()->section;
							 $j=1; echo $row->class_name."[".$section."]";
							 
							 $query = $this->db->query("SELECT * from class_info where id='$row->id' and school_code='$school_code'");
							
							 foreach($query->result() as $a):
							//print_r($a->class_name);
						
							?> 
							 <input type="hidden" style="width: 40px;" id="class<?php echo $i;?>" name="class<?php echo $i;?>" value="<?php echo $a->id;?>"  /> &
							 <input type="hidden" style="width: 60px;" id="shift<?php echo $i;?>" name="shift<?php echo $i;?>" value="<?php echo $sh->id?>" />
							<?php
							 endforeach;
							 ?>
							<?php echo $sh->shift?>
							</td>
							<?php foreach($days as $col):
							//echo "hhiiiiiii";exit;
							?>
							<?php if($msg > 1)
							{
								?><td><?php 
								$sub = $this->db->query("SELECT subject_id FROM exam_time_table WHERE class_id ='$a->id' AND shift_id = '$sh->id'  AND exam_day_id ='$col->id' AND school_code='$school_code'");
								$subject = $sub->row();
								$sub1 = $this->db->query("SELECT * FROM exam_time_table WHERE exam_id ='$exam_name' AND exam_day_id = '$col->id'  AND class_id = '$row->id' AND school_code='$school_code'");
								$row1 = $sub1->row();
								if($row1){
									$fs=$row1->subject_id;
								}
								else{
									$fs="none";
								}
								?>
								<select name="subject<?php echo $i.$j;?>" style="width: 100px;" id="subject<?php echo $i.$j;?>" >
									<option value="N/A">-Select Subject-</option>
									<?php //echo "hhiiiiiii";exit;
									 foreach ($subject as $sub):
									?>
									<option value=<?php echo '"'.$sub->id.'"'; if($fs == $subject){ echo 'selected="selectd"'; } ?>><?php echo $sub->subject; ?></option>
									<?php endforeach;?>
								</select>	
						
								<script> 
				 						$(document).ready(function(){
											$("#subject<?php echo $i.$j;?>").change(function(){
												var exam_id = "<?php echo $exam_name;?>";
												//var edate = "<?php //echo $edate;?>";
												var classid = $("#class<?php echo $i;?>").val();
												var shiftid = $("#shift<?php echo $i;?>").val();
												var edayid = $("#date<?php echo $j ?>").val();
												var subjectid = $("#subject<?php echo $i.$j;?>").val();

												//alert(exam_id);
												// alert(classid);
												// alert(shiftid);
												// alert(edayid);
											   //alert(subjectid);
										$.post("<?php echo site_url("index.php/examControllers/fullExam") ?>",{exam_id : exam_id,classid : classid,shiftid :shiftid,edayid : edayid,subjectid : subjectid}, function(data){
											$("#sectionId12").html(data);
											});
											});
					 					});
										</script>
								</td>
							<?php $j++; 
							}
							else 
							{
								?><td><?php 
								//echo $class;
							$sub = $this->db->query("SELECT * FROM subject WHERE class_id ='$row->id' ");
							
							//print_r($sub);
							 $subject = $sub->result();
							
						
							
							?>
							<select name="subject<?php echo $i.$j;?>" style="width: 100px;" id="subject<?php echo $i.$j;?>">
							<option value="N/A">-Select Subject-</option>
									
									<?php
									//print_r($subject);
									 foreach ($subject as $sub):
										$sub2 = $this->db->query("SELECT distinct subject_id FROM exam_time_table WHERE exam_day_id='$col->id' and subject_id='$sub->id' and exam_id ='$exam_name' AND shift_id = '$sh->id'  AND class_id = '$row->id' AND school_code='$school_code'");
							$row1 = $sub2->row();
							if($row1){
								$fs=$row1->subject_id;
							}
							else{
								$fs="none";
							}
									//echo "hii";
									//print_r($sub);?>
									<option value=<?php echo '"'.$sub->id.'"'; if($fs == $sub->id){ echo 'selected="selectd"'; } ?>><?php echo $sub->subject; ?></option>
									<?php endforeach;?>
								</select>	
								<script> 
				 						$(document).ready(function(){
											$("#subject<?php echo $i.$j;?>").change(function(){
												var exam_id = "<?php echo $exam_name;?>";
												//var edate = "<?php //echo $edate;?>";
												var classid = $("#class<?php echo $i;?>").val();
												var shiftid = $("#shift<?php echo $i;?>").val();
												var edayid = $("#date<?php echo $j ?>").val();
												//var day1 = $("#day<?php echo $j ?>").val();
												var subjectid = $("#subject<?php echo $i.$j;?>").val();
												
												// alert(exam_id);
												//   alert(classid);
												//   alert(shiftid);
												//   alert(edayid);
												 // alert(subjectid);
										$.post("<?php echo site_url("index.php/examControllers/fullExam") ?>",{exam_id : exam_id,classid : classid,shiftid :shiftid,edayid : edayid,subjectid : subjectid}, function(data){
											$("#sectionId12").html(data);
											});
												
											});
					 					});
								</script></td>
							<?php        
							$j++;  
							} 
							endforeach;//days and column?>
						</tr>
						<?php $i++; ?>
						<?php endforeach;//shift?>
						<?php endforeach;//class?>
						
					</tbody>
				</table>
				<input type="hidden" name="nos" value="<?php echo $i;?>"/>
			</div>
		</div>
	</div>
</div>

