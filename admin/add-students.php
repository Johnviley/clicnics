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
        $dentalid=$_POST["dentalid"];
        $name=$_POST["name"];
        $course=$_POST["course"];
        $telephone=$_POST["telephone"];
        $date=$_POST["date"];
        $sql="insert into dentaleducation (dentalid,name,course,telephone,date) values ('$dentalid','$name','$course','$telephone','$date');";
        $result= $database->query($sql);
        header("location: dental-education.php?action=item-added&title=$title");
        
    }


?>