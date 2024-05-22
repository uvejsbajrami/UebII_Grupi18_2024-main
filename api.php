<?php
include 'db.php';


$method = $_SERVER['REQUEST_METHOD'];   
$action = (isset($_GET['action']) && !empty($_GET['action'])) ? $_GET['action'] : '';

// Action: Get users
// HTTP verb: GET
// URL: http://localhost/mbrojtja_e_projektit/UebII_Grupi18_2024-main/api.php?action=get_doctors

if($action == 'get_doctors' && $method == 'GET') {
    $doctors = []; 

    $doctors_stm = $pdo->prepare("SELECT `id`,`name`, `lastname`, `position`, `email` FROM `users`");
    $doctors_stm->execute();
    while($row = $doctors_stm->fetch(PDO::FETCH_ASSOC)) {
            $doctors[] = $row;
    }

    echo json_encode(['doctors' => $doctors]);
}