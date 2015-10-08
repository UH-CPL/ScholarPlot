<?php


	error_reporting(E_ALL);
	ini_set('display_errors', TRUE);
	ini_set('display_startup_errors', TRUE);

	header( 'Content-Type: application/json;' ); 

    /* http://kyeongan.cpl.uh.edu/projects/scholar/htmlSQL/demo.php
    ** htmlSQL - Example 12
    **
    ** Shows how to replace the user agent and the referer with
    ** custom values
    */
    
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
 			    $google_id = $_POST["gid"];
 			    }
 			else {
 				$google_id = $_GET["gid"];
 	        }

    include_once("./lib/snoopy.class.php");
    include_once("./lib/htmlsql.class.php");
    
    $wsql = new htmlsql();
    
    // set a individual agent:
    $wsql->set_user_agent('MyAgentName/0.9');
    
    // set a new referer:
    $wsql->set_referer('http://www.jonasjohn.de/custom/referer/');
    
    
    // connect to a URL  'http://codedump.jonasjohn.de/'
	// HmdH51YAAAAJ (Weidong Shi)
	// cQan1qQAAAAJ (Kyeongan Kwon)
	// Y5laGgYAAAAJ - E3oBkwwAAAAJ (Ioannis Pavlidis)
	// _Hca89wAAAAJ (kakdiaris)
	// fMfq07IAAAAJ (John J foxe)
	// pUnd9t0AAAAJ (junior ioannis v)
	// XxHqFtcAAAAJ (junior butler)
	// LyEq7qEAAAAJ
	// _pPy-pAAAAAJ
	// qc6CJjYAAAAJ einstein
	// 0YEXoMMAAAAJ Chris Frith
	// 4nu1zCsAAAAJ Richard Frackowiak
	
