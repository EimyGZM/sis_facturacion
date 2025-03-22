<?php
require_once("connexion.php");

try {
    global $pdo;

    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id_factura'],$_POST['subtotalGeneral'],$_POST['impuesto'],$_POST['total'])) {
        $id_factura = $_POST['id_factura'];
        $subtotalGeneral = $_POST['subtotalGeneral'];
        $impuesto = $_POST['impuesto'];
        $total = $_POST['total'];

        $stmt = $pdo->prepare("UPDATE tb_factura SET subtotal = :subtotalGeneral, impuesto = :impuesto, total = :total WHERE id_factura = :id_factura;");
        $stmt->bindParam(':id_factura', $id_factura, PDO::PARAM_INT);
        $stmt->bindParam(':subtotalGeneral', $subtotalGeneral, PDO::PARAM_INT);
        $stmt->bindParam(':impuesto', $impuesto, PDO::PARAM_INT);
        $stmt->bindParam(':total', $total, PDO::PARAM_INT);
        $stmt->execute();

        $producto = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($producto) {
            echo json_encode($producto); 
        } else {
            echo json_encode(["error" => "Producto no guardado"]);
        }

        echo "
        <script>
            alert('factura act con éxito.');
            window.location.href = 'facturacion.php'; 
        </script>";
    }

} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>