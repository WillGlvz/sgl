<!--
                                          ▒█▄░▒█ █▀▀█ 　 █▀▀█ █▀▀█ █▀▀▄ █▀▀█ █▀▀█ █▀▀█ █▀▀ 　 
                                          ▒█▒█▒█ █░░█ 　 █▄▄▀ █░░█ █▀▀▄ █▄▄█ █▄▄▀ █▄▄█ ▀▀█ 　 
                                          ▒█░░▀█ ▀▀▀▀ 　 ▀░▀▀ ▀▀▀▀ ▀▀▀░ ▀░░▀ ▀░▀▀ ▀░░▀ ▀▀▀ 　 

                                          █▀▀ █░░ 　 █▀▀ █▀▀█ █▀▀▄ ░▀░ █▀▀▀ █▀▀█ 　 █▀▀▄ █▀▀ 
                                          █▀▀ █░░ 　 █░░ █░░█ █░░█ ▀█▀ █░▀█ █░░█ 　 █░░█ █▀▀ 
                                          ▀▀▀ ▀▀▀ 　 ▀▀▀ ▀▀▀▀ ▀▀▀░ ▀▀▀ ▀▀▀▀ ▀▀▀▀ 　 ▀▀▀░ ▀▀▀ 

                                          ▀▀█▀▀ █░░█ 　 █▀▀█ █▀▀█ █▀▀█ ░░▀ ░▀░ █▀▄▀█ █▀▀█ 
                                          ░░█░░ █░░█ 　 █░░█ █▄▄▀ █░░█ ░░█ ▀█▀ █░▀░█ █░░█ 
                                          ░░▀░░ ░▀▀▀ 　 █▀▀▀ ▀░▀▀ ▀▀▀▀ █▄█ ▀▀▀ ▀░░░▀ ▀▀▀▀ 
-->
<!DOCTYPE html>
<html lang="es">
<head>
	<title>SGL</title>
  <!-- Se enlaza por medio de la etiqueta PHP, a un archivo externo que contiene los enlaces a las hojas
        de estilo y de JavaScript
        http://www.alcancelibre.org/staticpages/index.php/18-como-apache-htaccess
        -->
  <?php include 'php/frontend/head.php'; include 'php/frontend/query_frontend.php'; ?>
  <script type="text/javascript">
    var onloadCallback = function() {
      grecaptcha.render('html_element', {
        'sitekey' : '6LfKfQMTAAAAAKuUOHc0YJFEjp7WeCUBfwmbs8VC'
      });
    };
  </script>
