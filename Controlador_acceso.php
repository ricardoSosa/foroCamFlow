<?php

	include "Administrador_acceso.php";

	$administrador_acceso;

	validar_acceso();

	function validar_acceso() {
		$administrador_acceso = new Administrador_acceso();

		$matricula = $_POST[ 'matricula' ];
		$contraseña = $_POST[ 'contraseña' ];

		$aviso = new stdClass();

		$usuario_correcto = $administrador_acceso->verificar_usuario();
		if( $usuario_correcto ) {
			$aviso->estado_sesion = true;
		} else {
			$aviso->estado_sesion = false;
		}

		echo json_encode($aviso);
	}

	public function iniciar_sesion() {
		session_start();

		$matricula = $_POST[ 'matricula' ];
		$_SESSION[ 'matricula' ] = $_POST[ 'matricula' ];
		$tiempo_expiracion = time()+3600*24*7; //1 semana.
		setcookie( 'matricula', $matricula, $tiempo_expiracion, "/" );
	}

	public function cerrar_sesion() {
		session_unset();
		session_destroy();
	}

?>
