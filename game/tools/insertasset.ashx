<?php 

if (isset($_GET['nsets'])) {
if(file_exists("../../web/sets/user" . $_GET['userid'])) {
    header("Content-type: text/plain");
    die(file_get_contents("../../web/sets/user" . $_GET['userid']));
}
}
if (isset($_GET['sid'])) {
if(file_exists("../../../web/sets/set" . $_GET['sid'])) {
    header("Content-type: text/plain");
    die(file_get_contents("../../web/sets/set" . $_GET['sid']));
}
else
{
	echo "<List></List>";
}
}
?>