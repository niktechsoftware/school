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
                    <i class="green fa fa-home"></i> Add/Update House/Team Name
                  </a>
                </li>
              </ul>
              <div class="tab-content">
                <div class="tab-pane fade in active" id="myTab_example1">
                  <div class="alert panel-pink">
                    <button data-dismiss="alert" class="close"></button>
                    <h3 class="media-heading text-center">Welcome to House/Team Define Area</h3>
                    <a class="alert-link" href="#"></a>
                    This is very important to create House .<p>If you want to <strong>Add</strong> a new
                      House/Team to your School/College, Please type in the House/Team Name into the box given below the House
                      Name and Press <strong>Add House </strong> Button.To <strong>Edit</strong> existing House/Team Edit
                      it's Name and Press <strong>Edit</strong> Button , And to <strong>Delete</strong> a House simply Press <strong>Delete</strong> Button.
                  </div>
                  <div class="row">
                    <div class="col-sm-6">
                      <div class="panel panel-calendar">
                        <div class="panel-heading panel-blue border-light">
                          <h4 class="panel-title">House/Team</h4>
                        </div>
                        <div class="panel-body">
                          <div class="text-black text-large">
                          <span id="message"></span>
                          <input type="text" id="addStream" class="text-uppercase"  maxlength="15" onkeypress="return isAlaphabte(event)">
                            <a href="#" class="btn btn-sm btn-blue" id="addStreamButton"><i class="fa fa-check"></i>
                              Add House</a></<br><br><br>
                            <div class="alert alert-warning"> Type a House Name and Press Add House.If House/Team added
                              successfully then it show in right side panel where you can change the Name and Delete it.
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="panel panel-calendar">
                        <div class="panel-heading panel-green border-light">
                          <h4 class="panel-title">House List</h4>
                        </div>
                        <div class="panel-body" id="streamList1">

                        </div>
												<div class="container">
                        <div class="alert alert-success">
                          You can <strong>Edit </strong> or <strong>Delete </strong>
                          House by Press concern Button it sure that you have not created
                          subject and classes depending Edited or Deleted House.</div>
                      </div>
											</div>
                    </div>
                  </div>
                </div>
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