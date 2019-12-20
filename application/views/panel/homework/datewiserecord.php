 <h3>
<center>
   
      <span style="color:green;height:100px;">  <?= $strt;?></span>
         <span style="color:green;height:100px;" >TO</span>
       <span style="color:green;height:100px;">  <?= $endt;?></span>
       
       </center>
       </h3>
<table class="table table-bordered;">
    <thead>
        
        <th>Sno.</th>
          <th>Homewrok Name</th>
            <th>Class NAme</th>
              <th>Given Subject</th>
              <th>Work Description</th>
              <th>Given Date</th>
             
    </thead>
    <tbody>
        <?php $i=1;
        foreach($result->result() as $row):
        
        
        ?>
        <tr>
        <td><?= $i; ?></td>
         <td><?= $row->work_name;?></td>
          <td><?php 
          $this->db->where("id",$row->class_id);
         $class= $this->db->get("class_info");
         if($class->num_rows()>0){
             echo $class->row()->class_name;
             $this->db->where("id",$class->row()->section);
             $sec=$this->db->get("class_section");
             if($sec->num_rows()>0){
                echo "[ ". $sec->row()->section ." ]";
             }else{
                 echo  " [ N/A ]";
             }
         }else{
             echo "Sorry ! class not found";
         }
          ?></td>
           <td><?php 
           $this->db->where("id",$row->subject_id);
           $subject=$this->db->get("subject");
           if($subject->num_rows()>0){
               echo $subject->row()->subject;
           }else{
               echo "Sub. not found";
           }
           ?></td>
           <td><?= $row->workDiscription; ?></td>
           <td><?= $row->givenWorkDate; ?></td>
        </tr>
        <?php $i++; endforeach; ?>
    </tbody>
</table>
