<?php include("db/conexion.php"); session_start(); ?>
<!DOCTYPE html>
<html>
<head><title>Registrar Material</title></head>
<body>
<h2>Registrar Material Reciclado</h2>
<form method="POST">
    Tipo de material:
    <select name="material_id">
        <?php
        $materiales = $conn->query("SELECT id_material, nombre FROM materiales");
        while ($row = $materiales->fetch_assoc()) {
            echo "<option value='{$row['id_material']}'>{$row['nombre']}</option>";
        }
        ?>
    </select><br>
    Cantidad: <input type="number" name="cantidad" required><br>
    <input type="submit" name="registrar" value="Enviar">
</form>

<?php
if (isset($_POST['registrar'])) {
    $usuario_id = $_SESSION['id_usuario'];
    $material_id = $_POST['material_id'];
    $cantidad = $_POST['cantidad'];

    // Insertar registro
    $conn->query("INSERT INTO registro_materiales (usuario_id, material_id, cantidad, fecha) 
                  VALUES ($usuario_id, $material_id, $cantidad, NOW())");

    // Obtener puntos del material
    $res = $conn->query("SELECT puntos_asignados FROM materiales WHERE id_material = $material_id");
    $puntos = $res->fetch_assoc()['puntos_asignados'];
    $total_puntos = $puntos * $cantidad;

    // Sumar puntos al usuario
    $conn->query("UPDATE usuarios SET puntos = puntos + $total_puntos WHERE id_usuario = $usuario_id");

    echo "Registro exitoso. ¡Ganaste $total_puntos puntos!";
}
?>
</body>
</html>
