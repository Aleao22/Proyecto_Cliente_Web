<?php include("db/conexion.php"); session_start(); ?>
<!DOCTYPE html>
<html>
<head><title>Login</title></head>
<body>
<h2>Inicio de Sesión</h2>
<form method="POST">
    Correo: <input type="email" name="correo" required><br>
    Contraseña: <input type="password" name="clave" required><br>
    <input type="submit" name="ingresar" value="Entrar">
</form>

<?php
if (isset($_POST['ingresar'])) {
    $correo = $_POST['correo'];
    $clave = $_POST['clave'];
    $sql = "SELECT * FROM usuarios WHERE correo='$correo'";
    $resultado = $conn->query($sql);

    if ($resultado->num_rows == 1) {
        $usuario = $resultado->fetch_assoc();
        if (password_verify($clave, $usuario['contraseña'])) {
            $_SESSION['id_usuario'] = $usuario['id_usuario'];
            header("Location: dashboard.php");
        } else {
            echo "Contraseña incorrecta.";
        }
    } else {
        echo "Usuario no encontrado.";
    }
}
?>
</body>
</html>
