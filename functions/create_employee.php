<?php

function cadastrarFuncionario($pdo, $data) {

    $sqlCheck = "SELECT cpf, email, cracha, nome, sobrenome, data_nascimento, isdeleted FROM funcionarios WHERE cpf = :cpf";
    $stmtCheck = $pdo->prepare($sqlCheck);
    $stmtCheck->bindParam(':cpf', $data->cpf);
    $stmtCheck->execute();
    
    $existing = $stmtCheck->fetch(PDO::FETCH_ASSOC);
    
    if ($existing) {
        if ($existing['isdeleted'] == FALSE) {
            $mensagemErro = 'CPF já cadastrado e não excluído.';
            return ['error' => $mensagemErro];
        } else {
            $sqlReativar = "UPDATE funcionarios 
                            SET isdeleted = FALSE, 
                                cracha = :cracha, 
                                nome = :nome, 
                                sobrenome = :sobrenome, 
                                email = :email, 
                                data_nascimento = :data_nascimento
                            WHERE cpf = :cpf";
            $stmtReativar = $pdo->prepare($sqlReativar);
            $stmtReativar->bindParam(':cpf', $data->cpf);
            $stmtReativar->bindParam(':cracha', $data->cracha);
            $stmtReativar->bindParam(':nome', $data->nome);
            $stmtReativar->bindParam(':sobrenome', $data->sobrenome);
            $stmtReativar->bindParam(':email', $data->email);
            $stmtReativar->bindParam(':data_nascimento', $data->data_nascimento);
            $stmtReativar->execute();
            
            $mensagemSucesso = 'CPF reativado e cadastro atualizado.';
            return ['message' => $mensagemSucesso];
        }
    }

    $dataNascimento = DateTime::createFromFormat('d/m/Y', $data->data_nascimento);
    if ($dataNascimento) {
        $data_nascimento = $dataNascimento->format('Y-m-d');
    } else {
        return ['error' => 'Formato de data inválido.'];
    }

    $sqlInsert = "INSERT INTO funcionarios (cpf, nome, sobrenome, email, cracha, data_nascimento, foto) 
                  VALUES (:cpf, :nome, :sobrenome, :email, :cracha, :data_nascimento, :foto)";
    $stmtInsert = $pdo->prepare($sqlInsert);
    $stmtInsert->bindParam(':cpf', $data->cpf);
    $stmtInsert->bindParam(':nome', $data->nome);
    $stmtInsert->bindParam(':sobrenome', $data->sobrenome);
    $stmtInsert->bindParam(':email', $data->email);
    $stmtInsert->bindParam(':cracha', $data->cracha);
    $stmtInsert->bindParam(':data_nascimento', $data_nascimento);
    $stmtInsert->bindParam(':foto', $data->foto);

    if ($stmtInsert->execute()) {
        return ['message' => 'Funcionário cadastrado com sucesso!'];
    } else {
        return ['error' => 'Ocorreu um erro ao cadastrar o funcionário. Tente novamente mais tarde.'];
    }
}


?>
