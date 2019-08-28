<style type="text/css">
    #printable { display: block; }
    @media print
    {
    	#non-printable { display: none; }
    	#printable { display: block; }
    }
</style>
<script>
    function autoResize(id){
        var newheight;
        var newwidth;

		if(document.getElementById)
		{
            newheight=document.getElementById(id).contentWindow.document .body.scrollHeight;
            newwidth=document.getElementById(id).contentWindow.document .body.scrollWidth;
        }

        document.getElementById(id).height= (newheight) + "px";
        document.getElementById(id).width= (newwidth) + "px";
    }
</script>
<!-- start: PAGE CONTENT -->
<div class="row">
	<div class="col-sm-12">
		<!-- start: INLINE TABS PANEL -->
		<div class="panel panel-white">
			<div class="panel-heading panel-pink">
			    <h3 class="panel-title">Fee <span class="text-bold">Invoice</span></h3>
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
					<div class="col-sm-12 embed-responsive embed-responsive-16by9" style="margin-left:100px;">
						<?php 
							$invoiceNo = $this->uri->segment(3);
							$studentId = $this->uri->segment(4);
							$isAdmission = $this->uri->segment(5);
							$isSMS = $this->uri->segment(6);
							// echo $studentId;
						?>
						<iframe class="embed-responsive-item" src="<?php echo base_url(); ?>index.php/invoiceController/feeInvoice/<?php echo $invoiceNo; ?>/<?php echo $studentId; ?>/<?php echo $isAdmission; ?>/<?php echo $isSMS; ?>" id="iframe1" style="border: 1px solid red; width:85%; margin:auto;" onLoad="autoResize('iframe1');"></iframe>
					</div>
                  
                  <div class="core-content" style="float:right; margin-right:30px;">
         				<a href="<?php echo base_url(); ?>index.php/login/collectFee">
                          <h2 class="title block "><button class="btn btn-dark-purple">Pay Another fee <i class="fa fa-arrow-circle-right"></i></button></h2>
                        </a>
                     </div>
					
				</div>
			</div>
			<!-- end: INLINE TABS PANEL -->
		</div>
	</div>
	<!-- end: PAGE CONTENT-->
</div>