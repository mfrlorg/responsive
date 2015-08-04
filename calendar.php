<!DOCTYPE html>
<?
$currentpage = "calendar.php";
$whatserveristhis = 'thisisthetestserver.txt';
if (file_exists($whatserveristhis)) {$server="test";}
// ************
// *** 2015 ***
// ************
	include 'inlibrary.php';
	    if($_REQUEST['cat']!='') $cat=$_REQUEST['cat'];
    if($_REQUEST['showday']!='') {$datetoshow=$_REQUEST['showday'];
	$datetoshow = $datetoshow."/".$datetoshow;}
    if($_REQUEST['showbranch']!='') $showbranch=$_REQUEST['showbranch'];
    $showbranch=strtolower($showbranch);
    if ($showbranch == "b") $cat="4";
    if ($showbranch == "c") $cat="5";
    if ($showbranch == "f") $cat="6";
    if ($showbranch == "m") $cat="7";?>
<html>
<head>
<title>MFRL Calendar</title>
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
<link rel="icon" type="image/png" href="../favicon.png">
</head>
<body>

<div id="wrap">
    <div id="header"><?include'xxxheader.php';?></div>
	<div id="menucont"><?include'xxxmenu.php';?></div>
	<div id="maincontent">
		<div id="leftmenu">
			<?include'menu.calendar.php';?>
		</div> <!-- End Menu col -->
		<div id="fullrightcol">
			<div class="pagediv">
<h1>Upcoming Programs</h1>
<?//Case to change title depending on branch
switch ($cat) {
	case "1":$this_week_at_branch = 'For adults:';break;
	case "2":$this_week_at_branch = 'For kids:';break;
	case "3":$this_week_at_branch = 'For Teens:';break;
	case "4":$this_week_at_branch = ' <a href="hours.php?branch=b">Blacksburg</a>';
	break;
	case "5":$this_week_at_branch = ' <a href="hours.php?branch=c">Christiansburg</a>';
	break;
	case "6":$this_week_at_branch = ' <a href="hours.php?branch=f">Floyd</a>';
	break;
	case "7":$this_week_at_branch = ' <a href="hours.php?branch=m">Meadowbrook</a>';
	break;
	default:
	$this_week_at_branch = 'All Branches';
	break;
}
?>
<h2>Programs and Activities for <?echo$this_week_at_branch;?></h2>
<div style="background:transparent;" id="calendartop"><form name="filterbybranch" action="#calendartop" method="POST">
<p>Filter: <select name="cat">
<option value=''>All Branches</option>
<option value='4'>Blacksburg</option>
<option value='5'>Christiansburg</option>
<option value='6'>Floyd</option>
<option value='7'>Meadowbrook</option>

</select>
<input name="Submit" type="submit" class="form_button" value="Go!">
<strong class="subheader" style="float:right;">Current Filter: <? echo $this_week_at_branch;?></strong>
</p>
</form>
</div>
<!-- Dropdown goes here -->

