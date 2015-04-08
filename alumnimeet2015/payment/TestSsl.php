<?php

	if(!isset($_SESSION)){
    	session_start();
	}
    
	include '../php/config/config.php';

	if (isset($_GET['uid'])) {
	    $uid = $_GET['uid'];
	}else{
	    redirect($baseurl);
	    exit(0);
	}

	
	if ($mysql == true){

		$sqldetails = "SELECT * FROM  `registration_details` WHERE `uid` = " . $uid;

		$selectdetails = mysql_query($sqldetails);

		if(! $selectdetails )
		{
		  die('Could not enter data: ' . mysql_error());
		}

		while ($row = mysql_fetch_array($selectdetails, MYSQL_ASSOC)) {
			$name = $row['name'];
			$email_id = $row['email_id'];
			$payment_amount = $row['payment_amount'];
			$uid = $row['uid'];
		}

		$payment_amount = $payment_amount + ($payment_amount * (0.95506/100));

		$payment_amount = round($payment_amount, 2);

	} else {
		redirect($baseurl);
		exit(0);
	}


include("Sfa/BillToAddress.php");
include("Sfa/CardInfo.php");
include("Sfa/Merchant.php");
include("Sfa/MPIData.php");
include("Sfa/ShipToAddress.php");
include("Sfa/PGResponse.php");
include("Sfa/PostLibPHP.php");
include("Sfa/PGReserveData.php");

 $oMPI                 =         new         MPIData();

 $oCI                =        new        CardInfo();

 $oPostLibphp        =        new        PostLibPHP();

 $oMerchant        =        new        Merchant();

 $oBTA                =        new        BillToAddress();

 $oSTA                =        new        ShipToAddress();

 $oPGResp        =        new        PGResponse();

 $oPGReserveData = new PGReserveData();



$oMerchant->setMerchantDetails("00012849","00012849","00012849","193.545.34.33",rand()."","Ord123",$baseurl."payment/SFAResponse.php","POST","INR","INV123","req.Sale",$payment_amount,"","Ext1","true","Ext3","Ext4","Ext5");

 $oBTA->setAddressDetails ("CID","Tester","JBIMS","Mumbai","Maharashtra","Test","Test","Test","IND","web@jbims.edu");

 $oSTA->setAddressDetails ("Add1","Add2","Add3","City","State","443543","IND","tester@soft.com");

$INRpayment_amount = "INR".$payment_amount;
$payment_amountpaisa = $payment_amount * 100;

 $oMPI->setMPIRequestDetails($payment_amountpaisa,$INRpayment_amount,"356","2","JBIMS Alumni Meet","","","","0","","image/gif, image/x-xbitmap, image/jpeg, image/pjpeg, application/vnd.ms-powerpoint, application/vnd.ms-excel, application/msword, application/x-shockwave-flash, */*","Mozilla/4.0 (compatible; MSIE 5.5; Windows NT 5.0)");

 $oPGReserveData->setReserveObj($name,$email_id,$payment_amount,$uid,"JBIMS Alumni Meet 2015","6","7","8","9","10");

 $oPGResp=$oPostLibphp->postSSL($oBTA,$oSTA,$oMerchant,$oMPI,$oPGReserveData);


        if($oPGResp->getRespCode() == '000'){

                $url        =$oPGResp->getRedirectionUrl();
                #$url =~ s/http/https/;
                #print "Location: ".$url."\n\n";
                #header("Location: ".$url);
                redirect($url);



           }else{

                        print "Error Occured.<br>";
                        print "Error Code:".$oPGResp->getRespCode()."<br>";
                        print "Error Message:".$oPGResp->getRespMessage()."<br>";

         }


# This will remove all white space
#$oResp =~ s/\s*//g;

# $oPGResp->getResponse($oResp);

 #print $oPGResp->getRespCode()."<br>";

 #print $oPGResp->getRespMessage()."<br>";

 #print $oPGResp->getTxnId()."<br>";


 #print $oPGResp->getEpgTxnId()."<br>";




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
