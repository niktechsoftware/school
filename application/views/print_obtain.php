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

        if(document.getElementById){
            newheight=document.getElementById(id).contentWindow.document .body.scrollHeight;
            newwidth=document.getElementById(id).contentWindow.document .body.scrollWidth;
        }

        document.getElementById(id).height= (newheight) + "px";
        document.getElementById(id).width= (newwidth) + "px";
    }
</script>


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
			    <input type="hidden" id="fsd" value="<?php echo $fsd; ?>" />
			       <?php
						$fsd =$fsd;
						$school_code=$school_code;
						$row2=$this->db->get('db_name')->row()->name;
               	?><!--other obtain mark list start(print button)-->
				<div class="row">
				
					<div class="col-sm-12"><?php //$fsd =$this->session->userdata("fsd"); ?>
						<IFRAME SRC="<?php echo base_url(); ?>index.php/examControllers/print_obtain/<?php echo $fsd; ?>/<?php echo $examid; ?>/<?php echo $classid; ?>/<?php echo $subjectid; ?>/<?php echo $sub_type; ?>" width="100%" height="150px" id="iframe1" style="border: 1px;" onLoad="autoResize('iframe1');"></iframe>
					</div>
				</div>
			<!--other obtain mark list end(print button)-->
			
				
			</div>
			<!-- end: INLINE TABS PANEL -->
		</div>
	</div>
	<!-- end: PAGE CONTENT-->
</div>