<?php include("db/conexion.php"); ?>
<!DOCTYPE html>
<html>
<head>
    <title>Registro</title>
</head>
<body>
<h2>Registro de Usuario</h2>
<form method="POST">
    Nombre: <input type="text" name="nombre" required><br>
    Correo: <input type="email" name="correo" required><br>
    Contraseña: <input type="password" name="clave" required><br>
    <input type="submit" name="registrar" value="Registrarse">
</form>

<?php
if (isset($_POST['registrar'])) {
    $nombre = $_POST['nombre'];
    $correo = $_POST['correo'];
    $clave = password_hash($_POST['clave'], PASSWORD_DEFAULT);
    $sql = "INSERT INTO usuarios (nombre, correo, contraseña, puntos, tipo_usuario)
            VALUES ('$nombre', '$correo', '$clave', 0, 'normal')";
    if ($conn->query($sql)) {
        echo "Registro exitoso";
    } else {
        echo "Error: " . $conn->error;
    }
}
?>
</body>
</html>
