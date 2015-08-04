<!DOCTYPE html>
<?$currentpage = "online.php";
$whatserveristhis = 'thisisthetestserver.txt';
if (file_exists($whatserveristhis)) {$server="test";}
// ********
// * 2014 *
// ********
include 'inlibrary.php';
if($_REQUEST['looks']!='')$inlibrary=$_REQUEST['looks'];
$cat=$_REQUEST['cat'];
$appropriatecats = array("career","books","learn","lang","dl","uniclass","credo","quotes","econtent","health","kids","all","db","resource","research","genes","oral");
if (!in_array($cat,$appropriatecats)) $cat="all";
	$subcat = $cat;
	switch ($cat) {
		case 'career':
		case 'books':
		case 'lang':
		case 'uniclass':
		case 'dl':
		case 'credo':
		case 'resource':
		$cat = 'resource';
		break;
		case 'learn':
		$cat = 'learn';
		$subcat='learn';
		break;
		
		
		case 'econtent':
		case 'genes':
		case 'research':
		case 'health':
		case 'kids':
		case 'quotes':
		case 'db':
		$cat = 'db';
		break;
		case 'oral':
		$cat='oral';
		break;
		default:
		$cat='all';
		$subcat='all';
		break;
		}
//echo "LIBRARY: ".$currentbranch; if ($inlibrary) echo " IN<br>"; else echo " OUT<br>";

// 3M Button
function mmmButton() {global $inlibrary;?><div class="dbutton">
<a class="dlink" href="http://ebook.3m.com/library/mfreglib/" onClick="javascript: pageTracker._trackPageview('/outgoing/<?=($inlibrary?'i':'o');?>l/3m');"><span class="divspanner"></span></a>
<!--<a href="http://www.mfrl.org/wp/?p=" class="helplink"><img src="/images/icons/help.png" alt="Emily's Reference Guide" title="Emily's Reference Guide"></a> -->
<h2 class="buttontitle"><span class="pagename">eBooks</span></h2>
<h2>3M Cloud Library</h2>
<p>Browse, borrow and read e-books!<br>
	
<a class="sublink mmmpic" href="http://ebook.3m.com/library/mfreglib/" onClick="javascript: pageTracker._trackPageview('/outgoing/<?=($inlibrary?'i':'o');?>l/3m');"><img src="/images/3mbutton.png" alt="3M Cloud Library" title="3M Cloud Library"></a>
</p>
</div><?}



// Hoopla Button
function hooButton() {global $inlibrary;?><div class="dbutton">
<a class="dlink" href="https://www.hoopladigital.com/home" onClick="javascript: pageTracker._trackPageview('/outgoing/<?=($inlibrary?'i':'o');?>l/hoopla');"><span class="divspanner"></span></a>
<a href="http://www.mfrl.org/wp/?p=3350" class="helplink"><img src="/images/icons/help.png" alt="Emily's Reference Guide" title="Emily's Reference Guide"></a> 
<h2 class="buttontitle"><span class="pagename">Digital Media</span></h2>
<h2>hoopla</h2>
<p>Download Movies, Music, TV Shows, and Audiobooks. Free!
	
<a class="sublink" href="https://www.hoopladigital.com/home" onClick="javascript: pageTracker._trackPageview('/outgoing/<?=($inlibrary?'i':'o');?>l/hoopla');"><img src="/images/hoopla.png" alt="hoopla" title="hoopla"></a>
</p>
</div><?}



// Resume Cypress Button
function CRButton() {global $inlibrary;?><div class="dbutton">
<a class="dlink" href="http://cypressresume.com/index.php?c=montgomeryfloydregionallibrary" onClick="javascript: pageTracker._trackPageview('/outgoing/<?=($inlibrary?'i':'o');?>l/cypress.resume');"><span class="divspanner"></span></a>
<a href="http://www.mfrl.org/wp/?p=3321" class="helplink"><img src="/images/icons/help.png" alt="Emily's Reference Guide" title="Emily's Reference Guide"></a> 
<h2 class="buttontitle"><span class="pagename">Career Building</span></h2>

<h2>Cypress Resume</h2>
<p>Effortlessly create a professional resume and increase the odds of getting the job you want.
	<br>&nbsp;
<a class="sublink" href="http://cypressresume.com/index.php?c=montgomeryfloydregionallibrary" onClick="javascript: pageTracker._trackPageview('/outgoing/<?=($inlibrary?'i':'o');?>l/cypress.resume');"><img src="/images/resume%20cr_banner.jpg" alt="Cypress Resume" title="Cypress Resume"></a>
</p>
</div><?}

// OverDrive Button
function ODButton() {global $inlibrary;?><div class="dbutton doubleh">
<a class="dlink" href="http://swvapub.lib.overdrive.com/" onClick="javascript: pageTracker._trackPageview('/outgoing/<?=($inlibrary?'i':'o');?>l/swvapub.overdrive.com');"><span class="divspanner"></span></a>
<h2 class="buttontitle"><span class="pagename">Audiobooks and eBooks</span></h2>
<a href="http://www.mfrl.org/wp/?p=1042" class="helplink"><img src="/images/icons/help.png" alt="Emily's Reference Guide" title="Emily's Reference Guide"></a> 
<h2>OverDrive</h2>
<p>Download eBooks and AudioBooks to your Tablet, Smart phone or MP3 Player. Full details on getting started can
be found on our <a href="overdrive.php" class="sublink">Overdrive Quick Start Guide</a> <br>
Or click the image below to go straight to our OverDrive catalog.<br>&nbsp;
<a class="sublink odpic" href="http://swvapub.lib.overdrive.com/" onClick="javascript: pageTracker._trackPageview('/outgoing/<?=($inlibrary?'i':'o');?>l/swvapub.overdrive.com');"><img src="/images/overdrive3.png" alt="OverDrive"></a>
</p>
</div><?}

