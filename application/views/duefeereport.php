<div class="row">
	<div class="col-md-12">
	    <?php $this->load->model('feeModel');?>
		<!-- start: RESPONSIVE TABLE PANEL -->
		<div class="panel panel-white">
			<div class="panel-heading panel-blue">
				<h4 class="panel-title">
					Student <span class="text-bold">Fee Report</span>
				</h4>
				<div class="panel-tools">
					<div class="dropdown">
						<a data-toggle="dropdown"
							class="btn btn-xs dropdown-toggle btn-transparent-grey"> <i
							class="fa fa-cog"></i>
						</a>
						<ul class="dropdown-menu dropdown-light pull-right" role="menu">
							<li><a class="panel-collapse collapses" href="#"><i
									class="fa fa-angle-up"></i> <span>Collapse</span> </a></li>
							<li><a class="panel-refresh" href="#"> <i class="fa fa-refresh"></i>
									<span>Refresh</span>
							</a></li>
							<li><a class="panel-config" href="#panel-config"
								data-toggle="modal"> <i class="fa fa-wrench"></i> <span>Configurations</span>
							</a></li>
							<li><a class="panel-expand" href="#"> <i class="fa fa-expand"></i>
									<span>Fullscreen</span>
							</a></li>
						</ul>
					</div>
					<a class="btn btn-xs btn-link panel-close" href="#"> <i
						class="fa fa-times"></i>
					</a>
				</div>
			</div>
			<div class="panel-body">
				<div class="alert alert-info">
					<button data-dismiss="alert" class="close">×</button>
					<h4 class="media-heading text-center">Welcome to Student Fee Report
						Area</h4>
					<p>Here you can see monthly Due  Fee Report Detail.To Pay Your Fee Please Contact Accountant.
						</p>
				</div>
				<br/>
					<br/>
           <div id="examTable">
            <div class ="table-responsive">
			<table
					class="table table-striped table-hover center table-responsive"
			id="f_tb"	>
					<thead>
                <tr tr class="text-center"
							style="background-color: #1ba593; color: white;">
						<th  class="text-center">SNo</th>
						<th  class="text-center">Student Id</th>
						<th  class="text-center">Student Name</th>
						<th  class="text-center">Class & Section</th>
						<th  class="text-center">Father Mobile </th>
						<th  class="text-center">Father Name</th>
						<th  class="text-center">Total Due Amount</th>
							</tr>
				</thead>
				<?php 
				
				    
				    $count = 1;
				    $tot=0.00;
				    $totalpaidp=0;
				    $totalduep=0;
				    $tilldatedue=0;
				    ?>
				<tbody>
				<?php  
				$this->load->model('allFormModel');
				$this->load->model('feeModel');
				$stu_id=$this->uri->segment(3);;
				$school_code=$this->session->userdata('school_code');
				$this->db->where("id",$stu_id);
			    $stuDetail=$this->db->get("student_info")->row();
			    $this->db->where("student_id",$stu_id);
			    $stuDetailp=$this->db->get("guardian_info")->row();
			    $this->db->where("id",$stuDetail->class_id);
			    $classDetailp=$this->db->get("class_info")->row();
				 $this->db->where("id",$classDetailp->section);
			    $class_section=$this->db->get("class_section")->row();
					?>
					<tr>
			  		<td  class="text-center"><?php echo $count;?></td>
			  				<td  class="text-center"><strong><?php echo $stuDetail->username;?></strong></td>
			  			<td  class="text-center"><?php echo $stuDetail->name;?>
			  		    </td>
						      <td><strong><?php 
						echo  $classinfo =  $this->session->userdata('classid');
						  echo $classDetailp->class_name." & ".$class_section->section;?></strong> </td> 
						  <td  class="text-center"><strong><?php if(strlen($stuDetail->mobile) > 1) {echo $stuDetail->mobile; }else echo "N/A"; ?>
                            </strong><input type = "hidden" id="mnum<?php echo $count;?>" value="<?php echo $stuDetail->mobile;?>"/></td>
                       <td  class="text-center"><strong><?php if(strlen($stuDetailp->father_full_name) > 1) {echo $stuDetailp->father_full_name; }else echo "N/A"; ?><?php //echo $rows->father_full_name;
                        ?></strong><input type = "hidden" id="fname<?php echo $count;?>" value="<?php echo $stuDetailp->father_full_name;?>"/></td></td>
                        
						<td  class="text-center"><?php $feetotdue= $this->feeModel->totFee_due_by_id($stu_id,1);
						    echo $feetotdue;?>
					</tr>
			  		<?php  ?>
			  	
        	</tbody>
			
			</table>
		</div>
	</div>
</div>
</div>
</div>
</div>