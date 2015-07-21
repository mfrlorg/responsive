<?
// Display next board meeting.
function nextmeeting($leadtime="") {
	global $currentpage;
	global $server;
	global $post;
	// This should be set to the FIRST meeting in the array. Keep in ORDER. Do not skip numbers. 
	// Blank entries are mostly okay, but BRANCH is required!
	$meetcount =0;
	$meetingdates[0]=array ( date=> "20140820",
								link => "https://www.google.com/calendar/event?eid=YjM0azU3OWUwajM3YjY1MmJqYnZtMnUyYWcgYzJ2N2Zxa2hrYzQyZm0yNXMxNDVnbzZjYWdAZw&ctz=America/New_York",
								branch => "c",
								mtime => "7pm"
							);
	$meetingdates[1]=array ( date=> "20140917",
								link => "https://www.google.com/calendar/event?eid=bm83dWpibTI1NGwxNTJyb285bnRpZ2s4NGMgZmJrbGV0Z2pkdDkzZzMyN2dldTdqb2l0ZTRAZw&ctz=America/New_York",
								branch => "b",
								mtime => "7pm"
							);
							
	$meetingdates[2]=array ( date=> "20141015",
								link => "https://www.google.com/calendar/event?eid=aDJ1cXFpOGFtdGpsOTY2ZDB2ZzJiZGowa2MgMW84OWc1YXA2bzFoZmI4ZThxYmdhMzlncGdAZw&ctz=America/New_York",
								branch => "f",
								mtime => "7pm"
							);
							
	$meetingdates[3]=array ( date=> "20141217",
								link => "https://www.google.com/calendar/event?eid=aTVvcW1xbTA3NWhjc2tjN285czNhaDA5NWMgNGswOWo2anE3c3M2b29lM3A5NjFydGdyZmdAZw&ctz=America/New_York",
								branch => "m",
								mtime => "7pm"
							);
							
	$meetingdates[4]=array ( date=> "20150121",
								link => "https://www.google.com/calendar/event?eid=a2JtNXFtNmhtZHFnYWdvc29rZGM0bXIxbjRfMjAxNTAxMjJUMDAwMDAwWiBjMnY3ZnFraGtjNDJmbTI1czE0NWdvNmNhZ0Bn&ctz=America/New_York",
								branch => "c",
								mtime => "7pm"
							);
							
	$meetingdates[5]=array ( date=> "20150225",
								link => "https://www.google.com/calendar/event?eid=ZThjcTdxMGttNmw5N3IwdjlnMHJkb2dnYjQgYzJ2N2Zxa2hrYzQyZm0yNXMxNDVnbzZjYWdAZw",
								branch => "c",
								mtime => "7pm"
							);
							
	$meetingdates[6]=array ( date=> "20150318",
								link => "https://www.google.com/calendar/event?eid=a2JtNXFtNmhtZHFnYWdvc29rZGM0bXIxbjRfMjAxNTAzMThUMjMwMDAwWiBjMnY3ZnFraGtjNDJmbTI1czE0NWdvNmNhZ0Bn&ctz=America/New_York",
								branch => "c",
								mtime => "7pm"
							);
							
	$meetingdates[7]=array ( date=> "20150415",
								link => "https://www.google.com/calendar/event?eid=czl2aTBwMjF2ZmoxdnJ1dWlpZWI5cDU0NHMgMW84OWc1YXA2bzFoZmI4ZThxYmdhMzlncGdAZw",
								branch => "f",
								mtime => "7pm"
							);
	$meetingdates[8]=array ( date=> "20150520",
								link => "https://www.google.com/calendar/event?eid=a2JtNXFtNmhtZHFnYWdvc29rZGM0bXIxbjRfMjAxNTA1MjBUMjMwMDAwWiBjMnY3ZnFraGtjNDJmbTI1czE0NWdvNmNhZ0Bn&ctz=America/New_York",
								branch => "c",
								mtime => "7pm"
							);
							
	$meetingdates[9]=array ( date=> "20150617",
								link => "https://www.google.com/calendar/event?eid=NDEwaTF2dmlxMW10ZnRlZzA3M2twNGJwcjQgNGswOWo2anE3c3M2b29lM3A5NjFydGdyZmdAZw",
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
