<?php	
class apt extends baza{	//класс для работы с таблицей технологии
function show($ord,$DESC){//функция для вывода таблицы
							//получает столбец, по которому необходимо сортировать, направление сортировки
							//возвращает массив массивов со всеми полями таблицы для вывода
$spisok=array();

$quest = "SELECT * FROM apteki ";

if($ord!=null)
{
	switch ($ord) {
    case 0:
        $ord='apteki.name';
        break;
    case 1:
         $ord='adress';
        break;
    case 2:
         $ord='phone';
        break;
}
$quest.=" ORDER BY `$ord`	$DESC";
}


if($result=$this->connection->query($quest)){
    while($row=$result->fetch_assoc()){
	$dop=array(id_ap=>$row['id_ap'],name=>$row['name'],adress=>$row['adress'],phone=>$row['phone']);
    $spisok[]=$dop;
    }
    $result->close();
  }

  return($spisok);
 }
 
 function del($id){//функция для удаления строк из таблицы
					//получает id записи, которую необходимо удалить
	 
	 $quest = "SELECT count(*) FROM lekar WHERE id_ap=".$id;
	
	if($result=$this->connection->query($quest)){
	$row = $result->fetch_assoc();
	If($row['count(*)']==0){
		$quest = "DELETE FROM apteki WHERE id_ap=".$id;
		
		$this->connection->query($quest);
		
	}
	else{ echo "УДАЛЕНИЕ НЕВОЗМОЖНО(ЗАПИСЬ ВХОДИТ В СОСТАВ ТАБЛИЦЫ lekarstv)";
	return('problem');}	
	}
	else{
	return('problem');
	echo $quest;}
 }
 
 function ins($mass2){//функция для добавления сток в таблицу
					//получает массив данныхЮ которые необходимо вставить в таблицу	 
$quest = "INSERT INTO `BD_Aptek`.`apteki` (`id_ap`, `name`, `adress`, `phone`) VALUES (NULL, '".htmlspecialchars(mysql_real_escape_string($mass2[name]))."',
 '".htmlspecialchars(mysql_real_escape_string($mass2[adress]))."',
 '".htmlspecialchars(mysql_real_escape_string($mass2[phone]))."')";
if($result=$this->connection->query($quest))
echo $quest ;
else echo $quest ;
 }
 
    function get_number_by_id($id_ap){//функция для возвращения данных из таблицы аптек
							//получает id записи
							//возвращает данные
$quest = "SELECT * FROM apteki WHERE apteki.id_ap=".$id_ap;
if($result=$this->connection->query($quest)){
    $row=$result->fetch_assoc(); 

$dop=array(name=>$row['name'],adress=>$row['adress'],
			phone=>$row['phone']);
	return($dop);	      
 }
	}
	

   
function chn($mass){//функция для изменения строк таблицы
					//получает массив  с id записи, которую необходимо изменить, а так же с новыми значениями.
	  	  $quest = "UPDATE apteki SET
`name`='".$mass[name]."',
  `adress`='".$mass[adress]."',
  `phone`='".$mass[phone]."'
	
  WHERE id_ap=".$mass[id_ap];
if($result=$this->connection->query($quest))
echo $quest;
//else echo $quest;
 }

   
   
   
   

}
