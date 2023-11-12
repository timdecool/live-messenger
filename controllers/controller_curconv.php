<?php 
// --- Modèle
require_once "./models/Conversation.php";

$curConv = Conversation::getLastSeen($_SESSION['user_info']['id']);

header('content-type:application/json');
echo json_encode($curConv);