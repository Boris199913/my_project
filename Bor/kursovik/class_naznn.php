<?php	
class naznn extends baza{//����� ��� ������ � �������� ������

	
function show($ord,$DESC){//������� ��� ������ �������
							//�������� �������, �� �������� ���������� ����������� � ����������� ����������
							//���������� ������ �������� �� ����� ������ ������� ��� ������
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
 
function del($id){//������� ��� �������� ���� �� �������
					//�������� id ������, ������� ���������� �������
	 
	 $quest = "SELECT count(*) FROM lekar WHERE id_nazn=".$id;
	
	if($result=$this->connection->query($quest)){
	$row = $result->fetch_assoc();
	If($row['count(*)']==0){
		$quest = "DELETE FROM Nazn WHERE id_nazn=".$id;
		
		$this->connection->query($quest);
		
	}
	else{ echo "�������� ����������(������ ������ � ������ ������� lekarstv)";
	return('problem');}	
	}
	else{
	return('problem');
	echo $quest;}
 }
 
  function chn($mass){//������� ��� ��������� ����� �������
								//�������� id ������, ������� ���������� ��������, � ��� �� ����� ��������.
	  	  
$quest = "UPDATE Nazn SET `group`='".$mass[group]."', `text`='".$mass[text]."'
  WHERE id_nazn=".$mass[id_nazn];
$result=$this->connection->query($quest);
echo $quest;
 }
 
 
   function get_number_by_id($id_nazn){//������� ��� ����������� ������ ������
							//�������� id ������
							//���������� ����� ������
$quest = "SELECT * FROM Nazn WHERE id_nazn=".$id_nazn;
if($result=$this->connection->query($quest)){
    $row=$result->fetch_assoc(); 
	$dop=array(group=>$row['group'],text=>$row['text']);
	return($dop);	      
   }
}
       function ins($mass2){//������� ��� ���������� ����� � �������
					//�������� ������ ������� ������� ���������� �������� � �������	 
$quest = "INSERT INTO `BD_Aptek`.`Nazn` (`id_nazn`, `group`, `text`) VALUES (NULL, '".$mass2[group]."', '".$mass2[text]."')";
if($result=$this->connection->query($quest))
echo $quest ;
else echo $quest ;
 }
}