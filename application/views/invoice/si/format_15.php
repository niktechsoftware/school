<?php $this->load->view("invoice/".$resultFolder."/resultHeader");?>
<body>
    <div id="printcontent" align="center">
        <div id="page-wrap" style="margin-top: 70px;height: 1250px;width:960px; border:0px solid #333;">
            <div style="width:100%; height:1250px;margin-left:auto; margin-right:auto; border:0px  solid blue; background-color:#ffffff;">
                <div style="width:95%; margin-left:auto; margin-right:auto; border:0px  solid yellow; height:auto;">
                    <?php
                        $this->db->where("id",$school_code);
                        $info =$this->db->get("school")->row();
                    ?>
                    <table style="width: 100%;">
                        <tr>
                           <td  style="border: none;">
                                <img src="<?php echo $this->config->item('asset_url'); ?><?php echo $school_code;?>/images/empImage/<?php echo $info->logo;?>"
                                    alt="" style="height: 100px;width: 100px;" />
                                </br><h3 style="color:white">Aff.No. - <?php echo $info->registration_no;?></h3>
                            </td>
                            <td colspan="2" style="border: none;" >
                                <h1 style="color:black;font-size: 35px;">
                                    <?php echo $info->school_name;?></h1>
                                <h2 style="color:black;">
                                    <?php if($info->address1){echo $info->address1; }else{echo $info->address2; }echo ",".$info->city; ?>
                                </h2>
                                <h2 style="color:black;">
                                <?php echo $info->state." - ".$info->pin.", Contact No. : " ;
                                    if(strlen($info->mobile_no > 0 )){echo $info->mobile_no ;}
									if(strlen($info->other_mobile_no > 0 )){echo ", ".$info->other_mobile_no ;} ?>
                                </h2>
                            </td>
                        </tr>
                      
                          <tr style="border: none;">
                        
                            <td style="border: 1px;" colspan="3">
                                <center><h2 style="border: 0px solid #000; padding: 5px; width: 200px; color:black;">
                                  <span class="report">PROGRESS REPORT</span>
                       <?php //$fsd1=$this->session->userdata('fsd');
                             $this->db->where('id',$fsd_id);
                            $fsd2=$this->db->get('fsd')->row()->finance_end_date;

                       ?>
        <span class="report1">ACADEMIC SESSION <?php echo (date('y', strtotime('-1 year', strtotime($fsd2)) )."-". date('Y', strtotime($fsd2))) ;?></span>
                                    <?php 
                                   /* $this->db->where("school_code",$school_code);
                                   $this->db->where("fsd",$fsd_id);
                                    $this->db->where("stu_id",$student_id);
                                    $result= $this->db->get("exam_info")->result();
                                    $c="";$d="";
                                    foreach($result as $d12):
                                    $c = $d12->class_id;
                                    break;
                                    endforeach;
                                    if(strlen($c)>0){   
                                }else{
                                    echo " There are no marks entry for this Student";
                                } */
                                    ?>
                                </h2></center>
                            </td>
                            
                        </tr>
                        <?php $this->db->where("id",$student_id);
                       $studentInfo= $this->db->get("student_info")->row();
                       $this->db->where("student_id",$student_id);
                       $parentInfo=$this->db->get("guardian_info")->row();
                        ?>
                         <tr class="wight" style="color: black;font-size: 13px;">
                            <td >
                                <span style="text-transform: uppercase;">Scholar ID: <?= $studentInfo->username; ?></span><br>
                                <span style="text-transform: uppercase;">Scholar Name: <?= strtoupper($studentInfo->name);?> </span><br>
                               <?php
                                         
                                           $this->db->where('id',$class_id);
                                           $classname=$this->db->get('class_info');
                                            //print_r($classid->class_id);exit();
                                            ?>
                                  <?php if($classname->num_rows()>0){
                                  $classdf=$classname->row();
                                  $this->db->where("id",$classdf->section);
                                  $secname = $this->db->get("class_section")->row()->section;
                                  ?>
                                <span style="text-transform: uppercase;">Class: <?php   $classdf->class_name."-".$secname; }?></span>
                               
                            
                            </td>
                            <td >
                                 <span style="text-transform: uppercase;">Mother's Name: <?php echo strtoupper($parentInfo->mother_full_name); ?></span><br>
                                <span style="text-transform: uppercase;">Father's Name: <?php echo strtoupper($parentInfo->father_full_name); ?></span><br>
                            </td>
                            <td class="">
                                <img src="<?php echo $this->config->item('asset_url'); ?><?= $this->session->userdata('school_code') ?>/images/stuImage/<?php echo $studentInfo->photo; ?>"  alt="" width="90" height="105" />
                            </td>
                        </tr>
                      
                </table>
            
            <br>
           <?php $this->exammodel->testResult($school_code,$class_id,$fsd_id,$student_id,$totalIndicator,$termTotal);?>
            
            <br>
            <div  style="color: white;">
            <div  style="text-align: left;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Congratulations! Promoted to Class :</div>
            </div>
            <br>
            <div>
                <table style="width:95%;background-color:white;">
                    <tr>
                        <td>        
                            Date : 23-03-2020
                        </td>
                        <td>
                            Class Teacher :
                        </td>
                        <td>
                            Principal :<div>
                                <img src="<?php echo $this->config->item('asset_url'); ?><?= $this->session->userdata('school_code') ?>/images/empImage/<?php echo $info->principle_sign;?>" alt="" width="100" height="30" style="margin-top=-60px;" /></div>
                        </td>
                    </tr>
                </table>
            </div>
        </div></div>
    </div>
    </div>
    <div class="invoice-buttons" style="text-align:center;">
    <button class="button button2" type="button" onclick="window.print();">
        <i class="fa fa-print padding-right-sm"></i> Print
    </button>
    </div>
</body>


</html>