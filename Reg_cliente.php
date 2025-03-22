<?php include("guardar.php"); include("registros.php"); ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registro de Clientes</title>
    <link rel="stylesheet" href="css/estilos.css">
</head>
<body>
    <header class="navbar">
        <nav>
            <ul>
                <li><a href="index.php">MENU</a></li>
                <li><a href="Reg_cliente.php">REGISTRO CLIENTE</a></li>
                <li><a href="Reg_producto.php">REGISTRO PRODUCTO</a></li>
                <li><a href="facturacion.php">FACTURACIÓN</a></li>
            </ul>
        </nav>
    </header>
    <h2>Registrar Cliente</h2>
    <div class="container"> 
        <form action="guardar.php" method="POST">
            <input type="hidden" name="type" value="cliente">

            <label>Nombre:</label>
            <input type="text" name="nombre" required>
            
            <label>Email:</label>
            <input type="email" name="email" required>
            
            <label>Teléfono:</label>
            <input type="text" name="telefono" required>

            <label>Direccion:</label>
            <input type="text" name="direccion" required>

            <label>Fecha de nacimiento:</label>
            <input type="date" name="fecha_nacimiento" required>
            
            <button type="submit">Guardar Cliente</button>
        </form>

        <div id="tabla_">
                    
            <table>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Email</th>
                    <th>Telefono</th>
                    <th>Direccion</th>
                    <th>Fecha Nacimiento</th>
                </tr>

                <?php 
                global $result_cli;
                while ($row = pg_fetch_assoc($result_cli)){
                    echo "
                    <tr>
                        <td>$row[id_cliente]</td>
                        <td>$row[nombre]</td>
                        <td>$row[email]</td>
                        <td>$row[telefono]</td>
                        <td>$row[direccion]</td>
                        <td>$row[fecha_nacimiento]</td>
                    </tr>

                    ";
                }

                ?>

            </table>
        </div>
    </div>
</body>
</html>


