<?php

include('../config/config.php');

header('Content-Type: application/json');

$data = json_decode(file_get_contents("php://input"));


if (isset($_FILES['foto']) && $_FILES['foto']['error'] == UPLOAD_ERR_OK) {
    $fotoTmp = $_FILES['foto']['tmp_name'];
    $fotoNome = $_FILES['foto']['name'];
    $fotoDestino = 'uploads/' . $fotoNome;

    if (move_uploaded_file($fotoTmp, $fotoDestino)) {
        $foto = $fotoDestino;
    } else {
        echo json_encode(['error' => 'Falha ao fazer upload da foto.']);
        exit;
    }
} else {
    $foto = '';
}


if (!isset($data->cpf) || !isset($data->nome) || !isset($data->sobrenome) || !isset($data->email) || !isset($data->cracha) || !isset($data->data_nascimento)) {
    echo json_encode(['error' => 'Por favor, preencha todos os campos antes de continuar.']);
    exit;
}

try {

    $sqlCheck = "SELECT cpf, email, cracha FROM funcionarios WHERE cpf = :cpf OR email = :email OR cracha = :cracha";
    $stmtCheck = $pdo->prepare($sqlCheck);
    $stmtCheck->bindParam(':cpf', $data->cpf);
    $stmtCheck->bindParam(':email', $data->email);
    $stmtCheck->bindParam(':cracha', $data->cracha);
    $stmtCheck->execute();

    $existing = $stmtCheck->fetch(PDO::FETCH_ASSOC);

    if ($existing) {
        $mensagemErro = 'Os dados informados já estão cadastrados: ';
        if ($existing['cpf'] == $data->cpf) $mensagemErro .= 'CPF já cadastrado. ';
        if ($existing['email'] == $data->email) $mensagemErro .= 'E-mail já cadastrado. ';
        if ($existing['cracha'] == $data->cracha) $mensagemErro .= 'Crachá já cadastrado. ';
        echo json_encode(['error' => trim($mensagemErro)]);
        exit;
    }

    $dataNascimento = DateTime::createFromFormat('d/m/Y', $data->data_nascimento);
    if ($dataNascimento) {
        $data_nascimento = $dataNascimento->format('Y-m-d');
    } else {
        echo json_encode(['error' => 'Formato de data inválido.']);
        exit;
    }


    $sqlInsert = "INSERT INTO funcionarios (cpf, nome, sobrenome, email, cracha, data_nascimento, foto) 
    VALUES (:cpf, :nome, :sobrenome, :email, :cracha, :data_nascimento, :foto)";
    $stmtInsert = $pdo->prepare($sqlInsert);
    $stmtInsert->bindParam(':cpf', $data->cpf);
    $stmtInsert->bindParam(':nome', $data->nome);
    $stmtInsert->bindParam(':sobrenome', $data->sobrenome);
    $stmtInsert->bindParam(':email', $data->email);
    $stmtInsert->bindParam(':cracha', $data->cracha);
    $stmtInsert->bindParam(':data_nascimento', $data->data_nascimento);
    $stmtInsert->bindParam(':foto', $data->foto);

    if ($stmtInsert->execute()) {
        echo json_encode(['message' => 'Funcionário cadastrado com sucesso!']);
    } else {
        echo json_encode(['error' => 'Ocorreu um erro ao cadastrar o funcionário. Tente novamente mais tarde.']);
    }
} catch (PDOException $e) {
    echo json_encode(['error' => 'Erro no banco de dados: ' . $e->getMessage()]);
}
