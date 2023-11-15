

CREATE TABLE `login` (
  `email` varchar(32) NOT NULL,
  `password` varchar(255) NOT NULL,
    
    CONSTRAINT `correoLog` check(`email` REGEXP '^[a-zA-Z0-9@.]+$')
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

ALTER TABLE `login`
  ADD PRIMARY KEY (`email`);

INSERT INTO `login` (`email`, `password`) VALUES
('long65tyco@gmail.com', '$2y$10$7PArTXWqqSIw/XU7cpm6OuQsRUrphZ9Ix2nPG9FOcfe6ip96hqAkC'),
('almacenero23@crecom.com', '$2y$10$USNexGc.aBx2Lob3Ncq6OONat713EHpyEdYuKU002eTwHeM39FdEK'),
('almacenero23@mail.com', '$2y$10$IR3OD.sqbFn4ocNYFr/nDO.Z1Mn67F1tGWK9yQTsAESZZNTtI.E4S'),
('camionero23@mail.com', '$2y$10$kkpXVU8z/od8kq4cfcOW7OYbsPS.C13BS/cZSVzq5TRcYcrcx/OKa'),
('NatLong9905@gmail.com', '$2y$10$eMMkqvNofKkbiawtZxQEqum8Lb8fLZdd4ek85X8BQYmx0i3rCazDa');

INSERT INTO `conduce` (`id_matricula`, `id_empleado`) VALUES
('ATP1982', 9),
('STL5691', 9),
('STP1986', 9);

INSERT INTO `asignado` (`id_almacen`, `id_empleado`) VALUES
(1, 3),
(1, 10),
(3, 10),
(4, 3),
(4, 10),
(5, 3),
(5, 10);
