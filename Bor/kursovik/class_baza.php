<?php
class baza{//класс для рнаботы с БД
  const USERNAME="root";
  const PASSWORD="";//
  const DBNAME="BD_Aptek";
  const SERVER="localhost";


function __construct(){//функция для подключения к БД
  if($mysqli=new mysqli(self::SERVER, self::USERNAME,
                        self::PASSWORD, self::DBNAME)){
	$this->connection=$mysqli;	
	
mysql_connect('localhost', 'root', '');//
}
}



function _destruct(){//функция для отключерия от БД
  $this->connection->close();
}
}
?>