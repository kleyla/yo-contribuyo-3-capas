<?php
headerPublic($data);
getModal("modalFavorito", $data);
?>

<div class="container-md my-2 py-4">
    <div class="row">
        <div class="col-lg-10 col-md-10 col-sm-8">
            <h2 class="text-center "><?= $data['proyecto']['nombre'] ?></h2>
        </div>
        <div class="col">
            <!-- Button trigger modal -->
            <?php if ($_SESSION['login']) { ?>
                <?php if (intval($data['proyecto']['favorito']) > 0) { ?>
                    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#exampleModal">
                        <span class="fa fa-heart-o"></span>
                    </button>
                <?php } else { ?>
                    <button type="button" class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#exampleModal">
                        <span class="fa fa-heart-o"></span>
                    </button>
                <?php } ?>
            <?php } ?>

        </div>
        <div class="col">
            <span class="fa fa-heart c-checked"></span>
            <span><?= $data['proyecto']['favoritos']['cantidad'] ?></span>
        </div>
    </div>
    <div class="row mt-4">
        <div class=" col-lg-3 col-md-3 col-sm-4 ">
            <h6>Lenguajes</h6>
            <?php foreach ($data['proyecto']['lenguajes'] as $lenguaje) { ?>
                <span class="badge bg-dark"><?= $lenguaje['nombre'] ?></span>
            <?php } ?>
        </div>
        <div class="col">
            <p>
                <?= $data['proyecto']['descripcion'] ?>
            </p>
            <h6>Tags</h6>
            <?php $tags = explode(',', $data['proyecto']['tags']);
            foreach ($tags as $tag) { ?>
                <span class="badge bg-primary"><?= $tag ?></span>
            <?php } ?>
        </div>
    </div>
    <div class="row mt-5">
        <h4>Comentarios:</h4>
    </div>
    <div>
        <?php foreach ($data['proyecto']['comentarios'] as $comentario) { ?>
            <div class="row my-2">
                <div class="col-lg-1 col-sm-3 d-flex flex-column justify-content-center align-items-center">
                    <img src="<?= media(); ?>images/uploads/usuario.svg" class="rounded-circle avatar " alt="...">
                </div>
                <div class="col">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <p class="text-muted my-0"><?= $comentario['nick'] ?></p>
                                </div>
                                <div class="col d-flex justify-content-end">
                                    <small class="text-muted"><?= $comentario['fecha'] ?></small>
                                </div>
                            </div>
                            <p class="my-0"><?= $comentario['contenido'] ?></p>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
    <?php if ($_SESSION['login']) { ?>
        <form action="" id="formComentario" name="formComentario">
            <div class="row my-3">
                <div class="col-lg-1 col-sm-3 d-flex flex-column justify-content-center align-items-center">
                    <img src="<?= media(); ?>images/uploads/usuario.svg" class="rounded-circle avatar " alt="...">
                </div>
                <input type="hidden" id="idProyecto" name="idProyecto" value="<?= $data['proyecto']["id_proyecto"] ?>">
                <div class="col-lg-10">
                    <div class="form-group">
                        <label class="control-label"><b>Comentar</b></label>
                        <textarea class="form-control" id="txtComentario" name="txtComentario" rows="2" placeholder="Deja tu comentario" required></textarea>
                    </div>
                </div>
                <div class="col">
                    <button id="btnActionForm" class="btn btn-primary" type="submit">
                        <span id="btnText">Enviar</span></button>
                </div>
            </div>
        </form>
    <?php } else { ?>
        <div class="mt-3">
            <p class="text-center">Registrate para comentar</p>
        </div>
    <?php } ?>
</div>

<?php footerPublic($data); ?>