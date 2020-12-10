<!-- start: PAGESLIDE LEFT -->
<a class="closedbar inner hidden-sm hidden-xs" href="#">
</a>
<nav id="pageslide-left" class="pageslide inner">
<div class="navbar-content">
<!-- start: SIDEBAR -->
<div class="main-navigation left-wrapper transition-left">
<div class="navigation-toggler hidden-sm hidden-xs">
    <a href="#main-navbar" class="sb-toggle-left">
    </a>
</div>
    <div class="user-profile border-top padding-horizontal-10 block">
    <div class="inline-block">
                          <?php 
                        
                        $this->db->where("id",$this->session->userdata("school_code"));
                       $result = $this->db->get("school")->row();?>
                        
                       
                            <?php if($this->session->userdata('login_type') == 'student'){ ?>
                           <?php  if(strlen($this->session->userdata('photo')) > 1){?>
                                <img src="<?php echo $this->config->item('asset_url'); ?><?php echo $this->session->userdata("school_code");?>/images/stuImage/<?php echo $this->session->userdata('photo');?>" class="img-circle" style="width:50px; margin-left:-6px; margin-top:-10px;"  alt="">
                          
                           <?php } else{?>
                            <img src="<?php echo $this->config->item('asset_url'); ?><?php echo $this->session->userdata("school_code");?>/images/anonymous.jpg" class="img-circle" style="width:50px; margin-left:-6px; margin-top:-10px;" alt="">
                        <?php }?>

                        
                        <?php }elseif($this->session->userdata('login_type') == 'admin'){ ?>
                            <?php
                             if(strlen($this->session->userdata('photo')) > 1){?>
                                 <img src="<?php echo $this->config->item('asset_url'); ?><?php echo $this->session->userdata("school_code");?>/images/empImage/<?php echo $result->logo;?>" class="img-circle" style="width:50px; margin-left:-6px; margin-top:-10px;" alt="">
                            
                             <?php }else{?>
                            <img src="<?php echo $this->config->item('asset_url'); ?><?php echo $this->session->userdata("school_code");?>/images/anonymous.jpg" class="img-circle" style="width:50px; margin-left:-6px; margin-top:-10px;" alt="">
                            

                             <?php }}elseif($this->session->userdata('login_type') == 3 || $this->session->userdata('login_type') == 2 || $this->session->userdata('login_type') == 1 ){ ?>
                                <?php
                                if(strlen($this->session->userdata('photo')) > 1){
                               $name=$this->session->userdata('username');
                                $this->db->where('username',$name);
                                $emp=$this->db->get('employee_info')->row();
                                ?>
                                <img src="<?php echo $this->config->item('asset_url'); ?><?php echo $this->session->userdata("school_code");?>/images/empImage/<?php echo $emp->photo;?>" class="img-circle" style="width:50px; margin-left:-6px; margin-top:-10px;"  alt="">
                               
                                <?php }else{?>
                            <img src="<?php echo $this->config->item('asset_url'); ?><?php echo $this->session->userdata("school_code");?>/images/anonymous.jpg" class="img-circle" style="width:50px; margin-left:-6px; margin-top:-10px;" alt="">
                             <?php }}?>
                    </div>
                        <div class="inline-block">
                            <h5 class="no-margin"> Welcome </h5>
                            <h4 class="no-margin"> <?php echo $this->session->userdata('name'); ?> </h4>
                            <a class="btn user-options sb_toggle open">
                                <i class="fa fa-cog"></i>
                            </a>
                        </div>
                    </div>
<!-- start: MAIN NAVIGATION MENU -->

<!-- ===================================================== Administrator Menu Start ======================================= -->
<?php if(($this->session->userdata('login_type') == 'admin' )): ?>

<ul class="main-navigation-menu">
<li class="active open">
    <a href="<?php echo base_url(); ?>index.php/login"><i class="fa fa-home"></i> <span class="title"> Dashboard </span><span class="label label-default pull-right ">HOME</span> </a>
</li>
<li>
    <a href="javascript:void(0)"><i class="fa fa-cogs"></i> <span class="title"> Configuration </span><i class="icon-arrow"></i> </a>
    <ul class="sub-menu">
	 <li>
            <a href="<?php echo base_url(); ?>index.php/login/configuredoc">
                Configure Document Formate <i class="icon-arrow"></i>
            </a>
        </li>
        <li>
            <a href="<?php echo base_url(); ?>index.php/login/configureClass">
                Configure Class <i class="icon-arrow"></i>
            </a>
        </li>
         <li>
            <a href="<?php echo base_url(); ?>index.php/login/configureFee">
                <span class="title"> Configure Fee  </span>
            </a>
        </li>
        <li>
            <a href="<?php echo base_url(); ?>index.php/login/updateClass">
                <span class="title"> Update Class </span>
            </a>
        </li>
        <li>
            <a href="<?php echo base_url(); ?>index.php/login/configureSubject">
                <span class="title"> Subject Configure  </span>
            </a>
        </li>
          <li>
            <a href="<?php echo base_url(); ?>index.php/configureHouse/configureHousepage">
                <span class="title"> House/Team Configure  </span>
            </a>
        </li>

        <li>
            <a href="<?php echo base_url(); ?>index.php/login/classPromotion">
                <span class="title">Student Promotion  </span>
            </a>
        </li>
        <li>
            <a href="<?php echo base_url(); ?>index.php/login/allStudentClassPromotion">
                <span class="title"> Class Promotion  </span>
            </a>
        </li>
    </ul>