//	$url = "http://scholar.google.com/citations?";

	$pagesize = "&pagesize=100";
	$view_op = "&view_op=list_works"; // needed when pagesize is 100
	
	$url = "http://scholar.google.com/citations?";
	//$userid = "&user=4nu1zCsAAAAJ";
	$userid = "&user=" . $google_id;
	$sort_by = "sortby=pubdate&hl=en";
	$cstart = "&cstart=0";

	$titleArray = array();
	$title_index = 0;

	$yearArray = array();
	$year_index = 0;
	
	$citeArray = array();
	$cite_index = 0;

	$authorArray = array();
	$author_index = 0;

	$journalArray = array();
	$journal_index = 0;

	$citationArray = array();
	$citation_index = 0;

	$pubAuthorArray = array();
	$pubAuthor_index = 0;

	$authorCountArray = array();
	$authorCount_index = 0;

	$coAuthorArray = array();
	$pubURLArray = array();

	$prevCountResults = 0;
	$countResults = 0;

	$author_fullname = "";
	
	$pattern = '/.*display:none.*/';




	// 
	$ProceedingsJournalName = array(
		"proceedings of the american mathematical society"
		,"proceedings of the biological society of washington"
		,"proceedings of the combustion institute"
		,"proceedings of the edinburgh mathematical society"
		,"proceedings of the entomological society of washington"
		,"proceedings of the estonian academy of sciences"
		,"proceedings of the geologists association"
		,"proceedings of the ieee"
		,"proceedings of the indian academy of sciences-mathematical sciences"
		,"proceedings of the institution of civil engineers-civil engineering"
		,"proceedings of the institution of civil engineers-engineering sustainability"
		,"proceedings of the institution of civil engineers-geotechnical engineering"
		,"proceedings of the institution of civil engineers-maritime engineering"
		,"proceedings of the institution of civil engineers-municipal engineer"
		,"proceedings of the institution of civil engineers-structures and buildings"
		,"proceedings of the institution of civil engineers-transport"
		,"proceedings of the institution of civil engineers-water management"
		,"proceedings of the institution of mechanical engineers part a-journal of power and energy"
		,"proceedings of the institution of mechanical engineers part b-journal of engineering manufacture"
		,"proceedings of the institution of mechanical engineers part c-journal of mechanical engineering science"
		,"proceedings of the institution of mechanical engineers part d-journal of automobile engineering"
		,"proceedings of the institution of mechanical engineers part e-journal of process mechanical engineering"
		,"proceedings of the institution of mechanical engineers part f-journal of rail and rapid transit"
		,"proceedings of the institution of mechanical engineers part g-journal of aerospace engineering"
		,"proceedings of the institution of mechanical engineers part h-journal of engineering in medicine"
		,"proceedings of the institution of mechanical engineers part i-journal of systems and control engineering"
		,"proceedings of the institution of mechanical engineers part j-journal of engineering tribology"
		,"proceedings of the institution of mechanical engineers part k-journal of multi-body dynamics"
		,"proceedings of the institution of mechanical engineers part l-journal of materials-design and applications"
		,"proceedings of the institution of mechanical engineers part m-journal of engineering for the maritime environment"
		,"proceedings of the institution of mechanical engineers part o-journal of risk and reliability"
		,"proceedings of the institution of mechanical engineers part p-journal of sports engineering and technology"
		,"proceedings of the japan academy series a-mathematical sciences"
		,"proceedings of the japan academy series b-physical and biological sciences"
		,"proceedings of the london mathematical society"
		,"proceedings of the national academy of sciences"
		,"proceedings of the national academy of science usa"
		,"proceedings of the national academy of sciences india section a-physical sciences"
		,"proceedings of the national academy of sciences india section b-biologicalsciences"
		,"proceedings of the national academy of sciences of the united states of america"
		,"proceedings of the national academy of sciences of the united states of"
		,"proceedings of the nutrition society"
		,"proceedings of the romanian academy series a-mathematics physics technicalsciences information science"
		,"proceedings of the royal society a-mathematical physical and engineering sciences"
		,"proceedings of the royal society b-biological sciences"
		,"proceedings of the royal society of edinburgh section a-mathematics"
		,"proceedings of the steklov institute of mathematics"
		,"proceedings of the yorkshire geological society"
	);

	

	for ($x=0, $terminate = 0 ; $terminate != 1; $x++) {
		
		if( $x == 3)
			break;

		$cstart = "&cstart=" . (string)($x*100);

	$url_param = $url. $userid. $view_op. $pagesize . $cstart;

	if (!$wsql->connect('url', $url_param)){
        print 'Error while connecting: ' . $wsql->error;
        exit;
    }


//	if (!$wsql->query('SELECT * FROM span WHERE $class="cit-name-display"')){
	if (!$wsql->query('SELECT * FROM div')){
        print "Query error: " . $wsql->error; 
        exit;
	}

	 foreach($wsql->fetch_array() as $row){

		foreach ($row as &$value) {

			if ($value == "gsc_prf_in" )
			{
				$test = next($row);
				$author_fullname = strip_tags($test);
				$author_fullname = utf8_encode($author_fullname);
				$author_fullname = transliterateString($author_fullname);
				$author_fullname = ucwords($author_fullname);

//				print_r( "[author_fullname]".$author_fullname);
			}
		}
	 }
    
    /* execute a query:
       
       This query returns all links:
    */
    if (!$wsql->query('SELECT * FROM td')){
        print "Query error: " . $wsql->error; 
        exit;
	}

/*    if (!$wsql->query('SELECT * FROM td WHERE $class="cit-borderleft cit-data"')){
        print "Query error: " . $wsql->error; 
        exit;
	}
*/

    // fetch results as array
	foreach($wsql->fetch_array() as $row){

		foreach ($row as &$value) {

			//			echo $value;
			if( $x ==  0 )
			{	

				if ( $value == "gsc_rsb_std" ) {
					$citations = next($row);
					//echo $citations;
					$citationArray[$citation_index] = $citations;
					$citation_index++;
				}
			}

			// span 
			if ( $value == "gsc_a_t" ) {
//					echo "<hr>";

					$name_title = next($row);

					/// to store url for publication
					$regexp = "<a\s[^>]*href=(\"??)([^\" >]*?)\\1[^>]*>(.*)<\/a>";
				//					$regexp = "<a\s[^>]*href=(\"??)([^\" >]*?)";
					if(preg_match_all("/$regexp/siU", $name_title, $matches)) {
						$pubURL = "http://scholar.google.com".$matches[2][0];											
					}									  
					$pubURL = str_replace("&amp;", "&", $pubURL);

					//$pubURLArray[$title_index] = $pubURL;
					insertPubURL($pubURL);

					// end for publication url

					$clean_title = strip_tags( preg_replace($pattern, '', $name_title) );

					//list($t1, $t2, $t3) = preg_split('/<br>/', $name_title);
					$split_result = preg_split('/<div class="gs_gray">/', $name_title);

					$clean_journal = "";
					$clean_author = "";

					$t1 = $split_result[0];
					if( isset($split_result[1]) ){
						$t2 = $split_result[1];
						$clean_author = strip_tags( preg_replace($pattern, '', $t2) );
					}
					if( isset($split_result[2]) ){
						$t3 = $split_result[2];
						$clean_journal = strip_tags( preg_replace($pattern, '', $t3) );
					}
					
					$clean_title = strip_tags( preg_replace($pattern, '', $t1) );
					$clean_authors = strip_tags( preg_replace($pattern, '', $t2) );
					// print_r($clean_author);
					// echo "\n";
					insertCoAuthors($clean_authors);
//					$clean_journal = strip_tags( preg_replace($pattern, '', $t3) );

/*					print_r("[T1]".$clean_t1);
					print_r("[T2]".$clean_author);
					print_r("[T3]".$clean_journal);
*/

//					$titleArray[$title_index] = str_replace('&#39', '+', rtrim($var1));
/*
					$clean_title = str_replace('&lt', ' ', rtrim($clean_title));
					$clean_title = str_replace('&gt', ' ', $clean_title);
					$clean_title = str_replace('&#39', ' ', $clean_title);
					$clean_title = str_replace(':', ' ', $clean_title);
					$clean_title = str_replace('&quot;', ' ', $clean_title);
					print_r($clean_title);
*/
					
					
//					list($t_1, $t_2) = preg_split('/[;]/', $clean_title);
// print_r("[clean_title]".$clean_title);
					$trim_title = trim($clean_title);
					$split_title = preg_split('/[;]/', $trim_title);
					$t_1 = $split_title[0];
//					if( count($split_title) > 1 )
//						$t_2 = $split_title[1];
				
//					list($j_1, $j_2) = preg_split('/[,(0-9&.-]/', $clean_journal);
//					echo $clean_journal . "\n";

// print_r("[clean_journal]".$clean_journal);




					// ==========================================================================
					// Please be very careful for patterns.
					
					$clean_journal = convert_smart_quotes($clean_journal);
					$clean_journal = str_replace("&amp;", "And", $clean_journal);
					$clean_journal = str_replace(": ", "-", $clean_journal);
					$clean_journal = str_replace("*", "", $clean_journal);

					if ( strncmp("the ", substr(strtolower($clean_journal), 0, 4), 4) == 0 )
						$clean_journal = substr($clean_journal, 4, strlen($clean_journal));
						
					$split_j = preg_split('/[,(0-9&.=;]/', $clean_journal);	
					$j_1 = $split_j[0];


					if (isset($split_j[1]))
					{
						$IEEE = ltrim($split_j[1]);
						// print_r("A: [IEEE]".$IEEE);
						if ( strncmp("ieee", strtolower($IEEE), 4) == 0 )
						{

							$j_1 = $IEEE.$j_1;
							// print_r("A: [j_1]".$j_1);
						}
					}
					

					if ( strncmp("proceedings of the", strtolower($clean_journal), 18) == 0 )
					{
						 // print_r("[A:]".$j_1."\n");
						 // print_r("[B:]".$clean_journal."\n");

						if (in_array(rtrim(strtolower($j_1)), $ProceedingsJournalName))	// journals
						{
							// print_r("[C:]".$j_1."\n");
							// nothing to do
							//print_r("A:[clean_journal]".$clean_journal."\n");
						}
						else //conferences
						{
							// print_r("[D:]".$j_1."\n");
							$split_j = preg_split('/[,(&.-]/', $clean_journal);
							$j_1 = $split_j[0];
						}
					}

					// ==========================================================================					

					

					
					
					/*
					 * Rtrim and Replace space with "+" char
					*/


					$titleArray[$title_index] = removeInvalidChars($clean_title);
					$title_index++;

					$authorArray[$year_index] = $clean_author;
					$author_index++;
					
					$journalArray[$year_index] = removeInvalidChars(rtrim($j_1));
//					$journalArray[$year_index] = str_replace(' ', '+', rtrim($j_1));

					
					/**********************************************************
					* START for Correding the jounal names
					*  This is for "alexander petersen". by added on May 9, 2014
					**********************************************************/

					// if( strtolower($journalArray[$year_index]) === "the lancet" ) {
					// 	$journalArray[$year_index] = "lancet";
					// }

					// if( strtolower($journalArray[$year_index]) === "proceedings of the national academy of sciences" ) {
					// 	$journalArray[$year_index] = "proceedings of the national academy of sciences of the united states of america";
					// }

					// if( strtolower($journalArray[$year_index]) === "journal of statistical mechanics: theory and experiment" ) {
					// 	$journalArray[$year_index] = "journal of statistical mechanics-theory and experiment";
					// }

					if( strtolower($journalArray[$year_index]) === "proceedings of the national academy of sciences of the united states of" ) {
						$journalArray[$year_index] = "proceedings of the national academy of sciences of the united states of america";
					}

					if( strtolower($journalArray[$year_index]) === "proceedings of the national academy of science usa" ) {
						$journalArray[$year_index] = "proceedings of the national academy of sciences of the united states of america";
					}

					// END for Correding the jounal names




					$journal_index++;

				}

			if ( $value == "gsc_a_y" ) {
					$next_elt = next($row);
					$val_cited = next($row);
//					echo  "[Year]" . $next_elt ;//."<br>" ;//. "<br> Cited =  " . $val_cited;
					if( $next_elt == "" ) {
//						echo "0";
						$next_elt = "0";
					}
//					echo "<br>";
					
					$clean_year = strip_tags( preg_replace($pattern, '', $next_elt) );
					
					
					$yearArray[$year_index] = $clean_year;
					$year_index++;


				}

				if ( $value == "gsc_a_c" ) 
				{
					$next_elt = next($row);
					$val_cited = next($row);
	//				echo  "Cited : " . $next_elt ;//."<br>" ;//. "<br> Cited =  " . $val_cited;
					if( $next_elt == "" ) {
						$next_elt = "0";
						//echo "0";
					}
//					echo "<br>";
					//echo $val_cited . "\n";
					//echo next($row) . "\n" . next(next($row)) . "\n" ;
					//echo $value . "\n" . next($row) . next(next($row));


					$var2 = strip_tags( preg_replace($pattern, '', $next_elt) );
					
					$newtext = html_entity_decode($var2);
					$newtext = str_replace("&nbsp;", '', $newtext);
					$newtext = str_replace("*", '', $newtext);
					//$newtext = str_replace(' ', '', $newtext);
//					$nextext = trim($newtext, chr(0xC2).chr(0xA0))						
					$newtext = str_replace( chr( 194 ) . chr( 160 ), '', $newtext );
					
					$newtext = strip_tags($newtext);
//$newtext = trim($newtext);
					
//					print_r("[citeArray]".$newtext);
					$citeArray[$cite_index] = empty($newtext) ? "0" : $newtext;
					$cite_index++;

				}

		} // foreach

		       
    } // foreach
	echo "\n";
	
	$countResults = count($titleArray);
	//echo $countResults;
	
	if( ($countResults - $prevCountResults) == 1 )
		$terminate = 1;
	
	$prevCountResults = $countResults;
	
	/*if($x == 0 ) {
	array_shift($titleArray);
    array_shift($authorArray);
	array_shift($journalArray);
    array_shift($citeArray);
	array_shift($yearArray);
	}*/
	}

	//echo "titles : " . $title_index . "\n Years: " . $year_index . "\n Cite: ". $cite_index . "\n autohre: ". $author_index. "\n jounral: " .$journal_index;

	
