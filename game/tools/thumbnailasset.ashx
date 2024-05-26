<?php
ini_set("allow_url_fopen", 1);
$url = 'https://thumbnails.roblox.com/v1/assets?assetIds='. $_GET["aid"] .'&returnPolicy=PlaceHolder&size=420x420&format=Png&isCircular=false';
$obj = json_decode(file_get_contents($url), true);
 //var_dump($obj);

header("Location: " . $obj['data'][0]['imageUrl']);
?>