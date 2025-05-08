


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/animations.css">
    <link rel="stylesheet" href="../css/main.css">
    <link rel="stylesheet" href="../css/admin.css">

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://unpkg.com/@dotlottie/player-component@2.7.12/dist/dotlottie-player.mjs" type="module"></script>

    <title>Chatbot</title>
    <style>
        .dashbord-tables {
            animation: transitionIn-Y-over 0.5s;
        }

        .filter-container {
            animation: transitionIn-X 0.5s;
        }

        .sub-table {
            animation: transitionIn-Y-bottom 0.5s;
        }

        .chatbox-container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 85vh;
            /* Adjust based on your layout */
            width: 100%;
        }

        #chatbox {
            width: 450px;
            height: 600px;
            background: white;
            border-radius: 15px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
            display: flex;
            flex-direction: column;
            overflow: hidden;
            padding: 10px;
        }

        #input-container {
            display: flex;
            padding: 10px;
            background: #fff;
            border-top: 1px solid #eee;
        }

        #userMessage {
            flex-grow: 1;
            border: none;
            padding: 12px;
            border-radius: 25px;
            font-size: 14px;
            box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.1);
            outline: none;
        }

        #sendMessage {
            background: #007bff;
            color: white;
            border: none;
            padding: 12px 20px;
            border-radius: 25px;
            margin-left: 10px;
            font-size: 14px;
            cursor: pointer;
            transition: 0.3s;
        }

        #sendMessage:hover {
            background: #0056b3;
        }

        #messages {
            flex-grow: 1;
            overflow-y: auto;
            padding: 10px;
            border-bottom: 1px solid #eee;
            display: flex;
            flex-direction: column;
        }

        .message {
            padding: 10px 15px;
            border-radius: 15px;
            margin-bottom: 10px;
            max-width: 75%;
            word-wrap: break-word;
            clear: both;
        }

        .user-message {
            background: #007bff;
            color: white;
            align-self: flex-end;
            text-align: right;
            float: right;
        }

        .bot-message {
            background: #f1f1f1;
            color: black;
            align-self: flex-start;
            text-align: left;
        }

        #loading-animation {
            display: none;
            text-align: center;
        }
    </style>

</head>

