<?php
session_start();
include("detectlogin.php");
include ("connection.php"); //include db.php file to connect to DB
$pagename="HomeStay Information"; //create and populate variable called $pagename
echo "<body>";
include ("headfile.html");
echo "<h4>".$pagename."</h4>";
echo "<link rel=stylesheet type=text/css href=style/mystylesheet.css>";
echo "<title>".$pagename."</title>";
//retrieve the product id passed from the previous page using the $_GET superglobal variable
//store the value in a variable called $prodid
$prodid=$_GET['u_prod_id'];


//query the product table to retrieve the record for which the value of the product id 
//matches the product id of the product that was selected by the user
$prodSQL="select * from homestay
where homestayId=".$prodid;
//execute SQL query
$exeprodSQL=mysqli_query($conn, $prodSQL) or die (mysqli_error());
//create array of records & populate it with result of the execution of the SQL query
$thearrayprod=mysqli_fetch_array($exeprodSQL);
$name = $thearrayprod['homestayName'];
//display product name in capital letters
echo "<p><b>".strtoupper($name)."</p></b><br>";
echo "<img src=Images/".$thearrayprod['homestayPic']." height=200 width=200> <br>";
echo "<p>".$thearrayprod['homestayDescription']."</p><br>";
echo "<p> Price : Rs ".$thearrayprod['homestayPrice']." /- Per Night </p><br>";
echo "<p><h5> No of Rooms Available - ".$thearrayprod['homestayRooms']."</h5>";

echo "<form action=Mybookings.php method=post>";
echo "<p>Rooms To Book  ";
echo "<select name='quantity' style='margin-left:30px;width:50px;height:30px;color:white;background-color:black;font-size:18px';>";
// this part is to fill the details on how many people are coming to the homestay
for ( $i = 1; $i <= $thearrayprod['homestayRooms']; $i++ ){
 echo "<option value=".$i.">".$i."</option>";
}
echo "</select>"; 
echo "<br>";
echo "<p> Arrival Date ";
echo "<input type='date' name='Arrival' placeholder='Choose Arrival Date' style='margin-left:30px;'></p>";
echo "<p> Departure Date ";
echo "<input type='date' name='Departure' placeholder='Choose Departure Date' style='margin-left:30px;'></p>";
echo "<p> No Of People  ";
echo "<input type='number' name='family' placeholder='Enter How Many People' style='width:200px;margin-left:30px;'></p>";
echo "<input type=submit value='Add Booking' style='margin-left:10px; display:inline-block;
padding:0.3em 1.2em;
border-radius:2em;
text-decoration:none;
font-weight:300;
color:#FFFFFF;
background-color:black;
text-align:center;
font-size: 20px';>";
echo "<input type=hidden name=h_prodid value=".$prodid.">";
echo "</form>";
echo "<br>";
echo "<br>";
include ("footfile.html");
//create a $SQL variable and populate it with a SQL statement that retrieves product details
echo "</body>";
?>
