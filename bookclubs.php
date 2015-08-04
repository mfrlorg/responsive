<!DOCTYPE html>
<?  $currentpage = "bookclubs.php";
$whatserveristhis = 'thisisthetestserver.txt';
if (file_exists($whatserveristhis)) {$server="test";}
// ************
// *** 2014 ***
// ************
# Include the Required files. Delete any that are unneed for individual pages.
	include 'inlibrary.php';
	if ($_REQUEST['coversize']!='') $coversize=strtoupper($_REQUEST['coversize']);
		else $coversize="M";
		$showall=$_REQUEST['show'];
$clubcat=$_REQUEST['clubcategory'];
$onlybranch=$_REQUEST['branch'];
$noneshown=true;
// bclub([YYYYMMDD],[$time],[branch],[club],[author],[isbn=""],[title=""],[blurb=""],
//		 [altserach=""],[author2=""],[isbn2=""],[title2=""],[blurb2=""],[altsearch2=""]);
// %a or %a2 = Author 	}
// %t or %t2 = Title	}	in blurb
// $m = Month
//		Default blurb "We will be discussing %t by %a in %m."
 function bclub($bcdate,$time,$branch,$club,$author="",$isbn="",$title="",$blurb="",
				$altsearch="t",$author2="",$isbn2="",$title2="",$blurb2="",$altsearch2="t")
{
global $clubcat;
global $onlybranch;
global $headermonth;
global $monthshown;
global $showall;

if ($_REQUEST['futuredate']!='') {
	$today=$_REQUEST['futuredate'];
	$today=mktime(0,0,0,substr($today,4,2),substr($today,6,2),substr($today,0,4));

	}else $today=mktime();
$freshness=mktime(0,0,0,substr($bcdate,4,2),substr($bcdate,6,2),substr($bcdate,0,4))-$today+166400;
$freshmonth=date("F",mktime(0,0,0,substr($bcdate,4,2),substr($bcdate,6,2),substr($bcdate,0,4)));
if (($showall!="all")&& (($freshness<-200000)||(($freshness>6600000)&&($headermonth!=$freshmonth)))) return;





$clubmonth = date("F",mktime(0,0,0,substr($bcdate,4,2),substr($bcdate,6,2),substr($bcdate,0,4)));
	switch(strtolower($branch))
		{
			case "b":
			$branch="Blacksburg";
			if($blurb=="")$blurb="Join fellow book lovers for coffee and conversation about the book %t by %a. No commitment is required – please drop in when it suits you.";
			break;
			case "c":
			$branch="Christiansburg";
			break;
			case "f":
		    $branch="Floyd";
		    break;
			case "m":
		    $branch="Meadowbrook";
		    if($blurb=="")$blurb="We will discuss %t by %a.  Join us for coffee and great discussion.   Call to reserve your copy.";
		    break;
		}
if(($onlybranch!=$branch)&&($onlybranch!=""))	return;
		$age="adult";
if($club=="tab"){$club="Talking About Books"; $age="adult";}
if($club=="frg"){$club="Fun Reading Group";$age="juvenile"; $blurb="Join us for a discussion of %t by %a in %m.";}
if($club=="tam"){$club="Talking About Movies"; $age="adult";}
if($club=="mdbc"){$club="Mother Daughter BookClub";$age="juvenile";}
if($club=="mdbcb"){$club="Mother Daughter BookClub";$age="juvenile";$version="Daughters 8-10 years old";
	if($blurb=="")$blurb="Mothers & daughters, enjoy an evening out together with just the girls! We’ll discuss the book %t by %a. After our book chat we’ll enjoy snacks and a craft. To request your copy of the book email Elizabeth at <a href=\"mailto:esensabaugh@mfrl.org\">esensabaugh@mfrl.org</a> or call <a href=\"tel:5405528246\">552-8246 ext. 109</a>. ";}
if($club=="mdbc1"){$club="Mother Daughter BookClub";$age="juvenile"; $version="Version 1.0:<br>5<sup>th</sup> & 6<sup>th</sup> graders";}
if($club=="mdbctw"){$club="Mother Daughter BookClub";$age="juvenile"; $version="TWEENS:<br>4<sup>th</sup>, 5<sup>th</sup> & 6<sup>th</sup> graders";}
if($club=="mdbcsf"){$club="Mother Daughter BookClub";$age="juvenile"; $version="Small Fries:<br>2<sup>nd</sup> & 3<sup>rd</sup> graders";}
if($club=="mdbct"){$club="Mother Daughter BookClub";$age="juvenile"; $version="TEENS:<br>6<sup>th</sup>, 7<sup>th</sup>, & 8<sup>th</sup> graders";}

if(($version!="")&&($blurb=="")){$blurb="We will be reading %t by %a in %m. Registration is required: contact Jenny at <a href=\"mailto:jbarrowclough@mfrl.org\">jbarrowclough@mfrl.org</a> or <a href=\"tel:5403826965\">(540) 382-6965 ext. 224</a>.";}
if($club=="ebt"){$club="Evening Book Talk";$age="adult";}
if($club=="Fun Reading Group")$age="juvenile";
if($club=="Dystopic Much?")$age="teen";
if($club=="Heartbroken Much?")$age="teen";
if($club=="tab1"){$club="Talking About <i>The One</i>";$age="teen";}
if (($clubcat!="")&&($clubcat!=$age)) return;

if($headermonth==""){
	$monthshown="";
	$headermonth=date("F",mktime(0,0,0,substr($bcdate,4,2),substr($bcdate,6,2),substr($bcdate,0,4)));
}elseif($monthshown!=date("F",mktime(0,0,0,substr($bcdate,4,2),substr($bcdate,6,2),substr($bcdate,0,4))))
{	$headermonth=date("F",mktime(0,0,0,substr($bcdate,4,2),substr($bcdate,6,2),substr($bcdate,0,4)));}

if(($monthshown=="")||($monthshown!=$headermonth)){
	$monthshown=$headermonth;

	echo "<h2 class=\"monthheader\">".$headermonth."</h2>";

}

if(($club=="a")||($club==""))$club="Book Club";
if($isbn2!="") $coversize="S"; else $coversize="M";
/*if($isbn2!="") {$result = mt_rand (0,1);
	if($result){
		$tisbn=$isbn;
		$isbn=$isbn2;
		$isbn2=$tisbn;
		}
	}*/
if($blurb==""){$blurb="Join us for a discussion of %t by %a in %m.";}

$showdate=date("D, M j",mktime(0,0,0,substr($bcdate,4,2),substr($bcdate,6,2),substr($bcdate,0,4)));
$blurb=str_replace("%m", $clubmonth, $blurb);
$blurb=str_replace("%a2", cattext($author2,"a"), $blurb);

$blurb=str_replace("%t2","<i>%t2</i>",$blurb);
if($altsearch=="s")$blurb=str_replace("%s2", cattext($title2,"s"), $blurb);
$blurb=str_replace("%t2", cattext($title2,"t"), $blurb);

$blurb=str_replace("%a", cattext($author,"a"), $blurb);
$blurb=str_replace("%t","<i>%t</i>",$blurb);
if($altsearch=="s")$blurb=str_replace("%s", cattext($title,"s"), $blurb);
$blurb=str_replace("%t", cattext($title,"t"), $blurb);


$esc_title =str_replace(" ","+",$title);
$esc_author=str_replace(" ","+",$author);
$esc_title= str_replace('&+','',$esc_title);
$esc_author= str_replace('&+','',$esc_author);

$esc_title2=str_replace(" ","+",$title2);
$esc_author2=str_replace(" ","+",$author2);
$esc_title2= str_replace('&+','',$esc_title2);
$esc_author2= str_replace('&+','',$esc_author2);


echo "

<div class=\"d".$branch." bcbox\">";



echo "<h2>".$club."</h2>";
echo "<h3 class=\"branch\">".$branch."</h3><h3 class=\"date\">".$showdate.", ".$time."</h3>";

echo "<p>";
catimg($author,$isbn,$title,$altsearch,$coversize);
if($isbn2!="") catimg($author2,$isbn2,$title2,$altsearch2,$coversize,"r");
if($version)echo "<b>".$version."</b><br>";
echo $blurb;

echo "</p>";

echo "</div>";
global $noneshown;
$noneshown=false;
}

