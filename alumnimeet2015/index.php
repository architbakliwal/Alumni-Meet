<?php
    
	include dirname(__FILE__).'/php/csrf_protection/csrf-token.php';
	include dirname(__FILE__).'/php/csrf_protection/csrf-class.php';
	
	include dirname(__FILE__).'/php/config/config.php';
	
	$language = array('en' => 'en','pt' => 'pt');

	if (isset($_GET['lang']) AND array_key_exists($_GET['lang'], $language)){
		include dirname(__FILE__).'/php/language/'.$language[$_GET['lang']].'.php';
	} else {
		include dirname(__FILE__).'/php/language/en.php';
	}
	
?> 
<!doctype html>
<html>
    <head>
	
        <meta charset="utf-8">
	    <meta name="author" content="<?php echo $lang['website_author'];?>">
		<meta name="description" content="<?php echo $lang['website_description'];?>">
		<meta name="keywords" content="<?php echo $lang['website_keywords'];?>">
        <title><?php echo $lang['website_title'];?></title>
		
		<!-- Viewport -->
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1"/>

		<!-- Favicon -->
        <link rel="shortcut icon" type="image/png" href="<?php echo $baseurl;?>images/favicon.png">
		
		<!-- Css Styles -->
		<link rel="stylesheet" type="text/css" href="<?php echo $baseurl;?>css/settings.css">
		<link rel="stylesheet" type="text/css" href="<?php echo $baseurl;?>css/tooltipster.css">
		<link rel="stylesheet" type="text/css" href="<?php echo $baseurl;?>css/responsive.css">
		<link rel="stylesheet" type="text/css" href="<?php echo $baseurl;?>css/sweet-alert.css">
		
		<!-- Font Link -->
        <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>		
		
		<!-- jQuery from the google apis -->
        <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.js"></script>

	    <!-- Js Files -->
		<script type="text/javascript" src="<?php echo $baseurl;?>js/jquery.custom.js"></script>
		<script type="text/javascript" src="<?php echo $baseurl;?>js/jquery.validate.js"></script>
		<script type="text/javascript" src="<?php echo $baseurl;?>js/jquery.methods.js"></script>
        <script type="text/javascript" src="<?php echo $baseurl;?>js/jquery.form.js"></script>
		<script type="text/javascript" src="<?php echo $baseurl;?>js/localization/messages_en.js"></script>
		<script type="text/javascript" src="<?php echo $baseurl;?>js/jquery.tooltipster.js"></script>
		<script type="text/javascript" src="<?php echo $baseurl;?>js/sweet-alert.min.js"></script>
		
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
						<img src="images/logo.JPG"/>
					</div>
			    	<div class="column-twelve">
						<h2>Autonomous JBIMS Golden Jubilee Function for Alumni Registration</h2>
					</div>
				</div>
			</div>
			<div class="section">
				<div class="grid-container">
					<div class="form">
						<div class="header inner_header" style="padding: 0;">
							<div class="grid-container">
								<div class="column-twelve">
									<h4 style="margin-bottom:15px;">* marked fields are mandatory</h4>
								</div>							
							</div>
						</div>
						<div class="section inner_section">
							<form method="post" action="<?php echo $baseurl;?>php/processor.php?lang=<?php echo $_GET['lang'];?>" id="section_register">
								<fieldset>
									<div class="grid-container">
										<div class="column-twelve">
									        <div class="input-group">
		                                        <?php echo CSRF::make('section_register')->protect(); ?>                               
											</div>
									    </div>
										<div class="column-six">
											<div class="input-group-right irequire">
												<label for="name" class="group label-input">
					                                <input type="text" id="name" name="name" class="input-right" placeholder="Name">
												</label>
										    </div>
										</div>
										<div class="column-six">
											<div class="input-group-right">
												<label for="spousename" class="group label-input">
					                                <input type="text" id="spousename" name="spousename" class="input-right" placeholder="Spouse name if attending">
												</label>
										    </div>
										</div>
										<div class="column-twelve">
											<div class="input-group-right irequire">
												<label for="address" class="group label-input">
					                                <input type="text" id="address" name="address" class="input-right" placeholder="Address">
												</label>
										    </div>
										</div>
										<div class="column-six">
											<div class="input-group-right irequire">
												<label for="email" class="group label-input">
					                                <input type="text" id="email" name="email" class="input-right" placeholder="Email Id">
												</label>
										    </div>
										</div>
										<div class="column-six">
											<div class="input-group-right irequire">
												<label for="phonenumber" class="group label-input">
					                                <input type="text" id="phonenumber" name="phonenumber" class="input-right" placeholder="Phone Number">
												</label>
										    </div>
										</div>
										<div class="column-six">
											<div class="input-group-right irequire">
												<label for="batchyear" class="group label-input">
					                                <input type="text" id="batchyear" name="batchyear" class="input-right" placeholder="Batch Year">
												</label>
										    </div>
										</div>
										<div class="column-six">
											<div class="input-group-right irequire">
												<label for="course" class="group label-input">
					                                <input type="text" id="course" name="course" class="input-right" placeholder="Course Attended">
												</label>
										    </div>
										</div>
										<?php if($captcha == true){ ?>
										<div class="column-six">
		                                    <div class="captcha-group">
		                                        <div class="captcha center">
												    <img src="<?php echo $baseurl;?>php/captcha/captcha.php?<?php echo time();?>" alt="captcha">
											    </div>
		                                    </div>
		                                </div>
										<div class="column-six">
		                                    <div class="captcha-group">												
		                                        <label for="captcha" class="group label-captcha">
											        <input type="text" name="captcha" class="captcha center" id="captcha" maxlength="6" placeholder="Enter Verification Code">
												</label>
		                                    </div>
		                                </div>
										<?php } ?>
										<div class="column-four">
											<button type="submit" id="save-button" class="button button-large button-green">Save & Proceed to Payment</button>
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