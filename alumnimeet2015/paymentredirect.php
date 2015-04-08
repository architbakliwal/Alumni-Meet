<?php
session_start();

	include 'php/csrf_protection/csrf-token.php';
	include 'php/csrf_protection/csrf-class.php';

	include 'php/config/config.php';
	
	$language = array('en' => 'en','pt' => 'pt');

	if (isset($_GET['lang']) AND array_key_exists($_GET['lang'], $language)){
		include 'php/language/'.$language[$_GET['lang']].'.php';
	} else {
		include 'php/language/en.php';
	}

	if (isset($_GET['uid'])) {
	    $uid = $_GET['uid'];
	}else{
	    redirect($baseurl);
	    exit(0);
	}

	$finalpaymentstatus = '';

	if ($mysql == true){
		$sqldetails = "SELECT * FROM  `registration_details` WHERE uid ='" . $uid ."'";

		$selectdetails = mysql_query($sqldetails);

		if(! $selectdetails )
		{
		  die('Could not enter data: ' . mysql_error());
		}

		while ($row = mysql_fetch_array($selectpersonal, MYSQL_ASSOC)) {
			$name = $row['name'];
			$email_id = $row['email_id'];
			$payment_amount = $row['payment_amount'];
			$uid = $row['uid'];
		}

	} else {
		redirect($baseurl);
	}


	if($finalpaymentstatus == "Complete") {
		$responsemsg = '<font color="green">CONGRATULATIONS! Your registration was successful. Please check your mail for payment receipt and confirmation.</font>';
		$finalsubject = 'JBIMS Alumni Meet 2015 Confirmation';
	} else {
		$responsemsg = '<font color="red">Your payment was not successful, please try again or contact support. Please check your mail for transaction id.</font>';
		$finalsubject = 'JBIMS Alumni Meet 2015 Confirmation';
	}

	include 'php/classes/PHPMailerAutoload.php';							
	include 'php/messages/autopaymentemail.php';
												
	$automail = new PHPMailer();
	$automail->IsSMTP();
	$automail->SMTPAuth = true;
	$automail->SMTPSecure = $protocol;
	$automail->Host = $host;
	$automail->Port = $port;
	$automail->Username = $smtpusername;
	$automail->Password = $smtppassword;
	$automail->From = $youremail;
	$automail->FromName = $yourname;
	$automail->isHTML(true);
	$automail->CharSet = "UTF-8";
	$automail->Encoding = "base64";
	$automail->Timeout = 200;
	$automail->SMTPDebug = 0; // 0 = off (for production use) // 1 = client messages // 2 = client and server messages
	$automail->ContentType = "text/html";
	$automail->AddAddress($email_id);
	$automail->Subject = $finalsubject;
	$automail->Body = $autopaymentemail;
	$automail->AltBody = "To view this message, please use an HTML compatible email";
						
	if ($automail->Send()) {
	} else {
	}
	
	
?>
<!doctype html>
<html>
    <head>

        <?php include 'header.php'; ?>

    </head>
	
    <body>
		<div class="wrapper"> 
		    <div class="form-bar">
				<div class="top-bar bar-green"></div>
				<div class="top-bar bar-orange"></div>
				<div class="top-bar bar-yellow"></div>
				<div class="top-bar bar-red"></div>
				<div class="top-bar bar-purple"></div>
				<div class="top-bar bar-pink"></div>
				<div class="top-bar bar-blue-dark"></div>
				<div class="top-bar bar-blue"></div>
			</div>
	        <div class="header dashboard_header">
			    <div class="grid-container">
			    	<div class="column-twelve">
						<h4>Autonomous JBIMS Golden Jubilee Function for Alumni Registration</h4>
					</div>					
				</div>
			</div>
			<div class="section">
				<div class="grid-container">
					<div class="form">
						<div class="section inner_section">
							<form method="post" action="" id="section_submit">
								<fieldset>
									<div class="grid-container">
										<div class="column-twelve">
										    <div class="box">
												<div class="box-section center">
													<div class="column-twelve" style="margin:30px;">
														<h3 style="text-align: center;"><?php echo $responsemsg;?></h3>
													</div>
											    </div>
											</div>
										</div>
									</div>
								</fieldset>
							</form>
						</div>
					</div>
				</div>
			</div>
			<div class="copyright">
				<div class="grid-container">
					<div class="column-twelve">
						<p>© 2015 JBIMS All Rights Reserved</p>
					</div>
				</div>
            </div>
		</div>
    </body>
</html>