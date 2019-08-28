		
		<?php 
		$school_code = $this->session->userdata("school_code");
		 $t_id=$this->input->post("teacherid");
		 $class=$this->uri->segment(4);
		 $class_section=$this->uri->segment(4);
		 $out_of=$this->uri->segment(5);
		 $exam_name=$this->uri->segment(6);
		  $section=$this->uri->segment(7);
		 $subject=$this->uri->segment(8);
		echo  $t_id;
		
		 $result = $this->db->query("select * from student_info where class_id='$class' and section='$section' and school_code ='$school_code' AND status = 'Active' ORDER BY first_name ");
		 $class_info = $result;
		 $num_row1 = $result->num_rows();
		 
		 ?>
            <table class="table table-striped table-bordered table-hover" id="datatable">
                  <tr>
                    <th><?php echo  $class; echo $class_section; ?> - <?php echo $section; ?> - <?php echo $subject; ?></th>
                    <th><?php 
						date_default_timezone_set("Asia/Calcutta");
						$day = date('d-m-Y');
						echo date("l jS F, Y", strtotime("$day"));  
					?>
                    </th>
                  </tr>
              </table>
              <br><br>
                <?php  $val=$this->db->get("general_settings")->row();
										$fsd = $val->finance_start_date;  
              $val=$this->db->query("select * from exam_info WHERE exam_name = '$exam_name' AND class1='$class_section' and school_code ='$school_code' AND section ='$section' AND subject='$subject' AND fsd = '$fsd' ");
              		
              		?>
               <table class="table table-striped table-hover" id="sample-table-2">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Student ID</th>
                    <th>Scholar No</th>
                    <th>Student Name</th>
                    <th>Attendance</th>
                    <th>M.M.</th>
                    <th>Marks Obtained</th>
                  </tr>
                </thead>
                <tbody>
                <?php $i = 1;?>
                <?php 
                if($val->num_rows()>0)
                {
                foreach ($val->result() as $v){?>
                  <tr>
                    <td><?php echo $i; ?></td>
                    
                    <?php $this->db->where("student_id",$v->stu_id);
                 $this->db->where("status","Active");
                    $num_row=$this->db->get("student_info")->row();?>
                    <td>
                    	
						<?php echo $v->stu_id; ?>
                    </td>
                    <td>
							<?php echo $num_row->scholer_no; ?>
                    </td>
                    <td><?php echo $num_row->first_name." ".$num_row->midd_name." ".$num_row->last_name; ?></td>
                    <td class="hidden-xs text-center">
  					<?php echo $v->Attendance;?>
                      </td>
                    <td><?php echo $out_of; ?></td>                  
                    <td><?php echo $v->marks;?></td>
                  </tr> 
                  <?php $i++; } ?>
                    </tbody>
              </table>
              <br>
                  
                  <?php 
                }
                else {
                	foreach($class_info->result() as $num_row){?>
                	                  <tr>
                	                    <td><?php echo $i; ?></td>
                	                    <td>
                	                    	<input type="hidden" name="stu_id<?php echo $i; ?>" value="<?php echo $num_row->student_id; ?>" />
                							<?php echo $num_row->student_id; ?>
                	                    </td>
                	                    <td>
                							<input type="hidden" name="scholer_no<?php echo $i; ?>" value="<?php echo $num_row->scholer_no; ?>" />
                								<?php echo $num_row->scholer_no; ?>
                	                    </td>
                	                    <td><?php echo $num_row->first_name." ".$num_row->midd_name." ".$num_row->last_name; ?></td>
                	                    <td class="hidden-xs text-center">
                	  					<label class="radio-inline">
                	                       <input class="radio" checked type="radio" onClick="undisableTxt(<?php echo $i; ?>);" name="Attendance<?php echo $i; ?>" id="optionsRadios1" value="P">
                	                   		P 
                	                    </label>
                	                    <label class="radio-inline">
                	                        <input class="radio" type="radio" onClick="disableTxt(<?php echo $i; ?>);" id="att<?php echo $i; ?>" name="Attendance<?php echo $i; ?>" id="optionsRadios2" value="A">
                	                         A
                	                    </label> 
                	                      </td>
                	                    <td><?php echo $out_of; ?></td>                  
                	                    <td><input type="text" id="mark<?php echo $i; ?>" onBlur="check<?php echo $i; ?>(); return false;" name="marks<?php echo $i; ?>" required /></td>
                	                  </tr> 
                	                  <?php $i++; } ?> 
                	                  	</tbody>
             						</table>
             					 <br>
              					 <table>              
                		<tr>
		                	<td>
		                    	<input type="submit" class="btn btn-info btn-gradient" value="Save <?php echo $subject; ?> Marks" />
		                    </td>
		                     <td>
		                    	&nbsp;
		                    </td>
		                    <td>
		                    	<a href="<?php echo base_url();?>/index.php/invoiceController/marksSlip" class="btn btn-info btn-gradient" >Print Slip</a>
		                    </td>
		                </tr>
		            	  </table>
		             	 <br><br><br>
		             	 </form><?php 
		                }?>                 
              
            