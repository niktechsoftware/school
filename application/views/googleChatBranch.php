<div id="main-wrapper" class="container">
					<div class="row">
						<!-- 
						<div class="col-md-4">
							<div class="panel panel-yellow">
								<div class="panel-heading">
									<h3 class="panel-title">Chat List</h3>
								</div>
								<div class="panel-body panel-white">
								
								</div>
							</div>
						</div>
						 -->
						<div class="col-md-12">
						    
     
    
                                <div class="panel panel-yellow">
                                    <div class="panel-heading">
                                        <h3 class="panel-title" id="chatName1">No one Selected For Vedio Chat...</h3>
                                        <div class="panel-control">
                                            <a href="javascript:void(0);" data-toggle="tooltip" data-placement="top" title="Remove"><i class="icon-close" id="closeChatBody"></i></a>
                                        </div>
                                    </div>
                                  <?php  $id= $this->session->userdata("username");
                                  $data = date("Y-m-d");
                                  $cid = date("dmy",strtotime($data));
                                  $randam = rand(9999,99999) ;
                                  $chatid =$cid."s".$randam;
                                  $fgdata['chat_id']=$chatid;
                                  $this->db->where("chat_username",$id);
                                  $this->db->update("chat",$fgdata);
                                  ?>
                                  
                                    <div class="panel-body panel-white" id="chatBody1">
                                        <IFRAME SRC="https://appr.tc/r/<?php echo $chatid;?>" allow="camera;microphone" style="border: 0px;" width="100%" height="600"></IFRAME>
                                    </div>
                                </div>
						</div>
					</div>
					<script src="<?php echo base_url()?>assets/plugins/jquery/jquery-2.1.3.min.js"></script>
					<script>
						$("#closeChatBody").click(function(){
							//alert();
							var v = '<img src="<?php echo base_url();?>assets/vChat.png"/>';
							$("#chatBody1").html(v);
						});
					</script>
</div><!-- Main Wrapper -->