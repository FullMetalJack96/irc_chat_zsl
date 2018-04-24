<?php
$dbConn = mysqli_connect("localhost", "root", "ay36b2EKWzyx9Fdb", "chat");

$query = "SELECT id FROM chat ORDER BY id DESC LIMIT 1";
$result = mysqli_query($dbConn, $query);
if(($row = mysqli_fetch_assoc($result)) != null) {
    echo($row["id"]);
}

mysqli_close($dbConn);