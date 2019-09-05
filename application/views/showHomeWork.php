<div class="row">
	<div class="col-md-12">
		<!-- start: RESPONSIVE TABLE PANEL -->
		<div class="panel panel-white">

			<div class="panel-heading panel-blue">
				<h4 class="panel-title ">Home Work <span class="text-bold"> Details</span></h4>
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
			<br>
			<div class="panel-body">
			    <div class="alert alert-info">
					<h3 class="media-heading text-center">Welcome to show Homework Area</h3>
					<p class="media-timestamp">To know the show homework for all the student / teacher / employee, go to the Home Work 
						for field and select it and you will start doing a list of homework and you can also take a printout of it.
					</p>
				</div>
			
				<div class="form-group">

				<div class="col-sm-12">

			<?php if($this->session->userdata('login_type')=="admin"){ ?>
			<div class="row">
				<div class="col-md-12 space20">
				<div class="btn-group pull-right">
				<button data-toggle="dropdown" class="btn btn-green dropdown-toggle">
					Export <i class="fa fa-angle-down"></i>
				</button>
				<ul class="dropdown-menu dropdown-light pull-right">
					<li>
						<a href="#" class="export-excel" data-table="#sample-table-2" data-ignoreColumn ="3,4">
							Export to Excel
						</a>
					</li>
				</ul>
			</div>
		</div>


		</div>
<?php } ?>
		<div class="row space20">
					<div class="col-sm-6">
						<div class="row">
							<div class="col-sm-6"><label>Home Work For</label></div>
							<div class="col-sm-6">
							<div><?php $do=$this->uri->segment(3);
								if($do)
								{echo "successfully home work is Given";
								}?></div>
								<select name="showhomeworkfor" id="showhomeworkfor">
								<option value="01">-Select-</option>
									<?php $logtype = $this->session->userdata('login_type');
											if($logtype == "admin"){
											?>
											<option value="employee">Employee</option>
											<option value="teachers">Teachers</option>
											<option value="students">Students</option>
											<?php
											}
											elseif($logtype == "3"){
											?>
											<option value="teachers">Teachers</option>
											<option value="students">Students</option>
											
											<?php }
											elseif($logtype == "2"){
												?>
											<option value="employee">Employee</option>
											<?php }
											elseif($logtype == "student"){
												?>
											<option value="students">Students</option>
											<?php }
											elseif($logtype == "accountent"){
											?>
											<option value="employee">Employee></option>
											<option value="teachers">Teachers</option>
											<option value="students">Students</option>
										<?php	}
											 ?>
								</select>
							</div>
						</div>
					</div>

				</div>
				
				<?php if($this->session->userdata('login_type')!="student"){ ?>
		     	<div id="showStudent">
				<div class="row">
		
					<div class="col-sm-6">
					<div class="row">
					<div class="col-sm-6">
					<label>Section</label></div>
					<div class="col-sm-6">
					<select class="form-control" id="classv" name="section">
                      <option value="01">-Select Section-</option>
                      <?php foreach ($noc as $en):
                      ?>
                      <option value="<?php echo $en->id;?>"><?php echo $en->section?></option>
                      <?php endforeach;?>
                    </select></div>
						</div>
					</div>
					<div class="col-sm-6">
						<div class="row">
							<div class="col-sm-6">Class Name</div>
							<div class="col-sm-6"><select name="classv" id="sectionId" class="form-control">
                    </select></div>
						</div>
					</div>
				</div>

			</div>
					  <?php } ?>
			<br>
			<br>
			<div id="teacherWork"></div>
		<div id="studentWork"></div>
		<div id="subjecthomework"></div> 


	</div>
	</div>
			</div><!-- end: panel Body -->
		</div><!-- end: panel panel-white -->
	</div><!-- end: MAIN PANEL COL-SM-12 -->
</div><!-- end: PAGE ROW-->