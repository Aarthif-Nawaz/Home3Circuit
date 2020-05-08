<?php
session_start();
include("detectlogin.php");
include ("connection.php"); //include db.php file to connect to DB
$pagename="HomeStay Added Details"; //create and populate variable called $pagename
echo "<link rel=stylesheet type=text/css href=style/mystylesheet.css>";
echo "<title>".$pagename."</title>";
echo "<body>";
include ("headfile.html");
echo "<h4>".$pagename."</h4>";

$area = $_POST['area'];
$prodName = $_POST['prodName'];
$prodPicSmall = $_POST['prodSmall'];
$prodShortDes = $_POST['shortDes'];
$prodLongDes = $_POST['rooms'];
$price = $_POST['price'];
$adminID = $_SESSION['userEmail'];
if(!empty($prodName) && !empty($prodPicSmall) && !empty($prodShortDes) && !empty($prodLongDes) && !empty($price) && !empty($area)){
    $command = escapeshellcmd("python HomeCircuitVisualization.py $area");
    $output = shell_exec($command);
    $que = array();
    $getSQL = "SELECT * from factor";
    $exeSQL1 = mysqli_query($conn, $getSQL);
    while($arrayp=mysqli_fetch_array($exeSQL1)){
        array_push($que,$arrayp['PercentageImpacted']);
    }

    $insertSQL = "INSERT INTO homestay(colombo, homestayName, homestayPic, homestayDescription, homestayRooms, homestayPrice, emailAddress, homestayCulture, homestayMedical, homestayWeather) VALUES ($area,'$prodName','$prodPicSmall','$prodShortDes',$prodLongDes,$price,'$adminID',$que[0],$que[1],$que[2])";
    $exeSQL = mysqli_query($conn, $insertSQL);
    
    if(mysqli_errno($conn)==0){
        $fs = fopen("HomeCircuit - Sheet1.csv","a");
        $prodName = str_replace(' ', '', $prodName);
        fputcsv($fs, array($area,$prodName,$prodLongDes,$price,$que[0],$que[1],$que[2]));
        fclose($fs);
        echo "Your HomeStay Was Added Successfully ! <br>";
        echo "Continue to Home Page <a href='myHome.php'> Home </a>";
    }
    else{
        echo " Unable to Add HomeStay ! <br>";
        if(mysqli_errno($conn)==1062){
            echo 'HomeStay Name Already Exists !<br>';
            echo "<p>Go Back to Home Page : </p><a href='myHome.php'> Home </a>";
        }
        elseif(mysqli_errno($conn)==1064){
            echo 'Invalid Characters entered !<br>';
            echo "<p>Go Back to Home Page : </p><a href='myHome.php'> Home </a>";
        }
        elseif(mysqli_errno($conn)==1054){
            echo 'Illegal Characters have been entered !<br>';
            echo "<p>Go Back to Home Page : </p><a href='myHome.php'> Home </a>";
        }
    }
}
else{
    echo "Fill in all fields to Add a HomeStay !<br>";
    echo "<p>Go Back to Home Page : </p><a href='myHome.php'> Home </a>";
}
echo "<br>";
echo "<br>";
include ("footfile.html");
echo "</body>";
?>