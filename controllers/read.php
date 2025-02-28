<?php

include('../config/config.php');
include('../functions/read_employee.php');

header('Content-Type: application/json');

if (isset($_GET['cpf'])) {
    $cpf = $_GET['cpf'];
    $response = buscarFuncionario($pdo, $cpf);
    echo json_encode($response);
} else {
    $response = buscarFuncionario($pdo);
    echo json_encode($response);
}
?>
