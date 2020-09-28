 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <style>
  .form-group{
      margin-left:5%;
  }
  </style>
  <div class="row">
	<div class="col-md-12">
	<!-- start: RESPONSIVE TABLE PANEL -->
		<div class="panel">
			<div class="panel-heading panel-pink">
				<i class="fa fa-external-link-square"></i>
					Fee Structure Window
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
			</div>
 <div class="panel-body">
	<div class="panel panel-white">

        <div class="alert  panel-green">
          <h4 class="media-heading text-center">Welcome to Fee Structure </h4>
          <p class="media-timestamp">Welcome to Student Fee Card Area,
            in this page you can Create Students Fee Structure
            <strong>Please Fill following Details .</strong>
           

          </p>
        </div>
        <div>
            
          <div id="validId"></div>
<br/>
        <br/>  
        <?php if($fee->num_rows()>0){
         	 $i=1; foreach($fee->result() as $row):?>			   
         
          <div class="form-group">
                       <div class="container">
             
              <form class="form-inline" action="<?php echo base_url();?>index.php/login/feestru/<?php echo $row->id;?>" method="post">
                <div class="form-group">
                  <label for="email">Text Font</label>
                  <input type="text" class="form-control"  placeholder="<?php echo $row->font;?>" name="font">
                </div>
                <div class="form-group">
                  <label for="pwd"> Number of Rows</label>
                  <input type="text" class="form-control"  placeholder="<?php echo $row->number_of_row;?>" name="row">
                </div>
                <div class="form-group">
                  <label for="pwd"> Number Of Receipt</label>
                  <input type="text" class="form-control" placeholder="<?php echo $row->number_of_receipt;?>" name="receipt">
                </div>
                
                <button type="submit" class="btn btn-default" style="margin-left:4%;">Update</button>
              </form>
            </div>

          </div>
                 <?php $i++; ?>
                    <?php  endforeach; } else{?>
                   
       <div class="form-group">
                       <div class="container">
             
              <form class="form-inline" action="<?php echo base_url();?>index.php/login/feestru" method="post">
                <div class="form-group">
                  <label for="email">Text Font</label>
                  <input type="text" class="form-control"  placeholder="Enter Text Font" name="font">
                </div>
                <div class="form-group">
                  <label for="pwd">Enter Number of Rows</label>
                  <input type="text" class="form-control"  placeholder="Enter Number of Rows" name="row">
                </div>
                <div class="form-group">
                  <label for="pwd">Enter Number Of Receipt</label>
                  <input type="text" class="form-control" placeholder="Enter Number Of Receipt" name="receipt">
                </div>
                
                <button type="submit" class="btn btn-default" style="margin-left:4%;">Submit</button>
              </form>
            </div>

          </div>
        <?php }?>
          <div class="col-sm-12">
            <div class="table-responsive" id="rahul"></div><!-- end: table-responsive -->
          </div>
        </div><!-- end: panel Body -->
      </div><!-- end: panel panel-white -->
</div>
</div>
</div>
    </div><!-- end: MAIN PANEL COL-SM-12 -->
  </div><!-- end: PAGE ROW--></div><!--  end paig Container -->