<?php

//var that states if upload is successfull 1 = good, 0 = erro
$upLoadOk = 1;

//Vars that hold file info
$fileName = basename($_FILES['file']['name']);
$fileLocation = "photos/".$fileName;
$imageFileType = pathinfo($fileLocation, PATHINFO_EXTENSION);

//array that hold valid image types
$vaildTypes = array('jpg', 'jpeg', 'png', 'gif', 'mp4');

//Check if file is valid
if (!in_array(strtolower($imageFileType), $vaildTypes)) {
	echo json_encode("wrongType");
	exit();
}

// Check if file already exists
if (file_exists($fileLocation)) {
	echo json_encode("exists");
	exit();
}

// Check file size
if ($_FILES["file"]["size"] > 5000000) {
	echo json_encode("tooBig");
	exit();
  }

//Move file
if (move_uploaded_file($_FILES['file']['tmp_name'],  $fileLocation)) {
	echo json_encode("success");
} else {
	echo json_encode("moveFailed");
}


?>

