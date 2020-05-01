
		<br/><br/>
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

						<li>
							<a href="#" class="export-csv" data-table="#sample-table-2" >
								Save as CSV
							</a>
						</li>
						<li>
							<a href="#" class="export-doc" data-table="#sample-table-2" data-ignoreColumn ="3,4">
								Export to Word
							</a>
						</li>

					</ul>
				</div>
			</div>
		</div>
		<?php   $count = 1;
			$sum=0;
	$school_code=	$this->session->userdata('school_code');
		$this->db->where('school_code',$this->session->userdata('school_code'));
		$sende_Detail=$this->db->get('sms_setting')->row();
		?>
		<div>   <p class="alert alert-danger"> Available SMS Balance = <?php 
		$cbs=checkBalSms($sende_Detail->uname,$sende_Detail->password)+$sende_Detail->sms_bal;
		echo $cbs;?></p>
		 <p class="alert alert-info"> Note : This is the area you can send Fee reminder to send click send sms button . If you send SMS change to Success Message send Successfully . <br>
		</div>
	<?php 	$fsd=$this->input->post("fsd"); 
	if($cla == "all" && $sec == "all"){ ?>
		<div class="table-responsive">
		
			<table class="table table-striped table-hover" id="sample-table-2">
				<thead>
					<tr class = "success">
						<th>SNo</th>
						<th>Student id</th>
						<th>Student Name</th>
						<th>Class & Section</th>
						<th>Father Mobile </th>
						<th>Father Name</th>
						<th>Paid Fee  Month</th>
						<th>Total Pay Amount</th>
						<th>Total Paid Amount</th>
						<th>Total Due Amount</th>
						<th>Full Detail</th>
						<th>Sms Send</th>
					</tr>
				</thead>
				<tbody>
				<?php
					if($stidRecord->num_rows() > 0){
				foreach($stidRecord->result() as $sid):
			
				 $color = array(
					    "progress-bar-danger",
					    "progress-bar-success",
					    "progress-bar-warning",
					    "progress-partition-green",
					    "partition-azure",
					    "partition-blue",
					    "partition-orange",
					    "partition-purple",
					    "progress-bar-danger",
					    "progress-bar-success",
					    "progress-partition-green",
					    "partition-purple"
				    );
				    $count = 1;
				    $tot=0.00;
				    $totalpaidp=0;
				    $totalduep=0;
				    $tilldatedue=0;
				    ?>
				
				<?php 
			
				    $rowcss = "danger";
				    $count = 1;
						$tot=0.00;
						$this->db->where("id",$fsd);
						$fdate =$this->db->get("fsd")->row()->finance_start_date;

						$sum=0;
				    	$stu_id = $sid->id;
				        $stuDetail= $this->allFormModel->getStu_record_fsdSingleid($stu_id)->row();
				    		$total = $this->db->query("SELECT DISTINCT(class_id) as classid, SUM(paid) as totalpaid, SUM(total) as totaldeposite,invoice_no from fee_deposit WHERE student_id = '$stu_id' AND finance_start_date='$fsd' and status =1 AND school_code='$school_code'")->row(); 
							$rowcss = $count % 2 == 0 ? "danger" : "warning";
						?>
					<tr class="<?php echo $rowcss;?>">
			  		<td><?php echo $count;?></td>
			  				<td><strong><?php echo $stuDetail->username;?></strong></td>
			  			<td><?php echo $stuDetail->name;?>
			  			    <input type = "hidden" id="sname<?php echo $count;?>" value="<?php echo $stuDetail->name;?>"/></td>
						  <td><strong><?php 
						 $classinfo =  $this->allFormModel->classDetailsbyId($total->classid);
						  echo $classinfo['class']." & ".$classinfo['section'];?></strong> </td> 
						  <td><strong><?php if(strlen($stuDetail->mobile) > 1) {echo $stuDetail->mobile; }else echo "N/A"; ?>
                    </strong><input type = "hidden" id="mnum<?php echo $count;?>" value="<?php echo $stuDetail->mobile;?>"/></td>
                      
                          
                          <td><strong><?php if(strlen($stuDetail->father_full_name) > 1) {echo $stuDetail->father_full_name; }else echo "N/A"; ?><?php //echo $rows->father_full_name;
                          
                        ?></strong><input type = "hidden" id="fname<?php echo $count;?>" value="<?php echo $stuDetail->father_full_name;?>"/></td></td>
                          
                          <td>
			  			
							<?php 
							
						     $fee_record =  $this->db->query("select deposite_months.deposite_month from deposite_months join fee_deposit on fee_deposit.invoice_no = deposite_months.invoice_no where fee_deposit.status=1 and fee_deposit.finance_start_date='$fsd' and deposite_months.student_id='$stu_id' order by deposite_months.id ASC ");
                                                                                	
								/*//$this->db->where("school_code",$this->session->userdata("school_code"));
								$this->db->where("student_id",$stu_id);
								$this->db->where("fsd",$fsd);
								$fee_record = $this->db->get("deposite_months");*/
							
			               $i=0;
							foreach($fee_record->result() as $fd):
								?>
								<span class="label label-success" style="line-height:20px;">
								<?php 
							 if($fd->deposite_month<4){
								$realm=  $fd->deposite_month-4+12;
					 
							}else{
							 $realm= $fd->deposite_month-4;}
							//	$realm = $fd->deposite_month-4;
								echo date('M-Y', strtotime("$realm months", strtotime($fdate)));
								//echo date("d-M-y",strtotime("$rdt1"));?>
								 </span>
									
							<?php $i++; endforeach;  ?>
						</td>
					
					
			  			<td>
			  			<?php  
			  			$cd=0;
			  			if($this->input->post("fsd")){
			  				$this->db->where("school_code",$this->session->userdata("school_code"));
								$this->db->where("student_id",$stu_id);
								$this->db->where("finance_start_date",$fsd);
								$this->db->where("status",1);
								$feedue = $this->db->get("fee_deposit");
								
								foreach($feedue->result() as $fd):?>
																
								<!-- <span class="label label-success" style="line-height:20px;">
								<?php //echo date("M-y",strtotime("$fd->diposit_date"));?> 
								 </span> -->
								<?php $cd=$cd+$fd->total;?>
							 <?php  endforeach; 
			  			   }
			  		  ?>
			  			<?php $totalduep += $cd; echo $cd;?>
							</td>
							<td>
							<?php  $totalpaidp += $total->totalpaid; echo $total->totalpaid;?>
						</td>
						<td><?php echo $this->feeModel->totFee_due_by_id($stu_id,1);?></td>
			  			<td>
							<a href="<?php echo base_url()?>index.php/feeControllers/feesDetail/<?php echo $stu_id;?>/<?php echo $fsd;?>" target="_blank" class="btn btn-blue">
								View Detail
							</a></td>
								<td>
							<button class="btn btn-yellow" id ="smstodew<?php echo $count;?>" >
								Send SMS
							</button></td>
							<script>
			  		
			  			$("#smstodew<?php echo $count;?>").click(function(){
			  				var smstodue = $("#rem<?php echo $count;?>").val();
			  				var sname = $("#sname<?php echo $count;?>").val();
			  				var fname = $("#fname<?php echo $count;?>").val();
			  				var mnum = $("#mnum<?php echo $count;?>").val();
							var amount = $("#amt<?php echo $count;?>").val();
							var amount1 = $("#amt1<?php echo $count;?>").val();
				// alert(amount1);
				// alert(amount);
					$.post("<?php echo site_url("index.php/feeControllers/feeRemSms") ?>",{smstodue : smstodue,sname : sname,fname : fname,mnum : mnum,amount : amount,amount1 : amount1}, function(data){
						$("#smstodew<?php echo $count;?>").html(data);
					});
				
				});
			  			</script>
			  			
			  		</tr>
			  		<?php  ?>
			  		<?php $count++; endforeach;?>
			  		</tbody>
				<tfoot>
				    <tr>
				        <td></td>
				        <td>Total Due</td>
				        <td></td>
				        <td></td>
				        <td></td>
				        <td></td>
				        <td></td>
				        <td></td>
				        <td><?php echo $sum;?></td>
				    </tr>
				</tfoot>
				
			</table>
		</div>
	
		

				<?php }else{?>

<br/><br/>
			<div class="alert alert-block alert-danger fade in">
				<button data-dismiss="alert" class="close" type="button">
					&times;
				</button>
				<h4 class="alert-heading"><i class="fa fa-times"></i> Error! <?php echo "0";?></h4>
				<p>
					No record found from Fee database please submit fee first of this class &amp; section... 
				</p>
			</div>
		
<?php }  }
	else{
	   
$sum=0;
?>
		<div class="table-responsive">
			<table class="table table-striped table-hover" id="sample-table-2">
				<thead>
					<tr class = "success">
						<th>SNo</th>
						<th>Student Id</th>
						<th>Student Name</th>
						<th>Class & Section</th>
						<th>Father Mobile </th>
						<th>Father Name</th>
						<th>Paid Fee  Month</th>
						<th>Total Pay Amount</th>
						<th>Total Paid Amount</th>
						<th>Total Due Amount</th>
						<th>Full Detail</th>
						<th>Sms Send</th>
					</tr>
				</thead>
				<?php 
				
				    $color = array(
					    "progress-bar-danger",
					    "progress-bar-success",
					    "progress-bar-warning",
					    "progress-partition-green",
					    "partition-azure",
					    "partition-blue",
					    "partition-orange",
					    "partition-purple",
					    "progress-bar-danger",
					    "progress-bar-success",
					    "progress-partition-green",
					    "partition-purple"
				    );
				    $count = 1;
				    $tot=0.00;
				    $totalpaidp=0;
				    $totalduep=0;
				    $tilldatedue=0;
				    ?>
				<tbody>
				<?php 
					if($stidRecordfsdclass->num_rows() > 0){
	    //print_r($stidRecordfsdclass);
        
				    $rowcss = "danger";
				    $count = 1;
				  
						$tot=0.00;
						$this->db->where("id",$fsd);
						$fdate = $this->db->get("fsd")->row()->finance_start_date;
	                foreach($stidRecordfsdclass->result() as $sid):
	                      $stu_id=$sid->id;
					
								 //$x=0;
                //  print_r($student->num_rows());
				    $stuDetail= $this->allFormModel->getStu_record_fsdSingleid($stu_id)->row();
				    		$total = $this->db->query("SELECT DISTINCT(class_id) as classid, SUM(paid) as totalpaid, SUM(total) as totaldeposite,invoice_no from fee_deposit WHERE student_id = '$stu_id' and status=1 AND finance_start_date='$fsd' AND school_code='$school_code'")->row(); 
								
							$rowcss = $count % 2 == 0 ? "danger" : "warning";
						?>
					<tr class="<?php echo $rowcss;?>">
			  		<td><?php echo $count;?></td>
			  				<td><strong><?php echo $stuDetail->username;?></strong>
			  			<td><?php echo $stuDetail->name;?>
			  			<input type = "hidden" id="sname<?php echo $count;?>" value="<?php echo $stuDetail->name;?>"/></td>
						      <td><strong><?php 
						 $classinfo =  $this->allFormModel->classDetailsbyId($total->classid);
						  echo $classinfo['class']." & ".$classinfo['section'];?></strong> </td> 
						  <td><strong><?php if(strlen($stuDetail->mobile) > 1) {echo $stuDetail->mobile; }else echo "N/A"; ?>
                            </strong><input type = "hidden" id="mnum<?php echo $count;?>" value="<?php echo $stuDetail->mobile;?>"/></td>
                      
                          
                          <td><strong><?php if(strlen($stuDetail->father_full_name) > 1) {echo $stuDetail->father_full_name; }else echo "N/A"; ?><?php //echo $rows->father_full_name;
                          
                        ?></strong><input type = "hidden" id="fname<?php echo $count;?>" value="<?php echo $stuDetail->father_full_name;?>"/></td></td>
                          
                          <td>
			  			
							<?php 
							
						
								//$this->db->where("school_code",$this->session->userdata("school_code"));
							 $fee_record =  $this->db->query("select deposite_months.deposite_month from deposite_months join fee_deposit on fee_deposit.invoice_no = deposite_months.invoice_no where fee_deposit.status=1 and fee_deposit.finance_start_date='$fsd' and deposite_months.student_id='$stu_id' order by deposite_months.id ASC ");
							
			               $i=0;
							foreach($fee_record->result() as $fd):
								?>
								<span class="label label-success" style="line-height:20px;">
								<?php 
							 if($fd->deposite_month<4){
								$realm=  $fd->deposite_month-4+12;
					 
							}else{
							 $realm= $fd->deposite_month-4;}
							//	$realm = $fd->deposite_month-4;
								echo date('M-Y', strtotime("$realm months", strtotime($fdate)));
								//echo date("d-M-y",strtotime("$rdt1"));?>
								 </span>
									
							<?php $i++; endforeach;  ?>
						</td>
					
					
			  			<td>
			  			<?php  
			  			$cd=0;
			  			if($this->input->post("fsd")){
			  				$this->db->where("school_code",$this->session->userdata("school_code"));
								$this->db->where("student_id",$stu_id);
								$this->db->where("finance_start_date",$fsd);
								$this->db->where("status",1);
								$feedue = $this->db->get("fee_deposit");
								
								foreach($feedue->result() as $fd):?>
																
								<!-- <span class="label label-success" style="line-height:20px;">
								<?php //echo date("M-y",strtotime("$fd->diposit_date"));?> 
								 </span> -->
								<?php $cd=$cd+$fd->total;?>
							 <?php  endforeach; 
			  			   }
			  		  ?>
			  			<?php $totalduep += $cd; echo $cd;?>
							</td>
							<td>
							<?php  $totalpaidp += $total->totalpaid; echo $total->totalpaid;?>
						</td>
						<td><?php echo $this->feeModel->totFee_due_by_id($stu_id,1);?></td>
			  			<td>
							<a href="<?php echo base_url()?>index.php/feeControllers/feesDetail/<?php echo $stu_id;?>/<?php echo $fsd;?>" target="_blank" class="btn btn-blue">
								View Detail
							</a></td>
								<td>
							<button class="btn btn-yellow" id ="smstodew<?php echo $count;?>" >
								Send SMS
							</button></td>
							<script>
			  		
			  			$("#smstodew<?php echo $count;?>").click(function(){
			  				var smstodue = $("#rem<?php echo $count;?>").val();
			  				var sname = $("#sname<?php echo $count;?>").val();
			  				var fname = $("#fname<?php echo $count;?>").val();
			  				var mnum = $("#mnum<?php echo $count;?>").val();
							var amount = $("#amt<?php echo $count;?>").val();
							var amount1 = $("#amt1<?php echo $count;?>").val();
				// alert(amount);
				// alert(amount1);
					$.post("<?php echo site_url("index.php/feeControllers/feeRemSms") ?>",{smstodue : smstodue,sname : sname,fname : fname,mnum : mnum,amount : amount,amount1 : amount1}, function(data){
						$("#smstodew<?php echo $count;?>").html(data);
					});
				
				});
			  			</script>
			  			
			  		</tr>
			  		<?php  ?>
			  		<?php $count++;  endforeach; }
        //
        if($fsd!= $this->session->userdata("fsd")){
        $student1= $this->db->query("select DISTINCT(student_info.id) from student_info  where status =1 and fsd ='$fsd' and student_info.class_id ='$cla'" );
        if($student1->num_rows()>0){
           $rowcss = "danger";
				   
				  
						$tot=0.00;
						$this->db->where("id",$fsd);
						$fdate = $this->db->get("fsd")->row()->finance_start_date;
	                foreach($student1->result() as $sid):
	                      $stu_id=$sid->id;
						
								 //$x=0;
                //  print_r($student->num_rows());
				    $stuDetail= $this->allFormModel->getStu_record_fsdSingleid($stu_id)->row();
				    		$total = $this->db->query("SELECT DISTINCT(class_id) as classid, SUM(paid) as totalpaid, SUM(total) as totaldeposite,invoice_no from fee_deposit WHERE student_id = '$stu_id' AND status =1 and finance_start_date='$fsd' AND school_code='$school_code'")->row(); 
								
							$rowcss = $count % 2 == 0 ? "danger" : "warning";
						?>
					<tr class="<?php echo $rowcss;?>">
			  		<td><?php echo $count;?></td>
			  				<td><strong><?php echo $stuDetail->username;?></strong>
			  			<td><?php echo $stuDetail->name;?>
			  			<input type = "hidden" id="sname<?php echo $count;?>" value="<?php echo $stuDetail->name;?>"/></td>
						      <td><strong><?php 
						 $classinfo =  $this->allFormModel->classDetailsbyId($total->classid);
						  echo $classinfo['class']." & ".$classinfo['section'];?></strong> </td> 
						  <td><strong><?php if(strlen($stuDetail->mobile) > 1) {echo $stuDetail->mobile; }else echo "N/A"; ?>
                            </strong><input type = "hidden" id="mnum<?php echo $count;?>" value="<?php echo $stuDetail->mobile;?>"/></td>
                      
                          
                          <td><strong><?php if(strlen($stuDetail->father_full_name) > 1) {echo $stuDetail->father_full_name; }else echo "N/A"; ?><?php //echo $rows->father_full_name;
                          
                        ?></strong><input type = "hidden" id="fname<?php echo $count;?>" value="<?php echo $stuDetail->father_full_name;?>"/></td></td>
                          
                          <td>
			  			
							<?php 
							
						
							 $fee_record =  $this->db->query("select deposite_months.deposite_month from deposite_months join fee_deposit on fee_deposit.invoice_no = deposite_months.invoice_no where fee_deposit.status=1 and fee_deposit.finance_start_date='$fsd' and deposite_months.student_id='$stu_id' order by deposite_months.id ASC ");
                             
							
			               $i=0;
							foreach($fee_record->result() as $fd):
								?>
								<span class="label label-success" style="line-height:20px;">
								<?php 
							 if($fd->deposite_month<4){
								$realm=  $fd->deposite_month-4+12;
					 
							}else{
							 $realm= $fd->deposite_month-4;}
							//	$realm = $fd->deposite_month-4;
								echo date('M-Y', strtotime("$realm months", strtotime($fdate)));
								//echo date("d-M-y",strtotime("$rdt1"));?>
								 </span>
									
							<?php $i++; endforeach;  ?>
						</td>
					
					
			  			<td>
			  			<?php  
			  			$cd=0;
			  			if($this->input->post("fsd")){
			  				$this->db->where("school_code",$this->session->userdata("school_code"));
								$this->db->where("student_id",$stu_id);
								$this->db->where("finance_start_date",$fsd);
							//	$this->db->where("status",1);
								$feedue = $this->db->get("fee_deposit");
								
								foreach($feedue->result() as $fd):?>
																
								<!-- <span class="label label-success" style="line-height:20px;">
								<?php //echo date("M-y",strtotime("$fd->diposit_date"));?> 
								 </span> -->
								<?php $cd=$cd+$fd->total;?>
							 <?php  endforeach; 
			  			   }
			  		  ?>
			  			<?php $totalduep += $cd; echo $cd;?>
							</td>
							<td>
							<?php  $totalpaidp += $total->totalpaid; echo $total->totalpaid;?>
						</td>
						<td><?php echo $this->feeModel->totFee_due_by_id($stu_id,1);?></td>
			  			<td>
							<a href="<?php echo base_url()?>index.php/feeControllers/feesDetail/<?php echo $stu_id;?>/<?php echo $fsd;?>" target="_blank" class="btn btn-blue">
								View Detail
							</a></td>
								<td>
							<button class="btn btn-yellow" id ="smstodew<?php echo $count;?>" >
								Send SMS
							</button></td>
							<script>
			  		
			  			$("#smstodew<?php echo $count;?>").click(function(){
			  				var smstodue = $("#rem<?php echo $count;?>").val();
			  				var sname = $("#sname<?php echo $count;?>").val();
			  				var fname = $("#fname<?php echo $count;?>").val();
			  				var mnum = $("#mnum<?php echo $count;?>").val();
							var amount = $("#amt<?php echo $count;?>").val();
							var amount1 = $("#amt1<?php echo $count;?>").val();
				// alert(amount);
				// alert(amount1);
					$.post("<?php echo site_url("index.php/feeControllers/feeRemSms") ?>",{smstodue : smstodue,sname : sname,fname : fname,mnum : mnum,amount : amount,amount1 : amount1}, function(data){
						$("#smstodew<?php echo $count;?>").html(data);
					});
				
				});
			  			</script>
			  			
			  		</tr>
			  		<?php  ?>
			  		<?php $count++;  endforeach; }}?>
        	</tbody>
				<tfoot>
				    <tr>
				        <td></td>
				        <td>Total Due</td>
				        <td></td>
				        <td></td>
				        <td></td>
				        <td></td>
				        <td></td>
				        <td></td>
				        <td><?php echo $sum;?></td>
				    </tr>
				</tfoot>
			</table>
		</div>
        <?php 
        }?>


<script>
	TableExport.init();
	
</script>