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

   <h3 style="text-align: center">Questions and Answers for your Curiosity</h3>

   <?php
   if(!isset($_SESSION['user'])){
   echo "</br></br><h2 style='text-align: center'><a href = '/Databases-Project/PHP%20web%20resources/login.php'>Create an account or Login </a>to post your questions and answers!</h2>";
   }
   ?>

   </br></br></br>
   <h3 style="text-align: center"><a href= '/Databases-Project/PHP%20web%20resources/browse.php'>Browse </a>By Questions using Keywords and Topics</h3>

   </br></br></br>
   <h3 style="text-align: center">Current Top 5 Questions</h3>
	
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
