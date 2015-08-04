<?if(isset($_SERVER['HTTP_USER_AGENT'])&&(strpos($_SERVER['HTTP_USER_AGENT'],'MSIE')!==false))header('X-UA-Compatible:IE=edge,chrome=1');?>
<!DOCTYPE html>
<?$currentpage = "index.php";
$whatserveristhis = 'thisisthetestserver.txt';
if (file_exists($whatserveristhis)) {$server="test";}
// ********
// * 2014 *
// ********

if($_REQUEST['slides']!='') $slides=intval($_REQUEST['slides']);
else $slides=8;

$side="left";
$view=$_REQUEST['view'];
if ($view=="Exploded View") $view="debug";
$okayviews=array('debug','time','hide');
if (!in_array($view,$okayviews)) $view='';
if ($_REQUEST['archive']=="archive")$archive="archive";
if ($view=="showall"){$showall=$view;$slides=99;}
# Include the Required files.
	include 	'inc/php/openconnectionro.php';
	include 	'nextboard.php';
	$wplocation = 	'wp/wp_start.php';
	if (file_exists($wplocation)) { include $wplocation;}
//	include 	'inlibrary.php';
$day = date("d");
$month = date("m");
$year = date ("Y");

if ($_REQUEST['futureday']!='') {	$day=$_REQUEST['futureday']; 		}
if ($_REQUEST['futuremonth']!='') {	$month=$_REQUEST['futuremonth']; 	}
if ($_REQUEST['futureyear']!='') {	$year=$_REQUEST['futureyear']; 		}
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


// For the buy our stuff blurb. Change to "" to remove the "NEWNESS" or put the date in to have that show up.
// Keep it short EG mm/dd or the header will wrap around in an unsightly manner.
// To hide the blurb completely set ="hide"
if (($year==2015)&&($month==4)||(($month==5)&&($day<16))) $auction="April 24";	else $auction="hide";
// left or right (all lowercase). Determines which column the movie blurb shows up in.
$moviepos = "left";
// Same as Movies but for the Video game quick searchs:
$vgpos="nope";
$ipadpos="right";
function showtomorrow($debugdate){
	if($debugdate!=""){
	$day= substr($debugdate,3,2);
			$month= substr($debugdate,0,2);
			$year= substr($debugdate,6,4);
$tempdate=mktime(0,0,0,$month,$day+1,$year);
}else $tempdate=mktime(0,0,0,date('n'),date('j')+1,date('Y'));
$tomorrowdate=date("m/d/Y",$tempdate);
return $tomorrowdate;
}



// Slide Hider & Debug tool
// Dates format YYYYMMDD
function showslide($enddate="",$startdate="",$fillcount="0"){
	global $year;
	global $day;
	global $month;
	global $view;
	global $newscounter;
	global $slideshowend;
	$currentdate = $year.$month.$day;
	$currentdaten = date("M d, Y",mktime(0,0,0,$month,$day,$year));
	$startdaten = date("M d, Y",mktime(0,0,0,substr($startdate,4,2),substr($startdate,6,2),substr($startdate,0,4)));
	$enddaten = date("M d, Y",mktime(0,0,0,substr($enddate,4,2),substr($enddate,6,2),substr($enddate,0,4)));
	if ($view=="debug") { echo "<div class=\"debug\">";
							if($enddate<$startdate) echo "<b style=\"color:red;\">ERROR</b>: Date Mismatch!";
	if (!$slideshowend) {echo "<div class=\"count";
						if (($currentdate<=$enddate)&&($currentdate>=$startdate)&&(($fillcount=="0")||($fillcount>$newscounter)))
							{
							echo "";
							echo "\">".($newscounter+1)."</div>";
							}
						else echo "higher\">".$newscounter."</div>";
						}
	echo "<div class=\"debugtext\">";
		if ($startdate!="") {
			if ($currentdate<=$enddate) echo "Runs"; else echo "Ran";
			echo " from ".$startdaten." through ".$enddaten;
			}
		else if ($currentdate<=$enddate) echo "Runs until ".$enddaten;
		else if ($currentdate>$enddate) echo "Ended ".$enddaten;
	echo "</div>";
		echo "<div class=\"debugstatus ";
		if ($currentdate<$startdate) echo "green\">Status: Coming Soon";
		else if ($fillcount>0) {
			if ($currentdate>=$enddate) echo "Finished\">Status Finished";

			else echo "filler\" title=\"Whether an item qualifies for FILLER is checked before the count is incremented.\">Status: Filler [&lt;".$fillcount."]";}
		else if ($currentdate<=$enddate) echo "\">Status: Current";
		else echo "finished\">Status: Finished";
		echo "</div>";
		echo "</div>";
		if (!(($currentdate<=$enddate)&&($currentdate>=$startdate)&&(($fillcount=="0")||($fillcount>$newscounter)))) $newscounter--;
		return true;
	} else if (($currentdate<=$enddate)&&($currentdate>=$startdate)&&(($fillcount=="0")||($fillcount>$newscounter)))
	return true;
	else { return false;}
}


// Fill Count not working. Why?
// Slide Hider & Debug tool
// Dates format YYYYMMDD
function speedslide($enddate="",$startdate="",$fillcount="0",$picture="",$link=""){
	global $year;
	global $day;
	global $month;
	global $view;
	global $newscounter;
	global $slideshowend;
	$wide=473;
	$high=266;
	$link=filter_var($link,FILTER_SANITIZE_SPECIAL_CHARS);
	$timezone="&amp;ctz=America/New_York";
	$callink="https://www.google.com/calendar/";

	if(($link!="") && (!substr_compare($link, $callink, 0,32))) {echo "<!--MATCH-->";$link.=$timezone; }
	$currentdate = $year.$month.$day;
	$currentdaten = date("M d, Y",mktime(0,0,0,$month,$day,$year));
	$startdaten = date("M d, Y",mktime(0,0,0,substr($startdate,4,2),substr($startdate,6,2),substr($startdate,0,4)));
	$enddaten = date("M d, Y",mktime(0,0,0,substr($enddate,4,2),substr($enddate,6,2),substr($enddate,0,4)));
	if ($view=="debug") { echo "<div class=\"debug\">";
							if($enddate<$startdate) echo "<b style=\"color:red;\">ERROR</b>: Date Mismatch!";
	if (!$slideshowend) {echo "<div class=\"count";
						if (($currentdate<=$enddate)&&($currentdate>=$startdate)&&(($fillcount=="0")||($fillcount>$newscounter)))
							{
							echo "";
							echo "\">".($newscounter+1)."</div>";
							}
						else echo "higher\">".$newscounter."</div>";
						}
	echo "<div class=\"debugtext\">";
		if ($startdate!="") {
			if ($currentdate<=$enddate) echo "Runs"; else echo "Ran";
			echo " from ".$startdaten." through ".$enddaten;
			}
		else if ($currentdate<=$enddate) echo "Runs until ".$enddaten;
		else if ($currentdate>$enddate) echo "Ended ".$enddaten;
	echo "</div>";
		echo "<div class=\"debugstatus ";
		if ($currentdate<$startdate) echo "green\">Status: Coming Soon";
		else if ($fillcount>0) {
			if ($currentdate>=$enddate) echo "Finished\">Status Finished";

			else echo "filler\" title=\"Whether an item qualifies for FILLER is checked before the count is incremented.\">Status: Filler [&lt;".$fillcount."]";}
		else if ($currentdate<=$enddate) echo "\">Status: Current";
		else echo "finished\">Status: Finished";
		echo "</div>";
		echo "</div>";
		if (!(($currentdate<=$enddate)&&($currentdate>=$startdate)&&(($fillcount=="0")||($fillcount>$newscounter)))) $newscounter--;
		$newscounter++;
		?>	<div style="padding:0; border:0;"><!-- Fill:News: <?echo$fillcount.":".$newscounter;?>-->
			<a style="margin:0;" href="<?echo$link;?>">
			<img src="/images/<?echo$picture;?>.png" alt="Click for more info" title="Click for more info" width="<?echo$wide;?>" height="<?echo$high;?>">
			</a>
			</div>
<?	} else if (($currentdate<=$enddate)&&($currentdate>=$startdate)&&(($fillcount=="0")||($fillcount>$newscounter))){$newscounter++;
	?> <div style="padding:0; border:0;"><!-- Fill:News: <?echo$fillcount.":".$newscounter;?>-->
		<a style="margin:0;" href="<?echo$link;?>">
		<img src="/images/<?echo$picture;?>.png" alt="Click for more info" title="Click for more info" width="<?echo$wide;?>" height="<?echo$high;?>">
		</a>
		</div>
<?}
	else { return false;}
}

