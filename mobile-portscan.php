<?php 
ini_set('output_buffering',10);
ob_implicit_flush(1);
$requester_ip=$_SERVER['REMOTE_ADDR'];
$device_ip=FALSE;

$array_of_ports=array();
$device_port_min=FALSE;
$device_port_max=FALSE;
if (!empty($_REQUEST['ports'])) {
    /*
    * If the Customer filled out the ports form then use it first and ignore everything else.
    */
    preg_match_all('/[0-9]+/',$_REQUEST['ports'],$matches); //Test at command line like this: php -r "preg_match_all('/[0-9]+/','80|443,34dfsg45a78 2345',\$matches); print_r(\$matches);"
    $array_of_ports=$matches[0];
} elseif (!empty($_REQUEST['port_array'])) {
    /*
    * If the Customer filled out the portnumber then use it ignore everything else.
    */    
    if (is_array($_REQUEST['port_array'])) {
        foreach ($_REQUEST['port_array'] as $key => $value) {
            $array_of_ports[]=preg_replace('/[^0-9.]*/','', $value);
        }        
    } else {
        $array_of_ports[]=preg_replace('/[^0-9.]*/','', $_REQUEST['port_array']);       
    }
} else {
	$device_port_min    =preg_replace('/[^0-9.]*/','', @$_REQUEST['port_start']); //Zero is a valid port!
	$device_port_max    =preg_replace('/[^0-9.]*/','', @$_REQUEST['port_end']); 
    if (ctype_digit($device_port_min) && ctype_digit($device_port_max)) {
        if (($device_port_max-$device_port_min)>0) {
            /*
            * If the max and min are the same, then don't use range, just use a single port number, otherwise the function "range" thows errors. 
            */        
            $array_of_ports = range($device_port_min, $device_port_max);
        } else {
            $array_of_ports[] = $device_port_max; 
        }        
    }
}
if (!empty($array_of_ports)) {
    $array_of_ports=array_filter(array_unique($array_of_ports)); //Remove duplicates, remove blanks, 
    sort($array_of_ports,SORT_NUMERIC); //order from smallest to biggest.
}

if (!empty($_REQUEST['scan_host']) && trim($_REQUEST['scan_host'])!='') {
    $device_ip          =trim($_REQUEST['scan_host']);
    $html['scan_host']  =htmlspecialchars($device_ip);
} else {
    /*
    *  If no host was entered, then use the REMOTE_ADDR.
    */
    $html['scan_host']=$device_ip=$requester_ip; ;
}

