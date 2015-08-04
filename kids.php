<?$submit=$_REQUEST['submit'];session_start();if ($submit==""){session_destroy();session_start();}?>
<!DOCTYPE html>
<?  $currentpage = "kids.php";
$whatserveristhis = 'thisisthetestserver.txt';
if (file_exists($whatserveristhis)) {$server="test";}
// ********
// * 2014 *
// ********
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
		if($service=="")$service="kidsbooks";
		$appropriatecats=array("kidsbooks","programs","fun","homework","literacy","educators","preview");
		$homeworktypes=array("sciencehw","englishhw","historyhw","mathhw","encyclohw","artshw");
		$subcat=$service;
		if(in_array($service,$homeworktypes)){
		$subcat=$service;
		$service="homework";
		}
		elseif(!in_array($service,$appropriatecats)) {$service="";
		}
		
	$_SESSION['coversize']=strtoupper($_REQUEST['coversize']);
	$coversizes= array("S","M","L");
	if (!in_array($_SESSION['coversize'],$coversizes)) $_SESSION['coversize']="M";
	$_SESSION['sortby']=strtoupper($_REQUEST['sortby']);
	$sortbytypes= array("A","T","D");
	if (!in_array($_SESSION['sortby'],$sortbytypes)) $_SESSION['sortby']="T";
	$_SESSION['newonly']=($_REQUEST['newonly']!="");
	$ktypes = array("all","e","j");
	$ksubtypes = array("E-FICTION","J-FICTION");
	$_SESSION['subtype']=strtolower($_REQUEST['type']);
	if (!in_array($_SESSION['subtype'],$ktypes)) $_SESSION['subtype']="all";

		
		// Get newest books!
		$newestquery = "SELECT MAX(new_timestamp) FROM new_kids WHERE new_type = 'Book' ";
		$newestday = mysql_query($newestquery) or die (mysql_error());
		$newest= mysql_fetch_array($newestday);
		$newday = $newest[0];		
		$lessday = date('Y-m-d H:i:s',strtotime($newday . " - 1 minute"));
		$_SESSION['lastaddition'] = date('F d, Y',strtotime($newday . " - 1 minute"));
		$query = "SELECT new_title, new_author, new_isbn, new_pub, new_added ".
			"FROM new_kids WHERE ";
			if($_SESSION['subtype']=="all") $query.= "new_subtype = 'J-FICTION' OR new_subtype= 'E-FICTION' ";
			elseif ($_SESSION['subtype']=="j") $query.= "new_subtype = 'J-FICTION' ";
			elseif ($_SESSION['subtype']=="e") $query.= "new_subtype = 'E-FICTION' ";
//			if (!$_SESSION['newonly']) $query.="AND new_timestamp >= '$lessday' ";
//			else $query.="AND new_timestamp <= '$lessday' ";
			$query.="ORDER BY new_id DESC LIMIT 20 ";
		$newbook = mysql_query($query) or die (mysql_error());


