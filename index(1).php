<?php
session_start();
    ?>
    <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Car Parking</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="css/style.css">
    <script>
        setInterval(() => {
            $.ajax({
                url:'check.php',
                method:'POST',
                data:{
                },
                datatype:"text",
                success:function(data){
                        console.log(data);
                }
            });  
        }, 500);
        </script>
</head>
<body>
    <div class="header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12 text-center" id="header">
                   <h1> Parking Lot Management System</h1>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-md-6 text-center mb-3">
                    <h2 class="register">Registration</h2>
                    <form action="save.php" method="post">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="owner">Vehicle Owner Name:</span>
                        </div>
                        <input type="text" name="owner_name" class="form-control">
                    </div>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text"> Vehicle Name:</span>
                        </div>
                        <input type="text" name="vehicle_name" class="form-control">
                    </div>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text"> Vehicle Number:</span>
                        </div>
                        <input type="text" name="vehicle_number" class="form-control">
                    </div>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text"> Entry Date:</span>
                        </div>
                        <input type="datetime-local" name="entry_date" class="form-control">
                    </div>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text"> Exit Date:</span>
                        </div>
                        <input type="datetime-local" name="exit_date" class="form-control">
                    </div>
                   <input type="submit" class="btn btn-primary my-3">
                   </form>
                </div>
                <div class="col-md-6">                                 
                    <?php 
                     $conn = Mysqli_connect("localhost", "root", "", "parking_project") or die("conection failed!");
                     $sql = "SELECT * FROM Vehicle_info";
                     $result = mysqli_query($conn, $sql) or die("query Failed");
                     $num = mysqli_num_rows($result);
                     echo $num;
                    ?>
                    <div id="car">
                        <h2>Parking Space Information :</h2>
                        <h3>Total space :- <span> 50</span> </h3>
                        <?php
                            if($num != 50){
                                ?>
                                <h3>Parking Booked space :- <span><?php echo $num ?> </span> </h3>
                                <h3>Total Available space :- <span> <?php echo (50-$num) ?></span> </h3>
                                <?php
                            }else{                    
                                echo "<h3>Sorry for that No paking Space avialeble</h3>";
                            }
                        ?>
                    </div>
                     
                </div>
            </div>
        </div> 
             
    </div>
    <section>
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center">
                    <h2 class="register1">All Vehicle Entry Records</h2>
                </div>
            </div>
            <div class="row">
               <div class="col-md-12">
                   <div class="input-group">
                       <div class="input-group-prepend">
                           <span class="input-group-text" >Search</span>
                       </div>
                        <input type="text" class="form-control" onkeyup="search()" id="text" placeholder="Enter vehicle name">
                   </div>
                   
                <table class="table table-striped" id="table" >
                    <?php
                        if($num>0){
                        ?>
                            <thead>
                        <tr>
                            <th>Owner Name</th>
                            <th>Vehicle Name</th>
                            <th>Vehicle Number</th>
                            <th>Entry Date</th>
                            <th>Exit Date</th>
                            <th>Delete Record</th>
                        </tr>
                    </thead>
                    <?php
                    while($row = mysqli_fetch_assoc($result)){
                    ?>
                   
                    <tbody>                      
                        <tr>
                            <td><?php echo $row['Owner_name']; ?></td>
                            <td> <?php echo $row['Vehicle_name']; ?> </td>
                            <td><?php echo $row['Vehicle_number']; ?></td>
                            <td> <?php echo $row['Entry_date']; ?></td>
                            <td><?php echo $row['Exit_date']; ?></td>
                            <td><a href="delete-inline.php?Exit_date=<?php echo $row['Exit_date']?>">Delete</a></td>
                        </tr>  
                    </tbody>
                    <?php
                    }
                    ?>
                </table> 
                <?php
                }else{
                    echo "No Data found!";
                }
                    ?>         
               </div>
            </div>
        </div>
    </section>
    <script>    
        const search = () =>{
            var input_value = document.getElementById("text").value.toUpperCase();
            var table = document.getElementById("table");
            var tr = table.getElementsByTagName("tr");
            for(var i =0; i<tr.length; i++){
               td = tr[i].getElementsByTagName("td")[0];
               if(td){
                 var text_value = td.textContent;
                 if(text_value.toUpperCase().indexOf(input_value)>-1){
                    tr[i].style.display = "";
                 }else{
                    tr[i].style.display= "none";
                 }
               }
            }
        }   
    </script>
</body>
</html>
