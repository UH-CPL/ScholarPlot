<?php
    $dbhost = "localhost";
    $dbuser = "kyeongan";
    $dbpass = "KwonCpl2013";
    $dbname = "kyeongan";

	$conn=mysql_connect($dbhost, $dbuser, $dbpass) or die("unable to connect to database.");
    
	mysql_select_db($dbname) or die ("Unable to select");
?>
