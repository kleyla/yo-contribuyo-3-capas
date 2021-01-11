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
            <li class="breadcrumb-item"><a href="<?= base_url(); ?>roles"><?= $data["page_title"] ?></a></li>
        </ul>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="tile">
                <div class="tile-body">
                    <input type="text" name="idArticulo" id="idArticulo" value="<?= $data["id_articulo"] ?>" hidden>
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered" id="tableDenuncias">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Usuario</th>
                                    <th>Razon</th>
                                    <th>Fecha</th>
                                    <th>Opciones</th>
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