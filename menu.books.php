<ul id="newvnav">
	<li class="textBrowsersOnly"><a href="#endOfNav">Skip navigation</a> </li>
	<!--<li<?if($subcat=="books")		{?> id="urhere"<?}?> ><a href="books.php">Books &amp; Materials</a></li>-->
	<li><a href="http://cat.mfrl.org/uhtbin/cgisirsi.exe/x/0/0/49" onClick="javascript: pageTracker._trackPageview('/outgoing/<?echo($inlibrary?"i":"o");?>l/ocat');">Online Catalog</a></li>
	<li<?if($subcat=="myaccount")	{?> id="urhere"<?}?> ><a href="catalog.php?cat=renew">My Account</a></li>
	<li><a href="online.php?cat=books">BookBrowse</a></li>
	<li<?if($subcat=="bookclub"){?> id="urhere"<?}?>><a href="bookclubs.php">Book Clubs</a></li>
	<li<?if($subcat=="goodbook"){?> id="urhere"<?}?>><a href="goodbooks.php">Looking for a<br> Good Book</a></li>
</ul>