// Zinio Button
function ZinioButton() {global $inlibrary;?><div class="dbutton">
<a class="dlink" href="https://www.rbdigital.com/montgomeryfloydva/service/zinio/landing?" onClick="javascript: pageTracker._trackPageview('/outgoing/<?echo($inlibrary?"i":"o");?>l/zinio');"><span class="divspanner"></span></a>
<a href="http://www.mfrl.org/wp/?p=1995" class="helplink"><img src="/images/icons/help.png" alt="Emily's Reference Guide" title="Emily's Reference Guide"></a> 
<h2 class="buttontitle"><span class="pagename">Digital Magazines</span></h2>
<h2>Zinio</h2>
<p>Read magazines on your Computer, Tablet or Smart Phone.
<a class="sublink ziniopic" href="https://www.rbdigital.com/montgomeryfloydva/service/zinio/landing?" onClick="javascript: pageTracker._trackPageview('/outgoing/<?echo($inlibrary?"i":"o");?>l/zinio');"><img src="/images/zinio-logo.png" alt="Zinio"></a>
</p>
</div><?}

// Freading Button
function FreadingButton() {global $inlibrary;?><div class="dbutton">
<a class="dlink" href="http://mfrl.freading.com/" onClick="javascript: pageTracker._trackPageview('/outgoing/<?echo($inlibrary?"i":"o");?>l/freading');"><span class="divspanner"></span></a>
<a href="http://www.mfrl.org/wp/?p=1006" class="helplink"><img src="/images/icons/help.png" alt="Emily's Reference Guide" title="Emily's Reference Guide"></a> 
<h2 class="buttontitle"><span class="pagename">eBooks</span></h2>
<h2>Freading</h2>
<p>
Download eBooks to 
<a class="sublink freadpic" href="http://mfrl.freading.com/" onClick="javascript: pageTracker._trackPageview('/outgoing/<?echo($inlibrary?"i":"o");?>l/freading');"><img src="/images/freadinglogo.png" alt="Freading"></a>
your Tablet, Smart Phone or MP3 player.
</p>
</div><?}

// OCD Button
function OCDButton() {global $inlibrary;?><div class="dbutton">
<a class="dlink" href="http://montgomeryfloydva.oneclickdigital.com/" onClick="javascript: pageTracker._trackPageview('/outgoing/<?echo($inlibrary?"i":"o");?>l/oneclickdigital');"><span class="divspanner"></span></a>
<a href="http://www.mfrl.org/wp/?p=1983" class="helplink"><img src="/images/icons/help.png" alt="Emily's Reference Guide" title="Emily's Reference Guide"></a> 
<h2 class="buttontitle"><span class="pagename">eBooks and Audiobooks</span></h2>
<h2>OneClickdigital</h2>
<p>Download eBooks and AudioBooks to your Tablet, Smart phone or MP3 Player.
<a class="sublink ocdpic" href="http://montgomeryfloydva.oneclickdigital.com/" onClick="javascript: pageTracker._trackPageview('/outgoing/<?echo($inlibrary?"i":"o");?>l/oneclickdigital');"><img src="/images/oneclickdigital-logo.png" height="47" width="224" alt="OneClickdigital"></a>
</p>
</div><?}

// OCD2 Button
function OCD2Button() {global $inlibrary;?><div class="dbutton doubleh">
<a class="dlink" href="http://montgomeryfloydva.oneclickdigital.com/" onClick="javascript: pageTracker._trackPageview('/outgoing/<?echo($inlibrary?"i":"o");?>l/oneclickdigital');"><span class="divspanner"></span></a>
<h2 class="buttontitle"><span class="pagename">Audiobooks and eBooks</span></h2>
<a href="http://www.mfrl.org/wp/?p=1983" class="helplink"><img src="/images/icons/help.png" alt="Emily's Reference Guide" title="Emily's Reference Guide"></a> 
<h2>OneClickdigital</h2>
<iframe src="http://featured.oneclickdigital.com/Featured/Index?libraryKey=1A7F1526-E84B-4FB6-B7D4-17470A478B81" width="125" height="285" style="float:left; margin-top:15px;"></iframe>
<p style="float:left; width:73px; padding-left:10px;">Download eBooks and AudioBooks to your Tablet, Smart phone or MP3 Player.</p>
</div><?}


//Digital Editions Button [W+H]
function DigEdButton() {global $inlibrary;?><div class="doublew doubleh dbutton">
<a href="?cat=dl" class="dlink"><span class="divspanner"></span></a>
<h2>Audiobooks, eBooks and Digital Magazines</h2>
<p>Download digital editions to your Tablet, Smart phone and MP3 players.</p>
<a class="sublink ocdpic" href="http://montgomeryfloydva.oneclickdigital.com/" onClick="javascript: pageTracker._trackPageview('/outgoing/<?echo($inlibrary?"i":"o");?>l/oneclickdigital');"><img src="/images/oneclickdigital-logo.png" height="47" width="224" alt="OneClickdigital"></a>
<a class="sublink freadpic" href="http://mfrl.freading.com/" onClick="javascript: pageTracker._trackPageview('/outgoing/<?echo($inlibrary?"i":"o");?>l/freading');"><img src="/images/freadinglogo.png" alt="Freading"></a>
<a class="sublink ziniopic" href="https://www.rbdigital.com/montgomeryfloydva/service/zinio/landing?" onClick="javascript: pageTracker._trackPageview('/outgoing/<?echo($inlibrary?"i":"o");?>l/zinio');"><img src="/images/zinio-logo.png" alt="Zinio"></a>
<a class="sublink odpic" href="http://swvapub.lib.overdrive.com/" onClick="javascript: pageTracker._trackPageview('/outgoing/<?=($inlibrary?'i':'o');?>l/swvapub.overdrive.com');"><img src="/images/overdrive2.gif" alt="OverDrive"></a>
</div><?}
// Zinio: <a href="http://www.mfrl.org/wp/?p=1995" class="helplink"><img src="/images/icons/help.png" alt="Emily's Reference Guide" title="Emily's Reference Guide"></a> 
// OCD: <a href="http://www.mfrl.org/wp/?p=1983" class="helplink"><img src="/images/icons/help.png" alt="Emily's Reference Guide" title="Emily's Reference Guide"></a> 
// Overdrive: <a href="http://www.mfrl.org/wp/?p=1042" class="helplink"><img src="/images/icons/help.png" alt="Emily's Reference Guide" title="Emily's Reference Guide"></a> 
// Freading: <a href="http://www.mfrl.org/wp/?p=1006" class="helplink"><img src="/images/icons/help.png" alt="Emily's Reference Guide" title="Emily's Reference Guide"></a> 
    
 
 
