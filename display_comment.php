<head>

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

</head>


<body>

	<div id="container">
		<article>
			<section id="content">
				<?php
				include "dblink.php";
				if (isset($_GET['topicID'])) {
					$topic_ID = $_GET['topicID'];
				}
				$stmt = $link->prepare("SELECT * FROM topic;");
				$stmt->execute();
				$countRow = $stmt->get_result();
				$num = $countRow->num_rows;
				//-------------------------------
				$stmt = $link->prepare("SELECT *,
										DATE_FORMAT(curDateTime, '%d-%m-%Y') AS curDateTime,
										DATE_FORMAT(upDateTime, '%H:%i') AS upDateTime
										FROM comment 
										WHERE TopicID = ? LIMIT 30;");
				$stmt->bind_param("s", $topic_ID);
				$stmt->execute();
				$result = $stmt->get_result();

				while ($data = $result->fetch_assoc()) {
					$commentID = $data['CommentID'];
					// echo $commentID;
					$dateTime = "เวลา: " . $data['upDateTime'] . " วันที่: " . $data['curDateTime'];
					$user_ID = "&ID=" . $_SESSION['ID'];
					$topicID = "topicID=$topic_ID";
					$comID = "&commentID=" . $commentID;
					// echo $comID;
					$butt = "";
					// include "delete_comment.php";
					if ($_SESSION['user'] == "user") {
						if ($data['UserID'] == $_SESSION['ID']) {
							$butt = '<a href="delete_comment.php?' . $topicID . $user_ID . $comID . '">ลบ</a>';
						} else $butt = "";
					} else if ($_SESSION['user'] == '$2y$12$hFLpweZ29gV0LdEgwtVlNOeLC2.UZtuGOS/Up9BmaE5T7XvX5L97e') {
						$butt = '<a href="delete_comment.php?' . $topicID . $user_ID . $comID . '">ลบ</a>';
					}
					echo '<div class="topic">' . $data['Comment_Text'] . '</div><br>
						<div class="datetime">' . $dateTime . ' โดย Email: ' . $data['Email'] .  '</div>
                        <div class="butt">' . $butt . '</div><hr>';

					$stmt = $link->prepare("SELECT * FROM topic;");
					$stmt->execute();
					$countRow = $stmt->get_result();
					$num = $countRow->num_rows;
				}
				// $test = $_GET['commentID'];
				// echo $test;

				// $stmt->close();
				// $link->close();

				?>
			</section>
		</article>
	</div>
</body>