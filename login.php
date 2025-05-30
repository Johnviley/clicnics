<?php
// Start output buffering to prevent headers already sent error
ob_start();
session_start();

// Unset all the server-side variables
$_SESSION["user"] = "";
$_SESSION["usertype"] = "";

// Set the new timezone
date_default_timezone_set('Asia/Kolkata');
$date = date('Y-m-d');
$_SESSION["date"] = $date;

// Import database
include("connection.php");

$error = '<label for="promter" class="form-label">&nbsp;</label>';

if ($_POST) {
    $email = $_POST['useremail'];
    $password = $_POST['userpassword'];

    $result = $database->query("SELECT * FROM webuser WHERE email='$email'");
    if ($result->num_rows == 1) {
        $utype = $result->fetch_assoc()['usertype'];

        if ($utype == 'p') {
            $checker = $database->query("SELECT * FROM patient WHERE pemail='$email' AND ppassword='$password'");
            if ($checker->num_rows == 1) {
                $_SESSION['user'] = $email;
                $_SESSION['usertype'] = 'p';
                header('Location: patient/index.php');
                exit;
            }
        } elseif ($utype == 'a') {
            $checker = $database->query("SELECT * FROM admin WHERE aemail='$email' AND apassword='$password'");
            if ($checker->num_rows == 1) {
                $_SESSION['user'] = $email;
                $_SESSION['usertype'] = 'a';
                header('Location: admin/index.php');
                exit;
            }
        } elseif ($utype == 'd') {
            $checker = $database->query("SELECT * FROM doctor WHERE docemail='$email' AND docpassword='$password'");
            if ($checker->num_rows == 1) {
                $_SESSION['user'] = $email;
                $_SESSION['usertype'] = 'd';
                header('Location: doctor/index.php');
                exit;
            }
        }

        $error = '<label for="promter" class="form-label" style="color:rgb(255,62,62);text-align:center;">Wrong credentials: Invalid email or password</label>';
    } else {
        $error = '<label for="promter" class="form-label" style="color:rgb(255,62,62);text-align:center;">We can\'t find any account with this email.</label>';
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="css/animations.css">
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/login.css">
</head>

<body>
    <center>
        <div class="container">
            <table border="0" style="margin: 0;padding: 0;width: 60%;">
                <tr>
                    <td>
                        <p class="header-text">Welcome BISUans!</p>
                    </td>
                </tr>
                <div class="form-body">
                    <tr>
                        <td>
                            <p class="sub-text">Login with your details to continue</p>
                        </td>
                    </tr>
                    <tr>
                        <form action="" method="POST">
                            <td class="label-td">
                                <label for="useremail" class="form-label">Email: </label>
                            </td>
                    </tr>
                    <tr>
                        <td class="label-td">
                            <input type="email" name="useremail" class="input-text" placeholder="Email Address" required>
                        </td>
                    </tr>
                    <tr>
                        <td class="label-td">
                            <label for="userpassword" class="form-label">Password: </label>
                        </td>
                    </tr>
                    <tr>
                        <td class="label-td">
                            <input type="password" name="userpassword" class="input-text" placeholder="Password" required>
                        </td>
                    </tr>
                    <tr>
                        <td><br><?php echo $error; ?></td>
                    </tr>
                    <tr>
                        <td>
                            <input type="submit" value="Login" class="login-btn btn-primary btn">
                        </td>
                    </tr>
                </div>
                <tr>
                    <td>
                        <br>
                        <label class="sub-text" style="font-weight: 280;">Don't have an account&#63; </label>
                        <a href="signup.php" class="hover-link1 non-style-link">Sign Up</a><br><br><br>
                    </td>
                </tr>
                </form>
            </table>
        </div>
    </center>
</body>

</html>
<?php ob_end_flush(); ?>