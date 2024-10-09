<?php
    include "check_user.php";
?>

<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Webboard</title>
    <style>

        form {
            width: 600px;
            border: solid 0px green;
            border-radius: 8px;
            margin: 10px auto 15px;
            padding: 10px 0px;
            background: #cee;
        }

        form label {
            display: inline-block;
            width: 200px;
            text-align: right;
            padding: 5px;
        }

        form div {
            text-align: center;
            margin: 10px;
        }

        button {
            background: steelblue;
            color: white;
            border: solid 1px orange;
            padding: 3px;
            width: 80px;
        }

        button:hover {
            color: aqua;
            cursor: pointer;
        }

        h4.error {
            color: red;
            text-align: center;
        }
    </style>
</head>

<body>
<div id="container">
        <?php 
            include "header.php"; 
        ?>
        <br><br><br>
        <article> 
            <section id="content">
            <?php 
                    include "dblink.php";

                    $stmt = $link->prepare("SELECT Email, FirstName, LastName FROM user WHERE UserID = ?");
                    $stmt->bind_param("s", $_SESSION['ID']);
                    $stmt->execute();
                    $result = $stmt->get_result();
                    $row = $result->fetch_assoc();

                    $link->close();
                    $stmt->close();

                ?> 
                <form id="login" action="edit_profile.php">
                    <div>ข้อมูลผู้ใช้งาน</div><br>
                    <label>Email: </label><?php echo $row['Email'] ?><br>
                    <label>ชื่อ: </label><?php echo $row['FirstName'] ?><br>
                    <label>นามสกุล: </label><?php echo $row['LastName'] ?><br>
                    <!-- <div>
                        <button type="editProfile">Edit Profile</button>
                    </div> --> 
                </form>
        </section>
        </article> 

        <?php include "footer.php"; ?>
    </div>
</body>
</html>