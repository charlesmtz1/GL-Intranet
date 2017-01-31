<?php
    session_start();
    if(empty($_SESSION['username'])){
        header("Location: ../login.php");
    }else{

    $buscar = null;
    $folio = $marca = $tipo = $modelo = $placas = $cia = $siniestro = null;
    $busqueda_exitosa = false;
    $error_busqueda = null;

    function test_input($dato){
        $dato = trim($dato);
        $dato = stripslashes($dato);
        $dato = htmlspecialchars($dato);
        return $dato;
    }

    if(isset($_POST["busqueda"])){
        $buscar = $_POST['buscar'];
        include("conexion_astillero.php");

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

?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <title>GL Intranet | Nuevo vale</title>
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
                    <li><a href="#"><i class="fa fa-bar-chart-o fa-3x"></i>Presupuestos<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li><a href="Presupuesto Rapido.html">Nuevo presupuesto r&aacutepido</a></li>
                            <li><a href="Presupuesto Taller.php">Nuevo presupuesto para taller</a></li>
                            <li><a href="Buscar Presupuesto.html">Buscar presupuesto</a></li>
                            <li><a href="Historial Presupuestos.html">Historial de presupuestos</a></li>
                        </ul>
                    </li>
                    <li><a class="active-menu" href="#"><i class="fa fa-square-o fa-3x"></i>Vales<span class="fa arrow"></span></a>
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
                            <span class="icon-box bg-color-green set-icon"><i class="fa fa-square-o"></i></span>
                            <div class="text-box">
                                <p class="main-text" style="text-align:center;">Nuevo vale</p>
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
                            <input type="text" class="form-control" name="marca" readonly >
                        </div>
                        <label class="control-label col-sm-1" for="tipo">Tipo:</label>
                        <div class="col-sm-2">
                            <input type="text" class="form-control" name="tipo" readonly >
                        </div>
                        <label class="control-label col-sm-1" for="modelo">Modelo:</label>
                        <div class="col-sm-1">
                            <input type="text" class="form-control" name="modelo" readonly >
                        </div>
                        <label class="control-label col-sm-1" for="placas">Placas:</label>
                        <div class="col-sm-2">
                        <input type="text" class="form-control" name="placas" readonly>    
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-sm-1" for="cia">Compa&ntildeia:</label>
                        <div class="col-sm-2">
                            <input type="text" class="form-control" name="cia" readonly >
                        </div>
                        <label class="control-label col-sm-1" for="siniestro">Siniestro:</label>
                        <div class="col-sm-2">
                            <input type="text" class="form-control" name="siniestro" readonly>    
                        </div>
                    </div>
                </fieldset>
            </form>
            <br>
            <form class="form-horizontal" oninput="montototal.value=parseFloat(a1.value) + parseFloat(a2.value) + parseFloat(a3.value) 
                                                    + parseFloat(a4.value) + parseFloat(a5.value);"
                                 action="Menu.html" method="POST">
                <fieldset>
                    <legend style="text-align:center">Generaci&oacuten de vale</legend>
                    <div class="form-group" style="text-align:center">
                        <div class="col-sm-2"></div>
                        <div class="col-sm-7">
                            <label for="concepto">Concepto</label>
                        </div>
                        <div class="col-sm-1">
                            <label for="monto">Monto</label>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-sm-2"></div>
                        <div class="col-sm-7">
                            <input type="text" class="form-control" name="concepto1">
                        </div>
                        <div class="col-sm-1">
                            <input type="text" class="form-control" id="a1" name="monto1" value="0" maxlength="5">
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-sm-2"></div>
                        <div class="col-sm-7">
                            <input type="text" class="form-control" name="concepto2">
                        </div>
                        <div class="col-sm-1">
                            <input type="text" class="form-control" id="a2" name="monto2" value="0" maxlength="5">
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-sm-2"></div>
                        <div class="col-sm-7">
                            <input type="text" class="form-control" name="concepto3">
                        </div>
                        <div class="col-sm-1">
                            <input type="text" class="form-control" id="a3" name="monto3" value="0" maxlength="5">
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-sm-2"></div>
                        <div class="col-sm-7">
                            <input type="text" class="form-control" name="concepto4">
                        </div>
                        <div class="col-sm-1">
                            <input type="text" class="form-control" id="a4" name="monto4" value="0" maxlength="5">
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-sm-2"></div>
                        <div class="col-sm-7">
                            <input type="text" class="form-control" name="concepto5">
                        </div>
                        <div class="col-sm-1">
                            <input type="text" class="form-control" id="a5" name="monto5" value="0" maxlength="5">
                        </div>
                    </div>                    

                    <div class="form-group">
                        <div class="col-sm-2"></div>
                        <div class="col-sm-7" style="text-align:right">
                            <label for="concepto">Total</label>
                        </div>
                        <div class="col-sm-1">
                            <strong>$<output name="montototal" for="a1" style="display:inline"></output></strong>
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



































<!DOCTYPE html>

<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <title>GL Intranet | Nuevo vale</title>
    </head>

    <body style="background-color:lightgray">
        <div class="jumbotron" style="text-align:center">
            <h1>Crear vale para veh&iacuteculo</h1>
        </div>
        <div class="container" style="background-color:white">
            <p style="font-weight: bold">Para asignar un vale a un veh&iacuteculo, digite el n&uacutemero de 
                folio de su inventario.</p>
            <form class="form-horizontal" action="none">     
                <div class="form-group">
                    <label class="control-label col-sm-1" for="buscar">Folio:</label>
                    <div class="col-sm-2">
                        <input type="search" class="form-control" name="buscar" placeholder="Ingrese el folio">                 
                    </div>
                    <button type="button" class="btn btn-info">
                        <span class="glyphicon glyphicon-search"></span> Buscar
                    </button>
                </div>  
            </form>
            <br>

            
        </div>      
    </body>
</html>