<?php
    require_once($_SERVER["DOCUMENT_ROOT"] . "/Game/Sign.php");
    header("Content-Type: text/plain");

    $user = addslashes($_GET["user"]);
    $ip = addslashes($_GET["ip"]);
    $port = addslashes($_GET["port"]);
    $id = addslashes($_GET["id"]);
    $capp = addslashes($_GET["capp"]);
    $mship = addslashes($_GET["mship"]);
    $pid = addslashes($_GET["PlaceId"]);
    
    if(preg_match("/[a-z]/i", $mship)){
        $mship = 0;
    }
    if ($mship == null) {
        $mship = 0;
    }
    if ($mship > 3) {
        $mship = 0;
    }
    if(preg_match("/[a-z]/i", $id)){
        $id = "1";
    }
    if(preg_match("/[a-z]/i", $port)){
        $port = "53640";
    }

    // Construct joinscript
    $joinscript = [
        "jobID" => 0,
        "status" => 2,
        "joinScriptUrl" => "http://www.epiccc.xyz/Game/Join16.php",
        "authenticationUrl" => "http://www.epiccc.xyz",
        "authenticationTicket" => "432",
        "message" => "test"
    ];

    // Encode it!
    $data = json_encode($joinscript, JSON_UNESCAPED_SLASHES | JSON_NUMERIC_CHECK);

    // Sign joinscript
    $signature = get_signature("\r\n" . $data);

    // exit
    exit("--rbxsig%". $signature . "%\r\n" . $data);
?>