</li>
<li>
        <a href="javascript:;">
            <i class="fa fa-wrench"></i> <span class="title">Setting</span><i class="icon-arrow"></i> <span class="arrow "></span>
        </a>
        <ul class="sub-menu">
            <li>
                <a href="<?php echo base_url(); ?>index.php/login/updatefsd">
                Update FSD  <i class="icon-arrow"></i>
                </a>
            </li>
         </ul>
         <ul class="sub-menu">
            <li>
                <a href="<?php echo base_url(); ?>index.php/login/feecategory">
                Fee Category  <i class="icon-arrow"></i>
                </a>
            </li>
         </ul>
          <ul class="sub-menu">
            <li>
                <a href="<?php echo base_url(); ?>index.php/login/staffcategory">
                Change Staff Category  <i class="icon-arrow"></i>
                </a>
            </li>
         </ul>
         <ul class="sub-menu">
            <li>
                <a href="<?php echo base_url(); ?>index.php/login/newexpenditure ">
                Expenditure   <i class="icon-arrow"></i>
                </a>
            </li>
         </ul>
         <ul class="sub-menu">
            <li>
                <a href="<?php echo base_url(); ?>index.php/login/examHead">
                Exam Head  <i class="icon-arrow"></i>
                </a>
            </li>
         </ul>
    </li>
<li>
    <a href="javascript:void(0)"><i class="fa fa-user"></i> <span class="title">Employee </span><i class="icon-arrow"></i> </a>
    <ul class="sub-menu">
        <li>
            <a href="<?php echo base_url(); ?>index.php/employeeController/addemployee">
                <span class="title"> Add Employee </span>
            </a>
        </li>
         <li>
            <a href="<?php echo base_url(); ?>index.php/login/employeeList">
                <span class="title">Simple Employee List</span>
            </a>
        </li>
        <li>
            <a href="<?php echo base_url(); ?>index.php/login/advencedEmployeeList">
                <span class="title">Advanced Employee List</span>
            </a>
        </li>
        <li>
            <a href="<?php echo base_url(); ?>index.php/login/employeeSalary">
                <span class="title"> Employee Salary</span>
            </a>
        </li>
      	<li>
            <a href="<?php echo base_url(); ?>index.php/login/employeeSalaryReport">
                <span class="title"> Employee Salary Report</span>
            </a>
        </li>
         <li>
            <a href="<?php echo base_url(); ?>index.php/login/empolyeeleave">
                <span class="title">Empolyee Leave Report </span>
            </a>
        </li>
        <li>
            <a href="<?php echo base_url(); ?>index.php/login/notActiveEmployee">
                <span class="title">Inactive Employee List </span>
            </a>
        </li>
         <!--
        <li>
            <a href="<?php echo base_url(); ?>index.php/login/employeeLeave">
                <span class="title"> Leave </span>
            </a>
        </li>
        <li>
            <a href="<?php echo base_url(); ?>index.php/login/updateProfile">
                <span class="title"> Update Profile </span>
            </a>
        </li>
        <li>
            <a href="<?php echo base_url(); ?>index.php/login/oldEmployeed">
                <span class="title"> Old Employee Details </span>
            </a>
        </li>
        -->
    </ul>
</li>
<li>
    <a href="javascript:void(0)"><i class="fa fa-users"></i> <span class="title"> Students </span><i class="icon-arrow"></i> </a>
    <ul class="sub-menu">
        <li>
            <a href="<?php echo base_url(); ?>index.php/login/newAdmission">
                <span class="title">New Admission</span>
            </a>
        </li>
        <li>
            <a href="<?php echo base_url(); ?>index.php/login/simpleSearchStudent">
                <span class="title">Simple Search</span>
            </a>
        </li>
        <li>
            <a href="<?php echo base_url(); ?>index.php/login/searchStudent">
                <span class="title">Advanced Search</span>
            </a>
        </li>
         <li>
            <a href="<?php echo base_url(); ?>index.php/login/studentleave">
                <span class="title">Student Leave Report </span>
            </a>
        </li>

        <li>
            <a href="<?php echo base_url(); ?>index.php/login/notActiveStudent">
                <span class="title">InActive Student List</span>
            </a>
        </li>

    </ul>
</li>
<li>
    <a href="javascript:void(0)"><i class="fa fa-money"></i> <span class="title">Fee </span><i class="icon-arrow"></i> </a>
    <ul class="sub-menu">
        <li>
            <a href="<?php echo base_url(); ?>index.php/login/collectFee">
                <span class="title">Collect Fee</span>
            </a>
        </li>
         <!--<li>
            <a href="<?php echo base_url(); ?>index.php/login/feeStructure">
                <span class="title"> Fee Structure</span>
            </a>
        </li>-->
         <li>
            <a href="<?php echo base_url(); ?>index.php/login/transport">
                <span class="title">Student Fee Card</span>
            </a>
        </li>
        <li>
            <a href="<?php echo base_url(); ?>index.php/login/feeReport">
                <span class="title">Fee Report</span>
            </a>
        </li>

         <li>
            <a href="<?php echo base_url(); ?>index.php/login/feedue">
                <span class="title">Due Fee Report</span>
            </a>
        </li>

         <li>
            <a href="<?php echo base_url(); ?>index.php/login/printDeuFee">
                <span class="title">Print Due Fee Report</span>
            </a>
        </li>

        <li>
            <a href="<?php echo base_url(); ?>index.php/Pay_Transport_Fee">
                <span class="title">Collect Individual Fee </span>
            </a>
        </li>
        <li>
            <a href="<?php echo base_url(); ?>index.php/Report_Transport_Fee">
                <span class="title">Indivisual Fee Report</span>
            </a>
        </li>
    </ul>
