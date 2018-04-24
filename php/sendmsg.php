<?php

$dbConn = mysqli_connect("localhost", "root", "ay36b2EKWzyx9Fdb", "chat");
if (mysqli_errno($dbConn)) die("Błąd w połączeniu z MySQL");

if (isset($_POST["nick"]) && isset($_POST["message"]) && isset($_POST["color"])) {
    $query = "INSERT INTO chat(nick, msg, color) VALUES('" . mysqli_real_escape_string($dbConn,$_POST["nick"]) . "', '" . mysqli_real_escape_string($dbConn, $_POST["message"]) . "', '" . mysqli_real_escape_string($dbConn, $_POST["color"]) . "');";
    mysqli_query($dbConn, $query);

    if (mysqli_errno($dbConn)) {
        echo("Błąd!");
    } else {
        $query = "SELECT id FROM chat ORDER BY id DESC LIMIT 1";
        $result = mysqli_query($dbConn, $query);
        if(($row = mysqli_fetch_assoc($result))!= null) {
            echo $row["id"];
        }
    }
}

mysqli_close($dbConn);