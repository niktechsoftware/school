	<!--  
Niktech software Solutions,niktechsoftware.com,schoolerp-niktech.in
  <meta name="description" content="Welcome to niktech software School business ERP . we proving school management erp software. we including online attendance with biometric attendance machine and tracking student with GPS technology & many other facilities in our school management erp system">
  <meta name="keywords" content="Enterprise resource planning,school,ERP,system software,attendance,biometric,online, school management,gps,niktech software solution, online result, online admit card,omr">
  <meta name="author" content="School management System software">
-->
<!--<link href="https//cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">-->
<!--	<script src="https//cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>-->
<!--<script>-->
<!--    	$(document).ready( function () {-->
<!--    $('#myTable').DataTable();-->
<!--} );-->
<!--</script>-->
		<table class="table table-striped table-bordered table-hover" id="myTable">
                <thead>
                  <tr>
                    <th>S.No.</th>
                    <th>Student Name</th>
                    <th>Student ID </th>
                    <th>Attendance</th>
                    <th>M.M.</th>
                    <th>Marks Obtained</th>
                     <th>Activity</th>
                  </tr>
                </thead>
                <tbody>
                <?php 

                if($dum){

                  $i = 1;
                    ?>
                <?php foreach($dum as $dum1){?>
                <tr>
                <td>
                <?php echo $i; ?>
                </td>
                <?php $var1=$dum1->stu_id; ?>          
                <?php 
                $school_code =  $this->session->userdata("school_code");
                                    $this->db->where("id",$school_code);
                                    $info =$this->db->get("school")->row();
                                    $row2=$this->db->get('db_name')->row()->name;
        if( $school_code == 1 && $row2== "A" || $school_code == 9 && $row2== "A"){
            //FOR MLA, RAMDOOT ORDER BY USERNAME
		                        $this->db->where("fsd",$this->session->userdata("fsd"));
                $this->db->where("status",1);
                $this->db->where("id",$dum1->stu_id);
                $this->db->order_by("username","asc");
               $result12 = $this->db->get("student_info"); 
        }else{
            //FOR KERALA AND SARVODYA ORDER BY NAME
                $this->db->where("fsd",$this->session->userdata("fsd"));
                $this->db->where("status",1);
                $this->db->where("id",$dum1->stu_id);
                $this->db->order_by("name","asc");
               $result12 = $this->db->get("student_info");
        }
               
               ?>
                <td>
               <?php if($result12->num_rows()>0){ echo $result12->row()->name;}else{echo "Student not in the current FSD";}?>
                    </td>
                    <td>
                        <?php if($result12->num_rows()>0){ echo $result12->row()->username;}else{echo "Studentid not in the current FSD";} ?>
                        
                    </td>
                    
                    <?php if($dum1->Attendance==1)
                    { ?>
                   <td><?php echo 'P'?></td>
                    <?php }?>
                 <?php if($dum1->Attendance==0)
                 {?>
                  <td><?php echo 'A'?></td>
                  <?php }?> 
                    <td><?php echo $dum1->out_of; ?></td>                  
                    <td>
                    <input type ="hidden" value="<?php echo $dum1->id;?>" name="rowid<?php echo $i;?>" id="rowid<?php echo $i;?>"/>
                 <input type="text" id="upmark<?php echo $i;?>" value="<?php echo $dum1->marks;?>" style="width:120px;" name="upmarks<?php echo $i;?>" />
                </td>
                <td>
                    <input type="submit" name="update" class="btn btn-dark-purple" value ="Update Marks" id="submit<?php echo $i;?>"/>
                    <script>
                    $("#submit<?php echo $i;?>").click(function(){
                    	var marks = $("#upmark<?php echo $i;?>").val();
    					var rowid= $("#rowid<?php echo $i;?>").val();
    				if(marks!=""){
    					$.post("<?php echo site_url("index.php/examControllers/updateSingeMarks") ?>",{marks : marks, rowid : rowid}, function(data){
    						$("#submit<?php echo $i;?>").val(data);
    						alert(" Updated Marks Successfully!!!!! ");
    					});
    				}else{
    				    alert('enter obtained marks');
    				}
    				});
                    </script>
                    </td>
                   </tr> 
                  <?php $i++; } ?>

                  <?php }else {?> 
                    
                         <?php  echo "<span style='color:red;font-size:20px;'>Please Update Your Marks From  Above Exam Section</span>"
                        ?>

                           <?php }?>      
                </tbody>
              </table>
             
          