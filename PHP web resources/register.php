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

    <title>Register</title>

    <!-- Bootstrap CSS will be here -->
</head>
<body>

<!-- navigation bar will be here -->
<div class="container mt-5">
    <div class="row">
    <div class="col-sm">
        <h1>Create an Account</h1>
    </div>
</div>

<form action='#' method='post'>
    <table class='table table-hover'>
		<form action="POST" action = 'register.php'>
        <tr>
            <td>Create Username</td>
            <td><input type='text' name='username' class='form-control' required></td>
        </tr>

        <tr>
            <td>Create Password</td>
            <td><input type='password' name='password' class='form-control' required></td>
        </tr>

        <tr>
            <td>Retype Password</td>
            <td><input type='password' name='password2' class='form-control' required></td>
        </tr>
        <tr>
            <td>City</td>
            <td><input type='text' name='city' class='form-control' required></td>
        </tr>
        <tr>
            <td>State</td>
            <td><input type='text' name='state' class='form-control' required></td>
        </tr>
        <tr>
            <td>Country</td>
            <td><input type='text' name='country' class='form-control' required></td>
        </tr>

        <tr>
            <td></td>
            <td>
					<button type="submit" name='register' color="secondary" class="btn btn-danger">
						<span class="glyphicon glyphicon-plus"></span> Register
					</button>
				</form>
            </td>
        </tr>

    </table>
</form>
</div>

<!-- Bootstrap JavaScript will be here -->

<?php
if(isset($_POST['register']))
{
	register();
}

function register()
{
	include 'db_connection_project.php';

	$conn = OpenCon();
	$name = $_POST['username']; //note i used $_POST since you have a post form **method='post'**
	$password = $_POST['password'];
  $password_check = $_POST['password2'];
  $city = $_POST['city'];
  $state = $_POST['state'];
  $country = $_POST['country'];

  if($password == $password_check){
    $sql = "SELECT *
        FROM users
        WHERE username = '$name'";
    $usercheck = mysqli_query($conn, $sql);
    $num = mysqli_num_rows($usercheck);
		if($num > 0){
      echo'<div class="row">
            <div class="col-sm">
              <div class="alert alert-danger">
                <center><strong>This username already exists</strong></center>
              </div>
            </div>
            </div>';
    }
    else{
      echo "hereth";
    	$sql = "SELECT uid
    			FROM users
    			order by uid desc
    			limit 1";
      echo "grab";
    	$rows = mysqli_query($conn, $sql);
      $row = mysqli_fetch_array($rows);
      echo "row";
    	$uid = $row['uid'] + 1;
      echo "uid";
    	$sql = "INSERT INTO users(uid, username, password, profile, status, city, state, country)
    			VALUES ($uid, '$name', '$password', 'PLACEHOLDER PROFILE', 'BASIC', '$city', '$state', '$country')";
      echo "insert";
    	$stmt = mysqli_query($conn, $sql);
      echo "here12";
    	if(!$stmt)
    	{
        echo "here2";
    		echo mysqli_error($conn);
    		die();
    	}
    	else
    	{
        echo "here2312";
    		$_SESSION['uid'] = $uid;
    		$_SESSION['user'] = $name;

    		include 'reactjs.php';
    		echo "You have registered to the site.  One moment";
        echo "<script> location.href='homepage.php'; </script>";
        redirect("profile.php");

    	}
    }
  }
  else{
    echo'<div class="row">
          <div class="col-sm">
            <div class="alert alert-danger">
              <center><strong>Passwords do not match</strong></center>
            </div>
          </div>
          </div>';
  }
}
?>
</body>
</html>
