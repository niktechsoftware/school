<?php 
//print_r($explist);
    // $this->db->where('school_code',$this->session->userdata('school_code'));
    //     $fsd=$this->db->get('fsd')->result();
    if($explist->num_rows()>0){
        ?>
        <div class="panel-body panel-scroll height-450 table-responsive" >
    <table class="table table-bordered table-hover ">
    <thead>
    <tr class="text-center">
        <th>Expenditure ID </th>
    <th>Name</th>
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
        <input type="hidden" id="exp_id<?php echo $i;?>" name="exp_id" value="<?php echo $row->sno; ?>">
        <input type="text" name="exp_name" id="exp_name<?php echo $i;?>" value="<?php echo $row->expenditure_name;?>"></td>
        <td class="text-center"><a href="#" id="expEdit<?php echo $i;?>" name="expEdit" class="btn btn-warning">Edit</a></td>
    </tr>
    <?php  
$i++;
 }?>
    </tbody>
    </table>
    </div>
    <?php } ?>
    <script>
	    <?php for($j = 1; $j < $i; $j++){ ?>
			    $("#expEdit<?php echo $j; ?>").click(function(){
		    		var expId = $('#exp_id<?php echo $j; ?>').val();	
		    		var expName = $('#exp_name<?php echo $j; ?>').val();
		    		alert("your Expenditure is successfully updated");
		    		var form_data = {
							expId : expId,
							expName : expName
						};
				$.ajax({
					url: "<?php echo site_url("index.php/dayBookControllers/updateExp") ?>",
					type: 'POST',
					data: form_data,
					success: function(msg){
						$("#expenditure2").html(msg);
					}
				});
		        });
	
	
                    <?php } ?>   
</script>