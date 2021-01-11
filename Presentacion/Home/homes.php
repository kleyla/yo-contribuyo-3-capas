<?php headerPublic($data); ?>

<div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
    <ol class="carousel-indicators">
        <li data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active"></li>
        <li data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1"></li>
        <li data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2"></li>
    </ol>
    <div class="carousel-inner">
        <div class="carousel-item active">
            <img src="<?= media(); ?>images/uploads/softwaredevelopment.jpeg" class="d-block w-100" alt="...">
        </div>
        <div class="carousel-item">
            <img src="<?= media(); ?>images/uploads/hero-1200x400.jpeg" class="d-block w-100" alt="...">
        </div>
        <div class="carousel-item">
            <img src="<?= media(); ?>images/uploads/server_article_003.jpeg" class="d-block w-100" alt="...">
        </div>
    </div>
    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </a>
</div>
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
<div class="row">
    <?php //dep($_SESSION); ?>

</div>
<div class="container bg-light my-2 py-4">
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