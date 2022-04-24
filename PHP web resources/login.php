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
<div class="row">
    <div class="col-sm">
        <div class="alert alert-success">
            <strong>Good day!</strong> This is an example alert.
        </div>
    </div>
</div>
<form action='#' method='post'>
    <table class='table table-hover'>
		<form action="POST" action = 'login.php'>
        <tr>
            <td>Username</td>
            <td><input type='text' name='username' class='form-control' required></td>
        </tr>
  
        <tr>
            <td>Password</td>
            <td><input type='text' name='password' class='form-control' required></td>
        </tr>
  
        <tr>
            <td></td>
            <td>
					<button type="submit" name='login' class="btn btn-primary">
						<span class="glyphicon glyphicon-plus"></span> Login
					</button>
				</form>
            </td>
        </tr>
  
    </table>
</form>
</div>
  
<!-- Bootstrap JavaScript will be here -->

<?php

function login()
{
	include 'db_connection_project.php';
	$conn = OpenCon();
	
	$name = $_POST['username']; //note i used $_POST since you have a post form **method='post'**
	$password = $_POST['password'];
	
	$sql = "select username, `password`
			from users
			where username = '$name'
			and `password` = '$password'
			";	
	$stmt = mysqli_query($conn, $sql);
	
	if (mysqli_num_rows($stmt) > 0) {
		echo "LOGIN SUCCESS";
	} else {
		echo "LOGIN FAILED.  PASSWORD OR USERNAME DOES NOT MATCH";
	}
}

if(isset($_POST['login']))
{
	login();
}


?>
  
</body>
</html>

<!-- Bootstrap CSS -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

<!-- javascript for bootstrap -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
    integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
</script>
  
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
    integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
</script>
  
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
    integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
</script>

