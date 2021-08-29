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
        <form class="d-flex" action="crud_empleado.php" method="post">
            <div class="col">
                <div class="mb-3">
                    <label for="lbl_codigo" class="form-label">Codigo</label>
                    <input type="text" name="txt_codigo" id="txt_codigo" class="form-control" placeholder="Codigo: E200"
                        aria-describedby="helpId" Required>
                </div>
                <div class="mb-3">
                    <label for="lbl_nombres" class="form-label">Nombres</label>
                    <input type="text" name="txt_nombres" id="txt_nombres" class="form-control"
                        placeholder="Nombres: Mario Haroldo" aria-describedby="helpId" Required>
                </div>
                <div class="mb-3">
                    <label for="lbl_apellidos" class="form-label">Apellidos</label>
                    <input type="text" name="txt_apellidos" id="txt_apellidos" class="form-control"
                        placeholder="Apellidos: Sinay Gaytán" aria-describedby="helpId" Required>
                </div>
                <div class="mb-3">
                    <label for="lbldirecciono" class="form-label">Direccion</label>
                    <input type="text" name="txt_direccion" id="txt_direccion" class="form-control"
                        placeholder="Direccion: 4ta calle" aria-describedby="helpId" Required>
                </div>
                <div class="mb-3">
                    <label for="lbl_telefono" class="form-label">Telefono</label>
                    <input type="text" name="txt_telefono" id="txt_telefono" class="form-control"
                        placeholder="Telefono: 30319066" aria-describedby="helpId" Required>
                </div>
                <div class="mb-3">
                    <label for="lbl_puesto" class="form-label">Puesto</label>
                    <select class="form-control" name="drop_puesto" id="drop_puesto">
                        <option value=0>----Puesto----</option>
                        <?php
                        include("datos_conexion.php");
                        $db_conexion = mysqli_connect($db_host, $db_usr, $db_pass, $db_name, $db_port);
                        $db_conexion->real_query("SELECT id_puesto as id,puesto FROM puestos;");
                        $resultado = $db_conexion->use_result();
                        while ($fila = $resultado->fetch_assoc()) {
                            echo ("<option value=" . $fila['id'] . ">" . $fila['puesto'] . "</option>");
                        }
                        $db_conexion->close();
                        ?>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="lbl_fn" class="form-label">Fecha de Nacimiento</label>
                    <input type="date" name="txt_fn" id="txt_fn" class="form-control" placeholder="aaaa-mm-dd"
                        aria-describedby="helpId" Required>
                </div>
                <div class="mb-3">
                    <input type="submit" name="btn_agregar" id="btn_agregar" class="btn btn-primary" value="Agregar">
                </div>
            </div>
        </form>
        <table class="table table-striped table-inverse table-responsive">
            <thead class="thead-inverse">
                <tr>
                    <th>Codigo</th>
                    <th>Nombres</th>
                    <th>Apellidos</th>
                    <th>Direccion</th>
                    <th>Telefono</th>
                    <th>Fecha de Nacimiento</th>
                    <th>Puesto</th>
                    <th>Operaciones</th>
                </tr>
            </thead>
            <tbody>
                <?php
                include("datos_conexion.php");
                $db_conexion = mysqli_connect($db_host, $db_usr, $db_pass, $db_name, $db_port);
                $db_conexion->real_query("select e.id_empleado,e.codigo,e.nombres,e.apellidos,e.direccion,e.telefono,e.fecha_nacimiento,p.puesto from empleados as e inner join puestos as p on e.id_puesto = p.id_puesto  ;");
                $resultado = $db_conexion->use_result();
                while ($fila = $resultado->fetch_assoc()) {
                    echo "<tr data-id=" . $fila['id_empleado'] . ">";
                    echo ("<th>" . $fila['codigo'] . "</th>");
                    echo ("<th>" . $fila['nombres'] . "</th>");
                    echo ("<th>" . $fila['apellidos'] . "</th>");
                    echo ("<th>" . $fila['direccion'] . "</th>");
                    echo ("<th>" . $fila['telefono'] . "</th>");
                    echo ("<th>" . $fila['fecha_nacimiento'] . "</th>");
                    echo ("<th>" . $fila['puesto'] . "</th>");
                    echo ("<th>");
                    echo ("<a class=\"btn btn-warning\" id=\"btn_editar\" href=\"editar.php?id=". $fila['codigo'] ."\">Editar</a>");
                    echo ("<a class=\"btn btn-danger\" id=\"btn_eliminar\" href=\"crud_empleado.php?id=". $fila['id_empleado'] ."\" >Eliminar</a>");
                    echo ("</th>");
                    echo "</tr>";
                }
                $db_conexion->close();
                ?>
            </tbody>
        </table>

        <?php
        if (isset($_POST["btn_eliminar"])){
            include("datos_conexion.php");
            $db_conexion = mysqli_connect($db_host, $db_usr, $db_pass, $db_name, $db_port);
            //$txt_codigo = utf8_decode($fila['id_empleado']);
            $sql="DELETE FROM empleados WHERE codigo == '".$fila['id_empleado']."'";
            $resultado = $mysqli->query($sql);
            ob_start();
            header("Refresh:0");
            ob_end_flush();
        }
        ?>
        <!-- Bootstrap JavaScript Libraries -->
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
            integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous">
        </script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"
            integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous">
        </script>
    </div>
</body>

</html>