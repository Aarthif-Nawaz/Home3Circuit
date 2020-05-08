<?php
session_start();
include("detectlogin.php");
include ("connection.php"); //include db.php file to connect to DB
$pagename="Login"; //create and populate variable called $pagename
echo "<link rel=stylesheet type=text/css href=style/mystylesheet.css>";
echo "<title>".$pagename."</title>";
echo "<body>";
include ("headfile.html");
echo "<h4>".$pagename."</h4>";
echo "<form action='login_process.php' method='post'>";
echo "<table>";
echo "<tr>";
echo "<td> <label> Email Address  </label></td>";
echo "<td> <input type='email' name='email' placeholder='Please Enter Email Address '></td>";
echo "</tr>";
echo "<tr>";
echo "<td> <label> Password  </label></td>";
echo "<td> <input type='password' name='pass' placeholder='Please Enter Password'></td>";
echo "</tr>";
echo "<tr>";
echo "<td> <input type='submit' value='Login'></td>";
echo "<td> <input type='reset'  value='Clear Form'></td>";
echo "</tr>";
echo "</table>";
echo "</form>";
echo "New User : <a href='signup.php'>Sign Up </a>";

echo "<br>";
echo "<br>";
include ("footfile.html");
echo "</body>";
?>