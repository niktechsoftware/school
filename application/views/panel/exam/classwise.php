
<div class="row">
										<div class="col-md-12 space20">

										 <?php 
//  $this->db->where('class_id',$classid);
//  $subjectname= $this->db->get('subject');
 
 ?>
 <!-- <table class="table table-bordered table-responsive">
 <tr> -->
 <?php 
//  $x=1; foreach($subjectname->result() as $sid){ 
// 	 if($x%5==0){
// 		echo "</tr><tr>"; 
// 		$x++;
// 	 }
	  ?>
 <!-- <td><?php //echo $sid->id.". ";?><?php //echo $sid->subject;?></td>  
	 <?php  //$x++; }?>
 </tr>
 </table>  -->
								
											<div class="btn-group pull-right">
												<button data-toggle="dropdown" class="btn btn-green dropdown-toggle">
													Export <i class="fa fa-angle-down"></i>
												</button>
												<ul class="dropdown-menu dropdown-light pull-right">

													<li>
														<a href="#" class="export-csv" data-table="#sample-table-2">
															Save as CSV
														</a>
													</li>
													<li>
														<a href="#" class="export-txt" data-table="#sample-table-2">
															Save as TXT
														</a>
													</li>
													<li>

													<li>
														<a href="#" class="export-sql" data-table="#sample-table-2">
															Save as SQL
														</a>
													</li>

													<li>
														<a href="#" class="export-excel" data-table="#sample-table-2">
															Export to Excel
														</a>
													</li>
													<li>
														<a href="#" class="export-powerpoint" data-table="#sample-table-2">
															Export to PowerPoint
														</a>
													</li>
												</ul>
											</div>
										</div>
									</div>
									<div class="table-responsive">
										<table class="table table-striped table-hover" id="sample-table-2" >
											<thead>
											<tr style="background-image: -webkit-linear-gradient(top, #e16f92 0px, #dd5a82 100%); color:white;">

<th>Sno</th>
<th>Student_Id</th>
<th>Student Name</th>
<!-- <th>Student_Name</th> -->
<?php 
	  $this->db->where('class_id',$classid);
	  $this->db->where('status',1);
	  $studentinfo=$this->db->get('student_info')->row();


	  $this->db->where('fsd',$this->session->userdata('fsd'));
	  $this->db->where('school_code',$this->session->userdata('school_code'));
	  $this->db->where('stu_id',$studentinfo->id);
	  $this->db->where('class_id',$classid);
	  $this->db->where('exam_id',$examid);
	  $examinfo=$this->db->get('exam_info');
      if($examinfo->num_rows()>0){
		    $i=1;$tot=0;	foreach($examinfo->result() as $sub):
			$this->db->where('id',$sub->subject_id);
			$subjectname= $this->db->get('subject')->row();
			
			$this->db->where('class_id',$sub->class_id);
			$this->db->where('exam_id',$sub->exam_id);
			$this->db->where('subject_id',$subjectname->id);
			$maxm=$this->db->get('exam_max_subject');
?>
<th class="text-uppercase"><?php echo $subjectname->subject;?><br><?php  if($maxm->num_rows()>0){
    if($maxm->row()->marks_grade!=0){ 
        $tot+=$maxm->row()->max_m; 
        echo $maxm->row()->max_m;
        
    }else{echo $maxm->row()->max_m;}
    
}else{echo "0";}  

$datasubject[$i]=$sub->subject_id; ?></th>
<?php  $i++;endforeach; }?>
<th>Total Marks <br> <?php echo $tot;?></th>
<th>Percentage</th>

</tr>
</thead>

<tbody>

<?php $sno = 1;
foreach($student as $data)
{
?>
<tr class="text-uppercase">	
    <td><?php echo $sno; ?></td>
	<td><?php echo $data->username; ?></td>
	<td><?php echo $data->name; ?></td>
	<?php 
	
$sum=0;
	foreach($datasubject as $did){
		$this->db->where('stu_id',$data->id);
		$this->db->where('class_id',$classid);
	$this->db->where('exam_id',$examid);
	$this->db->where('subject_id',$did);
	//$this->db->where('subject_id',$examid);
	$mm= $this->db->get('exam_info');
	if($mm->num_rows()>0){
	    	$this->db->where('class_id',$mm->row()->class_id);
			$this->db->where('exam_id',$mm->row()->exam_id);
			$this->db->where('subject_id',$mm->row()->subject_id);
			$maxm1=$this->db->get('exam_max_subject');
	?>
<td>

<?php if($maxm1->row()->marks_grade!=0){
    $sum+=$mm->row()->marks;
    echo $mm->row()->marks;
}else{ echo $mm->row()->marks; }?> 

</td>
	<?php }else{?>
          <td>
		  0
		  </td>
		  <?php
	}
	}?>
	<td><?php echo $sum;?></td>
	<td><?php if($sum!=0){echo ($sum/$tot)*100;}else{echo "0.00";}?></td>
</tr>

<?php $sno++; } ?>


</tbody>
</table>
</div>

 <script src="<?php echo base_url(); ?>assets/plugins/jQuery/jquery-2.1.1.min.js"></script>
		
		<script src="<?php echo base_url(); ?>assets/plugins/DataTables/media/js/jquery.dataTables.min.js"></script>
		<script src="<?php echo base_url(); ?>assets/plugins/DataTables/media/js/DT_bootstrap.js"></script>


		<script src="<?php echo base_url(); ?>assets/plugins/tableExport/tableExport.js"></script>
		<script src="<?php echo base_url(); ?>assets/plugins/tableExport/jquery.base64.js"></script>
		<script src="<?php echo base_url(); ?>assets/plugins/tableExport/html2canvas.js"></script>
		<script src="<?php echo base_url(); ?>assets/plugins/tableExport/jquery.base64.js"></script>
		<script src="<?php echo base_url(); ?>assets/plugins/tableExport/jspdf/libs/sprintf.js"></script>
		<script src="<?php echo base_url(); ?>assets/plugins/tableExport/jspdf/jspdf.js"></script>
		<script src="<?php echo base_url(); ?>assets/plugins/tableExport/jspdf/libs/base64.js"></script>
		<script src="<?php echo base_url(); ?>assets/js/table-export.js"></script>

		<script src="<?php echo base_url(); ?>assets/js/main.js"></script>
	
		<script>
			jQuery(document).ready(function() {
				TableExport.init();
				Main.init();
				SVExamples.init();
			});
		</script>

