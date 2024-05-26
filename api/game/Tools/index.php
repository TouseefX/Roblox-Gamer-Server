<?php
ob_start();
if(isset($_GET["assetversionid"])) {
$id = (int)$_GET["assetversionid"];
}
if(isset($_GET["wd"])) {
$wd = (int)$_GET["wd"];
}
if(isset($_GET["ht"])) {
$ht = (int)$_GET["ht"];
}
if(isset($_GET["fmt"])) {
$fmt = $_GET["fmt"];
}
$file = "http://www.roblox.com/Game/Tools/ThumbnailAsset.ashx?fmt=".$fmt."&wd=".$wd."&ht=".$ht."&assetversionid=".$id."";
if(isset($_GET["aid"])) {
$aid = $_GET["aid"];
$file = "http://www.roblox.com/Game/Tools/ThumbnailAsset.ashx?fmt=".$fmt."&wd=".$wd."&ht=".$ht."&aid=".$aid."";
}
header("location:" . $file);
header("content-type:text/plain");
?>