<?php
    include("conexionleal.php");

    $con = mysql_connect($host, $user, $password) or die("Error al conectar al servidor");
    
    mysql_select_db($db, $con);

    mysql_query("INSERT INTO clientes (NOMBRE, DOMICILIO, COLONIA, MUNICIPIO, RFC, TELEFONO, CELULAR, EMAIL) 
                    VALUES ('$_POST[nombre]','$_POST[domicilio]','$_POST[colonia]','$_POST[municipio]', '$_POST[rfc]',
                            '$_POST[telefono]','$_POST[celular]','$_POST[email]')",$con)
                            or die("Error al guardar los datos del cliente: ".mysql_error());

    mysql_query("INSERT INTO vehiculos (MARCA, TIPO, MODELO, PLACAS, COMPANIA, SINIESTRO, COLOR, PUERTAS, FECHA, STATUS)
                    VALUES ('$_POST[marca]','$_POST[tipo]','$_POST[modelo]','$_POST[placas]', '$_POST[cia]',
                            '$_POST[siniestro]','$_POST[color]','$_POST[puertas]','$_POST[fecha]', 'Activo')",$con)
                            or die("Error al guardar los datos del vehiculo: ".mysql_error());

    mysql_query("INSERT INTO inventarios (KILOMETROS, GASOLINA, LLANTAREF, EMBLEMAFRENTE, GATO, EMBLEMACOSTADO, 
                                EXTINGUIDOR, MOLDURADER, ESTEREO, MOLDURAIZQ, PARABRISAS, REFLEJANTESDER, HERRAMIENTA,
                                REFLEJANTESIZQ, ESPEJOSLAT, ESPEJORETRO, POLVERAS, TAPON, TAPETES, LIMPIABRISAS, 
                                CUBREASIENTOS, PARASOLES, ENCENDEDOR, CLAXON, CAJUELA, LUCESDEL, ANTENA, LUCESTRAS,
                                FAROS, OBJETOS, OBSERVACIONES) 
                    VALUES ('$_POST[kilometros]','$_POST[gasolina]','$_POST[llantaref]','$_POST[emblemafrente]', 
                            '$_POST[gato]', '$_POST[emblemacostado]','$_POST[extinguidor]','$_POST[moldurader]',
                            '$_POST[estereo]', '$_POST[molduraizq]', '$_POST[parabrisas]','$_POST[reflejantesder]',
                            '$_POST[herramienta]','$_POST[reflejantesizq]', '$_POST[espejoslat]','$_POST[espejoretro]',
                            '$_POST[polveras]','$_POST[tapon]','$_POST[tapetes]', '$_POST[limpiabrisas]',
                            '$_POST[cubreasientos]','$_POST[parasoles]','$_POST[encendedor]', '$_POST[claxon]',
                            '$_POST[cajuela]','$_POST[lucesdel]','$_POST[antena]','$_POST[lucestras]','$_POST[faros]',
                            '$_POST[objetos]','$_POST[observaciones]')",$con)
                            or die("Error al guardar los datos del inventario: ".mysql_error());

    mysql_query("INSERT INTO presupuestos (MARCA, TIPO, MODELO, PLACAS, COMPANIA, SINIESTRO, STATUS)
                    VALUES ('$_POST[marca]','$_POST[tipo]','$_POST[modelo]','$_POST[placas]', '$_POST[cia]',
                            '$_POST[siniestro]')", 'Presupuesto sin realizar',$con)
                            or die("Error al guardar los datos para presupuesto: ".mysql_error());

?>

<!DOCTYPE html>
<html lang="en">
        <head>
                <title>GL Intranet | Nuevo inventario</title>
                <!-- Bootstrap framework -->
                <meta charset="utf-8">
                <meta name="viewport" content="width=device-width, initial-scale=1">
                <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
                <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
                <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        </head>
        <body>
                <header class="jumbotron" style="margin-top: -20px; text-align:center">
                        <h1>Inventario de veh&iacuteculo</h1>        
                </header>
       
                <article class="container" style="text-align:center">

                        <h3>El inventario ha sido registrado</h3>
                        <div class="col-sm-12" style="text-align:center">
                                <a href="Menu.html"><button class="bt��`�= X�          /namespace-2e1c2d6e_6596_48a7_bee9_db59d7ce2a5e-N�v= Y�          /namespace-0f8e048b_5f11_4da9_b5a8