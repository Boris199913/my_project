<?php
//header ('Content-type:text/html; charset=utf-8');
?>
<?php
//�������� ������
session_start(); 
if(!isset($_SESSION['admin'])){
      echo "<script>
    location.replace('index.php');
    </script>";
}


function __autoload($class){
include("../class_".$class.".php");
}
//������ ����� � ����
$page=new hat_foot;
$page->adm_hat();
$page->menu(4);

echo"<script>
function conf(){
 return(confirm('�������?!'));}
</script>";

//����� �������
echo"<div id=content>
 <h2>���������� ����������</h2> <br> <div id=tbl> ";
$t=new baza;
$tt=new naznn;

$sort=array(2);

 for($i=0;$i<2;$i++)
 {
 $img[$i]='up';
 $DESC='';
 if($_GET['ord']==$i)
	 if($_GET['DESC']=='DESC')
		 $DESC='';
	 else
	 {$DESC='DESC';
 $img[$i]='down';
	 }
	 
 $sort[$i]="<a href='naznn.php?ord=".$i."&DESC=".$DESC."'> <img src='img\\".$img[$i].".png' style= ' width:15px; height:15px;'> </a>";
 }
 
 if(!isset($_GET['ord']))
{
	
 $list=$tt->show('','');
}
 else{
$list=$tt->show($_GET['ord'],$_GET['DESC']);
}


echo "<table border=1 align='center'>";
echo "<tr id=tr align='center'>
	<td>������$sort[0] </a></td>
	<td>�������� $sort[1] </td>
	<td colspan=2>��������������</td>

	</td>
	</tr>";
 for($i=0; $i<count($list); $i++){
   $el=$list[$i];
   echo "<tr>
         
	   <td>".$el[group]."
           </td>
		    <td>".$el[text]."
           </td>
		   <td><a href=?del=$el[id_nazn] onclick = 'return(conf())' > �������  </a>
           </td>
		   <td><a href=?chn=$el[id_nazn] )' > ��������  </a>
           </td>
         </tr>";
 }//for 	   
echo "</table>
<br>
<form>
<input type=submit value='�������� ����� ���������� ���������' name=crr class='octava'>
</form>";
if($_GET['crr'])
{
echo "
<br>
<form>
������: 
<input type=text  name=24 value=".$r2['group']."><br/>
�����:
<input type=text  name=25 value=".$r2['text']."><br/> 
<input type=submit value='��������' name=ok>
</form>
</div>";}
if($_GET['ok'])
{
	$mas2=array(
$save[group]=$_GET[24],
$save[text]=$_GET[25],
$mass[id_nazn]=NULL);
echo $save;
$r2=$tt->ins($save);
echo"<script> location.replace('naznn.php');   </script>;" ;
}
if($_GET['del'])
{
if($rr=$tt->del($_GET['del'])!='problem')
echo"<script> location.replace('naznn.php');   </script>;" ;
}
//���� ������ ������ ��������
if($_GET['chn'])
{
$r=$tt->get_number_by_id($_GET['chn']);	

echo"
<form >
������: 
<input type=text  name=1 value=".$r['group']."><br/>
��������:
<input type=text  name=2 value=".$r['text']."><br/> 
<input type= hidden value='".$_GET[chn]."' name=edddd>
<input type=submit value='��������' name=okk >
</form>
";


}

if($_GET['okk'])
{
	$mas=array(
$mass[group]=$_GET[1],
$mass[text]=$_GET[2],
$mass[id_nazn]=$_GET[edddd]
);
$tt->chn($mass);
echo"<script> location.replace('naznn.php');   </script>;" ;

}
$page->footer();






?>