<?php
    session_start();
    if(empty($_SESSION['username'])){
        header("Location: ../login.php");
    }else{

        $aux = 0;
        $presupuestos_pendientes = null;
        $vehiculos_activos = null;
        $vehiculos_terminados = null;

        include("conexion_leal.php");
        $con = mysqli_connect($hostname,$user,$pass,$db);
        $query = mysqli_query($con,"SELECT COUNT(STATUS) FROM vehiculos WHERE STATUS = 'Activo'");
        $row = mysqli_fetch_array($query,MYSQLI_ASSOC);
        
        $vehiculos_activos = $row["COUNT(STATUS)"];

        $query = mysqli_query($con,"SELECT COUNT(STATUS) FROM vehiculos WHERE STATUS = 'Terminado'");
        $row = mysqli_fetch_array($query,MYSQLI_ASSOC);

        $vehiculos_terminados = $row["COUNT(STATUS)"];

        $query = mysqli_query($con,"SELECT COUNT(STATUS) FROM presupuestos WHERE STATUS = 'Presupuesto sin realizar'");
        $row = mysqli_fetch_array($query,MYSQLI_ASSOC);
        
        $presupuestos_pendientes = $row["COUNT(STATUS)"];

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
                    <li><a class="active-menu" href="Menu.php"><i class="fa fa-user fa-3x"></i>Resumen</a>
				    <li><a href="Vehiculos en taller.php"><i class="fa fa-dashboard fa-3x"></i>Veh&iacuteculos en taller</a></li>
                    <li><a href="Vehiculos para entregar.php"><i class="fa fa-dashboard fa-3x"></i>Veh&iacuteculos para entregar</a></li>
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
                            <span class="icon-box bg-color-green set-icon"><i class="fa fa-user"></i></span>
                            <div class="text-box">
                                <p class="main-text" style="text-align:center;">Resumen</p>
                            </div>
                        </div>
                        <hr/>
                    </div>
                </div>
                <!-- /. ROW  -->
                <div class="row">
                    <div class="col-md-3 col-sm-6 col-xs-6">           
			            <div class="panel panel-back noti-box">
                            <span class="icon-box bg-color-green set-icon"><i class="fa fa-rocket"></i></span>
                            <div class="text-box">
                                <p class="main-text" style="text-align:center;">0</p><br>
                                <p class="text-muted">Veh&iacuteculos esta semana</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6 col-xs-6">           
			            <div class="panel panel-back noti-box">
                            <span class="icon-box bg-color-green set-icon"><i class="fa fa-dashboard"></i></span>
                            <div class="text-box">
                                <p class="main-text" style="text-align:center;"><?php echo $vehiculos_activos; ?></p><br>
                                <p class="text-muted">Veh&iacuteculos en taller</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6 col-xs-6">           
			            <div class="panel panel-back noti-box">
                            <span class="icon-box bg-color-green set-icon"><i class="fa fa-flag-checkered"></i></span>
                            <div class="text-box">
                                <p class="main-text" style="text-align:center;"><?php echo $vehiculos_terminados; ?></p><br>
                                <p class="text-muted">Veh&iacuteculos para entregar</p>
                            </div>
                        </div>
		            </div>
			    </div>
                <!-- /. ROW  -->
                <hr/>
                <div class="row">
                    <div class="col-md-6 col-sm-12 col-xs-12">           
			            <div class="panel panel-back noti-box">
                            <?php
                                if($presupuestos_pendientes === 0)
                                    echo "<span class='icon-box bg-color-green'><i class='fa fa-check'></i></span>";
                                else
                                    echo "<span class='icon-box bg-color-red'><i class='fa fa-warning'></i></span>";
                            ?>
                            <div class="text-box" >
                                <p class="main-text"><?php echo $presupuestos_pendientes; ?> Presupuestos pendientes</p>
                                <p class="text-muted">Deben generarse a la brevedad</p>
                            </div>
                        </div>
		            </div>

                    <div class="col-md-6 col-sm-12 col-xs-12">           
			            <div class="panel panel-back noti-box">
                            <?php
                                if($aux === 0)
                                    echo "<span class='icon-box bg-color-green'><i class='fa fa-check'></i></span>";
                                else
                                    echo "<span class='icon-box bg-color-red'><i class='fa fa-warning'></i></span>";
                            ?>
                            <div class="text-box" >
                                <p class="main-text">0 Veh&iacuteculos atrasados </p>
                                <p class="text-muted">Deben entregarse a la brevedad</p>
                            </div>
                        </div>
		            </div>
                </div>
                <!-- /. ROW  -->

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