<?php $school_code = $this->session->userdata("school_code");?>
<form action="<?php echo base_url();?>index.php/enterStockController/saleStock"  method ="post" role="form" class="smart-wizard form-horizontal" id="form">
<div class="row">
	<div class="col-md-12">
	<!-- start: RESPONSIVE TABLE PANEL -->
		<div class="panel panel-white">
			<div class="panel-heading panel-orange">
				<i class="fa fa-external-link-square"></i>
					Enter Stocks here:
			</div>
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
							<a class="panel-refresh" href="#"> <i class="fa fa-refresh"></i> <span>Refresh</span> </a>
						</li>
						<li>
							<a class="panel-config" href="#panel-config" data-toggle="modal"> <i class="fa fa-wrench"></i> <span>Configurations</span></a>
						</li>
						<li>
							<a class="panel-expand" href="#"> <i class="fa fa-expand"></i> <span>Fullscreen</span></a>
						</li>
					</ul>
				</div>
			</div>
			<div class="panel-body"  >
<div class="alert alert-info"><h3 class="media-heading text-center">welcome to the sale stock area</h3><p class="media-timestamp">In this section you can purchase any time which is present in stock.
Note- firstly select- buyer id then fill seller id and select item no, quantity and discount if you want then click on save and print reciept button.</div>
				<div id="validId"></div>


				<div class="row space20">
					<div class="col-sm-4">
						<label class="col-sm-6 control-label">
							Select Buyer ID<span class="symbol required"></span>
						</label>

						<div class="col-sm-6">
							<select class="form-control" id="category" name="category" style="width: 160px;">
								<option value="01">Select Buyer</option>
								<option value="Student Id">Student ID</option>
								<option value="Employee Id">Employee ID</option>
								<option value="04">Other</option>
							</select>
						</div>
					</div>
					<div id="stud" class="col-sm-8">
						<label class="col-sm-6 control-label">
						Student ID<span class="symbol required"></span>
						</label>
						<div class="col-sm-6">
							<input type="text" class="form-control" id="studID" name="studID" style="width: 160px;" placeholder="Text Field">
						</div>
					</div>
					<div id = "emp" class="col-sm-8">
						<label class="col-sm-6 control-label">
							Employee ID  <span class="symbol required"></span>
						</label>
						<div class="col-sm-6">
							<input type="text" class="form-control" id="empID" name="empID" style="width: 160px;" placeholder="Text Field">
						</div>
					</div>
					<div id="nandp" class="col-sm-8">
						<label class="col-sm-2 control-label">
							Name<span class="symbol required"></span>
						</label>
						<div class="col-sm-4">
							<input type="text" class="form-control" id="empFirstName" name="empFirstName" placeholder="Text Field">
						</div>
						<label class="col-sm-2 control-label">
							Phone No.<span class="symbol required"></span>
						</label>
						<div class="col-sm-4">
							<input type="text" class="form-control" id="empphone" name="empphone"  placeholder="Text Field">
						</div>
					</div>
				</div>


				<div class="row" id="rahul23">
					<div class="col-md-12">
					<div class="panel-heading panel-grey">
							Product Information:
					</div>
					<table class="table table-hover">
						<thead>
	                        <tr class="text-uppercase">
	                           <th>SNO</th>
	                           <th class="text-center"><label>Item No</label></th>
	                         <!--   <th><label>Item Name</label></th> -->
	                           <th><label>Item Category</label></th>
	                           <th><label>Item Size</label></th>
	                           <th><label>Price/Item</label></th>
	                           <th><label>Remaining Item Quantity</label></th>
	                            <th><label>Purchase Item Quantity</label></th>
	                           <th><label>Discount(%)</label></th>
	                           <th><label>Discount Rs</label></th>
	                           <th><label>Total Price</label></th>
	                           <th><label>Sub Total</label></th>
	                        </tr>
	                    </thead>
	                    <tbody>
                        <?php $i = 1; for($i = 1; $i <= 15; $i++){ ?>
                            <?php if($i%2==0){$rowcss="danger";}else{$rowcss ="warning";}?>
                        <tr class="<?php echo $rowcss;?>">
                            <td width="40">
                                <strong><?php echo $i; ?></strong>
                             </td>
                             <td>
                                <select id="item_no<?php echo $i; ?>" name="item_no<?php echo $i; ?>" style="width:120px;">
                                    <option value="">-Item No-</option>
                                    <?php $item_no = mysqli_query($this->db->conn_id,"select * from enter_stock WHERE school_code = '$school_code' ORDER BY item_no"); ?>
                                    <?php while($no = mysqli_fetch_object($item_no)){                    ?>
                                 <option value="<?php echo $no->item_no; ?>"><?php echo strtoupper($no->item_name."[".$no->item_no."]"); ?></option>
                                     <?php } ?>
                                    </select>
                            </td>
                            <!-- <td>
                                  <input id="item_name<?php echo $i; ?>" name="item_name<?php echo $i; ?>" style="width:70px;">
                            </td> -->
                            <td>
                                  <input readonly id="item_cat<?php echo $i; ?>" class="text-uppercase" name="item_cat<?php echo $i; ?>" style="width:70px;">
                            </td>
                            <td>
                                  <input readonly id="item_size<?php echo $i; ?>" class="text-uppercase" name="item_size<?php echo $i; ?>" style="width:70px;">
                            </td>
                            <td>
                                   <input readonly id="item_price<?php echo $i; ?>"  class="text-uppercase" name="item_price<?php echo $i; ?>" style="width:70px;">
                            </td>
                            <td>
                             <input readonly id="item_quantity1<?php echo $i; ?>" class="text-uppercase" name="item_quantity1<?php echo $i; ?>" style="width:70px;" type="text"/>
                             </td>
                            <td>
                            	
                                <input id="item_quantity<?php echo $i; ?>" class="text-uppercase" name="item_quantity<?php echo $i; ?>" style="width:70px;" type="text"/>
                            </td>
                            <td>
                                <input id="item_discount<?php echo $i; ?>" class="text-uppercase"  name="item_discount<?php echo $i; ?>" style="width:70px;" type="text"/>
                            </td>
                            <td>
                                <input id="discount<?php echo $i; ?>"  class="text-uppercase" name="discount<?php echo $i; ?>" style="width:70px;" type="text"/>
                            </td>
                            <td>
                                  <input readonly id="total_price<?php echo $i; ?>" class="text-uppercase"  name="total_price<?php echo $i; ?>" style="width:70px;" type="text"/>
                            </td>
                            <td>
                                <input  readonly id="sub_total<?php echo $i; ?>" class="text-uppercase" name="sub_total<?php echo $i; ?>" style="width:70px;" type="text"/>
                            </td>
                       </tr>
                       <?php } ?>
                       <tr>
                            	<td colspan="3"><strong>Previous Balance</strong></td>
                                <td colspan="5"><input  readonly id="valid_id" name="p_balance" style="width:180px;" type="text"/></td>
                       </tr>
                       <tr>
                            	<td colspan="3"><strong>Total</strong></td>
                                <td colspan="5"><input id="total" name="tt" style="width:180px;" type="text" required /></td>
                       </tr>
                       <tr>
                            	<td colspan="3"><strong>Paid</strong></td>
                                <td colspan="5"><input id="paid" name="paid" style="width:180px;" type="text" required /></td>
                       </tr>
                       <tr>
                            	<td colspan="3"><strong>Balance</strong></td>
                                <td colspan="5"><input id="balance" name="balance" style="width:180px;" type="text" /></td>
                       </tr>
                      </tbody>
                  </table>


                  </div>
                  <div class="col-md-4">
                    			<input type="submit" id="submit" name="day_book_detail" value="Save & Print Reciept" class="submit btn btn-blue">
                    	</div>
              </div>

				</div>

			</div>
		</div>
	</div>
</form>