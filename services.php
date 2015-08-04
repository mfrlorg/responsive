<!DOCTYPE html>
<?  // WHENLIVE, Ctrl+H and remove ''; Also in Header and every individual page.
	$root="../";
$currentpage = "services.php";
$whatserveristhis = 'thisisthetestserver.txt';
if (file_exists($whatserveristhis)) {$server="test";}
// ************
// *** 2013 ***
// ************
	include 'inlibrary.php';
?>
<html>
<head>
<title>Library Services</title>
<meta charset="UTF-8">
<meta name="google-site-verification" content="kwYyWkz6FQf_DQmvAwDvYR1Ccb2UmOn_tqnHVYAEBTM" />
<link href="xxxmfrl.css" rel="stylesheet" type="text/css" >
<link href="xxxmfrlpage.css" rel="stylesheet" type="text/css" >
<link type="text/css" href="/inc/css/jquery-ui-1.8.11.custom.css" rel="stylesheet" />	
<style type="text/css">
@media only screen and ( max-width: 40em ) /* 640 */
{
    #nav
    {
        position: relative;
    }
        #nav > a
        {
        }
        #nav:not( :target ) > a:first-of-type,
        #nav:target > a:last-of-type
        {
            display: block;
        }
</style>
<script type="text/javascript" src="/inc/js/jquery-1.5.1.min.js"></script>
<script type="text/javascript" src="/inc/js/jquery-ui-1.8.11.custom.min.js"></script>
<script type="text/javascript" src="/inc/js/jquery.cycle.all.min.js"></script>
<script type="text/javascript" src="/inc/js/superfish.js"></script>
<script type="text/javascript" src="/inc/js/doubletaptogo.js"></script>
<script type="text/javascript">
	$(document).ready(function(){
		$( '#nav li:has(ul)' ).doubleTapToGo();
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
			<?include'menu.services.php';?>				
		</div> <!-- End Menu col -->
		<div id="fullrightcol">
			<div class="pagediv">
<h1>Services</h1>
<h2>Montgomery-Floyd Regional Library offers many services</h2>
<p>However we don't actually have a "Service" page currently, 
this should be an overview of the services we offer. I need content here.</p>
			</div>
		</div> <!-- end right col -->
    </div>
<div style="clear:both;"></div>
    <div id="footer"><?include'xxxfooter.php';?></div>
</div>
</body>
</html>