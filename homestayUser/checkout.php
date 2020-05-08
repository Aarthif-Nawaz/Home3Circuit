<?php
session_start();
include ("connection.php"); //include db.php file to connect to DB
include ("detectlogin.php");
$pagename="Your Finalized Bookings"; //create and populate variable called $pagename
echo "<link rel=stylesheet type=text/css href=style/mystylesheet.css>";
echo "<title>".$pagename."</title>";
include ("headfile.html");
echo "<h4>".$pagename."</h4>";
echo "<body>";
date_default_timezone_set("Asia/Colombo");
$subtotal = 0;
$total = 0;
$userId = $_SESSION['userId'];
$currentdatetime = date("Y-m-d H:i:s");
$sql = "INSERT INTO booking(userId, bookingDateTime, bookingStatus) VALUES ($userId,'$currentdatetime','Booked')";
$exeSQL = mysqli_query($conn, $sql) or die (mysqli_error());
if(mysqli_errno($conn)==0){
    $maxOrder = "SELECT * FROM booking ORDER BY bookingNo DESC";
    $exemaxOrder = mysqli_query($conn, $maxOrder) or die (mysqli_error());
    $arrayord = mysqli_fetch_array($exemaxOrder);
    $orderNumber = $arrayord['bookingNo'];
    echo "<table>";
    echo "<th> HomeStay Name </th>";
    echo "<th> homeStayPrice  </th>";
    echo "<th> Rooms Booked </th>";
    echo "<th> Arrival </th>";
    echo "<th> Departure </th>";
    echo "<th> No Of People </th>";
    echo "<th> Subtotal </th>";

    foreach ($_SESSION['booking'] as $index => $value) {

        $ArrivalD = str_replace("'", "", $value[1]);
        $departD = str_replace("'", "", $value[2]);

        $ArrivalD = strtotime($ArrivalD);
        $departD = strtotime($departD);
        $diff = abs($ArrivalD - $departD);
        $years = floor($diff / (365*60*60*24)); 
        $months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));  
        $days = floor(($diff - $years * 365*60*60*24 -  $months*30*60*60*24)/ (60*60*24)); 


        $prod = "SELECT * FROM homestay WHERE homestayId=$index";
        $exeprod = mysqli_query($conn, $prod) or die (mysqli_error());
        $arrayb =  mysqli_fetch_array($exeprod);
        $subtotal = $arrayb['homestayPrice'] * $days;
        $orderLine = "INSERT INTO booking_line(bookingNo, homestayId, RommsBooked, ArrivalDate, DepartureDate, NoOfPeople, subTotal) VALUES ($orderNumber,$index,$value[0],$value[1],$value[2],$value[3],$subtotal)";
        $exeOrderLine = mysqli_query($conn, $orderLine) or die (mysqli_error());
        echo "<tr>";
        echo "<td>".$arrayb['homestayName']."</td>";
        echo "<td>".$arrayb['homestayPrice']."</td>";
        echo "<td>".$value[0]."</td>";
        echo "<td>".$value[1]."</td>";
        echo "<td>".$value[2]."</td>";
        echo "<td>".$value[3]."</td>";
        echo "<td>".$subtotal."</td>";
        echo "</tr>";
        $total += $subtotal;

    }
    echo "<tr><td colspan='6'> Total </td>";
    echo "<td>".$total."</td></tr>";
    echo "</table>";
    $update = "UPDATE booking SET bookingTotal=$total WHERE bookingNo=$orderNumber";
    $exeUpdate = mysqli_query($conn, $update) or die (mysqli_error());
    echo "<br>";
    echo "<a href='logout.php'> Logout </a>";
}
else{
    echo "There has been an error placing the order <br>";
}
unset($_SESSION['booking']);
include ("footfile.html");
echo "</body>";
?>