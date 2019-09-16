<?php
class periodTimeControllers extends CI_Controller{
    
    	function __construct(){
		parent::__construct();
		$this->load->model("periodmodel");
			$this->is_login();
		
	}
		function is_login(){
		$is_login = $this->session->userdata('is_login');
	
		if(($is_login != true)){
			
			redirect("index.php/homeController/index");
		}
	
	}
	function startScheduling(){
		$period_name = $this->input->post("periodName");
	    //print_r($period_name);exit;
		$pdate = $this->input->post("pdate");
		
	   $data['period_name'] = $period_name;
   //print_r($data);exit();
	   $data['pdate'] = $pdate;
	   $data['pageTitle'] = 'Period Scheduling';
	   $data['smallTitle'] = 'Period Scheduling';
	   $data['mainPage'] = 'Period Scheduling';
	   $data['subPage'] = 'Period Scheduling';
	   //$this->load->model("examModel");
	   $var=$this->periodmodel->getPeriodD($period_name);
	   //print_r($var->result());
	    $data['request']=$var->result();
	//    $count = $this->db->count_all("no_of_period");
	   
	//    $data['i']=$count;
	   
	   $data['title'] = 'Period Scheduling';
	   $data['headerCss'] = 'headerCss/periodTimeCss';
	   $data['footerJs'] = 'footerJs/periodTimeJs';
	   $data['mainContent'] = 'periodScheduling';
	   $this->load->view("includes/mainContent", $data);
	}

	function period_no(){
		$name=$this->input->post("periodName");
		$date=$this->input->post("datet");
		$data=array(
			'period_name'=>$name,
			'created_date'=>$date,
			'school_code'=>$this->session->userdata('school_code')
		);
		$var=$this->db->insert('no_of_period',$data);
		if($var)
		{
			redirect("index.php/login/periodTimeSlot");
		}	
	}
	function deleteperiod(){
		$id=$this->uri->segment('3');
		//print_r($id);exit;
		$this->db->where('id',$id);
		$this->db->delete('no_of_period');
		
		$data['pageTitle'] = 'Time table';
		$data['smallTitle'] = 'Time table';
		$data['mainPage'] = 'Period Time Scheduling';
		$data['subPage'] = 'Time table';
		$this->load->model("periodModel");
		$req=$this->periodModel->getperiodno();
		//print_r($req->result());exit;
		$data['request']=$req->result();
		$data['v']=false;
		$data['v'] = $this->uri->segment(3);
		$data['title'] = 'Period Time Scheduling';
		$data['headerCss'] = 'headerCss/periodTimeCss';
		$data['footerJs'] = 'footerJs/periodTimeJs';
		$data['mainContent'] = 'periodTimeSlot';
		$this->load->view("includes/mainContent", $data);
	}

