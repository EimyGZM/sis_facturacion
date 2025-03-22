<?php 
    require_once("connexion.php");

    try{
       

    }catch (PDOException $e){
        echo json_encode(array('error'=>'Error de ingresar factura'.$e->getMessage()));
    }

?>