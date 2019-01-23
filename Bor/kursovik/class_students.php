
<?php
//header ('Content-type:text/html; charset=utf-8');
?>
<?php	
class students extends baza{//класс для работы с таблицей студенты

	
function show($ord,$DESC){//функция для вывода таблицы
							//получает столбец, по которому необходимо сортировать, направление сортировки, номер группы, год выпуска
							//возвращает массив массивов со всеми полями таблицы для вывода
$spisok=array();



$quest = "SELECT * FROM `akt`,sotrud,apteki,postavhiki 
 where(akt.`id_post`= postavhiki.`id_post`)and
 (akt.`id_sot`=sotrud.`id_sot`) and 
 (akt.`id_ap`=apteki.`id_ap`)  
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
        $ord='postavhiki.name';
        break;
    case 1:
         $ord='FIO';
        break;
    case 2:
         $ord='akt.data';
        break;
		case 3:
         $ord='adress';
        break;
		
}
$quest.=" ORDER BY $ord	$DESC";
}
if($result=$this->connection->query($quest)){
	
    while($row=$result->fetch_assoc()){
	$dop=array(id_post=>$row['name'],id_sot=>$row['FIO'],
			data=>$row['data'], 
			id_ap=>$row['adress'], id=>$row['id_akt']
			
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
$quest = "SELECT * FROM `akt`,sotrud,apteki,postavhiki 
 where(akt.`id_post`= postavhiki.`id_post`)and
 (akt.`id_sot`=sotrud.`id_sot`) and 
 (akt.`id_ap`=apteki.`id_ap`) and (akt.id_akt =$id) 
 ";


if($result=$this->connection->query($quest)){
	
    while($row=$result->fetch_assoc()){
	$dop=array(id_post=>$row['name'],id_sot=>$row['FIO'],
			data=>$row['data'], 
			id_ap=>$row['adress'], id=>$row['id_akt']
			
	);
	
    }
    $result->close();
  return($dop);
 }
} 


 
  function chn($mass){//функция для изменения строк таблицы
					//получает массив  с id записи, которую необходимо изменить, а так же с новыми значениями.
	  	  
$quest = "UPDATE students SET
`id_group`='".$mass[id_group]."',
  `FIO`='".$mass[FIO]."',
  `phone`='".$mass[phone]."',
    `tema`='".$mass[tema]."',
	`id_tech`='".$mass[id_tech]."',
    `TZ`='".$mass[TZ]."',
	  `PZ`='".$mass[PZ]."',   
 `program`='".$mass[program]."'
  


  WHERE id=".$mass[id];
$result=$this->connection->query($quest);
echo $quest;
 }
 
 
 function get_number_by_id($id){//функция для возвращения записи конкретного студента
							//получает id студента
							//возвращает массив с данными ок конкретном студенте
$quest = "SELECT * FROM students WHERE students.id=".$id;
if($result=$this->connection->query($quest)){
    $row=$result->fetch_assoc(); 

$dop=array(id_group=>$row['id_group'],FIO=>$row['FIO'],
			phone=>$row['phone'],tema=>$row['tema'],
			TZ=>$row['TZ'],PZ=>$row['PZ'],id_tech=>$row['id_tech'],
			program=>$row['program']);
	return($dop);	      
 }
   }
   
  
 function verni_group(){//функция для возвращения всех данных из таблицы группы для выпадающего списка
						//возвращает массив массивов с данными из таблицы группы
$quest = "SELECT * FROM groups ";
if($result=$this->connection->query($quest)){
    while($row=$result->fetch_assoc()){
	
	$dop=array(id=>$row['id'],number=>$row['number'],id_curator=>$row['id_curator']);
    $spisok[]=$dop;
    }
    $result->close();
  }
  return($spisok);   
}  
   
   
   
   function verni_tech(){//функция для возвращения всех данных из таблицы технологии для выпадающего списка
						//возвращает массив массивов с данными из таблицы технологии
$quest = "SELECT * FROM tech ";
if($result=$this->connection->query($quest)){
    while($row=$result->fetch_assoc()){
	
	$dop=array(id=>$row['id'],name=>$row['name']);
    $spisok[]=$dop;
    }
    $result->close();
  }
  return($spisok);   
}   
   
   
   
   function grp(){//функция для возвращения всех данных из таблицы группы для выпадающего списка
						//возвращает массив массивов с данными из таблицы группы
$quest = "SELECT * FROM groups ";
if($result=$this->connection->query($quest)){
    while($row=$result->fetch_assoc()){
	
	$dop=array(id=>$row['id'],year=>$row['year'],number=>$row['number']);
    $spisok[]=$dop;
    }
    $result->close();
  }
  return($spisok);   
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
 
 
 
 function verni_post(){//функция для возвращения всех кураторов для выпадающего списка
						//возвращает массив массивов с данными из таблицы Кураторы
	 $quest = "SELECT * FROM postavhiki ";
if($result=$this->connection->query($quest)){
    while($row=$result->fetch_assoc()){
	
	$dop=array(name=>$row['name'],id=>$row['id_post']);
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
