<?php
session_start();
include ("detectlogin.php");
include ("connection.php"); //include db.php file to connect to DB
$pagename="Your Financial Forecast"; //create and populate variable called $pagename
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
    
    echo "<form action='financial.php' method='post'>";
    echo "<p style='margin-top:10px'> HomeStay's: ";
    echo "<select name='homestay' style='margin-left:10px;margin-top:10px;width:150px;height:30px;color:black;background-color:#4CAF50;font-size:18px';>";
    echo "<option></option>";
    while($arrayp=mysqli_fetch_array($exeSQL)){
        echo "<option>".$arrayp['homestayName']."</option>";
    }
    echo "</select>";
    echo "<select name='month' style='margin-left:10px;margin-top:10px;width:150px;height:30px;color:black;background-color:#4CAF50;font-size:18px';>";
    echo "<option></option>";
    while($count <= 12){
        echo "<option>".$count."</option>";
        $count +=1;
    }
    echo "</select>";
    echo "<input type='submit' name='search' value='Forecast' style='background-color: #4CAF50; /* Green */
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

    if(!empty($_POST['homestay']) && !empty($_POST['month'])){
        $count = 0;
        $email = $_SESSION['userEmail'];
        $SQL="select * from homestay where emailAddress='$email'";
        $exeSQL=mysqli_query($conn, $SQL) or die (mysqli_error());
        $arrayp=mysqli_fetch_array($exeSQL);
        $name = $_POST['homestay'];
        $month = $_POST['month'];
        
        $SQL1="select * from homestay where homestayName='$name'";
        $exeSQL1=mysqli_query($conn, $SQL1) or die (mysqli_error());
        $arrayp1=mysqli_fetch_array($exeSQL1);
        $id = $arrayp1['homestayId'];
        
        try{
            $SQL2 = "SELECT * from booking_line where homestayId=$id";
            $exeSQL2=mysqli_query($conn, $SQL2) or die (mysqli_error());
            while($arrayp2=mysqli_fetch_array($exeSQL2)){
                $count +=1;
                
            }
            $visit = "false";
            if($count > 10){
                $totalDays = 0;
                $fcsv   = file('Forecasting.csv');
                foreach ($fcsv as $key => $value) {
                    $temp = explode(',', $value);
                    $name = str_replace(' ', '', $name);
                    if ($temp[0] == $name) {
                        $command = escapeshellcmd("python FinancialForecasting.py $name $month");
                        $output = shell_exec($command);
                        include('linegraph.html');
                        $visit = "true";
                        break;
                    }
                }
                if($visit=="false"){
                    $SQL3 = "SELECT * from booking_line where homestayId=$id";
                    $exeSQL3=mysqli_query($conn, $SQL3) or die (mysqli_error());
                    $dates = array();
                    while($arrayp3=mysqli_fetch_array($exeSQL3)){
                        array_push($dates,$arrayp3['DepartureDate']);
                    }
                    $j=1;
                    for ($i=0; $i < count($dates); $i++) {
                        $date1 = strtotime($dates[$i]);
                        if($j== count($dates)){
                            $j = count($dates)-1;
                            $date2 = strtotime($dates[$j]);
                        }
                        $date2 = strtotime($dates[$j]);
                        $diff = ($date2 - $date1)/60/60/24;
                        $totalDays += $diff;
                        $j +=1;
                        
                    }
                    if($totalDays > 60){
                        $fs = fopen("Forecasting.csv","a");
                        $SQL4 = "SELECT * from booking_line where homestayId=$id";
                        $exeSQL4=mysqli_query($conn, $SQL4) or die (mysqli_error());
                        while($arrayp4=mysqli_fetch_array($exeSQL4)){
                            $name = str_replace(' ', '', $name);
                            $books = rand(2,6);
                            fputcsv($fs, array($name,$arrayp4['DepartureDate'],$arrayp4['subTotal'],$books));
                        }
                        fclose($fs);
                        $command = escapeshellcmd("python FinancialForecasting.py $name $month");
                        $output = shell_exec($command);
                        include('linegraph.html');
    
                    }
                    else{
                        echo "Not Enough Bookings To Forecast Finance";
                    }

                }    
               
            }
        }catch(Exception $ex){
            echo "";
        }
        
    }
    else{
        echo "Not Chosen any data in order to be forecasted";
    }
        
}
else{
    echo "Please Login to View Your Financial Forecasts";
}

echo "<br>";
echo "<br>";
include ("footfile.html");
echo "</body>";
?>