	function updateTBSubject(){
		$monday = $this->input->post("monday");
	$tuesday =$this->input->post("tuesday");
	$wednesday = $this->input->post("wednesday");
	$thursday = $this->input->post("thursday");
	$friday = $this->input->post("friday");
	$saturday = $this->input->post("saturday");
	$tb_id=$this->input->post("tb_id");
	$subjectid=$this->input->post("subjectid");
	$classid=$this->input->post("classid");
	$periodid=$this->input->post("periodid");

	$this->db->where("time_thead_id",$tb_id);
	$this->db->where("class_id",$classid);
	$this->db->where("period_id",$periodid);
	$checktbteacher=$this->db->get("time_table");
	if($checktbteacher->num_rows()>0){
		$data = array(
			
			"subject_id"		=>$subjectid
			
		);
		$this->db->where("id",$checktbteacher->row()->id);
		$this->db->update("time_table",$data);
		$tbr_id = $checktbteacher->row()->id;
		if($monday){
			//echo "rahul";
			$var = $this->periodmodel->checkdaystb($monday,$tbr_id);
		}
		if($tuesday){
			$var =$this->periodmodel->checkdaystb($tuesday,$tbr_id);
		}
		if($wednesday){
			$var =$this->periodmodel->checkdaystb($wednesday,$tbr_id);
		}
		if($thursday){
			$var =$this->periodmodel->checkdaystb($thursday,$tbr_id);
		}
		if($friday){
			$var =$this->periodmodel->checkdaystb($friday,$tbr_id);
		}
		if($saturday){
			$var = $this->periodmodel->checkdaystb($saturday,$tbr_id);
		}
		
	}else{

		$data = array(
			"time_thead_id"	=>$tb_id,
			"class_id"		=>$classid,
			"period_id"		=>$periodid,
			"subject_id"		=>$subjectid
			
		);
		$this->db->insert("time_table",$data);

		$this->db->where("time_thead_id",$tb_id);
	$this->db->where("class_id",$classid);
	$this->db->where("period_id",$periodid);
	$checktbteacher=$this->db->get("time_table");
if($checktbteacher->num_rows()>0){
	$tbr_id = $checktbteacher->row()->id;
		if($monday){
			$var =$this->periodmodel->checkdaystb($monday,$tbr_id);
		}
		if($tuesday){
			$var =$this->periodmodel->checkdaystb($tuesday,$tbr_id);
		}
		if($wednesday){
			$var =$this->periodmodel->checkdaystb($wednesday,$tbr_id);
		}
		if($thursday){
			$var =$this->periodmodel->checkdaystb($thursday,$tbr_id);
		}
		if($friday){
			$var =$this->periodmodel->checkdaystb($friday,$tbr_id);
		}
		if($saturday){
			$var =$this->periodmodel->checkdaystb($saturday,$tbr_id);
		}
		
	}
	}
echo '<div class="alert alert-warning">Subject is added into time table are Successfully done!!!!</div>';
	}
function updateTBTeacher(){
	$monday = $this->input->post("monday");
	$tuesday =$this->input->post("tuesday");
	$wednesday = $this->input->post("wednesday");
	$thursday = $this->input->post("thursday");
	$friday = $this->input->post("friday");
	$saturday = $this->input->post("saturday");
	$tb_id=$this->input->post("tb_id");
	$teacherid=$this->input->post("teacherid");
	$classid=$this->input->post("classid");
	$periodid=$this->input->post("periodid");

	$this->db->where("time_thead_id",$tb_id);
	$this->db->where("class_id",$classid);
	$this->db->where("period_id",$periodid);
	$checktbteacher=$this->db->get("time_table");
	if($checktbteacher->num_rows()>0){
		$data = array(
			
			"teacher"		=>$teacherid
			
		);
		$this->db->where("id",$checktbteacher->row()->id);
		$this->db->update("time_table",$data);
		$tbr_id = $checktbteacher->row()->id;
		if($monday){
			//echo "rahul";
			$var = $this->periodmodel->checkdaystb($monday,$tbr_id);
		}
		if($tuesday){
			$var =$this->periodmodel->checkdaystb($tuesday,$tbr_id);
		}
		if($wednesday){
			$var =$this->periodmodel->checkdaystb($wednesday,$tbr_id);
		}
		if($thursday){
			$var =$this->periodmodel->checkdaystb($thursday,$tbr_id);
		}
		if($friday){
			$var =$this->periodmodel->checkdaystb($friday,$tbr_id);
		}
		if($saturday){
			$var = $this->periodmodel->checkdaystb($saturday,$tbr_id);
		}
		
	}else{

		$data = array(
			"time_thead_id"	=>$tb_id,
			"class_id"		=>$classid,
			"period_id"		=>$periodid,
			"teacher"		=>$teacherid
			
		);
		$this->db->insert("time_table",$data);
		$this->db->where("time_thead_id",$tb_id);
	$this->db->where("class_id",$classid);
	$this->db->where("period_id",$periodid);
	$checktbteacher=$this->db->get("time_table");
if($checktbteacher->num_rows()>0){
	$tbr_id = $checktbteacher->row()->id;
		if($monday){
			$var =$this->periodmodel->checkdaystb($monday,$tbr_id);
		}
		if($tuesday){
			$var =$this->periodmodel->checkdaystb($tuesday,$tbr_id);
		}
		if($wednesday){
			$var =$this->periodmodel->checkdaystb($wednesday,$tbr_id);
		}
		if($thursday){
			$var =$this->periodmodel->checkdaystb($thursday,$tbr_id);
		}
		if($friday){
			$var =$this->periodmodel->checkdaystb($friday,$tbr_id);
		}
		if($saturday){
			$var =$this->periodmodel->checkdaystb($saturday,$tbr_id);
		}
		
	}
	}
echo '<div class="alert alert-info">Teacher is added into time table are Successfully done!!!!</div>';
}

