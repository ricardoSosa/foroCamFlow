<?php

	include "AdministradorAcceso.php";

	$administradorAcceso;

	
	
	validarAcceso();

	function validarAcceso(){

		$administradorAcceso = new AdministradorAcceso();

		$nombreUsuario = $_POST['nombre'];
		$contraseña = $_POST['contraseña'];

		$contraseñaValidar = $administradorAcceso->obtenerContraUsuario();

		if(!$contraseñaValidar){
			//hacer algo si es false
		}else{
			//la contraseña si esxiste
			$obj = new stdClass();
			$obj->status = true;

			echo json_encode($obj);

		}

	}

	function cerrarSesion(){

	}



?>