</li>
<li>
    <a href="javascript:void(0)"><i class="fa fa-sitemap"></i> <span class="title"> Attendance </span><i class="icon-arrow"></i> </a>
    <ul class="sub-menu">
        <li>
            <a href="<?php echo base_url(); ?>index.php/login/studentAttendance">
                <span class="title">Student Attendance </span>
            </a>
        </li>
        <li>
            <a href="<?php echo base_url(); ?>index.php/login/teacherAttendance">
                <span class="title"> Teacher Attendance </span>
            </a>
        </li>
        <li>
            <a href="<?php echo base_url(); ?>index.php/login/stuAttendanceReport">
                <span class="title"> Student Attendance Report </span>
            </a>
        </li>
        <li>
            <a href="<?php echo base_url(); ?>index.php/login/empAttendanceReport">
                <span class="title"> Teacher Attendance Report </span>
            </a>
        </li>
       
  
  
  
    </ul>
</li>
<li>
    <a href="javascript:void(0)"><i class="fa fa-code"></i> <span class="title">Time Scheduling</span><i class="icon-arrow"></i> </a>
    <ul class="sub-menu">
        <li>
            <a href="<?php echo base_url(); ?>index.php/login/periodTimeSlot">
                <span class="title">Period & Time Slots</span>
            </a>
        </li>
        <li>
            <a href="<?php echo base_url(); ?>index.php/login/timeScheduling">
                <span class="title">Time Scheduling</span>
            </a>
        </li>

         <li>
            <a href="<?php echo base_url(); ?>index.php/login/schedulingReport">
                <span class="title">Scheduling Report</span>
            </a>
        </li>

        <!-- <li>-->
        <!--    <a href="<?php //echo base_url(); ?>index.php/login/defineLessonPlan">-->
        <!--        <span class="title">Define Lesson Plan</span>-->
        <!--    </a>-->
        <!--</li>-->
          <li>
            <a href="<?php echo base_url(); ?>index.php/login/viewLessonPlan">
                <span class="title">Lesson Plan Report</span>
            </a>
        </li>

    </ul>
</li>
<li>
    <a href="javascript:void(0)"><i class="fa fa-hospital-o"></i> <span class="title">Exam</span><i class="icon-arrow"></i> </a>
    <ul class="sub-menu">
        <li>
            <a href="<?php echo base_url(); ?>index.php/login/examsheduling">
                <span class="title">Exam Scheduling</span>
            </a>
        </li>
		<li>
            <a href="<?php echo base_url(); ?>index.php/login/exammode">
                <span class="title">Exam Mode</span>
            </a>
        </li>
         <li>
            <a href="<?php echo base_url(); ?>index.php/login/examTimeTable">
                <span class="title">Exam Time Table </span>
            </a>
        </li>
         <li>
             <a href = "<?php echo base_url(); ?>index.php/adminc/admitCard">
             <span class="title">Download Admit Card</span>
             </a>
        </li>
         <li>
            <a href="<?php echo base_url(); ?>index.php/login/exammarksdetail">
                <span class="title">Enter Maximum Marks</span>
            </a>
        </li>
          
        <li>
            <a href="<?php echo base_url(); ?>index.php/login/examDetail">
                <span class="title">Exam Details</span>
            </a>
        </li>
        <li>
            <a href="<?php echo base_url(); ?>index.php/login/results">
                <span class="title">Subject Wise Marks</span>
            </a>
        </li>
        <li>
            <a href="<?php echo base_url(); ?>index.php/login/generateResult">
                <span class="title">Generate Result</span>
            </a>
        </li>

       

    </ul>
</li>


   <li>
    <a href="javascript:void(0)"><i class="fa fa-copy"></i> <span class="title"> Report </span><i class="icon-arrow"></i> </a>
    <ul class="sub-menu">
     <li>
            <a href="<?php echo base_url(); ?>index.php/login/pramoted_list">
                 Promoted Report Classwise <i class="icon-arrow"></i>
            </a>
        </li>
        <li>
            <a href="<?php echo base_url(); ?>index.php/login/tc">
                Transfer Certificate <i class="icon-arrow"></i>
            </a>
        </li>
        <li>
            <a href="<?php echo base_url(); ?>index.php/login/charc">
                <span class="title"> Character Certificate </span>
            </a>
        </li>

    </ul>
</li>

<li>
    <a href="javascript:;">
        <i class="fa fa-book"></i> <span class="title"> HomeWork </span><i class="icon-arrow"></i> <span class="arrow "></span>
    </a>
    <ul class="sub-menu">
        <li>
            <a href="<?php echo base_url(); ?>index.php/studentHWControllers/defineHomeWork">
                Define HomeWork <i class="icon-arrow"></i>
            </a>
        </li>
        <li>
            <a href="<?php echo base_url(); ?>index.php/studentHWControllers/showHomeWork">
              	Show HomeWork <i class="icon-arrow"></i>
            </a>
        </li>
    </ul>
</li>