//Displays a link to a book.
// The "link" variable is optional link text. The keywords will show up as the text of the link, if link is left blank.
// Type can be T (title) A (Author) or I (isbn) and determines what type of search is done.
function booklink($keywords,$type, $link="")
    {
    $type=strtolower($type);
    if ($type=="t") {$type="TI%5ETITLE&amp;match_on=EXACT";
					$italics=true;}
    elseif ($type=="a") {$type="AU%5EAUTHOR";$italics=false;}
    elseif ($type=="i") {$type="ISBN";$italics=false;}
	elseif ($type=="tnote") {$type="TI%5ETITLE";$italics=true;}
    $keywordsplus= str_replace(' ','+',$keywords);
    if ($link!="") $keywords=$link;
    if ($italics) $keywords="<em>".$keywords."</em>";
echo "<a href=\"http://cat.mfrl.org/uhtbin/cgisirsi.exe/0/CBURG/0/5?searchdata1=".$keywordsplus."&amp;srchfield1=".$type."\">".$keywords."</a>";
}

function newbookdisplay()
	{
	$query = "SELECT new_isbn, new_title, new_author ".
		"FROM new_items WHERE new_type = 'Book' ";
	$results = mysql_query($query) or die (mysql_error());
	$numbooks=  mysql_num_rows($results);
	$numbooks--;
	$display = rand(0,$numbooks);
	$i= $numbooks;
	while ($row = mysql_fetch_array($results)) {
		extract($row);
		if ($i==$display) {
			echo "<a href=\"http://cat.mfrl.org/uhtbin/cgisirsi.exe/0/CBURG/0/5?searchdata1=";
			echo $new_isbn;
			echo "&amp;srchfield1=%5EISBN%5E\">";
			$filename = "http://www.mfrl.org/images/isbn/".$new_isbn.".GIF";
			if (file_exists($filename)) {
				echo "<img src=\"http://www.mfrl.org/images/isbn/";
				echo $new_isbn;
				echo ".GIF\" title=\"";
			} else {
				echo "<img src=\"http://syndetics.com/index.aspx?isbn=";
				echo $new_isbn;
				echo "/SC.GIF\" title=\"";
			}
			echo $new_title;
			echo " by ";
			echo $new_author;
			echo "\" alt=\"";
			echo $new_title;
			echo " by ";
			echo $new_author;
			echo "\"";
			echo " class=\"left\"></a>";
			}
		$i--;
		}
	}


//Displays the bookcover and makes it a link to the catalog.
// Size can be S (small) M (Medium) or L (Large). Some books only have S&M sizes.
// Type can be T (title) A (Author) or I (isbn) and determines what type of search is done.
// Float can be "left" or "right" and determines which side the image is on.
function booklinkp($author,$isbn,$title="",$float="left",$type="t",$size="s",$top="0",$bordersize="0",$bordercolor="000000")
    {
    $type=strtolower($type);
    if ($float=="l") $float="left";
    if ($float=="r") $float="right";
    if (($float=="left")) $marg="right"; else $marg="left";
    $titleplus= str_replace(' ','+',$title);
    $authorplus= str_replace(' ','+',$author);
    if ($type=="t") {     $type="TI^TITLE&amp;match_on=EXACT"; $keywordsplus= $titleplus; }
	elseif ($type=="tnote") {$type="TI^TITLE"; $keywordsplus=$titleplus;}
    elseif ($type=="a") { $type="AU^AUTHOR"; $keywordsplus= $authorplus; }
    elseif ($type=="i") { $type="ISBN"; $keywordsplus= $isbn;}

echo "<a href=\"http://cat.mfrl.org/uhtbin/cgisirsi.exe/0/CBURG/0/5?searchdata1=".$keywordsplus."&amp;srchfield1=".$type."\">";
$filename="images/isbn/".$isbn."S.GIF";
if (file_exists($filename)) { echo "<img src=\"/".$filename."\"";}
else echo "<img src=\"http://syndetics.com/index.aspx?isbn=".$isbn."/".$size."C.GIF\"";
echo " style=\"border:".$bordersize."px solid #".$bordercolor."; float:".$float."; ".$yodaexception." margin-".$marg.":3px;";
if ($top!="0") echo " margin-top:".$top."px;";
if ($title=="") {echo "\" alt=\"".$author."\" title=\"".$author."\"></a>";}
else {echo "\" alt=\"".$title." by ".$author."\" title=\"".$title." by ".$author."\"></a>";}
}

//New Calendar link (rev 9/10/12)
// Leave $link blank to generate a link to the appropriate day in our activities page.
// Set $hideside to anything to hide the weekday and show just branch (not Branch Library).
function ncl($b,$date,$time,$link="",$hideside="",$alternatelinktext="")
	{
	global $side;
	$currentday = date("Y").date("m").date("d");
	switch ($b) {
		case "b":
		$branch="Blacksburg";
		break;
		case "c":
		$branch="Christiansburg";
		break;
		case "f":
		case "cancelf":
		$branch="Floyd";
		break;
		case "m":
		case "cancelm":
		$branch="Meadowbrook";
		break;
		case "emp":
		$branch="Eastern Montgomery Park";
		break;
		case "bc":
		$branch="Blacksburg and Christiansburg";
		break;
		case "vt":
		$branch="Newman Library of Virginia Tech";
		break;
		case "mc":
		$branch="Meadowbrook Library Courtyard";
		break;

		case "";
		$branch="";
		break;
		}
		if ($b!="") $at = " @ "; else $at = " ";
	$link=str_replace("&","&amp;",$link);
	if ($b=="cancelm") $specialstyle=" style=\"color:red; text-decoration:line-through;\" ";
	if ($b=="cancelf") $specialstyle=" style=\"color:red; text-decoration:line-through;\" ";
	//if (($side!="right")&&($side!="r")&&($hideside=="")) $branch.=" Library";
	if ($hideside=="rescheduled") { $branch = " RESCHEDULED:"; $at = " ";}
	$nclyear= substr($date,0,4);
	$nclmonth= substr($date,4,2);
	$nclday=substr($date,6,2);
	$weekday=date("l",mktime(0,0,0,$nclmonth,$nclday,$nclyear) );
	if ($hideside=="small") $nclmonth=date("M",mktime(0,0,0,$nclmonth,1));
	else $nclmonth=date("F",mktime(0,0,0,$nclmonth,1) );
	$weekday.=", ";
	if (($side=="r")||($side=="right")||($hideside!="")) $weekday="";
	if ($currentday>$date) $oldevent = "oldeventlink";
	if ($link=="") {
		echo "<a href=\"calendar.php?showday=".$date."\" ".$specialstyle."class=\"".$oldevent."\">";
		if ($alternatelinktext=="") echo $weekday.$nclmonth." ".$nclday.", ".$time;
		else echo $alternatelinktext;
		echo "</a>".$at.$branch;
	} else {
		echo "<a href=\"".$link."\" ".$specialstyle." class=\"newWindow ".$oldevent."\">";
		if ($alternatelinktext=="") echo $weekday.$nclmonth." ".$nclday.", ".$time;
		else echo $alternatelinktext;
		echo "</a>".$at.$branch;
	}
}

