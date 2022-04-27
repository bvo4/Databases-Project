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
 
    <title>Profile Page</title>
 
    <!-- Bootstrap CSS will be here -->
</head>
<body>
  
<!-- navigation bar will be here -->
<div class="container mt-5">
    <div class="row">
    <div class="col-sm">
        <h1>Login Page</h1>
    </div>
</div>
<?php
	include 'db_connection_project.php';
	$conn = OpenCon();
	$sql = "select *
			from users
			where uid = $_SESSION[uid]
			";
	$stmt = mysqli_query($conn, $sql);	
	$row = $row = mysqli_fetch_array($stmt);

	
	if(isset($_SESSION['uid']))
	{
		$form = "<form action='#' method='post'>
			<table class='table table-hover'>
				<tr>
					<td>Username</td>
					<td><input type='text' name='username' value='$row[uid]' class='form-control' required></td>
				</tr>
		  
				<tr>
					<td>Password</td>
					<td><input type='text' name='password' value='$row[password]' class='form-control' required></td>

				</tr>
		 
				 <tr>
					<td>Profile</td>
					<td><input type='text' name='profile' value='$row[profile]' class='form-control' required></td>
				</tr>

				<tr>
					<td>Status</td>
					<td><input type='text' name='status' value='$row[status]' class='form-control' required></td>
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
							<button type='submit' name='login' class='btn btn-primary'>
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
  
<!-- Bootstrap JavaScript will be here -->

<?php

function alert_status()
{
	if(isset($_SESSION['user']))
	  $greenthing = '<div class="row">
					<div class="col-sm">
						<div class="alert alert-success">
							<strong>Good day!</strong> You are logged in as ' . $_SESSION["user"]
					. '	</div>
					</div>
					</div>';
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


?>
</body>
</html>