if (!empty($array_of_ports)) {
    require 'safe_use.1.1.php';
    $su = new SafeUse('SC', $requester_ip, $device_ip, $array_of_ports);  
    if (!empty($su) && $su->handler()===TRUE) {
        $error_condition=$su->error_condition;
    } elseif ($su->mysql_error=='1226') {
        $error_condition='There are more than 12 people using this service right now.  Try back later.  Although I\'m a fast computer with a super-fat Internet connection and can handle many more requests per second than this, my owners have told me to limit the use of this service to 12 concurrent users at a time.  Maybe when my owners stop being so grumpy about the March 2010 botnet attack they will reconsider this restriction.  Botnets aren\'t my favorite thing.';       
    } else {
        $error_condition='I\'m sorry, some unknown error is happening - it does not appear to be your fault.  Please contact us and let us know about this!';
    }   
    @mysqli_close($su->link);  
} else {
    $error_condition='no_ports_to_scan';
}
?>
<!DOCTYPE html>
<html class="ui-mobile">
<head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8"><!-- base href="http://www.t1shopper.com/mobile/mobile3.php" -->
    <meta name="viewport" content="width=device-width, initial-scale=1,maximum-scale=1">
    <title>Port Scanning <?php echo $html['scan_host'] ?>...</title>
    <link rel="shortcut icon" href="http://www.t1shopper.com/favicon.ico">
    <link rel="stylesheet" type="text/css" href="//ajax.googleapis.com/ajax/libs/jquerymobile/1.4.5/jquery.mobile.min.css">
    <link rel="stylesheet" href="//www.t1shopper.com/mobile/mobile.css">
    <link rel="stylesheet" href="//fonts.googleapis.com/css?family=Open+Sans:300,400,700">
    <script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    <script async src="//www.t1shopper.com/mobile/jquerymobile.1.4.5.assets.index.js"></script>
    <link rel="canonical" href="http://www.t1shopper.com/mobile/mobile3.php">
    <script async src="//ajax.googleapis.com/ajax/libs/jquerymobile/1.4.5/jquery.mobile.min.js"></script>
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
	<script>
		function downloadJSAtOnload() {
			var element = document.createElement("script");
			element.src = "/ssi/t1shopper.js";
			document.body.appendChild(element);
		}
		// Check for browser support of event handling capability
		 if (window.addEventListener)
			window.addEventListener("load", downloadJSAtOnload, false);
		 else if (window.attachEvent)
			window.attachEvent("onload", downloadJSAtOnload);
		 else window.onload = downloadJSAtOnload;
	</script>
	<style>
		p{font-family:'Open Sans'}
        .hdr2 {
            font-family: serif;
            font-size:27px;
            font-weight:bold;
            line-height:33px;
            padding:2rem 0 0 1rem;
            color:#333;
        }
        .hdr3 {
            font-family: monospace;
            font-size:13px;
            line-height:15px;
            padding:0.25rem 0 0 1rem;
        }
        .ui-body-a{margin-top:1rem}
    </style>
