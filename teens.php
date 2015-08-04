<!DOCTYPE html>
<?  
$currentpage = "teens.php";
$whatserveristhis = 'thisisthetestserver.txt';
if (file_exists($whatserveristhis)) {$server="test"; }
// ************
// *** 2014 ***
// ************
# Include the Required files. Delete any that are unneed for individual pages.
include 'inc/php/openconnection.php';
if($server=="test")	$wplocation = 'wp_demostart.php';
else $wplocation = 'wp/wp_start.php';
if (file_exists($wplocation)) { include $wplocation;} 	
include 'inlibrary.php';

	
	$numcolumns = 5;
	$querysort = "new_author";
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
		$service=$_REQUEST['service'];
		$appropriatecats=array("teenbooks","programs","homework","involved","social","preview");
		$homeworktypes=array("sciencehw","englishhw","historyhw","mathhw","encyclohw","artshw");
		$subcat=$service;
		if(in_array($service,$homeworktypes)){
		$subcat=$service;
		$service="homework";
		}
		elseif(!in_array($service,$appropriatecats)) {$service="teenbooks";$subcat="teenbooks";
		}
		
	$_SESSION['coversize']=strtoupper($_REQUEST['coversize']);
	$coversizes= array("S","M","L");
	if (!in_array($_SESSION['coversize'],$coversizes)) $_SESSION['coversize']="M";
	$_SESSION['sortby']=strtoupper($_REQUEST['sortby']);
	$sortbytypes= array("A","T","D");
	if (!in_array($_SESSION['sortby'],$sortbytypes)) $_SESSION['sortby']="T";
	$_SESSION['newonly']=($_REQUEST['newonly']!="");
	$mtypes = array("all","dvd","j-dvd");
	$moviesubtypes = array("DVD","J-DVD");
	$_SESSION['subtype']=strtolower($_REQUEST['type']);
	if (!in_array($_SESSION['subtype'],$mtypes)) $_SESSION['subtype']="all";
		
		
		$query = "SELECT new_title, new_author, new_isbn, new_pub, new_added ".
			"FROM new_kids WHERE new_subtype = 'TEEN' ";
//			if (!$_SESSION['newonly']) $query.="AND new_timestamp >= '$lessday' ";
//			else $query.="AND new_timestamp <= '$lessday' ";
			$query.="ORDER BY new_id DESC LIMIT 20 ";
		$newbook = mysql_query($query) or die (mysql_error());		
		
//Displays a link to a book.
// The "link" variable is optional link text. The keywords will show up as the text of the link, if link is left blank.
// Type can be T (title) A (Author) or I (isbn) and determines what type of search is done.
/*function booklink($keywords,$type, $link="")
  {
  $type=strtolower($type);
  if ($type=="t") {$type="TI^TITLE&amp;match_on=EXACT";
					$italics=true;}  
  elseif ($type=="a") {$type="AU^AUTHOR";$italics=false;}
  elseif ($type=="i") {$type="ISBN";$italics=false;}
	elseif ($type=="tnote") {$type="TI^TITLE";$italics=true;}
  $keywordsplus= str_replace(' ','+',$keywords);
  if ($link!="") $keywords=$link;
  if ($italics) $keywords="<em>".$keywords."</em>";
echo "<a href=\"http://cat.mfrl.org/uhtbin/cgisirsi.exe/0/CBURG/0/5?searchdata1=".$keywordsplus."&amp;srchfield1=".$type."\">".$keywords."</a>";
}*/

function booklink($term,$type,$custom=""){
$texturl="http://cat.mfrl.org/uhtbin/cgisirsi.exe/0/CBURG/0/5?searchdata1=%22";
$esc_term=str_replace(" ", "+", $term);
$esc_term= str_replace('&+','',$esc_term);
$texturl.=$esc_term."%22&amp;srchfield1=";
if($type=="t") $texturl.="TI%5ETITLE";
if($type=="texact") $texturl.="TI%5ETITLE&amp;match_on=EXACT";
if($type=="a") $texturl.="AU%5EAUTHOR";
if($type=="i") $texturl.="ISBN";
if($type=="s") $texturl.="GENERAL%5ESUBJECT";
if($custom=="")$custom=$term;
if(($type=="t")||($type=="texact")) $custom="<i>".$custom."</i>";
echo "<a href=\"".$texturl."\">".$custom."</a>";

}
		
