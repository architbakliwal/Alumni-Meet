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
	
	if(!CSRF::check('section_register')){
        echo $lang['processor_wrong_security_token'];
    } else {
		echo "hello";
    }	
?>