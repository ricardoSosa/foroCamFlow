<?php

  //Clase que maneja las funciones elementales de una base de datos.

  class Manejador_bd {

    const BASE_DATOS = 'mysql:host=localhost; dbname=proyecto_ces';
    const USUARIO = 'root';
    const CONTRASEÑA = '';

    private $conexion;

    function __construct() {
      $this->realizar_conexion();
      $this->conexion->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
    }

     //Método que ingresa a la base de datos y guarda la conexión.

    private function realizar_conexion() {
      $this->conexion = new PDO( BASE_DATOS, USUARIO, CONTRASEÑA );

      //Consulta de manejo del utf8, para admitir símbolos extraños.

      $consulta_utf8 = "SET CHARACTER SET utf8";
      $this->conexion->exec( $consulta_utf8 );
    }

    /*Método que inserta elementos nuevos a las tablas de la base de datos según
    el tipo de inserción.*/

    public function insertar( $nombre_tabla, $datos ) {
      $numero_atributos = count($datos);

      switch( $numero_atributos ) {
        case 1:
          $consulta = "INSERT INTO
            $nombre_tabla ( attrib1 ) VALUES
            ( :attrib1 )";
          $datos_elemento = array(
            ':attrib1' => $datos[ 'attrib1' ] );
          break;

        case 2:
          $consulta = "INSERT INTO
            equipos ( attrib1, attrib2 ) VALUES
            ( :attrib1, :attrib2 )";
          $datos_elemento = array(
            ':attrib1' => $datos[ 'attrib1' ],
            ':attrib2' => $datos[ 'attrib2' ] );
          break;

        case 3:
          $consulta = "INSERT INTO
            componentes ( attrib1, attrib2, attrib3 ) VALUES
            ( :attrib1, :attrib2, :attrib3 )";
          $datos_elemento = array(
            ':attrib1' => $datos[ 'attrib1' ],
            ':attrib2' => $datos[ 'attrib2' ],
            ':attrib3' => $datos[ 'attrib3' ] );
          break;
      }

      //Se prepara la consulta y se realiza la inserción.

      $resultado = $this->conexion->prepare( $consulta );
      $resultado->execute( $datos_elemento );
    }

    //Método que modifica información de las tablas de la base de datos.

    public function modificar( $nombre_tabla, $datos ) {
      $atrib_modificar = $datos['atrib_modificar'];
      $consulta = "UPDATE $nombre_tabla SET $atrib_modificar = :dato_nuevo WHERE
        id = :id";
      $datos_elemento = array(
        ':dato_nuevo' => $datos[ 'dato_nuevo' ],
        ':id' => $datos[ 'id' ] );

      $resultado = $this->conexion->prepare( $consulta );
      $resultado->execute( $datos_elemento );
    }

    //Método que elimina elementos de las tablas de la base de datos.

    public function eliminar( $nombre_tabla, $id ) {
      $consulta = "DELETE FROM $nombre_tabla WHERE id = :id";
      $datos_elemento = array( 'id' => $id );

      $resultado = $this->conexion->prepare( $consulta );
      $resultado->execute( $datos_elemento );
    }

    /*Método que consulta información de las tablas de la base de datos y
    retorna los datos solicitados.*/

    public function consultar_informacion( $nombre_tabla, $datos_consulta ) {
      switch( $datos_consulta[ 'tipo_consulta' ] ){
        case 'lista':
          $consulta = "SELECT * FROM $nombre_tabla";
          break;

        case 'especifico':
          $id = $datos_consulta[ 'id' ];
          if( $nombre_tabla == 'alumnos' || $nombre_tabla == 'profesores') {
            $consulta = "SELECT * FROM $nombre_tabla INNER JOIN usuarios WHERE
            id = $id";
          } else if( $nombre_tabla == 'preguntas' ||
            $nombre_tabla == 'respuestas' || $nombre_tabla == 'anuncios') {
              $consulta = "SELECT * FROM $nombre_tabla INNER JOIN publicaciones WHERE
              id = $id";
          } else {
              $consulta = "SELECT * FROM $nombre_tabla WHERE id = $id";
          }
      }

      $resultado = $this->conexion->query( $consulta );
      return $resultado;
    }

  }

?>
