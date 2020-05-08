<?php
session_start();
include ("detectlogin.php");
include ("connection.php"); //include db.php file to connect to DB
$pagename="Super Admin Dashboard"; //create and populate variable called $pagename
echo "<link rel=stylesheet type=text/css href=style/mystylesheet.css>";
echo "<title>".$pagename."</title>";
echo "<body>";
echo "<h4>".$pagename."</h4>";


echo "<div>";
echo "<div class='content'>";
include ("occupancy.html");
echo "</div>";
echo "<div>";
include ("linegraph.html");
echo "</div>";
echo  "<div>";
include ("bargraph.html");
echo "</div>";
echo "</div>";

echo "<br>";
echo "<br>";
include ("footfile.html");
echo "</body>";
?>