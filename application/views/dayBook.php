<div class="row">
	<div class="col-md-12">
		<div class="panel">
			<div class="panel-heading panel-blue border-light">
				<h4 class="panel-title">Day Book Record </h4>
			</div>
			<div class="panel-body">
				<form action="<?php echo base_url();?>index.php/dayBookControllers/daybook"  method ="post" role="form" id="form">
			
				<div class="row"> 
					 <div class="col-md-12 space20">
            			 <div class="col-md-6">
            			 	<div class="col-md-3">
                   				 Start Date</div>
                   				 <div class="col-md-3">
                   				 <input type="date" data-date-format="yyyy-mm-dd" data-date-viewmode="years" class="form-control date-picker" name="st_date" style="width:180px; height:30px;" required/>
                   				</div>
                   		</div>
                   		<div class="col-md-6">
                    		 <div class="col-md-3">
                   				 End Date
                    		</div>
                			<div class="col-md-3">
                    			<input type="date" data-date-format="yyyy-mm-dd" data-date-viewmode="years" class="form-control date-picker" name="end_date" style="width:180px; height:30px;" required/>
                    		</div>
               			</div>               
               		</div>	 
            	</div>
            	<div class="row">
            		 <div class="col-md-12 space20">
            		 	<div class="col-md-2">
            		 			<input type="radio" name="check_list"  checked="checked" value="10" required="required">
                       			 All
                    	</div>
                     	<div class="col-md-2">
                        		<input type="radio" name="check_list" value="5" required="required">
                       			 Monthly Fee
                     	</div>
                     	<div class="col-md-2">
                        		<input type="radio" name="check_list" value="6" required="required">
                        		Stock Sale
                     	</div>
                     	<div class="col-md-2">
                        		<input type="radio" name="check_list" value="7" required="required">
                        		Bank Withdrawal
                        		<!--Recieve From Bank-->
                     	</div>
                    
                    </div>
                 </div>   	
                <div class="row">
            		 <div class="col-md-12 space20" >
            		 	<div class="col-md-2">
                        		<input type="radio" name="check_list" value="9" required="required">
                       			Receive From Director
                     	</div>
                     	<div class="col-md-2">
                       			<input type="radio" name="check_list" value="1" required="required">
                       			 Cash Payment[Expen.]
                     	</div>
                     	<div class="col-md-2">
                     			<input type="radio" name="check_list" value="2" required="required">
                        		Salary
                     	</div>
                     	<div class="col-md-2">
                        		<input type="radio" name="check_list" value="3" required="required">
                       			 Bank Deposits
                     	</div>
                     	<div class="col-md-3">
                        		<input type="radio" name="check_list" value="4" required="required">
                        		Handover To Director
                    	</div>
               		</div>
               		 <div class="row">
            		 <div class="col-md-12 space20" >
            		 <div style="color: red;"><?php echo $msg;?>
            		 </div>	
            		 </div>
                </div>
                </div>		
                
                <div class="row">
            		 <div class="col-md-6">
            		 	<div class="col-md-4">
                    			<input type="submit" name="dbd" value="Get Day Book Detail" class="submit btn btn-blue">
                    	</div>
                    </div>
                 </div>   	
           		 </form>
			</div>
		</div>
	</div>
	<div class="col-md-12">
		<div class="panel">
			<div class="panel-heading panel-blue border-light">
			<h4 class="panel-title">Day Book Account</h4>
			</div>
			<div class="panel-body">
				
           <div class="row">
           	<div class="col-md-12"> 
            	<div class="col-md-6">
            		<div class="form-group">
            			<H3 style="margin-left: 100px;">Debit</H3>
            		</div>
            		<div class="col-md-12">
            				<label class="control-label col-md-6">Opening Balance</label>
            			<div class="col-md-6">	
            			<input type="text"  value="<?php echo $opening?>" class="form-control" disabled="disabled"/>
            			</div>
            		</div>
            		<div class="col-md-12">
            				<label class="control-label col-md-6">Fee &amp; Admission</label>
            			<div class="col-md-6">
            			<input type="text"  value ="<?php echo $admin;?>" class="form-control" disabled="disabled"/>
            			</div>
            		</div>
            	<div class="col-md-12">
            				<label class="control-label col-md-6">Stock Sale</label>
            			<div class="col-md-6">
            			<input type="text"  value ="<?php echo $sale;?>" class="form-control" disabled="disabled"/>
            			</div>
            		</div>
            		<div class="col-md-12">
            				<label class="control-label col-md-6">Bank Withdrawal</label>
	                <div class="col-md-6">            				
            			<input type="text"  value="<?php echo $bankTransactionw;?>"  class="form-control" disabled="disabled"/>
            			</div>
            		</div>
            		<div class="col-md-12">
            				<label class="control-label col-md-6">Receive From Director</label>
            			<div class="col-md-6">		
            			<input type="text"  value="<?php echo $directorTransactionw;?>" class="form-control" disabled="disabled"/>
            			</div>
            		</div>
            		
            	</div>
            	 <div class="col-md-6">
            	 	<div class="form-group">
            	 		<H3 style="margin-left: 100px;">Credit</H3>
            		</div>
            	 	<div class="col-md-12">
            	 		    
            			<label class="control-label col-md-6">
            				<span>Closing Balance</span>
            			</label>
            			<div class="col-md-6">	
            			<input type="text"  value="<?php echo $closing?>" class="form-control" disabled="disabled"/>
            			</div>
            		</div>
            	<div class="col-md-12">
            				<label class="control-label col-md-6">Cash Payment</label>
            				<div class="col-md-6">	
            			<input type="text" value="<?php echo $cash;?>" class="form-control" disabled="disabled" />
            			</div>
            		</div>
            		<div class="col-md-12">
            			<label class="control-label col-md-6">Salary</label>
            			<div class="col-md-6">	
            			<input type="text"  value="<?php echo $salary;?>" class="form-control"  disabled="disabled"/>
            			</div>
            		</div>
            	<div class="col-md-12">
            				<label class="control-label col-md-6">Bank Deposits</label>
            				<div class="col-md-6">	
            			<input type="text" value="<?php echo $bankTransactiond;?>" class="form-control" disabled="disabled" />
            			</div>
            		</div>
            	<div class="col-md-12">
            				<label class="control-label col-md-6">Handover To Director</label>
            				<div class="col-md-6">	
            			<input type="text"  value="<?php echo $directorTransactiond;?>" class="form-control" disabled="disabled" />
            			</div>
            		</div>
            	</div>
            	</div>
            	</div>
           	</div>
      	</div>
  	</div>
</div>
      
     
