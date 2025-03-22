<?php 
    $host = 'localhost';
    $db = 'db_sisfacturacion';
    $user = 'postgres'; 
    $pass = 'EimyGuzman13';
    $port = '5432';
    
    $dsn = "pgsql:host=$host;port=$port;dbname=$db";
    //$dsn = pg_connect("host=$host port=$port dbname=$db user=$user password=$pass");
    
    try {
        //$pdo = new PDO($conexion, $user, $pass, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);

        $pdo = new PDO($dsn, $user, $pass, [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,  
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, 
            PDO::ATTR_EMULATE_PREPARES => false, 
            PDO::ATTR_PERSISTENT => true 
        ]);
    } catch (PDOException $e) {
        echo "Error de conexión: " . $e->getMessage();
        exit();
    }
?>