function cattext($term,$type,$custom=""){
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
return "<a href=\"".$texturl."\">".$custom."</a>";

}

function catimg($author,$isbn,$title,$type,$coversize="M",$side="")
{
	$esc_title =str_replace(" ","+",$title);
	$esc_author=str_replace(" ","+",$author);
	$esc_title= str_replace('&+','',$esc_title);
	$esc_author= str_replace('&+','',$esc_author);
	$imglurl="http://cat.mfrl.org/uhtbin/cgisirsi.exe/0/CBURG/0/5?searchdata1=";
	switch($type){
		case "s":
			$imglurl.=$esc_title."&amp;srchfield1=GENERAL%5ESUBJECT";
			break;
		case "a":
			$imglurl.=$esc_author."&amp;srchfield1=AU$5EAUTHOR";
		break;
		case "i":
			$imglurl.=$isbn."&amp;srchfield1=ISBN";
		break;
		case "texact":
			$imglurl.=$esc_title."&amp;srchfield1=TI%5ETITLE&amp;match_on=EXACT";
		case "t":
		case "":
		default:
			$imglurl.=$esc_title."&amp;srchfield1=TI%5ETITLE";
		break;
	}
	if ($isbn=="") $isbn="1";
	$filename="/images/isbn/".$isbn.$coversize.".GIF";
	if ((file_exists($filename))||($isbn=="1"))
		{
			$imgurl=$filename;
		} else {
			$imgurl="http://syndetics.com/index.aspx?isbn=".$isbn."/".$coversize."C.GIF";
		}
		if($side=="r")$forcefloat="style=\"float:right;\"";
echo "<a href=\"".$imglurl."\"><img src=\"".$imgurl."\" ".$forcefloat." alt=\"".$title.(($title!="")&&($author!="")?" by ":"").$author."\" title=\"".$title.(($title!="")&&($author!="")?" by ":"").$author."\"></a>";

}


