 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <style>
  .form-group{
      margin-left:5%;
  }
  </style>
  <div class="row">
	<div class="col-md-12">
	<!-- start: RESPONSIVE TABLE PANEL -->
		<div class="panel">
			<div class="panel-heading panel-pink">
				<i class="fa fa-external-link-square"></i>
					Exam Head Window
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
								<a class="panel-config" href="#panel-config" data-toggle="modal"> <i class="fa fa-wrench"></i> <span>Configurations</span></a>
							</li>
							<li>
								<a class="panel-expand" href="#"> <i class="fa fa-expand"></i> <span>Fullscreen</span></a>
							</li>
						</ul>
					</div>
				</div>
			</div>
 <div class="panel-body">
	<div class="panel panel-white">

        <div class="alert  panel-orange">
          <h4 class="media-heading text-center">Welcome to Exam Head Area </h4>
          <p class="media-timestamp">Welcome to Exam Head  Area,
            in this page you can Create Exam Head (Exam Name ) .
            <strong>Please Fill following Details .</strong>
          </p>
        </div>
        <div>
           <div id="validId"></div>
        <br/>
        <br/>  
         <div class="row">
                    <div class="col-sm-6">
                      <div class="panel panel-calendar">
                        <div class="panel-heading panel-blue border-light">
                          <h4 class="panel-title text-center">Create Exam Head</h4>
                        </div>
                        <div class="panel-body">
                        <div class="text-black text-large">
                            <div class="row">
                            <div class="col-md-12">
                              <form class="form-inline" action="<?php echo base_url();?>index.php/login/exam" method="post">
                                <div class="form-group">
                                  <label for="exam">Add Exam</label>
                                  <input type="text" class="form-control" id="exam" placeholder="Exam Head" name="examHead">
                                </div>   
                              </div>
                            </div>
                            <div class="row" style="padding-top:10px;">
                            <div class="col-md-12">
                            <button type="submit" style="margin-left:20%;"class="btn btn-sm btn-blue" id="createexp" value="Submit"><i class="fa fa-check">
                            </i>
                              Create Exam Head </a> 
                              </div>
                              </div>
                            <br><br><br>
                            <div class="alert alert-warning">Add  Exam Head.
                             If Exam Head Successfully  added then it Shows in right side panel.
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="panel panel-calendar">
                        <div class="panel-heading panel-green border-light">
                          <h4 class="panel-title text-center">Old/Current Exam Head </h4>
                        </div>
                        <div class="panel-body panel-scroll height-450 table-responsive" >
                        <div class="panel-body" id="expenditure2">
                           <div class="panel-body panel-scroll height-450 table-responsive" >
                                <table class="table table-bordered table-hover " id="sample-table-2">
                                <thead>
                                <tr class="text-center">
                                    <th>Exam ID </th>
                                <th>Exam Name</th>
                                <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                  <?php 
                                $i=1;
                               
                           
                            foreach($explist->result() as $row){?>
                                    <tr>
                                <td class="text-center"><?php echo $i;?> </td>
                                    <td class="text-center">
                                    <input type="hidden" id="exp_id<?php echo $i;?>" name="exp_id" value="<?php echo $row->exam_id; ?>">
                                    <input type="text" name="exp_name" id="exp_name<?php echo $i;?>" value="<?php echo $row->exam_name;?>"></td>
                                    <td class="text-center"><a href="#" id="expEdit<?php echo $i;?>" name="expEdit" class="btn btn-warning">Edit</a>
                                      </td>
                                </tr>
                                <?php  
                            $i++;
                             }?>
                                </tbody>
                                </table>
                                </div> 
                         </div>
                    </div>
                  </div>
                </div>
              </div>
 
          </div>
       
       <div class="col-sm-12">
            <div class="table-responsive" id="rahul"></div><!-- end: table-responsive -->
          </div>
        </div><!-- end: panel Body -->
      </div><!-- end: panel panel-white -->
</div>
</div>
</div>
    </div><!-- end: MAIN PANEL COL-SM-12 -->
  </div><!-- end: PAGE ROW--></div><!--  end paig Container -->