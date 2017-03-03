<?php
    session_start();
    if(empty($_SESSION['username'])){
        header("Location: ../login.php");
    }else{

        include("../assets/includes/conexion_astillero.php");
        $con = mysqli_connect($hostname, $user, $pass, $db) or die("Error al conectar con el servidor");

        $query = mysqli_query($con, "SELECT vehiculos.FOLIO, vehiculos.MARCA, vehiculos.TIPO, vehiculos.MODELO, vehiculos.PLACAS, vehiculos.COMPANIA, vehiculos.SINIESTRO,
                        vehiculos.COLOR, vehiculos.PUERTAS, vehiculos.FECHA, presupuestos.STATUS FROM vehiculos, presupuestos WHERE vehiculos.FOLIO = presupuestos.FOLIO AND presupuestos.STATUS = 'Presupuesto sin realizar'") or die("No se pudo realizar la consulta");


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
                <img src="../assets/img/user.png" height="30px" width="30px">&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
                <a href="../assets/includes/logout.php" class="btn btn-success square-btn-adjust">Logout</a> 
            </div>
        </nav>
        <!-- /. NAV TOP  -->
        <nav class="navbar-default navbar-side" role="navigation">
            <div class="sidebar-collapse">
                <ul class="nav" id="main-menu">
				    <li class="text-center"><img src="../assets/img/logo.png" class="user-image img-responsive"/></li>
                    <li><a href="Menu.php"><i class="fa fa-user fa-3x"></i>Resumen</a>
				    <li><a href="Vehiculos en taller.php"><i class="fa fa-dashboard fa-3x"></i>Veh&iacuteculos en taller</a></li>
                    <li><a href="Vehiculos para entregar.php"><i class="fa fa-dashboard fa-3x"></i>Veh&iacuteculos para entregar</a></li>
                    <li><a href="#"><i class="fa fa-edit fa-3x"></i>Inventarios<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li><a href="Nuevo Inventario.php">Nuevo inventario</a></li>
                            <li><a href="Historico Inventarios.php">Historico de inventarios</a></li>
                        </ul>
                    </li>
                    <li><a class="active-menu" href="#"><i class="fa fa-bar-chart-o fa-3x"></i>Presupuestos<span class="fa arrow"></span></a>
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
                            <span class="icon-box bg-color-green set-icon"><i class="fa fa-bar-chart-o"></i></span>
                            <div class="text-box">
                                <p class="main-text" style="text-align:center;">Presupuestos Pendientes</p>
                            </div>
                        </div>
                        <hr/>
                    </div>
                </div>
                <!-- /. ROW  -->
                <div class="row">
                    <div class="col-sm-12">
                        <table class="table table-striped">
                            <thead style="text-align:center">
                                <tr>
                                    <th>Folio</th>
                                    <th>Marca</th>
                                    <th>Tipo</th>
                                    <th>Modelo</th>
                                    <th>Placas</th>
                                    <th>Compañia</th>
                                    <th>Siniestro</th>
                                    <th>Color</th>
                                    <th>Puertas</th>
                                    <th>Fecha</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    while ($row = mysqli_fetch_array($query)) { ?>
                                        <tr>
                                            <td><?php echo $row['FOLIO'] ?></td>
                                            <td><?php echo $row['MARCA'] ?></td>
                                            <td><?php echo $row['TIPO'] ?></td>
                                            <td><?php echo $row['MODELO'] ?></td>
                                            <td><?php echo $row['PLACAS'] ?></td>
                                            <td><?php echo $row['COMPANIA'] ?></td>
                                            <td><?php echo $row['SINIESTRO'] ?></td>
                                            <td><?php echo $row['COLOR'] ?></td>
                                            <td><?php echo $row['PUERTAS'] ?></td>
                                            <td><?php echo $row['FECHA'] ?></td>
                                            <td><?php echo $row['STATUS'] ?></td>
                                            <td><a href="Presupuesto Taller.php?folio=<?php echo $row['FOLIO']?>"><button type="submit" class="btn btn-success" name="entregar">Realizar</button></a></td>
                                        </tr>
                                    <?php } ?>
                            </tbody>
                        </table>
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