?>
<html>
<head>
<title>Book Clubs</title>
<meta charset="UTF-8">
<meta name="google-site-verification" content="kwYyWkz6FQf_DQmvAwDvYR1Ccb2UmOn_tqnHVYAEBTM" />
<link href="xxxmfrl.css" rel="stylesheet" type="text/css" >
<link href="xxxmfrlpage.css" rel="stylesheet" type="text/css" >
<link type="text/css" href="/inc/css/jquery-ui-1.8.11.custom.css" rel="stylesheet" />
<script type="text/javascript" src="/inc/js/jquery-1.5.1.min.js"></script>
<script type="text/javascript" src="/inc/js/jquery-ui-1.8.11.custom.min.js"></script>
<script type="text/javascript" src="/inc/js/jquery.cycle.all.min.js"></script>
<script type="text/javascript" src="/inc/js/superfish.js"></script>
<style type="text/css">
.bcbox {
	width:314px;
	margin:5px;
	float: left;


}
.bcbox img {

}

.bcbox p, .bcbox img{
	float: left;
	margin:3px;

}


.dBlacksburg{
	border: 5px solid #7fe27f;
	background:#f9fff9;
}
.dBlacksburg h3,.dBlacksburg h2{
	/*background:#7fe27f;*/
}
.dBlacksburg h3{
	border-bottom:3px solid #7fe27f;

}
.dChristiansburg{
	border: 5px solid #D974E9;
	background:#fff9ff;
}
.dChristiansburg h3,.dChristiansburg h2{
	/*background: #d974e9; */
}
.dChristiansburg h3{
	border-bottom:3px solid  #d974e9;
}
.dFloyd{
	border: 5px solid #87C4FC;
	background:#f9f9ff;
}
.dFloyd h3,.dFloyd h2{
	/*background: #87C4FC;*/
}
.dFloyd h3{
	border-bottom: 3px solid #87C4FC;
}
.dMeadowbrook{
	border: 5px solid #c0c0c0;
	background:#f9f9f9;
}
.dMeadowbrook h3, .dMeadowbrook h2{
	/*background: #c0c0c0;*/
}
.dMeadowbrook h3 {
	border-bottom: 3px solid #c0c0c0;
}
.dBlacksburg h2, .dChristiansburg h2, .dFloyd h2, .dMeadowbrook h2{
	font-size:125%;
	padding:3px 5px;
	text-shadow: 2px 2px 2px #000;
}
.dBlacksburg h3, .dChristiansburg h3, .dFloyd h3, .dMeadowbrook h3 {
	float:left;
		padding:3px 5px;
		text-shadow: 0px 0px 5px #fff;
}
.dBlacksburg h3.branch, .dChristiansburg h3.branch, .dFloyd h3.branch, .dMeadowbrook h3.branch {
	width:114px;
}
.dBlacksburg h3.date, .dChristiansburg h3.date, .dFloyd h3.date, .dMeadowbrook h3.date {
	width:180px;
}
.clubnav {
	float:right;
	background:white;
	padding:2px 5px;
	font-weight: bold;
	text-align: right;
}
.monthheader{
	width:661px;
	clear:both;
	font-weight: bold;
	font-size:1.2em;
	color:black;
	background: white;
	padding:5px;
	border-top:20px solid #fff8e6;
}
</style>
<script type="text/javascript">


