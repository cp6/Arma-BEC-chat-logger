<html>
<head>
    <style>
        p {
            display: inline;
            font-size: 1.1rem;
        }

        body {
            background: #1e2132;
        }

        .pink {
            color: #db4a76;
        }

        .green {
            color: #00d27f;
        }

        .blue {
            color: #0e90d2;
        }

        .orange {
            color: #d27d5a;
        }
    </style>
</head>
<?php
$connect = mysqli_connect("localhost", "root", "", "bec_chat");//MYSQL details
$date = date('Y-m-d H:i:s');
//DISPLAY SECTION
$sql = "SELECT `player`, `message`, `date` FROM `server1` WHERE `type` = 0 ORDER BY `id` DESC LIMIT 250;";
$result = mysqli_query($connect, $sql);
while ($row = $result->fetch_assoc()) {
    $player = $row["player"];
    $message = $row["message"];
    $db_date = $row["date"];
    $datetime = date("g:i:s A D jS M", strtotime($db_date));
    echo "<body><p class='pink'>$player</p> <p class='green'>:</p> <p class='blue'>$message</p> <p class='orange'>$datetime</p><br></body>";
};
?>
</html>