//Displays the bookcover and makes it a link to the catalog.
// Size can be S (small) M (Medium) or L (Large). Some books only have S&M sizes.
// Type can be T (title) A (Author) or I (isbn) and determines what type of search is done.
// Float can be "left" or "right" and determines which side the image is on.
function booklinkp($author,$isbn,$title="",$pubyear="",$adddate="",$float="left",$type="t",$size="s",$top="0",$bordersize="0",$bordercolor="000000")
    {
    $type=strtolower($type);
    if ($float=="l") $float="left";
    if ($float=="r") $float="right";
    if (($float=="left")) $marg="right"; else $marg="left";
	$title=stripcslashes($title);
	$title=strtolower($title);
	$title=nomorexs($title);
	$author=nomorexs($author);
	$title=ucwords($title);	
	$temptitle =explode(":",$title);
	$author=stripcslashes($author);
    $titleplus= str_replace(' ','+',$temptitle[0]);
	$titleplus= str_replace('&+','',$titleplus);
    $authorplus= str_replace(' ','+',$author);
	$authorplus= str_replace('&+','',$authorplus);
    if ($type=="t") {     $type="TI%5ETITLE"; $keywordsplus= $titleplus; }
    elseif ($type=="a") { $type="AU%5EAUTHOR"; $keywordsplus= $authorplus; }
    elseif ($type=="i") { $type="ISBN"; $keywordsplus= $isbn;}
	
				$adyear= (int) substr($adddate,2,2);
				$admonth= (int) substr($adddate,4,2);
				$adday= (int) substr($adddate,6,2);
				$adddate = $admonth."/".$adday."/".$adyear;
   $datedata =" &copy; ".$pubyear." (Added: ".$adddate.")";
   // "&amp;pubyear=".$pubyear.
	echo "<a href=\"http://cat.mfrl.org/uhtbin/cgisirsi.exe/0/CBURG/0/5?searchdata1=%22".
	$keywordsplus."%22&amp;srchfield1=".$type."&amp;searchoper1=AND&amp;searchdata2=%22"
	.$authorplus."%22&amp;srchfield2=AU%5EAUTHOR\">";
	$filename="images/isbn/".$isbn."S.GIF";
	if (file_exists($filename)) { echo "<img src=\"/".$filename."\"";}
	else echo "<img src=\"http://syndetics.com/index.aspx?isbn=".$isbn."/".$size."C.GIF\"";
	echo " style=\"border:".$bordersize."px solid #".$bordercolor."; float:".$float."; ".$yodaexception." margin-".$marg.":3px;";
	if ($top!="0") echo " margin-top:".$top."px;";
	if ($title=="") {echo "\" alt=\"".$author."\" title=\"".$author."\"></a>";}
	else {echo "\" alt=\"".$title." by ".$author.$datedata."\" title=\"".$title." by ".$author.$datedata."\"></a>";}
}	

