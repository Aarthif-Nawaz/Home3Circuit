<?php
if(isset($_SESSION['userId'])){
    if($_SESSION['userType']=="Customer"){
        echo "<p style='float:right;width:20%;margin-top:40px;'>" .$_SESSION['fname']." ".$_SESSION['lname']." | "." User ID :  ".$_SESSION['userId']."</p>";
    }
}
?>