//Mango Button
function MangoButton() {global $inlibrary;?><div class="dbutton">
<a href="http://www.mfrl.org/wp/?p=2275" class="helplink"><img src="/images/icons/help.png" alt="Emily's Reference Guide" title="Emily's Reference Guide"></a> 
<a class="dlink" href="http://libraries.mangolanguages.com/montgomery-floyd-regional/start" onClick="javascript: pageTracker._trackPageview('/outgoing/<?echo($inlibrary?"i":"o");?>l/mango');">
<span class="divspanner"></span></a>
<h2 class="buttontitle"><span class="pagename">Learning</span></h2>
<h2>Mango Languages</h2>
<p>Sign up for a Mango account at the library and you can learn to speak any of nearly 50 languages.
<a class="sublink mangopic" href="http://libraries.mangolanguages.com/montgomery-floyd-regional/start" onClick="javascript: pageTracker._trackPageview('/outgoing/<?echo($inlibrary?"i":"o");?>l/mango');">
<img src="/images/mangologotrans.png" alt="Mango Languages" class="left"></a>
</p></div><?}

//Universal Class Button
function UCButton() {global $inlibrary;?><div class="dbutton">
<a href="http://www.mfrl.org/wp/?p=1060" class="helplink"><img src="/images/icons/help.png" alt="Emily's Reference Guide" title="Emily's Reference Guide"></a> 
 
<a class="dlink" href="http://montgomeryfloydva.universalclass.com/register.htm"  onClick="javascript: pageTracker._trackPageview('/outgoing/<?echo($inlibrary?"i":"o");?>l/universalclass');"><span class="divspanner"></span></a>
<h2 class="buttontitle"><span class="pagename">Learning</span></h2>
<h2>Universal Class</h2>
<p>Over 500 online continuing education courses. Sign up, and start learning today!
<a class="sublink ucpic" href="http://montgomeryfloydva.universalclass.com/register.htm"  onClick="javascript: pageTracker._trackPageview('/outgoing/<?echo($inlibrary?"i":"o");?>l/universalclass');">
<img src="/images/universalclasslogotrans.png" alt="Universal Class Logo" class="left" style="padding-right:5px;"></a>
</p></div><?}

//Book Browse Button [H]
function BBrowseButton(){global $inlibrary;?><div class="dbutton doubleh">
<a href="http://www.mfrl.org/wp/?p=887" class="helplink"><img src="/images/icons/help.png" alt="Emily's Reference Guide" title="Emily's Reference Guide"></a> 
 
<a class="dlink" href="http://www.bookbrowse.com/<? if (!$inlibrary) echo "libweb/?lcd=163704"; ?>" onClick="javascript: pageTracker._trackPageview('/outgoing/<?echo($inlibrary?"i":"o");?>l/bookbrowse');">
<span class="divspanner"></span></a>
<h2 class="buttontitle"><span class="pagename">Books</span></h2>
<h2>BookBrowse</h2>
<p>BookBrowse is an online magazine for book lovers: in-depth reviews; 
stories behind books; previews and book news;  
find handpicked book suggestions; 
get advice on starting &amp; running a book club; and more! 
<a class="sublink bbpic" href="http://www.bookbrowse.com/<? if (!$inlibrary) echo "libweb/?lcd=163704"; ?>" onClick="javascript: pageTracker._trackPageview('/outgoing/<?echo($inlibrary?"i":"o");?>l/bookbrowse');"><img src="/images/bookbrowse1.gif" class="left" alt="BookBrowse for Libraries"></a>
</p></div><?}

//Literati Button
function LiteratiButton(){global $inlibrary;?><div class="dbutton">
<a href="http://www.mfrl.org/wp/?p=1171" class="helplink"><img src="/images/icons/help.png" alt="Emily's Reference Guide" title="Emily's Reference Guide"></a> 
 
<h2 class="buttontitle"><span class="pagename">Research</span></h2>
<a class="dlink" href="http://public.literati.credoreference.com" onClick="javascript: pageTracker._trackPageview('/outgoing/<?if($inlibrary)echo"i";else echo"o";?>l/literati');">
<span class="divspanner"></span></a>
<h2>Literati Public</h2>
<p>Includes a host of resources for K-12 students and 
adults, is specifically 
<a class="sublink lppic" href="http://public.literati.credoreference.com" onClick="javascript: pageTracker._trackPageview('/outgoing/<?if($inlibrary)echo"i";else echo"o";?>l/literati');" style="float:right;">
<img src="/images/credo.png"  alt="Credo Literati"></a>
customized for Virginia Libraries, and includes Homework Help.
</p></div><?}

//Exanded Academic ASAP
function EAASAPButton(){global $inlibrary;?>
<div class="dbutton">
<a href="http://www.mfrl.org/wp/?p=865" class="helplink"><img src="/images/icons/help.png" alt="Emily's Reference Guide" title="Emily's Reference Guide"></a> 
 
<?if($inlibrary){?><a class="dlink" href="http://infotrac.galegroup.com/itweb/va0051_002?db=eaim" onClick="javascript: pageTracker._trackPageview('/outgoing/il/expanded.academic.asap');" >
<?}else{?><a class="dlink" href="online_data_redirect.php">
<?}?><span class="divspanner"></span></a>
<h2><span class="pagename">General Research</span><br>Expanded Academic ASAP</h2>
<p>From arts and the humanities to social sciences, science and technology, and more.
<?if($inlibrary){?><a class="sublink eaapic" href="http://infotrac.galegroup.com/itweb/va0051_002?db=eaim" onClick="javascript: pageTracker._trackPageview('/outgoing/il/expanded.academic.asap');" >
<?}else{?><a class="sublink eaapic" href="online_data_redirect.php">
<?}?><img src="/images/academicasap.gif" alt="Expanded Academic ASAP" style="float:right;"></a>
Access scholarly journals, magazines, and newspapers.
</p></div><?}

//Quotes
function QuoteButton(){global $inlibrary;?><div class="dbutton">
<a href="http://www.mfrl.org/wp/?p=2379" class="helplink"><img src="/images/icons/help.png" alt="Emily's Reference Help" title="Emily's Reference Help"></a>
<h2 class="buttontitle"><span class="pagename">Books</span></h2>
<a class="dlink" href="http://www.famousquotesandauthors.com/"   onClick="javascript: pageTracker._trackPageview('/outgoing/<?echo($inlibrary?"i":"o");?>l/quotesdb');">
<span class="divspanner"></span></a>
<h2>Author Quotes</h2>
<p>Famous quotations for all occasions! Browse over 25k
<a class="sublink quotepic" href="http://www.famousquotesandauthors.com/"   onClick="javascript: pageTracker._trackPageview('/outgoing/<?echo($inlibrary?"i":"o");?>l/quotesdb');"><img src="http://www.famousquotesandauthors.com/images/_button.gif" alt="Famous Quotes"></a>
 quotes online from over 6,700 famous authors.
</p></div><?}

