<?php

function excluirFuncionario($pdo, $cpf) {
    if ($cpf) {
        try {
            $sql = "UPDATE funcionarios SET isdeleted = TRUE WHERE cpf = :cpf";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':cpf', $cpf);
            $stmt->execute();

            return ["message" => "Funcionário excluído com sucesso"];
        } catch (PDOException $e) {
            return ["error" => "Erro ao excluir funcionário: " . $e->getMessage()];
        }
    } else {
        return ["error" => "CPF não fornecido"];
    }
}
?>
