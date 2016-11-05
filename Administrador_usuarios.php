<?php

	include "Manejador_bd.php";

	//Clase que administra los datos de los usuarios.

	class Administrador_usuarios{

		private $manejador_bd;

		function __construct(){
			$this->manejador_bd = new Manejador_bd();
		}

		//Método que verifica si existe una matrícula en la base de datos.

		public function verificar_usuario( $matricula ) {
			$datos = array(
				'tipo_consulta' => especifico,
				'id' => $matricula );

			$usuario_existe = $this->manejador_bd->consultar_informacion(
			'usuarios', $datos_consulta );
			return usuario_existe;
		}

		//Método que verifica si la contraseña de un usuario es correcta.

		public function verificar_contra( $matricula, $contraseña ) {
			$datos_consulta = array(
				'tipo_consulta' => especifico,
				'id' => $matricula );
			$datos_usuario = $this->manejador_bd->consultar_informacion(
			'usuarios', $datos_consulta );

			if( $contraseña = $datos_usuario[ 'contraseña' ] )
				$contraseña_correcta = true;
			else
				$contraseña_correcta = false;

			return $contraseña_correcta;
		}

		//Ingresa un nuevo alumno en la tabla de alumnos y usuarios.

		public function agregar_nuevo_alumno( $datos ) {
			$datos_alumno = array(
				'attrib1' => $datos[ 'matricula' ],
				'attrib2' => $datos[ 'carrera' ] );
			$this->manejador_bd->insertar( 'alumnos', $datos_alumno );

			$this->agregar_usuario($datos);
		}

		//Ingresa un nuevo profesor en la tabla de profesores y usuarios.

		public function agregar_nuevo_profesor( $datos ) {
			$datos_profesor = array(
				'attrib1' => $datos[ 'matricula' ],
				'attrib2' => $datos[ 'carrera' ] );
			$this->manejador_bd->insertar( 'profesores', $datos_profesor );

			$this->agregar_usuario($datos);
		}

		//Ingresa un nuevo usuario a la tabla de usuarios.

		public function agregar_usuario( $datos ) {
			$datos_usuario = array(
				'attrib1' => $datos[ 'matricula' ],
				'attrib2' => $datos[ 'nombre' ],
				'attrib3' => $datos[ 'contraseña' ] );
			$this->manejador_bd->insertar( 'usuarios', $datos_usuario );
		}

		//Elimina un alumno de la base de datos.

		public function eliminar_alumno( $id_alumno ) {
			$this->manejador_bd->eliminar( 'usuarios', $id_alumno );
			$this->manejador_bd->eliminar( 'alumno', $id_alumno );
		}

		//Elimina un profesor de la base de datos.

		public function eliminar_profesor( $id_profesor ) {
			$this->manejador_bd->eliminar( 'usuarios', $id_profesor );
			$this->manejador_bd->eliminar( 'profesores', $id_profesor );
		}

	}

?>
