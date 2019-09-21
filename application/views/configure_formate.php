<!-- start: PAGE CONTENT -->
<div class="row">
  <div class="col-sm-12">
    <!-- start: INLINE TABS PANEL -->
    <div class="panel panel-white">
     
      <div class="panel-body">
        <div class="row">
          <div class="col-sm-12">
            <div class="tabbable">
              <ul id="myTab" class="nav nav-tabs">
                <li class="active">
                  <a href="#myTab_example1" data-toggle="tab">
                    <i class="green fa fa-home"></i> Report Card Formate
                  </a>
                </li>
                <li>
                  <a href="#myTab_example2" data-toggle="tab">
                    <i class="green fa fa-home"></i> ID Card Formate
                  </a>
                </li>
                <li>
                  <a href="#myTab_example3" data-toggle="tab">
                    <i class="green fa fa-home"></i> TC Formate
                  </a>
                </li>
				<li>
                  <a href="#myTab_example4" data-toggle="tab">
                    <i class="green fa fa-home"></i> CC Formate
                  </a>
                </li>
              </ul>
              <div class="tab-content">
			  <!----1st tab end--->
                <div class="tab-pane fade in active" id="myTab_example1">
                  <div class="alert panel-pink">
                    <button data-dismiss="alert" class="close">×</button>
                    <h3 class="media-heading text-center">Welcome to Report Card Formate Section</h3>
                    <a class="alert-link" href="#"></a>
                   please select a formate for view of student report card. after select a formate you can view
				   the preview of that selected formate.if you like that formate then click save button which is
				   display in bottom side of that formate. if you want to see another formate you can select another 
				   formate and then click save button to configure that formate.
                  </div>
                  <div class="row">
					<div class="col-sm-4">
						<div class="panel-heading panel-red border-light">
							<h4 class="panel-title">Select Formate</h4>
						</div>
						<div class="panel-body">
							<div class="form-group">
								<select id="formate_rep" class="form-control" >
									<option value="">--Select--</option>
									<option value="1">Formate 1</option>
									<option value="2">Formate 2</option>
									<option value="3">Formate 3</option>
								</select>
							</div>
							<div class="text-red text-small">Please select a formate for student report card.</div>
						</div>
						<div>
							<button class="btn btn-green btn-block" id="rep_formate_save">
								Save <i class="fa fa-arrow-circle-right"></i>
							</button>
						</div>
					</div>
					<div class="col-sm-8">
						<div id="report_1"><img alt="" src="<?php echo base_url(); ?>assets/images/report_1.png" height="500px" width="650px" ></div>
						<div id="report_2"><img alt="" src="<?php echo base_url(); ?>assets/images/report_2.png" height="500px" width="400px" ></div>
						<div id="report_3"><img alt="" src="<?php echo base_url(); ?>assets/images/report_3.png" height="500px" width="400px" ></div>
					</div>
                  </div>
                </div>
				<!----1st tab end--->
				<!----2nd tab start--->
                <div class="tab-pane fade" id="myTab_example2">
                  <div class="alert btn-azure">
                    <button data-dismiss="alert" class="close">
                      ×
                    </button>
                    <h3 class="media-heading text-center">Welcome To Add or Update Section Area </h3>
                    <a class="alert-link" href="#"></a>
                    This is important to create Section after creating Stream because Subject and Classes requires a
                    valid section.You should not change Section name after creating and declare the Subjects and
                    Classes.If you change it may affect your Exam and Time Table Section. <br>If you
                    want to <strong>Add</strong> a new Section to your School, Please type in the <strong> Section
                      Name</strong> into the box given below the <strong>Section column</strong> and press 
                    <strong>Add Section</strong> Button.To <strong>Edit</strong> existing Section Edit it's Name and
                    Press <strong>Edit</strong> Button next to the row ,
                    And to <strong>Delete</strong> a Section simply Press <strong>Delete</strong> Button.
                  </div>

                  <div class="row">
					<div class="col-sm-4">
						<div class="panel-heading panel-red border-light">
							<h4 class="panel-title">Select Formate</h4>
						</div>
						<div class="panel-body">
							<div class="form-group">
								<select id="formate_id" class="form-control" required="">
									<option value="">--Select--</option>
									<option value="1">Formate 1</option>
									<option value="2">Formate 2</option>
									<option value="3">Formate 3</option>
								</select>
							</div>
							<div class="text-red text-small">Please select a formate for student ID card.</div>
						</div>
						<div>
							<button class="btn btn-green btn-block" id="id_formate_save">
								Save <i class="fa fa-arrow-circle-right"></i>
							</button>
						</div>
					</div>
					<div class="col-sm-8">
						<div id="id_1"><img alt="" src="<?php echo base_url(); ?>assets/images/id_1.png" height="300px" width="500px"></div>
						<div id="id_2"><img alt="" src="<?php echo base_url(); ?>assets/images/id_2.png" height="300px" width="500px"></div>
						<div id="id_3"><img alt="" src="<?php echo base_url(); ?>assets/images/id_3.png" height="300px" width="500px"></div>
					</div>
                  </div>
                </div>
				<!----2nd tab end--->
				<!----3rd tab start--->
                <div class="tab-pane fade" id="myTab_example3">
                  <div class="alert btn-green">
                    <button data-dismiss="alert" class="close">
                      
                    </button>
                    <h3 class="media-heading text-center">Welcome to Add Class Section</h3>
                    <p class="media-timestamp">Please insure that you have created Stream and Section for Class. This is
                      Class creation area. You have to provide Class Name (Like 1st,8th,12th etc..) and select Class
                      stream
                      (Like : Science, Arts, Commerce etc) . If Stream is not applicable then select (None of these).
                      After this
                      select Section if applicable, otherwise none,and after that click Save Button and Save your Class.</p>
                      
                  </div>
                  <div class="row">
                    <div class="col-sm-4">
						<div class="panel-heading panel-red border-light">
							<h4 class="panel-title">Select Formate</h4>
						</div>
						<div class="panel-body">
							<div class="form-group">
								<select id="clname" class="form-control">
									<option value="">--Select--</option>
									<option value="1">Formate 1</option>
									<option value="2">Formate 2</option>
									<option value="3">Formate 3</option>
								</select>
							</div>
							<div class="text-red text-small">Please select a formate for student transfer certificate.</div>
						</div>
					</div>
                  </div>
                </div>
				<!----3rd tab end--->
				<!----4rth tab start--->
				
				<div class="tab-pane fade" id="myTab_example4">
                  <div class="alert btn-green">
                    <button data-dismiss="alert" class="close">
                      
                    </button>
                    <h3 class="media-heading text-center">Welcome to Add Class Section</h3>
                    <p class="media-timestamp">Please insure that you have created Stream and Section for Class. This is
                      Class creation area. You have to provide Class Name (Like 1st,8th,12th etc..) and select Class
                      stream
                      (Like : Science, Arts, Commerce etc) . If Stream is not applicable then select (None of these).
                      After this
                      select Section if applicable, otherwise none,and after that click Save Button and Save your Class.</p>
                      
                  </div>
                  <div class="row">
                    <div class="col-sm-4">
						<div class="panel-heading panel-red border-light">
							<h4 class="panel-title">Select Formate</h4>
						</div>
						<div class="panel-body">
							<div class="form-group">
								<select id="clname" class="form-control">
									<option value="">--Select--</option>
									<option value="1">Formate 1</option>
									<option value="2">Formate 2</option>
									<option value="3">Formate 3</option>
								</select>
							</div>
							<div class="text-red text-small">Please select a formate for student character certificate.</div>
						</div>
					</div>
                  </div>
                </div>
<!----4rth tab end--->
                         <script>
                         function isAlaphabte(evt) {
                    evt = (evt) ? evt : window.event;
                    var charCode = (evt.which) ? evt.which : evt.keyCode;
                    if (charCode > 31 && (charCode < 48 || charCode > 57)) {
                    return true;
                    }
                    $('#message').html('only Alphabates').css('color', 'red');
                    return false;
                    }      
                         
                        
                         </script>



              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- end: INLINE TABS PANEL -->
    </div>
  </div>
</div>
<!-- end: PAGE CONTENT-->