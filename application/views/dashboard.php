<!-- start: PAGE CONTENT -->
<?php
$school_code = $this->session->userdata("school_code");

?>


<?php if($this->uri->segment("3") == "noteTrue"){?>
<div class="row">
  <div class="col-md-6 col-lg-12 col-sm-6">
    <div class="panel panel-default panel-white core-box">
      <div class="alert alert-success">
        <button data-dismiss="alert" class="close">
          &times;
        </button>
        <strong>Done!</strong> Your new Note successfully added <a class="alert-link" href="#">
          into database.</a>
      </div>
    </div>
  </div>
</div>
<?php } elseif($this->uri->segment("3") == "noteFalse"){?>
<div class="row">
  <div class="col-md-6 col-lg-12 col-sm-6">
    <div class="panel panel-default panel-white core-box">
      <div class="alert alert-danger">
        <button data-dismiss="alert" class="close">
          &times;
        </button>
        <strong>Oh my god! sorry....</strong>
        Something going wrong contect to <strong>NIKTECH SOFTWARE SOLUTIONS</strong> for this.... :(
      </div>
    </div>
  </div>
</div>
<?php }?>

<?php if($this->uri->segment("3") == "noteDelTrue"){?>
<div class="row">
  <div class="col-md-6 col-lg-12 col-sm-6">
    <div class="panel panel-default panel-white core-box">
      <div class="alert alert-success">
        <button data-dismiss="alert" class="close">
          &times;
        </button>
        <strong>Done!</strong> Your Note successfully Deleted from database.
      </div>
    </div>
  </div>
</div>
<?php } elseif($this->uri->segment("3") == "noteDelFalse"){?>
<div class="row">
  <div class="col-md-6 col-lg-12 col-sm-6">
    <div class="panel panel-default panel-white core-box">
      <div class="alert alert-danger">
        <button data-dismiss="alert" class="close">
          &times;
        </button>
        <strong>Oh my god! sorry....</strong>
        Something going wrong contect to <strong>NIKTECH SOFTWARE SOLUTIONS</strong> for this.... :(
      </div>
    </div>
  </div>
</div>
<?php }?>

<!-- ------------------------------------------ All alert codeing end -------------------------------------------- -->

<div class="row">
  <div class="col-md-6 col-lg-3 col-sm-6">
    <div class="panel panel-default panel-white core-box">
      <div class="panel-body no-padding">
        <div class="partition-green text-center core-icon">
          <i class="fa fa-inr fa-2x icon-big"></i><br>


        </div>
        <a href="<?php echo base_url(); ?>index.php/login/feeReport">
          <div class="padding-20 core-content">
            <!--	<h3 class="title block no-margin">Fee Reports</h3>-->
            <h3 class="title block no-margin">Today Collection</h3>
            <br />
            <div class="row">
              <div class="col-sm-6">
                <h6 class="block no-margin">Today Fees Collection</h6>
                </br>
                <mark><?php 
					
					 echo $totalIncome;
					?>
                </mark>
              </div>
              <div class="col-sm-6">
                <h6 class="block no-margin">Today Stock</h6>
                </br>
                <mark><?php 
					$camount=0;
					 $school_code=   $this->session->userdata("school_code");
					 $this->db->select_sum("sub_total");
					 $this->db->where('school_code',$school_code);
					 $this->db->where('date(date)',date('Y-m-d'));
				//	 $this->db->where('dabit_cradit',1);
					$stocktotal=$this->db->get('sale_info')->row();
					if($stocktotal->sub_total){
           echo $stocktotal->sub_total;
          } 
          else{
            echo "0";
          }
                    ?>
                </mark>
              </div>
            </div>

          </div>
        </a>
      </div>
    </div>
  </div>
  <div class="col-md-6 col-lg-3 col-sm-6">
    <div class="panel panel-default panel-white core-box">
      <div class="panel-body no-padding">
        <div class="partition-azure text-center core-icon">
          <i class="fa fa-book fa-2x icon-big"></i>

        </div>
        <a href="<?php echo base_url(); ?>index.php/login/daybook">
          <div class="padding-20 core-content">
            <!-- <h4 class="title block no-margin">DayBook</h4>-->
            <h4 class="title block no-margin">Today DayBook</h4>
            <br />
            <div class="row">
              <div class="col-sm-6">
                <h6 class="block no-margin">Debit Amount</h6>
                <mark><?php 
					$damount=0;
					 $school_code=   $this->session->userdata("school_code");
					 $this->db->where('school_code',$school_code);
					 $this->db->where('date(pay_date)',date('Y-m-d'));
					 $this->db->where('dabit_cradit',0);
					 $debit_amount=$this->db->get('day_book');
					 foreach($debit_amount->result() as $dm){
						 $damount=$damount + $dm->amount;
					 }
					 echo $damount;
					?>
                </mark>
              </div>
              <div class="col-sm-6">
                <h6 class="block no-margin">Credit Amount</h6>
                <mark><?php 
					$camount=0;
					 $school_code=   $this->session->userdata("school_code");
					 $this->db->where('school_code',$school_code);
					 $this->db->where('date(pay_date)',date('Y-m-d'));
					 $this->db->where('dabit_cradit',1);
					 $credit_amount=$this->db->get('day_book');
					 foreach($credit_amount->result() as $cm){
						 $camount=$camount + $cm->amount;
					 }
					 echo $camount;
                    ?>
                </mark>
              </div>
            </div>


          </div>
        </a>
      </div>
    </div>
  </div>

  <div class="col-md-6 col-lg-3 col-sm-6">
    <div class="panel panel-default panel-white core-box">
      <div class="panel-body no-padding">
        <div class="partition-pink text-center core-icon">
          <i class="fa fa-users fa-2x icon-big"></i>
          <br>
          <span class="subtitle"> <?php 
											$date=Date("Y-m-d");
											$this->db->select_sum("amount");
											//$x= $this->db->from("cash_payment");
                    	$this->db->where("school_code",$this->session->userdata("school_code"));
			                 $this->db->where("date",$date); 
		                   $info = $this->db->get('cash_payment')->row();
									
                    	?> </span>
        </div>
        <a href="<?php echo base_url(); ?>index.php/login/daybook">
          <div class="padding-20 core-content">
            <h4 class="title block no-margin">Today Expenditure</h4>
            <br />
            <span class="subtitle"> <mark><?php if($info->amount){ echo $info->amount; } else{ echo "0"; }?> </mark></span>
          </div>
        </a>
      </div>
    </div>
  </div>

  <div class="col-md-6 col-lg-3 col-sm-6">
    <div class="panel panel-default panel-white core-box">
      <div class="panel-body no-padding">
        <div class="partition-blue text-center core-icon">
          <i class="fa fa-users fa-2x icon-big"></i>

          </span>
        </div>
        <a href="<?php echo base_url(); ?>index.php/login/daybook">
          <div class="padding-20 core-content">
            <!-- <h4 class="title block no-margin">Student Admission</h4>-->
            <h4 class="title block no-margin">Today Business</h4><br>
            <div class="row">
              <div class="col-sm-6">
                <h6 class="block no-margin">Today Opening</h6>
                </br>
                <mark><?php 
                $date=Date("Y-m-d");
						$this->db->select('opening_balance');
						$this->db->where("school_code",$school_code);
						$this->db->where("Date(closing_date)",$date);
							$data=$this->db->get('opening_closing_balance')->row();
						//	$this->db->join('class_info','class_info.id=student_info.class_id');
						
							
						
							echo $data->opening_balance ;?></mark>
              </div>
              <div class="col-sm-6">
                <h6 class="block no-margin">Today Closing</h6>
                </br>
                <mark> <?php  $date=Date("Y-m-d");
						$this->db->select('closing_balance');
						$this->db->where("school_code",$school_code);
						$this->db->where("Date(closing_date)",$date);
							$data1=$this->db->get('opening_closing_balance')->row();
							echo $data1->closing_balance ; ;?></mark>
              </div>
            </div>

          </div>
        </a>
      </div>
    </div>
  </div>

  <!--<div class="col-md-6 col-lg-3 col-sm-6">-->
  <!--        <div class="panel panel-default panel-white core-box">-->
  <!--            <div class="panel-body no-padding">-->
  <!--                <div class="partition-red padding-20 text-center core-icon">-->
  <!--                    <i class="fa fa-tasks fa-2x icon-big"></i>-->
  <!--                </div>-->
  <!--                <a href="<?php echo base_url(); ?>index.php/login/schedulingReport">-->
  <!--                <div class="padding-20 core-content">-->
  <!--                    <h4 class="title block no-margin">Time Table</h4>-->
  <!--                    <br/>-->
  <!--                    <span class="subtitle"> Access the time table. </span>-->
  <!--                </div>-->
  <!--                </a>-->
  <!--            </div>-->
  <!--        </div>-->
  <!--    </div>-->
</div>
<div class="row">
<div class="col-md-6 col-lg-3 col-sm-6">
    <div class="panel panel-default panel-white core-box">
      <div class="panel-body no-padding">
        <div class="partition-green text-center core-icon">
          <i class="fa fa-inr fa-2x icon-big"></i><br>


        </div>
        <a href="<?php echo base_url(); ?>index.php/login/feeReport">
          <div class="padding-20 core-content">
            <!--	<h3 class="title block no-margin">Fee Reports</h3>-->
            <h3 class="title block no-margin">This Month Due</h3>
            <br />
            <div class="row">
              <div class="col-sm-6">
                <h6 class="block no-margin">Today Fees Collection</h6>
                </br>
                <mark><?php 
					
					 echo $totalIncome;
					?>
                </mark>
              </div>
              <div class="col-sm-6">
                <h6 class="block no-margin">Today Stock</h6>
                </br>
                <mark><?php 
					$camount=0;
					 $school_code=   $this->session->userdata("school_code");
					 $this->db->select_sum("sub_total");
					 $this->db->where('school_code',$school_code);
					 $this->db->where('date(date)',date('Y-m-d'));
				//	 $this->db->where('dabit_cradit',1);
					$stocktotal=$this->db->get('sale_info')->row();
					if($stocktotal->sub_total){
           echo $stocktotal->sub_total;
          } 
          else{
            echo "0";
          }
                    ?>
                </mark>
              </div>
            </div>

          </div>
        </a>
      </div>
    </div>
  </div>
  <div class="col-md-6 col-lg-3 col-sm-6">
    <div class="panel panel-default panel-white core-box">
      <div class="panel-body no-padding">
        <div class="partition-azure text-center core-icon">
          <i class="fa fa-book fa-2x icon-big"></i>

        </div>
        <a href="<?php echo base_url(); ?>index.php/login/daybook">
          <div class="padding-20 core-content">
            <!-- <h4 class="title block no-margin">DayBook</h4>-->
            <h4 class="title block no-margin">This Year Due</h4>
            <br />
            <div class="row">
              <div class="col-sm-6">
                <h6 class="block no-margin">Debit Amount</h6>
                <mark><?php 
					$damount=0;
					 $school_code=   $this->session->userdata("school_code");
					 $this->db->where('school_code',$school_code);
					 $this->db->where('date(pay_date)',date('Y-m-d'));
					 $this->db->where('dabit_cradit',0);
					 $debit_amount=$this->db->get('day_book');
					 foreach($debit_amount->result() as $dm){
						 $damount=$damount + $dm->amount;
					 }
					 echo $damount;
					?>
                </mark>
              </div>
              <div class="col-sm-6">
                <h6 class="block no-margin">Credit Amount</h6>
                <mark><?php 
					$camount=0;
					 $school_code=   $this->session->userdata("school_code");
					 $this->db->where('school_code',$school_code);
					 $this->db->where('date(pay_date)',date('Y-m-d'));
					 $this->db->where('dabit_cradit',1);
					 $credit_amount=$this->db->get('day_book');
					 foreach($credit_amount->result() as $cm){
						 $camount=$camount + $cm->amount;
					 }
					 echo $camount;
                    ?>
                </mark>
              </div>
            </div>


          </div>
        </a>
      </div>
    </div>
  </div>

  <div class="col-md-6 col-lg-3 col-sm-6">
    <div class="panel panel-default panel-white core-box">
      <div class="panel-body no-padding">
        <div class="partition-pink text-center core-icon">
          <i class="fa fa-users fa-2x icon-big"></i>
          <br>
          <span class="subtitle"> <?php 
											$date=Date("Y-m-d");
											$this->db->select_sum("amount");
											//$x= $this->db->from("cash_payment");
                    	$this->db->where("school_code",$this->session->userdata("school_code"));
			                 $this->db->where("date",$date); 
		                   $info = $this->db->get('cash_payment')->row();
									
                    	?> </span>
        </div>
        <a href="<?php echo base_url(); ?>index.php/login/daybook">
          <div class="padding-20 core-content">
            <h4 class="title block no-margin">Top 10 Defaulter</h4>
            <br />
            <span class="subtitle"> <mark><?php if($info->amount){ echo $info->amount; } else{ echo "0"; }?> </mark></span>
          </div>
        </a>
      </div>
    </div>
  </div>

</div>
</div>

<div class="row" style="margin-left:2px;">
  <!--<div class="col-lg-4 col-md-5">-->
  <!--	<div class="panel panel-red panel-calendar">-->
  <!--		<div class="panel-heading border-light">-->
  <!--			<h4 class="panel-title">Appointments</h4>-->
  <!--			<div class="panel-tools">-->
  <!--				<div class="dropdown">-->
  <!--					<a data-toggle="dropdown" class="btn btn-xs dropdown-toggle btn-transparent-white">-->
  <!--						<i class="fa fa-cog"></i>-->
  <!--					</a>-->
  <!--					<ul class="dropdown-menu dropdown-light pull-right" role="menu">-->
  <!--						<li>-->
  <!--							<a class="panel-collapse collapses" href="#"><i class="fa fa-angle-up"></i> <span>Collapse</span> </a>-->
  <!--						</li>-->
  <!--						<li>-->
  <!--							<a class="panel-refresh" href="#">-->
  <!--								<i class="fa fa-refresh"></i> <span>Refresh</span>-->
  <!--							</a>-->
  <!--						</li>-->
  <!--						<li>-->
  <!--							<a class="panel-config" href="#panel-config" data-toggle="modal">-->
  <!--								<i class="fa fa-wrench"></i> <span>Configurations</span>-->
  <!--							</a>-->
  <!--						</li>-->
  <!--						<li>-->
  <!--							<a class="panel-expand" href="#">-->
  <!--								<i class="fa fa-expand"></i> <span>Fullscreen</span>-->
  <!--							</a>-->
  <!--						</li>-->
  <!--					</ul>-->
  <!--				</div>-->
  <!--				<a class="btn btn-xs btn-link panel-close" href="#">-->
  <!--					<i class="fa fa-times"></i>-->
  <!--				</a>-->
  <!--			</div>-->
  <!--		</div>-->
  <!--		<div class="panel-body">-->
  <!--			<div class="height-300">-->
  <!--				<div class="row">-->
  <!--					<div class="col-xs-6">-->
  <!--						<div class="actual-date">-->
  <!--							<span class="actual-day"><?php $cdate = date("d-m-Y H:i:s"); echo date('d',strtotime($cdate));?></span>-->
  <!--							<span class="actual-month"><?php echo date('M',strtotime($cdate));?></span>-->
  <!--						</div>-->
  <!--					</div>-->
  <!--					<div class="col-xs-6">-->
  <!--						<div class="row">-->
  <!--							<div class="col-xs-12">-->
  <!--								<div class="clock-wrapper">-->
  <!--									<div class="clock">-->
  <!--										<div class="circle">-->
  <!--											<div class="face"><?php $ctimeh =  date('H',strtotime($cdate)); ?>-->
  <!--												<div id="hour" style="transform: rotate(258.55deg);"><?php echo $ctimeh." hour";?></div>-->
  <!--												<div id="minute" style="transform: rotate(222.6deg);"><?php echo date('i',strtotime($cdate));?></div>-->
  <!--												<div id="second" style="transform: rotate(36deg);"><?php echo date('s',strtotime($cdate)); ?></div>-->
  <!--											</div>-->
  <!--										</div>-->
  <!--									</div>-->
  <!--								</div>-->
  <!--							</div>-->
  <!--						</div>-->
  <!--						<div class="row">-->
  <!--							<div class="col-xs-12">-->
  <!--								<div class="weather text-light">-->
  <!--									<i class="wi-day-sunny"></i>-->
  <!--								25�-->
  <!--								</div>-->
  <!--							</div>-->
  <!--						</div>-->
  <!--					</div>-->
  <!--				</div>-->

  <!--				<div class="row">-->
  <!--					<div class="col-xs-12">-->
  <!--						<div class="row">-->
  <!--							<div class="appointments border-top border-bottom border-light space15">-->
  <!--								<a class="btn btn-sm owl-prev text-light">-->
  <!--									<i class="fa fa-chevron-left"></i>-->
  <!--								</a>-->
  <!--								<div class="e-slider owl-carousel owl-theme" data-plugin-options="{&quot;transitionStyle&quot;: &quot;goDown&quot;, &quot;pagination&quot;: false}" style="opacity: 1; display: block;">-->
  <!--									<div class="owl-wrapper-outer"><div class="owl-wrapper" style="width: 2208px; left: 0px; display: block; transition: all 0ms ease 0s; transform: translate3d(-368px, 0px, 0px); transform-origin: 552px center; perspective-origin: 552px center;"><div class="owl-item" style="width: 368px;"><div class="item">-->
  <!--										<div class="inline-block padding-10 border-right border-light">-->
  <!--											<span class="bold-text text-small"><i class="fa fa-clock-o"></i> 17:00</span>-->
  <!--											<span class="text-light text-extra-small">1 hour</span>-->
  <!--										</div>-->
  <!--										<div class="inline-block padding-10">-->
  <!--											<span class="bold-text text-small">NETWORKING</span>-->
  <!--											<span class="text-light text-small">Out to design conference</span>-->
  <!--										</div>-->
  <!--									</div></div><div class="owl-item" style="width: 368px;"><div class="item">-->
  <!--										<div class="inline-block padding-10 border-right border-light">-->
  <!--											<span class="bold-text text-small"><i class="fa fa-clock-o"></i> 18:30</span>-->
  <!--											<span class="text-light text-extra-small">30 mins</span>-->
  <!--										</div>-->
  <!--										<div class="inline-block padding-10">-->
  <!--											<span class="bold-text text-small">BOOTSTRAP SEMINAR</span>-->
  <!--											<span class="text-light text-small">Problem Solving</span>-->
  <!--										</div>-->
  <!--									</div></div><div class="owl-item" style="width: 368px;"><div class="item">-->
  <!--										<div class="inline-block padding-10 border-right border-light">-->
  <!--											<span class="bold-text text-small"><i class="fa fa-clock-o"></i> 20:00</span>-->
  <!--											<span class="text-light text-extra-small">2 hour</span>-->
  <!--										</div>-->
  <!--										<div class="inline-block padding-10">-->
  <!--											<span class="bold-text text-small">Lunch with Nicole</span>-->
  <!--											<span class="text-light text-small">Next on Tuesday</span>-->
  <!--										</div>-->
  <!--									</div></div></div></div>-->


  <!--								</div>-->
  <!--								<a class="btn btn-sm owl-next text-light"><i class="fa fa-chevron-right"></i> </a>-->
  <!--							</div>-->
  <!--						</div>-->
  <!--					</div>-->
  <!--				</div>-->
  <!--				<div class="row">-->
  <!--					<div class="col-xs-12">-->
  <!--						<div class="pull-right">-->
  <!--							<a href="#newEvent" class="btn btn-sm btn-transparent-white new-event"><i class="fa fa-plus"></i> New Event </a>-->
  <!--							<a href="#showCalendar" class="btn btn-sm btn-transparent-white show-calendar"><i class="fa fa-calendar-o"></i> Calendar </a>-->
  <!--						</div>-->
  <!--					</div>-->
  <!--				</div>-->
  <!--			</div>-->
  <!--		</div>-->
  <!--	</div>-->
  <!--</div>-->


  <!--  <div class="panel panel-dark">
        <div class="panel-heading text-center">
            <h4 class="panel-title">Class Homework</h4>
            <div class="panel-tools">
                <div class="dropdown">
                    <a data-toggle="dropdown" class="btn btn-xs dropdown-toggle btn-transparent-white">
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
        
      <!--   <div class="panel-body no-padding">
          
             <?php
                                $school_code=$this->session->userdata('school_code');
                                  $this->db->where('school_code',$school_code);
                                  $class_name=$this->db->get('class_info');
                                  foreach($class_name->result() as $cname){
                                      
                                      $this->db->where('id',$cname->section);
                                      $this->db->where('school_code',$school_code);
                                      $sectionname=$this->db->get('class_section')->row();
                                      
                                       $this->db->where('id',$cname->stream);
                                      $this->db->where('school_code',$school_code);
                                      $streamname=$this->db->get('stream')->row();
                                      $this->db->where('class_id',$cname->id);
                                      $this->db->where('school_code',$school_code);
                                      $homework_name=$this->db->get('homework_name');
                                      if($homework_name->num_rows() >0){
                                ?>
            <div id="accordion" class="panel-group accordion accordion-white no-margin">
                <div class="panel no-radius">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a href="#collapseOne<?php echo $cname->id; ?>" data-parent="#accordion" data-toggle="collapse" class="accordion-toggle padding-15">
                                <i class="icon-arrow"></i>
                               <?php echo $cname->class_name."-".$sectionname->section."-".$streamname->stream;?><span class="label label-danger pull-right"></span>
                            </a></h4>
                    </div>
                   <div class="panel-collapse collapse" id="collapseOne<?php echo $cname->id;?>">
                        <div class="panel-body no-padding partition-light-grey">
                            <table class="table">
                                <tbody>
                                <?php 
                                     
                                ?>
                                <?php ?>
                                <?php $i=1; foreach($homework_name->result() as $row):?>
                                <tr>
                                    <td class="center"><?php echo $i;?></td>
                                    <td>
                                    	<?php
                                    	  echo $row->workDiscription." in ".$row->work_name;
                                    	?>
                                    </td>
                                   
                                </tr>
                                <?php $i++; endforeach;?>
                                <?php }else{ ?>
                                <tr>
                                    <td class="center"><h2>Home Work not define ...</h2></td>
                                </tr>
                                <?php }?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <?php  }?>
        </div> 
    </div>
    </div>-->
  <div class="row" style="margin-left:2px;">

    <div class="col-lg-7 col-md-6" style="width:720px;">
      <div class="panel panel-white" style=" height:406px;">
        <div class="panel-heading border-light">
          <h4 class="panel-title">Earnings</h4>
          <ul class="panel-heading-tabs border-light">
            <li>
              <div id="reportrange" class="pull-right">
                <span>This Week </span><i class="fa fa-angle-down"></i>
              </div>
            </li>
            <li>
              <div class="rate">
                <i class="fa fa-caret-up text-green"></i><span class="value">15</span><span class="percentage">%</span>
              </div>
            </li>
            <li class="panel-tools">
              <div class="dropdown">
                <a data-toggle="dropdown" class="btn btn-xs dropdown-toggle btn-transparent-grey">
                  <i class="fa fa-cog"></i>
                </a>
                <ul class="dropdown-menu dropdown-light pull-right" role="menu">
                  <li>
                    <a class="panel-collapse collapses" href="#"><i class="fa fa-angle-up"></i> <span>Collapse</span>
                    </a>
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
            </li>
          </ul>
        </div>
        <div class="panel-body no-padding partition-green">
          <div class="col-md-3 col-lg-2 no-padding">
            <div class="partition-body padding-15">
              <ul class="mini-stats">
                <li class="col-md-12 col-sm-4 col-xs-4 no-padding">
                  <div class="sparkline-bar sparkline-1">
                    <span><canvas width="41" height="24"
                        style="display: inline-block; width: 41px; height: 24px; vertical-align: top;"></canvas></span>
                  </div>
                  <div class="values">
                    <strong>18304</strong>
                    Sales
                  </div>
                </li>
                <li class="col-md-12 col-sm-4 col-xs-4 no-padding">
                  <div class="sparkline-bar sparkline-2">
                    <span><canvas width="41" height="24"
                        style="display: inline-block; width: 41px; height: 24px; vertical-align: top;"></canvas></span>
                  </div>
                  <div class="values">
                    <strong>$3,833</strong>
                    Earnings
                  </div>
                </li>
                <li class="col-md-12 col-sm-4 col-xs-4 no-padding">
                  <div class="sparkline-bar sparkline-3">
                    <span><canvas width="41" height="24"
                        style="display: inline-block; width: 41px; height: 24px; vertical-align: top;"></canvas></span>
                  </div>
                  <div class="values">
                    <strong>$848</strong>
                    Referrals
                  </div>
                </li>
              </ul>
            </div>
          </div>
          <div class="col-md-9 col-lg-10 no-padding partition-white">
            <div class="partition">
              <div class="partition-body padding-15">
                <div class="height-300">
                  <?php 
												$query=	$this->db->query("select distinct class_name from class_info where school_code = ". $school_code . "");
													$data = $query->result();
													// print_r($data);
													// exit();
													?>
                  <div id="chart1" class="with-3d-shadow with-transitions">
                    <svg>
                      <g class="nvd3 nv-wrap nv-linePlusBar" transform="translate(60,30)">
                        <g>



                          <?php $i=0;
															$j=10;
															foreach($data as $row1):
															?>
                          <g class="nv-x nv-axis" transform="translate(0,255)">
                            <g class="nvd3 nv-wrap nv-axis">
                              <g>

                                <g class="tick major" transform="translate(20.075,0)" style="opacity: 1;">
                                  <line y2="-255" x2="0"></line>
                                </g>
                                <g class="tick major" transform="translate(92.58833333333332,0)" style="opacity: 1;">
                                  <line y2="-255" x2="0"></line><text y="7" dy=".71em" x="0"
                                    style="text-anchor: middle;"><?php echo $row1->class_name; ;?></text>
                                </g>
                              </g>

                            </g>
                          </g>
                          <g class="nv-y1 nv-axis">
                            <g class="nvd3 nv-wrap nv-axis">
                              <g>
                                <g class="tick major" transform="translate(0,255)" style="opacity: 1;">
                                  <line x2="584" y2="0"></line><text x="-3" dy=".32em" opacity="0"
                                    style="text-anchor: end;" y="0"><?php echo $j ;  ?></text>
                                </g>
                              </g>

                            </g>
                          </g>
                          <?php $i++ ; endforeach ;
															
															?>
                          <!-- <g class="tick major" transform="translate(165.10166666666663,0)" style="opacity: 1;"><line y2="-255" x2="0"></line><text y="7" dy=".71em" x="0" style="text-anchor: middle;">03/15/2019</text></g><g class="tick major" transform="translate(237.61499999999995,0)" style="opacity: 1;"><line y2="-255" x2="0"></line><text y="7" dy=".71em" x="0" style="text-anchor: middle;">03/17/2019</text></g><g class="tick major" transform="translate(310.1283333333333,0)" style="opacity: 1;"><line y2="-255" x2="0"></line><text y="7" dy=".71em" x="0" style="text-anchor: middle;">03/19/2019</text></g><g class="tick major" transform="translate(382.6416666666666,0)" style="opacity: 1;"><line y2="-255" x2="0"></line><text y="7" dy=".71em" x="0" style="text-anchor: middle;">03/21/2019</text></g><g class="tick major" transform="translate(455.1549999999999,0)" style="opacity: 1;"><line y2="-255" x2="0"></line><text y="7" dy=".71em" x="0" style="text-anchor: middle;">03/23/2019</text></g><path class="domain" d="M20.075,0V0H563.925V0"></path><text class="nv-axislabel" text-anchor="middle" y="36" x="281.9625"></text> -->


                          <g class="nv-y1 nv-axis">
                            <g class="nvd3 nv-wrap nv-axis">
                              <g>
                                <g class="tick major" transform="translate(0,255)" style="opacity: 1;">
                                  <line x2="584" y2="0"></line><text x="-3" dy=".32em" opacity="0"
                                    style="text-anchor: end;" y="0">0</text>
                                </g>
                                <g class="tick major" transform="translate(0,229.5)" style="opacity: 1;">
                                  <line x2="584" y2="0"></line><text x="-3" dy=".32em" opacity="1"
                                    style="text-anchor: end;" y="0">10</text>
                                </g>
                                <g class="tick major" transform="translate(0,204)" style="opacity: 1;">
                                  <line x2="584" y2="0"></line><text x="-3" dy=".32em" opacity="1"
                                    style="text-anchor: end;" y="0">20</text>
                                </g>
                                <g class="tick major" transform="translate(0,178.5)" style="opacity: 1;">
                                  <line x2="584" y2="0"></line><text x="-3" dy=".32em" opacity="1"
                                    style="text-anchor: end;" y="0">30</text>
                                </g>
                                <g class="tick major" transform="translate(0,153)" style="opacity: 1;">
                                  <line x2="584" y2="0"></line><text x="-3" dy=".32em" opacity="1"
                                    style="text-anchor: end;" y="0">40</text>
                                </g>
                                <g class="tick major" transform="translate(0,127.5)" style="opacity: 1;">
                                  <line x2="584" y2="0"></line><text x="-3" dy=".32em" opacity="1"
                                    style="text-anchor: end;" y="0">50</text>
                                </g>
                                <g class="tick major" transform="translate(0,102)" style="opacity: 1;">
                                  <line x2="584" y2="0"></line><text x="-3" dy=".32em" opacity="1"
                                    style="text-anchor: end;" y="0">60</text>
                                </g>
                                <g class="tick major" transform="translate(0,76.5)" style="opacity: 1;">
                                  <line x2="584" y2="0"></line><text x="-3" dy=".32em" opacity="1"
                                    style="text-anchor: end;" y="0">70</text>
                                </g>
                                <g class="tick major" transform="translate(0,51.00000000000003)" style="opacity: 1;">
                                  <line x2="584" y2="0"></line><text x="-3" dy=".32em" opacity="1"
                                    style="text-anchor: end;" y="0">80</text>
                                </g>
                                <g class="tick major" transform="translate(0,25.50000000000003)" style="opacity: 1;">
                                  <line x2="584" y2="0"></line><text x="-3" dy=".32em" opacity="1"
                                    style="text-anchor: end;" y="0">90</text>
                                </g>
                                <g class="tick major" transform="translate(0,0)" opacity="0" style="opacity: 1;">
                                  <line x2="584" y2="0"></line><text x="-3" dy=".32em" opacity="0"
                                    style="text-anchor: end;" y="0">100</text>
                                </g>
                                <path class="domain" d="M0,0H0V255H0"></path><text class="nv-axislabel"
                                  transform="rotate(-90)" y="-63" x="-127.5" style="text-anchor: middle;"></text>
                              </g>


                              <g class="nv-axisMaxMin" transform="translate(0,255)"><text dy=".32em" y="0" x="-3"
                                  text-anchor="end" style="opacity: 1;">0</text></g>
                              <g class="nv-axisMaxMin" transform="translate(0,0)"><text dy=".32em" y="0" x="-3"
                                  text-anchor="end" style="opacity: 1;">100</text></g>
                            </g>
                          </g>

                          <g class="nv-y2 nv-axis" transform="translate(584,0)" style="opacity: 1;">
                            <g class="nvd3 nv-wrap nv-axis">
                              <g>
                                <g class="tick major" transform="translate(0,255)" style="opacity: 1;">
                                  <line x2="0" y2="0"></line><text x="3" dy=".32em" opacity="0"
                                    style="text-anchor: start;" y="0">$0</text>
                                </g>
                                <g class="tick major" transform="translate(0,226.66666666666666)" style="opacity: 1;">
                                  <line x2="0" y2="0"></line><text x="3" dy=".32em" opacity="1"
                                    style="text-anchor: start;" y="0">$100</text>
                                </g>
                                <g class="tick major" transform="translate(0,198.33333333333334)" style="opacity: 1;">
                                  <line x2="0" y2="0"></line><text x="3" dy=".32em" opacity="1"
                                    style="text-anchor: start;" y="0">$200</text>
                                </g>
                                <g class="tick major" transform="translate(0,170)" style="opacity: 1;">
                                  <line x2="0" y2="0"></line><text x="3" dy=".32em" opacity="1"
                                    style="text-anchor: start;" y="0">$300</text>
                                </g>
                                <g class="tick major" transform="translate(0,141.66666666666669)" style="opacity: 1;">
                                  <line x2="0" y2="0"></line><text x="3" dy=".32em" opacity="1"
                                    style="text-anchor: start;" y="0">$400</text>
                                </g>
                                <g class="tick major" transform="translate(0,113.33333333333331)" style="opacity: 1;">
                                  <line x2="0" y2="0"></line><text x="3" dy=".32em" opacity="1"
                                    style="text-anchor: start;" y="0">$500</text>
                                </g>
                                <g class="tick major" transform="translate(0,85)" style="opacity: 1;">
                                  <line x2="0" y2="0"></line><text x="3" dy=".32em" opacity="1"
                                    style="text-anchor: start;" y="0">$600</text>
                                </g>
                                <g class="tick major" transform="translate(0,56.66666666666666)" style="opacity: 1;">
                                  <line x2="0" y2="0"></line><text x="3" dy=".32em" opacity="1"
                                    style="text-anchor: start;" y="0">$700</text>
                                </g>
                                <g class="tick major" transform="translate(0,28.333333333333343)" style="opacity: 1;">
                                  <line x2="0" y2="0"></line><text x="3" dy=".32em" opacity="1"
                                    style="text-anchor: start;" y="0">$800</text>
                                </g>
                                <g class="tick major" transform="translate(0,0)" opacity="0" style="opacity: 1;">
                                  <line x2="0" y2="0"></line><text x="3" dy=".32em" opacity="0"
                                    style="text-anchor: start;" y="0">$900</text>
                                </g>
                                <path class="domain" d="M0,0H0V255H0"></path><text class="nv-axislabel"
                                  transform="rotate(90)" y="-63" x="127.5" style="text-anchor: middle;"></text>
                              </g>
                              <g class="nv-axisMaxMin" transform="translate(0,255)"><text dy=".32em" y="0" x="3"
                                  style="opacity: 1; text-anchor: start;">$0</text></g>
                              <g class="nv-axisMaxMin" transform="translate(0,0)"><text dy=".32em" y="0" x="3"
                                  style="opacity: 1; text-anchor: start;">$900</text></g>
                            </g>
                          </g>
                          <g class="nv-barsWrap">

                            <g class="nvd3 nv-wrap nv-historicalBar-2818" transform="translate(0,0)">
                              <defs>
                                <clipPath id="nv-chart-clip-path-2818">

                                  <rect width="584" height="255"></rect>
                                </clipPath>
                              </defs>
                              <g clip-path="url(#nv-chart-clip-path-2818)">
                                <g class="nv-bars">
                                  <rect x="0" y="197.2629" height="57.7371" transform="translate(1.8249999999999993,0)"
                                    fill="#DFDFDD" class="nv-bar positive nv-bar-0-0" width="32.85"></rect>
                                  <rect x="0" y="150.31637999999998" height="104.68362000000002"
                                    transform="translate(38.325,0)" fill="#DFDFDD" class="nv-bar positive nv-bar-0-1"
                                    width="32.85"></rect>
                                  <rect x="0" y="172.48582499999998" height="82.51417500000002"
                                    transform="translate(74.825,0)" fill="#DFDFDD" class="nv-bar positive nv-bar-0-2"
                                    width="32.85"></rect>
                                  <rect x="0" y="130.22824500000002" height="124.77175499999998"
                                    transform="translate(111.325,0)" fill="#DFDFDD" class="nv-bar positive nv-bar-0-3"
                                    width="32.85"></rect>
                                  <rect x="0" y="100.5897225" height="154.4102775" transform="translate(147.825,0)"
                                    fill="#DFDFDD" class="nv-bar positive nv-bar-0-4" width="32.85"></rect>
                                  <rect x="0" y="186.1067775" height="68.89322250000001"
                                    transform="translate(184.325,0)" fill="#DFDFDD" class="nv-bar positive nv-bar-0-5"
                                    width="32.85"></rect>
                                  <rect x="0" y="118.5090825" height="136.4909175" transform="translate(220.825,0)"
                                    fill="#DFDFDD" class="nv-bar positive nv-bar-0-6" width="32.85"></rect>
                                  <rect x="0" y="127.42783500000002" height="127.57216499999998"
                                    transform="translate(257.325,0)" fill="#DFDFDD" class="nv-bar positive nv-bar-0-7"
                                    width="32.85"></rect>
                                  <rect x="0" y="167.535765" height="87.464235" transform="translate(293.825,0)"
                                    fill="#DFDFDD" class="nv-bar positive nv-bar-0-8" width="32.85"></rect>
                                  <rect x="0" y="133.0718775" height="121.9281225" transform="translate(330.325,0)"
                                    fill="#DFDFDD" class="nv-bar positive nv-bar-0-9" width="32.85"></rect>
                                  <rect x="0" y="104.8081875" height="150.1918125" transform="translate(366.825,0)"
                                    fill="#DFDFDD" class="nv-bar positive nv-bar-0-10" width="32.85"></rect>
                                  <rect x="0" y="186.9431775" height="68.05682250000001"
                                    transform="translate(403.325,0)" fill="#DFDFDD" class="nv-bar positive nv-bar-0-11"
                                    width="32.85"></rect>
                                  <rect x="0" y="135.1245" height="119.87549999999999" transform="translate(439.825,0)"
                                    fill="#DFDFDD" class="nv-bar positive nv-bar-0-12" width="32.85"></rect>
                                  <rect x="0" y="153.167025" height="101.832975" transform="translate(476.325,0)"
                                    fill="#DFDFDD" class="nv-bar positive nv-bar-0-13" width="32.85"></rect>
                                  <rect x="0" y="163.785225" height="91.214775" transform="translate(512.825,0)"
                                    fill="#DFDFDD" class="nv-bar positive nv-bar-0-14" width="32.85"></rect>
                                  <rect x="0" y="95.67855" height="159.32145" transform="translate(549.325,0)"
                                    fill="#DFDFDD" class="nv-bar positive nv-bar-0-15" width="32.85"></rect>
                                </g>
                              </g>
                            </g>
                          </g>
                          <g class="nv-linesWrap">
                            <g class="nvd3 nv-wrap nv-line" transform="translate(0,0)">
                              <defs>
                                <clipPath id="nv-edge-clip-16233">
                                  <rect width="584" height="255"></rect>
                                </clipPath>
                              </defs>
                              <g clip-path="">
                                <g class="nv-groups">
                                  <g class="nv-group nv-series-0"
                                    style="stroke-opacity: 1; fill-opacity: 0.5; fill: rgb(230, 111, 111); stroke: rgb(230, 111, 111);">
                                    <path class="nv-line"
                                      d="M20.075,231.79583723186025L56.33166666666666,171.3798675056433L92.58833333333332,155.16556696442834L128.84499999999997,147.72319840287628L165.10166666666663,179.59477845676503L201.3583333333333,188.4471406366933L237.61499999999995,224.98838948043056L273.8716666666666,146.39256147422435L310.1283333333333,212.99543135332965L346.38499999999993,206.40891765053834L382.6416666666666,208.3718442483502L418.89833333333326,187.38283676623536L455.1549999999999,146.36341905299827L491.4116666666666,145.70328981681996L527.6683333333333,204.74067592035837L563.925,161.13564557749376">
                                    </path>
                                  </g>
                                </g>
                                <g class="nv-scatterWrap" clip-path="">
                                  <g class="nvd3 nv-wrap nv-scatter nv-chart-16233" transform="translate(0,0)">
                                    <defs>
                                      <clipPath id="nv-edge-clip-16233">
                                        <rect width="584" height="255"></rect>
                                      </clipPath>
                                      <clipPath class="nv-point-clips" id="nv-points-clip-16233">
                                        <circle r="25" cx="20.0750000550729" cy="231.79583726186368"></circle>
                                        <circle r="25" cx="56.3316666870837" cy="171.37986750934732"></circle>
                                        <circle r="25" cx="92.58833337089757" cy="155.16556706288506"></circle>
                                        <circle r="25" cx="128.84500001007194" cy="147.72319847069818"></circle>
                                        <circle r="25" cx="165.10166670025677" cy="179.59477852371052"></circle>
                                        <circle r="25" cx="201.35833336240523" cy="188.44714064337063"></circle>
                                        <circle r="25" cx="237.61500007982" cy="224.9883895142937"></circle>
                                        <circle r="25" cx="273.8716667469256" cy="146.39256154284655"></circle>
                                        <circle r="25" cx="310.12833339260726" cy="212.99543141771872"></circle>
                                        <circle r="25" cx="346.38500004155065" cy="206.40891766006706"></circle>
                                        <circle r="25" cx="382.64166667907494" cy="208.37184433867264"></circle>
                                        <circle r="25" cx="418.89833335460094" cy="187.3828367875734"></circle>
                                        <circle r="25" cx="455.1550000534184" cy="146.3634190544787"></circle>
                                        <circle r="25" cx="491.41166672260186" cy="145.70328982639725"></circle>
                                        <circle r="25" cx="527.6683333973658" cy="204.74067597342238"></circle>
                                        <circle r="25" cx="563.9250000600927" cy="161.13564562669245"></circle>
                                      </clipPath>
                                    </defs>
                                    <g clip-path="">
                                      <g class="nv-groups">
                                        <g class="nv-group nv-series-0"
                                          style="stroke-opacity: 1; fill-opacity: 0.5; stroke: rgb(230, 111, 111); fill: rgb(230, 111, 111);">
                                          <circle cx="20.075" cy="231.79583723186025" r="2.256758334191025"
                                            class="nv-point nv-point-0"></circle>
                                          <circle cx="56.33166666666666" cy="171.3798675056433" r="2.256758334191025"
                                            class="nv-point nv-point-1"></circle>
                                          <circle cx="92.58833333333332" cy="155.16556696442834" r="2.256758334191025"
                                            class="nv-point nv-point-2"></circle>
                                          <circle cx="128.84499999999997" cy="147.72319840287628" r="2.256758334191025"
                                            class="nv-point nv-point-3"></circle>
                                          <circle cx="165.10166666666663" cy="179.59477845676503" r="2.256758334191025"
                                            class="nv-point nv-point-4"></circle>
                                          <circle cx="201.3583333333333" cy="188.4471406366933" r="2.256758334191025"
                                            class="nv-point nv-point-5"></circle>
                                          <circle cx="237.61499999999995" cy="224.98838948043056" r="2.256758334191025"
                                            class="nv-point nv-point-6"></circle>
                                          <circle cx="273.8716666666666" cy="146.39256147422435" r="2.256758334191025"
                                            class="nv-point nv-point-7"></circle>
                                          <circle cx="310.1283333333333" cy="212.99543135332965" r="2.256758334191025"
                                            class="nv-point nv-point-8"></circle>
                                          <circle cx="346.38499999999993" cy="206.40891765053834" r="2.256758334191025"
                                            class="nv-point nv-point-9"></circle>
                                          <circle cx="382.6416666666666" cy="208.3718442483502" r="2.256758334191025"
                                            class="nv-point nv-point-10"></circle>
                                          <circle cx="418.89833333333326" cy="187.38283676623536" r="2.256758334191025"
                                            class="nv-point nv-point-11"></circle>
                                          <circle cx="455.1549999999999" cy="146.36341905299827" r="2.256758334191025"
                                            class="nv-point nv-point-12"></circle>
                                          <circle cx="491.4116666666666" cy="145.70328981681996" r="2.256758334191025"
                                            class="nv-point nv-point-13"></circle>
                                          <circle cx="527.6683333333333" cy="204.74067592035837" r="2.256758334191025"
                                            class="nv-point nv-point-14"></circle>
                                          <circle cx="563.925" cy="161.13564557749376" r="2.256758334191025"
                                            class="nv-point nv-point-15"></circle>
                                        </g>
                                      </g>
                                      <g class="nv-point-paths" clip-path="url(#nv-points-clip-16233)">
                                        <path class="nv-path-0"
                                          d="M1.4446543239374314,179.52833438887978L13.535829227454403,255L35.137910537038096,265L113.93452982380312,265L105.6867794278856,242.08583357970923Z">
                                        </path>
                                        <path class="nv-path-1"
                                          d="M-3.0290841649032956,-10L-10,-9.999999999996133L-9.999999999999972,169.40829724898103L1.4446543239373475,179.5283343888798L105.6867794278856,242.08583357970923L106.26747142052946,234.39714797653113Z">
                                        </path>
                                        <path class="nv-path-2"
                                          d="M77.5771446366193,-10L-3.0290841649402864,-10L106.26747142052946,234.39714797653113L119.61290962220092,194.78382642925152Z">
                                        </path>
                                        <path class="nv-path-3"
                                          d="M77.57714463661927,-10L119.61290962220092,194.78382642925152L200.9472979211714,102.2589562439365L199.9173086369848,-10Z">
                                        </path>
                                        <path class="nv-path-4"
                                          d="M119.61290962220093,194.78382642925152L106.26747142052946,234.39714797653113L105.6867794278856,242.08583357970923L113.93452982380313,265L162.10263642770087,265L164.32513999393458,261.4496954853623L202.1949318177783,106.34618749931822L200.94729792117144,102.2589562439365Z">
                                        </path>
                                        <path class="nv-path-5"
                                          d="M164.32513999393458,261.4496954853623L245.45999402940006,180.94671726693736L202.19493181777833,106.34618749931822Z">
                                        </path>
                                        <path class="nv-path-6"
                                          d="M164.32513999393458,261.4496954853623L162.10263642770087,265L281.4809306422676,265L269.40637621164933,191.99330865828122L245.45999402940006,180.94671726693738Z">
                                        </path>
                                        <path class="nv-path-7"
                                          d="M199.9173086369848,-10L200.9472979211714,102.2589562439365L202.19493181777833,106.34618749931822L245.45999402940004,180.94671726693733L269.40637621164933,191.99330865828122L320.0330240235983,164.43363297831965L361.10407288017274,114.81051609531922L364.50632362687344,102.77309790742953L364.48819460952785,-9.999999999999972Z">
                                        </path>
                                        <path class="nv-path-8"
                                          d="M269.40637621164933,191.99330865828122L281.4809306422676,265L338.3022644465773,265L320.03302402359844,164.43363297831962Z">
                                        </path>
                                        <path class="nv-path-9"
                                          d="M320.03302402359844,164.43363297831962L338.3022644465773,265L361.3943632903064,265L368.08511172255004,141.4170673783276L361.10407288017274,114.81051609531922Z">
                                        </path>
                                        <path class="nv-path-10"
                                          d="M439.62735053884455,265L368.08511172255004,141.4170673783276L361.3943632903064,265Z">
                                        </path>
                                        <path class="nv-path-11"
                                          d="M364.50632362687344,102.77309790742953L361.10407288017274,114.81051609531922L368.08511172255004,141.4170673783276L439.62735053884467,265L462.2819640091385,265L472.8835852131631,198.56671147436217Z">
                                        </path>
                                        <path class="nv-path-12"
                                          d="M437.912872411435,0L424.9934487006722,-10L364.48819460952785,-10L364.50632362687344,102.77309790742953L472.883585213163,198.5667114743621L474.2098200658985,196.91932831447326L471.2428882451492,33.96478323585549Z">
                                        </path>
                                        <path class="nv-path-13"
                                          d="M471.24288824514923,33.96478323585552L474.2098200658985,196.91932831447326L525.0562767436938,165.692962249272L542.00707176176,86.04480837136634Z">
                                        </path>
                                        <path class="nv-path-14"
                                          d="M594,265L594,223.0182197417266L525.0562767436938,165.692962249272L474.2098200658985,196.91932831447326L472.88358521316303,198.5667114743621L462.2819640091384,265Z">
                                        </path>
                                        <path class="nv-path-15"
                                          d="M594,93.41260377856565L542.00707176176,86.0448083713663L525.0562767436938,165.69296224927183L594,223.0182197416941Z">
                                        </path>
                                        <path class="nv-path-16"
                                          d="M-10,169.40829724898174L-9.999999999883585,255L13.535829227454403,255L1.4446543239374314,179.52833438887978Z">
                                        </path>
                                        <path class="nv-path-17"
                                          d="M594.0000000001164,0L437.912872411435,0L471.2428882451492,33.96478323585549L542.00707176176,86.0448083713663L594,93.41260377856526Z">
                                        </path>
                                        <path class="nv-path-18"
                                          d="M-10,255L-10,265L35.137910537038096,265L13.535829227454403,255Z"></path>
                                        <path class="nv-path-19"
                                          d="M594.0000000001164,-10L424.9934487006722,-10L437.912872411435,0L594,0Z">
                                        </path>
                                      </g>
                                    </g>
                                  </g>
                                </g>
                              </g>
                            </g>
                          </g>
                          <g class="nv-legendWrap" transform="translate(292,-30)">
                            <g class="nvd3 nv-legend" transform="translate(0,5)">
                              <g transform="translate(27,5)">
                                <g class="nv-series" transform="translate(0,5)">
                                  <circle class="nv-legend-symbol" r="5"
                                    style="stroke-width: 2; fill: rgb(223, 223, 221); stroke: rgb(223, 223, 221);">
                                  </circle><text text-anchor="start" class="nv-legend-text" dy=".32em" dx="8">Quantity
                                    (left axis)</text>
                                </g>
                                <g class="nv-series" transform="translate(138,5)">
                                  <circle class="nv-legend-symbol" r="5"
                                    style="stroke-width: 2; fill: rgb(230, 111, 111); stroke: rgb(230, 111, 111);">
                                  </circle><text text-anchor="start" class="nv-legend-text" dy=".32em" dx="8">Price
                                    (right axis)</text>
                                </g>
                              </g>
                            </g>
                          </g>
                        </g>
                      </g>
                    </svg>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>





    <div class="col-lg-4 col-md-5">
      <div class="panel">
        <div class="panel-heading">
          <i class="clip-bars"></i>
          <h4 class="panel-title">Pageviews <span class="text-bold">real-time</span></h4>

        </div>
        <div class="panel-body">
          <h3 class="inline">26</h3> visitors on-line
          <div class="progress progress-xs transparent-black no-radius">
            <div aria-valuetransitiongoal="12"
              class="progress-bar progress-bar-success partition-green animate-progress-bar" aria-valuenow="12"
              style="width: 12%;"></div>
          </div>
          <div class="row">
            <div class="col-sm-4">
              <h4>
                <?php 
												$this->db->where("school_code",$school_code);
												$this->db->where("job_category",3);
												$dt =$this->db->get("employee_info");
											$data2=	$dt->num_rows();
												echo $data2;
												?>
              </h4>
              <div class="progress progress-xs transparent-black no-margin no-radius">
                <div aria-valuetransitiongoal="37"
                  class="progress-bar progress-bar-success partition-green animate-progress-bar" aria-valuenow="37"
                  style="width: 37%;"></div>
              </div>
              Total Teacher
            </div>
            <div class="col-sm-4">
              <h4><?php 
												if($dt->num_rows()>0){
                           $i=0;
													foreach($dt->result() as $row):
														//$this->db->count();
														$this->db->where("emp_id",$row->id);
														$this->db->where("school_code",$school_code);
														$dt1=$this->db->get("teacher_attendance")->num_rows();
												   $i=$i+$dt1;
														//print_r($i);
													endforeach;
													print_r($i);
												}
												?></h4>
              <div class="progress progress-xs transparent-black no-margin no-radius">
                <div aria-valuetransitiongoal="23"
                  class="progress-bar progress-bar-success partition-green animate-progress-bar" aria-valuenow="23"
                  style="width: 23%;"></div>
              </div>
              Today's Present
            </div>
            <div class="col-sm-4">
              <h4>
                <?php echo $absent=$data2-$i; ?>
              </h4>
              <div class="progress progress-xs transparent-black no-margin no-radius">
                <div aria-valuetransitiongoal="13"
                  class="progress-bar progress-bar-success partition-green animate-progress-bar" aria-valuenow="13"
                  style="width: 13%;"></div>
              </div>
              Totay's Absent
            </div>
          </div>
          
          <div class="height-120">
            <div id="chart2" class="chart half with-transitions">
              <svg>
                <g class="nvd3 nv-wrap nv-historicalBarChart" transform="translate(0,30)">
                  <g>
                    <g class="nv-x nv-axis" transform="translate(0,80)">
                      <g class="nvd3 nv-wrap nv-axis">
                        <g>
                          <g class="tick major" transform="translate(167.54483369433595,0)" style="opacity: 1;">
                            <line y2="-80" x2="0"></line><text y="7" dy=".71em" x="0"
                              style="text-anchor: middle;">1,056.0</text>
                          </g>
                          <g class="tick major" transform="translate(251.3226046923828,0)" style="opacity: 1;">
                            <line y2="-80" x2="0"></line><text y="7" dy=".71em" x="0"
                              style="text-anchor: middle;">1,058.0</text>
                          </g>
                          <g class="tick major" transform="translate(335.1003909472656,0)" style="opacity: 0.000257;">
                            <line y2="-80" x2="0"></line><text y="7" dy=".71em" x="0"
                              style="text-anchor: middle;">1,060.0</text>
                          </g>
                          <path class="domain" d="M0,0V0H377V0"></path><text class="nv-axislabel" text-anchor="middle"
                            y="36" x="188.5"></text>
                        </g>
                        <g class="nv-axisMaxMin" transform="translate(0,0)"><text dy=".71em" y="7"
                            transform="rotate(0 0,0)" style="text-anchor: middle;">1,053.0</text></g>
                        <g class="nv-axisMaxMin" transform="translate(377,0)"><text dy=".71em" y="7"
                            transform="rotate(0 0,0)" style="text-anchor: middle;">1,062.0</text></g>
                      </g>
                    </g>
                    <g class="nv-y nv-axis"></g>
                    <g class="nv-barsWrap">
                      <g class="nvd3 nv-wrap nv-historicalBar-3508" transform="translate(0,0)">
                        <defs>
                          <clipPath id="nv-chart-clip-path-3508">
                            <rect width="377" height="80"></rect>
                          </clipPath>
                        </defs>
                        <g clip-path="url(#nv-chart-clip-path-3508)">
                          <g class="nv-bars">
													<?php $i=20;
													foreach($dt->result() as $dt3):

													?>
                            
                            <rect x="0" y="<?php echo $i;?>" height="<?php echo $i;?>"
                              transform="translate(66.79850160691406,0)" fill="#5F8295"
                              class="nv-bar positive nv-bar-0-<?php echo $i;?>" width="33.93000000000001"><?php echo $dt3->name;?></rect>
                            
                          
                            
                            <rect x="0" y="37.26956218976048" height="42.73043781023952"
                              transform="translate(360.03499999999997,0)" fill="#5F8295"
                              class="nv-bar positive nv-bar-0-9" width="33.93000000000001"></rect>

													<?php $i++; endforeach;?>
                          </g>
                        </g>
                      </g>
                    </g>
                    <g class="nv-legendWrap"></g>
                  </g>
                </g>
              </svg>
              <!--
												<button id='start-stop-button'>
												Start/Stop Stream
												</button>
												!-->
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-lg-8 col-md-7" style="width:820px;">
      <div class="panel panel-white">
        <div class="panel-heading border-light">
          <h4 class="panel-title">Site <span class="text-bold">Visits</span></h4>
          <ul class="panel-heading-tabs border-light">
            <li>
              <div class="pull-right">
                <div class="btn-group">
                  <a class="btn btn-green dropdown-toggle" data-toggle="dropdown" href="#">
                    Tools <span class="caret"></span>
                  </a>
                  <ul role="menu" class="dropdown-menu">
                    <li class="dropdown-header" role="presentation">
                      Dropdown header
                    </li>
                    <li>
                      <a href="#">
                        Action
                      </a>
                    </li>
                    <li>
                      <a href="#">
                        Another action
                      </a>
                    </li>
                    <li>
                      <a href="#">
                        Something else here
                      </a>
                    </li>
                    <li class="divider"></li>
                    <li class="dropdown-header" role="presentation">
                      Dropdown header
                    </li>
                    <li>
                      <a href="#">
                        Separated link
                      </a>
                    </li>
                  </ul>
                </div>
              </div>
            </li>
            <li>
              <div class="rate">
                <i class="fa fa-caret-up text-green"></i><span class="value">11</span><span class="percentage">%</span>
              </div>
            </li>
            <li class="panel-tools">
              <div class="dropdown">
                <a data-toggle="dropdown" class="btn btn-xs dropdown-toggle btn-transparent-grey">
                  <i class="fa fa-cog"></i>
                </a>
                <ul class="dropdown-menu dropdown-light pull-right" role="menu">
                  <li>
                    <a class="panel-collapse collapses" href="#"><i class="fa fa-angle-up"></i> <span>Collapse</span>
                    </a>
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
            </li>
          </ul>
        </div>
        <div class="panel-body partition-green">
          <div class="col-md-12">
            <div class="height-350">
              <div id="chart4" class="with-3d-shadow with-transitions">
                <svg>
                  <g class="nvd3 nv-wrap nv-lineChart" transform="translate(35,30)">
                    <g>
                      <rect width="750" height="300" style="opacity: 0;"></rect>
                      <g class="nv-x nv-axis" transform="translate(0,300)">
                        <g class="nvd3 nv-wrap nv-axis">
                          <g>
                            <g class="tick major" transform="translate(98.69551060267858,0)" style="opacity: 1;">
                              <line y2="-300" x2="0"></line><text y="7" dy=".71em" x="0"
                                style="text-anchor: middle;">03/02/2019</text>
                            </g>
                            <g class="tick major" transform="translate(253.70543123759919,0)" style="opacity: 1;">
                              <line y2="-300" x2="0"></line><text y="7" dy=".71em" x="0"
                                style="text-anchor: middle;">03/08/2019</text>
                            </g>
                            <g class="tick major" transform="translate(408.7153518725198,0)" style="opacity: 1;">
                              <line y2="-300" x2="0"></line><text y="7" dy=".71em" x="0"
                                style="text-anchor: middle;">03/13/2019</text>
                            </g>
                            <g class="tick major" transform="translate(563.7252725074404,0)" style="opacity: 1;">
                              <line y2="-300" x2="0"></line><text y="7" dy=".71em" x="0"
                                style="text-anchor: middle;">03/19/2019</text>
                            </g>
                            <g class="tick major" transform="translate(718.7351931423611,0)" style="opacity: 1;">
                              <line y2="-300" x2="0"></line><text y="7" dy=".71em" x="0"
                                style="text-anchor: middle;">03/25/2019</text>
                            </g>
                            <path class="domain" d="M0,0V0H750V0"></path><text class="nv-axislabel" text-anchor="middle"
                              y="36" x="375"></text>
                          </g>
                        </g>
                      </g>
                      <g class="nv-y nv-axis">
                        <g class="nvd3 nv-wrap nv-axis">
                          <g>
                            <g class="tick major" transform="translate(0,300)" style="opacity: 1;">
                              <line x2="750" y2="0"></line><text x="-3" dy=".32em" opacity="0" style="text-anchor: end;"
                                y="0">0</text>
                            </g>
                            <g class="tick major" transform="translate(0,262.5)" style="opacity: 1;">
                              <line x2="750" y2="0"></line><text x="-3" dy=".32em" opacity="1" style="text-anchor: end;"
                                y="0">1,000</text>
                            </g>
                            <g class="tick major" transform="translate(0,225)" style="opacity: 1;">
                              <line x2="750" y2="0"></line><text x="-3" dy=".32em" opacity="1" style="text-anchor: end;"
                                y="0">2,000</text>
                            </g>
                            <g class="tick major" transform="translate(0,187.5)" style="opacity: 1;">
                              <line x2="750" y2="0"></line><text x="-3" dy=".32em" opacity="1" style="text-anchor: end;"
                                y="0">3,000</text>
                            </g>
                            <g class="tick major" transform="translate(0,150)" style="opacity: 1;">
                              <line x2="750" y2="0"></line><text x="-3" dy=".32em" opacity="1" style="text-anchor: end;"
                                y="0">4,000</text>
                            </g>
                            <g class="tick major" transform="translate(0,112.5)" style="opacity: 1;">
                              <line x2="750" y2="0"></line><text x="-3" dy=".32em" opacity="1" style="text-anchor: end;"
                                y="0">5,000</text>
                            </g>
                            <g class="tick major" transform="translate(0,75)" style="opacity: 1;">
                              <line x2="750" y2="0"></line><text x="-3" dy=".32em" opacity="1" style="text-anchor: end;"
                                y="0">6,000</text>
                            </g>
                            <g class="tick major" transform="translate(0,37.5)" style="opacity: 1;">
                              <line x2="750" y2="0"></line><text x="-3" dy=".32em" opacity="1" style="text-anchor: end;"
                                y="0">7,000</text>
                            </g>
                            <g class="tick major" transform="translate(0,0)" opacity="0" style="opacity: 1;">
                              <line x2="750" y2="0"></line><text x="-3" dy=".32em" opacity="0" style="text-anchor: end;"
                                y="0">8,000</text>
                            </g>
                            <path class="domain" d="M0,0H0V300H0"></path><text class="nv-axislabel"
                              transform="rotate(-90)" y="-63" x="-150" style="text-anchor: middle;"></text>
                          </g>
                          <g class="nv-axisMaxMin" transform="translate(0,300)"><text dy=".32em" y="0" x="-3"
                              text-anchor="end" style="opacity: 1;">0</text></g>
                          <g class="nv-axisMaxMin" transform="translate(0,0)"><text dy=".32em" y="0" x="-3"
                              text-anchor="end" style="opacity: 1;">8,000</text></g>
                        </g>
                      </g>
                      <g class="nv-linesWrap">
                        <g class="nvd3 nv-wrap nv-line" transform="translate(0,0)">
                          <defs>
                            <clipPath id="nv-edge-clip-50230">
                              <rect width="750" height="300"></rect>
                            </clipPath>
                          </defs>
                          <g clip-path="url(#nv-edge-clip-50230)">
                            <g class="nv-groups">
                              <g class="nv-group nv-series-0"
                                style="stroke-opacity: 1; fill-opacity: 0.5; fill: rgb(217, 83, 79); stroke: rgb(217, 83, 79);">
                                <path class="nv-line"
                                  d="M0,160.35L26.785714285714285,146.13750000000002L53.57142857142857,132.6L80.35714285714286,144.86249999999998L107.14285714285714,150L133.92857142857144,150.1125L160.71428571428572,193.0875L187.5,206.175L214.28571428571428,118.35L241.07142857142858,202.125L267.8571428571429,183.0375L294.6428571428571,158.475L321.42857142857144,186.0375L348.2142857142857,135L375,213.75L401.7857142857143,194.5125L428.57142857142856,153.9375L455.3571428571429,135.89999999999998L482.14285714285717,197.5125L508.92857142857144,207.825L535.7142857142858,169.23749999999998L562.5,190.9875L589.2857142857142,158.5875L616.0714285714287,176.28750000000002L642.8571428571429,161.025L669.6428571428572,216.5625L696.4285714285714,146.5125L723.2142857142858,141.45000000000002L750,152.92499999999998">
                                </path>
                              </g>
                              <g class="nv-group nv-series-1"
                                style="stroke-opacity: 1; fill-opacity: 0.5; fill: rgb(255, 255, 255); stroke: rgb(255, 255, 255);">
                                <path class="nv-line"
                                  d="M0,204.225L26.785714285714285,180.3L53.57142857142857,252.4875L80.35714285714286,174.52499999999998L107.14285714285714,156.675L133.92857142857144,229.8L160.71428571428572,207.225L187.5,220.9875L214.28571428571428,204.1875L241.07142857142858,236.7L267.8571428571429,160.0125L294.6428571428571,225.75L321.42857142857144,237.825L348.2142857142857,222.75L375,215.3625L401.7857142857143,237.3375L428.57142857142856,191.325L455.3571428571429,240.3375L482.14285714285717,230.1375L508.92857142857144,196.5L535.7142857142858,248.7375L562.5,199.8L589.2857142857142,219.4125L616.0714285714287,216.71249999999998L642.8571428571429,163.95L669.6428571428572,222.825L696.4285714285714,181.35L723.2142857142858,177.3375L750,195.6375">
                                </path>
                              </g>
                            </g>
                            <g class="nv-scatterWrap" clip-path="url(#nv-edge-clip-50230)">
                              <g class="nvd3 nv-wrap nv-scatter nv-chart-50230" transform="translate(0,0)">
                                <defs>
                                  <clipPath id="nv-edge-clip-50230">
                                    <rect width="750" height="300"></rect>
                                  </clipPath>
                                </defs>
                                <g clip-path="">
                                  <g class="nv-groups">
                                    <g class="nv-group nv-series-0"
                                      style="stroke-opacity: 1; fill-opacity: 0.5; stroke: rgb(217, 83, 79); fill: rgb(217, 83, 79);">
                                      <circle cx="0" cy="160.35" r="2.256758334191025" class="nv-point nv-point-0">
                                      </circle>
                                      <circle cx="26.785714285714285" cy="146.13750000000002" r="2.256758334191025"
                                        class="nv-point nv-point-1"></circle>
                                      <circle cx="53.57142857142857" cy="132.6" r="2.256758334191025"
                                        class="nv-point nv-point-2"></circle>
                                      <circle cx="80.35714285714286" cy="144.86249999999998" r="2.256758334191025"
                                        class="nv-point nv-point-3"></circle>
                                      <circle cx="107.14285714285714" cy="150" r="2.256758334191025"
                                        class="nv-point nv-point-4"></circle>
                                      <circle cx="133.92857142857144" cy="150.1125" r="2.256758334191025"
                                        class="nv-point nv-point-5 hover"></circle>
                                      <circle cx="160.71428571428572" cy="193.0875" r="2.256758334191025"
                                        class="nv-point nv-point-6"></circle>
                                      <circle cx="187.5" cy="206.175" r="2.256758334191025" class="nv-point nv-point-7">
                                      </circle>
                                      <circle cx="214.28571428571428" cy="118.35" r="2.256758334191025"
                                        class="nv-point nv-point-8"></circle>
                                      <circle cx="241.07142857142858" cy="202.125" r="2.256758334191025"
                                        class="nv-point nv-point-9"></circle>
                                      <circle cx="267.8571428571429" cy="183.0375" r="2.256758334191025"
                                        class="nv-point nv-point-10"></circle>
                                      <circle cx="294.6428571428571" cy="158.475" r="2.256758334191025"
                                        class="nv-point nv-point-11"></circle>
                                      <circle cx="321.42857142857144" cy="186.0375" r="2.256758334191025"
                                        class="nv-point nv-point-12"></circle>
                                      <circle cx="348.2142857142857" cy="135" r="2.256758334191025"
                                        class="nv-point nv-point-13"></circle>
                                      <circle cx="375" cy="213.75" r="2.256758334191025" class="nv-point nv-point-14">
                                      </circle>
                                      <circle cx="401.7857142857143" cy="194.5125" r="2.256758334191025"
                                        class="nv-point nv-point-15"></circle>
                                      <circle cx="428.57142857142856" cy="153.9375" r="2.256758334191025"
                                        class="nv-point nv-point-16"></circle>
                                      <circle cx="455.3571428571429" cy="135.89999999999998" r="2.256758334191025"
                                        class="nv-point nv-point-17"></circle>
                                      <circle cx="482.14285714285717" cy="197.5125" r="2.256758334191025"
                                        class="nv-point nv-point-18"></circle>
                                      <circle cx="508.92857142857144" cy="207.825" r="2.256758334191025"
                                        class="nv-point nv-point-19"></circle>
                                      <circle cx="535.7142857142858" cy="169.23749999999998" r="2.256758334191025"
                                        class="nv-point nv-point-20"></circle>
                                      <circle cx="562.5" cy="190.9875" r="2.256758334191025"
                                        class="nv-point nv-point-21"></circle>
                                      <circle cx="589.2857142857142" cy="158.5875" r="2.256758334191025"
                                        class="nv-point nv-point-22"></circle>
                                      <circle cx="616.0714285714287" cy="176.28750000000002" r="2.256758334191025"
                                        class="nv-point nv-point-23"></circle>
                                      <circle cx="642.8571428571429" cy="161.025" r="2.256758334191025"
                                        class="nv-point nv-point-24"></circle>
                                      <circle cx="669.6428571428572" cy="216.5625" r="2.256758334191025"
                                        class="nv-point nv-point-25"></circle>
                                      <circle cx="696.4285714285714" cy="146.5125" r="2.256758334191025"
                                        class="nv-point nv-point-26"></circle>
                                      <circle cx="723.2142857142858" cy="141.45000000000002" r="2.256758334191025"
                                        class="nv-point nv-point-27"></circle>
                                      <circle cx="750" cy="152.92499999999998" r="2.256758334191025"
                                        class="nv-point nv-point-28"></circle>
                                    </g>
                                    <g class="nv-group nv-series-1"
                                      style="stroke-opacity: 1; fill-opacity: 0.5; stroke: rgb(255, 255, 255); fill: rgb(255, 255, 255);">
                                      <circle cx="0" cy="204.225" r="2.256758334191025" class="nv-point nv-point-0">
                                      </circle>
                                      <circle cx="26.785714285714285" cy="180.3" r="2.256758334191025"
                                        class="nv-point nv-point-1"></circle>
                                      <circle cx="53.57142857142857" cy="252.4875" r="2.256758334191025"
                                        class="nv-point nv-point-2"></circle>
                                      <circle cx="80.35714285714286" cy="174.52499999999998" r="2.256758334191025"
                                        class="nv-point nv-point-3"></circle>
                                      <circle cx="107.14285714285714" cy="156.675" r="2.256758334191025"
                                        class="nv-point nv-point-4"></circle>
                                      <circle cx="133.92857142857144" cy="229.8" r="2.256758334191025"
                                        class="nv-point nv-point-5 hover"></circle>
                                      <circle cx="160.71428571428572" cy="207.225" r="2.256758334191025"
                                        class="nv-point nv-point-6"></circle>
                                      <circle cx="187.5" cy="220.9875" r="2.256758334191025"
                                        class="nv-point nv-point-7"></circle>
                                      <circle cx="214.28571428571428" cy="204.1875" r="2.256758334191025"
                                        class="nv-point nv-point-8"></circle>
                                      <circle cx="241.07142857142858" cy="236.7" r="2.256758334191025"
                                        class="nv-point nv-point-9"></circle>
                                      <circle cx="267.8571428571429" cy="160.0125" r="2.256758334191025"
                                        class="nv-point nv-point-10"></circle>
                                      <circle cx="294.6428571428571" cy="225.75" r="2.256758334191025"
                                        class="nv-point nv-point-11"></circle>
                                      <circle cx="321.42857142857144" cy="237.825" r="2.256758334191025"
                                        class="nv-point nv-point-12"></circle>
                                      <circle cx="348.2142857142857" cy="222.75" r="2.256758334191025"
                                        class="nv-point nv-point-13"></circle>
                                      <circle cx="375" cy="215.3625" r="2.256758334191025" class="nv-point nv-point-14">
                                      </circle>
                                      <circle cx="401.7857142857143" cy="237.3375" r="2.256758334191025"
                                        class="nv-point nv-point-15"></circle>
                                      <circle cx="428.57142857142856" cy="191.325" r="2.256758334191025"
                                        class="nv-point nv-point-16"></circle>
                                      <circle cx="455.3571428571429" cy="240.3375" r="2.256758334191025"
                                        class="nv-point nv-point-17"></circle>
                                      <circle cx="482.14285714285717" cy="230.1375" r="2.256758334191025"
                                        class="nv-point nv-point-18"></circle>
                                      <circle cx="508.92857142857144" cy="196.5" r="2.256758334191025"
                                        class="nv-point nv-point-19"></circle>
                                      <circle cx="535.7142857142858" cy="248.7375" r="2.256758334191025"
                                        class="nv-point nv-point-20"></circle>
                                      <circle cx="562.5" cy="199.8" r="2.256758334191025" class="nv-point nv-point-21">
                                      </circle>
                                      <circle cx="589.2857142857142" cy="219.4125" r="2.256758334191025"
                                        class="nv-point nv-point-22"></circle>
                                      <circle cx="616.0714285714287" cy="216.71249999999998" r="2.256758334191025"
                                        class="nv-point nv-point-23"></circle>
                                      <circle cx="642.8571428571429" cy="163.95" r="2.256758334191025"
                                        class="nv-point nv-point-24"></circle>
                                      <circle cx="669.6428571428572" cy="222.825" r="2.256758334191025"
                                        class="nv-point nv-point-25"></circle>
                                      <circle cx="696.4285714285714" cy="181.35" r="2.256758334191025"
                                        class="nv-point nv-point-26"></circle>
                                      <circle cx="723.2142857142858" cy="177.3375" r="2.256758334191025"
                                        class="nv-point nv-point-27"></circle>
                                      <circle cx="750" cy="195.6375" r="2.256758334191025" class="nv-point nv-point-28">
                                      </circle>
                                    </g>
                                  </g>
                                  <g class="nv-point-paths"></g>
                                </g>
                              </g>
                            </g>
                          </g>
                        </g>
                      </g>
                      <g class="nv-legendWrap" transform="translate(0,-30)">
                        <g class="nvd3 nv-legend" transform="translate(0,5)">
                          <g transform="translate(567.5,5)">
                            <g class="nv-series" transform="translate(0,5)">
                              <circle class="nv-legend-symbol" r="5"
                                style="stroke-width: 2; fill: rgb(217, 83, 79); stroke: rgb(217, 83, 79);"></circle>
                              <text text-anchor="start" class="nv-legend-text" dy=".32em" dx="8">Page Views</text>
                            </g>
                            <g class="nv-series" transform="translate(83,5)">
                              <circle class="nv-legend-symbol" r="5"
                                style="stroke-width: 2; fill: rgb(255, 255, 255); stroke: rgb(255, 255, 255);"></circle>
                              <text text-anchor="start" class="nv-legend-text" dy=".32em" dx="8">Unique Visits</text>
                            </g>
                          </g>
                        </g>
                      </g>
                      <g class="nv-interactive">
                        <g class=" nv-wrap nv-interactiveLineLayer">
                          <g class="nv-interactiveGuideLine">
                            <line class="nv-guideline" x1="133.92857142857144" x2="133.92857142857144" y1="300" y2="0">
                            </line>
                          </g>
                        </g>
                      </g>
                    </g>
                  </g>
                </svg>
                <div class="nvtooltip xy-tooltip nv-pointer-events-none" id="nvtooltip-56515"
                  style="top: 160.5px; left: 233.929px; opacity: 1; position: absolute;">
                  <table class="nv-pointer-events-none">
                    <thead>
                      <tr class="nv-pointer-events-none">
                        <td colspan="3" class="nv-pointer-events-none"><strong class="x-value">03/03/2019</strong></td>
                      </tr>
                    </thead>
                    <tbody>
                      <tr class="nv-pointer-events-none">
                        <td class="legend-color-guide nv-pointer-events-none">
                          <div style="background-color: rgb(217, 83, 79);" class="nv-pointer-events-none"></div>
                        </td>
                        <td class="key nv-pointer-events-none">Page Views</td>
                        <td class="value nv-pointer-events-none">3,997</td>
                      </tr>
                      <tr class="nv-pointer-events-none">
                        <td class="legend-color-guide nv-pointer-events-none">
                          <div style="background-color: rgb(255, 255, 255);" class="nv-pointer-events-none"></div>
                        </td>
                        <td class="key nv-pointer-events-none">Unique Visits</td>
                        <td class="value nv-pointer-events-none">1,872</td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>





  <div class="row" Style="margin-left:2px;">
    <div class="col-md-4 col-lg-4">
      <div class="panel panel-default panel-white ">
        <div class="panel-body no-padding">
          <div class="partition-green padding-20 text-center text-bold">
            <a href="<?php echo base_url(); ?>index.php/smsAjax/smsPanel" class="text-white">
              Click for SMS Panel
            </a>
          </div>

          <div class="padding-20 core-content">
            <h2 class="title block no-margin"></h2>
            <br />
            <span class="subtitle"></span>
          </div>
        </div>
      </div>
    </div>
    <div class="col-lg-4 col-md-12">
      <div class="panel panel-white">

        <div class="panel-body no-padding">
          <div class="padding-10">

            <h4 class="no-margin inline-block padding-5">Attendance Report <span
                class="block text-small text-left">Total Absent</span></h4>

          </div>

          <div class="tabbable no-margin no-padding partition-dark">

            <div class="tab-content partition-white">
              <div id="users_tab_example1" class="tab-pane padding-bottom-5 active">
                <div class="panel-scroll height-230">
                  <table class="table table-striped table-hover">
                    <thead>
                      <tr>

                        <th><span class="">Class Name</span><a href="#" class="btn"></i></a></th>
                        <th>Total
                        </th>
                        <th class="Present">Present
                        </th>
                        <th class="Absent">Absent
                        </th>
                        <th class="Leave">Leave
                        </th>


                      </tr>


                    </thead>
                    <tbody>

                      <?php $dat=date("Y-m-d") ;
															
															$this->db->distinct();
															//$this->db->select('id');
															$this->db->where("school_code",$this->session->userdata("school_code"));
															$dfg = $this->db->get('class_info');
															if($dfg->num_rows()>0){
															$vyt=	$dfg->result();
															  
															foreach($vyt as $t):
															
															$this->db->where("school_code",$this->session->userdata("school_code"));
															$this->db->where("DATE(a_date)",$dat);
															$this->db->where("class_id",$t->id);
															$grt = $this->db->get("attendance");
															if($grt->num_rows()>0){
																$ft = $grt->result();
																$p=0;$l=0;$a=0;
																	foreach($ft as $f):
																
																	if($f->attendance==0){
																	
																	$a=$a+1;
																	}
																	else{
																		$p=$p+1;	
																	}
																	
																	endforeach;
															?>
                      <tr>

                        <td><span>&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $t->class_name;?></span><a href="#"
                            class="btn"></a></td>
                        <td class="center"><?php echo $grt->num_rows();?>
                        </td>
                        <td class="center"><?php echo $p;?>
                        </td>
                        <td class="center"><?php echo $a;?>
                        </td>
                        <td class="center"><?php echo $l;?>
                        </td>
                      </tr>

                      <?php }else{
																
															}
															endforeach;
														}
															?>




                    </tbody>
                  </table>
                </div>
              </div>
              <div id="users_tab_example2" class="tab-pane padding-bottom-5">
                <div class="panel-scroll height-230">
                  <table class="table table-striped table-hover">
                    <tbody>
                      <tr>
                        <td class="center"><img src="assets/images/avatar-3.jpg" class="img-circle" alt="image" /></td>
                        <td><span class="text-small block text-light">Visual Designer</span><span
                            class="text-large">Steven Thompson</span><a href="#" class="btn"><i
                              class="fa fa-pencil"></i></a></td>
                        <td class="center">
                          <div>
                            <div class="btn-group">
                              <a class="btn btn-transparent-grey dropdown-toggle btn-sm" data-toggle="dropdown"
                                href="#">
                                <i class="fa fa-cog"></i> <span class="caret"></span>
                              </a>
                              <ul role="menu" class="dropdown-menu dropdown-dark pull-right">
                                <li role="presentation">
                                  <a role="menuitem" tabindex="-1" href="#">
                                    <i class="fa fa-edit"></i> Edit
                                  </a>
                                </li>
                                <li role="presentation">
                                  <a role="menuitem" tabindex="-1" href="#">
                                    <i class="fa fa-share"></i> Share
                                  </a>
                                </li>
                                <li role="presentation">
                                  <a role="menuitem" tabindex="-1" href="#">
                                    <i class="fa fa-times"></i> Remove
                                  </a>
                                </li>
                              </ul>
                            </div>
                          </div>
                        </td>
                      </tr>
                      <tr>
                        <td class="center"><img src="assets/images/avatar-5.jpg" class="img-circle" alt="image" /></td>
                        <td><span class="text-small block text-light">Senior Designer</span><span
                            class="text-large">Kenneth Ross</span><a href="#" class="btn"><i
                              class="fa fa-pencil"></i></a></td>
                        <td class="center">
                          <div>
                            <div class="btn-group">
                              <a class="btn btn-transparent-grey dropdown-toggle btn-sm" data-toggle="dropdown"
                                href="#">
                                <i class="fa fa-cog"></i> <span class="caret"></span>
                              </a>
                              <ul role="menu" class="dropdown-menu dropdown-dark pull-right">
                                <li role="presentation">
                                  <a role="menuitem" tabindex="-1" href="#">
                                    <i class="fa fa-edit"></i> Edit
                                  </a>
                                </li>
                                <li role="presentation">
                                  <a role="menuitem" tabindex="-1" href="#">
                                    <i class="fa fa-share"></i> Share
                                  </a>
                                </li>
                                <li role="presentation">
                                  <a role="menuitem" tabindex="-1" href="#">
                                    <i class="fa fa-times"></i> Remove
                                  </a>
                                </li>
                              </ul>
                            </div>
                          </div>
                        </td>
                      </tr>
                      <tr>
                        <td class="center"><img src="assets/images/avatar-4.jpg" class="img-circle" alt="image" /></td>
                        <td><span class="text-small block text-light">Web Editor</span><span class="text-large">Ella
                            Patterson</span><a href="#" class="btn"><i class="fa fa-pencil"></i></a></td>
                        <td class="center">
                          <div>
                            <div class="btn-group">
                              <a class="btn btn-transparent-grey dropdown-toggle btn-sm" data-toggle="dropdown"
                                href="#">
                                <i class="fa fa-cog"></i> <span class="caret"></span>
                              </a>
                              <ul role="menu" class="dropdown-menu dropdown-dark pull-right">
                                <li role="presentation">
                                  <a role="menuitem" tabindex="-1" href="#">
                                    <i class="fa fa-edit"></i> Edit
                                  </a>
                                </li>
                                <li role="presentation">
                                  <a role="menuitem" tabindex="-1" href="#">
                                    <i class="fa fa-share"></i> Share
                                  </a>
                                </li>
                                <li role="presentation">
                                  <a role="menuitem" tabindex="-1" href="#">
                                    <i class="fa fa-times"></i> Remove
                                  </a>
                                </li>
                              </ul>
                            </div>
                          </div>
                        </td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
              <div id="users_tab_example3" class="tab-pane padding-bottom-5">
                <div class="panel-scroll height-230">
                  <table class="table table-striped table-hover">
                    <tbody>
                      <tr>
                        <td class="center"><img src="assets/images/avatar-2.jpg" class="img-circle" alt="image" /></td>
                        <td><span class="text-small block text-light">Content Designer</span><span
                            class="text-large">Nicole Bell</span><a href="#" class="btn"><i
                              class="fa fa-pencil"></i></a></td>
                        <td class="center">
                          <div>
                            <div class="btn-group">
                              <a class="btn btn-transparent-grey dropdown-toggle btn-sm" data-toggle="dropdown"
                                href="#">
                                <i class="fa fa-cog"></i> <span class="caret"></span>
                              </a>
                              <ul role="menu" class="dropdown-menu dropdown-dark pull-right">
                                <li role="presentation">
                                  <a role="menuitem" tabindex="-1" href="#">
                                    <i class="fa fa-edit"></i> Edit
                                  </a>
                                </li>
                                <li role="presentation">
                                  <a role="menuitem" tabindex="-1" href="#">
                                    <i class="fa fa-share"></i> Share
                                  </a>
                                </li>
                                <li role="presentation">
                                  <a role="menuitem" tabindex="-1" href="#">
                                    <i class="fa fa-times"></i> Remove
                                  </a>
                                </li>
                              </ul>
                            </div>
                          </div>
                        </td>
                      </tr>
                      <tr>
                        <td class="center"><img src="assets/images/avatar-3.jpg" class="img-circle" alt="image" /></td>
                        <td><span class="text-small block text-light">Visual Designer</span><span
                            class="text-large">Steven Thompson</span><a href="#" class="btn"><i
                              class="fa fa-pencil"></i></a></td>
                        <td class="center">
                          <div>
                            <div class="btn-group">
                              <a class="btn btn-transparent-grey dropdown-toggle btn-sm" data-toggle="dropdown"
                                href="#">
                                <i class="fa fa-cog"></i> <span class="caret"></span>
                              </a>
                              <ul role="menu" class="dropdown-menu dropdown-dark pull-right">
                                <li role="presentation">
                                  <a role="menuitem" tabindex="-1" href="#">
                                    <i class="fa fa-edit"></i> Edit
                                  </a>
                                </li>
                                <li role="presentation">
                                  <a role="menuitem" tabindex="-1" href="#">
                                    <i class="fa fa-share"></i> Share
                                  </a>
                                </li>
                                <li role="presentation">
                                  <a role="menuitem" tabindex="-1" href="#">
                                    <i class="fa fa-times"></i> Remove
                                  </a>
                                </li>
                              </ul>
                            </div>
                          </div>
                        </td>
                      </tr>
                      <tr>
                        <td class="center"><img src="assets/images/avatar-5.jpg" class="img-circle" alt="image" /></td>
                        <td><span class="text-small block text-light">Senior Designer</span><span
                            class="text-large">Kenneth Ross</span><a href="#" class="btn"><i
                              class="fa fa-pencil"></i></a></td>
                        <td class="center">
                          <div>
                            <div class="btn-group">
                              <a class="btn btn-transparent-grey dropdown-toggle btn-sm" data-toggle="dropdown"
                                href="#">
                                <i class="fa fa-cog"></i> <span class="caret"></span>
                              </a>
                              <ul role="menu" class="dropdown-menu dropdown-dark pull-right">
                                <li role="presentation">
                                  <a role="menuitem" tabindex="-1" href="#">
                                    <i class="fa fa-edit"></i> Edit
                                  </a>
                                </li>
                                <li role="presentation">
                                  <a role="menuitem" tabindex="-1" href="#">
                                    <i class="fa fa-share"></i> Share
                                  </a>
                                </li>
                                <li role="presentation">
                                  <a role="menuitem" tabindex="-1" href="#">
                                    <i class="fa fa-times"></i> Remove
                                  </a>
                                </li>
                              </ul>
                            </div>
                          </div>
                        </td>
                      </tr>
                      <tr>
                        <td class="center"><img src="assets/images/avatar-4.jpg" class="img-circle" alt="image" /></td>
                        <td><span class="text-small block text-light">Web Editor</span><span class="text-large">Ella
                            Patterson</span><a href="#" class="btn"><i class="fa fa-pencil"></i></a></td>
                        <td class="center">
                          <div>
                            <div class="btn-group">
                              <a class="btn btn-transparent-grey dropdown-toggle btn-sm" data-toggle="dropdown"
                                href="#">
                                <i class="fa fa-cog"></i> <span class="caret"></span>
                              </a>
                              <ul role="menu" class="dropdown-menu dropdown-dark pull-right">
                                <li role="presentation">
                                  <a role="menuitem" tabindex="-1" href="#">
                                    <i class="fa fa-edit"></i> Edit
                                  </a>
                                </li>
                                <li role="presentation">
                                  <a role="menuitem" tabindex="-1" href="#">
                                    <i class="fa fa-share"></i> Share
                                  </a>
                                </li>
                                <li role="presentation">
                                  <a role="menuitem" tabindex="-1" href="#">
                                    <i class="fa fa-times"></i> Remove
                                  </a>
                                </li>
                              </ul>
                            </div>
                          </div>
                        </td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-lg-4 col-md-12">
      <div class="panel panel-white">
        <div class="panel-body no-padding">
          <div class="padding-10">
            <h4 class="no-margin inline-block padding-5">Absent Teachers 
            <!-- <span class="block text-small text-left">Total Absent</span> -->
            </h4>
          </div>
          <div class="tabbable no-margin no-padding partition-dark">
            <div class="tab-content partition-white">
              <div id="users_tab_example1" class="tab-pane padding-bottom-5 active">
                <div class="panel-scroll height-230">
                  <table class="table table-striped table-hover">
                    <thead>
                      <tr>
                        <th>#</th>
                        <th>Teacher Name</th>
                        <th>Status</th>
                        <th>Date</th>
                        <th>Action</th>
                        <!-- <th class="Leave">Leave</th> -->
                      </tr>
                    </thead>
                    <tbody>

                      <?php 
                          if($emp_lev->num_rows()>0){ $i=1;                
                          foreach($emp_lev->result() as $lv_data)
                          {                           															
                          ?>
                      <tr>
                        <td><?php echo $i;?></td>
                        <td><?php echo $lv_data->emp_id; ?></td>
                        <td>Absent</td>
                        <td><?php echo $lv_data->a_date; ?></td>
                        <td>
                            <input type="hidden" id="abc<?php echo $i;?>"  value="<?php echo $lv_data->emp_id; ?>"/>
                            <input type="button" id="assgin<?php echo $i;?>"  value="Assgin" class="btn btn-danger" />
                            <input type="button" id="assgined<?php echo $i;?>"  value="Assgined" class="btn btn-success" />
                        </td>
                      </tr>
                      <script>
                      $("#assgin<?php echo $i;?>").show();
                      alert("3"); 
                      $("#assgined<?php echo $i;?>").hide();
                      </script>
                      
                     
                            <?php 
														$i++;	}
														}
															?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    
  </div>

  <div class="row" style="margin-left:2px;">
    <div class="col-md-4 col-lg-4">
      <div class="panel panel-dark">
        <div class="panel-heading">
          <h4 class="panel-title">Cash Transaction</h4>
          <div class="panel-tools">
            <div class="dropdown">
              <a data-toggle="dropdown" class="btn btn-xs dropdown-toggle btn-transparent-white">
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
        <div class="panel-body no-padding">
          <div class="partition-green padding-15 text-center">
            <h4 class="no-margin">Last 4 Transaction</h4>
          </div>
          <div id="accordion" class="panel-group accordion accordion-white no-margin">
            <div class="panel no-radius">
              <div class="panel-heading">
                <h4 class="panel-title">
                  <a href="#collapseOne" data-parent="#accordion" data-toggle="collapse"
                    class="accordion-toggle padding-15">
                    <i class="icon-arrow"></i>
                    <?php $new = $this->db->query("SELECT * FROM cash_payment WHERE date='".date("Y-m-d")."' AND school_code='$school_code'")->num_rows();?>
                    Cash Payment <?php if($new > 0):?> <span
                      class="label label-danger pull-right"><?php echo $new;?></span><?php endif;?>
                  </a></h4>
              </div>
              <div class="panel-collapse collapse in" id="collapseOne">
                <div class="panel-body no-padding partition-light-grey">
                  <a href="<?php echo base_url()?>index.php/login/dayBook">
                    <table class="table">
                      <tbody>
                        <?php $i=1;?>
                        <?php $cash = $this->db->query("SELECT * FROM cash_payment where school_code='$school_code' ORDER BY receipt_no DESC LIMIT 4");?>
                        <?php if($cash->num_rows() >= 1):?>
                        <?php foreach($cash->result() as $row):?>
                        <tr>
                          <td class="center"><?php echo $i;?></td>
                          <td>
                            <?php
                                    		if(strlen($row->valid_id)>1):
                                    			echo $row->valid_id;
                                    		else:
                                    			echo $row->name;
                                    		endif;
                                    	?>
                          </td>
                          <td class="center"><?php echo $row->amount;?></td>
                          <td><?php echo date("d-M-Y", strtotime("$row->date"));?></td>
                        </tr>
                        <?php $i++; endforeach;?>
                        <?php else: ?>
                        <tr>
                          <td class="center">
                            <h2>No Trasaction done yet...</h2>
                          </td>
                        </tr>
                        <?php endif;?>
                      </tbody>
                    </table>
                  </a>
                </div>
              </div>
            </div>
            <div class="panel no-radius">
              <div class="panel-heading">
                <h4 class="panel-title">
                  <a href="#collapseTwo" data-parent="#accordion" data-toggle="collapse"
                    class="accordion-toggle padding-15 collapsed">
                    <i class="icon-arrow"></i>
                    <?php $new = $this->db->query("SELECT * FROM bank_transaction WHERE school_code='$school_code' AND date='".date("Y-m-d")."'")->num_rows();?>
                    Bank Transaction <?php if($new > 0):?> <span
                      class="label label-danger pull-right"><?php echo $new;?></span><?php endif;?>
                  </a></h4>
              </div>
              <div class="panel-collapse collapse" id="collapseTwo">
                <div class="panel-body no-padding partition-light-grey">
                  <a href="<?php echo base_url()?>index.php/login/dayBook">
                    <table class="table">
                      <tbody>
                        <?php $i=1;?>
                        <?php $cash = $this->db->query("SELECT * FROM bank_transaction WHERE school_code='$school_code' ORDER BY receipt_no DESC LIMIT 4");?>
                        <?php if($cash->num_rows() >= 1):?>
                        <?php foreach($cash->result() as $row):?>
                        <tr>
                          <td class="center">1</td>
                          <td><?php echo $row->id_name; ?></td>
                          <td class="center"><?php echo $row->amount;?></td>
                          <td><?php echo date("d-M-Y", strtotime("$row->date"));?></td>
                        </tr>
                        <?php $i++; endforeach;?>
                      </tbody>
                      <?php else: ?>
                      <tr>
                        <td class="center">
                          <h2>No Trasaction done yet...</h2>
                        </td>
                      </tr>
                      <?php endif;?>
                    </table>
                  </a>
                </div>
              </div>
            </div>
            <div class="panel no-radius">
              <div class="panel-heading">
                <h4 class="panel-title">
                  <a href="#collapseThree" data-parent="#accordion" data-toggle="collapse"
                    class="accordion-toggle padding-15 collapsed">
                    <i class="icon-arrow"></i>
                    <?php $new = $this->db->query("SELECT * FROM director_transaction WHERE school_code='$school_code' AND date='".date("Y-m-d")."'")->num_rows();?>
                    Director Transaction <?php if($new > 0):?> <span
                      class="label label-danger pull-right"><?php echo $new;?></span><?php endif;?>
                  </a></h4>
              </div>
              <div class="panel-collapse collapse" id="collapseThree">
                <div class="panel-body no-padding partition-light-grey">
                  <a href="<?php echo base_url()?>index.php/login/dayBook">
                    <table class="table">
                      <tbody>
                        <?php $i=1;?>
                        <?php $cash = $this->db->query("SELECT * FROM director_transaction WHERE school_code='$school_code' ORDER BY receipt_no DESC LIMIT 4");?>
                        <?php if($cash->num_rows() >= 1):?>
                        <?php foreach($cash->result() as $row):?>
                        <tr>
                          <td class="center"><?php echo $i;?></td>
                          <td>
                            <?php echo $row->applicant_name; ?>
                          </td>
                          <td class="center"><?php echo $row->amount;?></td>
                          <td><?php echo date("d-M-Y", strtotime("$row->date"));?></td>
                        </tr>
                        <?php $i++; endforeach;?>
                        <?php else: ?>
                        <tr>
                          <td class="center">
                            <h2>No Trasaction done yet...</h2>
                          </td>
                        </tr>
                        <?php endif;?>
                      </tbody>
                    </table>
                  </a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-md-4 col-lg-4 col-sm-6">
      <div class="panel panel-blue core-box">

        <?php              $dt=date('Y-m-d'); ?>
        <?php $leve = $this->db->query("SELECT * FROM emp_leave WHERE school_code='$school_code' AND  end_date>='$dt' ORDER BY id");?>
        <?php $is_row=$leve->num_rows();?>
        <?php if($is_row > 0):?>
        <div class="e-slider owl-carousel owl-theme">
          <?php foreach($leve->result() as $row):?>
          <?php $id = $row->emp_id;?>
          <?php
			$this->db->where("school_code",$this->session->userdata("school_code"));
			$this->db->where("id",$id); 
		    $info = $this->db->get("employee_info")->row(); ?>

          <div class="item">
            <div class="panel-body">
              <div class="core-box">
                <div class="text-light text-bold">
                  Employee Leave Request
                </div>
                <br />
                <table style="width: 100%;">
                  <tr>
                    <td rowspan="4" width="30%">

                      <?php if(strlen($info->photo > 0)):?>
                      <img
                        src="<?php echo base_url();?>assets/<?= $this->session->userdata('school_code') ?>/images/empImage/<?php echo $info->photo; ?>"
                        alt="" width="90" height="105" />
                      <?php else:?>
                      <?php if($info->gender == 'Male'):?>
                      <img alt="<?php echo $info->name;?>" width="80%"
                        src="<?php echo $this->config->item('asset_url'); ?><?php echo $this->session->userdata("school_code");?>/images/empImage/empMale.png" />
                      <?php endif;?>
                      <?php if($info->gender == 'Female'):?>
                      <img alt="<?php echo $info->name;?>" width="80%"
                        src="<?php echo $this->config->item('asset_url'); ?><?php echo $this->session->userdata("school_code");?>/images/empImage/empFemale.png" />
                      <?php endif;?>
                      <?php endif;?>
                    </td>
                    <td>Name :
                      <?php echo $info->name;?>
                    </td>
                  </tr>
                  <tr>
                    <td>Start Date : <?php echo date("d-M-Y", strtotime($row->start_date)); ?></td>
                  </tr>
                  <tr>
                    <td>Days : <?php echo $row->total_leave; ?></td>
                  </tr>
                  <tr>
                    <td>End Date : <?php echo date("d-M-Y", strtotime($row->end_date)); ?></td>
                  </tr>
                  <tr>
                    <td colspan="2"><br />Reason :
                      <?php echo implode(' ', array_slice(explode(' ', $row->reason), 0, 7)); ?>...</td>
                  </tr>
                </table>
              </div>
            </div>
            <div class="padding-10">
              <?php if($row->status==0){?>
              <a href="<?php echo base_url();?>index.php/adminController/appleaveemp/<?php echo $row->id;?>"
                class="btn btn-sm btn-light-green"><i class="fa fa-check"></i> Approve</a>
              <a href="<?php echo base_url();?>index.php/adminController/deleleaveemp/<?php echo $row->id;?>"
                class="btn btn-sm btn-light-red"><strong>x</strong> Reject</a>
              <?php } else{?>
              <a href="#" class="btn btn-sm btn-light-yellow">
                Approved<i class="fa fa-check"></i>
              </a>
              <?php }?>
            </div>
          </div>

          <?php endforeach; ?>
        </div>
        <?php else: ?>
        <div class="item">
          <div class="panel-body">
            <div class="core-box">
              <div class="text-light text-bold">
                Employee Leave Request
              </div>
              <br />
              <h2>There is no request for the day.....</h2>
            </div>
          </div>
        </div>
        <?php endif;?>

      </div>
    </div>
    <div class="col-md-4 col-lg-4 col-sm-6" style="height:auto;">
      <div class="panel panel-blue core-box">
        <div class="e-slider owl-carousel owl-theme">
          <?php $dt=date('Y-m-d');?>
          <?php $leve = $this->db->query("SELECT * FROM stu_leave WHERE school_code='$school_code' AND end_date>='$dt'  ORDER BY id");?>
          <?php $is_row=$leve->num_rows();?>
          <?php if($is_row > 0):?>

          <?php foreach($leve->result() as $row):?>
          <?php $id = $row->stu_id;?>
          <?php
			//$this->db->where("school_code",$this->session->userdata("school_code"));
			$this->db->where("id",$id); ?>
          <?php $info = $this->db->get("student_info")->row(); ?>
          <div class="item">
            <div class="panel-body">
              <div class="core-box">
                <div class="text-light text-bold">
                  Student Leave Request
                </div>
                <br />
                <table style="width: 100%;">
                  <tr>
                    <td rowspan="4" width="30%">

                      <?php if(strlen($info->photo > 0)):?>
                      <img alt="<?php echo $info->name;?>" width="80%"
                        src="<?php echo $this->config->item('asset_url'); ?><?php echo $this->session->userdata("school_code");?>/images/stuImage/<?php echo $info->photo;?>" />
                      <?php else:?>
                      <?php if($info->gender == 'Male'):?>
                      <img alt="<?php echo $info->name;?>" width="80%"
                        src="<?php echo $this->config->item('asset_url'); ?><?php echo $this->session->userdata("school_code");?>/images/stuImage/empMale.png" />
                      <?php endif;?>
                      <?php if($info->gender == 'Female'):?>
                      <img alt="<?php echo $info->name;?>" width="80%"
                        src="<?php echo $this->config->item('asset_url'); ?><?php echo $this->session->userdata("school_code");?>/images/stuImage/empFemale.png" />
                      <?php endif;?>
                      <?php endif;?>
                    </td>
                    <td>Name :
                      <?php echo $info->name;?>
                    </td>
                  </tr>
                  <tr>
                    <td>Start Date : <?php echo date("d-M-Y", strtotime($row->start_date)); ?></td>
                  </tr>
                  <tr>
                    <td>Days : <?php echo $row->total_leave; ?></td>
                  </tr>
                  <tr>
                    <td>End Date : <?php echo date("d-M-Y", strtotime($row->end_date)); ?></td>
                  </tr>
                  <tr>
                    <td colspan="2"><br />Reason :
                      <?php echo implode(' ', array_slice(explode(' ', $row->reason), 0, 7)); ?>...</td>
                  </tr>
                </table>
              </div>
            </div>
            <div class="padding-10">
              <?php if($row->approve=='NO'){?>
              <a href="<?php echo base_url();?>index.php/adminController/appleave/<?php echo $row->id;?>"
                class="btn btn-sm btn-light-green"><i class="fa fa-check"></i> Approve</a>
              <a href="<?php echo base_url();?>index.php/adminController/deleleave/<?php echo $row->id;?>"
                class="btn btn-sm btn-light-red"><strong>x</strong> Reject</a>
              <?php } else{?>
              <a href="#" class="btn btn-sm btn-light-yellow">
                Approved<i class="fa fa-check"></i>
              </a>
              <?php }?>
            </div>
          </div>

          <?php endforeach; ?>
        </div>
        <?php else: ?>
        <div class="item">
          <div class="panel-body">
            <div class="core-box">
              <div class="text-light text-bold">
                Student Leave Request
              </div>
              <br />
              <h2>There is no request for the day.....</h2>
            </div>
          </div>
        </div>
        <?php endif;?>
      </div>
    </div>
  </div>


  <!-- end: PAGE CONTENT-->