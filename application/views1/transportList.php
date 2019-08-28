<?php
	$this->db->where("Transport_fee >","0.00");
	$val = $this->db->get("transport_root_amount");
	if($val->num_rows()>0){
	

?> 
<div class="container">
	<div class="row">
		<div class="col-md-13">
			<!-- start: EXPORT DATA TABLE PANEL  -->
			<div class="panel panel-white">
				<?php if($Warning=$this->session->flashdata("Warning")){
	echo "<div class='alert alert-danger'>".$Warning."</div>";
}?>
	
				<div class="panel-heading">
					<h4 class="panel-title">Export <span class="text-bold">Transport Data</span> Table</h4>
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
			<table class="table table-striped table-hover" id="sample-table-2">
				<thead>
					<tr class ="success" class="text-uppercase">
						<th>Sno</th>
						<th>Stud. Id</th>
						<th>Stud. Name</th>
						<th>Class & Sec</th>
						<th>Father Name</th>
						<th>Father Mobile</th>
						<th>Address</th>
						<th>Vehicle Name </th>
						<th>Vehicle No</th>
						<th>Picup Point</th>
						<th> Drop Point</th>
						<th>Root</th>
						<th>Transport Fee</th>
					</tr>
				</thead>
				
				<tbody>
				<?php 
				$count=1;foreach($request as $row):
				                       
				                       $this->db->where("username",$row->username);
										$snameid  = $this->db->get("student_info")->row();

										     $this->db->select('class_name,section');
											  $this->db->where('id',$row->class_id);
										      $classInfo=$this->db->get('class_info')->row();

										      $this->db->select('section');
											  $this->db->where('id',$classInfo->section);
											  $this->db->where("school_code",$this->session->userdata("school_code"));
										      $sectionInfo=$this->db->get('class_section')->row();

										$this->db->where("school_code",$this->session->userdata("school_code"));
										$this->db->where('id',$row->v_id);
			                              $transport = $this->db->get("transport");

                                    
										   $this->db->where('v_id',$row->v_id);
			                              $transportrootamount = $this->db->get("transport_root_amount");



				                          $this->db->where("student_id",$snameid->id);
										    $fname  = $this->db->get("guardian_info");
										    if($fname->num_rows()>0){ 

				                         if($count%2==0){$rowcss="danger";}else{$rowcss ="warning";}?>
				                         <tr class="<?php echo $rowcss;?>" class="text-uppercase">
                                         <td><?php echo $count; ?></td>
								<td><a href="<?php echo base_url()?>index.php/studentController/admissionSuccess/<?php echo $snameid->id?>">	<?php echo $row->username; ?></a></td>
										<td><?php echo strtoupper($row->name); ?></td>	
										
										<td><?php 
										echo strtoupper($classInfo->class_name)." "."[".($row->class_id)."]".$sectionInfo->section; ?></td>	
										<td><?php echo strtoupper($fname->row()->father_full_name); ?></td>
										<?php } else{
										    ?>	<td><?php echo "Please Update";?></td>	
										<?php }?>	
										<td><?php echo strtoupper($fname->row()->f_mobile); ?></td>
										<td><?php echo  strtoupper($row->address1." ".$row->city.",".$row->state."-".$row->pin_code);?></td>



			  			             <td ><?php if($transport->num_rows()>0){$transport1=$transport->row();   


			  			             	echo strtoupper($transport1->vehicle_name);}?></td>
			  			
			  			<td><?php if($transport->num_rows()>0){$transport1=$transport->row();echo $transport1->vehicle_numnber;}else{ echo "Please Update the Student Transport Detail";}?></td>
			  			<td><?php if($transportrootamount->num_rows()>0){$transportrootamount1=$transportrootamount->row();echo strtoupper($transportrootamount1->pickup_points);}else{ echo "Please Update the Student Transport Detail";}?></td>		
			  			<td><?php if($transportrootamount->num_rows()>0){$transportrootamount1=$transportrootamount->row();echo strtoupper($transportrootamount1->drop_points);}else{ echo "Please Update the Student Transport Detail";}?></td>
						<td><?php if($transportrootamount->num_rows()>0){$transportrootamount1=$transportrootamount->row();echo strtoupper($transportrootamount1->root);}else{ echo "Please Update the Student Transport Detail";}?></td>
			  			<td><?php if($transportrootamount->num_rows()>0){$transportrootamount1=$transportrootamount->row();echo $transportrootamount1->transport_fee;}else{ echo "Please Update the Student Transport Detail";}?></td>
			  		</tr>
			  		<?php $count++; ?>
			  		<?php endforeach;?>
			  		
				</tbody>
			</table>
		</div>
		
		<br/></div></div></div></div></div>
	 <?php }else 
		{echo "NO Record Found";}?>
 
