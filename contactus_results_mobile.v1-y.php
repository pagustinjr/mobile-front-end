<?php
session_start();
/*
if (empty($_SESSION)) {require_once '/home/t1shopper/www/cookies.html'; exit();}  
*/
if (empty($_SESSION['user_specific_token']) || $_SESSION['user_specific_token'] != MD5($_SERVER['REMOTE_ADDR'].$_SERVER['HTTP_USER_AGENT'].parse_url($_SERVER['HTTP_REFERER'], PHP_URL_HOST).date('FzY'))) {   
    header('Location: https://www.t1shopper.com/xss.html');
    exit();
} else {
    $_SESSION['user_specific_token'] = $form_key = MD5($_SERVER['REMOTE_ADDR'].$_SERVER['HTTP_USER_AGENT'].$_SERVER['SERVER_NAME'].date('FzY')); //So the key is [IP] + [user_agent] + [SERVER_NAME] + [August dayofyear 2008]
}
/*
date_default_timezone_set('America/Los_Angeles');  

require '/usr/share/pear/helper_functions/hf.php';        

//$link = mysql_connect('localhost', 'localhostro', 'pr_PH7=9');
if (is_blacklisted($_SERVER['REMOTE_ADDR']) !== FALSE) {//IP is black listed, do not allow them to submit form.
    header('HTTP/1.0 403 Forbidden'); 
    exit();   
    //Used to help them out as to why we were not going to allow them to submit their form but not anymore.
	echo "
	<html><head><body>
	Your IP address, ".$_SERVER["REMOTE_ADDR"].", is listed in one or more of the below blacklists: 
	<a href='//www.spamhaus.org/query/bl?ip=".$_SERVER["REMOTE_ADDR"]."'>Spamhaus Exploits Block List</a>, 
	<a href='//www.projecthoneypot.org/search_ip.php?ip=".$_SERVER["REMOTE_ADDR"]."'>Project HoneyPot Block List</a> and/or the
	<a href='//www.sorbs.net/lookup.shtml?".$_SERVER["REMOTE_ADDR"]."'>SORBS Open HTTP/SOCKS Proxy Servers Block List</a>.  
	Before you can use this form, you need to get your IP address delisted from these services.
	</body></html>";
} 

if (count($_POST)) {
	$_SESSION["emailsubject"] = htmlspecialchars($_POST['emailsubject']);
	$_SESSION["submitdate"] = date("F j, Y, g:i a").' PST from an IP address of <a href="http://www.fixedorbit.com/cgi-bin/cgiip.exe?Machine='.$_SERVER["REMOTE_ADDR"].'">'.$_SERVER['REMOTE_ADDR'].'</a>';
	$_SESSION["name"] = htmlspecialchars($_POST['name']);
	$_SESSION["emailto"] = htmlspecialchars($_POST['Email']).'?subject=Reply from T1 Shopper - '.htmlspecialchars($_POST['emailsubject']).'&body=Dear '.htmlspecialchars($_POST['name']);
	$_SESSION["comment"] = htmlspecialchars(trim($_POST['comments']));
	$_SESSION["email"] = htmlspecialchars($_POST['Email']);

	$body='
		<table width="100%"  border="0" cellpadding="3">
		  <tr>
			<td align="right" valign="top"><div align="right" class="style4">Subject: </div></td>
			<td><div align="left" class="style4">'.$_SESSION["emailsubject"].'</div></td>
		  </tr>
		  <tr>
			<td align="right" valign="top"><div align="right" class="style4">Date: </div></td>
			<td><div align="left" class="style4">'.$_SESSION["submitdate"].'</div></td>
		  </tr>
		  <tr>
			<td align="right" valign="top"><div align="right" class="style4">Name:</div></td>
			<td width="100%"><div align="left" class="style4">'.$_SESSION["name"].'</div></td>
		  </tr>
		  </tr>
		  <tr>
			<td align="right" valign="top"><div align="right" class="style4">eMail:</div></td>
			<td width="100%"><div align="left" class="style4"><a href="mailto:'.$_SESSION["emailto"].'">'.$_SESSION["email"].'</a></div></td>
		  </tr>
		  <tr>
			<td align="right" valign="top"><span class="style4">Message:</span></td>
			<td width="100%" valign="top"><p class="style4">'.$_SESSION["comment"].'</p>
			</td>
		  </tr>
		</table>';

	require 'class.smtp.php';
	require 'class.phpmailer.php'; 

	$mail = new PHPMailer(true); // the true param means it will throw exceptions on errors, which we need to catch
	$mail->IsSMTP(); // telling the class to use SMTP

	try {
		$mail->Host = 'smtp.gmail.com';  // specify main and backup server
		$mail->SMTPAuth = true;     // turn on SMTP authentication
		$mail->SMTPSecure = 'tsl';
		$mail->Port = 587;  
		$mail->Username = 'impact.ticket.test1';  // SMTP username
		$mail->Password = 'ybrik2017'; // SMTP password
		$mail->AddReplyTo($_SESSION["email"], $_SESSION['name']);
		$mail->AddAddress($_SESSION["email"], $_SESSION['name']);
		$mail->AddAddress('impact.ticket.test1@gmail.com', 'T1 Shopper Client Services');
		$mail->SetFrom('impact.ticket.test1@gmail.com', 'T1 Shopper Client Services');
		$mail->Subject = 'T1 Shopper - '. $_SESSION['emailsubject'];
		$body = "<style type='text/css'>\n<!--\n .style4 {font-family: Arial, Helvetica, sans-serif; font-size: 12pt; }\n -->\n </style>\n".$body;
		$mail->MsgHTML($body);
		$mail->Send();
	} catch (phpmailerException $e) {
		echo '<html><body><h1>Error!</h1><ul><li>',htmlspecialchars($e->errorMessage()).'</li></ul></body></html>'; //Pretty error messages from PHPMailer
		exit();
	} catch (Exception $e) {
		echo '<html><body><h1>Error!</h1><ul><li>',htmlspecialchars($e->getMessage()).'</li></ul></body></html>';    //Boring error messages from anything else! 
		exit();
	}
}
*/
echo '
<!DOCTYPE html>
<html lang="en" class="ui-mobile">
<head>
	<title>T1 Shopper - Contact Us Results</title>
	<meta http-equiv="content-type" content="text/html; charset=UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1,maximum-scale=1">
	<meta name="robots" content="noindex">
	<link rel="shortcut icon" href="//www.t1shopper.com/favicon.ico">
	<link rel="stylesheet" type="text/css" href="//ajax.googleapis.com/ajax/libs/jquerymobile/1.4.5/jquery.mobile.min.css">
	<link rel="stylesheet" href="css/mobile.css">
	<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
	<link rel="stylesheet" href="//fonts.googleapis.com/css?family=Open+Sans:300,400,700">
	<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="apple-touch-icon" href="//www.t1shopper.com/mobile/apple-touch-icon.png">
	<link rel="apple-touch-icon" sizes="76x76" href="//www.t1shopper.com/i/apple-touch-icon-76x76.png">
	<link rel="apple-touch-icon" sizes="120x120" href="//www.t1shopper.com/i/apple-touch-icon-120x120.png">
	<link rel="apple-touch-icon" sizes="152x152" href="//www.t1shopper.com/i/apple-touch-icon-152x152.png">
	<link rel="apple-touch-icon" sizes="180x180" href="//www.t1shopper.com/i/apple-touch-icon-180x180.png">
	<link rel="icon" type="image/png" href="//www.t1shopper.com/favicon-32x32.png" sizes="32x32">
	<link rel="icon" type="image/png" href="//www.t1shopper.com/favicon-16x16.png" sizes="16x16">
	<link rel="manifest" href="//www.t1shopper.com/manifest.json">
	<link rel="mask-icon" href="//www.t1shopper.com/safari-pinned-tab.svg" color="#5bbad5">
	<meta name="theme-color" content="#ffffff">    
	<style>
		:root {
		  --z-9: 		9999;
		  --z-8: 		9998;
		  --light-gray: #f6f6f6;
		  --btn-next: 	#48851d;
		}
		#img-captcha{
			width:100%;
			max-width:561px;
			height:auto;
		}
		 hr{
			 color:gray;
			 background-color:gray;
			 border:none;
			 height:1px;
		}
		.fa-ul				{font-weight:bold;text-align:justify;margin-right:1.5rem}
		.jqm-header			{z-index:var(--z-8);position:fixed;width:100%;background-color:#fff}
		.jqm-navmenu-panel,
		.jqm-search-panel	{z-index:var(--z-9);background-color:var(--light-gray)}
		.jqm-content		{margin-top:1rem;margin-bottom:1rem}
		.jqm-list>li>a,
		.jqm-list>li>h3>a,
		.ui-listview>li>a	{padding:0.5rem}
		.required			{color:red;font-weight:bold}
		.ui-button			{width:50%}
		#btn-next.ui-btn-a	{color:#fff;background-color: var(--btn-next)}
		/* form input styles */
		 form{margin-top:0.5rem}
		.contact-box{
			margin-top:		1rem;
			padding:		0.25rem 1rem 1rem 1rem;
			font-family:	Arial;
			font-size:		0.8em;
			line-height:	1.6em;
			border:			1px solid #f0f0f0;
			border-radius:	7px;
			background-color:#fff
		}
		.contact{display:flex}
		.contact-label{flex:1}
		.contact-data{flex:4;font-weight:bold}
		.contact-flex-input{
			flex:			3;
			order:			1;
			margin:			1rem 0 0 1rem
		}
		.contact-flex-label{
			font-weight:	bold;
			text-align:		right;
			flex:			1;
			order:			0;
			margin:			1rem 0.5rem 0.1rem 1rem
		}
		.contact-input-container{
			display:		flex;
			flex-direction:	row;
			margin:			0.5rem 1.25rem 0.5rem 0.25rem
		}
		 label{
			 width:			200px !important;
			 padding-left:	1.75rem;
			 font-size:		0.8em !important;
			 font-weight:	bold !important
		}
		#btn-container{width:100%;text-align:center}

		/* ad styles */		
		.adslot_1{width:320px;height:50px;margin:0 auto}
		.adslot_2{width:468px;height:60px;margin:0 auto}
		.adslot_3{width:336px;height:280px;margin:0 auto}
		.adslot_4{width:970px;height:90px;margin:0 auto}
		.hdr-ad-height{
			display:		block;
			height:			60px;
			width:			100%;	
			margin:			0.25rem auto
		}
		.mnu-ad-height{
			display:		none;
			height:			280px;
			width:			100%;	
			margin-top:		-2.75rem;
			padding-top:	0;
			z-index:		var(--z-9);
		}
		.hdr-ad-height,.mnu-ad-height{
			border:			0;
			text-align:		center;
		}
		/* screen-specific styles */
		@media (max-width:359px) {
			.adslot_1{width:234px;height:50px} 
			.hdr-ad-height{height:50px}
		}
		@media (min-width:360px) and (max-width:509px) {
			.hdr-ad-height{height:50px}
		}
		@media (min-width:510px) and (max-width:759px) {
			.adslot_1{width:468px;height:60px} 
			.hdr-ad-height{height:60px}
		}
		@media (min-width:760px) and (max-width:799px) {
			.adslot_1{width:468px;height:90px} 
			.hdr-ad-height{height:90px}
		}
		@media (min-width:800px){
			.adslot_1{width:728px;height:90px}
			.hdr-ad-height{height:90px}
		}
		@media (min-width:960px){
			.adslot_1{width:468px;height:60px}
			.hdr-ad-height{height:60px}
			.mnu-ad-height{display:block}
			.jqm-navmenu-panel{margin-top:3.5rem !important;z-index:9997}
			.jqm-content{margin-top:4.75rem}
		}
		@media (min-width:960px) and (max-width:1039px){
			.adslot_3{width:200px;height:200px} 
			.adslot_1{width:468px;height:60px}
			.hdr-ad-height{height:60px}
		}
		@media (min-width:1040px) and (max-width:1359px){
			.adslot_3{width:250px;height:250px} 
			.adslot_1{width:468px;height:60px}
			.hdr-ad-height{height:60px}
		}
		.ui-loading .ui-loader{display:none}
		@media (max-width:680px) {
			.contact-input-container{flex-direction:column}
			.contact-flex-input{padding-left:1.5rem}
			.contact-flex-label{text-align:left}
		 }
	</style>
</head>
<body class="ui-mobile-viewport ui-overlay-a" onLoad="document.contact.name.focus();clock();readID();"><!-- T1 Shopper provides T1 line prices DSL service T1 connection T3 line and DS3 internet service provider availability and pricing services -->
	<div data-role="page" class="jqm-demos jqm-home ui-page ui-page-theme-a ui-page-footer-fixed ui-page-active" id="page1" data-url="page1" tabindex="0" style="padding-bottom: 132px;">
		<div data-role="header" class="jqm-header">
			<h2 class="ui-title" aria-level="1"><img src="/i/logo_t1_shopper.gif" alt="t1 Shopper Logo" class=""></h2>
			<a href="#" class="jqm-navmenu-link ui-alt-icon ui-btn-left ui-btn ui-icon-bars ui-btn-icon-notext" data-role="button" role="button">Menu</a>
			<a href="#" class="jqm-search-link ui-nodisc-icon ui-alt-icon ui-btn-right ui-btn ui-icon-search ui-btn-icon-notext ui-corner-all" data-role="button" role="button">Search</a>
		</div><!-- /header -->
		<div role="main" class="ui-content jqm-content">			
			<div class="hdr-ad-height">
				<ins class="adsbygoogle adslot_1"
					 style="display:block"
					 data-ad-client="ca-pub-3647130182727233"
					 data-ad-slot="5063659030"></ins>
				<script>
					(adsbygoogle = window.adsbygoogle || []).push({});
				</script>
			</div>
			<!-- Start main body -->
			<div class="contact-box">
				<div style="text-align:center">
					<h1>Your form submission was successful!</h1>
					<HR style="width:40%">
					T1 Shopper has received your information and will respond in the next business day.<br>
					A copy of the information received by T1 Shopper is shown below.
					<HR style="width:80%">
				</div>
				<div class="contact-input-container">
					<div class="contact-flex-label">Subject:</div>
					<div class="contact-flex-input">',$_SESSION["emailsubject"],'</div>
				</div>
				<div class="contact-input-container">
					<div class="contact-flex-label">Date:</div>
					<div class="contact-flex-input">'.$_SESSION["submitdate"].'</div>
				</div>
				<div class="contact-input-container">
					<div class="contact-flex-label">Name:</div>
					<div class="contact-flex-input">',$_SESSION["name"],'</div>
				</div>
				<div class="contact-input-container">
					<div class="contact-flex-label">eMail:</div>
					<div class="contact-flex-input"><a href="mailto:'.$_SESSION["emailto"].'">'.$_SESSION["email"].'</a></div>
				</div>
				<div class="contact-input-container">
					<div class="contact-flex-label">Message:</div>
					<div class="contact-flex-input">',$_SESSION["comment"],'</div>
				</div>
			</div>
			<!-- End main body -->
		</div><!-- /content -->
 		<div data-role="panel" class="jqm-navmenu-panel ui-panel ui-panel-position-left ui-panel-display-overlay ui-panel-closed ui-body-a ui-panel-animate" data-position="left" data-display="overlay" data-theme="a">
			<div class="ui-panel-inner">
				<ul class="jqm-list ui-alt-icon ui-nodisc-icon ui-listview">
					<li data-icon="home" class="ui-first-child"><a href="//www.t1shopper.com/mobile/" class="ui-btn ui-btn-icon-right ui-icon-home">Home</a></li>
					<li data-role="collapsible" data-enhanced="true" data-collapsed-icon="carat-d" data-expanded-icon="carat-u" data-iconpos="right" data-inset="false" class="ui-collapsible ui-collapsible-themed-content ui-li-static ui-body-inherit ui-collapsible-collapsed">
						<h3 class="ui-collapsible-heading ui-collapsible-heading-collapsed">
							<a href="//www.t1shopper.com/service/t1/t1-line.shtml" class="ui-collapsible-heading-toggle ui-btn ui-btn-icon-right ui-btn-inherit ui-icon-carat-d">Pricing & Information<span class="ui-collapsible-heading-status"> click to expand contents</span></a>
						</h3>
						<div class="ui-collapsible-content ui-body-inherit ui-collapsible-content-collapsed" aria-hidden="true">
							<ul class="ui-listview">
								<li><a href="//www.t1shopper.com/service/t1/t1-line.shtml" data-ajax="false" class="ui-btn ui-btn-icon-right ui-icon-carat-r">T1 Line Pricing</a></li>
								<li><a href="//www.t1shopper.com/service/fractional-t1/fractional-t1.shtml" data-ajax="false" class="ui-btn ui-btn-icon-right ui-icon-carat-r">Fractional T1</a></li>
								<li><a href="//www.t1shopper.com/service/t3/t3-line.shtml" data-ajax="false" class="ui-btn ui-btn-icon-right ui-icon-carat-r">T3 Line</a></li>
								<li><a href="//www.t1shopper.com/service/ip-vpn/mpls-vpn.shtml" data-ajax="false" class="ui-btn ui-btn-icon-right ui-icon-carat-r">VPN Services</a></li>
								<li><a href="//www.t1shopper.com/carriers/sla/" data-ajax="false" class="ui-btn ui-btn-icon-right ui-icon-carat-r">SLA Report</a></li>
								<li><a href="//www.t1shopper.com/toppicks.shtml" data-ajax="false" class="ui-btn ui-btn-icon-right ui-icon-carat-r">Most Popular</a></li>
							</ul>
						</div>
					</li>
					<li data-role="collapsible" data-enhanced="true" data-collapsed-icon="carat-d" data-expanded-icon="carat-u" data-iconpos="right" data-inset="false" class="ui-collapsible ui-collapsible-themed-content ui-li-static ui-body-inherit ui-collapsible-collapsed">
						<h3 class="ui-collapsible-heading ui-collapsible-heading-collapsed">
							<a href="//www.t1shopper.com/voip/" class="ui-collapsible-heading-toggle ui-btn ui-btn-icon-right ui-btn-inherit ui-icon-carat-d">Internet Phone Service<span class="ui-collapsible-heading-status"> click to expand contents</span></a>
						</h3>
						<div class="ui-collapsible-content ui-body-inherit ui-collapsible-content-collapsed" aria-hidden="true">
							<ul class="ui-listview">
								<li><a href="//www.t1shopper.com/voip/" data-ajax="false" class="ui-btn ui-btn-icon-right ui-icon-carat-r">VOIP Providers</a></li>
							</ul>
						</div>
					</li>
					<li data-role="collapsible" data-enhanced="true" data-collapsed-icon="carat-d" data-expanded-icon="carat-u" data-iconpos="right" data-inset="false" class="ui-collapsible ui-collapsible-themed-content ui-li-static ui-body-inherit ui-collapsible-collapsed">
						<h3 class="ui-collapsible-heading ui-collapsible-heading-collapsed">
							<a href="//www.t1shopper.com/carriers/" class="ui-collapsible-heading-toggle ui-btn ui-btn-icon-right ui-btn-inherit ui-icon-carat-d">T1 Service Providers<span class="ui-collapsible-heading-status"> click to expand contents</span></a>
						</h3>
						<div class="ui-collapsible-content ui-body-inherit ui-collapsible-content-collapsed" aria-hidden="true">
							<ul class="ui-listview">
								<li><a href="//www.t1shopper.com/carriers/" data-ajax="false" class="ui-btn ui-btn-icon-right ui-icon-carat-r">North America</a></li>
								<li><a href="//www.t1shopper.com/carriers/wireless" data-ajax="false" class="ui-btn ui-btn-icon-right ui-icon-carat-r">Fixed Wireless</a></li>
								<li><a href="//www.t1shopper.com/carriers/international.php" data-ajax="false" class="ui-btn ui-btn-icon-right ui-icon-carat-r">International</a></li>
							</ul>
						</div>
					</li>
					<li data-role="collapsible" data-enhanced="true" data-collapsed-icon="carat-d" data-expanded-icon="carat-u" data-iconpos="right" data-inset="false" class="ui-collapsible ui-collapsible-themed-content ui-li-static ui-body-inherit ui-collapsible-collapsed">
						<h3 class="ui-collapsible-heading ui-collapsible-heading-collapsed">
							<a href="//www.t1shopper.com/tools/" class="ui-collapsible-heading-toggle ui-btn ui-btn-icon-right ui-btn-inherit ui-icon-carat-d">Tools<span class="ui-collapsible-heading-status"> click to expand contents</span></a>
						</h3>
						<div class="ui-collapsible-content ui-body-inherit ui-collapsible-content-collapsed" aria-hidden="true">
							<ul class="ui-listview">
								<li><a href="//www.t1shopper.com/tools/speedtest/" data-ajax="false" class="ui-btn ui-btn-icon-right ui-icon-carat-r">Speed Test</a></li>
								<li><a href="//www.t1shopper.com/tools/traceroute/" data-ajax="false" class="ui-btn ui-btn-icon-right ui-icon-carat-r">Traceroute</a></li>
								<li><a href="//www.t1shopper.com/tools/calculate/ip-subnet/" data-ajax="false" class="ui-btn ui-btn-icon-right ui-icon-carat-r">Subnet Calculator</a></li>
								<li><a href="//www.t1shopper.com/tools/" data-ajax="false" class="ui-btn ui-btn-icon-right ui-icon-carat-r">Whois/Ping/More</a></li>
								<li><a href="mobile4.html" data-ajax="false" class="ui-btn ui-btn-icon-right ui-icon-carat-r">Port Scanner</a></li>
								<li><a href="//www.t1shopper.com/tools/http-headers.php" data-ajax="false" class="ui-btn ui-btn-icon-right ui-icon-carat-r">HTTP Headers</a></li>
								<li><a href="//www.t1shopper.com/tools/calculate/" data-ajax="false" class="ui-btn ui-btn-icon-right ui-icon-carat-r">File Size Calculator</a></li>
								<li><a href="//www.t1shopper.com/tools/calculate/downloadcalculator.php" data-ajax="false" class="ui-btn ui-btn-icon-right ui-icon-carat-r">File Transfer Calculator</a></li>
								<li><a href="//www.t1shopper.com/definitions.shtml" data-ajax="false" class="ui-btn ui-btn-icon-right ui-icon-carat-r">Telcom Definitions</a></li>
							</ul>
						</div>
					</li>
					<li><a href="//www.t1shopper.com/aboutus.shtml" class="ui-btn ui-btn-icon-right ui-icon-carat-r">About Us</a></li>
					<li><a style="border-bottom:0" href="//www.t1shopper.com/contactus/" class="ui-btn ui-btn-icon-right ui-icon-carat-r">Contact Us</a></li>
				</ul>
			</div>
			<div class="mnu-ad-height" style="">
			<!-- VOIP336x280 -->
				<ins class="adsbygoogle adslot_3"
					 style="display:inline-block"
					 data-ad-client="ca-pub-3647130182727233"
					 data-ad-slot="3894607171"></ins>
				<script>
				(adsbygoogle = window.adsbygoogle || []).push({});
				</script>
			</div>
		</div><!-- /panel -->
		<div data-role="panel" class="jqm-search-panel ui-panel ui-panel-position-right ui-panel-display-overlay ui-panel-closed ui-body-a ui-panel-animate" data-position="right" data-display="overlay" data-theme="a">
			<div class="jqm-search">
				<h3>Broadband Service Search</h3>
				<form name=f method=POST data-ajax="false" action="enter_street_address.php">
					<input type=hidden  name=id>
					<input data-type="search" name=install_phone type=tel maxlength=5 placeholder="ZIP Code for Service">
					<button id="btn-next" type="submit" data-mini="true" class="ui-btn ui-btn-a ui-icon-check ui-btn-icon-left ui-btn-inline ui-shadow ui-corner-all">Get Providers</button>
				</form>
			</div>
		</div><!-- /panel -->
		<div data-role="footer" data-position="fixed" data-tap-toggle="false" class="jqm-footer ui-footer ui-bar-inherit ui-footer-fixed slideup" role="contentinfo">
			<p class="">Use of these services are subject to these <a href="//www.t1shopper.com/termsofuse.shtml" class="ui-link">term of use</a> and <a href="//www.t1shopper.com/privacypolicy.shtml" class="ui-link">privacy policy</a>.  Colocation and bandwidth by <a href="//www.uscolo.com/" target="_blank" class="ui-link">U.S. Colo</a></p>
			<p>&copy; 2003-',date("Y"),' T1 Shopper, Inc. All Rights Reserved.&nbsp; T1 Shopper is a pending registered trademark in the USA and Canada.</p>
		</div><!-- /footer -->
	</div><!-- /page -->
	<script async src="js/jquerymobile.1.4.5.assets.index.js"></script>
	<script async src="//ajax.googleapis.com/ajax/libs/jquerymobile/1.4.5/jquery.mobile.min.js"></script>
	<script async src="//www.t1shopper.com/ssi/t1shopper.js"></script>
	<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
	<script>
		$( document ).ready(function() {
			var width = $(window).width(), height = $(window).height();
			$( window ).resize(function() {
				if($(window).width() != width && $(window).height() != height) {		
				window.location.href=window.location.href;
			}
			});
		});
	</script>
</body></html>'
?>