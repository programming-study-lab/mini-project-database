<?php
    try {
    $servername = "localhost";
    $db_UserName = "5]-Cei3p(mA-OTW*";
    $db_Password = "1OF]gTStHk!W8_(@";
    $db_Name = "web";

    $link = new mysqli($servername, $db_UserName, $db_Password, $db_Name);

    if ($link->connect_error) {
        die("การเชื่อมต่อล้มเหลว: ". $link->connect_error);
    }
    } catch (Exception $e) {
        $e->getMessage();
    }
    
?>