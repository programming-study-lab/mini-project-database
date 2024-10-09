<?php
session_start();
if ($_POST) {
    $err = "";
    $email = $_POST['email'];
    $pass = $_POST['password'];

    include "dblink.php";

    $stmt = $link->prepare("SELECT UserID, Email, UserPassword, UserCode
                            FROM user WHERE Email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();

    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        if (password_verify($pass, $row['UserPassword'])) {
            $_SESSION['username'] = $row['Email'];
            
            $stmt = $link->prepare("UPDATE user SET Status = 'Online' WHERE Email = ?");
            $stmt->bind_param("s", $email);
            $stmt->execute();
            if ($row['UserCode'] == '$2y$12$hFLpweZ29gV0LdEgwtVlNOeLC2.UZtuGOS/Up9BmaE5T7XvX5L97e') {
                $_SESSION['user'] = '$2y$12$hFLpweZ29gV0LdEgwtVlNOeLC2.UZtuGOS/Up9BmaE5T7XvX5L97e';
                $_SESSION['ID'] = $row['UserID'];
            } else {
                $_SESSION['user'] = "user";
                $_SESSION['ID'] = $row['UserID'];
            }
            header("Location: index.php");
            // echo $_SESSION['user'];
            // header("refresh: 3; url=index.php");
            exit;
        } else {
            $err = "อีเมลหรือรหัสผ่านไม่ถูกต้อง";
        }
    } else {
        $err = "ไม่พบผู้ใช้งาน";
    }

    $stmt->close();
    $link->close();
    
}

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
            // include "header.php"; 
        ?>
        <br><br><br><br><br><br><br><br><br><br>
        <article> 
            <section id="content">
            <?php 
                if ($_POST) {
                    echo '<h4 class="error">' . $err . '</h4>';   
                }
                ?> 
                <form id="login" method="post">
                    <label>Email:</label><input type="text" name="email" required><br>
                    <label>Password:</label><input type="password" name="password" required><br>

                    <div><button type="login">ตกลง</button><br><br>
                    หากยังไม่มีได้ลงทะเบียนสามารถ <a href="register.php">ลงทะเบียนได้ที่นี่</a>
                    </div>
                </form>
        </section>
        </article> 

        <?php include "footer.php"; ?>
    </div>
</body>
</html>