<?php

if (isset($_POST['email'])) {
	$email = $_POST['email'];
	$password = $_POST['password'];
	$firstname = $_POST['firstname'];
	$lastname = $_POST['lastname'];
	$result = "";

	$db = new mysqli("localhost", "root", "", "socialMedia");
	
	if ($db->query("SELECT users.email FROM users WHERE users.email = '$email' ")->num_rows == 0) {
	
		$newUser = "INSERT INTO `users` (`userId`, `email`, `password`, `firstname`, `lastname`, `age`, `bio`, `profilePic`) VALUES (NULL, '$email', '$password', '$firstname', '$lastname', 'NULL', NULL, NULL);";
		
		if ($db->query($newUser) === TRUE) {
			$result = "success";
		} else {
		  $result = "error";
		} 
	} else {
		$result =  "noEmail";
	}
}
echo json_encode($result); 
?>

