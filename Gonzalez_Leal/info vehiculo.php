<?php
    session_start();
    if(empty($_SESSION['username'])){
        header("Location: ../login.php");
    }else{
        
        include("conexion_leal.php");

        $con = mysqli_connect($hostname, $user, $pass, $db) or die("Error al conectar con el servidor");

        $query = mysqli_query($con, "SELECT * FROM vehiculos WHERE FOLIO = '$_GET[folio]'");
        $row = mysqli_fetch_array($query, MYSQLI_ASSOC);

        $query = mysqli_query($con, "SELECT * FROM clientes WHERE FOLIO = '$_GET[folio]'");
        $row2 = mysqli_fetch_array($query, MYSQLI_ASSOC);

        $query = mysqli_query($con, "SELECT * FROM inventarios WHERE FOLIO = '$_GET[folio]'");
        $row3 = mysqli_fetch_array($query, MYSQLI_ASSOC);

        $query = mysqli_query($con, "SELECT * FROM presupuestos WHERE FOLIO = '$_GET[folio]'");
        $row4 = mysqli_fetch_array($query, MYSQLI_ASSOC);

        $query = mysqli_query($con, "SELECT * FROM vales WHERE FOLIO = '$_GET[folio]'");
        $row5 = mysqli_fetch_array($query, MYSQLI_ASSOC);

        mysqli_close($con);
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
                    <li><a href="#"><i class="fa fa-edit fa-3x"></i>Inventarios<span class="fa arrow"></span></a>
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
                            <li><a href="Nuevo Vale.php">Nuevo vale</a></li>
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
                        <div class="row" style="text-align:center">
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
                    </div>




<!-----------------------------------------Vales del vehiculo-------------------------------------------------------------->
                    <div id="menu3" class="tab-pane fade">
                        <center><h3>Vales generados</h3></center>
                        <br><br>
                        <p>Eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo.</p>
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

<!--------------------------------------------Terminar vehiculo-------------------------------------------------------------->
                    <div id="menu5" class="tab-pane fade">
                        <center><h3>Terminar veh&iacuteculo</h3></center>
                        <br><br>
                        <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam.</p>
                    </div>

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