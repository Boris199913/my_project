<?php	
class goods extends baza{//класс для работы с пользовательским интерфесом
	
function show($kategory, $lim){//функция для вывода всех товаров
						//получает категорию, по каторой нужно вывести товары и лимит вывода
						//возвращает массив массивов со всеми полями таблицы для вывода
$spisok=array();
$quest = "SELECT * FROM  postavhiki,apteki ,nazn,lekar
where(apteki.id_ap=lekar.id_ap) 
and (postavhiki.id_post = lekar.`id_post`)
and (nazn.id_nazn = lekar.`id_nazn`)";
if($kategory!=" "&&$kategory!=""&&$kategory!="undefined"){
	
	
	//вложенный селект!!!!!!!!!!
$quest .=" and( lekar.id_nazn IN( '".$kategory."'))";
}
$lim_t= $lim*12;
$quest .=" LIMIT $lim_t , 12";
if($result=$this->connection->query($quest)){
    while($row=$result->fetch_assoc()){
	$dop=array(name=>$row['name'],strana=>$row['strana'],
			data=>$row['data'], 
			adress=>$row['adress'], id=>$row['id_akt'],price=>$row['price'],group=>$row['group']
			
	);
    $spisok[]=$dop;}
    $result->close();}
  return($spisok); }


//агрегатнаЯ ф-циЯ
function c_show($kategory){//функция для подсчета кол-ва товаров всего
						//получает категорию, по каторой нужно вывести товары
						//возвращает число
$spisok=array();
$quest = "SELECT count(*) FROM lekar";
if($kategory!=" "&&$kategory!=""&&$kategory!="undefined"){
$quest .=" WHERE category LIKE '%".$kategory."%'";}
if($result=$this->connection->query($quest)){
while($row=$result->fetch_assoc()){
$dop=$row['count(*)'];}
return($dop); }}
}