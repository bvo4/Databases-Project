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
	include 'db_connection_project.php';
	$topic = '';
	$keyword = '';
	
	if(isset($_POST['topic']))
	{
		$topic = topic_keyword();
	}

	if (isset($_POST['search']))
	{
		$keyword = question_keyword_search();
		$title_keyword = title_search();
	}
	/* If the user opted to search for questions */
	if(isset($_POST['Check_Question']))
	{
		echo "<h5><center>Search based on Questions: </center></h5>";
		search_question($title_keyword, $topic, $keyword);
	}
	/* If the user opted to search for answers */
	if(isset($_POST['Check_Answer']))
	{
		$keyword = answer_keyword_search();
		echo "<h5><center>Search based off Answers: </center></h5>";
		search_answers($topic, $keyword);
	}
	/* If the user didn't opt to search for anything */
	if(!(isset($_POST['Check_Answer'])) && !(isset($_POST['Check_Question'])))
	{
	  $greenthing = '<div class="row">
					<div class="col-sm">
						<div class="alert alert-danger">
							You didn\'t ask to search for anything!
							Please specify if you want to search for answers or questions!
						</div>
					</div>
					</div>';
		echo $greenthing;
	}

	/* This takes the list of topics and subtopics taken from the browse page
	and identifies which keyword belongs to a topic and which belongs to a subtopic and creates seperate arrays.
	Afterwards, creates a query to search for topics and subtopics based off which one found*/
	function topic_keyword()
	{
		$subtopic = '';
		$topic = '';
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
		$topic = topic_search($topic, $subtopic);
		return $topic;
	}

/* Creates a query to create keywords based off the topics and subtopics and search for any questions that have a matching topic and/or subtopic */
function topic_search($topic, $subtopic)
{
	if(isset($topic))
	{
		$search_topic = ' and (topic.tname in ("' . array_shift($topic) . '"';
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
			$search_subtopic.= ", '$subtopic[$b]'";
		}
		$search_subtopic.= '))';
	}

	$sql = "$search_topic
			$search_subtopic";
	return $sql;

}

/* Creates a query to search for any matching questions title */
function title_search()
{
	$sid = explode(' ', $_POST['search']);
	$searchwords = " (title like '%" . array_shift($sid) . "%'";
	
	for($b = 0; $b < sizeof($sid, 0); $b++)
	{
		$searchwords.= " and title like '%$sid[$b]%'";
	}
	
	return $searchwords;
}

/* Creates part of the query needed to search through the questions table */
function question_keyword_search()
{
	$sid = explode(' ', $_POST['search']);
	$searchwords = " or body like '%" . array_shift($sid) . "%'";
	
	for($b = 0; $b < sizeof($sid, 0); $b++)
	{
		$searchwords.= " and body like '%$sid[$b]%'";
	}
	$searchwords .=")";
	return $searchwords;
}

/* Same as the function above.  I just didn't feel like making seperate distinctiosn for questions and answers and just made a dupe function */
function answer_keyword_search()
{
	$sid = explode(' ', $_POST['search']);
	$searchwords = " and body like '%" . array_shift($sid) . "%'";
	
	for($b = 0; $b < sizeof($sid, 0); $b++)
	{
		$searchwords.= " and body like '%$sid[$b]%'";
	}
	return $searchwords;
}

/* This function serves to search for all questions that have the matching topic and subtopic and matching keywords*/
function search_question($title_keyword, $topic, $keyword)
{
	$conn = OpenCon();
	$sql = "select *
            from questions join post_question using (qid)
                join users using (uid)
                join subtopic using (stid)
                join topic using (tid)
            where
			$title_keyword
			$keyword
			$topic
			order by timeposted desc
			";
    
	//echo $sql;
    
	$stmt = mysqli_query($conn, $sql);
	$num = mysqli_num_rows($stmt);
	
	if($num > 0)
	{
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
							<button input type='link' name='qid' value=$row[qid]>View More</button>
						</form>
				  </th>"
				."</tr>"
				;
				echo $test;
		}
		echo "</table>";
	}
	else
	{
	  $greenthing = '<div class="row">
					<div class="col-sm">
						<div class="alert alert-danger">
							<center>No Questions Found!</center>
						</div>
					</div>
					</div>';
		echo $greenthing;
	}
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

/* This function serves to search for all answers that have the matching topic and subtopic and matching keywords*/
function search_answers($topic, $keyword)
{
	$keyword = str_replace('body', 'answers.body', $keyword);

	$conn = OpenCon();
	$sql = "select username, questions.qid, questions.title as title, questions.body as body, answers.body as answer, post_answers.timeposted as timeposted
			from answers, post_answers, post_question, questions, users, subtopic, topic
			where questions.qid = post_question.qid
			and post_question.uid = users.uid 
			and post_question.qid = post_answers.aid
			and post_answers.aid = answers.aid
			and subtopic.stid = questions.stid
			and subtopic.tid = topic.tid
			$keyword
			$topic
			order by post_answers.timeposted, grade desc
			";

	//echo "answer: " . $sql;

	$stmt = mysqli_query($conn, $sql);
	$num = mysqli_num_rows($stmt);
	
	if($num > 0)
	{
		echo "<br/>
			  <table style = 'width:100%' class='table table-dark table-hover'>
			  <tr>
			  <th> Username:  </th>
			  <th> Question Title:  </th>
			  <th> Question Body:  </th>
			  <th> Answer:  </th>
			  <th> Date posted:  </th>
			  </tr>
			";
		
		while($row = mysqli_fetch_array($stmt))
		{
		$test =
			"<tr>"
			. "<th>" . $row['username'] ."</th> "
			. "<th>" . $row['title'] ."</th> "
			. "<th>" . $row['body'] ."</th>". "</th>"
			. "<th>" . $row['answer'] ."</th> " . "</th>"
			. "<th>" . $row['timeposted'] . "</th>"
			."</tr>"
			;
			echo $test;
		}
	}
	else
	{
	  $greenthing = '<div class="row">
					<div class="col-sm">
						<div class="alert alert-danger">
							<center>No Answers Found!</center>
						</div>
					</div>
					</div>';
		echo $greenthing;
	}
}

?>
  
</body>
</html>

