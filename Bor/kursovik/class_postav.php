
<?php
//header ('Content-type:text/html; charset=utf-8');
?>
<?php	
class postav extends baza{//����� ��� ������ � �������� ��������

	
function show($ord,$DESC){//������� ��� ������ �������
							//�������� �������, �� �������� ���������� �����������, ����������� ����������, ����� ������, ��� �������
							//���������� ������ �������� �� ����� ������ ������� ��� ������
$spisok=array();

$result=$this->connection->query("set lc_time_names='ru_RU'");


$quest = "
SELECT * FROM postavhiki";

if($ord!=null)
{
	switch ($ord) {
    case 0:
        $ord='name';
        break;
    case 1:
         $ord='predstav';
        break;
    case 2:
         $ord='dolzhn';
        break;
		case 3:
         $ord='strana';
        break;
		case 4:
         $ord='adress';
        break;
		case 5:
         $ord='phone';
        break;
}
$quest.=" ORDER BY `$ord`	$DESC";
}




if($result=$this->connection->query($quest)){
 while($row=$result->fetch_assoc()){
	$dop=array(id_post=>$row['id_post'],name=>$row['name'],predstav=>$row['predstav'],
			dolzhn=>$row['dolzhn'],strana=>$row['strana'],
			adress=>$row['adress'],phone=>$row['phone']
	);
    $spisok[]=$dop;
    }
    $result->close();
  }

  return($spisok);
 }
 

 
  function chn($mass){//������� ��� ��������� ����� �������
					//�������� ������  � id ������, ������� ���������� ��������, � ��� �� � ������ ����������.
	  	  
$quest = "UPDATE postavhiki SET
`name`='".$mass[name]."',
  `predstav`='".$mass[predstav]."',
  `dolzhn`='".$mass[dolzhn]."',
    `strana`='".$mass[strana]."',
	`adress`='".$mass[adress]."',
    `phone`='".$mass[phone]."'
  


  WHERE id_post=".$mass[id_post];
$result=$this->connection->query($quest);
echo $quest;
 }
 
 
 function get_number_by_id($id_post){//������� ��� ����������� ������ ����������� ��������
							//�������� id ��������
							//���������� ������ � ������� �� ���������� ��������
$quest = "SELECT * FROM postavhiki WHERE postavhiki.id_post=".$id_post;
if($result=$this->connection->query($quest)){
    $row=$result->fetch_assoc(); 

$dop=array(id_post=>$row['id_post'],name=>$row['name'],
			predstav=>$row['predstav'],dolzhn=>$row['dolzhn'],
			strana=>$row['strana'],adress=>$row['adress'],phone=>$row['phone']);
	return($dop);	      
 }
   }
   
    function ins($mass2){//������� ��� ���������� ����� � �������
					//�������� ������ ������� ������� ���������� �������� � �������	 
$quest = "INSERT INTO `BD_Aptek`.`postavhiki` (`id_post`, `name`, `predstav`, `dolzhn`, `strana`,`adress`, `phone` ) VALUES (NULL, '".$mass2[name]."', '".$mass2[predstav]."', '".$mass2[dolzhn]."', '".$mass2[strana]."', '".$mass2[adress]."', '".$mass2[phone]."')";
if($result=$this->connection->query($quest))
echo $quest ;
else echo $quest ;
 }
 
 
	
	function del($id){//������� ��� �������� ����� �� �������
					//�������� id ������, ������� ���������� �������
	 
	 $quest = "SELECT count(*) FROM lekar WHERE id_post=".$id;
	
	if($result=$this->connection->query($quest)){
	$row = $result->fetch_assoc();
	If($row['count(*)']==0){
		$quest = "DELETE FROM postavhiki WHERE id_post=".$id;
		
		$this->connection->query($quest);
		
	}
	else{ echo "�������� ����������(������ ������ � ������ ������� lekarstv)";
	return('problem');}	
	}
	else{
	return('problem');
	echo $quest;}
 }
	
}
