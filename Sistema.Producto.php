<<<<<<< HEAD
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
	
	include_once("ConectarBD.php");
	

		
		
	/*DEBUG*/ if(empty($_GET['Debug']) ==FALSE) $Mensaje.= "ACCION NO POST<br>";
	
		
	

	if ($_POST == TRUE){
		/*DEBUG*/ if(empty($_GET['Debug']) ==FALSE)	echo "Debug LINE ".__LINE__."  <br>"  ;
	
	
		if( empty($_POST['BotonGuardar']) == false){
			
			$ID= 0;
			
			if ( empty($_GET['ID'])==false ) {  //Extraer el numero de ID si esta disponible
				$ID= $_GET['ID'];
			}
			
			$ProductoNombre =strtolower(htmlspecialchars($_POST["TextNombreDeProducto"])); 
			$mysqli->query("START TRANSACTION"); //Esta intruccion crea una poliza de seguro, como medida de seguridad, cancela todas las acciones a la base de datos si se produce algun error
											
			//*********************************************************		
				//Verificar antes que el nombre del producto no este repetido
			//*********************************************************	
					/*DEBUG*/ if(empty($_GET['Debug']) ==FALSE)	echo "Debug LINE ".__LINE__."  <br>"  ;
						 
						
						$result = $mysqli->query("SELECT ID FROM tablaproductos WHERE Borrado = 0 AND LOWER (ProductoNombre) ='" . $ProductoNombre ."'"); 
						
						
						if ($result->num_rows > 0) {
							/*DEBUG*/ if(empty($_GET['Debug']) ==FALSE)	echo "Debug LINE ".__LINE__."  <br>"  ;
					
							while($fila = $result->fetch_assoc()) {
								//Si el id es del mims producto ni aplica esta condicion
								/*DEBUG*/ if(empty($_GET['Debug']) ==FALSE)	echo "Debug LINE ".__LINE__."  <br>"  ;
					
								if  ( $fila['ID'] != $ID   ){
									$_SESSION['MensajeBox'] = "No se puede registrar, Ya existe un producto con el mismo nombre [" . $ID ;
									goto SaltarRegistroDeProducto;
								}
								
							}//fin while
							
							
						}//fin $result->num_rows
			
		
			
			//*********************************************************		
				//Insertar un campo si no existe previamente.
			//*********************************************************	
					/*DEBUG*/ if(empty($_GET['Debug']) ==FALSE)	echo "Debug LINE ".__LINE__."  <br>"  ;
					
					if ( empty($_GET['ID'])==true ) {  //si no existe registro previo, se inserta en la base de datos, antes de se utilizado
																		 
						$sql = "insert  tablaproductos ( ProductoNombre) 
											  values ('-No Usar-')";
						
						if ($mysqli->query($sql) === TRUE) {
							//echo "Registro exitoso";
								
							$ID = $mysqli->insert_id;
							/*DEBUG*/ if(empty($_GET['Debug']) ==FALSE)	echo "Debug LINE ".__LINE__."  <br>"  ;	
								
						} else {
							echo   ' LINE = '.__LINE__.'  ' . $mysqli->error;
							$Error .=  ' LINE = '.__LINE__.'  ' .  $mysqli->error;
						}
						
												  
						
															  
					}else{//de $IDEncontrado
						$ID= $_GET['ID'];	
					}//fin $IDEncontrado
			
			//*********************************************************		
				//Actualizar los datos del campo
			//*********************************************************	
			
					$sql = "UPDATE  tablaproductos  SET 
														ProductoNombre ='" . $_POST["TextNombreDeProducto"] . "',
														Precio ='" . $_POST["TextPrecio"] ."'
												WHERE
														ID=" . $ID  ; 
															
					
					
					if ($mysqli->query($sql) === TRUE) {
							//echo "Registro exitoso";
								
							/*DEBUG*/ if(empty($_GET['Debug']) ==FALSE)	echo "Debug LINE ".__LINE__."  <br>"  ;
							$Alert ="El producto a sido registrado con exito";
							
					} else {
						echo   ' LINE = '.__LINE__.'  ' . $mysqli->error;
						$Error .=  ' LINE = '.__LINE__.'  ' .  $mysqli->error;
					}													
															

					if (empty ($Error) == true and empty ($php_errormsg) == true ){	
							/*DEBUG*/ if(empty($_GET['Debug']) ==FALSE)	echo "Debug LINE ".__LINE__."  <br>"  ;
							
							$mysqli->query("COMMIT");//esta instruccion termina la poliza de seguro, contra errores 
							//redirecionar pagina solo si no hay errores
							if ( empty( $_GET['Debug'] ) == true){
								/*DEBUG*/ if(empty($_GET['Debug']) ==FALSE)	echo "Debug LINE ".__LINE__. "  <br>"  ;
								//header('Location:   ' . $URLDestino  . $AgregadoURL);
								
							}else{//de  empty( $_GET['Debug'] ) == true
								
								/*DEBUG*/ if(empty($_GET['Debug']) ==FALSE)	echo "Debug LINE ".__LINE__. " Location: "  . $URLDestino  . "?". $AgregadoURL."  <br>"  ;
							}//fin  empty( $_GET['Debug'] ) == true
						}else{
							//se cancela todos los cambios a la base de datos, debido a que se produju un erorr
							$mysqli->query("ROLLBACK"); //esta accion aplica la poliza de seguro, y cancela todas las acciones realizadas a la base de datos
							
			
						}//fin $Error
			
SaltarRegistroDeProducto:		
			
			
		}//FIN  empty(]$_POST['BotonGuardar')
	
	}//FIN $_POST == TRUE
	
	
	
