<?php
session_start();
include("detectlogin.php");
include ("connection.php"); //include db.php file to connect to DB
$pagename="Your Sign Up Results"; //create and populate variable called $pagename
echo "<link rel=stylesheet type=text/css href=style/mystylesheet.css>";
echo "<title>".$pagename."</title>";
echo "<body>";
include ("headfile.html");
echo "<h4>".$pagename."</h4>";
$fname = $_POST['fname'];
$lname = $_POST['lname'];
$address = $_POST['address'];
$postCode = $_POST['postCode'];
$telNo = $_POST['tel'];
$email = $_POST['email'];
$pass = $_POST['pass'];
$Confirm = $_POST['cpass'];
if(!empty($fname) && !empty($lname) && !empty($address) && !empty($postCode) && !empty($telNo) && !empty($email) && !empty($pass)){
    if($pass!=$Confirm){
        echo 'Passwords do not match !';
        echo "<p>Go Back to Sign Up Page : </p><a href='signup.php'>Sign Up</a>";
    }
    else{
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo "Invalid email format ! <br>";
            echo "<p>Go Back to Sign Up Page : </p><a href='signup.php'>Sign Up</a>";
        }
        else{
            $insertSQL = "INSERT INTO Users(userType, userFname, userSname, userAddress, userPostCode, userTelNo, userEmail, userPassword) VALUES (1,'$fname','$lname','$address','$postCode','$telNo','$email','$pass')";
            $exeSQL = mysqli_query($conn, $insertSQL);
            
            if(mysqli_errno($conn)==0){
                echo "Your Registration was Successful ! <br>";
                echo "Continue to Login<a href='login.php'>Login</a>";
            }
            else{
                echo "Sign Up Failed ! <br>";
                if(mysqli_errno($conn)==1062){
                    echo $email;
                    echo 'Email already exists !<br>';
                    echo "<p>Go Back to Sign Up Page : </p><a href='signup.php'>Sign Up</a>";
                }
                elseif(mysqli_errno($conn)==1064){
                    echo 'Invalid Characters entered !<br>';
                    echo "<p>Go Back to Sign Up Page : </p><a href='signup.php'>Sign Up</a>";
                }
            }
        }
    }
}
else{
    echo "Fill in all fields to sign up !<br>";
    echo "<p>Go Back to Sign Up Page : </p><a href='signup.php'>Sign Up</a>";
}
echo "<br>";
echo "<br>";
include ("footfile.html");
echo "</body>";
?>