<li>
    <a href="javascript:;" class="active">
        <i class="fa fa-archive"></i> <span class="title"> Stock </span> <i class="icon-arrow"></i>
    </a>
    <ul class="sub-menu">
        <li>
            <a href="<?php echo base_url(); ?>index.php/login/enterStock">
               Enter Stock <i class="icon-arrow"></i>
            </a>
        </li>
        <li>
            <a href="<?php echo base_url(); ?>index.php/login/saleStock">
               Sale Stock <i class="icon-arrow"></i>
            </a>
        </li>
        <li>
            <a href="<?php echo base_url(); ?>index.php/login/printReceipt">
               Print Receipt
            </a>
        </li>
        <li>
            <a href="<?php echo base_url(); ?>index.php/login/stockEdit">
              Edit Bill
            </a>
        </li>
    </ul>
</li>

<li>
    <a href="javascript:;">
        <i class="fa fa-envelope"></i> <span class="title"> Message </span><i class="icon-arrow"></i> <span class="arrow "></span>
    </a>
    <ul class="sub-menu">
        <li>
            <a href="<?php echo base_url(); ?>index.php/login/noticeAlert">
                Notice / Alert <i class="icon-arrow"></i>
            </a>

                </li>
                <li>
            <a href="<?php echo base_url(); ?>index.php/login/message">
               Message <i class="icon-arrow"></i>
            </a>

                </li>

            </ul>
        </li>
       <li>
    <a href="javascript:;">
        <i class="fa fa-envelope-o"></i> <span class="title"> Mobile Message </span><i class="icon-arrow"></i> <span class="arrow "></span>
    </a>
    <ul class="sub-menu">
   				 <li>
		            <a href="<?php echo base_url(); ?>index.php/login/smssetting">
		                Mobile SMS Setting<i class="icon-arrow"></i>
		            </a>
                </li>
        		<li>
		            <a href="<?php echo base_url(); ?>index.php/login/mobileNotice/Notice">
		                Notice(Individual)<i class="icon-arrow"></i>
		            </a>
                </li>
                <li>
		            <a href="<?php echo base_url(); ?>index.php/login/mobileNotice/Parent%20Message">
		              Parent Message <i class="icon-arrow"></i>
		            </a>
                </li>
                 <li>
		            <a href="<?php echo base_url(); ?>index.php/login/mobileNotice/Announcement">
		               Announcement(For Staff)<i class="icon-arrow"></i>
		            </a>
                </li>
                <li>
		            <a href="<?php echo base_url(); ?>index.php/login/mobileNotice/Greeting">
		              Greeting (To All)<i class="icon-arrow"></i>
		            </a>
                </li>

                <li>
		            <a href="<?php echo base_url(); ?>index.php/login/mobileNotice/classwise">
		            Class Wise <i class="icon-arrow"></i>
		            </a>
                </li>

            </ul>
 </li>
 <li>
    <a href="javascript:;">
        <i class="fa fa-money"></i> <span class="title"> Accounting </span><i class="icon-arrow"></i> <span class="arrow "></span>
    </a>
    <ul class="sub-menu">
        <li>
            <a href="<?php echo base_url(); ?>login/dayBook">
               Day Book<i class="icon-arrow"></i>
            </a>

            </li>
             <li>
            <a href="<?php echo base_url(); ?>login/deleteInvoice">
              Delete Invoice<i class="icon-arrow"></i>
            </a>

            </li>
         <li>
            <a href="<?php echo base_url(); ?>login/cashPayment">
              Transaction <i class="icon-arrow"></i>
            </a>

         </li>
         <li>
            
        </li>
      </ul>
    </li>

<!--	<li>
	    <a href="javascript:;">
	        <i class="fa fa-eye"></i> <span class="title"> Website </span><i class="icon-arrow"></i> <span class="arrow "></span>
	    </a>
	    <ul class="sub-menu">
	        <li>
	            <a href="<?php echo base_url(); ?>index.php/login/gallery">
	              Gallery<i class="icon-arrow"></i>
	            </a>
	        </li>
	     </ul>
	</li>-->
    

</ul>
<?php endif;?>

<!-- ===================================================== Administrator Menu End ======================================= -->
<!-- ===================================================== Student Menu Start ======================================= -->
<?php if($this->session->userdata('login_type') == 'student'):
 $unm=$this->session->userdata("username");
  $this->db->where('username',$unm);
 $dt= $this->db->get('student_info')->row();
 $stud_id=$dt->id;

