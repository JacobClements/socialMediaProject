<?php 

if (isset($_POST['email'])){
	$email = $_POST['email'];
	
	$db = new mysqli("localhost", "root", "", "socialMedia");
	$query = $db->query("SELECT users.firstname, users.lastname, users.profilePic FROM users WHERE users.email = '$email' ");
	$row = mysqli_fetch_row($query);
	$result = $row[0]. "*&*" .$row[1]. "*&*" .$row[2];


	echo json_encode($result); 
}


?>