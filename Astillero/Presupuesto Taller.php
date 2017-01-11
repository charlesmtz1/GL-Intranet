<?php
    include("conexionleal.php");

    $con = mysql_connect($host, $user, $password) or die("Error al conectar con el servidor");
    mysql_select_db($db, $con) or die("Error al conectar a la base de datos");

    $consulta = mysql_query("SELECT * FROM vehiculos WHERE FOLIO = '$_POST[busqueda]'", $con);

    $folio = mysql_fetch_array($consulta);
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <title>GL Intranet | Presupuesto para taller</title>
    </head>

    <body style="background-color:lightgray">
        <div class="jumbotron" style="text-align:center">
            <h1>Presupuesto</h1>
        </div>
        <div class="container" style="background-color:white">
            <form class="form-horizontal">
                <fieldset>
                    <legend>Datos del veh&iacuteculo</legend>
                    <div class="form-group">
                        <label class="control-label col-sm-1" for="marca">Marca:</label>
                        <div class="col-sm-2">
                            <input type="text" class="form-control" name="marca" value="<?php echo $folio['MARCA'] ?>" readonly >
                        </div>
                        <label class="control-label col-sm-1" for="tipo">Tipo:</label>
                        <div class="col-sm-2">
                            <input type="text" class="form-control" name="tipo" value="<?php echo $folio['TIPO'] ?>" readonly >
                        </div>
                        <label class="control-label col-sm-1" for="modelo">Modelo:</label>
                        <div class="col-sm-1">
                            <input type="text" class="form-control" name="modelo" value="<?php echo $folio['MODELO'] ?>" readonly >
                        </div>
                        <label class="control-label col-sm-1" for="placas">Placas:</label>
                        <div class="col-sm-2">
                        <input type="text" class="form-control" name="placas" value="<?php echo $folio['PLACAS'] ?>" readonly>    
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-sm-1" for="cia">Compa&ntildeia:</label>
                        <div class="col-sm-2">
                            <input type="text" class="form-control" name="cia" value="<?php echo $folio['COMPANIA'] ?>" readonly >
                        </div>
                        <label class="control-label col-sm-1" for="siniestro">Siniestro:</label>
                        <div class="col-sm-2">
                            <input type="text" class="form-control" name="siniestro" value="<?php echo $folio['SINIESTRO'] ?>" readonly>    
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
                                 action="Guardar Presupuesto.php" method="POST">
                <fieldset>
                    <legend style="text-align:center">Costo por pieza</legend>
                    <input type="hidden" name="folio" value="<?php echo $folio['FOLIO'] ?>">
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
                <br><br>
                <fieldset>
                    <div class="form-group">
                        <div class="col-sm-2"></div>
                        <div class="col-sm-3" style="text-align:right">
                            <label for="concepto">Total mano de obra</label>
                        </div>
                        <div class="col-sm-2">
                            <strong>$<output name="totalmanoobra" for="a1" style="display:inline"></output></strong>
                        </div>
                    </div> 

                    <div class="form-group">
                        <div class="col-sm-2"></div>
                        <div class="col-sm-3" style="text-align:right">
                            <label for="concepto">Total de refacciones</label>
                        </div>
                        <div class="col-sm-2">
                            <strong>$<output name="totalrefacciones" for="a1" style="display:inline"></output></strong>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-sm-2"></div>
                        <div class="col-sm-3" style="text-align:right">
                            <label for="concepto">Total de la valuaci&oacuten</label>
                        </div>
                        <div class="col-sm-2">
                            <strong>$<output name="totalvaluacion" for="a1" style="display:inline"></output></strong>
                        </div>
                    </div>
                </fieldset>
                <hr><br><br>
                <div class="row">
                    <div class="col-sm-12" style="text-align:center">
                        <button type="submit" class="btn btn-success">Guardar</button>
                    </div>
                </div>
                <br><br>
            </form>
            <div class="col-sm-12" style="text-align:center">
                <a href="Menu.html"><button class="btn btn-warning">Cancelar</button></a>    
            </div>
        </div>      
    </body>
</html>