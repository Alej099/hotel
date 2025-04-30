<?php
// Mostrar errores
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Conectar
include 'conexion.php';

if (isset($_GET['id'])) {
    $id = (int) $_GET['id'];

    try {
        // Verificar disponibilidad
        $verificar = $conexion->prepare("SELECT disponibilidad FROM habitaciones WHERE id = :id");
        $verificar->bindParam(':id', $id, PDO::PARAM_INT);
        $verificar->execute();
        $disponible = $verificar->fetchColumn();

        if ($disponible) {
            $stmt = $conexion->prepare("UPDATE habitaciones SET disponibilidad = false WHERE id = :id");
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            header("Location: habitaciones.php?mensaje=Habitación+reservada+correctamente");
            exit;
        } else {
            header("Location: habitaciones.php?mensaje=La+habitación+no+está+disponible,+reserva+otra");
            exit;
        }

    } catch (PDOException $e) {
        echo "❌ Error al reservar: " . $e->getMessage();
    }
} else {
    header("Location: habitaciones.php?mensaje=ID+no+recibido");
    exit;
}