	function updatePeriod(){
		$i=1;
		$tb_id=$this->input->post("tb_id");
		//$period_name = $this->input->post("periodName");
		$num=$this->input->post("nop");
		$this->db->where("school_code",$this->session->userdata("school_code"));
		$this->db->where("nop_id",$tb_id);
		$request = $this->db->get("period")->result();
		//print_r($period_name);
		?>
			<div class="panel">
				<div class="panel-heading panel-blue border-light">
					<h4 class="panel-title">Create Periods Time Slot</h4>
				</div>
				<div class="panel-body" >
					<table class="table table-bordered table-hover ">
						<thead>
							<tr>
								<th>S.No.</th>
								<th>Name Of Period (Like 1st,2nd,3rd)</th>
								<th>Time Slots</th>
							</tr>
						</thead><?php foreach($request as $row):
						?>
		        		<tbody>
		        			<tr>
		        				<td><?php echo $i; ?></td>
		            			<td>
		            				<table width="80%">
		                				<tr>
		                    				<td>
		                        			<input type="text" class="form-control" required="required" width:100px;" name="period<?php echo $i; ?>" value="<?php echo $row->period; ?>"/>
	                            			</td>
                                			<?php 
											$a = $num / 2;
											if(($i >= $a-3) && ($i <= $a + 3)):
											?>
                                			<td  align="center">
		                        				<input type="radio" value="<?php echo $i; ?>" name="lunch" />Lunch
		                        			</td>
		                            		<?php endif; ?>
		                      			</tr>
		                  			 </table>
		               			 </td>
		                			<td>
		                   				 <table width="80%" >
		                        			 <tr>
		                            			 <td>
		                                 			<input type="time" required="required" class="form-control" style="width:100px;" name="from<?php echo $i; ?>" id="from<?php echo $i; ?>" value="<?php echo $row->from;?>">
		                              			</td>
		                             			 <td> to</td>
		                             			 <td>
		                                   			<input type="time"  required="required" class="form-control" style="width:100px;" name="to<?php echo $i; ?>" id="to<?php echo $i; ?>" value="<?php echo $row->to;?>">
		                              			</td>
		                        			 </tr>
		                    			</table>
		               				 </td>
		           				</tr>
		      	  		 </tbody>
		           		 <?php $i++;  endforeach; 
						 for($j= $i ;$j<$num+1;$j++)
							 {?>
								 <tbody>
		        			<tr>
		        				<td><?php echo $j; ?></td>
		            			<td>
		            				<table width="80%">
		                				<tr>
		                    				<td>
		                        			<input type="text" class="form-control" required="required" style="width:100px;" name="period<?php echo $j; ?>" />
	                            			</td>
                                			
		                      			</tr>
		                  			 </table>
		               			 </td>
		                			<td>
		                   				 <table width="80%" >
		                        			 <tr>
		                            			 <td>
		                                 			<input type="time" class="form-control" required="required" style="width:100px;" name="from<?php echo $j; ?>" id="from<?php echo $j; ?>" >
		                              			</td>
		                             			 <td> to</td>
		                             			 <td>
		                                   			<input type="time" class="form-control" required="required" style="width:100px;" name="to<?php echo $j; ?>" id="to<?php echo $j; ?>" >
		                              			</td>
		                        			 </tr>
		                    			</table>
		               				 </td>
		           				</tr>
		      	  		 </tbody><?php
							 }
						 ?>
		     		</table>
				</div>
			</div>
				<div class="row space15">
					<div class="col-md-5">
						<input type="hidden" name="num" value="<?php echo $this->input->post("nop"); ?>" />
							<button type="submit" class="btn btn-blue">
							Click to Save <i class="fa fa-save"></i>
							</button>
					</div>										
				</div>
	
        <?php 
	}
	
	
	function insertPeriod(){
	$num = $this->input->post("num");
	$nopid = $this->input->post("nopid");	
	$this->load->model("periodModel");

	$this->db->where("school_code",$this->session->userdata("school_code"));
	$this->db->where("nop_id",$nopid);
	$dt=$this->db->get("period");
	if($dt->num_rows()>0){
		$this->db->where("school_code",$this->session->userdata("school_code"));
		$this->db->where("nop_id",$nopid);
		$this->db->delete("period");
		for($i=1;$i<=$num;$i++)
		{
			$data = array(
			"period_no"	=> $num,
			"nop_id"	=> $nopid,
			"period" => $this->input->post("period$i"),
			"lunch" => $this->input->post("lunch"),
			"from" => $this->input->post("from$i"),
			"to" => $this->input->post("to$i"),
					"school_code"=>$this->session->userdata("school_code")
			);
			$var = $this->periodModel->insertperiod($data);
		}
	}
	else{
    //$this->db->empty_table("period");
	
		for($i=1;$i<=$num;$i++)
		{
			$data = array(
			"period_no"	=> $num,
			"nop_id"	=> $nopid,
			"period" => $this->input->post("period$i"),
			"lunch" => $this->input->post("lunch"),
			"from" => $this->input->post("from$i"),
			"to" => $this->input->post("to$i"),
					"school_code"=>$this->session->userdata("school_code")
			);
			$var = $this->periodModel->insertperiod($data);
		}
		// redirect("index.php/login/periodTimeSlot/2");
	}
	redirect("index.php/login/periodTimeSlot/2");
}
	
