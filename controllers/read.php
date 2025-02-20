<?php

include('../config/config.php');

if (isset($_GET['cpf'])) {

    $cpf = $_GET['cpf'];

    try {

        $sql = "SELECT cpf, nome, sobrenome, email, cracha FROM funcionarios WHERE cpf = :cpf AND isdeleted = FALSE";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':cpf', $cpf);
        $stmt->execute();

        $funcionario = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($funcionario) {
            echo json_encode($funcionario);
        } else {
            echo json_encode(['error' => 'Funcionário não encontrado.']);
        }
    } catch (PDOException $e) {
        echo json_encode(['error' => 'Erro ao buscar dados: ' . $e->getMessage()]);
    }
} else {

    try {

        $sql = "SELECT cpf, nome, sobrenome, email, cracha FROM funcionarios WHERE isdeleted = FALSE";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();

        $funcionarios = $stmt->fetchAll(PDO::FETCH_ASSOC);

        echo json_encode($funcionarios);
    } catch (PDOException $e) {
        echo json_encode(['error' => 'Erro ao buscar funcionários: ' . $e->getMessage()]);
    }
}
