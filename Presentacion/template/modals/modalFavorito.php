<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <form name="formFavorito" id="formFavorito">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Favoritos</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input hidden type="text" name="idProyecto" id="idProyecto" value="<?= $data['proyecto']['id_proyecto'] ?>">
                    <?php if (intval($data['proyecto']['favorito']) > 0) { ?>
                        <input type="text" name="favorito" id="favorito" hidden value="0">
                        <p>Desea eliminar de sus favoritos?</p>
                    <?php } else { ?>
                        <input type="text" name="favorito" id="favorito" hidden value="1">
                        <p>Desea guardar a favoritos este proyecto?</p>
                    <?php } ?>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary">Confirmar</button>
                </div>
            </div>
        </form>
    </div>
</div>