//Displays a link to a book.
// The "link" variable is optional link text. The keywords will show up as the text of the link, if link is left blank.
// Type can be T (title) A (Author) or I (isbn) and determines what type of search is done.
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
$kittitles=array("Alligators and crocodiles","Alphabet","Autumn","Babies","Bears","Birthday","Blankets & quilts","Brown bear, brown bear, what do you see?","Cakes and baking","Careers","Chickens and eggs","Clothes","Colors","Counting","Dinosaurs","Elephants","Environment & conservation","Fairy tales","Folktales","Freight train","Friends","Getting clean","Giants and elves","Goodnight moon","Grandparents","Growing vegetable soup","Hats","Holidays","Houses and homes","Journeys","Let's dance","Let's go to the beach","Libraries, books & reading","Manners","Me","Mice","Monsters","Mouse paint","Multiculture","Music","Names","Owls","PBJ","Pizza","Rabbits","Rainy weather","Royalty","Safety","Shoes and feet","Snow","The little mouse, the red ripe strawberry, and the big hungry bear","The snowy day","Whales");
function cleankit($dirtytitle){
	$dirtytitle = strtolower($dirtytitle);
    $dirtytitle = preg_replace('/[^a-z0-9 -]+/', '', $dirtytitle);
    $dirtytitle = str_replace(' ', '+', $dirtytitle);
    return trim($dirtytitle, '+');
}
function linkakit($kittitle){
$cleantitle=cleankit($kittitle);
echo "<li><a href=\"http://cat.mfrl.org/uhtbin/cgisirsi.exe/0/CBURG/0/5?item_1cat=KITS&amp;srchfield1=TI^TITLE^TITLES&amp;searchdata1=".$cleantitle."\">".$kittitle."</a></li>";
}
function fixmsword($word){
$search = array('“', '”', '’','–');
$replace = array('"', '"', "'",'-');
$word = htmlentities(str_replace($search, $replace, $word), ENT_QUOTES);
return($word);
}
function craftdiv($title,$branch,$dates,$text){
	$showbranch=$_REQUEST['branch'];
	if($showbranch=="all")$showbranch='';
	if (($showbranch!='')&&($branch!=$showbranch))
	{return;}
	if($title=="mtm")$title="Make & Take Monday";
	if($title=="mtt")$title="Make & Take Tuesday";
	if($title=="hhs")$title="Happy Hands Saturday";
	if($title=="bmrrr")$title="BookMarks: RECYCLE * RECLAIM * RECREATE";
	$title=fixmsword($title);
	$date=fixmsword($date);
	$text=fixmsword($text);
	echo "<div class=\"".$branch."b\">";
	echo "<h3>".$title."</h3>";
	echo "<h4>".$dates."</h4>";
	echo "<p>".$text."</p></div>";
}

?>
<html>
<head>
<title>MFRL Kids</title>
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
var highesterBox = 0;
$('.hicon .halfdiv').each(function () {
    if ($(this).height() > highesterBox) {
        highesterBox = $(this).height();
    }
});
$('.hicon .halfdiv').height(highesterBox);
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
.Msize{
min-width:135px;
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
.kitlist,.shortkitlist{
border: 1px solid #ccc;
background:#fafafa;
height:400px; 
overflow-y:scroll; 
padding:10px;
margin:2px;
}
.shortkitlist{
height:110px;
}
table.storytimetimes {

border-collapse:collapse;
border: 1px solid white;
}
table.storytimetimes th {
font-size:1.2em;
height:25px;
padding:5px;
}
table.storytimetimes td,table.storytimetimes th {
width:129px;
border: 1px solid white;
background:#69f;
}
table.storytimetimes td {
background:#9cf;
text-align:center;
vertical-align:middle;
font-weight:bold;
}
table.storytimetimes td.double {
width:305px;
height:35px;
font-weight:bold;
}
table.storytimetimes td.yellow {
background:#fc0;
color:white;
}
table.storytimetimes td.green {
background:green;
color:white;
}
table.storytimetimes td.purple {
background:purple;
color:white;
}
table.storytimetimes td.red {
background:red;
color:white;
}
table.storytimetimes td.blue {
background:#39c;
color:white;
}
table.storytimetimes td.pink {
background:#f69;
color:white;
}
table.storytimetimes td.gray {
background:#ddd;
color:#666;
}
.slidemenu {
float:right;
color:white;
}
.slidemenu a:visited {
color:white;
}
.slidemenu a:hover {
color:black;
}
.slidemenucurrent {
color:#eee;
}
#caldecott{
background:url(/images/awards.png) -0px -33px no-repeat;
height:30px;
width:200px;
margin:2px;
line-height:30px;
}
#caldecott a,#newbery a,#geisel a,#coretta a{
padding-left:32px;
line-height:30px;
}
#caldecott a:hover,#newbery a:hover,#geisel a:hover,#coretta a:hover{
background:transparent;
outline:0;
}
#newbery{
background:url(/images/awards.png) -0px -0px no-repeat;
height:30px;
width:200px;
margin:2px;

line-height:30px;
}
#geisel{
background:url(/images/awards.png) -0px -98px no-repeat;
height:30px;
width:200px;
margin:2px;

line-height:30px;
}
#coretta{
background:url(/images/awards.png) -0px -65px no-repeat;
height:30px;
width:200px;
margin:2px;

line-height:30px;
}
#kidsearchbox  {
float:right;
width:375px;
height:50px;
padding-left:20px;
margin-bottom:10px;
}

