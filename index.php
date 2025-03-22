<?php 
$titulo = 'cliente';
?>

<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MENU</title>
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
    <h1>Administrativo</h1>
    </br>
    <div id="menu_" >
        <h1>Bienvenido <?php echo $titulo; ?></h1>
        <a id="lbl_regcli" href="Reg_cliente.php">REGISTRO CLIENTE</a>
        <a id="lbl_regcli" href="Reg_producto.php">REGISTRO PRODUCTO</a>
        <a id="lbl_regcli" href="facturacion.php">FACTURACION</a>
    </div>
</body>