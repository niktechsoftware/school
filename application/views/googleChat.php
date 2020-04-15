<div id="main-wrapper" class="container">
					<div class="row">
						<div class="col-md-4">
							<div class="panel panel-yellow">
								<div class="panel-heading">
									<h3 class="panel-title">Chat List</h3>
								</div>
								<div class="panel-body panel-white">
									<?php
					            		$chatId = 1;
										$this->db->where("status",1);
										$a = $this->db->get("chat");
										$school_code= $this->session->userdata("school_code");
										foreach($a->result() as $row){
										    $this->db->where("school_code",$this->session->userdata("school_code"));
												$this->db->where("username",$row->chat_username);
												$val = $this->db->get("employee_info");
										if($val->num_rows()>0){
									?>
											<div class="row" style="padding:10px;">
												<div class="col-md-12">
													<a href="javascript:void(0);" id="chatClick1<?php echo $chatId;?>">
														<input type="hidden" id="chat1<?php echo $chatId;?>" value="<?php echo $row->chat_username;?>" />
														<input type="hidden" id="name1<?php echo $chatId;?>" value="<?php echo $val->row()->name;?>" />
														<input type="hidden" id="image1<?php echo $chatId;?>" value="<?php echo $val->row()->photo;?>" />
														<div class="row">
															<div class="col-md-2">
															 <img src="<?php echo $this->config->item('asset_url'); ?><?php echo $school_code;?>/images/empImage/<?php echo $this->session->userdata('logo'); ?>" alt="" style="width:60px; height:60px; padding:2px;" />
															</div>
															<div class="col-md-10">
																<span>
																	<?php echo $val->row()->username;?><br/>
																	<small><?php echo $val->row()->name;?></small>
															
																</span>
															</div>
														</div>
													</a>
												</div>
											</div>
									<?php
											$chatId++;
										//	}
										}
										}
									?>
									
									<script>
										<?php for($i = 1;$i< $chatId; $i++){ ?>
											$('#chatClick1<?php echo $i;?>').click(function(){
												var id = jQuery("#chat1<?php echo $i;?>").val();
												var name = jQuery("#name1<?php echo $i;?>").val();
											    $.post("<?php echo site_url('singleStudentControllers/getChatId') ?>", {id : id}, function(data){
											        //alert(data);
												var chatUrl = '<IFRAME SRC="https://appr.tc/r/'+data+'" allow="camera;microphone" style="border: 0px;" width="100%" height="600"></iframe>';
												
												$("#chatName1").html(name);
												$("#chatBody1").html(chatUrl);
											    });
											});
										<?php }?>
									</script>
								</div>
							</div>
						</div>
						<div class="col-md-8">
                                <div class="panel panel-yellow">
                                    <div class="panel-heading">
                                        <h3 class="panel-title" id="chatName1">No one Selected For Vedio Chat...</h3>
                                        <div class="panel-control">
                                            <a href="javascript:void(0);" data-toggle="tooltip" data-placement="top" title="Remove"><i class="icon-close" id="closeChatBody"></i></a>
                                        </div>
                                    </div>
                                    <div class="panel-body panel-white" id="chatBody1">
                                        <img src="<?php echo base_url();?>assets/images/vChat.png"/>
                                    </div>
                                </div>
						</div>
					</div>
					<script>
						$("#closeChatBody").click(function(){
							//alert();
							var v = '<img src="<?php echo base_url();?>assets/vChat.png"/>';
							$("#chatBody1").html(v);
						});
					</script>
</div><!-- Main Wrapper -->