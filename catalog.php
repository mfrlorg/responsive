<!DOCTYPE html>
<?  // WHENLIVE, Ctrl+H and remove ''; Also in Header and every individual page.
	
$currentpage = "catalog.php";
$whatserveristhis = 'thisisthetestserver.txt';
if (file_exists($whatserveristhis)) {$server="test";}
$cat=$_REQUEST['cat'];
if($cat=="") $cat = $_REQUEST['catmenu']; 
// ************
// *** 2013 ***
// ************
include 'inlibrary.php';
# Include the Required files. Delete any that are unneed for individual pages.

?>
<html>
<head>
<title>MFRL Catalog</title>
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
<link rel="icon" type="image/png" href="../favicon.png">
</head>
<body>

<div id="wrap">
    <div id="header"><?include'xxxheader.php';?></div>
	<div id="menucont"><?include'xxxmenu.php';?></div>
	<div id="maincontent"><a name="contentstart" id="contentstart"> </a>
		<div id="leftmenu">
			<?include'menu.books.php';?>				
		</div> <!-- End Menu col -->
		<div id="fullrightcol">
			<div class="pagediv">
<h1>
<?switch ($cat) {
	case "renew":
	echo "Renew Materials and Manage Account";
	break;
	case "circpolicy":
	echo "Circulation Information";
	break;
	case "special":
	echo "Specialty Searches";
	break;
	case "catinstructions":
	default:
	echo "Instructions for the Online Public Access Catalog (OPAC)";
	break;
	}?>
</h1>



