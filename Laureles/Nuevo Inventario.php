<?php
    session_start();
    if(empty($_SESSION['username'])){
        header("Location: ../login.php");
    }else{
        
    $inventario_correcto = null;
    $inventario_erroneo = null;

    //Variables de datos del cliente para insercion de datos a SQL.
    $nombre = $domicilio = $colonia = $municipio = $rfc = $telefono = $celular = $email = null;
    
    //Variables de datos del vehiculo para insercion de datos a SQL.
    $marca = $tipo = $modelo = $placas = $cia = $siniestro = $color = $puertas = $fecha = $hoy = $fecha_aux= null;

    //Variables de checklist para insercion de datos a SQL
    $kilometros = $gasolina = $llantaref = $emblemafrente = $gato = $emblemacostado = $extinguidor = $moldurader = $estereo =
    $molduraizq = $parabrisas = $reflejantesder = $herramienta = $reflejantesizq = $espejoslat = $espejoretro = $polveras =
    $tapon = $tapetes = $limpiabrisas = $cubreasientos = $parasoles = $encendedor = $claxon = $cajuela = $lucesdel =
    $antena = $lucestras = $faros = $objetos = $observaciones = null;

    //Fotos
    $foto1 = $foto2 = $foto3 = $foto4 = $foto5 = $foto6 = null;

    //Variables de error de datos del cliente:
    $error_nombre = $error_domicilio = $error_municipio = $error_telefono = $error_celular = $error_email = null;

    //Variables de error de datos del vehiculo:
    $error_marca = $error_tipo = $error_modelo = $error_placas = $error_cia = $error_siniestro = $error_color =
    $error_puertas = $error_fecha = null;

    //Variables de error de checklist para insercion de datos a SQL
    $error_kilometros = $error_gasolina = $error_llantaref = $error_emblemafrente = $error_gato = $error_emblemacostado = 
    $error_extinguidor = $error_moldurader = $error_estereo = $error_molduraizq = $error_parabrisas = $error_reflejantesder = 
    $error_herramienta = $error_reflejantesizq = $error_espejoslat = $error_espejoretro = $error_polveras = $error_tapon = 
    $error_tapetes = $error_limpiabrisas = $error_cubreasientos = $error_parasoles = $error_encendedor = $error_claxon = 
    $error_cajuela = $error_lucesdel = $error_antena = $error_lucestras = $error_faros = $error_objetos = 
    $error_observaciones = null;

    //Variables de error de fotos:
    $error_foto1 = $error_foto2 = $error_foto3 = $error_foto4 = $error_foto5 = $error_foto6 = null;

    function test_input($dato){
        $dato = trim($dato);
        $dato = stripslashes($dato);
        $dato = htmlspecialchars($dato);
        return $dato;
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        
       include("../assets/includes/valida_formulario.php");

        if($validacion === 44){

            include("conexion_laureles.php");

            $con = mysqli_connect($hostname, $user, $pass, $db) or die("Error al conectar con el servidor");
            
            mysqli_query($con, "INSERT INTO clientes (NOMBRE, DOMICILIO, COLONIA, MUNICIPIO, RFC, TELEFONO, CELULAR, EMAIL) 
                    VALUES ('$nombre','$domicilio','$colonia','$municipio','$rfc','$telefono','$celular','$email')")
                            or die("Error al guardar los datos del cliente: ".mysqli_error($con));

            mysqli_query($con, "INSERT INTO vehiculos (MARCA, TIPO, MODELO, PLACAS, COMPANIA, SINIESTRO, COLOR, PUERTAS, FECHA, STATUS)
                    VALUES ('$marca','$tipo','$modelo','$placas', '$cia','$siniestro','$color','$puertas','$fecha', 'Activo')")
                            or die("Error al guardar los datos del vehiculo: ".mysqli_error($con));

            mysqli_query($con, "INSERT INTO inventarios (KILOMETROS, GASOLINA, LLANTAREF, EMBLEMAFRENTE, GATO, EMBLEMACOSTADO, 
                                EXTINGUIDOR, MOLDURADER, ESTEREO, MOLDURAIZQ, PARABRISAS, REFLEJANTESDER, HERRAMIENTA,
                                REFLEJANTESIZQ, ESPEJOSLAT, ESPEJORETRO, POLVERAS, TAPON, TAPETES, LIMPIABRISAS, 
                                CUBREASIENTOS, PARASOLES, ENCENDEDOR, CLAXON, CAJUELA, LUCESDEL, ANTENA, LUCESTRAS,
                                FAROS, OBJETOS, OBSERVACIONES) 
                    VALUES ('$kilometros','$gasolina','$llantaref','$emblemafrente','$gato','$emblemacostado','$extinguidor',
                            '$moldurader','$estereo','$molduraizq','$parabrisas','$reflejantesder','$herramienta',
                            '$reflejantesizq','$espejoslat','$espejoretro','$polveras','$tapon','$tapetes', '$limpiabrisas',
                            '$cubreasientos','$parasoles','$encendedor','$claxon','$cajuela','$lucesdel','$antena',
                            '$lucestras','$faros','$objetos','$observaciones')") 
                            or die("Error al guardar los datos del inventario: ".mysqli_error($con));

            mysqli_query($con, "INSERT INTO presupuestos (STATUS) VALUES ('Presupuesto sin realizar')")
                            or die("Error al guardar los datos para presupuesto: ".mysqli_error($con));
            
            mysqli_close($con);

            $inventario_correcto = "Inventario guardado correctamente! Número de folio generado: 0";

        }else {
            $inventario_erroneo = "El inventario contiene errores, favor de verificarlo."; 
        }
                
    }
    
?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <title>GL Intranet | Men&uacute</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- BOOTSTRAP STYLES-->
        <link href="../assets/css/bootstrap.css" rel="stylesheet" />
        <!-- FONTAWESOME STYLES-->
        <link href="../assets/css/font-awesome.css" rel="stylesheet" />
        <!-- MORRIS CHART STYLES-->
        <link href="../assets/js/morris/morris-0.4.3.min.css" rel="stylesheet" />
        <!-- CUSTOM STYLES-->
        <link href="../assets/css/custom.css" rel="stylesheet" />        
        <!-- GOOGLE FONTS-->
        <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
        <style> .error{color:red;} .correcto{color:green}</style>
    </head>
    
    <body>
    <div id="wrapper">
        <nav class="navbar navbar-default navbar-cls-top " role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="Menu.php"><?php echo $_SESSION["sucursal"]; ?></a> 
            </div>
            <div style="color: white; padding: 15px 50px 5px 50px; float: right; font-size: 16px;"> 
                Bienvenido <?php echo $_SESSION["username"]; ?> 
                <img src="gordito.png" height="30px" width="30px">&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
                <a href="../logout.php" class="btn btn-success square-btn-adjust">Logout</a> 
            </div>
        </nav>
        <!-- /. NAV TOP  -->
        <nav class="navbar-default navbar-side" role="navigation">
            <div class="sidebar-collapse">
                <ul class="nav" id="main-menu">
				    <li class="text-center"><img src="../assets/img/logo.png" class="user-image img-responsive"/></li>
                    <li><a href="Menu.php"><i class="fa fa-user fa-3x"></i>Resumen</a>
				    <li><a href="Vehiculos en taller.php"><i class="fa fa-dashboard fa-3x"></i>Veh&iacuteculos en taller</a></li>
                    <li><a class="active-menu" href="#"><i class="fa fa-edit fa-3x"></i>Inventarios<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li><a href="Nuevo Inventario.php">Nuevo inventario</a></li>
                            <li><a href="Buscar Inventario.html">Buscar inventario</a></li>
                            <li><a href="Historico inventarios.php">Hist&oacuterico de inventarios</a></li>
                        </ul>
                    </li>
                    <li><a href="#"><i class="fa fa-bar-chart-o fa-3x"></i>Presupuestos<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li><a href="Presupuesto Rapido.html">Nuevo presupuesto r&aacutepido</a></li>
                            <li><a href="Presupuesto Taller.php">Nuevo presupuesto para taller</a></li>
                            <li><a href="Buscar Presupuesto.html">Buscar presupuesto</a></li>
                            <li><a href="Historial Presupuestos.html">Historial de presupuestos</a></li>
                        </ul>
                    </li>
                    <li><a href="#"><i class="fa fa-square-o fa-3x"></i>Vales<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li><a href="Nuevo Vale.html">Nuevo vale</a></li>
                            <li><a href="Presupuesto Taller.html">Buscar vales</a></li>
                            <li><a href="Buscar Presupuesto.html">Hist&oacuterico de vales</a></li>
                        </ul>
                    </li>
                    <li><a  href="table.html"><i class="fa fa-money fa-3x"></i>Gastos</a></li>
                </ul>
            </div>   
        </nav>  
        <!-- /. NAV SIDE  -->
        <div id="page-wrapper" >
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12 col-sm-6 col-xs-6">           
			            <div class="panel panel-back noti-box">
                            <span class="icon-box bg-color-green set-icon"><i class="fa fa-edit"></i></span>
                            <div class="text-box">
                                <p class="main-text" style="text-align:center;">Nuevo inventario</p>
                            </div>
                        </div>
                        <hr/>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-10">
                        <?php
                            echo "<span class='correcto' style='font-size:20px'>" . $inventario_correcto ."</span>";
                            echo "<span class='error' style='font-size:20px'>" . $inventario_erroneo ."</span>";
                        ?>
                    </div>
                    <div class="col-sm-2">           
			                <legend>Folio: 0</legend>
                    </div>
                </div>

                <!-- /. ROW  -->

        <form id="inventarioForm" class="form-horizontal" action="<?php $_SERVER["PHP_SELF"]?>" name="inventario" method="POST">
            <fieldset>
                <legend>Datos del cliente</legend>
                <div class="form-group" >
                    <label class="control-label col-sm-1" for="nombre">Nombre:</label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" name="nombre" value="<?php echo $nombre; ?>" placeholder="Ingrese el nombre">
                        <span class="error"><?php echo $error_nombre; ?> </span>
                    </div> 
                    <label class="control-label col-sm-1" for="domicilio">Domicilio:</label>
                    <div class="col-sm-5">
                        <input type="text" class="form-control" name="domicilio" value="<?php echo $domicilio; ?>" placeholder="Ingrese el domicilio">    
                        <span class="error"><?php echo $error_domicilio; ?> </span>
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-sm-1" for="colonia">Colonia:</label>
                    <div class="col-sm-3">
                        <input type="text" class="form-control" name="colonia" value="<?php echo $colonia; ?>" placeholder="Ingrese la colonia" maxlength="25">    
                    </div>
                    <label class="control-label col-sm-1" for="municipio">Municipio:</label>
                    <div class="col-sm-3">
                        <input type="text" class="form-control" name="municipio" value="<?php echo $municipio; ?>" placeholder="Ingrese el municipio">
                        <span class="error"><?php echo $error_municipio; ?> </span>
                    </div>
                    <label class="control-label col-sm-1" for="rfc">R.F.C.:</label>
                    <div class="col-sm-2">
                        <input type="text" class="form-control" name="rfc" value="<?php echo $rfc; ?>" placeholder="Ingrese el RFC" maxlength="13">
                    </div>
                </div>
                    
                <div class="form-group">
                    <label class="control-label col-sm-1" for="telefono">Tel&eacutefono:</label>
                    <div class="col-sm-2">
                        <input type="tel" class="form-control" name="telefono" value="<?php echo $telefono; ?>" placeholder="Número 10 dígitos" maxlength="10">
                        <span class="error"><?php echo $error_telefono; ?> </span>
                    </div>
                    <label class="control-label col-sm-1" for="celular">Celular:</label>
                    <div class="col-sm-2">
                        <input type="tel" class="form-control" name="celular" value="<?php echo $celular; ?>" placeholder="Número 10 dígitos" maxlength="10">   
                        <span class="error"><?php echo $error_celular; ?> </span>
                    </div>
                    <label class="control-label col-sm-1" for="email">E-Mail:</label>
                    <div class="col-sm-3">
                        <input id="email" type="email" class="form-control" name="email" value="<?php echo $email; ?>" placeholder="ejemplo@correo.com">
                        <span class="error"><?php echo $error_email; ?> </span>
                    </div>
                </div>                        
            </fieldset>
            <br>
            <!-- Datos del Vehiculo-->
            <!-- Formulario para registrar el vehiculo del cliente -->
            <fieldset>            
            <legend>Datos del veh&iacuteculo</legend>
                <div class="form-group">
                    <label class="control-label col-sm-1" for="marca">Marca:</label>
                    <div class="col-sm-2">
                        <input type="text" class="form-control" name="marca" value="<?php echo $marca; ?>" placeholder="Ej. Nissan, Ford...">    
                        <span class="error"><?php echo $error_marca; ?> </span>
                    </div>
                    <label class="control-label col-sm-1" for="tipo">Tipo:</label>
                    <div class="col-sm-2">
                        <input type="text" class="form-control" name="tipo" value="<?php echo $tipo; ?>" placeholder="Ej. Versa, Focus...">    
                        <span class="error"><?php echo $error_tipo; ?> </span>
                    </div>
                    <label class="control-label col-sm-1" for="modelo">Modelo:</label>
                    <div class="col-sm-1">
                        <input type="text" class="form-control" name="modelo" value="<?php echo $modelo; ?>" placeholder="Año" maxlength="4">   
                        <span class="error"><?php echo $error_modelo; ?> </span>
                    </div>
                    <label class="control-label col-sm-1" for="placas">Placas:</label>
                    <div class="col-sm-2">
                        <input type="text" class="form-control" name="placas" value="<?php echo $placas; ?>" placeholder="No escribir guión" maxlength="7">    
                        <span class="error"><?php echo $error_placas; ?> </span>
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-sm-1" for="cia">Compa&ntildeia:</label>
                    <div class="col-sm-2">
                        <input type="text" class="form-control" name="cia" value="<?php echo $cia; ?>" placeholder="Ej. HDI">    
                        <span class="error"><?php echo $error_cia; ?> </span>
                    </div>
                    <label class="control-label col-sm-1" for="siniestro">Siniestro:</label>
                    <div class="col-sm-2">
                        <input type="text" class="form-control" name="siniestro" value="<?php echo $siniestro; ?>" placeholder="Num. de siniestro">    
                        <span class="error"><?php echo $error_siniestro; ?> </span>
                    </div>
                    <label class="control-label col-sm-1" for="color">Color:</label>
                    <div class="col-sm-2">
                        <input type="text" class="form-control" name="color" value="<?php echo $color; ?>" placeholder="Ej. Negro, tinto...">
                        <span class="error"><?php echo $error_color; ?> </span>
                    </div>
                    <label class="control-label col-sm-1" for="puertas">Puertas:</label>
                    <div class="col-sm-1">
                        <input type="text" class="form-control" name="puertas" value="<?php echo $puertas; ?>" maxlength="1">                       
                        <span class="error"><?php echo $error_puertas; ?> </span>
                    </div>
                </div>      
                <div class="form-group">
                    <label class="control-label col-sm-2" for="fecha">Fecha de ingreso:</label>
                    <div class="col-sm-3">
                        <input type="date" class="form-control" name="fecha" value="<?php echo $fecha; ?>">    
                        <span class="error"><?php echo $error_fecha; ?> </span>
                    </div>
                </div>                
            </fieldset>
            <br>
            <!-- Inventario -->
            <!-- Rubros de inventario -->
            <fieldset>
                <legend>Inventario del veh&iacuteculo</legend>
                <p>Marca la casilla correspondiente de acuerdo a los par&aacutemetros que cumple el veh&iacuteculo:</p>
                <br>
                <div class="form-group">
                    <label class="control-label col-sm-2" for="kilometros">Kil&oacutemetros:</label>
                    <div class="col-sm-2">
                        <input type="text" class="form-control" name="kilometros" value="<?php echo $kilometros; ?>" maxlength="6"> 
                        <span class="error"><?php echo $error_kilometros; ?> </span>   
                    </div>
                    <label class="control-label col-sm-2" for="gasolina">Gasolina:</label>
                    <div class="col-sm-2">
                        <input type="text" class="form-control" name="gasolina" value="<?php echo $gasolina ?>">
                        <span class="error"><?php echo $error_gasolina; ?> </span>
                    </div>
                </div>

                <div class="form-group">
                    <div class="row">
                         <div class="col-sm-5">
                            <label class="control-label col-sm-4" for="llantaref">Llanta refacci&oacuten</label>
                         <div class="radio">
                            <label class="col-sm-2"><input type="radio" name="llantaref" <?php if(isset($llantaref) && ($llantaref == "Si")) echo "checked"; ?> value="Si">Si</label>
                            <label class="col-sm-2"><input type="radio" name="llantaref" <?php if(isset($llantaref) && ($llantaref == "No")) echo "checked"; ?> value="No">No</label>
                            <span class="error"><?php echo $error_llantaref; ?> </span>
                         </div>   
                         </div>         
                        <div class="col-sm-5">
                            <label class="control-label col-sm-4" for="emblemafrente">Emblema frente</label>
                        <div class="radio">
                            <label class="col-sm-2"><input type="radio" name="emblemafrente" <?php if(isset($emblemafrente) && ($emblemafrente == "Si")) echo "checked"; ?> value="Si">Si</label>
                            <label class="col-sm-2"><input type="radio" name="emblemafrente" <?php if(isset($emblemafrente) && ($emblemafrente == "No")) echo "checked"; ?> value="No">No</label>
                            <span class="error"><?php echo $error_emblemafrente; ?> </span>
                        </div>
                        </div>    
                    </div>
                </div>

                 <div class="form-group">
                    <div class="row">
                         <div class="col-sm-5">
                            <label class="control-label col-sm-4" for="gato">Gato</label>
                         <div class="radio">
                            <label class="col-sm-2"><input type="radio" name="gato" <?php if(isset($gato) && ($gato == "Si")) echo "checked"; ?> value="Si">Si</label>
                            <label class="col-sm-2"><input type="radio" name="gato" <?php if(isset($gato) && ($gato == "No")) echo "checked"; ?> value="No">No</label>
                            <span class="error"><?php echo $error_gato; ?> </span>
                         </div>   
                         </div>         
                        <div class="col-sm-5">
                            <label class="control-label col-sm-4" for="emblemacostado">Emblema costado</label>
                        <div class="radio">
                            <label class="col-sm-2"><input type="radio" name="emblemacostado" <?php if(isset($emblemacostado) && ($emblemacostado == "Si")) echo "checked"; ?> value="Si">Si</label>
                            <label class="col-sm-2"><input type="radio" name="emblemacostado" <?php if(isset($emblemacostado) && ($emblemacostado == "No")) echo "checked"; ?> value="No">No</label>
                            <span class="error"><?php echo $error_emblemacostado; ?> </span>
                        </div>
                        </div>    
                    </div>
                </div>

                <div class="form-group">
                    <div class="row">
                        <div class="col-sm-5">
                            <label class="control-label col-sm-4" for="extinguidor">Extinguidor</label>
                        <div class="radio">
                            <label class="col-sm-2"><input type="radio" name="extinguidor" <?php if(isset($extinguidor) && ($extinguidor == "Si")) echo "checked"; ?> value="Si">Si</label>
                            <label class="col-sm-2"><input type="radio" name="extinguidor" <?php if(isset($extinguidor) && ($extinguidor == "No")) echo "checked"; ?> value="No">No</label>
                            <span class="error"><?php echo $error_extinguidor; ?> </span>
                        </div>
                        </div>         
                        <div class="col-sm-5">
                            <label class="control-label col-sm-4" for="moldurader">Moldura derecha</label>
                        <div class="radio">
                            <label class="col-sm-2"><input type="radio" name="moldurader" <?php if(isset($moldurader) && ($moldurader == "Si")) echo "checked"; ?> value="Si">Si</label>
                            <label class="col-sm-2"><input type="radio" name="moldurader" <?php if(isset($moldurader) && ($moldurader == "No")) echo "checked"; ?> value="No">No</label>
                            <span class="error"><?php echo $error_moldurader; ?> </span>
                        </div>
                        </div>    
                    </div>
                </div>
       
                <div class="form-group">
                    <div class="row">
                         <div class="col-sm-5">
                            <label class="control-label col-sm-4" for="estereo">Est&eacutereo</label>
                         <div class="radio">
                            <label class="col-sm-2"><input type="radio" name="estereo" <?php if(isset($estereo) && ($estereo == "Si")) echo "checked"; ?> value="Si">Si</label>
                            <label class="col-sm-2"><input type="radio" name="estereo" <?php if(isset($estereo) && ($estereo == "No")) echo "checked"; ?> value="No">No</label>
                            <span class="error"><?php echo $error_estereo; ?> </span>
                         </div>   
                         </div>         
                        <div class="col-sm-5">
                            <label class="control-label col-sm-4" for="molduraizq">Moldura izquierda</label>
                        <div class="radio">
                            <label class="col-sm-2"><input type="radio" name="molduraizq" <?php if(isset($molduraizq) && ($molduraizq == "Si")) echo "checked"; ?> value="Si">Si</label>
                            <label class="col-sm-2"><input type="radio" name="molduraizq" <?php if(isset($molduraizq) && ($molduraizq == "No")) echo "checked"; ?> value="No">No</label>
                            <span class="error"><?php echo $error_molduraizq; ?> </span>
                        </div>
                        </div>    
                    </div>
                </div>

                <div class="form-group">
                    <div class="row">
                         <div class="col-sm-5">
                            <label class="control-label col-sm-4" for="parabrisas">Parabrisas</label>
                        <div class="radio">
                            <label class="col-sm-2"><input type="radio" name="parabrisas" <?php if(isset($parabrisas) && ($parabrisas == "Si")) echo "checked"; ?> value="Si">Si</label>
                            <label class="col-sm-2"><input type="radio" name="parabrisas" <?php if(isset($parabrisas) && ($parabrisas == "No")) echo "checked"; ?> value="No">No</label>
                            <span class="error"><?php echo $error_parabrisas; ?> </span>
                        </div>
                        </div>         
                        <div class="col-sm-5">
                            <label class="control-label col-sm-4" for="reflejantesder">Reflejantes der.</label>
                        <div class="radio">
                            <label class="col-sm-2"><input type="radio" name="reflejantesder" <?php if(isset($reflejantesder) && ($reflejantesder == "Si")) echo "checked"; ?> value="Si">Si</label>
                            <label class="col-sm-2"><input type="radio" name="reflejantesder" <?php if(isset($reflejantesder) && ($reflejantesder == "No")) echo "checked"; ?> value="No">No</label>
                            <span class="error"><?php echo $error_reflejantesder; ?> </span>
                        </div>
                        </div>    
                    </div>
                </div>

                <div class="form-group">
                    <div class="row">
                         <div class="col-sm-5">
                            <label class="control-label col-sm-4" for="herramienta">Herramienta</label>
                         <div class="radio">
                            <label class="col-sm-2"><input type="radio" name="herramienta" <?php if(isset($herramienta) && ($herramienta == "Si")) echo "checked"; ?> value="Si">Si</label>
                            <label class="col-sm-2"><input type="radio" name="herramienta" <?php if(isset($herramienta) && ($herramienta == "No")) echo "checked"; ?> value="No">No</label>
                            <span class="error"><?php echo $error_herramienta; ?> </span>
                         </div>   
                         </div>         
                        <div class="col-sm-5">
                            <label class="control-label col-sm-4" for="reflejantesdizq">Reflejantes izq.</label>
                        <div class="radio">
                            <label class="col-sm-2"><input type="radio" name="reflejantesizq" <?php if(isset($reflejantesizq) && ($reflejantesizq == "Si")) echo "checked"; ?> value="Si">Si</label>
                            <label class="col-sm-2"><input type="radio" name="reflejantesizq" <?php if(isset($reflejantesizq) && ($reflejantesizq == "No")) echo "checked"; ?> value="No">No</label>
                            <span class="error"><?php echo $error_reflejantesizq; ?> </span>
                        </div>
                        </div>    
                    </div>
                </div>

                 <div class="form-group">
                    <div class="row">
                         <div class="col-sm-5">
                            <label class="control-label col-sm-4" for="espejoslat">Espejos laterales</label>
                         <div class="radio">
                            <label class="col-sm-2"><input type="radio" name="espejoslat" <?php if(isset($espejoslat) && ($espejoslat == "Si")) echo "checked"; ?> value="Si">Si</label>
                            <label class="col-sm-2"><input type="radio" name="espejoslat" <?php if(isset($espejoslat) && ($espejoslat == "No")) echo "checked"; ?> value="No">No</label>
                            <span class="error"><?php echo $error_espejoslat; ?> </span>
                         </div>   
                         </div>         
                        <div class="col-sm-5">
                            <label class="control-label col-sm-4" for="espejoretro">Espejo retrovisor</label>
                        <div class="radio">
                            <label class="col-sm-2"><input type="radio" name="espejoretro" <?php if(isset($espejoretro) && ($espejoretro == "Si")) echo "checked"; ?> value="Si">Si</label>
                            <label class="col-sm-2"><input type="radio" name="espejoretro" <?php if(isset($espejoretro) && ($espejoretro == "No")) echo "checked"; ?> value="No">No</label>
                            <span class="error"><?php echo $error_espejoretro; ?> </span>
                        </div>
                        </div>    
                    </div>
                </div>

                <div class="form-group">
                    <div class="row">
                         <div class="col-sm-5">
                            <label class="control-label col-sm-4" for="polveras">Polveras de rueda</label>
                         <div class="radio">
                            <label class="col-sm-2"><input type="radio" name="polveras" <?php if(isset($polveras) && ($polveras == "Si")) echo "checked"; ?> value="Si">Si</label>
                            <label class="col-sm-2"><input type="radio" name="polveras" <?php if(isset($polveras) && ($polveras == "No")) echo "checked"; ?> value="No">No</label>
                            <span class="error"><?php echo $error_polveras; ?> </span>
                         </div>   
                         </div>         
                        <div class="col-sm-5">
                            <label class="control-label col-sm-4" for="tapon">Tap&oacuten gasolina</label>
                        <div class="radio">
                            <label class="col-sm-2"><input type="radio" name="tapon" <?php if(isset($tapon) && ($tapon == "Si")) echo "checked"; ?> value="Si">Si</label>
                            <label class="col-sm-2"><input type="radio" name="tapon" <?php if(isset($tapon) && ($tapon == "No")) echo "checked"; ?> value="No">No</label>
                            <span class="error"><?php echo $error_tapon; ?> </span>
                        </div>
                        </div>    
                    </div>
                </div>

                <div class="form-group">
                    <div class="row">
                         <div class="col-sm-5">
                            <label class="control-label col-sm-4" for="tapetes">Tapete del. y tras.</label>
                         <div class="radio">
                            <label class="col-sm-2"><input type="radio" name="tapetes" <?php if(isset($tapetes) && ($tapetes == "Si")) echo "checked"; ?> value="Si">Si</label>
                            <label class="col-sm-2"><input type="radio" name="tapetes" <?php if(isset($tapetes) && ($tapetes == "No")) echo "checked"; ?> value="No">No</label>
                            <span class="error"><?php echo $error_tapetes; ?> </span>
                         </div>   
                         </div>         
                        <div class="col-sm-5">
                            <label class="control-label col-sm-4" for="limpiabrisas">Limpiabrisas</label>
                        <div class="radio">
                            <label class="col-sm-2"><input type="radio" name="limpiabrisas" <?php if(isset($limpiabrisas) && ($limpiabrisas == "Si")) echo "checked"; ?> value="Si">Si</label>
                            <label class="col-sm-2"><input type="radio" name="limpiabrisas" <?php if(isset($limpiabrisas) && ($limpiabrisas == "No")) echo "checked"; ?> value="No">No</label>
                            <span class="error"><?php echo $error_limpiabrisas; ?> </span>
                        </div>
                        </div>    
                    </div>
                </div>

                <div class="form-group">
                    <div class="row">
                         <div class="col-sm-5">
                            <label class="control-label col-sm-4" for="cubreasientos">Cubreasientos</label>
                         <div class="radio">
                            <label class="col-sm-2"><input type="radio" name="cubreasientos" <?php if(isset($cubreasientos) && ($cubreasientos == "Si")) echo "checked"; ?> value="Si">Si</label>
                            <label class="col-sm-2"><input type="radio" name="cubreasientos" <?php if(isset($cubreasientos) && ($cubreasientos == "No")) echo "checked"; ?> value="No">No</label>
                            <span class="error"><?php echo $error_cubreasientos; ?> </span>
                         </div>   
                         </div>         
                        <div class="col-sm-5">
                            <label class="control-label col-sm-4" for="parasoles">Parasoles</label>
                        <div class="radio">
                            <label class="col-sm-2"><input type="radio" name="parasoles" <?php if(isset($parasoles) && ($parasoles == "Si")) echo "checked"; ?> value="Si">Si</label>
                            <label class="col-sm-2"><input type="radio" name="parasoles" <?php if(isset($parasoles) && ($parasoles == "No")) echo "checked"; ?> value="No">No</label>
                            <span class="error"><?php echo $error_parasoles; ?> </span>
                        </div>
                        </div>    
                    </div>
                </div>

                <div class="form-group">
                    <div class="row">
                         <div class="col-sm-5">
                            <label class="control-label col-sm-4" for="encendedor">Encendedor</label>
                         <div class="radio">
                            <label class="col-sm-2"><input type="radio" name="encendedor" <?php if(isset($encendedor) && ($encendedor == "Si")) echo "checked"; ?> value="Si">Si</label>
                            <label class="col-sm-2"><input type="radio" name="encendedor" <?php if(isset($encendedor) && ($encendedor == "No")) echo "checked"; ?> value="No">No</label>
                            <span class="error"><?php echo $error_encendedor; ?> </span>
                         </div>   
                         </div>         
                        <div class="col-sm-5">
                            <label class="control-label col-sm-4" for="claxon">Claxon</label>
                        <div class="radio">
                            <label class="col-sm-2"><input type="radio" name="claxon" <?php if(isset($claxon) && ($claxon == "Si")) echo "checked"; ?> value="Si">Si</label>
                            <label class="col-sm-2"><input type="radio" name="claxon" <?php if(isset($claxon) && ($claxon == "No")) echo "checked"; ?> value="No">No</label>
                            <span class="error"><?php echo $error_claxon; ?> </span>
                        </div>
                        </div>    
                    </div>
                </div>

                <div class="form-group">
                    <div class="row">
                        <div class="col-sm-5">
                            <label class="control-label col-sm-4" for="cajuela">Tapete de cajuela</label>
                         <div class="radio">
                            <label class="col-sm-2"><input type="radio" name="cajuela" <?php if(isset($cajuela) && ($cajuela == "Si")) echo "checked"; ?> value="Si">Si</label>
                            <label class="col-sm-2"><input type="radio" name="cajuela" <?php if(isset($cajuela) && ($cajuela == "No")) echo "checked"; ?> value="No">No</label>
                            <span class="error"><?php echo $error_cajuela; ?> </span>
                         </div>   
                         </div>           
                        <div class="col-sm-5">
                            <label class="control-label col-sm-4" for="lucesdel">Luces delanteras</label>
                        <div class="radio">
                            <label class="col-sm-2"><input type="radio" name="lucesdel" <?php if(isset($lucesdel) && ($lucesdel == "Si")) echo "checked"; ?> value="Si">Si</label>
                            <label class="col-sm-2"><input type="radio" name="lucesdel" <?php if(isset($lucesdel) && ($lucesdel == "No")) echo "checked"; ?> value="No">No</label>
                            <span class="error"><?php echo $error_lucesdel; ?> </span>
                        </div>
                        </div>    
                    </div>
                </div>

                <div class="form-group">
                    <div class="row">
                         <div class="col-sm-5">
                            <label class="control-label col-sm-4" for="antena">Antena</label>
                         <div class="radio">
                            <label class="col-sm-2"><input type="radio" name="antena" <?php if(isset($antena) && ($antena == "Si")) echo "checked"; ?> value="Si">Si</label>
                            <label class="col-sm-2"><input type="radio" name="antena" <?php if(isset($antena) && ($antena == "No")) echo "checked"; ?> value="No">No</label>
                            <span class="error"><?php echo $error_antena; ?> </span>
                         </div>   
                         </div>         
                        <div class="col-sm-5">
                            <label class="control-label col-sm-4" for="lucestras">Luces traseras</label>
                        <div class="radio">
                            <label class="col-sm-2"><input type="radio" name="lucestras" <?php if(isset($lucestras) && ($lucestras == "Si")) echo "checked"; ?> value="Si">Si</label>
                            <label class="col-sm-2"><input type="radio" name="lucestras" <?php if(isset($lucestras) && ($lucestras == "No")) echo "checked"; ?> value="No">No</label>
                            <span class="error"><?php echo $error_lucestras; ?> </span>
                        </div>
                        </div>    
                    </div>
                </div>

                <div class="form-group">
                    <div class="row">
                         <div class="col-sm-5">
                            <label class="control-label col-sm-4" for="faros">Faros de niebla</label>
                         <div class="radio">
                            <label class="col-sm-2"><input type="radio" name="faros" <?php if(isset($faros) && ($faros == "Si")) echo "checked"; ?> value="Si">Si</label>
                            <label class="col-sm-2"><input type="radio" name="faros" <?php if(isset($faros) && ($faros == "No")) echo "checked"; ?> value="No">No</label>
                            <span class="error"><?php echo $error_faros; ?> </span>
                         </div>   
                         </div>                    
                    </div>
                </div>

                <br>
                <div class="form-group">
                    <label class="control-label col-sm-3" for="objetos">Objetos puesto bajo resguardo:</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" name="objetos" value="<?php echo $objetos; ?>">    
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-sm-3" for="observaciones">Observaciones:</label>
                    <div class="col-sm-8">
                        <input type="text" name="observaciones" class="form-control" value="<?php echo $observaciones; ?>">
                    </div>
                </div>
            </fieldset>
            <br>
            <fieldset>
                <legend>Fotograf&iacuteas</legend>
                <p>Para finalizar el inventario, es necesario subir seis fotograf&iacuteas.</p>
                <div class="form-group">
                    <div class="col-sm-5">
                        <input type="file" class="form-control" name="foto1" >
                        <span class="error"><?php echo $error_foto1; ?> </span> 
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-5">
                        <input type="file" class="form-control" name="foto2" >
                        <span class="error"><?php echo $error_foto2; ?> </span> 
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-5">
                        <input type="file" class="form-control" name="foto3" >
                        <span class="error"><?php echo $error_foto3; ?> </span> 
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-5">
                        <input type="file" class="form-control" name="foto4" >
                        <span class="error"><?php echo $error_foto4; ?> </span> 
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-5">
                        <input type="file" class="form-control" name="foto5" >
                        <span class="error"><?php echo $error_foto5; ?> </span> 
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-5">
                        <input type="file" class="form-control" name="foto6" >
                        <span class="error"><?php echo $error_foto6; ?> </span> 
                    </div>
                </div>
            </fieldset>
            <br>

            <!--Clausulas de servicio-->
            <p style="margin-left:10px; margin-right:10px">Este documento forma parte del contrato de prestaci&oacuten de servicio 
            de reparaci&oacuten y/o mantenimiento de veh&iacuteculos, contenido al reverso de esta p&aacutegina. De no 
            realizarse trabajo alguno y/o no aceptar las cl&aacuteusulas contractuales, <strong>el consumidor acepta pagar 
            $60.00</strong> (sesenta pesos) diarios por concepto de dep&oacutesito del veh&iacuteculo objeto del presente 
            contrato, desde su fecha de ingreso hasta el d&iacutea en que se lo lleve.</p>
            <br><br>            
            <div class="row">
                <div class="col-sm-12" style="text-align:center">
                    <button type="submit" class="btn btn-success">Guardar</button>
                </div>          
            </div>    
            <br>
        </form>      
        </div>
    
                </div>
            <!-- /. PAGE INNER  -->
        </div>
        <!-- /. PAGE WRAPPER  -->   
    </div>
    <!-- /. WRAPPER  -->

        <!-- SCRIPTS -AT THE BOTOM TO REDUCE THE LOAD TIME-->
        <!-- JQUERY SCRIPTS -->
        <script src="../assets/js/jquery-1.10.2.js"></script>
        <!-- BOOTSTRAP SCRIPTS -->
        <script src="../assets/js/bootstrap.min.js"></script>
        <!-- METISMENU SCRIPTS -->
        <script src="../assets/js/jquery.metisMenu.js"></script>
        <!-- MORRIS CHART SCRIPTS -->
        <script src="../assets/js/morris/raphael-2.1.0.min.js"></script>
        <script src="../assets/js/morris/morris.js"></script>
        <!-- CUSTOM SCRIPTS -->
        <script src="../assets/js/custom.js"></script>
    </body>
</html>
<?php } ?>