<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-4">

        <header class="header">
            <div class="container d-flex align-items-center justify-content-between">
                <h1 class="logo"><i class="fas fa-users"></i> Gestão de Funcionários</h1>

            </div>
        </header>

        <section class="sub-header text-center">
            <h2>Mantenha sua equipe organizada e eficiente</h2>
            <p>Gerencie seus funcionários de maneira rápida, prática e segura.</p>
        </section>

        <div class="d-flex justify-content-between mb-3">
            <div class="flex-fill me-2">
                <input type="text" id="pesquisa" class="form-control" placeholder="Pesquisar funcionários...">
            </div>

            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalCadastro">
                Cadastrar Funcionário
            </button>

        </div>


        <?php include 'modal_create.php'; ?>
        <?php include 'modal_edit.php'; ?>

        <div class="table-responsive">
            <table class="table table-striped text-center">
                <thead class="table-dark">
                    <tr>
                        <th></th>
                        <th>Crachá</th>
                        <th>Nome</th>
                        <th>Sobrenome</th>
                        <th>Email</th>
                        <th>CPF</th>
                        <th>Data de Nascimento</th>
                        <th>Visualizar</th>
                    </tr>
                </thead>
                <tbody id="lista"> </tbody>
            </table>
        </div>
    </div>
</body>

</html>