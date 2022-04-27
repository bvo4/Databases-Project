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
.cb-btn:checked + label {
  background-color: Red;
  
}
</style>

<?php
	include 'header.php';
	$header = returnHeader();
	echo $header;
?>

  <body>

    <h2 style="text-align: center">Browsing PAGE</h2>

	<?php
	include 'reactjs.php';
	
	$button = load_button();
	echo $button;
	?>

</link>
  </body>
</html>

<?php
	include 'db_connection_project.php';	
	grab_topics();
	grab_subtopics();
	
function grab_topics()
{
	$conn = OpenCon();
	$sql = "select *
			from topic
			";
	$stmt = mysqli_query($conn, $sql);
	$b = 0;
	while($row = mysqli_fetch_array($stmt))
	{
	$test =
			'<input src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"type="checkbox"'
			.'id=tn'
			. $b
			. ' hidden class="cb-btn"><label class="btn btn-primary"'
			. 'for="tn'
			. $b 
			. '">'
			
			.$row['tname']
			.'</label>'
			. '<br/> '
			;
			$test = str_replace(PHP_EOL, '<br />', $test);
			echo $test;
	$b = $b + 1;
	echo "</select>";
	}
}

function grab_subtopics()
{
	$conn = OpenCon();
	$sql = "select *
			from subtopic
			";
	$stmt = mysqli_query($conn, $sql);
	$b = 0;
	while($row = mysqli_fetch_array($stmt))
	{
	
	$test =
			'<input src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"type="checkbox"'
			.'id=sn'
			. $b
			. ' hidden class="cb-btn"><label class="btn btn-primary"'
			. 'for="sn'
			. $b 
			. '">'
			
			.$row['sname']
			.'</label>'
			. '<br/> '
			;
			$test = str_replace(PHP_EOL, '<br />', $test);
			echo $test;
	$b = $b + 1;
	}
	echo "</select>";
}
?>