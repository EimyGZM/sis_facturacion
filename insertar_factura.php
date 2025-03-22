<?php
require_once("connexion.php");

try {
    global $pdo;

    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id_factura'],$_POST['id_producto'],$_POST['cantidad'])) {
        $id_factura = $_POST['id_factura'];
        $id_producto = $_POST['id_producto'];
        $cantidad = $_POST['cantidad'];

        $stmt = $pdo->prepare("INSERT INTO tb_desarrollofactura (id_factura, id_producto, cantidad) values (:id_factura, :id_producto, :cantidad);");
        $stmt->bindParam(':id_factura', $id_factura, PDO::PARAM_INT);
        $stmt->bindParam(':id_producto', $id_producto, PDO::PARAM_INT);
        $stmt->bindParam(':cantidad', $cantidad, PDO::PARAM_INT);
        $stmt->execute();

        $producto = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($producto) {
            echo json_encode($producto); 
        } else {
            echo json_encode(["error" => "Producto no guardado"]);
        }

        if ($producto) {
            echo json_encode($producto); 
        } else {
            echo json_encode(["error" => "Producto no encontrado"]);
        }

        echo "
        <script>
            alert('Producto guardado con éxito.');
            window.location.href = 'facturacion.php'; 
        </script>";
    }

} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>