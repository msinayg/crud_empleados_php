<?php       
            include("datos_conexion.php");
            $db_conexion = mysqli_connect($db_host, $db_usr, $db_pass, $db_name, $db_port);
            $txt_codigo = utf8_decode($_POST["txt_codigo"]);
            $txt_nombres = utf8_decode($_POST["txt_nombres"]);
            $txt_apellidos = utf8_decode($_POST["txt_apellidos"]);
            $txt_direccion = utf8_decode($_POST["txt_direccion"]);
            $txt_telefono = utf8_decode($_POST["txt_telefono"]);
            $drop_puesto= utf8_decode($_POST["drop_puesto"]);
            $txt_fn = utf8_decode($_POST["txt_fn"]);
            $sql = "INSERT INTO empleados(codigo,nombres,apellidos,direccion,telefono,fecha_nacimiento,id_puesto)VALUES('".$txt_codigo."','".$txt_nombres."','".$txt_apellidos."','".$txt_direccion."','".$txt_telefono."','".$txt_fn."',".$drop_puesto.");";
            if($db_conexion->query($sql)===true){
                $db_conexion ->close();
                echo"Exito";
                ob_start();
                header('Location: index.php');
                ob_end_flush();
            }
            else{
                echo "Error".$sql."</br>".$db_conexion ->close();
            }       
?>

<?php
        
            include("datos_conexion.php");
            $db_conexion = mysqli_connect($db_host, $db_usr, $db_pass, $db_name, $db_port);
            $txt_id = $_GET['id'];
            $sql = "DELETE FROM empleados WHERE id_empleado = '".$txt_id."';";
            if($db_conexion->query($sql)===true){
                $db_conexion ->close();
                echo"Exito";
                ob_start();
                header('Location: index.php');
                ob_end_flush();
            }
            else{
                echo "Error".$sql."</br>".$db_conexion ->close();
            }       
?>