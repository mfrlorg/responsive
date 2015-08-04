<!DOCTYPE html>
<?  $currentpage = "about.php";
$whatserveristhis = 'thisisthetestserver.txt';
if (file_exists($whatserveristhis)) {$server="test";}
// ************
// *** 2015 ***
// ************
	include 'inlibrary.php';?>
<html>
<head>
<title>About the Library</title>
<meta name="google-site-verification" content="kwYyWkz6FQf_DQmvAwDvYR1Ccb2UmOn_tqnHVYAEBTM" />
<meta charset="UTF-8">
<link href="xxxmfrl.css" rel="stylesheet" type="text/css" >
<link href="xxxmfrlpage.css" rel="stylesheet" type="text/css" >
<link type="text/css" href="/inc/css/jquery-ui-1.8.11.custom.css" rel="stylesheet" />
<script type="text/javascript" src="/inc/js/jquery-1.5.1.min.js"></script>
<script type="text/javascript" src="/inc/js/jquery-ui-1.8.11.custom.min.js"></script>
<script type="text/javascript" src="/inc/js/jquery.cycle.all.min.js"></script>
<script type="text/javascript" src="/inc/js/superfish.js"></script>
<style type="text/css">
.about dl {
margin-top:10px;
}
.about dt {
	font-size:11px;
	font-weight:bold;
	margin-top: 5px;
	margin-bottom:5px;
    }
.about dd {
	font-size:11px;
	line-height:17px;
	margin-bottom: 15px;
	margin-left: 0px;
	padding-left: 40px;
	padding-right: 70px;
    }
</style>
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
			<?include'menu.about.php';?>
		</div> <!-- End Menu col -->
		<div id="fullrightcol">
			<div class="pagediv">
<h1>About the Library</h1>
<img src="/images/tagline.png" alt="One stop, unlimited possibilities" title="One stop, unlimited possibilities" style="padding-left:60px; padding-right:80px;">
<h2>Mission Statement</h2>
<p>To strengthen our community, the Montgomery-Floyd Regional Library provides individuals with access to information, experiences and ideas.</p>
<h2>Library Service Responses</h2>
<dl class="about">
		<dt>Stimulate Imagination: Reading, Viewing, and listening for Pleasure </dt>
		<dd>Residents who want materials to enhance their leisure time will find what
		they want when and where they want them and will have the help they need to make
		choices from among the options.</dd>

		<dt>Satisfy Curiosity: Lifelong Learning </dt>
		<dd>Residents will have the resources they need to explore topics of personal interest
		and continue to learn throughout their lives. </dd>

		<dt>Be an Informed Citizen: Local, National, and World Affairs </dt>
		<dd>Residents will have the information they need to support and promote democracy,
		to fulfill their civic responsibilities at the local, state, and national levels,
		and to fully participate in community decision making.</dd>

		<dt>Connect to the Online World: Public Internet Access</dt>
		<dd>Residents will have high-speed access to the digital world with no unnecessary
		restrictions or fees to ensure that everyone can take advantage of the ever-growing
		resources and services available through the Internet.</dd>

		<dt>Visit a Comfortable Place: Physical and Virtual Spaces</dt>
		<dd>Residents will have safe and welcoming physical places to meet and interact
		with others or to sit quietly and read and will have open and accessible virtual
		spaces that support networking.</dd>
		</dl>
<h2>Our Core Values</h2>
<dl class="about" >
<dt>Respect</dt>
		<dd>Value the individual with equal consideration and courtesy</dd>

<dt>Accountability</dt>
		<dd>Deliver on our commitments and responsibilities</dd>

<dt>Knowledge</dt>
		<dd>Promote learning, satisfy curiosity and encourage ideas</dd>

<dt>Diversity</dt>
		<dd>Provide a variety of viewpoints and free exchange of information</dd>

<dt>Service</dt>
		<dd>Maintain a welcoming atmosphere with professional staff and quality standards</dd>

<dt>Teamwork</dt>
		<dd>Build partnerships based on trust and collaboration</dd>
</dl>

<div style="border:2px solid white; background:#fffae9; padding-left:20px;">
<p>Adopted by the Montgomery-Floyd Regional Library Board of Trustees<br>
February 16, 2011</p>
</div>



			</div>
		</div> <!-- end right col -->
    </div>
<div style="clear:both;"></div>
    <div id="footer"><?include'xxxfooter.php';?></div>
</div>
</body>
</html>