#kidsearchbox input[type="text"] {
height:25px;
width: 365px;
font-size:1.2em;
Margin-bottom:2px;
margin-top:5px;
background-color:#fafafa;
}

#kidsearchbox select {
height:25px;
font-size:.9em;
margin: 0;
padding:0;
}
#kidsearchbox input[type="submit"] {
font-size:.9em; margin:0;
padding:3px 5px 3px 4px;
overflow:visible;
font-weight:bold;
}
#kidsearchbox input[type="text"]:focus,#searchbox select:focus, #searchbox input[type="submit"]:focus{
background:#ffeec1;
border: 2px solid #f90;
}
.booklist li{
width:185px;
font-size:1.2em;
line-height:1.2em;
}
.booklist{
padding:10px 0 10px 10px;
margin:10px;
float:left;
}
#crafts div {
width:32%;
float:left;
height:200px;
padding:0;
margin:2px;
}
#crafts div h3{
font-weight:bold;
color:black;
font-size:18px;
background:transparent;
padding:0;
text-align:center;
}
#crafts div h4{
font-size:14px;
text-align:center;
padding:3px;
border-top:3px dashed white;
}
#crafts div.cb{
border:2px solid #D974E9;
background:white;
}
#crafts div.bb{
border:2px solid #7FE27F;
background:white;
}
#crafts div.mb{
border:2px solid silver;
background:white;
}
#crafts div.fb{
border:2px solid #87C4FC;
background:white;
}
#craftkey h3.ch,#crafts .cb h3, .cb h4{
background: #D974E9;
}
#craftkey h3.bh,#crafts .bb h3, .bb h4{
background: #7FE27F; 
}
#craftkey h3.mh,#crafts .mb h3, .mb h4{
background: silver;
}
#craftkey h3.fh,#crafts .fb h3, .fb h4{
background: #87C4FC;
}

