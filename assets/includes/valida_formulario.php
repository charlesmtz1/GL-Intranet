<?php
        $validacion = 0;

        if (empty($_POST["nombre"])) {
            $error_nombre = "El nombre del cliente es requerido!";
            $validacion--;
        }else {
            $nombre = test_input($_POST["nombre"]);
            $validacion++;
            if (!preg_match("/^[a-zA-Z ]*$/",$nombre)) {
                $error_nombre = "Solo se pueden ingresar letras";
                $validacion--; 
            }
        }

        if (empty($_POST["domicilio"])) {
            $error_domicilio = "El domicilio es requerido!";
            $validacion--;
        }else {
            $domicilio = test_input($_POST["domicilio"]);
            $validacion++;
        }

        if(empty($_POST["colonia"])){
            $error_colonia = null;
        }else {
            $colonia = test_input($_POST["colonia"]);
        }

        if (empty($_POST["municipio"])) {
            $error_municipio = "El municipio es requerido!";
            $validacion--;
        }else {
            $municipio = test_input($_POST["municipio"]);
            $validacion++;
        }

        if(empty($_POST["rfc"])){
            $error_rfc= null;
        }else {
            $rfc = test_input($_POST["rfc"]);
        }

        if (empty($_POST["telefono"])) {
            $error_telefono = "El telefono es requerido!";
            $validacion--;
        }else {
            $telefono = test_input($_POST["telefono"]);
            $validacion++;
            if (!preg_match("/^[0-9]*$/",$telefono)) {
                $error_telefono = "Solo se pueden ingresar números";
                $validacion--; 
            }
        }

        if (empty($_POST["celular"])) {
            $error_celular = "El celular es requerido!";
            $validacion--;
        }else {
            $celular = test_input($_POST["celular"]);
            $validacion++;
            if (!preg_match("/^[0-9]*$/",$telefono)) {
                $error_celular = "Solo se pueden ingresar números";
                $validacion--; 
            }
        }

        if (empty($_POST["email"])) {
            $error_email = "El correo electronico es requerido!";
            $validacion--;
        }else {
            $email = test_input($_POST["email"]);
            $validacion++;
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $error_email = "Correo invalido!";
                $validacion--; 
            }
        }
        
        if (empty($_POST["marca"])) {
            $error_marca = "La marca es requerida!";
            $validacion--;
        }else {
            $marca = test_input($_POST["marca"]);
            $validacion++;
            if (!preg_match("/^[a-zA-Z ]*$/",$marca)) {
                $error_marca = "Solo se pueden ingresar letras"; 
                $validacion--;
            }
        }

        if (empty($_POST["tipo"])) {
            $error_tipo = "El tipo es requerido!";
            $validacion--;
        }else {
            $tipo = test_input($_POST["tipo"]);
            $validacion++;
        }

        if (empty($_POST["modelo"])) {
            $error_modelo = "El modelo es requerido!";
            $validacion--;
        }else {
            $modelo = test_input($_POST["modelo"]);
            $validacion++;
            if (!preg_match("/^[0-9]*$/",$modelo)) {
                $error_modelo = "Solo se pueden ingresar números";
                $validacion--; 
            }
        }

        if (empty($_POST["placas"])) {
            $error_placas = "Las placas son requeridas!";
            $validacion--;
        }else {
            $placas = test_input($_POST["placas"]);
            $validacion++;
        }

        if (empty($_POST["cia"])) {
            $error_cia = "La compañia es requerida!";
            $validacion--;
        }else {
            $cia = test_input($_POST["cia"]);
            $validacion++;
            if (!preg_match("/^[a-zA-Z ]*$/",$cia)) {
                $error_cia = "Solo se pueden ingresar letras";
                $validacion--; 
            }
        }

        if (empty($_POST["siniestro"])) {
            $error_siniestro = "El siniestro es requerido!";
            $validacion--;
        }else {
            $siniestro = test_input($_POST["siniestro"]);
            $validacion++;
        }

        if (empty($_POST["color"])) {
            $error_color = "El color es requerido!";
            $validacion--;
        }else {
            $color = test_input($_POST["color"]);
            $validacion++;
            if (!preg_match("/^[a-zA-Z ]*$/",$color)) {
                $error_color = "Solo se pueden ingresar letras"; 
                $validacion--;
            }
        }

        if (empty($_POST["puertas"])) {
            $error_puertas = "Las puertas son requeridas!";
            $validacion--;
        }else {
            $puertas = test_input($_POST["puertas"]);
            $validacion++;
            if (!preg_match("/^[0-9]*$/",$puertas)) {
                $error_puertas = "Solo se pueden ingresar números"; 
                $validacion--;
            }
        }

        if (empty($_POST["fecha"])) {
            $error_fecha = "La fecha es requerida!";
            $validacion--;
        }else {
            $fecha = $_POST["fecha"];
            $fecha_aux = getdate();
            
            if ($fecha_aux['mon'] < 10) {
                $hoy = $fecha_aux['year'] . "-0" . $fecha_aux['mon'] . "-" . $fecha_aux['mday'];
                if ($fecha_aux['mday'] < 10) {
                    $hoy = $fecha_aux['year'] . "-0" . $fecha_aux['mon'] . "-0" . $fecha_aux['mday'];
                }   
            }else {
                $hoy = $fecha_aux['year'] . "-" . $fecha_aux['mon'] . "-" . $fecha_aux['mday'];
                if ($fecha_aux['mday'] < 10) {
                    $hoy = $fecha_aux['year'] . "-" . $fecha_aux['mon'] . "-0" . $fecha_aux['mday'];
                }  
            }

            $validacion++;
            if ($fecha < $hoy) {
                $error_fecha = "La fecha de ingreso no es valida!"; 
                $validacion--;
            }
        }

        if (empty($_POST["kilometros"])) {
            $error_kilometros = "Los kilometros son requeridos!";
            $validacion--;
        }else {
            $kilometros = test_input($_POST["kilometros"]);
            $validacion++;
            if (!preg_match("/^[0-9]*$/",$kilometros)) {
                $error_kilometros = "Solo se pueden ingresar números"; 
                $validacion--;
            }
        }

        if (empty($_POST["gasolina"])) {
            $error_gasolina = "La gasolina es requerida!";
            $validacion--;
        }else {
            $gasolina = test_input($_POST["gasolina"]);
            $validacion++;
        }

        if(empty($_POST["llantaref"])){
            $error_llantaref = "Marca una opción!";
            $validacion--;
        }else {
            $llantaref = test_input($_POST["llantaref"]);
            $validacion++;
        }

        if(empty($_POST["emblemafrente"])){
            $error_emblemafrente = "Marca una opción!";
            $validacion--;
        }else {
            $emblemafrente = test_input($_POST["emblemafrente"]);
            $validacion++;
        }
    
        if(empty($_POST["gato"])){
            $error_gato = "Marca una opción!";
            $validacion--;
        }else {
            $gato = test_input($_POST["gato"]);
            $validacion++;
        }

        if(empty($_POST["emblemacostado"])){
            $error_emblemacostado = "Marca una opción!";
            $validacion--;
        }else {
            $emblemacostado = test_input($_POST["emblemacostado"]);
            $validacion++;
        }
        
        if(empty($_POST["extinguidor"])){
            $error_extinguidor = "Marca una opción!";
            $validacion--;
        }else {
            $extinguidor = test_input($_POST["extinguidor"]);
            $validacion++;
        }

        if(empty($_POST["moldurader"])){
            $error_moldurader = "Marca una opción!";
            $validacion--;
        }else {
            $moldurader = test_input($_POST["moldurader"]);
            $validacion++;
        }

        if(empty($_POST["estereo"])){
            $error_estereo = "Marca una opción!";
            $validacion--;
        }else {
            $estereo = test_input($_POST["estereo"]);
            $validacion++;
        }

        if(empty($_POST["molduraizq"])){
            $error_molduraizq = "Marca una opción!";
            $validacion--;
        }else {
            $molduraizq = test_input($_POST["molduraizq"]);
            $validacion++;
        }

        if(empty($_POST["parabrisas"])){
            $error_parabrisas = "Marca una opción!";
            $validacion--;
        }else {
            $parabrisas = test_input($_POST["parabrisas"]);
            $validacion++;
        }

        if(empty($_POST["reflejantesder"])){
            $error_reflejantesder = "Marca una opción!";
            $validacion--;
        }else {
            $reflejantesder = test_input($_POST["reflejantesder"]);
            $validacion++;
        }

        if(empty($_POST["herramienta"])){
            $error_herramienta = "Marca una opción!";
            $validacion--;
        }else {
            $herramienta = test_input($_POST["herramienta"]);
            $validacion++;
        }

        if(empty($_POST["reflejantesizq"])){
            $error_reflejantesizq = "Marca una opción!";
            $validacion--;
        }else {
            $reflejantesizq = test_input($_POST["reflejantesizq"]);
            $validacion++;
        }

        if(empty($_POST["espejoslat"])){
            $error_espejoslat = "Marca una opción!";
            $validacion--;
        }else {
            $espejoslat = test_input($_POST["espejoslat"]);
            $validacion++;
        }

        if(empty($_POST["espejoretro"])){
            $error_espejoretro = "Marca una opción!";
            $validacion--;
        }else {
            $espejoretro = test_input($_POST["espejoretro"]);
            $validacion++;
        }

        if(empty($_POST["polveras"])){
            $error_polveras = "Marca una opción!";
            $validacion--;
        }else {
            $polveras = test_input($_POST["polveras"]);
            $validacion++;
        }

        if(empty($_POST["tapon"])){
            $error_tapon = "Marca una opción!";
            $validacion--;
        }else {
            $tapon = test_input($_POST["tapon"]);
            $validacion++;
        }

        if(empty($_POST["tapetes"])){
            $error_tapetes = "Marca una opción!";
            $validacion--;
        }else {
            $tapetes = test_input($_POST["tapetes"]);
            $validacion++;
        }

        if(empty($_POST["limpiabrisas"])){
            $error_limpiabrisas = "Marca una opción!";
            $validacion--;
        }else {
            $limpiabrisas = test_input($_POST["limpiabrisas"]);
            $validacion++;
        }

        if(empty($_POST["cubreasientos"])){
            $error_cubreasientos = "Marca una opción!";
            $validacion--;
        }else {
            $cubreasientos = test_input($_POST["cubreasientos"]);
            $validacion++;
        }
        
        if(empty($_POST["parasoles"])){
            $error_parasoles = "Marca una opción!";
            $validacion--;
        }else {
            $parasoles = test_input($_POST["parasoles"]);
            $validacion++;
        }

        if(empty($_POST["encendedor"])){
            $error_encendedor = "Marca una opción!";
            $validacion--;
        }else {
            $encendedor = test_input($_POST["encendedor"]);
            $validacion++;
        }

        if(empty($_POST["claxon"])){
            $error_claxon = "Marca una opción!";
            $validacion--;
        }else {
            $claxon = test_input($_POST["claxon"]);
            $validacion++;
        }

        if(empty($_POST["cajuela"])){
            $error_cajuela = "Marca una opción!";
            $validacion--;
        }else {
            $cajuela = test_input($_POST["cajuela"]);
            $validacion++;
        }

        if(empty($_POST["lucesdel"])){
            $error_lucesdel = "Marca una opción!";
            $validacion--;
        }else {
            $lucesdel = test_input($_POST["lucesdel"]);
            $validacion++;
        }

        if(empty($_POST["antena"])){
            $error_antena = "Marca una opción!";
            $validacion--;
        }else {
            $antena = test_input($_POST["antena"]);
            $validacion++;
        }

        if(empty($_POST["lucestras"])){
            $error_lucestras = "Marca una opción!";
            $validacion--;
        }else {
            $lucestras = test_input($_POST["lucestras"]);
            $validacion++;
        }

        if(empty($_POST["faros"])){
            $error_faros = "Marca una opción!";
            $validacion--;
        }else {
            $faros = test_input($_POST["faros"]);
            $validacion++;
        }

        if(empty($_POST["objetos"])){
            $error_objetos = null;
        }else {
            $objetos = test_input($_POST["objetos"]);
        }

        if(empty($_POST["observaciones"])){
            $error_observaciones = null;
        }else {
            $observaciones = test_input($_POST["observaciones"]);
        }
                
?>