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
	$topic = '';
	$keyword = '';
	
	if(isset($_POST['topic']))
	{
		$subtopic = '';
		
		for($b = 0; $b < sizeof($_POST['topic'], 0); $b++)
		{
			$temp = substr($_POST['topic'][$b], 0, 4);
			if($temp == "top_")
			{
				$temp = substr($_POST['topic'][$b], 4);
				$topic .= "," . substr($_POST['topic'][$b], 4);
			}
			else if($temp == "sub_")
			{
				$temp = substr($_POST['topic'][$b], 4);
				$subtopic .= ',' . substr($_POST['topic'][$b], 4);
			}
		}
		
		$topic = explode(',', $topic);
		$subtopic = explode (',', $subtopic);
		echo "TOPIC: ";
		print_r ($topic);
		echo "<br/>";
		
		echo "SUBTOPIC: ";
		print_r ($subtopic);
		echo "<br/>";
		
		$topic = topic_search($topic, $subtopic);
	}

	if (isset($_POST['search']))
	{
		$keyword = keyword_search();
	}
	
	search($topic, $keyword);


function topic_search($topic, $subtopic)
{
	if(isset($topic))
	{
		$search_topic = ' and topic.tname in ("' . array_shift($topic) . '"';
		$tid = $topic;
		
		for($b = 0; $b < sizeof($topic, 0); $b++)
		{	
			$search_topic.= ", '$topic[$b]'";
		}
		$search_topic.= ')';
	}
	if(isset($subtopic))
	{
		$search_subtopic = ' or subtopic.sname in ("' . array_shift($subtopic) . '"';
		$tid = $subtopic;
		
		for($b = 0; $b < sizeof($subtopic, 0); $b++)
		{	
			$search_subtopic.= ", ' $subtopic[$b]'";
		}
		$search_subtopic.= ')';
	}

	$sql = "$search_topic
			$search_subtopic";
	return $sql;

}

function keyword_search()
{
	$sid = explode(' ', $_POST['search']);
	$searchwords = " and body like '%" . array_shift($sid) . "%'";
	
	for($b = 0; $b < sizeof($sid, 0); $b++)
	{
		$searchwords.= " and body like '%$sid[$b]%'";
	}

	return $searchwords;
}

function search($topic, $keyword)
{
	include 'db_connection_project.php';
	$conn = OpenCon();
	$sql = "select *
			from questions, post_question, users, subtopic, topic
			where questions.qid = post_question.qid
			and post_question.uid = users.uid 
			and subtopic.stid = questions.stid
			and subtopic.tid = topic.tid
			$keyword
			$topic
			";
	echo 'SQL: ' . $sql;
	
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

