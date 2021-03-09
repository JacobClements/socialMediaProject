<?php

if (isset($_POST['email']) and isset($_POST['password'])) {
	$email = $_POST['email'];
	$password = $_POST['password'];
	$result = "";
	$db = new mysqli("localhost", "root", "", "socialMedia");
	
	if ($db->query("SELECT users.email FROM users WHERE users.email = '$email' ")->num_rows == 1) {
		if ($db->query("SELECT users.password FROM users WHERE users.password = '$password' AND users.email = '$email' ")->num_rows == 1) {
			$result = "success";
		} else {
			$result = "wrongPassword";
		}
		
	} else {
		$result =  "fail";
	}

	echo json_encode($result);
}
?>