/* Thanks to CSS Tricks for pointing out this bit of jQuery
http://css-tricks.com/equal-height-blocks-in-rows/
It's been modified into a function called at page load and then each time the page is resized. One large modification was to remove the set height before each new calculation. */

equalheight = function(container){

var currentTallest = 0,
     currentRowStart = 0,
     rowDivs = new Array(),
     $el,
     topPosition = 0;
 $(container).each(function() {

   $el = $(this);
   $($el).height('auto')
   topPostion = $el.position().top;

   if (currentRowStart != topPostion) {
     for (currentDiv = 0 ; currentDiv < rowDivs.length ; currentDiv++) {
       rowDivs[currentDiv].height(currentTallest);
     }
     rowDivs.length = 0; // empty the array
     currentRowStart = topPostion;
     currentTallest = $el.height();
     rowDivs.push($el);
   } else {
     rowDivs.push($el);
     currentTallest = (currentTallest < $el.height()) ? ($el.height()) : (currentTallest);
  }
   for (currentDiv = 0 ; currentDiv < rowDivs.length ; currentDiv++) {
     rowDivs[currentDiv].height(currentTallest);
   }
 });
}

$(window).load(function() {
  equalheight('#clubs div');
});


$(window).resize(function(){
  equalheight('#clubs div');
});

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
			<?include'menu.books.php';?>
		</div> <!-- End Menu col -->
		<div id="fullrightcol">
			<div class="pagediv">
				<?if($onlybranch!="")$tonlybranch="branch=".$onlybranch;
				  if($clubcat!="")$tclubcat="&amp;clubcategory=".$clubcat;?>
<p class="clubnav">

<!--	<?if($showall=="all")$showalllink="&amp;show=all";
	  if($clubcat=="adult") echo "Adult";else 	{?><a href="?clubcategory=adult&amp;<?echo$tonlybranch;?>">Adult</a><?}?> |
	<?if($clubcat=="teen") echo "Teen";else 	{?><a href="?clubcategory=teen&amp;<?echo$tonlybranch;?>">Teen</a><?}?> |
	<?if($clubcat=="juvenile")echo"Juvenile";else {?><a href="?clubcategory=juvenile&amp;<?echo$tonlybranch;?>">Juvenile</a><?}?> |
	<?if($clubcat=="") echo "All";else 			{?><a href="bookclubs.php?<?echo$tonlybranch;?>">All</a><?}?><br>	-->
	<?if($onlybranch=="Blacksburg")echo"Blacksburg";else {?>	<a href="?branch=Blacksburg<?echo$tclubcat.$showalllink;?>">Blacksburg</a><?}?> |
	<?if($onlybranch=="Christiansburg")echo"Christiansburg";else {?>	<a href="?branch=Christiansburg<?echo$tclubcat.$showalllink;?>">Christiansburg</a><?}?> |
	<?if($onlybranch=="Floyd")echo"Floyd";else {?>	<a href="?branch=Floyd<?echo$tclubcat.$showalllink;?>">Floyd</a><?}?> |
	<?if($onlybranch=="Meadowbrook")echo"Meadowbrook";else {?>	<a href="?branch=Meadowbrook<?echo$tclubcat.$showalllink;?>">Meadowbrook</a><?}?> |
	<?if($onlybranch=="")echo"All";else {?>	<a href="bookclubs.php?<?echo$tclubcat.$showalllink;?>">All</a><?}?>
