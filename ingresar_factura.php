<?php
require_once("connexion.php");

try {
    global $pdo;

    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id_cliente'])) {
        $id_cliente = $_POST['id_cliente'];
        $ini = 0;

        $stmt = $pdo->prepare("INSERT INTO tb_factura (id_cliente, fecha, subtotal, impuesto, total) values (:id_cliente, :fecha, :subtotal, :impuesto, :total);");
        $stmt->execute([
            ":id_cliente" => $id_cliente,
            ":fecha" => date("Y-m-d H:i:s"),
            ":subtotal" => $ini,
            ":impuesto" => $ini,
            ":total" => $ini
        ]);
    }

    $stmt = $pdo->prepare("SELECT * FROM tb_factura ORDER BY id_factura DESC LIMIT 1;");
        $stmt->execute();

        if ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            echo $row['id_factura']; // Retorna el nombre del cliente
        } else {
            echo "Cliente no encontrado";
        }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>