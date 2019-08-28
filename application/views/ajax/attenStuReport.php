		 <br> 				
		<div class="row">

			<div class="col-md-12 space20">
				<div class="btn-group pull-right">
					<button data-toggle="dropdown" class="btn btn-green dropdown-toggle">
						Export <i class="fa fa-angle-down"></i>
					</button>
					<ul class="dropdown-menu dropdown-light pull-right">
						<li>
							<a href="#" class="export-excel" data-table="#sample-table-2" >
								Export to Excel
							</a>
						</li>
						<!--<li>-->
						<!--	<a href="#" class="export-pdf" data-table="#sample-table-2" >-->
						<!--		Save as PDF-->
						<!--	</a>-->
						<!--</li>-->
						<!--<li>-->
						<!--	<a href="#" class="export-png" data-table="#sample-table-2">-->
						<!--		Save as PNG-->
						<!--	</a>-->
						<!--</li>-->
						<li>
							<a href="#" class="export-csv" data-table="#sample-table-2" >
								Save as CSV
							</a>
						</li>
						<!--<li>-->
						<!--	<a href="#" class="export-txt" data-table="#sample-table-2" data-ignoreColumn ="3,4">-->
						<!--		Save as TXT-->
						<!--	</a>-->
						<!--</li>-->
						<!--<li>-->
						<!--	<a href="#" class="export-xml" data-table="#sample-table-2" data-ignoreColumn ="3,4">-->
						<!--		Save as XML-->
						<!--	</a>-->
						<!--</li>-->
						<!--<li>-->
						<!--	<a href="#" class="export-sql" data-table="#sample-table-2" data-ignoreColumn ="3,4">-->
						<!--		Save as SQL-->
						<!--	</a>-->
						<!--</li>-->
						<!--<li>-->
						<!--	<a href="#" class="export-json" data-table="#sample-table-2" data-ignoreColumn ="3,4">-->
						<!--		Save as JSON-->
						<!--	</a>-->
						<!--</li>-->
						<li>
							<a href="#" class="export-doc" data-table="#sample-table-2" data-ignoreColumn ="3,4">
								Export to Word
							</a>
						</li>
						<!--<li>-->
						<!--	<a href="#" class="export-powerpoint" data-table="#sample-table-2" data-ignoreColumn ="3,4">-->
						<!--		Export to PowerPoint-->
						<!--	</a>-->
						<!--</li>-->
					</ul>
				</div>
			</div>
		</div>

		<div class="table-responsive">
			<table class="table table-striped table-hover" id="sample-table">
				<thead>
					<tr class ="success">
									<th>S.no.</th>
									<th>Date</th>
									<th>Taken By</th>
									<th>Present</th>
									<th>Absent</th>
									<th>Absent Person</th>
								</tr>
							</thead>
							<tbody>
							
			  					<?php  $i=1;
			  				//	print_r($cla);exit;
                                $this->db->where("date  >=",$sdate);
                                $this->db->where("date <= ",$edate);
			  					$this->db->where("class_id",$cla);	  
			  				     $data=$this->db->get("school_attendance");
								if($data->num_rows()>0)
			  			             {
			  			             	$sno=1;
			  			             	foreach($data->result() as $a)
			  			             	{

			  			             	$queryString = "SELECT * FROM attendance WHERE class_id='$cla' AND  a_date >= '$sdate' and a_date <='$edate' AND school_code='$school_code' order by id";
                        				$query = $this->db->query($queryString);
                        				 if($i%2==0){$rowcss="danger";}else{$rowcss ="warning";}?>
									<tr class="<?php echo $rowcss;?>">
									<td><?php echo $sno;?></td>
									<td><?php  echo $a->date;?></td>
									<td>
									<?php echo $a->teacher_id ;?>
									</td>
			  					    <td>
			  						<?php    
										$rdta= $a->date;
									//	$resultP = $this->db->query("SELECT count(student_id) as totstu FROM student_info WHERE status = 'Active' AND class_id='$cla' AND section='$sec' AND school_code='$school_code'")->row();
        			  					$resultP = $this->db->query("SELECT count(username) as Total_Student FROM student_info WHERE status = 1 AND class_id='$cla'")->row();
        			  					$resultA = $this->db->query("SELECT count(stu_id) as Total_Absent FROM attendance WHERE attendance = 0 AND class_id='$cla' AND school_code='$school_code' AND a_date = '$rdta' ")->row();
        			  				//	$resultL = $this->db->query("SELECT count(stu_id) as totl FROM attendance WHERE attendance = 'L' AND class='$cla' AND section='$sec' AND school_code='$school_code' AND a_date = '$row->date' ")->row();
			  						
			  							//$absent = $this->teacherModel->countAtt($edate,$sdate,$cla,$sec);
			  							//$totp = $absent['p']-$absent['a']-$absent['l'];*/
			  							$praesent = $resultP->Total_Student - $resultA->Total_Absent;
			  							echo "Total Present =".$praesent;
			  							
			  						?> 
			  					</td>
			  					<td>
    			                 	<?php 
    			  					echo "Total Absent =".$resultA->Total_Absent;
                                    ?>
    			  					</div>
    			  					</td>
    				  		    	<td><?php	$resultAsh = $this->db->query("SELECT stu_id, a_date FROM attendance WHERE attendance = 0 AND class_id='$cla'  AND school_code='$school_code' AND a_date = '$rdta'");
			  					if($resultA->Total_Absent > 0){
			  						?>
			  						<div class="alert alert-info">
									  <?php 
									 if($resultAsh->num_rows()>0){
									  foreach($resultAsh->result() as $rt):
			  						 //foreach($resultA->result() as $row):
			  							$this->db->where('id',$rt->stu_id);
			  							$this->db->where('class_id',$cla);
										  $stu=$this->db->get('student_info');
										  if($stu->num_rows()>0){
			  							//print_r($rt->stu_id);print_r($cla);exit;
			  							echo $stu->row()->name."[".$stu->row()->username."]"." [Date ".date("d-m-Y",strtotime($rt->a_date))."]<br>";
										  }else{ echo '<span style="color:red"> Student name not found</span><br>';}  				
			  						
			  						$i++; endforeach;}
			  					

			  					 }?></td>
				  			
				  			<?php $sno++;
				  							}			
									}
									else{ ?><tr><td><div class="alert alert-warning">NO RECORD FOUND</div></td></tr>

								<?php }?>
							</tbody>
						</table>
					</div>
				
						
					
	  		

