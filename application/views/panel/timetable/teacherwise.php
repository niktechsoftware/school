<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
	<meta http-equiv='Content-Type' content='text/html; charset=UTF-8' />
	
	<title>Period Time Table</title>
	
	
	<link rel='stylesheet' type='text/css' href='<?php echo base_url(); ?>assets/css/invoice_css/print.css' media="print" />
	<script type='text/javascript' src='<?php echo base_url(); ?>assets/js/invoice_js/jquery-1.3.2.min.js'></script>
	<script type='text/javascript' src='<?php echo base_url(); ?>assets/js/invoice_js/example.js'></script>
	

<style type="text/css">
  @media print {
    body * {
      visibility: hidden;
    }

    #printcontent * {
      visibility: visible;
    }

    #printcontent {
      position: absolute;
      top: 40px;
      left: 30px;
    }
  }
  
  .button {
  background-color: #4CAF50; /* Green */
  border: none;
  color: white;
  padding: 16px 32px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 16px;
  margin: 4px 2px;
  -webkit-transition-duration: 0.4s; /* Safari */
  transition-duration: 0.4s;
  cursor: pointer;
}
  
  
  .button2 {
  background-color: #008CBA; 
  color: white; 
  border: 2px solid #008CBA;
}

.button2:hover {
  background-color: #4CAF50;
  color: white;
  border: 2px solid #4CAF50;
}
  
  </style>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
  
</head>



<body style ="color:none">	
<div id="printcontent" class="container">
<div class="row">
<div class="col-md-12">
<center>
<h2 style="color:green;"><?php echo $name;?> Period Time Table</h2>
<hr>
<table class="table table-striped table bordered">
<thead>	
<tr>
    <th>Period</th>
	<th>From</th>
	<th>To</th>
	<th>Subject</th>
	<th>Class</th>
	<th>Day</th>
	</tr>
</thead>
<tbody>	
<?php    

if($time->num_rows()>0){

foreach($time->result() as $data)
{
 $row1=$data->subject_id;
 $row2=$data->class_id;
 $row3=$data->period_id;
 $row4=$data->teacher;
 $row6=$data->subject_id;
 $row5=$data->day;

 $this->db->where('id',$row1);
 $sub=$this->db->get('subject');
//  $this->db->where('id',$row2);
// $class=$this->db->get('class_info')->row();

$this->db->where('id',$row3);
$period=$this->db->get('period');

$this->db->where('id',$row2);
$class=$this->db->get('class_info');

 ?>

<tr>
	<td><?php if($row3==0){echo "LUNCH"; }elseif($period->num_rows()>0){echo $period->row()->period;}else{ echo " Period not assign";} ?></td>
	<td><?php if($row3==0){echo "0000-00-00"; } elseif($period->num_rows()>0){echo $period->row()->from;}else{echo "0000-00-00";}?></td>
	<td><?php if($row3==0){echo "0000-00-00"; } elseif($period->num_rows()>0){echo $period->row()->to;}else{echo "0000-00-00";}?></td>
	<td> <?php if($row1==0){echo "subject not assign"; }elseif($sub->num_rows()>0){echo $sub->row()->subject;}else{echo "subject not assign";} ?> </td>
<td> <?php if($row4==0){echo "class not assign"; }elseif($class->num_rows()>0){echo $class->row()->class_name;}else{echo "class not assign";} ?> </td>
<td><?php echo $row5; ?></td>
</tr>

 <?php }}else{ echo "Data not found";}?>
 </tbody>
</table>
</center>
</div>
</div>
</div>
<br>
	<div class="invoice-buttons" style="text-align:center;">
    <button class="button button2" type="button"  onclick="window.print();">
      <i class="fa fa-print padding-right-sm"></i> Print Time Table
    </button>
  </div>
</body>

</html>
