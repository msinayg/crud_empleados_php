<?php 
    include("datos_conexion.php");
    $id = utf8_decode($_GET["id"]);
    $db_conexion = mysqli_connect($db_host, $db_usr, $db_pass, $db_name, $db_port);
    $db_conexion->real_query("select * from empleados where codigo = '".$id."' ;");
    $resultado = $db_conexion->use_result();
    while ($fila = $resultado->fetch_assoc()) {
        
?>
<!doctype html>
<html lang="en">

<head>
    <title>Empresa</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS v5.0.2 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

</head>

<body>
    <h1>Formulario Empresa</h1>
    <div class="container">
        <form class="d-flex" action="" method="post">
            <div class="col">
                <div class="mb-3">
                    <label for="lbl_codigo" class="form-label">Codigo</label>
                    <input type="text" name="txt_codigo" id="txt_codigo" class="form-control" placeholder="Codigo: E200"
                        value="<?php echo $fila['codigo'] ?>" aria-describedby="helpId" Required>
                </div>
                <div class="mb-3">
                    <label for="lbl_nombres" class="form-label">Nombres</label>
                    <input type="text" name="txt_nombres" id="txt_nombres" class="form-control"
                        value="<?php echo $fila['nombres'] ?>" placeholder="Nombres: Mario Haroldo"
                        aria-describedby="helpId" Required>
                </div>
                <div class="mb-3">
                    <label for="lbl_apellidos" class="form-label">Apellidos</label>
                    <input type="text" name="txt_apellidos" id="txt_apellidos" class="form-control"
                        value="<?php echo $fila['apellidos'] ?>" placeholder="Apellidos: Sinay Gaytán"
                        aria-describedby="helpId" Required>
                </div>
                <div class="mb-3">
                    <label for="lbl_direccion" class="form-label">Direccion</label>
                    <input type="text" name="txt_direccion" id="txt_direccion" class="form-control"
                        value="<?php echo $fila['direccion'] ?>" placeholder="Direccion: 4ta calle"
                        aria-describedby="helpId" Required>
                </div>
                <div class="mb-3">
                    <label for="lbl_telefono" class="form-label">Telefono</label>
                    <input type="text" name="txt_telefono" id="txt_telefono" class="form-control"
                        value="<?php echo $fila['telefono'] ?>" placeholder="Telefono: 30319066"
                        aria-describedby="helpId" Required>
                </div>
                <div class="mb-3">
                    <label for="lbl_puesto" class="form-label">Puesto</label>
                    <select class="form-control" name="drop_puesto" id="drop_puesto">
                        <!-- <option value="<?php echo $fila['id_puesto'] ?>"> -->
                        <?php 
                            $db_conexion3 = mysqli_connect($db_host, $db_usr, $db_pass, $db_name, $db_port);
                            $db_conexion3->real_query("SELECT puesto FROM puestos where id_puesto = '".$fila['id_puesto']."' ;");
                            $resultado3 = $db_conexion3->use_result();
                            while ($fila3 = $resultado3->fetch_assoc()) {
                                echo ("<option value=" . $fila3['id'] . ">" . $fila3['puesto'] . "</option>");
                            }
                            
                        ?>
                        </option>
                        <?php
                        $db_conexion2 = mysqli_connect($db_host, $db_usr, $db_pass, $db_name, $db_port);
                        $db_conexion2->real_query("SELECT id_puesto as id,puesto FROM puestos;");
                        $resultado2 = $db_conexion2->use_result();
                        while ($fila2 = $resultado2->fetch_assoc()) {
                            if ( $fila2['id'] != $fila3['id']){
                                echo ("<option value=" . $fila2['id'] . ">" . $fila2['puesto'] . "</option>");
                            } 
                        }
                        $db_conexion2->close();
                        $db_conexion3->close();
                        ?>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="lbl_fn" class="form-label">Fecha de Nacimiento</label>
                    <input type="date" name="txt_fn" id="txt_fn" class="form-control" placeholder="aaaa-mm-dd"
                        value="<?php echo $fila['fecha_nacimiento'] ?>" aria-describedby="helpId" Required>
                </div>
                <div class="mb-3">
                    <input type="submit" name="btn_editar" id="btn_editar" class="btn btn-primary" value="Editar">
                    <a class="btn btn-danger" href="index.php">Cancelar</a>
                </div>
            </div>
        </form>
        <!-- Bootstrap JavaScript Libraries -->
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
            integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous">
        </script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"
            integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous">
        </script>
    </div>
</body>

<?php 
    } 
    if (isset($_POST["btn_editar"])) {  
        $txt_codigo = utf8_decode($_GET["id"]);
        $txt_nombres = utf8_decode($_POST["txt_nombres"]);
        $txt_apellidos = utf8_decode($_POST["txt_apellidos"]);
        $txt_direccion = utf8_decode($_POST["txt_direccion"]);
        $txt_telefono = utf8_decode($_POST["txt_telefono"]);
        $drop_puesto= utf8_decode($_POST["drop_puesto"]);
        $txt_fn = utf8_decode($_POST["txt_fn"]);
        $sql = "update empleados set nombres='".$txt_nombres."', apellidos='".$txt_apellidos."', direccion='".$txt_direccion."', telefono='".$txt_telefono."', fecha_nacimiento='".$txt_fn."', id_puesto=".$drop_puesto." WHERE codigo='".$txt_codigo."';";
        if($db_conexion->query($sql)===true){
            $db_conexion ->close();
            //ob_start();
            //header('Location: index.php');
            //ob_end_flush();
        }
        else{
            echo "Error".$sql."</br>".$db_conexion ->close();
        }        
    }        

?>


</html>