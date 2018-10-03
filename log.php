<?php
$connect = mysqli_connect("localhost", "USERNAME", "PASSWORD", "bec_chat");//MySQL details
$file = file('chat.log');//file name
//$file = array_reverse(file('chat.log'));//if we want to have the newest message first
$start = strlen('00:00:00 : Side: ');
function chat_type($string)
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
    }
}
foreach ($file as $line) {
    $ar = explode(":", $line);
    $time = "$ar[0]:$ar[1]:$ar[2]";
    $type = $ar[3];
    $type = chat_type($type);//turns string (word) to int (number).
    $content = substr($line, $start);
    $arr = explode(":", $content, 2);
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
    $select = "SELECT `message` FROM `server1` WHERE `type` = '" . $type . "' AND `time` = '" . $time . "'";//MYSQL query
    $result = mysqli_query($connect, $select);
    if (mysqli_num_rows($result) > 0) {
        // already in db
    } else {
        $sql = "INSERT INTO `server1` (`type`, `time`, `player`, `message`, `date`) VALUES ('$type', '$time', '$player', '$message', '$date')";//MYSQL query
        $result = mysqli_query($connect, $sql);
    }
    echo "$sql<br>";//output what our query was
}
