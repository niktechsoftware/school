<?php $school_code = $this->session->userdata("school_code");

?>
<div class="row" id="rahul23">
	<div class="col-md-12">
		<div class="panel-heading panel-grey">
				Product Information:
		</div>
		<table class="table table-hover">
			<thead>
				<tr>
                	<th>S.No.</th>
                    <th><label>Item No</label></th>
                    <th><label>Item Name</label></th>
                    <th><label>Item Category</label></th>
                    <th><label>Item Size</label></th>
                    <th><label>Price/Piece</label></th>
                    <th><label>Remaining Item Quantity</label></th>
                    <th><label>Purchase Item Quantity</label></th>
                    <th><label>Discount(%)</label></th>
                    <th><label>Discount Rs</label></th>
                    <th><label>Total Price</label></th>
                    <th><label>Sub Total</label></th>
				</tr>
			</thead>
	        <tbody>
                        <?php $i=1; foreach($billNo  as $row){ 
                          $this->db->where("school_code",$this->session->userdata("school_code"));
                        		$this->db->where('item_no',$row->item_no);
                        		$item = $this->db->get("enter_stock")->row();
                        ?>
                       <?php if($i%2==0){$rowcss="danger";}else{$rowcss ="warning";}?>
                        <tr class="<?php echo $rowcss;?>">
                            <td width="40">
                                <strong><?php echo $i; ?></strong>
                             </td>
                             <td>
    
                                    <?php $item_no = mysqli_query($this->db->conn_id,"select DISTINCT item_no from sale_info WHERE school_code = '$school_code' And bill_no='$row->bill_no' ORDER BY item_no");
                                   ?>  
                                    <?php $no = mysqli_fetch_object($item_no); ?>
                                    <input readonly id="item_no<?php echo $i; ?>"  class="text-uppercase" name="item_no<?php echo $i; ?>" value="<?php echo $no->item_no;?>" style="width:70px;">
                                   
                            </td>
                            <td>
                                  <input readonly id="item_name<?php echo $i; ?>"  class="text-uppercase" name="item_name<?php echo $i; ?>" value="<?php echo $item->item_name;?>" style="width:70px;">
                            </td>
                            <td>
                                  <input readonly id="item_cat<?php echo $i; ?>"  class="text-uppercase" name="item_cat<?php echo $i; ?>" value="<?php echo $item->item_cat;?>" style="width:70px;">
                            </td>
                            <td>
                                  <input readonly id="item_size<?php echo $i; ?>"   class="text-uppercase" name="item_size<?php echo $i; ?>" value="<?php echo $item->item_size;?>" style="width:70px;">
                            </td>
                            <td>
                                   <input readonly id="item_price<?php echo $i; ?>"  class="text-uppercase"  name="item_price<?php echo $i; ?>" value="<?php echo $row->pries_per_item;?>" style="width:70px;">
                            </td>
                            <td>
                              <input  readonly id="item_quantity1<?php echo $i; ?>"  value="<?php echo $item->item_quantity;?>" class="text-uppercase" name="item_quantity1<?php echo $i; ?>" style="width:70px;"/>
                              </td>
                            <td>
                            	<input name="old_item_quantity<?php echo $i; ?>"  value="<?php echo $row->item_quant;?>" type="hidden"/>
                             
                                <input id="item_quantity<?php echo $i; ?>"  class="text-uppercase" name="item_quantity<?php echo $i; ?>" value="<?php echo $row->item_quant;?>" style="width:70px;" type="text"/>
                            </td>
                            <td>
                                <input id="item_discount<?php echo $i; ?>"   class="text-uppercase" name="item_discount<?php echo $i; ?>" value="<?php echo $row->dis;?>" style="width:70px;" type="text"/>
                            </td>
                            <td>
                                <input id="discount<?php echo $i; ?>"  class="text-uppercase" name="discount<?php echo $i; ?>" value="<?php echo $row->dis_rs;?>" style="width:70px;" type="text"/>
                            </td>
                            <td>
                                  <input  readonly id="total_price<?php echo $i; ?>"  class="text-uppercase"  name="total_price<?php echo $i; ?>" value="<?php echo $row->total_price;?>" style="width:70px;" type="text"/>
                            </td>
                            <td>
                                <input  readonly id="sub_total<?php echo $i; ?>"  class="text-uppercase" name="sub_total<?php echo $i; ?>" value="<?php echo $row->sub_total;?>" style="width:70px;" type="text"/>
                            </td>
                       </tr>
                       <?php $i++;}?>
                      <?php 
                          $this->db->where("billno",$row->bill_no);
                          $this->db->where("valid_id",$row->valid_id);
                          $singleRow= $this->db->get("sale_balance")->row();
                       ?>
                       <tr>
                            	<td colspan="3"><strong>Total</strong></td>
                                <td colspan="5">
                                	<input name="old_total" id="old_total"  class="text-uppercase" value="<?php echo  $singleRow->total;?>" type="hidden"/>
                                	<input id="total" name="tt"   class="text-uppercase" style="width:180px;" value="<?php echo $singleRow->total;?>" type="text" required />
                                </td>
                       </tr>
                       <tr>
                            	<td colspan="3"><strong>Paid</strong></td>
                                <td colspan="5">
                                	<input name="old_paid"   class="text-uppercase" id="old_paid" value="<?php echo  $singleRow->paid;?>" type="hidden"/>
                                	<input id="paid" name="paid"   class="text-uppercase" style="width:180px;" value="<?php echo $singleRow->paid;?>" type="text" required /></td>
                       </tr>
                       <tr>
                            	<td colspan="3"><strong>Balance</strong></td>
                                <td colspan="5"><input id="balance"  class="text-uppercase" name="balance" style="width:180px;" value="<?php echo $singleRow->balance;?>" type="text" /></td>
                       </tr>
                      </tbody>
                  </table>
                  		
                           
                  </div>
                  		<div class="col-md-4">
                  			<input name="rows" value="<?php echo $i-1;?>" type="hidden"/>
                  			<!-- <input name="id_name" value="<?php echo $singleRow->id_name;?>" type="hidden"/> -->
                  			<input name="valid_id" value="<?php echo $singleRow->valid_id;?>" type="hidden"/>
                  		<!-- 	<input name="nam" value="<?php echo $singleRow->name;?>" type="hidden"/> -->
                  			<input name="phone_no" value="<?php echo $row->phone_no;?>" type="hidden"/>
                    		<input type="submit" id="submit" name="day_book_detail" value="Save & Print Reciept" class="submit btn btn-blue">
                    	</div>
              </div>
