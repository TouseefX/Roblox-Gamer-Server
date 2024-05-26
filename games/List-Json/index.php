<?php 
// This function checks the status of a server
//
// $server_ip: The IP of the server you want to check
// $server_port: The Port of the server you want to check
//
// Return: true if the server is online. False if it isn't
//
//This fucncion could be cleaned up -Lanausse
function getServerStatus($server_ip, $server_port) : bool {

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
    socket_set_option($socket,SOL_SOCKET, SO_RCVTIMEO, array("sec"=>2, "usec"=>0)); //5 second timeout
    $connected = socket_connect($socket, $server_ip, $server_port);
    if ($connected) {
        socket_write($socket, $packet, strlen($packet));
        $responce = socket_read($socket,28);
        if ($responce != false) {
            if (implode(unpack('h*', $responce))[0] == 0x06) { 
                return true;
            } else {
                return false; //Something is here, but it doesn't seem to be Roblox
            }
        } else {
            return false;
        }
    } else {
        return false;
    }

    socket_close($socket);
}

$servers_json = file_get_contents('../../servers.txt');

// Decode the JSON string into an associative array
$servers = json_decode($servers_json, true);

// Check if decoding was successful
if ($servers === null) {
    die("Error parsing JSON.");
}

//Jaaaaaaaaaaaaaaank
$server_list = [];
foreach ($servers as $placeid => $server) {
    if ($_GET["sortFilter"] == 2) { //Online
        if (getServerStatus($server['address'], $server['port'])) {
            array_push($server_list,
                    [
                        "CreatorID" => 21557,
                        "CreatorName" => "Games",
                        "CreatorUrl" => "/User.aspx?ID=21557",
                        "Plays" => 4911454,
                        "Price" => 0,
                        "IsVotingEnabled" => true,
                        "TotalUpVotes" => 11645,
                        "TotalDownVotes" => 1103,
                        "TotalBought" => 0,
                        "HasErrorOcurred" => false,
                        "Name" => $server['name'],
                        "PlaceID" => $placeid,
                        "PlayerCount" => 53
                    ],
            );
        }
    } else {
        array_push($server_list,
                [
                    "CreatorID" => 21557,
                    "CreatorName" => "Games",
                    "CreatorUrl" => "/User.aspx?ID=21557",
                    "Plays" => 4911454,
                    "Price" => 0,
                    "IsVotingEnabled" => true,
                    "TotalUpVotes" => 11645,
                    "TotalDownVotes" => 1103,
                    "TotalBought" => 0,
                    "HasErrorOcurred" => false,
                    "Name" => $server['name'],
                    "PlaceID" => $placeid,
                    "PlayerCount" => 53
                ],
        );
    } 
}


header('Content-Type:application/json');
die(json_encode($server_list));
?>
