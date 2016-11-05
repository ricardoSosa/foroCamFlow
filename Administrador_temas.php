<?php

  include "Manejador_bd.php";

  //Clase que administra los temas y sus publicaciones

  class Administrador_temas {

    private $manejador_bd;

    function __construct(){
			$this->manejador_bd = new Manejador_bd();
		}

    //Método que agrega una nueva pregunta en un tema.

    public function publicar_pregunta( $datos_pregunta ) {
      $this->manejador_bd->insertar( 'preguntas', $datos_pregunta );
      $this->manejador_bd->insertar( 'publicaciones', $datos_pregunta );
    }

    //Método que elimina una pregunta en un tema.

    public function eliminar_pregunta( $id_pregunta ) {
      $this->manejador_bd->insertar( 'preguntas', $id_pregunta );
      $this->manejador_bd->insertar( 'publicaciones', $id_pregunta );
    }

    //Método que agrega una respuesta en una pregunta.

    public function agregar_respuesta( $datos_respuesta ) {
      $this->manejador_bd->insertar( 'respuestas', $datos_respuesta );
      $this->manejador_bd->insertar( 'publicaciones', $datos_respuesta );
    }

    //Método que elimina una respuesta en una pregunta.

    public function eliminar_respuesta( $id_respuesta ) {
      $this->manejador_bd->insertar( 'respuestas', $id_respuesta );
      $this->manejador_bd->insertar( 'publicaciones', $id_respuesta );
    }

    //Método que marca una pregunta como favorita para un usuario.

    public function marcar_pregunta( $ids_usuario_pregunta ) {
      $this->manejador_bd->insertar( 'preguntas_favoritas', $ids_usuario_pregunta );
    }

    //Método que desmarca una pregunta como favorita para un usuario.

    public function desmarcar_pregunta( $id_pregunta ) {
      $this->manejador_bd->eliminar( 'preguntas_favoritas', $id_pregunta );
    }
  }

?>
