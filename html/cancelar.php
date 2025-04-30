<?php
include 'conexion.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "UPDATE habitaciones SET disponibilidad = true WHERE id = :id";
    $stmt = $conexion->prepare($sql);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    
    if ($stmt->execute()) {
        header("Location: habitaciones.php?mensaje=cancelada");
        exit;
    } else {
        header("Location: habitaciones.php?error=cancelacion");
        exit;
    }
} else {
    header("Location: habitaciones.php?error=id");
    exit;
}
?>
