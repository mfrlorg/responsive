<!DOCTYPE html>
<?$currentpage = "hours.php";
$whatserveristhis = 'thisisthetestserver.txt';
if (file_exists($whatserveristhis)) {$server="test";}
// ********
// * 2014 *
// ********
$day = date("d");
$month = date("m");
$year = date ("Y");
if ($_REQUEST['futuredate']!='') {
		$fdate=$_REQUEST['futuredate'];
		if ($fdate=="today") { } else {
			$day= substr($fdate,3,2);
			$month= substr($fdate,0,2);
			$year= substr($fdate,6,4);
			if(strlen($day)==1) $day="0".$day;
			if(strlen($month)==1) $month="0".$month;
			if(strlen($year)==2) $year="20".$year;
			}
		}

include 'inc/php/emailadminaddresses.php';
if($_REQUEST['branch']!='')$branch=$_REQUEST['branch'];
$branch=strtolower($branch);
$branchlist=array("b","c","f","m");
if (!in_array($branch,$branchlist)) $branch="";
// If after Memorial Day, but before labor day
if (
    (format_date($year,$month,$day) >= get_holiday($year, 5, 1)) &&
    (format_date($year,$month,$day) <= get_holiday($year, 9, 1, 1))
    ) $closedsunday = "0"; else $closedsunday = "1";

if ($_REQUEST['closedsunday']!='') $closedsunday=$_REQUEST['closedsunday'];
$dow = array('Sunday','Monday','Tuesday','Wednesday','Thursday','Friday','Saturday');
$cbhours = array('1pm - 5pm','9am - 8pm','9am - 8pm','9am - 8pm','9am - 8pm','10am - 5pm','10am - 5pm');
$fhours = array('1pm - 5pm','10am - 7pm','10am - 7pm','10am - 7pm','10am - 7pm','10am - 5pm','10am - 3pm');
$mhours = array('1pm - 5pm','10am - 8pm','10am - 8pm','10am - 8pm','10am - 8pm','10am - 5pm','10am - 5pm');
$fblinks = array('b'=>'Blacksburg-Library/152248358735#',
				'c'=>'Christiansburg-VA/Christiansburg-Library-Montgomery-Floyd-Regional-Library-System-Va/343472325300#',
				'f'=>'Jessie-Peterman-Memorial-Library-in-Floyd/202254600699#',
				'm'=>'Shawsville-VA/Meadowbrook-Public-Library/207765498326#');

switch ($branch) {
	case "":
	$pagetitle="Hours and Locations";
	break;
	case "b":
	$pagetitle="Blacksburg Library";		$subtitle=$libraryname="Blacksburg";		$phoneclean="5405528246";
		$fax="(540) 552-8265";
	$address="200 Miller Street";			$city=$libraryname.", VA";	$zipcode="24060";
	reset($bemailadmin);					$superemail=key($bemailadmin);
	$supername=$bemailadmin[$superemail];	$hours=$cbhours;
	$bimage="libimg1.jpg";
	$lat="37.2300";
	$lon="-80.4178";
	$latlonweather="#lat=".$lat."&amp;lon=".$lon."&amp;name=Blacksburg";
	break;
	case "c":
	$pagetitle="Christiansburg Library";	$subtitle=$libraryname="Christiansburg";	$phoneclean="5403826965";
	$extension="";	$fax="(540) 382-6964";
	$address="125 Sheltman Street";			$city=$libraryname.", VA";	$zipcode="24073";
	reset($cemailadmin);					$superemail=key($cemailadmin);
	$supername=$cemailadmin[$superemail];	$hours=$cbhours;
	$bimage="Christiansburg.png";
	$lat="37.1411";
	$lon="-80.4078";
	$latlonweather="#lat=".$lat."&amp;lon=".$lon."&amp;name=Christiansburg";
	break;
	case "f":
	$pagetitle="Jessie Peterman Memorial Library"; $subtitle=$libraryname="Floyd";	$phoneclean="5407452947";
	$fax="(540) 745-4750";
	$address="321 West Main Street";		$city=$libraryname.", VA"; 	$zipcode="24091";
	reset($femailadmin);					$superemail=key($femailadmin);
	$supername=$femailadmin[$superemail];	$hours=$fhours;
	$bimage="libimg3.jpg";
	$lat="36.9122";
	$lon="-80.1383";
	$latlonweather="#lat=".$lat."&amp;lon=".$lon."&amp;name=Floyd";
	break;
	case "m":
	$pagetitle="Meadowbrook Public Library";	$libraryname="Meadowbrook";
	$phoneclean="5402681964";				$subtitle="Shawsville";
	$extension="";	$fax="(540) 268-2031";
	$address="267 Alleghany Spring Road";	$city="Shawsville, VA";		$zipcode="24162";
	reset($memailadmin);					$superemail=key($memailadmin);
	$supername=$memailadmin[$superemail];	$hours=$mhours;
	$bimage="libimg5.jpg";
	$lat="37.1733";
	$lon="-80.2486";
	$latlonweather="#lat=".$lat."&amp;lon=".$lon."&amp;name=Meadowbrook";
	break;
	}

