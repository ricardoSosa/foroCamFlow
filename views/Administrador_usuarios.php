<?php

	include "Manejador_bd.php";


	$admin = new Administrador_usuarios();

	$operacion = $_POST['operacion'];
	$usuario = $_POST['usuario'];

	switch ( $operacion ) {
		case 'registrar':
			switch ($usuario) {
				case 'alumno':
				$datos = array('matricula' => $_POST[ 'matricula' ], 'contraseña' => $_POST[ 'contraseña' ],
											 'carrera' => $_POST[ 'carrera' ], 'nombre' => $_POST['nombre']);


			 $admin->agregar_nuevo_alumno( $datos );
					break;

					case 'profesor':
					$datos = array('matricula' => $_POST[ 'matricula' ], 'contraseña' => $_POST[ 'contraseña' ],
												  'nombre' => $_POST['nombre']);


				 $admin->agregar_nuevo_profesor( $datos );
					break;

				default:
					# code...
					break;
			}
			break;

		case 'inicio-sesion':
			switch ($usuario) {
				case 'alumno':
					# code...
					$datos = array('matricula' => $_POST['matricula'] , 'contraseña' => $_POST['contraseña'] );
					$resultado = $admin->verificar_contra($datos['matricula'], $datos['contraseña']);
					echo $resultado;
					break;

				default:
					# code...
					break;
			}
		break;

		default:
			# code...
			break;
	}





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

			$resultado = $this->manejador_bd->consultar_informacion(
			'usuarios', $datos_consulta );

			if( $resultado == false ){
				$usuario_existe = false;
			} else {
				$usuario_existe = true;
			}
			return $usuario_existe;
		}

		//Método que verifica si la contraseña de un usuario es correcta.

		public function verificar_contra( $matricula, $contraseña ) {
			$datos_consulta = array(
				'tipo_consulta' => 'especifico',
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
			$atributos = array(
				'attrib1' => 'matricula',
				'attrib2' => 'carrera' );
			$valores = array(
				'valor1' => $datos[ 'matricula' ],
				'valor2' => $datos[ 'carrera' ] );
			$this->manejador_bd->insertar( 'alumnos', $atributos, $valores );

			$this->agregar_usuario($datos);
		}

		//Ingresa un nuevo profesor en la tabla de profesores y usuarios.

		public function agregar_nuevo_profesor( $datos ) {
			$datos_profesor = array(
				'attrib1' => 'matricula' );
				$valores = array(
					'valor1' => $datos[ 'matricula' ] );
			$this->manejador_bd->insertar( 'profesores', $datos_profesor, $valores );

			$this->agregar_usuario($datos);
		}

		//Ingresa un nuevo usuario a la tabla de usuarios.

		public function agregar_usuario( $datos ) {
			$atributos = array(
				'attrib1' => 'matricula',
				'attrib2' => 'nombre',
				'attrib3' => 'contraseña' );
			$valores = array(
				'valor1' => $datos[ 'matricula' ],
				'valor2' => $datos[ 'nombre' ],
				'valor3' => $datos[ 'contraseña' ] );
			$this->manejador_bd->insertar( 'usuarios', $atributos, $valores);
		}

		//Elimina un alumno de la base de datos.

		public function eliminar_alumno( $id ) {
			$this->manejador_bd->eliminar( 'usuarios', 'matricula', $id );
			$this->manejador_bd->eliminar( 'alumno', 'matricula', $id );
		}

		//Elimina un profesor de la base de datos.

		public function eliminar_profesor( $id ) {
			$this->manejador_bd->eliminar( 'usuarios', 'matricula', $id );
			$this->manejador_bd->eliminar( 'profesores', 'matricula', $id );
		}

	}

?>
