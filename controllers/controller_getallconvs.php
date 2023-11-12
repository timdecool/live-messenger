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
    $lastUpdate = Conversation::getUpdateTime($c['id_conv']);

    $upToDate = true;
    $lastSeen = new Datetime($c['last_seen']);
    $lastUpdate = new Datetime($lastUpdate);

    if($lastSeen < $lastUpdate) {
        $upToDate = false;
    }
    
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

    $conv = [];
    $conv['id'] = $c['id_conv'];
    $conv['users'] = $users;
    $conv['lastMessage'] = $lastMessage;
    $conv['src'] = $src;
    $conv['upToDate'] = $upToDate;
    $convInfos[] = $conv;        
}

header('content-type:application/json');
echo json_encode($convInfos);