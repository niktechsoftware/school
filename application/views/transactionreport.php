
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<!-- start: EXPORT DATA TABLE PANEL  -->
			<div class="panel panel-white">
			    

<?php if($Warning=$this->session->flashdata("Warning")){
	echo "<div class='alert alert-danger'>".$Warning."</div>";
}?>
				<div class="panel-heading panel-red">
					<h4 class="panel-title"> <span class="text-bold">Student Data Panel</span></h4>
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
				<div class="panel-body">
				    			<div class="alert btn-purple">
				    			    <button data-dismiss="alert" class="close">×</button>
<h4 class="media-heading text-center">Welcome to Transport Indivisual Report Area</h4>
<p> if you want to delete any Report  then click on Delete link.<br><br>

</p> </div>
				    
					<div class="row">
						<div class="col-md-12 space20">
							<div class="btn-group pull-right">
								<button data-toggle="dropdown" class="btn btn-green dropdown-toggle">
									Export <i class="fa fa-angle-down"></i>
								</button>
								<?php if($this->session->userdata('login_type') == 'admin'){?>
								<ul class="dropdown-menu dropdown-light pull-right">
								
									<li>
										<a href="#" class="export-excel" data-table="#sample-table-2" >
											Export to Excel
										</a>
									</li>
									
								</ul>
								<?php }?>
							</div>
						</div>
					</div>
					<div class="table-responsive">
						<div class="table-responsive">
							<table class="table table-striped table-hover" id="sample-table-2">
								<thead>
									<tr style="background-color:#1ba593; color:white;">
										<th>SNo.</th>
										<th>Expenditure Name</th>
										<th>Expenditure Name</th>
									
										<th>Paid To</th>
										<th>Reason</th>
								    <th>Paid amount</th>
										<th>Date</th>
										<th>Invoice Number</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>
									<?php
                  $this->db->where("school_code",$this->session->userdata("school_code"));
                  $transportdata=$this->db->get("cash_payment");
                  if($transportdata->num_rows()>0){

                  $sno = 1; foreach ($transportdata->result() as $tdt): 
                  
										?>
									<tr>
										<td><?php echo $sno; ?></td>
										<td><?php echo $tdt->expenditure_name; ?></td>
										<td><?php echo $tdt->exp_depart; ?></td>
                    <td><?php
                    if(strlen($tdt->id_name)>0){
                      echo $tdt->name ."[ " .$tdt->phone_no ."]";
                    }else{
                      echo $tdt->valid_id;
                    } ?></td>
										<td><?php echo $tdt->reason; ?></td>
                    <td><?php echo $tdt->amount; ?></td>
                    <td><?php echo $tdt->date; ?></td>
                    <td><a href="<?php echo base_url(); ?>index.php/dayBookControllers/invoiceCashPayment/<?= $tdt->receipt_no;?>/<?= $this->session->userdata("fsd"); ?>" class="btn btn-info"><?php echo $tdt->receipt_no; ?></a></td>
									
									
										<?php if($this->session->userdata('login_type') == 'admin'){ ?>
                    <td>
										<a href="<?php echo base_url(); ?>index.php/dayBookControllers/deletecashinvoice/<?= $tdt->receipt_no;?>/<?= $this->session->userdata("fsd"); ?>" class="btn btn-danger">Delete</a></td>
										<?php }?>
									</tr>
									<?php $sno++;  endforeach; } ?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
			<!-- end: EXPORT DATA TABLE PANEL -->
		</div>
	</div>
	<!-- end: PAGE CONTENT-->
</div>