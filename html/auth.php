<?php
session_start();
require_once 'conexion.php'; // Asegúrate de que este archivo esté en la misma carpeta

// ========== INICIO DE SESIÓN ==========
if (isset($_POST['login'])) {
    $correo = $_POST['email'];
    $clave = $_POST['password'];

    try {
        $stmt = $conexion->prepare("SELECT * FROM usuarios WHERE correo = :correo");
        $stmt->execute(['correo' => $correo]);
        $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($usuario && password_verify($clave, $usuario['clave'])) {
            $_SESSION['user_id'] = $usuario['id'];
            $_SESSION['nombre'] = $usuario['nombre'];
            $_SESSION['rol'] = $usuario['rol'];

            // Redirección según el rol
            if ($usuario['rol'] == 1) {
                header("Location: admi.php");
            } else {
                header("Location: habitaciones.php");
            }
            exit();
        } else {
            echo "<script>
                    alert('❌ Correo o contraseña incorrectos');
                    window.location.href='index.php#modal-login';
                  </script>";
            exit();
        }
    } catch (PDOException $e) {
        echo "<script>
                alert('⚠️ Error en inicio de sesión: " . $e->getMessage() . "');
                window.location.href='index.php#modal-login';
              </script>";
        exit();
    }
}

// ========== REGISTRO DE USUARIO ==========
if (isset($_POST['register'])) {
    $nombre     = $_POST['nombre'];
    $correo     = $_POST['email'];
    $clave      = $_POST['password'];
    $confirmar  = $_POST['confirmar'];

    if ($clave !== $confirmar) {
        echo "<script>
                alert('❌ Las contraseñas no coinciden');
                window.location.href='index.php#modal-register';
              </script>";
        exit();
    }

    $hash = password_hash($clave, PASSWORD_DEFAULT);
    $rol = 0; // por defecto, cliente

    try {
        $stmt = $conexion->prepare("INSERT INTO usuarios (nombre, correo, clave, rol)
                                    VALUES (:nombre, :correo, :clave, :rol)");
        $stmt->execute([
            'nombre'     => $nombre,
            'correo'     => $correo,
            'clave'      => $hash,
            'rol'        => $rol
        ]);

        echo "<script>
                alert('✅ Usuario registrado con éxito. Ahora inicia sesión.');
                window.location.href='index.php#modal-login';
              </script>";
        exit();
    } catch (PDOException $e) {
        echo "<script>
                alert('⚠️ Error al registrar: el correo ya está registrado.');
                window.location.href='index.php#modal-register';
              </script>";
        exit();
    }
}