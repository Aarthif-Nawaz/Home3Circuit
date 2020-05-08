<?php
session_start();
include("detectlogin.php");
include ("connection.php"); //include db.php file to connect to DB
$pagename="Ordering Basket"; //create and populate variable called $pagename
echo "<link rel=stylesheet type=text/css href=style/mystylesheet.css>";
echo "<title>".$pagename."</title>";
$total = 0;
if (empty($_POST['h_prodid']) && empty($_POST['quantity'])) {
    echo"<p> Existing basket </p>";
} else { 
    $newprodid = $_POST['h_prodid'];
    $reqQuantity = $_POST['quantity'];    $_SESSION['basket'][$newprodid] = [$reqQuantity,$Arrival,$depart,$no];
}
echo "<body>";
include ("headfile.html");
echo "<h4>".$pagename."</h4>";
//create a $SQL variable and populate it with a SQL statement that retrieves product details
echo "<table border='4'>";
echo"<tr>";
echo "<th> Product Name </th>";
echo "<th> Price  </th>";
echo "<th> Quantity </th>";
echo "<th> Subtotal </th>";
echo"</tr>";


if(isset($_SESSION['basket'])){
    
    foreach ($_SESSION['basket'] as $newprodid=>$values){
        $prodSQL="select * from Product where prodId=".$newprodid;
    //execute SQL query
        $exeprodSQL=mysqli_query($conn, $prodSQL) or die (mysqli_error());
    //create array of records & populate it with result of the execution of the SQL query
        $thearrayprod=mysqli_fetch_array($exeprodSQL);
        echo "<tr>";
        echo "<td>".$thearrayprod['prodName']."</td>";
        echo "<td>".$thearrayprod['prodPrice']."</td>";
        echo "<td>".$values."</td>";
        echo "<td>".$values*$thearrayprod['prodPrice']."</td>";
        echo "<form action='basket.php' method='post'>";
        echo "<td><input type='submit' value='Remove'></td>";
        echo "<input type='hidden' name='delID' value=".$newprodid.">";
        echo "</form>";
        echo "</tr>";
        $total += $values*$thearrayprod['prodPrice'];
       
  }

}
else{
    echo "<p><i>Your basket is empty</i></p>";
}
if(isset($_POST["delID"])){
    $delprodid=$_POST["delID"];
    unset($_SESSION['basket'][$delprodid]);
}
echo "<tr>";
echo "<td colspan='3'> Total </td>";
echo "<td> $".$total."</td>";
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
font-size: 18px;'><a href='clear.php' style='text-decoration:none;color:white;' > <p>Clear Basket </p></a></button>";
echo "<br>";
echo "<br>";
echo "<p>New Worked Up Customers</p><a href='register.php'> Register </a>";
echo "<br>";
echo "<p>Registered Worked Up Members </p><a href='login.php'> Login </a>";
echo "<br>";
echo "<br>";
if(isset($_SESSION['userId'])){
    echo "<p> TO Finalize Your Orders <a href='checkout.php'> Checkout </p>";
}
include ("footfile.html");
echo "</body>";
?>