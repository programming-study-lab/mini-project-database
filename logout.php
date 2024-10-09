<?php

    session_start();

    include "dblink.php";

    // echo $_SESSION['ID'];

    $stmt = $link->prepare("UPDATE user SET Status = 'Offline' WHERE UserID = ?");
    $stmt->bind_param("s", $_SESSION['ID']);
    $stmt->execute();

    $stmt->close();
    $link->close();
    
    session_destroy();
    // header("refresh: 3; url=login.php");
    header("Location: login.php");
    exit;

?>