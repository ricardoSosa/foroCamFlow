$( document ).ready( function() {
  var ventana = new VentanaRegistro();
  var manejadorVentana = new ManejadorRegistro( ventana );

  var botonEnviar = ventana.botonRegistrar;
  botonEnviar.on( 'click', function() {
    var datosCorrectos = manejadorVentana.validarCamposVentana();

    if ( datosCorrectos ) {
      manejadorVentana.enviarDatos();
      window.location.href = "login-maestros.html";
    } else {

      console.log('eror');

    }
  } );
} );

function VentanaRegistro() {
  this.nombreProf = $( '#nombre-prof' );
  this.matriculaProf = $( '#matricula-prof' );
  this.contraseñaProf = $( '#contraseña-prof' );
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

    if ( ( ventana.nombreProf.val() != '' ) &&
         ( ventana.matriculaProf.val() != '' ) &&
         ( ventana.contraseñaProf.val() != '' ) ) {
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
      data: {nombre: ventana.nombreProf.val(), contraseña: ventana.contraseñaProf.val(), matricula: ventana.matriculaProf.val(), operacion:'registrar', usuario:'profesor'},
      success : function( data ){
        console.log(data);
      },
      error: function( error ){
        console.log(error);
      }
    });
  }



}
