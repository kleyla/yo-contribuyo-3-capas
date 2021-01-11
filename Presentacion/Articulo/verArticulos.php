<?php headerPublic($data); ?>

<div class="container my-2 py-4">
    <div class="row">
        <h2 class="text-center ">Articulos</h2>
    </div>
    <div class="row row-cols-1 row-cols-md-3 g-4 ">
        <?php foreach ($data["articulos"] as $item) { ?>
            <div class="col">
                <div class="card shadow">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-3 d-flex flex-column justify-content-center align-items-center">
                                <img src="<?= media(); ?>images/uploads/usuario.svg" class="rounded-circle avatar" alt="...">
                                <p class="text-muted"><?= $item['nick'] ?></p>
                            </div>
                            <div class="col-9">
                                <h4 class="card-title"><?= $item['titulo'] ?></h4>
                            </div>
                        </div>
                        <div class="d-flex justify-content-end mt-2">
                            <a href="<?= base_url(); ?>home/verArticulo/<?= $item['id_articulo'] ?> " class="btn btn-outline-primary">Ver mas..</a>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
</div>
<?php footerPublic($data); ?>