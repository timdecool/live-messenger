<?php 
// --- Modèle
require_once "./models/Message.php";
require_once "./models/User.php";
require_once "./models/Conversation.php";

Conversation::updateLastSeen($_SESSION['user_info']['id'],$_GET['conv']);
$messages = Message::getConversation($_GET['conv']);
$convUsers = Conversation::getConvUsers($_GET['conv']);
$users = [];

foreach($convUsers as $u) {
    $users[] = User::getUser($u['id_user']);
}

$conversation = array("users" => $users, "messages" => $messages);
header('content-type:application/json');
echo json_encode($conversation);