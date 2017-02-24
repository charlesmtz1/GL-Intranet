<?php
    session_start();
    if(empty($_SESSION['username'])){
        header("Location: ../login.php");
    }else{
        $folio = $_GET['folio'];
        include("conexion_leal.php");

        $con = mysqli_connect($hostname, $user, $pass, $db) or die("Error al conectar con el servidor");

        if (isset($_POST['terminar'])) {
            $terminar = $_POST['folio'];

            mysqli_query($con, "UPDATE vehiculos SET STATUS = 'Terminado' WHERE FOLIO = '$terminar'");
            mysqli_query($con, "UPDATE presupuestos SET STATUS = 'Realizado' WHERE FOLIO = '$terminar'");
            header("Location: Menu.php");
        }


        $query = mysqli_query($con, "SELECT * FROM vehiculos WHERE FOLIO = '$_GET[folio]'");
        $row = mysqli_fetch_array($query, MYSQLI_ASSOC);

        $query = mysqli_query($con, "SELECT * FROM clientes WHERE FOLIO = '$_GET[folio]'");
        $row2 = mysqli_fetch_array($query, MYSQLI_ASSOC);

        $query = mysqli_query($con, "SELECT * FROM inventarios WHERE FOLIO = '$_GET[folio]'");
        $row3 = mysqli_fetch_array($query, MYSQLI_ASSOC);

        $query = mysqli_query($con, "SELECT * FROM presupuestos WHERE FOLIO = '$_GET[folio]'");
        $row4 = mysqli_fetch_array($query, MYSQLI_ASSOC);

        $query = mysqli_query($con, "SELECT * FROM vales WHERE FOLIO = '$_GET[folio]'");


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
				    <li><a class="active-menu" href="Vehiculos en taller.php"><i class="fa fa-dashboard fa-3x"></i>Veh&iacuteculos en taller</a></li>
                    <li><a href="Vehiculos para entregar.php"><i class="fa fa-dashboard fa-3x"></i>Veh&iacuteculos para entregar</a></li>
                    <li><a href="#"><i class="fa fa-edit fa-3x"></i>Inventarios<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li><a href="Nuevo Inventario.php">Nuevo inventario</a></li>
                            <li><a href="Historico Inventarios.php">Historico de inventarios</a></li>
                        </ul>
                    </li>
                    <li><a href="#"><i class="fa fa-bar-chart-o fa-3x"></i>Presupuestos<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li><a href="Presupuesto Taller.php">Nuevo presupuesto para taller</a></li>
                            <li><a href="Presupuestos Pendientes.php">Presupuestos pendientes</a></li>
                        </ul>
                    </li>
                    <li><a href="#"><i class="fa fa-square-o fa-3x"></i>Vales<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li><a href="Nuevo Vale.php">Nuevo vale</a></li>
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
                            <span class="icon-box bg-color-green set-icon"><i class="fa fa-dashboard"></i></span>
                            <div class="text-box">
                                <p class="main-text" style="text-align:center;"><?php echo $row['MARCA']." ".$row['TIPO']." ".$row['MODELO'] ?></p>
                            </div>
                        </div>
                        <hr/>
                    </div>
                </div>
                <!-- /. ROW  -->
                
                <ul class="nav nav-tabs">
                    <li class="active"><a data-toggle="tab" href="#home">Resumen</a></li>
                    <li><a data-toggle="tab" href="#menu1">Inventario</a></li>
                    <li><a data-toggle="tab" href="#menu2">Presupuesto</a></li>
                    <li><a data-toggle="tab" href="#menu3">Vales</a></li>
                    <li><a data-toggle="tab" href="#menu4">Fotos</a></li>
                    <li><a data-toggle="tab" href="#menu5">Terminar veh&iacuteculo</a></li>
                </ul>

<!----------------------------------Resumen con datos del cliente y vehiculo---------------------------------------------->
                <div class="tab-content">
                    <div id="home" class="tab-pane fade in active">
                        <h3>Resumen</h3>
                        <center><h3>Datos del Cliente</h3></center>
                        <br>
                        <div class="row">
                            <div class="col-sm-1"><strong>Nombre:</strong></div>
                            <div class="col-sm-4">
                                <?php echo $row2['NOMBRE']; ?>
                            </div> 
                            <div class="col-sm-1"><strong>Domicilio:</strong></div>
                            <div class="col-sm-4">
                                <?php echo $row2['DOMICILIO']; ?>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-sm-1"><strong>Colonia:</strong></div>
                            <div class="col-sm-3">
                                <?php echo $row2['COLONIA']; ?>
                            </div> 
                            <div class="col-sm-1"><strong>Municipio:</strong></div>
                            <div class="col-sm-3">
                                <?php echo $row2['MUNICIPIO']; ?>
                            </div>
                            <div class="col-sm-1"><strong>R.F.C.:</strong></div>
                            <div class="col-sm-2">
                                <?php echo $row2['RFC']; ?>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-sm-1"><strong>Telefono:</strong></div>
                            <div class="col-sm-2">
                                <?php echo $row2['TELEFONO']; ?>
                            </div> 
                            <div class="col-sm-1"><strong>Celular:</strong></div>
                            <div class="col-sm-2">
                                <?php echo $row2['CELULAR']; ?>
                            </div>
                            <div class="col-sm-1"><strong>E-Mail:</strong></div>
                            <div class="col-sm-3">
                                <?php echo $row2['EMAIL']; ?>
                            </div>
                        </div>
                        <br>
                        <center><h3>Datos del veh&iacuteculo</h3></center>
                        <br>
                        <div class="row">
                            <div class="col-sm-1"><strong>Marca:</strong></div>
                            <div class="col-sm-2">
                                <?php echo $row['MARCA']; ?>
                            </div> 
                            <div class="col-sm-1"><strong>Tipo:</strong></div>
                            <div class="col-sm-2">
                                <?php echo $row['TIPO']; ?>
                            </div>
                            <div class="col-sm-1"><strong>Modelo:</strong></div>
                            <div class="col-sm-1">
                                <?php echo $row['MODELO']; ?>
                            </div>
                            <div class="col-sm-1"><strong>Placas:</strong></div>
                            <div class="col-sm-2">
                                <?php echo $row['PLACAS']; ?>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-sm-1"><strong>Compañia:</strong></div>
                            <div class="col-sm-2">
                                <?php echo $row['COMPANIA']; ?>
                            </div> 
                            <div class="col-sm-1"><strong>Siniestro:</strong></div>
                            <div class="col-sm-2">
                                <?php echo $row['SINIESTRO']; ?>
                            </div>
                            <div class="col-sm-1"><strong>Color:</strong></div>
                            <div class="col-sm-2">
                                <?php echo $row['COLOR']; ?>
                            </div>
                            <div class="col-sm-1"><strong>Puertas:</strong></div>
                            <div class="col-sm-1">
                                <?php echo $row['PUERTAS']; ?>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-sm-2"><strong>Fecha de ingreso:</strong></div>
                            <div class="col-sm-3">
                                <?php echo $row['FECHA']; ?>
                            </div>
                        </div>
                    </div>
<!----------------------------------Inventario del vehiculo-------------------------------------------------------------->
                    <div id="menu1" class="tab-pane fade">
                        <center><h3>Inventario del veh&iacuteculo</h3></center>
                        <br>
                        <div class="row">
                            <div class="col-sm-2"><strong>Kilometros:</strong></div>
                            <div class="col-sm-2">
                                <?php echo $row3['KILOMETROS']; ?>
                            </div> 
                            <div class="col-sm-2"><strong>Gasolina:</strong></div>
                            <div class="col-sm-2">
                                <?php echo $row3['GASOLINA']; ?>
                            </div>
                        </div>
                        <br><br><br>
                        <div class="row">
                            <div class="col-sm-2"><strong>Llanta refacci&oacuten:</strong></div>
                            <div class="col-sm-1">
                                <?php echo $row3['LLANTAREF']; ?>
                            </div> 
                            <div class="col-sm-2"><strong>Gato:</strong></div>
                            <div class="col-sm-1">
                                <?php echo $row3['GATO']; ?>
                            </div>
                            <div class="col-sm-2"><strong>Extinguidor:</strong></div>
                            <div class="col-sm-1">
                                <?php echo $row3['EXTINGUIDOR']; ?>
                            </div>
                            <div class="col-sm-2"><strong>Estereo:</strong></div>
                            <div class="col-sm-1">
                                <?php echo $row3['ESTEREO']; ?>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-sm-2"><strong>Parabrisas:</strong></div>
                            <div class="col-sm-1">
                                <?php echo $row3['PARABRISAS']; ?>
                            </div> 
                            <div class="col-sm-2"><strong>Herramienta:</strong></div>
                            <div class="col-sm-1">
                                <?php echo $row3['HERRAMIENTA']; ?>
                            </div>
                            <div class="col-sm-2"><strong>Espejos laterales:</strong></div>
                            <div class="col-sm-1">
                                <?php echo $row3['ESPEJOSLAT']; ?>
                            </div>
                            <div class="col-sm-2"><strong>Polveras de rueda:</strong></div>
                            <div class="col-sm-1">
                                <?php echo $row3['POLVERAS']; ?>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-sm-2"><strong>Tapete del y tras:</strong></div>
                            <div class="col-sm-1">
                                <?php echo $row3['TAPETES']; ?>
                            </div> 
                            <div class="col-sm-2"><strong>Cubreasientos:</strong></div>
                            <div class="col-sm-1">
                                <?php echo $row3['CUBREASIENTOS']; ?>
                            </div>
                            <div class="col-sm-2"><strong>Encendedor:</strong></div>
                            <div class="col-sm-1">
                                <?php echo $row3['ENCENDEDOR']; ?>
                            </div>
                            <div class="col-sm-2"><strong>Tapete de cajuela:</strong></div>
                            <div class="col-sm-1">
                                <?php echo $row3['CAJUELA']; ?>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-sm-2"><strong>Antena:</strong></div>
                            <div class="col-sm-1">
                                <?php echo $row3['ANTENA']; ?>
                            </div> 
                            <div class="col-sm-2"><strong>Faros de niebla:</strong></div>
                            <div class="col-sm-1">
                                <?php echo $row3['FAROS']; ?>
                            </div>
                            <div class="col-sm-2"><strong>Emblema frente:</strong></div>
                            <div class="col-sm-1">
                                <?php echo $row3['EMBLEMAFRENTE']; ?>
                            </div>
                            <div class="col-sm-2"><strong>Emblema costado:</strong></div>
                            <div class="col-sm-1">
                                <?php echo $row3['EMBLEMACOSTADO']; ?>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-sm-2"><strong>Moldura derecha:</strong></div>
                            <div class="col-sm-1">
                                <?php echo $row3['MOLDURADER']; ?>
                            </div> 
                            <div class="col-sm-2"><strong>Moldura izquierda:</strong></div>
                            <div class="col-sm-1">
                                <?php echo $row3['MOLDURAIZQ']; ?>
                            </div>
                            <div class="col-sm-2"><strong>Reflejantes der.:</strong></div>
                            <div class="col-sm-1">
                                <?php echo $row3['REFLEJANTESDER']; ?>
                            </div>
                            <div class="col-sm-2"><strong>Reflejantes izq.:</strong></div>
                            <div class="col-sm-1">
                                <?php echo $row3['REFLEJANTESIZQ']; ?>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-sm-2"><strong>Espejo retrovisor:</strong></div>
                            <div class="col-sm-1">
                                <?php echo $row3['ESPEJORETRO']; ?>
                            </div> 
                            <div class="col-sm-2"><strong>Tapon gasolina:</strong></div>
                            <div class="col-sm-1">
                                <?php echo $row3['TAPON']; ?>
                            </div>
                            <div class="col-sm-2"><strong>Limpiabrisas:</strong></div>
                            <div class="col-sm-1">
                                <?php echo $row3['LIMPIABRISAS']; ?>
                            </div>
                            <div class="col-sm-2"><strong>Parasoles:</strong></div>
                            <div class="col-sm-1">
                                <?php echo $row3['PARASOLES']; ?>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-sm-2"><strong>Claxon:</strong></div>
                            <div class="col-sm-1">
                                <?php echo $row3['CLAXON']; ?>
                            </div> 
                            <div class="col-sm-2"><strong>Luces delanteras:</strong></div>
                            <div class="col-sm-1">
                                <?php echo $row3['LUCESDEL']; ?>
                            </div>
                            <div class="col-sm-2"><strong>Luces traseras:</strong></div>
                            <div class="col-sm-1">
                                <?php echo $row3['LUCESTRAS']; ?>
                            </div>
                        </div>
                        <br><br><br>
                        <div class="row">
                            <div class="col-sm-3"><strong>Objetos puesto bajo resguardo:</strong></div>
                            <div class="col-sm-5">
                                <?php echo $row3['OBJETOS']; ?>
                            </div>
                        </div>
                        <br>    
                        <div class="row">
                            <div class="col-sm-2"><strong>Observaciones:</strong></div>
                            <div class="col-sm-5">
                                <?php echo $row3['OBSERVACIONES']; ?>
                            </div>
                        </div>
                     </div>
<!----------------------------------Presupuesto del vehiculo-------------------------------------------------------------->
                    <div id="menu2" class="tab-pane fade">
                        <center><h3>Presupuesto</h3></center>
                        <br><br>

                        <div class="row">
                            <div class="col-sm-2"></div>
                            <div class="col-sm-8">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Concepto</th>
                                            <th>Cambio / Reparaci&oacuten</th>
                                            <th>Costo</th>
                                            <th>Pintura / Mec&aacutenica</th>
                                            <th>Costo</th>
                                            <th>Refacci&oacuten</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td><?php echo $row4['CONCEPTO1']; ?></td>
                                            <td><?php echo $row4['CAMREP1']; ?></td>
                                            <td><?php 
                                                    if ($row4['COSTOCR1'] == 0) {
                                                        echo "";
                                                    } else {
                                                        echo "$".$row4['COSTOCR1'];
                                                    }
                                                ?>
                                            </td>
                                            <td><?php echo $row4['PINMEC1']; ?></td>
                                            <td>
                                                <?php 
                                                    if ($row4['COSTOPM1'] == 0) {
                                                        echo "";
                                                    } else {
                                                        echo "$".$row4['COSTOPM1'];
                                                    }
                                                ?>
                                            </td>
                                            <td>
                                                <?php 
                                                    if ($row4['REFACCION1'] == 0) {
                                                        echo "";
                                                    } else {
                                                        echo "$".$row4['REFACCION1'];
                                                    }
                                                ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><?php echo $row4['CONCEPTO2']; ?></td>
                                            <td><?php echo $row4['CAMREP2']; ?></td>
                                            <td><?php 
                                                    if ($row4['COSTOCR2'] == 0) {
                                                        echo "";
                                                    } else {
                                                        echo "$".$row4['COSTOCR2'];
                                                    }
                                                ?>
                                            </td>
                                            <td><?php echo $row4['PINMEC2']; ?></td>
                                            <td>
                                                <?php 
                                                    if ($row4['COSTOPM2'] == 0) {
                                                        echo "";
                                                    } else {
                                                        echo "$".$row4['COSTOPM2'];
                                                    }
                                                ?>
                                            </td>
                                            <td>
                                                <?php 
                                                    if ($row4['REFACCION2'] == 0) {
                                                        echo "";
                                                    } else {
                                                        echo "$".$row4['REFACCION2'];
                                                    }
                                                ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><?php echo $row4['CONCEPTO3']; ?></td>
                                            <td><?php echo $row4['CAMREP3']; ?></td>
                                            <td><?php 
                                                    if ($row4['COSTOCR3'] == 0) {
                                                        echo "";
                                                    } else {
                                                        echo "$".$row4['COSTOCR3'];
                                                    }
                                                ?>
                                            </td>
                                            <td><?php echo $row4['PINMEC3']; ?></td>
                                            <td>
                                                <?php 
                                                    if ($row4['COSTOPM3'] == 0) {
                                                        echo "";
                                                    } else {
                                                        echo "$".$row4['COSTOPM3'];
                                                    }
                                                ?>
                                            </td>
                                            <td>
                                                <?php 
                                                    if ($row4['REFACCION3'] == 0) {
                                                        echo "";
                                                    } else {
                                                        echo "$".$row4['REFACCION3'];
                                                    }
                                                ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><?php echo $row4['CONCEPTO4']; ?></td>
                                            <td><?php echo $row4['CAMREP4']; ?></td>
                                            <td><?php 
                                                    if ($row4['COSTOCR4'] == 0) {
                                                        echo "";
                                                    } else {
                                                        echo "$".$row4['COSTOCR4'];
                                                    }
                                                ?>
                                            </td>
                                            <td><?php echo $row4['PINMEC4']; ?></td>
                                            <td>
                                                <?php 
                                                    if ($row4['COSTOPM4'] == 0) {
                                                        echo "";
                                                    } else {
                                                        echo "$".$row4['COSTOPM4'];
                                                    }
                                                ?>
                                            </td>
                                            <td>
                                                <?php 
                                                    if ($row4['REFACCION4'] == 0) {
                                                        echo "";
                                                    } else {
                                                        echo "$".$row4['REFACCION4'];
                                                    }
                                                ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><?php echo $row4['CONCEPTO5']; ?></td>
                                            <td><?php echo $row4['CAMREP5']; ?></td>
                                            <td><?php 
                                                    if ($row4['COSTOCR5'] == 0) {
                                                        echo "";
                                                    } else {
                                                        echo "$".$row4['COSTOCR5'];
                                                    }
                                                ?>
                                            </td>
                                            <td><?php echo $row4['PINMEC5']; ?></td>
                                            <td>
                                                <?php 
                                                    if ($row4['COSTOPM5'] == 0) {
                                                        echo "";
                                                    } else {
                                                        echo "$".$row4['COSTOPM5'];
                                                    }
                                                ?>
                                            </td>
                                            <td>
                                                <?php 
                                                    if ($row4['REFACCION5'] == 0) {
                                                        echo "";
                                                    } else {
                                                        echo "$".$row4['REFACCION5'];
                                                    }
                                                ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><?php echo $row4['CONCEPTO6']; ?></td>
                                            <td><?php echo $row4['CAMREP6']; ?></td>
                                            <td><?php 
                                                    if ($row4['COSTOCR6'] == 0) {
                                                        echo "";
                                                    } else {
                                                        echo "$".$row4['COSTOCR6'];
                                                    }
                                                ?>
                                            </td>
                                            <td><?php echo $row4['PINMEC6']; ?></td>
                                            <td>
                                                <?php 
                                                    if ($row4['COSTOPM6'] == 0) {
                                                        echo "";
                                                    } else {
                                                        echo "$".$row4['COSTOPM6'];
                                                    }
                                                ?>
                                            </td>
                                            <td>
                                                <?php 
                                                    if ($row4['REFACCION6'] == 0) {
                                                        echo "";
                                                    } else {
                                                        echo "$".$row4['REFACCION6'];
                                                    }
                                                ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><?php echo $row4['CONCEPTO7']; ?></td>
                                            <td><?php echo $row4['CAMREP7']; ?></td>
                                            <td><?php 
                                                    if ($row4['COSTOCR7'] == 0) {
                                                        echo "";
                                                    } else {
                                                        echo "$".$row4['COSTOCR7'];
                                                    }
                                                ?>
                                            </td>
                                            <td><?php echo $row4['PINMEC7']; ?></td>
                                            <td>
                                                <?php 
                                                    if ($row4['COSTOPM7'] == 0) {
                                                        echo "";
                                                    } else {
                                                        echo "$".$row4['COSTOPM7'];
                                                    }
                                                ?>
                                            </td>
                                            <td>
                                                <?php 
                                                    if ($row4['REFACCION7'] == 0) {
                                                        echo "";
                                                    } else {
                                                        echo "$".$row4['REFACCION7'];
                                                    }
                                                ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><?php echo $row4['CONCEPTO8']; ?></td>
                                            <td><?php echo $row4['CAMREP8']; ?></td>
                                            <td><?php 
                                                    if ($row4['COSTOCR8'] == 0) {
                                                        echo "";
                                                    } else {
                                                        echo "$".$row4['COSTOCR8'];
                                                    }
                                                ?>
                                            </td>
                                            <td><?php echo $row4['PINMEC8']; ?></td>
                                            <td>
                                                <?php 
                                                    if ($row4['COSTOPM8'] == 0) {
                                                        echo "";
                                                    } else {
                                                        echo "$".$row4['COSTOPM8'];
                                                    }
                                                ?>
                                            </td>
                                            <td>
                                                <?php 
                                                    if ($row4['REFACCION8'] == 0) {
                                                        echo "";
                                                    } else {
                                                        echo "$".$row4['REFACCION8'];
                                                    }
                                                ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><?php echo $row4['CONCEPTO9']; ?></td>
                                            <td><?php echo $row4['CAMREP9']; ?></td>
                                            <td><?php 
                                                    if ($row4['COSTOCR9'] == 0) {
                                                        echo "";
                                                    } else {
                                                        echo "$".$row4['COSTOCR9'];
                                                    }
                                                ?>
                                            </td>
                                            <td><?php echo $row4['PINMEC9']; ?></td>
                                            <td>
                                                <?php 
                                                    if ($row4['COSTOPM9'] == 0) {
                                                        echo "";
                                                    } else {
                                                        echo "$".$row4['COSTOPM9'];
                                                    }
                                                ?>
                                            </td>
                                            <td>
                                                <?php 
                                                    if ($row4['REFACCION9'] == 0) {
                                                        echo "";
                                                    } else {
                                                        echo "$".$row4['REFACCION9'];
                                                    }
                                                ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><?php echo $row4['CONCEPTO10']; ?></td>
                                            <td><?php echo $row4['CAMREP10']; ?></td>
                                            <td><?php 
                                                    if ($row4['COSTOCR10'] == 0) {
                                                        echo "";
                                                    } else {
                                                        echo "$".$row4['COSTOCR10'];
                                                    }
                                                ?>
                                            </td>
                                            <td><?php echo $row4['PINMEC10']; ?></td>
                                            <td>
                                                <?php 
                                                    if ($row4['COSTOPM10'] == 0) {
                                                        echo "";
                                                    } else {
                                                        echo "$".$row4['COSTOPM10'];
                                                    }
                                                ?>
                                            </td>
                                            <td>
                                                <?php 
                                                    if ($row4['REFACCION10'] == 0) {
                                                        echo "";
                                                    } else {
                                                        echo "$".$row4['REFACCION10'];
                                                    }
                                                ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><?php echo $row4['CONCEPTO11']; ?></td>
                                            <td><?php echo $row4['CAMREP11']; ?></td>
                                            <td><?php 
                                                    if ($row4['COSTOCR11'] == 0) {
                                                        echo "";
                                                    } else {
                                                        echo "$".$row4['COSTOCR11'];
                                                    }
                                                ?>
                                            </td>
                                            <td><?php echo $row4['PINMEC11']; ?></td>
                                            <td>
                                                <?php 
                                                    if ($row4['COSTOPM11'] == 0) {
                                                        echo "";
                                                    } else {
                                                        echo "$".$row4['COSTOPM11'];
                                                    }
                                                ?>
                                            </td>
                                            <td>
                                                <?php 
                                                    if ($row4['REFACCION11'] == 0) {
                                                        echo "";
                                                    } else {
                                                        echo "$".$row4['REFACCION11'];
                                                    }
                                                ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><?php echo $row4['CONCEPTO12']; ?></td>
                                            <td><?php echo $row4['CAMREP12']; ?></td>
                                            <td><?php 
                                                    if ($row4['COSTOCR12'] == 0) {
                                                        echo "";
                                                    } else {
                                                        echo "$".$row4['COSTOCR12'];
                                                    }
                                                ?>
                                            </td>
                                            <td><?php echo $row4['PINMEC12']; ?></td>
                                            <td>
                                                <?php 
                                                    if ($row4['COSTOPM12'] == 0) {
                                                        echo "";
                                                    } else {
                                                        echo "$".$row4['COSTOPM12'];
                                                    }
                                                ?>
                                            </td>
                                            <td>
                                                <?php 
                                                    if ($row4['REFACCION12'] == 0) {
                                                        echo "";
                                                    } else {
                                                        echo "$".$row4['REFACCION12'];
                                                    }
                                                ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><?php echo $row4['CONCEPTO13']; ?></td>
                                            <td><?php echo $row4['CAMREP13']; ?></td>
                                            <td><?php 
                                                    if ($row4['COSTOCR13'] == 0) {
                                                        echo "";
                                                    } else {
                                                        echo "$".$row4['COSTOCR13'];
                                                    }
                                                ?>
                                            </td>
                                            <td><?php echo $row4['PINMEC13']; ?></td>
                                            <td>
                                                <?php 
                                                    if ($row4['COSTOPM13'] == 0) {
                                                        echo "";
                                                    } else {
                                                        echo "$".$row4['COSTOPM13'];
                                                    }
                                                ?>
                                            </td>
                                            <td>
                                                <?php 
                                                    if ($row4['REFACCION13'] == 0) {
                                                        echo "";
                                                    } else {
                                                        echo "$".$row4['REFACCION13'];
                                                    }
                                                ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><?php echo $row4['CONCEPTO14']; ?></td>
                                            <td><?php echo $row4['CAMREP14']; ?></td>
                                            <td><?php 
                                                    if ($row4['COSTOCR14'] == 0) {
                                                        echo "";
                                                    } else {
                                                        echo "$".$row4['COSTOCR14'];
                                                    }
                                                ?>
                                            </td>
                                            <td><?php echo $row4['PINMEC14']; ?></td>
                                            <td>
                                                <?php 
                                                    if ($row4['COSTOPM14'] == 0) {
                                                        echo "";
                                                    } else {
                                                        echo "$".$row4['COSTOPM14'];
                                                    }
                                                ?>
                                            </td>
                                            <td>
                                                <?php 
                                                    if ($row4['REFACCION14'] == 0) {
                                                        echo "";
                                                    } else {
                                                        echo "$".$row4['REFACCION14'];
                                                    }
                                                ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><?php echo $row4['CONCEPTO15']; ?></td>
                                            <td><?php echo $row4['CAMREP15']; ?></td>
                                            <td><?php 
                                                    if ($row4['COSTOCR15'] == 0) {
                                                        echo "";
                                                    } else {
                                                        echo "$".$row4['COSTOCR15'];
                                                    }
                                                ?>
                                            </td>
                                            <td><?php echo $row4['PINMEC15']; ?></td>
                                            <td>
                                                <?php 
                                                    if ($row4['COSTOPM15'] == 0) {
                                                        echo "";
                                                    } else {
                                                        echo "$".$row4['COSTOPM15'];
                                                    }
                                                ?>
                                            </td>
                                            <td>
                                                <?php 
                                                    if ($row4['REFACCION15'] == 0) {
                                                        echo "";
                                                    } else {
                                                        echo "$".$row4['REFACCION15'];
                                                    }
                                                ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <td style="text-align:right;"><strong>Totales:</strong></td>
                                            <td><strong>$
                                                <?php echo $row4['COSTOCR1'] + $row4['COSTOCR2'] + $row4['COSTOCR3'] + $row4['COSTOCR4'] + $row4['COSTOCR5'] +
                                                            $row4['COSTOCR6'] + $row4['COSTOCR7'] + $row4['COSTOCR8'] + $row4['COSTOCR9'] + $row4['COSTOCR10'] +
                                                            $row4['COSTOCR11'] + $row4['COSTOCR12'] + $row4['COSTOCR13'] + $row4['COSTOCR14'] + $row4['COSTOCR15']; 
                                                ?></strong>
                                            </td>
                                            <td></td>
                                            <td><strong>$
                                                <?php echo $row4['COSTOPM1'] + $row4['COSTOPM2'] + $row4['COSTOPM3'] + $row4['COSTOPM4'] + $row4['COSTOPM5'] +
                                                            $row4['COSTOPM6'] + $row4['COSTOPM7'] + $row4['COSTOPM8'] + $row4['COSTOPM9'] + $row4['COSTOPM10'] +
                                                            $row4['COSTOPM11'] + $row4['COSTOPM12'] + $row4['COSTOPM13'] + $row4['COSTOPM14'] + $row4['COSTOPM15']; 
                                                ?></strong>
                                            </td>
                                            <td><strong>$
                                                <?php echo $row4['REFACCION1'] + $row4['REFACCION2'] + $row4['REFACCION3'] + $row4['REFACCION4'] + $row4['REFACCION5'] +
                                                            $row4['REFACCION6'] + $row4['REFACCION7'] + $row4['REFACCION8'] + $row4['REFACCION9'] + $row4['REFACCION10'] +
                                                            $row4['REFACCION11'] + $row4['REFACCION12'] + $row4['REFACCION13'] + $row4['REFACCION14'] + $row4['REFACCION15']; 
                                                ?></strong>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-sm-2"></div>
                            <div class="col-sm-3">
                                <table class="table table-striped table-bordered">
                                    <thead>
                                        <th colspan="2">Totales del presupuesto</th>
                                    </thead>
                                    <tr>
                                        <td><label for="concepto">Total mano de obra</label></td>
                                        <td><strong>$<?php echo $row4['TOTALMANOOBRA']; ?></strong></td>
                                    </tr>
                                    <tr>
                                        <td><label for="concepto">Total de refacciones</label></td>
                                        <td><strong>$<?php echo $row4['TOTALREFACCIONES']; ?></strong></td>
                                    </tr>
                                    <tr>
                                        <td><label for="concepto">Total de la valuaci&oacuten</label></td>
                                        <td><strong>$<?php echo $row4['TOTALVALUACION']; ?></strong></td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
<!-----------------------------------------Vales del vehiculo-------------------------------------------------------------->
                    <div id="menu3" class="tab-pane fade">
                        <center><h3>Vales generados</h3></center>
                        <br><br>
                        <?php

                            if ($query > 0) {
                                $num_vale = 1;
                                $total_vales = 0;

                                while ($row5 = mysqli_fetch_array($query, MYSQLI_ASSOC)) {
                                    echo "<div class='row'>";
                                        echo "<div class='col-sm-3'></div>";
                                        echo "<div class='col-sm-6'>";
                                            echo "<h2>Vale No.".$num_vale."</h2>";
                                            echo "<table class='table table-striped'>";
                                            echo "<thead>";
                                                echo "<tr>";
                                                    echo "<th colspan='7' style='text-align:center'>Concepto</th>";
                                                    echo "<th>Monto</th>";
                                                echo "</tr>";
                                            echo "</thead>";
                                            echo "<tbody>";
                                                echo "<tr>";
                                                    echo "<td colspan='7'>".$row5['CONCEPTO1']."</td>";
                                                    if ($row5['COSTO1'] == 0) {
                                                        echo "<td></td>";
                                                    } else {
                                                        echo "<td>$".$row5['COSTO1']."</td>";
                                                    }
                                                echo "</tr>";
                                                echo "<tr>";
                                                    echo "<td colspan='7'>".$row5['CONCEPTO2']."</td>";
                                                    if ($row5['COSTO2'] == 0) {
                                                        echo "<td></td>";
                                                    } else {
                                                        echo "<td>$".$row5['COSTO2']."</td>";
                                                    }
                                                echo "</tr>";
                                                echo "<tr>";
                                                    echo "<td colspan='7'>".$row5['CONCEPTO3']."</td>";
                                                    if ($row5['COSTO3'] == 0) {
                                                        echo "<td></td>";
                                                    } else {
                                                        echo "<td>$".$row5['COSTO3']."</td>";
                                                    }
                                                echo "</tr>";
                                                echo "<tr>";
                                                    echo "<td colspan='7'>".$row5['CONCEPTO4']."</td>";
                                                    if ($row5['COSTO4'] == 0) {
                                                        echo "<td></td>";
                                                    } else {
                                                        echo "<td>$".$row5['COSTO4']."</td>";
                                                    }
                                                echo "</tr>";
                                                echo "<tr>";
                                                    echo "<td colspan='7'>".$row5['CONCEPTO5']."</td>";
                                                    if ($row5['COSTO5'] == 0) {
                                                        echo "<td></td>";
                                                    } else {
                                                        echo "<td>$".$row5['COSTO5']."</td>";
                                                    }
                                                echo "</tr>";
                                                echo "<tr>";
                                                    echo "<td colspan='7'></td>";
                                                    echo "<td><strong>$".$row5['TOTAL']."</strong></td>";
                                                echo "</tr>";
                                            echo "</tbody>";
                                            echo "</table>";
                                        echo "</div>";
                                    echo "</div>";
                                    echo "<br><br>";
                                    $num_vale++;
                                    $total_vales = $total_vales + $row5['TOTAL'];
                                } ?>
                                
                                <div class="row">
                                    <div class="col-sm-2"></div>
                                    <div class="col-sm-3">
                                        <table class="table table-striped table-bordered">
                                            <thead>
                                                <th colspan="2">Total de vales generados</th>
                                            </thead>
                                            <tr>
                                                <td colspan="2"><strong>$<?php echo $total_vales; ?></strong></td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>

                                <?php
                            } else {
                                echo "<center>Este vehiculo no tiene generado ningun vale.</center>";
                            }
                        ?>
                    </div>

<!----------------------------------------Fotos del vehiculo-------------------------------------------------------------->
                    <div id="menu4" class="tab-pane fade">
                        <center><h3>Fotos del veh&iacuteculo</h3></center>
                        <br><br>
                        <div class="row">
                            <div class="col-sm-5">
                                <?php echo "<img src='".$row['FOTO1']."' alt='".$row['FOLIO']."-".$row['MARCA']."-".$row['TIPO']."-".$row['MODELO']."' style='height:300px; width:400px'>"; ?>
                            </div>
                            <div class="col-sm-1"></div>
                            <div class="col-sm-5">
                                <?php echo "<img src='".$row['FOTO2']."' alt='".$row['FOLIO']."-".$row['MARCA']."-".$row['TIPO']."-".$row['MODELO']."' style='height:300px; width:400px'>"; ?>
                            </div>
                        </div>
                        <br>    
                        <div class="row">
                            <div class="col-sm-5">
                                <?php echo "<img src='".$row['FOTO3']."' alt='".$row['FOLIO']."-".$row['MARCA']."-".$row['TIPO']."-".$row['MODELO']."' style='height:300px; width:400px'>"; ?>
                            </div>
                            <div class="col-sm-1"></div>
                            <div class="col-sm-5">
                                <?php echo "<img src='".$row['FOTO4']."' alt='".$row['FOLIO']."-".$row['MARCA']."-".$row['TIPO']."-".$row['MODELO']."' style='height:300px; width:400px'>"; ?>
                            </div>
                        </div>
                        <br> 
                        <div class="row">
                            <div class="col-sm-5">
                                <?php echo"<img src='".$row['FOTO5']."' alt='".$row['FOLIO']."-".$row['MARCA']."-".$row['TIPO']."-".$row['MODELO']."' style='height:300px; width:400px'>"; ?>
                            </div>
                            <div class="col-sm-1"></div>
                            <div class="col-sm-5">
                                <?php echo "<img src='".$row['FOTO6']."' alt='".$row['FOLIO']."-".$row['MARCA']."-".$row['TIPO']."-".$row['MODELO']."' style='height:300px; width:400px'>"; ?>
                            </div>
                        </div>
                    </div>

<!-------------------------------------------------------------Terminar vehiculo-------------------------------------------------------------->
                    <div id="menu5" class="tab-pane fade">
                        <center><h3>Terminar veh&iacuteculo</h3></center>
                        <br><br>
                        <form action="<?php $_SERVER['PHP_SELF'] ?>" method="POST">
                            <p>Si el veh&iacuteculo se encuentra listo para entregar, da clic al bot&oacuten de terminar.</p>
                            <div class="row">
                                <div class="col-sm-12" style="text-align:center">
                                    <input type="hidden" name="folio" value="<?php echo $folio ?>">
                                    <button type="submit" class="btn btn-success" name="terminar">Terminar</button>
                                </div>          
                            </div> 
                        </form>
                    </div>
<!---------------------------------------------------------------------------------------------------------------------------------------->

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