	function periodSchedule(){
		$period_name = $this->input->post("period_name");
		$data['period_name'] = $period_name;
		$data['monday'] = $this->input->post("monday");
		$data['tuesday'] = $this->input->post("tuesday");
		$data['wednesday'] = $this->input->post("wednesday");
		$data['thursday'] = $this->input->post("thursday");
		$data['friday'] = $this->input->post("friday");
		$data['saturday'] = $this->input->post("saturday");
		$this->load->model("periodModel");
		$data['var'] = $this->periodModel->getPeriodD($period_name);
		//print_r($data1);
		$vart = $this->periodModel->getPeriodD($period_name);
		$data['dog']=$vart->row();
		$this->db->where("nop_id",$period_name);
		$this->db->where("school_code",$this->session->userdata("school_code"));
		$data['countPeriod'] = $this->db->get("period")->num_rows();
       $this->load->model("periodModel");
		$data['className'] = $this->periodModel->getClass();
		$data['teacher'] = $this->periodModel->getTeacherName();
		$this->load->view('ajax/createTimeTable',$data);
				
	}
// 	function periodsheduleinsert(){
// 		$days = $this->input->post("days");
// 		$tbr = $this->input->post("tbr");
// 		$tbc = $this->input->post("tbc");
// 		$this->load->model("periodModel");
// 		$checkTB = $this->periodModel->checkvalue($days);
// 		if($checkTB->num_rows()>0)
// 		{
// 			$var = $this->periodModel->deldaywise($days);
// 		}
// 		for($i=1;$i<$tbr;$i++)
// 		{
// 			for($j=1;$j<$tbc;$j++)
// 			{
// 				$data = array(
// 				"day" => $this->input->post("days"),
// 				"period_id" => $this->input->post("period$j"),
// 			//	"time" => $this->input->post("from$j"),
// 				"class_id" => $this->input->post("class1$i"),
// 				"teacher" => $this->input->post("teacher$i$j"),
// 				"subject_id" => $this->input->post("subject$i$j"),
// 						"school_code"=>$this->session->userdata("school_code")
// 				);
// 				$this->periodModel->periodSchedule($data);
// 			}
// 		}	

// 	redirect("index.php/login/schedulingReport");
// 	}
	
	
	function timeTable(){
		$no_of_period=$this->input->post('no_of_period');
	
		$this->load->model("periodModel");
		//$period=$this->uri->segment('3');
		$var = $this->periodModel->uniqueClass($no_of_period);

		$uniqueClass=$var->result();
		//print_r($uniqueClass);exit;
		$var = $this->periodModel->uniquePeriod($no_of_period);
		$uniquePeriod=$var->result();
		?>
		<div class="col-sm-12">
					<div class="tabbable">
									<ul class="nav nav-tabs tab-padding tab-space-3 tab-blue" id="myTab4">
										<li class="active">
											<a data-toggle="tab" href="#monday">
												Monday
											</a>
										</li>
										<li>
											<a data-toggle="tab" href="#tuesday">
												Tuesday
											</a>
										</li>
										<li>
											<a data-toggle="tab" href="#wednesday">
												Wednesday
											</a>
										</li>
										<li>
											<a data-toggle="tab" href="#thursday">
												Thursday
											</a>
										</li>
										<li>
											<a data-toggle="tab" href="#friday">
												Friday
											</a>
										</li>
										<li>
											<a data-toggle="tab" href="#saturday">
												Saturday
											</a>
										</li>
									</ul>
									<div class="tab-content">
										<div id="monday" class="tab-pane fade in active">
											
											<table class="table table-hover">
												<thead>
													<tr>
														<th>Period</th>
														<?php foreach($uniquePeriod as $row):
															?>
														<th>
															<?php
															//print_r($row->period_id);
																if($row->period_id == '0'){
																	echo "<span style='color:green;'>Lunch</span>";
																}else{ 
																$this->db->where("id",$row->period_id);
																$this->db->where("nop_id",$no_of_period);
																$periodd=$this->db->get("period"); 
																if($periodd->num_rows()>0){
				  												// if(strlen( $periodd->row()->period) > 1) { echo $periodd->row()->period; }else {echo "N/A";}
				  												
				  												 // 	echo $periodd->period;
																	//echo $row->period_id;
																	echo $periodd->row()->period;
																}
																else{
																    echo "<span style='color:red;'>Deleted</span>";
																}
																}
															?>
														</th>
														<?php endforeach;?>
													</tr>
													<tr>
														<th>Time Slot</th>
														<?php foreach($uniquePeriod as $row):
															?>
														 <th><?php 
														 $this->db->where("id",$row->period_id);
														 $this->db->where("nop_id",$no_of_period);
				  										$periodd=$this->db->get("period"); 
				  										if( $periodd->num_rows() > 0) {
				  											if($periodd){
				  										 echo $periodd->row()->from." - ".$periodd->row()->to;
				  										}}else {echo "<span style='color:green;'>Lunch</span>";}
				  										// echo $periodd->to." - ".$periodd->from
				  													//echo $row->time; 
				  													?>
														</th> 
														<?php endforeach;?>
													</tr>
												</thead>
												<tbody>
													<?php $i=1; foreach($uniqueClass as $row):?>
													<?php if($i%2==0){$rowcss="danger";}else{$rowcss ="warning";}?>
	                                                <tr class="<?php echo $rowcss;?>">
													
														<th>
															<?php $class = $row->class_id;
															//print_r($class);
															$this->db->where("id",$row->class_id);
															$class1=$this->db->get("class_info"); 
															if($class1->num_rows()>0){
															// print_r($class1->row()->section);exit;
															$this->db->where('id',$class1->row()->section);
															$section=$this->db->get('class_section')->row()->section;
															echo $class1->row()->class_name."-".$section;
														  ?>
														  </th>
														<?php $query = mysqli_query($this->db->conn_id,"SELECT * FROM time_table WHERE class_id = '$class' and time_thead_id='$no_of_period'"); ?>
														<?php while($res = mysqli_fetch_object($query )):
															$this->db->where("days_id",1);
															 $this->db->where("time_table_id",$res->id);
															$getdaysa = $this->db->get("time_table_days");
															if($getdaysa->num_rows()>0){?>
														<td>
															<?php if($res->teacher == '0'):?>
																<?php echo "<span style='color:green;'>Lunch</span>";?>
															<?php else:?>
																<?php $this->db->where("id",$res->teacher);
				  													 $teacher=$this->db->get("employee_info"); 
				  													if( $teacher->num_rows() > 0) {
				  													if($teacher){ echo "<b>". $teacher->row()->name."</b>";}}
				  													else {echo "<span style='color:red;'>N/A</span>";}//print_r($teacher->name);
				  													?><br/>
				  													<?php $this->db->where("id",$res->subject_id);
				  													 $sub=$this->db->get("subject"); 
				  													if($sub->num_rows() > 0) { 
                                                                       if($sub){
				  														echo "[ ".$sub->row()->subject." ]";}}
				  														else {echo "<span style='color:red;'>N/A</span>";}
				  													//print_r($sub->subject);
				  													?>
															<?php endif;?>
														</td>
														<?php } endwhile; ?>
													</tr>
													<?php } $i++; endforeach;?>
												</tbody>
											</table>

										</div>

										<div id="tuesday" class="tab-pane fade">
											<table class="table table-hover">
												<thead>
													<tr>
														<th>Period</th>
														<?php foreach($uniquePeriod as $row):?>
														<th>
															<?php
																if($row->period_id == '0'){
																	echo "<span style='color:green;'>Lunch</span>";
																}else{ $this->db->where("id",$row->period_id);
																	$this->db->where("nop_id",$no_of_period);
				  													 $periodd=$this->db->get("period"); 
				  													 if($periodd->num_rows()>0)
				  													 {
				  												    	echo $periodd->row()->period;
				  													 }
				  													 else
				  													 {
				  													     echo "<span style='color:red;'>Deleted</span>";
				  													 }
																	//echo $row->period_id;
																}
															?>
														</th>
														<?php endforeach;?>
													</tr>
													<tr>
														<th>Time Slot</th>
														<?php foreach($uniquePeriod as $row):?>
														<th><?php 
														 $this->db->where("id",$row->period_id);
														 $this->db->where("nop_id",$no_of_period);
				  										$periodd=$this->db->get("period"); 
				  										if( $periodd->num_rows() > 0) {
				  											if($periodd){
				  										 echo $periodd->row()->from." - ".$periodd->row()->to;
				  										}}else {echo "<span style='color:red;'>N/A</span>";}
				  										// echo $periodd->to." - ".$periodd->from
				  													//echo $row->time; 
				  													?>
														</th>
														<?php endforeach;?>
													</tr>
												</thead>
											<tbody>
													<?php $i=1; foreach($uniqueClass as $row):?>
													<?php if($i%2==0){$rowcss="danger";}else{$rowcss ="warning";}?>
	                                                <tr class="<?php echo $rowcss;?>">
													
														<th><?php $class = $row->class_id;
															$this->db->where("id",$row->class_id);
				  													 $class1=$this->db->get("class_info")->row(); 
				  													echo $class1->class_name;
														 //echo $class;?>
														 	
														 </th>
														<?php $query = mysqli_query($this->db->conn_id,"SELECT * FROM time_table WHERE class_id = '$class' and time_thead_id='$no_of_period' "); ?>
														<?php while($res = mysqli_fetch_object($query )):
															$this->db->where("days_id",2);
															 $this->db->where("time_table_id",$res->id);
															$getdaysa = $this->db->get("time_table_days");
															if($getdaysa->num_rows()>0){?>
														<td>
															<?php if($res->teacher == '0'):?>
																<?php echo "<span style='color:green;'>Lunch</span>";?>
															<?php else:?>
																<?php $this->db->where("id",$res->teacher);
				  													 $teacher=$this->db->get("employee_info"); 
				  													if( $teacher->num_rows() > 0) {
																	if($teacher){ echo "<b>". $teacher->row()->name."</b>";}}
				  													else {echo "<span style='color:red;'>N/A</span>";}//print_r($teacher->name);
				  													?><br/>
				  													<?php $this->db->where("id",$res->subject_id);
				  													 $sub=$this->db->get("subject"); 
				  													if($sub->num_rows() > 0) { 
                                                                       if($sub){
																		  echo "[ ".$sub->row()->subject." ]";}}
				  														else {echo "<span style='color:red;'>N/A</span>";}
				  													//print_r($sub->subject);
				  													?>
															<?php endif;?>
														</td>
														<?php } endwhile; ?>
													</tr>
													<?php endforeach;?>
												</tbody>
											</table>
										</div>
										<div id="wednesday" class="tab-pane fade">
										<table class="table table-hover">
												<thead>
													<tr>
														<th>Period</th>
														<?php foreach($uniquePeriod as $row):?>
														<th>
															<?php
																if($row->period_id == '0'){
																	echo "<span style='color:green;'>Lunch</span>";
																}else{
																	$this->db->where("id",$row->period_id);
																	$this->db->where("nop_id",$no_of_period);
				  													 $periodd=$this->db->get("period"); 
				  													 if($periodd->num_rows()>0)
				  													 {
				  													     	echo $periodd->row()->period;
																	//echo $row->period_id;
				  													 }
				  													 else
				  													 {
				  													     echo "<span style='color:red;'>Deleted</span>";
				  													 }
				  												
																}
															?>
														</th>
														<?php endforeach;?>
													</tr>
													<tr>
														<th>Time Slot</th>
														<?php foreach($uniquePeriod as $row):?>
														<th><?php 
														 $this->db->where("id",$row->period_id);
														 $this->db->where("nop_id",$no_of_period);
				  										$periodd=$this->db->get("period"); 
				  										if( $periodd->num_rows() > 0) {
				  											if($periodd){
				  										 echo $periodd->row()->from." - ".$periodd->row()->to;
				  										}}else {echo "<span style='color:red;'>N/A</span>";}
				  										// echo $periodd->to." - ".$periodd->from
				  													//echo $row->time; 
				  													?>
														</th>
														<?php endforeach;?>
													</tr>
												</thead>
												<tbody>
													<?php $i=1; foreach($uniqueClass as $row):?>
													<?php if($i%2==0){$rowcss="danger";}else{$rowcss ="warning";}?>
	                                                <tr class="<?php echo $rowcss;?>">
														<th>
															<?php $class = $row->class_id;
															$this->db->where("id",$row->class_id);
				  													 $class1=$this->db->get("class_info")->row(); 
				  													echo $class1->class_name;
														 ?>
															</th>
															<?php $query = mysqli_query($this->db->conn_id,"SELECT * FROM time_table WHERE class_id = '$class' and time_thead_id='$no_of_period' "); ?>
														<?php while($res = mysqli_fetch_object($query )):
															$this->db->where("days_id",3);
															 $this->db->where("time_table_id",$res->id);
															$getdaysa = $this->db->get("time_table_days");
															if($getdaysa->num_rows()>0){?>
														<td><?php if($res->teacher == '0'):?>
																<?php echo "<span style='color:green;'>Lunch</span>";?>
															<?php else:?>
																<?php $this->db->where("id",$res->teacher);
				  													 $teacher=$this->db->get("employee_info"); 
				  													if( $teacher->num_rows() > 0) {
																		if($teacher){ echo "<b>". $teacher->row()->name."</b>";}}
				  													else {echo "<span style='color:red;'>N/A</span>";}//print_r($teacher->name);
				  													?><br/>
				  													<?php $this->db->where("id",$res->subject_id);
				  													 $sub=$this->db->get("subject"); 
				  													if($sub->num_rows() > 0) { 
                                                                       if($sub){
																		echo "[ ".$sub->row()->subject." ]";}}
				  														else {echo "<span style='color:red;'>N/A</span>";}
				  													//print_r($sub->subject);
				  													?>
															<?php endif;?>
														</td>
														<?php } endwhile; ?>
													</tr>
													<?php endforeach;?>
												</tbody>
											</table>
										</div>
										<div id="thursday" class="tab-pane fade">
										<table class="table table-hover">
												<thead>
													<tr>
														<th>Period</th>
														<?php foreach($uniquePeriod as $row):?>
														<th>
															<?php
																if($row->period_id == '0'){
																	echo "<span style='color:green;'>Lunch</span>";
																}else{
																	$this->db->where("id",$row->period_id);
																	$this->db->where("nop_id",$no_of_period);
				  													 $periodd=$this->db->get("period"); 
				  													 if($periodd->num_rows()>0)
				  													 {
				  													echo $periodd->row()->period;
																	//echo $row->period_id;
				  													 }
				  													 
				  													 else
				  													 {
				  													     echo "<span style='color:red;'>Deleted</span>";
				  													 }
																}
															?>
														</th>
														<?php endforeach;?>
													</tr>
													<tr>
														<th>Time Slot</th>
														<?php foreach($uniquePeriod as $row):?>
														<th><?php 
														 $this->db->where("id",$row->period_id);
														 $this->db->where("nop_id",$no_of_period);
				  										$periodd=$this->db->get("period"); 
				  										if( $periodd->num_rows() > 0) {
				  											if($periodd){
				  										 echo $periodd->row()->from." - ".$periodd->row()->to;
				  										}}else {echo "<span style='color:red;'>N/A</span>";}
				  										// echo $periodd->to." - ".$periodd->from
				  													//echo $row->time; 
				  													?>
														</th>
														<?php endforeach;?>
													</tr>
												</thead>
												<tbody>
													<?php $i=1; foreach($uniqueClass as $row):?>
													<?php if($i%2==0){$rowcss="danger";}else{$rowcss ="warning";}?>
	                                                <tr class="<?php echo $rowcss;?>">
														<th><?php $class = $row->class_id;
															$this->db->where("id",$row->class_id);
				  													 $class1=$this->db->get("class_info")->row(); 
				  													echo $class1->class_name;
														 ?></th>
														<?php $query = mysqli_query($this->db->conn_id,"SELECT * FROM time_table WHERE class_id = '$class' and time_thead_id='$no_of_period' "); ?>
														<?php while($res = mysqli_fetch_object($query )):
															$this->db->where("days_id",4);
															 $this->db->where("time_table_id",$res->id);
															$getdaysa = $this->db->get("time_table_days");
															if($getdaysa->num_rows()>0){
																?>
														<td>
															<?php if($res->teacher == '0'):?>
																<?php echo "<span style='color:green;'>Lunch</span>";?>
															<?php else:?>
																<?php $this->db->where("id",$res->teacher);
				  													 $teacher=$this->db->get("employee_info"); 
				  													if( $teacher->num_rows() > 0) {
																		if($teacher){ echo "<b>". $teacher->row()->name."</b>";}}
				  													else {echo "<span style='color:red;'>N/A</span>";}//print_r($teacher->name);
				  													?><br/>
				  													<?php $this->db->where("id",$res->subject_id);
				  													 $sub=$this->db->get("subject"); 
				  													if($sub->num_rows() > 0) { 
                                                                       if($sub){
																		echo "[ ".$sub->row()->subject." ]";}}
				  														else {echo "<span style='color:red;'>N/A</span>";}
				  													//print_r($sub->subject);
				  													?>
															<?php endif;?>
														</td>
														<?php  } endwhile; ?>
													</tr>
													<?php endforeach;?>
												</tbody>
											</table>
										</div>
								
										<div id="friday" class="tab-pane fade">
										<table class="table table-hover">
												<thead>
													<tr>
														<th>Period</th>
														<?php foreach($uniquePeriod as $row):?>
														<th>
															<?php
																if($row->period_id == '0'){
																	echo "<span style='color:green;'>Lunch</span>";
																}else{
																	$this->db->where("id",$row->period_id);
																	$this->db->where("nop_id",$no_of_period);
				  													 $periodd=$this->db->get("period"); 
				  													 if($periodd->num_rows()>0)
				  													 {
				  													echo $periodd->row()->period;
																	//echo $row->period_id;
				  													 }
				  													 else
				  													 {
				  													     echo "<span style='color:red;'>Deleted</span>";
				  													 }
																		
																}
															?>
														</th>
														<?php endforeach;?>
													</tr>
													<tr>
														<th>Time Slot</th>
														<?php foreach($uniquePeriod as $row):?>
														<th><?php 
														 $this->db->where("id",$row->period_id);
														 $this->db->where("nop_id",$no_of_period);
				  										$periodd=$this->db->get("period"); 
				  										if( $periodd->num_rows() > 0) {
				  											if($periodd){
				  										 echo $periodd->row()->from." - ".$periodd->row()->to;
				  										}}else {echo "<span style='color:red;'>N/A</span>";}
				  										// echo $periodd->to." - ".$periodd->from
				  													//echo $row->time; 
				  													?>
														</th>
														<?php endforeach;?>
													</tr>
												</thead>
												<tbody>
													<?php $i=1; foreach($uniqueClass as $row):?>
													<?php if($i%2==0){$rowcss="danger";}else{$rowcss ="warning";}?>
	                                                <tr class="<?php echo $rowcss;?>">
														<th><?php $class = $row->class_id;
															$this->db->where("id",$row->class_id);
				  													 $class1=$this->db->get("class_info")->row(); 
				  													echo $class1->class_name;
														 ?></th>
														<?php $query = mysqli_query($this->db->conn_id,"SELECT * FROM time_table WHERE class_id = '$class' and time_thead_id='$no_of_period' "); ?>
														<?php while($res = mysqli_fetch_object($query )):
															$this->db->where("days_id",5);
															 $this->db->where("time_table_id",$res->id);
															$getdaysa = $this->db->get("time_table_days");
															if($getdaysa->num_rows()>0){?>
														<td>
															<?php if($res->teacher == '0'):?>
																<?php echo "<span style='color:green;'>Lunch</span>";?>
															<?php else:?>
																<?php $this->db->where("id",$res->teacher);
				  													 $teacher=$this->db->get("employee_info"); 
				  													if( $teacher->num_rows() > 0) {
																		if($teacher){ echo "<b>". $teacher->row()->name."</b>";}}
				  													else {echo "<span style='color:red;'>N/A</span>";}//print_r($teacher->name);
				  													?><br/>
				  													<?php $this->db->where("id",$res->subject_id);
				  													 $sub=$this->db->get("subject"); 
				  													if($sub->num_rows() > 0) { 
                                                                       if($sub){
																		echo "[ ".$sub->row()->subject." ]";}}
				  														else {echo "<span style='color:red;'>N/A</span>";}
				  													//print_r($sub->subject);
				  													?>
															<?php endif;?>
														</td>
														<?php } endwhile; ?>
													</tr>
													<?php endforeach;?>
												</tbody>
											</table>
										</div>
										<div id="saturday" class="tab-pane fade">
										<table class="table table-hover">
												<thead>
													<tr>
														<th>Period</th>
														<?php foreach($uniquePeriod as $row):?>
														<th>
															<?php
																if($row->period_id == '0'){
																	echo "<span style='color:green;'>Lunch</span>";
																}else{
																	$this->db->where("id",$row->period_id);
																	$this->db->where("nop_id",$no_of_period);
				  													 $periodd=$this->db->get("period"); 
				  													 if($periodd->num_rows()>0)
				  													 {
				  													echo $periodd->row()->period;
																	//echo $row->period_id;
				  													 }
				  													 else
				  													 {
				  													     echo "<span style='color:red;'>Deleted</span>";
				  													 }
																		
																}
															?>
														</th>
														<?php endforeach;?>
													</tr>
													<tr>
														<th>Time Slot</th>
														<?php foreach($uniquePeriod as $row):?>
														<th><?php 
														 $this->db->where("id",$row->period_id);
														 $this->db->where("nop_id",$no_of_period);
				  										$periodd=$this->db->get("period"); 
				  										if( $periodd->num_rows() > 0) {
				  											if($periodd){
				  										 echo $periodd->row()->from." - ".$periodd->row()->to;
				  										}}else {echo "<span style='color:red;'>N/A</span>";}
				  										// echo $periodd->to." - ".$periodd->from
				  													//echo $row->time; 
				  													?>
														</th>
														<?php endforeach;?>
													</tr>
												</thead>
												<tbody>
													<?php $i=1; foreach($uniqueClass as $row):?>
													<?php if($i%2==0){$rowcss="danger";}else{$rowcss ="warning";}?>
	                                                <tr class="<?php echo $rowcss;?>">
														<th><?php $class = $row->class_id;
															$this->db->where("id",$row->class_id);
				  													 $class1=$this->db->get("class_info")->row(); 
				  													echo $class1->class_name;
														 ?></th>
														<?php $query = mysqli_query($this->db->conn_id,"SELECT * FROM time_table WHERE class_id = '$class' and time_thead_id='$no_of_period' "); ?>
														<?php while($res = mysqli_fetch_object($query )):$this->db->where("days_id",6);
															 $this->db->where("time_table_id",$res->id);
															$getdaysa = $this->db->get("time_table_days");
															if($getdaysa->num_rows()>0){?>
														<td>
															<?php if($res->teacher == '0'):?>
																<?php echo "<span style='color:green;'>Lunch</span>";?>
															<?php else:?>
																<?php $this->db->where("id",$res->teacher);
				  													 $teacher=$this->db->get("employee_info"); 
				  													if( $teacher->num_rows() > 0) {
																		if($teacher){ echo "<b>". $teacher->row()->name."</b>";}}
				  													else {echo "<span style='color:red;'>N/A</span>";}//print_r($teacher->name);
				  													?><br/>
				  													<?php $this->db->where("id",$res->subject_id);
				  													 $sub=$this->db->get("subject"); 
				  													if($sub->num_rows() > 0) { 
                                                                       if($sub){
																		echo "[ ".$sub->row()->subject." ]";}}
				  														else {echo "<span style='color:red;'>N/A</span>";}
				  													//print_r($sub->subject);
				  													?>
															<?php endif;?>
														</td>
														<?php } endwhile; ?>
													</tr>
													<?php endforeach;?>
												</tbody>
											</table>
										</div>

									</div>
								</div>
							</div>
							<?php
	}
	
