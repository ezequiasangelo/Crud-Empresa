let isEditMode = false;

$(document).ready(function () {

    $(document).ready(function () {
        $("#pesquisa").on("input", function () {
            let valorPesquisa = $(this).val().toLowerCase();

            $("#lista tr").each(function () {
                let nome = $(this).find("td:eq(2)").text().toLowerCase();
                let sobrenome = $(this).find("td:eq(3)").text().toLowerCase();
                let cpf = $(this).find("td:eq(5)").text().toLowerCase();
                let email = $(this).find("td:eq(4)").text().toLowerCase();
                let cracha = $(this).find("td:eq(6)").text().toLowerCase();

                if (nome.includes(valorPesquisa) || sobrenome.includes(valorPesquisa) || cpf.includes(valorPesquisa) || email.includes(valorPesquisa) || cracha.includes(valorPesquisa)) {
                    $(this).show();
                } else {
                    $(this).hide();
                }
            });
        });
    });



    $("#cpf").on("input", function () {
        let cpf = $(this).val();
        cpf = cpf.replace(/\D/g, '');
        if (cpf.length <= 3) {
            cpf = cpf.replace(/(\d{1,3})/, '$1');
        } else if (cpf.length <= 6) {
            cpf = cpf.replace(/(\d{3})(\d{1,3})/, '$1.$2');
        } else if (cpf.length <= 9) {
            cpf = cpf.replace(/(\d{3})(\d{3})(\d{1,3})/, '$1.$2.$3');
        } else if (cpf.length <= 11) {
            cpf = cpf.replace(/(\d{3})(\d{3})(\d{3})(\d{1,2})/, '$1.$2.$3-$4');
        }
        $(this).val(cpf);
    });

    function validarCPF(cpf) {
        cpf = cpf.replace(/[^\d]+/g, '');
        if (cpf.length !== 11 || /^(\d)\1{10}$/.test(cpf)) {
            return false;
        }

        let soma = 0;
        let resto;


        for (let i = 0; i < 9; i++) {
            soma += parseInt(cpf.charAt(i)) * (10 - i);
        }
        resto = (soma * 10) % 11;
        if (resto === 10 || resto === 11) resto = 0;
        if (resto !== parseInt(cpf.charAt(9))) return false;

        soma = 0;
        for (let i = 0; i < 10; i++) {
            soma += parseInt(cpf.charAt(i)) * (11 - i);
        }
        resto = (soma * 10) % 11;
        if (resto === 10 || resto === 11) resto = 0;
        if (resto !== parseInt(cpf.charAt(10))) return false;

        return true;
    }
    function uploadImagem(inputSelector, previewSelector, hiddenInputSelector) {
        $(inputSelector).change(function () {
            let file = this.files[0];
            if (!file) return;

            let formData = new FormData();
            formData.append("file", file);
            formData.append("upload_preset", "imagepreset");

            $.ajax({
                url: "https://api.cloudinary.com/v1_1/daujmvh3s/image/upload",
                type: "POST",
                data: formData,
                processData: false,
                contentType: false,
                success: function (response) {
                    let imageUrl = response.secure_url;
                    $(previewSelector).attr("src", imageUrl).show();
                    $(hiddenInputSelector).val(imageUrl);
                },
                error: function (xhr) {
                    console.error("Erro ao enviar imagem:", xhr.responseText);
                    alert("Erro ao enviar a imagem. Tente novamente.");
                }
            });
        });
    }

    uploadImagem("#foto", "#previewFoto", "#fotoUrl");
    uploadImagem("#fotoEditar", "#previewFotoEditar", "#fotoUrlEditar");



    $("#formFuncionario").submit(function (event) {
        event.preventDefault();


        const cpf = $("#cpf").val();
        if (!validarCPF(cpf)) {
            alert("CPF inválido.");
            return;
        }

        const dataNascimento = $("#data_nascimento").val();
        const dataFormatada = formatarData(dataNascimento);

        const funcionario = {
            cpf: cpf,
            nome: $("#nome").val(),
            sobrenome: $("#sobrenome").val(),
            email: $("#email").val(),
            cracha: $("#cracha").val(),
            data_nascimento: dataFormatada,
            foto: $("#fotoUrl").val()
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

    function formatarData(data) {
        const partes = data.split("-");
        return `${partes[2]}/${partes[1]}/${partes[0]}`;
    }

    $("#formFuncionarioEditar").submit(function (event) {
        event.preventDefault();

        const funcionario = {
            cpf: $("#cpfEditar").val(),
            nome: $("#nomeEditar").val(),
            sobrenome: $("#sobrenomeEditar").val(),
            email: $("#emailEditar").val(),
            cracha: $("#crachaEditar").val(),
            data_nascimento: $("#data_nascimentoEditar").val(),
            foto: $("#fotoUrlEditar").val()
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
                    funcionarios.reverse();

                    funcionarios.forEach(funcionario => {

                        const dataNascimento = formatarData(funcionario.data_nascimento);
                        lista.append(`
                            <tr>
                                <td class="text-center"><img src="${funcionario.foto}" alt="Foto" class="lista-foto" onerror="this.onerror=null;this.src='default.jpg';"/></td>
                                <td class="text-center">${funcionario.cracha}</td>
                                <td class="text-center">${funcionario.nome}</td>
                                <td class="text-center">${funcionario.sobrenome}</td>
                                <td class="text-center">${funcionario.email}</td>
                                <td class="text-center">${funcionario.cpf}</td>
                                <td class="text-center">${dataNascimento}</td>
                                <td class="text-center">
                                    <button class="btn btn-link text-primary" onclick="editarFuncionario('${funcionario.cpf}')" data-bs-toggle="modal" data-bs-target="#modalEditar">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                </td>
                            </tr>
                        `);
                    });
                } else {
                    lista.append("<tr><td colspan='8' class='text-center'>Nenhum funcionário cadastrado</td></tr>");
                }
            },
            error: function (xhr) {
                console.error("Erro ao carregar funcionários:", xhr.responseText);
            }
        });
    }

    carregarFuncionarios();
});


$(document).ready(function () {
    $("#btnHabilitarEdicao").click(function () {
        toggleEditMode(true);

        $("#btnHabilitarEdicao").hide();
        $("#btnSalvarEdicao").show();
    });


    $("#modalEditar").on("show.bs.modal", function () {
        toggleEditMode(false);

        $("#btnHabilitarEdicao").show();
        $("#btnSalvarEdicao").hide();
    });
});


function toggleEditMode(enable) {
    $("#formFuncionarioEditar input").prop("disabled", !enable);
    $("#cpfEditar").prop("disabled", true);
}

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
            $("#data_nascimentoEditar").val(funcionario.data_nascimento);
            $("#fotoUrlEditar").val(funcionario.foto);

            if (funcionario.foto) {
                $("#previewFotoEditar").attr("src", funcionario.foto).show();
            } else {
                $("#previewFotoEditar").hide();
            }
            toggleEditMode(false);
        },
        error: function (xhr) {
            console.error("Erro ao carregar dados do funcionário:", xhr.responseText);
        }
    });
}
$(document).ready(function () {
    $("#btnExcluirFuncionario").click(function () {
        let cpf = $("#cpfEditar").val();
        if (!cpf) {
            alert("Nenhum funcionário selecionado.");
            return;
        }

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
                    $("#modalEditar").modal('hide');
                } else if (response.error) {
                    alert(response.error);
                }
            },
            error: function (xhr) {
                alert("Erro ao excluir funcionário.");
                console.error("Erro na requisição:", xhr.responseText);
            }
        });
    });
});