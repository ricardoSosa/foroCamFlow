$(document).ready(function(){
  $(".menu-prin").hide();

  //$(".login").hide();
  $(".etiquetas").hide();
  $(".foros").hide();

  $(".eti").on("click", function() {
    $(".login").hide();
    $(".menu-prin").hide();
    $(".foros").hide();
    $(".etiquetas").show();
  });

  $(".logo").on("click", function(){
    $(".login").hide();
    $(".etiquetas").hide();
    $(".foros").hide();
    $(".menu-prin").show();
  });

  $(".foro").on("click", function(){
    $(".login").hide();
    $(".etiquetas").hide();
    $(".menu-prin").hide();
    $(".foros").show();
  });

  $(".loguear").on("click", function(){
    $.ajax({
      type: "POST",
      url: "../Administrador_usuarios.php",
      data:{operacion:"inicio-sesion", usuario:"alumno", matricula: $("#matricula-alumn").val(), contraseña: $("#contraseña-alumn").val()},
      success : function(data){
        console.log(data);
      }
    });
  });
});
