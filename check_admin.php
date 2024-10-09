<?php 
    session_start();
    if ($_SESSION['user'] != '$2y$12$hFLpweZ29gV0LdEgwtVlNOeLC2.UZtuGOS/Up9BmaE5T7XvX5L97e') {
        header("Location: user.php");
        exit;
    }
    
?>

