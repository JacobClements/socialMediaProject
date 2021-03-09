<?php

//Vars
$email = $_POST['email'];
$title = $_POST['title'];
$message = $_POST['message'];
$filename = $_POST['filename'];

//Access database
$db = new mysqli("localhost", "root", "", "socialMedia");

//Queries
$findUserId = $db->query("SELECT users.userId FROM `users` WHERE users.email = '$email'; ");
$userId = mysqli_fetch_row($findUserId)[0];
$insertPost = "INSERT INTO `post` (`postID`, `title`, `text`, `picture`, `timeCreated`, `Users_userId`) VALUES (NULL, '$title','$message', '$filename', current_timestamp(), '$userId' );";

if ($db->query($insertPost)){
    echo json_encode("success");
} else {
    echo json_encode("fail");
}

 
?>

