<?php

    session_start();

    if(isset($_SESSION["user"])){
        if(($_SESSION["user"])=="" or $_SESSION['usertype']!='a'){
            header("location: ../login.php");
        }

    }else{
        header("location: ../login.php");
    }
    
    
    if($_GET){
        //import database
        include("../connection.php");
        $id=$_GET["id"];
        //$result001= $database->query("select * from schedule where scheduleid=$id;");
        //$email=($result001->fetch_assoc())["docemail"];
        $sql= $database->query("UPDATE appointment SET appostatus = 3 where appoid='$id';");
        //$sql= $database->query("delete from doctor where docemail='$email';");
        //print_r($email);
        // Get the schedule ID of the appointment being accepted
$appointment_id = $_POST['appointment_id']; // or from GET, depending on your setup

// 1. Get schedule_id from this appointment
$get_sched_sql = "SELECT schedule_id FROM appointments WHERE id = $appointment_id";
$sched_result = $database->query($get_sched_sql);
$sched_data = $sched_result->fetch_assoc();
$schedule_id = $sched_data['schedule_id'];

// 2. Count accepted appointments for this schedule
$count_sql = "SELECT COUNT(*) AS accepted_count FROM appointments 
              WHERE schedule_id = $schedule_id AND status = 'accepted'";
$count_result = $database->query($count_sql);
$count_data = $count_result->fetch_assoc();

// 3. Get the maximum allowed (nop) from the schedule
$max_sql = "SELECT nop FROM schedule WHERE id = $schedule_id";
$max_result = $database->query($max_sql);
$max_data = $max_result->fetch_assoc();
$max_nop = $max_data['nop'];

// 4. If accepted bookings >= nop, mark schedule as closed
if ($count_data['accepted_count'] >= $max_nop) {
    $database->query("UPDATE schedule SET status = 'closed' WHERE id = $schedule_id");
}

        header("location: appointment.php");
    }


?>