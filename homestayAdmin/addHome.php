<?php
session_start();
include("detectlogin.php");
include ("connection.php"); //include db.php file to connect to DB
$pagename="Add HomeStay"; //create and populate variable called $pagename
echo "<link rel=stylesheet type=text/css href=style/mystylesheet.css>";
echo "<title>".$pagename."</title>";
echo "<body>";
include ("headfile.html");
echo "<h4>".$pagename."</h4>";
echo "<form action='addHome_conf.php' method='post'>";
echo "<table>";
echo "<tr>";
echo "<td> <label> Colombo Area </label></td>";
echo "<td> <input type='number' name='area' placeholder='Please Enter Which Area In Colombo '></td>";
echo "</tr>";
echo "<tr>";
echo "<td> <label> HomeStay Name </label></td>";
echo "<td> <input type='text' name='prodName' placeholder='Please Enter HomeStay Name '></td>";
echo "</tr>";
echo "<tr>";
echo "<td> <label> HomeStay Picture  </label></td>";
echo "<td> <input type='text' name='prodSmall' placeholder='Please Provide HomeStay Picture '></td>";
echo "</tr>";
echo "<tr>";
echo "<td> <label> HomeStay Description  </label></td>";
echo "<td> <input type='text' name='shortDes' placeholder='Please provide HomeStay Description '></td>";
echo "</tr>";
echo "<tr>";
echo "<td> <label> Rooms  </label></td>";
echo "<td> <input type='number' name='rooms' placeholder='Please Enter Number Of Rooms '></td>";
echo "</tr>";
echo "<tr>";
echo "<td> <label> Price  </label></td>";
echo "<td> <input type='number' name='price' placeholder='Please Enter Price'></td>";
echo "</tr>";
echo "<tr>";
echo "<td> <input type='submit' value='Add HomeStay'></td>";
echo "<td> <input type='reset'  value='Clear Form'></td>";
echo "</tr>";
echo "</table>";
echo "</form>";
echo "<br>";
echo "<br>";
include ("footfile.html");
echo "</body>";
?>