function nomorexs($stringtoclear)
	{
	$stringtoclear=str_replace('kxll','kill',$stringtoclear);
	$stringtoclear=str_replace('ixd','id',$stringtoclear);
	$stringtoclear=str_replace('pxrl','perl',$stringtoclear);
	$stringtoclear=str_replace('pxthon','python',$stringtoclear);
	$stringtoclear=str_replace('exho','echo',$stringtoclear);
	$stringtoclear=str_replace('pxs','ps',$stringtoclear);
	$stringtoclear=str_replace('pxng','ping',$stringtoclear);
	$stringtoclear=str_replace('fxnger','finger',$stringtoclear);
	return $stringtoclear;
}	
		
		
?>
<html>
<head>
<title>MFRL Teens</title>
<meta charset="UTF-8">
<meta name="google-site-verification" content="kwYyWkz6FQf_DQmvAwDvYR1Ccb2UmOn_tqnHVYAEBTM" />
<link href="xxxmfrl.css" rel="stylesheet" type="text/css" >
<link href="xxxmfrlpage.css" rel="stylesheet" type="text/css" >
<link type="text/css" href="/inc/css/jquery-ui-1.8.11.custom.css" rel="stylesheet" />	
<script type="text/javascript" src="/inc/js/jquery-1.5.1.min.js"></script>
<script type="text/javascript" src="/inc/js/jquery-ui-1.8.11.custom.min.js"></script>
<script type="text/javascript" src="/inc/js/jquery.cycle.all.min.js"></script>
<script type="text/javascript" src="/inc/js/superfish.js"></script>
<script type="text/javascript" src="/inc/js/jcarousellite_1.0.1.min.js"></script>
<script type="text/javascript" src="/inc/js/jquery.mousewheel.js"></script>
<script type="text/javascript">
	$(document).ready(function(){
		$("#bookscroll").jCarouselLite({
		btnNext: ".jcl-next",
		btnPrev: ".jcl-prev",
		visible:4,
		mouseWheel:true
		});
		jQuery('ul.sf-menu').superfish({
			pathClass: 'current'
		});
		
		var highestBox = 0;
$('.hicon .thirds').each(function () {
    if ($(this).height() > highestBox) {
        highestBox = $(this).height();
    }
});
$('.hicon .thirds').height(highestBox);
/*var highesterBox = 0;
$('.hicon .halfdiv').each(function () {
    if ($(this).height() > highesterBox) {
        highesterBox = $(this).height();
    }
});
$('.hicon .halfdiv').height(highesterBox);
*/
	

$('.right').each(function() {
    var $divs = $(this).add($(this).prev('.halfdiv'));
    var tallestHeight = $divs.map(function(i, el) {
        return $(el).height();
    }).get();
    $divs.height(Math.max.apply(this, tallestHeight));
	});
});
</script>
<style type="text/css">
.fulldiv {
border:2px solid #376e47;
background:white;
margin: 10px 0 10px 5px;
width:97.5%;
}
.fulldiv h2 {
background:#376e47;
padding: 10px 5px;
margin:0;
color:white;
font-size:1.1em;
}
.fulldiv h3 {
font-weight:bold;
font-size:1.2em;
color:#f09100;
padding-left:15px;
background:#fafafa;
}
.fulldiv p {
padding: 5px 5px;
margin:0;
}
.halfdiv, .halfdivx {
border:2px solid orange;
background:white;
margin: 10px 0;
width:48%;
float:left;
margin-left:5px;
}
.halfdiv h2, .halfdivx h2{
background:orange;
color:black;
padding: 10px 5px;
margin:0;
font-size:1.1em;
}
.halfdiv p{
padding: 5px 5px;
margin:0;
}
.thirds {
border:2px solid #0086b3;
background:white;
margin: 10px 0;
width:31.5%;
min-height:172px;
float:left;
margin-left:5px;
}

.thirds h2{
padding: 10px 5px;
background:#0086b3;
margin:0;
font-size:1.1em;
color:white;
}
.thirds p{
margin:0;
padding: 5px 5px;

}
.thirds ul {
margin:5px 10px;
}
.hicon{
}
.hicon:after{
    clear:both;
    display:table;
    content:"";
}
.hwmenu{
margin: 0;
padding: 0 0 20px 0px;
border-bottom: 1px solid #000;
}
.hwmenu ul,.hwmenu li{
margin: 0;
padding: 0;
display: inline;
list-style-type: none;
}
.hwmenu ul li{

}
.hwmenu ul li a{
float: left;
line-height: 14px;
font-weight: bold;
margin: 0 5px 4px 5px;
text-decoration: none;
color: #f09100;
}
li.current a, .hwmenu a:hover{
border-bottom: 4px solid #000;
padding-bottom: 2px;
background: transparent;
color: #000;
}
.wpdiv{
background:#fff8e6;
padding:10px;
margin-bottom:2px;
overflow:auto;
}
.hiliteit{
background:#fffcfa;
}
.wpdiv h3{
background:white;
color:#376e47;
padding:5px;
width:auto;
font-size:1.1em;
}
.alignright{
float:right;
}
.alignleft{
float:left;
}

.book {

margin:auto;
}
#bookscroll {

position:relative;
list-style-type:none;
float:left;
vertical-align:bottom;
}
#bookscroll li {
float:left;
overflow:hidden;
height:300px;

}
#bookscroll li a img {
max-width:142px;
margin-left:3px;
padding-right:3px;
padding-top:3px;
}
#bookscroll li a:hover{
display:block;
background:#fff8e6;
color:black;

}
#bookscroll li {
max-width:140px;
margin-top:5px;
margin-bottom:5px;

}
.Msize{
min-width:135px;
}
.bookinfo{
text-align:center;
height:90px;

}
.bookinfo p{
font-size:1.1em;
padding:0 0 5px 0;
vertical-align:bottom;
}
.jcl-prev,.jcl-next{
float:left;
height:300px;
}
.jcl-prev a img,.jcl-next a img{
padding:5px;
display:block;
margin-top:120px;
}
.kitlist{
border: 1px solid #ccc;
background:#fafafa;
height:148px; 
overflow-y:scroll; 
padding:10px;
margin:2px;
}
.socialmedia a{
margin:10px 45px;
}
.halfdiv h3 {
font-weight:bold;
font-size:1.2em;
color:#f09100;
padding-left:15px;
background:#fcfcfc;
}

