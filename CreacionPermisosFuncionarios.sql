CREATE USER 'admin_quickcarry_cw'@'localhost' IDENTIFIED BY '123';
GRANT ALL PRIVILEGES ON * . * TO 'admin_quickcarry_cw'@'localhost' WITH GRANT OPTION; 
FLUSH PRIVILEGES;


CREATE USER 'almacenero_quickcarry_cw'@'localhost' IDENTIFIED BY '123';
GRANT SELECT,UPDATE,INSERT,DELETE ON base_quickcarry.paquete TO 'almacenero_quickcarry_cw'@'localhost'; 
GRANT SELECT,UPDATE,INSERT,DELETE ON base_quickcarry.lote TO 'almacenero_quickcarry_cw'@'localhost'; 
GRANT SELECT,UPDATE,INSERT,DELETE ON base_quickcarry.destinado TO 'almacenero_quickcarry_cw'@'localhost'; 
GRANT SELECT ON base_quickcarry.ruta TO 'almacenero_quickcarry_cw'@'localhost'; 
GRANT SELECT ON base_quickcarry.almacen TO 'almacenero_quickcarry_cw'@'localhost'; 
GRANT SELECT ON base_quickcarry.asignado TO 'almacenero_quickcarry_cw'@'localhost'; 
GRANT SELECT ON base_quickcarry.empleado TO 'almacenero_quickcarry_cw'@'localhost'; 
FLUSH PRIVILEGES;

CREATE USER 'empaquetador_crecom_cw'@'localhost' IDENTIFIED BY '123';
GRANT SELECT,UPDATE,INSERT,DELETE ON base_quickcarry.paquete TO 'empaquetador_crecom_cw'@'localhost'; 
GRANT SELECT,UPDATE,INSERT,DELETE ON base_quickcarry.lote TO 'empaquetador_crecom_cw'@'localhost'; 
GRANT SELECT,UPDATE,INSERT,DELETE ON base_quickcarry.destinado TO 'empaquetador_crecom_cw'@'localhost'; 
GRANT SELECT ON base_quickcarry.ruta TO 'empaquetador_crecom_cw'@'localhost'; 
GRANT SELECT ON base_quickcarry.almacen TO 'empaquetador_crecom_cw'@'localhost'; 
GRANT SELECT ON base_quickcarry.empleado TO 'empaquetador_crecom_cw'@'localhost'; 
FLUSH PRIVILEGES;

CREATE USER 'externo_seguimiento_cw'@'localhost' IDENTIFIED BY '123';
GRANT SELECT ON base_quickcarry.paquete TO 'externo_seguimiento_cw'@'localhost'; 
GRANT SELECT ON base_quickcarry.lote TO 'externo_seguimiento_cw'@'localhost'; 
GRANT SELECT ON base_quickcarry.destinado TO 'externo_seguimiento_cw'@'localhost'; 
GRANT SELECT ON base_quickcarry.ruta TO 'externo_seguimiento_cw'@'localhost'; 
GRANT SELECT ON base_quickcarry.almacen TO 'externo_seguimiento_cw'@'localhost'; 
FLUSH PRIVILEGES;


CREATE USER 'camionero_quickcarry_cw'@'localhost' IDENTIFIED BY '123';
GRANT SELECT,UPDATE ON base_quickcarry.paquete TO 'camionero_quickcarry_cw'@'localhost'; 
GRANT SELECT,UPDATE,INSERT ON base_quickcarry.destinado TO 'camionero_quickcarry_cw'@'localhost'; 
GRANT SELECT,UPDATE,INSERT ON base_quickcarry.vehiculo TO 'camionero_quickcarry_cw'@'localhost'; 
GRANT SELECT,UPDATE,INSERT ON base_quickcarry.lotes TO 'camionero_quickcarry_cw'@'localhost'; 
GRANT SELECT ON base_quickcarry.ubicacion TO 'camionero_quickcarry_cw'@'localhost'; 
GRANT SELECT ON base_quickcarry.ruta TO 'camionero_quickcarry_cw'@'localhost';
GRANT SELECT ON base_quickcarry.almacen TO 'camionero_quickcarry_cw'@'localhost';  
GRANT SELECT ON base_quickcarry.empleado TO 'camionero_quickcarry_cw'@'localhost'; 
GRANT SELECT ON base_quickcarry.conduce TO 'camionero_quickcarry_cw'@'localhost'; 
FLUSH PRIVILEGES;