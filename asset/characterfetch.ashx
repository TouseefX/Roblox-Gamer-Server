<?php
// hacky solution for Sodikm compatibility
if (isset($_GET["userId"]))
{
	$string =  $_GET['userId']; 
	$str_arr = preg_split ("/\,/", $string); 
  
	$string2 =  $_GET['userId'];
	$str_arr2 = explode (".", substr($string2, 0, strpos($string2, ","))); 
	echo "
http://www.roblox.com/asset/bodycolors.ashx?headc=$str_arr2[0]&larmc=$str_arr2[1]&rarmc=$str_arr2[2]&llegc=$str_arr2[3]&rlegc=$str_arr2[4]&torsoc=$str_arr2[5];http://www.roblox.com/asset/?id=$str_arr[1];http://www.roblox.com/asset/?id=$str_arr[2];http://www.roblox.com/asset/?id=$str_arr[3];http://www.roblox.com/asset/?id=$str_arr[4];http://www.roblox.com/asset/?id=$str_arr[5];http://www.roblox.com/asset/?id=$str_arr[6];http://www.roblox.com/asset/?id=$str_arr[7];http://www.roblox.com/asset/?id=$str_arr[8];http://www.roblox.com/asset/?id=$str_arr[9];http://www.roblox.com/asset/?id=$str_arr[10];http://www.roblox.com/asset/?id=$str_arr[11];http://www.roblox.com/asset/?id=$str_arr[12]";
}
else
{
  $hat1 = $_GET["hat1"];
  $hat2 = $_GET["hat2"];
  $hat3 = $_GET["hat3"];
  $shirt = $_GET["shirt"];
  $pants = $_GET["pants"];
  $tshirt = $_GET["tshirt"];
  $hc = $_GET["hc"];
  $tc = $_GET["tc"];
  $la = $_GET["la"];
  $ll = $_GET["ll"];
  $ra = $_GET["ra"];
  $rl = $_GET["rl"];
  echo "http://www.roblox.com/asset/bodycolors.ashx?headc=$hc&torsoc=$tc&larmc=$la&llegc=$ll&rarmc=$ra&rlegc=$rl;http://www.roblox.com/asset/?id=$hat1;http://www.roblox.com/asset/?id=$hat2;http://www.roblox.com/asset/?id=$hat3;http://www.roblox.com/asset/?id=$tshirt;http://www.roblox.com/asset/?id=$shirt;http://www.roblox.com/asset/?id=$pants";
}

?>