preg_match('/(\d{3})(\d{3})(\d{4})/', $phoneclean, $matches);
$phone="({$matches[1]}) {$matches[2]}-{$matches[3]}";

function format_date($year, $month, $day) {
    // pad single digit months/days with a leading zero for consistency (aesthetics)
    // and format the date as desired: YYYY-MM-DD by default
    if(strlen($month)==1)	{$month="0".$month;}
    if(strlen($day)==1)		{$day="0".$day;}
    $date=$year."-".$month."-".$day;
    return $date;
}
// the following function get_holiday() is based on the work done by
// Marcos J. Montes: http://www.smart.net/~mmontes/ushols.html
// if $week is not passed in, then we are checking for the last week of the month
function get_holiday($year, $month, $day_of_week, $week="") {
    if ( (($week != "") && (($week > 5) || ($week < 1))) || ($day_of_week > 6) || ($day_of_week < 0) ) {
        // $day_of_week must be between 0 and 6 (Sun=0, ... Sat=6); $week must be between 1 and 5
        return FALSE;
    } else {
        if (!$week || ($week == "")) {
            $lastday = date("t", mktime(0,0,0,$month,1,$year));
            $temp = (date("w",mktime(0,0,0,$month,$lastday,$year)) - $day_of_week) % 7;
        } else {
            $temp = ($day_of_week - date("w",mktime(0,0,0,$month,1,$year))) % 7;
        }

        if ($temp < 0) {
            $temp += 7;
        }

        if (!$week || ($week == "")) {
            $day = $lastday - $temp;
        } else {
            $day = (7 * $week) - 6 + $temp;
        }

        return format_date($year, $month, $day);
    }
}


function display_hours($dayofweek,$branchhours)
{
global $closedsunday;
for ($i=0;$i<7;$i++)
{
if (($i==0)&&(!$closedsunday)) echo "<div class=\"dowcolumn\">".$dayofweek[$i]."</div><div class=\"hourcolumn\"><a href=\"#note\" style=\"text-decoration:none;\"><span style=\"color:green; font-weight:bold;\">*</span><span class=\"closed\">".$branchhours[$i]."</span></a></div>";
else echo "<div class=\"dowcolumn\">".$dayofweek[$i]."</div><div class=\"hourcolumn\">".$branchhours[$i]."</div>";
}

}
?>
<html>
<head>
<title><?echo $pagetitle;?></title>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=Edge"/>
<meta name="google-site-verification" content="kwYyWkz6FQf_DQmvAwDvYR1Ccb2UmOn_tqnHVYAEBTM" />
<link href="xxxmfrl.css" rel="stylesheet" type="text/css" >
<link href="xxxmfrlpage.css" rel="stylesheet" type="text/css" >
<link type="text/css" href="/inc/css/jquery-ui-1.8.11.custom.css" rel="stylesheet" />
<script type="text/javascript" src="/inc/js/jquery-1.5.1.min.js"></script>
<script type="text/javascript" src="/inc/js/jquery-ui-1.8.11.custom.min.js"></script>
<script type="text/javascript" src="/inc/js/jquery.cycle.all.min.js"></script>
<script type="text/javascript" src="/inc/js/superfish.js"></script>
<script type="text/javascript">
	$(document).ready(function(){
		jQuery('ul.sf-menu').superfish({
			pathClass: 'current'
		});
	});
</script>
<style type="text/css">
div .hoursbox, div .adminaddress {
	font-size:11px;
	line-height:17px;
	}
	h3{
		font-size:66%;
	}
