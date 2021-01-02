<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="Karen Rodriguez">
    <meta name="theme-color" content="#009688">
    <link rel="shortcut icon" href="<?= media(); ?>images/uploads/cv.svg">
    <title><?= $data["page_tag"]; ?></title>
    <!-- Main CSS-->
    <link rel="stylesheet" type="text/css" href="<?= media(); ?>css/main.css">
    <link rel="stylesheet" type="text/css" href="<?= media(); ?>css/styles.css">
    <!-- Font-icon css-->
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>
    <section class="material-half-bg">
        <div class="cover"></div>
    </section>
    <section class="login-content">
        <div class="logo">
            <h1>Yo contribuyo</h1>
        </div>
        <div class="login-box register-box">
            <form class="login-form" action="" id="formRegister" name="formRegister">
                <h3 class="login-head"><i class="fa fa-lg fa-fw fa-user"></i><?= $data["page_title"]; ?></h3>
                <div class="form-group">
                    <label class="control-label">EMAIL</label>
                    <input class="form-control" id="txtEmail" name="txtEmail" type="email" placeholder="Email" autofocus>
                </div>
                <div class="form-group">
                    <label class="control-label">NICK</label>
                    <input class="form-control" id="txtNick" name="txtNick" type="text" placeholder="Nick" autofocus>
                </div>
                <div class="form-group">
                    <label class="control-label">CONTRASENA</label>
                    <input class="form-control" id="txtPass" name="txtPass" type="password" placeholder="Contrasena">
                </div>
                <div class="form-group">
                    <label class="control-label">CONFIRMAR CONTRASENA</label>
                    <input class="form-control" id="txtPassConfirm" name="txtPassConfirm" type="password" placeholder="Contrasena">
                </div>
                <div class="form-group btn-container">
                    <button type="submit" class="btn btn-primary btn-block"><i class="fa fa-sign-in fa-lg fa-fw"></i>REGISTRAR</button>
                </div>
            </form>
        </div>
    </section>
    <script>
        const base_url = "<?= base_url(); ?>";
    </script>
    <!-- Essential javascripts for application to work-->
    <script src="<?= media(); ?>js/jquery-3.3.1.min.js"></script>
    <script src="<?= media(); ?>js/popper.min.js"></script>
    <script src="<?= media(); ?>js/bootstrap.min.js"></script>
    <script src="<?= media(); ?>js/main.js"></script>
    <!-- The javascript plugin to display page loading on top-->
    <script src="<?= media(); ?>js/plugins/pace.min.js"></script>
    <script type="text/javascript" src="<?= media(); ?>js/plugins/sweetalert.min.js"></script>
    <script src="<?= media(); ?><?= $data['script']; ?> "></script>
    <script type="text/javascript">
        // Login Page Flipbox control
        $('.login-content [data-toggle="flip"]').click(function() {
            $('.login-box').toggleClass('flipped');
            return false;
        });
    </script>
</body>

</html>