?>
<ul class="main-navigation-menu">
	<li class="active open">
	    <a href="<?php echo base_url(); ?>index.php/singleStudentControllers"><i class="fa fa-home"></i> <span class="title"> Dashboard </span></a>
	</li>
	<li>
	    <a href="<?php echo base_url(); ?>index.php/singleStudentControllers/studentProfile"><i class="fa fa-bars"></i> <span class="title"> Your Profile</a>
	</li>
	<li>
	    <a href="<?php echo base_url(); ?>index.php/singleStudentControllers/feesDetail/<?php echo $stud_id?>"><i class="fa fa-money"></i>Your Fee Report</a>
	</li>
	<li>
	    <a href="<?php echo base_url(); ?>index.php/singleStudentControllers/stuattendence/"><i class="fa fa-calendar-o"></i> Attendance Report</a>
	</li>
	<li>
	    <a href="<?php echo base_url(); ?>index.php/singleStudentControllers/leave"><i class="fa fa-edit"></i>Leave Detail</a>
	</li>
	<li>
	    <a href="<?php echo base_url(); ?>index.php/singleStudentControllers/timeScheduling"><i class="fa fa-calendar"></i>Time Table</a>
	</li>
	<li>
	    <a href="<?php echo base_url(); ?>index.php/singleStudentControllers/examResult"><i class="fa fa-book"></i>Exam/Test Report</a>
	</li>
	<li>
	    <a href="<?php echo base_url(); ?>index.php/singleStudentControllers/stock"><i class="fa fa-desktop"></i>Purchasing Report</a>
	</li>
	<li>
    <a href="<?php echo base_url(); ?>index.php/studentHWControllers/studentShowHomeWork">
            <i class="fa fa-book"></i>	Home Work 
            </a>
    <!-- <ul class="sub-menu"> -->

        <!-- <li>
            <a href="<?php echo base_url(); ?>index.php/studentHWControllers/studentShowHomeWork">
            <i class="fa fa-book"></i>	Home Work 
            </a>
        </li> -->
       <!-- <li>
            <a href="<?php echo base_url(); ?>index.php/studentHWControllers/submitHomeWork">
              	Submit HomeWork <i class="icon-arrow"></i>
            </a>
        </li>-->
    <!-- </ul> -->
</li>
	<!--<li>-->
	<!--    <a href="#"><i class="fa fa-envelope-o"></i>Mail/Message</a>-->
	<!--</li>-->
</ul>

<?php endif; ?>
<!-- ===================================================== Student Menu End ======================================= -->

<!-- ===================================================== Accountent Menu Start ======================================= -->
<?php if($this->session->userdata('login_type') == '1'): ?>

<ul class="main-navigation-menu">
<li class="active open">
    <a href="<?php echo base_url(); ?>index.php/login"><i class="fa fa-home"></i> <span class="title"> Dashboard </span><span class="label label-default pull-right ">LABEL</span> </a>
</li>


<li>
    <a href="javascript:void(0)"><i class="fa fa-cogs"></i> <span class="title">Employee </span><i class="icon-arrow"></i> </a>
    <ul class="sub-menu">
        <li>
            <a href="<?php echo base_url(); ?>index.php/employeeController/addemployee">
                <span class="title"> Add Employee </span>
            </a>
        </li>
         <!--
        <li>
            <a href="<?php echo base_url(); ?>index.php/login/employeeList">
                <span class="title">Employee List</span>
            </a>
        </li>
        <li>
            <a href="<?php echo base_url(); ?>index.php/login/employeeSalary">
                <span class="title"> Employee Salary</span>
            </a>
        </li>

        <li>
            <a href="<?php echo base_url(); ?>index.php/login/employeeSummry">
                <span class="title">Salary Summry </span>
            </a>
        </li>

        <li>
            <a href="<?php echo base_url(); ?>index.php/login/employeeLeave">
                <span class="title"> Leave </span>
            </a>
        </li>
        <li>
            <a href="<?php echo base_url(); ?>index.php/login/updateProfile">
                <span class="title"> Update Profile </span>
            </a>
        </li>
        <li>
            <a href="<?php echo base_url(); ?>index.php/login/oldEmployeed">
                <span class="title"> Old Employee Details </span>
            </a>
        </li>
        -->
    </ul>
</li>
<li>
    <a href="javascript:void(0)"><i class="fa fa-th-large"></i> <span class="title"> Students </span><i class="icon-arrow"></i> </a>
    <ul class="sub-menu">
        <li>
            <a href="<?php echo base_url(); ?>index.php/login/newAdmission">
                <span class="title">New Admission</span>
            </a>
        </li>
        <li>
            <a href="<?php echo base_url(); ?>index.php/login/searchStudent">
                <span class="title">Advance Search Students</span>
            </a>
        </li>
          <li>
            <a href="<?php echo base_url(); ?>index.php/login/simpleSearchStudent">
                <span class="title">Simple Search</span>
            </a>
        </li>
        <!--
        <li>
            <a href="<?php echo base_url(); ?>index.php/login/oldStudentsDetails">
                <span class="title">Old Students</span>
            </a>
        </li>
         -->
    </ul>
</li>
<li>
    <a href="javascript:void(0)"><i class="fa fa-pencil-square-o"></i> <span class="title">Fee </span><i class="icon-arrow"></i> </a>
    <ul class="sub-menu">
       
        <li>
            <a href="<?php echo base_url(); ?>index.php/login/collectFee">
                <span class="title">Collect Fee</span>
            </a>
        </li>
        
        
        
        
        <li>
            <a href="<?php echo base_url(); ?>index.php/login/feeReport">
                <span class="title">Fee Report</span>
            </a>
        </li>
        
         <li>
            <a href="<?php echo base_url(); ?>index.php/login/feedue">
                <span class="title">Due Fee Report</span>
            </a>
        </li>

         <li>
            <a href="<?php echo base_url(); ?>index.php/login/printDeuFee">
                <span class="title">Print Due Fee Report</span>
            </a>
        </li>
    </ul>
</li>
<li>
    <a href="javascript:void(0)"><i class="fa fa-user"></i> <span class="title"> Attendance </span><i class="icon-arrow"></i> </a>
    <ul class="sub-menu">
        <li>
            <a href="<?php echo base_url(); ?>index.php/login/studentAttendance">
                <span class="title">Student Attendance </span>
            </a>
        </li>
        <li>
            <a href="<?php echo base_url(); ?>index.php/login/teacherAttendance">
                <span class="title"> Teacher Attendance </span>
            </a>
        </li>
        <li>
            <a href="<?php echo base_url(); ?>index.php/login/stuAttendanceReport">
                <span class="title"> Attendance Report </span>
            </a>
        </li>
    </ul>