//Board Blurb Text
function boardblurb()	{
echo "<p class=\"fph4\">Board of Trustees Meeting<br>Montgomery-Floyd Regional Library ";
echo "<a href=\"/about_board.php\">Board of Trustees</a> will meet on ";
}

//Wikipedia Link. If $linktext is blank the search word is used as the linktext.
function wiki($word,$linktext="")	{
    if ($linktext=="") $linktext=$word;
	$word= str_replace(' ','_',$word);
    echo "<a href=\"http://en.wikipedia.org/wiki/".$word."\">".$linktext."</a>";
}
// End dates:
// Holidays
if (($year==2015)&&($month==7)&&($day<5)||($month==6)) $holidaytimes="true";
//if (($year==2014)&&($month<=6)) $sundayclosed="true";

// For Employment. Make true until last day.
$isalisting=(($year==2015)&&((($month==7) && ($day <=17))||($month==13)));

?>


<html>
<head>
<title>Montgomery-Floyd Regional Library</title>
<meta name="google-site-verification" content="kwYyWkz6FQf_DQmvAwDvYR1Ccb2UmOn_tqnHVYAEBTM" />
<meta charset="UTF-8">
<!--	<link rel="stylesheet" type="text/css" href="/inc/css/superfish.css" media="screen">
	<link rel="stylesheet" type="text/css" href="/inc/css/superfish-navbar.css" media="screen">
<link href="notable.css" rel="stylesheet" type="text/css">
<link href="menustyle.css" rel="stylesheet" type="text/css">
<link href="frontpage.css" rel="stylesheet" type="text/css"> -->
<link href="mfrlfront.css" rel="stylesheet" type="text/css">
<link href="xxxmfrl.css" rel="stylesheet" type="text/css" >

<!-- REMOVE AFTER 2014 SRP -->
<!--<link href='http://fonts.googleapis.com/css?family=Gochi+Hand' rel='stylesheet' type='text/css'>-->
<link href='http://fonts.googleapis.com/css?family=Courgette' rel='stylesheet' type='text/css'>
<!-- <link href="mfrl.css" rel="stylesheet alternate" type="text/css" > -->

		<link type="text/css" href="/inc/css/jquery-ui-1.8.11.custom.css" rel="stylesheet" />
		<script type="text/javascript" src="/inc/js/jquery-1.5.1.min.js"></script>
		<script type="text/javascript" src="/inc/js/jquery-ui-1.8.11.custom.min.js"></script>
		<script type="text/javascript" src="/inc/js/jquery.cycle.all.min.js"></script>
<!--		<script type="text/javascript" src="/inc/js/hoverIntent.js"></script> -->
		<script type="text/javascript" src="/inc/js/superfish.js"></script>

<style type="text/css">
<?if(($day=="1")&&($month=="4")){?>
html {  -webkit-animation: rainbow 90s infinite;}
@-webkit-keyframes rainbow {  100% { -webkit-filter: hue-rotate(360deg); } }
<?}?>

#srp15 p, #srp15 a {
	font-family: 'Courgette', cursive;
}
#srp15 a {line-height: 1.4em;}

#xmas .hilite{
	background:white;
}
#xmas{
	margin:5px 10px 5px 35px;
}
#xmas td {
	padding: 3px 20px;
}
#xmas td.leftc{
	text-align:right;
}
.red{
	color:red;
}
.ecar {
list-style-type:disc;
}
.ecar li {
margin-left:25px;
}
dl.holist {
	font-size:11px;
	line-height:17px;
	padding: 0;
	margin: 0;
	}
dl.holist dd {
	padding-left: 1.2em;

	}
