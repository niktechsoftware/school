<div class="row">
<div class="col-md-12">
<!-- start: RESPONSIVE TABLE PANEL -->
        <div class="panel panel-white">
            <div class="panel-heading panel-blue">
                <h4 class="panel-title">Student <span class="text-bold">Attendance Detail</span></h4>
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
                    <div class="panel-body panel-scroll"  style="height:auto" >
                            <div class="alert alert-info">
                					<h3 class="media-heading text-center">Welcome to Show Attendence Area</h3>
                					<p class="media-timestamp">To know the Attendence of stundent  ,you can see here Attendence .
                					</p>
                				</div>  
                     <table class="table table-bordered table-hover " id="a_tb">
                            <thead>
                            <tr class="text-center">
                            <th class="text-center">S No.</th>
                            <th class="text-center">Student Userid</th>
                            <th class="text-center">Attendance (Green for present,Red for absent)</th>
                            <th class="text-center">Attendance Date/Day</th>
                            <th class="text-center">Shift 1</th>
                            <th class="text-center">Shift 2</th>
                            <!-- <th>Activity</th> -->
                            </tr>
                            </thead>
                            <tbody>
                            <?php 
                            $username=$this->session->userdata("username");
                            $this->db->where("username",$username);
                            $this->db->where("status",1);
                            $id=$this->db->get("student_info")->row();
                            
                            // $this->db->where("stu_id",$id->id);
                            $this->db->where("class_id",$id->class_id);
                            $this->db->where("school_code",$this->session->userdata('school_code'));
                            $dt=$this->db->get("school_attendance")->result();
                            // echo "<pre>";
                            // print_r($dt);exit;
                            ?>
                            <?php $v=1;$p=0;$a1=0; foreach($dt as $row):
                            ?><tr>
                            <td class="text-center"><?php echo $v; ?> </td>
                            <td class="text-center"><?php echo $username;?></td>
                            <?php 
                            $this->db->where("class_id",$row->class_id);
                            $this->db->where("stu_id",$id->id);
                            $this->db->where("attendance",0);
                            $this->db->where("a_date",$row->date);
                            $this->db->where("school_code",$this->session->userdata('school_code'));
                            $a=$this->db->get("attendance");
                            if($a->num_rows()>0){ ?>
                            <td class="text-center">
                             <svg height="30" width="30">
                              <circle cx="15" cy="15" r="13" stroke="black" stroke-width="1" fill="red" />
                            </svg>  
                            </td>
                            <td class="text-center"><?php echo $a->row()->a_date; $at=$a->row()->a_date; echo " ( ".date('D', strtotime("D", strtotime($at)))." )"; ?></td>
                            <td class="text-center"><?php if($a->row()->shift_1==1){echo "YES";}else{echo "NO";}?></td>
                            <td class="text-center"><?php if($a->row()->shift_2==1){echo "YES";}else{echo "NO";};?></td>
                            <?php $p=$p+1;}else{ 
                              ?>
                              <td class="text-center">
                                <svg height="30" width="30">
                              <circle cx="15" cy="15" r="13" stroke="black" stroke-width="1" fill="green" />
                            </svg> 
                            </td>
                            <td class="text-center"><?php echo $row->date; $at=$row->date; echo " ( ".date('D', strtotime("D", strtotime($at)))." )"; ?></td>
                            <td class="text-center"><?php echo "YES";?></td>
                            <td class="text-center"><?php echo "NO";?></td>
                              <?php $a1=$a1+1;}?>
                             </tr>	<?php $v++; endforeach; ?>
                            </tbody>
                     <span style="font-size:20px;">Attendance (in %) = <?php $totatt=$p+$a1;if($totatt!=0){echo round(($a1/$totatt)*100,2) ."%";}else{echo "0%";}?></span>
                            <?php $totatt=$p+$a1;if($totatt!=0){ ?>
                    <div><label>Total Attendence=</label><label><?php echo $totatt; ?></label></div>
                    <div><label>Total Present =</label><label><?php echo $a1; ?></label></div>
                    <div><label>Total Absent =</label><label><?php echo $absent= $totatt-$a1; ?></label></div>
                    <?php } ?>
                </table>
         </div>
      </div>
   </div>
</div>