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
post_questions();
post_answers();

function post_answers()
{
	include 'reactjs.php';
	$conn = OpenCon();
	$uid = $_SESSION['uid'];
	$sql = "select * 
		from answers, post_answers
		where post_answers.aid = answers.aid
		and post_answers.uid = $uid";
		
	$stmt = mysqli_query($conn, $sql);
	$num = mysqli_num_rows($stmt);
	if($num > 0)
	{
		echo "<br/> The answers you have posted";
		echo_table_answers();
		while($row = mysqli_fetch_array($stmt))
		{
			$qid = $row['qid'];
			$sql_question = "select * 
			from post_answers, questions
			where post_answers.qid = questions.qid
			and post_answers.qid = $qid";
			$question = grab_first_row($conn, $sql_question);
			
			$test =
				"<tr>"
				. "<th>" . $question['title'] ."</th>". "</th>"
				. "<th>" . $question['body'] ."</th> " . "</th>"
				. "<th>" . $question['timeposted'] . "</th>"
				. "<th>" . $row['body'] . "</th>"
				. "<th>" . $row['grade'] . "</th>"
				. "<th>" . $row['timeposted'] . "</th>"
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
							You have not submitted any answers.
						</div>
					</div>
					</div>';
		echo $greenthing;
	}
}

function post_questions()
{
	if(isset($_SESSION['uid']))
	{
		$uid = $_SESSION['uid'];
		$conn = OpenCon();
		$sql = "select *
				from questions, post_question
				where post_question.uid = $uid
				and post_question.qid = questions.qid
				";
		
		$stmt = mysqli_query($conn, $sql);
		$num = mysqli_num_rows($stmt);
		
		if($num > 0)
		{
			echo "The questions you have posted";
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
					echo $test;
			}
			echo "</table>";
		}
		else
		{
		  $greenthing = '<div class="row">
						<div class="col-sm">
							<div class="alert alert-success">
								You have not submitted any questions.
							</div>
						</div>
						</div>';
			echo $greenthing;
		}
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

function echo_table_answers()
{
	echo "<br/>
		  <table style = 'width:100%' class='table table-dark table-hover'>
		  <tr>
		  <th> Question Title:  </th>
		  <th> Question Body:  </th>
		  <th> Question's Date Posted:  </th>
		  <th> Your answer:  </th>
		  <th> Liked received:  </th>
		  <th> Time posted: </th>
		  </tr>
		";
}

?>
  
</body>
</html>

