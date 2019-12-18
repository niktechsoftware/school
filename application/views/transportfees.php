<?php if($result->num_rows()>0){ ?>
<div class="table-responsive">
<table id="aarju" class="table table-striped table-bordered">
			    <thead>
				<tr>
                <th>S.No.</th>
                <th>Vehicle Name</th>
                <th>Number</th>
                <th>Driver Name</th>
                <th>Conductor Name</th>
                <th >Pickup Points</th>
                <th >Drop Points</th>
                <th>Route</th>
                <th>Transport Fee</th>
                <th style="max-width:120px;">Action</th>
                
                </tr>
				</thead>
	        	<tbody>
                    <?php $i=1;foreach($result->result() as $res):
                  //  print_r($res);
                    $this->db->where("v_id",$res->id);
                    $fdata = $this->db->get("transport_root_amount");
                    if($fdata->num_rows()>0){
                    foreach($fdata->result() as $row):
                    ?>
            <tr>
                <td><?php echo $i;?></td>
                <td><?php echo $res->vehicle_name;?></td>
                <td><?php echo $res->vehicle_numnber;?></td>
                <td><?php echo $res->driver_name;?></td>
                <td><?php echo $res->conductor_name;?></td>
                <td><?php echo $row->pickup_points;?></td>
                <td ><?php echo $row->drop_points;?></td>
                <td ><?php echo $row->root;?></td>
                <td><input type="text" value="<?php echo $row->transport_fee;?>"   onkeypress="return isNumber(event)" class="form-control"  style="max-width:80px;" maxlength="8" id="trans_fee<?php echo $i;?>" /></td>
                <td style="max-width:120px;"><input type="hidden" id="rowSno1<?php echo $i;?>" size="20" value="<?php echo $row->id;?>">
                    <a href="#" class="btn btn-primary" id="editroot1<?php echo $i;?>">Edit</a>
                     <input type="hidden" id="rowSno1<?php echo $i;?>" size="20" value="<?php echo $row->id;?>">
                    <a href="#" class="btn btn-danger" id="deleteroot1<?php echo $i;?>"></i>Delete</a>
                </td>
              
           
            <script>
                $("#editroot1<?php echo $i; ?>").click(function() {
                    var transfee = $("#trans_fee<?php echo $i;?>").val();
                    var rowSno = $('#rowSno1<?php echo $i;?>').val();
                    $.post("<?php echo site_url('configureFeeController/edittransfee') ?>", {
                        transfee: transfee,
                        rowSno: rowSno
                    }, function(data) {
                        $("#editroot1<?php echo $i;?>").html(data);
                        //alert(data);
                    })
                });
                $("#deleteroot1<?php echo $i; ?>").click(function() {
                    var rowSno = $('#rowSno1<?php echo $i;?>').val();
                    $.post("<?php echo site_url('configureFeeController/deletetransfee') ?>", {
                        rowSno: rowSno
                    }, function(data) {
                        $("#deleteroot1<?php echo $i;?>").html(data);
                        //alert(data);
                    })
                });

                function isNumber(evt) {
                                    evt = (evt) ? evt : window.event;
                                    var charCode = (evt.which) ? evt.which : evt.keyCode;
                                    if (charCode > 31 && (charCode < 48 || charCode > 57)) {

                                        return false;
                                    }
                                    return true;
                                }
                </script>
                </tr>
                <?php $i++; endforeach; }?>
           
     
                
                <?php   endforeach; ?>
            
								</tbody>
							</table>
                            </div>
                            <?php } ?>
                            <script>
                              //  $('#aarju').DataTable();
                            </script>