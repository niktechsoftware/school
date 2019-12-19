<?php
    $school_code = $this->session->userdata("school_code");
    $row2=$this->db->get('db_name')->row()->name;

if($school_code == 9 && $row2 == "A"){ ?>
<!DOCTYPE html
    PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>

    <meta http-equiv='Content-Type' content='text/html; charset=UTF-8' />

    <title>Fee Invoice</title>

    <link rel='stylesheet' type='text/css' href='<?php echo base_url(); ?>assets/css/invoice_css/style.css' />
    <link rel='stylesheet' type='text/css' href='<?php echo base_url(); ?>assets/css/invoice_css/print.css'
        media="print" />
		<link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/bootstrap/css/bootstrap.min.css">
    <script type='text/javascript' src='<?php echo base_url(); ?>assets/js/invoice_js/jquery-1.3.2.min.js'></script>
    <script type='text/javascript' src='<?php echo base_url(); ?>assets/js/invoice_js/example.js'></script>
    <style type="text/css">
    @media print {
        body * {
            visibility: hidden;
        }

        #printcontent * {
            visibility: visible;
        }

        #printcontent {
            position: absolute;
            top: 40px;
            left: 30px;
        }
    }

    .button {
        background-color: #4CAF50;
        /* Green */
        border: none;
        color: white;
        padding: 16px 32px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        font-size: 16px;
        margin: 4px 2px;
        -webkit-transition-duration: 0.4s;
        /* Safari */
        transition-duration: 0.4s;
        cursor: pointer;
    }


    .button2 {
        background-color: #008CBA;
        color: white;
        border: 2px solid #008CBA;
    }

    .button2:hover {
        background-color: #4CAF50;
        color: white;
        border: 2px solid #4CAF50;
    }
    </style>

</head>

<body>
    <div id="printcontent">
       <!-- <div id="page-wrap">-->
           <!--  
Niktech software Solutions,niktechsoftware.com,schoolerp-niktech.in
  <meta name="description" content="Welcome to niktech software School business ERP . we proving school management erp software. we including online attendance with biometric attendance machine and tracking student with GPS technology & many other facilities in our school management erp system">
  <meta name="keywords" content="Enterprise resource planning,school,ERP,system software,attendance,biometric,online, school management,gps,niktech software solution, online result, online admit card,omr">
  <meta name="author" content="School management System software">
-->
				<?php 	$school_code=$this->session->userdata("school_code");
						$fsd = $this->uri->segment(3);
						$examid = $this->uri->segment(4);
						$classid = $this->uri->segment(5);
						$subjectid = $this->uri->segment(6);
										$this->db->where('school_code',$school_code);
										$this->db->where('id',$classid);
						$classname= 	$this->db->get('class_info')->row()->class_name;
										$this->db->where('class_id',$classid);
										$this->db->where('id',$subjectid);
                        $subjectname=	$this->db->get('subject')->row()->subject;
				?>
                     <br><br>
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
								$this->db->order_by("name","asc");
								$this->db->where("status",1);
								$this->db->where("class_id",$classid);
                    $num_row=	$this->db->get("student_info");
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
             						</div>
             						 <script>
                      	Main.init();
        				// SVExamples.init();
        				// FormElements.init();
        				TableExport.init();
        				// UIModals.init();
                  </script>


        <!--</div>-->
    </div>
<div class="invoice-buttons" style="text-align:center;">
    <button class="button button2" type="button" onclick="window.print();">
        <i class="fa fa-print padding-right-sm"></i> Print
    </button>
</div>
</body>
</html>
<?PHP }else{ ?>

<!DOCTYPE html
    PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>

    <meta http-equiv='Content-Type' content='text/html; charset=UTF-8' />

    <title>Fee Invoice</title>

    <link rel='stylesheet' type='text/css' href='<?php echo base_url(); ?>assets/css/invoice_css/style.css' />
    <link rel='stylesheet' type='text/css' href='<?php echo base_url(); ?>assets/css/invoice_css/print.css'
        media="print" />
		<link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/bootstrap/css/bootstrap.min.css">
    <script type='text/javascript' src='<?php echo base_url(); ?>assets/js/invoice_js/jquery-1.3.2.min.js'></script>
    <script type='text/javascript' src='<?php echo base_url(); ?>assets/js/invoice_js/example.js'></script>
    <style type="text/css">
    @media print {
        body * {
            visibility: hidden;
        }

        #printcontent * {
            visibility: visible;
        }

        #printcontent {
            position: absolute;
            top: 40px;
            left: 30px;
        }
    }

    .button {
        background-color: #4CAF50;
        /* Green */
        border: none;
        color: white;
        padding: 16px 32px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        font-size: 16px;
        margin: 4px 2px;
        -webkit-transition-duration: 0.4s;
        /* Safari */
        transition-duration: 0.4s;
        cursor: pointer;
    }


    .button2 {
        background-color: #008CBA;
        color: white;
        border: 2px solid #008CBA;
    }

    .button2:hover {
        background-color: #4CAF50;
        color: white;
        border: 2px solid #4CAF50;
    }
    </style>

