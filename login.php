<?php 

error_reporting(E_ERROR | E_PARSE);   //while debugging remove this as ll warnings lost!! 
session_start();
?>
<html>
<head>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <section class="loginform cf">
    <form method="post">
      Name:
      <input type="text" name="username" placeholder="yourname" required value="<?php if(isset($_POST['username'])) { echo htmlentities ($_POST['username']); }?>">
      <br>
      <br>
      Email:
      <input type="email" name="usermail" placeholder="yourname@email.com" required value="<?php if(isset($_POST['usermail'])) { echo htmlentities ($_POST['usermail']); }?>">
      <br>
      <br>
      Password:
      <input type="password" name="password" placeholder="password" required value="<?php if(isset($_POST['password'])) { echo htmlentities ($_POST['password']); }?>">
      <br>
      <br>
      <input type="submit" value="Login">
      <br>
      <br>


<?php 
// if(isset($_POST['submit'])){
$name = $_POST["username"];
$email = $_POST["usermail"];
$userpassword = $_POST["password"];
$_SESSION["name"] = $name;
$_SESSION["email"] = $email;
$_SESSION["userpassword"] = "$userpassword";
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "university1";
$mysqli = new mysqli($servername, $username, $password,$dbname);
if (mysqli_connect_errno()) {
    die("Connection failed: " . mysqli_connect_error());
}
// echo "Connection established <br> ";
if($name!=""){
$sql_query = "SELECT password FROM credentials WHERE username = '$name' limit 1";
// echo $sql_query;
// echo "<br>";
$result = $mysqli->query($sql_query);
if($result->num_rows > 0){
  // echo "Got 1 row!";
  // echo "<br>";
  $row = $result->fetch_assoc();
  // print_r($row);
  // echo "<br>";
  $correct = 0;
  // echo $userpassword;
  // echo "<br>";
  if($userpassword === $row["password"]){
    $correct = 1;
  }
  if($correct == 0){
    echo "username or password is incorrect!";
  }else{
    // echo "All correct <br>";
    header("Location: welcome.php");
  }
}else{
  // echo "Got No row!";
  if($username!==""){
  $sql_query = "INSERT INTO credentials(username, password) VALUES('$name', '$userpassword')";
  if ($mysqli->query($sql_query) === TRUE) {
    echo "Now you can login <br>";
  }
}
}
}
// $conn->close();
// }
?>

    </form>
  </section>
</body>
</html>