/* 
                ▒█▄░▒█ █▀▀█ 　 █▀▀█ █▀▀█ █▀▀▄ █▀▀█ █▀▀█ █▀▀█ █▀▀ 　 
                ▒█▒█▒█ █░░█ 　 █▄▄▀ █░░█ █▀▀▄ █▄▄█ █▄▄▀ █▄▄█ ▀▀█ 　 
                ▒█░░▀█ ▀▀▀▀ 　 ▀░▀▀ ▀▀▀▀ ▀▀▀░ ▀░░▀ ▀░▀▀ ▀░░▀ ▀▀▀ 　 

                █▀▀ █░░ 　 █▀▀ █▀▀█ █▀▀▄ ░▀░ █▀▀▀ █▀▀█ 　 █▀▀▄ █▀▀ 
                █▀▀ █░░ 　 █░░ █░░█ █░░█ ▀█▀ █░▀█ █░░█ 　 █░░█ █▀▀ 
                ▀▀▀ ▀▀▀ 　 ▀▀▀ ▀▀▀▀ ▀▀▀░ ▀▀▀ ▀▀▀▀ ▀▀▀▀ 　 ▀▀▀░ ▀▀▀ 

                ▀▀█▀▀ █░░█ 　 █▀▀█ █▀▀█ █▀▀█ ░░▀ ░▀░ █▀▄▀█ █▀▀█ 
                ░░█░░ █░░█ 　 █░░█ █▄▄▀ █░░█ ░░█ ▀█▀ █░▀░█ █░░█ 
                ░░▀░░ ░▀▀▀ 　 █▀▀▀ ▀░▀▀ ▀▀▀▀ █▄█ ▀▀▀ ▀░░░▀ ▀▀▀▀ 
*/
function main() {

(function () {
   'use strict';
  	$('a.page-scroll').click(function() {
        if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname) {
          var target = $(this.hash);
          target = target.length ? target : $('[name=' + this.hash.slice(1) +']');
          if (target.length) {
            $('html,body').animate({
              scrollTop: target.offset().top - 40
            }, 900);
            return false;
          }
        }
      });
    
    $(window).bind('scroll', function() {
        var navHeight = $(window).height() - 100;
        if ($(window).scrollTop() > navHeight) {
            $('.navbar-default').addClass('on');
        } else {
            $('.navbar-default').removeClass('on');
        }
    });

    $('body').scrollspy({ 
        target: '.navbar-default',
        offset: 80
    })
}());
}

main();

function Enviar(){
  var correo = document.getElementById("correo").value;
  var asunto = document.getElementById("asunto").value;
  var mensaje = document.getElementById("mensaje").value;
  if (correo == "" || asunto == "" || mensaje == "") {
    swal("¡Campos en blanco!", "No puedes dejar campos en blanco", "warning");  
  }else{
    $.ajax({
        url: 'php/frontend/enviar.php',
        type: 'post', 
        dataType: 'json',
        data: {
            'g-recaptcha-response': grecaptcha.getResponse(),
            'txtmensaje': mensaje,
            'txtasunto': asunto,
            'txtcorreo': correo 
        },
        success: function(data) {
            if(data == 1){
              swal("¡Correo enviado!", "Tu correo ha sido enviado, te responderemos en unos momentos, gracias.", "success");
              setTimeout(function(){ window.location="index.php"; }, 3000);
            }else if(data == 2){
              swal("¡Captcha requerido!", "Debes confirmar el captcha.", "error");
            }
        },
        error: function(data){
            swal("¡Error!", "Al parecer a ocurrido un error.", "error");
            console.log(data);
        }
    });
  }
}