</li>
<li>
    <a href="javascript:void(0)"><i class="fa fa-code"></i> <span class="title">Time Scheduling</span><i class="icon-arrow"></i> </a>
    <ul class="sub-menu">
        <li>
            <a href="<?php echo base_url(); ?>index.php/login/periodTimeSlot">
                <span class="title">Period & Time Slots</span>
            </a>
        </li>
        <li>
            <a href="<?php echo base_url(); ?>index.php/login/timeScheduling">
                <span class="title">Time Scheduling</span>
            </a>
        </li>
        <li>
            <a href="<?php echo base_url(); ?>index.php/login/schedulingReport">
                <span class="title">Scheduling Report</span>
            </a>
        </li>

    </ul>
</li>
<li>
    <a href="javascript:void(0)"><i class="fa fa-cubes"></i> <span class="title">Exam</span><i class="icon-arrow"></i> </a>
    <ul class="sub-menu">
        <li>
            <a href="<?php echo base_url(); ?>index.php/login/examsheduling">
                <span class="title">Exam Scheduling</span>
            </a>
        </li>
        <li>
            <a href="<?php echo base_url(); ?>index.php/login/examTimeTable">
                <span class="title">Exam Time Table </span>
            </a>
        </li>
        <li>
            <a href="<?php echo base_url(); ?>index.php/login/examDetail">
                <span class="title">Exam Details</span>
            </a>
        </li>
        <li>
            <a href="<?php echo base_url(); ?>index.php/login/results">
                <span class="title">Results</span>
            </a>
        </li>
         <li>
             <a href = "<?php echo base_url(); ?>index.php/adminc/admitCard">
             <span class="title">Download Admit Card</span>
             </a>
        </li>
        <li>
            <a href="<?php echo base_url(); ?>index.php/login/generateResult">
                <span class="title">Generate Result</span>
            </a>
        </li>

        <!--
        <li>
            <a href="<?php echo base_url(); ?>index.php/login/editUpdateDetail">
                <span class="title">Edit & Update Details</span>
            </a>
        </li>

        -->
    </ul>
</li>


<li>
    <a href="javascript:;" class="active">
        <i class="fa fa-archive"></i> <span class="title"> Stock </span> <i class="icon-arrow"></i>
    </a>
    <ul class="sub-menu">
        <li>
            <a href="<?php echo base_url(); ?>index.php/login/enterStock">
               Enter Stock <i class="icon-arrow"></i>
            </a>
        </li>
        <li>
            <a href="<?php echo base_url(); ?>index.php/login/saleStock">
               Sale Stock <i class="icon-arrow"></i>
            </a>
        </li>
        <li>
            <a href="<?php echo base_url(); ?>index.php/login/printReceipt">
               Print Receipt
            </a>
        </li>
        <!--
        <li>
            <a href="<?php echo base_url(); ?>index.php/login/stockReport">
              Stock Report
            </a>
        </li>
         -->
    </ul>
</li>
<li>
    <a href="javascript:;">
        <i class="fa fa-evenlop"></i> <span class="title"> Message </span><i class="icon-arrow"></i> <span class="arrow "></span>
    </a>
    <ul class="sub-menu">
        <li>
            <a href="<?php echo base_url(); ?>index.php/login/noticeAlert">
                Notice / Alert <i class="icon-arrow"></i>
            </a>

                </li>
                <li>
            <a href="<?php echo base_url(); ?>index.php/login/message">
               Message <i class="icon-arrow"></i>
            </a>

                </li>

            </ul>
        </li>
       <li>
    <a href="javascript:;">
        <i class="fa fa-folder-open"></i> <span class="title"> Mobile Message </span><i class="icon-arrow"></i> <span class="arrow "></span>
    </a>
    <ul class="sub-menu">

        		<li>
		            <a href="<?php echo base_url(); ?>index.php/login/mobileNotice/Notice">
		                Notice(Individual)<i class="icon-arrow"></i>
		            </a>
                </li>
                <li>
		            <a href="<?php echo base_url(); ?>index.php/login/mobileNotice/Parent%20Message">
		              Parent Message <i class="icon-arrow"></i>
		            </a>
                </li>
                 <li>
		            <a href="<?php echo base_url(); ?>index.php/login/mobileNotice/Announcement">
		               Announcement(For Staff)<i class="icon-arrow"></i>
		            </a>
                </li>
                <li>
		            <a href="<?php echo base_url(); ?>index.php/login/mobileNotice/Greeting">
		              Greeting (To All)<i class="icon-arrow"></i>
		            </a>
                </li>
                <!--
                <li>
		            <a href="<?php echo base_url(); ?>index.php/login/smssetting">
		            Sms Setting <i class="icon-arrow"></i>
		            </a>
                </li>
                 -->
            </ul>
 </li>
 <li>
    <a href="javascript:;">
        <i class="fa fa-folder-open"></i> <span class="title"> Accounting </span><i class="icon-arrow"></i> <span class="arrow "></span>
    </a>
    <ul class="sub-menu">
        <li>
            <a href="<?php echo base_url(); ?>login/dayBook">
               Day Book<i class="icon-arrow"></i>
            </a>

                </li>
                <li>
            <a href="<?php echo base_url(); ?>login/cashPayment">
              Transaction <i class="icon-arrow"></i>
            </a>

            </li>
      </ul>

