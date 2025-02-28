<?php

include('../config/config.php');
include('../functions/update_employee.php');

header('Content-Type: application/json');

$data = json_decode(file_get_contents("php://input"));

$response = atualizarFuncionario($pdo, $data);

echo json_encode($response);
?>