</p>
<h1 >Book Clubs</h1>
<h2 >The Library's Book Discussion Groups</h2>
<!--<p><a href="?coversize=<?if($coversize=="S") echo "M\">"; else echo "S\">";?><img style="float:none;" src="/images/<?if($coversize=="S")echo"enlarge"; else echo"reduce";?>cover2.png" alt="<?if($coversize=="S")echo "In";else echo "De";?>crease Cover Size. Large size covers are not available for all books."><?if($coversize=="S")echo "In"; else echo "De";?>crease Cover Size.</a></p>-->
<div style="clear:both;"></div>
<div id="clubs">
<?/*
bclub(20141201,"6:30pm","c","mdbc2","Brian Selznick","9780545027892","Wonderstruck");
bclub(20141203,"11am","c","tab","","9780470503959","Christmas","Join us for a discussion of %s and %s2 books.",
		"s","","0696213753","Hanukkah","","s");
bclub(20141204,"5pm","c","mdbc1","Ann M. Martin","0439715598","A dog's life: Autobiography of a Stray");
bclub(20141209,"5:30","c","mdbcsf","Natalie Carlson","0060209917","The Family Under the Bridge");
bclub(20141210,"6pm","c","ebt","George Eliot","067960118X","Middlemarch","Join us for a discussion of %t by %a. We will read the first half in November and the Second in December.");
bclub(20141211,"2pm","f","tab","Ayad Akhtar","9780316183314","American Dervish");
bclub(20141229,"11am","b","tab","Carol Wall","9780399157981","Mister Owita's Guide to Gardening");
bclub(20150105,"6:30pm","c","mdbc2","Michael Buckley","0810959259","The Fairy-Tale Detectives");
bclub(20150107,"11am","c","tab","M.L. Stedman","0857521004","The Light Between Oceans");
bclub(20150107,"6pm","m","tab","Bill Bryson","0767902513","A Walk in the Woods");
bclub(20150107,"6:30pm","c","ebt","Dean Koontz","9781401323523","A Big Little Life");
bclub(20150108,"11am","m","tab","Jane Austen","9780674049161","Pride & Prejudice");
bclub(20150108,"2pm","f","tab","Edeet Ravel","9780143186458","The Cat");
bclub(20150108,"5pm","c","mdbc1","Kirsten Miller","1599900920","Kiki Strike: inside the shadow city");
bclub(20150112,"4:15pm","m","frg","Emery Bernhard","0525675329","Happy New Year!");
bclub(20150113,"5:30pm","c","mdbcsf","Patricia MacLachlan","9781442421714","White Fur Flying");
bclub(20150126,"11am","b","tab","Paul Auster","9780805095531","Winter Journal");
//in calendar above 12/17/14 ybc
bclub(20150204,"11:00am","c","tab","Khaled Hosseini","9781594631764","And The Mountains Echoed");
bclub(20150204,"6pm","m","tab","Jane Austen","9780674049161","Pride & Prejudice");
bclub(20150204,"6:30pm","c","ebt","Sue Monk Kidd","9780670024780","The Invention of Wings");
bclub(20150205,"5pm","c","mdbc1","Cece Bell","9781419710209","El Deafo");
bclub(20150202,"6:30pm","c","mdbc2","Caroline Starr Rose","9780385374149","May B");
bclub(20150209,"4:15pm","m","frg","Gail Gibbons","0823418529","Valentine's Day Is");
bclub(20150210,"5:30pm","c","mdbcsf","Anne Ursu","9780062015051","Breadcrumbs");
bclub(20150212,"11am","m","tab","Sheryl Sandberg","9780385349949","Lean In");
bclub(20150212,"2pm","f","tab","Chris Bohjalian","9780385534796","The Sandcastle Girls");
bclub(20150223,"11am","b","tab","Andrew Sean Greer","0062213784","The Impossible Lives of Greta Wells");
bclub(20150302,"6:30pm","c","mdbc2","Ingrid Law","9780803733060","Savvy");
bclub(20150304,"11:00am","c","tab","James Lee Burke","9781476710792","Wayfaring Stranger");
bclub(20150304,"6pm","m","tab","Sheryl Sandberg","9780385349949","Lean In");
bclub(20150304,"6:30pm","c","ebt","Anne Morrow Lindbergh","0679406832","Gift from the Sea");
bclub(20150309,"4:15pm","m","frg","Jack Prelutsky","9780375864582","The Carnival of the Animals");
bclub(20150305,"5:00pm","c","mdbc1","Victoria Forester","9780312374624","The Girl Who Could Fly");
bclub(20150310,"5:30pm","c","mdbcsf","Annie Barrows","068980217X","My Name is Maria Isabel");
bclub(20150312,"11am","m","tab","Jamie Ford","9780345522023","Songs of Willow Frost");
bclub(20150312,"2pm","f","tab","Tiffany Baker","9780446194204","The Little Giant of Aberdeen County");
bclub(20150330,"11am","b","tab","Karen Joy Fowler","9780399162091","We Are All Completely Beside Ourselves");
bclub(20150401,"11:00am","c","tab","","","","In April we will discuss Readers' choice of funny titles for April Fools' Day.");
bclub(20150401,"6pm","m","tab","Jamie Ford","9780345522023","Songs of Willow Frost");
bclub(20150401,"6:30pm","c","ebt","Marja Mills","9781594205194","The Mockingbird Next Door");
bclub(20150402,"5pm","c","mdbc1","Linda Sue Park","9780547251271","A Long Walk to Water");
bclub(20150406,"6:30pm","c","mdbc2","R. A. Spratt","9780316068192","Adventures of Nanny Piggins");
bclub(20150409,"11am","m","tab","Piper Kerman","9780812986181","Orange is the New Black");
bclub(20150409,"2pm","f","tab","Russell Banks","9780061857638","Lost Memory of Skin");
bclub(20150413,"4:15pm","f","frg","Phyllis Reynolds Naylor","9780385736169","Emily's Fortune");
bclub(20150414,"5:30pm","c","mdbcsf","Ann M. Martin","0786803614","The Doll People");
bclub(20150427,"11am","b","tab","David Mitchell","9781400065677","Bone Clocks");
bclub(20150504,"6:30pm","c","mdbc2","George Selden","0374316503","The Cricket in Times Square");
bclub(20150506,"11:00am","c","tab","Beth Macy","9780316231435","Factory Man");
bclub(20150506,"6pm","m","tab","Piper Kerman","9780812986181","Orange is the New Black");
bclub(20150506,"6:30pm","c","ebt","Adriana Trigiani","0345438329","Big Stone Gap");
bclub(20150507,"5:30pm","c","mdbc1","Jennifer Holm","9780375870644","Fourteenth Goldfish");
bclub(20150511,"4:15pm","f","frg","Phyllis Reynolds Naylor","9780385740975","Emily and Jackson: Hiding Out");
bclub(20150512,"6pm","c","Virginia Authors Book Discussion","Lee Smith","0345410319","Black Mountain Breakdown");
bclub(20150512,"5:30pm","c","mdbcsf","Katherine Applegate","0061992259","The One and Only Ivan");
bclub(20150514,"11am","m","tab","Mitch Albom","9780062294371","First Phone Call from Heaven");
bclub(20150514,"2pm","f","tab","Alice Hoffman","9781451693560","Museum of Extraordinary Things");
bclub(20150514,"5pm","b","Green for Words","John Green","0525475060","Looking for Alaska","Come talk about %a’s book %t and other teen books of interest.  You don’t have to be a teen to attend – but if you enjoy teen reads, come talk about a few of your favorites. All ages are welcome, including tweens, teens and adults! We’ll gather in the teen area at the newly installed teen bar!");
bclub(20150518,"11am","b","tab","Anthony Doerr","9781476746586","All the Light We Cannot See");



bclub(20150603,"11am","c","tab","Sue Monk Kidd","9780670024780","The Invention of Wings");
bclub(20150601,"6:30pm","c","mdbctw","Rita Williams-Garcia","9780060760885","One Crazy Summer");
bclub(20150603,"6pm","m","tab","Mitch Albom","9780062294371","First Phone Call from Heaven");
bclub(20150603,"6:30pm","c","ebt","Ann Patchett","9780062236678","This Is the Story of a Happy Marriage");
bclub(20150604,"5pm","c","mdbct","Diane Stanley","9780062248978","The Chosen Prince");
bclub(20150608,"4:15pm","m","frg","Jim Arnosky","9781402756610","Thunder Birds: Nature's Flying Predators");
//bclub(20150609,"5:30pm","c","mdbcsf","Ann M. Martin","0786803614","The Doll People");
bclub(20150611,"11am","m","tab","Martin Sixsmith","9780143124726","Philomena");
bclub(20150629,"11am","b","tab","W. Bruce Cameron","9780765377487","The Midnight Plan of the Repo Man");
*/

