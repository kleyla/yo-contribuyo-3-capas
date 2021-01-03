<?php
headerAdmin($data);
?>

<main class="app-content">
    <div class="app-title">
        <div>
            <h1><i class="fa fa-users"></i> <?php echo $data["page_title"]; ?>
                <a class="btn btn-primary" type="button" href="<?= base_url(); ?>articulo/form">
                    <i class="fa fa-plus"></i>
                    Nuevo</a>
            </h1>
        </div>
        <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
            <li class="breadcrumb-item"><a href="<?= base_url(); ?>roles"><?= $data["page_title"] ?></a></li>
        </ul>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="tile">
                <div class="tile-body">
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered" id="tableArticulos">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Titulo</th>
                                    <th>Usuario</th>
                                    <th>Fecha</th>
                                    <th>Estado</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
<?php footerAdmin($data); ?>