</head>
<body class="ui-mobile-viewport ui-overlay-a">
    <div data-role="page" class="jqm-demos jqm-home ui-page ui-page-theme-a ui-page-footer-fixed ui-page-active" id="page1" data-url="page1" tabindex="0" style="padding-bottom: 132px;">
        <div data-role="header" class="jqm-header ui-header ui-bar-inherit" role="banner">
            <h2 class="ui-title" role="heading" aria-level="1"><img src="http://www.t1shopper.com/i/logo_t1_shopper.gif" alt="jQuery Mobile" class=""></h2>
            <a href="#" class="jqm-navmenu-link ui-alt-icon ui-btn-left ui-btn ui-icon-bars ui-btn-icon-notext" data-role="button" role="button">Menu</a>
            <a href="#" class="jqm-search-link ui-nodisc-icon ui-alt-icon ui-btn-right ui-btn ui-icon-search ui-btn-icon-notext ui-corner-all" data-role="button" role="button">Search</a>
        </div><!-- /header -->
        <div data-role="panel" class="jqm-search-panel ui-panel ui-panel-position-right ui-panel-display-overlay ui-panel-closed ui-body-a ui-panel-animate" data-position="right" data-display="overlay" data-theme="a">
            <div class="jqm-search">
                <h3>Broadband Service Search</h3>
 					<form name=f method=POST data-ajax="false" action="https://www.t1shopper.com/dossier/enter_street_address.php">
						<input type=hidden  name=id>
						<input data-type="search" name=install_phone type=text maxlength=5 placeholder="ZIP Code for Service">
                    <button type="submit" data-mini="true" class="ui-btn ui-btn-a ui-icon-check ui-btn-icon-left ui-btn-inline ui-shadow ui-corner-all">Get Providers</button>
                </form>
            </div>
        </div>                   
			<div data-role="panel" class="jqm-navmenu-panel ui-panel ui-panel-position-left ui-panel-display-overlay ui-panel-closed ui-body-a ui-panel-animate" data-position="left" data-display="overlay" data-theme="a">
				<div class="ui-panel-inner">
					<ul class="jqm-list ui-alt-icon ui-nodisc-icon ui-listview">
						<li data-filtertext="demos homepage" data-icon="home" class="ui-first-child"><a href="http://www.t1shopper.com/mobile/" class="ui-btn ui-btn-icon-right ui-icon-home">Home</a></li>
						<li data-role="collapsible" data-enhanced="true" data-collapsed-icon="carat-d" data-expanded-icon="carat-u" data-iconpos="right" data-inset="false" class="ui-collapsible ui-collapsible-themed-content ui-li-static ui-body-inherit ui-collapsible-collapsed">
							<h3 class="ui-collapsible-heading ui-collapsible-heading-collapsed">
								<a href="http://www.t1shopper.com/service/t1/t1-line.shtml" class="ui-collapsible-heading-toggle ui-btn ui-btn-icon-right ui-btn-inherit ui-icon-carat-d">Pricing & Information<span class="ui-collapsible-heading-status"> click to expand contents</span></a>
							</h3>
							<div class="ui-collapsible-content ui-body-inherit ui-collapsible-content-collapsed" aria-hidden="true">
								<ul class="ui-listview">
									<li data-filtertext="form checkboxradio widget checkbox input checkboxes controlgroups" class="ui-first-child"><a href="http://www.t1shopper.com/service/t1/t1-line.shtml" data-ajax="false" class="ui-btn ui-btn-icon-right ui-icon-carat-r">T1 Line Pricing</a></li>
									<li data-filtertext="form checkboxradio widget radio input radio buttons controlgroups"><a href="http://www.t1shopper.com/service/fractional-t1/fractional-t1.shtml" data-ajax="false" class="ui-btn ui-btn-icon-right ui-icon-carat-r">Fractional T1</a></li>
									<li data-filtertext="form checkboxradio widget checkbox input checkboxes controlgroups"><a href="http://www.t1shopper.com/service/t3/t3-line.shtml" data-ajax="false" class="ui-btn ui-btn-icon-right ui-icon-carat-r">T3 Line</a></li>
									<li data-filtertext="form checkboxradio widget radio input radio buttons controlgroups"><a href="http://www.t1shopper.com/service/ip-vpn/mpls-vpn.shtml" data-ajax="false" class="ui-btn ui-btn-icon-right ui-icon-carat-r">VPN Services</a></li>
									<li data-filtertext="form checkboxradio widget radio input radio buttons controlgroups"><a href="http://www.t1shopper.com/carriers/sla/" data-ajax="false" class="ui-btn ui-btn-icon-right ui-icon-carat-r">SLA Report</a></li>
									<li data-filtertext="form checkboxradio widget radio input radio buttons controlgroups"><a href="http://www.t1shopper.com/toppicks.shtml" data-ajax="false" class="ui-btn ui-btn-icon-right ui-icon-carat-r">Most Popular</a></li>
								</ul>
							</div>
						</li>
						<li data-role="collapsible" data-enhanced="true" data-collapsed-icon="carat-d" data-expanded-icon="carat-u" data-iconpos="right" data-inset="false" class="ui-collapsible ui-collapsible-themed-content ui-li-static ui-body-inherit ui-collapsible-collapsed">
							<h3 class="ui-collapsible-heading ui-collapsible-heading-collapsed">
								<a href="http://www.t1shopper.com/voip/" class="ui-collapsible-heading-toggle ui-btn ui-btn-icon-right ui-btn-inherit ui-icon-carat-d">Internet Phone Service<span class="ui-collapsible-heading-status"> click to expand contents</span></a>
							</h3>
							<div class="ui-collapsible-content ui-body-inherit ui-collapsible-content-collapsed" aria-hidden="true">
								<ul class="ui-listview">
									<li data-filtertext="form checkboxradio widget checkbox input checkboxes controlgroups" class="ui-first-child"><a href="http://www.t1shopper.com/voip/" data-ajax="false" class="ui-btn ui-btn-icon-right ui-icon-carat-r">VOIP Providers</a></li>
								</ul>
							</div>
						</li>
						<li data-role="collapsible" data-enhanced="true" data-collapsed-icon="carat-d" data-expanded-icon="carat-u" data-iconpos="right" data-inset="false" class="ui-collapsible ui-collapsible-themed-content ui-li-static ui-body-inherit ui-collapsible-collapsed">
							<h3 class="ui-collapsible-heading ui-collapsible-heading-collapsed">
								<a href="http://www.t1shopper.com/carriers/" class="ui-collapsible-heading-toggle ui-btn ui-btn-icon-right ui-btn-inherit ui-icon-carat-d">T1 Service Providers<span class="ui-collapsible-heading-status"> click to expand contents</span></a>
							</h3>
							<div class="ui-collapsible-content ui-body-inherit ui-collapsible-content-collapsed" aria-hidden="true">
								<ul class="ui-listview">
									<li data-filtertext="form checkboxradio widget checkbox input checkboxes controlgroups" class="ui-first-child"><a href="http://www.t1shopper.com/carriers/" data-ajax="false" class="ui-btn ui-btn-icon-right ui-icon-carat-r">North America</a></li>
									<li data-filtertext="form checkboxradio widget radio input radio buttons controlgroups"><a href="http://www.t1shopper.com/carriers/wireless" data-ajax="false" class="ui-btn ui-btn-icon-right ui-icon-carat-r">Fixed Wireless</a></li>
									<li data-filtertext="form checkboxradio widget checkbox input checkboxes controlgroups"><a href="http://www.t1shopper.com/carriers/international.php" data-ajax="false" class="ui-btn ui-btn-icon-right ui-icon-carat-r">International</a></li>
								</ul>
							</div>
						</li>
						<li data-role="collapsible" data-enhanced="true" data-collapsed-icon="carat-d" data-expanded-icon="carat-u" data-iconpos="right" data-inset="false" class="ui-collapsible ui-collapsible-themed-content ui-li-static ui-body-inherit ui-collapsible-collapsed">
							<h3 class="ui-collapsible-heading ui-collapsible-heading-collapsed">
								<a href="http://www.t1shopper.com/tools/" class="ui-collapsible-heading-toggle ui-btn ui-btn-icon-right ui-btn-inherit ui-icon-carat-d">Tools<span class="ui-collapsible-heading-status"> click to expand contents</span></a>
							</h3>
							<div class="ui-collapsible-content ui-body-inherit ui-collapsible-content-collapsed" aria-hidden="true">
								<ul class="ui-listview">
									<li data-filtertext="form checkboxradio widget checkbox input checkboxes controlgroups" class="ui-first-child"><a href="http://www.t1shopper.com/tools/speedtest/" data-ajax="false" class="ui-btn ui-btn-icon-right ui-icon-carat-r">Speed Test</a></li>
									<li data-filtertext="form checkboxradio widget radio input radio buttons controlgroups"><a href="http://www.t1shopper.com/tools/traceroute/" data-ajax="false" class="ui-btn ui-btn-icon-right ui-icon-carat-r">Traceroute</a></li>
									<li data-filtertext="form checkboxradio widget checkbox input checkboxes controlgroups"><a href="http://www.t1shopper.com/tools/calculate/ip-subnet/" data-ajax="false" class="ui-btn ui-btn-icon-right ui-icon-carat-r">Subnet Calculator</a></li>
									<li data-filtertext="form checkboxradio widget checkbox input checkboxes controlgroups" class="ui-first-child"><a href="http://www.t1shopper.com/tools/" data-ajax="false" class="ui-btn ui-btn-icon-right ui-icon-carat-r">Whois/Ping/More</a></li>
									<li data-filtertext="form checkboxradio widget radio input radio buttons controlgroups"><a href="mobile4.html" data-ajax="false" class="ui-btn ui-btn-icon-right ui-icon-carat-r">Port Scanner</a></li>
									<li data-filtertext="form checkboxradio widget checkbox input checkboxes controlgroups"><a href="http://www.t1shopper.com/tools/http-headers.php" data-ajax="false" class="ui-btn ui-btn-icon-right ui-icon-carat-r">HTTP Headers</a></li>
									<li data-filtertext="form checkboxradio widget checkbox input checkboxes controlgroups" class="ui-first-child"><a href="http://www.t1shopper.com/tools/calculate/" data-ajax="false" class="ui-btn ui-btn-icon-right ui-icon-carat-r">File Size Calculator</a></li>
									<li data-filtertext="form checkboxradio widget radio input radio buttons controlgroups"><a href="http://www.t1shopper.com/tools/calculate/downloadcalculator.php" data-ajax="false" class="ui-btn ui-btn-icon-right ui-icon-carat-r">File Transfer Calculator</a></li>
									<li data-filtertext="form checkboxradio widget checkbox input checkboxes controlgroups"><a href="http://www.t1shopper.com/definitions.shtml" data-ajax="false" class="ui-btn ui-btn-icon-right ui-icon-carat-r">Telcom Definitions</a></li>
								</ul>
							</div>
						</li>
						<li data-filtertext="demos homepage"><a href="http://www.t1shopper.com/aboutus.shtml" class="ui-btn ui-btn-icon-right ui-icon-carat-r">About Us</a></li>
						<li data-filtertext="demos homepage"><a href="http://www.t1shopper.com/contactus/" class="ui-btn ui-btn-icon-right ui-icon-carat-r">Contact Us</a></li>
					</ul>
				</div>
			</div><!-- /panel -->
        <div data-role="footer" data-position="fixed" data-tap-toggle="false" class="ft-height jqm-footer ui-footer ui-bar-inherit ui-footer-fixed slideup" role="contentinfo">
            <p class="">Use of these services are subject to these <a href="http://www.t1shopper.com/termsofuse.shtml" class="ui-link">term of use</a> and <a href="http://www.t1shopper.com/privacypolicy.shtml" class="ui-link">privacy policy</a>.  Colocation and bandwidth by <a href="http://www.uscolo.com/" target="_blank" class="ui-link">U.S. Colo</a></p>
            <p>© 2003-2017 T1 Shopper, Inc. All Rights Reserved.&nbsp; T1 Shopper is a pending registered trademark in the USA and Canada.</p>
        </div><!-- /footer -->
        <div role="main" class="ui-content jqm-content">
