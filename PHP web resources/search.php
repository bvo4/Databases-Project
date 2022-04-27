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
	if(isset($_GET['topic']))
	{
		topic_search();
	}
	else if (isset($_POST['search']))
	{
		keyword_search();
	}


function topic_search()
{
	$search_topic = ' or topic.tname = "' . array_shift($_GET['topic']) . '"';
	$tid = explode(' ', $_GET['search']);
	
	for($b = 0; $b < sizeof($tid, 0); $b++)
	{
		$search_topic.= " or topic.tname = '$tid[$b]'";
	}

	include 'db_connection_project.php';
	$conn = OpenCon();
	
	echo "SEARCH TOPIC NOT FINISHED.  TO DO";
	
	$sql = "select *
			from post_question, users, topic, questions join subtopic on questions.stid
			where questions.qid = post_question.qid
			and post_question.uid = users.uid
			and questions.stid = subtopic.stid
			$search_topic
			group by users.uid
			";
	
	$stmt = mysqli_query($conn, $sql);

	echo_table();
		
	while($row = mysqli_fetch_array($stmt))
	{
	$test =
			"<tr>"
			. "<th>" . $row['username'] ."</th> "
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

function keyword_search()
{
	$sid = explode(' ', $_POST['search']);
	$searchwords = " and body like '%" . array_shift($sid) . "%'";
	
	for($b = 0; $b < sizeof($sid, 0); $b++)
	{
		$searchwords.= " and body like '%$sid[$b]%'";
	}

	include 'db_connection_project.php';
	$conn = OpenCon();
	
	$sql = "select *
			from questions, post_question, users
			where questions.qid = post_question.qid
			and post_question.uid = users.uid
			$searchwords
			group by users.uid
			";
	$stmt = mysqli_query($conn, $sql);
	
	echo_table();
		
	while($row = mysqli_fetch_array($stmt))
	{
	
	$test =
			"<tr>"
			. "<th>" . $row['username'] ."</th> "
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

function echo_table()
{
	echo "<br/>
		  <table style = 'width:100%' class='table table-dark table-hover'>
		  <tr>
		  <th> Username:  </th>
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