div .leftop {
    float: left;
    width: 315px;
    background-color: #FFDD82;
    padding:0;
    border:0;
    margin: 3px;
    margin-left: 15px;
	padding-left:5px;
    height: 54px;
}
div .adminaddress{
	background-color: #FFDD82;
	padding-left:5px;
}
div .adminhours{
	background-color: white;
	margin:0 0 0 -5px;
	padding:5px 0 0 5px;
	border-top: 5px solid #fff8e6;
	border-bottom: 1px solid white;
}
div .leftom {
    float: left;
    width: 315px;
    background-color: #fff;
    padding:0;
	padding-left:5px;
    border:0;
    margin: 3px;
    margin-left: 15px;
}
div .rightop {
    float: left;
    width: 315px;
    background-color: #FFDD82;
    margin: 3px;
    height: 54px;
}
div .rightom {
    float: left;
    width: 315px;
    background-color: #fff;
    margin: 3px;
}
div .dowcolumn {
    float:left;
    margin-left:10px;
    width:80px;
    color:#0086c6
}
div .adowcolumn{
	float:left;
	margin-left:10px;
	width:80px;
	display:block;
	color:#0086c6;
}
div .dowcolumnf {
    float:left;
    margin-left:10px;
    width:80px;
    color:#0086c6
}
div .hourcolumn{
    float:left;
    width:161px;}
div .ahosu rcolumn{
	float:left;
	width:505px;
	display:block;
}
.closed{
    color:#ccc;}
div .remainder{
    width:640px;
    margin-left:15px;
	}
div .beafan 	{
float:right;
}
.beafan a, .facebox a{
    float:right;
    padding:4px 3px 0 3px;
	margin:10px 3px 0 0;
    border: 1px solid #09c;
    background-color:#fff;
}
.beafan a:hover, .facebox a:hover {
display:block;
background-color:#eff;
border: 1px solid #f90;
text-decoration:none;
}
.newhours {
color:red;
}
.address {
width:225px;
float:left;
}
.caddress {
width:150px;
float:left;
}
.cblogimg {
height:28px;
}
div .jblog {
float:right;
}
.jblog a{
    float:right;
    padding:0 1px;
	margin:10px 3px 0 0;
    border: 1px solid #09c;
    background-color:#fff;
}
.phonebox, .addressbox, .superbox {
float:left;
width:29%;
}
.facebox {

}

.jblog a:hover {
display:block;
background-color:#eff;
border: 1px solid #f90;
text-decoration:none;
}
.minicolleft {
	float:left;
	width:305px;
	margin-bottom:10px;
	}
.minicolright {
	float:right;
	width:350px;
	margin-bottom:<?if($branch=="f") echo "10"; else echo "30"?>px;
	}
.weatherbox{
}
.weather_title{
position:relative;
height:28px;
border-bottom:2px solid #444;
font-weight:bold;
font-size:18px;
padding-left:20px;
padding-top:6px;
margin-bottom:3px;
}
.weather_current{
background:transparent;
padding:17px;
float:left;
}
.daycast{
float:left;
margin-right:10px;
}
.dayname{
margin-left:5px;
font-weight:bold;
}
.weather_alert{
margin:10px 30px;
width:100%;
}
.wulogo{
float:right;
margin-top:-6px;
}
<!--[if lte IE  8]>
#forecast_embed {
display:none;
}
<![endif]-->
</style>
<link rel="icon" type="image/png" href="../favicon.png">
</head>
<body>

<div id="wrap">
    <div id="header"><?include'xxxheader.php';?></div>
	<div id="menucont"><?include'xxxmenu.php';?></div>
	<div id="maincontent">
		<div id="leftmenu">
			<?include'menu.hours.php';?>
		</div> <!-- End Menu col -->
		<div id="fullrightcol">
