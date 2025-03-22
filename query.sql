CREATE TABLE tb_Clientes (
    id_cliente SERIAL PRIMARY KEY,
    nombre VARCHAR(100),
    email VARCHAR(100),
    telefono VARCHAR(15),
	direccion VARCHAR(150)
);

CREATE TABLE tb_Producto (
    id_producto SERIAL PRIMARY KEY,
    nombre VARCHAR(100),
    precio_venta DECIMAL(10, 2),
    costo DECIMAL(10, 2),
	stock int,
	status BOOLEAN
);

CREATE TABLE tb_Factura(
	id_factura SERIAL PRIMARY KEY,
	id_cliente INT NOT NULL,
	fecha TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	subtotal DECIMAL(10, 2),
	impuesto DECIMAL(10, 2),
	total DECIMAL(10, 2),
	FOREIGN KEY (id_cliente) REFERENCES tb_Clientes(id_cliente) ON DELETE CASCADE
);

CREATE TABLE tb_DesarrolloFactura(
	id_factura INT NOT NULL,
	id_producto INT NOT NULL,
	cantidad INT NOT NULL,
	FOREIGN KEY (id_factura) REFERENCES tb_Factura(id_factura) ON DELETE CASCADE,
	FOREIGN KEY (id_producto) REFERENCES tb_Producto(id_producto) 
);
