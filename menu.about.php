<ul id="newvnav">
	<li class="textBrowsersOnly"><a href="#endOfNav">Skip navigation</a> </li>

	<li<?if($subcat=="director")	{?> id="urhere"<?}?> ><a href="director.php">Director</a></li>
	<li<?if($subcat=="board") {?> id="urhere"<?}?> ><a href="boardoftrustees.php">Board of Trustees</a></li>
	<li><a href="/pdf/mfrlorgchart2015.pdf"  onClick="javascript: pageTracker._trackPageview('/outgoing/<?if ($inlibrary) echo"i"; else echo"o"; ?>l/organization.chart');">Organization Chart</a></li>
	<li<?if($subcat=="policy") {?> id="urhere"<?}?> ><a href="policy.php">Policies</a></li>
	<li><a href="pdf/annual_report_1314.pdf" onClick="javascript: pageTracker._trackPageview('/outgoing/<?if ($inlibrary) echo"i"; else echo"o"; ?>l/annual.report');">Annual Report<br>2013-2014</a></li>
	<li><a href="pdf/Strategic_Plan_2013-2018.pdf" onClick="javascript: pageTracker._trackPageview('/outgoing/<?if ($inlibrary) echo"i"; else echo"o"; ?>l/strategic.plan');">Strategic Plan<br>2013-2018</a></li>
	<li<?if($subcat=="jobs") {?> id="urhere"<?}?> ><a href="employment.php">Employment</a></li>
	<li<?if($subcat=="foundation")		{?> id="urhere"<?}?>><a href="mfrlfoundation.php">MFRL Foundation</a></li>
	<li<?if($subcat=="fol")			{?> id="urhere"<?}?>><a href="fol.php">Friends of the Library</a></li>
	<li<?if($subcat=="contact")		{?> id="urhere"<?}?>><a href="contact.php">Contact Us</a></li>
</ul>