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

        @media (max-width: 480px) {
            .orange {
                display: none;
            }
        }
    </style>
</head>
<body>
<?php
$db = new PDO('mysql:host=127.0.0.1;dbname=bec_chat;charset=utf8mb4', 'username', 'password');
$select = $db->query("SELECT `player`, `message`, `date` FROM `server1` WHERE `type` = 0 ORDER BY `id` DESC LIMIT 250;");
while ($row = $select->fetch(PDO::FETCH_ASSOC)) {
    $player = $row["player"];
    $message = $row["message"];
    $db_date = $row["date"];
    $datetime = date("g:i:s A D jS M", strtotime($db_date));
    echo "<p class='pink'>$player</p> <p class='green'>:</p> <p class='blue'>$message</p> <p class='orange'>$datetime</p><br>";//Output data with styles
}
?>
</body>
</html>
