<!-- start: PAGE CONTENT -->
<div class="row">
	<div class="col-sm-12">
		<!-- start: INLINE TABS PANEL -->
		<div class="panel panel-white">
			<div class="panel-heading">
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
			</div>
			<div class="panel-body">
		
			<div class="row">
				<div class="col-sm-12">
					<div class="panel panel-calendar">
						<div class="panel-heading panel-blue border-light">
							<h4 class="panel-title">SMS Setting Panel</h4>
						</div>
						
						<div class="panel-body">
						    <div class="alert alert-info">
          <button data-dismiss="alert" class="close"></button>
          <h3 class="media-heading text-center">Welcome to the SMS Setting Area</h3>
         In this section you can set the SMS for send.you can see toggle button of every facility ,if you have switch on button of any facility, only then you have to able for send the message.if button
         is switched off then you can't able to send sms  for those particular section.
        </div>
							<table class="table">
								<thead>
									<tr>
										<th>Admission</th>
										<th>Fee Submit</th>
										<th>Purchase</th>
										<th>Attendance</th>
										<th>Exam Report</th>
										<th>Parent Message</th>
										<th>Announcement</th>
										<th>Greeting</th>
										<th>Home Work</th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td>
											<button class="btn btn-sm <?php if($adm){echo "btn-light-green"; }else{echo "btn-light-red";}?>" id="admission" value="admission">
												<i class="<?php if($adm){echo "fa fa-check"; }else{echo "fa fa-times fa fa-white";}?>"></i> 
												<?php if($adm){echo "YES"; }else{echo "NO";}?>
											</button>
										</td>
										<td>
											<button class="btn btn-sm <?php if($fee_submit){echo "btn-light-green"; }else{echo "btn-light-red";}?>" id="fee_submit" value="fee_submit">
												<i class="<?php if($fee_submit){echo "fa fa-check"; }else{echo "fa fa-times fa fa-white";}?>"></i> 
												<?php if($fee_submit){echo "YES"; }else{echo "NO";}?>
											</button>
										</td>
										<td>
											<button class="btn btn-sm <?php if($purchase){echo "btn-light-green"; }else{echo "btn-light-red";}?>" id="purchase" value="purchase">
												<i class="<?php if($purchase){echo "fa fa-check"; }else{echo "fa fa-times fa fa-white";}?>"></i> 
												<?php if($purchase){echo "YES"; }else{echo "NO";}?>
											</button>
										</td>
										<td>
											<button class="btn btn-sm <?php if($stu_attendance){echo "btn-light-green"; }else{echo "btn-light-red";}?>" id="stu_attendance" value="stu_attendance">
												<i class="<?php if($stu_attendance){echo "fa fa-check"; }else{echo "fa fa-times fa fa-white";}?>"></i> 
												<?php if($stu_attendance){echo "YES"; }else{echo "NO";}?>
											</button>
										</td>
										<td>
											<button class="btn btn-sm <?php if($exam_report){echo "btn-light-green"; }else{echo "btn-light-red";}?>" id="exam_report" value="exam_report">
												<i class="<?php if($exam_report){echo "fa fa-check"; }else{echo "fa fa-times fa fa-white";}?>"></i> 
												<?php if($exam_report){echo "YES"; }else{echo "NO";}?>
											</button>
										</td>
										<td>
											<button class="btn btn-sm <?php if($parent_message){echo "btn-light-green"; }else{echo "btn-light-red";}?>" id="parent_message" value="parent_message">
												<i class="<?php if($parent_message){echo "fa fa-check"; }else{echo "fa fa-times fa fa-white";}?>"></i> 
												<?php if($parent_message){echo "YES"; }else{echo "NO";}?>
											</button>
										</td>
										<td>
											<button class="btn btn-sm <?php if($announcement){echo "btn-light-green"; }else{echo "btn-light-red";}?>" id="announcement" value="announcement">
												<i class="<?php if($announcement){echo "fa fa-check"; }else{echo "fa fa-times fa fa-white";}?>"></i> 
												<?php if($announcement){echo "YES"; }else{echo "NO";}?>
											</button>
										</td>
										<td>
											<button class="btn btn-sm <?php if($greeting){echo "btn-light-green"; }else{echo "btn-light-red";}?>" id="greeting" value="greeting">
												<i class="<?php if($greeting){echo "fa fa-check"; }else{echo "fa fa-times fa fa-white";}?>"></i>
												<?php if($greeting){echo "YES"; }else{echo "NO";}?>
											</button>
										</td>
										<td>
											<button class="btn btn-sm <?php if($homework){echo "btn-light-green"; }else{echo "btn-light-red";}?>" id="homework" value="homework">
												<i class="<?php if($homework){echo "fa fa-check"; }else{echo "fa fa-times fa fa-white";}?>"></i>
												<?php if($homework){echo "YES"; }else{echo "NO";}?>
											</button>
										</td>
									</tr>
								</tbody>
							</table>
							<div id="smsSetting"></div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- end: INLINE TABS PANEL -->
	</div>
</div>
<!-- end: PAGE CONTENT-->