
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<!-- start: EXPORT DATA TABLE PANEL  -->
			<div class="panel panel-white">
			    

<?php if($Warning=$this->session->flashdata("Warning")){
	echo "<div class='alert alert-danger'>".$Warning."</div>";
}?>
				<div class="panel-heading panel-red">
					<h4 class="panel-title"> <span class="text-bold">Today's Homework Detail</span></h4>
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
				<?php
				if($uri==1){ 
				?><div class="panel-body">
			<div class="table-responsive" id ="normal">
<table class="table table-striped table-hover"  id="sample-table-2">
    <thead>
        <tr style="background-color:#1ba593; color:white;">
            <th>Sno</th>
            <th>Class</th>
			<th>Total Subject</th>
            <th>Today's Given Homework</th>
			<th>Today's left Homework</th>
			<th>Activity</th>
        </tr>
    </thead><tbody>
<?php
$sno= 1;
foreach($class as $data)
            {
                $id=$data->id;
                $row1=$data->section;
                            $this->db->where('id',$row1);
                $section=   $this->db->get('class_section')->row();
                        $this->db->where('class_id',$id);
                        $this->db->where('fsd',$this->session->userdata('fsd'));
                        $this->db->where('status',1);
            $class_id=  $this->db->get('student_info');
			$this->db->where("class_id",$id);
			//$this->db->group_by("class_id");
		$result = $this->db->get("subject");
		$subject=$result->result();
		$subject_tot=$result->num_rows();
?>
 <?php if($sno%2==0){$rowcss="warning";}else{$rowcss ="danger";}?>
	   <tr class="<?php echo $rowcss;?> text-uppercase">
            <td><?php echo $sno;?></td>
            <td><input type = "hidden" id="classid<?php echo $sno;?>" value="<?php echo $id;?>"/>
									<?php echo $data->class_name;?><?php echo "[".$section->section . "]";?></td>
			<td><?php echo $subject_tot;
			/*echo "("; 
			foreach($subject as $subject1)
            {echo $subject1->subject.","; }
			echo ")"; */
			?></td>
            <td>
            <a href="<?php echo base_url();?>index.php/studentHWControllers/getStudentWork1/2/<?php echo $id;?>">
            <?php
            $school_code=$this->session->userdata("school_code");
			$date		=Date("Y-m-d");
                                	$this->db->where("workfor",'students');
            						$this->db->where("school_code",$school_code);
            						$this->db->where("Date(givenWorkDate)",$date);
            						$this->db->where("class_id",$id);
									$this->db->group_by("subject_id");
            				$v1 =  $this->db->get('homework_name');
									$this->db->where("workfor",'students');
            						$this->db->where("school_code",$school_code);
            						$this->db->where("Date(givenWorkDate)",$date);
            						$this->db->where("class_id",$id);
									$this->db->where("subject_id",0);
									$this->db->group_by("subject_id");
            				$v2 =  $this->db->get('homework_name');
            echo $g_hw=$v1->num_rows()-$v2->num_rows();
			echo "("; 
			
			foreach($v1->result() as $sub){
			if($sub->subject_id >0){
				  $this->db->where("id",$sub->subject_id);
		$result = $this->db->get("subject");
		
		foreach($result->result() as $subject1)
            {echo $subject1->subject." ,"; }
									}else{ echo "<label style='color:red;'>ALL SUBJECT ,</label>";}
									
			
			}echo ")";
			?></a>
            </td>
			<td><?PHP echo $subject_tot-$g_hw ; ?>
			<?php 
			/*echo  "("; 
			foreach($subject as $subject1)
            {echo $subject1->id.","; }
			echo ")"; */
			?></td>
			<td>
			   <?php if($v1->num_rows()>0){ ?>
			    <a href="#" style="color:white;" id="sms<?php echo $sno;?>" class="btn btn-warning">Send SMS</a></td>
			   
			  	  <?php }else{  ?>
			     <a href="#" style="color:white;"  class="btn btn-danger"> Homework Not Assign</a></td>
		
			    <?php }?>
			<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
			<script>
			  		$("#sms<?php echo $sno;?>").click(function(){
			  				var classid = $("#classid<?php echo $sno;?>").val();
					$.post("<?php echo site_url("index.php/studentHWControllers/hwSms") ?>",{classid : classid}, function(data){
						$("#sms<?php echo $sno;?>").html(data);
					});
																});
				</script>
        </tr>
			<?php  $sno++; } ?></tbody>
</table>
</div></div>
				<?php }else if($uri==2){ ?>
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
				<?php $school_code =$this->session->userdata("school_code");
			 $fsd = $this->session->userdata("fsd");
			?>
              <?php 
			  $school_code =  $this->session->userdata("school_code");
    	$date=Date("Y-m-d");
                    	$this->db->where("workfor",'students');
						$this->db->where("school_code",$school_code);
						$this->db->where("Date(givenWorkDate)",$date);
						$this->db->where("class_id",$classid);
				$va =  $this->db->get('homework_name');
    		if($va->num_rows()>0){
			$var1=$va->result();
        	?>
    	<div class="table-responsive" id ="normal">
    	<table class="table table-striped table-hover" id="sample-table-2">
    	<thead>
    	<tr>
        	<th>S.no.</th>
        	<th>Given By</th>
        	<th>Class</th>
        	<th>Assignment Title</th>
        	<th>Subject</th>
        	<th>Marks & Grade</th>
        	<th>Work Description</th>
        	<th>Given Date</th>
        	<th>Submission Date</th>
        	<!--<th>Action</th>-->
    	</tr>
    	</thead>
    	<tbody>
    	<?php
	      $count = 1;
				foreach($var1 as $lv):
				?>
					<tr>
			  			<td><?php echo $count;?></td>
			  			
			  			<td><?php $this->db->where("username",$lv->givenby);
			  			$emp_p = $this->db->get("employee_info");
			  			if($emp_p->num_rows()>0){
			  			    	echo $emp_p->row()->name."[".$emp_p->row()->username."]";
			  			}else{
			  			    	echo "Admin";
			  			}
			  		?></td>
						<td><?php
				  		        	$this->db->where("id",$lv->class_id);
                        	$var =  $this->db->get("class_info")->row();
                        	        $this->db->where("id",$var->section);
                        	$var1 = $this->db->get("class_section")->row();
                            if($lv->class_id==0){echo "No Record Found";}else{ echo $var->class_name."[". $var1->section."]";}
                            ?>
                            </td>
			  			<td><?php echo $lv->work_name;?></td>
			  			<td><?php $sub= $lv->subject_id;
			  			if($sub==0){
                            echo "for all subject";
                        }else{
                           $this->db->where("id",$sub);
						   $dt1= $this->db->get("subject")->row();
						   if($dt1){echo $dt1->subject;} else{ echo "N/A";}
                           
                        }
                        ?></td>
			  			<td><?php echo $lv->maximam_marks;?> ( <?php echo $lv->grade;?> )</td>
			  			<td style="max-width: 151px;"><?php echo $lv->workDiscription;?></td>
			  			<td><?php  echo $lv->givenWorkDate; ?></td>
						<td><?php echo $lv->DueWorkDate; ?></td>
						
			  		</tr>
			  		<?php $count++; endforeach; ?>
				</tbody>
			</table>
			</div>
			<script>
	TableExport.init();
</script>
			<?php 
	}
	
	else{
		echo "<div style='color:red;'>home Work not Assign.</div>";
	} ?>
				
					</div>
				<?php } ?>
				
				
				
				
				</div>
			</div>
			<!-- end: EXPORT DATA TABLE PANEL -->
		</div>
	</div>
	<!-- end: PAGE CONTENT-->
</div>