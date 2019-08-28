<!--  
Niktech software Solutions,niktechsoftware.com,schoolerp-niktech.in
  <meta name="description" content="Welcome to niktech software School business ERP . we proving school management erp software. we including online attendance with biometric attendance machine and tracking student with GPS technology & many other facilities in our school management erp system">
  <meta name="keywords" content="Enterprise resource planning,school,ERP,system software,attendance,biometric,online, school management,gps,niktech software solution, online result, online admit card,omr">
  <meta name="author" content="School management System software">
-->
<?php
$school_code = $this->session->userdata("school_code");
if($this->input->post("fsd")==$this->session->userdata("fsd")){


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
						<th>Student Mobile </th>
						<th>Father Name</th>
						<th>Paid Fee  Month</th>
						<th>Total Pay</th>
						<th>Total Due</th>
						<th>Total Paid</th>
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
				
				    $rowcss = "danger";
				    $count = 1;
				    $tot=0.00;
				    foreach($student->result() as $stuDetail):
				    $stu_id = $stuDetail->id;
				    $this->db->where("student_id",$stu_id);
				      $this->db->where("school_code",$school_code);
				    $rows = $this->db->get("guardian_info")->row();
				    if($this->input->post("fsd")==$this->session->userdata("fsd")){
				    $total = $this->db->query("SELECT SUM(paid) as totalpaid, SUM(total) as totaldeposite from fee_deposit WHERE student_id = '$stu_id' AND finance_start_date='$fsd' AND school_code='$school_code'")->row(); 
					}
					if($count%2==0){$rowcss="danger";}
					else{$rowcss ="warning";}?>
					<tr class="<?php echo $rowcss;?>">
			  			<td><?php echo $count;?></td>
			  				<td><strong><?php echo $stuDetail->username;?></strong>
			  			<td><?php echo $stuDetail->name;?>
			  			<input type = "hidden" id="sname<?php echo $count;?>" value="<?php echo $stuDetail->name;?>"/></td>
			  			<td><strong><?php if(strlen($rows->f_mobile) > 1) {echo $rows->f_mobile; }else echo "N/A"; ?>
                    </strong><input type = "hidden" id="mnum<?php echo $count;?>" value="<?php echo $rows->f_mobile;?>"/></td>
                      
                          
                          <td><strong><?php if(strlen($rows->father_full_name) > 1) {echo $rows->father_full_name; }else echo "N/A"; ?><?php //echo $rows->father_full_name;
                          
                        ?></strong><input type = "hidden" id="fname<?php echo $count;?>" value="<?php echo $rows->father_full_name;?>"/></td></td>
                          
                          <td>
			  			
							<?php 
							
							if($this->input->post("fsd")==$this->session->userdata("fsd")){
							$fee_record = $this->feemodel->getperfeerecord($stuDetail->id); 
							}
							else
							{
								$this->db->where("school_code",$this->session->userdata("school_code"));
								$this->db->where("student_id",$stu_id);
								$this->db->where("finance_start_date",$fsd);
								$fee_record = $this->db->get("fee_deposit");
							}
			               $i=0;
							foreach($fee_record->result() as $fd):
								?>
								<span class="label label-success" style="line-height:20px;">
								<?php echo date("d-M-y",strtotime("$fd->diposit_date"));?>
								 </span>
									
							<?php  endforeach; ?>
						</td>
						<td>
			  			<?php  
			  			$cd=0;
			  			if($this->input->post("fsd")==$this->session->userdata("fsd")){
			  				$this->db->where("school_code",$this->session->userdata("school_code"));
								$this->db->where("student_id",$stu_id);
								$this->db->where("finance_start_date",$fsd);
							//	$this->db->where("status",1);
								$feedue = $this->db->get("fee_deposit");
								
								foreach($feedue->result() as $fd):?>
																
								<!-- <span class="label label-success" style="line-height:20px;">
								<?php echo date("M-y",strtotime("$fd->diposit_date"));?> 
								 </span> -->
								<?php $cd=$cd+$fd->total;?>
							 <?php  endforeach; 
			  			   }
			  		  ?>
			  			<input type = "hidden" id="rem<?php //echo $count;?>" value="<?php //echo $vsms;?>"/>
			  			<?php $totalduep += $cd; echo $cd;?>
			  			</td>
						<td>
							<?php 
							$tilldtdu = $total->totaldeposite-$total->totalpaid;
							$tilldatedue += $tilldtdu; echo $tilldtdu;?>
						</td>
						<td>
							<?php  $totalpaidp += $total->totalpaid; echo $total->totalpaid;?>
						</td>
			  		
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
					<?php 
					
					?>
					$.post("<?php echo site_url("index.php/feeControllers/feeRemSms") ?>",{smstodue : smstodue,sname : sname,fname : fname,mnum : mnum}, function(data){
						$("#smstodew<?php echo $count;?>").html(data);
					});
				
				});
			  			</script>
			  			
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