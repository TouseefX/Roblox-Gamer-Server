<?php 
//Created by Lanausse
//I'm not the best w/ php lol

//Get user ID from username
$options = [
    'http' => [
        'header' => "Content-type: application/json",
        'method' => 'POST',
        'content' => '{"usernames": ["'. $_GET["username"] .'"],"excludeBannedUsers": true}',
    ],
];
$context = stream_context_create($options);
$result = file_get_contents('https://users.roblox.com/v1/usernames/users', false, $context);
$userId = json_decode($result)->data[0]->id;

//What params should this use?
$width = 100;
if (isset($_GET["x"])){
    $width = $_GET["x"];
} else {
    $width = $_GET["width"];
}

//Change width to be an allowed size
//The If Else Chain
if ($width < 30) {
    $width = 30;
} else if ($width < 48) {
    $width = 48;
} else if ($width < 60) {
    $width = 60;
} else if ($width < 75) {
    $width = 75;
} else if ($width < 100) {
    $width = 100;
} else if ($width < 110) {
    $width = 110;
} else if ($width < 140) {
    $width = 140;
} else if ($width < 150) {
    $width = 150;
} else if ($width < 180) {
    $width = 180;
}  else if ($width < 250) {
    $width = 250;
} else if ($width < 352) {
    $width = 352;
} else if ($width < 420) {
    $width = 420;
} else {
    $width = 720;
}

//redirect to thumbnail
$thumbnailJson = file_get_contents("https://thumbnails.roblox.com/v1/users/avatar?userIds=" . $userId . "&size=". $width ."x". $width ."&format=Png&isCircular=false");
$imageUrl = json_decode($thumbnailJson)->data[0]->imageUrl;
header("Location: ".$imageUrl);
?>