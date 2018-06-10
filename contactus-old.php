<?php 
	session_start();
	$_SESSION['user_specific_token'] = $form_key = MD5($_SERVER['REMOTE_ADDR'].@$_SERVER['HTTP_USER_AGENT'].$_SERVER['SERVER_NAME'].date('FzY')); //So the key is [IP] + [user_agent] + [SERVER_NAME] + [August dayofyear 2008]
	if (substr_count($_SERVER['HTTP_ACCEPT_ENCODING'], 'gzip')) ob_start("ob_gzhandler"); else ob_start(); 
?>
<!DOCTYPE html>
<html lang="en" class="ui-mobile">
<head>
    <title>T1 Shopper Contact Us | Contact Information</title>
	<meta http-equiv="content-type" content="text/html; charset=UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1,maximum-scale=1">
	<meta name="robots" content="noindex">
	<link rel="shortcut icon" href="http://www.t1shopper.com/favicon.ico">
	<link rel="stylesheet" type="text/css" href="//ajax.googleapis.com/ajax/libs/jquerymobile/1.4.5/jquery.mobile.min.css">
	<link rel="stylesheet" href="//www.t1shopper.com/mobile/mobile.css">
	<link rel="stylesheet" href="//fonts.googleapis.com/css?family=Open+Sans:300,400,700">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
	<link rel="canonical" href="http://www.t1shopper.com/mobile/mobile3.php">
	<link rel="apple-touch-icon" href="http://www.t1shopper.com/mobile/apple-touch-icon.png">
	<link rel="apple-touch-icon" sizes="76x76" href="http://www.t1shopper.com/i/apple-touch-icon-76x76.png">
	<link rel="apple-touch-icon" sizes="120x120" href="http://www.t1shopper.com/i/apple-touch-icon-120x120.png">
	<link rel="apple-touch-icon" sizes="152x152" href="http://www.t1shopper.com/i/apple-touch-icon-152x152.png">
	<link rel="apple-touch-icon" sizes="180x180" href="http://www.t1shopper.com/i/apple-touch-icon-180x180.png">
	<link rel="icon" type="image/png" href="http://www.t1shopper.com/favicon-32x32.png" sizes="32x32">
	<link rel="icon" type="image/png" href="http://www.t1shopper.com/favicon-16x16.png" sizes="16x16">
	<link rel="manifest" href="http://www.t1shopper.com/manifest.json">
	<link rel="mask-icon" href="http://www.t1shopper.com/safari-pinned-tab.svg" color="#5bbad5">
	<meta name="theme-color" content="#ffffff">    
	<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