bclub(20150701,"11am","c","tab","Anne Tyler","9781101874271","A Spool of Blue Thread");
bclub(20150701,"6pm","m","tab","Martin Sixsmith","9780143124726","Philomena");
bclub(20150701,"6:30pm","c","ebt","Malala Yousafzai","9780316322409","I am Malala");
bclub(20150706,"6:30pm","c","mdbc2","Katherine Applegate","0061992259","The One and Only Ivan");
bclub(20150709,"11am","m","tab","F. Scott Fitzgerald","0521402301","The Great Gatsby");
bclub(20150709,"5pm","c","mdbct","","","","We will discuss which books are Must-Reads this summer! contact Jenny at <a href=\"mailto:jbarrowclough@mfrl.org\">jbarrowclough@mfrl.org</a> or <a href=\"tel:5403826965\">(540) 382-6965 ext. 224</a>.");
bclub(20150713,"4:15pm","m","frg","Sterling North","0142402524","Rascal");
bclub(20150714,"6:30","b","mdbc","Jane Yolen","9781467712347","Trash Mountain","<b>Mothers &  Daughters</b><br> (ages 8-10 years) <br> We’ll meet in the storytime room and talk about books, eat snacks, and make a craft! This month we’ll discuss %a’s newest book: %t, a story about Nutley the young red squirrel who is learning how to survive on his own. Copies are limited; contact Elizabeth at <a href=\"mailto:esensabaugh@mfrl.org?subject=Mother%20Daughter%20BookClub:%20Trash%20Mountain\">esensabaugh@mfrl.org</a> or <a href=\"tel:5405528246\">(540) 552-8246 ext. 109</a> to reserve your copy.");
bclub(20150718,"2pm","b","tab","Kiera Cass","9780062349859","The Heir","Come discuss the recently published book four of The Selection series %t by New York Times Bestselling Author %a. Feel free to wear your tiaras! Following the discussion, author %a will join the group, sign books and answer questions!");
bclub(20150721,"5pm","c","mdbctw","","","","Come join our interest meeting and help us decide what to read this summer.  Registration is required: contact Jenny at <a href=\"mailto:jbarrowclough@mfrl.org\">jbarrowclough@mfrl.org</a> or <a href=\"tel:5403826965\">(540) 382-6965 ext. 224</a>.");
bclub(20150727,"11am","b","tab","Sue Monk Kidd","9780670024780","The Invention of Wings");


