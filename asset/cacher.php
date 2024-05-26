<?php
/**
  * Original asset redirect by godly... edited for use by geno on R08, and fire on Vanilla
  * Provides easier configuration and replaces incompatible classes with their original counterparts
  */

// Replace classes
$class_replacements = [
    "Accessory" => "Hat"
];

$id = $_GET['id'];

// Check if we have a replacement for this file

$asset_dirs = ['../char/hats/', '../char/faces/', '../char/shirts/', '../char/pants/', '../char/t-shirts/', '../char/packages/', '../web/', '../assetcache/'];
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
 $key = file_get_contents("..\web\privatekey.pem");
 openssl_sign($script, $sig, $key, OPENSSL_ALGO_SHA1);
 echo sprintf("--rbxsig%%%s%%%s", base64_encode($sig), $script);
 exit;
}

else
{
	// set up ua for audio fix
	ini_set('user_agent', 'Roblox/WinInet'); 
	
	// Let's get the contents of the asset from assetdelivery
	$asset = @file_get_contents("https://assetdelivery.roblox.com/v1/asset/?".$_SERVER["QUERY_STRING"]);
 
    // Gz decode if applicable
    !(substr($asset, 0, 2) == hex2bin('1f8b')) ?: ($asset = gzdecode($asset));
    
    // In-case yall are lazy to do version=1
    foreach($class_replacements as $class1 => $class2)
        $asset = str_replace("class=\"$class1\"", "class=\"$class2\"", $asset);
}

// Set headers
header("User-Agent: Roblox/WinInet");
header('Content-Type: application/octet-stream');

// Return the content, save, and kill the script
if (!file_exists("../assetcache/$id"))
{
file_put_contents("../assetcache/$id", $asset);
}
die($asset);
?>