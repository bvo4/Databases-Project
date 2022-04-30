<!DOCTYPE html>
<html lang="en">
<head>
  
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Search Page</title>
<?php
	include 'header.php';
	$header = returnheader();

echo $header;
?> 
</head>

<body>
<?php

search();

function search()
{
	include 'db_connection_project.php';
	if(isset($_SESSION['uid']))
	{
		$uid = $_SESSION['uid'];
		$conn = OpenCon();
		$sql = "select *
				from questions, post_question
				where post_question.uid = $uid
				and post_question.qid = questions.qid
				";
				
		echo 'SQL: ' . $sql;
		
		$stmt = mysqli_query($conn, $sql);
		
		echo_table();
		while($row = mysqli_fetch_array($stmt))
		{
		$test =
				"<tr>"
				. "<th>" . $row['title'] ."</th>". "</th>"
				. "<th>" . $row['body'] ."</th> " . "</th>"
				. "<th>" . $row['timeposted'] . "</th>"
				. "<th> <form method='post' action='answer.php'>
							<button input type='link' name='answer' value=$row[qid]>View More</button>
						</form>
				  </th>"
				."</tr>"
				;
				$test = str_replace(PHP_EOL, '<br />', $test);
				echo $test;
		}
		echo "</table>";
	}
	else
	{
		echo "ERROR:  YOU ARE NOT LOGGED IN";
	}
}

function echo_table()
{
	echo "<br/>
		  <table style = 'width:100%' class='table table-dark table-hover'>
		  <tr>
		  <th> Title:  </th>
		  <th> Body:  </th>
		  <th> Date:  </th>
		  <th> View Answers:  </th>
		  </tr>
		";
}

?>
  
</body>
</html>

