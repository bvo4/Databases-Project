<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8" />
    <title>Databases Project</title>
  </head>

  
<style>
 .header {
  padding: 5px;
  text-align: center;
  background: #1abc9c;
  color: white;
  font-size: 15px;
}
.container {
  display: flex;
}
.container.space-around {
  padding: 5px;
  text-align: center;
  background: #808080;
  color: white;
  font-size: 15px;
  justify-content: space-around;
}
.container.space-between {  
  justify-content: space-between;
}

.tablink {
  background-color: #555;
  color: white;
  float: left;
  border: none;
  outline: none;
  cursor: pointer;
  padding: 14px 16px;
  font-size: 17px;
  width: 200%;
  display:inline
}
table, th, td {
  border:1px solid black;
}
</style>



<?php
	include 'header.php';
	$header = returnHeader();
	echo $header;
?>

  <body>

    <h2 style="text-align: center">QUESTIONS PAGE</h2>

	<?php
	include 'reactjs.php';
	
	$button = load_button();
	echo $button;
	?>

  </body>
</html>

<?php
	echo "PROFILE PAGE";

?>