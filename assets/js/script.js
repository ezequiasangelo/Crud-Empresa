let isEditMode = false;

$(document).ready(function () {
    $("#formFuncionario").submit(function (event) {
        event.preventDefault();

        const funcionario = {
            cpf: $("#cpf").val(),
            nome: $("#nome").val(),
            sobrenome: $("#sobrenome").val(),
            email: $("#email").val(),
            cracha: $("#cracha").val()
        };

        $.ajax({
            url: 'controllers/create.php',
            type: 'POST',
            contentType: 'application/json',
            data: JSON.stringify(funcionario),
            dataType: 'json',
            success: function (response) {
                if (response.message) {
                    alert(response.message);
                    location.reload();
                    $("#modalCadastro").modal('hide');
                } else if (response.error) {
                    alert(response.error);
                }
            },
            error: function (xhr) {
                alert("Erro ao processar a requisição. Verifique os dados e tente novamente.");
                console.error("Erro na requisição:", xhr.responseText);
            }
        });
    });

    $("#formFuncionarioEditar").submit(function (event) {
        event.preventDefault();

        const funcionario = {
            cpf: $("#cpfEditar").val(),
            nome: $("#nomeEditar").val(),
            sobrenome: $("#sobrenomeEditar").val(),
            email: $("#emailEditar").val(),
            cracha: $("#crachaEditar").val()
        };

        $.ajax({
            url: 'controllers/update.php',
            type: 'POST',
            contentType: 'application/json',
            data: JSON.stringify(funcionario),
            dataType: 'json',
            success: function (response) {
                if (response.message) {
                    alert(response.message);
                    location.reload();
                    $("#modalEditar").modal('hide');
                } else if (response.error) {
                    alert(response.error);
                }
            },
            error: function (xhr) {
                alert("Erro ao atualizar os dados. Tente novamente.");
                console.error("Erro na requisição:", xhr.responseText);
            }
        });
    });

    function carregarFuncionarios() {
        $.ajax({
            url: 'controllers/read.php',
            type: 'GET',
            dataType: 'json',
            success: function (funcionarios) {
                const lista = $("#lista");
                lista.empty();

                if (funcionarios.length > 0) {
                    funcionarios.forEach(funcionario => {
                        lista.append(`
                            <tr>
                                <td>${funcionario.cpf}</td>
                                <td>${funcionario.nome}</td>
                                <td>${funcionario.sobrenome}</td>
                                <td>${funcionario.email}</td>
                                <td>${funcionario.cracha}</td>
                                <td>
                                    <button class="btn btn-warning btn-sm" onclick="editarFuncionario('${funcionario.cpf}')" data-bs-toggle="modal" data-bs-target="#modalEditar">Editar</button>
                                    <button class="btn btn-danger btn-sm" onclick="excluirFuncionario('${funcionario.cpf}')">Excluir</button>
                                </td>
                            </tr>
                        `);
                    });
                } else {
                    lista.append("<tr><td colspan='6' class='text-center'>Nenhum funcionário cadastrado</td></tr>");
                }
            },
            error: function (xhr) {
                console.error("Erro ao carregar funcionários:", xhr.responseText);
            }
        });
    }

    carregarFuncionarios();
});

function editarFuncionario(cpf) {
    $.ajax({
        url: `controllers/read.php?cpf=${cpf}`,
        type: 'GET',
        dataType: 'json',
        success: function (funcionario) {
            $("#cpfEditar").val(funcionario.cpf);
            $("#nomeEditar").val(funcionario.nome);
            $("#sobrenomeEditar").val(funcionario.sobrenome);
            $("#emailEditar").val(funcionario.email);
            $("#crachaEditar").val(funcionario.cracha);
        },
        error: function (xhr) {
            console.error("Erro ao carregar dados do funcionário:", xhr.responseText);
        }
    });
}

function excluirFuncionario(cpf) {
    if (!confirm("Tem certeza que deseja excluir este funcionário?")) {
        return;
    }

    $.ajax({
        url: 'controllers/delete.php',
        type: 'POST',
        contentType: 'application/json',
        data: JSON.stringify({ cpf }),
        dataType: 'json',
        success: function (response) {
            if (response.message) {
                alert(response.message);
                location.reload();
            } else if (response.error) {
                alert(response.error);
            }
        },
        error: function (xhr) {
            alert("Erro ao excluir funcionário.");
            console.error("Erro na requisição:", xhr.responseText);
        }
    });
}