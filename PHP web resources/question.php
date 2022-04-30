<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8" />
    <title>Databases Project</title>
  </head>

<?php
	include 'header.php';
	$header = returnHeader();
	echo $header;
?>

  <body>

    <h2 style="text-align: center">QUESTIONS PAGE</h2>

	<?php
	
	if(isset($_SESSION['uid']))
	{
		echo "<th> <form method='post' action='submit_question.php'>
			<button input type='link' name='question' value='$_SESSION[uid]'>Submit Question</button>
			</form>
		</th>";
	}
	?>



  </body>
</html>

<?php
	include 'db_connection_project.php';
	$conn = OpenCon();

	$sql = "select *
			from questions, post_question, users
			where questions.qid = post_question.qid
			and post_question.uid = users.uid
			order by timeposted desc
			";
	$stmt = mysqli_query($conn, $sql);
	$num = mysqli_num_rows($stmt);
	
	if($num > 0)
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
				$test = str_replace(PHP_EOL, '<br />', $test);
				echo $test;
		}
		echo "</table>";
	}
	else
	{
		$greenthing = '<div class="row">
					<div class="col-sm">
						<div class="alert alert-danger">
							Unforutnately, we have no questions available.
						</div>
					</div>
					</div>';
			echo $greenthing;	
	}

?>