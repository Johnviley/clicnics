<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/animations.css">
    <link rel="stylesheet" href="../css/main.css">
    <link rel="stylesheet" href="../css/admin.css">

    <title>Inventory</title>
    <style>
        .popup {
            animation: transitionIn-Y-bottom 0.5s;
        }

        .sub-table {
            animation: transitionIn-Y-bottom 0.5s;
        }
    </style>
</head>

<body>
    <?php

    //learn from w3schools.com

    session_start();

    if (isset($_SESSION["user"])) {
        if (($_SESSION["user"]) == "" or $_SESSION['usertype'] != 'a') {
            header("location: ../login.php");
        }
    } else {
        header("location: ../login.php");
    }



    //import database
    include("../connection.php");


    ?>
    <div class="container">
        <div class="menu">
            <table class="menu-container" border="0">
                <tr>
                    <td style="padding:10px" colspan="2">
                        <table border="0" class="profile-container">
                            <tr>
                                <td width="30%" style="padding-left:20px">
                                    <img src="../img/user.png" alt="" width="100%" style="border-radius:50%">
                                </td>
                                <td style="padding:0px;margin:0px;">
                                    <p class="profile-title">Administrator</p>
                                    <p class="profile-subtitle">bisuclinic@gmail.com</p>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <a href="../logout.php"><input type="button" value="Log out" class="logout-btn btn-primary-soft btn"></a>
                                </td>
                            </tr>
                        </table>
                    </td>

                </tr>
                <tr class="menu-row">
                    <td class="menu-btn menu-icon-">
                        <a href="index.php" class="non-style-link-menu">
                            <div>
                                <p class="menu-text">Dashboard</p>
                        </a>
        </div></a>
        </td>
        </tr>
        <tr class="menu-row">
            <td class="menu-btn menu-icon- ">
                <a href="doctors.php" class="non-style-link-menu ">
                    <div>
                        <p class="menu-text">Doctors</p>
                </a>
    </div>
    </td>
    </tr>
    <tr class="menu-row">
        <td class="menu-btn menu-icon- menu-active menu-icon-">
            <a href="schedule.php" class="non-style-link-menu non-style-link-menu">
                <div>
                    <p class="menu-text">Schedule</p>
                </div>
            </a>
        </td>
    </tr>
    <tr class="menu-row">
        <td class="menu-btn menu-icon-">
            <a href="appointment.php" class="non-style-link-menu">
                <div>
                    <p class="menu-text">Appointment</p>
            </a></div>
        </td>
    <tr class="menu-row">
        <td class="menu-btn menu-icon--active">
            <a href="inventory.php" class="non-style-link-menu-active">
                <div>
                    <p class="menu-text">Inventory</p>
            </a></div>
        </td>
    </tr>
    <tr class="menu-row">
        <td class="menu-btn menu-icon-">
            <a href="transaction.php" class="non-style-link-menu">
                <div>
                    <p class="menu-text">Transaction</p>
            </a></div>
        </td>
    </tr>
    <tr class="menu-row">
        <td class="menu-btn menu-icon-">
            <a href="dental-education.php" class="non-style-link-menu">
                <div>
                    <p class="menu-text">Dental Education</p>
            </a></div>
        </td>
    </tr>
    <tr class="menu-row">
        <td class="menu-btn menu-icon-">
            <a href="patient.php" class="non-style-link-menu">
                <div>
                    <p class="menu-text">Patients</p>
            </a></div>
        </td>
    </tr>

    </table>
    </div>
    <div class="dash-body">
        <table border="0" width="100%" style=" border-spacing: 0;margin:0;padding:0;margin-top:25px; ">
            <tr>
                <td width="13%">
                    <a href="inventory.php"><button class="login-btn btn-primary-soft btn btn-icon-back" style="padding-top:11px;padding-bottom:11px;margin-left:20px;width:125px">
                            <font class="tn-in-text">Back</font>
                        </button></a>
                </td>
                <td>
                    <p style="font-size: 23px;padding-left:12px;font-weight: 600;">Inventory</p>

                </td>
                <td width="15%">
                    <p style="font-size: 14px;color: rgb(119, 119, 119);padding: 0;margin: 0;text-align: right;">
                        Today's Date
                    </p>
                    <p class="heading-sub12" style="padding: 0;margin: 0;">
                        <?php

                        date_default_timezone_set('Asia/Kolkata');

                        $today = date('Y-m-d');
                        echo $today;

                        $list110 = $database->query("select  * from  inventory;");

                        ?>
                    </p>
                </td>
                <td width="10%">
                    <button class="btn-label" style="display: flex;justify-content: center;align-items: center;"><img src="../img/calendar.svg" width="100%"></button>
                </td>


            </tr>

            <tr>
                <td colspan="2">
                    <div style="display: flex;margin-top: 40px;">
                        <div class="heading-main12" style="margin-left: 45px;font-size:20px;color:rgb(49, 49, 49);margin-top: 5px;">Inventory</div>
                        <a href="?action=add-item&id=none&error=0" class="non-style-link"><button class="login-btn btn-primary btn button-icon" style="margin-left:25px;background-image: url('../img/icons/add.svg');">Add an Item</font></button>
                        </a>
                <td colspan="2">
                    <a href="?action=report" class="non-style-link">
                        <button class="login-btn btn-primary btn button-icons" style="display: flex;justify-content: center;align-items: center;margin-left:120px;">Reports</button>
                    </a>
                </td>
    </div>
    </td>
    </tr>
    <tr>
        <td colspan="4" style="padding-top:10px;width: 100%;">

            <p class="heading-main12" style="margin-left: 45px;font-size:18px;color:rgb(49, 49, 49)">All Items</p>
        </td>

    </tr>
    <tr>
        <td colspan="4" style="padding-top:0px;width: 100%;">
            <center>
                <table class="filter-container" border="0">
                    <tr>
                        <td width="10%">

                        </td>
                        <td width="5%" style="text-align: center;">
                            Date:
                        </td>
                        <td width="30%">
                            <form action="" method="post">

                                <input type="date" name="scheduledate" id="date" class="input-text filter-container-items" style="margin: 0;width: 95%;">

                        </td>
                        <td width="5%" style="text-align: center;">
                        Item Name:
                        </td>
                        <td width="30%">
                            
                        <input type="search" name="name" class="input-text header-searchbar" placeholder="Search Item Name" list="students" style="width:90%; height: 37px; margin: 0;">

                        <datalist id="medicine">
                            <?php 
                                $list11 = $database->query("SELECT * FROM inventory;");

                                for ($y = 0; $y < $list11->num_rows; $y++) {
                                    $row00 = $list11->fetch_assoc();
                                    $sn = $row00["name"];
                                    $id00 = $row00["invid"];
                                   
                                }
                            ?>
                        </datalist>
                    </td>
                    <td width="12%">
                        <input type="submit"  name="filter" value="Search" class=" btn-primary-soft btn button-icon btn-filter"  style="padding: 15px; margin :0;width:100%">
                        </form>
                    </td>

                    </tr>
                            </table>

                        </center>
                    </td>
                    
                </tr>
                

    <?php
    if ($_POST) {
        //print_r($_POST);
        $sqlpt1 = "";
        if (!empty($_POST["date"])) {
            $date = $_POST["date"];
            $sqlpt1 = "inventory.date='$date' ";
        }


        $sqlpt2="";
        if(!empty($_POST["name"])){
        $name=$_POST["name"];
        $sqlpt2 = "inventory.name LIKE '%$name%'";
        }
        //echo $sqlpt2;
        //echo $sqlpt1;
        $sqlmain = "select inventory.invid,inventory.name,inventory.category,inventory.expdate,inventory.date,inventory.quantity from inventory";
        $sqllist = array($sqlpt1, $sqlpt2);
        $sqlkeywords = array(" where ", " and ");
        $key2 = 0;
        foreach ($sqllist as $key) {

            if (!empty($key)) {
                $sqlmain .= $sqlkeywords[$key2] . $key;
                $key2++;
            };
        };
        //echo $sqlmain;



        //
    } else {
        $sqlmain = "select inventory.invid,inventory.name,inventory.category,inventory.expdate,inventory.date,inventory.quantity from inventory order by inventory.date desc";
    }



    ?>

    <tr>
        <td colspan="4">
            <center>
                <div class="abc scroll">
                    <table width="93%" class="sub-table scrolldown" border="0">
                        <thead>
                            <tr>
                                <th class="table-headin">
                                    Item Name

                                </th>

                                <th class="table-headin">
                                    Quantity
                                </th>
                                <th class="table-headin">
                                    Category
                                
                                </th>
                                <th class="table-headin">
                                    Date Expiration

                                </th>
                                <th class="table-headin">
                                    Date Received

                                </th>

                                <th class="table-headin">

                                    Events

                            </tr>
                        </thead>
                        <tbody class="data">

                            <?php

                        
                            $result = $database->query($sqlmain);

                            if ($result->num_rows == 0) {
                                echo '<tr>
                                    <td colspan="4">
                                    <br><br><br><br>
                                    <center>
                                    <img src="../img/notfound.png" width="25%">
                                    
                                    <br>
                                    <p class="heading-main12" style="margin-left: 45px;font-size:20px;color:rgb(49, 49, 49)">We  couldnt find anything related to your keywords !</p>
                                    <a class="non-style-link" href="inventory.php"><button  class="login-btn btn-primary-soft btn"  style="display: flex;justify-content: center;align-items: center;margin-left:20px;">&nbsp; Show all Sessions &nbsp;</font></button>
                                    </a>
                                    </center>
                                    <br><br><br><br>
                                    </td>
                                    </tr>';
                            } else {
                                for ($x = 0; $x < $result->num_rows; $x++) {
                                    $row = $result->fetch_assoc();
                                    $invid = $row["invid"];
                                    $name = $row["name"];
                                    $quantity = $row["quantity"];
                                    $category = $row["category"];

                                    $sqlmainexpdate = "SELECT expdate FROM history WHERE name='$name';";
                                    $expdateResult = $database->query($sqlmainexpdate);
                                    $expdateList = [];

                                    if ($expdateResult->num_rows > 0) {
                                        while ($rowexpdate = $expdateResult->fetch_assoc()) {
                                            $expdateFormatted = date("F j, Y", strtotime($rowexpdate["expdate"]));
                                            $expdateList[] = $expdateFormatted;
                                        }
                                        $expdateDisplay = implode("/", $expdateList);
                                    } else {
                                        $expdateDisplay = "No Expiry Date";
                                    }
                                    $date = $row["date"];

                                    echo '<tr>
                                        <td style="text-align:center;"> &nbsp;' .
                                        substr($name, 0, 30)
                                        . '</td>
                                        <td style="text-align:center;">
                                            ' . $quantity . '
                                        </td>
                                        <td style="text-align:center;">
                                        ' . substr($category, 0, 20) . '
                                        </td>
                                        <td style="text-align:center;">
                                        ' . $expdateDisplay . '
                                        </td>

                                        <td style="text-align:center;">
                                            ' . substr($date, 0, 10) . ' 
                                        </td>
                                        

                                        <td>
                                        <div style="display:flex;justify-content: center;">
                                        
                                        <a href="?action=edit&id=' . $invid . '&name=' . $name . '" class="non-style-link badge badge-solid-red">Add</button></a>
                                        &nbsp;&nbsp;&nbsp;
                                        <a href="?action=history&id=' . $invid . '&name=' . $name . '" class="non-style-link badge badge-solid-red">Record</button></a>
                                        &nbsp;&nbsp;&nbsp;
                                        <a href="?action=view&id=' . $invid . '&name=' . $name . '" class="non-style-link badge badge-solid-red">View</button></a>
                                       &nbsp;&nbsp;&nbsp;
                                       <a href="?action=drop&id=' . $invid . '&name=' . $name . '" class="non-style-link badge badge-solid-red">Remove</button></a>
                                        </div>
                                        </td>
                                    </tr>';
                                }
                            }

                            ?>

                        </tbody>

                    </table>
                </div>
            </center>
        </td>
    </tr>



    </table>
    </div>
    </div>
    <?php

    if ($_GET) {
        $id = $_GET["id"];
        $action = $_GET["action"];
        if ($action == 'add-item') {

            echo '
            <div id="popup1" class="overlay">
                    <div class="popup">
                    <center>
                    
                    
                        <a class="close" href="inventory.php">&times;</a> 
                        <div style="display: flex;justify-content: center;">
                        <div class="abc">
                        <table width="100%" class="sub-table scrolldown add-doc-form-container" border="0">
                        <tr>
                                <td class="label-td" colspan="2">' .
                ""

                . '</td>
                            </tr>

                            <tr>
                                <td>
                                    <p style="padding: 0;margin: 0;text-align: left;font-size: 25px;font-weight: 500;">Add Item.</p><br>
                                </td>
                            </tr>
                            
                                
                                <form action="add-item.php" method="POST" class="add-new-form">
                                <tr>
                                <td class="label-td">
                                    <label for="name" class="form-label">Item Name : </label>
                                    <input type="text" name="name" class="input-text" placeholder="Name of the Item" required><br>
                                </td>
                                <td class="label-td">
                                    <label for="quantity" class="form-label">Quantity: </label>
                                    <input type="number" name="quantity" class="input-text" placeholder="" required><br>
                                </td>
                            </tr>
                            
                            <tr>
                                <td class="label-td">
                                    <label for="category" class="form-label">Category : </label>
                                    <select name="category" class="input-text" required>
                                        <option value="">Select Category</option>
                                        <option value="Medicine">Medicine</option>
                                        <option value="Equipment">Equipment</option>
                                        <option value="Others">Others</option>
                                    </select><br>
                                </td>
                                <td class="label-td">
                                    <label for="date" class="form-label">Date Received: </label>
                                    <input type="date" name="date" class="input-text" required><br>
                                </td>
                            </tr>
                            
                            <tr>
                                <td class="label-td">
                                <label for="expdate" class="form-label">Date Expiration: </label>
                                <input type="date" name="expdate" class="input-text" required><br>
                                </td>
                            </tr>
                            
                            
                                <td class="label-td" colspan="2">
                                    
                                </td>
                            </tr>
                            <tr>
                               
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                   
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                   
                                </td>
                            </tr>
                           
                            <tr>
                                <td colspan="2">
                                    <input type="reset" value="Cancel" class="login-btn btn-primary-soft btn" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                
                                    <input type="submit" value="Add" class="login-btn btn-primary btn" name="shedulesubmit">
                                </td>
                
                            </tr>
                           
                            </form>
                            </tr>
                        </table>
                        </div>
                        </div>
                    </center>
                    <br><br>
            </div>
            </div>
            ';
        } elseif ($action == 'drop') {
            $nameget = $_GET["name"];
            echo '
            <div id="popup1" class="overlay">
                    <div class="popup">
                    <center>
                        <h2>Are you sure?</h2>
                        <a class="close" href="inventory.php">&times;</a>
                        <div class="content">
                            You want to delete this record<br>(' . substr($nameget, 0, 40) . ').
                            
                        </div>
                        <div style="display: flex;justify-content: center;">
                        <a href="delete-item.php?id=' . $id . '" class="non-style-link"><button  class="btn-primary btn"  style="display: flex;justify-content: center;align-items: center;margin:10px;padding:10px;"<font class="tn-in-text">&nbsp;Yes&nbsp;</font></button></a>&nbsp;&nbsp;&nbsp;
                        <a href="inventory.php" class="non-style-link"><button  class="btn-primary btn"  style="display: flex;justify-content: center;align-items: center;margin:10px;padding:10px;"><font class="tn-in-text">&nbsp;&nbsp;No&nbsp;&nbsp;</font></button></a>

                        </div>
                    </center>
            </div>
            </div>
            ';
        } elseif ($action == 'edit') {
            $sqlmain = "select inventory.invid,inventory.name,inventory.category,inventory.expdate,inventory.date,inventory.quantity from inventory";
            $result = $database->query($sqlmain);
            $row = $result->fetch_assoc();
            $invid = $row["invid"];
            $name = $_GET["name"];
            $quantity = $row["quantity"];
            $category = $row["category"];
            $expdate = $row["expdate"];
            $date = $row["date"];

        
            echo '
            <div id="popup1" class="overlay">
                    <div class="popup" style="width: 70%;">
                    <center>
                        <h2></h2>
                        <a class="close" href="inventory.php">&times;</a> 
                                <div style="display: flex;justify-content: center;">
                                <div class="abc">
                                <table width="80%" class="sub-table scrolldown add-doc-form-container" border="0">
                                <tr>
                                        <td class="label-td" colspan="2">' .
                $errorlist[$error_1]
                . '</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <p style="padding: 0;margin: 0;text-align: left;font-size: 25px;font-weight: 500;">Add Amount.</p>
                                        
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="label-td" colspan="2">
                                            <form action="edit-item.php" method="POST" class="add-new-form">
                                            
                                            <input type="hidden" value="' . $id . '" name="id00">
                                            <input type="hidden" name="oldemail" value="' . $email . '" >
                                        </td>
                                    </tr>
                                    
                                    <tr>
                                        
                                        <td class="label-td" colspan="2">
                                            <label for="name" class="form-label">Name: </label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="label-td" colspan="2">
                                            <input type="name" name="name" class="input-text" placeholder="name" value="' . $name . '" readonly><br>
                                        </td>
                                        
                                    </tr>   
                                    
                                    <tr>
                                        <td class="label-td" colspan="2">
                                            <label for="nic" class="form-label">Quantity: </label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="label-td" colspan="2">
                                            <input type="text" name="quantity" class="input-text" placeholder="Quantity" value="" required><br>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="label-td" colspan="2">
                                            <label for="category" class="form-label">Category: </label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="label-td" colspan="2">
                                            <input type="category" name="category" class="input-text" placeholder="category" value="' . $category . '" required><br>
                                        </td>
                                    </tr>
                                    <tr>
                                    <td class="label-td" colspan="">
                                    
                                    <label for="expdate" class="form-label">Date Expiration: </label>
                                     <input type="date" name="expdate" class="input-text" min="' . date('Y-m-d') . '" required><br>
                                </td>
                                    </tr>
                                    
                                    
                           
                           
                           
                                <td class="label-td" colspan="">
                                    
                                    <label for="date" class="form-label">Date Received: </label>
                                     <input type="date" name="date" class="input-text" min="' . date('Y-m-d') . '" required><br>
                                </td>
                        
                              
                            
                                <td class="label-td" colspan="2">
                                    
                                </td>
                            </tr>
                                        
                                    
                        
                                    <tr>
                                        <td colspan="2">
                                            <input type="reset" value="Reset" class="login-btn btn-primary-soft btn" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        
                                            <input type="submit" value="Save" class="login-btn btn-primary btn">
                                        </td>
                        
                                    </tr>
                                
                                    </form>
                                    </tr>
                                </table>
                                </div>
                                </div>
                    </center>
                    <br><br>
            </div>
            </div>
            ';
        }elseif ($action == 'history') {
            $name = $_GET["name"];
        
            // Fetch inventory data by item name
            $sqlmain = "select inventory.invid,inventory.name,inventory.category,inventory.expdate,inventory.date,inventory.quantity from inventory";
            $result = $database->query($sqlmain);
            $row = $result->fetch_assoc();
        
            if ($row) {
                $invid = $row["invid"];
                $quantity = $row["quantity"];
                $category = $row["category"];
                $expdate = $row["expdate"];
                $date = $row["date"];
            }
        
            // Fetch history of this item
            $sqlmain12 = "SELECT * FROM record WHERE name = '$name'";
            $result12 = $database->query($sqlmain12);
    
            echo '
            <div id="popup1" class="overlay">
                <div class="popup" style="width: 70%;">
                <center>
                    <h2>Item Record</h2>
                    <a class="close" href="inventory.php">&times;</a>
                    <div class="content">
                    </div>
                    <div class="abc scroll" style="display: flex;justify-content: center;">
                    <table width="80%" class="sub-table scrolldown add-doc-form-container" border="0">
                        <tr>
                            <td>
                                <p style="padding: 0;margin: 0;text-align: left;font-size: 25px;font-weight: 500;">Records of '.$name.'</p><br><br>
                            </td>
                        </tr>
                        <tr>
                        <td colspan="4">
                            <center>
                            <div class="abc scroll">
                            <table width="100%" class="sub-table scrolldown" border="0">
                            <thead>
                            <tr>   
                                <th class="table-headin">Item Name</th>
                                <th class="table-headin">Quantity</th>
                                <th class="table-headin">Category</th>
                                <th class="table-headin">Expiration Date</th>
                                <th class="table-headin">Date Received</th>
                            </tr>
                            </thead>
                            <tbody>';
                            
            // Loop through history records
            while ($recordRow = $result12->fetch_assoc()) {
                $formattedExpDate = date("F j, Y", strtotime($recordRow["expdate"]));
                echo '<tr>
                        <td style="text-align: center;">'.$recordRow["name"].'</td>
                        <td style="text-align: center;">'.$recordRow["quantity"].'</td>
                        <td style="text-align: center;">'.$recordRow["category"].'</td>
                        <td style="text-align: center;">'.$formattedExpDate.'</td>
                        <td style="text-align: center;">'.$recordRow["date"].'</td>
                    </tr>';

            }
        
            echo '
                            </tbody>
                            </table>
                            </div>
                            </center>
                        </td>
                        </tr>
                    </table>
                    </div>
                </center>
                </div>
            </div>';
        } elseif ($action == 'view') {
            $sqlmain = "select inventory.invid,inventory.name,inventory.category,inventory.expdate,inventory.date,inventory.quantity from inventory";
            $result = $database->query($sqlmain);
            $row = $result->fetch_assoc();
            $invid = $row["invid"];
            $name = $_GET["name"];
            $quantity = $row["quantity"];
            $category = $row["category"];
            $expdate = $row["expdate"];
            $date = $row["date"];


            $sqlmain12 = "select * from history where history.name='$name';";
            $result12 = $database->query($sqlmain12);
            echo '
            <div id="popup1" class="overlay">
                    <div class="popup" style="width: 70%;">
                    <center>
                        <h2></h2>
                        <a class="close" href="inventory.php">&times;</a>
                        <div class="content">
                            
                            
                        </div>
                        <div class="abc scroll" style="display: flex;justify-content: center;">
                        <table width="80%" class="sub-table scrolldown add-doc-form-container" border="0">
                        
                            <tr>
                                <td>
                                    <p style="padding: 0;margin: 0;text-align: left;font-size: 25px;font-weight: 500;">View History.</p><br><br>
                                </td>
                            </tr>
                            
                           
                           

                            
                            <tr>
                            <td colspan="4">
                                <center>
                                 <div class="abc scroll">
                                 <table width="100%" class="sub-table scrolldown" border="0">
                                 <thead>
                                 <tr>   
                                        <th class="table-headin">
                                             Item Name
                                         </th>
                                         <th class="table-headin">
                                             Quantity
                                         </th>
                                         <th class="table-headin">
                                             
                                             Category
                                             
                                         </th>
                                         <th class="table-headin">
                                             
                                             Expiration Date
                                             
                                         </th>
                                        
                                         
                                         <th class="table-headin">
                                             Date Received
                                         </th>
                                         
                                 </thead>
                                 <tbody>';




            $result = $database->query($sqlmain12);

            if ($result->num_rows == 0) {
                echo '<tr>
                                             <td colspan="7">
                                             <br><br><br><br>
                                             <center>
                                             <img src="../img/notfound.svg" width="25%">
                                             
                                             <br>
                                             <p class="heading-main12" style="margin-left: 45px;font-size:20px;color:rgb(49, 49, 49)">We  couldnt find anything related to your keywords !</p>
                                             <a class="non-style-link" href="inventory.php"><button  class="login-btn btn-primary-soft btn"  style="display: flex;justify-content: center;align-items: center;margin-left:20px;">&nbsp; Show all History &nbsp;</font></button>
                                             </a>
                                             </center>
                                             <br><br><br><br>
                                             </td>
                                             </tr>';
            } else {
                for ($x = 0; $x < $result->num_rows; $x++) {
                    $row = $result->fetch_assoc();
                    $name = $row["name"];
                    $quantity = $row["quantity"];
                    $category = $row["category"];
                    $expdate = $row["expdate"];
                    $date = $row["date"];


                    echo '<tr style="text-align:center;">
                                                <td>
                                                ' . substr($name, 0, 15) . '
                                                </td>
                                                 <td style="font-weight:600;padding:25px">' .

                    substr($quantity, 0, 25)
                        . '</td >

                                                 <td style="font-weight:600;padding:25px">' .

                        substr($category, 0,
                            25
                        )
                        . '</td >
                        <td style="font-weight:600;padding:25px">'
                        . date("F j, Y", strtotime($expdate)) .


                        '</td >
                                                 
                                                 <td style="font-weight:600;padding:25px">
                                                 ' . substr($date, 0, 25) . '
                                                 </td>
                                                 
                                                 
                
                                                 
                                             </tr>';
                } 
            }



             '</tbody>
                
                                 </table>
                                 </div>
                                 </center>
                            </td> 
                         </tr>

                        </table>
                        </div>
                    </center>
                    <br><br>
            </div>
            </div>
            ';
        } elseif ($action == 'report') {

            $months = [
                'January' => 1, 'February' => 2, 'March' => 3, 'April' => 4,
                'May' => 5, 'June' => 6, 'July' => 7, 'August' => 8,
                'September' => 9, 'October' => 10, 'November' => 11, 'December' => 12
            ];
            
            // Step 1: Fetch data
            $sql = "SELECT name, expdate, quantity, date FROM inventory";
            $result = $database->query($sql);
            
            $data = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $name = $row["name"];
        $expdate = $row["expdate"];
        $quantity = (int)$row["quantity"];
        $month = date("F", strtotime($row["date"])); // e.g., 'March'

        // Unique key per medicine+expdate
        $key = $name . '|' . $expdate;
        

        if (!isset($data[$key])) {
            $data[$key] = [
                'name' => $name,
                'expdate' => $expdate,
                'months' => array_fill_keys(array_keys($months), 0)
            ];
                    }

                    $data[$key]['months'][$month] += $quantity;
                }
            }


        
            
            // Display Popup and Table
            echo '
