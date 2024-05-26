<head>
<title>Vanilla Mobile | Servers</title>
<!--TODO: Theming?-->
<style>
table, th, td {
    border:0.1px solid black;
}
green {
    color: green;
}
red {
    color: red;
}
</style>
</head>
<body>
<h3>Server List</h3>
<p>These are taken from servers.txt, So edit it to your heart's delight!</p>
<hr>
<?php
// This function checks the status of a server
//
// $server_ip: The IP of the server you want to check
// $server_port: The Port of the server you want to check
//
// Return: The server's status surounded by HTML tags (String)
//
//This fucncion could be cleaned up -Lanausse
function getServerStatus($server_ip, $server_port) {

    $roblox_packet_id   = 0x05; //ID_OPEN_CONNECTION_REQUEST_1
    $magic              = [0x00,0xff,0xff,0x00,0xfe,0xfe,0xfe,0xfe,0xfd,0xfd,0xfd,0xfd,0x12,0x34,0x56,0x78];
    $potocol_ver        = 0x05;

    $packet = pack('h', $roblox_packet_id);
    //If it works it works
    foreach ($magic as $byte) {
        $packet .= chr($byte);
    }
    $packet .= pack('h', $potocol_ver);
    for ($i = 0; $i < 1446; $i++) { //Padding
        $packet .= chr(0x00);
    }

    //Could be cleaned up
    $socket = socket_create(AF_INET, SOCK_DGRAM, SOL_UDP);
    socket_set_option($socket,SOL_SOCKET, SO_RCVTIMEO, array("sec"=>5, "usec"=>0)); //5 second timeout
    $connected = socket_connect($socket, $server_ip, $server_port);
    if ($connected) {
        socket_write($socket, $packet, strlen($packet));
        $responce = socket_read($socket,28);
        if ($responce != false) {
            if (implode(unpack('h*', $responce))[0] == 0x06) { 
                return "<green>Online</green>";
            } else {
                return "<i>Unknown</i>"; //Something is here, but it doesn't seem to be Roblox
            }
        } else {
            return "<red>Offline</red>";
        }
    } else {
        return "<red>Offline</red>";
    }

    socket_close($socket);
}

// Read the JSON file into a string
$servers_json = file_get_contents('../../servers.txt');

// Decode the JSON string into an associative array
$servers = json_decode($servers_json, true);

// Check if decoding was successful
if ($servers === null) {
    die("Error parsing JSON.");
}

// Iterate through the servers and display them
echo "<center>";
echo "<table>";
foreach ($servers as $placeid => $server) {
    $address = $server['address'];
    $port =  $server['port'];
    $name = $server['name'];
    echo "<tr>";
    echo "<td>$placeid</td>"; 
    echo "<td><a href='games/start?placeid=$placeid'>$name</a></td>";
    echo "<td><b>".getServerStatus($address, $port)."</b></td>";
    echo "</tr>";
}
echo "</table>";
echo "</center>";
?>
</p>

</body>