</head>

<body>
    <div id="printcontent">
       <!-- <div id="page-wrap">-->
           <!--  
Niktech software Solutions,niktechsoftware.com,schoolerp-niktech.in
  <meta name="description" content="Welcome to niktech software School business ERP . we proving school management erp software. we including online attendance with biometric attendance machine and tracking student with GPS technology & many other facilities in our school management erp system">
  <meta name="keywords" content="Enterprise resource planning,school,ERP,system software,attendance,biometric,online, school management,gps,niktech software solution, online result, online admit card,omr">
  <meta name="author" content="School management System software">
-->
				<?php 	$school_code=$this->session->userdata("school_code");
						$fsd = $this->uri->segment(3);
						$examid = $this->uri->segment(4);
						$classid = $this->uri->segment(5);
						$subjectid = $this->uri->segment(6);
						$sub_type = $this->uri->segment(7);
										$this->db->where('school_code',$school_code);
										$this->db->where('id',$classid);
						$classname= 	$this->db->get('class_info')->row()->class_name;
										$this->db->where('class_id',$classid);
										$this->db->where('id',$subjectid);
                        $subjectname=	$this->db->get('subject')->row()->subject;
				?>
                     <br><br>
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
							<th>Subject Type</th>
							<th>Maximum Marks</th>
							<th>Marks Obtained</th>
						   <th>Activity</th>
						</tr>
					</thead>
                <tbody>
                <?php
                $i = 1;$j=1;
								$this->db->order_by("name","asc");
								$this->db->where("status",1);
								$this->db->where("class_id",$classid);
                    $num_row=	$this->db->get("student_info");
                if($num_row->num_rows()>0){
                foreach ($num_row->result() as $stu):
                 $val=$this->db->query("select * from exam_info WHERE exam_id = '$examid' AND class_id='$classid' AND subject_id='$subjectid' AND sub_type='$sub_type' AND fsd = '$fsd' and school_code='$school_code' AND stu_id='$stu->id'");
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
						<input type="hidden" id="sub_type<?php echo $i; ?>" value="<?php echo $sub_type; ?>" />
					<?php echo $stu->username; ?> </td>
                    <td ><span  style="text-transform:uppercase;"><?php echo $stu->name;?></span></td>
                     <?php if($v->Attendance==1){ ?>
					<td><?php echo 'P'?></td><?php }?>
					<?php if($v->Attendance==0){ ?>
					<td><?php echo 'A'?></td><?php }?>
					<td><?php echo $sub_type; ?></td>					
					<?php if($result1){ ?>
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
							<input type="hidden" id="sub_type<?php echo $i; ?>" value="<?php echo $sub_type; ?>" />
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
                              
						<td><?php echo $sub_type; ?></td>
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
				var sub_type = $("#sub_type<?php echo $i; ?>").val();
                var examid = $("#examid<?php echo $i; ?>").val();
                var term = $("#term<?php echo $i; ?>").val();
                var attendence = $("input[name='attendence<?php echo $i; ?>']:checked").val();
    				   alert(marks +" "+ sub_type +" "+mmarks);
    				    if(mmarks!="" && marks!=""){
    					$.post("<?php echo site_url("index.php/examControllers/insertMarksdetail") ?>",{sub_type:sub_type,term:term,examid:examid, attendence: attendence,stuid : stuid, marks : marks,mmarks:mmarks,classid:classid,subjectid:subjectid}, function(data){
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
             						</div>
             						 <script>
                      	Main.init();
        				// SVExamples.init();
        				// FormElements.init();
        				TableExport.init();
        				// UIModals.init();
                  </script>


        <!--</div>-->
    </div>
<div class="invoice-buttons" style="text-align:center;">
    <button class="button button2" type="button" onclick="window.print();">
        <i class="fa fa-print padding-right-sm"></i> Print
    </button>
</div>
</body>
</html>

<?PHP } ?>