//Salem Health Button
function HealthButton(){global $inlibrary;?><div class="dbutton">
<a href="http://www.mfrl.org/wp/?p=1330" class="helplink"><img src="/images/icons/help.png" alt="Emily's Reference Guide" title="Emily's Reference Guide"></a> 
 
<h2 class="buttontitle"><span class="pagename">Health</span></h2>

<a class="dlink" href="http://health.salempress.com/<?if (!$inlibrary) echo "action/remoteAccessActivation?redirectUri=%2F"; ?>
" onClick="javascript: pageTracker._trackPageview('/outgoing/<?echo($inlibrary?"i":"o");?>l/salem.health');">
<span class="divspanner"></span></a>
<h2>Salem Health</h2>
<p>Online access to Salem Press' award-winning health reference work: Magill's Medical Guide.
<a class="sublink shpic" href="http://health.salempress.com/<?if (!$inlibrary) echo "action/remoteAccessActivation?redirectUri=%2F"; ?>
" onClick="javascript: pageTracker._trackPageview('/outgoing/<?echo($inlibrary?"i":"o");?>l/salem.health');">
<img class="sublink shpic" src='/images/salem_health_logo.gif' alt="Salem Health"></a>
</p></div>
<?}

//E-Library Button 
function ElibButton(){global $inlibrary;?><div class="dbutton">
<a href="http://www.mfrl.org/wp/?p=936" class="helplink"><img src="/images/icons/help.png" alt="Emily's Reference Guide" title="Emily's Reference Guide"></a> 
 
<h2><span class="pagename">E-Content</span></h2>
<?if($inlibrary){
echo "<a class=\"dlink\" href=\"http://elibrary.bigchalk.com/libweb/elib/do/search\" onClick=\"javascript: pageTracker._trackPageview('/outgoing/il/e-library');\">";
} else echo "<a class=\"dlink\" href=\"http://galesites.com/state/lva/geo.php?db=elibrary\">";
?><span class="divspanner"></span></a>
<h2>eLibrary</h2>
<p>Search current full text newspapers such as Roanoke Times, Washington Post and more.
<?if($inlibrary){
echo "<a class=\"sublink elibpic\" href=\"http://elibrary.bigchalk.com/libweb/elib/do/search\" onClick=\"javascript: pageTracker._trackPageview('/outgoing/il/e-library');\">";
} else echo "<a class=\"sublink elibpic\" href=\"http://galesites.com/state/lva/geo.php?db=elibrary\">";
?><img src="/images/elibrarylogotrans.png" alt="E-Library"></a></p></div><?}



// Ebschohost Ebooks
function EbscoBooksButton(){global$inlibrary;?><div class="dbutton">
<a href="http://www.mfrl.org/wp/?p=998" class="helplink"><img src="/images/icons/help.png" alt="Emily's Reference Guide" title="Emily's Reference Guide"></a> 
 
<h2><span class="pagename">E-Content</span></h2>
<a class="dlink" href="http://search.ebscohost.com/login.aspx?authtype=URL&amp;profile=ehost"  onClick="javascript: pageTracker._trackPageview('/outgoing/<?echo($inlibrary?"i":"o");?>l/EBSCOeBooks');"><span class="divspanner"></span></a>
<h2>EBSCOHost eBooks</h2>
<p>A variety of educational and reference books can be viewed online covering Architecture to Social Studies.<br>
<a class="sublink ebscopic" href="http://search.ebscohost.com/login.aspx?authtype=URL&amp;profile=ehost"  onClick="javascript: pageTracker._trackPageview('/outgoing/<?echo($inlibrary?"i":"o");?>l/EBSCOeBooks');">
<img src="/images/ebscohostlogo.png" alt="EBSCO Host eBook Collection"></a>
</p></div><?}



//Genealogy FOLD3 Button 
function FoldButton(){global$inlibrary;?><div class="dbutton">
<a href="http://www.mfrl.org/wp/?p=2078" class="helplink"><img src="/images/icons/help.png" alt="Emily's Reference Guide" title="Emily's Reference Guide"></a> 
 
<h2 class="buttontitle"><span class="pagename">Genealogy &amp; History</span></h2>
 <a class="dlink" href="http://search.ebscohost.com/login.aspx?authtype=URL&amp;profile=footnoteep "><span class="divspanner"></span></a>
<h2>Fold3</h2>
<p>Fold3 contains searchable digital images of records;
 including census, war, and naturalization files.
 <a class="sublink foldpic" href="http://search.ebscohost.com/login.aspx?authtype=URL&amp;profile=footnoteep ">
<img  src="/images/fold3.png" alt="Fold3 History and Genealogy Archives"></a>
</p></div><?}

//Genealogy Heritage Button
function HeriButton(){global$inlibrary;?><div class="dbutton">
<a href="http://www.mfrl.org/wp/?p=2008" class="helplink"><img src="/images/icons/help.png" alt="Emily's Reference Guide" title="Emily's Reference Guide"></a> 
 
<h2 class="buttontitle"><span class="pagename">Genealogy &amp; History</span></h2>
<? if ($inlibrary) {
echo "<a class=\"dlink\" href=\"http://www.heritagequestonline.com/prod/genealogy/index\" onClick=\"javascript: pageTracker._trackPageview('/outgoing/il/heritage.quest');\">";
} else echo "<a class=\"dlink\" href=\"http://www.heritagequestonline.com/barcode?aid=10318\" onClick=\"javascript: pageTracker._trackPageview('/outgoing/ol/heritage.quest');\">";
?><span class="divspanner"></span></a>
<h2>Heritage Quest</h2>
<p>Data on people and places 
using records covering the 1700's - 1900's.
<? if ($inlibrary) {
echo "<a class=\"sublink heripic\" href=\"http://www.heritagequestonline.com/prod/genealogy/index\" onClick=\"javascript: pageTracker._trackPageview('/outgoing/il/heritage.quest');\">";
} else echo "<a class=\"sublink heripic\" href=\"http://www.heritagequestonline.com/barcode?aid=10318\" onClick=\"javascript: pageTracker._trackPageview('/outgoing/ol/heritage.quest');\">";
?><img class="heripic" src="/images/heritagequestsmall.png" alt="Heritage Quest Online" title="Heritage Quest Online"></a>
</p></div><?}

