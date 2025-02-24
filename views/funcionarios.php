<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <div class="container mt-4">
        <h1 class="text-center">Lista de Funcionários</h1>

        <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#modalCadastro">
            Cadastrar Funcionário
        </button>

        <div class="mb-3">
            <input type="text" id="pesquisa" class="form-control" placeholder="Pesquisar funcionários...">
        </div>


        <?php include 'modal_cadastro.php'; ?>
        <?php include 'modal_editar.php'; ?>

        <div class="table-responsive">
            <table class="table table-striped">
                <thead class="table-dark">
                    <tr>
                        <th>Foto</th>
                        <th>CPF</th>
                        <th>Nome</th>
                        <th>Sobrenome</th>
                        <th>Email</th>
                        <th>Data de Nascimento</th>
                        <th>Crachá</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody id="lista"> </tbody>
            </table>
        </div>
    </div>
</body>

</html>