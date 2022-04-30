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
 
    <title>Login Page</title>
 
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

	$alert = alert_status();
	echo $alert;
?>
<table class='table table-hover'>
<form action='#' method='post'>
		<form action="POST" action = 'login.php'>
        <tr>
            <td>Username</td>
            <td><input type='text' name='username' class='form-control' required></td>
        </tr>
  
        <tr>
            <td>Password</td>
            <td><input type='password' name='password' class='form-control' required></td>
        </tr>
  
        <tr>
            <td></td>
            <td>
					<button type="submit" name='login' class="btn btn-primary">
						<span class="glyphicon glyphicon-plus"></span> Login
					</button>
                    <!--
                    <button type="submit" name='register' color="secondary" class="btn btn-danger">
                        <span class="glyphicon glyphicon-plus"></span> Register
                    </button> -->
                    <a href = "register.php">Register</a>
        </td>
        </tr>
        </table>
        </form>
</form>

</div>

<?php

if(isset($_POST['login']))
{
	login();
}

else if(isset($_POST['register']))
{
	register();
}
else if (isset($_GET['logout'])) {
  logout();
}

/* Informs if the user is logged in or not */
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
							<strong>Good day!</strong> You are not logged in.
						</div>
					</div>
					</div>';
	}
	return $greenthing;
}

//Logs the user in
function login()
{
	include 'db_connection_project.php';
	$conn = OpenCon();
	
	$name = $_POST['username']; //note i used $_POST since you have a post form **method='post'**
	$password = $_POST['password'];

	//Check if the username and password match the MySQL query
	$sql = "select uid, username, `password`
			from users
			where username = '$name'
			and `password` = '$password'
			";	
	$stmt = mysqli_query($conn, $sql);
	
	if (mysqli_num_rows($stmt) > 0) {
		$row = mysqli_fetch_array($stmt);
		
		$_SESSION['user'] = $name;
		$_SESSION['uid'] = $row['uid'];
		
		echo "<script> location.href='homepage.php'; </script>";
		exit;
		
		//Login failed
	} else {
        echo'<div class="row">
                  <div class="col-sm">
                    <div class="alert alert-danger">
                      <center><strong>LOGIN FAILED.  PASSWORD OR USERNAME DOES NOT MATCH</strong></center>
                    </div>
                  </div>
                  </div>';
	}
}

//Logs out the user by destroying the session uid
function logout() {

  echo "LOGGING OUT";
  
  //Apparently need to start the session again to destroy it
  session_unset();
  session_destroy();
  
  echo "<script> location.href='homepage.php'; </script>";
  exit;
}

?>
</body>
</html>
