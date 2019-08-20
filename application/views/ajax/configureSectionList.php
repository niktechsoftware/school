<!--  
Niktech software Solutions,niktechsoftware.com,schoolerp-niktech.in
  <meta name="description" content="Welcome to niktech software School business ERP . we proving school management erp software. we including online attendance with biometric attendance machine and tracking student with GPS technology & many other facilities in our school management erp system">
  <meta name="keywords" content="Enterprise resource planning,school,ERP,system software,attendance,biometric,online, school management,gps,niktech software solution, online result, online admit card,omr">
  <meta name="author" content="School management System software">
-->

<?php
if(isset($sectionList)){
	$i = 1;
	foreach ($sectionList->result() as $row){
		echo '<div class="text-white text-large pull-left space10">';
		?>
	    <span id="name3'.$i.'" Style="color:red;"></span>
        <?php
		echo '<input type="text" id="sectionValue'.$i.'" size="10" minLength="1" maxLength="2" value="'.$row->section.'" onkeyup="Validate1()"  onkeyup="myFunction()">';
		echo '<input type="hidden" id="sectionId'.$i.'" size="10" value="'.$row->id.'">';
		echo ' <a href="#" class="btn btn-sm btn-light-blue" id="editSection'.$i.'"><i class="fa fa-edit"></i> Edit</a>';
		echo ' <a href="#" class="btn btn-sm btn-light-blue" id="deleteSection'.$i.'"><i class="fa fa-trash-o"></i> Delete</a>';
		echo '</div>';
		$i++;
	}
	?>
				<script>
			    <?php for($j = 1; $j < $i; $j++){ ?>
			    $("#editSection<?php echo $j; ?>").click(function(){
		    		var sectionId = $('#sectionId<?php echo $j; ?>').val();	
		    		var sectionName = $('#sectionValue<?php echo $j; ?>').val();
		    		$.post("<?php echo site_url('index.php/configureClassControllers/updateSection') ?>", {sectionId : sectionId, sectionName : sectionName}, function(data){
		                $("#sectionList").html(data);
		    		})
		        });

			    $("#deleteSection<?php echo $j; ?>").click(function(){
		    		var sectionId = $('#sectionId<?php echo $j; ?>').val();	
		    		$.post("<?php echo site_url('index.php/configureClassControllers/deleteSection') ?>", {sectionId : sectionId}, function(data){
		                $("#sectionList").html(data);
		    		})
		        });


       
                      var input = document.getElementById("sectionValue<?php echo $j; ?>");
                         input.addEventListener("keyup", function () {
                         var text_value = document.getElementById("sectionValue<?php echo $j; ?>").value;
                                    if (!text_value.match(/^[A-Za-z]+$/)) {
                                        document.getElementById("name3'.$j.'").innerHTML = "Only Alphabets Allow";
                                               $('#editSection<?php echo $j; ?>').attr('disabled', 'disabled');
                                                 $('#deleteSection<?php echo $j; ?>').attr('disabled', 'disabled');

                                           $(document).on('click', 'a', function(e) {
                                          if ($(this).attr('disabled') == 'disabled') {
                                             e.preventDefault();
                                                }
                                                window.location.reload();
                                            });

                                        document.getElementById("sectionValue<?php echo $j; ?>").focus();
                                        if (text_value == "") {
                                            document.getElementById("name3'.$j.'").innerHTML = " ";
                                            window.location.reload();
                                            document.getElementById("sectionValue<?php echo $j; ?>").focus();
                                        }
                                    }
                         });

                         input.addEventListener("keyup", function () {
                          var x = document.getElementById("sectionValue<?php echo $j; ?>");
                             x.value = x.value.toUpperCase();
                         
                  });
                          <?php } ?> 
		</script>
<?php
	}
?>			   
