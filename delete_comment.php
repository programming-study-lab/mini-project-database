
<?php
    session_start();

$message = "";
// echo $_SERVER['QUERY_STRING'];
$bufferTopicID = $_GET['topicID'];
$topicID = "topicID=".$bufferTopicID;
if ($_GET) {
    include "dblink.php";
    $stmt = $link->prepare("SELECT * FROM comment");
            $stmt->execute();
            $res = $stmt->get_result();
            $row = $res->fetch_assoc();
    if ($row['UserID'] == $_SESSION['ID']) {
        $stmt = $link->prepare("DELETE FROM comment WHERE UserID = ? AND CommentID = ?");
        $stmt->bind_param("ss", $_SESSION['ID'], $_GET['commentID'] );
        $stmt->execute();
        header("Location: comment.php?$topicID");
        // exit;
    } else if ($_SESSION['ID'] == 1) {
        $stmt = $link->prepare("DELETE FROM comment WHERE CommentID = ?");
        $stmt->bind_param("s", $_GET['commentID'] );
        $stmt->execute();
        header("Location: comment.php?$topicID");
    } else {
        $message = "มีข้อผิดพลาดในการลบข้อมูล";
        header("Location: comment.php?$topicID");
    }
    // echo $_SERVER['QUERY_STRING'];
    echo "<script>alert('$message')</script>";
}   

?>

