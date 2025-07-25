<?php include("conexion.php"); session_start(); 
include('includes/header.php');
?>
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
            
            header("Location: includes/dashboard.php");
        } else {
            echo "Contraseña incorrecta.";
        }
    } else {
        echo "Usuario no encontrado.";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <meta charset="UTF-8">
    
</head>
<body>
<div class="d-flex justify-content-center align-items-center min-vh-100">
    <div class="card border-0 w-50 shadow p-4" >
    <h2 class="mt-4">Inicio de Sesión</h2>
    <form method="POST">
        <div class="mb-3">
            <label for="correo" class="form-label">Correo</label>
            <input type="email" class="form-control" id="correo" name="correo" required>
        </div>
        <div class="mb-3">
            <label for="clave" class="form-label">Contraseña</label>
            <input type="password" class="form-control" id="clave" name="clave" required>
        </div>      
        <button type="submit" name="ingresar" class="btn btn-success w-100">Entrar</button>
                
    </form>
    
    <div class="mt-3 text-center">
    <a href="registro.php" class="btn btn-outline-secondary w-100">
        ¿No tienes cuenta? Regístrate
    </a>
    </div>

    </div>
</div>
</body>
<?php include('includes/footer.php'); ?>
</html>
