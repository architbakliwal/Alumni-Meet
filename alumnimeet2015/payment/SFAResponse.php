<?php
include("Sfa/EncryptionUtil.php");
include '../php/config/config.php';

 $strMerchantId="00012849";
 $astrFileName="/var/www/vhosts/jbims.edu/public_html/alumnimeet2015/payment/00012849.key";
 $astrClearData;
 $ResponseCode = "";
 $Message = "";
 $TxnID = "";
 $ePGTxnID = "";
 $AuthIdCode = "";
 $RRN = "";
 $CVRespCode = "";
 $Reserve1 = "";
 $Reserve2 = "";
 $Reserve3 = "";
 $Reserve4 = "";
 $Reserve5 = "";
 $Reserve6 = "";
 $Reserve7 = "";
 $Reserve8 = "";
 $Reserve9 = "";
 $Reserve10 = "";

 // $finalpaymentstatus = 'Complete';
 // $TxnID= "2323a";
 // $uid=12;

 // $sqlpayment = "UPDATE registration_details SET payment_status = '" . $finalpaymentstatus . "', transaction_id = '" . $TxnID . "' WHERE uid = " . $uid;

 // print $sqlpayment;

if($_POST){

    if($_POST['DATA']==null){
        redirect($baseurl . 'paymentredirect.php');
    }
                 
    $astrResponseData=$_POST['DATA'];
    $astrDigest = $_POST['EncryptedData'];
    $oEncryptionUtilenc =         new         EncryptionUtil();
    $astrsfaDigest  = $oEncryptionUtilenc->getHMAC($astrResponseData,$astrFileName,$strMerchantId);


    if (strcasecmp($astrDigest, $astrsfaDigest) == 0) {
         parse_str($astrResponseData, $output);

         if( array_key_exists('RespCode', $output) == 1) {
                 $ResponseCode = $output['RespCode'];
         }
         if( array_key_exists('Message', $output) == 1) {
                 $Message = $output['Message'];
         }
         if( array_key_exists('TxnID', $output) == 1) {
                 $TxnID=$output['TxnID'];
         }
         if( array_key_exists('ePGTxnID', $output) == 1) {
                 $ePGTxnID=$output['ePGTxnID'];
         }
         if( array_key_exists('AuthIdCode', $output) == 1) {
                 $AuthIdCode=$output['AuthIdCode'];
         }
         if( array_key_exists('RRN', $output) == 1) {
                 $RRN = $output['RRN'];
         }
         if( array_key_exists('CVRespCode', $output) == 1) {
                 $CVRespCode=$output['CVRespCode'];
         }
         if( array_key_exists('Reserve1', $output) == 1) {
                $Reserve1 = $output['Reserve1'];
         }

         if( array_key_exists('Reserve2', $output) == 1) {
                 $Reserve2 = $output['Reserve2'];
         }
         if( array_key_exists('Reserve3', $output) == 1) {
                 $Reserve3 = $output['Reserve3'];
         }

         if( array_key_exists('Reserve4', $output) == 1) {
                 $Reserve4 = $output['Reserve4'];
         }

         if( array_key_exists('Reserve5', $output) == 1) {
                 $Reserve5 = $output['Reserve5'];
         }
         if( array_key_exists('Reserve6', $output) == 1) {
                 $Reserve6 = $output['Reserve6'];
         }

         if( array_key_exists('Reserve7', $output) == 1) {
                 $Reserve7 = $output['Reserve7'];
         }
         if( array_key_exists('Reserve8', $output) == 1) {
                 $Reserve8 = $output['Reserve8'];
         }

         if( array_key_exists('Reserve9', $output) == 1) {
                 $Reserve9 = $output['Reserve9'];
         }
         if( array_key_exists('Reserve10', $output) == 1) {
                 $Reserve10 = $output['Reserve10'];
         }

         if($ResponseCode == 0) {
            $finalpaymentstatus = 'Complete';
         } else {
            $finalpaymentstatus = 'Failed';
         }

         $uid = trim($Reserve4);
         $email_id = $Reserve2;

         if ($mysql == true){
            $sqlpayment = "UPDATE registration_details SET payment_status = '" . $finalpaymentstatus . "', transaction_id = '" . $TxnID . "' WHERE uid = " . $uid;

            $updatepayment = mysql_query($sqlpayment);

            if(! $updatepayment )
            {
              die('Could not enter data: ' . mysql_error());
            }

            echo "success";
            redirect($baseurl . 'paymentredirect.php?uid=' .$uid);

        } else {

        }
    }
    
 }


 function redirect($url) {

         if(headers_sent()) {

         ?>
         <html><head>
         <script language="javascript" type="text/javascript">

          window.self.location='<?php print($url);?>';

         </script>
         </head></html>
         <?php
         exit;

         } else {

         header("Location: ".$url);
         exit;

         }

 }



?>
