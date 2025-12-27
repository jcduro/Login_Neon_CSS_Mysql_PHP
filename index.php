
<?php
session_start();
require_once __DIR__ . "/conexion/conexion.php";

$mensaje = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usuario = trim($_POST['usuario']);
    $clave = trim($_POST['clave']);

    $sql = "SELECT * FROM admin_user WHERE usuario = :usuario LIMIT 1";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['usuario' => $usuario]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($clave, $user['clave'])) {
        $_SESSION['admin'] = $user['usuario'];
        header("Location: visitas/tu_archivo.php");
        exit;
    } else {
        $mensaje = "⚠️ Usuario o contraseña incorrectos";
    }
}
?>

<pre class="ascii-art">
      _  _____ _____  _    _ _____   ____  
     | |/ ____|  __ \| |  | |  __ \ / __ \ 
     | | |    | |  | | |  | | |__) | |  | |
 _   | | |    | |  | | |  | |  _  /| |  | |
| |__| | |____| |__| | |__| | | \ \| |__| |
 \____/ \_____|_____/ \____/|_|  \_\\____/ 
</pre>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Login Efecto Cuadrícula</title>
 <link rel="stylesheet" href="styles.css">
</head>
<body>
  <div class="grid" id="grid"></div>

  <div class="login-container">
    <h2>Iniciar Sesión</h2>
    <input type="text" placeholder="Usuario" />
    <div class="input-group">
      <input type="password" id="password" placeholder="Contraseña" />
      <span class="toggle-password" id="togglePassword">👁️</span>
    </div>
    <button>Ingresar</button>
  </div>
<script src="script.js"></script>
 
</body>
</html>