<?php 
switch ($cat) {
case "renew":
?>
<p>Logging in below allows you to review your account, renew materials, update your address, and change your PIN.</p>
<p>Your User ID is the number on your library card (no spaces).</p><p>Your PIN was 
issued to you when you received your card. If you have forgotten your 
PIN, bring your card to the library and the library staff can reset it for you.</p>

<form action="http://cat.mfrl.org/uhtbin/cgisirsi.exe/0/CBURG/0/57/1/1166/X/" name="catlogin" method="POST">
<p><label for="user_id">User ID:</label> <input type="text" name="user_id" id="user_id" value=""></p>
<p><label for="password">PIN:</label> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="password" name="password" id="password" value=""></p>
<p><input type="submit" value="Login"></p></form>

<p>The above will keep you logged in for the entire session.</p>
<p><strong>Don't forget to logout of the online catalog when you are finished.</strong><br>Or, simply close all windows.</p>
<h2>Bill Payment</h2>
<p>Now you can pay your Overdues and other Fees online from our <a href="payonline.php">Bill Payments</a> page.</p>

<?break;

case "circpolicy":
$fine= "$0.15/day";
$dvdfine= "$1.00/day"; 

$overdrivefine = "N/A";

$circall[] = array( 'type' => "New Adult Fiction Books", 'period' => "2", 'fine' => 'book');
$circall[] = array( 'type' => "Books, Magazines, Newspapers", 'period' => "3", 'fine' => "book");
$circall[] = array( 'type' => "Books on CD &amp; MP3", 'period' => "3", 'fine' => "book");
$circall[] = array( 'type' => "New DVDs", 'period' => "1", 'fine' => "dvd");
$circall[] = array( 'type' => "DVDs, Juvenile DVDs", 'period' => "2", 'fine' => "dvd");
$circall[] = array( 'type' => "Music CDs, Juvenile Music CDs", 'period' => "2", 'fine' => "book");
$circall[] = array( 'type' => "eReader devices (Nook/Kindle)", 'period' => "2", 'fine' => "dvd");
$circall[] = array( 'type' => "Video Games", 'period' => "1", 'fine' => "dvd");
$circall[] = array( 'type' => "Kits", 'period' => "3", 'fine' => "dvd");
$circall[] = array( 'type' => "OverDrive Items", 'period' => "note", 'fine' => "none");
if ($_REQUEST['yannisort']!='') { $circall="";
$circall[] = array( 'type' => "New Adult Fiction Books", 'period' => "2", 'fine' => 'book');
$circall[] = array( 'type' => "Music CDs", 'period' => "2", 'fine' => "book");
$circall[] = array( 'type' => "Books, Magazines, Newspapers", 'period' => "3", 'fine' => "book");
$circall[] = array( 'type' => "Books on CD &amp; MP3", 'period' => "3", 'fine' => "book");
$circall[] = array( 'type' => "New DVDs", 'period' => "1", 'fine' => "dvd");
$circall[] = array( 'type' => "Video Games", 'period' => "1", 'fine' => "dvd");
$circall[] = array( 'type' => "Adult &amp; Juvenile DVDs", 'period' => "2", 'fine' => "dvd");
$circall[] = array( 'type' => "eReader devices (Nook/Kindle)", 'period' => "2", 'fine' => "dvd");
$circall[] = array( 'type' => "Kits", 'period' => "3", 'fine' => "dvd");
$circall[] = array( 'type' => "OverDrive Items", 'period' => "note", 'fine' => "none");
}
?>
<div class="tablecorrection">
<table >
<tr><td style="width:260px"></td><td style="width:90px">Checkout &nbsp; &nbsp;<br>Period &nbsp; &nbsp;</td><td>Overdue Fines</td></tr>
<?
$hicounter=0;
foreach ($circall as $key => $token) {
if ($hicounter<1) $hicounter++; else $hicounter=0;
if ($hicounter) echo "<tr class=\"hilite\">"; else echo "<tr> "; 

echo "	 <td>";
echo $token['type']."</td>
	 ";
echo "<td>";
if ($token['period']=="note") echo "See note";
else {
	echo $token['period']." week";
	if ($token['period']!=1) echo "s";
	}
	echo "</td>
		 <td>";
if ($token['fine']=="book") echo $fine;
else if ($token['fine']=="dvd") echo $dvdfine;
else if ($token['fine']=="none") echo $overdrivefine;
}
echo "</td>
	 </tr>
	 </table>
	 </div>";
?>

<br>
<p>All items can be renewed twice, unless a hold has been placed on the item.</p>
<p><span class="subheader">Holds:</span><br>MFRL patrons can place up to 20 holds at a time. If the item is available at another branch, we will transport that item to your desired branch for pickup.</p>
<p><span class="subheader">OverDrive Items:</span>
<br>Patrons can place up to four OverDrive holds at a time.  OverDrive holds do not affect 
regular catalog hold limits, and vice versa.   Once the title you have placed on hold 
becomes available for check out, you will receive an email indicating the title is 
available.  You will then have three days to check out the title before it is returned 
to the collection.</p>

<p>There is a four item checkout limit for OverDrive books.  AudioBooks check out for one or 
two weeks; eBooks can be checked out for two or three weeks.  Most items can be returned early, 
depending upon the checkout delivery method.  OverDrive items can not be renewed and are 
automatically returned at the end of the lending period.</p>

<p><span class="subheader">Inter-Library Loans:</span><br>If you are looking for material that MFRL does not own, 
we can request items from other systems on your behalf. Each system's ILL policies 
are unique. Most systems will not ILL new items, CDs or DVDs. Patrons requesting ILLs must be in good standing; 
see our 
<a href="http://www.mfrl.org/policies/204.pdf">Interlibrary Loan Policy</a>.
 There is a $5.00 fee per item and payment is expected when the ILL request is fulfilled.</p>

<?
break;

case "archive": ?>
<p class="pagename">CIRC INFO PRE March 1, 2012</p>
<? $fine= "$0.15/day";
$dvdfine= "$1.00/day"; 
?>

<div class="tablecorrection">

<table border="0" cellpadding="0" cellspacing="1">
<tr><td style="width:260px"></td><td style="width:90px">Checkout &nbsp; &nbsp;<br>Period &nbsp; &nbsp;</td><td>Limit</td><td>Overdue Fines</td></tr>
<tr><td>Books, Magazines, Newspapers</td>
	<td>3 weeks</td>
		<td>None&nbsp;&nbsp;</td>
			<td><?echo $fine?></td></tr>
<tr><td>New Adult Fiction Books</td>
	<td>2 weeks</td>
		<td>10</td>
			<td><?echo $fine?></td></tr>
<tr><td>Books on CD &amp; MP3 </td>
	<td>3 weeks</td>
		<td>10</td>
			<td><?echo $fine?></td></tr>
<tr><td>Music CDs, Juvenile Music CDs </td>
	<td>2 weeks</td>
		<td>None</td>
			<td><?echo $fine?></td></tr>
<tr><td>DVDs  </td>
	<td>2 weeks</td>
		<td>4</td>
			<td><?echo $dvdfine?></td></tr>
<tr><td>Juvenile DVDs </td>
	<td>2 weeks</td>
		<td>4 </td>
			<td><?echo $dvdfine?></td></tr>
<tr><td>New DVDs</td>
	<td>1 week</td>
		<td>4</td>
			<td><?echo $dvdfine?></td></tr>
<tr><td>Kits</td>
	<td>3 weeks</td>
		<td>2</td>
			<td><?echo $dvdfine?></td></tr>
<tr><td>eReader devices (Nook/Kindle)</td>
	<td>2 weeks</td>
		<td>1</td>
			<td><?echo $dvdfine?></td></tr>
<tr><td>Video Games</td>
	<td>1 week</td>
		<td>2</td>
			<td><?echo$dvdfine?></td></tr>
<tr><td>OverDrive Items</td>
	<td>See note</td>
		<td>4</td>
			<td>N/A</td></tr>			
</table></div><br>
<p>All items can be renewed twice, unless a hold has been placed on the item.</p>
<p><span class="subheader">Holds:</span><br>MFRL patrons can place up to 8 holds at a time.  If the item 
is or becomes available at another branch, we will transport that item to your 
desired branch for pickup.</p>
<p><span class="subheader">OverDrive Items:</span>
<br>

Patrons can place up to four OverDrive holds at a time.  OverDrive holds do not affect regular catalog hold limits, and vice versa.   Once the title you have placed on hold becomes available for check out, you will receive an email indicating the title is available.  You will then have three days to check out the title before it is returned to the collection.</p>

<p>OverDrive eBooks and Audiobooks both count towards the 4 item limit for
 OverDrive. Audiobooks check out for one or two weeks and can not be returned early. eBooks can be checked out for two or 
 three weeks and may be 
 returned early with Adobe Digital Editions. OverDrive items can not be renewed and
 are automatically returned at the end of the lending period.</p>

<p><span class="subheader">Inter-Library Loans:</span><br>If you are looking for material that MFRL does not own, 
we can request items from other systems on your behalf. Each system's ILL policies 
are unique. Most systems will not ILL new items, CDs or DVDs. There is a $3.00 fee 
per item and payment is expected when the ILL request is fulfilled.</p>


<? break;

case "catinstructions": ?>
<p><strong class="subheader">Login and Logout of Public Access Catalog</strong></p>
<p>If you are planning on performing multiple tasks that are "user-specific", 
such as placing holds or renewing your materials, you may wish to login to the 
OPAC first.  This will save your information for your entire session.  However, you can 
browse our collection without logging in.  You will also be prompted for your 
information later if you decide to place a hold or attempt any user-specific task.</p>
<p><strong>To login for the entire session:</strong>  at the top-right of the online catalog, enter your 
User ID (your library card number with no spaces) and your PIN.  
Click the Login to the e-Library OPAC button.  </p>
<p style="width:555px;"><img src="/images/catinstructlogin.gif" alt="Login Example" style="float:none;"></p>
<p>These boxes and button will disappear when you are successfully logged in. 
<br><strong>Don't forget to Logout when you are finished</strong> using the 
text link on the blue band, or simply close all windows.</p>
<p><strong class="subheader">Renew Materials / Manage Account</strong></p>
<p>Using the Renew Materials / Manage Account link at the left, you can:<br>
<b>&nbsp;&raquo;</b> Check the status of your account (current Checkouts, Fines, and Holds)<br>
<b>&nbsp;&raquo;</b> Renew Materials<br>
<b>&nbsp;&raquo;</b> Change your PIN
</p>
<p>If you are renewing item(s), please notice on the following screen if the 
renewal was successful or failed.  Items can not be renewed if they have already 
been renewed twice, or if another user has a hold on the item.</p>
<p><strong class="subheader">Search Catalog / Place Hold</strong></p>
<p>Click the Search Catalog link at the above left.  The Online Catalog will open in a new window.</p>
<p>If the search produced multiple results, click on the 
Details button to see the single item display of the desired item.</p>
<img src="/images/catinstructionexample1.jpg" alt="Details Example" style="float:none;">
<p>To place a hold on the item click the words <span class="blue" title="This is an example of what it looks like, not an actual link.">Place Hold</span> 
in the box on the left of the single items display screen:</p>
<img src="/images/catinstructionexample2.jpg" alt="Place Hold Example" style="float:none;">
<p>The hold confirmation screen will ask you for your desired pickup branch.  
If you have not logged into this session, you will be prompted for your User ID (your library card number - no spaces) 
and your PIN. By default, a hold request is good for one year.  We will contact you when your item is available.</p>
<p>Click Place Hold to complete the transaction.</p> <?
break;

default: ?>


<p>Use the links to the left to access our Online Public Access Catalog, download eBooks and Audiobooks from OverDrive, or learn more about either subject.<br>
<?if (1==2) {?>
If are you looking for something specific, below are some pre-formatted searches for your convienence.</p>
<p><b>Video Games</b>: 
Click for <a href="http://cat.mfrl.org/uhtbin/cgisirsi.exe/0/CBURG/0/5?item_type=VIDEOGAME">All Videogames</a>, or by specific console
<a href="http://cat.mfrl.org/uhtbin/cgisirsi.exe/0/CBURG/0/5?searchdata1=playstation+3&item_type=VIDEOGAME">Playstation 3</a>, 
<a href="http://cat.mfrl.org/uhtbin/cgisirsi.exe/0/CBURG/0/5?searchdata1=wii&item_type=VIDEOGAME">Wii</a> or 
<a href="http://cat.montgmery-floyd.lib.va.us/uhtbin/cgisirsi.exe/0/CBURG/0/5?searchdata1=xbox+360&item_type=VIDEOGAME">Xbox 360</a>.
Or search our catalog for a specific game: 
<form method="post" action="http://cat.mfrl.org/uhtbin/cgisirsi.exe/x/CBURG/0/57/5">
	<input type="text" name="searchdata1" class="form_catsearch" size="30" maxlength="255" value="" style="width:150px;">
	<input type="submit" class="form_button" value=" Search Videogames">
	<input type="hidden" name="item_type" value="VIDEOGAME">
	<input type="hidden" name="srchfield1" value="GENERAL^SUBJECT^GENERAL^^ words or phrase" >
    <input type="hidden" name="sort_by" value="-PBYR">
    <input type="hidden" name="user_id" value="WEBSERVER">
    <input type="hidden" name="password" value="WEBSERVER">
</form></p>
<p><b>Audiobooks</b>:
We have Audiobooks on <a href="">CD</a> and <a href="">CD-MP3</a>. Additionally audiobooks can be downloaded
through <a href="">Overdrive</a>.
<form method="post" action="http://cat.mfrl.org/uhtbin/cgisirsi.exe/x/CBURG/0/57/5">
	<input type="text" name="searchdata1" class="form_catsearch" size="30" maxlength="255" value="" style="width:150px;">
	<input type="submit" class="form_button" value=" Search Audiobooks">
	<input type="hidden" name="item_type" value="CD">
	<input type="hidden" name="srchfield1" value="GENERAL^SUBJECT^GENERAL^^ words or phrase" >
    <input type="hidden" name="sort_by" value="-PBYR">
    <input type="hidden" name="user_id" value="WEBSERVER">
    <input type="hidden" name="password" value="WEBSERVER">
</form>
</p>
<p><b>Music CDs</b>:
We have over 2000 <a href="">Music CDs</a> in our collection.
<form method="post" action="http://cat.mfrl.org/uhtbin/cgisirsi.exe/x/CBURG/0/57/5">
	<input type="text" name="searchdata1" class="form_catsearch" size="30" maxlength="255" value="" style="width:150px;">
	<input type="submit" class="form_button" value=" Search Music">
	<input type="hidden" name="item_type" value="CD-MUSIC">
	<input type="hidden" name="srchfield1" value="GENERAL^SUBJECT^GENERAL^^ words or phrase" >
    <input type="hidden" name="sort_by" value="-PBYR">
    <input type="hidden" name="user_id" value="WEBSERVER">
    <input type="hidden" name="password" value="WEBSERVER">
</form></p>
<!--
//TitleFormatID
//	25 - OverDrive WMA Audiobook
//	30 - OverDrive Music
//	35 - OverDrive Video
//	40 - OverDrive Video (mobile)
//	50 - Adobe PDF eBook
//	410 - Adobe EPUB eBook
//	425 - OverDrive MP3 Audiobook
//	900 - Mobipocket eBook

//BANGSearch.dll?Type=Advanced&UserRating=1&URL=SearchResultsUserRank.htm
//BANGSearch.dll?Type=Series&ID={AA2583D2-B2A5-4DD6-A1C1-CE5487289AB0}&SortBy=CollDate
//BANGSearch.dll?Type=Creator&ID={F6F6EAAF-46D0-4F54-BECF-51F5D2B88104}
//BANGSearch.dll?Type=Subject&ID=622
//BANGSearch.dll?Type=Awards&ID=68
//BANGSearch.dll?Type=Subject&ID=1069&Format=25,30,425&SortBy=CollDate
//BANGSearch.dll?Type=Series&ID={B371EB3F-4915-4243-86A3-62560D75AA6E}&SortBy=CollDate
//BANGSearch.dll?Type=Format&ID=25,30,425&SortBy=CollDate
//BANGSearch.dll?Type=Format&ID=425&url=SearchResultsmp3.htm
//BANGSearch.dll?Type=Seek&Letter=M&SearchID=30508654&SortBy=title&SortOrder=ASC
//NewMP3Additions.htm
//BrowseeBookFiction.htm
//BrowseeBookNonfiction.htm
//BrowseFiction.htm
//BrowseNonfiction.htm
//BrowseYouth.htm
//BrowseVideo.htm
//xPod.htm

//http://swvapub.lib.overdrive.com/BANGSearch.dll?Title=Breast+Cancer

	var classes = {
				"audio":new FormatClass("Audiobook", "Audiobooks"),
				"ebook":new FormatClass("eBook", "eBooks"),
				"video":new FormatClass("Video", "Videos"),
				"music":new FormatClass("Music"),
				"online":new FormatClass("Online"),
			};
		var numbers = {
				1: new Format("Microsoft eBook", "ebook", "Microsoft", []),
2254				25: new Format("OverDrive WMA Audiobook", "audio", "OverDrive", ["WMA Digital Audiobook"]),
0				30: new Format("OverDrive Music", "music", "OverDrive", []),
0				35: new Format("OverDrive Video", "video", "OverDrive", []),
0				40: new Format("OverDrive Video (mobile)", "video", "OverDrive", []),
861 				50: new Format("Adobe PDF eBook", "ebook", "Adobe", [/*Spanish "eBook de Adobe"*/]),
0				302: new Format("Disney Online Book", "online", "Adobe", ["Disney Digital Books Online", "Disney Online Books"]),
1800				410: new Format("Adobe EPUB eBook", "ebook", "Adobe", ["Adobe EPUB  eBook"]),
1751				420: new Format("Kindle eBook", "ebook", "Amazon", ["Kindle Book", "Kindle Book (BETA)"]),
703 				425: new Format("OverDrive MP3 Audiobook", "audio", "OverDrive", ["MP3 Digital Audiobook"]),
0				450: new Format("Open PDF eBook", "ebook", "Open", ["PDF eBook", "Open PDF"]),
0				810: new Format("Open EPUB eBook", "ebook", "Open", ["EPUB eBook", "Open EPUB"]),
0				900: new Format("Mobipocket eBook", "ebook", "Mobipocket", []),
			}
-->


<p><b>Overdrive</b>: Download eBooks and Audiobooks to read or listen to on your computer or portable device.
<form action="http://swvapub.lib.overdrive.com/BANGSearch.dll" method="POST">
<label for="Title">Title</label> <input type="hidden" value="Breast Cancer" name="Title" size="35" maxlength="100" style="width:288" width="288">
<input type="image" src="http://syndetics.com/index.aspx?isbn=9781583334058/SC.GIF" alt="Search for eBooks on Breast Cancer" title="Search for eBooks on Breast Cancer">
</form>

</p>

 <form method="post" action="http://cat.mfrl.org/uhtbin/cgisirsi.exe/x/CBURG/0/57/5" >
    <p class="cat"> CATALOG SEARCH
    <select name="format" class="form_catmenu1">
    <option value="MARC">Books</option>
	<option value="MRDF">Whatisthis</option>
    <option value="ANY">Any</option>
    <option value="MUSIC">Audio</option>
    <option value="VM">Video</option>
    </select>
    <select name="item_2cat" class="form_catmenu1">
    <option value="ANY">All Ages</option>
    <option value="EASY">Easy</option>
    <option value="JUVENILE">Juvenile</option>
    <option value="TEEN">Teen</option>
    <option value="ADULT">Adult</option>
    <option value="LT">Large Type</option>
    </select>
    <select name="srchfield1" class="form_catmenu2">
    <option value="TI^TITLE^TITLES"> Title </option>
    <option value="AU^AUTHOR^AUTHORS"> Author </option>
    <option value="">Any</option>
    </select>&nbsp;
    <input type="text" name="searchdata1" class="form_catsearch" size="30" maxlength="255" value="">
    <input type="submit" name="submit" class="form_button" value=" Search" >&nbsp;
    <input type="hidden" name="searchfield1" value="GENERAL^SUBJECT^GENERAL^^ words or phrase">
    <input type="hidden" name="sort_by" value="-PBYR">
    <input type="hidden" name="user_id" value="WEBSERVER">
    <input type="hidden" name="password" value="WEBSERVER">
    
    </p>
    </form>

<?}// END catalog mini-searchs?>
<p>&nbsp;</p>
<p>&nbsp;</p><?
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