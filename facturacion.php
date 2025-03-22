<?php 
include("guardar.php"); include("registros.php"); include("connexion.php");
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>FACTURACION</title>
    <link rel="stylesheet" href="css/estilos.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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

    <form action="registros.php" method="POST">
    <input type="hidden" name="type" value="fac_">
        <?php
        echo "Fecha: " . date("Y-m-d H:i:s");
        ?>



        <select name="id_cliente" id="cliente" onchange="consultarcliente();">
            <option value="">-- Seleccione un cliente --</option>
            <?php
                global $result_cli;
                while ($row = pg_fetch_assoc($result_cli)) { ?>
                    <option value="<?= $row['id_cliente'] ?>"><?= $row['nombre'] ?></option>
            <?php } ?>
        </select>


        <script>
            

            function consultarcliente() {
                var idcliente = document.getElementById("cliente").value;

                // Enviar el ID a registros.php usando fetch()
                fetch('buscar_Cliente.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded'
                    },
                    body: 'id_cliente=' + encodeURIComponent(idcliente)
                })
                .then(response => response.text())
                .then(data => {
                    console.log("Nombre del Cliente:", data);
                    document.getElementById("txt_nomcli").value = data;
                })
                .catch(error => console.error('Error:', error));
            }
            </script>
    </form>
    </br>
    
    <div class="container"> 
        <form method="POST" action="agregar.php">
            <input type="text" id="txt_nomcli" name="nombre_cliente" readonly>
            <button type="submit" onclick="ingresar_factura()">Iniciar Factura</button>

            <label for="producto">id factura:</label><input type="text" id="txt_idfac" name="id_factura" readonly>




            
            <label for="producto">Selecciona producto:</label>
            <select name="id_producto" id="producto">
                <option value="">-- Selecciona un producto --</option>
                <?php
                    global $result_prod_act; 
                    while ($row = pg_fetch_assoc($result_prod_act)){ ?>
                    
                    <option id="id_producto" value="<?= $row['id_producto'] ?>"><?= $row['nombre'] ?></option>
                
                <?php } ?>
            </select>

            <label>Cantidad:</label>
            <input id="txt_cantidad" type="text" name="cantidad" required>
            <button type="button" onclick="buscar_producto()"> + Agregar Producto</button>
            

  
        </form>


        <div id="tabla_">
                    
            <table>
                <thead>
                    <tr>
                        <th>ID producto</th>
                        <th>Nombre</th>
                        <th>Cantidad</th>
                        <th>Precio</th>
                        <th>Sub total</th>
                    </tr>
                </thead>
                <tbody id="resultado_prod">
                        
                </tbody>
                

                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>

            </table>

            <h4 id="sub_total">Sub total:</h4>
            <h4 id="itebis">Impuesto:</h4>
            <h4 id="total">Total:</h4>
            
            <button type="submit" onclick="alter_factura()">FACTURAR</button>

        </div>

        <script>
            var impuesto = 0;
            var total = 0;
            var subtotal = 0;
            var subtotalGeneral = 0;
            var id_factura = 0;   
            var cantidad = 0;      

            function buscar_producto() {
                event.preventDefault();
                var idproducto = document.getElementById("producto").value;
                cantidad= document.getElementById("txt_cantidad").value;

                if (cantidad<= 0 || isNaN(cantidad)) {
                    alert("Ingresa una cantidad válida.");
                    return;
                }

                fetch('buscar_Cliente.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded'
                    },
                    body: 'id_producto=' + encodeURIComponent(idproducto)
                })
                .then(response => response.json())
                .then(data => {
                    if (data.error) {
                        alert(data.error);
                    } else {
                        var tabla = document.getElementById("resultado_prod");
                        var fila = document.createElement("tr");
                        subtotal = data.precio_venta * cantidad;
                        subtotalGeneral += subtotal;
                        impuesto = subtotalGeneral * 0.18;
                        total = subtotalGeneral + impuesto;
                        
                        insertar_factura(id_factura,data.id_producto, cantidad);


                        fila.innerHTML = `
                            <td>${data.id_producto}</td>
                            <td>${data.nombre}</td>
                            <td>${cantidad}</td>
                            <td>${data.precio_venta}</td>
                            <td class="subtotal">${(data.precio_venta * cantidad).toFixed(2)}</td>
                        `;

                        tabla.appendChild(fila);

                        document.getElementById("sub_total").innerText = "Sub Total: " + subtotalGeneral;
                        document.getElementById("itebis").innerText = "ITEBIS: " + impuesto;
                        document.getElementById("total").innerText = "Total: " + total;

                        document.getElementById("producto").selectedIndex = 0;
                        document.getElementById("txt_cantidad").value = "";

                    }
                })
                .catch(error => console.error('Error agregar producto:', error));
                
            }

                function ingresar_factura() {
                    var idcliente = document.getElementById("cliente").value;

                    fetch('ingresar_factura.php', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/x-www-form-urlencoded'
                        },
                        body: 'id_cliente=' + encodeURIComponent(idcliente)
                    })
                    .then(response => response.text())
                    .then(data => {
                        console.log("factura", data);
                        document.getElementById("txt_idfac").value = data;
                        id_factura = data;


                    })
                    .catch(error => console.error('Error:', error));

                    
                }

            function insertar_factura(id_factura,id_producto, cantidad) {
                console.log("insertar producto: ");

                fetch('insertar_factura.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded'
                    },
                    body: 'id_factura=' + encodeURIComponent(id_factura) + 
                    '&id_producto=' + encodeURIComponent(id_producto) + 
                    '&cantidad=' + encodeURIComponent(cantidad)
                })
                .then(response => response.text())
                .then(data => {
                    
                })
                .catch(error => console.error('Error:', error));

            }

            function alter_factura(){
                console.log("alter factura: " + id_factura,subtotalGeneral, impuesto,total);

                fetch('alter_factura.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded'
                    },
                    body: 'id_factura=' + encodeURIComponent(id_factura) + 
                    '&subtotalGeneral=' + encodeURIComponent(subtotalGeneral) + 
                    '&impuesto=' + encodeURIComponent(impuesto) +
                    '&total=' + encodeURIComponent(total)
                })
                .then(response => response.text())

                .catch(error => console.error('Error:', error));

                alert('factura act con éxito.');
                window.location.href = 'facturacion.php'; 
            }
        </script>
            
    </div>
</body>