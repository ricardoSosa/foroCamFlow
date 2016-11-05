<?php

  //Clase que maneja las funciones elementales de una base de datos.

  class Manejador_bd {

    const BASE_DATOS = 'mysql:host=mysql.hostinger.mx; dbname=u587651001_foroc';
    const USUARIO = 'u587651001_rechi';
    const CONTRASEÑA = 'EayCH8z1vo';

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

    public function insertar( $nombre_tabla, $atributos, $valores ) {
      $numero_atributos = count($datos);
      $attrib1 = $atributos[ 'attrib1' ];
      $val1 = $valores[ 'valor1' ];

      switch( $numero_atributos ) {
        case 1:
          $consulta = "INSERT INTO
            $nombre_tabla ( $attrib1 ) VALUES
            ( :valor1 )";
          $datos_elemento = array(
            ':valor1' => $datos[ 'valor1' ] );
          break;

        case 2:
          $attrib2 = $atributos[ 'atrib2' ];
          $val2 = $valores[ 'valor2' ];
          $consulta = "INSERT INTO
            equipos ( $attrib1, $attrib2 ) VALUES
            ( :valor1, :valor2 )";
          $datos_elemento = array(
            ':valor1' => $valores[ 'valor1' ],
            ':valor2' => $valores[ 'valor2' ] );
          break;

        case 3:
          $attrib2 = $atributos[ 'atrib2' ];
          $val2 = $valores[ 'valor2' ];
          $attrib3 = $atributos[ 'atrib3' ];
          $val3 = $valores[ 'valor3' ];
          $consulta = "INSERT INTO
            componentes ( $attrib1, $attrib2, $attrib3 ) VALUES
            ( :valor1, :valor2, :valor3 )";
          $datos_elemento = array(
            ':valor1' => $valores[ 'valor1' ],
            ':valor2' => $valores[ 'valor2' ],
            ':valor3' => $valores[ 'valor3' ] );
          break;
      }

      //Se prepara la consulta y se realiza la inserción.

      $resultado = $this->conexion->prepare( $consulta );
      $resultado->execute( $datos_elemento );
    }

    //Método que modifica información de las tablas de la base de datos.

    public function modificar( $nombre_tabla, $atributos, $valores ) {
      $atrib_modificar = $atributos['atrib_modificar'];
      $atrib_identificar = $atributos[ 'atrib_identificar' ];
      $valor_modificar = $valores[ 'valor_modificar' ];
      $valor_identificar = $valores[ 'valor_identificar' ];
      $consulta = "UPDATE $nombre_tabla SET $atrib_modificar = :dato_nuevo WHERE
        $atrib_identificar = :id";
      $datos_elemento = array(
        ':dato_nuevo' => $valor_modificar,
        ':id' => $valor_identificar );

      $resultado = $this->conexion->prepare( $consulta );
      $resultado->execute( $datos_elemento );
    }

    //Método que elimina elementos de las tablas de la base de datos.

    public function eliminar( $nombre_tabla, $atributo, $valor) {
      $consulta = "DELETE FROM $nombre_tabla WHERE $atributo = :valor";
      $datos_elemento = array( ':valor' => $valor );

      $resultado = $this->conexion->prepare( $consulta );
      $resultado->execute( $datos_elemento );
    }

    /*Método que consulta información de las tablas de la base de datos y
    retorna los datos solicitados.*/

    public function consultar_informacion( $nombre_tabla, $datos_consulta, $join) {
      switch( $datos_consulta[ 'tipo_consulta' ] ){
        case 'lista':
          $consulta = "SELECT * FROM $nombre_tabla";
          break;

        case 'especifico':
          $atributo = $datos_consulta[ 'atributo' ];
          $valor = $datos_consulta[ 'valor' ];
          if( $join ){
            $tabla_sec = $datos_consulta[ 'tabla_sec' ];
            $consulta = "SELECT * FROM $nombre_tabla INNER JOIN $tabla_sec WHERE
            $atributo = $valor";
          } else{
              $consulta = "SELECT * FROM $nombre_tabla WHERE $atributo = $valor";
          }
      }

      $resultado = $this->conexion->query( $consulta );
      return $resultado;
    }

  }

?>
