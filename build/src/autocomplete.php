<?php

	function connect() {
		return new PDO('mysql:host=kyeongan.cpl.uh.edu;dbname=kyeongan', 'kview', 'B9j8iTbA', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
	}

	$pdo = connect();
	$keyword = '%'.$_POST['keyword'].'%';
	$sql = "SELECT google_id, name, school FROM scholar_autocomplete WHERE name LIKE (:keyword) ORDER BY update_date DESC LIMIT 0, 10";
	$query = $pdo->prepare($sql);
	$query->bindParam(':keyword', $keyword, PDO::PARAM_STR);
	$query->execute();
	$list = $query->fetchAll();
	
	foreach ($list as $rs) {
		// put in bold the written text
		$name = str_replace($_POST['keyword'], '<strong>'.$_POST['keyword'].'</strong>', $rs['name']);
		$google_id = $rs['google_id'];
		$school = $rs['school'];
		// add new option
		echo '<li data-google-id="'.$rs['google_id'].'" data-google-name="'.$rs['name'].'" onclick="set_item(this)">'.$name.'</li>';
		// echo '<li data-google-id="'.$rs['google_id'].'" onclick="set_item(\''.str_replace("'", "\'", $rs['name']).'\')">'.$name.'</li>';
	}


// For jQuery

 /*$conn = mysql_connect("kyeongan.cpl.uh.edu", "kview", "B9j8iTbA");
    mysql_select_db("kyeongan", $conn);
    $q = strtolower($_GET["term"]);

$return = array();
    $query = mysql_query("SELECT google_id, name, school FROM scholar_autocomplete WHERE name like '%$q%' ORDER BY google_id ASC LIMIT 0, 10");
    while ($row = mysql_fetch_array($query)) {
    array_push($return,array('label'=>$row['name'],'value'=>$row['name'],'gid'=>$row['google_id']));
}
echo(json_encode($return));
*/

?>