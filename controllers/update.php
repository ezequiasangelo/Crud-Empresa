<?php

include('../config/config.php');

$data = json_decode(file_get_contents("php://input"));

if (isset($data->cpf) && isset($data->nome) && isset($data->sobrenome) && isset($data->email) && isset($data->cracha)) {
    try {

        $sql = "UPDATE funcionarios SET nome = :nome, sobrenome = :sobrenome, email = :email, cracha = :cracha WHERE cpf = :cpf";
        $stmt = $pdo->prepare($sql);

        $stmt->bindParam(':cpf', $data->cpf);
        $stmt->bindParam(':nome', $data->nome);
        $stmt->bindParam(':sobrenome', $data->sobrenome);
        $stmt->bindParam(':email', $data->email);
        $stmt->bindParam(':cracha', $data->cracha);
        $stmt->execute();

        echo json_encode(['message' => 'Funcionário atualizado com sucesso!']);
    } catch (PDOException $e) {
        echo json_encode(['error' => 'Erro ao atualizar funcionário: ' . $e->getMessage()]);
    }
} else {
    echo json_encode(['error' => 'Dados incompletos']);
}
