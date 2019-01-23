<?php	
class events extends baza{//класс для работы с главной страницей администрирования

function show_drugs($ord,$DESC){//функция для вывода таблицы лекарств
							//получает столбец, по которому необходимо сортировать и направление сортировки
							//возвращает массив массивов со всеми полями таблицы для вывода
$spisok=array();
$quest = "SELECT * FROM  postavhiki,apteki ,nazn,lekar
where(apteki.id_ap=lekar.id_ap) 
and (postavhiki.id_post = lekar.`id_post`)
and (nazn.id_nazn = lekar.`id_nazn`) 
 ";


if($name!=null)
{
	$ii=0;
	foreach ($name as $value){
	$quest.= ' and ( $value= $what[$ii])  ';
	$ii++;
	}
}

if($ord!=null)
{
	switch ($ord) {
    case 0:
        $ord='lekar.name';
        break;
    case 1:
         $ord='price';
        break;
    case 2:
         $ord='goden';
        break;
		case 3:
         $ord='nazn.group';
        break;
		case 4:
         $ord='apteki.adress';
        break;
		case 5:
         $ord='postavhiki.strana';
        break;
}
$quest.=" ORDER BY $ord	$DESC";

}
if($result=$this->connection->query($quest)){
	
    while($row=$result->fetch_assoc()){
	$dop=array(name=>$row['name'],price=>$row['price'],
			goden=>$row['goden'], 
			adress=>$row['adress'],	strana=>$row['strana'],	
			group=>$row['group'],id_lekar=>$row['id_lekar']
			
	);
	
    $spisok[]=$dop;
    }
    $result->close();
  return($spisok);
 }
}  

function get_info($id){//функция для вывода таблицы лекарств
							//получает столбец, по которому необходимо сортировать и направление сортировки
							//возвращает массив массивов со всеми полями таблицы для вывода
$quest = "SELECT * FROM  postavhiki,apteki ,nazn,lekar
where(apteki.id_ap=lekar.id_ap) 
and (postavhiki.id_post = lekar.`id_post`)
and (nazn.id_nazn = lekar.`id_nazn`) and(lekar.id_lekar =$id) 
 ";


if($result=$this->connection->query($quest)){
	
    while($row=$result->fetch_assoc()){
	$dop=array(name=>$row['name'],price=>$row['price'],
			goden=>$row['goden'], 
			adress=>$row['adress'],	strana=>$row['strana'],	
			group=>$row['group'],id_lekar=>$row['id_lekar']
			
	);
	
    }
    $result->close();
  return($dop);
 }
}  



//ВЛОЖЕННЫЙ СЕЛЕКТ
//ВЫВОДИТ НАЗВАНИЕ АПТЕКИ В КОТОРМ НАХОДИТСЯ ЛЕКАРСТВО С САМЫМ БЛИЗКИМ ИСТЕЧЕНИЕМ СРОКА ГОДНОСТИ	

function godn(){//функция для вывода таблицы лекарств
							//получает столбец, по которому необходимо сортировать и направление сортировки
							//возвращает массив массивов со всеми полями таблицы для вывода

							
$quest = "SELECT name FROM apteki
where id_ap=(
SELECT DISTINCT( id_ap) FROM lekar where goden=( SELECT min(goden) from lekar )
) 
 ";


if($result=$this->connection->query($quest)){
	
    while($row=$result->fetch_assoc()){
	$nm= $row['name'];
	
	
    }
    $result->close();
  return($nm);
 }
} 

  function chn($nm,$pr,$gd,$tp,$ap,$str,$id){//функция для изменения строк таблицы
					//получает массив  с id записи, которую необходимо изменить, а так же с новыми значениями.
	  	  
$quest = "UPDATE  lekar SET ";
$quest .= "
`name`='".$nm."',
  `price`='".$pr."',
  `goden`='".$gd."',
    `id_ap`='".$ap."',
	`id_nazn`='".$tp."',
    `id_post`='".$str."' ";

$quest .= "
where(id_lekar=$id)  ";
$result=$this->connection->query($quest);

 }
 
 	function del($id){//функция для удаления строк из таблицы
					//получает id записи, которую необходимо удалить
	 
	 $quest = "SELECT count(*) FROM postavhiki  WHERE id_lekar=".$id;
	
	if($result=$this->connection->query($quest)){
	$row = $result->fetch_assoc();
	If($row['count(*)']==0){
		$quest = "DELETE FROM lekar WHERE id_lekar=".$id;
		
		$this->connection->query($quest);
		
	}
	else{ echo "УДАЛЕНИЕ НЕВОЗМОЖНО(ЗАПИСЬ ВХОДИТ В СОСТАВ ТАБЛИЦЫ lekarstv)";
	return('problem');}	
	}
	else{
	return('problem');
	echo $quest;}
 }

function show_drugs2($nm,$pr,$tp, $apt, $cnt){//функция для вывода таблицы лекарств
							//получает столбец, по которому необходимо сортировать и направление сортировки
							//возвращает массив массивов со всеми полями таблицы для вывода
$spisok=array();
$quest = "SELECT * FROM  postavhiki ,nazn,apteki,lekar
where(apteki.id_ap=lekar.id_ap) 
and (postavhiki.id_post = lekar.`id_post`)
and (nazn.id_nazn = lekar.`id_nazn`)  ";


if($nm!=null)$quest.= " and ( lekar.name LIKE '%".$nm."%'])  ";
if($pr!=null)$quest.= " and ( price =$pr)  ";
if($tp!=null)$quest.= " and ( nazn.group LIKE '%".$tp."%')  ";
if($apt!=null)$quest.= " and ( apteki.adress LIKE '%".$apt."%')  ";
if($cnt!=null)$quest.= " and ( strana LIKE '%".$cnt."%')  ";


if($result=$this->connection->query($quest)){
	
    while($row=$result->fetch_assoc()){
	$dop=array(name=>$row['name'],price=>$row['price'],
			goden=>$row['goden'], 
			adress=>$row['adress'],	strana=>$row['strana'],	
			group=>$row['group']
			
	);
	
    $spisok[]=$dop;
    }
    $result->close();
  return($spisok);
 }
 
}
 
   function verni_gr(){//функция для возвращения всех кураторов для выпадающего списка
						//возвращает массив массивов с данными из таблицы Кураторы
	 $quest = "SELECT * FROM nazn ";
if($result=$this->connection->query($quest)){
    while($row=$result->fetch_assoc()){
	
	$dop=array(name=>$row['group'],id=>$row['id_nazn']);
    $spisok[]=$dop;
    }
    $result->close();
  }
  return($spisok); 
	 
 }
 
 
    function verni_ap(){//функция для возвращения всех кураторов для выпадающего списка
						//возвращает массив массивов с данными из таблицы Кураторы
	 $quest = "SELECT * FROM apteki ";
if($result=$this->connection->query($quest)){
    while($row=$result->fetch_assoc()){
	
	$dop=array(name=>$row['adress'],id=>$row['id_ap']);
    $spisok[]=$dop;
    }
    $result->close();
  }
  return($spisok); 
	 
 }
 
 
 
 function verni_str(){//функция для возвращения всех кураторов для выпадающего списка
						//возвращает массив массивов с данными из таблицы Кураторы
	 $quest = "SELECT * FROM postavhiki ";
if($result=$this->connection->query($quest)){
    while($row=$result->fetch_assoc()){
	
	$dop=array(name=>$row['strana'],id=>$row['id_post']);
    $spisok[]=$dop;
    }
    $result->close();
  }
  return($spisok); 
	 
 }



}
