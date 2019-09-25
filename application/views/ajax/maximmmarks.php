<!--  
Niktech software Solutions,niktechsoftware.com,schoolerp-niktech.in
  <meta name="description" content="Welcome to niktech software School business ERP . we proving school management erp software. we including online attendance with biometric attendance machine and tracking student with GPS technology & many other facilities in our school management erp system">
  <meta name="keywords" content="Enterprise resource planning,school,ERP,system software,attendance,biometric,online, school management,gps,niktech software solution, online result, online admit card,omr">
  <meta name="author" content="School management System software">
-->
<?php $school_code=$this->session->userdata("school_code");?>
		 <?php 
                            $this->db->where('school_code',$school_code);
                           $this->db->where('id',$classid);
                          $classname=$this->db->get('class_info')->row()->class_name;

                           $this->db->where('school_code',$school_code);
                           $this->db->where('id',$sectionid);
                          $sectionname=$this->db->get('class_section')->row()->section;
                         
                          if($subjectid=="all"){?>
	
            <table class="table table-striped table-bordered table-hover" id="datatable">
                   <tr>
                    <th><?php echo $classname; ?> - <?php echo $sectionname; ?> - <?php echo  "All Subject"; ?></th>
                    <th><?php 
					    	date_default_timezone_set("Asia/Calcutta");
					     	$day = date('d-m-Y');
						    echo date("l jS F, Y", strtotime("$day"));  
					        ?>
                    </th>
                  </tr>
              </table>
              <br><br>
                
               <table class="table table-striped table-bordered table-hover" id="sample-table-2">
                <thead>
                  <tr>
                    <th>S.No</th>
                    <th>Exam Name</th>
                    <th>Class Name </th>
                    <th>Subject Name</th>
                    <th>Grade Or Marks</th>
                    <th>Maximum Marks</th>
                   <th>Activity</th>
                  </tr>
                </thead>
                
                    <?php 
                $this->db->where('class_id',$classid);
               $subname=$this->db->get('subject');
               
                     $i=1;
            foreach($subname->result() as $subject){
               
                   $subjectid=$subject->id;
                    $val=$this->db->query("select * from exam_max_subject WHERE exam_id = '$examid' AND class_id='$classid' AND subject_id='$subjectid' order by id");
                    // print_r($val->result());exit;
                    if($val->num_rows()>0){
            ?>
            <tbody>
                <tr>
                 <td><?php echo $i; ?></td>

            <?php
              $this->db->where('school_code',$school_code);
            $this->db->where('id',$val->row()->exam_id);
            $examname=$this->db->get('exam_name')->row()->exam_name;
                 ?>
                  <td><?php echo  $examname; ?> </td>               	
						      <td><?php echo  $classname; ?> </td>
                  <td><?php echo  $subject->subject;?></td>
                  <?php if($val->row()->marks_grade==1)
                  { ?>
                   <td><?php echo 'Marks'?></td>
                   <td>
                 <input type="text" id="mmmark<?php echo $i;?>" pattern="[0-9]{3}" minlength="1" maxlength="3" value="<?php echo $val->row()->max_m;?>" required />     
                 </td>
                    <?php }?>
                 <?php if($val->row()->marks_grade==0)
                 {?>
                  <td><?php echo 'Grade'?></td>
                  <td>
                 <input type="text" id="mmmark<?php echo $i;?>" class="text-uppercase" pattern="[A-Za-z]{1}" minlength="1" maxlength="6"  value="<?php echo $val->row()->max_m;?>" required />     
                 </td>
                  <?php }?>             
  					     
                 <td><button class="btn btn-red" id="updtmmarks<?php echo $i;?>">Update Your Marks<i class="fa fa-arrow-circle-right"></i>
                     </button>
                     <button class="btn btn-red" id="deletemmarks<?php echo $i;?>">Delete Marks<i class="fa fa-trash-o"></i>
                     </button>
                  </td>
                  <input type="hidden" id="viid<?php echo $i;?>" value="<?php echo $val->row()->id; ?>" />
                  <input type="hidden" id="examid1<?php echo $i;?>" value="<?php echo $examid; ?>" />
                      <input type="hidden" id="classid1<?php echo $i;?>" value="<?php echo $classid; ?>" />
                    
                      <input type="hidden" id="subjectid1<?php echo $i;?>" value="<?php echo $subjectid; ?>" />
                    </tr>
                 </tbody>
                  <?php  }else{?>  
               
                   <input type="hidden" id="examid<?php echo $i;?>" value="<?php echo $examid; ?>" />
                      <input type="hidden" id="classid<?php echo $i;?>" value="<?php echo $classid; ?>" />
                     <input type="hidden" id="sectionid" value="<?php echo $sectionid; ?>" />
                      <input type="hidden" id="subjectid<?php echo $i;?>" value="<?php echo $subjectid; ?>" />
                      <tbody>
    	                  <tr>
    	                    <td><?php echo $i; ?></td>
                          <?php  
                           $this->db->where('school_code',$school_code);
                           $this->db->where('id',$examid);
                           $examname=$this->db->get('exam_name')->row()->exam_name; ?>
    	                     <td><?php echo  $examname; ?> </td>                         
                            <td><?php echo  $classname; ?> </td>
                            <td><?php echo  $subject->subject;?></td>
                            <td><select name="marks_grade" id="marks_grade<?php echo $i;?>" required>
                            <option value="a">--select-- </option>
                            <option value="1">Marks</option>
                             <option value="0">Grade</option> 
                            </select></td>                                  
    	                     <td><input type="text" id="mark<?php echo $i;?>"  onkeypress="return isNumber(event)"  name="marks" required /></td>           
                 	        <td>
                	         <button class="btn btn-green" id="savemax<?php echo $i;?>">Save Maximum Marks<i class="fa fa-arrow-circle-save"></i>
                             </button>
                                <!--<input type="hidden" id="id<?php echo $i;?>"/>-->
                          </td>
                             </tr>
                             </tbody>
                      <?php }?>
                      <script type="text/javascript">
                            $("#savemax<?php echo $i;?>").click(function(){
                                
                                var examid = $("#examid<?php echo $i;?>").val();
                                var classid = $("#classid<?php echo $i;?>").val();
                                var mark = $("#mark<?php echo $i;?>").val();
                               var subjectid = $("#subjectid<?php echo $i;?>").val();
                               var marks_grade = $("#marks_grade<?php echo $i;?>").val();
            
                               if(marks_grade!="a" && mark!=""){
                           if(marks_grade==0){
                              
                               if(mark.match(/[A-Za-z]$/)){
                                  
                       // alert(examid+classid+mark+subjectid+marks_grade);
                      $.post("<?php echo site_url("index.php/examControllers/maximarks") ?>",{examid : examid,classid : classid,mark : mark,subjectid : subjectid,marks_grade : marks_grade}, function(data){
                        $("#savemax").html(data);
                          alert('Maximum Marks Save Successfully');
                           $("#savemax").html();
                         // window.location.reload();
                        });
                               }else{
                                   alert('Please fill Only Character');
                               }
                           }else{
                               if(mark.match(/[0-9]$/)){
                       // alert(examid+classid+mark+subjectid+marks_grade);
                      $.post("<?php echo site_url("index.php/examControllers/maximarks") ?>",{examid : examid,classid : classid,mark : mark,subjectid : subjectid,marks_grade : marks_grade}, function(data){
                        $("#savemax").html(data);
                          alert('Maximum Marks Save Successfully');
                           $("#savemax").html();
                         // window.location.reload();
                        });
                               }else{
                                   alert('Please fill Only Number');
                               }
                           }
                       }else{
                           alert('Please fill all Boxes');
                       }
                     });  

                        $("#updtmmarks<?php echo $i;?>").click(function(){
                            var mark = $("#mmmark<?php echo $i;?>").val();
                            var examid = $("#examid1<?php echo $i;?>").val();
                            var classid = $("#classid1<?php echo $i;?>").val();
                            var subjectid = $("#subjectid1<?php echo $i;?>").val();
                            var viid = $("#viid<?php echo $i;?>").val();
                            if(mark!=""){
                                //alert(mark+viid);
                    $.post("<?php echo site_url("index.php/examControllers/updatesubmaxiMarks") ?>",{mark : mark,viid : viid, examid : examid, classid : classid, subjectid : subjectid,}, function(data){
                    
                      alert('Maximum Marks Updated Successfully');
                      $("#updtmmarks<?php echo $i;?>").html(data);
                      // $("#updtmmarks<?php echo $i;?>").hide();
                        //window.location.reload();
                    });
                            }else{
                                alert('Please fill Marks');
                            }
                 
                     });  

                     $("#deletemmarks<?php echo $i;?>").click(function(){
                            var mark = $("#mmmark<?php echo $i;?>").val();
                            var examid = $("#examid1<?php echo $i;?>").val();
                            var classid = $("#classid1<?php echo $i;?>").val();
                            var subjectid = $("#subjectid1<?php echo $i;?>").val();
                            var viid = $("#viid<?php echo $i;?>").val();
                            if(mark!=""){
                                //alert(mark+viid);
                    $.post("<?php echo site_url("index.php/examControllers/deletesubmaxiMarks") ?>",{mark : mark,viid : viid, examid : examid, classid : classid, subjectid : subjectid,}, function(data){
                     
                      $("#deletemmarks<?php echo $i;?>").html(data);
                      alert('Maximum Marks Deleted Successfully');
                      $("#deletemmarks<?php echo $i;?>").html();
                     // $("#mmmark<?php echo $i;?>").show();
                      // $("#updtmmarks<?php echo $i;?>").hide();
                       // window.location.reload();
                    });
                            }else{
                                alert('Please fill Marks');
                            }
                 
                     });  
                </script>
        	    <?php $i++; }?>
        	   </table>
        	   
		       
                         <?php     
                         }else{
                             $this->db->where('class_id',$classid);
                           $this->db->where('id',$subjectid);
                           $subjectname=$this->db->get('subject')->row()->subject;
                         

                     ?>
                      <table class="table table-striped table-bordered table-hover" id="datatable">
<tr>
                    <th><?php echo $classname; ?> - <?php echo $sectionname; ?> - <?php echo  $subjectname; ?></th>
                    <th><?php 
					    	date_default_timezone_set("Asia/Calcutta");
					     	$day = date('d-m-Y');
						    echo date("l jS F, Y", strtotime("$day"));  
					        ?>
                    </th>
                  </tr>
              </table>
              <br><br>
                <?php 
              $val=$this->db->query("select * from exam_max_subject WHERE exam_id = '$examid' AND class_id='$classid' AND subject_id='$subjectid' order by id");
              		// print_r($val->result());exit;
              		?>
               <table class="table table-striped table-bordered table-hover" id="sample-table-2">
                <thead>
                  <tr>
                    <th>S.No.</th>
                    <th>Exam Name</th>
                    <th>Class Name </th>
                    <th>Subject Name</th>
                    <th>Grade Or Marks</th>
                    <th>Maximum Marks</th>
                   <th>Activity</th>
                  </tr>
                </thead>
                <tbody>
                <?php $i = 1;?>
                <?php 
                if($val->num_rows()>0)
                { 
            $this->db->where('school_code',$school_code);
            $this->db->where('id',$val->row()->exam_id);
            $examname=$this->db->get('exam_name')->row()->exam_name;
               ?>
                <tr>
           <td>
               <?php echo 1; ?> </td>
                  <td><?php echo  $examname; ?> </td>               	
						      <td><?php echo  $classname; ?> </td>
                  <td><?php echo  $subjectname;?></td>
                  <?php if($val->row()->marks_grade==1)
                  { ?>
                   <td><?php echo 'Marks'?></td>
                   <td>
                 <input type="text" id="mmmark<?php echo $i;?>" pattern="[0-9]{3}" minlength="1" maxlength="3" value="<?php echo $val->row()->max_m;?>" required />     
                 </td>
                    <?php }?>
                 <?php if($val->row()->marks_grade==0)
                 {?>
                  <td><?php echo 'Grade'?></td>
                  <td>
                 <input type="text" id="mmmark<?php echo $i;?>" class="text-uppercase" pattern="[A-Za-z]{1}" minlength="1" maxlength="6"  value="<?php echo $val->row()->max_m;?>" required />     
                 </td>
                  <?php }?>             
                 <td><button class="btn btn-red" id="updtmmarks">Update Your Marks<i class="fa fa-arrow-circle-right"></i>
                     </button>
                     <button class="btn btn-red" id="deletemmarks">Delete Marks<i class="fa fa-trash-o"></i>
                     </button>
                  </td>
                  <input type="hidden" id="viid" value="<?php echo $val->row()->id; ?>" />
                  <input type="hidden" id="classid1" value="<?php echo $classid; ?>" />
                <input type="hidden" id="examid1" value="<?php echo $examid; ?>" />
                <input type="hidden" id="subjectid1" value="<?php echo $subjectid; ?>" />
                    </tr>
                  
                 
                    </tbody> 
              <?php  }               
                else
                {
                ?>              
                <input type="hidden" id="examid" value="<?php echo $examid; ?>" />
                <input type="hidden" id="classid" value="<?php echo $classid; ?>" />
                <input type="hidden" id="sectionid" value="<?php echo $sectionid; ?>" />
                <input type="hidden" id="subjectid" value="<?php echo $subjectid; ?>" />
                  <tr>
                    <td><?php echo "1"; ?></td>
                  <?php  
                   $this->db->where('school_code',$school_code);
                   $this->db->where('id',$examid);
                   $examname=$this->db->get('exam_name')->row()->exam_name; ?>
                      <td><?php echo  $examname; ?> </td>                         
                    <td><?php echo  $classname; ?> </td>
                    <td><?php echo  $subjectname;?></td>
                    <td><select name="marks_grade" id="marks_grade" required>
                    <option value="a">--select-- </option>
                    <option value="1">Marks</option>
                     <option value="0">Grade</option> 
                    </select></td>                                  
                     <td><input type="text" id="mark" class="text-uppercase" onkeypress="return isNumber(event)"  name="marks" required /></td>           
         	             <td>
        	         <button class="btn btn-green" id="savemax">Save Maximum Marks<i class="fa fa-arrow-circle-save"></i>
                  </button>
                  </td>
                     </tr>
                  <?php }?>
    	       </table>
		                	                
		       <script type="text/javascript">
                    $("#savemax").click(function(){
                        var examid = $("#examid").val();
                        var classid = $("#classid").val();
                        var mark = $("#mark").val();
                       var subjectid = $("#subjectid").val();
                       var marks_grade = $("#marks_grade").val();
                      // alert(marks_grade);
                       if(marks_grade!="a" && mark!=""){
                           if(marks_grade==0){
                               if(mark.match(/[A-Za-z]$/)){
                                  
                       // alert(examid+classid+mark+subjectid+marks_grade);
                      $.post("<?php echo site_url("index.php/examControllers/maximarks") ?>",{examid : examid,classid : classid,mark : mark,subjectid : subjectid,marks_grade : marks_grade}, function(data){
                        $("#savemax").html(data);
                          alert('Maximum Marks Save Successfully');
                           $("#savemax").html();
                         // window.location.reload();
                        });
                               }else{
                                   alert('Please fill Only Character');
                               }
                           }else{
                               if(mark.match(/[0-9]$/)){
                       // alert(examid+classid+mark+subjectid+marks_grade);
                      $.post("<?php echo site_url("index.php/examControllers/maximarks") ?>",{examid : examid,classid : classid,mark : mark,subjectid : subjectid,marks_grade : marks_grade}, function(data){
                        $("#savemax").html(data);
                          alert('Maximum Marks Save Successfully');
                           $("#savemax").html();
                         // window.location.reload();
                        });
                               }else{
                                   alert('Please fill Only Number');
                               }
                           }
                       }else{
                           alert('Please fill all Boxes');
                       }
                     });  

                        $("#updtmmarks").click(function(){
                            var mark = $("#mmmark<?php echo $i;?>").val();
                            var examid = $("#examid1").val();
                            var classid = $("#classid1").val();
                            var subjectid = $("#subjectid1").val();
                           // var marks_grade = $("#marks_grade").val();
                            var viid = $("#viid").val();
                            //alert(mark);
                            if(mark!=""){
                                //alert(mark+viid);
                            $.post("<?php echo site_url("index.php/examControllers/updatesubmaxiMarks") ?>",{mark : mark,viid : viid,examid : examid, classid : classid, subjectid : subjectid,}, function(data){
                            $("#updtmmarks").html(data);
                              alert('Maximum Marks Updated Successfully');
                               $("#updtmmarks").html();
                                //window.location.reload();
                            });
                            }else{
                                alert('Please fill Marks');
                            }
                     });  
                     $("#deletemmarks").click(function(){
                            var mark = $("#mmmark<?php echo $i;?>").val();
                            var examid = $("#examid1").val();
                            var classid = $("#classid1").val();
                            var subjectid = $("#subjectid1").val();
                            var viid = $("#viid").val();
                            if(mark!=""){
                                alert(subjectid+classid+examid );
                    $.post("<?php echo site_url("index.php/examControllers/deletesubmaxiMarks") ?>",{mark : mark,viid : viid, examid : examid, classid : classid, subjectid : subjectid,}, function(data){
                     
                      $("#deletemmarks").html(data);
                      alert('Maximum Marks Deleted Successfully');
                      $("#deletemmarks").html();
                     // $("#mmmark<?php echo $i;?>").show();
                      // $("#updtmmarks<?php echo $i;?>").hide();
                       // window.location.reload();
                    });
                            }else{
                                alert('Please fill Marks');
                            }
                 
                     });  
                </script>
                <?php } ?>
                  


        