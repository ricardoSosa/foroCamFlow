<?php

	include "Manejador_bd.php";

	class Administrador_acceso{


		private $manejador_bd;

		function __construct(){
			$this->manejador_bd = new Manejador_bd();
		}

		public function obtener_contra_usuario(){

			$contraseña = $this->manejador_bd->leer_datos();

			return $contraseña;

		}


	}



?>
