<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

<?php
	include 'header.php';
	$header = returnHeader();
	echo $header;
?>
 
    <title>Submit Page</title>
</head>
<body>
<div class="container mt-5">
    <div class="row">
    <div class="col-sm">
        <h1>Submit Question Page</h1>
    </div>
</div>

<form method="post" action ='submit.php'>
    <table class='table table-hover'>
        <tr>
            <td>Question Title</td>
            <td><input type='text' name='title' class='form-control' required></td>
        </tr>
  
        <tr>
            <td>Question Body</td>
            <td><input type='text' style='height:150px;' name='body' class='form-control' required></td>
        </tr>
		
		<tr>
		<td>Select a topic:</td>
		<td>
			<div>
			<label for="select_1">Select a topic:</label>
			<select class="form-control" id="select_1" name='stid'>
				<?php
				topic_list();
				?>
			</select>
			</div>
		</td>
		</tr>
        <tr>
            <td></td>
            <td>
				<button type="submit" name='register' color="secondary" class="btn btn-danger">
					<span class="glyphicon glyphicon-plus"></span> Submit
				</button>
            </td>
        </tr>
    </table>
</form>
	
</div>

<?php

function topic_list()
{
	include 'db_connection_project.php';
	$conn = OpenCon();
	
	$sql = "select *
			from subtopic";
	$stmt = mysqli_query($conn, $sql);
	while($row = mysqli_fetch_array($stmt))
	{
		$test = "<option class='dropdown-item' value=" . $row['stid'] . ">" . $row['sname'] . "</option> ";
		echo $test;
	}
}

function submit_question()
{
	$conn = OpenCon();
	
	$sql = "select qid 
			from questions
			order by qid desc
			limit 1";
	$stmt = mysqli_query($conn, $sql);
	$qid = mysqli_fetch_array($stmt);
	
	$qid = $qid['qid'] + 1;
	$date = date('Y-m-d H:i:s');
	
	$sql = "INSERT INTO questions(qid, stid, title, body)
			VALUES($qid, $_POST[stid], '$_POST[title]', '$_POST[body]')";
	$stmt = mysqli_query($conn, $sql);
	
	
	$sql = "INSERT INTO post_question(qid, uid, resolved, timeposted)
			VALUES($qid, $_SESSION[uid], False, '$date')";
	$stmt = mysqli_query($conn, $sql);
	echo "Question submitted";
}

if(isset($_POST['title']) && isset($_POST['body']))
{
	submit_question();
}

?>
</body>
</html>