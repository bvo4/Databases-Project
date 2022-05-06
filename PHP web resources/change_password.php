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

    <title>Change Password</title>

    <!-- Bootstrap CSS will be here -->
</head>
<body>

<!-- navigation bar will be here -->
<div class="container mt-5">
    <div class="row">
    <div class="col-sm">
        <h1>Change Password</h1>
    </div>
</div>

<table class='table table-hover'>
<form action='#' method='post'>
		<form action="POST" action = 'change_password.php'>
        <tr>
            <td>Current Password</td>
            <td><input type='password' name='curr' class='form-control' required></td>
        </tr>

        <tr>
            <td>New Password</td>
            <td><input type='password' name='password' class='form-control' required></td>
        </tr>

        <tr>
            <td>Re-enter Password</td>
            <td><input type='password' name='password2' class='form-control' required></td>
        </tr>

        <tr>
            <td></td>
            <td>
					<button type="submit" name='cancel' class="btn btn-primary">
						<span class="glyphicon glyphicon-plus"></span> Change Password
					</button>
          <a href = "profile.php">Cancel</a>
                    <!--
                    <button type="submit" name='register' color="secondary" class="btn btn-danger">
                        <span class="glyphicon glyphicon-plus"></span> Register
                    </button> -->

        </td>
        </tr>
        </table>
        </form>
</form>

</div>

<?php

if(isset($_POST['curr']))
{
	reset_password();
}


function alert_status($changed)
{
	if($changed == 0){
	  $greenthing = '<div class="row">
					<div class="col-sm">
						<div class="alert alert-success">
							<center><strong>Password changed successfully</strong></center>	</div>
					</div>
					</div>';
  }
	elseif ($changed == 1)
	{
	  $greenthing = '<div class="row">
					<div class="col-sm">
						<div class="alert alert-danger">
							<center><strong>Passwords do not match</strong></center>
						</div>
					</div>
					</div>';
	}
  else{
    $greenthing = '<div class="row">
					<div class="col-sm">
						<div class="alert alert-danger">
							<center><strong>Incorrect password</strong></center>
						</div>
					</div>
					</div>';
  }
	return $greenthing;
}

//Logs the user in
function reset_password()
{
	include 'db_connection_project.php';
	$conn = OpenCon();

	$uid = $_SESSION['uid'];
  $curr = $_POST['curr'];
	$password = $_POST['password'];
  $pass2 = $_POST['password2'];

	//Check if the username and password match the MySQL query
	$sql = "select *
			from users
			where uid = '$uid'
			and password = '$curr'
			";
	$stmt = mysqli_query($conn, $sql);

	if (mysqli_num_rows($stmt) > 0) { #current password matches
		if($password == $pass2){
      $sql = "UPDATE users set password = '$password' where uid = $uid"; #change password
      $stmt = mysqli_query($conn, $sql);
      if(!$stmt)
  		{
  			echo mysqli_error($conn);
  			die();
  		}
  		else
  		{
  			echo alert_status(0); #success
  			redirect('profile.php'); #not redirecting?
  		}
    }
    else{
      echo alert_status(1); #passwords don't match
    }

		exit;

	} else {
        echo alert_status(2); #incorrect password
	}
}

?>
</body>
</html>
