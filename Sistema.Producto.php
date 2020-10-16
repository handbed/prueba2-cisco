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
		
			//*********************************************************		
				//Verificar antes que el nombre del producto no este repetido
			//*********************************************************	
			
			
			
			
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
					
					
			} else {
				echo   ' LINE = '.__LINE__.'  ' . $mysqli->error;
				$Error .=  ' LINE = '.__LINE__.'  ' .  $mysqli->error;
			}													
													
			
			
			
			
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
    
 
</style>


    
    
    
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
                               

		
            
                                    <form  method="post" >
                                    
                                    	
                                    
                                    	<br>
                                        		Nombre del producto
										<br>
                                        		<input  name="TextNombreDeProducto" type="text" size="50"  value=""  style="text-align:left"/> 
                                        <br>
                                        
                                        <br>
                                                Precio
										<br>
                                                <input name="TextPrecio" type="text" size="40" maxlength="255"  style="width:100px;" autocomplete="off"  />
                                                
                                         <br>
                                         
                                         <br>
                                         		Imagen
                                         <br>
                                         		<input name="archivo" type="file" size="35"   />
                                         
                                         
                                         <br>
                                         <br>
                                    			<img src="logo.jpg" width="30" height="30"  >
                                    	 <br>
                                         
                                         	 	<input  type="submit" id="BotonGuardar" name="BotonGuardar" value="Guardar" />
                                         <br>
                                         
                                    </form>
                                
                            </div><! --Fin  Columna_Elemento -->
                        </div><! --Fin  Columna_BordeInterior -->
					</div><! --Fin  Columna_BordeEntreColumnas -->
            </div> <! --Fin  Columna -->
           
            
            
            
            
            
            
        
        
       
    </div> <! --Fin  PrimerCuadro -->


</body><! -- Fin CuerpoFondo -->
</HTML>
