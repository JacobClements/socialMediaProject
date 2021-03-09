<?php



$email = $_POST['email'];
$postID = $_POST['postID'];
$isGood = $_POST['isGood'];

$db = new mysqli("localhost", "root", "", "socialMedia");

$selectQuery = $db->query("SELECT userID FROM users WHERE email = '$email'; ");
$selectQuery = mysqli_fetch_row($selectQuery);
$userID = $selectQuery[0];

$insert = "INSERT INTO `likes` (`postID`, `userID`) VALUES ('$postID', '$userID'); ";
$remove = "DELETE FROM `likes` WHERE `likes`.`postID` = '$postID' AND `likes`.`userID` = '$userID';";


if ($db->query("SELECT userID, postID FROM likes WHERE userID = '$userID' AND postID = '$postID'")->num_rows == 0){
    $db->query($insert);
    echo json_encode("like");
} else {
    $db->query($remove);
    echo json_encode("unlike");
}




?>
