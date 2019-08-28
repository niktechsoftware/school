<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

	<meta http-equiv='Content-Type' content='text/html; charset=UTF-8' />
	
	<title><?php echo $title; ?></title>

	<link rel='stylesheet' type='text/css' href='<?php echo base_url(); ?>assets/css/invoice_css/style.css' />
	<link rel='stylesheet' type='text/css' href='<?php echo base_url(); ?>assets/css/invoice_css/prin_result.css' media="print" />
	<script type='text/javascript' src='<?php echo base_url(); ?>assets/js/invoice_js/jquery-1.3.2.min.js'></script>
	<script type='text/javascript' src='<?php echo base_url(); ?>assets/js/invoice_js/example.js'></script>
	
	<style type="text/css">

	@media print
	{
			body * { visibility: hidden; }
			#printcontent * { visibility: visible; }
			#printcontent { position: absolute; top: -20px; left: 30px; }
	    }
	    
	    .button {
  background-color: #4CAF50; /* Green */
  border: none;
  color: white;
  padding: 16px 32px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 16px;
  margin: 4px 2px;
  -webkit-transition-duration: 0.4s; /* Safari */
  transition-duration: 0.4s;
  cursor: pointer;
}
  
  
  .button2 {
  background-color: #008CBA; 
  color: white; 
  border: 2px solid #008CBA;
}

.button2:hover {
  background-color: #4CAF50;
  color: white;
  border: 2px solid #4CAF50;
}

    .nob{
    	border: none;
    }
   
	</style>
	
    <script>
        function convert_number(number)
        {
            if ((number < 0) || (number > 999999999))
            {
                return "Number is out of range";
            }
            var Gn = Math.floor(number / 10000000);  /* Crore */
            number -= Gn * 10000000;
            var kn = Math.floor(number / 100000);     /* lakhs */
            number -= kn * 100000;
            var Hn = Math.floor(number / 1000);      /* thousand */
            number -= Hn * 1000;
            var Dn = Math.floor(number / 100);       /* Tens (deca) */
            number = number % 100;               /* Ones */
            var tn= Math.floor(number / 10);
            var one=Math.floor(number % 10);
            var res = "";

            if (Gn>0){
                res += (convert_number(Gn) + " Crore");
            }
            if (kn>0){
                res += (((res=="") ? "" : " ") +
                    convert_number(kn) + " Lakhs");
            }
            if (Hn>0){
                res += (((res=="") ? "" : " ") +
                    convert_number(Hn) + " Thousand");
            }

            if (Dn){
                res += (((res=="") ? "" : " ") +
                    convert_number(Dn) + " hundred");
            }


            var ones = Array("", "One", "Two", "Three", "Four", "Five", "Six","Seven", "Eight", "Nine", "Ten", "Eleven", "Twelve", "Thirteen","Fourteen", "Fifteen", "Sixteen", "Seventeen", "Eightteen","Nineteen");
            var tens = Array("", "", "Twenty", "Thirty", "Fourty", "Fifty", "Sixty","Seventy", "Eigthy", "Ninety");

            if (tn>0 || one>0)
            {
                if (!(res==""))
                {
                    res += " and ";
                }
                if (tn < 2)
                {
                    res += ones[tn * 10 + one];
                }
                else
                {

                    res += tens[tn];
                    if (one>0)
                    {
                        res += ("-" + ones[one]);
                    }
                }
            }

            if (res=="")
            {
                res = "zero";
            }
            return res;
        }

    </script>
</head>

<body>
	<div id="printcontent" align="center">
	<br/><br/><br/>
	<div id="page-wrap" style="width:960px; border:1px solid #333;">
<?php
	$school_code = $this->session->userdata("school_code");

    $this->db->where("id",$school_code);
    $info =$this->db->get("school")->row();
