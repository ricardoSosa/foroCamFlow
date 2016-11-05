<?php

	include "Administrador_acceso.php";

	$administrador_acceso;



	validar_acceso();

	function validar_acceso(){

		$administrador_acceso = new Administrador_acceso();

		$nombreUsuario = $_POST[ 'nombre' ];
		$contraseña = $_POST[ 'contraseña' ];

		$contraseña_validar = $administrador_acceso->obtener_contra_usuario();

		if( !$contraseña_validar ){
			//hacer algo si es false
		}else{
			//la contraseña si esxiste
			$obj = new stdClass();
			$obj->status = true;

			echo json_encode($obj);

		}

	}

	function cerrar_sesion(){

	}



?>
