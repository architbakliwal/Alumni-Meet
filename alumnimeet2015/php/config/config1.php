<?php

/*	--------------------------------------------------
	:: CONFIG SETTINGS
	-------------------------------------------------- */

	error_reporting(0);

	// error_reporting(E_ALL & ~E_NOTICE);

	// Enter your Name here!
    $yourname = 'JBIMS Alumni Meet';

    // Enter your Email here!
    $youremail = 'alumnimeet@jbims.edu';

	// Turn true SMTP if you want don´t forget to turn false sendmail and mail

	$sendmail = false;
	$mail = false;

	$SMTP = true;
	
	$protocol = '';                       // Can be 'ssl' or 'tls' or ''
	$host = 'jbi.jbims.edu';
	$port = 25;                             // Can be 465, 587, 25
	$smtpusername = 'alumnimeet@jbims.edu';        // Need to be equal to $youremail
	$smtppassword = 'pass@123';

	// If you want file upload turn this to true!
	$upload = true;
	
	// Enter your default time zone
	date_default_timezone_set('Asia/Kolkata');
	
	$localtime = date("l jS \of F Y h:i:s A");	

	// Enter your URL here without http:// only domain!
	$url = 'jbims.edu';
	
	if ($_SERVER['SERVER_NAME'] == $url) {
	    // Enter your BASEURL here without WWW!
		$baseurl = 'http://jbims.edu/alumnimeet2015/';
	} else {
	    // Enter your BASEURL here with WWW!
		$baseurl = 'http://www.jbims.edu/alumnimeet2015/';
	}
	
	// Enter your Website here!
	$website = 'http://www.jbims.edu/';

	// Enter Company here!
	$company = 'JBIMS';
		
	// If you want captcha turn this to true!
	$captcha = true;
	
	
	// Don't change order of tables may cause some conflicts
	$mysql 			     = true;										       
    $mysqltable_name   = "registration_details";

    $hostname_Connection = "localhost";
    $database_Connection = "jbims_alumnimeet2015";
    $username_Connection = "alumnimeet";
    $password_Connection = "pass@123";

    if ($mysql) {
        $connection = mysql_connect($hostname_Connection, $username_Connection, $password_Connection) or die ('<div class="error-message"><i class="icon-close"></i>Failed to connect to MySQL '.mysql_error().'</div>');
        $database = mysql_select_db ($database_Connection, $connection) or die ('<div class="error-message"><i class="icon-close"></i>Failed to connect to MySQL '.mysql_error().'</div>');
	}

?>