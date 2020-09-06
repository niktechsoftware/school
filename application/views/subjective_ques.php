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
</style>
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
						  </br>
						  
								<input type="file" id="myfile" name="image"><br><br>
									<input type="submit" value="Upload" class="btn btn-red">
										
												</form>
                           </br>
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
													<th>File Name</th>
													<th>Date</th>
													<th class="text-center">Delete</th> 
												</tr>
											</thead>
											<tbody>
											<tr>
											
												<?php $i=1;?>
												<?php $getsheet=$this->db->get('subjective_question');
												if($getsheet->num_rows()>0){
													foreach($getsheet->result() as $row):
												?>
												<td><?php echo $i;?></td>

												<td><?php echo $row->image ;?>
												<input type="hidden" name="dlt" id="rowid<?php echo $i;?>" value="<?php echo $row->id;?>"/></td>
												<td><?php echo $row->date; ?></td>
												
												<td class="text-center"><input type="button" value="Delete" id="dlt<?php echo $i; ?>" class="btn btn-danger"/></td>
												
											</tr>
																		<script >
																		$("#dlt<?php echo $i; ?>").click(function(){
																		var id =$('#rowid<?php echo $i;?>').val();
																		
																	   $.post("<?php echo site_url('index.php/examControllers/deletesheet') ?>",{id : id},function(data){
																		alert("deleted Successfully!!!!! ");
																		 $("#dlt<?php echo $i;?>").hide();
																		  window.location.reload();
																		 });
																	   }); 
																	</script>
												<?php $i++; endforeach; }?>
										
							
											</tbody>
										</table>
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
	 