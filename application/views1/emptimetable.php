                        <div class="row">
							<div class="col-md-12">
								<!-- start: DYNAMIC TABLE PANEL -->
								<div class="panel panel-white">
								  <div class="panel-heading panel-purple">
									
										<h4 class="panel-title">Your <span class="text-bold"> Time Table</span></h4>
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
								
									
									<div class="panel-body">
                            		<div class="row">
                            			<div class="col-md-12">
                        



<table class="table table-striped table bordered">
<b><th>Period</th>

	<th>From</th>
	<th>To</th>
	<th>Subject</th>
	<th>Class</th>
		<th>Section</th>
	<th>Teacher Name</th>
	<th>Day</th></b>
<?php

if($time->num_rows()>0){
foreach($time->result() as $class)
{



 $row1=$class->subject_id;
 $row2=$class->class_id;
 $row3=$class->period_id;
 $row4=$class->teacher;
 $row5=$class->day;
 $this->db->where('id',$row1);
 $sub=$this->db->get('subject');
 $this->db->where('id',$row2);
$class=$this->db->get('class_info');



$this->db->where('id',$row3);
$period=$this->db->get('period');

$this->db->where('id',$row4);
$teacher=$this->db->get('employee_info')->row();

if($class->num_rows()>0)
{
    $this->db->where('id',$class->row()->section);
    $section=$this->db->get('class_section');
    if($section->num_rows>0)
    {
    
    if($sub->num_rows>0)
    {
         if($period->num_rows>0)
         {
        
        

 ?>

	
<tr>
	<td><?php if($row3==0){echo "LUNCH"; }else{echo $period->row()->period;} ?></td>

	<td><?php if($row3==0){echo "LUNCH"; } else{echo $period->row()->from;}?></td>
	<td><?php if($row3==0){echo "LUNCH"; } else{echo $period->row()->to;}?></td>
	<td> <?php if($row1==0){echo "LUNCH"; }else{echo $sub->row()->subject;} ?> </td>
		<td> <?php if($row2==0){echo "Not define"; }else{echo $class->row()->class_name;} ?> </td>
			<td> <?php if($row2==0){echo "Not define"; }else{echo $section->row()->section;} ?> </td>
	
<td> <?php if($row4==0){echo "LUNCH"; }else{echo $teacher->name;} ?> </td>


<td><?php echo $row5; ?></td></tr

 <?php
         }
         }
    }

}
}  }?>


</table>
</div></div></div></div></div>
</div>