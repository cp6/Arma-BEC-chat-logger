<?php

function chatLogFile(string $filename, bool $newest_first = false): array
{
    if ($newest_first) {
        return array_reverse(file($filename));//The newest message first
    }
    return file($filename);//file name
}

function chatType(string $string): int
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

$db = new PDO('mysql:host=127.0.0.1;dbname=bec_chat;charset=utf8mb4', 'username', 'password');

$file = chatLogFile('chat.log');//Chat log file

foreach ($file as $line) {
    $ar = explode(":", $line);
    $time = "$ar[0]:$ar[1]:$ar[2]";
    $type = chatType($ar[3]);
    $arr = explode(":", substr($line, strlen('00:00:00 : Side: ')), 2);
    $player = $ar[4];
    if (isset($ar[6])) {
        $one = str_replace(["(", ")"], ["(:", "):"], $ar[5]);
        $two = str_replace([")", "("], ["):", "(:"], $ar[6]);
        $message = "$one $two";
    } else {
        $message = $ar[5];
    }

    $select = $db->prepare("SELECT `message` FROM `server1` WHERE `type` = ? AND `time` = ?;");
    $select->execute([$type, $time]);
    $row = $select->fetch(PDO::FETCH_ASSOC);
    if (empty($row)) {//Row not found
        $insert = $db->prepare("INSERT INTO `server1` (`type`, `time`, `player`, `message`) VALUES (?, ?, ?, ?);");
        $insert->execute([$type, $time, $message, $player]);
        echo "INSERTED: [$type][$time][$player][$message]<br>";
    }
}