<script>
<?php $i = 1; foreach($billNo as $row){ ?>

$('select#item_no<?php echo $i; ?>').change(function(){
	var name = $('#item_no<?php echo $i; ?>').val();					
	$.post("<?php echo site_url("index.php/enterStockController/getTData") ?>", {name : name}, function(data){		
		var d = jQuery.parseJSON(data);				
		 $('#item_name<?php echo $i; ?>').val(d.itemName);
		 $('#item_cat<?php echo $i; ?>').val(d.itemCat);
         $('#item_quantity1<?php echo $i;?>').val(d.qunatity);
		 $('#item_size<?php echo $i; ?>').val(d.itemsize);
		 $('#item_price<?php echo $i; ?>').val(d.price);
	});
});


$('input#item_quantity<?php echo $i; ?>').keyup(
	function(){
		var a = 0;
		var name = $('#item_price<?php echo $i; ?>').val();
		var name1 = $('#item_quantity<?php echo $i; ?>').val();
	   var name2 = Number($('#item_quantity1<?php echo $i; ?>').val());
         if(name2>name1){
	     var total = name * name1;
       document.getElementById('total_price<?php echo $i; ?>').value=total;
       document.getElementById('sub_total<?php echo $i; ?>').value=total;
       $("#submit").show();
      }
     else
     {

        alert('Please update your stock');
        document.getElementById('total_price<?php echo $i; ?>').value=0;
       document.getElementById('sub_total<?php echo $i; ?>').value=0;
        $("#submit").hide();

         }
        });

$('input#item_discount<?php echo $i; ?>').keyup(
	function(){
		var name = $('#total_price<?php echo $i; ?>').val();
		var name1 = $('#item_discount<?php echo $i; ?>').val();
		
		var dis = (name1 * name)/100;
		var total = name - dis;
		document.getElementById('total_price<?php echo $i; ?>').value=name;
		document.getElementById('sub_total<?php echo $i; ?>').value=total;
		document.getElementById('discount<?php echo $i; ?>').value=dis;
});

<?php $i++; } ?>

$('input#total').focusin(function(){

var name = <?php for($i = 1 ; $i <= $count; $i++){ ?> Number($('#sub_total<?php echo $i;?>').val()) <?php if($i < $count){ echo "+";}  }?>;				
$("#total").val(name);
});

$('input#paid').focusin(function(){

	var name = $('#total').val();
	var name1 = $('#old_total').val();
	var a =  name - name1;				
	document.getElementById('paid').value=a;
	});

$('input#paid').keyup(
function(){
	var name = $('#paid').val();
	var name1 = $('#total').val();
	var a = name1 - name;				
	document.getElementById('balance').value=a;
});
</script>
						