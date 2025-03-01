<?php

function buscarFuncionario($pdo, $cpf = null) {
    try {
        if ($cpf) {
            $sql = "SELECT cpf, nome, sobrenome, email, cracha, data_nascimento, foto FROM funcionarios WHERE cpf = :cpf AND isdeleted = FALSE";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':cpf', $cpf);
            $stmt->execute();

            $funcionario = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($funcionario) {
                return $funcionario;
            } else {
                return ['error' => 'Funcionário não encontrado.'];
            }
        } else {
            $sql = "SELECT cpf, nome, sobrenome, email, cracha, data_nascimento, foto FROM funcionarios WHERE isdeleted = FALSE";
            $stmt = $pdo->prepare($sql);
            $stmt->execute();

            $funcionarios = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return $funcionarios;
        }
    } catch (PDOException $e) {
        return ['error' => 'Erro ao buscar dados: ' . $e->getMessage()];
    }
}
?>
