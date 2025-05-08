<?php
header("Content-Type: application/json");

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $userMessage = $_POST["message"];

    // Your Render chatbot API endpoint
    $apiUrl = "https://clinic-chatbot.onrender.com/chat"; // Replace with your actual Render URL

    $postData = json_encode(["message" => $userMessage]);

    $ch = curl_init($apiUrl);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
    curl_setopt($ch, CURLOPT_HTTPHEADER, ["Content-Type: application/json"]);

    $response = curl_exec($ch);
    curl_close($ch);

    echo $response;
}
?>