</ul>
<?php endif;?>
<!-- ===================================================== Accountent Menu End ======================================= -->

<!-- ===================================================== Employee Menu Start ======================================= -->
<?php if($this->session->userdata('login_type') == '2'): ?>
<ul class="main-navigation-menu">
    <li>
            <a href="<?php echo base_url(); ?>index.php/singleTeacherControllers.Niktech">
               <i class="fa fa-home"></i> <span class="title"> Dashboard </span><span class="label label-default pull-right ">HOME</span>
            </a>
        </li>
	 <li>
            <a href="<?php echo base_url(); ?>index.php/singleTeacherControllers/viewProfile">
              <i class="fa fa-user"></i>  <span class="title"> View Profile </span>
            </a>
        </li>
        <li>
            <a href="<?php echo base_url(); ?>index.php/singleTeacherControllers/salarySummry">
               <i class="fa fa-money"></i> <span class="title">Salary Summary </span>
            </a>
        </li>

        <li>
            <a href="<?php echo base_url(); ?>index.php/singleTeacherControllers/TeacherLeave">
               <i class="fa fa-user"></i> <span class="title"> Leave Detail </span>
            </a>
        </li>
        <li>
    <a href="javascript:;">
        <i class="fa fa-book"></i> <span class="title"> HomeWork </span><i class="icon-arrow"></i> <span class="arrow "></span>
    </a>
    <ul class="sub-menu">

        <li>
            <a href="<?php echo base_url(); ?>index.php/studentHWControllers/showHomeWork">
              	Show HomeWork <i class="icon-arrow"></i>
            </a>
        </li>
        <!--<li>
            <a href="<?php echo base_url(); ?>index.php/studentHWControllers/submitHomeWork">
              	Submit HomeWork <i class="icon-arrow"></i>
            </a>
        </li>-->
    </ul>
</li>
   </ul>




<?php endif; ?>
<!-- ===================================================== Employee Menu End ======================================= -->

<!-- ===================================================== Teacher Menu Start ======================================= -->
<?php if($this->session->userdata('login_type') == '3'): ?>

<ul class="main-navigation-menu">
<li class="active open">
    <a href="<?php echo base_url();?>index.php/singleTeacherControllers/"><i class="fa fa-home"></i> <span class="title"> Dashboard </span><span class="label label-default pull-right ">LABEL</span> </a>
</li>

<li>
    <a href="javascript:void(0)"><i class="fa fa-cogs"></i> <span class="title"> Personal </span><i class="icon-arrow"></i> </a>
    <ul class="sub-menu">
         <li>
            <a href="<?php echo base_url(); ?>index.php/singleTeacherControllers/viewProfile">
                <span class="title"> View Profile </span>
            </a>
        </li>
        <!--<li>-->
        <!--    <a href="<?php echo base_url(); ?>index.php/singleTeacherControllers/salarySummry">-->
        <!--        <span class="title">Salary Summry </span>-->
        <!--    </a>-->
        <!--</li>-->

        <!--<li>-->
        <!--    <a href="<?php echo base_url(); ?>index.php/singleTeacherControllers/TeacherLeave">-->
        <!--        <span class="title"> Leave Detail </span>-->
        <!--    </a>-->
        <!--</li>-->


    </ul>
</li>
<li>
            <a href="<?php echo base_url(); ?>index.php/singleTeacherControllers/salarySummry">
               <i class="fa fa-money"></i> <span class="title">Salary Summary </span>
            </a>
        </li>
    
        <li>
            <a href="<?php echo base_url(); ?>index.php/singleTeacherControllers/TeacherLeave">
               <i class="fa fa-user"></i> <span class="title"> Leave Detail </span>
            </a>
        </li>
<li>
    <a href="javascript:void(0)"><i class="fa fa-th-large"></i> <span class="title"> Class </span><i class="icon-arrow"></i> </a>
    <ul class="sub-menu">
        <li>
            <!--singleTeacherControllers/classTaken-->
            
            <a href="<?php echo base_url(); ?>index.php/login/schedulingReport">
                <span class="title">Classes Taken</span>
            </a>
        </li>
        <li>
            <a href="<?php echo base_url(); ?>index.php/singleTeacherControllers/marksEntry">
                <span class="title">Marks Entry</span>
            </a>
        </li>

    </ul>
</li>
<!--<li>-->
<!--    <a href="javascript:void(0)"><i class="fa fa-pencil-square-o"></i> <span class="title">Fee </span><i class="icon-arrow"></i> </a>-->
<!--    <ul class="sub-menu">-->
<!--        <li>-->
<!--            <a href="<?php echo base_url(); ?>index.php/login/feeReport">-->
<!--                <span class="title">Fee Report</span>-->
<!--            </a>-->
<!--        </li>-->
<!--    </ul>-->
<!--</li>-->
<li>
    <a href="javascript:void(0)"><i class="fa fa-user"></i> <span class="title"> Attendance </span><i class="icon-arrow"></i> </a>
    <ul class="sub-menu">
        <li>
            <a href="<?php echo base_url(); ?>index.php/singleTeacherControllers/teacherStudentAttendance">
                <span class="title">Student Attendance </span>
            </a>
        </li>
        <li>
            <a href="<?php echo base_url(); ?>index.php/login/stuAttendanceReport">
                <span class="title"> Attendance Report </span>
            </a>
        </li>
    </ul>
