<?php

//	ini_set('max_execution_time', 360); // 3600 - 1hour

//	header( 'Content-Type: application/json;' ); 
 


//$response=file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=6LcozwQTAAAAAPYD47vKWoE2ktxdtkj5XM13rPnR&response=".$captcha."&remoteip=".$_SERVER['REMOTE_ADDR']);

//if($response.success==false)
//{
//	echo 'You are spammer';
//}
//else
//{
	$link = mysql_connect('kyeongan.cpl.uh.edu:3306', 'kyeongan', 'KwonCpl2013');
    if (!$link) {
        die('Could not connect: ' . mysqli_error($link));
        //die('Could not connect: ' . mysqli -> connect_error );
    }
    //echo 'Connected successfully';

    mysql_select_db("kyeongan");		


	$gid = $_POST[gid];
	$gname = $_POST[gname];
	
	if (mysql_query("INSERT INTO scholar_autocomplete (google_id, name) VALUES ('$gid', '$gname')"))
		echo "<script>
					alert('Successful Stored.');
					window.history.go(-1)
				</script>";
	else
		echo "<script>
		            alert('Google Scholar ID already exists in our system.'); 
					window.history.go(-1);				    
				 </script>";

	// check if row inserted or not
//	if ($result) {
//		echo "Good job"; 
////					 window.history.go(-1);
////				 </script>";
//	} else {
//		echo "Oops! An error occurred." . mysql_error();
////		echo "<script>
//		             sweetalert('Oops...', 'Google Scholar ID already exists in our system.', 'error'); 
//					window.history.go(-1);				    
//				 </script>";
//	}		

	mysql_close($link);

//}

	
?>