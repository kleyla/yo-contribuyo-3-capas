  <!-- Sidebar menu-->
  <div class="app-sidebar__overlay" data-toggle="sidebar"></div>
  <aside class="app-sidebar">
          <div class="app-sidebar__user"><img class="app-sidebar__user-avatar" src="<?= media(); ?>images/uploads/usuario.svg" alt="User Image">
                  <div>
                          <p class="app-sidebar__user-name" style="text-transform: uppercase;"><?= $_SESSION['userData']['nick'] ?></p>
                          <p class="app-sidebar__user-designation"><?= $_SESSION['userData']['rol'] ?></p>
                  </div>
          </div>
          <ul class="app-menu">
                  <li><a class="app-menu__item <?php if($data['nav_dash']) { echo $data['nav_dash'];} ?>" href="<?= base_url(); ?>dashboard"><i class="app-menu__icon fa fa-dashboard"></i>
                                  <span class="app-menu__label">Dashboard</span></a></li>
                  <?php if ($_SESSION['userData']['rol'] == "Administrador") { ?>
                          <li><a class="app-menu__item <?php if($data['nav_usuarios']) { echo $data['nav_usuarios'];} ?>" href="<?= base_url(); ?>usuarios"><i class="app-menu__icon fa fa-user"></i>
                                          <span class="app-menu__label">Usuarios</span></a></li>
                  <?php } ?>
                  <li><a class="app-menu__item <?php if($data['nav_proyectos']) { echo $data['nav_proyectos'];} ?>" href="<?= base_url(); ?>proyectos"><i class="app-menu__icon fa fa-archive"></i>
                                  <span class="app-menu__label">Proyectos</span></a></li>
                  <?php if ($_SESSION['userData']['rol'] == "Administrador") { ?>
                          <li><a class="app-menu__item <?php if($data['nav_lenguajes']) { echo $data['nav_lenguajes'];} ?>" href="<?= base_url(); ?>lenguajes"><i class="app-menu__icon fa fa-code"></i>
                                          <span class="app-menu__label">Lenguajes</span></a></li>
                  <?php } ?>
                  <li><a class="app-menu__item <?php if($data['nav_articulos']) { echo $data['nav_articulos'];} ?>" href="<?= base_url(); ?>articulos"><i class="app-menu__icon fa fa-newspaper-o"></i>
                                  <span class="app-menu__label">Articulos</span></a></li>
                  <li><a class="app-menu__item <?php if($data['nav_favoritos']) { echo $data['nav_favoritos'];} ?>" href="<?= base_url(); ?>favoritos"><i class="app-menu__icon fa fa-heart"></i>
                                  <span class="app-menu__label">Mis favoritos</span></a></li>
                  <li><a class="app-menu__item <?php if($data['nav_dash']) { echo $data['nav_dash'];} ?>" href="<?= base_url(); ?>dashboard"><i class="app-menu__icon fa fa-file-code-o"></i>
                                  <span class="app-menu__label">Docs</span></a></li>

          </ul>
  </aside>