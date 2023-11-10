<?php
    // --- config file
    require "./config.php";
    // --- router file
    require "./services/router.php";
    // --- controller
    require "./controllers/controller_{$page}.php";