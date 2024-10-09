<!-- <script src="jquery.js"></script> -->

<?php
    $message = "";

    if ($_GET) {
        $stmt = $link->prepare("SELECT * FROM topic WHERE TopicID = ?");
                $stmt->bind_param("s", $_GET['topicID']);
                $stmt->execute();
                $res = $stmt->get_result();
                $row = $res->fetch_assoc();

        if ($row['UserID'] == $_GET['ID']) {
            $stmt = $link->prepare("DELETE FROM topic WHERE UserID = ? AND TopicID = ?");
            $stmt->bind_param("ss", $_SESSION['ID'], $_GET['topicID'] );
            $stmt->execute();
            header("Location: index.php");
        } else if ($_SESSION['ID'] == 1) {
            $stmt = $link->prepare("DELETE FROM topic WHERE TopicID = ?");
            $stmt->bind_param("s", $_GET['topicID'] );
            $stmt->execute();
            header("Location: index.php");
        } else {
            $message = "มีข้อผิดพลาดในการลบข้อมูล";
        }
        // echo $_SERVER['QUERY_STRING'];
    }

    // if ($message != "") {
    //     // echo "<script>alert('$message')</script>";
    //     // $message = "";
    //     // header("Location: index.php");
    //     // exit;
    // }
    // $stmt->close();
    // $link->close();

?>


<!-- <body>
    
    <form method="post">
        <button name="delete">ลบ</button>
    </form>

</body> -->
