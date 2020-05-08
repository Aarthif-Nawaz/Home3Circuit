<?php
session_start();
include ("detectlogin.php");
include ("connection.php"); //include db.php file to connect to DB
$pagename="Your Login Results"; //create and populate variable called $pagename
echo "<link rel=stylesheet type=text/css href=style/mystylesheet.css>";
echo "<title>".$pagename."</title>";
echo "<body>";
echo "<h4>".$pagename."</h4>";
$email = $_POST['email'];
$pass = $_POST['pass'];
if(!empty($email) && !empty($pass)){
    $exeSQL = "Select * from users where userEmail = '".$email."' and userType=1";
    $exeprodSQL=mysqli_query($conn, $exeSQL) or die (mysqli_error());
    $UserArray = mysqli_fetch_array($exeprodSQL);
    if($UserArray['userEmail']!=$email){
        include ("headfile.html");
        echo "Email Not Recognized";
        echo "<p>Please Sign Up to continue : </p><a href='signup.php'> Sign Up </a>";
    }
    else{
        if($UserArray['userPassword']!=$pass){
            include ("headfile.html");
            echo "Password not recognized !";
            echo "<p>Go Back to Login Page : </p><a href='index.php'>Login</a>";
        }
        else{
            $_SESSION['userEmail'] = $UserArray['userEmail'];
            $_SESSION['userId'] = $UserArray['userId'];
            $_SESSION['fname'] = $UserArray['userFname'];
            $_SESSION['lname'] = $UserArray['userSname'];
            if($UserArray['userType']==1){
                $_SESSION['userType'] = "Customer";
                include ("headfile.html");
                echo "Login Success ! <br>";
                echo "Welcome ".$_SESSION['fname']." ".$_SESSION['lname'];
                echo "<br>";
                echo "Welcome You are Precious Customer";
                echo "<br>";
                echo "<p>Continue Exploring : </p><a href='index.php'>Home</a>";
                echo "<br>";
                echo "<p>Your Bookings : </p><a href='Mybookings.php'>My Bookings</a>";
            }
            
              
        }
    }
}
else{
    include ("headfile.html");
    echo "Fill in all fields to Login !<br>";
    echo "<p>Go Back to Login Page : </p><a href='index.php'>Login</a>";
}
echo "<br>";
echo "<br>";
include ("footfile.html");
echo "</body>";
?>