//General Research Button
function InfotracButton(){global$inlibrary;?><div class="dbutton">
<a href="?cat=research"><span class="divspanner"></span></a>
<h2><span class="pagename">General Research</span></h2>
<p> We have many Research databases available which can provide verifiable sources of sorts. Some favorites include A to Z World Culture &amp; The USA,

Computer Databases, General OneFile and Reference Center Gold.
</p>
</div><?}

//GR AZ WORLD Button
function AZWButton(){global$inlibrary;?><div class="dbutton">
<a href="http://www.mfrl.org/wp/?p=1723" class="helplink"><img src="/images/icons/help.png" alt="Emily's Reference Guide" title="Emily's Reference Guide"></a> 
 
<a class="dlink" href="http://www.atozworldculture.com/a-z_culture_home.asp?c=mfrl" onClick="javascript: pageTracker._trackPageview('/outgoing/<?if($inlibrary){?>i<?}else{?>o<?}?>l/atozworld');"><span class="divspanner"></span></a>
<h2><span class="pagename">General Research</span></h2>
<h2>A to Z World Culture</h2>
<p>This database of 175 countries, covers culture, travel, 
 customs, money, weather and much more.<br>
<a class="sublink azwpic" href="http://www.atozworldculture.com/a-z_culture_home.asp?c=mfrl" onClick="javascript: pageTracker._trackPageview('/outgoing/<?if($inlibrary){?>i<?}else{?>o<?}?>l/atozworld');"><img src="/images/atozworld.png" alt="A to Z World"></a>
</p>
</div><?}

//GR AZ USA Button
function AZUButton(){global$inlibrary;?><div class="dbutton">
<a href="http://www.mfrl.org/wp/?p=1752" class="helplink"><img src="/images/icons/help.png" alt="Emily's Reference Guide" title="Emily's Reference Guide"></a> 
 
<a  class="dlink" href="http://www.atoztheusa.com/states1.asp?c=mfrl" onClick="javascript: pageTracker._trackPageview('/outgoing/<?if($inlibrary){?>i<?}else{?>o<?}?>l/atozusa');">
<span class="divspanner"></span></a>
<h2><span class="pagename">General Research</span></h2>
<h2>A to Z USA</h2>
<p style="margin-top:3px;">Covers the United States, including:
maps, photographs, cross words, 
statistics and demographics. <br>
<a class="sublink azupic" href="http://www.atoztheusa.com/states1.asp?c=mfrl" onClick="javascript: pageTracker._trackPageview('/outgoing/<?if($inlibrary){?>i<?}else{?>o<?}?>l/atozusa');"><img src="/images/atozusa.png" alt="A to Z USA"></a>
</p>
</div><?}

//GR Comp Research Button
function ComputerDButton(){global$inlibrary;?><div class="dbutton">
<a href="http://www.mfrl.org/wp/?p=2284" class="helplink"><img src="/images/icons/help.png" alt="Emily's Reference Help" title="Emily's Reference Help"></a>
<a class="dlink" href="<?if($inlibrary){?>http://infotrac.galegroup.com/itweb/va0051_002?db=cdb"
<?}else{?>online_data_redirect.php" <?}?>  onClick="javascript: pageTracker._trackPageview('/outgoing/<?if($inlibrary){?>i<?}else{?>o<?}?>l/computer.database');" >
<span class="divspanner" ></span></a>
<h2><span class="pagename">General Research</span></h2>
<h2>Computer Database</h2>
<p>Keep pace with the fast changing world of high technology. This Computer Database provides 
<a class="sublink cdpic" href="<?if($inlibrary){?>http://infotrac.galegroup.com/itweb/va0051_002?db=cdb"
<?}else{?>online_data_redirect.php" <?}?> onClick="javascript: pageTracker._trackPageview('/outgoing/<?if($inlibrary){?>i<?}else{?>o<?}?>l/computer.database');"><img src="/images/computer_database.gif" alt="<?if(!$inlibrary){?>Via Find It VA" title="Via Find It VA<?}?>" ></a>
Product reviews, industry status reports, company profiles and more. </p>
</div><?}


//GR General Reference Center Gold Button
function GRGoldButton(){global$inlibrary;?><div class="dbutton">
<a href="http://www.mfrl.org/wp/?p=865" class="helplink"><img src="/images/icons/help.png" alt="Emily's Reference Guide" title="Emily's Reference Guide"></a> 
 
<a class="dlink" href="<?if($inlibrary){?>http://infotrac.galegroup.com/itweb/va0051_002?db=grgm"
<?}else{?>online_data_redirect.php" <?}?>  onClick="javascript: pageTracker._trackPageview('/outgoing/<?if($inlibrary){?>i<?}else{?>o<?}?>l/general.reference.center.gold');">
<span class="divspanner"></span></a>
<h2><span class="pagename">General Research</span></h2>
<h2>Reference Center Gold</h2>
<p>This general interest database has an easy-to-use interface with
 <a class="sublink cdpic" href="<?if($inlibrary){?>http://infotrac.galegroup.com/itweb/va0051_002?db=grgm"
<?}else{?>online_data_redirect.php" <?}?> onClick="javascript: pageTracker._trackPageview('/outgoing/<?if($inlibrary){?>i<?}else{?>o<?}?>l/general.reference.center.gold');"><img src="/images/general_reference_center_gold.gif" alt="<?if(!$inlibrary){?>Via Find It VA" title="Via Find It VA<?}?>" ></a>
 articles from newspapers, reference books, &amp; periodicals, many with full-text and 
 images. </p>
</div><?}

