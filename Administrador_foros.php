<?php

  //Clase que administra los foros y sus componentes.

  class Administrador_foros {

    private $manejador_bd;

		function __construct(){
			$this->manejador_bd = new Manejador_bd();
		}

    //Método que crea un nuevo foro.

    public function crear_nuevo_foro( $datos ) {
      $atributos = array(
        'attrib1' => 'id',
        'attrib2' => 'nombre'
        'attrib3' => 'id_foro' );
      $valores = array(
        'valor1' => $datos[ 'id' ],
        'valor2' => $datos[ 'nombre' ],
        'valor3' => $datos[ 'id_foro' ] );
      $this->manejador_bd = insertar( 'foros', $atributos, $valores );
    }

    //Método que agrega un nuevo tema a un foro existente.

    public function agregar_nuevo_tema( $datos_tema, $id_foro ) {
      $atributos = array(
        'attrib1' => 'id',
        'attrib2' => 'nombre'
        'attrib3' => 'id_tema' );
      $valores = array(
        'valor1' => $datos_tema[ 'id' ],
        'valor2' => $datos_tema[ 'nombre' ],
        'valor3' => $datos_tema[ 'id_tema' ] );
      $this->manejador_bd = insertar( 'temas', $atributos, $valores );

      $atributos = array(
        'attrib1' => 'id_foro',
        'attrib2' => 'id_tema' );
      $valores = array(
        'valor1' => $datos_tema[ 'id_foro' ],
        'valor2' => $datos_tema[ 'id_tema' ] );
      $this->manejador_bd = insertar( 'temas_foros', $atributos, $valores );
    }

    //Método elimina un tema en un foro existente.

    public function eliminar_tema( $id ) {
      $this->manejador_bd = eliminar( 'temas', 'id', $id );
      $this->manejador_bd = eliminar( 'temas_foros', 'id_tema', $id );
    }

    //Método que elimina un foro.

    public function eliminar_foro( $id ) {
      $this->manejador_bd = eliminar( 'foros', 'id', $id );
      $this->manejador_bd = eliminar( 'temas_foros', 'id_foro', $id );
    }

  }

?>
