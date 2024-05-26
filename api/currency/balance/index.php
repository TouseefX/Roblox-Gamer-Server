<?php
$data = file_get_contents('php://input');
$fp = fopen('post.txt', 'w');
fwrite($fp, serialize($data));
fclose($fp);
?>
{
    "robux": 69,
    "tickets": -420
}