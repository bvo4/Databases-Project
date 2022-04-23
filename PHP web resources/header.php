<?php
	function returnHeader(){
	$header = "	<div class='container space-around'>
	<form action = 'question.php' method='post'>
	  <button type='hidden' name = 'Questions' class='tablink' action = 'question.php'>Questions</button>
	</form>
	<form action='search.php' method='post'>
	  <button type='hidden' name = 'search' class = 'tablink'>Search</button>
	</form>
	<form action = 'login.php' method='post'>
	  <button type='hidden' name = 'login' class = 'tablink'>Login</button>
	</form>
	</div>";
	return $header;
	}
?>