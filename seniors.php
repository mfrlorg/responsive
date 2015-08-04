<!DOCTYPE html>
<?  $currentpage = "seniors.php";
$whatserveristhis = 'thisisthetestserver.txt';
if (file_exists($whatserveristhis)) {$server="test";}
// ************
// *** 2013 ***
// ************
# Include the Required files. Delete any that are unneed for individual pages.
//	$wplocation = 'wp/wp_start.php';
	$wplocation = 'wp_demostart.php';
	if (file_exists($wplocation)) { include $wplocation;}
	include 'inlibrary.php';
	if($_REQUEST['service']!='')$service=$_REQUEST['service'];
?>
<html>
<head>
<title>Seniors</title>
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

		$('.seniors').click(function(){
			var selfClick = $(this).find('div:first').is(':visible');

			$(this)
				.find('div:first')
				.slideToggle(900);
				});
	});
</script>
<style type="text/css">
 .seniors {

	cursor: pointer;
	background: #f7fff7;
	width: 650px;
	height:auto;
	margin-top: 2px;
	padding: 10px;
	color:#333
}
 #careg, #genes, #money, #games, #volun, #health, #local, #travel {
	display:none;
	margin-top:7px;
}
#<?echo$service;?> {
display:block;
}
h2 {
color:#333;
font-size:15px;
margin-bottom:5px;
padding-bottom:5px;
}
h3.subheader{

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
			<?include'menu.services.php';?>
		</div> <!-- End Menu col -->
		<div id="fullrightcol">
			<div class="pagediv">
<h1>Seniors</h1>
<div class="seniors" >
	<h2>+ Caregiving and Living</h2>
	<div id="careg" class="seniorsub">
	<?php //get most recent post in category Caregiving
	$lastposts = get_posts('category_name=care-giving&numberposts=-1');
	// spit out content of the post
	foreach($lastposts as $post)
		{
		echo "<div class=\"leavesbg wpdiv\" style=\"height:100%\">";
		setup_postdata($post);
		echo "<h3 class=\"subheader\">";
		the_title();
		echo "</h3>";
		the_content();
		echo "</div>";
		echo "<div style=\"clear:both;\"></div>";
		}?>


	</div>
</div>
<div class="seniors" >
	<h2>+ Family History and Genealogy</h2>
	<div id="genes" class="seniorsub">
<?php //get most recent post in category Local Resources
	$lastposts = get_posts('category_name=genealogy');
	// spit out content of the post
	foreach($lastposts as $post)
		{
		echo "<div class=\"leavesbg wpdiv\" style=\"height:100%\">";
		setup_postdata($post);
				echo "<h3 class=\"subheader\">";
		the_title();
		echo "</h3>";
		the_content();
		echo "</div>";
		echo "<div style=\"clear:both;\"></div>";
		}?>


	</div>
</div>
<div class="seniors" >
	<h2>+ Financial and Legal</h2>
	<div id="money" class="seniorsub">
<?php //get most recent post in category Finance/Legal
	$lastposts = get_posts('category_name=legal&numberposts=-1');
	// spit out content of the post
	foreach($lastposts as $post)
		{
		echo "<div class=\"leavesbg wpdiv\" style=\"height:100%\">";
		setup_postdata($post);
		echo "<h3 class=\"subheader\">";
		the_title();
		echo "</h3>";
		the_content();
		echo "</div>";
		echo "<div style=\"clear:both;\"></div>";
		}?>

	</div>
</div>

<div class="seniors" >
	<h2>+ Free Time and Games</h2>
	<div id="games" class="seniorsub">
<?php //get most recent post in category Local Resources
	$lastposts = get_posts('category_name=free-time');
	// spit out content of the post
	foreach($lastposts as $post)
		{
		echo "<div class=\"leavesbg wpdiv\" style=\"height:100%\">";
		setup_postdata($post);
				echo "<h3 class=\"subheader\">";
		the_title();
		echo "</h3>";
		the_content();
		echo "</div>";
		echo "<div style=\"clear:both;\"></div>";
		}?>


	</div>
</div>
<div class="seniors" >
	<h2>+ Volunteers</h2>
	<div id="volun" class="seniorsub">
<?php //get most recent post in category Volunteers
	$lastposts = get_posts('numberposts=-1&category_name=volunteers');
	// spit out content of the post
	foreach($lastposts as $post)
		{
		echo "<div class=\"leavesbg wpdiv\" style=\"height:100%\">";
		setup_postdata($post);
		echo "<h3 class=\"subheader\">";
		the_title();
		echo "</h3>";
		the_content();
		echo "</div>";
		echo "<div style=\"clear:both;\"></div>";
		}?>


	</div>
</div>
<div class="seniors" >
	<h2>+ Healthcare</h2>
	<div id="health" class="seniorsub">
<?php //get most recent post in category Health
	$lastposts = get_posts('category_name=senior-health&numberposts=-1');
	// spit out content of the post
	foreach($lastposts as $post)
		{
		echo "<div class=\"leavesbg wpdiv\" style=\"height:100%\">";
		setup_postdata($post);
		echo "<h3 class=\"subheader\">";
		the_title();
		echo "</h3>";
		the_content();
		echo "</div>";
		echo "<div style=\"clear:both;\"></div>";
		}?>

	</div>
</div>
<div class="seniors" >
	<h2>+ Local Resources</h2>
	<div id="local" class="seniorsub">
<?php //get most recent post in category Local Resources
	$lastposts = get_posts('category_name=local&numberposts=-1');
	// spit out content of the post
	foreach($lastposts as $post)
		{
		echo "<div class=\"leavesbg wpdiv\" style=\"height:100%\">";
		setup_postdata($post);
		echo "<h3 class=\"subheader\">";
		the_title();
		echo "</h3>";
		the_content();
		echo "</div>";
		echo "<div style=\"clear:both;\"></div>";
		}?>


	</div>
</div>
<div class="seniors" >
	<h2>+ Travel</h2>
	<div id="travel" class="seniorsub">
	<?php //get most recent post in category Travel
	$lastposts = get_posts('category_name=travel&numberposts=-1');
	// spit out content of the post
	foreach($lastposts as $post)
		{
		echo "<div class=\"leavesbg wpdiv\" style=\"height:100%\">";
		setup_postdata($post);
		echo "<h3 class=\"subheader\">";
		the_title();
		echo "</h3>";
		the_content();
		echo "</div>";
		echo "<div style=\"clear:both;\"></div>";
		}?>


	</div>
</div>

			</div>
		</div> <!-- end right col -->
    </div>
<div style="clear:both;"></div>
    <div id="footer"><?include'xxxfooter.php';?></div>
</div>
</body>
</html>
