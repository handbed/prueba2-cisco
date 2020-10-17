<?php
		
		$_SESSION["AccesoAdmitido"] = FALSE;
		
		// destruir la sesión.
		session_unset();
		session_destroy();
		
	
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
    	text-align: center; /* esto centra el contenedor en los navegadores IE 5*. El texto se ajusta posteriormente con el valor predeterminado de alineación a la izquierda en el selector #PrimerCuadro */
    	color: #000000;
    }
    #PrimerCuadro {
    	width: 470px;
    	background: #FFFFFF;
    	margin: 1 auto; /* los márgenes automáticos (conjuntamente con un ancho) centran la página */
    	border: 1px solid #000000;
    	text-align: left; /* esto anula text-align: center en el elemento body. */
		border-radius: 20;
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


<body class="CuerpoFondo">
<div id="PrimerCuadro">
      	
		
			
  <img src="logo.jpg" width="397" height="30"></p>

		
            
              	Session <a href="login.php">Terminada
 		
        		Ingresar de nuevo
		
</a></div>


</body>
</HTML>
=======
<?php
		
		$_SESSION["AccesoAdmitido"] = FALSE;
		
		// destruir la sesión.
		session_unset();
		session_destroy();
		
	
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
    	text-align: center; /* esto centra el contenedor en los navegadores IE 5*. El texto se ajusta posteriormente con el valor predeterminado de alineación a la izquierda en el selector #PrimerCuadro */
    	color: #000000;
    }
    #PrimerCuadro {
    	width: 470px;
    	background: #FFFFFF;
    	margin: 1 auto; /* los márgenes automáticos (conjuntamente con un ancho) centran la página */
    	border: 1px solid #000000;
    	text-align: left; /* esto anula text-align: center en el elemento body. */
		border-radius: 20;
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


<body class="CuerpoFondo">
<div id="PrimerCuadro">
      	
		
			
  <img src="logo.jpg" width="397" height="30"></p>

		
            
              	Session <a href="login.php">Terminada
 		
        		Ingresar de nuevo
		
</a></div>


</body>
</HTML>
>>>>>>> 6e51a58d0e370fd00b841584b23a0c154d72d191
