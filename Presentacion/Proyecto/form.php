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
                    <form id="formProyecto" name="formProyecto">
                        <input type="hidden" id="idProyecto" name="idProyecto" value="<?= $data["id_proyecto"] ?>">
                        <div class="tile-body">
                            <div class="row">
                                <div class="col-md-12 col-lg-6">
                                    <div class="form-group">
                                        <label class="control-label">Nombre</label>
                                        <input value="" class="form-control" id="txtNombre" name="txtNombre" type="text" placeholder="Nombre" required>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label">Repositorio oficial</label>
                                        <input class="form-control" id="txtRepositorio" name="txtRepositorio" value="https://" type="text" placeholder="Link" required>
                                    </div>
                                </div>
                                <div class="col-md-12 col-lg-6">
                                    <div class="form-group">
                                        <label class="control-label">Descripcion</label>
                                        <textarea class="form-control" id="txtDescripcion" name="txtDescripcion" rows="4" placeholder="Descripcion del rol" required></textarea>
                                    </div>
                                </div>



                                <div class="form-group col-md-12 col-md-8">
                                    <label class="control-label">Tags <span>(Separar por comas)</span></label>
                                    <input value="" class="form-control" id="txtTags" name="txtTags" type="text" placeholder="Tags">
                                </div>
                            </div>
                            <label for="listaLenguajes">Lenguajes</label>
                            <div class="row">
                                <?php foreach ($data["lenguajes"] as $item) { ?>
                                    <div class="animated-checkbox col-sm-12 col-md-3">
                                        <label>
                                            <input class="" type="checkbox" name="lenguajes[]" value="<?php echo $item["id_lenguaje"] ?>"><span class="label-text"><?php echo $item["nombre"] ?></span>
                                        </label>
                                    </div>
                                <?php } ?>
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