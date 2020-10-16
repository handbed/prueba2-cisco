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
        
       
    	body {font: 100% Verdana, Arial, Helvetica, sans-serif;background: #666666;margin: 20;padding: 20;text-align: center;color: #000000;    }
    	#CuerpoFondo #PrimerCuadro {width: width: 90%;background: #FFFFFF;margin: 1 auto; border: 1px solid #000000; text-align: left;     }
        #contenedor  { width: 100%; background-color: black;}
        #cabecera { width: 100%; background-color: black; color:#FFFFFF;  }
        #Columna  { width: 25%; height:80%; float: left; background-color: #333333  ; color: white;}

        #pie  { clear:both; width: 100%; background-color: black; color:white; }
        
        h1,h2,h3,h4,h5,h6  {padding : 0.5em; }
    
 
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
        <div id="contenedor">
        
        <div id="cabecera">
        <h1>Cabezera</h1>
        
        </div>
        
        <div id="Columna">
        
        <h3>COLA</h3>
        </div>
        
        <div id="Columna">
        <h3>PREPARACION</h3>
        
        </div>
        
        <div id="Columna">
        <h3>FINALIZADO</h3>
        
        </div>
        <div id="Columna">
        
        <h3>ENTREGADO</h3>
        
        </div>
        
        
        
        <div id="pie">
        <h4>Pie de p&aacute;gina</h4>
        </div>
        
        
        
        </div> <! --  PrimerCuadro -->
    </div> <! --Fin  PrimerCuadro -->


</body><! -- Fin CuerpoFondo -->
</HTML>
