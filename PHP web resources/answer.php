<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8" />
    <title>Databases Project Title</title>
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
    <h2 style="text-align: center">ANSWERS PAGE</h2>

    <!-- We will put our React component inside this div. -->
    <div id="like_button_container"></div>

    <!-- Load React. -->
    <!-- Note: when deploying, replace "development.js" with "production.min.js". -->
    <script src="https://unpkg.com/react@17/umd/react.development.js" crossorigin></script>
    <script src="https://unpkg.com/react-dom@17/umd/react-dom.development.js" crossorigin></script>

    <!-- Load our React component. -->
    <script src="like_button.js"></script>

  </body>
</html>

<?php

	$qid = $_POST['answer'];
	
	include 'db_connection_project.php';
	$conn = OpenCon();

	$sql = "select * 
			from answers, post_answers, users
			where post_answers.qid = $qid
			and answers.aid = post_answers.aid
			and users.uid = post_answers.uid";
	$stmt = mysqli_query($conn, $sql);
	
	echo "<br/>
		  <table class = 'table table-dark table-hover' style = 'width:100%'>
		  <tr>
		  <th> Aid:  </th>
		  <th> Body:  </th>
		  <th> Username:  </th>
		  <th> Likes:  </th>
		  <th> Date:  </th>
		  <th>Leave a like?</th>
		  </tr>
		";
	while($row = mysqli_fetch_array($stmt))
	{
	
	$test =
			"<tr>"
			. "<th>" . $row['aid'] ."</th> "
			. "<th>" . $row['body'] ."</th>". "</th>"
			. "<th>" . $row['username'] ."</th> " . "</th>"
			. "<th>" . $row['grade'] . "</th>"
			. "<th>" . $row['timeposted'] . "</th>"
			. "<th><script src='like_button.js'></script></th>"
			."</tr>"
			;
			$test = str_replace(PHP_EOL, '<br />', $test);
			echo $test;
			}
	echo "</table>";
	
?>

<?php

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