CREATE USER 'admin'@'localhost' IDENTIFIED BY '123';
GRANT ALL PRIVILEGES ON * . * TO 'admin'@'localhost' WITH GRANT OPTION; 
FLUSH PRIVILEGES;


CREATE USER 'almacenero'@'localhost' IDENTIFIED BY '123';
GRANT SELECT,UPDATE,INSERT,DELETE ON cloudware.paquete TO 'almacenero'@'localhost'; 
GRANT SELECT,UPDATE,INSERT,DELETE ON cloudware.lote TO 'almacenero'@'localhost'; 
GRANT SELECT,UPDATE,INSERT,DELETE ON cloudware.destino TO 'almacenero'@'localhost'; 
GRANT SELECT ON cloudware.rutas TO 'almacenero'@'localhost'; 
GRANT SELECT ON cloudware.almacenes TO 'almacenero'@'localhost'; 
GRANT SELECT ON cloudware.empleado TO 'camionero'@'localhost'; 
FLUSH PRIVILEGES;

CREATE USER 'crecom'@'localhost' IDENTIFIED BY '123';
GRANT SELECT,UPDATE,INSERT,DELETE ON cloudware.paquete TO 'crecom'@'localhost'; 
GRANT SELECT,UPDATE,INSERT,DELETE ON cloudware.lote TO 'crecom'@'localhost'; 
GRANT SELECT,UPDATE,INSERT,DELETE ON cloudware.destino TO 'crecom'@'localhost'; 
GRANT SELECT ON cloudware.rutas TO 'crecom'@'localhost'; 
GRANT SELECT ON cloudware.almacenes TO 'crecom'@'localhost'; 
GRANT SELECT ON cloudware.empleado TO 'crecom'@'localhost'; 
FLUSH PRIVILEGES;

CREATE USER 'externo'@'localhost' IDENTIFIED BY '123';
GRANT SELECT ON cloudware.paquete TO 'crecom'@'localhost'; 
GRANT SELECT ON cloudware.lote TO 'crecom'@'localhost'; 
GRANT SELECT ON cloudware.destino TO 'crecom'@'localhost'; 
GRANT SELECT ON cloudware.rutas TO 'crecom'@'localhost'; 
GRANT SELECT ON cloudware.almacenes TO 'crecom'@'localhost'; 
FLUSH PRIVILEGES;


CREATE USER 'camionero'@'localhost' IDENTIFIED BY '123';
GRANT SELECT,UPDATE ON cloudware.paquete TO 'camionero'@'localhost'; 
GRANT SELECT,UPDATE,INSERT ON cloudware.destino TO 'almacenero'@'localhost'; 
GRANT SELECT,UPDATE,INSERT ON cloudware.vehiculo TO 'almacenero'@'localhost'; 
GRANT SELECT,UPDATE,INSERT ON cloudware.lotes TO 'camionero'@'localhost'; 
GRANT SELECT ON cloudware.ubicacion TO 'almacenero'@'localhost'; 
GRANT SELECT ON cloudware.rutas TO 'camionero'@'localhost';
GRANT SELECT ON cloudware.almacenes TO 'camionero'@'localhost';  
GRANT SELECT ON cloudware.empleado TO 'camionero'@'localhost'; 
FLUSH PRIVILEGES;

