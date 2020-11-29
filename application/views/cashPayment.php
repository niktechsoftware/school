<!-- start: PAGE CONTENT -->
<div class="row">
	<div class="col-sm-12">
		<!-- start: INLINE TABS PANEL -->
		<div class="panel panel-white">
			<div class="panel-heading">
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
							<a class="panel-expand" href="#"> <i class="fa fa-expand"></i> <span>Fullscreen</span></a>
						</li>										
					</ul>
					</div>
				</div>
			</div>
			<div class="panel-body">
				<div class="row">
					<div class="col-sm-12">
						<div class="tabbable">
							<ul id="myTab" class="nav nav-tabs">
								<li <?php if(($this->uri->segment(3) == "cash") || ($this->uri->segment(3) == "")) {?> class="active"<?php }?>>
									<a href="#myTab_example1" data-toggle="tab">
										<i class="green fa fa-money"></i> Cash Payment
									</a>
								</li>
								<li <?php if(($this->uri->segment(3) == "bank")) {?> class="active"<?php }?>>
									<a href="#myTab_example2" data-toggle="tab">
										<i class="green fa fa-bank"></i> Bank Transaction
									</a>
								</li>
								<li <?php if(($this->uri->segment(3) == "director")) {?> class="active"<?php }?>>
									<a href="#myTab_example3" data-toggle="tab">
										<i class="green fa fa-user"></i> Director Transaction
									</a>
								</li>
							</ul>
						<div class="tab-content">
							<div class="tab-pane fade<?php if(($this->uri->segment(3) == "cash") || ($this->uri->segment(3) == "")) {?> in active<?php }?>" id="myTab_example1">
								<div class="row">
									<div class="col-sm-12">
				                        <form method="post" action="<?php echo base_url()?>index.php/dayBookControllers/cashPaymentDb">
				                            <input type ="hidden"  name="heads" value="8"/>
				                        	<div class="panel panel-calendar">
												<div class="panel-heading panel-blue border-light">
													<h4 class="panel-title">Cash Payment</h4>
												</div>
												<div class="panel-body">
												    <div class="alert alert-info">
											<h4 class="center"><b>WELCOME TO THE CASH PAYMENT AREA</b></h4><br>
	                                    <center>  Here You Can Pay CASH Money For School Purpose .</center>

										</div>
										
				                      		<div class="col-sm-12 row">
				                      		 <div class="form-group">
										    	<div class="col-sm-6">
										        	<label class="col-sm-3"> Expenditure <span style="color:#F00">*</span></label> 
							                            <select id="expenditure" name="expenditure" class="col-sm-9" style="width:150px;" required>
							                                <option value="">-Expenditure-</option>
							                                <?php if($expenditureList->num_rows()>0){
							                                foreach($expenditureList->result() as $row):?>
							                                 <option value="<?php echo $row->id;?>"><?php echo $row->expenditure_name;?> </option>
							                                	
							                               <?php  endforeach;}?>
							                               
							                            </select>
							                            </div>

										    </div>
										    <div class="col-sm-6">
										     <div class="form-group">
										        <label class="col-sm-3" > Expenditure Depart <span style="color:#F00">*</span></label> 

						<select id="expenditurer" name="expenditurer" class="col-sm-9" style="width:150px;" required></select>


										    </div>
										    </div>
										 </div>
				                      	    <div class="col-sm-12 row">
				                      	 		<div class="form-group">
				                      	    		<div class="col-sm-6">
				                      	        		<label class="col-sm-3">Employee ID <span style="color:#F00">*</span></label> 
							                            	<select id="stu_emp_id" name="id_name" class="col-sm-9" style="width:150px;" required>
							                               		 	<option value="">- Select -</option>
							                                		<option value="Employee Id"> Employee Id </option>
							                               
							                                		<option value="other"> Other </option>
							                            	</select>
				                      	    	</div>
				                      	    	</div>
				                      	    <div class="form-group">
				                      	    		<div class="col-sm-6">
				                      	     			   
							                            	<label id="valid_id" class="col-sm-3">Enter Valid ID</label>
							                            	<input id="emp_id" name="emp_id" class="col-sm-9" style="width:150px;" type="text"/>
							                        
				                      	    		</div>
				                      	    	</div>
				                      	    </div>	
				                      	    <div clas="col-sm-12 row space20" id="Other_name">
				                      	    	 <div class="form-group">
				                      	    		<div class="col-sm-6">
				                      	        		<label class="col-sm-3">Name</label>
							                            <input id="name" name="name" class="col-sm-9" style="width:150px;" type="text"/>
							                          
				                      	    		</div>
				                      	    	</div>
				                      	    	 <div class="form-group">	
				                      	    		<div class="col-sm-6">
				                      	        		<label class="col-sm-3">Phone No</label>
							                            <input id="phone_no" name="phone_no" class="col-sm-9" style="width:150px;" type="text"/>
							                       
				                      	    		</div>
				                      	    	</div>
				                      	    </div>
				                      		<div class="col-sm-12 row space20">
				                      	 		<div class="form-group">
				                      				<div class="col-sm-6" id="check_valid_id"></div>
				                      
				                        			</div>
				                        			<div class="form-group">
				                      				<div class="col-sm-6" ></div>
				                      
				                        			</div>
				                        	</div>
				                         
				                         	    <div class="col-sm-12 row">
				                         	     <div class="form-group">
				                         	        <div class="col-sm-6">
				                         	         <label id="res" class="col-sm-3">Reason  <span style="color:#F00">*</span></label>
				                            			<textarea name="reason" class="col-sm-9" cols="20" rows="6" required></textarea>
				                            		
				                         	        </div>
				                         	        </div>
				                         	       <div class="form-group">
				                         	        <div class="col-sm-6">
				                         	            <label  class="col-sm-3">	Pay Date</label>
							                           
							                            <input class="col-sm-9"  name="paydate" style="width:150px;" type="date" required/>
				                        			
				                         	        </div>
				                         	        </div>
				                         	        </div>
				                         	        <div class="col-sm-12 row">
				                         	        	<div class="form-group">
				                         	        		<div class="col-sm-6">
				                         	            	<span id="balance"></span><br/>
							                            	<label class="col-sm-3" id="am" >Amount <span style="color:#F00">*</span></label>

							                           
				                        					<input id="amount" class="col-sm-9" name="amount" onkeyup="digitvalidation()"   style="width:150px;" type="text"  required > <span style="color:#F00" id="digit"></span>
				                        		
				                         	        	</div>
				                         	    	</div>
				                         		
				                         		    <div class="col-sm-6">
				                         		         <div class="form-group" style="margin-top:30px">
					                              	<div class="form-group" align="right">
					                              		<input class="submit btn btn-blue" type="submit" value="Save &amp; Print Slip" />
					                              	</div>
					                          </div>
				                         		    </div>
				                         		    
				                         		</div>
					                        
					                     </div>
					                    </div>
				                       	</form>
									</div>
								</div>
							</div>
							<!-- second tab-->
							<div class="tab-pane fade<?php if(($this->uri->segment(3) == "bank")) {?> in active<?php }?>" id="myTab_example2">
								<div class="row">
									<div class="col-sm-12">
										<?php if(($this->uri->segment(4) == "bankTrue")) {?>
										<div class="alert alert-success">
											<button data-dismiss="alert" class="close">
												&times;
											</button>
											<strong>Done!</strong> Bank Transaction record saved successfully... :)
										</div>
										<?php }elseif(($this->uri->segment(4) == "bankFalse")){?>
										<div class="alert alert-danger">
											<button data-dismiss="alert" class="close">
												&times;
											</button>
											<strong>Oh my god...!</strong> Somthing Wrong contact to Hwebs technologies... :(
										</div>
										<?php }elseif(($this->uri->segment(4) == "balanceFalse")){?>
										<div class="alert alert-danger">
											<button data-dismiss="alert" class="close">
												&times;
											</button>
											<strong>Oh my god...!</strong> Not enough balance avaliable in account.... <strong>Sorry...</strong> :(
										</div>
										<?php }?>
									
										<div class="panel panel-calendar">
											<div class="panel-heading panel-blue border-light">
												<h4 class="panel-title">Bank Transaction Detail</h4>
											</div>
											<div class="panel-body">
											     <div class="alert alert-info">
											<h4 class="center"><b>WELCOME TO THE BANK TRANSACTION AREA</b></h4><br>
	                                    <center>  Here You Can Maintain bank Related Transaction's Entries .</center>
										</div>
												<form method="post" action="<?php echo base_Url()?>index.php/dayBookControllers/directorTransaction">
					                            <div class="form-group">
					                              	<div class="form-group" align="center">
					                              	 <input type ="hidden"  name="heads" value="6"/>
					                              	    <div class="col-sm-12">
					                              	    <div class="col-sm-6">
					                              	    <a href="<?php echo base_Url()?>dayBookControllers/transactionDetail/bank/deposit" class="submit btn btn-blue">
						                                        		Previous Deposits
						                                        	</a>    
					                              	    
					                              	    </div>
					                              	    <div class="col-sm-6">
					                              	        	<a href="<?php echo base_Url()?>dayBookControllers/transactionDetail/bank/withdrwal" class="submit btn btn-blue">
						                                        		Previous Withdrawal
						                                        	</a>
					                              	    </div>
					                              	   
					                                </div>	
					                                </div>
					                       		</div>
					                       		<div class=col-sm-12>
					                       		<div class=col-sm-3>
					                       		    	<label>Bank Transaction</label> &nbsp;&nbsp;&nbsp; <br>
							                            <select name="action_transaction" style="width:150px;" required>
							                                <option value="">-Select Transaction-</option>
							                                <option value=0> Deposits </option>
							                                <option value=1> Withdrawal </option>
							                            </select>
					                       		</div>
					                       		<div class=col-sm-3>
					                       		    <label>Bank Name</label> &nbsp;&nbsp;&nbsp;<br>
							                            <input name="bank_nm" style="width:150px;" type="text" required/>
					                       		</div>
					                       		<div class=col-sm-3>
					                       		    	<label>Account No.</label> &nbsp;&nbsp;&nbsp;<br>

							                        <!--    <input name="account_no" name="amount" id="amount3" pattern="[0-9]" onkeyup="digitvalidation3()" style="width:200px;" type="text" required/><span style="color:#F00" id="digit3"></span>-->
							                           <input name="accountno"  id="amount3"   style="width:200px;" type="number" required/><span style="color:#F00" id="digit3"></span>
							                       
					                       		</div>
					                       		<div class=col-sm-3>
					                       		    	<span id="balance1"></span><br/>
							                            <label>Amount<span style="color:#F00">*</span></label> &nbsp;&nbsp;&nbsp;<br>
							                            <!--<input name="amount" id="amount1" pattern="[0-9]" onkeyup="digitvalidation1()" style="width:200px;" type="text" required /><span style="color:#F00" id="digit1"></span>-->

							                            <input name="amount" id="amount1" onkeyup="digitvalidation1()"  style="width:200px;" type="text" required /><span style="color:#F00" id="digit1"></span>
							                        
					                       		</div>
					                       		</div>
					                          
							                       <div class="col-sm-12">
							                           <div class="col-sm-3">
							                              
							                           	 	<label>Cheque / Trasaction Number *</label> &nbsp;&nbsp;&nbsp;<br>
							                            	<input name="name" style="width:200px;" type="text" required="required" />
							                       	 	 
							                           </div>
							                           <div class="col-sm-3">
							                               
							                           	 	<label>Remark *</label> &nbsp;&nbsp;&nbsp;<br>
							                           	 	<textarea rows="3" name="remark" style="width:200px;" cols="6" required="required"></textarea>
							                            	
							                           </div>
							                       </div>
							                         <div class="col-sm-3">
						                         <div class="form-group" style="margin-top:30px">
					                              	<div class="form-group" align="right">
					                              		<input class="submit btn btn-blue" type="submit" value="Save to School Record" />
					                        		</div>
					                        		</div>
												</div>
					                       		</form>
											</div>
										</div>
									</div>
								</div>
							</div>
						
						<!-- third tab-->
							<div class="tab-pane fade<?php if(($this->uri->segment(3) == "director")) {?> in active<?php }?>" id="myTab_example3">
								<div class="row">
									<div class="col-sm-12">
										<?php if(($this->uri->segment(4) == "directorTrue")) {?>
										<div class="alert alert-success">
											<button data-dismiss="alert" class="close">
												&times;
											</button>
											<strong>Done!</strong> Director Transaction record saved successfully... :)
										</div>
										<?php }elseif(($this->uri->segment(4) == "directorFalse")){?>
										<div class="alert alert-danger">
											<button data-dismiss="alert" class="close">
												&times;
											</button>
											<strong>Oh my god...!</strong> Somthing Wrong contact Niktech Software Solutions... :(
										</div>
										<?php }elseif(($this->uri->segment(4) == "balanceFalse")){?>
										<div class="alert alert-danger">
											<button data-dismiss="alert" class="close">
												&times;
											</button>
											<strong>Ooops...!</strong> Not enough balance avaliable in account.... <strong>Sorry...</strong> :(
										</div>
										<?php }?>
									
									
										 <form method="post" action="<?php echo base_Url()?>index.php/dayBookControllers/directorTransaction">
										 	  <input type ="hidden"  name="heads" value="7"/>
										 	<div class="panel panel-calendar">
												<div class="panel-heading panel-blue border-light">
													<h4 class="panel-title">Director Transaction Detail</h4>
												</div>
												<div class="panel-body">
												     <div class="alert alert-info">
											<h4 class="center"><b>WELCOME TO THE DIRECTOR TRANSACTION AREA</b></h4><br>
	                                          <center>In This Area Director Can Withdraw Money in Emergency Case And Also Can Deposit Money .</center> 
										</div>
					                        		<div class="form-group">
						                              	<div class="form-group" align="center">
						                                <div class="col-sm-12">
						                                    <div class="col-sm-6">
							                                        	<a href="<?php echo base_Url()?>dayBookControllers/transactionDetail/director/deposit" class="submit btn btn-blue">
							                                        		Previous Deposits
							                                        	</a>
							                                       </div>
							                                       <div class="col-sm-6">
							                                        	<a href="<?php echo base_Url()?>dayBookControllers/transactionDetail/director/withdrwal" class="submit btn btn-blue">
							                                        		Previous Received
							                                        	</a>
							                                        </div>							                                	</tr>
						                                 
						                                </div>
						                                </div>
						                       		</div> 
						                             <div class="col-sm-12">
						                                 <div class="col-sm-3">
						                                 <label id="action">Action <span style="color:#F00">*</span></label> &nbsp;&nbsp;&nbsp; 
							                            		<select name="action_transaction" required="required" "width:120px;">
								                               		<option value="">-select one-</option>
								                                	<option value=0>Handover to Director</option>
								                               		<option value=1>Received from Director</option>
							                           			</select> 
						                                 </div>
						                                  <div class="col-sm-3">
						                                  <label>Bank Name</label> &nbsp;&nbsp;&nbsp;<br>
							                            <input name="bank_nm" style="width:150px;" type="text" required/>
						                                 </div>
						                                  <div class="col-sm-3">
						                                 	<label>Account No.</label> &nbsp;&nbsp;&nbsp;<br>

							                        <!--    <input name="account_no" name="amount" id="amount3" pattern="[0-9]" onkeyup="digitvalidation3()" style="width:200px;" type="text" required/><span style="color:#F00" ></span>-->
							                           <input name="accountno"  id="amount4" style="width:200px;" type="number" required/><span style="color:#F00" id="digit4"></span>
							                       
						                                 </div>
						                                  <div class="col-sm-3">
						                                 	<span id="balance3"></span><br/>
							                            <label>Amount<span style="color:#F00">*</span></label> &nbsp;&nbsp;&nbsp;<br>
							                            <!--<input name="amount" id="amount1" pattern="[0-9]" onkeyup="digitvalidation1()" style="width:200px;" type="text" required /><span style="color:#F00" id="digit1"></span>-->

							                            <input name="amount" id="damt" onkeyup="digitvalidation3()"  style="width:200px;" type="text" required /><span style="color:#F00" id="errorid"></span>
							                   
						                                 </div>
						                             </div>
							                             		
							                            <div class ="col-sm-12">
							                                 <div class="col-sm-3">
							                                     	<label>Handover/Receive by Name</label> &nbsp;&nbsp;&nbsp;<br>
									                            <input name="name" style="width:200px;" type="text"/>
							                                     </div>
							                                 <div class="col-sm-3">
							                         <label>Description</label> &nbsp;&nbsp;&nbsp;<br>
									                            <textarea rows="5" cols="12" name="disc" style="width:200px;" type="text"> </textarea> 
							                                     </div>
							                                 <div class="col-sm-3">
							                                     <div class="form-group" style="margin-top:30px">
							                         	<div class="form-group" align="right">
							                            	<input class="submit btn btn-blue" type="submit" value="Save to School Record" />
							                           	</div>
							                        </div>
							                                     </div>
							                            </div>
									                    
							                     </div>
							                 </div>
					                	</form>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- end: INLINE TABS PANEL -->
		</div>
	</div>
</div>


<script>
													function digitvalidation()
                            {
                                var text_value = document.getElementById("amount").value;
                                if (!text_value.match(/[0-9]$/))
                                {
                                    document.getElementById("digit").innerHTML = "&nbsp&nbsp&nbspEnter Digit Only";
                                    if(text_value=="")
                                    {
                                    document.getElementById("digit").innerHTML = " ";
                                    }
                                }
                            }
						

						
													function digitvalidation1()
                            {
                                var text_value = document.getElementById("amount1").value;
                                if (!text_value.match(/[0-9]$/))
                                {
                                    document.getElementById("digit1").innerHTML = " &nbsp&nbsp&nbsp Enter Digit Only";
                                    if(text_value=="")
                                    {
                                    document.getElementById("digit1").innerHTML = " ";
                                    }
                                }
                            }
							function digitvalidation3()
                            {
                                var text_value = document.getElementById("damt").value;
                                if (!text_value.match(/[0-9]$/))
                                {
                                    document.getElementById("errorid").innerHTML = " &nbsp&nbsp&nbspEnter Digit Only";
                                    if(text_value=="")
                                    {
                                    document.getElementById("errorid").innerHTML = " ";
                                    }
                                }
                            }

						
													function digitvalidation2()
                            {
                                var text_value = document.getElementById("amount2").value;
                                if (!text_value.match(/[0-9]$/))
                                {
                                    document.getElementById("digit2").innerHTML = " &nbsp&nbsp&nbspEnter Digit Only";
                                    if(text_value=="")
                                    {
                                    document.getElementById("digit2").innerHTML = " ";
                                    }
                                }
                            }
					

							</script>
