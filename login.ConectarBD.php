<?php
	
	
	
	if ( empty( $Mensaje )== true ){
		$Mensaje="";
	}//fin empty( $Mensaje )== true 
	
	//Mostrar todo posible error que se produsca en pantalla
	error_reporting(E_ALL);
	ini_set("display_errors", 1);

	

	date_default_timezone_set("America/Mexico_City" ) ;
	$hora = date('H:i:s',time() ); //para restar una hora agregar los siguientes datos - 3600*date('I') 
	$FechHora = date("Y-m-d") . $hora;
	
	$today = new DateTime($FechHora);
	$FechaYHora=$today->format('Y-m-d H:i:s'); //formated today = '2011-03-09'
	
	if ( empty($mysqli ) == true ){ //Establer conexion con la base datos mysql solo si no se a creado conexion previa	

		
			error_reporting(E_ALL ^ E_WARNING);  //desactivar el mensaje de error, para evitar mostrar informacion que pueda ser utilizada por un atacante
			
			
			$mysqli = new mysqli ("127.0.0.1", "usuario", "SiComoNo", "BDprincipal");
			
			//Veficando conexion
			if ($mysqli->connect_error){
			
				echo "Error: Error al conectar a la base de datos, por favor comuniquese con su administrador de sistemas" 
			
				
				/* echo "Error: No se pudo conectar a MySQL." . PHP_EOL;
				echo "errno de depuración: " . mysqli_connect_errno() . PHP_EOL;
				echo "error de depuración: " . mysqli_connect_error() . PHP_EOL */;
				/* include_once("SistemaLocal.BD.Reconstruir.php");
				header('Location: SistemaLocal.ReconstruirBasedDeDatos.php'); */
				
				exit;
			}
			
			error_reporting(E_ALL); //Este parametro sirve para presentar en detalle los errores que se puedan presentar
			ini_set("display_errors", 1); //Este parametro sirve para presentar en detalle los errores que se puedan presentar

				
									 
	}//fin empty( $mysqli ) == true
				
	//*DEBUG*/ if(empty($_GET['Debug']) ==FALSE) $Mensaje.= "<br> Debug ".__FILE__." LINE ".__LINE__."<br>";
	

?>