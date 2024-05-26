<?php
//header('Content-Type: application/octet-stream');
header('Content-Type: text/html; charset=utf-8');
//admins
$admins = [
	232,
	71217160,
	3174711,
	1337617,
	170263,
	38542771,
	391038733,
	115,
	8243709,
	2723542,
	9009123
];

if ($_GET["method"] == "IsBestFriendsWith") {
	echo '<Value Type="boolean">false</Value>';
}
if ($_GET["method"] == "IsFriendsWith") {
	echo '<Value Type="boolean">false</Value>';
}
if ($_GET["method"] == "IsInGroup") {
	if ($_GET['groupid'] == "1200769") {
		if (in_array((int)$_GET['playerid'], $admins)) {
			$value = 'true';
		} else {
			$value = 'false';
		}
	} else {
		$value = 'false';
	}
	echo '<Value Type="boolean">'.$value.'</Value>';
}
if ($_GET["method"] == "GetGroupRank") {
	if ($_GET['groupid'] == "1200769") {
		if (in_array((int)$_GET['playerid'], $admins)) {
			$value = 'true';
		} else {
			$value = 'false';
		}
	} else {
		$value = 'false';
	}
	echo '<Value Type="boolean">'.$value.'</Value>';
}
?>