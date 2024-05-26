<?php
// epic get assets from files because i'm tired of getting it from db

try {
if (isset($_GET['version'])) {
$version = $_GET['version'];
}
if (isset($_GET['assetversionid'])) {
	$ver_id = $_GET['assetversionid'];
	 header("Location: https://assetdelivery.roblox.com/v1/asset/?assetversionid=$ver_id");
	 exit; 
}
$id = $_GET['id'];
$ua = $_SERVER['HTTP_USER_AGENT'];

// check client version by UA. NovetusBut2013 = 2013 client and so on

if ($ua == "NovetusBut2013") { // he's using 2013 boys
 $asset = @file_get_contents ('corescripts/' . $id . '.lua');
}else {
 $asset = @file_get_contents ('corescripts/' . $id . '.lua');
}

if(file_exists($id . ".corescript")) {
    header("Content-type: text/plain");

 $script = "%" . $id . "%\r\n" . file_get_contents($id . ".corescript");
 $sig;
 $key = file_get_contents("..\web\privatekey.pem");
 openssl_sign($script, $sig, $key, OPENSSL_ALGO_SHA1);
 echo sprintf("%%%s%%%s", base64_encode($sig), $script);
 exit;
}

if(file_exists($id . ".corescriptnew")) {
    header("Content-type: text/plain");

 $script = "\r\n--rbxassetid%" . $id . "%\r\n" . file_get_contents($id . ".corescriptnew");
 $sig;
 $key = file_get_contents("..\..\web\privatekey.pem");
 openssl_sign($script, $sig, $key, OPENSSL_ALGO_SHA1);
 echo sprintf("--rbxsig%%%s%%%s", base64_encode($sig), $script);
 exit;
}


$asset_dirs = ['../../char/hats/', '../../char/faces/', '../../char/shirts/', '../../char/pants/', '../../char/t-shirts/', '../../char/packages/', '../../web/', '../../assetcache/'];
//$file_audio_exts =['.mp3', '.ogg', '.wav', '.mid', '.midi', '.it', '.xm', '.mod'];
//$file_misc_exts =['.mesh', '.lua', '.rbxm', 'rbxmx', '.rbxl', '.rbxlx'];
if(file_exists($id)) {
    header("Content-type: text/plain");
    die(file_get_contents($id));

}
foreach ($asset_dirs as $dir) {
    foreach (['', '.[!info][!thumb]*', '.mesh'] as $pattern) { // This is a bit silly
        if(glob($dir . $id.$pattern) != false) {
            header("Content-type: text/plain");
             die(file_get_contents(glob($dir . $id.$pattern)[0]));
         }
    }
    
}

// gets the asset from the files, if it's not found, then it will 
// redirect to roblox's asset server. (if a version variable is defined on the unexistent file, then it also redirects the version to roblox. ex: packages)
if ($asset === false) {
 if (!isset($version)) {
	 header("Location: https://assetdelivery.roblox.com/v1/asset/?id=$id&version=1");
	 exit; 
 }

} if ($asset === false and isset($version)) {
    header("Location: https://assetdelivery.roblox.com/v1/asset/?id=$id&version=$version");
	exit;
 } 

} catch (exception $e) {
	$asset = '';
}
header("content-type: text/plain");
ob_start();

?>