/*$r_titleArray = array_reverse($titleArray);
$r_authorArray = array_reverse($authorArray);
$r_journalArray = array_reverse($journalArray);
$r_citeArray = array_reverse($citeArray);
$r_yearArray = array_reverse($yearArray);
*/
	
	// remove occurance of "cited by"
	while(($key = array_search("Cited by", $citeArray)) !== false) {
		unset($citeArray[$key]);
		unset($titleArray[$key]);
		unset($journalArray[$key]);
		unset($yearArray[$key]);
	}
	
	$citeArray = array_values($citeArray);
	$titleArray = array_values($titleArray);
	$journalArray = array_values($journalArray);
	$yearArray = array_values($yearArray);
	

	$idx = 0;
	foreach ($coAuthorArray as $coAuthorName) {
		$coAuthorArray[$idx] = removeInvalidChars($coAuthorName);
		$idx++;
	}
	//print_r($coAuthorArray);

	$coAuthorAllArray = array_values($coAuthorArray);

	$counts = array();
	$keysReplaceInfo = array();

	foreach ($coAuthorArray as $name) {
		if( $name == "..." )
			continue;

		$actualKey = getDisambiguatedName($name);

    	if (array_key_exists($actualKey, $counts) === false){
        	$counts[$actualKey] = 0;
        	//$keysReplaceInfo[$key] = $actualKey;
    	}

    	$counts[$actualKey]++;
	}
	$finalCounts = $counts;
	arsort($finalCounts);

	$pubDetailsArray = array();

	$i = 0;
	for ($i = 0; $i < count($titleArray); ++$i) {
        
        $pubDetails = array(
        	"title" => $titleArray[$i],
        	"url" => $pubURLArray[$i],
        	"year" => empty($yearArray[$i]) ? "0" : $yearArray[$i],
        	"citation" => empty($citeArray[$i]) ? "0" : $citeArray[$i],       
        	"num_of_co_authors" => is_null($authorCountArray[$i]) ? 0 : $authorCountArray[$i],
        	"type" => null,
        	"co_authors" => is_null($pubAuthorArray[$i]) ? [] : $pubAuthorArray[$i],
        );

        //array_push($pubDetailsArray, $pubDetails);
        $pubDetailsArray[] = $pubDetails;
        unset($pubDetails);
    }

     $final = array(
// 				
				"titleArray" => $titleArray,
// 				"authorArray" => $authorArray,
				"journalArray" => $journalArray,
 				"citeArray" => $citeArray,
				"yearArray" => $yearArray,
				"citationArray" => $citationArray,
				"pubAuthorArray" => $pubAuthorArray,
				"pubURLArray" => $pubURLArray,
				"completeDetails" => $pubDetailsArray,
				"author_fullname" => $author_fullname,
				"finalCounts" => $finalCounts,
				"status" => 'success'
             );  
	