<? if($branch==""){ //All Branches
	?>
<div class="pagediv">
<h1>Hours &amp; Locations</h1>
<p class="blue">For more information, click on the branch name.</p>
<?if(($year==2014)&&($month<11)){?>
<p><span style="color:red;font-weight: bold;">New!</span> The Administrative Office and Regional Personnel phone number is now
 <a href="tel:5403826969">(540) 382-6969</a>.</p>
<?}?>


<div class="hoursbox">
<div class="leftop">
	<div class="address">
		<a href="hours.php?branch=b"><strong>Blacksburg Library </strong></a>
		<br>Blacksburg, VA<br><a href="tel:5405528246">(540) 552-8246</a>
	</div>
	<div class="beafan">
		<a href="http://www.facebook.com/pages/<?echo$fblinks['b'];?>">
		<img src="/images/facebookbuttonsmaller.png" alt="Become a Fan of Blacksburg Library on Facebook" title="Become a Fan of Blacksburg Library on Facebook"></a>
	</div>
</div>
<div class="rightop">
		<div class="caddress">
			<a href="hours.php?branch=c"><strong>Christiansburg Library</strong></a>
			<br>Christiansburg, VA<br><a href="tel:5403826965">(540) 382-6965</a>
		</div>
	<div class="beafan">
		<a href="http://www.facebook.com/pages/<?echo$fblinks['c'];?>">
		<img src="/images/facebookbuttonsmaller.png" alt="Become a Fan of Christiansburg Library on Facebook" title="Become a Fan of Christiansburg Library on Facebook"></a>
	</div>

</div>
<div class="leftom"><?display_hours($dow,$cbhours);?></div>
<div class="rightom"><?display_hours($dow,$cbhours);?></div>

<div class="leftop">
	<div class="address">
		<a href="hours.php?branch=f"><strong>Jessie Peterman Memorial Library</strong></a>
		Floyd, VA<br><a href="tel:5407452947">(540) 745-2947</a>
	</div>
	<div class="beafan">
		<a href="http://www.facebook.com/pages/<?echo$fblinks['f'];?>">
		<img src="/images/facebookbuttonsmaller.png" alt="Become a Fan of Floyd Library on Facebook"  title="Become a Fan of Floyd Library on Facebook"></a>
	</div>
</div>
<div class="rightop">
	<div class="address">
		<a href="hours.php?branch=m"><strong>Meadowbrook Public Library</strong></a>
		<br>Shawsville, VA<br><a href="tel:5402681964">(540) 268-1964</a>
	</div>
	<div class="beafan">
		<a href="http://www.facebook.com/pages/<?echo$fblinks['m'];?>">
		<img src="/images/facebookbuttonsmaller.png" alt="Become a Fan of Meadowbrook Library on Facebook"  title="Become a Fan of Meadowbrook Library on Facebook"></a>
	</div>
</div>
<div class="leftom"><?display_hours($dow,$fhours);?></div>
    <div class="rightom"><?display_hours($dow,$mhours);?></div>
</div>

<div class="remainder">
<hr>



<div class="adminaddress">
	<div id="admin">
		<strong>Administrative Offices</strong>
		<em>(in the same building as the <a href="hours.php?branch=c">Christiansburg Library</a>)</em><br>
	    125 Sheltman Street, Christiansburg, VA 24073<br>
		 <a href="tel:5403826969">(540) 382-6969</a> <br>
		<div class="adminhours">
	        <div class="adowcolumn">Weekdays</div>
	        <div class="ahourcolumn"> 8:30am &ndash; 5pm</div>
	    </div>
    </div>
</div>

<p><strong>Summer</strong><br>
	<?if($closedsunday==0)echo "<a name=\"note\"><span style=\"color:green; font-weight:bold;\">*</span></a>";?>The Library is closed on Sundays from Memorial Day Weekend through Labor Day Weekend, inclusive.
</p>

<p><strong>Holidays</strong><br>
MFRL is <strong>closed</strong> on New Year&rsquo;s Day, Martin Luther
	King, Jr. Day, Presidents' Day, Memorial Day,  Independence Day, Labor Day,
	Veteran's Day, Thanksgiving Day and the Friday after Thanksgiving, and
	Christmas Day.<br>
        The Library observes regular hours on Lee-Jackson Day and Columbus Day.</p>

</div>


			</div><?}else{//A Specific Branch?>
<div class="pagediv">
	<h1 class="pagename"><?echo$pagetitle."</h1> <h3>".$subtitle;?></h3>
	<div class="contactbox">
		<div class="phonebox">
			<p><span class="orange"><strong>Phone Numbers</strong></span><br>
			Phone: <a href="tel:<?echo$phoneclean;?>"><?echo$phone?></a><br>
			<?echo($extension?$extension."<br>":"");?>
			<?echo($fax?"<br>Fax: ".$fax:"");?></p>
		</div>
		<div class="addressbox">
			<p><span class="orange"><strong>Address</strong></span><br>
			<? echo $address; ?><BR>
			<? echo $city; ?>, <? echo $state; ?>
			<? echo $zipcode; ?></p>
		</div>
		<div class="superbox">
			<p><span class="orange"><strong> Supervisor:</strong></span> <BR>
			<a href="mailto:<?echo$superemail;?>"><?echo$supername;?></a>
			</p>
		</div>
		<div class="facebox">
			<p><a href="http://www.facebook.com/pages/<?echo $fblinks[$branch];?>">
			<img src="/images/facebookbutton2.png" alt="Become a Fan of <?echo$libraryname;?> Library on Facebook"  title="Become a Fan of <?echo$libraryname;?> Library on Facebook"></a></p>
		</div>
	</div>
	<div style="clear:both;"></div>
	<div class="minicolleft">
		<p class="orange"><strong>Hours</strong></p>
		<table>
	    <? for ($i=0;$i<7;$i++) {
		echo ' <tr><td><span class="blue">'.$dow[$i].'</span></td>';
		if (($i==0)&&(!$closedsunday)) {
			echo '<td><span class="closed">'.$hours[$i].'</span><span style="color:green;">*</span></td></tr>';}
			else {echo '<td>'.$hours[$i].'</td></tr>';}
		}
		?>
		</table>
	<p><span style="font-weight:bold;">Summer Hours</span><br>
	<?if($closedsunday==0){?><span style="color:green; font-weight:bold;">*</span><?}?>The Library is closed on Sundays from Memorial Day Weekend through Labor Day Weekend, inclusive.</p>
	</div>
	<div class="minicolright">
	<p style="margin-bottom:1px;"><img src="images/<?echo$bimage;?>" alt="<? echo $libraryname; ?>" class="brder_white" style="margin-bottom:10px; margin-left:5px;"> </p>
	</div>
	<div style="clear:both;"></div>

		<iframe id="forecast_embed"  height="245" width="640" src="http://forecast.io/embed/<?echo$latlonweather;?>"> </iframe>



<div style="clear:both;"></div>
	<p class="orange"><strong>Directions</strong></p>
	<?php
switch ($branch) {
case "b":
?><iframe width="680" height="445"
src="http://maps.google.com/maps/ms?ie=UTF8&amp;msa=0&amp;msid=104297967944134334160.000488b1d77d32f8b12cc&amp;ll=37.226023,-80.411103&amp;spn=0.015206,0.023689&amp;z=15&amp;output=embed"></iframe><br><small>View the entire <a
href="http://maps.google.com/maps/ms?hl=en&amp;geocode=&amp;ie=UTF8&amp;hnear=Virginia&amp;source=embed&amp;msa=0&amp;msid=104297967944134334160.000488b1d77d32f8b12cc&amp;ll=37.068328,-80.336151&amp;spn=0.703484,0.653687&amp;z=10&amp;source=embed" style="color:#0000FF;text-align:left">Montgomery Floyd Regional Library System</a> in a larger map</small><?
break;
case "c":
?><iframe width="680" height="445"
src="http://maps.google.com/maps/ms?ie=UTF8&amp;msa=0&amp;msid=104297967944134334160.000488b1d77d32f8b12cc&amp;ll=37.130179,-80.413313&amp;spn=0.015226,0.023689&amp;z=15&amp;output=embed"></iframe><br><small>View the entire <a
href="http://maps.google.com/maps/ms?hl=en&amp;geocode=&amp;ie=UTF8&amp;hnear=Virginia&amp;source=embed&amp;msa=0&amp;msid=104297967944134334160.000488b1d77d32f8b12cc&amp;ll=37.068328,-80.336151&amp;spn=0.703484,0.653687&amp;z=10&amp;source=embed" style="color:#0000FF;text-align:left">Montgomery Floyd Regional Library System</a> in a larger map</small><?
break;
case "f":
?><iframe width="680" height="445"
src="http://maps.google.com/maps/ms?ie=UTF8&amp;msa=0&amp;msid=104297967944134334160.000488b1d77d32f8b12cc&amp;ll=36.91135,-80.32289&amp;spn=0.007635,0.011845&amp;z=16&amp;output=embed"></iframe><br><small>View the entire <a
href="http://maps.google.com/maps/ms?hl=en&amp;geocode=&amp;ie=UTF8&amp;hnear=Virginia&amp;source=embed&amp;msa=0&amp;msid=104297967944134334160.000488b1d77d32f8b12cc&amp;ll=37.068328,-80.336151&amp;spn=0.703484,0.653687&amp;z=10&amp;source=embed" style="color:#0000FF;text-align:left">Montgomery Floyd Regional Library System</a> in a larger map</small><?
break;
case "m":
?><iframe width="680" height="445"
src="http://maps.google.com/maps/ms?ie=UTF8&amp;msa=0&amp;msid=104297967944134334160.000488b1d77d32f8b12cc&amp;ll=37.174064,-80.265598&amp;spn=0.030434,0.047379&amp;z=14&amp;output=embed"></iframe><br><small>View the entire <a
href="http://maps.google.com/maps/ms?hl=en&amp;geocode=&amp;ie=UTF8&amp;hnear=Virginia&amp;source=embed&amp;msa=0&amp;msid=104297967944134334160.000488b1d77d32f8b12cc&amp;ll=37.068328,-80.336151&amp;spn=0.703484,0.653687&amp;z=10&amp;source=embed" style="color:#0000FF;text-align:left">Montgomery Floyd Regional Library System</a> in a larger map</small><?
break;
}
?>

</div>
<?}?>
		</div> <!-- end right col -->
    </div>
<div style="clear:both;"></div>
    <div id="footer"><?include'xxxfooter.php';?></div>
</div>
</body>
</html>
