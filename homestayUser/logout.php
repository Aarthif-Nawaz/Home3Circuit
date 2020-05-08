<?php
session_start();
include ("connection.php");
$pagename="LogOut"; //create and populate variable called $pagename
echo "<link rel=stylesheet type=text/css href=style/mystylesheet.css>";
echo "<title>".$pagename."</title>";
echo "<h4>".$pagename."</h4>";
    echo "<p>" .$_SESSION['fname']." ".$_SESSION['lname']."</p>";
    unset($_SESSION['userId']);
    session_destroy();
    echo "<body>";
    include ("headfile.html");
    echo "You are now Logged Out";
    include ("footfile.html");
    echo "<br>";
    echo "<br>";
    echo "</body>";
?>