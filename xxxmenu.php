<?
function cactive($cpage,$page){
if((($cpage=="home")||($cpage=="hours")||($cpage=="books")||($cpage=="teens")||($cpage=="kids"))&&($cpage==$page)) {echo "active"; return;}
if($cpage==$page) echo " class=\"active\"";
}
switch ($currentpage){
	case "about.php":$current="about";break;
	case "director.php":$current="about";$subcat="director";break;
	case "boardoftrustees.php":$current="about";$subcat="board";break;
	case "policy.php":$current="about";$subcat="policy";break;
	case "employment.php":$current="about";$subcat="jobs";break;
	case "mfrlfoundation.php":$current="about";$subcat="foundation";break;
	case "fol.php":$current="about";$subcat="fol";break;
	case "contact.php":$current="about";$subcat="contact";break;
	case "calendar.php":$current="calendar";break;
	case "programs.php":$current="calendar";$subcat="programs";break;
	case "events.php":$current="calendar";$subcat="events";break;
	case "classes.php":$current="calendar";$subcat="class";break;
	case "teens.php":$current="teens";break;
	case "kids.php":$current="kids";break;
	case "services.php":$current="services";break;
	case "seniors.php":$current="services";$subcat="seniors";break;
	case "booksbymail.php":$current="services";$subcat="bbm";break;
	case "ask.php":$current="services";$subcat="aal";break;
	case "reservearoom.php":$current="services";$subcat="rar";break;
	case "reserveacomputer.php":$current="services";$subcat="rac";break;
	case "index.php":$current="home";break;
	case "demopage.php":$current="elib";break;
	case "books.php":$current="books";break;
	case "talkingaboutbooks.php":
    case "bookclubs.php":$current="books";$subcat="bookclub";break;
	case "goodbooks.php":$current="books";$subcat="goodbook";break;
	case "new_fiction.php":$current="books";break;
	case "online.php":$current="elib";break;
	case "databases.php":$current="elib";$subcat="db";break;
	case "resources.php":$current="elib";$subcat="resources";break;
	case "oral.php":$current="elib";$subcat="oral";break;
	case "hours.php":$current="hours";break;
	case "overdrive.php":$current="books";break;
	case "catalog.php":$current="books";if($cat=="renew"){$subcat="myaccount";} break;
	case "proctoring.php":$current="services";$subcat="proc";break;
	case "assignalertform.php":	case "teenbookreview.php":	case "schoolvisitform.php":	case "librarytourform.php":$current="kids";break;
	case "payonline.php": $current="services";$subcat="pay";break;
		$current="cat";
		break;
	}
?>
<div style="clear:both;"></div>
<div class="menucont">
<!-- 	change to the below WHENLIVE 
					  <a href="/" class="current"
-->
    <div class="home <?cactive($current,"home");?>"><a href="index.php" class="current " title="Home"><img src="http://www.mfrl.org/images/icons/library-home-24.png" alt="Home"></a></div>
<nav id="nav" role="navigation">
<ul class="sf-menu sf-navbar">
        
    <li class="<?cactive($current,"books");?> books"><a href="catalog.php?cat=circpolicy">Books &amp; Materials</a>

        <ul>
            <li><a href="http://cat.mfrl.org/uhtbin/cgisirsi.exe/x/0/0/49" title="Visit our Online Catalog">Catalog</a>
            </li>
            <li><a href="catalog.php?catmenu=renew" title="Login to your account">My Account</a>
            </li>
            <li><a href="online.php?cat=books" title="Book Reviews, Read-a-likes, Author interviews and more">BookBrowse</a>
            </li>
            <li><a href="bookclubs.php" title="See what we're reading, and join in.">BookClubs</a>
            <li><a href="goodbooks.php" title="Feel the need? The need to Read? We can help.">Looking For A Good Book</a>
            </li>
            <li class="bottom"></li>
        </ul>
    </li>
	<li class="<?cactive($current,"hours");?> hours"><a href="hours.php">Hours</a>
		<ul>
			<li><a href="hours.php?branch=b">Blacksburg</a></li>
			<li><a href="hours.php?branch=c">Christiansburg</a></li>
			<li><a href="hours.php?branch=f">Floyd</a></li>
			<li><a href="hours.php?branch=m">Meadowbrook</a></li>
			<li class="bottom"> </li>
			
		</ul>
    <li<?cactive($current,"elib");?>><a href="online.php">eLibrary</a>

        <ul>
            <li><a href="online.php?cat=db">Databases</a>
            </li>
            <li><a href="online.php?cat=resource">Resources</a>
            </li>
            <li><a href="online.php?cat=dl">OverDrive</a>
            </li>
            <li><a href="online.php?cat=dl">Freading</a>
            </li>
            <li><a href="oral.php">Oral Histories</a>
            </li>
   <li class="bottom"> </li>

        </ul>
    </li>
    <li<?cactive($current,"services");?>><a href="services.php">Services</a>

        <ul>
            <li<?cactive($current,"seniors");?>><a href="seniors.php">Seniors</a>
            </li>
            <li<?cactive($current,"bbm");?>><a href="booksbymail.php">Books by Mail</a>
            </li>
			<li<?cactive($current,"proc");?>><a href="proctoring.php">Proctoring</a>
			</li>
            <li<?cactive($current,"aal");?>><a href="ask.php">Ask a Librarian</a>
            </li>
            <li<?cactive($current,"rar");?>><a href="reservearoom.php">Meeting Rooms</a>
            </li>
            <li<?cactive($current,"rac");?>><a href="reserveacomputer.php">Reserve a Computer</a>
            </li>
            <li<?cactive($current,"pay");?>><a href="payonline.php">Bill Payments</a>
            </li>
   <li class="bottom"></li>

        </ul>
    </li>
    <li class="kids <?cactive($current,"kids");?>" ><a href="kids.php?service=kidsbooks">Kids</a>
    </li>
    <li class="teens <?cactive($current,"teens");?>"><a href="teens.php">Teens</a>
           
    </li>
    <li<?cactive($current,"calendar");?>><a href="calendar.php">Calendar</a>

        <ul>
			<li><a href="programs.php">Programs</a>
            </li>
            <!--<li><a href="events.php">Events</a></li>-->
            <li><a href="classes.php">Classes</a>
            </li>
   <li class="bottom"> </li>

        </ul>
    </li>
    <li<?cactive($current,"about");?>><a href="about.php">About</a>

        <ul>
            <li><a href="director.php">Director</a>
            </li>
            <li><a href="boardoftrustees.php">Board of Trustees</a>
            </li>
            <li><a href="/pdf/mfrlorgchart2015.pdf"  onClick="javascript: pageTracker._trackPageview('/outgoing/<?if ($inlibrary) echo"i"; else echo"o"; ?>l/organization.chart');">Organization Chart</a></li>
            <li><a href="policy.php">Policies</a>
            </li>
            <li><a href="employment.php">Employment</a>
            </li>
            <li><a href="mfrlfoundation.php">MFRL Foundation</a>
            </li>
            <li><a href="fol.php">Friends of the Library</a>
            </li>
            <li><a href="contact.php">Contact Us</a>
            </li>
   <li class="bottom"> </li>

        </ul>
    </li>
</ul>
</nav>
        </div><div style="clear:both;"></div>