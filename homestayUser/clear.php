<?php
    session_start();
include("detectlogin.php");
    $total = 0;
    include ("connection.php"); //include db.php file to connect to DB
    $pagename="Clear Basket"; //create and populate variable called $pagename
    echo "<link rel=stylesheet type=text/css href=style/mystylesheet.css>";
    echo "<title>".$pagename."</title>";
    session_unset();
    echo "<p><i> Your basket is now empty ! </i></p>";
    echo "<body>";
include ("headfile.html");
echo "<h4>".$pagename."</h4>";
//create a $SQL variable and populate it with a SQL statement that retrieves product details
echo "<table border='4'>";
echo"<tr>";
echo "<th> Product Name </th>";
echo "<th> Price  </th>";
echo "<th> Quantity </th>";
echo "<th> Subtotal </th>";
echo"</tr>";
echo "<tr>";
echo "<td colspan='3'> Total </td>";
echo "<td> $".$total."</td>";
echo "</tr>";
echo "</table>";
echo "<br>";
include ("footfile.html");
echo "</body>";
?>