<?php
session_start();
include("detectlogin.php");
include ("connection.php"); //include db.php file to connect to DB
$pagename="My Bookings"; //create and populate variable called $pagename
echo "<link rel=stylesheet type=text/css href=style/mystylesheet.css>";
echo "<title>".$pagename."</title>";
function setInterval($f, $milliseconds)
{
    $seconds=(int)$milliseconds/1000;
    while(true)
    {
        $f();
        sleep($seconds);
    }
}
if(isset($_SESSION['userId'])){
    $total = 0;
    $date = 0;
    if (empty($_POST['h_prodid']) || empty($_POST['quantity']) || empty($_POST['Arrival']) || empty($_POST['Departure']) || empty($_POST['family'])){
        echo"<p> Existing Bookings </p>";
    } else { 
        $newprodid = $_POST['h_prodid'];
        $reqQuantity = $_POST['quantity'];
        $Arrival = $_POST['Arrival'];
        $depart = $_POST['Departure'];
        $no = $_POST['family'];
        if($Arrival > $depart){
            echo "<script>alert('Arrival Dates and Departure Dates dont match');</script>";
        }
        else{
           
            $_SESSION['booking'][$newprodid] = array(floatval($reqQuantity),"'$Arrival'","'$depart'",$no);
        }
        
    }
    echo "<body>";
    include ("headfile.html");
    echo "<h4>".$pagename."</h4>";
    //create a $SQL variable and populate it with a SQL statement that retrieves product details
    echo "<table border='4'>";
    echo"<tr>";
    echo "<th> HomeStay Name </th>";
    echo "<th> HomeStay Price  </th>";
    echo "<th> Rooms Booked </th>";
    echo "<th> Arrival </th>";
    echo "<th> Departure </th>";
    echo "<th> No Of People </th>";
    echo "<th> Subtotal </th>";
    echo"</tr>";


    if(isset($_SESSION['booking'])){
        
        foreach ($_SESSION['booking'] as $newprodid=>$values){
            $ArrivalD = str_replace("'", "", $values[1]);
            $departD = str_replace("'", "", $values[2]);

            $ArrivalD = strtotime($ArrivalD);
            $departD = strtotime($departD);
            $diff = abs($ArrivalD - $departD);
            $years = floor($diff / (365*60*60*24)); 
            $months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));  
            $days = floor(($diff - $years * 365*60*60*24 -  $months*30*60*60*24)/ (60*60*24)); 
            
            $prodSQL="select * from homestay where homestayId=".$newprodid;
        //execute SQL query
            $exeprodSQL=mysqli_query($conn, $prodSQL) or die (mysqli_error());
        //create array of records & populate it with result of the execution of the SQL query
            $thearrayprod=mysqli_fetch_array($exeprodSQL);
            echo "<tr>";
            echo "<td>".$thearrayprod['homestayName']."</td>";
            echo "<td>".$thearrayprod['homestayPrice']."</td>";
            echo "<td>".$values[0]."</td>";
            echo "<td>".$values[1]."</td>";
            echo "<td>".$values[2]."</td>";
            echo "<td>".$values[3]."</td>";
            echo "<td>".($thearrayprod['homestayPrice']*intval($days))."</td>";
            echo "<form action='Mybookings.php' method='post'>";
            echo "<td><input type='submit' value='Remove'></td>";
            echo "<input type='hidden' name='delID' value=".$newprodid.">";
            echo "</form>";
            echo "</tr>";
            $total += $days*$thearrayprod['homestayPrice'];
        
    }

    }
    else{
        echo "<p><i>Your'booking is empty</i></p>";
    }
    if(isset($_POST["delID"])){
        $delprodid=$_POST["delID"];
        unset($_SESSION['booking'][$delprodid]);
    }
    echo "<tr>";
    echo "<td colspan='6'> Total </td>";
    echo "<td> Rs".$total."</td>";
    echo "</tr>";
    echo "</table>";
    echo "<br>";
    echo "<button style='margin-left:2px; display:inline-block;
    padding:0.2em 1.2em;
    border-radius:1em;
    text-decoration:none;
    font-weight:300;
    color:#FFFFFF;
    background-color:black;
    text-align:center;
    font-size: 18px;'><a href='clear.php' style='text-decoration:none;color:white;' > <p>Clear'booking </p></a></button>";
    echo "<br>";
    echo "<br>";
    echo "<p>Registered Customers </p><a href='logout.php'> Logout </a>";
    echo "<br>";
    echo "<br>";
    echo "<p> TO Finalize Your Bookings <a href='checkout.php'> Confirm Bookings </p>";
}
else{
    include ("headfile.html");
    echo "<h4>".$pagename."</h4>";
    echo "Please Login to View Bookings <a href='login.php'>Login</a>";
}
echo "<br>";
echo "<br>";
include ("footfile.html");
echo "</body>";
?>