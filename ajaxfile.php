<?php 

include "config.php";

$request = "";
$unique_code = 0;
$email = "";

if(isset($_POST['request'])){
	$request = $_POST['request'];
	$unique_code = $_POST['unique_code'];
	$email = $_POST['email'];
}


// Fetch record by id
if($request == 'fetchbyid'){
	
	// if(isset($_POST['unique_code']) && is_numeric($_POST['unique_code']) ){ 
	//     $userid = $_POST['unique_code']; 
	// }

	$query = "SELECT * FROM product WHERE unique_code=$unique_code AND email='$email'";
	$result = pg_query($con, $query);

	$response = array();
	if (pg_numrows($result) > 0) {

		$row = pg_fetch_assoc($result);
			
		$unique_code = $row['unique_code'];
		$pname = $row['pname'];
		$email = $row['email'];
		$colour = $row['colour'];
		$size = $row['size'];
		$country = $row['country'];


		
	    $response[] = array(
					"unique_code" => $unique_code,
					"pname" => $pname,
					"email" => $email,
					"colour" => $colour,
					"size" => $size,
					"country" => $country,

				);
	} 

	echo json_encode($response);
	die;
}
