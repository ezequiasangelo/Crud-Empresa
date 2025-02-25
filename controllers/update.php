<?php

include('../config/config.php');

$data = json_decode(file_get_contents("php://input"));

if (isset($data->cpf) && isset($data->nome) && isset($data->sobrenome) && isset($data->email) && isset($data->cracha) && isset($data->data_nascimento)) {
    try {
        $sql = "UPDATE funcionarios SET nome = :nome, sobrenome = :sobrenome, email = :email, cracha = :cracha, data_nascimento = :data_nascimento WHERE cpf = :cpf";
        $stmt = $pdo->prepare($sql);

        $stmt->bindParam(':cpf', $data->cpf);
        $stmt->bindParam(':nome', $data->nome);
        $stmt->bindParam(':sobrenome', $data->sobrenome);
        $stmt->bindParam(':email', $data->email);
        $stmt->bindParam(':cracha', $data->cracha);
        $stmt->bindParam(':data_nascimento', $data->data_nascimento);
        $stmt->execute();

        echo json_encode(['message' => 'Funcionário atualizado com sucesso!']);
    } catch (PDOException $e) {
        echo json_encode(['error' => 'Erro ao atualizar funcionário: ' . $e->getMessage()]);
    }
} else {
    echo json_encode(['error' => 'Dados incompletos']);
}

if (isset($_FILES['foto']) && $_FILES['foto']['error'] == 0) {
    $foto = $_FILES['foto'];
    $fotoName = time() . "_" . $foto['name'];
    $uploadDir = 'uploads/';
    $uploadFile = $uploadDir . $fotoName;

    if (move_uploaded_file($foto['tmp_name'], $uploadFile)) {
        
        $sql = "UPDATE funcionarios SET nome = :nome, sobrenome = :sobrenome, email = :email, cracha = :cracha, data_nascimento = :data_nascimento, foto = :foto WHERE cpf = :cpf";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':foto', $fotoName);

    } else {
        echo json_encode(['error' => 'Erro ao salvar a foto.']);
        exit;
    }
}
