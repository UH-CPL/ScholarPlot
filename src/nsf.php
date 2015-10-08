<?php
 
	header( 'Content-Type: application/json;' ); 

	// error_reporting(E_ALL);
	// ini_set( 'display_errors','1');

//	echo $_GET['firstname'];
//	echo $_GET['lastname'];

	$firstname = $_GET['firstname'];
	$lastname = $_GET['lastname'];
	
	$middleInitial = $_GET['middleInitial'];
	$firstname_M = "";
	$M_firstname = "";


	if (!empty($middleInitial))
	{
		$firstname_M = $firstname.' '.$middleInitial.'%';
		$M_firstname = $middleInitial.'% '.$firstname;
	}
	

	// we connect to kyeongan.cpl.uh.edu and port 3306
	$link = mysql_connect('kyeongan.cpl.uh.edu:3306', 'kview', 'B9j8iTbA');
	if (!$link) {
		die('Could not connect: ' . mysql_error());
	}
//	echo 'Connected successfully';

	mysql_select_db("kyeongan");





	$query = "
	SELECT year as Year, ROUND(sum(amount/1000000),2) as SumOfYear
	FROM (
			SELECT award_id, firstname, lastname, role 
			FROM nsf_awardinvestigators
			WHERE lastname = '".$lastname."' and (firstname like '".$firstname_M."' OR firstname like '".$M_firstname."' OR firstname = '".$firstname."')
		) a, nsf_award b
	WHERE a.award_id = b.id and b.amount > 0
	GROUP BY year
	ORDER BY year asc
	";

	$result = mysql_query($query);
	

	while ($row = mysql_fetch_array($result, MYSQL_BOTH)) {

		$summary[] = array(
			  'Year' => $row['Year'],
			  'SumOfYear' => $row['SumOfYear']
		   );

	}







	$query = "
	SELECT id as AwardID, CONCAT('$',FORMAT(amount,0)) as AwardAmount, firstname as FirstName, lastname as LastName, CASE role WHEN 'CI' then 'Co-PI' WHEN 'FI' then 'Former PI' else 'PI' end as Role, year as Year
		FROM (
			SELECT award_id, firstname, lastname, role 
			FROM nsf_awardinvestigators
			WHERE lastname = '".$lastname."' and (firstname like '".$firstname_M."' OR firstname like '".$M_firstname."' OR firstname = '".$firstname."')
		) a, nsf_award b
		WHERE a.award_id = b.id and b.amount > 0
		ORDER BY year asc, b.id asc
	";

	$result = mysql_query($query);
	

	while ($row = mysql_fetch_array($result, MYSQL_BOTH)) {
		//printf ("AwardID: %s  AwardAmount: %s Firstname: %s, Lastname: %s, Role: %s, Year: %s \n", $row[0], $row[1], $row[2], $row[3], $row[4], $row[5]);

		$details[] = array(
			  'AwardID' => $row['AwardID'],
			  'AwardAmount' => $row['AwardAmount'],
			  'Firstname' => $row['FirstName'],
			  'Lastname' => $row['LastName'],
			  'Role' => $row['Role'],
			  'Year' => $row['Year']
		   );

	}





	$results = array(
		"Summary" => $summary,
		"Details" => $details
	);

	
//	echo json_encode($results);

	print $_GET['jsoncallback']. '('.json_encode($results).')';

//	echo json_encode($results);



	mysql_close($link);


?>