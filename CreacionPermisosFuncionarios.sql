CREATE USER 'admin'@'localhost' IDENTIFIED BY '123';

GRANT ALL PRIVILEGES ON * . * TO 'admin'@'localhost' WITH GRANT OPTION; 

FLUSH PRIVILEGES;


CREATE USER 'almacenero'@'localhost' IDENTIFIED BY '123';

GRANT SELECT,UPDATE,INSERT,DELETE ON php.paquete TO 'almacenero'@'localhost'; 

GRANT SELECT,UPDATE,INSERT,DELETE ON php.lote TO 'almacenero'@'localhost'; 

GRANT SELECT,UPDATE,INSERT,DELETE ON php.destino TO 'almacenero'@'localhost'; 

GRANT SELECT ON php.rutas TO 'almacenero'@'localhost'; 

GRANT SELECT ON php.almacenes TO 'almacenero'@'localhost'; 

GRANT SELECT ON php.empleado TO 'camionero'@'localhost'; 

FLUSH PRIVILEGES;

CREATE USER 'crecom'@'localhost' IDENTIFIED BY '123';

GRANT SELECT,UPDATE,INSERT,DELETE ON php.paquete TO 'crecom'@'localhost'; 

GRANT SELECT,UPDATE,INSERT,DELETE ON php.lote TO 'crecom'@'localhost'; 

GRANT SELECT,UPDATE,INSERT,DELETE ON php.destino TO 'crecom'@'localhost'; 

GRANT SELECT ON php.rutas TO 'crecom'@'localhost'; 

GRANT SELECT ON php.almacenes TO 'crecom'@'localhost'; 

GRANT SELECT ON php.empleado TO 'crecom'@'localhost'; 

FLUSH PRIVILEGES;

CREATE USER 'externo'@'localhost' IDENTIFIED BY '123';

GRANT SELECT ON php.paquete TO 'crecom'@'localhost'; 

GRANT SELECT ON php.lote TO 'crecom'@'localhost'; 

GRANT SELECT ON php.destino TO 'crecom'@'localhost'; 

GRANT SELECT ON php.rutas TO 'crecom'@'localhost'; 

GRANT SELECT ON php.almacenes TO 'crecom'@'localhost'; 

FLUSH PRIVILEGES;


CREATE USER 'camionero'@'localhost' IDENTIFIED BY '123';

GRANT SELECT,UPDATE ON php.paquete TO 'camionero'@'localhost'; 

GRANT SELECT,UPDATE,INSERT,DELETE ON php.destino TO 'almacenero'@'localhost'; 

GRANT SELECT,UPDATE,INSERT,DELETE ON php.vehiculo TO 'almacenero'@'localhost'; 

GRANT SELECT,UPDATE,INSERT,DELETE ON php.lotes TO 'camionero'@'localhost'; 

GRANT SELECT ON php.ubicacion TO 'almacenero'@'localhost'; 

GRANT SELECT ON php.rutas TO 'camionero'@'localhost';

GRANT SELECT ON php.almacenes TO 'camionero'@'localhost';  

GRANT SELECT ON php.empleado TO 'camionero'@'localhost'; 

FLUSH PRIVILEGES;

