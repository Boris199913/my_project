<?php	
class sot extends baza{	//класс для работы с таблицей кураторы



function show($ord,$DESC){//функция для вывода таблицы
							//получает столбец, по которому необходимо сортировать, направление сортировки
							//возвращает массив массивов со всеми полями таблицы для вывода
$spisok=array();

$result=$this->connection->query("set lc_time_names='ru_RU'");

$quest = "SELECT * FROM sotrud ORDER BY ".$ord." ".$DESC;
if($result=$this->connection->query($quest)){
    while($row=$result->fetch_assoc()){
	$dop=array(id_sot=>$row['id_sot'],FIO=>$row['FIO'],dolzhn=>$row['dolzhn'],data=>$row['data'],phone=>$row['phone'],zp=>$row['zp'],id_ap=>$row['id_ap'],photo=>$row['photo']);
    $spisok[]=$dop;
    }
    $result->close();
  }
  return($spisok); 
 }
 
  function get_number_by_id($id_sot){//функция для возвращения данных из таблицы sotrudnikov
							//получает id записи
							//возвращает данные
$quest = "SELECT * FROM sotrud WHERE sotrud.id_sot=".$id_sot;
if($result=$this->connection->query($quest)){
    $row=$result->fetch_assoc(); 

$dop=array(FIO=>$row['FIO'],dolzhn=>$row['dolzhn'],
			data=>$row['data'],phone=>$row['phone'],
			zp=>$row['zp'],id_ap=>$row['id_ap']);
	return($dop);	      
 }
	}
 
 
function get_cur_by_id($id){//функция для возвращения aptek
							//получает id записи
							//возвращает ФИО куратора
$quest = "SELECT * FROM apteki WHERE id_ap=".$id;
$result=$this->connection->query($quest);
$row=$result->fetch_assoc(); 
  return($row['name']);	      
   }

   function chn($mass){//функция для изменения строк таблицы
					//получает массив  с id записи, которую необходимо изменить, а так же с новыми значениями.
	  	  $quest = "UPDATE sotrud SET
`FIO`='".$mass[FIO]."',
  `dolzhn`='".$mass[dolzhn]."',
  `data`='".$mass[data]."',
    `phone`='".$mass[phone]."',
	`zp`='".$mass[zp]."',
  `id_ap`='".$mass[id_ap]."',
    `photo`='".$mass[photo]."'
	
  WHERE id_sot=".$mass[id_sot];
if($result=$this->connection->query($quest))
echo $quest;
//else echo $quest;
 }
   
  function verni_apt(){//функция для возвращения всех кураторов для выпадающего списка
						//возвращает массив массивов с данными из таблицы Кураторы
	 $quest = "SELECT * FROM apteki ";
if($result=$this->connection->query($quest)){
    while($row=$result->fetch_assoc()){
	
	$dop=array(id_ap=>$row['id_ap'],name=>$row['name']);
    $spisok[]=$dop;
    }
    $result->close();
  }
  return($spisok); 
	 
 }
  function del($id){//функция для удаления строк из таблицы
					//получает id записи, которую необходимо удалить
		$quest = "DELETE FROM sotrud WHERE id_sot=".$id;
		$this->connection->query($quest);
	echo $quest;}
 
 
 function update_img($name,$id){ 
$sql = "UPDATE `sotrud` SET `photo`= '$name'  WHERE id_sot= ".$id." ";
if($result=$this->connection->query($sql))
	echo" ";
else echo $sql;

} 
}