#teensearchbox  {
float:right;
width:375px;
height:50px;
padding-left:20px;
margin-bottom:10px;
}

#teensearchbox input[type="text"] {
height:25px;
width: 365px;
font-size:1.2em;
Margin-bottom:2px;
margin-top:5px;
background-color:#fafafa;
}

#teensearchbox select {
height:25px;
font-size:.9em;
margin: 0;
padding:0;
}
#teensearchbox input[type="submit"] {
font-size:.9em; margin:0;
padding:3px 5px 3px 4px;
overflow:visible;
font-weight:bold;
}
#teensearchbox input[type="text"]:focus,#searchbox select:focus, #searchbox input[type="submit"]:focus{
background:#ffeec1;
border: 2px solid #f90;
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
			<?include'menu.teens.php';?>				
		</div> <!-- End Menu col -->
		<div id="fullrightcol">
			<div class="pagediv">
			<?if($service=="teenbooks"){?>
<!-- Search Box -->
	<div id="teensearchbox" > 
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
<?}?>	
<h1>TEENS</h1>
<?if($service==""){// =========== MAIN ===========
?>
<div class="hicon">
<div class="fulldiv">
<? // Grab Welcome post
	if($server!="test") {$lastposts=get_posts('numberposts=1&category_name=teens-welcome');
	//Post the posts
	foreach($lastposts as $post) {
    setup_postdata($post);
	echo "<h2>";
	the_title();
	echo "</h2>";
    the_content();
	echo "<div style=\"clear:both;\"></div>";
	}}?>
</div>
</div>
<?} // ======= MAIN ========
elseif($service=="teenbooks"){?>
<div style="clear:both;"></div>
<div class="hicon">
<div class="fulldiv"><h2>New Teen Books</h2>
<div class="jcl-prev"><a href="/#sb"><img src="/images/icons/previousbutton.png" alt="Previous"></a></div>	
<?
	$numdisplayed=0;
	echo "<div id=\"bookscroll\"><ul>";
	
	while (($numdisplayed<20)&&($item = mysql_fetch_array($newbook))) {
		echo "<li><div class=\"bookinfo\"><p>";
		booklink($item['new_title'],"t");
		echo"</p><p>";
		booklink($item['new_author'],"a");
		echo"</p></div>";
		echo "<div class=\"book ".$_SESSION['coversize']."size\" >";
		$numdisplayed++;
		booklinkp(ucfirst($item['new_author']),$item['new_isbn'],ucfirst($item['new_title']),$item['new_pub'],$item['new_added'],"none","t",$_SESSION['coversize']);
		echo "</div>";	
		echo "</li>";
	}
	
?></ul></div>

<div class="jcl-next"><a href="/#sf"><img src="/images/icons/nextbutton.png" alt="Next"></a></div>
<div style="clear:both;"></div>

	
	
	</div>
</div>
<div class="hicon">


<div class="halfdiv">
<? //get most recent post(s) in category 
	$lastposts = get_posts('numberposts=1&category_name=teen-book-review');
		// spit out content of the post(s)
		foreach($lastposts as $post) 
			{	
			
			setup_postdata($post);
			echo "<h2>";
			the_title();
			echo "</h2>";
			echo "";
			the_content('Read the rest of the review...');
			
			
			}
		?>
		<a href="http://www.mfrl.org/wp/?cat=67" style="float:right; padding:5px;">All Reviews</a>
</div>
<div class="halfdiv right">
<? //get most recent post(s) in category 
	$lastposts = get_posts('numberposts=1&category_name=national-awards');
		// spit out content of the post(s)
		foreach($lastposts as $post) 
			{	
			
			setup_postdata($post);
			echo "<h2>";
			the_title();
			echo "</h2>";
			echo "";
			the_content();
			
			
			}
		?>
</div>


</div>

<?} // ======= Contests & Events ======
elseif($service=="programs"){?>
<p><img src="/images/teen-events2.png" alt="Teen Events"><br>
	&nbsp;&nbsp;&nbsp;Below are a few of our popular programs. More can be found on our <a href="calendar.php">Online Calendar</a>. Or follow us <a href="https://twitter.com/MFRLteens">@MFRLteens</a>!</p>
 
<div class="fulldiv" style="background:green;"><h2>Upcoming Programs</h2>
<? // Grab all of the Upcoming Programs posts
	$lastposts=get_posts('numberposts=20&category_name=teens');
	//Post the posts
	$hilitecount=0;
	foreach($lastposts as $post) {
	$hilitecount++;
		echo "<div class=\"wpdiv ";
		if($hilitecount%2==1)echo"hiliteit";
		echo"\"><div>";
    setup_postdata($post);
	echo "<h3>";
	the_title();
	echo "</h3>";
    the_content();
	echo "</div></div>";
	echo "<div style=\"clear:both;\"></div>";
    
       
		}
	?>
</div>


<?} // Get Involved
elseif($service=="involved"){?>
<div class="hicon">
<div class="halfdiv">
<? //get most recent post(s) in category 
	$lastposts = get_posts('numberposts=1&category_name=teen-volunteer');
		// spit out content of the post(s)
		foreach($lastposts as $post) 
			{	
			
			setup_postdata($post);
			echo "<h2>";
			the_title();
			echo "</h2>";
			echo "";
			the_content();
			
			
			}
		?>

</div>
<div class="halfdiv right">
<? //get most recent post(s) in category 
	$lastposts = get_posts('numberposts=1&category_name=tag');
		// spit out content of the post(s)
		foreach($lastposts as $post) 
			{	
			
			setup_postdata($post);
			echo "<h2>";
			the_title();
			echo "</h2>";
			echo "";
			the_content();
			
			
			}
		?>
</div>
</div>
<div class="hicon">
<div class="halfdiv">
<? //get most recent post(s) in category 
	$lastposts = get_posts('numberposts=1&category_name=teen-online-book-club');
		// spit out content of the post(s)
		foreach($lastposts as $post) 
			{	
			
			setup_postdata($post);
			echo "<h2>";
			the_title();
			echo "</h2>";
			echo "";
			the_content();
			
			
			}
		?>
</div>
<div class="halfdiv right">
<? //get most recent post(s) in category 
	$lastposts = get_posts('numberposts=1&category_name=teen-book-club');
		// spit out content of the post(s)
		foreach($lastposts as $post) 
			{	
			
			setup_postdata($post);
			echo "<h2>";
			the_title();
			echo "</h2>";
			echo "";
			the_content();
			
			
			}
		?>
</div>

</div>

<div class="fulldiv">
<h2>Tell us about the books you're reading!</h2>

<h3>Tips for writing a book review:</h3>
<p>Keep it between 5-10 sentences.
<br>What's the book about?
<br>Describe what you liked or disliked about it.
<br>Try not to give away the ending!
<br>Who would you recommend this to?<br>
Please include your name, your age and the title and author of the book you reviewed.</p>

<p>Visit our 
<a href="teenbookreview.php">Teen Book Review Form</a>, 
review that awesome book you just read, and the review could be posted to front of the Teens Page!</p>
</div>



<?} // ======= School & Beyond =======
elseif($service=="homework"){?>
<div class="hicon">
<div class="halfdiv">
<? //get most recent post(s) in category 
	$lastposts = get_posts('numberposts=1&category_name=teen-homework');
		// spit out content of the post(s)
		foreach($lastposts as $post) 
			{	
			
			setup_postdata($post);
			echo "<h2>";
			the_title();
			echo "</h2>";
			echo "";
			the_content();
			
			
			}
		?>
	</div>
<div class="halfdiv right">
<? //get most recent post(s) in category 
	$lastposts = get_posts('numberposts=1&category_name=college-prep');
		// spit out content of the post(s)
		foreach($lastposts as $post) 
			{	
			
			setup_postdata($post);
			echo "<h2>";
			the_title();
			echo "</h2>";
			echo "";
			the_content();
			
			
			}
		?>
</div>	
</div>



<?} // ====== Social Media ======
elseif($service=="social"){?>
<div class="fulldiv socialmedia">
<h2>Connect with the library</h2>
<p>
<a href="https://www.facebook.com/montgomeryfloydteens?ref=hl" onClick="javascript: pageTracker._trackPageview('/outgoing/<?echo($inlibrary?"i":"o");?>l/teen.facebook');"><img src="/images/facebook.png" alt="Find us on Facebook" ></a>
<a href="https://twitter.com/MFRLteens"  onClick="javascript: pageTracker._trackPageview('/outgoing/<?echo($inlibrary?"i":"o");?>l/teen.twitter');"><img src="/images/twitter.png" alt="Follow us on Twitter" ></a>

</p>
</div>
<?}?>







			</div>
		</div> <!-- end right col -->
    </div>
<div style="clear:both;"></div>
    <div id="footer"><?include'xxxfooter.php';?></div>
</div>
</body>
</html>