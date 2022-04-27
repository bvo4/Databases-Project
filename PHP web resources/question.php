<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8" />
    <title>Databases Project</title>
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

    <h2 style="text-align: center">QUESTIONS PAGE</h2>

	<?php
	include 'reactjs.php';
	
	$button = load_button();
	echo $button;
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
						<button input type='link' name='answer' value=$row[qid]>View More</button>
					</form>
			  </th>"
			."</tr>"
			;
			$test = str_replace(PHP_EOL, '<br />', $test);
			echo $test;
			}
	echo "</table>";
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