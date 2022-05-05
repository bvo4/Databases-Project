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
 
    <title>Edit Question Page</title>
</head>
<body>

<div class="container mt-5">
    <div class="row">
    <div class="col-sm">
        <h1>Edit Question Page</h1>
    </div>
</div>
<?php
	/* Outputs a bunch of details regarding profile information */
	if(isset($_SESSION['uid']))
	{
		include 'reactjs.php';
		include 'db_connection_project.php';
		$qid = $_POST['qid'];
		$conn = OpenCon();
		
		$sql = "select *
				from questions, post_question, subtopic
				where uid = $_SESSION[uid]
				and questions.qid = $qid
				and questions.qid = post_question.qid
				and subtopic.stid = questions.stid
				limit 1
				";

		$row = grab_first_row($conn, $sql);

		$form = "<form method='post' action='edit_question.php'>
			<table class='table table-hover'>
				<tr>
					<td>Question Title</td>
					<td><input type='text' name='title' value='$row[title]' class='form-control' required></td>
				</tr>
		  
				<tr>
					<td>Question Body</td>
					<td>
					<textarea name='body' style='height:150px;' class='form-control' required>$row[body]</textarea>
					</td>

				</tr>
		 
				 <tr>
					<td>
					<div>
					<label for='select_1'>Select a topic:</label>
					</td>
					<td>
					<select class='form-control' id='select_1' name='stid'>";
					
					$form .=topic_list();
				
		$form .="
				</td>
				</tr>
					</select>
					</div>
				<tr>
					<td></td>
				<input type='hidden' name='qid' value=$qid>
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
	$qid = $_POST['qid'];
	$conn = OpenCon();
	$sql = "select *
				from questions
				where questions.qid = $qid
				limit 1
				";
	
	/* Finds the user in the users table and creates an SQL update query to change the user's details */
	$row = grab_first_row($conn, $sql);
	$sql_edit = write_question_update($row);
	
	if($sql_edit == '-1')
	{
		echo "ERROR:  NO CHANGE DETECTED";
	}
	else
	{
		$sql = "UPDATE questions
				$sql_edit
				where qid = $qid
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