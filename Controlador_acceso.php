<?php

	include "Administrador_acceso.php";

	$administrador_acceso;

	validar_acceso();

	function validar_acceso() {
		$administrador_acceso = new Administrador_acceso();

		$matricula = $_POST[ 'matricula' ];
		$contraseña = $_POST[ 'contraseña' ];

		$aviso = new stdClass();

		$existe_matricula = $administrador_acceso->verificar_usuario();
		if( $existe_matricula ) {
			$existe_contraseña = $administrador_acceso->verificar_contra();
			if( $existe_contraseña ) {
				$aviso->estado_sesion = true;
			} else {
				$aviso->estado_sesion = false;
				$aviso->problema = 'contraseña no encontrada';
			}
		} else {
			$aviso->estado_sesion = false;
			$aviso->problema = 'matricula no encontrada';
		}

		echo json_encode($aviso);
	}

	public function iniciar_sesion() {
		$matricula = $_POST[ 'matricula' ];
		$tiempo_expiracion = time()+3600*24*7; //1 semana.
		setcookie( 'matricula', $matricula, $tiempo_expiracion, "/" );
	}

	public function cerrar_sesion() {

	}

?>
