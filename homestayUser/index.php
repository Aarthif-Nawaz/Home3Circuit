
<?php
session_start();
include("detectlogin.php");
include ("connection.php"); //include db.php file to connect to DB
$pagename="HomeStay - User"; //create and populate variable called $pagename
echo "<link rel=stylesheet type=text/css href=style/mystylesheet.css>";
echo "<title>".$pagename."</title>";
echo "<body>";
include ("headfile.html");
echo "<h4>".$pagename."</h4>";
echo "<form action='index.php' method='post'>";
echo "<input type='text' name='home' placeholder='Search by HomeStay Name' style='float: left;
padding: 6px;
width:250px;
border: 2px solid black;
margin-top: 8px;
margin-right: 16px;
font-size: 17px;'>";
echo "<p style='margin-top:10px'>Sort By : ";
// This part is to filter by a search option and get the hometstays according to that
echo "<select name='factor' style='margin-left:10px;margin-top:10px;width:150px;height:30px;color:black;background-color:#4CAF50;font-size:18px';>";
echo "<option></option>";
echo "<option>Price</option>";
echo "<option>Culture</option>";
echo "<option>Medical</option>";
echo "<option>Weather</option>";
echo "<option>Rooms</option>";
echo "</select>";
echo "<input type='submit' name='search' value='Search' style='background-color: #4CAF50; /* Green */
float:right;
border: none;
color: black;
padding: 15px 32px;
width:250px;
text-align: center;
text-decoration: none;
display: inline-block;
font-size: 16px;'>";
echo "</form>";
echo "<br>";
echo "<br>";
echo "<br>";
echo "<br>";
// Check if the any of the factors were selected in order for the data to be filtered.. and if it is filtered it will provide the relevent results
if(!empty($_POST['factor'])){
    $factor = $_POST['factor'];
    if($factor != 'Select Option'){
        $factor1 = "homestay".$factor;
        $exeFactor = "SELECT * from homestay ORDER BY $factor1 DESC";
        $exeSQL=mysqli_query($conn, $exeFactor) or die (mysqli_error());
        echo "<table style='border: 0px'>";
        //create an array of records (2 dimensional variable) called $arrayp.
        //populate it with the records retrieved by the SQL query previously executed.
        //Iterate through the array i.e while the end of the array has not been reached, run through it
        while ($arrayp=mysqli_fetch_array($exeSQL))
        {
            echo "<tr>";
            echo "<td style='border: 0px'>";
            //display the small image whose name is contained in the array
            echo "<a style='text-decoration:none;color:black;' href=homeInfo.php?u_prod_id=".$arrayp['homestayId'].">"; 
            echo "<img src=Images/".$arrayp['homestayPic']." height=200 width=200>";
            echo "<p>".$arrayp['homestayName']."</p><br>";
            echo "</a>";
            echo "</td>";
            echo "<td style='border: 0px'>";
            echo "<p><h5> No of Rooms : ".$arrayp['homestayRooms']."</h5>"; //display product name as contained in the array
            echo "<p>".$arrayp['homestayDescription']."</p>";
            echo "<b> Price :  Rs ".$arrayp['homestayPrice']."/- Per Night </b>";
            echo "</td>";
            echo "</tr>";
        }
        echo "</table>";
    }
}
else if(!empty($_POST['home'])){
    $name = $_POST['home'];
    $searchSQL = "SELECT * from homestay where homestayName like '$name%'";
    $exeSQL=mysqli_query($conn, $searchSQL) or die (mysqli_error());
    echo "<table style='border: 0px'>";
    //create an array of records (2 dimensional variable) called $arrayp.
    //populate it with the records retrieved by the SQL query previously executed.
    //Iterate through the array i.e while the end of the array has not been reached, run through it
    while ($arrayp=mysqli_fetch_array($exeSQL))
    {
        echo "<tr>";
        echo "<td style='border: 0px'>";
        //display the small image whose name is contained in the array
        echo "<a style='text-decoration:none;color:black;' href=homeInfo.php?u_prod_id=".$arrayp['homestayId'].">"; 
        echo "<img src=Images/".$arrayp['homestayPic']." height=200 width=200>";
        echo "<p>".$arrayp['homestayName']."</p><br>";
        echo "</a>";
        echo "</td>";
        echo "<td style='border: 0px'>";
        echo "<p><h5> No of Rooms : ".$arrayp['homestayRooms']."</h5>"; //display product name as contained in the array
        echo "<p>".$arrayp['homestayDescription']."</p>";
        echo "<b> Price :  Rs ".$arrayp['homestayPrice']."/- Per Night </b>";
        echo "</td>";
        echo "</tr>";
    }
    echo "</table>";
}
else{
//create a $SQL variable and populate it with a SQL statement that retrieves product details
    $SQL="select * from homestay";
    //run SQL query for connected DB or exit and display error message
    $exeSQL=mysqli_query($conn, $SQL) or die (mysqli_error());
    echo "<table style='border: 0px'>";
    //create an array of records (2 dimensional variable) called $arrayp.
    //populate it with the records retrieved by the SQL query previously executed.
    //Iterate through the array i.e while the end of the array has not been reached, run through it
    while ($arrayp=mysqli_fetch_array($exeSQL))
    {
        echo "<tr>";
        echo "<td style='border: 0px'>";
        //display the small image whose name is contained in the array
        echo "<a style='text-decoration:none;color:black;' href=homeInfo.php?u_prod_id=".$arrayp['homestayId'].">"; 
        echo "<img src=Images/".$arrayp['homestayPic']." height=200 width=200>";
        echo "<p>".$arrayp['homestayName']."</p><br>";
        echo "</a>";
        echo "</td>";
        echo "<td style='border: 0px'>";
        echo "<p><h5> No of Rooms : ".$arrayp['homestayRooms']."</h5>"; //display product name as contained in the array
        echo "<p>".$arrayp['homestayDescription']."</p>";
        echo "<b> Price :  Rs ".$arrayp['homestayPrice']."/- Per Night </b>";
        echo "</td>";
        echo "</tr>";
    }
    echo "</table>";
}
echo "<br>";
echo "<br>";
include ("footfile.html");
echo "</body>";
?>


