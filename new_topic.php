<?php

$message = "";
session_start();
if ($_POST) {
	include "dblink.php";
	if (isset($_POST['topic'])) {
		$topic = $_POST['topic'];
	}
	if (isset($_POST['details'])) {
		$details = $_POST['details'];
		$details = nl2br($details);
	}
	$eml = $link->prepare("SELECT Email FROM user WHERE UserID = ?;");
	$eml->bind_param("s", $_SESSION['ID']);
	$eml->execute();
	$emlResult = $eml->get_result();
	$email = $emlResult->fetch_assoc();

	$stmt = $link->prepare("INSERT INTO topic (Topic, Details, UserID, Email) VALUES (?, ?, ?, ?);");
	$stmt->bind_param("ssss", $topic, $details, $_SESSION['ID'], $email['Email']);
	// echo $_SESSION['ID'];
	if ($topic != "") {
		if ($stmt->execute()) {
			$message = '<h4><img src="images/ok.png" width="50" height="50">เพิ่มข้อมูลสำเร็จแล้ว...';
			header("refresh: 1; url=index.php");
		} else {
			$message = '<h4 class="err"><img src="images/no.png" width="50" height="50">เกิดข้อผิดพลาด...</h4>';
		}
	} else  $message = '<h4 class="err"><img src="images/no.png" width="50" height="50">เกิดข้อผิดพลาด...</h4>';

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
			width: 850px;
			border: solid 0px green;
			border-radius: 8px;
			margin: 15px auto 2px;
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

		form input[name=topic] {
			width: 400px;
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

		textarea {
			resize: none;
			width: 400px;
			height: 100px;
			display: inline-block;
		}
	</style>
</head>
<article>
	<section id="top">
		<h3>หัวข้อสนทนา</h3>
	</section>

	<section id="content">
		<?php echo $message; ?>
		<form method="post">
			<label>กำหนดหัวข้อ:</label><input type="text" name="topic"><br><br><br>
			<label> </label> <!-- มีไว้เพื่อ texatra ให้อยู่กึ่งกลาง -->
			<textarea name="details" placeholder="รายละเอียด" rows="8" cols="110"></textarea><br>
			<br><br>
			<div>
				<button type="topic" id="ok">ตกลง</button>
				<a href="index.php">ยกเลิก</a>
			</div>
		</form>
	</section>
</article>