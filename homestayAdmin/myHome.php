
<?php
session_start();
include("detectlogin.php");
include ("connection.php"); //include db.php file to connect to DB

$pagename="HomeStay - Admin"; //create and populate variable called $pagename
echo "<link rel=stylesheet type=text/css href=style/mystylesheet.css>";
echo "<title>".$pagename."</title>";
echo "<body>";
include ("headfile.html");
echo "<h4>".$pagename."</h4>";
//create a $SQL variable and populate it with a SQL statement that retrieves product details
if(isset($_SESSION['userId'])){
    $email = $_SESSION['userEmail'];
    $SQL="select * from homestay where emailAddress='$email'";
    //run SQL query for connected DB or exit and display error message
    $exeSQL=mysqli_query($conn, $SQL) or die (mysqli_error());
    echo "<table style='border: 0px'>";
    //create an array of records (2 dimensional variable) called $arrayp.
    //populate it with the records retrieved by the SQL query previously executed.
    //Iterate through the array i.e while the end of the array has not been reached, run through it
    while ($arrayp=mysqli_fetch_array($exeSQL))
    {
        echo "<tr>";
        echo "<td style='border: 0px'>";
        //display the small image whose name is contained in the array
        echo "<img src=Images/".$arrayp['homestayPic']." height=200 width=200>";
        echo "<p>".$arrayp['homestayName']."</p><br>";
        echo "</a>";
        echo "</td>";
        echo "<td style='border: 0px'>";
        echo "<p><h5> No of Rooms : ".$arrayp['homestayRooms']."</h5>"; //display product name as contained in the array
        echo "<p>".$arrayp['homestayDescription']."</p>";
        echo "<b> Price :  Rs ".$arrayp['homestayPrice']."/- Per Room </b>";
        echo "</td>";
        echo "</tr>";
    }
    echo "</table>";

}
else{
    "Please Login to View HomeStays <a href='index.php'>Login</a>";

}
echo "<br>";
echo "<br>";
include ("footfile.html");
echo "</body>";
?>


