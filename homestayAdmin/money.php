<?php
session_start();
include ("detectlogin.php");
include ("connection.php"); //include db.php file to connect to DB
$pagename="Your Predicted Money Fluctuations"; //create and populate variable called $pagename
echo "<link rel=stylesheet type=text/css href=style/mystylesheet.css>";
echo "<title>".$pagename."</title>";
echo "<body>";
include ("headfile.html");
echo "<h4>".$pagename."</h4>";
if(isset($_SESSION['userId'])){
    $count = 1;
    $email = $_SESSION['userEmail'];
    $SQL="select * from homestay where emailAddress='$email'";
    $exeSQL=mysqli_query($conn, $SQL) or die (mysqli_error());
    
    echo "<form action='money.php' method='post'>";
    echo "<p style='margin-top:10px'> HomeStay's: ";
    echo "<select name='homestay' style='margin-left:10px;margin-top:10px;width:150px;height:30px;color:black;background-color:#4CAF50;font-size:18px';>";
    echo "<option></option>";
    while($arrayp=mysqli_fetch_array($exeSQL)){
        echo "<option>".$arrayp['homestayName']."</option>";
    }
    echo "</select>";
    echo "<input type='submit' name='search' value='Predict Money Fluctuations' style='background-color: #4CAF50; /* Green */
    float:right;
    border: none;
    color: black;
    padding: 15px 32px;
    width:300px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 16px;'>";
    echo "</form>";

    if(!empty($_POST['homestay'])){
        $name = $_POST['homestay'];
        $name = str_replace(' ', '', $name);
        $command = escapeshellcmd("python PriceFluctuations.py $name");
        $output = shell_exec($command);
        include('fluctuation.html');
        
        
    }
    else{
        echo "Not Chosen any data in order to be Predicted";
    }
        
}
else{
    echo "Please Login to View Your Financial Fluctuations";
}

echo "<br>";
echo "<br>";
include ("footfile.html");
echo "</body>";
?>