


CREATE USER 'almacenero_quickcarry_cw'@'localhost' IDENTIFIED BY '123';
GRANT SELECT,UPDATE,INSERT,DELETE ON cloudware.paquete TO 'almacenero_quickcarry_cw'@'localhost'; 
GRANT SELECT,UPDATE,INSERT,DELETE ON cloudware.lote TO 'almacenero_quickcarry_cw'@'localhost'; 
GRANT SELECT,UPDATE,INSERT,DELETE ON cloudware.destinado TO 'almacenero_quickcarry_cw'@'localhost'; 
GRANT SELECT ON cloudware.ruta TO 'almacenero_quickcarry_cw'@'localhost'; 
GRANT SELECT ON cloudware.almacen TO 'almacenero_quickcarry_cw'@'localhost'; 
GRANT SELECT ON cloudware.asignado TO 'almacenero_quickcarry_cw'@'localhost'; 
GRANT SELECT ON cloudware.empleado TO 'almacenero_quickcarry_cw'@'localhost'; 
FLUSH PRIVILEGES;

CREATE USER 'empaquetador_crecom_cw'@'localhost' IDENTIFIED BY '123';
GRANT SELECT,UPDATE,INSERT,DELETE ON cloudware.paquete TO 'empaquetador_crecom_cw'@'localhost'; 
GRANT SELECT,UPDATE,INSERT,DELETE ON cloudware.lote TO 'empaquetador_crecom_cw'@'localhost'; 
GRANT SELECT,UPDATE,INSERT,DELETE ON cloudware.destinado TO 'empaquetador_crecom_cw'@'localhost'; 
GRANT SELECT ON cloudware.ruta TO 'empaquetador_crecom_cw'@'localhost'; 
GRANT SELECT ON cloudware.almacen TO 'empaquetador_crecom_cw'@'localhost'; 
GRANT SELECT ON cloudware.empleado TO 'empaquetador_crecom_cw'@'localhost'; 
FLUSH PRIVILEGES;

CREATE USER 'externo_seguimiento_cw'@'localhost' IDENTIFIED BY '123';
GRANT SELECT ON cloudware.paquete TO 'externo_seguimiento_cw'@'localhost'; 
GRANT SELECT ON cloudware.lote TO 'externo_seguimiento_cw'@'localhost'; 
GRANT SELECT ON cloudware.destinado TO 'externo_seguimiento_cw'@'localhost'; 
GRANT SELECT ON cloudware.ruta TO 'externo_seguimiento_cw'@'localhost'; 
GRANT SELECT ON cloudware.almacen TO 'externo_seguimiento_cw'@'localhost'; 
FLUSH PRIVILEGES;


CREATE USER 'camionero_quickcarry_cw'@'localhost' IDENTIFIED BY '123';
GRANT SELECT,UPDATE ON cloudware.paquete TO 'camionero_quickcarry_cw'@'localhost'; 
GRANT SELECT,UPDATE,INSERT ON cloudware.destinado TO 'camionero_quickcarry_cw'@'localhost'; 
GRANT SELECT,UPDATE,INSERT ON cloudware.vehiculo TO 'camionero_quickcarry_cw'@'localhost'; 
GRANT SELECT,UPDATE,INSERT ON cloudware.lotes TO 'camionero_quickcarry_cw'@'localhost'; 
GRANT SELECT ON cloudware.ubicacion TO 'camionero_quickcarry_cw'@'localhost'; 
GRANT SELECT ON cloudware.ruta TO 'camionero_quickcarry_cw'@'localhost';
GRANT SELECT ON cloudware.almacen TO 'camionero_quickcarry_cw'@'localhost';  
GRANT SELECT ON cloudware.empleado TO 'camionero_quickcarry_cw'@'localhost'; 
GRANT SELECT ON cloudware.conduce TO 'camionero_quickcarry_cw'@'localhost'; 
FLUSH PRIVILEGES;