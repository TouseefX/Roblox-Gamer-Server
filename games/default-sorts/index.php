<?php
//[{ "Id": 23, "Name": "Most Engaging", "TimeOptionsAvailable": false, "DefaultTimeOption": 0, "GenresOptionsAvailable": true, "NumberOfRows": 1, "GameSetTargetId": 80 }, { "Id": 23, "Name": "Up-and-Coming", "TimeOptionsAvailable": false, "DefaultTimeOption": 0, "GenresOptionsAvailable": true, "NumberOfRows": 1, "GameSetTargetId": 60 }, { "Id": 1, "Name": "Popular", "TimeOptionsAvailable": false, "DefaultTimeOption": 0, "GenresOptionsAvailable": true, "NumberOfRows": 1, "GameSetTargetId": 0 }, { "Id": 11, "Name": "Top Rated", "TimeOptionsAvailable": true, "DefaultTimeOption": 0, "GenresOptionsAvailable": true, "NumberOfRows": 1, "GameSetTargetId": 0 }, { "Id": 16, "Name": "Recommended", "TimeOptionsAvailable": false, "DefaultTimeOption": 0, "GenresOptionsAvailable": true, "NumberOfRows": 1, "GameSetTargetId": 0 }, { "Id": 23, "Name": "Play Together (Free Private Servers)", "TimeOptionsAvailable": false, "DefaultTimeOption": 0, "GenresOptionsAvailable": true, "NumberOfRows": 1, "GameSetTargetId": 71 }, { "Id": 23, "Name": "Learn \u0026 Explore", "TimeOptionsAvailable": false, "DefaultTimeOption": 0, "GenresOptionsAvailable": true, "NumberOfRows": 1, "GameSetTargetId": 67 }, { "Id": 3, "Name": "Featured", "TimeOptionsAvailable": false, "DefaultTimeOption": 0, "GenresOptionsAvailable": false, "NumberOfRows": 1, "GameSetTargetId": 0 }, { "Id": 23, "Name": "Popular Among Premium", "TimeOptionsAvailable": false, "DefaultTimeOption": 0, "GenresOptionsAvailable": true, "NumberOfRows": 1, "GameSetTargetId": 94 }, { "Id": 23, "Name": "Rthro", "TimeOptionsAvailable": false, "DefaultTimeOption": 0, "GenresOptionsAvailable": true, "NumberOfRows": 1, "GameSetTargetId": 5 }, { "Id": 8, "Name": "Top Earning", "TimeOptionsAvailable": false, "DefaultTimeOption": 0, "GenresOptionsAvailable": true, "NumberOfRows": 1, "GameSetTargetId": 0 }, { "Id": 23, "Name": "Players Love", "TimeOptionsAvailable": false, "DefaultTimeOption": 0, "GenresOptionsAvailable": true, "NumberOfRows": 1, "GameSetTargetId": 81 }, { "Id": 23, "Name": "Roleplay", "TimeOptionsAvailable": false, "DefaultTimeOption": 0, "GenresOptionsAvailable": true, "NumberOfRows": 1, "GameSetTargetId": 64 }, { "Id": 23, "Name": "Adventure", "TimeOptionsAvailable": false, "DefaultTimeOption": 0, "GenresOptionsAvailable": true, "NumberOfRows": 1, "GameSetTargetId": 63 }, { "Id": 23, "Name": "Fighting", "TimeOptionsAvailable": false, "DefaultTimeOption": 0, "GenresOptionsAvailable": true, "NumberOfRows": 1, "GameSetTargetId": 62 }, { "Id": 23, "Name": "Obby", "TimeOptionsAvailable": false, "DefaultTimeOption": 0, "GenresOptionsAvailable": true, "NumberOfRows": 1, "GameSetTargetId": 56 }, { "Id": 23, "Name": "Tycoon", "TimeOptionsAvailable": false, "DefaultTimeOption": 0, "GenresOptionsAvailable": true, "NumberOfRows": 1, "GameSetTargetId": 58 }, { "Id": 23, "Name": "Simulator", "TimeOptionsAvailable": false, "DefaultTimeOption": 0, "GenresOptionsAvailable": true, "NumberOfRows": 1, "GameSetTargetId": 57 }]
$sorts = [
    [
        "Id" => 1,
        "Name" => "All Servers",
        "TimeOptionsAvailable" => false,
        "DefaultTimeOption" => 0,
        "GenresOptionsAvailable" => true,
        "NumberOfRows" => 2,
        "GameSetTargetId" => 80
    ],
    [
        "Id" => 2,
        "Name" => "Online Servers",
        "TimeOptionsAvailable" => false,
        "DefaultTimeOption" => 0,
        "GenresOptionsAvailable" => true,
        "NumberOfRows" => 1,
        "GameSetTargetId" => 80
    ],
];

header('Content-Type:application/json');
die(json_encode($sorts));
?>