</head>
<body>
  <!-- Se enlaza por medio de la etiqueta PHP, a un archivo externo que contiene el codigo HTML del Header -->
  <?php include 'php/frontend/header.php'; ?>
  <!-- Slider dinamico utilizando la libreria wowslider.js -->
  <div id="mn-home">
      <div id="wowslider-container1">
          <div class="ws_images"><ul>
                  <li><img src="img/<?php echo $result['url_imagen']; ?>" alt="banner" title="banner" id="wows1_0"/></li>
                  <li><img src="img/<?php echo $result2['url_imagen']; ?>" alt="banner2" title="banner2" id="wows1_1"/></li>
                  <li><img src="img/<?php echo $result3['url_imagen']; ?>" alt="banner3" title="banner3" id="wows1_2"/></li>
                  <li><img src="img/<?php echo $result4['url_imagen']; ?>" alt="banner4" title="banner4" id="wows1_3"/></li>
              </ul></div>
          <div class="ws_bullets"><div>
                  <a href="#" title="banner"><span><img src="img/tooltips/banner.jpg" alt="banner"/>1</span></a>
                  <a href="#" title="banner2"><span><img src="img/tooltips/banner2.jpg" alt="banner2"/>2</span></a>
                  <a href="#" title="banner3"><span><img src="img/tooltips/banner3.jpg" alt="banner3"/>3</span></a>
                  <a href="#" title="banner4"><span><img src="img/tooltips/banner4.jpg" alt="banner4"/>4</span></a>
              </div></div>
          <div class="ws_shadow"></div>
      </div>
  </div>
  <!-- Seccion de la empresa en sí -->
  <div id="mn-empresa" style="background-color:#F0E7C0;">
    <br><br>
    <div class="container">
      <div class="ro">
        <div class="col-md-6">
          <br><br><br>
          <img src="img/<?php echo $result5['img_seccion']; ?>" class="img-responsive">
        </div>
        <div class="col-md-6">
          <h1 class="text-center letraa2"><?php echo utf8_encode($result5['titulo_seccion']); ?></h1>
          <p class="text-justify parra"><?php echo utf8_encode($result5['descripcion']); ?></p>
        </div>
      </div>
    </div>
    <br><br>
  </div>
  <!-- Seccion de la planificación estrategica es decir los valores, mision y vision de la empresa -->
  <div id="mn-estrategia" class="planif">
    <div class="overlay">
    <br><br>
    <div class="container">
      <div class="ro">
        <div class="col-md-12">
          <h1 class="text-center letraa2" style="color:#fff;"><?php echo utf8_encode($result8['titulo_seccion']); ?></h1>
          <br><br>
        </div>
        <div class="col-md-4">
          <img src="img/<?php echo $result6['img_seccion']; ?>" height="250" width="330" class="center-block img-responsive img-thumbnail">
          <h3 style="color:#fff;" class="text-center letraa"><strong><?php echo utf8_encode($result6['titulo_seccion']); ?></strong></h3>
          <p style="color:#fff;" class="text-justify parra"><?php echo utf8_encode($result6['descripcion']); ?></p>
        </div>
        <div class="col-md-4">
          <img src="img/<?php echo $result7['img_seccion']; ?>" height="250" width="330" class="center-block img-responsive img-thumbnail">
          <h3 style="color:#fff;" class="text-center letraa"><strong><?php echo utf8_encode($result7['titulo_seccion']); ?></strong></h3>
          <p style="color:#fff;" class="text-justify parra"><?php echo utf8_encode($result7['descripcion']); ?></p>
        </div>
        <div class="col-md-4">
          <img src="img/valores.jpg" height="250" width="330" class="center-block img-responsive img-thumbnail">
          <h3 style="color:#fff;" class="text-center letraa"><strong>Valores</strong></h3>
          <p class="bg-primary text-center parra"><?php echo utf8_encode($result9['valor']); ?></p>
          <p class="bg-success text-center parra"><?php echo utf8_encode($result10['valor']); ?></p>
          <p class="bg-info text-center parra"><?php echo utf8_encode($result11['valor']); ?></p>
          <p class="bg-warning text-center parra"><?php echo utf8_encode($result12['valor']); ?></p>
          <p class="bg-danger text-center parra"><?php echo utf8_encode($result13['valor']); ?></p>
          <?php if ($result14 == "") {
          }else{
            echo "<p class='bg-primary text-center parra'><?php echo utf8_encode($result14[valor]); ?></p>";
            } ?>
        </div>
      </div>
    </div>
    <br><br><br>
    </div>
  </div>
  <!-- Seccion de servicios donde se detallan los servicios que la empresa ofrece -->
  <div id="mn-servicios" style="background-color:#F0E7C0;">
    <br><br>
    <div class="container">
      <div class="ro">
        <h1 class="text-center letraa2">Servicios</h1>
        <br>
        <div class="col-md-6">
        <div role="tabpanel">
          <ul class="nav nav-tabs" role="tablist" id="myTab">
            <li role="presentation" class="active ta"><a href="#home" aria-controls="home" role="tab" data-toggle="tab" class="ja" id="as"><?php echo utf8_encode($result15['titulo_servicio']); ?></a></li>
            <li role="presentation" class="ta"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab" class="ju" id="as2"><?php echo utf8_encode($result17['titulo_servicio']); ?></a></li>
            <li role="presentation" class="ta"><a href="#messages" aria-controls="messages" role="tab" data-toggle="tab" class="ja" id="as3"><?php echo utf8_encode($result19['titulo_servicio']); ?></a></li>
            <li role="presentation" class="ta"><a href="#seguros" aria-controls="seguros" role="tab" data-toggle="tab" class="ju" id="as4"><?php echo utf8_encode($result21['titulo_servicio']); ?></a></li>
            <li role="presentation" class="ta"><a href="#permisos" aria-controls="permisos" role="tab" data-toggle="tab" class="jo" id="as5"><?php echo utf8_encode($result23['titulo_servicio']); ?></a></li>
          </ul>
          <div class="tab-content">
            <div role="tabpanel" class="tab-pane fade in active" id="home">
                <div class="panel panel-success">
                  <div class="panel-heading letraa3"><?php echo utf8_encode($result15['subtitulo_servicio']); ?></div>
                  <div class="panel-body">
                    <?php 
                      $rs = ""; 
                      foreach ($result16 as $key => $value) {
                        $rs .= utf8_encode("<p class='parra'><span class='icon-triangle-right' style='margin-right:10px;''></span>$value[servicio]</p>");
                      }
                      print($rs);
                    ?>
                  </div>
                </div>
            </div>
            <div role="tabpanel" class="tab-pane fade" id="profile">
                <div class="panel panel-primary">
                  <div class="panel-heading letraa3"><?php echo utf8_encode($result17['subtitulo_servicio']); ?></div>
                  <div class="panel-body">
                    <?php 
                      $rs = ""; 
                      foreach ($result18 as $key => $value) {
                        $rs .= utf8_encode("<p class='parra'><span class='icon-triangle-right' style='margin-right:10px;''></span>$value[servicio]</p>");
                      }
                      print($rs);
                    ?>
                  </div>
                </div>
            </div>
            <div role="tabpanel" class="tab-pane fade" id="messages">
                <div class="panel panel-success">
                  <div class="panel-heading letraa3"><?php echo utf8_encode($result19['subtitulo_servicio']); ?></div>
                  <div class="panel-body">
                    <?php 
                      $rs = ""; 
                      foreach ($result20 as $key => $value) {
                        $rs .= utf8_encode("<p class='parra'><span class='icon-triangle-right' style='margin-right:10px;''></span>$value[servicio]</p>");
                      }
                      print($rs);
                    ?>
                  </div>
                </div>
            </div>
            <div role="tabpanel" class="tab-pane fade" id="seguros">
                <div class="panel panel-primary">
                  <div class="panel-heading letraa3"><?php echo utf8_encode($result21['subtitulo_servicio']); ?></div>
                  <div class="panel-body">
                    <?php 
                      $rs = ""; 
                      foreach ($result22 as $key => $value) {
                        $rs .= utf8_encode("<p class='parra'><span class='icon-triangle-right' style='margin-right:10px;''></span>$value[servicio]</p>");
                      }
                      print($rs);
                    ?>
                  </div>
                </div>
            </div>
            <div role="tabpanel" class="tab-pane fade" id="permisos">
                <div class="panel panel-danger">
                  <div class="panel-heading letraa3"><?php echo utf8_encode($result23['subtitulo_servicio']); ?></div>
                  <div class="panel-body">
                    <?php 
                      $rs = ""; 
                      foreach ($result24 as $key => $value) {
                        $rs .= utf8_encode("<p class='parra'><span class='icon-triangle-right' style='margin-right:10px;''></span>$value[servicio]</p>");
                      }
                      print($rs);
                    ?>
                  </div>
                </div>
            </div>
          </div>
        </div>
        </div>
        <div class="col-md-6">
          <br><br><br>
          <img src="img/servicios.jpg" class="center-block img-responsive img-thumbnail">
        </div>
      </div>
    </div>
    <br><br>
  </div>
  <!-- Formulario de contacto -->
  <div id="mn-contacto" class="fon">
    <div class="overlay">
    <br><br>
    <div class="container">
      <div class="ro">
        <div class="col-md-8 col-md-offset-2">
          <h1 class="text-center letraa2" style="color:#fff;">Formulario de contacto</h1>
          <div class="linea">
          </div>
          <small style="color:#fff;"><p class="text-center">gerencia@sgl.com.sv</p></small>
          <br>
          <form method="post" onSubmit="Enviar(); return false;">
          <div class="col-md-6">
            <div class="form-group">
              <label>Dirección de correo</label>
              <input type="text" class="form-control" name="txtcorreo" id="correo" pattern="^([0-9a-zA-Z]([_.w]*[0-9a-zA-Z])*@([0-9a-zA-Z][-w]*[0-9a-zA-Z].)+([a-zA-Z]{2,9}.)+[a-zA-Z]{2,3})$" title="Ingrese un correo electrónico válido" placeholder="Ingrese su correo electronico">
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label>Asunto</label>
              <input type="text" class="form-control" name="txtasunto" id="asunto" placeholder="Ingrese su asunto">
            </div>
          </div>
          <div class="col-md-12">
            <div class="form-group">
              <label>Mensaje</label>
              <textarea class="form-control" rows="3" name="txtmensaje" id="mensaje" placeholder="Ingrese su mensaje"></textarea>
            </div>
            <div class="form-group">
              <div id="html_element"></div>
            </div>
          </div>
          <div class="col-md-3">
            <div class="form-group">
              <button type="submit" class="btn btn-info btn-block">Enviar</button>
            </div>
          </div>
        </form>
        <script src="https://www.google.com/recaptcha/api.js?onload=onloadCallback&render=explicit"async defer></script>
        </div>
      </div>
    </div>
    <br><br>
    </div>
  </div>
  <!-- Se enlaza por medio de la etiqueta PHP, a un archivo externo que contiene el Footer. -->
  <?php include 'php/frontend/footer.php'; ?>
  <!-- Se enlaza por medio de la etiqueta PHP, a un archivo externo que contienen los archivos JS que requieran uso
        mas avanzado del documento. -->
  <?php include 'php/frontend/scrbody.php'; ?>
  <script type="text/javascript">
    if (window.console) {
        console.log("Hola");
    };
  </script>
</body>
</html>
