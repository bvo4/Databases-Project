<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8" />
    <title>Databases Project Title</title>
  </head>

  <body>

<?php
	include 'header.php';
    include 'db_connection_project.php';
    $conn = OpenCon();
	$header = returnHeader();
	echo $header;
	echo '<h2 style="text-align: center">ANSWERS PAGE</h2>';

    if(isset($_POST['qid']))
    {
        $qid = $_POST['qid'];
        $sql = "select title, body from questions where qid = $qid";
        $stmt = mysqli_query($conn, $sql);
        $row = mysqli_fetch_array($stmt);
        echo '<center><br><h4>' . $row['title'] . '</h4><h5>' . $row['body'] . '</h5></center>';
    }

	//If the user is logged in and is looking at a question, present the option to answer the question
	if(isset($_SESSION['uid']) && isset($_POST['qid']))
	{
		echo "<br><th><form method='post' action='submit_answer.php'>
			<center><button input type='link' name='qid' value=$_POST[qid]>Submit Answer</button></center>
			</form>
		</th><br>";
	}
?>
  
  </body>
</html>

<?php
	
	/* If a user wanted to like an answer or set an answer as best answer */
	if(isset($_POST['like']) && isset($_POST['qid']))
	{
		$qid = $_POST['qid'];
		$aid = $_POST['like'];
		
		$sql = "INSERT INTO likes(aid, uid, points) VALUES ($aid, $_SESSION[uid], 1)";
		mysqli_query($conn, $sql);
	}
	if(isset($_POST['best']))
	{
		select_best();
	}
	//Bring the list of answers for that question
	if(isset($_POST['qid']))
	{
		$qid = $_POST['qid'];
        
		$sql = "select * 
				from answers, post_answers, users
				where post_answers.qid = $qid
				and answers.aid = post_answers.aid
				and users.uid = post_answers.uid
				order by timeposted desc";
		print_sql($conn, $sql, $qid);
		
	}
	//If the user just came back after posting an answer.  Bring back the list of answers from that question and destroy the temp variable.
	//Then, bring the list of answers for that question
	else if(isset($_SESSION['post_qid']))
	{
		$post_qid = $_SESSION['post_qid'];
		unset ($_SESSION['post_qid']);
        
        $sql = "select title, body from questions where qid = $post_qid";
        $stmt = mysqli_query($conn, $sql);
        $row = mysqli_fetch_array($stmt);
        echo '<center><br><h4>' . $row['title'] . '</h4><h5>' . $row['body'] . '</h5></center>';
        
        if(isset($_SESSION['uid']))
        {
            echo "<br><th><form method='post' action='submit_answer.php'>
                <center><button input type='link' name='qid' value=$post_qid>Submit Answer</button></center>
                </form>
            </th><br>";
        }
		
		$sql = "select * 
				from answers, post_answers, users
				where post_answers.qid = $post_qid
				and answers.aid = post_answers.aid
				and users.uid = post_answers.uid
				order by timeposted desc";
		print_sql($conn, $sql, $post_qid);
	}
	/* Blank questions error message */
	else
	{
		$greenthing = '<div class="row">
					<div class="col-sm">
						<div class="alert alert-danger">
							Unfortunately, we have no answers available.
						</div>
					</div>
					</div>';
			echo $greenthing;	
	}
	
	function print_sql($conn, $sql, $qid)
	{
		$like_stmt = null;
		
		if(isset($_SESSION['uid']))
		{
			/* Grab the list of likes made by that user */
			$uid = $_SESSION['uid'];
			$sql_like_check = "select * from users, likes
								where likes.uid = users.uid
								and users.uid = $uid
								;";
			$like_stmt = mysqli_query($conn, $sql_like_check);
		}
		
		$stmt = mysqli_query($conn, $sql);
		$num = mysqli_num_rows($stmt);
		
		if($num > 0)
		{
			print_answer($stmt, $like_stmt, $qid);
		}
		else
		{
		  $greenthing = '<div class="row">
						<div class="col-sm">
							<div class="alert alert-danger">
								Unforutnately, there are no answers for this question.
							</div>
						</div>
						</div>';
			echo $greenthing;
		}
	}
	
	function print_answer($stmt, $like_stmt, $qid)
	{
		include 'reactjs.php';
		$conn = OpenCon();
		$sql = "select uid from post_question where qid = $qid";
		$user_question_id = mysqli_fetch_array(mysqli_query($conn, $sql));
		$user_question_id = $user_question_id['uid'];
		
		//Print answer table header
		echo "
			<table class = 'table table-dark table-hover' style = 'width:100%'>
			<tr>
			<th> Aid:  </th>
			<th> Body:  </th>
			<th> Username:  </th>
			<th> Likes:  </th>
			<th> Date:  </th>";
        if(isset($_SESSION['uid'])){
			echo "<th>Leave a Like?</th>";
            }
        echo "<th>Best Answer</th></tr>";
			
			//Print answer contents
			while($row = mysqli_fetch_array($stmt))
			{
				$like_match = check_likes($like_stmt, $row['aid']);
		
				$test =
						"<tr>"
						. "<th>" . $row['aid'] ."</th> "
						. "<th>" . $row['body'] ."</th>". "</th>"
						. "<th>" . $row['username'] ."</th> " . "</th>"
						. "<th>" . $row['grade'] . "</th>"
						. "<th>" . $row['timeposted'] . "</th>";
				
				/* Check if the user made this answer */
				if(isset($_SESSION['uid']) && $_SESSION['uid'] != $row['uid'])
				{
					/* Check if the user has already liked this answer */
					if(isset($like_stmt) && $like_match)
					{
						$test .="<th><button type='submit' name='like' value=$row[aid] class='btn btn-secondary'>
									You have already liked this
								</button></th>";
					}
					/* Otherwise, show an option to like the answer */
					else
					{
						$test .="<form method='post' action='answer.php'>"
						. "<input type='hidden' name='qid' value=$qid>";
						if(isset($_SESSION['uid']))
						{
							$test .= "<th><button type='submit' name='like' value=$row[aid] class='btn btn-danger'>
								Like
							</button></th>";
						}
					}
				}
					$test .= "</form>";
					/* Inform the user that this is the user's answer */
					if(isset($_SESSION['uid']) && $_SESSION['uid'] == $row['uid'])
					{
						$test .= "
								<th><button class='btn btn-light'>This is your answer!</button>
								</th> ";
					}
					/* Check if the question is selected as best answer.  Otherwise, give the user an option to select this answer as best answer */
                    if($row['best'] == False && $_SESSION['uid'] == $user_question_id)
					{
					$test .= "<form method='post' action='answer.php?qid=$qid'>
							<th><button type='submit' name='best' value=$row[aid] class='btn btn-light'>Select</button>
							</th> "
						. "<input type='hidden' name='qid' value=$qid>
								</form>";
						}
					/* If this is already selected as best answer, inform the user */
					else if($row['best'])
					{
					$test .= "
							<th><button type='submit' name='best' value=$row[aid] class='btn btn-light'>This is Best Answer</button>
							</th> ";
					}
					$test .="</tr>";
					
					echo $test;
			}
				echo "</table>";
	}
	
	/* Function to check for the list of likes made by that user */
	function check_likes($like_stmt, $question_aid)
	{
		$like_match = False;
		if(isset($like_stmt))
		{
			while($like_check = mysqli_fetch_array($like_stmt))
			{
				if($like_check['aid'] == $question_aid)
				{
					$like_match = True;
					break;
				}
			}
		}
		return $like_match;
	}
	
	/* Sends an update query to select an answser as best answer */
	function select_best()
	{
		$conn = OpenCon();
		$aid = $_POST['best'];
		$uid = $_SESSION['uid'];
		
		$qid = $_POST['qid'];
		$sql = "UPDATE post_answers
				SET best=True, grade = grade + 5, weight = weight + 5
				WHERE qid = $qid
				and aid = $aid";
		
		$stmt = mysqli_query($conn, $sql);
	}
	
?>
