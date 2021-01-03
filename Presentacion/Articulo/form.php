<?php
headerAdmin($data);
?>

<main class="app-content">
    <div class="app-title">
        <div>
            <h1><i class="fa fa-users"></i> <?php echo $data["page_title"]; ?></h1>
        </div>
        <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
            <li class="breadcrumb-item"><a href="<?= base_url(); ?>proyectos"><?= $data["page_title"] ?></a></li>
        </ul>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="tile">
                <div class="tile-body">
                    <form id="formArticulo" name="formArticulo">
                        <input type="hidden" id="idArticulo" name="idArticulo" value="<?= $data['id_articulo'] ?>">
                        <div class="tile-body">
                            <div class="row">
                                <div class="form-group col-md-12">
                                    <label class="control-label">Titulo</label>
                                    <input value="" class="form-control" id="txtTitulo" name="txtTitulo" type="text" placeholder="Nombre" required>
                                </div>
                                <div class="form-group col-md-12">
                                    <label class="control-label">Contenido <small>(use Markdown)</small></label>
                                    <textarea class="form-control" id="txtContenido" name="txtContenido" rows="15" placeholder="Contenido del articulo" required></textarea>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="listStatus">Estado</label>
                                    <select class="form-control" id="listStatus" name="listStatus" required>
                                        <option value="2">Borrador</option>
                                        <option value="1">Publicar</option>
                                    </select>
                                </div>
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
</main>
<?php footerAdmin($data); ?>