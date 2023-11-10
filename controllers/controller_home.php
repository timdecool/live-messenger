<?php

if(!isset($_SESSION['user_info'])) {
    header('Location:?page=signin');
}

// - model
require_once './models/Image.php';

// -- controller
$i = Image::getOne($_SESSION['user_info']['id_image']);

// --- view
include "./views/layout.phtml";