<?php
			if(!empty($_GET['scan_host'])) {  
				$ports = preg_split( "/(,| )+/", $_GET['ports'] );
				$domain = $_GET['scan_host'];
				$results = array();

				echo "<div class='hdr2'>Scanning ports on $domain</div>";
/*	
    foreach($ports as $port) {
        if($pf = @fsockopen($domain, $port, $err, $err_string, 1)) {
            $results[$port] = true;
            fclose($pf);
        } else {
            $results[$port] = false;
        }
    }
	set_time_limit(120);
    foreach($results as $port=>$val) {
		ob_flush(); flush();
		sleep(1);	
        $prot = getservbyport($port,"tcp");
                echo "<div class='hdr3'>" . $domain;
        if($val) {
            echo " responded on port";
        }
        else {
            echo " isn't responding on port";
        }
		print " $port ($prot) .</div>";
    }
*/	
//ini_set('output_buffering',5);
				echo '<pre>'."\r\n";
				if (count($ports) > 0) {
					foreach ($ports as $k => $port_to_scan) {
//ob_implicit_flush(2);
						$fp = @fsockopen($domain, $port_to_scan, $errno, $errstr, 2); 
							if (is_resource($fp)) {
								echo '<tt style="color:red;">',$domain,' is responding on port ',$port_to_scan,' (',getservbyport ($port_to_scan, 'tcp'),').</tt><br>'."\r\n";
							} else {
								echo '<tt>',$domain,' isn\'t responding on port ',$port_to_scan,' ('.getservbyport($port_to_scan, 'tcp'),').</tt>'."\r\n";
							}
						 if (is_resource($fp)) {
							 fclose($fp);
						 }
					} //Close foreach
					echo '</pre>';
				}
			}
?>            
        </div>
    </div><!-- /page -->
    <div class="ui-loader ui-corner-all ui-body-a ui-loader-default"><span class="ui-icon-loading"></span><h1>loading</h1></div><div class="ui-panel-dismiss"></div><div class="ui-panel-dismiss"></div>
</body>
</html>
