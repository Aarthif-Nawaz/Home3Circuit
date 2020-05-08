<?php
session_start();
include ("detectlogin.php");
include ("connection.php"); //include db.php file to connect to DB
$pagename="Your Login Results"; //create and populate variable called $pagename
echo "<link rel=stylesheet type=text/css href=style/mystylesheet.css>";
echo "<title>".$pagename."</title>";
echo "<body>";
include ("headfile.html");
echo "<h4>".$pagename."</h4>";
$email = $_POST['email'];
$pass = $_POST['pass'];
if(!empty($email) && !empty($pass)){
    $exeSQL = "Select * from users where userEmail = '".$email."' and userType in (0,2)";
    $exeprodSQL=mysqli_query($conn, $exeSQL) or die (mysqli_error());
    $UserArray = mysqli_fetch_array($exeprodSQL);
    if($UserArray['userEmail']!=$email){
        echo "Email Not Recognized";
        echo "<p>Please Sign Up to continue : </p><a href='signup.php'> Sign Up </a>";
    }
    else{
        if($UserArray['userPassword']!=$pass){
            echo "Password not recognized !";
            echo "<p>Go Back to Login Page : </p><a href='index.php'>Login</a>";
        }
        else{
            if($UserArray['userType']==2){
                echo "Login Success ! <br>";
                $_SESSION['userType'] = "Super Admin";
                echo "Welcome Super Administrator ".$_SESSION['fname'].$_SESSION['lname'];
                echo "<br> <a href='super.php'> Home </a>";
            }
            else{
                echo "Login Success ! <br>";
                $_SESSION['userType'] = "Admin";
                $_SESSION['userEmail'] = $UserArray['userEmail'];
                $_SESSION['userId'] = $UserArray['userId'];
                $_SESSION['fname'] = $UserArray['userFname'];
                $_SESSION['lname'] = $UserArray['userSname'];
                
                echo "Welcome Administrator ".$_SESSION['fname'].$_SESSION['lname'];
                echo "<br> <a href='myHome.php'> Home </a>";   
            }
            
            
        }
    }
}
else{
    echo "Fill in all fields to Login !<br>";
    echo "<p>Go Back to Login Page : </p><a href='index.php'>Login</a>";
}
echo "<br>";
echo "<br>";
include ("footfile.html");
echo "</body>";
?>