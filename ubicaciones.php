<?php
session_start();
if (!isset($_SESSION['id_usuario'])) header('Location: login.php');
include('db/conexion.php');
$titulo = 'Sedes de Reciclaje';
include('includes/header.php');

$res = $conn->query("SELECT u.nombre, d.provincia, d.canton, d.distrito, d.detalle_extra
                     FROM ubicaciones u
                     JOIN detalle_direccion d ON u.id_direccion=d.id_direccion");
?>
<div class="container mt-4">
  <h2>Sedes de Reciclaje</h2>
  <table class="table table-striped">
    <thead><tr><th>Sede</th><th>Provincia</th><th>Cantón</th><th>Distrito</th><th>Detalle</th></tr></thead>
    <tbody>
      <?php while($row=$res->fetch_assoc()): ?>
      <tr>
        <td><?php echo htmlspecialchars($row['nombre']); ?></td>
        <td><?php echo htmlspecialchars($row['provincia']); ?></td>
        <td><?php echo htmlspecialchars($row['canton']); ?></td>
        <td><?php echo htmlspecialchars($row['distrito']); ?></td>
        <td><?php echo htmlspecialchars($row['detalle_extra']); ?></td>
      </tr>
      <?php endwhile; ?>
    </tbody>
  </table>
</div>
<?php include('includes/footer.php'); ?>
