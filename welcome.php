<?php
error_reporting(E_ERROR | E_PARSE);   //while debugging remove this as ll warnings lost!! 
session_start();
?>
<html>
 <head>
  <title>DUMMY University Website</title>
 </head>
 <body>
  <h1>
  	I am Manikanta. I am sam fan!!
  	<br>
  </h1>
  <h1>
 	<?php
 	echo "Hi ".$_SESSION["name"];
 	  ?>
 </h1> 
  

<center>
<h2>
  Contine as:
</h2>
<form method="post">	
  <input type="radio" name="identity" required="required" value="student" vertical-align: middle;"> <font size="6">Student</font><br>
  <input type="radio" name="identity" required="required" value="instructor" vertical-align: middle;"> <font size="6">Instructor</font><br>
  <br>
  <input type="submit" style="height:30px; width:50px" value="Login">
</form>
</center>
</div>

 </body>
</html>

<?php 
// if(isset($_POST['submit'])){
$name = $_SESSION["name"];
$email = $_SESSION["email"];
$userpassword = $_SESSION["userpassword"];

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "university1";
$designation = $_POST["identity"];
$mysqli = new mysqli($servername, $username, $password,$dbname);
if (mysqli_connect_errno()) {
    die("Connection failed: " . mysqli_connect_error());
}
// // echo "Connection established <br> ";
if($designation === "student" or $designation === 'instructor'){
if($designation === "student"){
	$sql_query = "SELECT sid FROM student WHERE name = '$name' AND emailid = '$email' limit 1";
	// echo "$sql_query";
	$result = $mysqli->query($sql_query);
	// print_r($result);
	if($result->num_rows > 0){
	header("Location: student.php");
}else{
   echo "You are not added as student :(";
}
}else{
	$sql_query = "SELECT * FROM instructor WHERE name = '$name' AND emailid = '$email' limit 1";
	$result = $mysqli->query($sql_query);
	if($result->num_rows > 0){
	header("Location: instructor.php");
}else{
   echo "You are not added as instructor :(";
}	
}
}
// $conn->close();
// }
?>