//print_r($final);

    echo json_encode($final);
	
function getDisambiguatedName($name) {
	$splitNames = explode(' ', $name);
	$last_name = strtolower(array_pop($splitNames));
	$first_name_letter = substr(strtolower(array_shift((explode(' ', $name)))), 0, 1);

	// $first_name = array_shift($splitNames);
	// $actualKey = $first_name . ' '. ucfirst($last_name);
	return strtoupper($first_name_letter) . ' '. ucfirst(strtolower($last_name));
}

function insertCoAuthors($next_elt) {

	global $authorCount_index, $pubAuthor_index, $coAuthorArray, $pubAuthorArray, $authorCountArray, $title_index;

	$coAuthorName = strip_tags($next_elt);
	$coAuthorName = utf8_encode($coAuthorName);
	$coAuthorName = transliterateString($coAuthorName);

	$authorCountArray[$title_index] = substr_count($next_elt, ',') + 1;
	//$authorCount_index++;

	$tempCoAuthorArray = explode(', ', $next_elt);

	// added Nov 26 for pubAuthor array special characters
	$iter = 0;
	foreach ($tempCoAuthorArray as $tempCoAuthorName) {
		$tempCoAuthorArray[$iter++] = removeInvalidChars($tempCoAuthorName);
	}
										
	$pubAuthorArray[$title_index] = $tempCoAuthorArray;
	//$pubAuthor_index++;

	if(empty($coAuthorArray)){
		$coAuthorArray = $tempCoAuthorArray;
	} else { 
		$coAuthorArray =  array_merge($coAuthorArray,$tempCoAuthorArray);
	}

}