<?php
/*
	if(isset($_POST['btn-next'])) {
		$_SESSION['cap'] = $_POST;
		$nextpage = "contactus_results.php"; //"http://impacttest.xyz/t1shop/contactus_results.php";
		header("Location: $nextpage");
		exit();

		$secretKey = "6LerIlEUAAAAAE6xmWwDhqtKdIu4uboUAtMgsjsm";
		$responseKey = $_POST['g-recaptcha-response'];
		$userIP = $_SERVER['REMOTE_ADDR'];
		$url = "https://www.google.com/recaptcha/api/siteverify?secret=$secretKey&response=$responseKey&remoteip=$userIP";
		$response = json_decode(file_get_contents($url));
		if($response->success) {
			$nextpage = "http://impacttest.xyz/t1shop/contactus_results.php";
			header("Location: $nextpage");
		} else
			echo "<script>
					$(document).ready(function(){
						$('#lbl-captcha').css('color', 'red');
					});
				</script>";
	}
*/
?>
	<style>
		:root {
		  --z-9: 		9999;
		  --z-8: 		9998;
		  --light-gray: #f6f6f6;
		  --btn-next: 	#48851d;
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
			padding:		0.25rem 1rem 1rem 1rem;
			font-family:	Arial;
			font-size:		0.8em;
			line-height:	1.6em;
		}
		.contact-box>ul{text-align:justify}
		.contact{display:flex}
		.contact-label{flex:1;padding-right:0.5rem}
		.contact-data{flex:3.5;font-weight:bold}
		.contact-flex-input{
			flex:				3;
			order:				1;
			margin:				0 0 0 1rem
		}
		.contact-flex-label{
			flex:				1;
			order:				0;
			margin:				1rem 0.5rem 0.1rem 1rem
		}
		.contact-input-container{
			display:		flex;
			flex-direction:	row;
			margin:			0.5rem 1.25rem 0.5rem 0.25rem
		}
		 label{
			 width:			200px !important;
			 padding-left:	1.75rem;
			 font-size:		0.9em !important;
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
		.hdr-ad-height,.mnu-ad-height,{
			border:			0;
			text-align:		center;
		}
		/* screen-specific styles */
		@media (max-width:359px) {
			.adslot_1{width:234px;height:50px} 
			.hdr-ad-height{height:50px}
			.g-recaptcha{
				 transform:					scale(0.75);
				-webkit-transform:			scale(0.75);
				 transform-origin:			0 0;
				-webkit-transform-origin:	0 0;
			}
		}
		@media (min-width:360px) and (max-width:509px) {
			.hdr-ad-height{height:50px}
			.g-recaptcha{
				 transform:					scale(0.9);
				-webkit-transform:			scale(0.9);
				 transform-origin:			0 0;
				-webkit-transform-origin:	0 0;
			}
		}
		@media (min-width:510px) and (max-width:759px) {
			.adslot_1{width:468px;height:60px} 
			.hdr-ad-height{height:60px}
			.contact-box{padding-left:0}
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
		@media (max-width:680px) {
			.contact-input-container{flex-direction:column}
			.contact-flex-input{margin-left:1rem;margin-right:-1rem}
			.contact-flex-label{margin-left:0}
			.contact-box{padding-left:0}
			 label{width:100% !important}
		}
		.ui-loading .ui-loader{display:none}
		 html{height:auto !important}
	</style>
</head>
<body class="ui-mobile-viewport ui-overlay-a">
	<div data-role="page" class="jqm-demos jqm-home ui-page ui-page-theme-a ui-page-footer-fixed ui-page-active" id="page1" data-url="page1" tabindex="0" style="padding-bottom: 132px;">
		<div data-role="header" class="jqm-header">
			<h2 class="ui-title" aria-level="1"><img src="images/logo_t1_shopper.gif" alt="t1 Shopper Logo" class=""></h2>
			<a href="#" class="jqm-navmenu-link ui-alt-icon ui-btn-left ui-btn ui-icon-bars ui-btn-icon-notext" data-role="button" role="button">Menu</a>
			<a href="#" class="jqm-search-link ui-nodisc-icon ui-alt-icon ui-btn-right ui-btn ui-icon-search ui-btn-icon-notext ui-corner-all" data-role="button" role="button">Search</a>
		</div><!-- /header -->
		<div role="main" class="ui-content jqm-content">			
			<div class="contact-box">
				<div class="hdr-ad-height">
					<ins class="adsbygoogle adslot_1"
						 style="display:block"
						 data-ad-client="ca-pub-3647130182727233"
						 data-ad-slot="5063659030"></ins>
					<script>
						(adsbygoogle = window.adsbygoogle || []).push({});
					</script>
				</div>
				<ul>
					<li style="padding-bottom:1rem">T1 Shopper takes your requests, questions, and suggestions seriously. 
						We have provided the form below as the preferred method for you to contact us. 
						However, please feel free use our mailing address or facsimile below as well.
						<ul>
							<li>
								<div class="contact">
									<div class="contact-label">Support:</div>
									<div class="contact-data">(805) 557-0800</div>
								</div>
							</li>
							<li>
								<div class="contact">
									<div class="contact-label">Mailing address:</div>
									<div class="contact-data">T1 Shopper, Inc.<br>
											501-I South Reino Road, Suite 352<br>
											Newbury Park, CA &nbsp;&nbsp;91320
									</div>
								</div>
							</li>
							<li>
								<div class="contact">
									<div class="contact-label">Facsimile:</div>
									<div class="contact-data">(877) 571-1703  (toll free)</div>
								</div>
							</li>
						</ul>
					</li>
					<li>If you would like to <a href="/carriers/application/">join the T1 Shopper Network</a> 
						and you represent a telecommunications provider servicing North or South America, Ireland, 
						the UK, Africa, Western Europe or any of the Pacific Rim countries we are accepting applications to at this time.
					</li>
				</ul>
				<!-- Start Server Side Include Form -->
				<form style="display:block;clear:both" data-ajax="false" name="contact" method="post" action="contactus_results.php" style="margin:0">
					<div class="contact-input-container">
						<div class="contact-flex-label">
							<label for="name">Your Name:</label>
						</div>
						<div class="contact-flex-input">
							<input data-clear-btn="true" id="name" name="name" type="text" size=40 maxlength=80 tabindex="1"	
								value="<?php if(isset($_POST['name'])) echo htmlspecialchars($_POST['name']); ?>">
						</div>
					</div>
					<div class="contact-input-container">
						<div class="contact-flex-label">
							<label for="Email">Your e-mail address:</label>
						</div>
						<div class="contact-flex-input">
							<input data-clear-btn="true" name="Email" type="text" size=40 maxlength=80 tabindex="2"
								value="<?php if(isset($_POST['Email'])) echo htmlspecialchars($_POST['Email']); ?>">
						</div>
					</div>
					<div class="contact-input-container">
						<div class="contact-flex-label">
							<label for="emailsubject">Subject:</label>
						</div>
						<div class="contact-flex-input">
							<input data-clear-btn="true" name="emailsubject" type="text" size=80 maxlength=80 tabindex="3"
								value="<?php if(isset($_POST['emailsubject'])) echo htmlspecialchars($_POST['emailsubject']); ?>">
						</div>
					</div>
					<div class="contact-input-container">
						<div class="contact-flex-label">
							<label for="comments">Comments/Questions:</label>
						</div>
						<div class="contact-flex-input">
							<textarea name="comments" cols="70" rows="8" tabindex="4"><?php if(isset($_POST['comments'])) echo htmlspecialchars($_POST['comments']); ?></textarea>
						</div>
					</div>
					<div class="contact-input-container">
						<div class="contact-flex-label">
							<label id="lbl-captcha">Click/Tap checkbox to submit the form:</label>
						</div>
						<div class="contact-flex-input">
							<div id="re-captcha" tabindex="5" class="g-recaptcha" data-sitekey="6LerIlEUAAAAAHEBriycoa5KzTOrvwRP6qYShh9v"
							data-callback="recaptcha_callback"></div>
						</div>
					</div>
				</form>
				<!-- End Server Side Include Form -->
			</div>
		</div><!-- /content -->
		<div data-role="panel" class="jqm-navmenu-panel ui-panel ui-panel-position-left ui-panel-display-overlay ui-panel-closed ui-body-a ui-panel-animate" data-position="left" data-display="overlay" data-theme="a">
			<div class="ui-panel-inner">
				<ul class="jqm-list ui-alt-icon ui-nodisc-icon ui-listview">
					<li data-icon="home" class="ui-first-child"><a href="http://www.t1shopper.com/mobile/" class="ui-btn ui-btn-icon-right ui-icon-home">Home</a></li>
					<li data-role="collapsible" data-enhanced="true" data-collapsed-icon="carat-d" data-expanded-icon="carat-u" data-iconpos="right" data-inset="false" class="ui-collapsible ui-collapsible-themed-content ui-li-static ui-body-inherit ui-collapsible-collapsed">
						<h3 class="ui-collapsible-heading ui-collapsible-heading-collapsed">
							<a href="http://www.t1shopper.com/service/t1/t1-line.shtml" class="ui-collapsible-heading-toggle ui-btn ui-btn-icon-right ui-btn-inherit ui-icon-carat-d">Pricing & Information<span class="ui-collapsible-heading-status"> click to expand contents</span></a>
						</h3>
						<div class="ui-collapsible-content ui-body-inherit ui-collapsible-content-collapsed" aria-hidden="true">
							<ul class="ui-listview">
								<li><a href="http://www.t1shopper.com/service/t1/t1-line.shtml" data-ajax="false" class="ui-btn ui-btn-icon-right ui-icon-carat-r">T1 Line Pricing</a></li>
								<li><a href="http://www.t1shopper.com/service/fractional-t1/fractional-t1.shtml" data-ajax="false" class="ui-btn ui-btn-icon-right ui-icon-carat-r">Fractional T1</a></li>
								<li><a href="http://www.t1shopper.com/service/t3/t3-line.shtml" data-ajax="false" class="ui-btn ui-btn-icon-right ui-icon-carat-r">T3 Line</a></li>
								<li><a href="http://www.t1shopper.com/service/ip-vpn/mpls-vpn.shtml" data-ajax="false" class="ui-btn ui-btn-icon-right ui-icon-carat-r">VPN Services</a></li>
								<li><a href="http://www.t1shopper.com/carriers/sla/" data-ajax="false" class="ui-btn ui-btn-icon-right ui-icon-carat-r">SLA Report</a></li>
								<li><a href="http://www.t1shopper.com/toppicks.shtml" data-ajax="false" class="ui-btn ui-btn-icon-right ui-icon-carat-r">Most Popular</a></li>
							</ul>
						</div>
					</li>
					<li data-role="collapsible" data-enhanced="true" data-collapsed-icon="carat-d" data-expanded-icon="carat-u" data-iconpos="right" data-inset="false" class="ui-collapsible ui-collapsible-themed-content ui-li-static ui-body-inherit ui-collapsible-collapsed">
						<h3 class="ui-collapsible-heading ui-collapsible-heading-collapsed">
							<a href="http://www.t1shopper.com/voip/" class="ui-collapsible-heading-toggle ui-btn ui-btn-icon-right ui-btn-inherit ui-icon-carat-d">Internet Phone Service<span class="ui-collapsible-heading-status"> click to expand contents</span></a>
						</h3>
						<div class="ui-collapsible-content ui-body-inherit ui-collapsible-content-collapsed" aria-hidden="true">
							<ul class="ui-listview">
								<li><a href="http://www.t1shopper.com/voip/" data-ajax="false" class="ui-btn ui-btn-icon-right ui-icon-carat-r">VOIP Providers</a></li>
							</ul>
						</div>
					</li>
					<li data-role="collapsible" data-enhanced="true" data-collapsed-icon="carat-d" data-expanded-icon="carat-u" data-iconpos="right" data-inset="false" class="ui-collapsible ui-collapsible-themed-content ui-li-static ui-body-inherit ui-collapsible-collapsed">
						<h3 class="ui-collapsible-heading ui-collapsible-heading-collapsed">
							<a href="http://www.t1shopper.com/carriers/" class="ui-collapsible-heading-toggle ui-btn ui-btn-icon-right ui-btn-inherit ui-icon-carat-d">T1 Service Providers<span class="ui-collapsible-heading-status"> click to expand contents</span></a>
						</h3>
						<div class="ui-collapsible-content ui-body-inherit ui-collapsible-content-collapsed" aria-hidden="true">
							<ul class="ui-listview">
								<li><a href="http://www.t1shopper.com/carriers/" data-ajax="false" class="ui-btn ui-btn-icon-right ui-icon-carat-r">North America</a></li>
								<li><a href="http://www.t1shopper.com/carriers/wireless" data-ajax="false" class="ui-btn ui-btn-icon-right ui-icon-carat-r">Fixed Wireless</a></li>
								<li><a href="http://www.t1shopper.com/carriers/international.php" data-ajax="false" class="ui-btn ui-btn-icon-right ui-icon-carat-r">International</a></li>
							</ul>
						</div>
					</li>
					<li data-role="collapsible" data-enhanced="true" data-collapsed-icon="carat-d" data-expanded-icon="carat-u" data-iconpos="right" data-inset="false" class="ui-collapsible ui-collapsible-themed-content ui-li-static ui-body-inherit ui-collapsible-collapsed">
						<h3 class="ui-collapsible-heading ui-collapsible-heading-collapsed">
							<a href="http://www.t1shopper.com/tools/" class="ui-collapsible-heading-toggle ui-btn ui-btn-icon-right ui-btn-inherit ui-icon-carat-d">Tools<span class="ui-collapsible-heading-status"> click to expand contents</span></a>
						</h3>
						<div class="ui-collapsible-content ui-body-inherit ui-collapsible-content-collapsed" aria-hidden="true">
							<ul class="ui-listview">
								<li><a href="http://www.t1shopper.com/tools/speedtest/" data-ajax="false" class="ui-btn ui-btn-icon-right ui-icon-carat-r">Speed Test</a></li>
								<li><a href="http://www.t1shopper.com/tools/traceroute/" data-ajax="false" class="ui-btn ui-btn-icon-right ui-icon-carat-r">Traceroute</a></li>
								<li><a href="http://www.t1shopper.com/tools/calculate/ip-subnet/" data-ajax="false" class="ui-btn ui-btn-icon-right ui-icon-carat-r">Subnet Calculator</a></li>
								<li><a href="http://www.t1shopper.com/tools/" data-ajax="false" class="ui-btn ui-btn-icon-right ui-icon-carat-r">Whois/Ping/More</a></li>
								<li><a href="mobile4.html" data-ajax="false" class="ui-btn ui-btn-icon-right ui-icon-carat-r">Port Scanner</a></li>
								<li><a href="http://www.t1shopper.com/tools/http-headers.php" data-ajax="false" class="ui-btn ui-btn-icon-right ui-icon-carat-r">HTTP Headers</a></li>
								<li><a href="http://www.t1shopper.com/tools/calculate/" data-ajax="false" class="ui-btn ui-btn-icon-right ui-icon-carat-r">File Size Calculator</a></li>
								<li><a href="http://www.t1shopper.com/tools/calculate/downloadcalculator.php" data-ajax="false" class="ui-btn ui-btn-icon-right ui-icon-carat-r">File Transfer Calculator</a></li>
								<li><a href="http://www.t1shopper.com/definitions.shtml" data-ajax="false" class="ui-btn ui-btn-icon-right ui-icon-carat-r">Telcom Definitions</a></li>
							</ul>
						</div>
					</li>
					<li><a href="http://www.t1shopper.com/aboutus.shtml" class="ui-btn ui-btn-icon-right ui-icon-carat-r">About Us</a></li>
					<li><a style="border-bottom:0" href="http://www.t1shopper.com/contactus/" class="ui-btn ui-btn-icon-right ui-icon-carat-r">Contact Us</a></li>
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
			<p class="">Use of these services are subject to these <a href="http://www.t1shopper.com/termsofuse.shtml" class="ui-link">term of use</a> and <a href="http://www.t1shopper.com/privacypolicy.shtml" class="ui-link">privacy policy</a>.  Colocation and bandwidth by <a href="http://www.uscolo.com/" target="_blank" class="ui-link">U.S. Colo</a></p>
			<p>© 2003-<?php echo date("Y"); ?> T1 Shopper, Inc. All Rights Reserved.&nbsp; T1 Shopper is a pending registered trademark in the USA and Canada.</p>
		</div><!-- /footer -->
	</div><!-- /page -->
	<script async src="//www.t1shopper.com/mobile/jquerymobile.1.4.5.assets.index.js"></script>
	<script async src="//ajax.googleapis.com/ajax/libs/jquerymobile/1.4.5/jquery.mobile.min.js"></script>
	<script async src='https://www.google.com/recaptcha/api.js'></script>
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
	<script type="text/javascript">
		function recaptcha_callback() {
			document.forms['contact'].submit();
		};                                 
	</script>
</body>
</html>
