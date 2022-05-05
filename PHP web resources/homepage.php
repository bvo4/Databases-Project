<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8" />
    <title>Databases Project Title</title>
  </head>

<?php
	include 'header.php';
	$header = returnHeader();
	echo $header;
	
?>

  <body>

   <h3 style="text-align: center">Questions and Answers for your Curiosity</h3>

   <?php
   if(!isset($_SESSION['user'])){
   echo "</br></br><h2 style='text-align: center'><a href = 'login.php'>Create an account or Login </a>to post your questions and answers!</h2>";
   }
   ?>

   </br></br></br>
   <h3 style="text-align: center"><a href= 'browse.php'>Browse</a> By Questions or Answers using Keywords and Topics</h3>

   </br></br></br>
   <h3 style="text-align: center">Current Top 5 Questions</h3>
	
	<?php
	include 'reactjs.php';
	include 'db_connection_project.php';
	$conn = OpenCon();
	
	/* Chooses the 5 most recently posted questions */
	$sql = "select *
			from questions, post_question, users, subtopic
			where questions.qid = post_question.qid
			and post_question.uid = users.uid
			and questions.stid = subtopic.stid
			order by timeposted desc
			limit 5
			";
	$stmt = mysqli_query($conn, $sql);
	$num = mysqli_num_rows($stmt);
	
	//Check if we found a row, otherwise, output a generic error message.
	if($num > 0)
	{
		/* Builds the header table for the questions */
		echo "<br/>
			  <table style = 'width:100%' class='table table-dark table-hover'>
			  <tr>
			  <th> Username:  </th>
			  <th> Topic:  </th>
			  <th> Title:  </th>
			  <th> Body:  </th>
			  <th> Date:  </th>
			  <th> View Answers:  </th>
			  </tr>
			";
		/* Outputs each row found into the table */
		while($row = mysqli_fetch_array($stmt))
		{
			$test = '';
			if($row['resolved'] == True)
			{
				$test = "<tr style='background: pink;'>";
			}
			else
			{
				$test = "<tr>";
			}
		/* Outputs the table of all questions */
		$test .=
				"<th>" . $row['username'] ."</th> "
				. "<th>" . $row['sname'] ."</th> "
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
							Unforutnately, we have no questions available.
						</div>
					</div>
					</div>';
			echo $greenthing;	
	}
	?>

  </body>
</html>
