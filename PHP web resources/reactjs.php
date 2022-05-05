<?php
//Obtains the contents of the first row from an sql query
function grab_first_row($conn, $sql) {
	$stmt = mysqli_query($conn, $sql);
	$row = mysqli_fetch_array($stmt);
	return $row;
}

//Redircts to provided web page
function redirect($page)
{
    echo "<script> location.href='" . $page   . "'" . "; </script>";
    exit;
}

//Used in profile.php.  Updates user info based off what was changed or what wasn't.
function write_update($row)
{
	$sql_edit = "SET ";
	$previous_change = False;
	if(isset($_POST['username']) && strcmp($_POST['username'], $row['username']) !== 0)
	{
		$sql_edit .= 'username = "' . $_POST['username'] . '"';
		$previous_change = True;
	}
	if(isset($_POST['password']) && strcmp($_POST['password'], $row['password']) !== 0)
	{
		if($previous_change)
		{
			$sql_edit .= ', ';
		}
		$sql_edit .= 'password = "' . $_POST['password'] . '"';
		$previous_change= True;
	}
	if(isset($_POST['profile']) && strcmp($_POST['profile'], $row['profile']) !== 0)
	{
		if($previous_change)
		{
			$sql_edit .= ', ';
		}
		$sql_edit .= 'profile = "' . $_POST['profile'] . '"';
		$previous_change= True;
	}
	if(isset($_POST['city']) && strcmp($_POST['city'], $row['city']) !== 0)
	{
		if($previous_change)
		{
			$sql_edit .= ', ';
		}
		$sql_edit .= 'city = "' . $_POST['city'] . '"';
		$previous_change= True;
	}
	if(isset($_POST['state']) && strcmp($_POST['state'], $row['state']) !== 0)
	{
		if($previous_change)
		{
			$sql_edit .= ', ';
		}
		$sql_edit .= 'state = "' . $_POST['state'] . '"';
		$previous_change= True;
	}
	if(isset($_POST['country']) && strcmp($_POST['country'], $row['country']) !== 0)
	{
		if($previous_change)
		{
			$sql_edit .= ', ';
		}
		$sql_edit .= 'country = "' . $_POST['country'] . '"';
		$previous_change = True;
	}
	
	//Returns sql query for the update.
	if($previous_change)
	{
		return $sql_edit;
	}
	//If no changes found, output -1
	else
	{
		return '-1';
	}
}

function write_question_update($row)
{
	$sql_edit = "SET ";
	$previous_change = False;
	
	if(isset($_POST['title']) && strcmp($_POST['title'], $row['title']) !== 0)
	{
		$sql_edit .= 'title = "' . $_POST['title'] . '"';
		$previous_change = True;
	}
	
	if(isset($_POST['body']) && strcmp($_POST['body'], $row['body']) !== 0)
	{
		if($previous_change)
		{
			$sql_edit .= ', ';
		}
		$sql_edit .= 'body = "' . $_POST['body'] . '"';
		$previous_change = True;
	}
	
	if(isset($_POST['stid']) && strcmp($_POST['stid'], $row['stid']) !== 0)
	{
		if($previous_change)
		{
			$sql_edit .= ', ';
		}
		$sql_edit .= 'stid = ' . $_POST['stid'];
		$previous_change = True;
	}
	
	//Returns sql query for the update.
	if($previous_change)
	{
		return $sql_edit;
	}
	//If no changes found, output -1
	else
	{
		return '-1';
	}
}

function write_answer_update($row)
{
	$sql_edit = "SET ";
	$previous_change = False;
	
	if(isset($_POST['body']) && strcmp($_POST['body'], $row['body']) !== 0)
	{
		$sql_edit .= 'body = "' . $_POST['body'] . '"';
		$previous_change = True;
	}
	
	//Returns sql query for the update.
	if($previous_change)
	{
		return $sql_edit;
	}
	//If no changes found, output -1
	else
	{
		return '-1';
	}	
}

?>