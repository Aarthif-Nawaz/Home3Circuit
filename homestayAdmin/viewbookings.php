<?php
session_start();
include ("detectlogin.php");
include ("connection.php"); //include db.php file to connect to DB
$pagename="View My Bookings"; //create and populate variable called $pagename
echo "<link rel=stylesheet type=text/css href=style/mystylesheet.css>";
echo "<title>".$pagename."</title>";
echo "<body>";
include ("headfile.html");
echo "<h4>".$pagename."</h4>";
if(isset($_SESSION['userId'])){
    $totalB = 0;
    $totalR = 0;
    $email = $_SESSION['userEmail'];
    $SQL="select * from homestay where emailAddress='$email'";
    $exeSQL=mysqli_query($conn, $SQL) or die (mysqli_error());
    echo "<div id='left'>";
    echo "<table>";
    echo "<th> HomeStay Name </th>";
    echo "<th> Customer Name </th>";
    echo "<th> Rooms Booked </th>";
    echo "<th> Arrival </th>";
    echo "<th> Departure </th>";
    echo "<th> No Of People </th>";
    echo "<th> Total </th>";
    //run SQL query for connected DB or exit and display error message
    
    while($arrayp=mysqli_fetch_array($exeSQL)){
        $id = $arrayp['homestayId'];
        try{
            $SQL2 = "SELECT * from booking_line where homestayId=$id";
            $exeSQL2=mysqli_query($conn, $SQL2) or die (mysqli_error());
            while($arrayp2=mysqli_fetch_array($exeSQL2)){
                $totalR +=1;
                $bookingNo = $arrayp2['bookingNo'];
                $SQL3 = "SELECT * from booking where bookingNo=$bookingNo";
                $exeSQL3=mysqli_query($conn, $SQL3) or die (mysqli_error());
                $arrayp3=mysqli_fetch_array($exeSQL3);

                $user = $arrayp3['userId'];

                $SQL4 = "SELECT * from users where userId=$user";
                $exeSQL4=mysqli_query($conn, $SQL4) or die (mysqli_error());
                $arrayp4=mysqli_fetch_array($exeSQL4);

                echo "<tr>";
                echo "<td>".$arrayp['homestayName']."</td>";
                echo "<td>".$arrayp4['userFname']." ".$arrayp4['userSname']."</td>";
                echo "<td>".$arrayp2['RommsBooked']."</td>";
                echo "<td>".$arrayp2['ArrivalDate']."</td>";
                echo "<td>".$arrayp2['DepartureDate']."</td>";
                echo "<td>".$arrayp2['NoOfPeople']."</td>";
                echo "<td>".$arrayp3['bookingTotal']."</td>";
                $totalB += $arrayp3['bookingTotal'];
                echo "</tr>";
            }
        }catch(Exception $ex){
            echo "";
        }
    }
    echo "</table>";
    echo "</div>";

    echo "<br>";
    echo "<br>";
    
    echo "<div>";
    echo "<table>";
    echo "<th> Total Reservations </th>";
    echo "<th> Total Revenue </th>";
    echo "<th> Target For Month </th>";
    echo "<th> Pending </th>";
    echo "<tr>";
    echo "<td>".$totalR."</td>";
    echo "<td>".$totalB."</td>";
    echo "<td>".intval(30)."</td>";
    echo "<td>".(30-$totalR)."</td>";
    echo "</tr>";
    echo "</table>";
    echo "</div>";
}
else{
    echo "Login to View the bookings for your homeStay <a href='login.php'>Login</a>";
    echo "Dont have an account <a href='signup.php'>SignUp</a>";
}
echo "<br>";
echo "<br>";
include ("footfile.html");
echo "</body>";
?>