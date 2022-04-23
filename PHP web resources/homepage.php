<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8" />
    <title>Databases Project Title</title>
  </head>
<style>
 .form{
	 display: inline;
 }

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


	<div class="container space-around">
	<form action = 'question.php' method="post">
	  <button type="hidden" name = "Questions" class="tablink" action = 'question.php'>Questions</button>
	</form>
	<form action='search.php' method="post">
	  <button type="hidden" name = "search" class = "tablink">Search</button>
	</form>
	<form action = 'login.php' method="post">
	  <button type="hidden" name = "login" class = "tablink">Login</button>
	</form>
	</div>
</body>
  <body>

    <h2 style="text-align: center">DATABASES PROJECT TITLE:  HEADER</h2>
	

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
function question()
{
    echo "This is what questions will be";
	include 'db_connection_project.php';
	$conn = OpenCon();

	$sql = "select *
			from questions, post_question, users
			where questions.qid = post_question.qid
			and post_question.uid = users.uid
			";
	$stmt = mysqli_query($conn, $sql);
	
	echo "<br/>
		  <table style = 'width:100%'>
		  <tr>
		  <th> User ID:</th>
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
			. "<th>" . $row['uid'] ."</th> "
			. "<th>" . $row['username'] ."</th> "
			. "<th>" . $row['title'] ."</th>". "</th>"
			. "<th>" . $row['body'] ."</th> " . "</th>"
			. "<th>" . $row['timeposted'] . "</th>"
			. "<th> <form method='post' action='answer.php'>
						<button input type='link' value='View More'>View Answers </button>
					</form>
			  </th>"
			."</tr>"
			;
			$test = str_replace(PHP_EOL, '<br />', $test);
			echo $test;
			}
	echo "</table>";
}

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