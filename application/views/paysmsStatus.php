<div id="main-wrapper" class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-white">
                <div class="panel-body">
                    <?php
                    $paytmChecksum = "";
        $paramList = array();
        $isValidChecksum = "FALSE";
        $paramList = $_POST;
        $paytmChecksum = isset($_POST["CHECKSUMHASH"]) ? $_POST["CHECKSUMHASH"] : ""; //Sent by Paytm pg

        //Verify all parameters received from Paytm pg to your application. Like MID received from paytm pg is same as your application’s MID, TXN_AMOUNT and ORDER_ID are same as what was sent by you to Paytm PG for initiating transaction etc.
        $isValidChecksum = verifychecksum_e($paramList, PAYTM_MERCHANT_KEY, $paytmChecksum); //will return TRUE or FALSE string.
        
        


        if($isValidChecksum == "TRUE") {
            //echo "<b>Checksum matched and following are the transaction details:</b>" . "<br/>";
            if ($_POST["STATUS"] == "TXN_SUCCESS") {
                echo "<center><h4 style='color:green;'>Transaction status is SUCCESS</h4> </center>" . "<br/>";
                //Process your transaction here as success transaction.
                //Verify amount & order id received from Payment gateway with your application's order id and amount.
            }
            else {
                echo "<center><h4 style='color:red;'>Transaction status is FAILURE</h4></center>" . "<br/>";
            }
            
            

            if (isset($_POST) && count($_POST)>0 )
             { 
                foreach($_POST as $paramName => $paramValue) {
                       // echo "<br/>" . $paramName . " = " . $paramValue;
                }
                          
   ?>  
   <table style="width:75%; margin:auto; border:1px solid black; margin-bottom:30px;">
          <tr>
              <th style="border:1px solid black;"><?php echo "ORDER_ID" ?></th>
              <td style="border:1px solid black; text-align:center;"><?php echo $_POST["ORDERID"]; ?></td>
          </tr>
          <tr>
              <th style="border:1px solid black;"><?php echo "TXN_ID" ?></th>
              <td style="border:1px solid black; text-align:center;"><?php echo $_POST["TXNID"]; ?></td>
          </tr>
                    <tr>
              <th style="border:1px solid black;"><?php echo "TXN_AMOUNT" ?></th>
              <td style="border:1px solid black; text-align:center;"><?php echo $_POST["TXNAMOUNT"]; ?></td>
          </tr>
          <tr>
              <th style="border:1px solid black;"><?php echo "STATUS" ?></th>
              <td style="border:1px solid black; text-align:center;"><?php echo $_POST["STATUS"]; ?></td>
          </tr>
                    <tr>
              <th style="border:1px solid black;"><?php echo "RESP_MSG" ?></th>
              <td style="border:1px solid black; text-align:center;"><?php echo $_POST["RESPMSG"]; ?></td>
          </tr>
                    <tr>
              <th style="border:1px solid black;"><?php echo "CURRENCY" ?></th>
              <td style="border:1px solid black; text-align:center;"><?php echo $_POST["CURRENCY"]; ?></td>
          </tr>
          <tr>
              <th style="border:1px solid black;"><?php echo "BANK_TXN_ID" ?></th>
              <td style="border:1px solid black; text-align:center;"><?php echo $_POST["BANKTXNID"]; ?></td>
          </tr>
                    <tr>
              <th style="border:1px solid black;"><?php echo "BANK_NAME" ?></th>
              <td style="border:1px solid black; text-align:center;"><?php echo (isset($_POST["BANKNAME"])?$_POST["BANKNAME"]:""); ?></td>
          </tr>
          <tr>
              <th style="border:1px solid black;"><?php echo "TXN_DATE_TIME" ?></th>
              <td style="border:1px solid black; text-align:center;"><?php echo (isset($_POST["TXNDATE"])?$_POST["TXNDATE"]:date("Y-m-d H:i:s")); ?></td>
          </tr>

          
      </table><?php
               
               // $insert["order_id"] = $_POST["ORDERID"];
                $insert["txn_id"]   = $_POST["TXNID"];
                $insert["txn_amount"] = $_POST["TXNAMOUNT"];
                $insert["status"] = $_POST["STATUS"];
                $insert["txn_date_time"] = isset($_POST["TXNDATE"])?$_POST["TXNDATE"]:date("Y-m-d H:i:s");
                // $insert["product"] = $this->session->userdata("PRODUCT");
                // $insert["person_name"] = $this->session->userdata("PERSON_NAME");
                // $insert["person_mobile_no"] = $this->session->userdata("MOBILE");

                 $this->db->order_by("order_id","decs");
                $this->db->where("order_id",$_POST["ORDERID"]);
                $res = $this->db->get("sms_transaction");
                // echo "1";
                if($res->num_rows()>0){
                   // echo "2";
                    $this->db->where("order_id",$_POST["ORDERID"]);
                    $this->db->update("sms_transaction",$insert);
            }
            }

        }
        else {
            echo "<b>Checksum mismatched.</b>";
            //Process transaction as suspicious.
        }
        
        
                    ?>
                </div>
            </div>
        </div>
    </div><!-- Row -->

</div><!-- Main Wrapper -->