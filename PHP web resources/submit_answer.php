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
	
	$qid = get_question();
?>
 
    <title>Submit Answer Page</title>
</head>
<body>
<div class="container mt-5">
    <div class="row">
    <div class="col-sm">
        <h1>Submit Answer Page</h1>
    </div>
</div>

<form method="post" action ='submit_answer.php'>
    <table class='table table-hover'>
        <tr>
            <td>Question Title: </td>
            <td>
			<?php
				echo $qid['title'];
			?>
			</td>
        </tr>
 
        <tr>
            <td>Question Body:</td>
			<td>
			<?php
				echo $qid['body'];
			?>
			 </td>
        </tr>
 
        <tr>
            <td>Answer Body:</td>
            <td><input type='text' style='height:150px;' name='body' class='form-control' required></td>
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
	<input type="hidden" name="qid" value='<?php echo $qid['qid'] ?>'>
</form>
	
</div>

<?php

function get_question()
{
	include 'db_connection_project.php';
	$conn = OpenCon();
	
	$sql = "select *
			from questions
			where qid = $_POST[qid]";
			
	$stmt = mysqli_query($conn, $sql);
	
	return mysqli_fetch_array($stmt);
}

if(isset($_POST['aid']))
{
	submit_answer();
}

if(isset($_POST['body']))
{
	$conn = OpenCon();
	
	$sql = "select aid
			from answers
			order by aid desc
			limit 1";
	$stmt = mysqli_query($conn, $sql);
	$aid = mysqli_fetch_array($stmt);
	$aid = $aid['aid'] + 1;
	$date = date('Y-m-d H:i:s');
	
	
	
	$sql = "INSERT INTO answers(aid, body)
			VALUES ($aid, '$_POST[body]')";
	mysqli_query($conn, $sql);
	
	$sql = "INSERT INTO post_answers(uid, qid, aid, grade, weight, best, timeposted)
			VALUES ($_SESSION[uid], $qid[qid], $aid, 1, 1, False, '$date')";
	mysqli_query($conn, $sql);
	echo "Answer submitted";
}

?>
</body>
</html>