//GR General OneFile Button
function GOFButton(){global$inlibrary;?><div class="dbutton">
<a href="http://www.mfrl.org/wp/?p=865" class="helplink"><img src="/images/icons/help.png" alt="Emily's Reference Guide" title="Emily's Reference Guide"></a> 
 
<a class="dlink" href="<?if($inlibrary){?>http://infotrac.galegroup.com/itweb/va0051_002?db=ITOF"
<?}else{?>online_data_redirect.php" <?}?>  onClick="javascript: pageTracker._trackPageview('/outgoing/<?if($inlibrary){?>i<?}else{?>o<?}?>l/infotrac.onefile');">
<span class="divspanner"></span></a>
<h2><span class="pagename">General Research</span></h2>
<h2>General OneFile</h2>
<p>A one-stop source for news and periodical articles on a wide 
<a class="sublink gofpic" href="<?if($inlibrary){?>http://infotrac.galegroup.com/itweb/va0051_002?db=ITOF"
<?}else{?>online_data_redirect.php" <?}?>  onClick="javascript: pageTracker._trackPageview('/outgoing/<?if($inlibrary){?>i<?}else{?>o<?}?>l/infotrac.onefile');">
<img src="/images/infotrac_onefile.gif" alt="<?if(!$inlibrary){?>Via Find It VA" title="Via Find It VA<?}?>"></a>
range of topics. Millions of full-text articles, many with images. Updated daily.
</p>
</div><?}

//Hist VA Highway Button
function VAHHighwayMButton(){global$inlibrary;?><div class="dbutton">
<a href="http://www.mfrl.org/wp/?p=1478" class="helplink"><img src="/images/icons/help.png" alt="Emily's Reference Guide" title="Emily's Reference Guide"></a> 
 
<a class="dlink" href="http://www.dhr.virginia.gov/hiway_markers/hwmarker_info.htm" onClick="javascript: pageTracker._trackPageview('/outgoing/<?echo($inlibrary?"i":"o");?>l/vaMileMarker');">
<span class="divspanner"></span></a>
<h2><span class="pagename">Genealogy &amp; History</span></h2>
<h2>Virginia Historical<br>Highway Markers</h2>
<p>
<a class="sublink vhhmpic" href="http://www.dhr.virginia.gov/hiway_markers/hwmarker_info.htm" onClick="javascript: pageTracker._trackPageview('/outgoing/<?echo($inlibrary?"i":"o");?>l/vaMileMarker');"><img src="/images/milemarker.png" alt=""></a>
Virginia's Historical Marker program is the oldest 
in the nation, beginning in 1927, and is searchable online. 
</p>
</div><?}

//Hist VA Memory Button
function VAMemButton(){global$inlibrary;?><div class="dbutton">
<a href="http://www.mfrl.org/wp/?p=1418" class="helplink"><img src="/images/icons/help.png" alt="Emily's Reference Guide" title="Emily's Reference Guide"></a> 
 
<a class="dlink" href="http://www.virginiamemory.com/"  onClick="javascript: pageTracker._trackPageview('/outgoing/<?echo($inlibrary?"i":"o");?>l/vaMemories');">
<span class="divspanner"></span></a>
<h2><span class="pagename">Genealogy &amp; History</span></h2>
<h2>Virginia Memory</h2>
<p>Provides online Digital Collections, Reading 
<a class="sublink vampic" href="http://www.virginiamemory.com/"  onClick="javascript: pageTracker._trackPageview('/outgoing/<?echo($inlibrary?"i":"o");?>l/vaMemories');">
<img src="/images/vamemory3.png" alt=""></a>
Rooms, Exhibitions &amp; Online Classrooms.
</p>
</div><?}

//Hist HDG Button
function HDGButton(){global$inlibrary;?><div class="dbutton doublew">
<a href="http://www.mfrl.org/wp/?p=1441#hdogi" class="helplink"><img src="/images/icons/help.png" alt="Emily's Reference Guide" title="Emily's Reference Guide"></a> 
 
<a class="dlink" href="http://digitool1.lva.lib.va.us:8881/R?func=collections-result&amp;collection_id=1522" onClick="javascript: pageTracker._trackPageview('/outgoing/<?echo($inlibrary?"i":"o");?>l/vaMemories.cohab');">
<span class="divspanner"></span></a>
<h2><span class="pagename">Genealogy &amp; History</span></h2>
<h2>Historical Documents of Genealogical Interest</h2>
<p><a class="sublink hdgpic" href="http://digitool1.lva.lib.va.us:8881/R?func=collections-result&amp;collection_id=1522" onClick="javascript: pageTracker._trackPageview('/outgoing/<?echo($inlibrary?"i":"o");?>l/vaMemories.cohab');"><img src="/images/register.gif" alt=""></a>
Montgomery County's Cohabitation Register has been indexed and posted in The Library of Virginia's
Virginia Memory site. Genealogists and local historians may find the content interesting.
</p>
</div><?}

//Hist Oral Button
function OralButton(){global$inlibary;?><div class="dbutton">
<a class="dlink" href="oral.php">
<span class="divspanner"></span></a>
<h2><span class="pagename">Genealogy &amp; History</span></h2>
<h2>Oral Histories</h2>
<p>Content for this is coming SOON&trade;
</p>
</div><?}

//Kids TumbleButt
function TumbleButton(){global$inlibrary;?><div class="dbutton">
<a href="http://www.mfrl.org/wp/?p=1770" class="helplink"><img src="/images/icons/help.png" alt="Emily's Reference Guide" title="Emily's Reference Guide"></a> 
 
<a class="dlink" href="http://www.tumblebooks.com/library/auto_login.asp?U=lva&amp;P=libra" onClick="javascript: pageTracker._trackPageview('/outgoing/<?echo($inlibrary?"i":"o");?>l/tumblebooks');">
<span class="divspanner"></span></a>
<h2><span class="pagename">Kids &amp; Teens</span></h2>
<h2>TumbleBooks Library</h2>
<p>
TumbleBooks are animated, talking picture 
<a class="sublink tbpic" href="http://www.tumblebooks.com/library/auto_login.asp?U=lva&amp;P=libra"><img src="/images/tumblebooksbook.png" alt=""></a>
books which teach young children the joys of reading.
</p>
</div><?}

//Kids Infobitsbutton
function InfoBButton(){global$inlibrary;?><div class="dbutton">
<a href="http://www.mfrl.org/wp/?p=1809" class="helplink"><img src="/images/icons/help.png" alt="Emily's Reference Guide" title="Emily's Reference Guide"></a> 
 
<a class="dlink" href="<?echo($inlibrary?"http://infotrac.galegroup.com/itweb/va0051_002?db=itke":"online_data_redirect.php");?>"  onClick="javascript: pageTracker._trackPageview('/outgoing/<?echo($inlibrary?"i":"o");?>l/kids.infobits');">
<span class="divspanner"></span></a>
<h2><span class="pagename">Kids &amp; Teens</span></h2>
<h2>Kid's InfoBits (K-5)</h2>
<p>Subject-based 
topic tree search and full-text, 
<a class="sublink kibpic" href="<?echo($inlibrary?"http://infotrac.galegroup.com/itweb/va0051_002?db=itke":"online_data_redirect.php");?>" onClick="javascript: pageTracker._trackPageview('/outgoing/<?echo($inlibrary?"i":"o");?>l/kids.infobits');"><img src="/images/kidsinfobits.gif" alt="" ></a>
age-appropriate reference 
content for Kindergarten through 5th grade.
</p>
</div><?}

