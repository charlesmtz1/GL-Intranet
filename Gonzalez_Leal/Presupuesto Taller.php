<?php
    session_start();
    if(empty($_SESSION['username'])){
        header("Location: ../login.php");
    }else{

    $buscar = null;
    $folio = $marca = $tipo = $modelo = $placas = $cia = $siniestro = null;
    $busqueda_exitosa = false;
    $error_busqueda = null;  

    $concepto1 = $cr1 = $costocr1 = $pm1 = $costopm1 = $refaccion1 = null;
    $concepto2 = $cr2 = $costocr2 = $pm2 = $costopm2 = $refaccion2 = null;
    $concepto3 = $cr3 = $costocr3 = $pm3 = $costopm3 = $refaccion3 = null;
    $concepto4 = $cr4 = $costocr4 = $pm4 = $costopm4 = $refaccion4 = null;
    $concepto5 = $cr5 = $costocr5 = $pm5 = $costopm5 = $refaccion5 = null;
    $concepto6 = $cr6 = $costocr6 = $pm6 = $costopm6 = $refaccion6 = null;
    $concepto7 = $cr7 = $costocr7 = $pm7 = $costopm7 = $refaccion7 = null;
    $concepto8 = $cr8 = $costocr8 = $pm8 = $costopm8 = $refaccion8 = null;
    $concepto9 = $cr9 = $costocr9 = $pm9 = $costopm9 = $refaccion9 = null;
    $concepto10 = $cr10 = $costocr10 = $pm10 = $costopm10 = $refaccion10 = null;
    $concepto11 = $cr11 = $costocr11 = $pm11 = $costopm11 = $refaccion11 = null;
    $concepto12 = $cr12 = $costocr12 = $pm12 = $costopm12 = $refaccion12 = null;
    $concepto13 = $cr13 = $costocr13 = $pm13 = $costopm13 = $refaccion13 = null;
    $concepto14 = $cr14 = $costocr14 = $pm14 = $costopm14 = $refaccion14 = null;
    $concepto15 = $cr15 = $costocr15 = $pm15 = $costopm15 = $refaccion15 = null;

    $total_mano_obra = null;
    $total_refacciones = null;
    $total_valuacion = null; 

    function test_input($dato){
        $dato = trim($dato);
        $dato = stripslashes($dato);
        $dato = htmlspecialchars($dato);
        return $dato;
    }

    if(isset($_POST["busqueda"])){
        $buscar = $_POST['buscar'];
        include("conexion_leal.php");

        $con = mysqli_connect($hostname, $user, $pass, $db) or die("Error al conectar con el servidor");
        $query = mysqli_query($con, "SELECT * FROM vehiculos WHERE FOLIO = '$buscar'");
        $row = mysqli_fetch_array($query, MYSQLI_ASSOC);
        mysqli_close($con);

        if($row > 0){
            $folio = $row['FOLIO'];
            $marca = $row['MARCA'];
            $tipo = $row['TIPO'];
            $modelo = $row['MODELO'];
            $placas = $row['PLACAS'];
            $cia = $row['COMPANIA'];
            $siniestro = $row['SINIESTRO'];
            $busqueda_exitosa = true;
        }
        else {
            $error_busqueda = "No se encuentra ningun folio con el número ingresado!";
        }
    }

    if (isset($_POST["guardar"])) {
        $folio = $_POST['folio'];
        include("../assets/includes/valida_presupuesto.php");

        $total_mano_obra = $costocr1 + $costopm1 + $costocr2 + $costopm2 + $costocr3 + $costopm3 + $costocr4 + $costopm4 + 
                            $costocr5 + $costopm5 + $costocr6 + $costopm6 + $costocr7 + $costopm7 + $costocr8 + $costopm8 + 
                            $costocr9 + $costopm9 + $costocr10 + $costopm10 + $costocr11 + $costopm11 + $costocr12 + $costopm12 + 
                            $costocr13 + $costopm13 + $costocr14 + $costopm14 + $costocr15 + $costopm15;

        $total_refacciones = $refaccion1 + $refaccion2 + $refaccion3 + $refaccion4 + $refaccion5 + $refaccion6 + $refaccion7 + 
                            $refaccion8 + $refaccion9 + $refaccion10 + $refaccion11 + $refaccion12 + $refaccion13 + $refaccion14 + 
                            $refaccion15;

        $total_valuacion = $total_mano_obra + $total_refacciones;

        include("conexion_leal.php");

        $con = mysqli_connect($hostname, $user, $pass, $db) or die("Error al conectar con el servidor");

        mysqli_query($con, "UPDATE presupuestos SET STATUS='Realizado',
                        CONCEPTO1='$concepto1', CAMREP1='$cr1', COSTOCR1='$costocr1', PINMEC1='$pm1', COSTOPM1='$costopm1', REFACCION1='$refaccion1',
                        CONCEPTO2='$concepto2', CAMREP2='$cr2', COSTOCR2='$costocr2', PINMEC2='$pm2', COSTOPM2='$costopm2', REFACCION2='$refaccion2',
                        CONCEPTO3='$concepto3', CAMREP3='$cr3', COSTOCR3='$costocr3', PINMEC3='$pm3', COSTOPM3='$costopm3', REFACCION3='$refaccion3',
                        CONCEPTO4='$concepto4', CAMREP4='$cr4', COSTOCR4='$costocr4', PINMEC4='$pm4', COSTOPM4='$costopm4', REFACCION4='$refaccion4',
                        CONCEPTO5='$concepto5', CAMREP5='$cr5', COSTOCR5='$costocr5', PINMEC5='$pm5', COSTOPM5='$costopm5', REFACCION5='$refaccion5',
                        CONCEPTO6='$concepto6', CAMREP6='$cr6', COSTOCR6='$costocr6', PINMEC6='$pm6', COSTOPM6='$costopm6', REFACCION6='$refaccion6',
                        CONCEPTO7='$concepto7', CAMREP7='$cr7', COSTOCR7='$costocr7', PINMEC7='$pm7', COSTOPM7='$costopm7', REFACCION7='$refaccion7',
                        CONCEPTO8='$concepto8', CAMREP8='$cr8', COSTOCR8='$costocr8', PINMEC8='$pm8', COSTOPM8='$costopm8', REFACCION8='$refaccion8',
                        CONCEPTO9='$concepto9', CAMREP9='$cr9', COSTOCR9='$costocr9', PINMEC9='$pm9', COSTOPM9='$costopm9', REFACCION9='$refaccion9',
                        CONCEPTO10='$concepto10', CAMREP10='$cr10', COSTOCR10='$costocr10', PINMEC10='$pm10', COSTOPM10='$costopm10', REFACCION10='$refaccion10',
                        CONCEPTO11='$concepto11', CAMREP11='$cr11', COSTOCR11='$costocr11', PINMEC11='$pm11', COSTOPM11='$costopm11', REFACCION11='$refaccion11',
                        CONCEPTO12='$concepto12', CAMREP12='$cr12', COSTOCR12='$costocr12', PINMEC12='$pm12', COSTOPM12='$costopm12', REFACCION12='$refaccion12',
                        CONCEPTO13='$concepto13', CAMREP13='$cr13', COSTOCR13='$costocr13', PINMEC13='$pm13', COSTOPM13='$costopm13', REFACCION13='$refaccion13',
                        CONCEPTO14='$concepto14', CAMREP14='$cr14', COSTOCR14='$costocr14', PINMEC14='$pm14', COSTOPM14='$costopm14', REFACCION14='$refaccion14',
                        CONCEPTO15='$concepto15', CAMREP15='$cr15', COSTOCR15='$costocr15', PINMEC15='$pm15', COSTOPM15='$costopm15', REFACCION15='$refaccion15',
                        TOTALMANOOBRA='$total_mano_obra', TOTALREFACCIONES='$total_refacciones', TOTALVALUACION='$total_valuacion'
                        WHERE FOLIO = '$folio'") or die("Error al guardar el inventario: ".mysqli_error($con));

        mysqli_close($con);
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
                    <li><a href="#"><i class="fa fa-edit fa-3x"></i>Inventarios<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li><a href="Nuevo Inventario.php">Nuevo inventario</a></li>
                            <li><a href="Buscar Inventario.html">Buscar inventario</a></li>
                            <li><a href="Historico inventarios.php">Hist&oacuterico de inventarios</a></li>
                        </ul>
                    </li>
                    <li><a class="active-menu" href="#"><i class="fa fa-bar-chart-o fa-3x"></i>Presupuestos<span class="fa arrow"></span></a>
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
                            <span class="icon-box bg-color-green set-icon"><i class="fa fa-bar-chart-o"></i></span>
                            <div class="text-box">
                                <p class="main-text" style="text-align:center;">Nuevo presupuesto para taller</p>
                            </div>
                        </div>
                        <hr/>
                    </div>
                </div>
                <form class="form-horizontal" action="<?php $_SERVER["PHP_SELF"] ?>" method="POST">
                    <fieldset>
                        <p>Para realizar el presupuesto de un veh&iacuteculo, escriba el n&uacutemero de folio generado
                            en su inventario:
                        </p>
                        <br>
                        <div class="form-group">
                            <div class="col-sm-3">
                                <input type="text" class="form-control" name="buscar" placeholder="Escriba num. de folio">
                            </div>
                            <div class="col-sm-1">
                                <button type="submit" class="btn btn-success" name="busqueda">Buscar</button>
                            </div>
                        </div>
                    </fieldset>
                </form>
                <br><br>
                <?php 
                    if($busqueda_exitosa == true){
                ?>
                <form class="form-horizontal">
                    <fieldset>
                        <legend>Datos del veh&iacuteculo</legend>
                        <div class="form-group">
                            <label class="control-label col-sm-1" for="marca">Marca:</label>
                            <div class="col-sm-2">
                                <input type="text" class="form-control" name="marca" value="<?php echo $marca ?>" readonly >
                            </div>
                            <label class="control-label col-sm-1" for="tipo">Tipo:</label>
                            <div class="col-sm-2">
                                <input type="text" class="form-control" name="tipo" value="<?php echo $tipo ?>" readonly >
                            </div>
                            <label class="control-label col-sm-1" for="modelo">Modelo:</label>
                            <div class="col-sm-1">
                                <input type="text" class="form-control" name="modelo" value="<?php echo $modelo ?>" readonly >
                            </div>
                            <label class="control-label col-sm-1" for="placas">Placas:</label>
                            <div class="col-sm-2">
                            <input type="text" class="form-control" name="placas" value="<?php echo $placas ?>" readonly>    
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-sm-1" for="cia">Compa&ntildeia:</label>
                            <div class="col-sm-2">
                                <input type="text" class="form-control" name="cia" value="<?php echo $cia ?>" readonly >
                            </div>
                            <label class="control-label col-sm-1" for="siniestro">Siniestro:</label>
                            <div class="col-sm-2">
                                <input type="text" class="form-control" name="siniestro" value="<?php echo $siniestro ?>" readonly>    
                            </div>
                        </div>
                    </fieldset>
                </form>
                <br>
                <form class="form-horizontal" oninput="
                                            pinturamecanicatotal.value = parseFloat(b1.value) + parseFloat(b2.value) + parseFloat(b3.value) + parseFloat(b4.value)
                                            + parseFloat(b5.value) + parseFloat(b6.value) + parseFloat(b7.value) + parseFloat(b8.value) + parseFloat(b9.value)
                                            + parseFloat(b10.value) + parseFloat(b11.value) + parseFloat(b12.value) + parseFloat(b13.value) + parseFloat(b14.value)
                                            + parseFloat(b15.value);
                                            
                                            refacciontotal.value = parseFloat(c1.value) + parseFloat(c2.value) + parseFloat(c3.value) + parseFloat(c4.value)
                                            + parseFloat(c5.value) + parseFloat(c6.value) + parseFloat(c7.value) + parseFloat(c8.value) + parseFloat(c9.value)
                                            + parseFloat(c10.value) + parseFloat(c11.value) + parseFloat(c12.value) + parseFloat(c13.value) + parseFloat(c14.value)
                                            + parseFloat(c15.value);
                                            
                                            cambioreparaciontotal.value = parseFloat(a1.value) + parseFloat(a2.value) + parseFloat(a3.value) + parseFloat(a4.value)
                                            + parseFloat(a5.value) + parseFloat(a6.value) + parseFloat(a7.value) + parseFloat(a8.value) + parseFloat(a9.value)
                                            + parseFloat(a10.value) + parseFloat(a11.value) + parseFloat(a12.value) + parseFloat(a13.value) + parseFloat(a14.value)
                                            + parseFloat(a15.value);
                                            
                                            totalmanoobra.value = parseFloat(cambioreparaciontotal.value) + parseFloat(pinturamecanicatotal.value);

                                            totalrefacciones.value = parseFloat(refacciontotal.value);

                                            totalvaluacion.value = parseFloat(totalmanoobra.value) + parseFloat(totalrefacciones.value);
                                            "
                                    action="<?php $_SERVER["PHP_SELF"] ?>" method="POST">
                    <fieldset>
                    <legend style="text-align:center">Costo por pieza</legend>
                    <input type="hidden" name="folio" value="<?php echo $folio ?>">
                    <div class="form-group" style="text-align:center">
                        <div class="col-sm-1"></div>
                        <div class="col-sm-3">
                            <label for="concepto">Concepto</label>
                        </div>
                        <div class="col-sm-2">
                            <label for="cambio">Cambio / Reparaci&oacuten</label>
                        </div>
                        <div class="col-sm-1">
                            <label for="costo">Costo</label>
                        </div>
                        <div class="col-sm-2">
                            <label for="pintura">Pintura / Mec&aacutenica</label>
                        </div>
                        <div class="col-sm-1">
                            <label for="costo">Costo</label>
                        </div>
                        <div class="col-sm-1">
                            <label for="refaccion">Refacci&oacuten</label>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-sm-1"></div>
                        <div class="col-sm-3">
                            <input type="text" class="form-control" name="concepto1">
                        </div>
                        <div class="col-sm-2">
                            <select class="form-control" name="cr1">
                                <option value="Cambio">Cambio</option>
                                <option value="Reparacion">Reparaci&oacuten</option>
                            </select>
                        </div>
                        <div class="col-sm-1">
                            <input type="text" class="form-control" id="a1" name="costocr1" value="0" maxlength="5">
                        </div>
                        <div class="col-sm-2">
                            <select class="form-control" name="pm1">
                                <option value="Pintura">Pintura</option>
                                <option value="Mecanica">Mec&aacutenica</option>
                            </select>
                        </div>
                        <div class="col-sm-1">
                            <input type="text" class="form-control" id="b1" name="costopm1" value="0" maxlength="5">
                        </div>
                        <div class="col-sm-1">
                            <input type="text" class="form-control" id="c1" name="refaccion1" value="0" maxlength="5">
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-sm-1"></div>
                        <div class="col-sm-3">
                            <input type="text" class="form-control" name="concepto2">
                        </div>
                        <div class="col-sm-2">
                            <select class="form-control" name="cr2">
                                <option value="Cambio">Cambio</option>
                                <option value="Reparacion">Reparaci&oacuten</option>
                            </select>
                        </div>
                        <div class="col-sm-1">
                            <input type="text" class="form-control" id="a2" name="costocr2" value="0" maxlength="5">
                        </div>
                        <div class="col-sm-2">
                            <select class="form-control" name="pm2">
                                <option value="Pintura">Pintura</option>
                                <option value="Mecanica">Mec&aacutenica</option>
                            </select>
                        </div>
                        <div class="col-sm-1">
                            <input type="text" class="form-control" id="b2" name="costopm2" value="0" maxlength="5">
                        </div>
                        <div class="col-sm-1">
                            <input type="text" class="form-control" id="c2" name="refaccion2" value="0" maxlength="5">
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-sm-1"></div>
                        <div class="col-sm-3">
                            <input type="text" class="form-control" name="concepto3">
                        </div>
                        <div class="col-sm-2">
                            <select class="form-control" name="cr3">
                                <option value="Cambio">Cambio</option>
                                <option value="Reparacion">Reparaci&oacuten</option>
                            </select>
                        </div>
                        <div class="col-sm-1">
                            <input type="text" class="form-control" id="a3" name="costocr3" value="0" maxlength="5">
                        </div>
                        <div class="col-sm-2">
                            <select class="form-control" name="pm3">
                                <option value="Pintura">Pintura</option>
                                <option value="Mecanica">Mec&aacutenica</option>
                            </select>
                        </div>
                        <div class="col-sm-1">
                            <input type="text" class="form-control" id="b3" name="costopm3" value="0" maxlength="5">
                        </div>
                        <div class="col-sm-1">
                            <input type="text" class="form-control" id="c3" name="refaccion3" value="0" maxlength="5">
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <div class="col-sm-1"></div>
                        <div class="col-sm-3">
                            <input type="text" class="form-control" name="concepto4">
                        </div>
                        <div class="col-sm-2">
                            <select class="form-control" name="cr4">
                                <option value="Cambio">Cambio</option>
                                <option value="Reparacion">Reparaci&oacuten</option>
                            </select>
                        </div>
                        <div class="col-sm-1">
                            <input type="text" class="form-control" id="a4" name="costocr4" value="0" maxlength="5">
                        </div>
                        <div class="col-sm-2">
                            <select class="form-control" name="pm4">
                                <option value="Pintura">Pintura</option>
                                <option value="Mecanica">Mec&aacutenica</option>
                            </select>
                        </div>
                        <div class="col-sm-1">
                            <input type="text" class="form-control" id="b4" name="costopm4" value="0" maxlength="5">
                        </div>
                        <div class="col-sm-1">
                            <input type="text" class="form-control" id="c4" name="refaccion4" value="0" maxlength="5">
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-sm-1"></div>
                        <div class="col-sm-3">
                            <input type="text" class="form-control" name="concepto5">
                        </div>
                        <div class="col-sm-2">
                            <select class="form-control" name="cr5">
                                <option value="Cambio">Cambio</option>
                                <option value="Reparacion">Reparaci&oacuten</option>
                            </select>
                        </div>
                        <div class="col-sm-1">
                            <input type="text" class="form-control" id="a5" name="costocr5" value="0" maxlength="5">
                        </div>
                        <div class="col-sm-2">
                            <select class="form-control" name="pm5">
                                <option value="Pintura">Pintura</option>
                                <option value="Mecanica">Mec&aacutenica</option>
                            </select>
                        </div>
                        <div class="col-sm-1">
                            <input type="text" class="form-control" id="b5" name="costopm5" value="0" maxlength="5">
                        </div>
                        <div class="col-sm-1">
                            <input type="text" class="form-control" id="c5" name="refaccion5" value="0" maxlength="5">
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-sm-1"></div>
                        <div class="col-sm-3">
                            <input type="text" class="form-control" name="concepto6">
                        </div>
                        <div class="col-sm-2">
                            <select class="form-control" name="cr6">
                                <option value="Cambio">Cambio</option>
                                <option value="Reparacion">Reparaci&oacuten</option>
                            </select>
                        </div>
                        <div class="col-sm-1">
                            <input type="text" class="form-control" id="a6" name="costocr6" value="0" maxlength="5">
                        </div>
                        <div class="col-sm-2">
                            <select class="form-control" name="pm6">
                                <option value="Pintura">Pintura</option>
                                <option value="Mecanica">Mec&aacutenica</option>
                            </select>
                        </div>
                        <div class="col-sm-1">
                            <input type="text" class="form-control" id="b6" name="costopm6" value="0" maxlength="5">
                        </div>
                        <div class="col-sm-1">
                            <input type="text" class="form-control" id="c6" name="refaccion6" value="0" maxlength="5">
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-sm-1"></div>
                        <div class="col-sm-3">
                            <input type="text" class="form-control" name="concepto7">
                        </div>
                        <div class="col-sm-2">
                            <select class="form-control" name="cr7">
                                <option value="Cambio">Cambio</option>
                                <option value="Reparacion">Reparaci&oacuten</option>
                            </select>
                        </div>
                        <div class="col-sm-1">
                            <input type="text" class="form-control" id="a7" name="costocr7" value="0" maxlength="5">
                        </div>
                        <div class="col-sm-2">
                            <select class="form-control" name="pm7">
                                <option value="Pintura">Pintura</option>
                                <option value="Mecanica">Mec&aacutenica</option>
                            </select>
                        </div>
                        <div class="col-sm-1">
                            <input type="text" class="form-control" id="b7" name="costopm7" value="0" maxlength="5">
                        </div>
                        <div class="col-sm-1">
                            <input type="text" class="form-control" id="c7" name="refaccion7" value="0" maxlength="5">
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-sm-1"></div>
                        <div class="col-sm-3">
                            <input type="text" class="form-control" name="concepto8">
                        </div>
                        <div class="col-sm-2">
                            <select class="form-control" name="cr8">
                                <option value="Cambio">Cambio</option>
                                <option value="Reparacion">Reparaci&oacuten</option>
                            </select>
                        </div>
                        <div class="col-sm-1">
                            <input type="text" class="form-control" id="a8" name="costocr8" value="0" maxlength="5">
                        </div>
                        <div class="col-sm-2">
                            <select class="form-control" name="pm8">
                                <option value="Pintura">Pintura</option>
                                <option value="Mecanica">Mec&aacutenica</option>
                            </select>
                        </div>
                        <div class="col-sm-1">
                            <input type="text" class="form-control" id="b8" name="costopm8" value="0" maxlength="5">
                        </div>
                        <div class="col-sm-1">
                            <input type="text" class="form-control" id="c8" name="refaccion8" value="0" maxlength="5">
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-sm-1"></div>
                        <div class="col-sm-3">
                            <input type="text" class="form-control" name="concepto9">
                        </div>
                        <div class="col-sm-2">
                            <select class="form-control" name="cr9">
                                <option value="Cambio">Cambio</option>
                                <option value="Reparacion">Reparaci&oacuten</option>
                            </select>
                        </div>
                        <div class="col-sm-1">
                            <input type="text" class="form-control" id="a9" name="costocr9" value="0" maxlength="5">
                        </div>
                        <div class="col-sm-2">
                            <select class="form-control" name="pm9">
                                <option value="Pintura">Pintura</option>
                                <option value="Mecanica">Mec&aacutenica</option>
                            </select>
                        </div>
                        <div class="col-sm-1">
                            <input type="text" class="form-control" id="b9" name="costopm9" value="0" maxlength="5">
                        </div>
                        <div class="col-sm-1">
                            <input type="text" class="form-control" id="c9" name="refaccion9" value="0" maxlength="5">
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-sm-1"></div>
                        <div class="col-sm-3">
                            <input type="text" class="form-control" name="concepto10">
                        </div>
                        <div class="col-sm-2">
                            <select class="form-control" name="cr10">
                                <option value="Cambio">Cambio</option>
                                <option value="Reparacion">Reparaci&oacuten</option>
                            </select>
                        </div>
                        <div class="col-sm-1">
                            <input type="text" class="form-control" id="a10" name="costocr10" value="0" maxlength="5">
                        </div>
                        <div class="col-sm-2">
                            <select class="form-control" name="pm10">
                                <option value="Pintura">Pintura</option>
                                <option value="Mecanica">Mec&aacutenica</option>
                            </select>
                        </div>
                        <div class="col-sm-1">
                            <input type="text" class="form-control" id="b10" name="costopm10" value="0" maxlength="5">
                        </div>
                        <div class="col-sm-1">
                            <input type="text" class="form-control" id="c10" name="refaccion10" value="0" maxlength="5">
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-sm-1"></div>
                        <div class="col-sm-3">
                            <input type="text" class="form-control" name="concepto11">
                        </div>
                        <div class="col-sm-2">
                            <select class="form-control" name="cr11">
                                <option value="Cambio">Cambio</option>
                                <option value="Reparacion">Reparaci&oacuten</option>
                            </select>
                        </div>
                        <div class="col-sm-1">
                            <input type="text" class="form-control" id="a11" name="costocr11" value="0" maxlength="5">
                        </div>
                        <div class="col-sm-2">
                            <select class="form-control" name="pm11">
                                <option value="Pintura">Pintura</option>
                                <option value="Mecanica">Mec&aacutenica</option>
                            </select>
                        </div>
                        <div class="col-sm-1">
                            <input type="text" class="form-control" id="b11" name="costopm11" value="0" maxlength="5">
                        </div>
                        <div class="col-sm-1">
                            <input type="text" class="form-control" id="c11" name="refaccion11" value="0" maxlength="5">
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-sm-1"></div>
                        <div class="col-sm-3">
                            <input type="text" class="form-control" name="concepto12">
                        </div>
                        <div class="col-sm-2">
                            <select class="form-control" name="cr12">
                                <option value="Cambio">Cambio</option>
                                <option value="Reparacion">Reparaci&oacuten</option>
                            </select>
                        </div>
                        <div class="col-sm-1">
                            <input type="text" class="form-control" id="a12" name="costocr12" value="0" maxlength="5">
                        </div>
                        <div class="col-sm-2">
                            <select class="form-control" name="pm12">
                                <option value="Pintura">Pintura</option>
                                <option value="Mecanica">Mec&aacutenica</option>
                            </select>
                        </div>
                        <div class="col-sm-1">
                            <input type="text" class="form-control" id="b12" name="costopm12" value="0" maxlength="5">
                        </div>
                        <div class="col-sm-1">
                            <input type="text" class="form-control" id="c12" name="refaccion12" value="0" maxlength="5">
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-sm-1"></div>
                        <div class="col-sm-3">
                            <input type="text" class="form-control" name="concepto13">
                        </div>
                        <div class="col-sm-2">
                            <select class="form-control" name="cr13">
                                <option value="Cambio">Cambio</option>
                                <option value="Reparacion">Reparaci&oacuten</option>
                            </select>
                        </div>
                        <div class="col-sm-1">
                            <input type="text" class="form-control" id="a13" name="costocr13" value="0" maxlength="5">
                        </div>
                        <div class="col-sm-2">
                            <select class="form-control" name="pm13">
                                <option value="Pintura">Pintura</option>
                                <option value="Mecanica">Mec&aacutenica</option>
                            </select>
                        </div>
                        <div class="col-sm-1">
                            <input type="text" class="form-control" id="b13" name="costopm13" value="0" maxlength="5">
                        </div>
                        <div class="col-sm-1">
                            <input type="text" class="form-control" id="c13" name="refaccion13" value="0" maxlength="5">
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-sm-1"></div>
                        <div class="col-sm-3">
                            <input type="text" class="form-control" name="concepto14">
                        </div>
                        <div class="col-sm-2">
                            <select class="form-control" name="cr14">
                                <option value="Cambio">Cambio</option>
                                <option value="Reparacion">Reparaci&oacuten</option>
                            </select>
                        </div>
                        <div class="col-sm-1">
                            <input type="text" class="form-control" id="a14" name="costocr14" value="0" maxlength="5">
                        </div>
                        <div class="col-sm-2">
                            <select class="form-control" name="pm14">
                                <option value="Pintura">Pintura</option>
                                <option value="Mecanica">Mec&aacutenica</option>
                            </select>
                        </div>
                        <div class="col-sm-1">
                            <input type="text" class="form-control" id="b14" name="costopm14" value="0" maxlength="5">
                        </div>
                        <div class="col-sm-1">
                            <input type="text" class="form-control" id="c14" name="refaccion14" value="0" maxlength="5">
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-sm-1"></div>
                        <div class="col-sm-3">
                            <input type="text" class="form-control" name="concepto15">
                        </div>
                        <div class="col-sm-2">
                            <select class="form-control" name="cr15">
                                <option value="Cambio">Cambio</option>
                                <option value="Reparacion">Reparaci&oacuten</option>
                            </select>
                        </div>
                        <div class="col-sm-1">
                            <input type="text" class="form-control" id="a15" name="costocr15" value="0" maxlength="5">
                        </div>
                        <div class="col-sm-2">
                            <select class="form-control" name="pm15">
                                <option value="Pintura">Pintura</option>
                                <option value="Mecanica">Mec&aacutenica</option>
                            </select>
                        </div>
                        <div class="col-sm-1">
                            <input type="text" class="form-control" id="b15" name="costopm15" value="0" maxlength="5">
                        </div>
                        <div class="col-sm-1">
                            <input type="text" class="form-control" id="c15" name="refaccion15" value="0" maxlength="5">
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-sm-2"></div>
                        <div class="col-sm-4" style="text-align:right">
                            <label for="concepto">Totales</label>
                        </div>
                        <div class="col-sm-1">
                            <strong>$<output name="cambioreparaciontotal" for="a1 " style="display:inline"></output></strong>
                        </div>
                        <div class="col-sm-2"></div>
                        <div class="col-sm-1">
                            <strong>$<output name="pinturamecanicatotal" for="b1" style="display:inline"></output></strong>
                        </div>
                        <div class="col-sm-1">
                            <strong>$<output name="refacciontotal" for="c1" style="display:inline"></output></strong>
                        </div>
                    </div>                                  
                    </fieldset>
                    <br>
                    <fieldset>
                    <div class="form-group">
                        <div class="col-sm-1"></div>
                        <div class="col-sm-3">
                            <table class="table table-striped table-bordered">
                                <thead>
                                    <th colspan="2">Totales del presupuesto</th>
                                </thead>
                                <tr>
                                    <td><label for="concepto">Total mano de obra</label></td>
                                    <td><strong>$<output name="totalmanoobra" for="a1" style="display:inline"></output></strong></td>
                                </tr>
                                <tr>
                                    <td><label for="concepto">Total de refacciones</label></td>
                                    <td><strong>$<output name="totalrefacciones" for="a1" style="display:inline"></output></strong></td>
                                </tr>
                                <tr>
                                    <td><label for="concepto">Total de la valuaci&oacuten</label></td>
                                    <td><strong>$<output name="totalvaluacion" for="a1" style="display:inline"></output></strong></td>
                                </tr>
                            </table>
                        </div>
                    </div> 
                    </fieldset>
                    <br>
                    <div class="row">
                        <div class="col-sm-12" style="text-align:center">
                            <button type="submit" class="btn btn-success" name="guardar">Guardar</button>
                        </div>
                    </div>
                    <br>
                </form>
                <?php 
                }else {
                    echo "<span class='error' style='font-size:20px'>" . $error_busqueda ."</span>";
                } ?>
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