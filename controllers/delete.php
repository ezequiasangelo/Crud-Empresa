<?php

include('../config/config.php');
include('../functions/delete_employee.php');

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $dados = json_decode(file_get_contents("php://input"), true);

    if (isset($dados['cpf'])) {
        $cpf = $dados['cpf'];

        $response = excluirFuncionario($pdo, $cpf);

        echo json_encode($response);
    } else {
        echo json_encode(["error" => "CPF não fornecido"]);
    }
} else {
    echo json_encode(["error" => "Método inválido"]);
}
?>
