 <?php
$servername = "localhost";
$username = "sodikmplus";
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
	$headc = $_GET['headc'];
	$larmc = $_GET['larmc'];
	$llegc = $_GET['llegc'];
	$rarmc = $_GET['rarmc'];
	$rlegc = $_GET['rlegc'];
	$torsoc = $_GET['torsoc'];
	$tshirt = $_GET['tshirt'];
	$shirt = $_GET['shirt'];
	$pants = $_GET['pants'];
	$face = $_GET['face'];
	$hat1 = $_GET['hat1'];
	$hat2 = $_GET['hat2'];
	$hat3 = $_GET['hat3'];
	$torsop = $_GET['torsop'];
	$lap = $_GET['lap'];
	$llp = $_GET['llp'];
	$rap = $_GET['rap'];
	$rlp = $_GET['rlp'];
	$hp = $_GET['hp'];
	$userid = $_GET['userid'];
// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}
if (isset($_GET['userid'])) {
$sql2 = "DELETE FROM users WHERE requestaddr LIKE '%" . getIP() . "%'";
$conn->query($sql2);
$sql = "INSERT INTO users (torsocolor, leftlegcolor, leftarmcolor, rightlegcolor, rightarmcolor, headcolor, asset1, asset2, asset3, asset4, asset5, asset6, asset7, asset8, asset9, asset10, asset11, asset12, asset13, requestip, userid)
VALUES ('$torsoc', '$llegc', '$larmc', '$rlegc', '$rarmc', '$headc', '$tshirt', '$shirt', '$pants', '$face', '$hat1', '$hat2', '$hat3', '$torsop', '$lap', '$llp', '$rap', '$rlp', '$hp', ". getIP() . ", '$userid')";
if (mysqli_query($conn, $sql)) {
  echo "set";
} else {
  echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}
}


mysqli_close($conn);
?> 

