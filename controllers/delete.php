<?php

include('../config/config.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $dados = json_decode(file_get_contents("php://input"), true);

    if (isset($dados['cpf'])) {
        $cpf = $dados['cpf'];

        try {
            $sql = "UPDATE funcionarios SET isdeleted = TRUE WHERE cpf = :cpf";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':cpf', $cpf);
            $stmt->execute();

            echo json_encode(["message" => "Funcionário excluído com sucesso"]);
        } catch (PDOException $e) {
            echo json_encode(["error" => "Erro ao excluir funcionário: " . $e->getMessage()]);
        }
    } else {
        echo json_encode(["error" => "CPF não fornecido"]);
    }
} else {
    echo json_encode(["error" => "Método inválido"]);
}
