<?php 
// --- Modèle
require_once "./models/Message.php";
require_once "./models/User.php";
require_once "./models/Conversation.php";
require_once "./models/Image.php";

// Récupérer toutes les conversations d'un utilisateur
$userConvs = Conversation::getAllByUser($_SESSION['user_info']['id']);
// Préparer le gros tableau pour la fin
$convInfos = [];

// Pour chaque conversation, on va chercher tous les autres participants
foreach($userConvs as $c) {
    $convUsers = Conversation::getConvUsers($c['id_conv']);
    $lastMessage = Message::getLastMessage($c['id_conv']);
    $users = [];
    $src = [];

    // On chope leurs infos
    foreach($convUsers as $u) {
        if(empty($src)) {
            $uTemp = User::getUser($u['id_user']);
            $src = Image::getOne($uTemp['id_image']);
        }
        if($u['id_user'] != $_SESSION['user_info']['id']) {
            $users[] = User::getUser($u['id_user']);
        }
    }
    // Et on chope le dernier message envoyé

    $conv = [];
    $conv[] = $c['id_conv'];
    $conv[] = $users;
    $conv[] = $lastMessage;
    $conv[] = $src;
    $convInfos[] = $conv;        
}

header('content-type:application/json');
echo json_encode($convInfos);