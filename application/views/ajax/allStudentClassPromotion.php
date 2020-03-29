	<input type="hidden" name="classv" id = "classv" value="<?php echo $cla;?>"/>
    <?php $i=1;
        if($check->num_rows() > 0){
        $school_code = $this->session->userdata('school_code');?>
                <table class="table table-bordered table-hover" id="sample-table-1">
                         <thead>
                             <tr>
                                <td>Stream</td>
                                <td>Section</td>
                                <td>Select Class </td>
                                 <td>Current FSD </td>
                                  <td>Promoted FSD </td>
                                <td>Pramote </td>
                                <td>Status </td>
                            </tr>
                        </thead>
                    <tbody>
                <tr>
               <?php $this->db->where("id",$cla);
                    $oldv=	$this->db->get("class_info")->row();?>
                 
                    <td><select id="clname" class="form-control">
                        <option value="">Select Stream</option>
                        <?php 
                        $school_code = $this->session->userdata("school_code");
                        $StreamList = $this->db->query("SELECT DISTINCT stream from class_info where school_code='$school_code' ORDER BY id");
                        ?>
                        <?php if(isset($StreamList)){?>
                        <?php foreach ($StreamList->result() as $row2){ ?>
                        <option value="<?php echo $row2->stream;?>" <?php if($row2->stream==$oldv->stream){echo 'selected="selected"';}?>>
                        <?php $this->db->where("id",$row2->stream);
                        $sname=	$this->db->get("stream")->row()->stream;
                        echo $sname;?>
                        </option>
                        <?php } }?>
                        </select>
                    </td>
                                
                    <td><select id="sectionList" class="form-control">
                                
                                    <?php 
                                    $school_code = $this->session->userdata("school_code");
                                 $SectionList = $this->db->query("SELECT DISTINCT section from class_info where school_code='$school_code' ORDER BY id");
                                    ?>
                                    <?php if(isset($SectionList)){?>
                                    <?php foreach ($SectionList->result() as $row7){
                                            $sectionid=$row7->section;
                                            $this->db->where('id',$sectionid);
                                        $row2=$this->db->get('class_section')->row(); 
                                        ?>
                                    <option value="<?php echo $row2->id;?>" <?php if($row2->section == $oldv->section){echo 'selected="selected"';}?>><?php echo $row2->section;?></option>
                                    <?php } }?>
                        </select> 
                    </td>
                                            
                    <td> <?php $classname = $this->db->query("SELECT * FROM class_info where section= '$oldv->section' and stream='$oldv->stream'")->result();
                          ?><select class="form-control" id="changeClass" name="class" style="width: 90px;">
                      <?php 
                        foreach($classname as $row7):?>
                            <option value="<?php echo $row7->id;?>" <?php if($row7->id == $cla){echo 'selected="selected"';}?>><?php echo $row7->class_name;?></option>
                            <?php endforeach;  ?> 
                        </select>		
                    </td>
                      <td> <?php $cfsdd = $this->db->query("SELECT * FROM fsd where id= '$cfsd'")->row();
                                                ?>
                           <input type ="text" name ="cfsddate" id="cfsddate" value="<?php echo $cfsdd->finance_start_date." To ".$cfsdd->finance_end_date;?>"  readonly>	
                     <input type ="hidden" name ="cfsd" id="cfsd" value="<?php echo $cfsd;?>"  readonly>	
                    </td>
                     <td> <?php $psd =$this->session->userdata("fsd");
                     			$pfsd = $this->db->query("SELECT * FROM fsd where id= '$psd'")->row();?>
                           <input type ="text" name ="pfsddate" id="pfsddate" value="<?php echo $pfsd->finance_start_date." To ".$pfsd->finance_end_date;?>"  readonly>	
                           <input type ="hidden" name ="pfsd" id="pfsd" value="<?php echo $psd;?>"  readonly>	
                    </td>                                     
                    <td>
                        <button id = "pro" class="btn btn-dark-purple">
                            Pramote <i class="fa fa-arrow-circle-right"></i>
                        </button>
                    </td>
                    <td>
                        <input type ="button" value = "Good Day" class="btn btn-success btn-sm" id="msg1">
                    </td>

                </tr>
            
                </tbody>
                    </table><?php 
                                                    
                                                    
        }?>
        <script> 
       
            $("#pro").click(function(){
                var changeClass = $("#changeClass").val();
                var cfsd = $("#cfsd").val();
                var pfsd = $("#pfsd").val();
                $("#pro").hide()
                if(changeClass==null){
                    alert("Please select a Valid stream section and class to pramot");
                }else{
                    $.post("<?php echo site_url("index.php/promotionControler/pramoteAllStudent") ?>",{
                        changeClass : changeClass, cfsd: cfsd, pfsd : pfsd
                        }, function(data){
                    $("#msg1").html(data);
                    $("#pro").show()
                     $("#pro").val(data);
                    });
                }
            });
    
              $("#clname").change(function(){
                var streamid = $("#clname").val();
                $.post("<?php echo site_url('index.php/promotionControler/getpromoteSection') ?>", {streamid : streamid}, function(data){
                    $("#sectionList").html(data);
                });
            });
    
             $("#sectionList").change(function(){
                var sectionid = $("#sectionList").val();
                var streamid = $("#clname").val();
               // alert(sectionid);
                $.post("<?php echo site_url('index.php/promotionControler/getpramoteClass') ?>", {
                    sectionid : sectionid , 
                    streamid : streamid
                    }, function(data){
                    $("#changeClass").html(data);
                    //alert(data);
                });
            });
        </script>
    