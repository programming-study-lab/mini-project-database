<?php
	include "check_user.php";
?>

<!doctype html>
<html>

<head>
	<meta charset="utf-8">
	<title>Webboard</title>
	<style>
		section#content {
			text-align: center;
			padding: 15px 5px;
		}

		section#content>div {
			padding-top: 5px;
		}

		div.topic {
			width: 725px;
			display: inline-table;
			text-align: left;
			font-size: 18px;
			color: green;
		}

		div.comment {
			width: 200px;
			display: inline-table;
			text-align: right;
		}

		div.datetime {
			width: 425px;
			display: inline-table;
			font-size: 14px;
			color: gray;
			text-align: left;
		}

		div.butt {
			width: 425px;
			display: inline-table;
			text-align: right;
		}

		div.butt>a {
			width: 100px;
			border: solid 1px brown;
			border-radius: 5px;
			background: khaki;
			padding: 2px 5px;
			margin: 2px;
			text-decoration: none;
			font-size: 13px;
		}

		div.butt>a:hover {
			background: aqua;
			color: red;
		}

		hr {
			width: 96%;
		}

		section#top a {
			display: inline-block;
			float: right;
			border: solid 1px gray;
			padding: 5px;
			padding-left: 28px !important;
			margin: 7px 5px;
			text-decoration: none;
			background: #cc6 2px center no-repeat;
			border-radius: 5px;
			color: #30c;
		}

		section#top a:hover {
			background-color: aqua;
			color: red;
		}

		div#pagenum {
			text-align: center;
		}
	</style>
	<link href="js/jquery-ui.min.css" rel="stylesheet">
	<script src="js/jquery.js"></script>
	<script src="js/jquery-ui.min.js"></script>
	<script src="js/jquery-ui.js"></script>
</head>

<body>

	<div id="container">
		<?php
		include "header.php";
		?>
		<article>
			<section id="top">
				<?php
				$img = "";
				if ($_SESSION['user'] == "user") { //ตรวจสอบสิทธิ์
					echo '<a href="new_topic.php">
								<img src="images/plus.png" width="20" height="20"> เพิ่มหัวข้อสนทนา
							</a>';
					$img = "plus.png";
				} else if ($_SESSION['user'] == '$2y$12$hFLpweZ29gV0LdEgwtVlNOeLC2.UZtuGOS/Up9BmaE5T7XvX5L97e') {
					echo '<a href="new_topic.php">
						<img src="images/plus.png" width="20" height="20"> เพิ่มหัวข้อสนทนา </a>';
					$img = "plus.png";
				}
				?>
				<h3>หัวข้อสนทนา</h3>
			</section>
			<section id="content">
				<?php
				include "dblink.php";

				$stmt = $link->prepare("SELECT * FROM topic;");
				$stmt->execute();
				$countRow = $stmt->get_result();
				$num = $countRow->num_rows;
				//-------------------------------
				$stmt = $link->prepare("SELECT *,
						DATE_FORMAT(curDateTime, '%d-%m-%Y') AS curDateTime,
						DATE_FORMAT(upDateTime, '%H:%i') AS upDateTime
						FROM topic 
						ORDER BY TopicID DESC LIMIT 30;");
				$stmt->execute();
				$result = $stmt->get_result();

				// for ($i = 0; $i < $num; $i++) {
				while ($data = $result->fetch_assoc()) {
					$topic_ID = $data['TopicID'];
					// echo $topic_ID; //--------------------------------
					// echo $_SESSION['ID'];//--------------------------------
					$dateTime = "เวลา: " . $data['upDateTime'] . " วันที่: " . $data['curDateTime'];
					$user_ID = "&ID=".$_SESSION['ID'];
					$topicID = "topicID=$topic_ID";
					$butt = "";
					include "delete.php";
					if ($_SESSION['user'] == "user") {
						$butt = '<a href="comment.php?'.$topicID.'" id="cm">ความคิดเห็น</a>';
						if ($data['UserID'] == $_SESSION['ID']) {
							$buttDelete = '<a href="index.php?'.$topicID.$user_ID.'">ลบ</a>';
						} else $buttDelete = "";
					} else if ($_SESSION['user'] == '$2y$12$hFLpweZ29gV0LdEgwtVlNOeLC2.UZtuGOS/Up9BmaE5T7XvX5L97e') {
						$butt = '<a href="comment.php?'.$topicID.'" id="cm">ความคิดเห็น</a>';
						$buttDelete = '<a href="index.php?'.$topicID.$user_ID.'">ลบ</a>';
					}

					$countComment = $link->prepare("SELECT COUNT(Comment_Text) AS countComment
										FROM comment 
										WHERE TopicID = ?;");
					$countComment->bind_param("s", $topic_ID);
					$countComment->execute();	
					$counter = $countComment->get_result();
					$ctrComment = $counter->fetch_assoc();

					echo '<div class="topic">' . $data['Topic'] . '</div>
						<div class="comment">จำนวนความคิดเห็น: '.$ctrComment['countComment'].'</div><br>
						<div class="datetime">' . $dateTime .' โดย Email: '.$data['Email']. '</div>
                        <div class="butt">' . $butt.$buttDelete.'</div><hr>';

					$stmt = $link->prepare("SELECT * FROM topic;");
					$stmt->execute();
					$countRow = $stmt->get_result();
					$num = $countRow->num_rows;
				}


				$stmt->close();
				$link->close();

				?>

	
	</section>

	</article>
	<div id="comm"> </div>
	<?php
		include "footer.php";
	?>
	</div>
</body>