//Kids Junior Button
function JRButton(){global$inlibrary;?><div class="dbutton">
<a href="http://www.mfrl.org/wp/?p=1890" class="helplink"><img src="/images/icons/help.png" alt="Emily's Reference Guide" title="Emily's Reference Guide"></a> 
<a class="dlink" href="<?echo($inlibrary?"http://infotrac.galegroup.com/itweb/va0051_002?db=k12j":"online_data_redirect.php");?>"  onClick="javascript: pageTracker._trackPageview('/outgoing/<?echo($inlibrary?"i":"o");?>l/junior.edition');">
<span class="divspanner"></span></a>
<h2><span class="pagename">Kids &amp; Teens</span></h2>
<h2>Junior Edition (6-8)</h2>
<p>Designed for students in junior high and middle school, with information
<a class="sublink jrepic" href="<?echo($inlibrary?"http://infotrac.galegroup.com/itweb/va0051_002?db=k12j":"online_data_redirect.php");?>"  onClick="javascript: pageTracker._trackPageview('/outgoing/<?echo($inlibrary?"i":"o");?>l/junior.edition');"><img src="/images/infotracjunior.gif" alt=""></a>
 on current events, arts, science, popular culture, health, 
people, government, history, sports and more.
</p>
</div><?}

//Kids Student Button
function SEButton(){global$inlibrary;?><div class="dbutton">
<a href="http://www.mfrl.org/wp/?p=1915" class="helplink"><img src="/images/icons/help.png" alt="Emily's Reference Guide" title="Emily's Reference Guide"></a> 
 
<a class="dlink" href="<?echo($inlibrary?"http://infotrac.galegroup.com/itweb/va0051_002?db=stom":"online_data_redirect.php");?>"  onClick="javascript: pageTracker._trackPageview('/outgoing/<?echo($inlibrary?"i":"o");?>l/student.edition');">
<span class="divspanner"></span></a>
<h2><span class="pagename">Kids &amp; Teens</span></h2>
<h2>Student Edition (9-12)</h2>
<p>Designed for high school students, with  information on current 
<a class="sublink sepic" href="<?echo($inlibrary?"http://infotrac.galegroup.com/itweb/va0051_002?db=stom":"online_data_redirect.php");?>"  onClick="javascript: pageTracker._trackPageview('/outgoing/<?echo($inlibrary?"i":"o");?>l/student.edition');"><img src="/images/infotracstudent.gif" alt=""></a>
events, the arts, science, popular culture, 
health, people, government, history, sports and more.
</p>
</div><?}

//Kids NGM Kids Button
function NGMKButton(){global$inlibrary;?><div class="dbutton">
<a href="http://www.mfrl.org/wp/?p=2498" class="helplink"><img src="/images/icons/help.png" alt="Emily's Reference Guide" title="Emily's Reference Guide"></a> 
<a class="dlink" href="<?echo($inlibrary?"http://infotrac.galegroup.com/itweb/va0051_002?db=ngmk":"online_data_redirect.php");?>"  onClick="javascript: pageTracker._trackPageview('/outgoing/<?echo($inlibrary?"i":"o");?>l/national.geographic.kids');">
<span class="divspanner"></span></a>
<h2><span class="pagename">Kids &amp; Teens</span></h2>
<h2>National Geographic Kids</h2>
<p>National Geographic Magazine for Kids 
<a class="sublink ngmkpic" href="<?echo($inlibrary?"http://infotrac.galegroup.com/itweb/va0051_002?db=ngmk":"online_data_redirect.php");?>" onClick="javascript: pageTracker._trackPageview('/outgoing/<?echo($inlibrary?"i":"o");?>l/national.geographic.kids');">
<img src="/images/ngmkicon.jpg" alt=""></a>
contains Pictures, and Full-Text Books, and Magazines. It is completely
searchable, with downloadable pictures and source citation tools.

</p>
</div><?}




?>
<html>
<head>
<title>MFRL eLibrary</title>
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
h2.buttontitle {
padding-bottom:3px;
}
.dbutton {
width:214px;
height:165px;
background:#ffeec1;
vertical-align:top;
display:inline-block;
margin:5px 0 0 5px;
padding:2px 0 2px 4px;
cursor:pointer;
position: relative;
float:left;
}

.dbutton h2{
text-align:center;
}
.dlink {
background:transparent;
}
.doublew {
width:437px;
}
.doubleh {
height:339px;
}
.doubleh .dbutton {
margin:0;
padding:0;
height:146px;
}
.clickable {
height: 100%;
  width: 100%;
  left: 0px;
  top: 0px;
  padding:5px;
  position: absolute;     
  z-index: 1;
}

.dlink a:link, .dbutton a:link{
color:black;
}
.dlink a:visited,.dbutton a:visited{
color:#222;
}
.dbutton:hover {
background:#fff2e1;
}
.dlink:hover {
background:transparent;
text-decoration:none;
}
.dbutton p:first-child {
font-weight:bold;
margin:0 3px 5px 3px;
}
.divspanner {
  position:absolute; 
  width:100%;
  height:100%;
  top:0;
  left: 0;

  /* edit: added z-index */
  z-index: 1;

  /* edit: fixes overlap error in IE7/8, 
     make sure you have an empty gif */
  background-image: url(/images/empty.gif);
}
.sublink {
position:relative;
z-index:2;
margin:10px;
}
.helplink{
z-index:3;
float:right;
position:relative;
}
a.helplink{
border:1px solid transparent;
}
.helplink img{
margin:0;
}

a.helplink:hover{
background:white;
border:1px solid white;
}

a.sublink {
display:inline-block;
border:1px solid transparent;
}
a.sublink:hover {
background:white;
border:1px solid white;
}

.ocdpic {
margin-left:-8px;
margin-top:0;
}
.ziniopic {
margin-left:55px;
}
.odpic {
margin-left:20px;
margin-top:0;
}

