<?php
require_once './models/User.php';

$users = [];
if(!empty(trim($_GET['q']))) {
    $users = User::getUsersByQuery($_GET['q']);
}
$users = array('users' => $users);
header('content-type:application/json');
echo json_encode($users);
