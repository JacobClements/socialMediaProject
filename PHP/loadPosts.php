<?php 


function resultToArray($result) {
    $rows = array();
    while($row = $result->fetch_assoc()) {
        $rows[] = $row;
    }
    return $rows;
}


$index = $_POST['postIndex'];
$email = $_POST['email'];


$db = new mysqli("localhost", "root", "", "socialMedia");

$selectQuery = $db->query("SELECT userID FROM users WHERE email = '$email'; ");
$selectQuery = mysqli_fetch_row($selectQuery);
$userID = $selectQuery[0];

$query = $db->query("SELECT post.postID, post.title, post.text, post.picture, post.Users_userId , users.firstname, users.lastname, post.timeCreated, users.profilePic
                    FROM post
	                    JOIN users on post.Users_userId = users.userId
                    ORDER BY postID DESC LIMIT ".$index." , 5");

$result = resultToArray($query);



foreach ($result as $key => $value) {
    $ifLiked = 0;
    if ($db->query("SELECT * FROM likes WHERE postID = ".$value['postID']." AND userID = ".$userID." ")->num_rows == 0){
        $ifLiked = 0;
    } else {
        $ifLiked = 1;
    }

    $run = $db->query("SELECT COUNT(userID) FROM `likes` WHERE postID = ".$value['postID']." ");
    $run = mysqli_fetch_row($run);
    $result[$key]['Users_userId'] = $run[0];
    
    $result[$key]['isLiked'] = $ifLiked;


}

echo json_encode($result); 



?>