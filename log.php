<?php
$mysql_connect = mysqli_connect("localhost", "USERNAME", "PASSWORD", "bec_chat");//MySQL details

function chatLogFile($filename, $newest_first = false)
{
    if ($newest_first) {
        return array_reverse(file($filename));//The newest message first
    } else {
        return file($filename);//file name
    }
}

function chat_type($string): int
{
    if (strpos($string, 'Side') !== false) {
        return 0;
    } elseif (strpos($string, 'Direct') !== false) {
        return 1;
    } elseif (strpos($string, 'Vehicle') !== false) {
        return 2;
    } elseif (strpos($string, 'Global') !== false) {
        return 3;
    } elseif (strpos($string, 'Command') !== false) {
        return 4;
    } elseif (strpos($string, 'Group') !== false) {
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
        $one = str_replace("(", "(:", $ar[5]);
        $one = str_replace(")", "):", $one);
        $two = str_replace(")", "):", $ar[6]);
        $two = str_replace("(", "(:", $two);
        $message = "$one $two";
    } else {
        $message = $ar[5];
    }
    $select = mysqli_query($mysql_connect, "SELECT `message` FROM `server1` WHERE `type` = '" . $type . "' AND `time` = '" . $time . "'");
    if (mysqli_num_rows($select) == 0) {//Doesnt exist yet
        $insert_q = "INSERT INTO `server1` (`type`, `time`, `player`, `message`) VALUES ('$type', '$time', '$player', '$message')";//MYSQL query
        $insert = mysqli_query($mysql_connect, $insert_q);
    }
    echo $insert_q . '<br>';//output query
}