bclub(20150803, "6:30pm","c","mdbctw","Raina Telgemeier","9780545132060","Smile");
bclub(20150805,"11am","c","tab","Emma Hooper","9781476755670","Etta & Otto & Russell & James");
bclub(20150805,"6pm","m","tab","F. Scott Fitzgerald","0521402301","The Great Gatsby");
bclub(20150805,"6:30pm","c","ebt","Jennifer Chiaverini","9780525953616","Mrs. Lincoln's Dressmaker");
bclub(20150806,"5pm","c","mdbct","Sharon Draper","9781416971702","Out of My Mind");
bclub(20150810,"4:15pm","m","frg","Karen Price Hossell","1588109437","Sign Language");
bclub(20150811,"6:30pm","b","mdbcb","George Selden","0374316503","The Cricket in Times Square");
bclub(20150813,"11am","m","tab","Malcolm Gladwell","9780316204361","David and Goliath");
bclub(20150813,"2pm","f","tab","Gabrielle Zevin","9781616203214","Storied Life of A J Fikry");
bclub(20150818,"5pm","c","mdbctw","","","","Come join our interest meeting and help us decide what to read this summer.  Registration is required: contact Jenny at <a href=\"mailto:jbarrowclough@mfrl.org\">jbarrowclough@mfrl.org</a> or <a href=\"tel:5403826965\">(540) 382-6965 ext. 224</a>.");
bclub(20150831,"11am","b","tab","Ellen Cooney","9780544236158","Mountaintop School for Dogs");