dl.holist dt {
	font-weight:bold;
}
#maincontent p.redfirstline::first-line {
color:red;
}
.smaller {
font-size:80%;
}
.bigger {
font-size:120%;}
p.whitebg {
background-color:rgba(255,255,255,0.6);
}
#maincontent p.red:first-line{
color:red;
}
#maincontent p.green:first-line{
color:green;
}
@import url(http://fonts.googleapis.com/css?family=Droid+Sans:400,700);

/* the interesting 3D scrolling stuff */
#titles
{
	position: absolute;
	width: 18em;
	height: 50em;
	bottom: 0;
	left: 70%;
	margin-left: -9em;
	font-size: 350%;
	text-align: center;
	overflow: hidden;
	-webkit-transform-origin: 50% 100%;
	-moz-transform-origin: 50% 100%;
	-ms-transform-origin: 50% 100%;
	-o-transform-origin: 50% 100%;
	transform-origin: 50% 100%;
	-webkit-transform: perspective(300px) rotateX(25deg);
	-moz-transform: perspective(300px) rotateX(25deg);
	-ms-transform: perspective(300px) rotateX(25deg);
	-o-transform: perspective(300px) rotateX(25deg);
	transform: perspective(300px) rotateX(25deg);
}

#titles:after
{
	position: absolute;
	content: ' ';
	left: 0;
	right: 0;
	top: 0;
	bottom: 60%;
	background-image: -webkit-linear-gradient(top, rgba(0,0,0,1) 0%, transparent 100%);
	background-image: -moz-linear-gradient(top, rgba(0,0,0,1) 0%, transparent 100%);
	background-image: -ms-linear-gradient(top, rgba(0,0,0,1) 0%, transparent 100%);
	background-image: -o-linear-gradient(top, rgba(0,0,0,1) 0%, transparent 100%);
	background-image: linear-gradient(top, rgba(0,0,0,1) 0%, transparent 100%);
	pointer-events: none;
}

#titles p
{
	text-align: justify;
	margin: 0.8em 0;
	line-height:40px;
	color:yellow;
	font-family: "Droid Sans", arial, verdana, sans-serif;
	font-weight: 700;
	color: #ff6;

}

#titles p.center
{
	text-align: center;
}

#titles a
{

	color: #ff6;
	text-decoration: underline;
}

#titlecontent
{
	position: absolute;
	top: 65%;

}





</style>
<script type="text/javascript">
$(function(){
		$('#datepicker').datepicker({
					inline: true
				});
	});
// Alert Popup for Marquee!
function show_details(){
	alert("Our current phone systems are quite old and are being replaced this week.  There may be sporadic loss of phone service.  If you can't get through please try again.  We are also improving your calling experience by eliminating the automated messages - you will be connected to a live person when you call.  Thanks for your patience!");
}
$(document).ready(function(){





	jQuery('ul.sf-menu').superfish({
		pathClass: 'current'
	});

	$('a.newWindow').click(function(){
   window.open(this.href);
   return false;
	});

	$('#playButton').hide();
	var numSlides = $('#news div').length;
	var pause_show = false;
	var starter = Math.floor(Math.random()*numSlides);
	starter = 0;
	var fxArray = ["blindX","blindY","blindZ","cover","curtainX","curtainY","fade","fadeZoom","growX",
					"growY","none","scrollUp","scrollDown","scrollLeft","scrollRight","scrollHorz",
					"scrollVert","shuffle","slideX","slideY","toss","turnUp","turnDown","turnLeft",
					"turnRight","uncover","wipe","zoom"];
	var thisTimefx =		fxArray[Math.floor(Math.random() * fxArray.length)];
	thisTimefx = "scrollHorz";
	$('<span> '+thisTimefx+ '<\/span>').appendTo('#specialfx');

	$('#news').cycle({
		fx: thisTimefx,
		speedIn: 1800,
		speedOut:1200,
		timeout: 6000,
		startingSlide: starter,
		//pagerAnchorBuilder: function() {return '<img src="/favicon.png">';},
		pause: true,
		pager: '#slideshownav',
		next: '#nextButton',
		prev: '#prevButton',
		containerResize: true
		});

	$('#pauseButton').click(function() {
		$('#news').cycle('pause');
		$('#pauseButton').hide();
		$('#playButton').show();
		pause_show = true;
	});

	$('#playButton').click(function() {
		$('#news').cycle('resume');
		$('#pauseButton').show();
		$('#playButton').hide();
		pause_show = false;
	});

	$('#news div').hover(function() {
		if (pause_show === false) {
		$('#paused').addClass('panelhover');
	}	}, function(){
		if (pause_show === false) {
		$('#paused').removeClass('panelhover');
	}	});

	$('#font_smaller').click(function() {
		var cookieval=readCookie("font_size");
		if (cookieval=="smaller") {
			createCookie("font_size","smallest",365);
			location.reload();
		}else{
			createCookie("font_size","smaller",365);
			location.reload();
		}
		});

	$('#font_normal').click(function() {
		createCookie("font_size","","1");
		location.reload();
		});

	$('#font_larger').click(function() {
		var cookieval=readCookie("font_size");
		if (cookieval=="larger") {
			createCookie("font_size","largest",365);
			location.reload();
		}else{
			createCookie("font_size","larger",365);
			location.reload();
		}
		});



	});


</script>
<link rel="icon" type="image/png" href="/favicon.png">
</head>
<body>

<div id="wrap">
    <div id="header"><?

		include'xxxheader.php';?></div>
<div id="menucont"><?include'xxxmenu.php';?></div>

	<div id="maincontent">
		<div id="leftcol">

<div id="newsOuterBox" style="background:#fff8e6;">
<div id="slideshownav">
<? $newscounter=0;	?>
</div>
<?if($view=="debug") {?>
<div id="fakenews">
<?}else {?>
<div id="news" style="min-height:266px;"><?}?>


	<?if(speedslide(20150803,20150801,$slides,
	"tmp/tomatocook",
	"https://www.google.com/calendar/event?eid=NGM4NmNtcXNwcW52cHZhMDMwazA5b25kYmcgNGswOWo2anE3c3M2b29lM3A5NjFydGdyZmdAZw&ctz=America/New_York"))
	{$newscounter++; //end
	}?>

	<?if(speedslide(20150804,20150801,$slides,
	"tmp/bricksaugb",
	"https://www.google.com/calendar/event?eid=OXM5YXA1MnBnZjZncTVpOHNoOGRrNW90NDggZmJrbGV0Z2pkdDkzZzMyN2dldTdqb2l0ZTRAZw&ctz=America/New_York"))
	{$newscounter++; //end
	}?>

	<?if(speedslide(20150804,20150801,$slides,
	"tmp/cardboard",
	"https://www.google.com/calendar/event?eid=c2NmOWJkOGF0NTFqaGI3ZnNtN29vODRob28gYzJ2N2Zxa2hrYzQyZm0yNXMxNDVnbzZjYWdAZw&ctz=America/New_York"))
	{$newscounter++; //end
	}?>

	<?if(speedslide(20150804,20150801,$slides,
	"tmp/tomatoart",
	"https://www.google.com/calendar/event?eid=M2w3ZWVuMTRxNnU4dmlidDhoYnZvY3NpMmcgNGswOWo2anE3c3M2b29lM3A5NjFydGdyZmdAZw&ctz=America/New_York"))
	{$newscounter++; //end
	}?>

	<?if(speedslide(20150805,20150802,$slides,
	"tmp/zucchini",
	"https://www.google.com/calendar/event?eid=NmlocXZlNms3anE5OG5rYWtyNmZsNjJ2MDBfMjAxNTA4MDQgMW84OWc1YXA2bzFoZmI4ZThxYmdhMzlncGdAZw&ctz=America/New_York"))
	{$newscounter++; //end
	}?>

	<?if(speedslide(20150806,20150802,$slides,
	"tmp/veins",
	"https://www.google.com/calendar/event?eid=YzJybDRjaDFoMnZyYmhjZW5rdWw0czVybGsgZmJrbGV0Z2pkdDkzZzMyN2dldTdqb2l0ZTRAZw&ctz=America/New_York"))
	{$newscounter++; //end
	}?>

	<?if(speedslide(20150807,20150803,$slides,
	"tmp/yugiohaug",
	"https://www.google.com/calendar/event?eid=Zmxyc2RuNDlrcXVnMnF0a2loZmVpMjkxZWMgYzJ2N2Zxa2hrYzQyZm0yNXMxNDVnbzZjYWdAZw&ctz=America/New_York"))
	{$newscounter++; //end
	}?>

	<?if(speedslide(20150815,20150801,$slides,
	"tmp/gameonauga",
	"gameon.php"))
	{$newscounter++; //end
	}?>

	<?if(speedslide(20150807,20150803,$slides,
	"tmp/scrabble",
	"https://www.google.com/calendar/event?eid=czVoNWx0dmhtYzVlZGRzbGhrbDVvcDNuZTggMW84OWc1YXA2bzFoZmI4ZThxYmdhMzlncGdAZw&ctz=America/New_York"))
	{$newscounter++; //end
	}?>



	<?if(speedslide(20150811,20150804,$slides,
	"tmp/bookswap",
	"https://www.google.com/calendar/event?eid=aWVqMWNqaWsxa3JjYnN1bTBxcThlbHY3M3MgZmJrbGV0Z2pkdDkzZzMyN2dldTdqb2l0ZTRAZw&ctz=America/New_York"))
	{$newscounter++; //end
	}?>

	<?if(speedslide(20150811,20150805,$slides,
	"tmp/sunsafety",
	"https://www.google.com/calendar/event?eid=ZmVuMzNqbGJubGFqdDc3ajdkZTFwOTQ3bjAgZmJrbGV0Z2pkdDkzZzMyN2dldTdqb2l0ZTRAZw&ctz=America/New_York"))
	{$newscounter++; //end
	}?>

	<?if(speedslide(20150813,20150806,$slides,
	"tmp/claypen",
	"https://www.google.com/calendar/event?eid=b21pYmJqcXNqN2dlOTUwdTU3aGdldGt0OTggZmJrbGV0Z2pkdDkzZzMyN2dldTdqb2l0ZTRAZw&ctz=America/New_York"))
	{$newscounter++; //end
	}?>

	<?if(speedslide(20150814,20150807,$slides,
	"tmp/dmv2goaugf",
	"https://www.google.com/calendar/event?eid=azl1ODluaTZudjRoOG1uY3VqN3RxcG1tM2cgMW84OWc1YXA2bzFoZmI4ZThxYmdhMzlncGdAZw&ctz=America/New_York"))
	{$newscounter++; //end
	}?>

	<?if(speedslide(20150815,20150807,$slides,
	"tmp/frozenparty",
	"https://www.google.com/calendar/event?eid=OG45YmM1ZW1nZjZjNjdhY2dkbTIyMm92djggYzJ2N2Zxa2hrYzQyZm0yNXMxNDVnbzZjYWdAZw&ctz=America/New_York"))
	{$newscounter++; //end
	}?>

	<?if(speedslide(20150815,20150807,$slides,
	"tmp/flagaugf",
	"https://www.google.com/calendar/event?eid=dXVnNWYyN2hkZ3R0a3BvcmJtMWxjODZsanMgMW84OWc1YXA2bzFoZmI4ZThxYmdhMzlncGdAZw&ctz=America/New_York"))
	{$newscounter++; //end
	}?>

	<?if(speedslide(20150815,20150807,$slides,
	"tmp/tomatofest",
	"https://www.google.com/calendar/event?eid=cjlmZ2JlNXVoZmNnMjlhcmR0ZTU1OWtvYTAgNGswOWo2anE3c3M2b29lM3A5NjFydGdyZmdAZw&ctz=America/New_York"))
	{$newscounter++; //end
	}?>

	<?if(speedslide(20150815,20150808,$slides,
	"tmp/magicaugm",
	"https://www.google.com/calendar/event?eid=dnVzZ2ltYTAxODlrOW41MnBlNnBqYmxlcWsgNGswOWo2anE3c3M2b29lM3A5NjFydGdyZmdAZw&ctz=America/New_York"))
	{$newscounter++; //end
	}?>

	<?if(speedslide(20150816,20150809,$slides,
	"tmp/huntaugf",
	"https://www.google.com/calendar/event?eid=OHVkcm1vcTgzMHJlZ25lYnB1dGVuZmplcm8gMW84OWc1YXA2bzFoZmI4ZThxYmdhMzlncGdAZw&ctz=America/New_York"))
	{$newscounter++; //end
	}?>

	<?if(speedslide(20150818,20150809,$slides,
	"tmp/seniornavaugb",
	"https://www.google.com/calendar/event?eid=bXQ3bjZyYWNqajZwY3NiaGw3ZzUwa2hkMTggZmJrbGV0Z2pkdDkzZzMyN2dldTdqb2l0ZTRAZw&ctz=America/New_York"))
	{$newscounter++; //end
	}?>

	<?if(speedslide(20150818,20150809,$slides,
	"tmp/artrelax",
	"https://www.google.com/calendar/event?eid=Nm0xaTE3YWdrZWJiOWVrMWtvY2htZXFsZW8gZmJrbGV0Z2pkdDkzZzMyN2dldTdqb2l0ZTRAZw&ctz=America/New_York"))
	{$newscounter++; //end
	}?>

	<?if(speedslide(20150819,20150810,$slides,
	"tmp/buttfly",
	"https://www.google.com/calendar/event?eid=NWM4NmIya25icmE1N3RoYWxiaGthbDV1aTggZmJrbGV0Z2pkdDkzZzMyN2dldTdqb2l0ZTRAZw&ctz=America/New_York"))
	{$newscounter++; //end
	}?>


	<?if(speedslide(20150820,20150811,$slides,
	"tmp/writeaugm",
	"https://www.google.com/calendar/event?eid=YTFubzBvbHJyczhxaWxmamtwYjFkcm4xcTRfMjAxNTA4MjBUMjIwMDAwWiA0azA5ajZqcTdzczZvb2UzcDk2MXJ0Z3JmZ0Bn&ctz=America/New_York"))
	{$newscounter++; //end
	}?>


	<?if(speedslide(20150825,20150815,$slides,
	"tmp/scrabble",
	"https://www.google.com/calendar/event?eid=czVoNWx0dmhtYzVlZGRzbGhrbDVvcDNuZTggMW84OWc1YXA2bzFoZmI4ZThxYmdhMzlncGdAZw&ctz=America/New_York"))
	{$newscounter++; //end
	}?>


<?if(speedslide(20160101,20150519,$slides,
"tmp/imini",
"http://cat.mfrl.org/uhtbin/cgisirsi.exe/0/CBURG/0/5?searchdata1=%22ipad+mini%22&srchfield1=TI%5ETITLE"))
{$newscounter++; //end
}?>



<?if(($archive=="archive")) include 'index.archive.php';?>

<? $randommm=mt_rand(0,1)+1;
$immmage="3ms";
if((($year==2015)&&($month==2))||(($year==2015)&&($month==3)&&($day<9)))
	{$immmage.="oon"; $mmmlink="online.php";}
else {$immmage.="lide"; $mmmlink="http://ebook.3m.com/library/mfreglib/";}
$immmage.=$randommm;
if(speedslide(20161231,20150225,$slides,
$immmage,
$mmmlink))
{$newscounter++; //end
}?>


<?$livehooplas=array("actionhoopla","audiobookhoopla","britishhoopla","chinesehoopla",
		"dramahoopla","frenchhoopla","hoopla","romancehoopla",
		"spanishhoopla","thursdayhoopla","tuesdayhoopla","fridayhoopla","disneyhoopla");
$whichtoshow=mt_rand(0,12);
if($whichtoshow>8){
	if(date("D")=="Tue")$whichtoshow=10;
	if(date("D")=="Thu")$whichtoshow=9;
	if(date("D")=="Fri")$whichtoshow=11;
	if(date("D")=="Sat")$whichtoshow=12;
	if(date("D")=="Sun")$whichtoshow=12;
}
if($_REQUEST['showhoopla']!='')$whichtoshow=$_REQUEST['showhoopla'];
$hooplaimg="tmp/".$livehooplas[$whichtoshow];
if(speedslide(20151201,20141001,$slides,
$hooplaimg,
"https://www.hoopladigital.com/home"))
{$newscounter++; //end
	}?>



<?if(speedslide(20160601,20150428,$slides,
"tmp/1989calledagain",
"/about.php"))
{$newscounter++; //end
	}?>


<?if(speedslide(20150101,20140715,6,
"kindles",
"http://cat.mfrl.org/uhtbin/cgisirsi.exe/0/CBURG/0/5?searchdata1=KINDLE&srchfield1=TI%5ETITLE&item_1cat=AV"))
{$newscounter++; //end Kindle eBooks
	}?>







<?if(showslide(20141230,20130604,$slides)){$newscounter++;?>
<div style="padding:0; border:0;">
<a style="margin:0;" href="https://www.rbdigital.com/montgomeryfloydva/zinio" onClick="javascript: pageTracker._trackPageview('/outgoing/<?if ($inlibrary) echo"i"; else echo"o"; ?>l/zinio');">
<img src="/images/tmp/zinio.png" alt="Click for more info" title="Click for more info">
</a>
</div>
 <? //end Zinio Revised
	}?>


<?if(showslide(20141230,20130604,$slides)){$newscounter++;?>
<div style="padding:0; border:0;">
<a href="http://public.literati.credoreference.com" onClick="javascript: pageTracker._trackPageview('/outgoing/<?if($inlibrary)echo"i";else echo"o";?>l/literati');" style="margin:0;">
<img src="/images/literatipublic.png" alt="Click for more info" title="Click for more info">
</a>
</div>
 <? //end Literati Revised
	}?>



<?if(showslide(20151230,20120517,$slides)){$newscounter++;?>
<div style="padding:0; border:0;">

<img src="/images/gamingcart2.png" alt="Ask at the Circulation Desk to sign up!" title="Ask at the Circulation Desk to sign up!" >

</div>
 <? //end Gaming Revised again
	}?>




<!--

<?if(showslide(20141230,20130604,1)){$newscounter++; ?>
<div style="height:220px;">
<p>New Digital Media<br>
<a href="http://montgomeryfloydva.oneclickdigital.com/" onClick="javascript: pageTracker._trackPageview('/outgoing/<?if ($inlibrary) echo"i"; else echo"o"; ?>l/oneclickdigital');">
<img src="/images/oneclickdigital-logo.png" alt="OneClickdigital Audiobook Downloads" class="left" style="margin-right:5px;"></a>
Now your MFRL Library Card is even more powerful. Thousands of audiobooks
 are available for download through <a href="http://montgomeryfloydva.oneclickdigital.com/" onClick="javascript: pageTracker._trackPageview('/outgoing/<?if ($inlibrary) echo"i"; else echo"o"; ?>l/oneclickdigital');">OneClickdigital</a>. <br>&nbsp;<br>
 <a href="https://www.rbdigital.com/montgomeryfloydva/zinio" onClick="javascript: pageTracker._trackPageview('/outgoing/<?if ($inlibrary) echo"i"; else echo"o"; ?>l/zinio');">
<img src="/images/zinio-logo.png" alt="Zinio Magazine Downloads" class="right" style="margin-left:5px;"></a>
Also new is  <a href="https://www.rbdigital.com/montgomeryfloydva/zinio" onClick="javascript: pageTracker._trackPageview('/outgoing/<?if ($inlibrary) echo"i"; else echo"o"; ?>l/zinio');">Zinio</a>
with which you can download
 full digital copies of your favorite magazines to your computer or mobile device.<br>&nbsp;<br>
 You can find these as well as our other eBook and Audiobook resources
 on our <a href="/online.php?cat=dl">eLibrary page</a>.

</p>
</div>
 <? //end digital media
	}?>



<?if (showslide(20131231,20120101,6)) {$newscounter++;?>

<div style="border:2px solid #96f; padding:10px; margin-bottom:5px;">

<p style=" margin-top:0; padding-top:0;">
<a href="http://swvapub.lib.overdrive.com/" onClick="javascript: pageTracker._trackPageview('/outgoing/<?=($inlibrary?'i':'o');?>l/swvapub.overdrive.com');">
<img src="/images/overdriveadvantage.png" alt="" class="right" style="margin-right:10px; margin-top:0px; margin-bottom:5px;">
</a>

<span style="font-size:1.1em; color:#90c; font-weight:bold; line-height:15px; margin-top:0; padding-top:0;">
 AudioBooks and eBooks <span style="color:#f60;">Plus</span></span><br>
<br><span style="color:red; font-weight:bold; padding-left:15px;">New:</span> We are purchasing extra copies
of high demand titles just for Montgomery-Floyd patrons!  Sign in to OverDrive before you browse to see
these additional copies.
<br><span style="color:red; font-weight:bold; padding-left:15px;">New:</span> eBooks and MP3 Audiobooks can now be returned early from your mobile device via the
<a href="http://omc.overdrive.com/"  onClick="javascript: pageTracker._trackPageview('/outgoing/<?=($inlibrary?"i":"o");?>l/overdrive.com.app');">Overdrive App</a>!
<br><span style="padding-left:15px;">Download</span> titles to read on your computer or mobile device.

We have <a href="http://cat.mfrl.org/uhtbin/cgisirsi.exe/0/CBURG/0/5?searchdata1=Nook&amp;srchfield1=TI&#94;TITLE&amp;match_on=EXACT">Nooks</a>
and <a href="http://cat.mfrl.org/uhtbin/cgisirsi.exe/0/CBURG/0/5?searchdata1=Kindle&amp;srchfield1=TI&#94;TITLE&amp;match_on=EXACT">Kindles</a> that can be checked out, too.
Browse our <a href="http://swvapub.lib.overdrive.com/" onClick="javascript: pageTracker._trackPageview('/outgoing/<?if ($inlibrary) echo"i"; else echo"o"; ?>l/overdrive.com');">OverDrive</a> site, or visit our <a href="overdrive.php">eBook Quick start guide</a> to learn more!
</p>
</div>

<?}?>





<?if(showslide(20141230,20121022,1)){$newscounter++;?>
<div>
<p>New Research and Homework Database<br>
<a href="http://public.literati.credoreference.com" onClick="javascript: pageTracker._trackPageview('/outgoing/<?if($inlibrary)echo"i";else echo"o";?>l/literati');" style="float:left;">
<img src="/images/credo.png" class="left" alt="Credo Literati"></a>
<a href="http://public.literati.credoreference.com" onClick="javascript: pageTracker._trackPageview('/outgoing/<?if($inlibrary)echo"i";else echo"o";?>l/literati');">
Literati Public</a> includes a host of resources, such as educational content for K-12 students and adults, informational videos and tutorials, and interactive discovery tools. Literati Public has been specifically customized for Virginia Libraries and includes Homework Help.
</p>
</div>
 <? //end
	}?>



	-->




</div>
<? $slideshowend=true;
if($view!="debug"){?>
	<div id="slideshownav2" style="padding:5px 5px 5px 145px; overflow:auto;">
		<a href="#" id="prevButton"><div class="buttonborder" title="Previous Slide"><span class="rewindBtn">Back</span><span class="rewindBtnB">Back</span></div></a>
		<a href="#" id="pauseButton"><div class="buttonborder" title="Pause Slideshow" id="paused"><span class="pauseBtn">Pause</span></div></a>
		<a href="#" id="playButton"><div class="buttonborder" title="Paused: Click to Resume Slideshow"><span class="playBtn">Play</span></div></a>
		<a href="#" id="nextButton"><div class="buttonborder" title="Next Slide"><span class="forwardBtn">Next</span><span class="forwardBtnB">Next</span></div></a>
		<?if($view=="hide") {echo "Debug date: ".$fdate."<br><a href=\"?";
		if ($fdate!="") echo "futuredate=".$fdate."&amp;";

		echo "view=debug\">Show tools</a>";
		echo ' &bull; <a href="?futuredate='.showtomorrow($fdate).'&view='.$view.'">Tomorrow</a>';

		}?>
	</div><?}?>

<?if((($_REQUEST['futuredate']!="")||($view=="debug"))&&($view!="hide")){
?><div style="border: 1px solid red;"><h3 class="subheader">End of Slideshow</h3>

<p class="pnorm">You are viewing the website as if today was <?echo date("l, F jS, Y",mktime(0,0,0,$month,$day,$year))?>.</p>
<form action="/index.php">
<p class="pnorm">Take me to
<input type="text" id="datepicker" name="futuredate"><br>
<input type="radio" name="view" value="debug" <?if (($view=="debug")||($view=="")) echo "checked=\"checked\"";?> >Explode the Future!<br>
<input type="radio" name="view" value="hide" <?if ($view=="hide") echo "checked=\"checked\"";?> >Hide in the Future!<br>

<input name="Submit" type="submit" id="submit_button" value="Submit"></p></form></div><?
}?>

</div>



<p>&nbsp;</p>

<!--
<div style="min-height:130px;">
<a href="/notify.php">
	<img src="/images/txtholds.png" alt="Get Hold Notices as TXTs">
</a>
</div>	-->




<?if($month<9){?>
<div style="fpdiv">
<?if(speedslide(20150901,20150728,100,
"tmp/starreaders2015",
""))
{$newscounter++; //end
	}?>

</div><?}?>


<div class="fpdiv" style="min-height:130px;">
<a href="mfrlfoundation.php"><img src="/images/donate.png" alt="Donate Today!" style="height:130px; "></a>
<p style="margin-top:35px;" class="bluefirst">Love Your Library!<br>Visit our <a href="mfrlfoundation.php">Foundation Page</a> to see how you can support your library.
<em>All donations are tax deductible.</em></p>
</div>

<!-- Check one out in the future -->
<? if ($vgpos=="left") {?>
<p class="bluefirst">We now have Video Games<br>
MFRL now circulates
<a href="http://cat.mfrl.org/uhtbin/cgisirsi.exe/0/CBURG/0/5?item_type=VIDEOGAME">Video Games</a>
for
<a href="http://cat.mfrl.org/uhtbin/cgisirsi.exe/0/CBURG/0/5?searchdata1=playstation+3&amp;item_type=VIDEOGAME">Playstation 3</a>,
<a href="http://cat.mfrl.org/uhtbin/cgisirsi.exe/0/CBURG/0/5?searchdata1=wii&amp;item_type=VIDEOGAME">Wii</a>,
<a href="http://cat.mfrl.org/uhtbin/cgisirsi.exe/0/CBURG/0/5?searchdata1=ds&amp;item_type=VIDEOGAME">DS</a>,
<a href="http://cat.mfrl.org/uhtbin/cgisirsi.exe/0/CBURG/0/5?searchdata1=3ds&amp;item_type=VIDEOGAME">3DS</a>, and
<a href="http://cat.mfrl.org/uhtbin/cgisirsi.exe/0/CBURG/0/5?searchdata1=xbox+360&amp;item_type=VIDEOGAME">Xbox 360</a> for a one week check out period. We're taking suggestions for additional game titles!</p>
<?}?><!-- Check one out in the future -->

<!--
<p class="bluefirst">Your hold is ready - we can TXT you!<br>
We can now Text your cell phone when your requested item is available.
Set your <a href="email_notify.php">notification preferences</a> to enable it.</p>
-->

<!-- Movies left (make any changes to "Movies  Right" below as well) -->
<? if ($moviepos=="left") {?>
<p><a href="movies.php"><img src="/images/mfrlmovieswide.jpg" alt="MFRL Movies" style="float:none;"></a><br>
Join us for new release movies and old favorites at all of our Library Branches. Show times and dates are listed on our <a href="movies.php">Movie page</a>.
</p>
			<?}?>
<!-- Movies -->

<!-- DEBUG FOR FUTURE DATES -->
<? if ($_REQUEST['debug']=="") {} else {?>
<? if ($_REQUEST['futureday']!='') {?>
<? if ($_REQUEST['futuremonth']!='') $futuremonthstring="&amp;futuremonth=".$month; ?>
<p>View Future Dates:<br>
Day: <a href="?futureday=<?if ($day-1<10) echo "0"; echo $day-1; echo $futuremonthstring;?>"><?if ($day-1<10) echo "0";  echo $day-1;?></a> - <a href="?futureday=<?if ($day+1<10) echo "0"; echo $day+1; echo $futuremonthstring;?>"><?if ($day+1<10) echo "0"; echo $day+1;?></a><br>
Month: <a href="?futureday=<?echo $day; echo "&amp;futuremonth="; echo $month-1;?>"><?echo $month-1;?></a> - <a href="?futureday=<?echo $day; echo "&amp;futuremonth="; echo $month+1;?>"><?echo $month+1;?></a></p>
<?}?><?}?>
<!-- DEBUG FOR FUTURE DATES -->
    </div>
<!--******************************
    ******************************
    **      END LEFT SIDEBAR	**
    **    START RIGHT SIDEBAR	**
    ******************************
    ******************************-->
    <div id="rightcol">
<?if($slides>14)echo "<p>&nbsp;</p>";?>

<!-- Search Box -->
	<div id="searchbox" >
		<form method="post" action="http://cat.mfrl.org/uhtbin/cgisirsi.exe/x/CBURG/0/57/5" >
		<input type="text" name="searchdata1"  value="">
		<select name="format" class="form_catmenu1">
		<option value="MARC">Books</option>
		<option value="ANY">Any</option>
		<option value="MUSIC">Audio</option>
		<option value="VM">Video</option>
		</select>
		<select name="item_2cat" >
		<option value="ANY">All Ages</option>
		<option value="EASY">Easy</option>
		<option value="JUVENILE">Juvenile</option>
		<option value="TEEN">Teen</option>
		<option value="ADULT">Adult</option>
		<option value="LT">Large Type</option>
		</select>
		<select name="srchfield1" >
		<option value="TI^TITLE^TITLES"> Title </option>
		<option value="AU^AUTHOR^AUTHORS"> Author </option>
		<option value="">Any</option>
		</select>
		<input type="submit" name="submit" value="Search Catalog" onClick="javascript: pageTracker._trackPageview('/outgoing/interim/catalog.search');">&nbsp;
		<input type="hidden" name="searchfield1" value="GENERAL^SUBJECT^GENERAL^^ words or phrase">
		<input type="hidden" name="sort_by" value="-PBYR">
		<input type="hidden" name="user_id" value="WEBSERVER">
		<input type="hidden" name="password" value="WEBSERVER">
		</form>
	</div>
<!-- End Search Box -->







<?
if ($holidaytimes=="true"){?>
<div style="border: 2px solid #f21313; background-color:#fcffyfc;  margin-bottom:5px; padding-left:5px; padding-right:5px;">
<p class="bluefirst">Holiday Schedule<br>
	The library will be closed Friday, July 3rd and Saturday, July 4th in observance of
	<?wiki("Independence Day (United States)","Independence Day");?>.  We're also closed on Sunday, July 5th, as we are closed on Sundays during the summer months.

 </div>
<?}?>





<?
if ((($month==8)&&($day>10))||(($month==9)&&($day<9))) {?>
<div class="fpdiv"><p class="bluefirst" >Storytime on Hiatus<br>
Storytimes are on break starting
<b>August 17</b> and will resume on <b>September 8</b>.<br> Meadowbrook Library will continue
to have Storytimes during the break.

</p></div>
<?}?>


<?if(($year==2014)&&(($month==10)||(($month==11)&&($day<7)))){?>
<div>
<a href="mfrlfoundation.php">
	<img src="/images/basketbox2.png" alt="Click here for more information and to buy tickets">
</a>
</div><?}?>


<div class="fpdiv">




<? // Display Board of Trustees meeting, starting 1 week before, and disappear the day after. ?>

<? if(($year==2015)&&($month==02)&&($day<26)){
?><p class="bluefirst">Board of Trustees Meeting<br> The next meeting
will be held at the <span class="red">Christiansburg</span> Branch. It has been <span class="red">Postponed</span> to:
<a href="https://www.google.com/calendar/event?eid=ZThjcTdxMGttNmw5N3IwdjlnMHJkb2dnYjQgZmJrbGV0Z2pkdDkzZzMyN2dldTdqb2l0ZTRAZw">Wednesday, February 25 2015</a><b> at 7pm</b>.
View the <a href="http://www.mfrl.org/wp/?p=3489">February 18, 2015 Library Board Agenda</a>.<?
}else nextmeeting("604800"); ?>


<?if(($year==2014)&&($month==10)&&($day<16)){?>
<p class="fph3 bluefirst">Montgomery County FY 2014 Annual Report<br>
	This year's annual report is now viewable on <a href="http://youtu.be/-qevWXrlWEQ">YouTube</a>.
</p><?}?>

<?if ($isalisting){?>
<p class="fph3 bluefirst">The Library is Hiring<br>
<span class="red">July 2: New Position Posted</span> <br>
 View our <a href="employment.php">Employment</a> page for more information.</p><?}?>
<?if(($year==2015)&&($month<9)||(($month==9)&&($day<=7))){?>
<p class="bluefirst">Floyd Hours Extended<br>
	The Jessie Peterman Library will now be open until 7:00 p.m. Monday – Thursday evenings.</p>
<?}?>
<p  class="bluefirst">Library News eMails<br>
Want your inbox to tell you what's going on at your library? Sign up for one (or more!) of our branch-specific <a href="/mailinglists.php">Announcement Lists</a>.</p>



<!-- Going once, Going Twice, Posted to the web [auctions] --> <?if ($auction!="hide") {?>
<p class="fph3 bluefirst">Buy Our Stuff! <?php if ($auction!="") {?><span class="red" style="font-size:.8em;">New Items <?echo $auction;?></span><?}?><br>
Ever wonder what happens to old MFRL equipment?  It goes up for
<a href="http://www.publicsurplus.com/sms/montgomery,va/list/current?orgid=17434"  onClick="javascript: pageTracker._trackPageview('/outgoing/<?echo($inlibrary?"i":"o");?>l/auction');">auction</a>,
 along with other Montgomery County items.  Check back regularly, you may find a bargain!
</p><?}?>
<!-- Going once, Going Twice, Posted to the web -->


</div>
<? /*******************************************************************************
   ***	End News Box															***
   *******************************************************************************/ ?>



<Div class="fpdiv">
	<p class="bluefirst">Library of VA Literary Awards People's Choice<br>
Vote for the <a href="http://www.lva.virginia.gov/public/litawards/vote.asp" onClick="javascript: pageTracker._trackPageview('/outgoing/<?echo($inlibrary?"i":"o");?>l/va.lit.awards');">12th Annual People’s Choice Awards</a>!
 Haven’t read them all yet? Check them out:<br>
<b>Fiction</b>: <?booklink("Good Bad Emus","tnote","The Good, The Bad, and the Emus");?>,
 <?booklink("Gray Mountain","t");?>,
 <?booklink("The Hunger Artist","tnote");?>,
 <?booklink("How to Tell Toledo from the Night Sky","t");?>,
 <?booklink("Small Blessings","t");?><br>

<b>Non-Fiction</b>: <?booklink("Beyond the First Draft","t");?>,
<?booklink("Give War and Peace a Chance","t");?>,
 <?booklink("Factory Man","t");?>,
 <?booklink("Embattled Rebel","t");?>,
 <?booklink("Overwhelmed","t");?>




</p>
</div>


<!-- Staff Pickaxes -->
<div class="fpdiv">
<p class="bluefirst" style="margin-bottom:20px; margin-top:3px; margin-right:5px;">
<?newbookdisplay();?>
New Arrivals!<br>
Check out the <a href="new_fiction.php">New Books</a>
and <a href="new_fiction.php?action=newm">New Movies</a> recently added to the library collection.
<?if(($year==2014)&&(($month==10)||(($month==11)&&($day<13)))) {?>
	<br><br><span style="color:red;font-weight:bold;">New!</span> Now including Non-Fiction and Biographies.
<?}?>

</p>
<div style="clear:both;"></div>
</div>
<!-- Staff Pickaxes -->


<div class="fpdiv">
<p class="bluefirst">Bill Payments<br>

<?if(($year==2014)&&($month==7)){?>
<span style="color:red;font-weight:bold">New!</span>
<?}?>
Library Bills can be paid online. Visit our <a href="payonline.php">Bill Payment</a> page for more information.</p>
<p class="bluefirst">Reserve a PC online!<br>
Go to our <a href="reserveacomputer.php">Reserve a Computer</a> page to make your reservation.</p>


<!-- Preduemail -->
<p class="bluefirst">Pre-Due and Holds Notifications<br>
Visit our <a href="/notify.php">Notification</a> page to set TXT / Email preferences. </p>
<!-- Preduemail --></div>




<!-- Check one out in the future -->
<? if ($vgpos=="right") {?>
<p  class="bluefirst">We now have Video Games<br>
MFRL now circulates
<a href="http://cat.mfrl.org/uhtbin/cgisirsi.exe/0/CBURG/0/5?item_type=VIDEOGAME">Video Games</a>
for
<a href="http://cat.mfrl.org/uhtbin/cgisirsi.exe/0/CBURG/0/5?searchdata1=playstation+3&amp;item_type=VIDEOGAME">Playstation 3</a>,
<a href="http://cat.mfrl.org/uhtbin/cgisirsi.exe/0/CBURG/0/5?searchdata1=wii&amp;item_type=VIDEOGAME">Wii</a> and
<a href="http://cat.mfrl.org/uhtbin/cgisirsi.exe/0/CBURG/0/5?searchdata1=xbox+360&amp;item_type=VIDEOGAME">Xbox 360</a> for a one week check out period. We're taking suggestions for additional game titles!</p>
<?}?><!-- Check one out in the future -->


<!-- Do hyou want an iPad? -->
<? if($ipadpos=="right") {?>
<div style="background:#fff8e6; height:120px; padding:1px 10px;">
<p class="bluefirst" >
	<a href="http://cat.mfrl.org/uhtbin/cgisirsi.exe/0/CBURG/0/5?searchdata1=ipad+mini&amp;srchfield1=TI%5ETITLE"
	onClick="javascript: pageTracker._trackPageview('/outgoing/<?echo($inlibrary?"i":"o");?>l/opac.ipad');">
	<img style="float:right;" src="/images/wegotipad3.png" alt=""></a>
	Borrow an iPad Mini<br>
	MFRL now circulates an
	<a href="http://cat.mfrl.org/uhtbin/cgisirsi.exe/0/CBURG/0/5?searchdata1=ipad+mini&amp;srchfield1=TI%5ETITLE"
	onClick="javascript: pageTracker._trackPageview('/outgoing/<?echo($inlibrary?"i":"o");?>l/opac.ipad');">
	iPad Mini</a>
	for two weeks at a time. Library Apps are pre-installed so you can
	try checking out Movies, Music, eBooks, AudioBooks and Magazines using
	your online library.
</p>
</div>

<?}?><!-- You want an iPad -->


<!-- Movies right (make any changes to "Movies  Left" above as well) -->
<? if ($moviepos=="right") {?>
<p><a href="movies.php"><img src="/images/mfrlmoviesmedium.png" alt="MFRL Movies" style="float:none;"></a><br>
Join us for new release movies and old favorites at all of our Library Branches. Show times and dates are listed on our <a href="movies.php">Movie page</a>.
</p>
				<?}?>
<!-- Movies -->



    </div> <!-- end right col -->



     </div><div style="clear:both;"></div>
<!-- <p class="pagename" style="text-align:center; margin-bottom:5px;">Thanks to all of our Summer Reading Program Sponsors</p>
<img src="/images/thankyous.jpg" alt="Thanks to all of our SRP Sponsors" style="float:none;"> -->
    <div id="footer">
<?php include 'xxxfooter.php'; ?>
</div>
	</div> <!-- end content -->
</body>
</html>
