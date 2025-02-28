<?php

function atualizarFuncionario($pdo, $data) {
    if (isset($data->cpf) && isset($data->nome) && isset($data->sobrenome) && isset($data->email) && isset($data->cracha) && isset($data->data_nascimento)) {
        try {
            $sql = "UPDATE funcionarios SET nome = :nome, sobrenome = :sobrenome, email = :email, cracha = :cracha, data_nascimento = :data_nascimento";

            if (!empty($data->foto)) {
                $sql .= ", foto = :foto"; 
            }

            $sql .= " WHERE cpf = :cpf";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':cpf', $data->cpf);
            $stmt->bindParam(':nome', $data->nome);
            $stmt->bindParam(':sobrenome', $data->sobrenome);
            $stmt->bindParam(':email', $data->email);
            $stmt->bindParam(':cracha', $data->cracha);
            $stmt->bindParam(':data_nascimento', $data->data_nascimento);

            if (!empty($data->foto)) {
                $stmt->bindParam(':foto', $data->foto);
            }

            $stmt->execute();

            return ['message' => 'Funcionário atualizado com sucesso!'];
        } catch (PDOException $e) {
            return ['error' => 'Erro ao atualizar funcionário: ' . $e->getMessage()];
        }
    } else {
        return ['error' => 'Dados incompletos'];
    }
}
?>
