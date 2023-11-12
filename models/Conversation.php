<?php

require_once "./services/database.php";

class Conversation {
    public static function getAllByUser($id) {
        $conv = [];

        $pdo = connectDB();
        $statement = $pdo->prepare("SELECT * FROM conversations_users WHERE id_user=? ORDER BY last_seen DESC");
        $statement->execute([$id]);
        $conv = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $conv;
    }

    public static function getConvUsers($id_conv) {
        $users = [];

        $pdo = connectDB();
        $statement = $pdo->prepare("SELECT * FROM conversations_users WHERE id_conv=? ORDER BY id DESC");
        $statement->execute([$id_conv]);
        $users = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $users;
    }

    public static function updateLastSeen($id_user, $id_conv) {
        $pdo = connectDB();
        $sql = $pdo->prepare("UPDATE conversations_users 
        SET last_seen=?
        WHERE id_user = ? AND id_conv = ?");
        $sql->execute([date('Y-m-d H:i:s'),$id_user,$id_conv]);
    }

    public static function getLastSeen($id_user) {
        $curConv = 0;

        $pdo = connectDB();
        $statement = $pdo->prepare("SELECT id_conv FROM conversations_users WHERE id_user=? ORDER BY last_seen DESC LIMIT 1");
        $statement->execute([$id_user]);
        $curConv = $statement->fetchColumn();

        return $curConv;
    }

    public static function setUpdateTime($id_conv) {
        $pdo = connectDB();
        $sql = $pdo->prepare("UPDATE conversations
        SET date_updated=?
        WHERE  id=?");
        $sql->execute([date('Y-m-d H:i:s'),$id_conv]);
    }

    public static function getUpdateTime($id_conv) {
        $dateUpdated = "";

        $pdo = connectDB();
        $statement = $pdo->prepare("SELECT date_updated FROM conversations WHERE id=?");
        $statement->execute([$id_conv]);
        $dateUpdated = $statement->fetchColumn();

        return $dateUpdated;
    }

    
}