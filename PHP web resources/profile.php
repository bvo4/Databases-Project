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
 
    <title>Profile Page</title>
</head>
<body>

<div class="container mt-5">
    <div class="row">
    <div class="col-sm">
        <h1>Profile Page</h1>
    </div>
</div>
<?php
	/* Outputs a bunch of details regarding profile information */
	if(isset($_SESSION['uid']))
	{
		include 'reactjs.php';
		include 'db_connection_project.php';
		$conn = OpenCon();
		
		$sql = "select *
				from users
				where uid = $_SESSION[uid]
				limit 1
				";

		$row = grab_first_row($conn, $sql);

		$form = "<form action='#' method='post'>
			<table class='table table-hover'>
				<tr>
					<td>Username</td>
					<td><input type='text' name='username' value='$row[username]' class='form-control' required></td>
				</tr>
		  
				<tr>
					<td>Password</td>
					<td><input type='text' name='password' value='$row[password]' class='form-control' required></td>

				</tr>
		 
				 <tr>
					<td>Profile</td>
					<td>
					<textarea name='profile' style='height:150px;' class='form-control' required>$row[profile]</textarea>
					</td>
				</tr>

				<tr>
					<td>Status</td>
					<td>
						$row[status]
					</td>
				</tr>

				<tr>
					<td>City</td>
					<td><input type='text' name='city' value='$row[city]' class='form-control' required></td>
				</tr>

				<tr>
					<td>State</td>
					<td><input type='text' name='state' value='$row[state]' class='form-control' required></td>
				</tr>
				
				<tr>
					<td>Country</td>
					<td><input type='text' name='country' value='$row[country]' class='form-control' required></td>
				</tr>
		 
				<tr>
					<td></td>
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
	else
	{
		$alert = alert_status();
		echo $alert;
	}
?>

</div>

<?php

function alert_status()
{
	if(isset($_GET['topic']))
	{

	  $greenthing = '<div class="row">
					<div class="col-sm">
						<div class="alert alert-success">
							<strong>Good day!</strong> You are logged in as ' . $_SESSION["user"]
					. '	</div>
					</div>
					</div>';
	}
	else
	{
	  $greenthing = '<div class="row">
					<div class="col-sm">
						<div class="alert alert-danger">
							Warning, you are not logged in, so you are not able to see this page.
							<br/> If you want to see this page, please log in through the header above.
						</div>
					</div>
					</div>';
	}
	return $greenthing;
}

function update()
{
	$conn = OpenCon();
	$sql = "select * from users where uid = $_SESSION[uid]";
	
	/* Finds the user in the users table and creates an SQL update query to change the user's details */
	$row = grab_first_row($conn, $sql);
	$sql_edit = write_update($row);
	
	if($sql_edit == '-1')
	{
		echo "ERROR:  NO CHANGE DETECTED";
	}
	else
	{
		$sql = "UPDATE users
				$sql_edit
				where uid = $_SESSION[uid]
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
			redirect('profile.php');
		}
	}
}

if(isset($_POST['save']))
{
	update();
}

?>
</body>
</html>