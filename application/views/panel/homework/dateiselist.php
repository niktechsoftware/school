
<div class="row">
  <div class="col-md-12">
    <!-- start: RESPONSIVE TABLE PANEL -->
    <div class="panel panel-white">
      <div class="panel-heading panel-pink">
        <h4 class="panel-title">class Daywise <span class="text-bold">HomeWork Report</span></h4>
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
      <div class="row">
          <div class="col-md-4">
              <label>Start Date</label>
              <input type="date" name="strtdt" id="strtdt">
              
          </div>
           <div class="col-md-4">
              <label>end Date</label>
              <input type="date" name="enddt" id="enddt">
              
          </div>
          <div class="col-md-4">
              <input type="submit" id="sub" value ="Get Record">
          </div>
      </div>
      <div class="row">
          <div id="record">
              
          </div>
          
      </div>



</div>
</div>
</div>
</div>
<script>
    $(document).ready(function(){
        $('#sub').click(function(){
            var strt= $('#strtdt').val();
             var enddt= $('#enddt').val();
             $.post("<?= site_url();?>index.php/homeworkpanel/datewiserecord",
             { strt : strt ,enddt : enddt },
             function(data){
                 $('#record').html(data);
             });
        });
    });
</script>
