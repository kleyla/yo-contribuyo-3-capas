<!-- Modal -->
<div class="modal fade" id="modalFormLenguaje" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header headerRegister">
                <h5 class="modal-title" id="titleModalLenguaje">Nuevo Usuario</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="tile">
                    <form id="formLenguaje" name="formLenguaje">
                        <input type="hidden" id="idLenguaje" name="idLenguaje" value="">
                        <div class="tile-body">
                            <div class="form-group">
                                <label class="control-label">Nombre</label>
                                <input class="form-control" id="txtNombre" name="txtNombre" type="text" placeholder="Nombre" required>
                            </div>
                            <div class="form-group">
                                <label class="control-label">Link oficial</label>
                                <input class="form-control" id="txtLink" name="txtLink" type="text" placeholder="Link" required>
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