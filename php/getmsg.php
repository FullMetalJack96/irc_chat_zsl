<?php
$lastid = $_GET["last"];
$sent = false;
$returned = array();
$dbConn = mysqli_connect("localhost", "root", "root", "chat");
if (mysqli_errno($dbConn)) die("Błąd podczas łączenia z MySQL");



$time = time();

while(time() - $time < 10) {
    
    $query = "DELETE FROM chat WHERE time<=" . (time() - 300);
    mysqli_query($dbConn, $query);

    usleep(50000);
    
    $query = "SELECT * FROM chat ORDER BY id DESC LIMIT 1";
    $result = mysqli_query($dbConn, $query);
    $row=mysqli_fetch_array($result, MYSQLI_NUM);
    
//    echo($row[0] . " " . $lastid);
//    break;
    
    if($row[0] > $lastid) {
        $query = "SELECT * FROM chat WHERE id > $lastid";
        $result = mysqli_query($dbConn,$query);
        while(($row = mysqli_fetch_array($result, MYSQLI_NUM))!= null) {
            array_push($returned, $row);
        }
        $sent = true;
        echo json_encode($returned);       
        break;
    }
    usleep(50000);
}

if(!$sent) {
    $returned["status"] = "no message";
}
mysqli_close($dbConn);