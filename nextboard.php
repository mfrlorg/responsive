<?
// Display next board meeting.
function nextmeeting($leadtime="") {
	global $currentpage;
	global $server;
	global $post;
	// This should be set to the FIRST meeting in the array. Keep in ORDER. Do not skip numbers.
	// Blank entries are mostly okay, but BRANCH is required!
	$meetcount =0;

$meetingdates[0]=array ( date=> "20150819",
								link => "https://www.google.com/calendar/event?eid=MjBxbzBqZ2I3aG1yYjFrMXNpMDljb20wMXMgNGswOWo2anE3c3M2b29lM3A5NjFydGdyZmdAZw&ctz=America/New_York",
								branch => "m",
								mtime => "7pm"
);

$meetingdates[1]=array ( date=> "20150916",
								link => "https://www.google.com/calendar/event?eid=NjQxZzkxOGl0bTNiOGw1dW9iOTYwY2MzYTAgZmJrbGV0Z2pkdDkzZzMyN2dldTdqb2l0ZTRAZw&ctz=America/New_York",
								branch => "b",
								mtime => "7pm"
);
$meetingdates[2]=array ( date=> "20151021",
								link => "https://www.google.com/calendar/event?eid=ZGc3Zm5xaDZrOWE3N2czN2JubjFqczB0bW8gMW84OWc1YXA2bzFoZmI4ZThxYmdhMzlncGdAZw&ctz=America/New_York",
								branch => "f",
								mtime => "7pm"
);
$meetingdates[3]=array ( date=> "20151216",
								link => "https://www.google.com/calendar/event?eid=c2o0NnAyNGRhZ2VzczdvNWwzNWgwaHRpZHMgYzJ2N2Zxa2hrYzQyZm0yNXMxNDVnbzZjYWdAZw&ctz=America/New_York",
								branch => "c",
								mtime => "7pm"
);
$meetingdates[4]=array ( date=> "20160120",
								link => "https://www.google.com/calendar/event?eid=NDNyOWhpZjNrNXVpbmRpbGU4YjNlcWEwY28gYzJ2N2Zxa2hrYzQyZm0yNXMxNDVnbzZjYWdAZw&ctz=America/New_York",
								branch => "c",
								mtime => "7pm"
);
$meetingdates[5]=array ( date=> "20160217",
								link => "https://www.google.com/calendar/event?eid=MGwxa2ZqbjJpdTYyZ2szNzF2Zmw2bjExMDAgZmJrbGV0Z2pkdDkzZzMyN2dldTdqb2l0ZTRAZw&ctz=America/New_York",
								branch => "b",
								mtime => "7pm"
);
$meetingdates[6]=array ( date=> "20160316",
								link => "https://www.google.com/calendar/event?eid=MGNmdXQ3cnMzaWhjazg4czlsdGdmczM5cjggYzJ2N2Zxa2hrYzQyZm0yNXMxNDVnbzZjYWdAZw&ctz=America/New_York",
								branch => "c",
								mtime => "7pm"
);
$meetingdates[7]=array ( date=> "20160420",
								link => "https://www.google.com/calendar/event?eid=ODlhODNyZG5zdDAwdHJicDQzMjgxZHYwa28gYzJ2N2Zxa2hrYzQyZm0yNXMxNDVnbzZjYWdAZw&ctz=America/New_York",
								branch => "c",
								mtime => "7pm"
);
$meetingdates[8]=array ( date=> "20160518",
								link => "https://www.google.com/calendar/event?eid=dmR2cm1zdWR2Ymc2cGVzcWU5bXNvMnM2dW8gYzJ2N2Zxa2hrYzQyZm0yNXMxNDVnbzZjYWdAZw&ctz=America/New_York",
								branch => "c",
								mtime => "7pm"
);
$meetingdates[9]=array ( date=> "20160615",
								link => "https://www.google.com/calendar/event?eid=cDJubmQ0cmkwNWJpMWM5bGpzN2ZiMTJibG8gNGswOWo2anE3c3M2b29lM3A5NjFydGdyZmdAZw&ctz=America/New_York",
								branch => "m",
								mtime => "7pm"
);



	$meetingerror="error";
if (($currentpage=="index.php")||($currentpage=="boardoftrustees.php")) {
	if (($_REQUEST['futuredate']=="today")||($_REQUEST['futuredate']=='')) {	$curdate = mktime(0,0,0,date("m"),date("d"),date("Y")); }
	else {$curdate = mktime(0,0,0,substr($_REQUEST['futuredate'],0,2),substr($_REQUEST['futuredate'],3,2),substr($_REQUEST['futuredate'],6,4));}
	} else {$curdate = mktime(0,0,0,$month,$day,$year);}
	while ($meetingdates[$meetcount]['branch']!="") {
		$datetemp = $meetingdates[$meetcount]['date'];
		$yeartemp = substr($datetemp,0,4);
		$monthtemp = substr($datetemp,4,2);
		$daytemp = substr($datetemp,6,2);
		$nextmeeting = mktime(0,0,0,$monthtemp,$daytemp,$yeartemp);

		if ($leadtime!="") { $leaddate=$curdate+$leadtime;

		}
		if ((($leadtime!="")&&(($nextmeeting >= $curdate)&&($leaddate >= $nextmeeting)))||(($leadtime=="")&&($nextmeeting >= $curdate)))		{
		if (($currentpage=="index.php")||($currentpage=="newindex.php")) {echo "<p class=\"bluefirst\">Board of Trustees Meeting<br>";}

			echo " The next meeting will be held at the ";
			switch ($meetingdates[$meetcount]['branch']) {
			case "b":	echo "Blacksburg";		break;
			case "c":	echo "Christiansburg";	break;
			case "f":	echo "Floyd";			break;
			case "m":	echo "Meadowbrook";		break;
			default:	echo "Unknown";	break;
			}
			if ($meetingdates[$meetcount]['link']==''){
				echo " Branch on <a href=\"activities.php?showday=".$datetemp."\">".date("l, F j Y",$nextmeeting)."</a>"; $meetingerror="";
				}else {
					$linktmp=str_replace("&","&amp;",$meetingdates[$meetcount]['link']);

				echo " Branch on <a href=\"".$linktmp."\">".date("l, F j Y",$nextmeeting)."</a>"; $meetingerror="";
				}
			if ($meetingdates[$meetcount]['mtime']!=''){echo "<b> at ".$meetingdates[$meetcount]['mtime']."</b>"; }
			echo ". ";
if ($server!="test") {
$args = array(
		'numberposts' => 1,

		'category' => 29 );
$lastposts = get_posts($args);
}
// spit out content of the post(s)
echo "View the ";
if ($server=="test") {echo "AGENDA on the production server."; }
else foreach($lastposts as $post) {
    setup_postdata($post);
    echo "<a href=\"";
    the_permalink();
    echo "\">";
    the_title();
    echo "</a>.";
}			break;

			if (($currentpage=="index.php")||($currentpage=="newindex.php")) {echo "</p>";}
			}
		else	{
			$meetcount++;
			}

		//  in the <a href=\"\">future</a>.";
		}
		if (($leadtime=="")&&($meetingerror!="")) echo "ERROR: Future Schedule not found.<br>";
	}
	?>
