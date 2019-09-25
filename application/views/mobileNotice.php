<?php $school_code = $this->session->userdata("school_code");?>
<div class="row">
	<div class="col-md-12">
	<!-- start: RESPONSIVE TABLE PANEL -->
		<div class="panel panel-white">
			<div class="panel-heading panel-orange">
				<i class="fa fa-external-link-square"></i>
				Send Message:
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
<!-- -------------------------------------------------------- Msg part ------------------------------------------------ -->
                  <?php
if($this->uri->segment(3) == 'Notice'){ ?>
<div class="alert alert-info">
          <button data-dismiss="alert" class="close">×</button>
          <h3 class="media-heading text-center">Welcome to Notice Area</h3>
         This is the area you can send message to a particular Parent or Mobile number.
                     If you want to add more than one number Please use Comma.<br>
                    <strong>For Example: (9889599---,898900---,78000-----)</strong><br>
                    you can also see your credit SMS Balance . you can also see Number of Character in your message and Number of 
                     Unit SMS<br><strong> (where 1 Unit = 140 SMS Character)</strong>
        </div>
                    
                    <p class="alert alert-danger"> Available SMS Balance = <?php echo $cbs;?></p>
                    
                     <form method="post" action="<?php echo base_url();?>index.php/smsAjax/sendNotice">
                      <div>  </div>
                     <table class="table">
                     	<tr>
                     		<td>Mobile Number : </td>
                     		<td>
                            	<input type="hidden" name="section" value="Notice" />
                            	<input type="text" name="m_number" id="inputStandard" class="form-control" placeholder="Mobile Number"/>
                            </td>
                            <td> <select class="form-control"  name="language" style="width: 200px;" required="required">
                               
                               
                                <option value="1">GENRAL[English]</option>
                                
                                <option value="2">HINDI[Unicode Hindi]</option>
                              </select>
                            </td>
                     	</tr>
                     	<tr>
                     		<td >Message : </td>
                     		<td colspan="2"><textarea name="meg" class="form-control" id="textArea" rows="5"></textarea></td>
                     	</tr>
                     	<tr>
                     		<td colspan="2">
                     			<input type="submit" name="Send_Message" value="Send Message" class="btn btn-dark-purple" />
                     		</td>
                     	</tr>
		     		</table>
                    </form>
<?php }
elseif($this->uri->segment(3) == 'Parent%20Message'){ ?>
 <div class="alert alert-info">
          <button data-dismiss="alert" class="close">×</button>
          <h3 class="media-heading text-center">Welcome to Parent Message Area</h3>
        This is the area where you are able to send message to all parents. Type the message in textbox and press send button.
                    you can also see your credit SMS Balance . you can also see Number of Character in your message and Number of 
                     Unit SMS<br><strong> (where 1 Unit = 140 SMS Character)</strong>
        </div>
        <?php 
      	$query = $this->smsmodel->getAllFatherNumber($this->session->userdata("school_code"));
        ?>
            <p class="alert alert-danger"> Available SMS Balance = <?php echo $cbs;?><br>Available Contacts of Parents to send SMS=<?php echo $query->num_rows();?> + 1 SMS for admin</p>
           
            <?php
					// if(!($auth->parent_message == 'yes')){
						//echo '<font color=" color="#FF0000">Parent Message Not Activated. Please activat it first, from SMS setting.</font>';
					// }
					 ?>
            <form method="post" action="<?php echo base_url();?>index.php/smsAjax/sendallParent">
          <?php $totmsg=$this->uri->segment(4);
          if($totmsg)
          		{
					?><div class="alert alert-success">You have sent successfuly <?php echo $totmsg;?> SMS</div>
          		<?php }
          			?> 
                     <table class="table">
                      <tr><td>Select Language</td><td><select class="form-control"  name="language" style="width: 200px;" required="required">
                               
                               
                                <option value="1">GENRAL[English]</option>
                                
                                <option value="2">HINDI[Unicode Hindi]</option>
                              </select></td></tr>
                     	<tr>

                     		<td>Message : </td>
                     		<td>
                            	<input type="hidden" name="section" value="Parent Message" />
                            	<textarea name="meg" class="form-control" id="textArea" rows="5"></textarea>
                             </td>
                     	</tr>
                     	<tr>
                     		<td colspan="2">
                     			<input type="submit" name="Send_Message" value="Send Message" class="btn btn-dark-purple" />
                     		</td>
                     	</tr>
		     </table>
             </form>
<?php } 
elseif($this->uri->segment(3) == 'Announcement'){ ?>
<div class="alert alert-info">
          <button data-dismiss="alert" class="close">×</button>
          <h3 class="media-heading text-center">Welcome to Announcement Area</h3>
       This is the area you are able to send Announcement to <strong>all Employee and Teacher</strong>. Type the message in textbox and press send button.
                    you can also see your credit SMS Balance . you can also see Number of Character in your message and Number of 
                     Unit SMS<br><strong> (where 1 Unit = 140 SMS Character)</strong>
        </div>
         <?php 
        	$this->db->where("school_code",$school_code);
		$this->db->where("status",1);
		$result = $this->db->get("employee_info");
	//	$a= $result->result();
	//	print_r($a);
        ?>
			<p class="alert alert-danger"> Available SMS Balance = <?php echo $cbs;?><br>Available Contacts of Employees to send SMS =<?php echo $result->num_rows();?> + 1 SMS for admin </p>
            <?php
					 //if(!($auth->announcement == 'yes')){
						// echo '<font color=" color="#FF0000">Announcement Not Activated. Please activat it first, from SMS setting.</font>';
					 //}
					 ?>
             <form method="post" action="<?php echo base_url();?>index.php/smsAjax/sendAnnuncement">
                    
                      <?php $totmsg=$this->uri->segment(4);
          if($totmsg)
          		{
					?><div class="alert alert-success">You have sent successfuly <?php echo $totmsg;?> SMS</div>
          		<?php }
          			?> 
                     <table class="table">
                     	<tr>
                         <tr><td>Select Language</td><td><select class="form-control"  name="language" style="width: 200px;" required="required">
                               
                               
                                <option value="1">GENRAL[English]</option>
                                
                                <option value="2">HINDI[Unicode Hindi]</option>
                              </select></td></tr>
                      
                     		<td>Message : </td>
                     		<td>
                            	<input type="hidden" name="section" value="Announcement" />
                            	<textarea name="meg" class="form-control" id="textArea" rows="5"></textarea>
                            </td>
                     	</tr>
                     	<tr>
                     		<td colspan="2">
                     			<input type="submit" name="Send_Message" value="Send Message" class="btn btn-dark-purple" />
                     		</td>
                     	</tr>
		     </table>
             </form>
<?php } 
elseif($this->uri->segment(3) == 'Greeting'){ ?>
<div class="alert alert-info">
          <button data-dismiss="alert" class="close">×</button>
          <h3 class="media-heading text-center">Welcome to Greeting Area</h3>
        This is the area you are able to send Greeting to all Student and Employee and Parents Type the message in textbox and press send button.
                    you can also see your credit SMS Balance . you can also see Number of Character in your message and Number of 
                     Unit SMS . <br><strong> (where 1 Unit = 140 SMS Character)</strong>
        </div>
			 <p class="alert alert-danger"> Available SMS Balance = <?php echo $cbs;?><br>Available Contacts to send SMS =<?php //echo $result->num_rows();?></p>
            
           
            <?php
					 //if(!($auth->greeting == 'yes')){
						 //echo '<font color=" color="#FF0000">Greeting Not Activated. Please activat it first, from SMS setting.</font>';
					 //}
					 ?>
            <form method="post" action="<?php echo base_url();?>index.php/smsAjax/sendGreeting">
                     <?php $totmsg=$this->uri->segment(4);
          if($totmsg)
          		{
					?><div class="alert alert-success">You have sent successfuly <?php echo $totmsg;?> SMS</div>
          		<?php }
          			?> 
                     <table class="table">
                     	<tr>
                         <tr><td>Select Language</td><td><select class="form-control"  name="language" style="width: 200px;" required="required">
                               
                               
                                <option value="1">GENRAL[English]</option>
                                
                                <option value="2">HINDI[Unicode Hindi]</option>
                              </select></td></tr>
                      
                     		<td>Message : </td>
                     		<td>
                            	<input type="hidden" name="section" value="Greeting" />
                            	<textarea name="meg" class="form-control" id="textArea" rows="5"></textarea>
                            </td>
                     	</tr>
                     	<tr>
                     		<td colspan="2">
                     			<input type="submit" name="Send_Message" value="Send Message" class="btn btn-dark-purple" />
                     		</td>
                     	</tr>
		     </table>
            </form>
<?php } 
elseif($this->uri->segment(3) == 'classwise'){ ?>
<div class="alert alert-info">
          <button data-dismiss="alert" class="close">×</button>
          <h3 class="media-heading text-center">Welcome to Classwise Message Area</h3>
       This is the area you are able to send Message Class Wise to Student . select the section and then class.Type the message in textbox and press send
                    you can also see your credit SMS Balance . you can also see Number of Character in your message and Number of 
                     Unit SMS . <br><strong> (where 1 Unit = 140 SMS Character)</strong>
        </div>
		<!--	<p class="alert alert-info"> This is the area you are able to send Message Class Wise to Student . select the class and Type the message in textbox and press send.</p>-->
             <p class="alert alert-danger"> Available SMS Balance = <?php echo $cbs;?></p>
           
            <?php
					 //if(!($auth->greeting == 'yes')){
						 //echo '<font color=" color="#FF0000">Greeting Not Activated. Please activat it first, from SMS setting.</font>';
					 //}
					 ?>
            <form method="post" action="<?php echo base_url();?>index.php/smsAjax/classwise">
                     <?php $totmsg=$this->uri->segment(4);
          if($totmsg)
          		{
					?><div class="alert alert-success">You have sent successfuly <?php echo $totmsg;?> SMS</div>
          		<?php }
          			?> 
                     <table class="table">
                     	<tr>
                     	
                     	<tr>
                     		<td><strong>Select Section</strong> </td>
                     		<td> <?php $classname = $this->db->query("SELECT DISTINCT section FROM class_info WHERE school_code='$school_code'")->result();
																	 ?>
													<select class="form-control" id="class" name="section" style="width: 160px;">
												<option value="no">-Select Section-</option>
												<?php foreach($classname as $row):
												$this->db->where("id",$row->section);
												$try = $this->db->get("class_section")->row();
												?>
													<option value="<?php echo $try->id;?>"><?php echo $try->section;?></option>
													
													<?php endforeach; ?>
													<option value="0">All</option>
												</select>		
														</td>
														
							<td><strong>Select Class</strong> </td>
                     		<td> 				
													<select class="form-control" id="section" name="class" style="width: 160px;">
														</select>
														</td>							
                     	</tr>
                       <tr><td>Select Language</td><td><select class="form-control"  name="language" style="width: 200px;" required="required">
                               
                               
                                <option value="1">GENRAL[English]</option>
                                
                                <option value="2">HINDI[Unicode Hindi]</option>
                              </select></td></tr>
                      
                     	<tr>
                     		<td>Message : </td>
                     		<td>
                            	
                            	<textarea name="meg" class="form-control" id="textArea" rows="5"></textarea>
                            </td>
                     	</tr>
                     	<tr>
                     		<td colspan="2">
                     			<input type="submit" name="Send_Message" value="Send Message" class="btn btn-dark-purple" />
                     		</td>
                     	</tr>
		     </table>
            </form>
<?php } 
elseif($this->uri->segment(3) == 'transportwise'){ ?>
			<p class="alert alert-info"> This is the area you are able to send Message Vehicle Wise to Student . select the Vehicle and Type the message in textbox and press send.</p>
             <p class="alert alert-danger"> Available SMS Balance = <?php echo $cbs;?></p>
           
            <form method="post" action="<?php echo base_url();?>index.php/smsAjax/transportwise">
                     <?php $totmsg=$this->uri->segment(4);
          if($totmsg)
          		{
					?><div class="alert alert-success">You have sent successfuly <?php echo $totmsg;?> SMS</div>
          		<?php }
          			?> 
                     <table class="table">
                     	<tr>
                     		<td><strong>Select Vehicle</strong> </td>
                     		<td> <?php
												$scode = $this->session->userdata("school_code");
												$sub = $this->db->query("SELECT * FROM transport where school_code='$scode'");
												if($sub->num_rows()>0){?>
												  <div>
														<select class="form-control" id="vehicle"
															name="vehicle" required="required">
															<option value=""> Select vehicle</option>
															<?php 	foreach($sub->result() as $row):

															echo '<option value="'.$row->id.'">'.$row->vehicle_name."[".$row->vehicle_numnber."]".'</option>';
															endforeach;?>
														</select>
													</div>
											<?php } ?>
														</td>
                     	</tr>
                     	<tr>
                     		<td>Message : </td>
                     		<td>
                            	
                            	<textarea name="meg" class="form-control" id="textArea" rows="5"></textarea>
                            </td>
                     	</tr>
                     	<tr>
                     		<td colspan="2">
                     			<input type="submit" name="Send_Message" value="Send Message" class="btn btn-dark-purple" />
                     		</td>
                     	</tr>
		          </table>
              </form>

												<?php }

?>
<!-- -------------------------------------------------------- End msg part -------------------------------------------- -->
                   <table>
          <tr>
          <td style="color:red;"><b>Number Of Character=</b></td>
          <td id="totalCharacter" style="color: green"></td>
          </tr>
          <tr>
          <td style="color:red;"><b>Number Of SMS Unit=</b></td>
          <td id="totalCharacter1" style="color: green"></td>
          </tr>
          </table> 
		     </div>
		</div>
	</div>
</div>
</form>