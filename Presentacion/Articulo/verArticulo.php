<?php headerPublic($data); ?>

<div class="container-md my-2 py-4">
    <div class="row">
        <h2 class="text-center "><?= $data['articulo']['titulo'] ?></h2>
    </div>
    <div class="row mt-4">
        <div class=" col-lg-2 col-md-3 col-sm-4 ">
            <div class="card shadow">
                <div class="card-body my-2 d-flex flex-column justify-content-center align-items-center">
                    <img src="<?= media(); ?>images/uploads/usuario.svg" class="rounded-circle avatar-big" alt="...">
                    <p class="text-muted mt-2"><?= $data['articulo']['nick'] ?></p>
                </div>
            </div>
        </div>
        <div class="col">

            <div>
                <?php
                require_once 'Libraries/Parsedown.php';
                $parsedown = new Parsedown();
                echo $parsedown->text($data['articulo']['contenido'])
                ?>
            </div>

        </div>
    </div>
    <?php if (array_key_exists("login", $_SESSION)) { ?>
        <div class="text-center mt-4">
            <button type="button" class="btn btn-link" data-bs-toggle="modal" data-bs-target="#DenunciaModal">
                Denunciar
            </button>

        </div>
    <?php } ?>

</div>
<?php if (array_key_exists("login", $_SESSION)) {
    getModal("modalDenuncias", $data);
} ?>
<?php footerPublic($data); ?>