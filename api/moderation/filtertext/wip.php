<?php
$naughtywords = array(
    "nigga", "nigger"
);
$input = $_GET["input"];
if (in_array($input, $naughtywords)) {
    echo "Got mac";
}
?>
 <?php
$str = "Visit W3Schools";
$pattern = "/w3schools/i";
echo preg_match($pattern, $str);
?> 