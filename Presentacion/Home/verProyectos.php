<?php headerPublic($data); ?>

<div class="container my-2 py-4">
    <h2 class="text-center mb-4">Proyectos</h2>
    <div class="row row-cols-1 row-cols-md-3 g-4">
        <?php foreach ($data["proyectos"] as $item) { ?>
            <div class="col">
                <div class="card shadow">
                    <div class="card-body">
                        <h4 class="card-title text-center"><?= $item['nombre'] ?></h4>
                        <?php foreach ($item['lenguajes'] as $lenguaje) { ?>
                            <span class="badge bg-dark"><?= $lenguaje['nombre'] ?></span>
                        <?php } ?>
                        <div class="my-3">
                            <h6>Descripcion</h6>
                            <p class="card-text text-muted"><?= $item['descripcion'] ?></p>
                        </div>
                        <a href="<?= $item['repositorio'] ?>" target="_blank" class="btn btn-primary">Repositorio</a>
                        <a href="<?= base_url(); ?>home/verProyecto/<?= $item['id_proyecto'] ?> " class="btn btn-outline-primary">Ver mas..</a>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>

</div>

<?php footerPublic($data); ?>