</li>
<li>
    <a href="javascript:void(0)"><i class="fa fa-code"></i> <span class="title">Time Scheduling</span><i class="icon-arrow"></i> </a>
    <ul class="sub-menu">


        <li>
            <a href="<?php echo base_url(); ?>index.php/login/schedulingReport">
                <span class="title">Class Time Table</span>
            </a>
        </li>
         <li>
            <a href="<?php echo base_url(); ?>index.php/login/defineLessonPlan">
                <span class="title">Define Lesson Plan</span>
            </a>
        </li>
          <li>
            <a href="<?php echo base_url(); ?>index.php/login/viewLessonPlan">
                <span class="title">Lesson Plan Report</span>
            </a>
        </li>

    </ul>
</li>
<li>
    <a href="javascript:void(0)"><i class="fa fa-cubes"></i> <span class="title">Exam</span><i class="icon-arrow"></i> </a>
    <ul class="sub-menu">
        <!-- <li>
            <a href="<?php echo base_url(); ?>index.php/singleTeacherControllers/teacherExamDuty">
                <span class="title">Exam Duty</span>
            </a>
        </li> -->
        <!-- <li>
            <a href="<?php //echo base_url(); ?>index.php/login/exammode">
                <span class="title">Exam Mode</span>
            </a>
        </li>-->
         <li>
            <a href="<?php echo base_url(); ?>index.php/login/exammarksdetail">
                <span class="title">Enter Maximum Marks</span>
            </a>
        </li>

          <li>
           <a href="<?php echo base_url(); ?>index.php/login/exammode">
                <span class="title">Exam Mode</span>
            </a>
        </li>

        <li>
            <a href="<?php echo base_url(); ?>index.php/login/examTimeTable">
                <span class="title">Exam Time Table </span>
            </a>
        </li>
        <li>
            <a href="<?php echo base_url(); ?>index.php/login/examDetail">
                <span class="title">Exam Details</span>
            </a>
        </li>
        <li>
            <a href="<?php echo base_url(); ?>index.php/exampanel/classwiseexampanel">
                <span class="title">Results</span>
            </a>
        </li>

    </ul>
</li>
<li>
    <a href="javascript:;">
        <i class="fa fa-book"></i> <span class="title"> HomeWork </span><i class="icon-arrow"></i> <span class="arrow "></span>
    </a>
    <ul class="sub-menu">
        <li>
            <a href="<?php echo base_url(); ?>index.php/singleTeacherControllers/defineHomeWork">
                Define HomeWork <i class="icon-arrow"></i>
            </a>
        </li>
        <li>
            <a href="<?php echo base_url(); ?>index.php/singleTeacherControllers/showHomeWork">
              	Show HomeWork <i class="icon-arrow"></i>
            </a>
        </li>
        <!--<li>
            <a href="<?php echo base_url(); ?>index.php/studentHWControllers/submitHomeWork">
              	Submit HomeWork <i class="icon-arrow"></i>
            </a>
        </li>-->

    </ul>
</li>
<li>
    <a href="javascript:;" class="active">
        <i class="fa fa-archive"></i> <span class="title"> Stock </span> <i class="icon-arrow"></i>
    </a>
    <ul class="sub-menu">

        </li>
        <li>
            <a href="<?php echo base_url(); ?>index.php/singleTeacherControllers/teacherStockDetail">
               Stock Report
            </a>
        </li>

    </ul>
</li>


<li>
    <a href="javascript:;">
        <i class="fa fa-envelope-o"></i> <span class="title"> Mobile Message </span><i class="icon-arrow"></i> <span class="arrow "></span>
    </a>
    <ul class="sub-menu">
   			
        		<li>
		            <a href="<?php echo base_url(); ?>index.php/login/mobileNotice/Notice">
		                Notice(Individual)<i class="icon-arrow"></i>
		            </a>
                </li>
                </ul>
                </li>

<li>
    <a href="javascript:;">
        <i class="fa fa-envelope"></i> <span class="title"> Message </span><i class="icon-arrow"></i> <span class="arrow "></span>
    </a>
    <ul class="sub-menu">
        <li>
            <a href="<?php echo base_url(); ?>index.php/singleTeacherControllers/teacherNoticeAlert">
                Notice / Alert <i class="icon-arrow"></i>
            </a>

                </li>
                <li>
            <a href="<?php echo base_url(); ?>index.php/singleTeacherControllers/teacherMessage">
               Message <i class="icon-arrow"></i>
            </a>

                </li>

            </ul>
        </li>
</ul>
<?php endif;?>
<!-- ===================================================== Teacher Menu End ======================================= -->

<!-- end: MAIN NAVIGATION MENU -->
</div>
<!-- end: SIDEBAR -->
</div>
<div class="slide-tools">
    <div class="col-xs-6 text-left no-padding">
        <a class="btn btn-sm status" href="#">
            Status <i class="fa fa-dot-circle-o text-green"></i> <span>Online</span>
        </a>
    </div>
    <div class="col-xs-6 text-right no-padding">
        <a class="btn btn-sm log-out text-right" href="<?php echo base_url()?>index.php/homeController/logout">
            <i class="fa fa-power-off"></i> Log Out
        </a>
    </div>
</div>
</nav>
<!-- end: PAGESLIDE LEFT -->