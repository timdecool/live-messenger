<?php
    // -- default timezone
    date_default_timezone_set("Europe/Paris");

    // --- config file
    require "./config.php";
    // --- router file
    require "./services/router.php";
    // --- controller
    require "./controllers/controller_{$page}.php";