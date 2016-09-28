<?php
// error_reporting(E_ERROR | E_PARSE);   //while debugging remove this as ll warnings lost!! 
session_start();
?>
<html>
 <head>
 <link rel="stylesheet" type="text/css" href="buttonstyle.css">
  <title>DUMMY University Website</title>
  <style>
ul {
    list-style-type: none;
    margin: 0;
    padding: 0;
    overflow: hidden;
    background-color: #333;
}

li {
    float: left;
}

.browsing{
  font-size: 250%;
}

li a {
    display: inline-block;
    color: white;
    text-align: center;
    padding: 12px 14px;
    text-decoration: none;
}

li a:hover {
    background-color: #111;
}
</style>
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
 <h2>
   Browse:
 </h1>
 <div id = 'browsing' style="margin-left: 200px;">
<!-- <center> -->
  <a class="button" href="displayStudent.php" >Student</a>
  <!-- <br>
  <br>
  <br> -->
  <a class="button" href="displayInstructor.php" style="margin-left: 200px;">Instructor</a>
  <!-- <br>
  <br>
  <br> -->
  <a class="button"   href="displayDepartment.php" style="margin-left: 400px;">Department</a>
  <!-- <br>
  <br>
  <br> -->
  <a class="button"   href="displayCourse.php" style="margin-left: 600px;">Course</a>
  <br>
  <br>
  <br><br>
  <br>
  <br>
  <a class="button"   href="enrollCourse1.php" style="margin-left: 200px;">Enroll course</a>
  <!-- <br>
  <br>
  <br> -->
  <a class="button"   href="unenrollCourse.php" style="margin-left: 400px;">Unenroll course</a>
  <br>
  <br>
  <br>
<!-- </center> -->
 </div>


 </body>
</html>