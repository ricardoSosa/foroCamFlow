<?php

	include "Manejador_bd.php";

	class Administrador_acceso{

		private $manejador_bd;

		function __construct(){
			$this->manejador_bd = new Manejador_bd();
		}

		public function verificar_usuario( $matricula ) {
			$datos = array(
				'tipo_consulta' => especifico,
				'id' => $matricula );

			$usuario_existe = $manejador_bd->consultar_informacion(
			'usuarios', $datos_consulta );
			return usuario_existe;
		}

		public function verificar_contra( $contraseña ) {
			$datos = array(
				'tipo_consulta' => especifico,
				'id' => $matricula );

			$contraseña_bd = $manejador_bd->consultar_informacion(
			'usuarios', $datos_consulta );
			if( $contraseña = $contraseña_bd )
				$contraseña_correcta = true;
			else
				$contraseña_correcta = false;

			return $contraseña_correcta;
		}

	}

?>