function insertPubURL($pubURL) {
	global $pattern, $pubURLArray, $title_index;

	$var2 = strip_tags( preg_replace($pattern, '', $pubURL) );

	if( $var2 === "" ) {
		$var2 = "0";
		//echo "0";
	}

	$newtext = html_entity_decode($var2);
	$newtext = str_replace("&nbsp;", '', $newtext);
	$newtext = str_replace("*", '', $newtext);
//	$newtext = str_replace(' ', '', $newtext);
//	$nextext = trim($newtext, chr(0xC2).chr(0xA0))						
	$newtext = str_replace( chr( 194 ) . chr( 160 ), '', $newtext );	
	$newtext = strip_tags($newtext);
//  $newtext = trim($newtext);
//	print_r("[citeArray]".$newtext);
	$pubURLArray[$title_index] = $newtext;//$var2;
}

function removeInvalidChars( $text) {
    $regex = '/( [\x00-\x7F] | [\xC0-\xDF][\x80-\xBF] | [\xE0-\xEF][\x80-\xBF]{2} | [\xF0-\xF7][\x80-\xBF]{3} ) | ./x';
    return preg_replace($regex, '$1', $text);
}

function transliterateString($txt) {
    $transliterationTable = array('á' => 'a', 'Á' => 'A', 'à' => 'a', 'À' => 'A', 'ă' => 'a', 'Ă' => 'A', 'â' => 'a', 'Â' => 'A', 'å' => 'a', 'Å' => 'A', 'ã' => 'a', 'Ã' => 'A', 'ą' => 'a', 'Ą' => 'A', 'ā' => 'a', 'Ā' => 'A', 'ä' => 'ae', 'Ä' => 'AE', 'æ' => 'ae', 'Æ' => 'AE', 'ḃ' => 'b', 'Ḃ' => 'B', 'ć' => 'c', 'Ć' => 'C', 'ĉ' => 'c', 'Ĉ' => 'C', 'č' => 'c', 'Č' => 'C', 'ċ' => 'c', 'Ċ' => 'C', 'ç' => 'c', 'Ç' => 'C', 'ď' => 'd', 'Ď' => 'D', 'ḋ' => 'd', 'Ḋ' => 'D', 'đ' => 'd', 'Đ' => 'D', 'ð' => 'dh', 'Ð' => 'Dh', 'é' => 'e', 'É' => 'E', 'è' => 'e', 'È' => 'E', 'ĕ' => 'e', 'Ĕ' => 'E', 'ê' => 'e', 'Ê' => 'E', 'ě' => 'e', 'Ě' => 'E', 'ë' => 'e', 'Ë' => 'E', 'ė' => 'e', 'Ė' => 'E', 'ę' => 'e', 'Ę' => 'E', 'ē' => 'e', 'Ē' => 'E', 'ḟ' => 'f', 'Ḟ' => 'F', 'ƒ' => 'f', 'Ƒ' => 'F', 'ğ' => 'g', 'Ğ' => 'G', 'ĝ' => 'g', 'Ĝ' => 'G', 'ġ' => 'g', 'Ġ' => 'G', 'ģ' => 'g', 'Ģ' => 'G', 'ĥ' => 'h', 'Ĥ' => 'H', 'ħ' => 'h', 'Ħ' => 'H', 'í' => 'i', 'Í' => 'I', 'ì' => 'i', 'Ì' => 'I', 'î' => 'i', 'Î' => 'I', 'ï' => 'i', 'Ï' => 'I', 'ĩ' => 'i', 'Ĩ' => 'I', 'į' => 'i', 'Į' => 'I', 'ī' => 'i', 'Ī' => 'I', 'ĵ' => 'j', 'Ĵ' => 'J', 'ķ' => 'k', 'Ķ' => 'K', 'ĺ' => 'l', 'Ĺ' => 'L', 'ľ' => 'l', 'Ľ' => 'L', 'ļ' => 'l', 'Ļ' => 'L', 'ł' => 'l', 'Ł' => 'L', 'ṁ' => 'm', 'Ṁ' => 'M', 'ń' => 'n', 'Ń' => 'N', 'ň' => 'n', 'Ň' => 'N', 'ñ' => 'n', 'Ñ' => 'N', 'ņ' => 'n', 'Ņ' => 'N', 'ó' => 'o', 'Ó' => 'O', 'ò' => 'o', 'Ò' => 'O', 'ô' => 'o', 'Ô' => 'O', 'ő' => 'o', 'Ő' => 'O', 'õ' => 'o', 'Õ' => 'O', 'ø' => 'oe', 'Ø' => 'OE', 'ō' => 'o', 'Ō' => 'O', 'ơ' => 'o', 'Ơ' => 'O', 'ö' => 'oe', 'Ö' => 'OE', 'ṗ' => 'p', 'Ṗ' => 'P', 'ŕ' => 'r', 'Ŕ' => 'R', 'ř' => 'r', 'Ř' => 'R', 'ŗ' => 'r', 'Ŗ' => 'R', 'ś' => 's', 'Ś' => 'S', 'ŝ' => 's', 'Ŝ' => 'S', 'š' => 's', 'Š' => 'S', 'ṡ' => 's', 'Ṡ' => 'S', 'ş' => 's', 'Ş' => 'S', 'ș' => 's', 'Ș' => 'S', 'ß' => 'SS', 'ť' => 't', 'Ť' => 'T', 'ṫ' => 't', 'Ṫ' => 'T', 'ţ' => 't', 'Ţ' => 'T', 'ț' => 't', 'Ț' => 'T', 'ŧ' => 't', 'Ŧ' => 'T', 'ú' => 'u', 'Ú' => 'U', 'ù' => 'u', 'Ù' => 'U', 'ŭ' => 'u', 'Ŭ' => 'U', 'û' => 'u', 'Û' => 'U', 'ů' => 'u', 'Ů' => 'U', 'ű' => 'u', 'Ű' => 'U', 'ũ' => 'u', 'Ũ' => 'U', 'ų' => 'u', 'Ų' => 'U', 'ū' => 'u', 'Ū' => 'U', 'ư' => 'u', 'Ư' => 'U', 'ü' => 'ue', 'Ü' => 'UE', 'ẃ' => 'w', 'Ẃ' => 'W', 'ẁ' => 'w', 'Ẁ' => 'W', 'ŵ' => 'w', 'Ŵ' => 'W', 'ẅ' => 'w', 'Ẅ' => 'W', 'ý' => 'y', 'Ý' => 'Y', 'ỳ' => 'y', 'Ỳ' => 'Y', 'ŷ' => 'y', 'Ŷ' => 'Y', 'ÿ' => 'y', 'Ÿ' => 'Y', 'ź' => 'z', 'Ź' => 'Z', 'ž' => 'z', 'Ž' => 'Z', 'ż' => 'z', 'Ż' => 'Z', 'þ' => 'th', 'Þ' => 'Th', 'µ' => 'u', 'а' => 'a', 'А' => 'a', 'б' => 'b', 'Б' => 'b', 'в' => 'v', 'В' => 'v', 'г' => 'g', 'Г' => 'g', 'д' => 'd', 'Д' => 'd', 'е' => 'e', 'Е' => 'e', 'ё' => 'e', 'Ё' => 'e', 'ж' => 'zh', 'Ж' => 'zh', 'з' => 'z', 'З' => 'z', 'и' => 'i', 'И' => 'i', 'й' => 'j', 'Й' => 'j', 'к' => 'k', 'К' => 'k', 'л' => 'l', 'Л' => 'l', 'м' => 'm', 'М' => 'm', 'н' => 'n', 'Н' => 'n', 'о' => 'o', 'О' => 'o', 'п' => 'p', 'П' => 'p', 'р' => 'r', 'Р' => 'r', 'с' => 's', 'С' => 's', 'т' => 't', 'Т' => 't', 'у' => 'u', 'У' => 'u', 'ф' => 'f', 'Ф' => 'f', 'х' => 'h', 'Х' => 'h', 'ц' => 'c', 'Ц' => 'c', 'ч' => 'ch', 'Ч' => 'ch', 'ш' => 'sh', 'Ш' => 'sh', 'щ' => 'sch', 'Щ' => 'sch', 'ъ' => '', 'Ъ' => '', 'ы' => 'y', 'Ы' => 'y', 'ь' => '', 'Ь' => '', 'э' => 'e', 'Э' => 'e', 'ю' => 'ju', 'Ю' => 'ju', 'я' => 'ja', 'Я' => 'ja');
    $txt = str_replace(array_keys($transliterationTable), array_values($transliterationTable), $txt);
    
//	echo "results:";
//	echo $txt;
	return $txt;
}

function convert_smart_quotes($string)
{
	$search = array(chr(145),
		chr(146),
		chr(147),
		chr(148),
		chr(151));

	$replace = array("'",
		"'",
		'"',
		'"',
		'-');

	return str_replace($search, $replace, $string);
}

?>