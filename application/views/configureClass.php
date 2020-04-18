<!-- start: PAGE CONTENT -->
<div class="row">
  <div class="col-sm-12">
    <!-- start: INLINE TABS PANEL -->
    <div class="panel panel-white">
      <!-- <div class="panel-heading">
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
													<a class="panel-refresh" href="#"> <i class="fa fa-refresh"></i> <span>Refresh</span> </a>
												</li>
												<li>
													<a class="panel-expand" href="#"> <i class="fa fa-expand"></i> <span>Fullscreen</span></a>
												</li>
											</ul>
											</div>
										</div>
									</div> -->
      <div class="panel-body">
        <div class="row">
          <div class="col-sm-12">
            <div class="tabbable">
              <ul id="myTab" class="nav nav-tabs">
                <li class="active">
                  <a href="#myTab_example1" data-toggle="tab">
                    <i class="green fa fa-home"></i> Add/Update Subject Stream
                  </a>
                </li>
                <li>
                  <a href="#myTab_example2" data-toggle="tab">
                    <i class="green fa fa-home"></i> Add/Update Section
                  </a>
                </li>
                <li>
                  <a href="#myTab_example3" data-toggle="tab">
                    <i class="green fa fa-home"></i> Add New Class
                  </a>
                </li>
              </ul>
              <div class="tab-content">
                <div class="tab-pane fade in active" id="myTab_example1">
                  <div class="alert panel-pink">
                    <button data-dismiss="alert" class="close">×</button>
                    <h3 class="media-heading text-center">Welcome to Stream Section</h3>
                    <a class="alert-link" href="#"></a>
                    This is very important to create Stream first because Subject and Classes requires a valid
                    Stream.You should not change Stream after creating and declare the Subjects and Classes.If you
                    change it may affect your Exam and time table Section.<p>If you want to <strong>Add</strong> a new
                      Stream to your School/College, Please type in the Stream Name into the box given below the Stream
                      Name and Press <strong>Add Stream </strong> Button.To <strong>Edit</strong> existing Stream Edit
                      it's Name and Press <strong>Edit</strong> Button , And to <strong>Delete</strong> a Stream simply Press <strong>Delete</strong> Button.
                  </div>
                  <div class="row">
                    <div class="col-sm-6">
                      <div class="panel panel-calendar">
                        <div class="panel-heading panel-blue border-light">
                          <h4 class="panel-title">Class Stream</h4>
                        </div>
                        <div class="panel-body">
                          <div class="text-black text-large">
                          <span id="message"></span>
                          <input type="text" id="addStream" class="text-uppercase"  maxlength="15" onkeypress="return isAlaphabte(event)">
                            <a href="#" class="btn btn-sm btn-blue" id="addStreamButton"><i class="fa fa-check"></i>
                              Add Stream</a></<br><br><br>
                            <div class="alert alert-warning"> Type a Stream Name and Press Add Stream.If Stream added
                              successfully then it show in right side panel where you can change the Name and Delete it.
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="panel panel-calendar">
                        <div class="panel-heading panel-green border-light">
                          <h4 class="panel-title">Stream List</h4>
                        </div>
                        <div class="panel-body" id="streamList1">

                        </div>
												<div class="container">
                        <div class="alert alert-success">
                          You can <strong>Edit </strong> or <strong>Delete </strong>
                          Stream by Press concern Button it sure that you have not created
                          subject and classes depending Edited or Deleted Stream.</div>
                      </div>
											</div>
                    </div>
                  </div>
                </div>
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
                    <div class="col-sm-6">
                      <div class="panel panel-calendar">
                        <div class="panel-heading panel-red border-light">
                          <h4 class="panel-title">Add Section</h4>
                        </div>
                        <div class="panel-body">
                          <div class="text-white text-large">
                            <span id="name1" Style="color:red;"></span>

                            <input type="text" minLength="1" maxLength="2" class="text-uppercase" id="addSection1" 
                             >

                            <a href="#" class="btn btn-sm btn-light-red" id="addSectionButton"><i
                                class="fa fa-check"></i> Add Section</a>
                            <br>
                            <br>
                            <div class="alert alert-warning"> Type a Section Name and Press Add Section.If Section added
                              successfully then it show in right side panel where you can change the Name and Delete it.
                              <h1>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="panel panel-calendar">
                        <div class="panel-heading panel-blue border-light">
                          <h4 class="panel-title">Section List</h4>
                        </div>
                        <div class="panel-body" id="sectionList">

                        </div>
                        <div class="alert alert-success">
                          <p>You can <strong>edit </strong> or <strong> Delete </strong>Section by press concern Button
                            it sure that you have not created
                            Subject and Classes depending Edited or Deleted Section.</p>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
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
                      <!--Leave the <strong>teacher's id</strong> field blank.-->
                      <!--Update the <strong>teacher's id</strong> after it has been created. You can find the teacher's id-->
                      <!--in the employee detail section. -->
                  </div>
                  <div class="row">
                    <div class="col-sm-6">
                      <div class="panel panel-calendar">
                        <div class="panel-heading panel-purple border-light">
                          <h4 class="panel-title">Add <span class="text-bold">New Class</span></h4>
                        </div>
                        <div class="panel-body" id="sectionList">
                          
                          <div class="form-horizontal" role="form">
                            <div class="form-group">
                              <label for="inputStandard" class="col-lg-4 control-label">Class Name <span
                                  style="color:#F00">*</span></label>
                              <div class="col-lg-7">
                                <input type="text" id="className" maxlength="10" class="form-control"
                                  placeholder="like : 1st, 10th, etc..." />
                                  <span style="color:red" id="clnm"></span>
                              </div>
                            </div>
                            <div class="form-group">
                              <label for="standard-list1" class="col-md-4 control-label">Select Stream <span
                                  style="color:#F00">*</span></label>
                              <div class="col-md-7">
                                <select class="form-control" id="classStream">
                                  <option value="">-Select Class Stream-</option>
                                  <?php
																                        $this->db->where("school_code",$this->session->userdata("school_code"));
																                        $var=$this->db->get("stream");
																                        foreach($var->result() as $v):
																                        ?><option value="<?php echo $v->id;?>"><?php echo $v->stream;?></option>
                                  <?php endforeach;?>
                                </select>
                              </div>
                            </div>
                            <div class="form-group">
                              <label for="standard-list1" class="col-md-4 control-label">Select Section <span
                                  style="color:#F00">*</span></label>
                              <div class="col-md-7">
                                <select class="form-control" id="classSection">
                                  <option value="">-Select Class Section-</option>
                                  <?php
																                        $this->db->where("school_code",$this->session->userdata("school_code"));
																                        $var=$this->db->get("class_section");
																                        foreach($var->result() as $v):
																                        ?><option value="<?php echo $v->id;?>"><?php echo $v->section;?></option>
                                  <?php endforeach;?>
                                </select>
                              </div>
                            </div>
                            <div class="form-group">
                              <label for="inputStandard" class="col-lg-3 control-label">
                                <button class="btn btn-purple btn-sm" id="classSave">
                                  <i class="fa fa-save" onclick="myFunction()"></i> &nbsp;Save
                                </button>

                                <!--<button type="reset" class="btn btn-purple btn-sm">-->
                                <!--  <i class="fa fa-refresh"></i> &nbsp;Reset-->
                                <!--</button>-->
                              </label>
                              <div class="col-lg-9">
                                &nbsp;
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-sm-6" style="overflow: auto; width: 300px; height: 420px;">
                      <div class="panel panel-white">
                        <div class="panel-heading panel-pink border-light">
                          <h4 class="panel-title">Class <span class="text-bold">List</span></h4>
                        </div>
                        <div class="panel-body">
                          <div>
                              <div class="form-group"> 
                              <label for="standard-list1" class="col-md-4 control-label">Filter By Class</label>
                              <div class="col-md-7">
                               <input type="text" placeholder="Enter class name" id="findclass">
                             </div>
                           </div>
                           <div class="table-responsive"> 
                            <table class="table table-striped table-bordered"
							style="width: 100%; overflow-y: scroll; overflow-x: scroll;" id="sample-table-2" >
                              <thead>
                                <tr>
                                  <th>SNo.</th>
                                  <th>Class Name</th>
                                  <th>Section</th>
                                  <th>Subject Stream</th>
                                </tr>
                              </thead>
                                 <tbody id="classfindDetail">
                              
                              </tbody>
                              
                              <tbody id="classDetail">

                              </tbody>
                            </table>
                           </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

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