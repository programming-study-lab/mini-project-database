<?php
include "check_admin.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Webboard</title>
    <style>
        h1{
            color: red;
            text-align: center;
        }
        h3{
            text-align: center;
        }
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
        
        label{
            font-size: 25px;
            padding: 3px 2px;
            margin: 4px 50px;
            color: red;
            text-align: center;
        }
        button{
            border: none;
            color: black;
            padding: 15px 32px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 25px;
            margin: 4px 50px;
            cursor: pointer;
            border-radius: 13px;
        }
        button.Yes{
            background-color: red;
            text-align: center;
            border: 2px solid black;
        }
        button.No{
            background-color: blue;
            text-align: center;
            border: 2px solid black;
        }
    </style>
<?php
    include "dblink.php";
    $stmt = $link->prepare("SELECT UserID, Email, FirstName, LastName
                            FROM user
                            WHERE UserID = ?");
    $stmt->bind_param("s", $_GET['deleteUser']);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
?>

</head>
<body>
    <br><br><br><br><br>
<h1>ลบผู้ใช้งาน</h1>

<div>
<form id="text">
    <label>User ID: </label><?php echo $row['UserID'] ?><br>
    <label>Email: </label><?php echo $row['Email'] ?><br>
    <label>ชื่อ: </label><?php echo $row['FirstName'] ?><br>
    <label>นามสกุล: </label><?php echo $row['LastName'] ?><br>
</form>
    </div>

<br>
<form method="post">
<div>
    <button class="Yes" name="Yes" value="1">ยืนยัน</button>
    <button class="No" name="No" value="1">ยกเลิก</button>
</div>
</form>

</body>
</html>

<?php
    if (isset($_POST['Yes'])) {
        // echo "<h3>yes</h3>";
        if (isset($_GET)) {
            $dl = $link->prepare("DELETE FROM user WHERE UserID = ?");
            $dl->bind_param("s", $_GET['deleteUser']);
            $dl->execute();
            header("Location: admin.php");
        }
    } else {}
    if (isset($_POST['No'])) {
        // echo "<h3>No</h3>";
        if (isset($_GET)) {
            header("Location: admin.php");
        }
    } else {}

    
?>