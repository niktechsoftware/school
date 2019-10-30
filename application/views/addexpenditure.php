<!-- start: PAGE CONTENT -->
<div class="row">
  <div class="col-sm-12">
    <!-- start: INLINE TABS PANEL -->
    <div class="panel panel-white">
     
      <div class="panel-body">
        <div class="row">
          <div class="col-sm-12">
            <div class="tabbable">
              <ul id="myTab" class="nav nav-tabs">
                <li class="active">
                  <a href="#myTab_example1" data-toggle="tab">
                    <i class="green fa fa-home"></i>Add Expenditure
                  </a>
                </li>
                <li>
                  <a href="#myTab_example2" data-toggle="tab">
                    <i class="green fa fa-home"></i> Add Sub Expenditure Type
                  </a>
                </li>
              </ul>
              <div class="tab-content">
                <div class="tab-pane fade in active" id="myTab_example1">
                  <div class="alert alert-danger">
                    <button data-dismiss="alert" class="close">×</button>
                    <h3 class="media-heading text-center">Welcome to Expenditure Section</h3>
                    <a class="alert-link" href="#"></a>
                   This is very Important to Create Expenditure First because School or College requires a Expenditure type (like as Salary, Transport, Stationary etc) .You Can edit Expenditure name .
                  If You change its may affect Your Fee Structure and Other Section.
                  </div>
                 <div class="row">
                    <div class="col-sm-6">
                      <div class="panel panel-calendar">
                        <div class="panel-heading panel-blue border-light">
                          <h4 class="panel-title text-center">Create Expenditure Section</h4>
                        </div>
                        <div class="panel-body">
                        <div class="text-black text-large">
                            <div class="row">
                            <div class="col-md-12">
                         Add Expenditure <input type="text"   id="expenditure" name="expenditure" required>
                        </div>
                            </div>
                            <div class="row" style="padding-top:10px;">
                            <div class="col-md-12">
                            <center><a href="#" class="btn btn-sm btn-blue" id="createexp"><i class="fa fa-check">
                            
                            </i>
                              Create Expenditure </a> </center>
                              </div>
                              </div>
                            <br><br><br>
                            <div class="alert alert-warning">Add  Expenditure.
                             If Expenditure Successfully  added then it Shows in right side panel.
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="panel panel-calendar">
                        <div class="panel-heading panel-green border-light">
                          <h4 class="panel-title text-center">Old/Current Expenditure Section </h4>
                        </div>
                        <div class="panel-body" id="expenditure2">
                    
                    </div>
                  </div>
                </div>
              </div>
 
          </div>
       
                <div class="tab-pane fade" id="myTab_example2">
                  <div class="alert alert-info">
                    <button data-dismiss="alert" class="close">
                      ×
                    </button>
                    <h3 class="media-heading text-center">Welcome to  Add Sub Expenditure Type </h3>
                    <a class="alert-link" href="#"></a>
                    This is  Add Sub Expenditure Type section. In this section you can add or update  Sub Expenditure Type. 
                  </div>
                  <div class="row">
                    <div class="col-sm-6">
                      <div class="panel panel-calendar">
                        <div class="panel-heading panel-red border-light">
                          <h4 class="panel-title">Sub Expenditure Type</h4>
                        </div>
                        <div class="panel-body">
                          <div class="text-black text-large">
                             <div class="panel-body panel-scroll height-250" >
                           <?php 
                        //   $this->db->where('fsd',$this->session->userdata('fsd'));
                        //    $data=$this->db->get('class_fees')->result();
                          ?>     
                        <!-- <table class="table table-bordered table-hover ">
                        <thead>
                        <tr class="text-center">
                         <th>FSD ID </th>
                        <th>Fee Head Name</th>
                        <th>Fee Amount</th>
                        </tr>
                      </thead>
                       <tbody>
                        <?php foreach($data as $row1){?>
                         <tr>
                           <td class="text-center"><?php echo $row1->fsd;?> </td>
                          <td class="text-center"><?php echo $row1->fee_head_name;?></td>
                          <td class="text-center"><?php echo $row1->fee_head_amount;?></td>
                        </tr>
                       <?php   }?>
                        </tbody>
                      </table> -->
                      <div class="panel-body">
                        <div class="text-black text-large">
                            <div class="row">
                            <div class="col-md-6">
                        Select Expenditure Name
                        </div>
                        <div class="col-md-6">
                        <?php //$this->db->where('school_code',$this->session->userdata('school_code'));
                                     $exp= $this->db->get('expenditure');
                                    // print_r($exp);
                                     if($exp->num_rows()>0){ ?>
                                <select id="subexp" class="form-control" name="subexp">
                                      <option>-Select-</option> 
                                      <?php
                                         foreach($exp->result() as $row): ?>
                                      <option value="<?php echo $row->sno;?>"><?php echo $row->expenditure_name; ?></option> 
                                     <?php 
                                        endforeach; ?>
                                   
                                </select>
                                <?php  } ?>
                        </div>
                            </div>
                            <div class="row">
                            <div class="col-md-12">
                         Add Expenditure <input type="text"   id="expsub" name="expsub" required>
                        </div>
                            </div>
                            <div class="row" style="padding-top:10px;">
                            <div class="col-md-12">
                            <center><a href="#" class="btn btn-sm btn-blue" id="createexp1"><i class="fa fa-check">
                            
                            </i>
                              Create Sub Expenditure </a> </center>
                              </div>
                              </div>
                            <br><br><br>
                            <div class="alert alert-warning">Add  Expenditure.
                             If Expenditure Successfully  added then it Shows in right side panel.
                            </div>
                          </div>
                        </div>
                      </div> 
                      </div>
                         <div class="alert alert-danger">
                         <p>This panel shows the class fee with current FSD .
                         Here You can not  update or change any anything.</p>
                        </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="panel panel-calendar">
                        <div class="panel-heading panel-blue border-light">
                          <h4 class="panel-title">New FSD Update</h4>
                        </div>
                        <div class="panel-body" id="expen">
                        
                      </div>
                    </div>
                 
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- end: INLINE TABS PANEL -->
    </div>
  </div>
</div>
<!-- end: PAGE CONTENT-->