<?
switch ($cat) {
case "4":
// Blacksburg
if ($datetoshow==""){?>
<iframe src="http://www.google.com/calendar/embed?title=Programs%20and%20Activities%20for%20the%20Blacksburg%20Branch&amp;showTz=0&amp;mode=AGENDA&amp;height=600&amp;wkst=1&amp;bgcolor=%23fff8e6&amp;src=montgomery.floyd%40gmail.com&amp;color=%23A32929&amp;src=fbkletgjdt93g327geu7joite4%40group.calendar.google.com&amp;color=%230D7813&amp;src=en.usa%23holiday%40group.v.calendar.google.com&amp;color=%232952A3&amp;ctz=America%2FNew_York" style=" border-width:0 " width="650" height="600" ></iframe>
<?} else {?>
<iframe src="http://www.google.com/calendar/embed?title=Programs%20and%20Activities%20for%20the%20Blacksburg%20Branch&amp;showTz=0&amp;mode=DAY&amp;dates=<?echo $datetoshow;?>&amp;height=600&amp;wkst=1&amp;bgcolor=%23fff8e6&amp;src=montgomery.floyd%40gmail.com&amp;color=%23A32929&amp;src=fbkletgjdt93g327geu7joite4%40group.calendar.google.com&amp;color=%230D7813&amp;src=en.usa%23holiday%40group.v.calendar.google.com&amp;color=%232952A3&amp;ctz=America%2FNew_York" style=" border-width:0 " width="650" height="600" frameborder="0" scrolling="no"></iframe>
<?}

break;
case "5":
//Christiansburg
if ($datetoshow==""){?>
<iframe src="http://www.google.com/calendar/embed?title=Programs%20and%20Activities%20for%20the%20Christiansburg%20Branch&amp;showTz=0&amp;mode=AGENDA&amp;height=600&amp;wkst=1&amp;bgcolor=%23fff8e6&amp;src=montgomery.floyd%40gmail.com&amp;color=%23A32929&amp;src=c2v7fqkhkc42fm25s145go6cag%40group.calendar.google.com&amp;color=%235229A3&amp;src=en.usa%23holiday%40group.v.calendar.google.com&amp;color=%232952A3&amp;ctz=America%2FNew_York" style=" border-width:0 " width="650" height="600" ></iframe>
<?} else {?>
<iframe src="http://www.google.com/calendar/embed?title=Programs%20and%20Activities%20for%20the%20Christiansburg%20Branch&amp;showTz=0&amp;mode=DAY&amp;dates=<?echo $datetoshow;?>&amp;height=600&amp;wkst=1&amp;bgcolor=%23fff8e6&amp;src=montgomery.floyd%40gmail.com&amp;color=%23A32929&amp;src=c2v7fqkhkc42fm25s145go6cag%40group.calendar.google.com&amp;color=%235229A3&amp;src=en.usa%23holiday%40group.v.calendar.google.com&amp;color=%232952A3&amp;ctz=America%2FNew_York" style=" border-width:0 " width="650" height="600" frameborder="0" scrolling="no"></iframe>
<?}

break;
case "6":
//Floyd
if ($datetoshow==""){?>
<iframe src="http://www.google.com/calendar/embed?title=Programs%20and%20Activities%20for%20Floyd%20Branch&amp;showTz=0&amp;mode=AGENDA&amp;height=600&amp;wkst=1&amp;bgcolor=%23fff8e6&amp;src=montgomery.floyd%40gmail.com&amp;color=%23A32929&amp;src=1o89g5ap6o1hfb8e8qbga39gpg%40group.calendar.google.com&amp;color=%232952A3&amp;src=en.usa%23holiday%40group.v.calendar.google.com&amp;color=%232952A3&amp;ctz=America%2FNew_York" style=" border-width:0 " width="650" height="600"></iframe>
<?} else {?>
<iframe src="http://www.google.com/calendar/embed?title=Programs%20and%20Activities%20for%20Floyd%20Branch&amp;showTz=0&amp;mode=DAY&amp;dates=<?echo $datetoshow;?>&amp;height=600&amp;wkst=1&amp;bgcolor=%23fff8e6&amp;src=montgomery.floyd%40gmail.com&amp;color=%23A32929&amp;src=1o89g5ap6o1hfb8e8qbga39gpg%40group.calendar.google.com&amp;color=%232952A3&amp;src=en.usa%23holiday%40group.v.calendar.google.com&amp;color=%232952A3&amp;ctz=America%2FNew_York" style=" border-width:0 " width="650" height="600" frameborder="0" scrolling="no"></iframe>
<?}

break;
case "7":
//Meadowbrook
if ($datetoshow==""){?>
<iframe src="http://www.google.com/calendar/embed?title=Programs%20and%20Activities%20for%20The%20Meadowbrook%20Branch&amp;showTz=0&amp;mode=AGENDA&amp;height=600&amp;wkst=1&amp;bgcolor=%23fff8e6&amp;src=montgomery.floyd%40gmail.com&amp;color=%23A32929&amp;src=4k09j6jq7ss6ooe3p961rtgrfg%40group.calendar.google.com&amp;color=%234E5D6C&amp;src=en.usa%23holiday%40group.v.calendar.google.com&amp;color=%232952A3&amp;ctz=America%2FNew_York" style=" border-width:0 " width="650" height="600" ></iframe>
<?} else {?>
<iframe src="http://www.google.com/calendar/embed?title=Programs%20and%20Activities%20for%20The%20Meadowbrook%20Branch&amp;showTz=0&amp;mode=DAY&amp;dates=<?echo $datetoshow;?>&amp;height=600&amp;wkst=1&amp;bgcolor=%23fff8e6&amp;src=montgomery.floyd%40gmail.com&amp;color=%23A32929&amp;src=4k09j6jq7ss6ooe3p961rtgrfg%40group.calendar.google.com&amp;color=%234E5D6C&amp;src=en.usa%23holiday%40group.v.calendar.google.com&amp;color=%232952A3&amp;ctz=America%2FNew_York" style=" border-width:0 " width="650" height="600" frameborder="0" scrolling="no"></iframe>

<?}

break;
default:
//All
{

if ($datetoshow==''){?>
<iframe src="http://www.google.com/calendar/embed?title=Programs%20and%20Activities%20for%20Montgomery-Floyd%20Regional%20Library&amp;showTz=0&amp;mode=AGENDA&amp;height=600&amp;wkst=1&amp;bgcolor=%23fff8e6&amp;src=montgomery.floyd%40gmail.com&amp;color=%23A32929&amp;src=fbkletgjdt93g327geu7joite4%40group.calendar.google.com&amp;color=%230D7813&amp;src=c2v7fqkhkc42fm25s145go6cag%40group.calendar.google.com&amp;color=%235229A3&amp;src=1o89g5ap6o1hfb8e8qbga39gpg%40group.calendar.google.com&amp;color=%232952A3&amp;src=4k09j6jq7ss6ooe3p961rtgrfg%40group.calendar.google.com&amp;color=%234E5D6C&amp;src=en.usa%23holiday%40group.v.calendar.google.com&amp;color=%232952A3&amp;ctz=America%2FNew_York" style=" border-width:0 " width="650" height="600" ></iframe>
<?} else {?>
<iframe src="http://www.google.com/calendar/embed?title=Programs%20and%20Activities%20for%20Montgomery-Floyd%20Regional%20Library&amp;showTz=0&amp;mode=DAY&amp;dates=<?echo $datetoshow;?>&amp;height=600&amp;wkst=1&amp;bgcolor=%23fff8e6&amp;src=montgomery.floyd%40gmail.com&amp;color=%23A32929&amp;src=fbkletgjdt93g327geu7joite4%40group.calendar.google.com&amp;color=%230D7813&amp;src=c2v7fqkhkc42fm25s145go6cag%40group.calendar.google.com&amp;color=%235229A3&amp;src=1o89g5ap6o1hfb8e8qbga39gpg%40group.calendar.google.com&amp;color=%232952A3&amp;src=4k09j6jq7ss6ooe3p961rtgrfg%40group.calendar.google.com&amp;color=%234E5D6C&amp;src=en.usa%23holiday%40group.v.calendar.google.com&amp;color=%232952A3&amp;ctz=America%2FNew_York" style=" border-width:0 " width="650" height="600" frameborder="0" scrolling="no"></iframe>
<?	}
}
break;
}
?>


			</div>
		</div> <!-- end right col -->
    </div>
<div style="clear:both;"></div>
    <div id="footer"><?include'xxxfooter.php';?></div>
</div>
</body>
</html>
