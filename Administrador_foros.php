<?php

  //Clase que administra los foros y sus componentes.

  class Administrador_foros {

    private $manejador_bd;

		function __construct(){
			$this->manejador_bd = new Manejador_bd();
		}

    //Método que crea un nuevo foro.

    public function crear_nuevo_foro( $datos_foro ) {
      $this->manejador_bd = insertar( 'foros', $datos_foro );
    }

    //Método que agrega un nuevo tema a un foro existente.

    public function agregar_nuevo_tema( $datos_tema, $id_foro ) {
      $this->manejador_bd = insertar( 'temas', $datos_tema );

      $datos_tema_foro = array(
        'id_tema' => $datos_tema[ 'id_tema' ],
        'id_foro' => $id_foro );
      $this->manejador_bd = insertar( 'temas_foros', $datos_tema_foro );
    }

    //Método elimina un tema en un foro existente.

    public function eliminar_tema( $id_tema ) {
      $this->manejador_bd = eliminar( 'temas', $id_tema );
      $this->manejador_bd = eliminar( 'temas_foros', $id_tema );
    }

    //Método que elimina un foro.

    public function eliminar_foro( $id_foro ) {
      $this->manejador_bd = eliminar( 'foros', $id_foro );
      $this->manejador_bd = eliminar( 'temas_foros', $id_foro );
    }

  }

?>
