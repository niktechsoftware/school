<!--  
Niktech software Solutions,niktechsoftware.com,schoolerp-niktech.in
  <meta name="description" content="Welcome to niktech software School business ERP . we proving school management erp software. we including online attendance with biometric attendance machine and tracking student with GPS technology & many other facilities in our school management erp system">
  <meta name="keywords" content="Enterprise resource planning,school,ERP,system software,attendance,biometric,online, school management,gps,niktech software solution, online result, online admit card,omr">
  <meta name="author" content="School management System software">
-->

<?php
$i = 1;
if(isset($streamList)):
	foreach ($streamList->result() as $row):
?>
		<div class="text-white text-sm pull-left space10">
			<span id="name2<?php echo $i;?>" Style="color:red;"></span>
			<input type="text" id="streamValue<?php echo $i;?>"  class="text-uppercase" maxlength="15" onkeypress="return isAlaphabte(event)" value="<?php echo $row->house_name;?>" >
			<input type="hidden" id="streamId<?php echo $i;?>" size="13" value="<?php echo $row->id; ?>">
			<a href="#" class="btn btn-sm btn-light-green" id="edit<?php echo $i;?>"><i class="fa fa-edit"></i> Edit</a>
			<a href="#" class="btn btn-sm btn-light-green" id="delete<?php echo $i;?>"><i class="fa fa-trash-o"></i> Delete</a>
		</div>
		
<?php
	$i++;
	endforeach;
endif;
?>


<script>
	    <?php for($j = 1; $j < $i; $j++){ ?>
			    $("#edit<?php echo $j; ?>").click(function(){
		    		var streamId = $('#streamId<?php echo $j; ?>').val();	
		    		var streamName = $('#streamValue<?php echo $j; ?>').val();
		    		alert("House is successfully updated");
		    		var form_data = {
							streamId : streamId,
							streamName : streamName
						};
				$.ajax({
					url: "<?php echo site_url("index.php/configureHouse/updateHouse") ?>",
					type: 'POST',
					data: form_data,
					success: function(msg){
						$("#streamList1").html(msg);
					}
				});
		        });
	
			    $("#delete<?php echo $j; ?>").click(function(){
		    		var streamId = $('#streamId<?php echo $j; ?>').val();	
		    		//alert(streamName);
		    		$.post("<?php echo site_url('index.php/configureHouse/deleteHouse') ?>", {streamId : streamId}, function(data){
		                $("#streamList1").html(data);
		                //alert(data);
		    		})
		        });
	 
                       

	                 
                    <?php } ?> 


					
                    

  
</script>