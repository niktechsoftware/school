
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<!-- start: EXPORT DATA TABLE PANEL  -->
			<div class="panel panel-white">
			    
<?php $school_code= $this->session->userdata("school_code"); ?>

				<div class="panel-heading panel-red">
					<h4 class="panel-title"> <span class="text-bold">Student Attendence Panel</span></h4>
					<div class="panel-tools">
						<div class="dropdown">
							<a data-toggle="dropdown" class="btn btn-xs dropdown-toggle btn-transparent-grey">
								<i class="fa fa-cog"></i>
							</a>
							<ul class="dropdown-menu dropdown-light pull-right" role="menu">
								<li>
									<a class="panel-collapse collapses" href="#"><i class="fa fa-angle-up"></i> <span>Collapse</span> </a>
								</li>
								<li>
									<a class="panel-refresh" href="#">
										<i class="fa fa-refresh"></i> <span>Refresh</span>
									</a>
								</li>
								<li>
									<a class="panel-config" href="#panel-config" data-toggle="modal">
										<i class="fa fa-wrench"></i> <span>Configurations</span>
									</a>
								</li>
								<li>
									<a class="panel-expand" href="#">
										<i class="fa fa-expand"></i> <span>Fullscreen</span>
									</a>
								</li>
							</ul>
						</div>
						<a class="btn btn-xs btn-link panel-close" href="#">
							<i class="fa fa-times"></i>
						</a>
					</div>
				</div>
				<div class="panel-body">
				    			
				    
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
								
								</ul>
								
							</div>
						</div>
					</div>
					<?php
					if($uri==3){ ?>
					<div class="table-responsive">
					
						     <table class="table" id="sample-table-2">
                    <thead>
                    <th>Sno.</th>
                    <th>Section </th>
                    <th>Class </th>
                    <th>Total Student</th>
                    <th>Present </th>
                    <th>Absent </th>
                    </thead>
                                 <tbody>
                        <?php $i=1;?>
                        <?php $count=0;
                        $totstu=0;
                     

                      
                      
                         $this->db->where("school_code",$school_code);
                       // $this->db->where("section",$sectiondt->id);
                       $classdt= $this->db->get("class_info");
                     if($classdt->num_rows()>0){
                        // print_r($classdt->result());
                         foreach($classdt->result() as $sectiondt):
                            //  print_r($sectiondt);
                            // exit();
                               $this->db->where("school_code",$school_code);
                        $this->db->where("id",$sectiondt->section);
                       $classsection= $this->db->get("class_section");
                           $fsd= $this->session->userdata("fsd");
                           
                           $this->db->where("fsd",$fsd);
                            $this->db->where("status",1);
                          $this->db->where("class_id",$sectiondt->id);
                          $data= $this->db->get("student_info");
                         if($data->num_rows()>0){  
                            $this->db->where("status",1);  
                         $this->db->where("class_id",$sectiondt->id);
                         $studata=$this->db->get("student_info");
                         $totstudent= $studata->num_rows();
                        // echo "<pre>";
                      //  print_r($studata->row());
                         //$totstu=$totstu+$totstudent; 
                        
                        
                       if($studata->num_rows()>0){  ?>
                           <tr>
                          <td class="center"><?php echo $i;?></td>
                          <td> <?php  if($classsection->num_rows()>0){ echo $classsection->row()->section ; } else{ echo "Section Not define";}?>  </td>

                          <td class="center"><?php echo $sectiondt->class_name;?></td>
                          <td class="center"><?php echo $totstudent;?></td>
                          <?php  $date=Date("Y-m-d");
                             $this->db->where("date",$date);
                          $this->db->where("school_code",$school_code);
                          $this->db->where("shift_1",1);
                          $this->db->where("class_id",$sectiondt->id);
                          $school_atten= $this->db->get("school_attendance");
                          if($school_atten->num_rows()>0){
                          
                    $resultA = $this->db->query("SELECT count(stu_id) as Total_Absent FROM attendance WHERE attendance = 0 AND class_id='$sectiondt->id' AND school_code='$school_code' AND a_date = '$date' ");
        			  
                           if($resultA->num_rows()>0){
                            $absent=$resultA->row()->Total_Absent;
                          

                          $presentstu=$totstudent-$absent;
                          // print_r($count);
                         
                        ?>
                    
                       
                          <td class="center"><?php echo $presentstu;?></td>
                          <td class="center"><?php echo $absent;?></td>
                        
                        </tr>
                        <?php  } else{ ?>
                        
                          <td class="center"><?php echo $school_atten->num_rows();?></td>
                          <td class="center"><?php echo 0;?></td>
                        
                    <?php    }  } else{?>
                    
                          <td class="center"><?php echo "N/A";?></td>
                          <td class="center"><?php echo "N/A";?></td>
                  <?php  } $i++; } }    endforeach; } ?>
                       
                       
                     
                      </tbody>
                    </table>
					
					</div>
					<?php } else{ ?>
					
					 <table class="table" id="sample-table-2">
                    <thead>
                    <th>Sno.</th>
                    <th>Section </th>
                    <th>Class </th>
                    <th>Total Student</th>
                    <th>Present </th>
                    <th>Absent </th>
                    </thead>
                                 <tbody>
                        <?php $i=1;?>
                        <?php $count=0;
                        $totstu=0;
                     

                      
                      
                         $this->db->where("school_code",$school_code);
                       // $this->db->where("section",$sectiondt->id);
                       $classdt= $this->db->get("class_info");
                     if($classdt->num_rows()>0){
                        // print_r($classdt->result());
                         foreach($classdt->result() as $sectiondt):
                            //  print_r($sectiondt);
                            // exit();
                               $this->db->where("school_code",$school_code);
                        $this->db->where("id",$sectiondt->section);
                       $classsection= $this->db->get("class_section");
                           $fsd= $this->session->userdata("fsd");
                           
                           $this->db->where("fsd",$fsd);
                             $this->db->where("status",1);
                          $this->db->where("class_id",$sectiondt->id);
                          $data= $this->db->get("student_info");
                         if($data->num_rows()>0){  
                             $this->db->where("status",1);   
                         $this->db->where("class_id",$sectiondt->id);
                         $studata=$this->db->get("student_info");
                         $totstudent= $studata->num_rows();
                        // echo "<pre>";
                      //  print_r($studata->row());
                         //$totstu=$totstu+$totstudent; 
                        
                        
                       if($studata->num_rows()>0){  ?>
                           <tr>
                          <td class="center"><?php echo $i;?></td>
                          <td> <?php  if($classsection->num_rows()>0){ echo $classsection->row()->section ; } else{ echo "Section Not define";}?>  </td>

                          <td class="center"><?php echo $sectiondt->class_name;?></td>
                          <td class="center"><?php echo $totstudent;?></td>
                          <?php  $date=Date("Y-m-d");
                             $this->db->where("date",$date);
                          $this->db->where("school_code",$school_code);
                          $this->db->where("shift_2",1);
                          $this->db->where("class_id",$sectiondt->id);
                          $school_atten= $this->db->get("school_attendance");
                          if($school_atten->num_rows()>0){
                          
                           $resultA = $this->db->query("SELECT count(stu_id) as Total_Absent FROM attendance WHERE attendance = 0 AND class_id='$sectiondt->id' AND school_code='$school_code' AND a_date = '$date' ");
        			  
                           if($resultA->num_rows()>0){
                            $absent=$resultA->row()->Total_Absent;

                        //  $count=$count+$absent;

                          $presentstu=$totstudent-$absent;
                          // print_r($count);
                         
                        ?>
                    
                       
                          <td class="center"><?php echo $presentstu;?></td>
                          <td class="center"><?php echo $absent;?></td>
                        
                        </tr>
                        <?php  } else{ ?>
                        
                          <td class="center"><?php echo $school_atten->num_rows();?></td>
                          <td class="center"><?php echo 0;?></td>
                        
                    <?php    }  } else{?>
                    
                          <td class="center"><?php echo "N/A";?></td>
                          <td class="center"><?php echo "N/A";?></td>
                  <?php  } $i++; } }    endforeach; } ?>
                       
                       
                     
                      </tbody>
                    </table>
                 
               
                 
					
					<?php } ?>
				</div>
			</div>
			<!-- end: EXPORT DATA TABLE PANEL -->
		</div>
	</div>
	<!-- end: PAGE CONTENT-->
</div>