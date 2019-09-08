<?php 

   
        $dbhost="208.91.198.93";
        $dbuser="schoodhe_school";
        $dbpass="Rahul!123singh";
        $con=mysqli_connect($dbhost,$dbuser,$dbpass);

    	$con1=mysqli_select_db($con,'schoodhe_C');

       if($con1)
       {
          $query1="select * from school";
          $res=mysqli_query($con,$query1);
          if($res)
          {
              while($dd=mysqli_fetch_array($res))
              {
                if( $dd['id'])
                {
                    
                    $query2="select * from opening_closing_balance where school_code ='".$dd['id']."' and opening_date= '".date('Y-m-d')."'";// and opening_date='".dat;
                    // SELECT * FROM `opening_closing_balance` WHERE `school_code`='6' and`opening_date`='2019-07-31'
                    $getDaybook = mysqli_query($con,$query2);
                    //print_r($getDaybook);
                    while($ddt=mysqli_fetch_array($getDaybook))
                    {
                        if($ddt['school_code'])
                        {
                          $query3="select sum(amount) as cradit from day_book where dabit_cradit='1' and school_code ='".$ddt['school_code']."' and DATE(pay_date)= '".date('Y-m-d')."'";
                          $query4="select sum(amount) as dabit from day_book where dabit_cradit='0' and school_code ='".$ddt['school_code']."' and DATE(pay_date)= '".date('Y-m-d')."'";
                          $dx1=mysqli_query($con,$query3);
                          $dx2=mysqli_query($con,$query4);

                          //print_r($dx);
                          $df['cr']=0;
                          $df['dr']=0;
                          while($ddx1=mysqli_fetch_array($dx1))
                         {
                            $ddx1['cradit'];
                            if($ddx1['cradit']!= null)
                            {
                                $df['cr']= $ddx1['cradit'];
                            }
                            else
                            {
                                $df['cr']=0;
                            }

                         }
                         while($ddx2=mysqli_fetch_array($dx2))
                         {

                            //$df['dr']=$ddx2['dabit']."<br>";
                            $ddx2['dabit'];
                            if($ddx2['dabit']!= null)
                            {
                                $df['dr']= $ddx2['dabit']."<br>";
                            }
                            else
                            {
                                $df['dr']=0;
                            }
                         }
                         
                         //echo  $ddt['school_code']."&nbsp;&nbsp;&nbsp;&nbsp;".$dd['school_name']."&nbsp;&nbsp;&nbsp;&nbsp;";
                        // $this->db->where('school_code',$ddt['school_code']);
                        // $this
                        $query5="select * from sms_setting where school_code=".$ddt['school_code'];
                        $dta1=mysqli_query($con,$query5);
                        print_r($dta1);
                        while($dta2=mysqli_fetch_array($dta1))
                        {
                            // $dta2['sender_id']."<br>";
                        
                        
                         $bln=$ddt['closing_balance']-$ddt['opening_balance'];
						$number ="8382829593";
						$msg ="Dear Sir/Madam [".$dd['school_name']."], Today's School Profit Amount is Rs.".$bln.". Credited Amount is Rs.".$df['cr']." and Debited Amount is Rs. ".$df['dr']." With Best Regards, Niktech Software Solution For Any Query Contact Us 6389027901, 6389027902" ; 
						//echo  $msg;
						echo $dd['mobile_no']."<br>";
					    $url="http://bulksms.niktechsoftware.com/vendorsms/pushsms.aspx?user=niktecht&password=123@niktech&msisdn=".$dd['mobile_no']."&sid=".$dta2['sender_id']."&msg=".urlencode($msg)."&fl=0&gwid=2";
					    //	$url="http://bulksms.niktechsoftware.com/vendorsms/pushsms.aspx?user=niktecht&password=123@niktech&msisdn=8382829593&sid=".$dta2['sender_id']."&msg=".urlencode($msg)."&fl=0&gwid=2";
	                    $ch = curl_init();
            			curl_setopt($ch,CURLOPT_URL,$url);
            			curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
            			$output=curl_exec($ch);
            			curl_close($ch);
                        }
					
                        }      
                    }
                }  
              }
          }
       }
       else
       {
           echo "not";
       }
	
	
// }
 ?>
