<!-- Modal -->
<div class="modal fade" id="modalFormPerfil" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header headerPerfil">
                <h5 class="modal-title" id="titleModalPerfil">Actualizar Datos</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="tile">
                    <form id="formPerfil" name="formPerfil">
                        <input type="hidden" id="idUsuario" name="idUsuario" value="">
                        <p class="text-primary">Los campos con asterisco (<span class="required">*</span>) son obligatorios.</p>
                        <div class="tile-body">
                            <div class="form-group">
                                <label class="control-label">Nick</label>
                                <input value="<?= $_SESSION['userData']['nick'] ?>" class="form-control" id="txtNick" name="txtNick" type="text" placeholder="Nick" required>
                            </div>
                            <div class="form-group">
                                <label class="control-label">Email</label>
                                <input value="<?= $_SESSION['userData']['email'] ?>" class="form-control" id="txtEmail" name="txtEmail" type="email" placeholder="Email" readonly disabled>
                            </div>
                            <div class="form-group">
                                <label class="control-label">Contrasena</label>
                                <input class="form-control" id="txtPass" name="txtPass" type="password" placeholder="Contrasena" required>
                            </div>
                            <div class="form-group">
                                <label class="control-label">Confirmar Contrasena</label>
                                <input class="form-control" id="txtPassConfirm" name="txtPassConfirm" type="password" placeholder="Contrasena" required>
                            </div>

                        </div>
                        <div class="tile-footer">
                            <button id="btnActionForm" class="btn btn-info" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>
                                <span id="btnText">Guardar</span></button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-fw fa-lg fa-times-circle"></i>Cancelar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>