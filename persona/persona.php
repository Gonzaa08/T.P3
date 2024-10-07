<?php 

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "base_de_datos";

$conexion = new mysqli($servername, $username, $password, $dbname);

if ($conexion -> connect_error){
    die("Conexión Perdida" . $conexion->connect_error);
} else {
    echo "Conectado";
}

function insertarPersona($conexion, $dni, $nombre, $nacimiento) {
    $sql = "INSERT INTO persona (dni, nombre, nacimiento) VALUES ('$dni', '$nombre', '$nacimiento')";
    if ($conexion->query($sql) === TRUE) {
        echo "Nuevo registro creado <br>";
    } else {
        echo "Error: " . $sql . "<br>" . $conexion->error;
    }
}

function actualizarPersona($conexion, $id, $nombre) {
    $sql = "UPDATE persona SET nombre='$nombre' WHERE id=$id";
    if ($conexion->query($sql) === TRUE) {
        echo "Registro actualizado <br>";
    } else {
        echo "Error: " . $sql . "<br>" . $conexion->error;
    }
}

function eliminarPersona($conexion, $id) {
    $sql = "DELETE FROM persona WHERE id=$id";
    if ($conexion->query($sql) === TRUE) {
        echo "Registro eliminado <br>";
    } else {
        echo "Error: " . $sql . "<br>" . $conexion->error;
    }
}

function obtenerPersonas($conexion) {
    $sql = "SELECT * FROM persona";
    $result = $conexion->query($sql);
    $personas = array();

    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $personas[] = $row;
        }
        echo json_encode($personas);
    } else {
        echo "0 resultados";
    }
}

$conexion->close();

?>
