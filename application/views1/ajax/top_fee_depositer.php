

<?php
$school_code = $this->session->userdata("school_code");
if($this->input->post("fsd")){
 if($student->num_rows() > 0){	
?>
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
						<!--<li>-->
						<!--	<a href="#" class="export-pdf" data-table="#sample-table-2" >-->
						<!--		Save as PDF-->
						<!--	</a>-->
						<!--</li>-->
						<!--<li>-->
						<!--	<a href="#" class="export-png" data-table="#sample-table-2">-->
						<!--		Save as PNG-->
						<!--	</a>-->
						<!--</li>-->
						<!--<li>-->
						<!--	<a href="#" class="export-csv" data-table="#sample-table-2" >-->
						<!--		Save as CSV-->
						<!--	</a>-->
						<!--</li>-->
						<!--<li>-->
						<!--	<a href="#" class="export-txt" data-table="#sample-table-2" data-ignoreColumn ="3,4">-->
						<!--		Save as TXT-->
						<!--	</a>-->
						<!--</li>-->
						<!--<li>-->
						<!--	<a href="#" class="export-xml" data-table="#sample-table-2" data-ignoreColumn ="3,4">-->
						<!--		Save as XML-->
						<!--	</a>-->
						<!--</li>-->
						<!--<li>-->
						<!--	<a href="#" class="export-sql" data-table="#sample-table-2" data-ignoreColumn ="3,4">-->
						<!--		Save as SQL-->
						<!--	</a>-->
						<!--</li>-->
						<!--<li>-->
						<!--	<a href="#" class="export-json" data-table="#sample-table-2" data-ignoreColumn ="3,4">-->
						<!--		Save as JSON-->
						<!--	</a>-->
						<!--</li>-->-->/li>-->
						<!--<li>-->
						<!--	<a href="#" class="export-doc" data-table="#sample-table-2" data-ignoreColumn ="3,4">-->
						<!--		Export to Word-->
						<!--	</a>-->
						<!--</li>-->
						<!--<li>-->
						<!--	<a href="#" class="export-powerpoint" data-table="#sample-table-2" data-ignoreColumn ="3,4">-->
						<!--		Export to PowerPoint-->
						<!--	</a>-->
						<!--</li>-->
					</ul>
				</div>
			</div>
		</div>
		<div class="table-responsive">
		<?php $this->db->where('school_code',$this->session->userdata('school_code'));
		$sende_Detail=$this->db->get('sms_setting')->row();
		?>
		<div>   <p class="alert alert-danger"> Available SMS Balance = <?php $cbs=checkBalSms($sende_Detail->uname,$sende_Detail->password);
		echo $cbs;?></p>
										 <p class="alert alert-info"> Note : This is the area you can send Fee reminder to send click send sms button . If you send SMS change to Success Message send SuccessfulLy . <br>
										</div>
			<table class="table table-striped table-hover" id="sample-table-2">
				<thead>
					<tr class = "success">
						<th>SNo</th>
						<th>Student Username</th>
						<th>Student Name</th>
						<th>Father Mobile </th>
						<th>Father Name</th>
						<th>Paid Fee  Month</th>
						<th>Total Paid Amount</th>
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
				
				    $rowcss = "danger";
				    $count = 1;
						$tot=0.00;
						$this->db->where("id",$fsd);
						$fdate =	$this->db->get("fsd")->row()->finance_start_date;
				    foreach($student->result() as $stuDetail):
				    	$stu_id = $stuDetail->id;
				    	$this->db->where("student_id",$stu_id);
				    	$this->db->where("school_code",$school_code);
				    	$rows = $this->db->get("guardian_info")->row();
				    	if($this->input->post("fsd")==$this->session->userdata("fsd")){
				    		$total = $this->db->query("SELECT SUM(paid) as totalpaid, SUM(total) as totaldeposite,invoice_no from fee_deposit WHERE student_id = '$stu_id' AND finance_start_date='$fsd' AND school_code='$school_code'")->row(); 
							}
							$rowcss = $count % 2 == 0 ? "danger" : "warning";
						?>
					<tr class="<?php echo $rowcss;?>">
			  		<td><?php echo $count;?></td>
			  				<td><strong><?php echo $stuDetail->username;?></strong>
			  			<td><?php echo $stuDetail->name;?>
			  			<input type = "hidden" id="sname<?php echo $count;?>" value="<?php echo $stuDetail->name;?>"/></td>
			  			<td><strong><?php if(strlen($stuDetail->mobile) > 1) {echo $stuDetail->mobile; }else echo "N/A"; ?>
                    </strong><input type = "hidden" id="mnum<?php echo $count;?>" value="<?php echo $stuDetail->mobile;?>"/></td>
                      
                          
                          <td><strong><?php if(strlen($rows->father_full_name) > 1) {echo $rows->father_full_name; }else echo "N/A"; ?><?php //echo $rows->father_full_name;
                          
                        ?></strong><input type = "hidden" id="fname<?php echo $count;?>" value="<?php echo $rows->father_full_name;?>"/></td></td>
                          
                          <td>
			  			
							<?php 
							
						
								//$this->db->where("school_code",$this->session->userdata("school_code"));
								$this->db->where("student_id",$stu_id);
								$this->db->where("fsd",$fsd);
								$fee_record = $this->db->get("deposite_months");
							
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
							<?php  $totalpaidp += $total->totalpaid; echo $total->totalpaid;?>
						</td>
						
						
			  			
			  		</tr>
			  		<?php  ?>
			  		<?php $count++; ?>
			  		<?php endforeach;?>
				</tbody>
			</table>
		</div>
	
		
<?php }else{?>

<br/><br/>
			<div class="alert alert-block alert-danger fade in">
				<button data-dismiss="alert" class="close" type="button">
					&times;
				</button>
				<h4 class="alert-heading"><i class="fa fa-times"></i> Error! <?php echo $student->num_rows();?></h4>
				<p>
					No record found from Fee database please submit fee first of this class &amp; section... 
				</p>
			</div>
		

	<br/><br/>
	<div class="alert alert-block alert-danger fade in">
		<button data-dismiss="alert" class="close" type="button">
			&times;
		</button>
		<h4 class="alert-heading"><i class="fa fa-times"></i> Error! <?php echo $student->num_rows();?></h4>
		<p>
			No record found from this class and section... 
		</p>
		<p>
			Make sure students are avaliable in this class section... :)
		</p>
	</div>

<?php }}?>


<script>
	TableExport.init();
	
</script>