<!DOCTYPE html>
<?
$currentpage = "boardoftrustees.php";
$whatserveristhis = 'thisisthetestserver.txt';
if (file_exists($whatserveristhis)) {$server="test";}
// ********
// * 2014 *
// ********
# Include the Required files.
	include 'inlibrary.php';
if($server=="test")	$wplocation = 'wp_demostart.php';
else $wplocation = 'wp/wp_start.php';

	if (file_exists($wplocation)) { include $wplocation;}
	include 'nextboard.php';
		$numtrustees = 9;

	$boardarray[0] = array ( name => "Margaret R.",
							surname => "Christle",
							position => "Chair",
							email => "mrosschristle@gmail.com",
							toeend => "6/30/2018",
							term => "Term 1",
							district => "District E",
							picoffset => "3",
							priority => "1"
						);
	$boardarray[1] = array ( name => "Alison",
							surname => "Armstrong",
							position => "Vice-Chair",
							email => "amarmstro@radford.edu",
							toeend => "6/30/2016",
							term => "Term 1",
							district => "District F",
							picoffset => "8",
							Priority => "2"
						);
	$boardarray[8] = array ( name => "&quot;Ginny&quot;",
							surname => "Gardner",
							position => "",
							email => "ggardner@swva.net",
							toeend => "6/30/2016",
							term => "Term 2",
							district => "Floyd",
							picoffset => "5",
							priority => "0"
						);
	$boardarray[2] = array ( name => "Cynthia",
							surname => "Saunders",
							position => "Secretary",
							email => "clstes@swva.net",
							toeend => "6/30/2018",
							term => "Term 1",
							district => "Floyd",
							picoffset => "6"
						);
	$boardarray[4] = array ( name => "Karen",
							surname => "Drake",
							position => "",
							email => "kdrake.mfrl@gmail.com",
							toeend => "6/30/2016",
							term => "Term 2",
							district => "District B",
							picoffset => "2",


						);
	$boardarray[5] = array ( name => "Tim ",
							surname => "Thornton",
							position => "",
							email => "timothywthornton@gmail.com",
							toeend => "6/30/2019",
							term => "Term 1",
							district => "District C",
							picoffset => "10"
						);

	$boardarray[3] = array ( name => "Larry",
							surname => "Spencer",
							position => "",
							email => "lspencer06@gmail.com",
							toeend => "6/30/2017",
							term => "Term 1",
							district => "District A",
							priority => "0",
							picoffset => "9"
						);
	$boardarray[7] = array ( name => "Natalie",
							surname => "Cherbaka",
							position => "",
							email => "nscherbaka@gmail.com",
							toeend => "6/30/2017",
							term => "Term 1",
							district => "District G",
							picoffset => "4"
						);
	$boardarray[6] = array ( name => "Curtis",
							surname => "Jones",
							position => "",
							email => "coraljones00@gmail.com",
							toeend => "6/30/2019",
							term => "Term 1",
							district => "District D",
							picoffset => "10"
						);



						/*
	$boardarray[11] = array ( name => "VACANT",
							surname => "",
							position => "",
							email => "",
							toeend => "",
							term => "Apointment Pending",
							term => "Completing vacated term",
							district => "",
							picoffset => "none"
						);
 */
function bot_map($botnumber) {
	if ($botnumber>5) {$botnumber=$botnumber-5; $wide="104px ";} else $wide="0px ";
		$botnumber--;
		$high= $botnumber*104;
		$offset="-".$wide."-".$high."px";
		return($offset);
}

function bot_display($board, $number ,$hilite="")
	{
		//echo " <!-- DEBUG ".$board['picoffset']." | ".bot_map($board['picoffset'])." -->";
		echo "
				<div  class=\"".$hilite." boardpic\" ";
			echo "style=\"background:url(/images/board/boardforwebbigger2014.png) ";
			echo bot_map($board['picoffset']);

			if ($board['picoffset']=="10") {
				echo ";\" title=\"No Picture Available\"></div>";
			} else {
				echo ";\" title=\"".$board['name']." ".$board['surname']."\"></div>";
			}
			echo "<div  class=\"".$hilite." boardinfo\"><b>".$board['name']." ".$board['surname'];
		if ($board['position']!="") {
		echo "<br><i>".$board['position']."</i>"; }
		echo "</b> <br>
			<a href=\"mailto:".$board['email']."\">".$board['email']."</a>
			<br>".$board['term'];
		if (($board['term']=="Apointment Pending")||($board['term']=="Completing vacated term")) {echo "<br>";}
		else {echo " (Ends: ".$board['toeend'].")<br>";}
		echo $board['district']."</div>";
	}
?>
<html>
<head>
<title>Board of Trustees</title>
<meta charset="UTF-8">
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

.boardpic {
width: 98px;
height: 98px;
float:left;
margin-bottom:3px;
border: 1px solid #ffff66;
}
.boardinfo {
height: 90px;
width: 202px;
float:left;
font-size:11px;
line-height:17px;
margin-right:6px;
margin-left:2px;
margin-bottom:3px;
padding: 5px;
}
</style>
<link rel="icon" type="image/png" href="../favicon.png">
</head>
<body>

<div id="wrap">
    <div id="header"><?include'xxxheader.php';?></div>
	<div id="menucont"><?include'xxxmenu.php';?></div>
	<div id="maincontent">
		<div id="leftmenu">
			<?include'menu.about.php';?>
		</div> <!-- End Menu col -->
		<div id="fullrightcol">
			<div class="pagediv">
<h1>Board of Trustees</h1>
<p class="blue"><b>Board meetings are normally held on the third Wednesday of each month at 7pm. Location varies by month.
<? nextmeeting(); ?>
<? // nextmeeting("604800"); ?>
</b></p>
<h2>Board Members</h2>



<?	for ($i=0;$i<$numtrustees;$i++) {
if (($i+1) % 4 < 2) $hilite = "hilite"; else $hilite ="";

bot_display($boardarray[$i],$i,$hilite);

}
?>
<div style="clear:both; height:5px;"></div>

<?include 'boardmeetingminutesarchive.php';?>

			</div>
		</div> <!-- end right col -->
    </div>
<div style="clear:both;"></div>
    <div id="footer"><?include'xxxfooter.php';?></div>
</div>
</body>
</html>
