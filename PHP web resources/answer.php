<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8" />
    <title>Databases Project Title</title>
  </head>
<style>
 .header {
  padding: 5px;
  text-align: center;
  background: #1abc9c;
  color: white;
  font-size: 15px;
}
.container {
  display: flex;
}
.container.space-around {
  padding: 5px;
  text-align: center;
  background: #808080;
  color: white;
  font-size: 15px;
  justify-content: space-around;
}
.container.space-between {  
  justify-content: space-between;
}

.tablink {
  background-color: #555;
  color: white;
  float: left;
  border: none;
  outline: none;
  cursor: pointer;
  padding: 14px 16px;
  font-size: 17px;
  width: 200%;
  display:inline
}
table, th, td {
  border:1px solid black;
}
</style>
<?php
	include 'header.php';
	$header = returnHeader();
	echo $header;
?>

  <body>
    <h2 style="text-align: center">ANSWERS PAGE</h2>
  </body>
</html>

<?php
	include 'db_connection_project.php';
	$conn = OpenCon();
		
	if(isset($_POST['like']) && isset($_POST['qid']))
	{
		$qid = $_POST['qid'];
		$aid = $_POST['like'];
		
		$sql = "INSERT INTO likes(aid, uid, points) VALUES ($aid, $_SESSION[uid], 1)";
		mysqli_query($conn, $sql);
	}
	
	if(isset($_POST['qid']))
	{
		$qid = $_POST['qid'];
		$sql = "select * 
				from answers, post_answers, users
				where post_answers.qid = $qid
				and answers.aid = post_answers.aid
				and users.uid = post_answers.uid";
		print_sql($conn, $sql, $qid);
	}
	else
	{
		echo "ERROR: NO MATCHING QUESTION FOUND";
	}
	
	
	function print_sql($conn, $sql, $qid)
	{

		$like_stmt = null;
		
		if(isset($_SESSION['uid']))
		{
			$uid = $_SESSION['uid'];
			$sql_like_check = "select * from users, likes
								where likes.uid = users.uid
								and users.uid = $uid
								;";
			$like_stmt = mysqli_query($conn, $sql_like_check);
		}
		
		$stmt = mysqli_query($conn, $sql);
		echo "<br/>
			  <table class = 'table table-dark table-hover' style = 'width:100%'>
			  <tr>
			  <th> Aid:  </th>
			  <th> Body:  </th>
			  <th> Username:  </th>
			  <th> Likes:  </th>
			  <th> Date:  </th>
			  <th>Leave a like?</th>
			  </tr>
			";
		while($row = mysqli_fetch_array($stmt))
		{
			$like_match = check_likes($like_stmt, $row['aid']);
	
			$test =
					"<tr>"
					. "<th>" . $row['aid'] ."</th> "
					. "<th>" . $row['body'] ."</th>". "</th>"
					. "<th>" . $row['username'] ."</th> " . "</th>"
					. "<th>" . $row['grade'] . "</th>"
					. "<th>" . $row['timeposted'] . "</th>";
					
				if(isset($like_stmt) && $like_match)
				{
					$test .="<th>	<button type='submit' name='like' value=$row[aid] class='btn btn-secondary'>
								You have already liked this
							</button></th>";
				}
				else
				{
					$test .="<form method='post' action='answer.php?qid=$qid'>"
					. "<input type='hidden' name='qid' value=$qid>"
					. "<th>	<button type='submit' name='like' value=$row[aid] class='btn btn-danger'>
								Like
							</button></th>"
					. "</form>";
				}
					$test .="</tr>"
					;
					$test = str_replace(PHP_EOL, '<br />', $test);
					echo $test;
		}
			echo "</table>";
	}
	
	function check_likes($like_stmt, $question_aid)
	{
		$like_match = False;
		if(isset($like_stmt))
		{
			while($like_check = mysqli_fetch_array($like_stmt))
			{
				if($like_check['aid'] == $question_aid)
				{
					$like_match = True;
					break;
				}
			}
		}
		return $like_match;
	}
	
?>
