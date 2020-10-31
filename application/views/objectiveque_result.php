
<style>
table {
  font-family: arial, sans-serif;
 
  width: 100%;
}

td, th {
 
  text-align: left;
  padding: 8px;
}

tr:nth-child(even) {
 
}
</style>

<div class="row">
  <div class="col-md-12">
    <!-- start: RESPONSIVE TABLE PANEL -->
    <div class="panel panel-white">
      <div class="panel-heading panel-red">
        <h4 class="panel-title">Objective<span class="text-bold">Exam Result Panel</span></h4>
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
       <div class="text-black text-large">
         <div class="row">
             
            <div class="col-md-12 col-lg-12 col-sm-12">
              <div class="col-md-6 col-lg-6 col-sm-6">
              <div class="table-responsive">
		<table class="table table-striped table-hover" id="example">
           <tbody>
                <tr>
                    
                
                    <td> <p><h3> Total number of question &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
                    <button class="btn btn-sm btn-light-green" style="font-size:15px;">
                        <?php echo $left+$wrong+$right;?><i class="<?php //echo "fa fa-arrow-right";?>"></i>
                        </button>
                    </h3></p></td>
                   
              
                 
                </tr>
                 <tr>
                    <td> <p><h3>Total number of attempt question&nbsp &nbsp
                     <button class="btn btn-sm btn-light-green" style="font-size:15px;">
                         <?php echo $wrong+$right;?><i class="<?php //echo "fa fa-arrow-right";?>"></i></button>
                   </h3></p></td>
                
                  </tr>
                  <tr><td>
                      <?php $this->db->where('exam_mode_id',$exam_mode_id);
                		    $this->db->where('student_id',$student_id);
                		    $result1=$this->db->get('objective_exam_result');
                		    $i=1;foreach($result1->result() as $res):
                            $this->db->where('id',$res->question_id);
                            $this->db->where('exam_mode_id',$exam_mode_id);
                            $ques=$this->db->get('question_master')?>
                           <?php echo $i." ) ";if($ques->num_rows()>0){ $ques=$ques->row();  ?><strong><?php echo $ques->question;?></strong><br>
                           <?php } $i++; endforeach;
                		    ?>
                            </td></tr>
                  
                  <tr>
                  <td> <p><h3>Total number of right answer&nbsp &nbsp&nbsp 
                   <button class="btn btn-sm btn-light-green" style="font-size:15px;" >
                        <?php echo $right;?><i class="<?php echo "fa fa-arrow-right";?>"></i></button>
                  </h3></p></td>
                </tr><tr><td><?php
                    
        		  $i=1; $right=0; $wrong=0; foreach($result1->result() as $row):
                            $this->db->where('question_master_id',$row->question_id);
                            $ans=$this->db->get('right_answer');
                           
                           if($row->given_answer==$ans->row()->right_answer){?>
                           <?php $right+=1;
                          echo "<strong>".$i.") ".$ans->row()->right_answer."</strong>&nbsp;&nbsp;&nbsp;&nbsp;";
                           }else{
                              $wrong+=1;
                           }
                          $i++; endforeach;
                            ?> 
                
                </td></tr>
                 
                  <tr>
                   <td>  <p><h3>Total number of wrong Answer
                   <button class="btn btn-sm btn-light-green" style="font-size:15px;" >
                        <?php echo $wrong;?><i class="<?php //echo "fa fa-arrow-right";?>"></i></button>
                   </h3></p></td>
                 
   
                  </tr>
                  <tr><td>
                           <?php  
                            $i=1;foreach($result1->result() as $row):
                            $this->db->where('question_master_id',$row->question_id);
                            $ans=$this->db->get('right_answer')->row();
                            if($ans->right_answer==$row->given_answer){ 
                            }else{?>
                            <?php echo "<strong>".$i.") ".$row->given_answer."</<strong>&nbsp;&nbsp;&nbsp;&nbsp;";}?></a>
                                		    <?php $i++;endforeach;?>
                                		   
		    </td></tr>
                  <tr>
                    <td> <p><h3>Total number of left answer 
                     <button class="btn btn-sm btn-light-green" style="font-size:15px;" >
                	<?php echo $left;?><i class="<?php //echo "fa fa-arrow-right";?>"></i></button> 
                    </h3></p></td>
                   
                  </tr>
                  <tr><td><!-- <?php 
                		     $i=1; foreach($result1->result() as $row):
                              $this->db->where('exam_mode_id',$exam_mode_id);
                              $this->db->where('id',$row->question_id);
                          
                              $ques=$this->db->get('question_master');
                              if($ques->num_rows()>0){
                                  $k=0;
                              }else{?>
                		     <?php echo $i;?>.<?php echo $ques->question;?>
                		    
                		    <?php  }?>
                            <?php $i++;endforeach;?>-->
                		    </td></tr>
                  </table>
                </div>
              </div>
             
                  <style> 
        .piechart { 
            margin-top: 50px; 
            display: block; 
            position: absolute; 
            width: 300px; 
            height: 300px; 
            border-radius: 50%; 
            background-image: conic-gradient( 
                pink <?php echo $right*10;?>deg,  
                lightblue 0 <?php echo $wrong*80;?>deg,  
                orange 0 <?php echo $left;?>deg); 
        } 
      </style>
             <div class="col-md-6 col-lg-6 col-sm-6"> <?php 
             $this->db->where("id",$exam_mode_id);
             $exammodeD= $this->db->get("exam_mode")->row();
             $this->db->where("id",$student_id);
                                                       $student_Details= $this->db->get("student_info")->row();
                                                       $this->db->where("id",$student_Details->class_id);
                                                       $classD= $this->db->get("class_info")->row();
                                                       $this->db->where("id",$exammodeD->exam_id);
                                                       $examn = $this->db->get("exam_name")->row();
                                                        echo "<h2>".$student_Details->name. "<br> Class : ".$classD->class_name."<br>Exam Name : ".$examn->exam_name."</h2>";?>
                            <div class="piechart"></div>                           
               </div>
           </div>
                    <p><h3><span style="color:green;">Thanks For giving online exam!!!!!</span></h3></p>      
        </div>
      </div>
    </div>
  </div>
</div>
</div>  
