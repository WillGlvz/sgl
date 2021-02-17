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
            <a href="#" class="dropdown-toggle subtitulo g" style="color:#FFF; text-decoration:none;" data-toggle="dropdown" role="button" aria-expanded="false"><?php echo $_SESSION['name']; ?> <span class="caret"></span></a>
            <ul class="dropdown-menu" role="menu">
              <li><a href="../login/cerrar2.php">Cerrar sesión</a></li>
            </ul>
          </li>
    </div>
      <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
        <ul class="nav navbar-nav navbar-right">
          <li><a href="index.php" class="page-scroll">Inicio</a></li>
          <li><a href="elegir.php" class="page-scroll">Desprendimientos</a></li>
          <li><a href="actualizar.php" class="page-scroll">Editar información</a></li>
          <li><a href="#" class="page-scroll">Mercancías retiradas</a></li>      
        </ul>
      </div>
    </div>
</nav>