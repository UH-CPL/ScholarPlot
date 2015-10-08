<?php

	$conn = mysql_connect("kyeongan.cpl.uh.edu", "kview", "B9j8iTbA");
	mysql_select_db("kyeongan", $conn);
	$keyword = $_GET["term"];

	$return = array();
	$query = mysql_query("SELECT google_id, name, school FROM scholar_autocomplete WHERE name like '%$keyword%' ORDER BY google_id ASC LIMIT 0, 10");

	while ($row = mysql_fetch_array($query))
	{
		array_push($return,array('gid'=>$row['google_id'],'name'=>$row['name']));
	}
	
	echo(json_encode($return));
	
?>