<body>
    <?php

    //learn from w3schools.com

    session_start(); // ✅ Must be at the very top, before any HTML or whitespace


    if (isset($_SESSION["user"])) {
        if (($_SESSION["user"]) == "" or $_SESSION['usertype'] != 'p') {
            header("location: ../login.php");
        } else {
            $useremail = $_SESSION["user"];
        }
    } else {
        header("location: ../login.php");
    }


    //import database
    include("../connection.php");
    $userrow = $database->query("select * from patient where pemail='$useremail'");
    $userfetch = $userrow->fetch_assoc();
    $userid = $userfetch["pid"];
    $username = $userfetch["pname"];
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
                                    <p class="profile-title"><?php echo substr($username,0,13)  ?>..</p>
                                    <p class="profile-subtitle"><?php echo substr($useremail,0,30)  ?></p>
                                </td>
                                <td style="padding:0px;margin:0px;">


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
                    <td class="menu-btn menu-icon- ">
                        <a href="index.php" class="non-style-link-menu ">
                            <div>
                                <p class="menu-text">Home</p>
                        </a>
        </div></a>
        </td>
        </tr>
        <tr class="menu-row">
            <td class="menu-btn menu-icon-">
                <a href="doctors.php" class="non-style-link-menu">
                    <div>
                        <p class="menu-text">All Doctors</p>
                </a>
    </div>
    </td>
    </tr>

    <tr class="menu-row">
        <td class="menu-btn menu-icon-">
            <a href="schedule.php" class="non-style-link-menu">
                <div>
                    <p class="menu-text">Scheduled Sessions</p>
                </div>
            </a>
        </td>
    </tr>
    <tr class="menu-row">
        <td class="menu-btn menu-icon-">
            <a href="appointment.php" class="non-style-link-menu">
                <div>
                    <p class="menu-text">My Bookings</p>
            </a></div>
        </td>
    </tr>
    <tr class="menu-row">
        <td class="menu-btn menu-icon-  menu-active menu-icon--active">
            <a href="chatbot.php" class="non-style-link-menu-active">
                <div>
                    <p class="menu-text">Chatbot</p>
            </a></div>
        </td>
    </tr>
    <tr class="menu-row">
        <td class="menu-btn menu-icon-">
            <a href="settings.php" class="non-style-link-menu  non-style-link-menu">
                <div>
                    <p class="menu-text">Settings</p>
            </a></div>
        </td>
    </tr>

    </table>
    </div>
    <div class="dash-body" style="margin-top: 15px">
        <table border="0" width="100%" style=" border-spacing: 0;margin:0;padding:0;">

            <tr>

                <td width="13%">
                    <a href="chatbot.php"><button class="login-btn btn-primary-soft btn btn-icon-back" style="padding-top:11px;padding-bottom:11px;margin-left:20px;width:125px">
                            <font class="tn-in-text">Back</font>
                        </button></a>
                </td>
                <td>
                    <p style="font-size: 23px;padding-left:12px;font-weight: 600;">Chatbot</p>

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



                        ?>
                    </p>
                </td>
                <td width="10%">
                    <button class="btn-label" style="display: flex;justify-content: center;align-items: center;"><img src="../img/calendar.svg" width="100%"></button>
                </td>


            </tr>
            <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

            </style>
        </table>

        <div class="chatbox-container">
            <div id="chatbox">
                <div id="messages"></div>
                <div id="loading-animation">
                    <dotlottie-player src="https://lottie.host/a2a8a8e1-febd-49d7-b6b5-0226a9c917e9/vFPQ5UOoCY.lottie" background="transparent" speed="1" style="width: 100px; height: 100px" loop autoplay></dotlottie-player>
                </div>
                <div id="input-container">
                    <input type="text" id="userMessage" placeholder="Type a message..." />
                    <button id="sendMessage">Send</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            function appendMessage(text, className, withAnimation = false) {
                let messageWrapper = $("<div>").css({
                    display: "flex",
                    alignItems: "center",
                    marginBottom: "10px"
                });

                if (className === "bot-message") {
                    messageWrapper.css({
                        flexDirection: "row"
                    });
                } else {
                    messageWrapper.css({
                        flexDirection: "row-reverse"
                    });
                }

                let messageDiv = $("<div>").addClass("message " + className).text(text).hide();

                if (withAnimation) {
                    let animationDiv = $('<dotlottie-player>')
                        .attr('src', 'https://lottie.host/a2a8a8e1-febd-49d7-b6b5-0226a9c917e9/vFPQ5UOoCY.lottie')
                        .attr('background', 'transparent')
                        .attr('speed', '1')
                        .attr('loop', '')
                        .attr('autoplay', '')
                        .css({
                            width: "50px",
                            height: "50px",
                            marginRight: className === "bot-message" ? "10px" : "0",
                            marginLeft: className === "user-message" ? "10px" : "0"
                        });

                    messageWrapper.append(animationDiv).append(messageDiv);
                    $("#messages").append(messageWrapper);
                    $("#messages").scrollTop($("#messages")[0].scrollHeight);

                    setTimeout(() => {
                        messageDiv.fadeIn();
                    }, 1500);
                } else {
                    messageWrapper.append(messageDiv);
                    $("#messages").append(messageWrapper);
                    messageDiv.fadeIn();
                }

                $("#messages").scrollTop($("#messages")[0].scrollHeight);
            }

            $("#sendMessage").click(function() {
                var userMessage = $("#userMessage").val().trim();
                if (userMessage === "") return;

                appendMessage(userMessage, "user-message");
                $("#userMessage").val("");

                $.ajax({
                    url: "apiService.php", // ✅ Use apiService.php instead of direct API URL
                    method: "POST",
                    data: {
                        message: userMessage
                    },
                    success: function(response) {
                        if (response && response.response) {
                            appendMessage(response.response, "bot-message", true);
                        } else {
                            appendMessage("Sorry, no response received.", "bot-message", true);
                        }
                    },
                    error: function(xhr, status, error) {
                        appendMessage("Error connecting to chatbot!", "bot-message", true);
                        console.error("Error:", status, error);
                    }
                });
            });

            $("#userMessage").keypress(function(event) {
                if (event.which === 13) {
                    $("#sendMessage").click();
                }
            });
        });
    </script>
</body>

</html>