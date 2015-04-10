<?php

    include dirname(__FILE__).'/csrf_protection/csrf-token.php';
	include dirname(__FILE__).'/csrf_protection/csrf-class.php';

    if(!isset($_SESSION)){
    	session_start();
	}
	
	include dirname(__FILE__).'/config/config.php';
	
    $language = array('en' => 'en','pt' => 'pt');

	if (isset($_GET['lang']) AND array_key_exists($_GET['lang'], $language)){
		include dirname(__FILE__).'/language/'.$language[$_GET['lang']].'.php';
	} else {
		include dirname(__FILE__).'/language/en.php';
	}

    $name = strip_tags(trim($_POST["name"]));
    $spousename = strip_tags(trim($_POST["spousename"]));
	$address = strip_tags(trim($_POST["address"]));
    $email = strip_tags(trim($_POST["email"]));
    $phonenumber = strip_tags(trim($_POST["phonenumber"]));
	$batchyear = strip_tags(trim($_POST["batchyear"]));
	$course = strip_tags(trim($_POST["course"]));
	
	$finalname = htmlspecialchars($name, ENT_QUOTES, 'UTF-8');
    $finalspousename = htmlspecialchars($spousename, ENT_QUOTES, 'UTF-8');
	$finaladdress = htmlspecialchars($address, ENT_QUOTES, 'UTF-8');
    $finalemail = htmlspecialchars($email, ENT_QUOTES, 'UTF-8');
    $finalphonenumber = htmlspecialchars($phonenumber, ENT_QUOTES, 'UTF-8');
	$finalbatchyear = htmlspecialchars($batchyear, ENT_QUOTES, 'UTF-8');
	$finalcourse = htmlspecialchars($course, ENT_QUOTES, 'UTF-8');

	$payment_status = 'Pending';

    $sqlcheckduplicate = mysql_query("SELECT * FROM `jbims_alumnimeet2015`.`registration_details` WHERE `email_id` = '".mysql_real_escape_string($finalemail)."'");
    $duplicatecount = mysql_num_rows($sqlcheckduplicate);

    if($duplicatecount > 0) {
    	echo 'duplicate';
    	exit(0);
    }

    if($finalspousename !== '') {
    	$number_of_people = 2;
    	$payment_amount = 4000;
    } else {
    	$number_of_people = 1;
    	$payment_amount = 2000;
    }

    if ($mysql == true){

		$sqlregister = "INSERT INTO `jbims_alumnimeet2015`.`registration_details` (`name`, `spouse_name`, `address`, `email_id`,`phone_number`, `batch_year`, `course_attended`, `number_of_people`, `payment_amount`, `payment_status`) VALUES ('".mysql_real_escape_string($finalname)."','".mysql_real_escape_string($finalspousename)."','".mysql_real_escape_string($finaladdress)."','".mysql_real_escape_string($finalemail)."','".mysql_real_escape_string($finalphonenumber)."','".mysql_real_escape_string($finalbatchyear)."','".mysql_real_escape_string($finalcourse)."','".mysql_real_escape_string($number_of_people)."','".mysql_real_escape_string($payment_amount)."','".mysql_real_escape_string($payment_status)."')";

		$insertregister = mysql_query($sqlregister);

		if(! $insertregister )
		{
		  die('Could not enter data: ' . mysql_error());
		}

		$sqluid = "SELECT * FROM  `registration_details` WHERE email_id ='" . mysql_real_escape_string($finalemail) ."'";

		$selectuid = mysql_query($sqluid);

		if(! $selectuid )
		{
		  die('Could not enter data: ' . mysql_error());
		}

	    while ($row = mysql_fetch_array($selectuid, MYSQL_ASSOC)) {
	        $uid = $row['uid'];
	    }

	    if($uid !== '') {
	    	echo $uid;
	    } else {
	    	echo "Failed";
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