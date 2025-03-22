<?php include("guardar.php"); include("registros.php"); ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registro de Producto</title>
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
    <h2>Registrar Producto</h2>
    <div class="container"> 
        <form action="guardar.php" method="POST">
            <input type="hidden" name="type" value="producto">

            <label>Nombre:</label>
            <input type="text" name="nombre" required>
            
            <label>Precio Venta:</label>
            <input type="text" name="precio_venta" required>
            
            <label>Costo:</label>
            <input type="text" name="costo" required>

            <label>Stock:</label>
            <input type="text" name="stock" required>

            <div class="label-container">
                <label>Activo:</label>
                <label>
                    <input id="chk_activo" type="checkbox" name="status" value="1" checked>
                </label>
            </div>
            
            <button type="submit">Guardar Producto</button>
        </form>

        <div id="tabla_">
                    
            <table>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Precio de Venta</th>
                    <th>Costo</th>
                    <th>Stock</th>
                    <th>Status</th>
                </tr>

                <?php 
                global $result_prod;
                while ($row = pg_fetch_assoc($result_prod)){
                    echo "
                    <tr>
                        <td>$row[id_producto]</td>
                        <td>$row[nombre]</td>
                        <td>$row[precio_venta]</td>
                        <td>$row[costo]</td>
                        <td>$row[stock]</td>
                        <td>$row[status]</td>
                    </tr>

                    ";
                }
                ?>

            </table>
        </div>
    </div>
</body>
</html>


