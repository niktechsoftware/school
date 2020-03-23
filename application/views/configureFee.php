 <!--start: PAGE CONTENT -->
<script src="<?php echo base_url(); ?>assets/plugins/jQuery/jquery-2.1.1.min.js"></script>
<div class="row">
  <div class="col-sm-12">
    <!-- start: INLINE TABS PANEL -->
    <div class="panel panel-white">
    
      <div class="panel-body">
        <div class="row">
          <div class="col-sm-12">
            <div class="tabbable">
              <ul id="myTab" class="nav nav-tabs">
                <li class="active">
                  <a href="#myTab_example1" data-toggle="tab">
                    <i class="green fa fa-home"></i> Define Date Of Deposit Fee
                  </a>
                </li>
                <li>
                  <a href="#myTab_example2" data-toggle="tab">
                    <i class="green fa fa-home"></i> Fee Head & Amount Configure
                  </a>
                </li>
                <li>
                  <a href="#myTab_example3" data-toggle="tab">
                    <i class="green fa fa-home"></i> Active Discount
                  </a>
                </li>
                <li>
                  <a href="#myTab_example4" data-toggle="tab">
                    <i class="green fa fa-home"></i> Transport
                  </a>
                </li>
                <li>
                  <a href="#myTab_example5" data-toggle="tab">
                    <i class="green fa fa-home"></i> Define Route & Amount
                  </a>
                </li>
              </ul>
              <div class="tab-content">
                <div class="tab-pane fade in active" id="myTab_example1">
                    
                                      <div class="panel panel-white ">
               
                    <div class="panel-body">
                    
                  <div class="alert btn-azure">
                    <button data-dismiss="alert" class="close">×</button>
                    <h3 class="media-heading text-center">Welcome to Fee Configuration Area.</h3>
                    </center>
                    This is very important area to define date for deposit month fee.You can change
                    date in any time but all Student's who remain to deposit their fee will be
                    change accordingly.
                    <p> Note:-Define deposit date for every Month . <br>If you want to take <strong> Late Fee </strong> 
                    you can define Late Fee charges also. One row or Month will
                        save at a time on click <strong>SAVE </strong> Button.
                      </p>

                  </div>
                  <div class="panel-body">

                   <?php 	$this->db->where('school_code',$this->session->userdata('school_code'));

                                                $row=	$this->db->get('late_fees');
                                                if($row->num_rows()>0)
                                                {
                                                $row =$row->row();
                                                $mgap=$row->apply_method;
                                                $fee=$row->late_fee;
                                        ?>
                                        <div class="row" style="margin:20px;">
                                           <div class="col-sm-4"><b>Apply Method &nbsp;</b>
                                           <input type="text" id="applymethod" readonly value="<?php echo $mgap;?>">
                                          </div>


                                          <div class="col-sm-4"><b>Late Fee Amount</b>
                                           <input type="text" id="feecharge" name="feecharge" readonly value="<?php echo $fee;?>">

                                        <!--   <div class="col-sm-4"><b>Late Fee Amount &nbsp;</b>
                                           <input type="text" id="feecharge"   name="feecharge" value="<?php echo $fee;?>" readonly /> -->

                                          </div>
                                            <div class="col-sm-4">
                                              <button type="reset" id="reset" onClick="Refresh()" value="reset" class="btn btn-primary" style="margin-top:16px;">Reset</button> 

                                              Reset Your Fee apply Method
                                            </div>
                                                </div>
                                        <div id="demo"></div>
                                         <script>
                                        function Refresh() {
                                            window.parent.location = window.parent.location.href;
                                        }
                                       </script>
                    <table class="table table-bordered table-hover" id="subhead">
                      <thead>
                        <tr style="background-color: #337ab7; color:white;">
                          <th width="15%">S.No.</th>
                          <th width="15%">Month</th>
                          <th width="20%">Deposit Date</th>
                          <!--   <th width="20%">Late Fee</th>  -->
                          <th width="20%">Status</th>
                        </tr>
                      </thead>
                      <tbody>


                        <?php $ft=4;  $loop  = 12/$mgap ; 
                        for($j = 1 ; $j<= $loop; $j++)
													{

													    ?>
                        <form action="<?php echo base_url();?>index.php/configureFeeController/update_fee_deposit"
                          method="post" role="form" class="form-horizontal" id="form">
                          <tr>

                            <td><?php echo $j;?></td>
                            <?php
                                if($ft>12){
                                 $ft=$ft-12;}
																 $month_name = date("F",mktime(0,0,0,$ft,1,date("Y")));
																	$result =  $this->configurefeemodel->check_fee_deposit($ft);

																 if($result->num_rows()>0){
																 $fd = $result->row();	?>

                            <td>
                              <?php	 $month_name1 = date("F",mktime(0,0,0,$fd->month_number,1,date("Y")));

																 	  echo $month_name1; ?>
                              <input type="hidden" name="month_number" value="<?php echo $fd->month_number;?>">
                            </td>
                            <td> <input type="date" name="dddate" style="font-size: 10pt; height: 34px;" min="2018-01-01" max="Date()"
                                class="form-control" value="<?php echo date('Y-m-d',strtotime($fd->deposite_date))?>" />
                            </td>
                            <!-- <td><input type="text" class="form-control" name="latefee" id="latefee" value = "<?php //echo $fd->late_fee;?>"></td>-->
                            <td><button type="submit" class="btn btn-primary"> Save
                              </button></td>
                            <?php  }else{
																 ?>
                            <td><?php  echo $month_name ?>

                              <input type="hidden" name="month_number" value="<?php echo $ft;?>"></td>
                            <td> <input type="date" id="dddate" name="dddate" style="font-size: 10pt; height: 34px;"
                                class="form-control" /> </td>
                            <!-- <td><input type="text" class="form-control" name="latefee" id="latefee"></td> -->
                            <td><button type="submit" class="btn btn-primary" id="subbutton" disabled> Save
                              </button></td>
                            <?php
 							}   $ft = $mgap+$ft;

                                ?>

                          </tr>
                        </form>
                        <?php }?>

                      </tbody>
                    </table>
                    <?php }else{?>
                                
                    <h2>Fee Collect Apply Method</h2>
                    <form action="<?php echo base_url() ?>configureFeeController/apply_method"
                          method="post">
                    <div class="row">
                    <div class="col-md-4">
                      <h4 style="color:red;"><b>
                          Choose Method:</b></h4>
                    </div>
                    <div class="col-md-4">
                      <select class="form-control" name="head" required>
                        <option value="">--select--</option>
                        <option value="1" id="1">Monthly</option>
                        <option value="2" id="2">Two Month</option>
                        <option value="3" id="3">Three month</option>
                        <option value="4" id="4">Four Month</option>
                        <option value="6" id="5">Half Yearly</option>
                        <option value="12" id="6">Yearly</option>
                      </select>
                    </div>
                    </div>    
                    <div class="row">
                    <div class="col-md-4">
                      <h4 style="color:red;"><b>
                      Late Fee Charge Type:</b></h4>
                    </div>
                    <div class="col-md-4">
                      <select class="form-control" name="latefee" required>
                        <option value="">--select--</option>
                        <option value="1">Monthly Charge</option>
                        <option value="2">Day Wise Charge</option>
                        <option value="0">None</option>
                      </select>
                    </div>
                   
                    </div>
                    <div class="row">
                    <div class="col-md-4">
                      <h4 style="color:red;"><b>
                      Late Fee Amount:</b></h4>
                    </div>
                    <div class="col-sm-4">
                      <input type="text" class="form-control" maxlength="4" onkeypress="return isNumber(event)" id="lateamt" name="lateamt" placeholder="Enter Amount" required/>
                    </div>
                    <div class="col-sm-4">
                      <input type="submit" class="form-control btn-primary" id="submit" name="submit" value="Submit"/>
                    </div>
                    </div>
                    </form>
                    <?php }?>
                  </div>
                </div>
                </div>
                </div>
                <div class="tab-pane fade" id="myTab_example2">

                  <div class="panel panel-white ">
 
                    <div class="panel-body">
                                          <div class="alert panel-pink">
                    <button data-dismiss="alert" class="close">×</button>
                    <h3 class="media-heading text-center">Welcome to Fee Head & Amount Configuration
                      Area</h3>
                    </center>
                    This is the Second Phase of Fee Configuration where we Define Fee Head and
                    their Amount, Class Wise.
                   If you want to
                      <strong>Add</strong> a Fee Head
                      please select Stream, Section and Class Name after then Please fill Head Name, Amount
                      and taken Month </strong> and Press <strong>Add Fee Head</strong>
                      Button.<br>
                      To <strong>Edit</strong> existing Fee Head Edit it's name and Press
                      <strong>Edit</strong> Button next to the row.
                      And to <strong>Delete</strong> a head simply Press
                      <strong>Delete</strong> Button. </p>
                  </div>
                      <div class="row">

                        <div class="col-sm-4">

                          <div class="panel">
                            <div class="panel-heading btn-dark-green">
                              <h3 class="panel-title">Select Stream</h3>
                            </div>
                            <div class="panel-body">
                              <div class="form-group">
                                <select id="streamListshow" class="form-control">
                                  <option value="">Select Stream Name</option>
                                  <?php
  					            	$this->load->model("configurefeemodel");
									$result = $this->configurefeemodel->getStreamList();
									$streamList = $result->result();
									if(isset($streamList)):?>
                                    <?php foreach ($streamList as $row):?>
                                    <?php $this->db->where("school_code",$this->session->userdata("school_code"));
                                    $this->db->where('id',$row->stream);
                                     $row1=$this->db->get('stream');
                                     if($row1->num_rows()>0){
                                         $row2 =$row1->row();
                                    ?>
                                  <option value="<?php echo $row2->id;?>">
                                    <?php echo $row2->stream;?></option>
                                  <?php } endforeach; endif;?>
                                </select>
                              </div>
                            </div>
                          </div>

                        </div>
                        <div class="col-sm-4">
                          <div class="panel">
                            <div class="panel-heading btn-dark-red">
                              <h3 class="panel-title">Select Section</h3>
                            </div>
                            <div class="panel-body">
                              <div class="form-group">
                                <select id="sectionshow" class="form-control">

                                </select>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="col-sm-4">
                          <div class="panel">
                            <div class="panel-heading btn-dark-purple">
                              <h3 class="panel-title">Select Class</h3>
                            </div>
                            <div class="panel-body">
                              <div class="form-group">
                                <select id="classshow" class="form-control">


                                </select>
                              </div>

                            </div>
                          </div>
                        </div>

                      </div>
                  <!--         <div class="alert alert-info">-->
                  <!--  <button data-dismiss="alert" class="close">×</button>-->
                  <!--NOTE : -  Class will automatically come select and Add Subject.</div>-->
                      <div class="row" id="feeBox">


                      </div>
                    </div>
                  </div>
                </div>
                <div class="tab-pane fade" id="myTab_example3">

                  <div class="row">
                      
                    <div class="col-md-12">

                      <div class="panel panel-primary">
  
                        <div class="panel-body">
                                              <div class="alert panel-orange">
                    <button data-dismiss="alert" class="close">×</button>
                    <h3 class="media-heading text-center"> Welcome to Important Instructions about Discount</h3>
                    </center>
                    <p class="media-timestamp">Please insure that you create Fee of all Class.In this Section you
                      provide discount like as <strong>(brother/sister discount etc)</strong> . Please insert Discount Head, Discount
                      Amount, Discount Present, Applicated date and Discount Type in a given below Section and Press Save Button. 
                      If you want Delete this field then Press Delete Button.You can choose only one column in Disc/Concession Head and Discount type or Discount
                      Amount and Discount Present.
                      </p>
                      <p><stong>Note:-</stong>Discount type is most Important column, choose this column when Student are staff child or study more then two brother </p>

                  </div>
                          <table cellpadding="0" cellspacing="0" width="100%"
                            class="table table-bordered table-striped sortable_simple">
                            <thead>
                              <tr class="text-nowrap" style="background-color:#804c75; color:white;">
                                <th>Sno</th>
                                <th>Disc/Concession Head</th>
                                <th>Discount Type</th>
                                <!-- <th>Disc/Consession ID</th> -->
                                <th>Disc Amount</th>
                                <th>Disc Per %</th>
                                <th>Applied Date</th>
                                <th>Mannual Filled</th>
                                <th>Action</th>
                              </tr>
                            </thead>

                            <tbody>
                              <?php
                                  $this->db->where("school_code",$this->session->userdata('school_code'));
                                      $result = $this->db->get("discounttable");
                                      // print_r( $result->row());
                                      // exit;
                                     // $countrow=$result->num_rows();
                                      $y=1 ;
                                      if($result->num_rows()>0){
                                      foreach($result->result() as $rt):?>
                              <tr class="text-uppercase">
                                <td> <?php echo $y;?>
                                  <input type="hidden" id="sno<?php echo $y;?>" value="<?php echo $rt->id;?>">
                                </td>
                                <td> <input type="text" class="form-control text-uppercase"  onkeypress="return isAlpha(event)" id="dhead<?php echo $y;?>" 
                                    value="<?php if(strlen($rt->discount_head)>2){ echo $rt->discount_head;}else{ echo "N/A";}?>"  maxlength="20" minlength="2">
                                    <script>
                                        function isAlpha(evt) {
                                    evt = (evt) ? evt : window.event;
                                    var charCode = (evt.which) ? evt.which : evt.keyCode;
                                    if (charCode > 31 && (charCode < 48 || charCode > 57)) {

                                        return true;
                                    }
                                    return false;
                                }
                                    </script>
                                    </td>
                                  <?php 
                                  $this->db->where('id',$rt->discount_head);
                                  $data=$this->db->get('discount_head');
                                ?>
                                <td> <input type="text" class="form-control"   onkeypress="return isAlpha(event)"  disabled="" id="dtype<?php echo $y;?>"
                                    value="<?php if($data->num_rows()>0){ echo $data->row()->disc_head ;}else{ echo "N/A";} ?>"/> 
                                  <!--   elseif($rt->discount_head=='2'){ echo "BROTHER DISCOUNT (ONE CHILD)" ;}
                                    elseif($rt->discount_head=='3'){ echo "MORE THEN ONE BROTHER DISCOUNT" ;}
                                    elseif($rt->discount_head=='4'){ echo "OTHER DISCOUNT" ;} -->
                                  
                                </td>
                               
                                <!-- <td> <input type="text" class="form-control" id="discid1<?php echo $y;?>"
                                      value="<?php //echo $rt->discount_id1;?>">
                                       <input type="text" class="form-control" id="discid2<?php echo $y;?>"
                                      value="<?php //echo $rt->discount_id2;?>"> -->
                                      <!-- <div id="div1<?php echo $y;?>" style="display: none"> 
                                      <input type="text" class="form-control" id="discid2<?php echo $y;?>"
                                      value="<?php //echo $rt->discount_id2;?>">
                                     </div> 
                                </td> -->
                                <td> <input type="text" class="form-control" id="damount<?php echo $y;?>"
                                    value="<?php echo $rt->discount_amount;?>"  maxlength="5" minlength="2" onkeypress="return isNumber(event)"></td>
                                <td> <input type="text" class="form-control" id="dper<?php echo $y;?>"
                                    value="<?php echo $rt->discount_persent;?>" maxlength="5" minlength="2" onkeypress="return isNumber(event)">
                                </td>
                                <td> <input type="date" class="form-control" style="font-size: 10pt; height: 34px;"
                                    id="applied_date<?php echo $y;?>"
                                    value="<?php echo date('Y-m-d',strtotime($rt->applied_date));?>"></td>

                                <td> <select class="form-control" id="mannual<?php echo $y;?>">
                                   <option value="all">ALL</option>

                                    <?php 
                                     $school_code = $this->session->userdata("school_code");
                                  
                                    $query = $this->db->query("SELECT DISTINCT(class_fees.fee_head_name) FROM class_info INNER JOIN class_fees ON class_info.id = class_fees.class_id where class_info.school_code=$school_code");
                                                                        foreach($query->result() as $row){?>
                                  <!--<option value="<?php echo $rt->applied_head_id; ?>"></option>-->
                                  <option value="<?php echo $row->fee_head_name;?>"
                                                                    <?php if($row->fee_head_name== $rt->applied_head_id): echo ' selected="selected"'; endif; ?>>
                                                                    <?php echo $row->fee_head_name;?></option>
                                    <?php   }?>
                                  </select></td>
                                <td>
                                    <button type="submit" class="btn btn-primary" id="edit<?php echo $y;?>"><i class="fa fa-edit"></i> Edit
                                  </button>
                                  <button type="submit" class="btn btn-danger" id="delete<?php echo $y;?>"><i class="fa fa-trash-o"></i> Delete
                                  </button>
                                  <!--<a href="#" class="btn btn-primary"-->
                                  <!--  id="edit<?php echo $y;?>"><i class="fa fa-edit"></i>-->
                                  <!--  Edit</a>-->
                                  <!--  <a href="#" class="btn btn-danger"-->
                                  <!--  id="delete<?php echo $y;?>"><i-->
                                  <!--      class="fa fa-trash-o"></i> Delete-->
                                  <!--      </a>-->
                                </td>
                              </tr>

                              <script>
                              $("#edit<?php echo $y;?>").click(function() {
                                var dhead = $("#dhead<?php echo $y;?>").val();
                                // var discid1 = $("#discid1<?php echo $y;?>").val();
                                // var discid2 = $("#discid2<?php echo $y;?>").val();
                                var damount = $("#damount<?php echo $y;?>").val();
                                 
                                var dper = $("#dper<?php echo $y;?>").val();
                                var applied_date = $("#applied_date<?php echo $y;?>").val();
                                 
                                var mannual = $('#mannual<?php echo $y;?>').val();
                                 
                                var sno = $('#sno<?php echo $y;?>').val();

                                //alert( dhead+sno+damount+dper+applied_date+mannual);
                                $.post("<?php echo site_url('configureFeeController/updatediscount') ?>", {
                                  dhead: dhead,
                                  // discid1:discid1,
                                  // discid2:discid2,
                                  damount: damount,
                                  dper: dper,
                                  applied_date: applied_date,
                                  mannual: mannual,
                                  sno: sno
                                }, function(data) {
                                  $("#edit<?php echo $y;?>").html(
                                    data);
                                 // alert(data);
                                })
                              });
                              // $(function () {
                              //   var head = <?php //echo $rt->discount_head;?>;
                              //        //alert(head);
                              //             if (head == "3") {
                              //                 $("#div1<?php echo $y;?>").show();
                              //             } 
                              //             else {
                              //                 $("#div1<?php echo $y;?>").hide();
                              //             }
                                      
                              //     });
                                 
                              
                       var dper = document.getElementById("damount<?php echo $y;?>");
                        dper.onchange = function () {
                           if (this.value != "" || this.value.length > 0) {
                              document.getElementById("dper<?php echo $y;?>").disabled = true;
                           }
                        }
                               var damn = document.getElementById("dper<?php echo $y;?>");
                        damn.onchange = function () {
                           if (this.value != "" || this.value.length > 0) {
                              document.getElementById("damount<?php echo $y;?>").disabled = true;
                           }
                        }
                              $("#delete<?php echo $y;?>").click(function() {

                                var sno = $('#sno<?php echo $y;?>').val();

                                //alert(streamName);
                                $.post("<?php echo site_url('configureFeeController/deletediscount') ?>", {
                                  sno: sno
                                }, function(data) {
                                  $("#delete<?php echo $y;?>").html(
                                    data);
                                  //alert(data);
                                })
                              });
                              
                              
                              
                              
                              
                              
                              /////////////////
                              function isNumber(evt) {
                              evt = (evt) ? evt : window.event;
                              var charCode = (evt.which) ? evt.which : evt.keyCode;
                              if (charCode > 31 && (charCode < 48 || charCode > 57)) {
                                return false;
                              }
                              return true;
                            
                            }
                            function isAlpha(evt) {
                                    evt = (evt) ? evt : window.event;
                                    var charCode = (evt.which) ? evt.which : evt.keyCode;
                                    if (charCode > 31 && (charCode < 48 || charCode > 57)) {

                                        return true;
                                    }
                                    return false;
                                }
                            
                           
                              ////////////
                              </script>
                              <?php $y++; endforeach;}?>
                              <?php for($p=$y;$p<10;$p++){?>
                              <tr class="text-uppercase">
                                <td> <?php echo $p;?></td>
                                <td class="text-uppercase"> <input type="text"   onkeypress="return isAlpha(event)"  class="form-control text-uppercase" id="dhead<?php echo $p;?>" maxlength="20" minlength="20"> </td>
                               
                                <td>
                                <select class="form-control" id="dtype<?php echo $p;?>" required>
                                    <option value="0">--select--</option>
                                    <?php $data=$this->db->get('discount_head');
                                $i=1;foreach( $data->result() as $id): ?>
                                    <option value="<?php echo $i;?>"><?php echo $id->disc_head; ?></option>
                                    <?php $i++; endforeach; ?>
                                  </select>
                                </td>
                             
                                <!-- <td>
                                <input type="text" required="" class="form-control" id="discid1<?php echo $p;?>">
                                <div id="div<?php echo $p;?>" style="display: none"> 
                                <input type="text" required class="form-control" id="discid2<?php echo $p;?>">
                                </div>
                              </td> -->
                                <!-- <td> <input type="text" class="form-control" id="dhead<?php echo $p;?>"> </td> -->
                                <td> <input type="text" class="form-control" id="damount<?php echo $p;?>" maxlength="5" minlength="2" onkeypress="return isNumber(event)"></td>
                                <td> <input type="text" class="form-control" id="dper<?php echo $p;?>" maxlength="5" minlength="2" onkeypress="return isNumber(event)"></td>
                                <td> <input type="date" required class="form-control" style="font-size: 10pt; height: 34px;" id="applied_date<?php echo $p;?>"> </td>
                                <td> <select class="form-control" required id="mannual<?php echo $p;?>">
                                    <option value="all">ALL</option>
                                   <?php  $school_code = $this->session->userdata("school_code");  
                                    $query = $this->db->query("SELECT DISTINCT(class_fees.fee_head_name) FROM class_info INNER JOIN class_fees ON class_info.id = class_fees.class_id where class_info.school_code=$school_code");
                                    foreach($query->result() as $row){?>
                                    <option value="<?php echo $row->fee_head_name;?>"><?php echo $row->fee_head_name;?></option>
                                    <?php   }?>
                                  </select></td>
                                <td><button type="submit" class="btn btn-primary" id="save<?php echo $p;?>"> Save
                                  </button></td>
                              </tr>

                              <script>
                              $("#save<?php echo $p;?>").click(function() {
                                var dhead = $("#dhead<?php echo $p;?>").val();
                                var dtype = $("#dtype<?php echo $p;?>").val();
                                // var discid1 = $("#discid1<?php echo $p;?>").val();
                                // var discid2 = $("#discid2<?php echo $p;?>").val();
                                var damount = $("#damount<?php echo $p;?>").val();
                                var dper = $("#dper<?php echo $p;?>").val();
                                var applied_date = $("#applied_date<?php echo $p;?>").val();
                                var mannual = $('#mannual<?php echo $p;?>').val();
                                //alert(mannual);
                                $.post("<?php echo site_url('configureFeeController/insertdiscount') ?>", {
                                  dhead: dhead,
                                  dtype:dtype,
                                  // discid1:discid1,
                                  // discid2:discid2,
                                  damount: damount,
                                  dper: dper,
                                  applied_date: applied_date,
                                  mannual: mannual
                                }, function(data) {
                                  $("#save<?php echo $p;?>").html(
                                    data);
                                  //alert(data);
                                })
                              });
                              function isAlpha(evt) {
                                    evt = (evt) ? evt : window.event;
                                    var charCode = (evt.which) ? evt.which : evt.keyCode;
                                    if (charCode > 31 && (charCode < 48 || charCode > 57)) {

                                        return true;
                                    }
                                    return false;
                                }
                            

                              var dhead = document.getElementById("dhead<?php echo $p;?>");
                              dhead.onchange = function () {
                           if (this.value != "" || this.value.length > 0) {
                              document.getElementById("dtype<?php echo $p;?>").disabled = true;
                           }
                        }
                               var dtype = document.getElementById("dtype<?php echo $p;?>");
                               dtype.onchange = function () {
                           if (this.value != "" || this.value.length > 0) {
                              document.getElementById("dhead<?php echo $p;?>").disabled = true;
                           }
                        }
                              
                                     var dis1 = document.getElementById("damount<?php echo $p;?>");
                        dis1.onchange = function () {
                           if (this.value != "" || this.value.length > 0) {
                              document.getElementById("dper<?php echo $p;?>").disabled = true;
                           }
                        }
                               var dis2 = document.getElementById("dper<?php echo $p;?>");
                        dis2.onchange = function () {
                           if (this.value != "" || this.value.length > 0) {
                              document.getElementById("damount<?php echo $p;?>").disabled = true;
                           }
                        }
                              </script>
                              <?php }?>
                            </tbody>
                          </table>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="tab-pane fade" id="myTab_example4">
                  <div class="row">
                    <div class="col-md-12">
                      <div class="panel panel-calendar">

                        <div class="panel-body">
                                              <div class="alert panel-pink">
                    <button data-dismiss="alert" class="close">×</button>
                    <h3 class="media-heading text-center">Welcome to Transport Area</h3>
                    </center>
                    <p class="media-timestamp">Please insure that you have created Stream and
                      Section for Class. In this Section you must provide all Vehicle information You also provide the
                      Name of the Driver and his Mobile Number and see the list
                      on the right-hand panel. If you want to edit the details, Press the Edit Button and change the
                      information. If you want to Delete the information about the Vehicle, then you see the
                      Button to take down the Button.</p>
                  </div>
                          <div class="row">
                            <div class="col-sm-4">
                              <div class="panel panel-primary">
                                <div class="panel-heading">
                                  <h3 class="panel-title">Vehicle List</h3>
                                </div>
                                <div class="panel-body">
                                  <div class="form-group">
                                    <div class="col-sm-12">
                                    <div class="row">
                                      <div class="row-form">
                                        <div class="col-md-5"><strong>Vehicle
                                            Name:</strong></div>
                                        <div class="col-md-7"><input type="text" class="form-control text-uppercase"
                                            id="vehicle_name" maxlength="10" minlength="2" /></div>
                                      </div>
                                       <div id="name" style="color:red"></div>
                                      </div>
                                      <br>
                                      <div class="row">
                                      <div class="row-form">
                                        <div class="col-md-5"><strong>Vehicle
                                            Number:</strong></div>
                                        <div class="col-md-7"><input type="text " class="form-control text-uppercase"
                                            id="vehicle_number" maxlength="10"  /></div>
                                      </div>
                                      </div>
                                      </br>
                                      <div class="row">
                                      <div class="row-form">
                                        <div class="col-md-5"><strong>Driver
                                            Name:</strong></div>
                                        <div class="col-md-7"><input type="text "  onkeypress="return isAlpha(event)" class="form-control text-upercase"
                                            id="driver_name" maxlength="15" minlength="2"/></div>
                                      </div>
                                      </div>
                                      <br>
                                      <div class="row">
                                      <div class="row-form">
                                        <div class="col-md-5"><strong>Driver
                                            Mobile Number:</strong></div>
                                        <div class="col-md-7"><input type="text"   onkeypress="return isNumber(event)" class="form-control text-upercase"
                                            id="dr_mobile"  maxlength="10" minlength="10" /></div>
                                      </div>
                                      </div>
                                      <br>
                                      <div class="row">
                                      <div class="row-form">
                                        <div class="col-md-5"><strong>Conductor
                                            Name:</strong></div>
                                        <div class="col-md-7"><input type="text" class="form-control text-upercase"
                                            id="conductor_name" maxlength="20"  onkeypress="return isAlpha(event)" minlength="2"/></div>
                                      </div>
                                       <div id="name1" style="color:red"></div>
                                      </div>
                                      <br>
                                      <div class="row">
                                      <div class="row-form">
                                        <a href="#" class="btn btn-sm btn-light-green" id="addtransport"><i
                                            class="fa fa-check"></i> Add
                                          Vehicle</a>
                                      </div>
                                       <div id="name2" style="color:red"></div>
                                    </div>
                                  </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="col-sm-8">
                              <div class="panel panel-primary">
                                <div class="panel-heading">
                                  <h3 class="panel-title">Vehicle Details</h3>
                                </div>
                                <div class="panel-body" id="tranListBox">
                                <div class="row">
                                  <div class="form-group">
                                  </div>
                                  </div>
                                </div>
                              </div>
                              <script>
                               function isAlpha(evt) {
                                    evt = (evt) ? evt : window.event;
                                    var charCode = (evt.which) ? evt.which : evt.keyCode;
                                    if (charCode > 31 && (charCode < 48 || charCode > 57)) {

                                        return true;
                                    }
                                    return false;
                                }
                              </script>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="tab-pane fade" id="myTab_example5">
                  <div class="row">
                    <div class="col-md-12">
                      <div class="panel panel-primary">
                        <!--<div class="panel-heading">-->

                        <!--  <h3 class="panel-title">Define Transport</h3>-->
                        <!--</div>-->
                        <div class="panel-body">
                    <div class="alert btn-blue">
                    <button data-dismiss="alert" class="close">×</button>
                    <h3 class="media-heading text-center">Welcome to Define Transport Route and Amount</h3>
                  
                    <p class="media-timestamp">You will have to pay the cost to bring and leave your children according
                      to the
                      kilometer. You will also know the location of the bus by having GPS in the bus.</p>

                  </div>
                          <div class="row">

                            <div class="col-sm-12">
                              <div class="panel panel-white">
                                <div class="panel-heading panel-green">
                                  <h3 class="panel-title">Vehicle Configure</h3>
                                </div>
                                <div class="panel-body">
                                  <div class="form-group">
                                    <div class="col-sm-12">


                                      <?php
												$scode = $this->session->userdata("school_code");
												$sub = $this->db->query("SELECT * FROM transport where school_code='$scode'");
												if($sub->num_rows()>0){?>
                                      <div class="col-sm-12" style="margin-Bottom:20px;">
                                        <div class="col-md-4">
                                          <div class="row-form">
                                            <div class="col-md-5">
                                              <strong>Vehicle :</strong>
                                            </div>
                                            <div class="col-md-7">
                                                <select class="form-control" id="vehicle" name="vehicle" required="required">
                                                <option value=""> Select Vehicle</option>
                                                <?php 	foreach($sub->result() as $row):
												echo '<option value="'.$row->id.'">'.$row->vehicle_name."[".$row->vehicle_numnber."]".'</option>';
												endforeach;?>
                                              </select>
                                            </div>
                                          </div>
                                        </div>
                                        <div class="col-md-4">
                                          <div class="row-form">
                                            <div class="col-md-5">
                                              <strong>Pickup Points:</strong>
                                             </div>
                                            <div class="col-md-7"><input type="text" class="form-control text-uppercase" maxlength="40" minlength="2" id="vehicle_pickup" required/>
                                            </div>
                                          </div>
                                        </div>
                                        <div class="col-md-4">
                                          <div class="row-form">
                                            <div class="col-md-5">
                                              <strong>Drop Points:</strong></div>
                                            <div class="col-md-7"><input type="text" class="form-control text-uppercase" maxlength="40" minlength="2" id="drop_points" required/>
                                            </div>
                                          </div>
                                        </div>
                                      </div>
                                      <div class="col-sm-12">
                                        <div class="col-md-4">
                                          <div class="row-form">
                                            <div class="col-md-5">
                                              <strong>Vehicle Route:</strong></div>
                                            <div class="col-md-7"><input type="text" class="form-control text-uppercase" maxlength="40" minlength="2" id="vahicle_root" required/>
                                            </div>
                                          </div>
                                        </div>
                                        <div class="col-md-4">
                                          <div class="row-form">
                                            <div class="col-md-5">
                                              <strong>Transport Fee:</strong></div>
                                            <div class="col-md-7"><input type="text" class="form-control" maxlength="4" minlength="2" onkeypress="return isNumber(event)" id="transport_fee" required/>
                                            </div>
                                          </div>
                                        </div>
                                       
                                        <div class="col-md-4">
                                          <div class="row-form">
                                              <div class="col-md-5">
                                                    <select class="form-control" id="selfsd" name="selfsd" required="required">
                                                        <option value=""> Select FSD</option>
                                                        <?php 	$this->db->where("school_code",$school_code);
                                                        $fsdd = $this->db->get("fsd");
                                                        if($fsdd->num_rows()>0){
                                                        foreach($fsdd->result() as $row):
        												    echo '<option value="'.$row->id.'">'.$row->finance_start_date." TO ".$row->finance_end_date.'</option>';
        												endforeach; }?>
                                                      </select>
                                                  </div>
                                              <div class="col-md-7">
                                            <a href="#" class="btn btn-primary" id="addrootbutton"><i
                                                class="fa fa-check"></i>
                                              Save Route & Fee</a>
                                              </div>
                                          </div>
                                        </div>
                                      </div>

                                      <?php 	}
												else{
													echo "Define vehicle Details first";
												}
												?>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="row">
                            <div class="col-sm-12">
                              <div class="panel panel-white">
                                
                                <div class="panel-body table-responsive" id="roolist">
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <script>
                               function isAlpha(evt) {
                                    evt = (evt) ? evt : window.event;
                                    var charCode = (evt.which) ? evt.which : evt.keyCode;
                                    if (charCode > 31 && (charCode < 48 || charCode > 57)) {
                                        return true;
                                    }
                                    return false;
                                }
                                function isNumber(evt) {
                                    evt = (evt) ? evt : window.event;
                                    var charCode = (evt.which) ? evt.which : evt.keyCode;
                                    if (charCode > 31 && (charCode < 48 || charCode > 57)) {

                                        return false;
                                    }
                                    return true;
                                }
                              </script>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- end: INLINE TABS PANEL -->
    </div>
    </div>
  </div>
  </div>
  <!-- end: PAGE CONTENT