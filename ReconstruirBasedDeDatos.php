<?php
//publicacion de variables
$Server = 'localhost';
$Usuario= 'root';
$PassWord = '';

//Establaciendo conexion inicial
$mysqli = new mysqli ($Server,$Usuario,$PassWord);

//Veficando conexion
if ($mysqli->connect_error){
 echo "Error de conexion".$mysqli->connect_error;
}




//Crear la base de datos si esta no existe;
$database_sql = "CREATE DATABASE IF NOT EXISTS BDPrincipal";
if ($mysqli->query($database_sql) === FALSE){
	
}else{

	echo "BD: Existe!<br>";
	//Establaciendo conexion inicial
	$mysqli = new mysqli ($Server,$Usuario,$PassWord, "BDPrincipal");

}


for( $f = 1; $f<= 3; $f++){
	switch ($f) {
		case 1:
			$database_sql = "CREATE TABLE IF NOT EXISTS `BDPrincipal`.`TablaUsuarios` ( 
														`ID` INT NOT NULL AUTO_INCREMENT ,
														`Borrado` BOOLEAN  NOT NULL DEFAULT '0' COMMENT 'Registrar  usuario borrado, la informacion de usuarios borrados debe mantenerse en la base de datos' ,
														`AccesoAControlDeUsuarios` BOOLEAN  NOT NULL DEFAULT '0' COMMENT 'Con este privilegio el usuario tiene derechos de administrador' ,
														`NickName` CHAR( 30 ) NOT NULL DEFAULT '' ,
														`Nombre` CHAR( 60 ) NOT NULL DEFAULT '' COMMENT 'Nombre de la persona el usuario'  ,
														`PASSWORD` CHAR( 20 ) NOT NULL DEFAULT '' ,
														
														PRIMARY KEY ( `ID` ) ,
														INDEX ( `NickName` ) ,
														UNIQUE (`ID`)
														) ENGINE = InnoDB DEFAULT CHARSET=utf8;";
			break;
	  
		case 2:
			$database_sql =  "CREATE TABLE IF NOT EXISTS `TablaUsuario_HistorialDeLogin` ( 
																`ID`  BIGINT NOT NULL AUTO_INCREMENT 
															   ,`IDUsuario`  INT NOT NULL COMMENT 'Es la llave forenea que esta vinculada a la tabla ID Usuario'
															   ,`Fecha` DATETIME NOT NULL DEFAULT '1981-01-30 00:00:00'  
															   
															   , PRIMARY KEY ( `ID`  ) 
															    ) ENGINE = InnoDB COMMENT 'Registra la fecha y la hora en que un usuario ingresa al sistema ' ;";
															   
		break;
		
		case 3:													   
			$database_sql = 	"CREATE TABLE IF NOT EXISTS `TablaProductos` ( 
																		`ID`  INT NOT NULL AUTO_INCREMENT  ,
																		`Borrado` BOOLEAN  NOT NULL DEFAULT '0' COMMENT 'Registrar aunque el producto hay sido borrado el ID se utiliza en otras tablas' ,
																		`ProductoNombre` CHAR( 80 ) NOT NULL DEFAULT '',
																		`Precio` decimal(10,2) NOT NULL DEFAULT  '0.00',
																		
																		 PRIMARY KEY ( `ID`  ) 
																		) ENGINE = InnoDB DEFAULT CHARSET=utf8;";													   
															   
        
		break;
		default:
       		echo "Error falta tablas por crear";
	}
	
	
	//Verificar que la crecion de la tabla fue exitosa
	$res = $mysqli->query($database_sql);
	if (1 == $res) {
		printf("<p>Tabla". $f ." creada con exito<p>");
	}else{
		printf("<p>respuesta query: " .  $res . "<p>");
	}
	
													
	if ($mysqli->error) {
	   printf("Errormessage: %s\n", $mysqli->error);
		echo "<p>Error al crear la tabla!<p>";
	}

}//end for

												
												
												
												

?>

