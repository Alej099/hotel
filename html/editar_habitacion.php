<?php
// Conexión a la base de datos
require 'conexion.php';

// Verificar si se recibió un ID
if (!isset($_GET['id'])) {
    die("ID no especificado.");
}

$id = $_GET['id'];

// Obtener datos de la habitación
$sql = "SELECT * FROM habitaciones WHERE id = ?";
$stmt = $conexion->prepare($sql);
$stmt->execute([$id]);
$habitacion = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$habitacion) {
    die("Habitación no encontrada.");
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Actualizar Habitación</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f0f4f8;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
    }

    form {
      background-color: white;
      padding: 2em;
      border-radius: 10px;
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
      max-width: 400px;
      width: 100%;
    }

    form label {
      display: block;
      margin-bottom: 1em;
      font-weight: bold;
    }

    input[type="text"],
    input[type="number"],
    textarea {
      width: 100%;
      padding: 0.6em;
      margin-top: 0.4em;
      border: 1px solid #ccc;
      border-radius: 6px;
      box-sizing: border-box;
    }

    textarea {
      resize: vertical;
      min-height: 80px;
    }

    button {
      display: block;
      width: 100%;
      padding: 0.75em;
      background-color: #007bff;
      color: white;
      border: none;
      border-radius: 6px;
      font-size: 1em;
      cursor: pointer;
      transition: background-color 0.3s ease;
    }

    button:hover {
      background-color: #0056b3;
    }
  </style>
</head>
<body>

<form action="actualizar_habitacion.php" method="post" enctype="multipart/form-data">
  <input type="hidden" name="id" value="<?= $habitacion['id'] ?>">
  
  <label>
    Nombre:
    <input type="text" name="nombre" value="<?= htmlspecialchars($habitacion['nombre']) ?>">
  </label>

  <label>
    Descripción:
    <textarea name="descripcion"><?= htmlspecialchars($habitacion['descripcion']) ?></textarea>
  </label>

  <label>
    Precio:
    <input type="number" name="precio" value="<?= $habitacion['precio'] ?>">
  </label>

  <button type="submit">Actualizar</button>
</form>

</body>
</html>

