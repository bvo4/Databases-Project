<?php
	function returnHeader(){
		
	session_start();
	$profile = 'User Page';
	if(isset($_SESSION['user']))
	{
		$profile = $_SESSION['user'];
	}
					
		
	$header = '
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
	<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="homepage.php">Home</a>
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
				<form action = "login.php" method="post">
				<a class="nav-link" href= "login.php">Topic</a>
				</form>
			</li>
			<li class="nav-item dropdown">
				<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
					data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					' . $profile . '
				</a>
				<div class="dropdown-menu" aria-labelledby="navbarDropdown">
					<a class="dropdown-item" href="login.php">Login</a>
					<a class="dropdown-item" href="profile.php">Profile</a>
					<div class="dropdown-divider"></div>
					<a class="dropdown-item" href = "login.php?logout=true">Sign Out</a>
				</div>
			</li>
		</ul>
		<form class="form-inline my-2 my-lg-0" method="POST" action="search.php">
    <input class="form-control mr-sm-2" type="search" name="search" placeholder="Search" aria-label="Search">
    <button class="btn btn-primary my-2 my-sm-0" type="submit">Search</button>
</form>
	</div>
</nav>';

	return $header;
	}
	
	function question()
	{
		//echo "TEST";
	}
	
	if(array_key_exists('login',$_POST)){
	   question();
	}

?>