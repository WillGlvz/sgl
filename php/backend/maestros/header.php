<nav id="mn-menu" class="navbar navbar-default navbar-fixed-top">
  <div class="container ">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <li class="dropdown navbar-brand" style="list-style:none;">
        <a href="#" class="dropdown-toggle subtitulo g" style="color:#FFF; text-decoration:none;" data-toggle="dropdown" role="button" aria-expanded="false"><?php echo $_SESSION['nombre']; ?> <span class="caret"></span></a>
        <ul class="dropdown-menu" role="menu">
          <li><a href="http://localhost/SGL/admin/cpanel/update-img/<?php echo $_SESSION['id'] ?>">Modificar imagen</a></li>
          <li class="divider"></li>
          <li><a href="http://localhost/SGL/admin/log-out">Cerrar sesión</a></li>
        </ul>
      </li>
    </div>
      <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
        <ul class="nav navbar-nav navbar-right">
          <li><a href="http://localhost/SGL/admin/cpanel" class="page-scroll">Inicio</a></li>
          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Admin <span class="caret"></span></a>
            <ul class="dropdown-menu" role="menu">
              <li><a href="http://localhost/SGL/admin/cpanel/userprofiles">Tipos usuario</a></li>
              <li class="divider"></li>
              <li><a href="http://localhost/SGL/admin/cpanel/users">Administradores</a></li>
            </ul>
          </li>
          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Empresas <span class="caret"></span></a>
            <ul class="dropdown-menu" role="menu">
              <li><a href="http://localhost/SGL/admin/cpanel/enterprise">Gestor empresas</a></li>
              <li class="divider"></li>
              <li><a href="http://localhost/SGL/php/backend/mnt_empresas/chat_admin.php">Mensajeria</a></li>
            </ul>
          </li>
          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Mercancías <span class="caret"></span></a>
            <ul class="dropdown-menu" role="menu">
              <li><a href="http://localhost/SGL/admin/cpanel/dm-number">Números DM</a></li>
              <li class="divider"></li>
              <li><a href="http://localhost/SGL/admin/cpanel/freight-kinds">Tipos mercancías</a></li>
              <li class="divider"></li>
              <li><a href="http://localhost/SGL/admin/cpanel/freight">Mercancías</a></li>
            </ul>
          </li>
          <li><a href="http://localhost/SGL/admin/cpanel/update-password" class="page-scroll">Cambiar clave</a></li>
          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Frontend <span class="caret"></span></a>
            <ul class="dropdown-menu" role="menu">
              <li><a href="http://localhost/SGL/admin/cpanel/frontend-slider">Slider</a></li>
              <li class="divider"></li>
              <li><a href="http://localhost/SGL/admin/cpanel/frontend-description">Seccion empresarial</a></li>
              <li class="divider"></li>
              <li><a href="http://localhost/SGL/admin/cpanel/frontend-strategy">Estrategia</a></li>
              <li class="divider"></li>
              <li><a href="http://localhost/SGL/admin/cpanel/frontend-services">Seccion de servicios</a></li>
            </ul>
          </li>
          <li><a href="http://localhost/SGL/php/backend/documentacion/Manualdeusuario.pdf" class="page-scroll" target="_blank">Ayuda</a></li>
        </ul>
      </div>
    </div>
</nav>
