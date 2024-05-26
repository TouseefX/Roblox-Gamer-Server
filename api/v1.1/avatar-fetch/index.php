 <?php
$servername = "localhost";
$username = "sodikmmobile";
$password = "Erm!ILoveGock!";
$dbname = "sodikmcharapps";
function getIP()
{
    if (isset($_SERVER["HTTP_CF_CONNECTING_IP"])) {
              $_SERVER['REMOTE_ADDR'] = $_SERVER["HTTP_CF_CONNECTING_IP"];
              $_SERVER['HTTP_CLIENT_IP'] = $_SERVER["HTTP_CF_CONNECTING_IP"];
    }
    $client  = @$_SERVER['HTTP_CLIENT_IP'];
    $forward = @$_SERVER['HTTP_X_FORWARDED_FOR'];
    $remote  = $_SERVER['REMOTE_ADDR'];

    if(filter_var($client, FILTER_VALIDATE_IP))
    {
        $ip = $client;
    }
    elseif(filter_var($forward, FILTER_VALIDATE_IP))
    {
        $ip = $forward;
    }
    else
    {
        $ip = $remote;
    }

    return $ip;
}
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
$sql = "SELECT torsocolor, leftlegcolor, leftarmcolor, rightlegcolor, rightarmcolor, headcolor, asset1, asset2, asset3, asset4, asset5, asset6, asset7, asset8, asset9, asset10, asset11, asset12, asset13 FROM users WHERE userid LIKE '%". $_GET["userId"] ."%'";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
$tc = $row['torsocolor'];
$llc = $row['leftlegcolor'];
$lac = $row['leftarmcolor'];
$rlc = $row['rightlegcolor'];
$rac = $row['rightarmcolor'];
$hc = $row['headcolor'];
$a1 = $row['asset1'];
$a2 = $row['asset2'];
$a3 = $row['asset3'];
$a4 = $row['asset4'];
$a5 = $row['asset5'];
$a6 = $row['asset6'];
$a7 = $row['asset7'];
$a8 = $row['asset8'];
$a9 = $row['asset9'];
$a10 = $row['asset10'];
$a11 = $row['asset11'];
$a12 = $row['asset12'];
$a13 = $row['asset13'];
$conn->close();

?> 
{"resolvedAvatarType":"R6","accessoryVersionIds":[<?php echo $a1?>,<?php echo $a2?>,<?php echo $a3?>,<?php echo $a4?>,<?php echo $a5?>,<?php echo $a6?>,<?php echo $a7?>,<?php echo $a8?>,<?php echo $a9?>,<?php echo $a10?>,<?php echo $a11?>,<?php echo $a12?>,<?php echo $a13?>],"equippedGearVersionIds":[],"backpackGearVersionIds":[],"bodyColors":{"HeadColor":<?php echo $hc?>,"LeftArmColor":<?php echo $lac?>,"LeftLegColor":<?php echo $llc?>,"RightArmColor":<?php echo $rac?>,"RightLegColor":<?php echo $rlc?>,"TorsoColor":<?php echo $tc?>},"animations":{"Run":969731563},"scales":{"Width":1.0000,"Height":1.0500,"Head":1.0000,"Depth":1.00,"Proportion":0.0000,"BodyType":0.0000}}