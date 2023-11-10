CREATE USER 'Lucas02'@'localhost' IDENTIFIED BY 'LuRep', 'FaSuarez'@'localhost' IDENTIFIED BY 'fa0982',
'ErzoAbreu'@'localhost' IDENTIFIED BY 'er0982';

GRANT ALL PRIVILEGES ON * . * TO 'Lucas02'@'localhost','FaSuarez'@'localhost',
'ErzoAbreu'@'localhost' WITH GRANT OPTION; 

FLUSH PRIVILEGES;




