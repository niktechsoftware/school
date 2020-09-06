

<div class="row">
	<div class="col-md-12">
		<div class="panel panel-white">
			<div class="panel-heading panel-yellow">
				<h4 class="panel-title">Update  <span class="text-bold">Staff Job Category</span></h4>
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
			<div id="success"></div>
			<div class="tab-content">
			<div class="tab-pane fade in active">
			<div class="alert alert-info">
			<h3 class="media-heading text-center"><b>Welcome to Change Staff Category</b></h3>
		    <p>This is the area here you can change Staff Job Category.As you saw a table in this Job Category column show the current Job Category and you can change Job Category
		    by select Change Category column</p>
		     </div><br><br>
				<div class="panel-scroll height-400">
					<table class="table table-striped table-hover center table-responsive" id="sample-table-3" style="border:3px solid green;" >
						<thead class="text-blue text-large" style="border:3px solid green;">
							<tr>
								<th style="border:1px solid green;">Staff Name</th>
                                <th style="border:1px solid green;">Job Category</th>
                                <th style="border:1px solid green;">Change Category</th>
								<th style="border:1px solid green;">DOB</th>
								<th style="border:1px solid green;">Gender</th>
								<th style="border:1px solid green;">Mobile No</th>
								<th style="border:1px solid green;">Username</th>
								<th style="border:1px solid green;">Action</th>
							</tr>
                        </thead>
                        <?php  $staffid=$this->input->post('staff_id');
                             $this->db->where('username',$staffid);
                             $data=$this->db->get('employee_info')->row();
                        ?>
						<tbody style="border:3px solid green;">
                            <tr style="font-size:18px;">
                                <td style="border:1px solid green;"><?php echo $data->name ;?></td>
                                <td style="border:1px solid green;"><?php if($data->job_category==1){ echo "Accountant";}elseif($data->job_category==2){echo "Employee";}elseif($data->job_category==3){echo "Teacher";}else{echo "Principal";} ?></td>
                                <td style="border:1px solid green;">   
                                <select class="form-control text-uppercase" id="jobCategory" name="jobCategory" required>
                                    <option value="0">-Category-</option>
                                    <option value="1">Accountant</option>
                                    <option value="2">Employee</option>
                                    <option value="3">Teacher</option>
                                </select>
                                </td>
                                <!-- <td style="border:1px solid green;"><input type="text" id="job" value="<?php echo $data->job_category ;?>"></td> -->
                                <td style="border:1px solid green;"><?php echo $data->dob ;?></td>
                                <td style="border:1px solid green;"><?php if($data->gender==1){ echo "Male";}else{ echo "Female";}?></td>
                                <td style="border:1px solid green;"><?php echo $data->mobile ;?></td>
                                <input type="hidden" value="<?php echo $data->username ;?>" id="uname"/>
								<td style="border:1px solid green;"><?php echo $data->username ;?></td>	
								<td style="border:1px solid green;">
									<button class="btn btn-purple btn-sm" id="edit">
			                    		<i class="fa fa-edit"></i> &nbsp;Update
			                    	</button>
			                        <!-- <button class="btn btn-red btn-sm" id="deleteClass<?php echo $i; ?>" onClick="Refreshs()">
			                    		<i class="fa fa-trash-o"></i> &nbsp;Delete
			                    	</button> -->
								</td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
<script>
	
function Refreshs() {
            window.parent.location = window.parent.location.href;
        }
</script>