<div id="popup1" class="overlay">
    <div class="popup" style="width: 90%; max-width: 100%; overflow-x: auto;">
        <center>
            <h2></h2>
            <a class="close" href="inventory.php">&times;</a>
            <div class="content"></div>

            <div style="overflow-x: auto; width: 100%;">
                <table class="sub-table scrolldown add-doc-form-container" 
                       style="width: max-content; border-collapse: collapse;" 
                       border="1">
                    <thead>
                        <tr>
                            <th class="table-headin" style="padding: 10px;">NAME OF MEDICINE</th>
                            <th class="table-headin" style="padding: 10px;">EXPIRATION DATE</th>';
                            foreach ($months as $month => $num) {
                                echo "<th class='table-headin' style='padding: 10px;'>$month</th>";
                            }
                            echo '<th class="table-headin" style="padding: 10px;">REMARKS</th>';
                            echo '</tr>';
            '</tr>
                    </thead>
                    <tbody>';
            foreach ($data as $entry) {
                $name = $entry['name'];

                $sqlmainexpdate = "SELECT expdate FROM history WHERE name='$name';";
                $expdateResult = $database->query($sqlmainexpdate);
                $expdateList = [];

                if ($expdateResult->num_rows > 0) {
                    while ($rowexpdate = $expdateResult->fetch_assoc()) {
                        $expdateFormatted = date("F j, Y", strtotime($rowexpdate["expdate"]));
                        $expdateList[] = $expdateFormatted;
                    }
                    $expdateDisplay = implode("/", $expdateList);
                } else {
                    $expdateDisplay = "No Expiry Date";
                }

                echo "<tr style='text-align: center;'>";
                echo "<td style='padding: 8px; font-weight: 600;'>" . htmlspecialchars($entry['name']) . "</td>";
                        echo "<td style='padding: 8px; font-weight: 600;'>" . htmlspecialchars($expdateDisplay) . "</td>";
                        foreach ($months as $month => $num) {
                            $qty = $entry['months'][$month] ?: '';
                            echo "<td style='padding: 8px;'>$qty</td>";
                        }
                        // Add a single REMARKS cell after all the months
                        echo "<td style='padding: 10px;'></td>";
                        echo "</tr>";
                    }
                    
                        }
echo '              </tbody>
                </table>
            </div>
            <div style="width: 100%; text-align: right; padding: 15px 10px;">
            <form action="export_excel.php" method="POST">
    <input type="submit" value="Export" class="login-btn btn-primary btn">
</div>
        </center>
        <br><br>
    </div>
</div>';

            
        }
    



    ?>
    </div>
    <script>
        // preloader

        function onReady(callback) {
            var intervalID = window.setInterval(checkReady, 1000);

            function checkReady() {
                if (document.getElementsByTagName('body')[0] !== undefined) {
                    window.clearInterval(intervalID);
                    callback.call(this);
                }
            }
        }

        function show(id, value) {
            document.getElementById(id).style.display = value ? 'block' : 'none';
        }

        onReady(function() {
            show('page', true);
            show('loading', false);
        });