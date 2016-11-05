<?php

	include "ManejadorBD.php";

	class AdministradorAcceso{


		private $manejadorBD;

		function __construct(){
			$this->manejadorBD = new ManejadorBD();
		}

		public function obtenerContraUsuario(){

			$contraseña = $this->manejadorBD->leerDatos();

			return $contraseña;

		}


	}



?>