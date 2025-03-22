<?php 
    include("connexion.php");
    $conexion = pg_connect("host=localhost dbname=db_sisfacturacion user=postgres password=EimyGuzman13");
    if(!$conexion){
        echo "erro conexion db";
        exit;
    }

    $result_cli = pg_query($conexion, "SELECT * FROM tb_Clientes");
    if(!$result_cli){
        echo "erro conexion result_cli";
        exit;
    }

    $result_cli = pg_query($conexion, "SELECT * FROM tb_Clientes");
    if(!$result_cli){
        echo "erro conexion result_cli";
        exit;
    }

    $result_prod = pg_query($conexion, "SELECT * FROM tb_producto");
    if(!$result_prod){
        echo "erro conexion result_prod";
        exit;
    }

    $result_prod_act = pg_query($conexion, "SELECT * FROM tb_producto WHERE status = true");
    if(!$result_prod_act){
        echo "erro conexion result_prod_act";
        exit;
    }

?>