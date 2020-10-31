<?php $school_code = $this->session->userdata("school_code");?>

<style>
table {
  font-family: arial, sans-serif;
  border-collapse: collapse;
  width: 100%;
  
}

td, th {
  border:  ;
  text-align: center;
  padding: 8px;
}

tr:nth-child(even) {
  background-color: #dddddd;
}
#demo {
  display: none;
}
</style>
<?php 	$this->db->where("id",$this->uri->segment("3"));
												$exammoded1 = $this->db->get("exam_mode");
												if($exammoded1->num_rows()>0){
												    $exammoded =$exammoded1->row();
												
												$this->db->where("id",$exammoded->class_id);
											$classname= 	$this->db->get("class_info");;
											
											$this->db->where("id",$exammoded->subject);
											$subject= 	$this->db->get("subject");;
												}else{
												    $subject=0;
												    $classname=0;
												}
											
												$this->db->where("exam_mode_id",$this->uri->segment("3"));
												
												$getsheet=$this->db->get('subjective_question');?>
<div class="row">
	<div class="col-md-12">
		<!-- start: RESPONSIVE TABLE PANEL -->
		<div class="panel panel-white">
			<div class="panel-heading panel-pink">
				<h4 class="panel-title"><span class="text-bold">Subjective Questions</span></h4>
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
								<a class="panel-refresh" href="#">
									<i class="fa fa-refresh"></i> <span>Refresh</span>
								</a>
							</li>
							<li>
								<a class="panel-config" href="#panel-config" data-toggle="modal">
									<i class="fa fa-wrench"></i> <span>Configurations</span>
								</a>
							</li>
							<li>
								<a class="panel-expand" href="#">
									<i class="fa fa-expand"></i> <span>Fullscreen</span>
								</a>
							</li>
						</ul>
					</div>
					<a class="btn btn-xs btn-link panel-close" href="#">
						<i class="fa fa-times"></i>
					</a>
				</div>
			</div>
						  <div class="panel-body">
							  <div class="alert panel-green">
								   <button data-dismiss="alert" class="close">×</button>
								   <h2 class="media-heading text-center">Welcome to Subjective Questions Area</h2>
							 </div>
							  <div class="alert alert-info"><h3>Subjective Paper For <?php echo $classname->row()->class_name;?> and <?php echo $subject->row()->subject;?> Subject</h3> </div>
						  </div>
						   <div class="row">
						
                    <div class="col-sm-6">
                      <div class="panel panel-calendar">
                        <div class="panel-heading panel-blue border-light">
                          <h4 class="panel-title">Upload File</h4>
                        </div>
                        <div class="panel-body">
                          <div class="text-black text-large">
                          <span id="message"></span>
                          <form action="<?php echo base_url();?>index.php/examControllers/submit_ques"  method ="post" enctype="multipart/form-data">
						  
						   <input type="hidden" name ="exam_mode_id" value ="<?php echo $this->uri->segment(3);?>" />
						   <?php for($i=1; $i<6;$i++){?>
							 <div class="col-sm-6">	<input type="file" id="myfile" name="image<?php echo $i;?>" accept="image/*" capture="camera">
							 </div>
							  <div class="col-sm-6">
									<input type="submit" value="Save Page <?php echo $i;?>" class="btn btn-red">
									</div>
									<br>
									<br>
							<?php }?>			
							</form>
                          
                            <div class="alert alert-warning"> Choose a file and upload that file.If file uploaded
                              successfully then it show in right side panel where you can change the file and Delete it.
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="panel panel-calendar">
                        <div class="panel-heading panel-red border-light">
                          <h4 class="panel-title">List</h4>
                        </div>
                        <div class="panel-body" id="streamList1">
							<table class="table table-responsive">
											<thead>
												<tr>
													<th>#</th>
													<th>Class</th>
													<th>Subject</th>
													<th>File Name</th>
													<th>Date</th>
													<th class="text-center">Delete</th> 
												</tr>
											</thead>
											<tbody>
										
											
												<?php $i=1;?>
												<?php 
											
												if($getsheet->num_rows()>0){
													$row=$getsheet->row();
													    for($i=1; $i<5;$i++){
													   $vb1= "image".$i;
													   if($row->$vb1){
												?>
												<tr>
												<td><?php echo $i;?>    <input type="hidden" id="rowf<?php echo $i;?>" value ="<?php echo $i;?>">   </td>
                                                <td><?php if($classname){echo $classname->row()->class_name;}?> </td>
                                                <td><?php if($subject){ echo $subject->row()->subject;}?></td>

												<td><a href="<?php echo base_url();?>assets/images/question_img/<?php echo $row->$vb1 ;?>" ><?php echo $row->$vb1 ;?></a>
												<input type="hidden" name="dlt" id="rowid<?php echo $i;?>" value="<?php echo $row->id;?>"/></td>
													<input type="hidden" name="img" id="img<?php echo $i ;?>" value="<?php echo $row->$vb1 ;?>"/></td>

												<td><?php echo $row->date; ?></td>
												
												<td class="text-center"><input type="button" value="Delete" id="dlt<?php echo $i; ?>" class="btn btn-danger"/></td>
												
										
																		<script >
																		$("#dlt<?php echo $i; ?>").click(function(){
																		var id =$('#rowid<?php echo $i;?>').val();
																		var img =$('#img<?php echo $i ;?>').val();

																			var rowg =$('#rowf<?php echo $i;?>').val();
																		//alert(rowg+id);

																	   $.post("<?php echo site_url('index.php/examControllers/deletesheet') ?>",{id : id , img : img ,rowg : rowg },function(data){
																		alert("deleted Successfully!!!!! ");
																		 $("#dlt<?php echo $i;?>").hide();
																		  window.location.reload();
																		 });
																	   }); 
																	</script>
																		</tr>

												<?php }; }}?>

										
							
											</tbody>
										</table>
									<?	if($exammoded1->num_rows()>0){?>
									  <div class="col-sm-12">
										 <div style="margin-left:80%;">  <button type="button"  onclick="myFunction()" class="btn btn-info" >View Demo</button>
                                      <div class="form-group" id="demo" >
                                          <form action="<?php echo base_url();?>index.php/examControllers/demoExamSubjective"  method ="post" role="form" class="smart-wizard form-horizontal" id="form">
                                              <input type="text" name="stu_id" id="stu_id" placeholder="Stundent Id ">
                                              <input type="hidden" name="exam_mode_id" value="<?php echo $this->uri->segment(3);?>">
                                             
                                              </br>
                                              <input  type="submit">
                                           </form>
                                    </div>       
                            </div>
                                  </div>
                                  <?php } ?>
                              <script>
function myFunction() {
  document.getElementById("demo").style.display = "block";
}
</script>
						</div>
                        </div>
												<div class="container">
                        <div class="alert alert-success">
                          You can <strong>Delete </strong>
                          file by Press delete Button.</div>
                      </div>
											</div>
                    </div>
                  </div>
						
						 	
		</div>	 
	</div>
</div>
	 