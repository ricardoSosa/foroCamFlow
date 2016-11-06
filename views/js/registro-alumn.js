$( document ).ready( function() {
  var ventana = new VentanaRegistro();
  var manejadorVentana = new ManejadorRegistro( ventana );

  var botonEnviar = ventana.botonRegistrar;
  botonEnviar.on( 'click', function() {
    var datosCorrectos = manejadorVentana.validarCamposVentana();

    if ( datosCorrectos ) {
      manejadorVentana.enviarDatos();
      window.location.href = "login-alumnos.html";
    } else {

      console.log('eror');

    }
  } );
} );

function VentanaRegistro() {
  this.nombreAlumn = $( '#nombre-alumn' );
  this.matriculaAlumn = $( '#matricula-alumn' );
  this.carreraAlumn = $( '#carrera-alumn' );
  this.contraseñaAlumn = $( '#contraseña-alumn' );
  this.botonRegistrar = $( '#registrar' );
  this.mensajeError = $( '#error' );
}

//------------------------------------------------------------------------------
// Clase ManejadorRegistro
//
// Clase encargada de todo lo necesario para poder hacer el registro-alumn
//------------------------------------------------------------------------------

/**
* Representa al manejador de la ventana registro-alumn
*@param {VentanaRegistro} ventana -  Ventana a manejar
*/
function ManejadorRegistro( ventana ) {

  /**
   * Representa la ventana de Registro
   *@ VentanaRegistro
   */
  this.ventana = ventana;

  /*Función encargada de validar los datos que mete el alumno*/
  this.validarCamposVentana = function() {
    var datosCorrectos = false;

    if ( ( ventana.nombreAlumn.val() != '' ) &&
         ( ventana.matriculaAlumn.val() != '' ) &&
         ( ventana.carreraAlumn.val() !='' ) &&
         ( ventana.contraseñaAlumn.val() != '' ) ) {
           datosCorrectos = true;
    } else {
      datosCorrectos = false;
    }

    return datosCorrectos;
  }

  this.enviarDatos = function() {
    $.ajax({
      type: "POST",
      url: "../Administrador_usuarios.php",
      data: {nombre: ventana.nombreAlumn.val(), contraseña: ventana.contraseñaAlumn.val(),carrera: ventana.carreraAlumn.val(), matricula: ventana.matriculaAlumn.val(), operacion:'registrar', usuario:'alumno'},
      success : function( data ){
        console.log(data);
      },
      error: function( error ){
        console.log(error);
      },
      done: function(){
        console.log('se envio esa wea');
      }
    });
  }



}
