<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
<table id="" class="table table-striped table-bordered">
	<thead><tr><th>Subject Name</th>
		<th>Obtain Marks</th>
		<th>Total Marks</th></tr>
	</thead>
<?php

foreach($exam as $data)
{

$row1=$data->subject_id;
$this->db->where('id',$row1);
$sub=$this->db->get('subject')->row();



?>
<tr>
	<td><?php echo $sub->subject;?></td>
	<td><?php echo $data->marks;?></td>
	<td><?php if($data->out_of==0){ echo "GRADE"; } else{echo $data->out_of;}?></td>
</tr>


<?php

}


 ?>