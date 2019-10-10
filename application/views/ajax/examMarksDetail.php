
<!--  
Niktech software Solutions,niktechsoftware.com,schoolerp-niktech.in
  <meta name="description" content="Welcome to niktech software School business ERP . we proving school management erp software. we including online attendance with biometric attendance machine and tracking student with GPS technology & many other facilities in our school management erp system">
  <meta name="keywords" content="Enterprise resource planning,school,ERP,system software,attendance,biometric,online, school management,gps,niktech software solution, online result, online admit card,omr">
  <meta name="author" content="School management System software">
-->
<?php $school_code=$this->session->userdata("school_code");?>
		
		<!--<form method="post" action="<?php //echo base_url();?>/index.php/examControllers/marksSave">-->
  <!--          <input type="hidden" name="teacherid" value="<?php //echo $t_id; ?>" />-->
  <!--          <input type="hidden" name="examid" value="<?php //echo $examid; ?>" />-->
           
  <!--          <input type="hidden" name="classid" value="<?php //echo $classid; ?>" />-->
  <!--          <input type="hidden" name="sectionid" value="<?php //echo $sectionid; ?>" />-->
  <!--          <input type="hidden" name="subjectid" value="<?php //echo $subjectid; ?>" />-->
  <!--          <input type="hidden" name="row" value="<?php //echo $num_row1; ?>" />-->
           
                     <?php 
                            $this->db->where('school_code',$school_code);
                           $this->db->where('id',$classid);
                          $classname=$this->db->get('class_info')->row()->class_name;

                           $this->db->where('school_code',$school_code);
                           $this->db->where('id',$sectionid);
                          $sectionname=$this->db->get('class_section')->row()->section;

                           $this->db->where('class_id',$classid);
                           $this->db->where('id',$subjectid);
                          $subjectname=$this->db->get('subject')->row()->subject;

                     ?>
                     <br><br>
 <table class="table table-striped table-bordered table-hover" >
                  <tr>

                    <th><?php echo $classname; ?> - <?php echo $sectionname; ?> - <?php echo $subjectname; ?></th>
                    <th><?php 
						date_default_timezone_set("Asia/Calcutta");
						$day = date('d-m-Y');
						echo date("l jS F, Y", strtotime("$day"));  
					
           $result1=$this->db->query("select * from exam_max_subject where exam_id='$examid'  and subject_id='$subjectid' and class_id='$classid' ORDER BY id");
            $result1=$result1->row();
           ?>
                    </th>
                  </tr>
              </table>
              <br><br>
                <?php  $fsd=$this->session->userdata('fsd');?>
              			<div class="table-responsive">
						<div class="table-responsive">
               <table class="table table-striped table-bordered table-hover" id="sample-table-2">
                <thead>
                  <tr>
                    <th>S.No</th>
                    <th>Student ID</th>
                    <th>Student Name</th>
                    <th>Attendance</th>
                    <th>Maximum Marks</th>
                  <th>Marks Obtained</th>
                   <th>Activity</th>
                  </tr>
                </thead>
                <tbody>
                <?php $i = 1;$j=1;
                     $this->db->where("status",1);
                      $this->db->where("class_id",$classid);

                      //$this->db->order_by("name","asc");

                    $num_row=$this->db->get("student_info");
                  //  print_r($num_row);exit();
                if($num_row->num_rows()>0){
                foreach ($num_row->result() as $stu):
                 $val=$this->db->query("select * from exam_info WHERE exam_id = '$examid' AND class_id='$classid' AND subject_id='$subjectid' AND fsd = '$fsd' and school_code='$school_code' AND stu_id='$stu->id'");
	        if($val->num_rows()>0){
	            $v=$val->row();
                
                ?>
                  <tr>
                    <td><?php echo $j; ?></td>
                    <td>
					 <input type="hidden" id="examid<?php echo $i; ?>" value="<?php echo $examid; ?>" />
                        <input type="hidden" id="stu_id<?php echo $i; ?>" value="<?php echo $stu->id; ?>" />
					<?php echo $stu->username; ?> </td>
                    <td ><span  style="text-transform:uppercase;"><?php echo $stu->name;?></span></td>
                     <?php if($v->Attendance==1)
                    { ?>
                   <td><?php echo 'P'?></td>
                    <?php }?>
                 <?php if($v->Attendance==0)
                 {?>
                  <td><?php echo 'A'?></td>
                  <?php }?> 
                
                 <?php if($result1)
                    { ?>
                    <td><?php echo $result1->max_m; ?></td>
                    <?php }?>
                      
                    <td><?php echo $v->marks;?></td>
					<td>
                     <button class="btn btn-red" id="deletemmarks1<?php echo $i;?>">Delete Marks<i class="fa fa-trash-o"></i>
                     </button>
                  </td>
                  </tr>
				  <script>
				  $("#deletemmarks1<?php echo $i;?>").click(function(){
                           var mmarks = $("#mammarks<?php echo $i; ?>").val();
							var classid = $("#classId").val();
							var stuid= $("#stu_id<?php echo $i; ?>").val();
							var marks = $("#mark<?php echo $i; ?>").val();
							var subjectid = $("#subjectId").val();
							var examid = $("#examid<?php echo $i; ?>").val();
							var attendence = $("input[name='attendence']:checked").val();
                    $.post("<?php echo site_url("index.php/examControllers/deletesubMarks") ?>",{examid:examid, attendence: attendence,stuid : stuid, marks : marks,mmarks:mmarks,classid:classid,subjectid:subjectid}, function(data){
                      $("#deletemmarks1<?php echo $i;?>").html(data);
                      alert('Marks Deleted Successfully');
                      $("#deletemmarks1<?php echo $i;?>").html();
                    });
                            
                 
                     }); 
				  </script> 
                  <?php  $j++; $i++; ?>
				  <?php
				  }else{?>
                   <tr>
                      <td><?php echo $j; ?></td>
                      <td>
                          <input type="hidden" id="examid<?php echo $i; ?>" value="<?php echo $examid; ?>" />
                        <input type="hidden" id="stu_id<?php echo $i; ?>" value="<?php echo $stu->id; ?>" />
                        <?php echo $stu->username; ?>
                      </td>
                      <td><?php echo $stu->name; ?></td>
                      <td class="hidden-xs text-center">
                      <label class="radio-inline">
                          <input class="radio" checked type="radio" id="Attendance<?php echo $i; ?>" name="attendence" value="1">
                        P 
                      </label>
                      <label class="radio-inline">
                          <input class="radio" type="radio" id="att<?php echo $i; ?>" name="attendence" value="0">
                            A
                      </label> 
                        </td>
                              

                      <td>
                          <?php 
                          if($result1)
                          { ?>
                        <input type="text" id="mammarks<?php echo $i;?>" value="<?php echo $m = $result1->max_m;?>" readonly  name="mammarks<?php echo $i; ?>"/>   
                         <?php 
                          }else
                            {
                              echo "<span style='color:red'>*Please define Maximum Marks*</span> ";
                            }
                                                
                          ?>
                      </td>
                      <td><input type="text" id="mark<?php echo $i; ?>" minlength="1" maxlength="3" onBlur="check<?php echo $i; ?>(); return false;"  onkeypress="return isNumber(event)" name="marks<?php echo $i; ?>"/></td>
                      
                      <td>
                		  <div class="invoice-buttons">
                            <input type="submit"  class="btn btn-dark-purple" value ="Insert Marks" id="submit<?php echo $i;?>"/>
                       </div>
                       </td>
                        </tr> 
        <script>

              $("#mark<?php echo $i; ?>").keyup(function(){
                  var max = Number ($('#mammarks<?php echo $i;?>').val());
                  var notmax =Number( $("#mark<?php echo $i; ?>").val());
                if(notmax > max){
                  $('#submit<?php echo $i;?>').hide();
                  alert("You can't fill greater than Maximum Marks " );
                }else{
                  $('#submit<?php echo $i;?>').show()
                }
                });


              $("#submit<?php echo $i;?>").click(function(){
                var mmarks = $("#mammarks<?php echo $i; ?>").val();
                var classid = $("#classId").val();
                var stuid= $("#stu_id<?php echo $i; ?>").val();
                var marks = $("#mark<?php echo $i; ?>").val();
                var subjectid = $("#subjectId").val();
                var examid = $("#examid<?php echo $i; ?>").val();
                var attendence = $("input[name='attendence']:checked").val();
    				    //alert(attendence);
    				    if(mmarks!="" && marks!=""){
    					$.post("<?php echo site_url("index.php/examControllers/insertMarksdetail") ?>",{examid:examid, attendence: attendence,stuid : stuid, marks : marks,mmarks:mmarks,classid:classid,subjectid:subjectid}, function(data){
    						$("#submit<?php echo $i;?>").val(data);
    						 $("#submit<?php echo $i;?>").show();

    					});
    				    }else{
    				        alert('Please fill all Boxes');
                }
                
                return false;
            });
            
		    

			


			
     /*      var abc = Number(getElementById("mark<?php echo $i; ?>").value);
             function check<?php echo $i; ?>(abc){
              if(mark<?php echo $i; ?>.value > Number(<?php echo $result1->max_m;?>)){
                alert("Marks Obtained can not be greater than Maximum Marks");
                setTimeout(function() {
                  document.getElementById('mark<?php echo $i; ?>').focus();
                }, 0);
                return false;
                  }
				} 
			
				function isNumber(evt) {
                                    evt = (evt) ? evt : window.event;
                                    var charCode = (evt.which) ? evt.which : evt.keyCode;
                                    if (charCode > 31 && (charCode < 48 || charCode > 57)) {
                                               alert("Please Input numbers only.");
                                                   setTimeout(function() {
                                          document.getElementById('mark<?php echo $i; ?>');
                }, 0);
                                                          return false;
                                    }
                                    return true;
                                }*/
			
                    </script>
            
                   
                               
                	                 
                	                  <?php $j++; $i++; }  endforeach;?>
                	                  	
             					
             						
             					 <br>
              			
		             	 <?php 
		                }else{
                    echo "Student Not Enrolled";}?> 
                    </tbody>    
		                	</table>
                    </div>
             						</div>
		                
         
            