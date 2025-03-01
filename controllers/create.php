<?php

include('../config/config.php');
include('../functions/create_employee.php');

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

$resultado = cadastrarFuncionario($pdo, $data);
echo json_encode($resultado);
