<?php
$mysql_connect = mysqli_connect("localhost", "USERNAME", "PASSWORD", "bec_chat");//MySQL details

function chatLogFile(string $filename, bool $newest_first = false): array
{
    if ($newest_first) {
        return array_reverse(file($filename));//The newest message first
    }
    return file($filename);//file name
}

function chat_type(string $string): int
{
    if (str_contains($string, 'Side')) {
        return 0;
    } elseif (str_contains($string, 'Direct')) {
        return 1;
    } elseif (str_contains($string, 'Vehicle')) {
        return 2;
    } elseif (str_contains($string, 'Global')) {
        return 3;
    } elseif (str_contains($string, 'Command')) {
        return 4;
    } elseif (str_contains($string, 'Group')) {
        return 5;
    } else {
        return 6;//Unknown type
    }
}

$file = chatLogFile('chat.log');//Chat log file

$start = strlen('00:00:00 : Side: ');
foreach ($file as $line) {
    $ar = explode(":", $line);
    $time = "$ar[0]:$ar[1]:$ar[2]";
    $type = chat_type($ar[3]);
    $arr = explode(":", substr($line, $start), 2);
    $player = $ar[4];
    if (isset($ar[6])) {
        $one = str_replace(array("(", ")"), array("(:", "):"), $ar[5]);
        $two = str_replace(array(")", "("), array("):", "(:"), $ar[6]);
        $message = "$one $two";
    } else {
        $message = $ar[5];
    }
    $select = mysqli_query($mysql_connect, "SELECT `message` FROM `server1` WHERE `type` = '" . $type . "' AND `time` = '" . $time . "'");
    if (mysqli_num_rows($select) === 0) {//Doesnt exist yet
        $insert_q = "INSERT INTO `server1` (`type`, `time`, `player`, `message`) VALUES ('$type', '$time', '$player', '$message')";//MYSQL query
        $insert = mysqli_query($mysql_connect, $insert_q);
    }
    echo $insert_q . '<br>';//output query
}