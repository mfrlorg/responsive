<? // This should be TRUE for the test server and FALSE for the PROD server.
if(1==2) { 
$server = "test";
echo "<a href=\"http://www.mfrl.org";
$uri = $_SERVER['REQUEST_URI'];
$uri = str_replace('&','&amp;',$uri);
echo $uri;
echo "\">BEV LIVE SERVER</a>
";}
?>