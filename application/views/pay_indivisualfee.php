 <?php $this->db->where("username",$stuid);
     $studentdt=$this->db->get("student_info");
     if($studentdt->num_rows()>0){
       if($studentdt->row()->transport==1){ 
         $this->db->where("v_id",$studentdt->row()->v_id);
         $tamt=$this->db->get("transport_root_amount");
         if($tamt->num_rows()>0){

         ?>
<input type="hidden" name="stud_username" value="<?= $stuid?>" readonly>
<input type="hidden" name="student_id" value="<?= $studentdt->row()->id;?>" readonly>
<input type="hidden" name="paymonth" value="<?= $month;?>" readonly>
<div class="col-md-4">
<label>Total Transport Amount</label></br>
<input type="text" name="tfee" value="<?= $tamt->row()->transport_fee; ?>" readonly>
</div>
<div class="col-md-4">
<label>Paid Amount</label></br>

<input type="text" name="paidfee" value="<?= $tamt->row()->transport_fee; ?>" readonly >
</div>
<div class="col-md-4">

<input type="submit"  value="Pay Fee" readonly>
</div>
       <?php } } } ?>