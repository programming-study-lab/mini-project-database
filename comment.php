<?php
	include "check_user.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Webboard</title>
	<style>
		form {
			width: 700px;
			border: solid 0px green;
			border-radius: 8px;
			margin: 10px auto 15px;
			padding: 10px 0px;
			background: #cee;
		}

		form input:not([type=radio]) {
			background: #ffd;
			border: solid 1px gray;
			padding: 2px;
			color: blue;
		}

		form [type=file] {
			background: inherit !important;
			border: none !important;
		}

		form label {
			display: inline-block;
			width: 180px;
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

		form input[name=question] {
			width: 450px;
		}

		form input[type=file] {
			width: 300px;
		}

		form input[name^=choice] {
			width: 300px;
			margin: 2px 0px;
		}

		section#content h4 {
			text-align: center;
			color: green;
		}

		section#content h4.err {
			color: red;
		}

		section#content h4 img {
			margin-right: 3px;
			vertical-align: middle;
		}
	</style>
</head>

<body>
	<?php
	include "dblink.php";
	if (isset($_GET['topicID'])) {
		$topic_ID = $_GET['topicID'];
	}
	// echo $topic_ID; ///----------------
	$message = "";
	if($_POST){
		$comment = $_POST['comment'];

	$eml = $link->prepare("SELECT Email FROM user WHERE UserID = ?;");
	$eml->bind_param("s", $_SESSION['ID']);
	$eml->execute();
	$emlResult = $eml->get_result();
	$email = $emlResult->fetch_assoc();

		if ($message == "") { //ส่วนแสดงความคิดเห็น
			$stmt = $link->prepare("INSERT INTO comment(Comment_Text, UserID, TopicID, Email) VALUES (?,?,?,?)");
			$stmt->bind_param("ssss", $comment, $_SESSION['ID'], $topic_ID, $email['Email']);
			$stmt->execute();

			$stmt = $link->prepare("SELECT * FROM comment;");
			$stmt->execute();
			$res = $stmt->get_result();
			$row = $res->fetch_assoc();
			$commentID = $row["CommentID"];
			$comID = "&commentID=".$commentID;
			header("Location: comment.php?topicID=".$topic_ID.$comID."");
			// $message = 'แสดงความคิดเห็นเรียบร้อย<br> <a href="comment.php">หน้าหลัก</a>';
		} else {
			$message = "เกิดข้อผิดพลาด กรุณาลองใหม่อีกครั้ง";
		}
	}
	?>

	<div id="container">
		<article>
			<section id="top">
				<?php
					$stmt = $link->prepare("SELECT Topic, Details FROM topic WHERE TopicID = ?;");
					$stmt->bind_param("s", $topic_ID);
					$stmt->execute();
					$result = $stmt->get_result();
					$row = $result->fetch_assoc();
					if ($row['Topic']) {
						echo "<h2>หัวข้อสนทนา: ".$row['Topic']."</h2>";
					}
					if($row['Details']) {
						echo "<h3>รายละเอียด: ".$row['Details']."</h3>";
					} else {
						echo "<h4>ไม่มีรายละเอียด</h4>";
					}
					
					include "display_comment.php"; //-----------
					include "header.php"; 

				?>

				<h3>แสดงความคิดเห็น</h3>
				<span>หัวข้อสนทนา:
					<?php 
						echo $row['Topic']; 
					?>
				</span>
				<br>
				<span>รายละเอียด: 
					<?php
						if($row['Details'] != "") {
							echo $row['Details'];
						} else {
							echo "ไม่มีรายละเอียด";
						}
					?>
				</span>
			</section>
			<?php
				echo $message;
			?>

			<form method="post">
				<label>ความคิดเห็นของท่าน</label> <input type="text" name="comment"><br>
				<div>
					<button type="butt" id="ok">ตกลง</button>
					<a href="index.php">ยกเลิก</a>
				</div>
			</form>
			</section>
		</article>
		<?php
			include "footer.php";
		?>
	</div>
</body>

</html>