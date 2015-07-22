<?php $rem_address = getenv('REMOTE_ADDR'); 
switch ($rem_address) {
case '72.66.191.77':
case '66.37.66.139':
$inlibrary = true;
$currentbranch = "Blacksburg";
$county = "Montgomery";
break;
case '72.66.191.76':
case '66.37.66.140':
$inlibrary = true;
$currentbranch = "Christiansburg";
$county = "Montgomery";
break;
case '72.66.191.78':
case '75.146.22.249':
case '66.37.66.141':
$inlibrary = true;
$currentbranch = "Meadowbrook";
$county = "Montgomery";
break;
case '66.37.67.17':
case '66.37.66.138':
case '66.37.67.18':
case '66.37.67.19':
$inlibrary = true;
$currentbranch = "Floyd";
$county = "Floyd";
break;
default:
$inlibrary = false;
$currentbranch = "Blacksburg";
$county = "Montgomery";
break;
}
?>

