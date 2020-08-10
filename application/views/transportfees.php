<?php if($result->num_rows()>0){ ?>
<div class="panel-heading panel-pink">
                                  <h3 class="panel-title">Vehicle List</h3>
                                </div>
                                <br>
                                 <div class "alert alert-info"> Copy All Route And Tranport to another FSD <input type="checkbox" id="clickch"/></div>
                      <div class="col-sm-12" id ="copyd">
                                        <div class="col-md-3">
                                          <div class="row-form">
                                            <div class="col-md-5">
                                              <strong>Select FSD </strong></div>
                                            <div class="col-md-7"> 
                                            <select class="form-control" id="selfsd1" name="selfsd1" required="required">
                                                        <option value=""> Select FSD</option>
                                                        <?php 	$this->db->where("school_code",$this->session->userdata("school_code"));
                                                        $fsdd = $this->db->get("fsd");
                                                        if($fsdd->num_rows()>0){
                                                        foreach($fsdd->result() as $row):
        												    echo '<option value="'.$row->id.'">'.$row->finance_start_date." TO ".$row->finance_end_date.'</option>';
        												endforeach; }?>
                                                      </select>
                                            </div>
                                          </div>
                                        </div>
                                        <div class="col-md-3">
                                          <div class="row-form">
                                            <div class="col-md-5">
                                              <strong>Select Amount Change</strong></div>
                                            <div class="col-md-7">
                                              <select class="form-control" id="selset" name="selset" required="required">
                                                        <option value=""> change Type</option>
                                                        <option value="fixed"> Want to change fix updation </option>
                                                        <option value="manual"> Leave it Change Manually </option>
                                                      </select>
                                            </div>
                                          </div>
                                        </div>
                                         <div class="col-md-6">
                                          <div class="row-form">
                                            <div class="col-md-4">
                                              <input type="text" name="updateamount" class="form-control" id ="updateamount" /></div>
                                            <div class="col-md-7">
                                             <button class ="btn btn-success" id ="saveallchanges">Copy to next FSD</button>
                                            </div>
                                         
                                        </div>
                                        </div>
                          </div>     
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
                 <th>FSD</th>
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
                        $this->db->where("root_id",$row->id);
                    $fv = $this->db->get("fsdwise_root_amount");
                    foreach($fv->result() as $rty):
                        $this->db->where("id",$rty->fsd);
                       $fsdd =  $this->db->get("fsd")->row();
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
                <td ><?php echo $fsdd->finance_start_date;?></td>
               
                <td><input type="text" value="<?php echo $rty->amount;?>"   onkeypress="return isNumber(event)" class="form-control"  style="max-width:80px;" maxlength="8" id="trans_fee<?php echo $i;?>" /></td>
                <td style="max-width:120px;"><input type="hidden" id="rowSno1f<?php echo $i;?>" size="20" value="<?php echo $rty->id;?>">
                    <a href="#" class="btn btn-primary" id="editroot1<?php echo $i;?>">Edit</a>
                     <input type="hidden" id="rowSno1<?php echo $i;?>" size="20" value="<?php echo $row->id;?>">
                    <a href="#" class="btn btn-danger" id="deleteroot1<?php echo $i;?>"></i>Delete</a>
                </td>
              
                </tr>
                
                 <script>
                $("#editroot1<?php echo $i; ?>").click(function() {
                    var transfee = $("#trans_fee<?php echo $i;?>").val();
                    var rowSno = $('#rowSno1f<?php echo $i;?>').val();
                    //alert(transfee + rowSno);
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
                <?php $i++; endforeach; endforeach; }?>
           
     
                
                <?php   endforeach; ?>
            
								</tbody>
							</table>
                            </div>
                            <?php } ?>
                            <script>
                             $('#copyd').hide();
                               $('#aarju').DataTable();
                            </script>
                            <script>
                            $('input[type="checkbox"]').click(function() {
                          if($(this).prop("checked") == true){
                                   $('#copyd').show();
                                }
                                else if($(this).prop("checked") == false){
                                     $('#copyd').hide();
                                }      
                            });
                  $('#saveallchanges').click(function() {
                         var fsd = $("#selfsd1").val();
                          var salfixn = $("#selset").val();
                          var upam = $('#updateamount').val();
                          alert(fsd);
                           $.post("<?php echo site_url('configureFeeController/updaterootfsd') ?>", {
                        fsd : fsd,
                        salfixn: salfixn,
                        upam  : upam 
                    }, function(data) {
                        
                        alert(data);
                    })
                         
                  });
                
                </script>