.ocdpic img {
margin-top:5px;
}
.mangopic img {
margin-top:0;
}
a.mangopic {
margin-top:0;
}

.ucpic img {
margin-top:0;
height:55px;
}
.bbpic img {
margin-top:0;

}
a.bbpic {
margin-left:25px;
}
.eaapic img {
margin:0;
}
a.eaapic {
float:right;
}
.quotepic img {
margin:0;
}
a.quotepic {
float:right;
}
.shpic img {
margin:0;
}
a.shpic {
margin-left:45px;margin-top:3px;
}
a.elibpic{
margin-left:25px;margin-top:3px;
}
a.ebscopic {
margin:0;
margin-left:69px;
}
a.heripic{
margin:0; margin-left:35px;
}
.foldpic img{margin:0;}
a.foldpic{
margin:0; margin-left:30px;margin-top:3px;
}
img.grpic {
margin:0;float:right;
margin-right:5px;
}
.azwpic img {
margin:0;

}
a.azwpic {
margin-left:40px;margin-top:0px;
}
.azupic img{
height:60px;
margin:0;
}
a.azupic {
margin-left:65px;
margin-top:0;
}
.cdpic img{
margin:0;
}
a.cdpic {
float:right;
}
.gofpic img{
margin:0;
}
a.gofpic {
float:right;
}
.vhhmpic img {
margin:0;
height:75px;
}
a.vhhmpic{
float:right;
}
.vampic img{
margin:0;
}
a.vampic{
float:right;
}
.hdgpic img{
margin:0;
height:105px;
}
a.hdgpic{
float:right;
}
.tbpic img{
margin:0;
height:85px;
}
a.tbpic{
float:right;
}
.kibpic img{
margin:0;
}
a.kibpic{
float:right;
}
.jrepic img{
margin:0;
}
a.jrepic{
float:right;
}
.sepic img{
margin:0;
}
a.sepic{
float:right;
}
.ngmkpic img{
margin:0;
}
a.ngmkpic{
float:right;
}
h2 img{
float:right;
margin:5px;
}
.freadpic img{
margin:0;
}
a.freadpic{
float:right;
}
a.mmmpic{margin-left:60px;}

</style>
<script type="text/javascript">
	$(document).ready(function(){
		jQuery('ul.sf-menu').superfish({
			pathClass: 'current'
		});
	});
</script>
<link rel="icon" type="image/png" href="/favicon.png">
</head>
<body>

<div id="wrap">
    <div id="header"><?include'xxxheader.php';?></div>
	<div id="menucont"><?include'xxxmenu.php';?></div>
	<div id="maincontent">
		<div id="leftmenu">
			<?include'menu.elib.php';?>				
		</div> <!-- End Menu col -->
		<div id="fullrightcol">
			<div class="pagediv">
<h1>Your Library Online</h1>
<h2>MFRL is open 24 hours a day on the web!</h2>
<!--
<div style="background:white; border:2px solid green;"><h2>DEBUG:</h2>
<p>Viewing as [<?echo($inlibrary?"IN":"OUT");?>] 
<a href="?looks=0">OUT</a> | <a href="?looks=1">IN</a></p>
</div>-->
<p>When you use our <a href="online.php?cat=db">databases</a>, you have available many more 
reference sources, magazines, and periodicals than we could possibly provide in print format.</p>
<p>Our <a href="online.php?cat=resource">Online Resources</a> provide a suite of unmatched 
tools including Language Classes, Online Education, Homework Help, Audiobook Downloads and more, 
all for free!</p>
<p>There is no charge for using your online library. Choose a category from the menu on the 
left to get started, or browse the library's entire list of 
<a href="online.php?cat=all">Online Resources and Databases</a>.</p>
<p>If you are outside of the library you may need to verify that you are a library patron. 
If you are not automatically authorized, you may need to enter your 14 digit library 
card number to access the databases. Any special instructions will appear at the top 
of the page for each database.</p>


<?if(($subcat=="all")|($subcat=="resource")|($subcat=="dl")) 
	{ODButton(); OCD2Button();  mmmButton(); hooButton(); }?>
<?if(($subcat=="all")|($subcat=="resource")|($subcat=="books")) 
	{BBrowseButton();}?>
<?if(($subcat=="all")|($subcat=="resource")|($subcat=="dl")) {
	ZinioButton(); FreadingButton();}?> 	
<?if(($subcat=="all")|($subcat=="resource")|($subcat=="uniclass")|($subcat=="learn")) 
	UCButton();?>
<?if(($subcat=="all")|($subcat=="resource")|($subcat=="lang")|($subcat=="learn")) 
	MangoButton();?>	
<?if(($subcat=="all")|($subcat=="resource")|($subcat=="credo")|($subcat=="research")|($subcat=="learn")) 
	LiteratiButton();?>
<?if(($subcat=="all")|($subcat=="resource")|($subcat=="career"))
	CRButton();?>	
<?if(($subcat=="all")|($subcat=="db")|($subcat=="research")) 
	EAASAPButton();?>
<?if(($subcat=="all")|($subcat=="db")|($subcat=="quotes")) 
	QuoteButton();?>
<?if(($subcat=="all")|($subcat=="db")|($subcat=="health")) 
	HealthButton();?>
<?if(($subcat=="all")|($subcat=="db")|($subcat=="econtent")) {
	ElibButton(); EbscoBooksButton(); }?>	
<?if(($subcat=="all")|($subcat=="db")|($subcat=="genes")) {
	FoldButton(); HeriButton();	VAHHighwayMButton();}?>

<?if(($subcat=="all")|($subcat=="db")|($subcat=="research")) {
	InfotracButton();		ComputerDButton();	GRGoldButton();	GOFButton();	}?>
<?if(($subcat=="oral"))
	 OralButton();?>
<?if(($subcat=="all")|($subcat=="db")|($subcat=="genes")) {
	VAMemButton();	 HDGButton(); 				}?>
<?if(($subcat=="all")|($subcat=="db")|($subcat=="kids")){
	TumbleButton();	InfoBButton();	JRButton();	SEButton();	NGMKButton();	}?>



<div style="clear:both;"></div>

			</div>
		</div> <!-- end right col -->
    </div>
<div style="clear:both;"></div>
    <div id="footer"><?include'xxxfooter.php';?></div>
</div>
</body>
</html>