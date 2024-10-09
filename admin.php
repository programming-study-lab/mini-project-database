<?php
    include "check_admin.php";
?>

<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <title>Webboard</title>
    <style>
        div.butt>a {
			width: 100px;
			/* border: black 1px black; */
			border-radius: 5px;
			background: red;
			padding: 2px 5px;
			margin: 2px;    
			text-decoration: none;
			font-size: 15px;
            color: black;
		}
        div.butt {
			width: 100%;
			display: inline-table;
			text-align: center;
		}
        h3{
            text-align: center;
        }
    </style>        
</head>

<body>

    <div id="container">
        <?php
        include "header.php";
        ?>
        <article>
            <section id="top">
                <h3>ลบผู้ใช้งาน</h3>
            </section>
            <section id="content">
                <?php
                    include "dblink.php";
                    $stmt = $link->prepare("SELECT * FROM user");
                    $stmt->execute();
                    $result = $stmt->get_result();
                    // $row = $result->fetch_assoc();
                    // $name_Row = $result->fetch_row();
                    $nameRow = array("UserID", "Email", "FirstName", 
                                    "LastName", "Role", "Status", 
                                    "Registration date", "DeleteUser");
                        ?>
<!DOCTYPE html>
<html>
<style>
table, th, td {
  border:1px solid black;
}
</style>
<body>

<table style="width: 100%;">
  <tr>
    <th><?php echo $nameRow[0] ?></th>
    <th><?php echo $nameRow[1] ?></th>
    <th><?php echo $nameRow[2] ?></th>
    <th><?php echo $nameRow[3] ?></th>
    <th><?php echo $nameRow[4] ?></th>
    <th><?php echo $nameRow[5] ?></th>
    <th><?php echo $nameRow[6] ?></th>
    <th><?php echo $nameRow[7] ?></th>
  </tr>
    <?php 
    while($row = $result->fetch_assoc()) {
        $deleteUser = $row['UserID'];
        $delete = "deleteUser=$deleteUser";
        echo '<tr>';
        echo '<td>'.$row['UserID'].'</td>';
        echo '<td>'.$row['Email'].'</td>';
        echo '<td>'.$row['FirstName'].'</td>';
        echo '<td>'.$row['LastName'].'</td>';
        echo '<td>'.$row['Role'].'</td>';
        echo '<td>'.$row['Status'].'</td>';
        echo '<td>'.$row['DateTime'].'</td>';
        echo '<td><div class="butt"><a onclick="myFunction()" href="delete_user.php?'.$delete.'">ลบ</a></div></td>';
    }
    echo '</tr>';

    $stmt->close();
    $link->close();
    ?>
</table>


</body>
</html>
            </section>

        </article>
        <br>
        <?php
        include "footer.php";
        ?>
    </div>
</body>
