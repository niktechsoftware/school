

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
						<th>Total Due Amount</th>
						<!-- <th>Sms Send</th> -->
					</tr>
				</thead>
				
				<tbody>
				<?php 
				
				    $rowcss = "danger";
						$count = 1;
						$dt=0;
						$pbalance=0;
						$tot=0.00;
						$this->db->where("id",$fsd);
						$fdate = $this->db->get("fsd")->row()->finance_start_date;
				    foreach($student->result() as $stuDetail):
				    $stu_id = $stuDetail->id;
				    $this->db->where("student_id",$stu_id);
				    $this->db->where("school_code",$school_code);
				    $rows = $this->db->get("guardian_info")->row();
				    if($this->input->post("fsd")==$this->session->userdata("fsd")){
				    $total = $this->db->query("SELECT SUM(paid) as totalpaid, SUM(total) as totaldeposite,invoice_no from fee_deposit WHERE student_id = '$stu_id' AND finance_start_date='$fsd' AND school_code='$school_code'")->row(); 
				
					}
					if($count%2==0){$rowcss="danger";}
					else{$rowcss ="warning";}?>
					<tr class="<?php echo $rowcss;?>">
			  			<td><?php echo $count;?></td>
			  			<td><strong><?php echo $stuDetail->username;?></strong></td>
			  			<td><?php echo $stuDetail->name;?>
			  			<input type = "hidden" id="sname<?php echo $count;?>" value="<?php echo $stuDetail->name;?>"/></td>
			  			<td><strong><?php if(strlen($stuDetail->mobile) > 1) {echo $stuDetail->mobile; }else echo "N/A"; ?></strong>
                        <input type = "hidden" id="mnum<?php echo $count;?>" value="<?php echo $stuDetail->mobile;?>"/>
                        </td>
                        <td><strong><?php if(strlen($rows->father_full_name) > 1) {echo $rows->father_full_name; }else echo "N/A"; ?></strong>
                        <input type = "hidden" id="fname<?php echo $count;?>" value="<?php echo $rows->father_full_name;?>"/>
                        </td>
    					<td>
							<?php 
            						$depmonth=array();
            						$mbk=0;
								 	$this->db->where('invoice_no',$total->invoice_no); 
								 	$this->db->where('student_id',$stu_id);
                                	$mbalance=$this->db->get('feedue');
								 	//print_r($mbalance->mbalance);
								 	if($mbalance->num_rows()>0){                                                   
								 	if(strlen($mbalance->row()->mbalance)>0){
								 	    echo "Previous Balance " ;
									echo	$amounttobesort[$dt]=$mbk= $mbalance->row()->mbalance."<br>";
									}}
									$cdate = date("Y-m-d");
									$cmonth = date("Y-m",strtotime($cdate));
									//print_r($stu_id);
									$this->db->where("student_id",$stu_id);
									$dipom = $this->db->get("deposite_months");
									if($dipom->num_rows()>0){
										$g=0;	
											foreach($dipom->result() as $dip):
												$depmonth[$g]=$dip->deposite_month;
												//echo $depmonth[$g];
												$g++;	
											
											endforeach;
												//print_r($depmonth);
										$this->db->where_not_in("month_number",$depmonth);
										$this->db->where("school_code",$this->session->userdata("school_code"));
										$fcd = 	$this->db->get("fee_card_detail");
										if($fcd->num_rows()>0){
							
											$rt=0;$month="";	
											foreach($fcd->result() as $fcg):
											if($fcg->month_number<4){
												$roldm=$fcg->month_number-4+12;
											}
											else{
												$roldm=$fcg->month_number-4;
											}
									$oldm =  date('Y-m', strtotime("$roldm months", strtotime($fdate)));
									if($oldm<=$cmonth){
										$searchM[$rt]=$fcg->month_number;
										echo $duedate= date("M-Y",strtotime($oldm));
										$month =$month." and ".$duedate;
									
										$rt++;
								//	echo $cmonth;
							}
							
									endforeach;
								if($rt>0){
								$searchM[$rt]=13;
									//$this->db->distinct();
								
									$this->db->select_sum("fee_head_amount");
									if($school_code ==1){
										$this->db->where("cat_id",3);}
									$this->db->where("fsd",$fsd);
									$this->db->where("class_id",$stuDetail->class_id);
									
								 $this->db->where_in("taken_month",$searchM);
								 
								 $fee_head = $this->db->get("class_fees");
								 if($fee_head->num_rows()>0){
									$amounttobesort[$dt]= $fee_head =$fee_head->row()->fee_head_amount;
								 echo "<br>".$fee_head;
								 }else{
									 echo "fee Not found";								}
							 }
							}else{
								echo "Define Deposite Date in Configuration Fee section";
							}

							}else{
								$this->db->where("school_code",$this->session->userdata("school_code"));
								$fcd = 	$this->db->get("fee_card_detail");
								$rt=0;
									$month="";
								foreach($fcd->result() as $fcg):
									if($fcg->month_number<4){
										$roldm=$fcg->month_number-4+12;
									}else{
									$roldm=$fcg->month_number-4;
									}	$oldm =  date('Y-m', strtotime("$roldm months", strtotime($fdate)));
									if($oldm<=$cmonth){
										$searchM[$rt]=$fcg->month_number;
										echo $duedate = date("M-Y",strtotime($oldm));
							 	    $month =$month." and ".$duedate;
										$rt++;
								//	echo $fcg->month_number;
								//	echo $cmonth;
									
							}
								endforeach;
								$adable_amount=0;
						  	$searchM[$rt]=13;
								//$this->db->distinct();
								$this->db->select_sum("fee_head_amount");
								$this->db->where("fsd",$fsd);
								$this->db->where("class_id",$stuDetail->class_id);
							//	print_r($stuDetail->class_id);
							if($school_code ==1){$this->db->where("cat_id",3);}
							    $this->db->where_in("taken_month",$searchM);
								$fee_head = $this->db->get("class_fees");
								if($fee_head->num_rows()>0){

									$this->db->where("class_id",$stuDetail->class_id);
									//	print_r($stuDetail->class_id);
								
											$this->db->where_in("taken_month",13);
										$one_all_amount = $this->db->get("class_fees");
										$one_all_amount=$one_all_amount->row()->fee_head_amount;
									
										for($ui=0;$ui<$rt;$ui++){
											if($ui>0){
												$adable_amount =$one_all_amount+$adable_amount;
											}
										}
										$amounttobesort[$dt]=$fee_head =$fee_head->row()->fee_head_amount+$adable_amount;
								echo "<br>".$fee_head;
								}else{
									echo "fee Not found";}
							}

							?>
						</td>
			  		</tr>
			  		<?php $count++; ?>
			  		<?php $dt++; endforeach;?>
				</tbody>
			</table>
		</div>
		<?php rsort($amounttobesort) ;
        for($i=0;$i<$dt;$i++)
        {
        	echo $amounttobesort[$i];?><br><?php
        }
        ?>
		
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