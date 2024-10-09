<?php
session_start();
echo $_GET['test'];
if ($_POST) {
    $email = $_POST['email'];
    $pass = $_POST['password'];
    $rePass = $_POST['password2'];
    $fName = $_POST['firstname'];
    $lName = $_POST['lastname'];
    //$code = $_POST['code'];
    $err = "";

    include "dblink.php";

    $stmt = $link->prepare("SELECT Email
                            FROM user 
                            WHERE Email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();

    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        if ($email == $row['Email']) {
            $err = "อีเมล : $email เคยลงทะเบียไว้แล้ว";
        }
    }
    if ($pass != $rePass) {
        $err = "รหัสผ่านไม่ตรงกัน";
    }

    if ($err == "") {
        $stmt = $link->prepare("UPDATE user
                                SET Email =  ?
		                        WHERE UserID = ?;"); /// เปลี่ยน เป็น UPDATE user SET Email, UserPasswordWHERE UserID 
        $option = ['cost' => 12, ];
        $hashedPass = password_hash($pass, PASSWORD_BCRYPT, $option);
        $stmt->bind_param("sssss", $email, $hashedPass, $fName, $lName, $hashedPass);
        if (!$stmt->execute()) {
            echo "เกิดข้อผิดพลาด";
        }
    }
    if ($err != "") {
        echo "<script>alert('$err');</script>";
        $stmt->close();
        $link->close();
        header("refresh: 1; url=register.php");
        exit;
    }


    echo "<h3>กำลังบันทึกข้อมูล</h3>";
    header("refresh: 3; url=login.php");

    $stmt->close();
    $link->close();
    exit;
}


?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <style>
        form {
            width: 600px;
            border: solid 0px green;
            border-radius: 8px;
            margin: 10px auto 15px;
            padding: 10px 0px;
            background: #cee;
        }

        form input {
            width: 200px;
            background: #ffd;
            border: solid 1px gray;
            padding: 2px;
            color: blue;
        }

        form label {
            display: inline-block;
            width: 200px;
            text-align: right;
            padding: 5px;
        }

        form div {
            text-align: center;
            margin-top: 10px;
        }

        form button {
            background: steelblue;
            color: white;
            border: solid 1px orange;
            padding: 3px;
            width: 80px;
            margin-right: 50px;
        }

        form button:hover {
            color: aqua;
            cursor: pointer;
        }
    </style>

</head>

<body>
    <div id="container">
        <?php 
            // include "header.php"; 
        ?>
        <br><br><br><br><br><br><br><br><br><br>
        <article>
            <form method="post">
                <?php 
                    echo '<label>ชื่อ:</label><input type="text" name="firstname" required><br>' 
                ?>
                <label>นามสกุล:</label><input type="text" name="lastname" required><br>
                <br>
                <label>Email:</label><input type="email" name="email" required><br>
                <label>Password:</label><input type="password" name="password" required><br>
                <label>Re-Password:</label><input type="password" name="password2" required><br>
                <div>
                    <button>ตกลง</button>
                    <a href="index.php">ยกเลิก</a>
                </div>
            </form>
        </article>
        <?php include "footer.php"; ?>
    </div>
</body>
</html>