bclub(20150825,"6:30pm","b","mdbcb","","","","Mothers & daughters, enjoy an evening out together with just the girls! The book selection will be announced by July 25. Email  Elizabeth at <a href=\"mailto:esensabaugh@mfrl.org\">esensabaugh@mfrl.org</a> or call <a href=\"tel:5405528246\">552-8246 ext. 109</a> for your book suggestions.");

bclub(20150902,"11am","c","tab","Marja Mills","9781594205194","The Mockingbird Next Door");
bclub(20150902,"6pm","m","tab","Malcolm Gladwell","9780316204361","David and Goliath");
bclub(20150902,"6:30pm","c","ebt","Anthony Doerr","9781476746586","All the Light We Cannot See");
bclub(20150910,"11am","m","tab","Diane Chamberlain","0778320170","Her Mother's Shadow");
bclub(20150910,"2pm","f","tab","Darragh McKeon","0062246879","All That is Solid Melts Into Air");
bclub(20150928,"11am","b","tab","Sherman Alexie","9780316013680","The Absolutely True Diary of a Part-Time Indian");

bclub(20151007,"6pm","m","tab","Diane Chamberlain","0778320170","Her Mother's Shadow");
bclub(20151008,"2pm","f","tab","Carol Wall","9780399157981","Mister Owita's Guide to Gardening");
bclub(20151015,"11am","m","tab","Cokie Roberts","0060090251","Founding Mothers");
bclub(20151026,"11am","b","tab","Tim O'Brien","9780547391175","The Things They Carried");

bclub(20151104,"6pm","m","tab","Cokie Roberts","0060090251","Founding Mothers");
bclub(20151112,"11am","m","tab","Francine Rivers","9781414368184","Bridge to Haven");
bclub(20151112,"2pm","f","tab","Kristin Hannah","9780312577223","Nightingale");
bclub(20151123,"11am","b","tab","Sally Mann","9780316247764","Hold Still");

bclub(20151202,"6pm","m","tab","Francine Rivers","9781414368184","Bridge to Haven");
bclub(20151210,"11am","m","tab","Maya Angelou","9780375507892","I know why the caged bird sings");
bclub(20151210,"2pm","f","tab","Emma Hooper","9781476755670","Etta & Otto & Russell & James");
bclub(20151228,"11am","b","tab","Dave Eggers","1400033543","You Shall Know Our Velocity");

bclub(20160114,"2pm","f","tab","Richard Ford","0061692069","Let Me Be Frank with You");
bclub(20160211,"2pm","f","tab","Rachel Joyce","9780812993295","Unlikely Pilgrimage of Harold Fry",
				"We will be reading %t and %t2 by %a in %m",
				"","Rachel Joyce","9780812996678","The Love Song of Miss Queenie Hennessy");
bclub(20160310,"2pm","f","tab","Annie Barrows","0385342942","Truth According to Us");
bclub(20160414,"2pm","f","tab","Lisa Genova","9781476717777","Inside the O'Briens");
bclub(20160512,"2pm","f","tab","Tim O'Brien","0767902890","The Things They Carried");



if($noneshown==true){?>
<h3>No Bookclubs found with the criteria <?
echo "<i>".ucwords($clubcat)."</i>";
if (($clubcat)&&($onlybranch)) echo " AND ";
echo "<i>".ucwords($onlybranch)."</i>";
?>. Broaden you search above.</h3><br>

<?}

// bclub([YYYYMMDD],[$time],[branch],[club],[author],[isbn=""],[title=""],[blurb=""],
//		 [altserach=""],[author2=""],[isbn2=""],[title2=""],[blurb2=""],[altsearch2=""]);
// %a or %a2 = Author 	}
// %t or %t2 = Title	}	in blurb
// %m = Month


?></div>
<div style="clear:both;"></div>
			</div>
		</div> <!-- end right col -->
    </div>
<div style="clear:both;"></div>
    <div id="footer"><?include'xxxfooter.php';?></div>
</div>
</body>
</html>