#craftkey h3.allh{
background:snow;
height:25px;
}
#crafts div#craftkey{
width:646px;
height:85px;
border:1px solid orange;
padding:0;
}
#craftkey h3.bh,#craftkey h3.ch,#craftkey h3.fh,#craftkey h3.mh{
float:left;
width:50%;
height:25px;
padding-top:5px;
color:black;
font-weight:normal;
}
table td{
width:205px;
padding:5px;
background:white;
font-size:1.5em;
text-align:center;
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
			<?include'menu.kids.php';?>					
		</div> <!-- End Menu col -->
		<div id="fullrightcol">
			<div class="pagediv">
<?if($service=="kidsbooks"){?>
<!-- Search Box -->
	<div id="kidsearchbox" > 
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
<h1>KIDS</h1>
<?if($service==""){ // ======= MAIN ========
?>
<div class="hicon">
<div class="fulldiv">
<? // Grab all of the Upcoming Programs posts
	$lastposts=get_posts('numberposts=1&category_name=kids-welcome');
	//Post the posts
	foreach($lastposts as $post) {
		
    setup_postdata($post);
	echo "<h2>";
	the_title();
	echo "</h2>";
    the_content();
	
	echo "<div style=\"clear:both;\"></div>";
    
       
	}?>
</div>
</div>
<?} // ============ BOOKS =============
elseif($service=="kidsbooks"){?>
<div style="clear:both;"></div>
<div class="hicon">
<div class="fulldiv"><h2>New Easy and Juvenile Books
		<span class="slidemenu">
			<?if($_SESSION['subtype']=="all") echo "All |";else{?><a href="?service=kidsbooks&amp;type=all">All</a> | <?}?>
			<?if($_SESSION['subtype']=="e") echo "Easy |";else{?><a href="?service=kidsbooks&amp;type=e">Easy</a> | <?}?>
			<?if($_SESSION['subtype']=="j") echo "Juvenile";else{?><a href="?service=kidsbooks&amp;type=j">Juvenile</a><?}?></span></h2>
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
		booklinkp(ucfirst($item['new_author']),$item['new_isbn'],cleankit(ucfirst($item['new_title'])),$item['new_pub'],$item['new_added'],"none","t",$_SESSION['coversize']);
		echo "</div>";	
		echo "</li>";
	}
	
?></ul></div>

<div class="jcl-next"><a href="/#sf"><img src="/images/icons/nextbutton.png" alt="Next"></a></div>
<div style="clear:both;"></div>

	
	
	</div>
</div>
<div class="hicon">
	<div class="thirds"><h2>Award Winning Kids Books</h2>

	<div id="caldecott" style="margin-top:10px;">	<a href="http://www.ala.org/alsc/awardsgrants/bookmedia/caldecottmedal/caldecottmedal">Caldecott</a></div>
	<div id="newbery" style="margin-top:10px;">	<a href="http://www.ala.org/alsc/awardsgrants/bookmedia/newberymedal/newberymedal">Newbery</a></div>
	<div id="coretta" style="margin-top:10px;">	<a href="http://www.ala.org/emiert/cskbookawards">Coretta Scott King</a></div>
	<div id="geisel" style="margin-top:10px;">	<a href="http://www.ala.org/alsc/awardsgrants/bookmedia/geiselaward">Geisel</a></div>
	</div>
	
	<div class="thirds" style="height:250px;"><h2>Tumblebook Library</h2>
	<p> 
	<?php  // Tumblebooks			 
echo "<a href=\"http://www.tumblebooks.com/library/auto_login.asp?U=lva&amp;P=libra\" onClick=\"javascript: pageTracker._trackPageview('/outgoing/";
if ($inlibrary) echo "i"; else echo "o";
?>l/tumblebooks');"><img src="/images/tumblebookssmall.png" alt=""></a> The 
	<?php  // Tumblebooks			 
echo "<a href=\"http://www.tumblebooks.com/library/auto_login.asp?U=lva&amp;P=libra\" onClick=\"javascript: pageTracker._trackPageview('/outgoing/";
if ($inlibrary) echo "i"; else echo "o";
?>l/tumblebooks');">TumbleBook Library</a> database is an online collection of multi- level ebooks including; fiction, non-fiction and mathematics. Many Tumblebook titles have puzzles and games to ensure reading comprehension.

</p>
	</div>
	
	<div class="thirds"><h2>Overdrive</h2>
	<p>
		<a href="http://swvapub.lib.overdrive.com/kids/" title="OverDrive eReading Room for Kids and Teens">
	<img src="/images/overdriveforkids.png" alt="OverDrive eReading Room for Kids and Teens">	
	</a>
	
	</p>
	</div>
</div>
<div class="hicon">
	<div class="fulldiv"><h2>Booklists</h2>
	<?//remove the ../ before moving to live server! ?>
	<p>Need suggestions for what to read? Your helpful Librarians have compiled lists of Age Appropriate books.</p>
	<ul class="booklist">
	
		<li><a href="http://www.mfrl.org/pdf/booklists/0to18.pdf">0 - 18 Months</a></li>
		<li><a href="http://www.mfrl.org/pdf/booklists/2to3.pdf">2 - 3 Years</a></li>
		<li><a href="http://www.mfrl.org/pdf/booklists/4to5.pdf">4 - 5 Years</a></li>
	</ul>
	<ul class="booklist">
		<li><a href="http://www.mfrl.org/pdf/booklists/1stgrade.pdf">1st Grade</a></li>
		<li><a href="http://www.mfrl.org/pdf/booklists/2ndgrade.pdf">2nd Grade</a></li>
		<li><a href="http://www.mfrl.org/pdf/booklists/3rdgrade.pdf">3rd Grade</a></li>
		<li><a href="http://www.mfrl.org/pdf/booklists/4thgrade.pdf">4th Grade</a></li>
		<li><a href="http://www.mfrl.org/pdf/booklists/5thgrade.pdf">5th Grade</a></li>
	</ul>
	<ul class="booklist">
		<li><a href="http://www.mfrl.org/pdf/booklists/6th7th8th.pdf">6th - 8th Grade</a></li>
		<li><a href="http://www.mfrl.org/pdf/booklists/9th10th11th12th.pdf">9th - 12th Grade</a></li>
	
	</uL>
	&nbsp;<br>
	<div style="clear:both;"></div>
	</div>
</div>
<?} // ======== Programs ========
elseif($service=="programs"){?>
<p><img src="/images/kids-events.png" alt="Events for Kids"><br>
	Some of our most popular Kids Programs are listed below. Visit our <a href="calendar.php">Online Calendar</a> to see all of our events!</p>

<div class="fulldiv" style="background:green;"><h2>Upcoming Programs</h2>
<? // Grab all of the Upcoming Programs posts
	$lastposts=get_posts('numberposts=20&category_name=kids');
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
    
       
	
}?>
</div>
<?} // ======== Fun-N-Games ========
elseif($service=="fun"){?> 

<div class="fulldiv">
<? //get most recent post(s) in category 
	$lastposts = get_posts('numberposts=10&category_name=fun-and-games');
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
<?if($_REQUEST['crafts']=="old"){?>
<div class="fulldiv" id="crafts"><h2>Crafts</h2>
	<div id="craftkey">
	<h3 class="allh"><a href="?service=fun">All Branches</a></h3>
	<h3 class="bh"><a href="?service=fun&amp;branch=b">Blacksburg</a></h3>
	<h3 class="ch"><a href="?service=fun&amp;branch=c">Christiansburg</a></h3>
	<h3 class="fh"><a href="?service=fun&amp;branch=f">Floyd</a></h3>
	<h3 class="mh"><a href="?service=fun&amp;branch=m">Meadowbrook</a></h3>
	
	</div>
	
<? //  mtt=Make & Take Tuesday; hhs=Happy Hands Saturday; 
	// mtm=Make & Take Mondays; bmrrr=BookMarks: RECYCLE * RECLAIM * RECREATE;
// craftdiv([title],[branch=b|c|f|m],[dates],[text])


craftdiv("Teen Alley Talent","c","July 6-12",
	"Paint Chip Bookmarks");

craftdiv("Teen Alley Talent","c","July 13-19",
	"Post it note Gallery");

craftdiv("Bottle-cap Pixel Art ","b","July 14-July 19",
	"Make Pixel Art in the Kids Area");

craftdiv("BookMarks: RECYCLE * RECLAIM * RECREATE","m","July 19",
	"Stop by all day on Saturday and make a sponge ball.");

craftdiv("Teen Alley Talent","c","July 20-26",
	"3d Hands");

craftdiv("Teen Alley Talent","c","July 27-Aug 3",
	"Doodle Table");


craftdiv("Make a Golden Snitch ","b","July 31",
	"Celebrate Harry Potter’s Birthday by making a golden snitch of your very own.  Supplies limited.");

/* 
craftdiv("","","",
	"");

*/?>
	

<p><img src="/images/empty.gif" style="width:600px; height:0;" alt=""></p>

</div>
<?}else{?>

<div class="fulldiv" id="crafts"><h2>Crafts</h2>
<p>For information on Crafts at your library please <a href="hours.php">call</a> or sign up for <a href="mailinglists.php">weekly news emails</a> from your branch. </p>
</div>	
<?}?>
<div style="clear:both;"></div>


<?}// ========= Home Work Help ======
elseif($service=="homework"){$hwname="homework-help";?>

<div class="hwmenu">
<ul>
<li <?if($subcat=="sciencehw"){$hwname="science-health-homework";
	?>class="current"<?}?>><a href="?service=sciencehw">Science/Health</a></li>
<li <?if($subcat=="englishhw"){$hwname="english-language-homework";
	?>class="current"<?}?>><a href="?service=englishhw">English/Languages</a></li>
<li <?if($subcat=="historyhw"){$hwname="history-social-studies-homework";
	?>class="current"<?}?>><a href="?service=historyhw">History/Social Studies</a></li>
<li <?if($subcat=="mathhw"){$hwname="math-homework";
	?>class="current"<?}?>><a href="?service=mathhw">Math</a></li>
<li <?if($subcat=="encyclohw"){$hwname="encyclopedia-dictionary-homework";
	?>class="current"<?}?>><a href="?service=encyclohw">Encyclopedia/Dictionary</a></li>
<li <?if($subcat=="artshw"){$hwname="art-homework";
?>class="current"<?}?>><a href="?service=artshw">Arts</a></li>
</ul>
</div>
<?// Get appropriate Homework help

$lastposts=get_posts('numberposts=1&category_name='.$hwname);

// Make it appear
?><div class="fulldiv"><?
foreach($lastposts as $post) {
setup_postdata($post);
echo "<h2>";
 the_title();
echo "</h2><p>";
 the_content();
 echo "</p>";
}?>

</div>
<?// END content management ...?>
<?}// ========= Literacy, Early =======
elseif($service=="literacy"){?>

<div class="fulldiv">
<? // Grab Early Literacy Post
	$lastposts=get_posts('numberposts=1&category_name=early-literacy');
	//Post the posts
	foreach($lastposts as $post) {
    setup_postdata($post);
	echo "<h2>";
	the_title();
	echo "</h2>";
    the_content();
	echo "<div style=\"clear:both;\"></div>";
	}?>
</div>

<div class="hicon">
<div class="halfdivx" style="height:533px;"><h2>Early Literacy Begins with You</h2>
<img src="/images/everchildr2read.png" alt="" style="margin-left:1px;"></div>

<div class="halfdivx" style="height:533px;"><h2>Literacy Kits</h2>
<p>We have many Literacy Kits which contain Books and Early Learning materials on a variety of titles.</p>
<ul class="kitlist" >
<?foreach($kittitles as $kittitle) {linkakit($kittitle);}?>
</ul>

</div>

<div class="halfdiv">
<? // Grab Early Literacy Link List
	$lastposts=get_posts('numberposts=1&category_name=early-literacy-links');
	//Post the posts
	foreach($lastposts as $post) {
    setup_postdata($post);
	echo "<h2>";
	the_title();
	echo "</h2>";
    the_content();
	echo "<div style=\"clear:both;\"></div>";
	}?>

</div>


<div class="halfdiv" style="min-height:174px;"><h2>Day by Day Virginia</h2>
<a href="http://daybydayva.org/"><img src="/images/daybydayva322.png" alt=""></a>
</div>
<div style="clear:both;"></div>
<div class="fulldiv" id="st">
<?$lastposts = get_posts('numberposts=10&category_name=Storytime');
		// spit out content of the post(s)
		foreach($lastposts as $post) 
			{
			echo "<div class=\"wpdiv\">";
			setup_postdata($post);

			the_content();
			echo "</div>";
			echo "<div style=\"clear:both;\"></div>";
			}
		?>


</div>

</div>


<div style="clear:both;"></div>
<?} // ========== Education ==========
elseif($service=="educators"){?>
<div class="hicon">
<div class="halfdiv">
<?$lastposts = get_posts('numberposts=1&category_name=homeschool-websites');
		// spit out content of the post(s)
		foreach($lastposts as $post) 
			{
			
			setup_postdata($post);
						echo "<h2>";
	the_title();
	echo "</h2>";
			the_content();
			
			echo "<div style=\"clear:both;\"></div>";
			
		}?>
</div>

<div class="halfdiv"><h2>Assignment Alert Form</h2>
<p>Teachers, have an assignment coming up? The library has many resources for 
your students from reference books to online databases.</p>
<p><strong>Please give us two weeks advance notice on upcoming assignments.</strong></p>
<a href="assignalertform.php">Assignment Alert Form</a>
</div>
</div>


<div class="hicon">
<div class="thirds"><h2>Library Tours</h2><p>
Are you interested in bringing your students to the library for a tour and/or 
research instruction, please fill out the <a href="librarytourform.php">Library Tour Form</a>.
</p></div>

<div class="thirds"><h2>School Visits</h2><p>
Request library staff to visit your class, parent group, faculty meeting or special event.</p>
<p>Outreach visits can vary from story times to booktalks, and or database instruction.</p>
<p>Please fill out the <a href="schoolvisitform.php">School Visit Form</a>
to request a visit or call Sarah Pahl at <a tel="5405528246">540-552-8246</a>.

</p></div>

<div class="thirds">
<h2>Literacy Kits</h2>
<p>We have many Literacy Kits which contain Books and Early Learning materials on a variety of titles.</p>
<ul class="shortkitlist" >
<?foreach($kittitles as $kittitle) {linkakit($kittitle);}?>
</ul>

</div>
</div>
<div style="clear:both;"></div>
<?}
elseif($service=="preview"){?>
<h1>Preview Posts</h1>
<div class="fulldiv">
<?php //get most recent posts in category
$lastposts = get_posts('category_name=yspreview');
// divulge post contents
foreach($lastposts as $post) {
	echo "<div class=\"wpdiv\">";
	setup_postdata($post);
	the_content();
	echo "</div>";
	
	}
	?>

<div style="clear:both;"></div>
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