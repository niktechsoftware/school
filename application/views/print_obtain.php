<style type="text/css">
    #printable { display: block; }
    @media print
    {
    	#non-printable { display: none; }
    	#printable { display: block; }
    }
</style>
<script>
    function autoResize(id){
        var newheight;
        var newwidth;

        if(document.getElementById){
            newheight=document.getElementById(id).contentWindow.document .body.scrollHeight;
            newwidth=document.getElementById(id).contentWindow.document .body.scrollWidth;
        }

        document.getElementById(id).height= (newheight) + "px";
        document.getElementById(id).width= (newwidth) + "px";
    }
</script>


<div class="row">
	<div class="col-sm-12">
		<!-- start: INLINE TABS PANEL -->
		<div class="panel panel-white">
			<div class="panel-heading">
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
							<a class="panel-refresh" href="#"> <i class="fa fa-refresh"></i> <span>Refresh</span> </a>
						</li>
						<li>
							<a class="panel-expand" href="#"> <i class="fa fa-expand"></i> <span>Fullscreen</span></a>
						</li>										
					</ul>
					</div>
				</div>
			</div>
			<div class="panel-body">
			       <?php
						$fsd =$this->session->userdata("fsd");
						$school_code=$this->session->userdata("school_code");
						$row2=$this->db->get('db_name')->row()->name;
               	 if($school_code == 1 && $row2=="D" || $school_code == 2 && $row2=="D" || $school_code == 3 && $row2=="D" || $school_code == 4 && $row2=="D" ){
					?>
					<!--kerala obtain mark list start(datatable)-->
					<?php	
								   $this->db->where('school_code',$school_code);
								   $this->db->where('id',$classid);
						$classname=$this->db->get('class_info')->row()->class_name;
								   $this->db->where('class_id',$classid);
								   $this->db->where('id',$subjectid);
					    $subjectname=$this->db->get('subject')->row()->subject;
						?>
                     <br><br>
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
					<div class="row">
                     	<div class="table-responsive">
							<table class="table table-striped table-bordered table-hover" id="sample-table-2">
							  <tr>
								<th><?php echo $classname; ?> - <?php //echo $sectionname; ?> - <?php echo $subjectname; ?></th>
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
                <?php  //$fsd=$this->session->userdata('fsd');?>
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
                <?php
					$i = 1;$j=1;
                      $this->db->where("status",1);
                      $this->db->where("class_id",$classid);
                      $this->db->order_by("name","asc");
                    $num_row=$this->db->get("student_info");
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
						 <input type="hidden" id="fsd<?php echo $i; ?>" value="<?php echo $fsd; ?>" />
                        <input type="hidden" id="classid<?php echo $i; ?>" value="<?php echo $classid; ?>" />
						<input type="hidden" id="subjectid<?php echo $i; ?>" value="<?php echo $subjectid; ?>" />
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
                    <td> <input type="text" id="mammarks<?php echo $i;?>" value="<?php echo $m = $result1->max_m;?>" readonly  name="mammarks<?php echo $i; ?>"/>  <?php //echo $result1->max_m; ?></td>
                    <?php }?>
                      
                    <td><input type="text" id="mark<?php echo $i; ?>"  name="marks<?php echo $i; ?>" value="<?php echo $v->marks; ?>" readonly /><?php //echo $v->marks;?></td>
					<td>
				  <?php $login_type=$this->session->userdata("login_type"); if($login_type == "admin"){ ?>
                     <button class="btn btn-danger" id="deletemmarks1<?php echo $i;?>">Delete Marks<i class="fa fa-trash-o"></i>
                     </button>
				  <?php } ?>
                  </td>
				</tr>
				  <script>
				  $("#deletemmarks1<?php echo $i;?>").click(function(){
                           var mmarks = $("#mammarks<?php echo $i; ?>").val();
							var classid = $("#classid<?php echo $i; ?>").val();
							var stuid= $("#stu_id<?php echo $i; ?>").val();
							var marks = $("#mark<?php echo $i; ?>").val();
							var subjectid = $("#subjectid<?php echo $i; ?>").val();
							var examid = $("#examid<?php echo $i; ?>").val();
							var attendence = $("input[name='attendence']:checked").val();
							//alert(classid +" "+ subjectid +" "+examid);
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
					<td><?php 
								$this->db->where("id",$examid);
						$term=  $this->db->get("exam_name")->row()->term;
							?>
							<input type="hidden" id="term<?php echo $i; ?>" value="<?php echo $term; ?>" />
							<input type="hidden" id="examid<?php echo $i; ?>" value="<?php echo $examid; ?>" />
							<input type="hidden" id="classid<?php echo $i; ?>" value="<?php echo $classid; ?>" />
							<input type="hidden" id="subjectid<?php echo $i; ?>" value="<?php echo $subjectid; ?>" />
							<input type="hidden" id="stu_id<?php echo $i; ?>" value="<?php echo $stu->id; ?>" />
							<?php echo $stu->username; ?>
					</td>
					<td><?php echo $stu->name; ?></td>
					<td class="hidden-xs text-center">
						<label class="radio-inline">
                          <input class="radio"  type="radio" id="Attendance<?php echo $i; ?>" name="attendence<?php echo $i; ?>" value="1" checked />
                        P 
						</label>
						<label class="radio-inline">
                          <input class="radio" type="radio" id="att<?php echo $i; ?>" name="attendence<?php echo $i; ?>" value="0">
                            A
						</label> 
					</td>
					<td><?php 
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
                    <td><div class="invoice-buttons">
						<input type="submit"  class="btn btn-info" value ="Insert Marks" id="submit<?php echo $i;?>"/>
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
                var classid = $("#classid<?php echo $i; ?>").val();
                var stuid= $("#stu_id<?php echo $i; ?>").val();
                var marks = $("#mark<?php echo $i; ?>").val();
                var subjectid = $("#subjectid<?php echo $i; ?>").val();
                var examid = $("#examid<?php echo $i; ?>").val();
                var term = $("#term<?php echo $i; ?>").val();
                var attendence = $("input[name='attendence<?php echo $i; ?>']:checked").val();
    				  // alert(marks +" "+ subjectid +" "+examid);
    				    if(mmarks!="" && marks!=""){
    					$.post("<?php echo site_url("index.php/examControllers/insertMarksdetail") ?>",{term:term,examid:examid, attendence: attendence,stuid : stuid, marks : marks,mmarks:mmarks,classid:classid,subjectid:subjectid}, function(data){
    						$("#submit<?php echo $i;?>").val(data);
    						 $("#submit<?php echo $i;?>").show();

    					});
    				    }else{
    				        alert('Please fill all Boxes');
                }
                
                return false;
            });
			
		</script>
			<?php $j++; $i++; }  endforeach; ?> <br>
			<?php  }else{
                    echo "Student Not Enrolled";}
			?> 
                    </tbody>    
					</table>
				</div>
			</div>
			</div></div>
				<script>
					TableExport.init();
				</script>
			<!--kerala obtain mark list end(datatable)-->
			<?php } else{ ?>
			<!--other obtain mark list start(print button)-->
				<div class="row">
					<div class="col-sm-12"><?php //$fsd =$this->session->userdata("fsd"); ?>
						<IFRAME SRC="<?php echo base_url(); ?>index.php/examControllers/print_obtain/<?php echo $fsd; ?>/<?php echo $examid; ?>/<?php echo $classid; ?>/<?php echo $subjectid; ?>/<?php echo $sub_type; ?>" width="100%" height="150px" id="iframe1" style="border: 1px;" onLoad="autoResize('iframe1');"></iframe>
					</div>
				</div>
			<!--other obtain mark list end(print button)-->
				<?php } ?>
				
			</div>
			<!-- end: INLINE TABS PANEL -->
		</div>
	</div>
	<!-- end: PAGE CONTENT-->
</div>