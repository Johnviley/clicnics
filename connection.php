<?php

    $database = new mysqli("192.185.48.158", "bisublar_clinic", "Cl1n1c2025@", "bisublar_clinic");
    
    if ($database->connect_error) {
        die("Connection failed: " . $database->connect_error);
    }

?>