	function defineclassplan(){
		 $uri1=$this->uri->segment(3);
		 $uri2=$this->uri->segment(4);
		$defPlan= $this->uri->segment(5);
		
		if((strlen($uri1) > 0) && (strlen($uri2) > 0))
		{
			$data['sdate']=$uri1;
			$data['edate']=$uri2;
			$data['time_thead_id'] = $defPlan;
		}
		else
		{
		$data['time_thead_id'] = $this->input->post('time_thead_id1');	
		$data['sdate']= $this->input->post("sdate");
		$data['edate']= $this->input->post("edate");
		}
		$data['pageTitle'] = 'Time Schedule';
		$data['smallTitle'] = 'Time Schedule';
		$data['mainPage'] = 'Teacher Lesson Plan';
		$data['subPage'] = 'Teacher Lesson Plan';
		$data['title'] = 'Teacher Lesson Plan';
		$data['headerCss'] = 'headerCss/lessonPlanCss';
		$data['footerJs'] = 'footerJs/lessonPlanJs';
		$data['mainContent'] = 'ajax/defineclassplan';
		$this->load->view("includes/mainContent", $data);
	}
	function saveLessonPlan(){
		$i=1;
		$s1date =$this->input->post("s1date");
		$edate =$this->input->post("edate");
		$userid = $this->session->userdata("username");
		$thead= $this->input->post('thead');
		//print_r($thead);exit();
		$this->db->where('nop_id',$thead);
		$period=$this->db->get("period");
		//print_r($period);exit();
		foreach($period->result() as $row):
		    $period_id=$row->id;
		print_r($period_id);
		$date1=$this->input->post("date1");
		$dayname=$this->input->post("weekday");
		$class_sec=$this->input->post("class1$i");
		//print_r($class_sec);exit;
		$sno=$this->input->post("sno$i");
		$subject=$this->input->post("subject$i");
		$data=array(
				'dayname'=>$this->input->post("weekday"),
				'date1'=>$this->input->post("date1"),
				'class_sec'=>$this->input->post("class1$i"),
				'subject_id'=>$this->input->post("subject$i"),
				'period'=>$this->input->post("period$i"),
				'class_work'=>$this->input->post("lp$i"),
				'teacher_id'=>$userid,
				//'school_code'=>$this->session->userdata("school_code")
				
		);
		//$guru = $this->db->query("SELECT * FROM lesson_plan WHERE subject='".$subject."' AND class_sec ='".$class_sec."' AND teacher_id = '".$userid."' AND date1='".$date1."' AND dayname = '".$dayname."'");
		if(strlen($sno)>0)	
		{
			$this->db->where("date1",$date1);
			$this->db->where("dayname",$dayname);
			$this->db->where("teacher_id",$userid);
			$this->db->where("subject_id",$subject);
			$this->db->where("class_sec",$class_sec);
			$this->db->update("lesson_plan",$data);
			$i++;
		}
		else {
		$this->db->insert("lesson_plan",$data);
			$i++;
		}
		endforeach;
			redirect("periodTimeControllers/defineclassplan/$s1date/$edate/$thead");
		
	}
	function viewclassplan(){
		$logtype = $this->session->userdata('login_type');
				if($logtype == "admin"){
				$data['username']=$this->input->post("teacherid");
			}
			$data['lesson_plan']=$this->input->post('time_thead_id');
			$data['sdate']= $this->input->post("sdate");
			$data['edate']= $this->input->post("edate");
		$data['pageTitle'] = 'Time Schedule';
		$data['smallTitle'] = 'Time Schedule';
		$data['mainPage'] = 'Teacher Lesson Plan';
		$data['subPage'] = 'Teacher Lesson Plan';
		$data['title'] = 'Teacher Lesson Plan';
		$data['headerCss'] = 'headerCss/lessonPlanCss';
		$data['footerJs'] = 'footerJs/lessonPlanJs';
		$data['mainContent'] = 'ajax/viewClassPlan';
		$this->load->view("includes/mainContent", $data);
	}
	
}
?>