<!-- Modal -->
<div class="modal fade" id="modalFormUsuario" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header headerRegister">
                <h5 class="modal-title" id="titleModalUsuario">Nuevo Rol</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="tile">
                    <form id="formUsuario" name="formUsuario">
                        <input type="hidden" id="idUsuario" name="idUsuario" value="">
                        <div class="tile-body">
                            <div class="form-group">
                                <label class="control-label">Nick</label>
                                <input class="form-control" id="txtNick" name="txtNick" type="text" placeholder="Nick" required>
                            </div>
                            <div class="form-group">
                                <label class="control-label">Email</label>
                                <input class="form-control" id="txtEmail" name="txtEmail" type="email" placeholder="Email" required>
                            </div>
                            <div class="form-group">
                                <label class="control-label">Contraseña</label>
                                <input class="form-control" id="txtPass" name="txtPass" type="password" placeholder="" required>
                            </div>
                            <div class="form-group">
                                <label for="listaRol">Estado</label>
                                <select class="form-control" id="listaRol" name="listaRol" required>
                                    <option value="Administrador">Administrador</option>
                                    <option value="Contribuidor">Contribuidor</option>
                                </select>
                            </div>
                        </div>
                        <div class="tile-footer">
                            <button id="btnActionForm" class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>
                                <span id="btnText">Guardar</span></button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-fw fa-lg fa-times-circle"></i>Cancelar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>