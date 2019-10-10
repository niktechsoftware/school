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
		
			<div class="panel-body">
				<div class="row">
					<div class="col-sm-12 embed-responsive embed-responsive-16by9" style="margin-left:100px;">
					<?php 
					$examid1=$examid;
					?>
						<iframe class="embed-responsive-item" src="<?php echo base_url(); ?>index.php/examControllers/printexamreport/<?php echo $examid1;?>" id="iframe1" style="border: 1px solid red; width:85%; margin:auto;" onLoad="autoResize('iframe1');"></iframe>
					</div>
                  
                
					
				</div>
			</div>
			<!-- end: INLINE TABS PANEL -->
		</div>
	</div>
	<!-- end: PAGE CONTENT-->
</div>