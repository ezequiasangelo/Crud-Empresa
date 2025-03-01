<div class="modal fade" id="modalEditar" tabindex="-1" aria-labelledby="modalEditarLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalEditarLabel">Detalhes do Funcionário</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="formFuncionarioEditar">
                    <div class="mb-3">
                        <label for="fotoEditar" class="form-label">Nova Foto</label>
                        <input type="file" class="form-control" id="fotoEditar" accept="image/*">
                        <input type="hidden" id="fotoUrlEditar">
                        <img id="previewFotoEditar" src="" alt="Foto Atual" width="100" style="display: none; margin-top: 10px;">
                    </div>
                    <div class="mb-3">
                        <label for="cpfEditar" class="form-label">CPF</label>
                        <input type="text" class="form-control" id="cpfEditar" required disabled>
                    </div>
                    <div class="mb-3">
                        <label for="nomeEditar" class="form-label">Nome</label>
                        <input type="text" class="form-control" id="nomeEditar" required disabled>
                    </div>
                    <div class="mb-3">
                        <label for="sobrenomeEditar" class="form-label">Sobrenome</label>
                        <input type="text" class="form-control" id="sobrenomeEditar" required disabled>
                    </div>
                    <div class="mb-3">
                        <label for="emailEditar" class="form-label">Email</label>
                        <input type="email" class="form-control" id="emailEditar" required disabled>
                    </div>
                    <div class="mb-3">
                        <label for="data_nascimentoEditar" class="form-label">Data de Nascimento</label>
                        <input type="date" class="form-control" id="data_nascimentoEditar" required disabled>
                    </div>
                    <div class="mb-3">
                        <label for="crachaEditar" class="form-label">Crachá</label>
                        <input type="text" class="form-control" id="crachaEditar" required disabled>
                    </div>                  
                    <div class="d-flex justify-content-between">
                        <button type="button" class="btn btn-danger" id="btnExcluirFuncionario">Excluir</button>
                        <button type="button" class="btn btn-warning" id="btnHabilitarEdicao">Habilitar Edição</button>
                        <button type="submit" class="btn btn-success" id="btnSalvarEdicao" style="display: none;">Salvar Edição</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>