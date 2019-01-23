<?php	
class naznn extends baza{//класс для работы с таблицей группы

	
function show($ord,$DESC){//функция для вывода таблицы
							//получает столбец, по которому необходимо сортировать и направление сортировки
							//возвращает массив массивов со всеми полями таблицы для вывода
$spisok=array();


$quest = "SELECT * FROM nazn ";

if($ord!=null)
{
	switch ($ord) {
    case 0:
        $ord='group';
        break;
    case 1:
         $ord='text';
        break;
    case 2:
         $ord='goden';
        break;
	}
	$quest.=" ORDER BY `$ord`	$DESC";
}

if($result=$this->connection->query($quest)){
    while($row=$result->fetch_assoc()){
	$dop=array(id_nazn=>$row['id_nazn'],group=>$row['group'],text=>$row['text']);
    $spisok[]=$dop;
    }
    $result->close();
  }
  return($spisok);
 }
 
function del($id){//функция для удаления сток из таблицы
					//получает id записи, которую необходимо удалить
	 
	 $quest = "SELECT count(*) FROM lekar WHERE id_nazn=".$id;
	
	if($result=$this->connection->query($quest)){
	$row = $result->fetch_assoc();
	If($row['count(*)']==0){
		$quest = "DELETE FROM Nazn WHERE id_nazn=".$id;
		
		$this->connection->query($quest);
		
	}
	else{ echo "УДАЛЕНИЕ НЕВОЗМОЖНО(ЗАПИСЬ ВХОДИТ В СОСТАВ ТАБЛИЦЫ lekarstv)";
	return('problem');}	
	}
	else{
	return('problem');
	echo $quest;}
 }
 
  function chn($mass){//функция для изменения строк таблицы
								//получает id записи, которую необходимо изменить, а так же новые значения.
	  	  
$quest = "UPDATE Nazn SET `group`='".$mass[group]."', `text`='".$mass[text]."'
  WHERE id_nazn=".$mass[id_nazn];
$result=$this->connection->query($quest);
echo $quest;
 }
 
 
   function get_number_by_id($id_nazn){//функция для возвращения номера группы
							//получает id записи
							//возвращает номер группы
$quest = "SELECT * FROM Nazn WHERE id_nazn=".$id_nazn;
if($result=$this->connection->query($quest)){
    $row=$result->fetch_assoc(); 
	$dop=array(group=>$row['group'],text=>$row['text']);
	return($dop);	      
   }
}
       function ins($mass2){//функция для добавления строк в таблицу
					//получает массив данныхЮ которые необходимо вставить в таблицу	 
$quest = "INSERT INTO `BD_Aptek`.`Nazn` (`id_nazn`, `group`, `text`) VALUES (NULL, '".$mass2[group]."', '".$mass2[text]."')";
if($result=$this->connection->query($quest))
echo $quest ;
else echo $quest ;
 }
}