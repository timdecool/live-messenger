<?php 
// --- Modèle
require_once "./models/Conversation.php";

$curConv = Conversation::getLastSeen($_SESSION['user_info']['id']);

$lastSeen = array("curconv" => $curConv);
header('content-type:application/json');
echo json_encode($lastSeen);