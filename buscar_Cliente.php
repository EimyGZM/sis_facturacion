<?php
require_once("connexion.php");

try {
    global $pdo;

    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id_cliente'])) {
        $id_cliente = $_POST['id_cliente'];


        $stmt = $pdo->prepare("SELECT nombre FROM tb_clientes WHERE id_cliente = :id_cliente");
        $stmt->bindParam(':id_cliente', $id_cliente, PDO::PARAM_INT);
        $stmt->execute();

        if ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            echo $row['nombre']; // Retorna el nombre del cliente
        } else {
            echo "Cliente no encontrado";
        }
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id_producto'])) {
        $id_producto = $_POST['id_producto'];

        if (!ctype_digit($id_producto)) {
            echo json_encode(["error" => "ID de producto inválido"]);
            exit;
        }

        $stmt = $pdo->prepare("SELECT id_producto, nombre, precio_venta FROM tb_producto WHERE id_producto = :id_producto");
        $stmt->bindParam(':id_producto', $id_producto, PDO::PARAM_INT);
        $stmt->execute();

        $producto = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($producto) {
            echo json_encode($producto); 
        } else {
            echo json_encode(["error" => "Producto no encontrado"]);
        }
    } 

} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>

