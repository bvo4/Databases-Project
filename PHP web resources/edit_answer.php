<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

<style>
.clearfix::after {
  content: "";
  clear: both;
  display: table;
}
</style>

<?php
	include 'header.php';
	$header = returnHeader();
	echo $header;
?>
 
    <title>Edit Answer Page</title>
</head>
<body>

<div class="container mt-5">
    <div class="row">
    <div class="col-sm">
        <h1>Edit Answer Page</h1>
    </div>
</div>
<?php
	/* Outputs a bunch of details regarding profile information */
	if(isset($_SESSION['uid']))
	{
		include 'reactjs.php';
		include 'db_connection_project.php';
		$aid = $_POST['aid'];
		$conn = OpenCon();
		
		$sql = "select *
				from answers, post_answers
				where uid = $_SESSION[uid]
				and answers.aid = $aid
				limit 1
				";

		$row = grab_first_row($conn, $sql);

		$form = "<form method='post' action='edit_answer.php'>
			<table class='table table-hover'>
				<tr>
					<td>Answer Body</td>
					<td><textarea name='body' style='height:150px;' class='form-control' required>$row[body]</textarea></td>
				</tr>
				
					<td></td>
				<input type='hidden' name='aid' value=$aid>
					<td>
							<button type='submit' name='save' class='btn btn-primary'>
								<span class='glyphicon glyphicon-plus'></span> Save
							</button>
					</td>
				</tr>
			</table>
		</form>";
		echo $form;
	}
?>

</div>

<?php

function update()
{
	$aid = $_POST['aid'];
	$conn = OpenCon();
	$sql = "select *
				from answers
				where answers.aid = $aid
				limit 1
				";
	
	/* Finds the user in the users table and creates an SQL update query to change the user's details */
	$row = grab_first_row($conn, $sql);
	$sql_edit = write_answer_update($row);
	
	if($sql_edit == '-1')
	{
	  $greenthing = '<div class="row">
					<div class="col-sm">
						<div class="alert alert-danger">
							You did not change anything!
						</div>
					</div>
					</div>';
	echo $greenthing;
	}
	else
	{
		$sql = "UPDATE answers
				$sql_edit
				where aid = $aid
				";
		echo "UPDATE: " . $sql;
		$stmt = mysqli_query($conn, $sql);
		if(!$stmt)
		{
			echo mysqli_error($conn);
			die();
		}
		else
		{
			echo "SUCCESS";
			redirect('submissions.php');
		}
	}
}

if(isset($_POST['save']))
{
	update();
}

function topic_list()
{
	$conn = OpenCon();
	
	$sql = "select *
			from subtopic";
	$stmt = mysqli_query($conn, $sql);
	$test = '';
	while($row = mysqli_fetch_array($stmt))
	{
		$test .= "<option class='dropdown-item' value=" . $row['stid'] . ">" . $row['sname'] . "</option> ";
	}
	return $test;
}


?>
</body>
</html>