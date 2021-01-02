<div class="modal fade" id="DenunciaModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <form name="formDenuncia" id="formDenuncia">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Denunciar Articulo</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input hidden type="text" name="idArticulo" id="idArticulo" value="<?= $data['articulo']['id_articulo'] ?>">
                    <p>Desea denunciar este articulo?</p>
                    <div class="mb-3">
                        <label for="txtRazones" class="form-label">Razones</label>
                        <input type="text" class="form-control" id="txtRazones" name="txtRazones" placeholder="Escribenos tus razones">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary">Confirmar</button>
                </div>
            </div>
        </form>
    </div>
</div>