<?php
    session_start();
    if(empty($_SESSION['username'])){
        header("Location: ../login.php");
    }else{
        
        include("conexion_leal.php");

        $con = mysqli_connect($hostname, $user, $pass, $db) or die("Error al conectar con el servidor");

         if (isset($_POST['entregar'])) {
            $entregar = $_POST['folio'];

            mysqli_query($con, "UPDATE vehiculos SET STATUS = 'Entregado' WHERE FOLIO = '$entregar'");
            header("Location: Menu.php");
        }

        
        $query = mysqli_query($con, "SELECT * FROM vehiculos WHERE STATUS = 'Terminado'");
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
				    <li><a href="Vehiculos en taller.php"><i class="fa fa-dashboard fa-3x"></i>Veh&iacuteculos en taller</a></li>
                    <li><a class="active-menu" href="Vehiculos para entregar.php"><i class="fa fa-dashboard fa-3x"></i>Veh&iacuteculos para entregar</a></li>
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
                                <p class="main-text" style="text-align:center;">Vehiculos para entregar</p>
                            </div>
                        </div>
                        <hr/>
                    </div>
                </div>
                <!-- /. ROW  -->
                <p>Seleccione un veh&iacuteculo para marcarlo como entregado:</p>

                <?php
                    while ($row = mysqli_fetch_array($query, MYSQLI_ASSOC)) { ?>
                        <div class="polaroid">
                            <img src="<?php echo $row['FOTO1']; ?>" alt="<?php echo $row['FOLIO']."-".$row['MARCA']."-".$row['TIPO']."-".$row['MODELO']; ?>" style="height:300px; width:400px">
                            <div class="titulo"><strong>
                                Folio: <?php echo $row['FOLIO'] ?><br>
                                Marca: <?php echo $row['MARCA'] ?><br>
                                Tipo: <?php echo $row['TIPO'] ?><br>
                                Modelo: <?php echo $row['MODELO'] ?><br>
                                </strong>
                            </div>
                            <div class="titulo"><strong>
                                <form action="<?php $_SERVER['PHP_SELF'] ?>" method="POST">
                                    <input type="hidden" name="folio" value="<?php echo $row['FOLIO'] ?>">
                                    <button type="submit" class="btn btn-success" name="entregar">Entregar</button>
                                </form>
                                </strong>
                            </div>
                        </div>
                <?php   }
                ?>
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