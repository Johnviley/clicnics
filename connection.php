<?php
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

try {
    $db_host = '192.185.48.158';
    $db_user = 'bisublar_clinic';
    $db_pass = 'Cl1n1c2025@';
    $db_name = 'bisublar_clinic';

    $database = new mysqli($db_host, $db_user, $db_pass, $db_name);
    $database->set_charset("utf8mb4");

    // echo "Database connection successful.";

} catch (mysqli_sql_exception $e) {
    error_log("Database connection error: " . $e->getMessage());
    die("Database connection failed. Please try again later.");
}
?>