?>
<HTML>
<head>

<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
<title>Coffe shop Producto</title>

<style type="text/css"> 	          	 		
   		*  { margin: 0; padding: 0; text-align: center; font-family: arial; border: 0; }
        
       
    	body {font: 100% Verdana, Arial, Helvetica, sans-serif;background: black ;margin: 20;padding: 20;text-align: center; color: #000000; color:white;   }
    	#CuerpoFondo #PrimerCuadro {width: width: 90%;background: #FFFFFF;margin: 1 auto; border: 1px solid #000000; text-align: center;     }
       	#cabecera { width: 100%; background-color: black; color:#FFFFFF;  }
        #Columna  { width: 500px; height:80%;  background-color:black ; color: white; margin: 1 auto; /* los márgenes automáticos (conjuntamente con un ancho) centran la página */ }
		#Columna_BordeEntreColumnas { padding:20px;  border-radius: 25px;  background-color:  black  ;}
		#Columna_BordeInterior { padding:20px;  background-color: #333333 ;  border-radius: 15px;}
		#Columna_Elemento { background:#666666; border-radius: 15px; padding:15px;  }
        
        #pie  { clear:both; width: 100%; background-color: black; color:white; }
        
        h1,h2,h3,h4,h5,h6  { padding-bottom : 30px; }
    	input { height:25px; }
 
</style>



	<?php
	
	//*********************************************************		
		//AVISO DE ALERTA
	//*********************************************************
	
    /*DEBUG*/ if(empty($_GET['Debug']) ==FALSE)	echo "Debug LINE ".__LINE__."  <br>"  ;
    
        if(empty($Alert) ==FALSE){
    ?>		
            <script type="text/javascript">
            alert("<?php  echo $Alert ; ?>");	 
            </script>
        
    <?php 
        }
		
		//*********************************************************		
			//FIN- AVIOS DE ALERTA
		//*********************************************************
		
    ?>  
    
</head>


<body class="CuerpoFondo">
    <div id="PrimerCuadro"  >
        	
            <?php
       	     include_once("Sistema.Cabecera.php");

			?>
            
            <div id="Columna">
           			<div id="Columna_BordeEntreColumnas">
                        <div id="Columna_BordeInterior">
                            <h3>	
                            	Informacion de Producto
                                
                            </h3>
                            <div id="Columna_Elemento">
                               
									<?php
									/*DEBUG*/ if(empty($_GET['Debug']) ==FALSE)	echo "Debug LINE ".__LINE__."  <br>"  ;
									$NombreDeProducto = "";
									$Precio = "";
									
									if ( empty($_GET['ID'])==FALSE ) { 
										/*DEBUG*/ if(empty($_GET['Debug']) ==FALSE)	echo "Debug LINE ".__LINE__."  <br>"  ;

                                     	$result = $mysqli->query("SELECT * FROM TablaProductos WHERE ID = ". $_GET['ID']); 
							
										if ($result->num_rows == 1) {
												
												/*DEBUG*/ if(empty($_GET['Debug']) ==FALSE)	echo "Debug LINE ".__LINE__."  <br>"  ;
												
												while($fila = $result->fetch_assoc()) {	
												
													$NombreDeProducto 	= $fila["ProductoNombre"]; 
															$Precio 	= $fila["Precio"]; 
												
												}// Foin while
												
												
												
										}//Fin $result->num_row
									}	//fn empty($_GET['ID'])							
									
									?>
		
            
                                    <form  name="DatosFormulario" id="DatosFormulario"  method="post" >
                                    
                                    	
                                    
                                    	<br>
                                        		Nombre del producto
										<br>
                                        		<input  name="TextNombreDeProducto" type="text" size="45"  value="<?php echo $NombreDeProducto; ?>"  style="text-align:left"/> 
                                        <br>
                                        
                                        <br>
                                                Precio
										<br>
                                                <input name="TextPrecio" type="text" size="40" maxlength="255"  style="width:100px;" autocomplete="off"  value="<?php echo $Precio; ?>" />
                                                
                                         <br>
                                         
                                         <br>
                                         		Imagen
                                         <br>
                                         		<input name="archivo" type="file" size="35"   />
                                         
                                         
                                         <br>
                                         <br>
                                    			<img src="logo.jpg" width="30" height="30"  >
                                    	 <br>
                                         
                                         	 	<input  type="submit" id="BotonGuardar" name="BotonGuardar" value="Guardar"  onclick="return ValidarFormulario();" />
                                                
													<script type="text/javascript">
                                                
															function ValidarFormulario(){
																
																	var x=document.forms["DatosFormulario"]["TextNombreDeProducto"].value;
																	if (x==null || x=="") {
																	  alert("Falta el nombre del producto");
																	  return false;
																	}  
																
																	var x=document.forms["DatosFormulario"]["TextPrecio"].value;
																	if (x==null || x=="") {
																	  alert("Falta el precio del producto");
																	  return false;
																	}  
																
															}	
													</script>                                             
                                                	
                                         <br>
                                         
                                    </form>
                                
                            </div><! --Fin  Columna_Elemento -->
                        </div><! --Fin  Columna_BordeInterior -->
					</div><! --Fin  Columna_BordeEntreColumnas -->
            </div> <! --Fin  Columna -->
           
            
            
            
            
            
            
        
        
       
    </div> <! --Fin  PrimerCuadro -->


</body><! -- Fin CuerpoFondo -->
</HTML>
=======
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
	
	include_once("ConectarBD.php");
	

		
		
	/*DEBUG*/ if(empty($_GET['Debug']) ==FALSE) $Mensaje.= "ACCION NO POST<br>";
	
		
	

	if ($_POST == TRUE){
		/*DEBUG*/ if(empty($_GET['Debug']) ==FALSE)	echo "Debug LINE ".__LINE__."  <br>"  ;
	
	
		if( empty($_POST['BotonGuardar']) == false){
			
			$ID= 0;
			
			if ( empty($_GET['ID'])==false ) {  //Extraer el numero de ID si esta disponible
				$ID= $_GET['ID'];
			}
			
			$ProductoNombre =strtolower(htmlspecialchars($_POST["TextNombreDeProducto"])); 
			$mysqli->query("START TRANSACTION"); //Esta intruccion crea una poliza de seguro, como medida de seguridad, cancela todas las acciones a la base de datos si se produce algun error
											
			//*********************************************************		
				//Verificar antes que el nombre del producto no este repetido
			//*********************************************************	
					/*DEBUG*/ if(empty($_GET['Debug']) ==FALSE)	echo "Debug LINE ".__LINE__."  <br>"  ;
						 
						
						$result = $mysqli->query("SELECT ID FROM tablaproductos WHERE Borrado = 0 AND LOWER (ProductoNombre) ='" . $ProductoNombre ."'"); 
						
						
						if ($result->num_rows > 0) {
							/*DEBUG*/ if(empty($_GET['Debug']) ==FALSE)	echo "Debug LINE ".__LINE__."  <br>"  ;
					
							while($fila = $result->fetch_assoc()) {
								//Si el id es del mims producto ni aplica esta condicion
								/*DEBUG*/ if(empty($_GET['Debug']) ==FALSE)	echo "Debug LINE ".__LINE__."  <br>"  ;
					
								if  ( $fila['ID'] != $ID   ){
									$_SESSION['MensajeBox'] = "No se puede registrar, Ya existe un producto con el mismo nombre [" . $ID ;
									goto SaltarRegistroDeProducto;
								}
								
							}//fin while
							
							
						}//fin $result->num_rows
			
		
			
			//*********************************************************		
				//Insertar un campo si no existe previamente.
			//*********************************************************	
					/*DEBUG*/ if(empty($_GET['Debug']) ==FALSE)	echo "Debug LINE ".__LINE__."  <br>"  ;
					
					if ( empty($_GET['ID'])==true ) {  //si no existe registro previo, se inserta en la base de datos, antes de se utilizado
																		 
						$sql = "insert  tablaproductos ( ProductoNombre) 
											  values ('-No Usar-')";
						
						if ($mysqli->query($sql) === TRUE) {
							//echo "Registro exitoso";
								
							$ID = $mysqli->insert_id;
							/*DEBUG*/ if(empty($_GET['Debug']) ==FALSE)	echo "Debug LINE ".__LINE__."  <br>"  ;	
								
						} else {
							echo   ' LINE = '.__LINE__.'  ' . $mysqli->error;
							$Error .=  ' LINE = '.__LINE__.'  ' .  $mysqli->error;
						}
						
												  
						
															  
					}else{//de $IDEncontrado
						$ID= $_GET['ID'];	
					}//fin $IDEncontrado
			
			//*********************************************************		
				//Actualizar los datos del campo
			//*********************************************************	
			
					$sql = "UPDATE  tablaproductos  SET 
														ProductoNombre ='" . $_POST["TextNombreDeProducto"] . "',
														Precio ='" . $_POST["TextPrecio"] ."'
												WHERE
														ID=" . $ID  ; 
															
					
					
					if ($mysqli->query($sql) === TRUE) {
							//echo "Registro exitoso";
								
							/*DEBUG*/ if(empty($_GET['Debug']) ==FALSE)	echo "Debug LINE ".__LINE__."  <br>"  ;
							$Alert ="El producto a sido registrado con exito";
							
					} else {
						echo   ' LINE = '.__LINE__.'  ' . $mysqli->error;
						$Error .=  ' LINE = '.__LINE__.'  ' .  $mysqli->error;
					}													
															

					if (empty ($Error) == true and empty ($php_errormsg) == true ){	
							/*DEBUG*/ if(empty($_GET['Debug']) ==FALSE)	echo "Debug LINE ".__LINE__."  <br>"  ;
							
							$mysqli->query("COMMIT");//esta instruccion termina la poliza de seguro, contra errores 
							//redirecionar pagina solo si no hay errores
							if ( empty( $_GET['Debug'] ) == true){
								/*DEBUG*/ if(empty($_GET['Debug']) ==FALSE)	echo "Debug LINE ".__LINE__. "  <br>"  ;
								//header('Location:   ' . $URLDestino  . $AgregadoURL);
								
							}else{//de  empty( $_GET['Debug'] ) == true
								
								/*DEBUG*/ if(empty($_GET['Debug']) ==FALSE)	echo "Debug LINE ".__LINE__. " Location: "  . $URLDestino  . "?". $AgregadoURL."  <br>"  ;
							}//fin  empty( $_GET['Debug'] ) == true
						}else{
							//se cancela todos los cambios a la base de datos, debido a que se produju un erorr
							$mysqli->query("ROLLBACK"); //esta accion aplica la poliza de seguro, y cancela todas las acciones realizadas a la base de datos
							
			
						}//fin $Error
			
SaltarRegistroDeProducto:		
			
			
		}//FIN  empty(]$_POST['BotonGuardar')
	
	}//FIN $_POST == TRUE
	
	
	
?>
<HTML>
<head>

<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
<title>Coffe shop Producto</title>

<style type="text/css"> 	          	 		
   		*  { margin: 0; padding: 0; text-align: center; font-family: arial; border: 0; }
        
       
    	body {font: 100% Verdana, Arial, Helvetica, sans-serif;background: black ;margin: 20;padding: 20;text-align: center; color: #000000; color:white;   }
    	#CuerpoFondo #PrimerCuadro {width: width: 90%;background: #FFFFFF;margin: 1 auto; border: 1px solid #000000; text-align: center;     }
       	#cabecera { width: 100%; background-color: black; color:#FFFFFF;  }
        #Columna  { width: 500px; height:80%;  background-color:black ; color: white; margin: 1 auto; /* los márgenes automáticos (conjuntamente con un ancho) centran la página */ }
		#Columna_BordeEntreColumnas { padding:20px;  border-radius: 25px;  background-color:  black  ;}
		#Columna_BordeInterior { padding:20px;  background-color: #333333 ;  border-radius: 15px;}
		#Columna_Elemento { background:#666666; border-radius: 15px; padding:15px;  }
        
        #pie  { clear:both; width: 100%; background-color: black; color:white; }
        
        h1,h2,h3,h4,h5,h6  { padding-bottom : 30px; }
    	input { height:25px; }
 
</style>



	<?php
	
	//*********************************************************		
		//AVISO DE ALERTA
	//*********************************************************
	
    /*DEBUG*/ if(empty($_GET['Debug']) ==FALSE)	echo "Debug LINE ".__LINE__."  <br>"  ;
    
        if(empty($Alert) ==FALSE){
    ?>		
            <script type="text/javascript">
            alert("<?php  echo $Alert ; ?>");	 
            </script>
        
    <?php 
        }
		
		//*********************************************************		
			//FIN- AVIOS DE ALERTA
		//*********************************************************
		
    ?>  
    
</head>


<body class="CuerpoFondo">
    <div id="PrimerCuadro"  >
        	
            <?php
       	     include_once("Sistema.Cabecera.php");

			?>
            
            <div id="Columna">
           			<div id="Columna_BordeEntreColumnas">
                        <div id="Columna_BordeInterior">
                            <h3>	
                            	Informacion de Producto
                                
                            </h3>
                            <div id="Columna_Elemento">
                               
									<?php
									/*DEBUG*/ if(empty($_GET['Debug']) ==FALSE)	echo "Debug LINE ".__LINE__."  <br>"  ;
									$NombreDeProducto = "";
									$Precio = "";
									
									if ( empty($_GET['ID'])==FALSE ) { 
										/*DEBUG*/ if(empty($_GET['Debug']) ==FALSE)	echo "Debug LINE ".__LINE__."  <br>"  ;

                                     	$result = $mysqli->query("SELECT * FROM TablaProductos WHERE ID = ". $_GET['ID']); 
							
										if ($result->num_rows == 1) {
												
												/*DEBUG*/ if(empty($_GET['Debug']) ==FALSE)	echo "Debug LINE ".__LINE__."  <br>"  ;
												
												while($fila = $result->fetch_assoc()) {	
												
													$NombreDeProducto 	= $fila["ProductoNombre"]; 
															$Precio 	= $fila["Precio"]; 
												
												}// Foin while
												
												
												
										}//Fin $result->num_row
									}	//fn empty($_GET['ID'])							
									
									?>
		
            
                                    <form  name="DatosFormulario" id="DatosFormulario"  method="post" >
                                    
                                    	
                                    
                                    	<br>
                                        		Nombre del producto
										<br>
                                        		<input  name="TextNombreDeProducto" type="text" size="45"  value="<?php echo $NombreDeProducto; ?>"  style="text-align:left"/> 
                                        <br>
                                        
                                        <br>
                                                Precio
										<br>
                                                <input name="TextPrecio" type="text" size="40" maxlength="255"  style="width:100px;" autocomplete="off"  value="<?php echo $Precio; ?>" />
                                                
                                         <br>
                                         
                                         <br>
                                         		Imagen
                                         <br>
                                         		<input name="archivo" type="file" size="35"   />
                                         
                                         
                                         <br>
                                         <br>
                                    			<img src="logo.jpg" width="30" height="30"  >
                                    	 <br>
                                         
                                         	 	<input  type="submit" id="BotonGuardar" name="BotonGuardar" value="Guardar"  onclick="return ValidarFormulario();" />
                                                
													<script type="text/javascript">
                                                
															function ValidarFormulario(){
																
																	var x=document.forms["DatosFormulario"]["TextNombreDeProducto"].value;
																	if (x==null || x=="") {
																	  alert("Falta el nombre del producto");
																	  return false;
																	}  
																
																	var x=document.forms["DatosFormulario"]["TextPrecio"].value;
																	if (x==null || x=="") {
																	  alert("Falta el precio del producto");
																	  return false;
																	}  
																
															}	
													</script>                                             
                                                	
                                         <br>
                                         
                                    </form>
                                
                            </div><! --Fin  Columna_Elemento -->
                        </div><! --Fin  Columna_BordeInterior -->
					</div><! --Fin  Columna_BordeEntreColumnas -->
            </div> <! --Fin  Columna -->
           
            
            
            
            
            
            
        
        
       
    </div> <! --Fin  PrimerCuadro -->


</body><! -- Fin CuerpoFondo -->
</HTML>
>>>>>>> 6e51a58d0e370fd00b841584b23a0c154d72d191
