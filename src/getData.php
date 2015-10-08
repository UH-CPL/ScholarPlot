<?php

	// date_default_timezone_set('America/Chicago');
	// $startTime = new DateTime();

	// error_reporting(E_ALL); 
	// ini_set( 'display_errors','1');

	ini_set('max_execution_time', 180);

	header( 'Content-Type: html/text;' ); 

	// Script URL = http://times-web-host.times.uh.edu/cpl/projects/scholar/ScholarPlot-Web/scholar/trial.php

	$google_id = $_GET["gid"];
	$service = $_GET["service"];	// If if 1 is iOS.

	//$gURL = "http://kyeongan.cpl.uh.edu/projects/scholarplot/src/get_data_300w.php?gid=" . $google_id;
	// $gURL = "http://www2.cs.uh.edu/~kyeongan/scholar/GET_DATA_300w.php?gid=" . $google_id;
	$gURL = "http://kyeongan.cpl.uh.edu/projects/scholarplot/src/GET_DATA_300w.php?gid=" . $google_id;

	$curl = curl_init();
	// Set some options - we are passing in a useragent too here
	curl_setopt_array($curl, array(
	    CURLOPT_RETURNTRANSFER => 1,
	    CURLOPT_URL => $gURL
	));
	// Send the request & save response to $resp
	$jsonGoogle = curl_exec($curl);
	
	// Close request to clear up some resources
	curl_close($curl);

	// $jsonGoogle = file_get_contents($gURL);
	$objGoogle = json_decode($jsonGoogle);
	$obtainedVenueArray = $objGoogle -> journalArray;
	$obtainedTitleArray = $objGoogle -> titleArray;
	$obtainedYearArray = $objGoogle -> yearArray;
	$obtainedCiteArray = $objGoogle -> citeArray;
	$obtainedpubAuthorArray = $objGoogle -> pubAuthorArray;
	$obtainedpubURLArray = $objGoogle -> pubURLArray;

	$hIndex = $objGoogle -> citationArray[2];
	$totalCitations = $objGoogle -> citationArray[0];
	$maxCite = max($obtainedCiteArray);

	$impactFactorArray = array();
	$titleArray = array();
	$citeArray = array();
	$yearArray = array();
	$journalArray = array();
	$pubAuthorArray = array();
	$pubURLArray = array();
	$validIndices = array();

	$patent_titleArray = array();
	$patent_yearArray = array();
	$patent_citeArray = array();
	$patent_nameArray = array();
	$patent_pubAuthorArray = array();
	$patent_pubURLArray = array();
	$patentIndices = array();

	$conf_titleArray = array();
	$conf_yearArray = array();
	$conf_citeArray = array();
	$conf_nameArray = array();
	$conf_pubAuthorArray = array();
	$conf_pubURLArray = array();
	$confIndices = array();

	$pubAuthorPerYearArray = array();
	$pubYearsPerAuthorArray = array();

	$obtainedCompleteDetails = $objGoogle -> completeDetails;

	$idx = -1;	
	$cnt = count($obtainedVenueArray);
	$curYear = date('Y');


	$idxValidYears = array();	// remove empty year and year < 1960
	for ( $i = 0 ; $i < $cnt ; $i++ )
	{
		if( empty($obtainedYearArray[$i]) || $obtainedYearArray[$i] < 1960 || $obtainedYearArray[$i] > $curYear )
			continue;
		$idxValidYears[] = $i;
	}

	$obtainedTitleArray = array_values(array_intersect_key($obtainedTitleArray, array_flip($idxValidYears))); 
	$obtainedYearArray = array_values(array_intersect_key($obtainedYearArray, array_flip($idxValidYears))); 
	$obtainedCiteArray = array_values(array_intersect_key($obtainedCiteArray, array_flip($idxValidYears)));
	$obtainedVenueArray = array_values(array_intersect_key($obtainedVenueArray, array_flip($idxValidYears)));
	$obtainedpubAuthorArray = array_values(array_intersect_key($obtainedpubAuthorArray, array_flip($idxValidYears)));
	$obtainedpubURLArray = array_values(array_intersect_key($obtainedpubURLArray, array_flip($idxValidYears)));


	$link = mysql_connect('kyeongan.cpl.uh.edu:3306', 'kview', 'B9j8iTbA');
	if (!$link) 
		die('Could not connect: ' . mysql_error());
	//echo 'Connected successfully';

	mysql_select_db("kyeongan");
		
	while( $idx < $cnt - 1 )
	{
		$idx++;
		
		//// for co authors per year
		$currentPubYear = $obtainedYearArray[$idx];
		$currentPubAuthorArray = $obtainedpubAuthorArray[$idx];
		storeCoAuthorDataInFormat($currentPubAuthorArray, $currentPubYear);

		$journalItem = $obtainedVenueArray[$idx];
		//echo "<br/> journal = " . $journalItem;

		//// check if it is a patent
		if(strpos($journalItem, 'Patent') !== false) {
			$patentIndices[] = $idx;
			$obtainedCompleteDetails[$idx] -> type = "Patent";
			continue;
		}

		//$jURL = "http://www.impactfactorsearch.com/test.php?json=true&input=" . $journalItem;
		//$jURL = "http://kyeongan.cpl.uh.edu/projects/scholar/web/jcr.php?journal_name=" . $journalItem;

		$query = "
		SELECT name, im FROM jcr WHERE name ='".$journalItem."'";

		$result = mysql_query($query);

		while ($row = mysql_fetch_array($result, MYSQL_BOTH)) {

			$name = $row['name'];
			$im = $row['im'];
			//echo json_encode($im);
		}

		// print_r("[IM]".$journalItem."----------".$im."\n");

		if( !isset($im) )
		{
			if (strpos(strtolower($journalItem), 'journal') !== false)
				$im = '0';
			else {
				$confIndices[] = $idx;
				$obtainedCompleteDetails[$idx] -> type = "Conference";
				continue;
			}
		}

		if ( $im == 0 )	$im = '-';

//		$journalNameInput = strtolower($journalItem);
//		$journalNameOutput = strtolower($name);
		  
		//if( $journalNameInput == $journalNameOutput )
		{
			$impactFactorArray[] = $im;
			$journalArray[] =  $journalItem;
			$validIndices[] = $idx;
		}

		$obtainedCompleteDetails[$idx] -> type = "Journal";
		$im = null;

	} // end of while

	mysql_close($link);

	if(count($validIndices) > 0 ) {
		$titleArray = array_values(array_intersect_key($obtainedTitleArray, array_flip($validIndices))); 
		$yearArray = array_values(array_intersect_key($obtainedYearArray, array_flip($validIndices))); 
		$citeArray = array_values(array_intersect_key($obtainedCiteArray, array_flip($validIndices)));
		$validJournals = array_values(array_intersect_key($obtainedVenueArray, array_flip($validIndices)));
		$pubAuthorArray = array_values(array_intersect_key($obtainedpubAuthorArray, array_flip($validIndices)));
		$pubURLArray = array_values(array_intersect_key($obtainedpubURLArray, array_flip($validIndices)));
	}
	if(count($patentIndices) > 0 ) {
		$patent_titleArray = array_values(array_intersect_key($obtainedTitleArray, array_flip($patentIndices))); 
		$patent_yearArray = array_values(array_intersect_key($obtainedYearArray, array_flip($patentIndices))); 
		$patent_citeArray = array_values(array_intersect_key($obtainedCiteArray, array_flip($patentIndices)));
		$patent_nameArray = array_values(array_intersect_key($obtainedVenueArray, array_flip($patentIndices)));
		$patent_pubAuthorArray = array_values(array_intersect_key($obtainedpubAuthorArray, array_flip($patentIndices)));
		$patent_pubURLArray = array_values(array_intersect_key($obtainedpubURLArray, array_flip($patentIndices)));
	}
	if(count($confIndices) > 0 ) {
		$conf_titleArray = array_values(array_intersect_key($obtainedTitleArray, array_flip($confIndices))); 
		$conf_yearArray = array_values(array_intersect_key($obtainedYearArray, array_flip($confIndices))); 
		$conf_citeArray = array_values(array_intersect_key($obtainedCiteArray, array_flip($confIndices)));
		$conf_nameArray = array_values(array_intersect_key($obtainedVenueArray, array_flip($confIndices)));
		$conf_pubAuthorArray = array_values(array_intersect_key($obtainedpubAuthorArray, array_flip($confIndices)));
		$conf_pubURLArray = array_values(array_intersect_key($obtainedpubURLArray, array_flip($confIndices)));
	}
		
	$minYear = getValidMinimumYear($obtainedYearArray);
	
	/// get co author counts per year
	$pubAuthorsPerYearWithCounts = array();
	foreach ($pubAuthorPerYearArray as $pubYear => $coAuthorArray) {
		// use array_filter to remove empty strings
		// there are no co-authors for certain publications 
		$pubAuthorsPerYearWithCounts[$pubYear] = getCoAuthorCounts(array_filter($coAuthorArray));
	}

	$pubYearsPerAuthorWithCounts = array();
	foreach ($pubYearsPerAuthorArray as $author => $yearsArray) {
		if( $author === "...")
			continue;

		$pubYearsPerAuthorWithCounts[$author] = array_count_values(array_filter($yearsArray));
	}

	$finalCounts = (array) $objGoogle -> finalCounts;
	$shortname = key($finalCounts);
	

	$final = array(
		"journal_titleArray" => $titleArray,
		"journal_impactFactorArray" => $impactFactorArray,
		"journal_nameArray" => $journalArray,
		"journal_citeArray" => $citeArray,
		"journal_yearArray" => $yearArray,
		"journal_pubAuthorArray" => $pubAuthorArray,
		"journal_pubURLArray" => $pubURLArray,

		"conf_titleArray" => $conf_titleArray,
		"conf_nameArray" => $conf_nameArray,
		"conf_citeArray" => $conf_citeArray,
		"conf_yearArray" => $conf_yearArray,
		"conf_pubAuthorArray" => $conf_pubAuthorArray,
		"conf_pubURLArray" => $conf_pubURLArray,

		"patent_titleArray" => $patent_titleArray,
		"patent_nameArray" => $patent_nameArray,
		"patent_citeArray" => $patent_citeArray,
		"patent_yearArray" => $patent_yearArray,
		"patent_pubAuthorArray" => $patent_pubAuthorArray,
		"patent_pubURLArray" => $patent_pubURLArray,

		"pubAuthorPerYearArray" => $pubAuthorPerYearArray,
		"pubYearsPerAuthorArray" => $pubYearsPerAuthorArray,
		"pubAuthorsPerYearWithCounts" => $pubAuthorsPerYearWithCounts,
		"pubYearsPerAuthorWithCounts" => $pubYearsPerAuthorWithCounts,

		"completeDetails" => $obtainedCompleteDetails,
		"totalCitations" => $totalCitations,
		"hIndex" => $hIndex,
		"author_fullname" => $objGoogle -> author_fullname,
		"minYear" => $minYear,
		"curYear" => $curYear,
		"maxCite" => $maxCite,
		"finalCounts" => $objGoogle -> finalCounts,
		"author_shortName" => $shortname,
		"status" => 'success'
	);  
	
	// echo -> for print to browser
	// print -> for javascript
	if ( $service == 1 ) 
		echo json_encode($final);
	else
		print $_GET['jsoncallback']. '('.json_encode($final).')';


	// $endTime = new DateTime();
	// $diff = $startTime->diff( $endTime );
	// echo $diff->format( '%H:%I:%S' );
	

	////////////////// functions //////////////////

	function getDisambiguatedName($name) {
		// no disambiguation for "..."
		if($name === "...")
			return $name;

		$splitNames = explode(' ', $name);
    	$last_name = strtolower(array_pop($splitNames));
		$first_name_letter = substr(strtolower(array_shift((explode(' ', $name)))), 0, 1);
		return strtoupper($first_name_letter) . ' '. ucfirst(strtolower($last_name));
	}

	function storeCoAuthorDataInFormat($currentPubAuthorArray, $currentPubYear) {
		global $pubAuthorPerYearArray, $pubYearsPerAuthorArray;

		// clean all names in the array
		$cleanedNames = array_map('getDisambiguatedName', $currentPubAuthorArray);

		// store all the co-authors in a particular year
		if(empty($pubAuthorPerYearArray[$currentPubYear])) 
			$pubAuthorPerYearArray[$currentPubYear] = $cleanedNames;
		else 
			$pubAuthorPerYearArray[$currentPubYear] = array_merge($pubAuthorPerYearArray[$currentPubYear], $cleanedNames);

		// store all the years with publications to the google scholar author
		foreach ($cleanedNames as $pubAuthor) {
			if(empty($pubYearsPerAuthorArray[$pubAuthor])) {
				$pubYearsPerAuthorArray[$pubAuthor] = array($currentPubYear);	
			}
			else {
				$pubYearsPerAuthorArray[$pubAuthor][] = $currentPubYear;
			}
		}
		///// end of co author data
	}

	function getCoAuthorCounts($coAuthorArray) {

		$counts = array();
		$keysReplaceInfo = array();

		// disambiguate and count co authors
		// count co authors with same last name and first letter of first name
		foreach ($coAuthorArray as $name) {

			// do not count "..." as author
			if($name === "...") 
				continue;

			$actualKey = getDisambiguatedName($name);

	    	if (array_key_exists($actualKey, $counts) === false){
	        	$counts[$actualKey] = 0;
	    	}

	    	$counts[$actualKey]++;
		}
		$finalCounts = $counts;
		arsort($finalCounts);
		return $finalCounts;
	}

	function getValidMinimumYear($yearArray) {
		$smallest = min($yearArray);

		while(($key = array_search($smallest, $yearArray)) !== false) {
		    unset($yearArray[$key]);
		}

		$smallest_2nd = min( $yearArray );

		if ( $smallest == 0 ) {
			$minYear = $smallest_2nd;
		} else {
			$minYear = $smallest;
		}

		return $minYear;
	}

?>