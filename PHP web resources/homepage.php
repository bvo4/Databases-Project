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

    <h2 style="text-align: center">DATABASES PROJECT TITLE:  HEADER</h2>
	
	<?php
	include 'reactjs.php';
	
	include 'db_connection_project.php';
	$conn = OpenCon();

	$sql = "select *
			from questions, post_question, users
			where questions.qid = post_question.qid
			and post_question.uid = users.uid
			order by timeposted desc
			limit 5
			";
	$stmt = mysqli_query($conn, $sql);
	
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
	?>

  </body>
</html>

<?php
function login()
{
   echo "This will be the login";
}

function search()
{
   echo "This will be the search";
}

if(array_key_exists('Questions',$_POST)){
   question();
}
if(array_key_exists('search',$_POST)){
   search();
}
if(array_key_exists('login',$_POST)){
   login();
}
?>