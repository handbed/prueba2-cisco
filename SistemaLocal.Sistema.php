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
		
	
	}//FIN $_POST == TRUE
	
	
	
?>
<HTML>
<head>

<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
<title>obarator Iniciar sesión</title>
<style type="text/css">
   		*  { margin: 0; padding: 0; text-align: center; font-family: arial; border: 0; }
        
       
    	body {font: 100% Verdana, Arial, Helvetica, sans-serif;background: black ;margin: 20;padding: 20;text-align: center;color: #000000;    }
    	#CuerpoFondo #PrimerCuadro {width: width: 90%;background: #FFFFFF;margin: 1 auto; border: 1px solid #000000; text-align: left;     }
       	#cabecera { width: 100%; background-color: black; color:#FFFFFF;  }
        #Columna  { width: 25%; height:80%; float: left; background-color:black ; color: white; }
		#Columna_BordeEntreColumnas { padding:20px;  border-radius: 25px;  background-color:  black  ;}
		#Columna_BordeInterior { padding:20px;  background-color: #333333 ;  border-radius: 15px;}
		#Columna_Elemento { background:#666666; border-radius: 15px;  }
        
        #pie  { clear:both; width: 100%; background-color: black; color:white; }
        
        h1,h2,h3,h4,h5,h6  { padding-bottom : 20px; }
    
 
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


<body class="CuerpoFondo">
    <div id="PrimerCuadro">
        
        
            <div id="cabecera">
            <h1>Cabezera</h1>
            
            </div>
            <?php
            	for( $NumeroDeColumna = 1; $NumeroDeColumna<= 4; $NumeroDeColumna++){ //Duplica la forma de las columnas y solo cambia los valores interiores
			?>
            
            <div id="Columna">
           			<div id="Columna_BordeEntreColumnas">
                        <div id="Columna_BordeInterior">
                            <h3>	<?php 
							
										switch ($NumeroDeColumna) {
												case 1:	
													echo "COLA";
													break;
													
												case 2:	
													echo "PREPARACION";
													break;
		
												case 3:	
													echo "FINALIZADO";
													break;
		
												case 4:	
													echo "ENTREGADO";
													break;
		
												default:
													echo "Error falta tablas por crear";
												}
									?>		
                            
                            </h3>
                            <div id="Columna_Elemento">
                                #123456
                                
                            </div><! --Fin  Columna_Elemento -->
                        </div><! --Fin  Columna_BordeInterior -->
					</div><! --Fin  Columna_BordeEntreColumnas -->
            </div> <! --Fin  Columna -->
            <?php
            	} //Fin for 
			?>
            
            
            
            
            <div id="pie">
                    <h4>Pie de p&aacute;gina</h4>
            </div>
            
        
        
       
    </div> <! --Fin  PrimerCuadro -->


</body><! -- Fin CuerpoFondo -->
</HTML>
