<script type="text/javascript">
var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
document.write(unescape("%3Cscript src='" + gaJsHost + "google-analytics.com/ga.js' type='text/javascript'%3E%3C/script%3E"));
</script>
<script type="text/javascript">
try {
var pageTracker = _gat._getTracker("UA-7456328-1");
pageTracker._trackPageview();
} catch(err) {}</script>

<?$textfile = 'marquee_text.txt';
$scriptfile = 'inc/js/marquis.js';
if (file_exists($textfile) && file_exists($scriptfile)) $marquis=true;
if($marquis){?><script type="text/javascript" src="/inc/js/marquis.js"></script>
<script type="text/javascript"> $(document).ready(function(){
$('marquee').marquee('.newmarquee').mouseover(function () {
		$(this).trigger('stop');
		}).mouseout(function () {
  $(this).trigger('start');
}).mousemove(function (event) {
  if ($(this).data('drag') == true) {
    this.scrollLeft = $(this).data('scrollX') + ($(this).data('x') - event.clientX);
  }
}).mousedown(function (event) {
  $(this).data('drag', true).data('x', event.clientX).data('scrollX', this.scrollLeft);
}).mouseup(function () {
  $(this).data('drag', false);});
});</script>
<?}?>
<!-- *******************************************************************************
****	Web site coded and maintained by Yanni Cooper (2006-current).  			****
****	Pages are written in HTML 5 and CSS3 where possible with attention to 	****
****	graceful failure for users with older browsers.							****
******************************************************************************** -->
<div id="skip"><a href="#fullrightcol">Skip to Main Content</a></div>
<div id="logo">
    <a href="../index.php"><img src="../images/forweb.png" alt="MFRL" height="107" width="291"></a>
</div>
<!-- Search Box
<div id="searchandserve">
	<div id="searchbox">
		<form method="post" action="http://cat.montgomery-floyd.lib.va.us/uhtbin/cgisirsi.exe/x/CBURG/0/57/5" >
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
</div>-->
<!-- <div id="spacer"> -->
<!-- <div id="font-sizer"><a href="#" class="smaller" id="font_smaller" title="Smaller Text">A</a>
					 <a href="#" class="normal" id="font_normal" title="Normal Text">A</a>
					 <a href="#" class="bigger" id="font_larger" title="Larger Text">A</a> </div>-->
<?include 'prodlink.php';?>&nbsp;
<!-- Marquee include starts here --><?
if ($marquis) { include'marquee_text.txt'; }  else { if ($_REQUEST['img']!='') $img="?img=".$_REQUEST['img'];?><div id="headphoto" >
<?if($server=="test") {?>
<div style="float:left; height: 81px; color:#c03; font-size:55px; font-weight:bold; line-height:70px; width:779px; display:block; background:#efe; padding-left:45px;">Dreamy Test</div>
<?} else {?>
	<img src="/images/deaderphotos/rotate.php<?echo$img;?>" alt="One Stop, Unlimited Possibilities"> <?}?>
</div> <?}?>