?>		
		<table style="width: 100%;">
			<tr>
				<td width="20%" style="border: none;" rowspan="2">
					<img src="<?php echo base_url();?>assets/<?php echo $school_code;?>/images/empImage/<?php echo $info->logo;?>" alt="" width="120" />
					</br><i>Aff.No. - RC/A-15-16/_____</i>
				</td>
				<td style="border: none;">
				    <h1 style="font-size:45px; color:red; margin-left:25px;"><?php echo $info->school_name;?></h1>
				<!--	<p style="Arial Black, Gadget, sans-serif; font-size:45px; color:blue; margin-left:45px;"><?php echo $info->your_school_name;?></p>-->
			        <h2 style="color:blue; margin-left:90px; font-size:20px;">
						<?php echo $info->address1." ".$info->city; ?>
			        </h2>
			       
			     <!--   <h2 style="font-variant:small-caps; margin-left:180px;">
						<?php   if(strlen($info->mobile_number > 0 )){echo "Mobile No:- : ".$info->mobile_number." ";} ?>
			           
			        </h2>-->
				</td>
				<td style="border: none;></td>
				    	<div style="display:inline-block; float:right; margin-right:5px;>
            <table>
                <tr>
                    	<td style="border:none; line-height: 20px;">
                    		<img src="<?php echo base_url()?>assets/<?php echo $school_code;?>/images/stuImage/<?php echo $studentInfo->photo;?>"  alt="" width="100" height="100" />
                        </td>
                    </tr>
                   
            </table>
            </div></td>
			</tr>
			<tr>
				<td style="border: none;">
				
						<h2 style="border: 2px solid #000; padding: 5px; width: 200px; color:red; margin-left:130px;">
							&nbsp;&nbsp;Progress Report (2018-19) <br>	
							<?php 
					    	$this->db->where("school_code",$school_code);
					       $this->db->where("fsd",$this->session->userdata('fsd'));
                        	$this->db->where("stu_id",$studentInfo->id);
                        	$result= $this->db->get("exam_info")->result();
                        	$c="";$d="";
                        	foreach($result as $d12):
                        	$c = $d12->class_id;
              
                        	break;
                        	endforeach;
                        	if(strlen($c)>0){
				  //		echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Class : <strong>'.$c.' - '.$d.'</strong>';	
				  		}else{
				  			echo " There are no marks entry for this Student";
				  		} 
                        	?> 
						</h2>
						
					
				</td>
			</tr>
			<tr><td style="border: none;"></td></tr>
			<tr><td style="border: none;"></td></tr>
		</table>
        <hr/>
		<div style="clear:both"></div>
		
		<div id="customer">
        	<div style="display:inline-block; float:left; margin-left:5px;">
            <table> 
                    <tr>
                    	<td style="border:none;  line-height: 20px; font-size:16px; color:blue;">
                    		Student Name : <strong><?php echo $studentInfo->name; ?></strong>
                        </td>
                    </tr>
                    
                    <tr>
                    	<td style="border:none; line-height: 20px; font-size:16px; color:blue;">
                    		Father's Name : <strong><?php echo $parentInfo->father_full_name; ?></strong>
                        </td>
                    	
                    </tr>
                    <tr>
                    <td style="border:none; line-height: 20px; font-size:16px; color:blue;">
                    		Mother's Name : <strong><?php echo $parentInfo->mother_full_name; ?></strong>
                        </td>
                    	
                    </tr>
                    
            </table>
			</div>
			
		
			
			
			
			
            <div style="display:inline-block; float:center; margin-right:5px;">
            <table>
                <tr>
                <td style="border:none; line-height: 20px; font-size:16px; color:blue;">
                    		
                        	
                        	<?php echo 'Student Id : <strong>'.$studentInfo->username.'</strong>';	?>
                        </td>
                    
                    </tr>
                    <tr>
                    	<td style="border:none; line-height: 20px; font-size:16px; color:blue;">
                    		Date of Birth : <strong><?php echo date("d-m-Y",strtotime($studentInfo->dob)); ?></strong>
                        </td>
                    </tr>
                <tr>
                	 <?php
                           $this->db->where('school_code',$school_code);
                           $this->db->where('id',$studentInfo->class_id);
                           $classname=$this->db->get('class_info')->row();
                            ?>
                    <td style="border:none; line-height: 20px; font-size:16px; color:blue;">
                    		CLASS :<strong><?php echo  $classname->class_name;?></strong>
                        </td>
                    </tr>
                    </H3>
            </table>
            </div>
		
		</div>
		<h3>
		<table id="items" align="center" class="exam" style="width:100%; margin-top:0px; alignment-adjust:central;">
		  	<tr>
		  		     <?php $fsd1=$this->session->userdata('fsd');
                             $this->db->where('school_code',$school_code);
                             $this->db->where('id',$fsd1);
                            $fsd2=$this->db->get('fsd')->row()->finance_end_date;

                       ?>
		  		<th>S.No.</th>
		  		<th>Subjects</th>
		  		<?php 
		  		$this->db->where("school_code",$school_code);
		  		$this->db->where("exam_date >", $fsd2);
		  		$examName = $this->db->get("exam_name")->result();
		  		foreach($examName as $examName1):?>
		  		<th>
		  		
		  		<?php if($examName1->exam_name=="SUMMATIVE_ASSESSMENT-1st"){
                  echo "SA-1";

                    }  else{echo $examName1->exam_name;}?>
				    </th>
				   <?php endforeach;?>	
		  	</tr>
		  	<?php 
		  		$i = 1;
		  		$j = 1;
		  		$gross = 0;
		  		$gross1 = 0;
		  		$gross2 = 0;
		  		$gross3 = 0;
		  		$gross4 = 0;
		  		$gross5 = 0;
		  		$gross6 = 0;
		  		$gross7 = 0;
		  		$gross8 = 0;
		  		$rowtot=0;
		  		$totoutofrow=0;
		  		$tot1 = 0;$tot2 = 0;$tot3 = 0;$tot4 = 0;$tot5 = 0;$tot6 = 0;$tot7 = 0;$tot8 = 0;$tot9 = 0;
		  		$total = 0;
		  	///	$this->db->where("school_code",$this->session->userdata("school_code"));
		  		$this->db->where("class_id",$c);
		  		//$this->db->where("section",$d);
		  		$var  = $this->db->get("subject")->result();
		  		foreach($var as $row):
		  			echo '<tr>';
		  			echo "<td style='text-align: center;font-size:14px;'>".$i."</td>";
		  			echo "<td style='font-size:14px;'>".$row->subject."</td>";
		  			$this->db->where("school_code",$this->session->userdata("school_code"));
		  			$this->db->where("exam_date >",$fsd2);
		  			$examName = $this->db->get("exam_name")->result();
		  			   foreach($examName as $ex):

		  			  $this->db->where("fsd",$this->session->userdata('fsd'));
		  			
		  			   $this->db->where("school_code",$this->session->userdata("school_code"));
				  		$this->db->where("stu_id",$studentInfo->id);
				  		$this->db->where("subject_id",$row->id);
				  		$this->db->where("exam_id",$ex->id);
				  		$var1  = $this->db->get("exam_info");
				  		$num = $var1->num_rows();
					  		if($num > 0){
					  			$result = $var1->row();
					  			if(is_numeric($result->marks)||(is_numeric($result->out_of))){
					  				if($j == 1){
					  				if(is_numeric($result->marks)){
					  					$tot1 += $result->marks;
					  					$rowtot +=$result->marks;
					  					}
					  					$gross1 += $result->out_of;
					  					
					  					$totoutofrow += $result->out_of;
					  				}
					  				if($j == 2){
					  				if(is_numeric($result->marks)){
					  					$tot2 += $result->marks;
					  					$rowtot +=$result->marks;
					  					}
					  					$gross2 += $result->out_of;
					  					
					  					$totoutofrow += $result->out_of;
					  				}
					  				if($j == 3){
					  				if(is_numeric($result->marks)){
					  					$tot3 += $result->marks;
					  					$rowtot +=$result->marks;
					  					}
					  					
					  					$gross3 += $result->out_of;
					  					$totoutofrow += $result->out_of;
					  				}
					  				if($j == 4){
					  				if(is_numeric($result->marks)){
					  					$tot4 += $result->marks;
					  					
					  					$rowtot +=$result->marks;
					  					}
					  					$gross4 += $result->out_of;
					  					$totoutofrow += $result->out_of;
					  				}
					  				if($j == 5){
					  				if(is_numeric($result->marks)){
					  					$tot5 += $result->marks;
					  					$rowtot +=$result->marks;
					  					}
					  					$gross5 += $result->out_of;
					  					$totoutofrow += $result->out_of;
					  				}
					  				if($j == 6){
					  				if(is_numeric($result->marks)){
					  					$tot6 += $result->marks;
					  					$rowtot +=$result->marks;
					  					}
					  					$gross6 += $result->out_of;
					  					$totoutofrow += $result->out_of;
					  				}
					  				if($j == 7){
					  				if(is_numeric($result->marks)){
					  					$tot7 += $result->marks;
					  					$rowtot +=$result->marks;
					  					}
					  					$gross7 += $result->out_of;
					  					$totoutofrow += $result->out_of;
					  				}
					  				if($j == 8){
					  				if(is_numeric($result->marks)){
					  					$tot8 += $result->marks;
					  					$rowtot +=$result->marks;
					  					}
					  					$totoutofrow += $result->out_of;
					  					
					  				}
					  				$val = $result->marks;
					  			}else{
					  				$val = 0;
					  			}echo "<td  style='text-align: center;'><table ><tr><td style='border-left:none;border-bottom:none;border-top:none; font-size:14px;width:37%;'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".$result->marks."&nbsp;&nbsp;</td><td style='border-right:none;border-bottom:none;border-top:none;font-size:14px; width:37%;'>".$result->out_of."</td></tr></table></td>";
					  			
					  			$total = $total + $result->marks;
					  		}else{ 
					  			echo "<td> </td>";
					  			
					  		
					  		}
					  		
					  		$j++;
					endforeach;
					
				  	
				  		$tot9 += $total;
				  		$total = 0;
				  		
				  		?>
				  	<!--	<td><table ><tr><td style="border-left:none;border-bottom:none;border-top:none;font-size:14px; width:35%;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php if($rowtot > 9 ){echo $rowtot;}else{echo "0".$rowtot; }?></td><td style="border-right:none;border-bottom:none;border-top:none;font-size:14px; width:35%;">&nbsp;&nbsp;&nbsp;<?php echo $totoutofrow;?></td></tr></table>
				  </td>	--><?php 	$j = 1;	$rowtot=0;
				  		$totoutofrow=0;			  		
		  			echo '</tr>';
		  		$i++; endforeach; 
		  	?>
			 	<tr>
			  		<td colspan="2" align="center"><B>TOTAL</B></td>
			  		<td><table ><tr><td style="border-left:none;border-bottom:none;border-top:none;font-size:14px; width:35%;">&nbsp;&nbsp;<?php echo $tot1;?></td><td style="border-right:none;border-bottom:none;border-top:none;font-size:14px; width:35%;">&nbsp;&nbsp;&nbsp;<?php echo $gross1;?></td></tr></table>
		  				</td>
			  		<td><table ><tr><td style="border-left:none;border-bottom:none;border-top:none;font-size:14px; width:35%;">&nbsp;&nbsp;<?php echo $tot2;?></td><td style="border-right:none;border-bottom:none;border-top:none;font-size:14px; width:35%;">&nbsp;&nbsp;&nbsp;<?php echo $gross2;?></td></tr></table>
		  				</td>
		  				
		  				
		  				<td><table ><tr><td style="border-left:none;border-bottom:none;border-top:none; font-size:14px;width:35%;">&nbsp;&nbsp;<?php echo $tot3;?></td><td style="border-right:none;border-bottom:none;border-top:none;font-size:14px; width:35%;">&nbsp;&nbsp;&nbsp;<?php echo $gross3;?></td></tr></table>
		  				</td>	
			  	</tr>
		  	</table>
		  	<table style="width:100%;">
		  	<tr>
		  		<td style="border-left:none; width:25.2%;">
		  			<table class="nob" >
				  			<tr>
			  			<td class="nob"></br><strong>Attendance </strong></td>
			  			<td class="nob"></br> <strong>Record</strong></td>
			  			</tr>
			  			<tr>
			  			<?php 
						?>
			  				<td class="nob">1st Term : </td>
			  				<td class="nob">___________</td>
			  			
			  			</tr>
		  			</table>
		  		</td>
		  		<td style="border-right:none; width:35%;">
		  			<table>
		  			<tr>
			  				<td class="nob"></br>Percentage	:</td>
			  				<td class="nob"></br><span style="text-decoration: underline;">
			  						<b><?php 
			  						 $perv=$tot3+$tot4+$tot5+$tot6;
			  						$gros=$gross3+$gross4+$gross5+$gross6;
			  						
			  							echo $per = round(($perv*100)/$gros, 2);
			  							
			  						?> %&nbsp;&nbsp;&nbsp;
			  							
			  						</b>
			  					</span></td>		
			  			</tr>
			  			<tr>
			  				<td class="nob"></br>Rank	:</td>
			  				<td class="nob"></br>______</td>
			  			</tr>   			
		  			</table>
		  			
		  		</td>
		  		<td style = "width:26%;">  		
		  		<table>
			  			<tr>
			  				<td class="nob"></br>Sig. of Class Teacher :</td>
			  				<td class="nob"></br>____________</td>
			  			</tr>
			  			<tr>
			  				<td class="nob"></br>Sig. of the Principal :</td>
			  				<td class="nob"></br>____________</br></td>
			  			</tr>
		  			</table>
		  			
		  		
		  		</td>
		  	</tr>
		  	
		</table>
	
	</div>
	</div>
	<br/><br/>
	<div class="invoice-buttons" style="text-align:center;">
    <button class="button button2" type="button"  onclick="window.print();">
      <i class="fa fa-print padding-right-sm"></i> Print
    </button>
  </div>

</body>

</html>