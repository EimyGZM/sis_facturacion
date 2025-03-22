<?php 
include("connexion.php");

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["type"])) {
    $type = $_POST["type"];

    if ($type == "cliente") {
        guardarCliente($_POST["nombre"], $_POST["email"], $_POST["telefono"], $_POST["direccion"], $_POST["fecha_nacimiento"]);
    }elseif($type == "producto"){
        guardarProducto($_POST["nombre"], $_POST["precio_venta"], $_POST["costo"], $_POST["stock"], $_POST["status"]);
    } else{
        echo "Error: Tipo de registro no válido.";
    }
}

function guardarCliente($nombre, $email, $telefono, $direccion, $fecha_nacimiento) {
    global $pdo;
    try {
        $sql = "INSERT INTO tb_Clientes (nombre, email, telefono, direccion, fecha_nacimiento) VALUES (:nombre, :email, :telefono, :direccion, :fecha_nacimiento)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ":nombre" => $nombre,
            ":email" => $email,
            ":telefono" => $telefono,
            ":direccion" => $direccion,
            ":fecha_nacimiento" => $fecha_nacimiento
        ]);
        //echo "Cliente guardado con éxito.";

        echo "
        <script>
            alert('Cliente guardado con éxito.');
            window.location.href = 'Reg_cliente.php'; 
        </script>";
    } catch (PDOException $e) {
        echo "Error al guardar cliente: " . $e->getMessage();
    }
}

function guardarProducto($nombre, $precio_venta, $costo, $stock, $status) {
    global $pdo;

    if($status != 1){
        $status = 0;
    }
    try {
        $sql = "INSERT INTO tb_producto (nombre, precio_venta, costo, stock, status) VALUES (:nombre, :precio_venta, :costo, :stock, :status)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ":nombre" => $nombre,
            ":precio_venta" => $precio_venta,
            ":costo" => $costo,
            ":stock" => $stock,
            ":status" => $status
        ]);
        //echo "Cliente guardado con éxito.";

        echo "
        <script>
            alert('Producto guardado con éxito.');
            window.location.href = 'Reg_producto.php'; 
        </script>";
    } catch (PDOException $e) {
        echo "Error al guardar producto: " . $e->getMessage();
    }
}
?>