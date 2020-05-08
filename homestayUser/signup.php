<?php
session_start();
include("detectlogin.php");
include ("connection.php"); //include db.php file to connect to DB
$pagename="Sign Up"; //create and populate variable called $pagename
echo "<link rel=stylesheet type=text/css href=style/mystylesheet.css>";
echo "<title>".$pagename."</title>";
echo "<body>";
include ("headfile.html");
echo "<h4>".$pagename."</h4>";
echo "<form action='signup_process.php' method='post'>";
echo "<table>";
echo "<tr>";
echo "<td> <label> First Name </label></td>";
echo "<td> <input type='text' name='fname' placeholder='Please Enter First Name '></td>";
echo "</tr>";
echo "<tr>";
echo "<td> <label> Last Name  </label></td>";
echo "<td> <input type='text' name='lname' placeholder='Please Enter Last Name '></td>";
echo "</tr>";
echo "<tr>";
echo "<td> <label> Address  </label></td>";
echo "<td> <input type='text' name='address' placeholder='Please Enter Address '></td>";
echo "</tr>";
echo "<tr>";
echo "<td> <label> PostCode  </label></td>";
echo "<td> <input type='text' name='postCode' placeholder='Please Enter Post Code '></td>";
echo "</tr>";
echo "<tr>";
echo "<td> <label> Tel No  </label></td>";
echo "<td> <input type='text' name='tel' placeholder='Please Enter Telephone Number '></td>";
echo "</tr>";
echo "<tr>";
echo "<td> <label> Email Address  </label></td>";
echo "<td> <input type='email' name='email' placeholder='Please Enter Email Address '></td>";
echo "</tr>";
echo "<tr>";
echo "<td> <label> Password  </label></td>";
echo "<td> <input type='password' name='pass' placeholder='Please Enter Password'></td>";
echo "</tr>";
echo "<tr>";
echo "<td> <label> Confirm Password  </label></td>";
echo "<td> <input type='password' name='cpass' placeholder='Please Confirm Your Password '></td>";
echo "</tr>";
echo "<tr>";
echo "<td> <input type='submit' value='Sign Up'></td>";
echo "<td> <input type='reset'  value='Clear Form'></td>";
echo "</tr>";
echo "</table>";
echo "</form>";
echo "<br>";
echo "<br>";
include ("footfile.html");
echo "</body>";
?>