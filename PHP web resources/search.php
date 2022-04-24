<!DOCTYPE html>
<html lang="en">
<head>
  
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

<?php
	$header = '<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="#">Home</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
  
	<div class="collapse navbar-collapse" id="navbarSupportedContent">
		<ul class="navbar-nav mr-auto">
			<li class="nav-item active">
				<form action = "question.php" method="post">
				<a class="nav-link" href = "question.php">Questions <span class="sr-only">(current)</span></a>
				</form>
			</li>
			<li class="nav-item">
				<form action = "search.php" method="post">
				<a class="nav-link" href= "search.php" >Search</a>
				</form>
			</li>
			<li class="nav-item">
				<form action = "login.php" method="post">
				<a class="nav-link" href= "login.php">Login</a>
				</form>
			</li>
			<!-- drop down will be here -->
		</ul>
		<form class="form-inline my-2 my-lg-0">
    <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
    <button class="btn btn-primary my-2 my-sm-0" type="submit">Search</button>
</form>
	</div>
</nav>';

echo $header;
?>
 
    <title>Bootstrap Tutorial for Beginners</title>
 
    <!-- Bootstrap CSS will be here -->
</head>
<body>
  
<!-- navigation bar will be here -->
<div class="container mt-5">
    <div class="row">
    <div class="col-sm">
        <h1>Bootstrap Sample Page with Form</h1>
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
  
        <tr>
            <td>Name</td>
            <td><input type='text' name='name' class='form-control' required></td>
        </tr>
  
        <tr>
            <td>Contact Number</td>
            <td><input type='text' name='contact_number' class='form-control' required></td>
        </tr>
  
        <tr>
            <td>Address</td>
            <td><textarea name='address' class='form-control'></textarea></td>
        </tr>
  
        <tr>
            <td>List</td>
            <td>
                <select name='list_id' class='form-control'>
                    <option value='1'>List One</option>
                    <option value='2'>List Two</option>
                    <option value='3'>List Three</option>
                </select>
            </td>
        </tr>
  
        <tr>
            <td></td>
            <td>
                <button type="submit" class="btn btn-primary">
                    <span class="glyphicon glyphicon-plus"></span> Submit
                </button>
            </td>
        </tr>
  
    </table>
</form>
</div>
  
<!-- Bootstrap JavaScript will be here -->
  
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

