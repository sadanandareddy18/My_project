S<?php
session_start();
 $con = mysqli_connect("localhost", "root", "", "parking_project") or die("conection failed!");

 $items = mysqli_query($con,"SELECT * FROM `vehicle_info`");
 while($row = mysqli_fetch_assoc($items)){
    if($row['Exit_date']){
        $tt=date("h:i:sa");
        echo($tt);
        $a = $row['Exit_date'];
        $t = $a[-1]+$a[-2]+$a[-4]+$a[-5];
        echo($t);
    }
    
    }
     
 ?>
