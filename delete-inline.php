<?php
    $Exit_date = $_GET['Exit_date']; 
    $conn = Mysqli_connect("localhost", "root", "", "parking_project") or die("conection failed!");
    $sql = "DELETE FROM vehicle_info where Exit_date = '{$Exit_date}'";
    $result = mysqli_query($conn, $sql) or die("query Failed");
    header("location: http://localhost/project/index.php");
    mysqli_close($conn);
?>