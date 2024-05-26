<?php
//Created by Lanausse
//I'm not the best w/ php lol
error_reporting(0);

//What params should this use?
$width = 100;
$id = 1818;

if (isset($_GET["x"])){
    $width = $_GET["x"];
} else {
    $width = $_GET["width"];
}

if (isset($_GET["assetId"])){
    $id = $_GET["assetId"];
} else {
    $id = $_GET["assetid"];
}

//Change width to be an allowed size
//The If Else Chain lol
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
} else if ($width < 420) {
    $width = 420;
} else if ($width < 512) {
    $width = 512;
}  else {
    $width = 700;
}

$json = json_decode(file_get_contents('https://thumbnails.roblox.com/v1/assets?assetIds='.$id.'&returnPolicy=PlaceHolder&size='.$width.'x'.$width.'&format=Png&isCircular=false'));
header("Location: ".$json->data[0]->imageUrl);
?>