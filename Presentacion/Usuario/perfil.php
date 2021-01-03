<?php
headerAdmin($data);
getModal("modalPerfil", $data);
?>

<main class="app-content">
    <div class="row user">
        <div class="col-md-12">
            <div class="profile">
                <div class="info"><img class="user-img" src="<?= media(); ?>images/uploads/usuario.svg">
                    <h4><?= $_SESSION['userData']['nick'] ?></h4>
                    <p><?= $_SESSION['userData']['rol'] ?></p>
                </div>
                <div class="cover-image"></div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="tile p-0">
                <ul class="nav flex-column nav-tabs user-tabs">
                    <li class="nav-item"><a class="nav-link active" href="#user-timeline" data-toggle="tab">Datos</a></li>
                    <li class="nav-item"><a class="nav-link" href="#user-settings" data-toggle="tab">Configuracion</a></li>
                </ul>
            </div>
        </div>
        <div class="col-md-9">
            <div class="tab-content">
                <div class="tab-pane active" id="user-timeline">
                    <div class="timeline-post">
                        <div class="post-media">
                            <div class="content">
                                <h5>DATOS PERSONALES
                                    <button class="btn btn-primary btn-sm" onclick="openModalPerfil()" title="Editar">
                                        <i class="fa fa-pencil"></i></button></h5>
                                <p class="text-muted"><small>2 January at 9:30</small></p>
                            </div>
                        </div>
                        <table class="table table-bordered">
                            <tbody>
                                <tr>
                                    <td style="width: 150px;">Nick:</td>
                                    <td><?= $_SESSION['userData']['nick'] ?></td>
                                </tr>
                                <tr>
                                    <td style="width: 150px;">Email:</td>
                                    <td><?= $_SESSION['userData']['email'] ?></td>
                                </tr>
                                <tr>
                                    <td style="width: 150px;">Rol:</td>
                                    <td><?= $_SESSION['userData']['rol'] ?></td>
                                </tr>
                                <tr>
                                    <td style="width: 150px;">Fecha de registro:</td>
                                    <td><?= $_SESSION['userData']['fecha'] ?></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="tab-pane fade" id="user-settings">
                    <div class="tile user-settings">
                        <h4 class="line-head">Settings</h4>
                        <form>
                            <div class="row mb-4">
                                <div class="col-md-4">
                                    <label>First Name</label>
                                    <input class="form-control" type="text">
                                </div>
                                <div class="col-md-4">
                                    <label>Last Name</label>
                                    <input class="form-control" type="text">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-8 mb-4">
                                    <label>Email</label>
                                    <input class="form-control" type="text">
                                </div>
                                <div class="clearfix"></div>
                                <div class="col-md-8 mb-4">
                                    <label>Mobile No</label>
                                    <input class="form-control" type="text">
                                </div>
                                <div class="clearfix"></div>
                                <div class="col-md-8 mb-4">
                                    <label>Office Phone</label>
                                    <input class="form-control" type="text">
                                </div>
                                <div class="clearfix"></div>
                                <div class="col-md-8 mb-4">
                                    <label>Home Phone</label>
                                    <input class="form-control" type="text">
                                </div>
                            </div>
                            <div class="row mb-10">
                                <div class="col-md-12">
                                    <button class="btn btn-primary" type="button"><i class="fa fa-fw fa-lg fa-check-circle"></i> Save</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<?php footerAdmin($data); ?>