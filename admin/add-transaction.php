<?php

    session_start();

    if(isset($_SESSION["user"])){
        if(($_SESSION["user"])=="" or $_SESSION['usertype']!='a'){
            header("location: ../login.php");
        }

    }else{
        header("location: ../login.php");
    }
    
    
    if($_POST){
        //import database
        include("../connection.php");
        
        $name=$_POST["name"];
       
        $quantity=$_POST["quantity"];
        $date=$_POST["scheduledate"];
        $expdate=$_POST["expdate"];
        $medicinename=$_POST["medicinename"];
        
        $sql="insert into transaction (name,quantity,scheduledate,expdate,medicinename) values ('$name','$quantity','$date','$expdate','$medicinename');";
        
        if ($database->query($sql) === TRUE) {
            // Deduct the quantity from inventory
            $update_inventory = "UPDATE inventory SET quantity = quantity - $quantity WHERE name = '$medicinename'";
            $update_history = "UPDATE history SET quantity = quantity - $quantity WHERE name = '$medicinename' AND expdate = '$expdate'";
    
            if ($database->query($update_inventory) === TRUE && $database->query($update_history) === TRUE) {
                header("location: transaction.php?action=transaction-added");
            } else {
                echo "Error updating inventory: " . $database->error;
            }
        } else {
            echo "Error inserting transaction: " . $database->error;
        }
        
    }


?>