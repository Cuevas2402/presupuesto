<?php
    require '../config/db.php';
    require '../config/config.php'; 
    session_start();
    if(isset($_SESSION['id']) && isset($_POST['id'])) {
        $sql = $pdo->prepare("DELETE FROM favoritos WHERE uid = ? AND pid = ? ");
        $sql->execute([$_SESSION['id'], $_POST['id']]);
        header("Content-Type: application/json");
        echo json_encode(array("condicion" => true));
    }
    exit();
?>