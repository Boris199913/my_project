<?php

session_start(); 
if(!isset($_SESSION['admin'])){
      echo "<script>
    location.replace('index.php');
    </script>";
}


function __autoload($class){
include("../class_".$class.".php");
}

$page=new hat_foot;
$page->adm_hat();
$page->menu(3);

echo"<script>
function conf(){
 return(confirm('�������?!'));}
</script>";


echo"<div id=content>
 <h2>����������</h2> <br> <div id=tbl> ";
$t=new baza;
$tt=new postav;

$sort=array(6);

 for($i=0;$i<6;$i++)
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
	 
 $sort[$i]="<a href='postav.php?ord=".$i."&DESC=".$DESC."'> <img src='img\\".$img[$i].".png' style= ' width:15px; height:15px;'> </a>";
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
	<td>��������$sort[0] </td>
	<td>�������������$sort[1] </td>
	<td>���������$sort[2]</td>
	<td>������$sort[3]</td>
	<td>�����$sort[4]</td>
	<td>�������$sort[5]</td>
	<td colspan=2>��������������</td>

	</td>
	</tr>";
 for($i=0; $i<count($list); $i++){
   $el=$list[$i];
   echo "<tr>
         
	   <td>".$el[name]."
           </td>
		    <td>".$el[predstav]."
           </td>
		    <td>".$el[dolzhn]."
           </td>
		   <td>".$el[strana]."
           </td>
		   <td>".$el[adress]."
           </td>
		    <td>".$el[phone]."
           </td>
		   <td><a href=?del=$el[id_post] onclick = 'return(conf())' > �������  </a>
           </td>
		   <td><a href=?chn=$el[id_post] )' > ��������  </a>
           </td>
         </tr>";
 }//for 	   
echo "</table>
<br>
<form>
<input type=submit value='�������� ������ ����������' name=crr class='octava'>
</form>";
if($_GET['crr'])
{
echo "
<br>
<form>
��������: 
<input type=text  name=24 value=".$r2['name']."><br/>
�������������:
<input type=text  name=25 value=".$r2['predstav']."><br/> 
���������:
<input type=text  name=26 value=".$r2['dolzhn']."><br/>
������:
<input type=text  name=27 value=".$r2['strana']."><br/>
�����:
<input type=text  name=28 value=".$r2['adress']."><br/>
�������:
<input type=text  name=29 value=".$r2['phone']."><br/>
<input type=submit value='��������' name=ok>
</form>
</div>";}
if($_GET['ok'])
{
	$mas2=array(
$save[name]=$_GET[24],
$save[predstav]=$_GET[25],
$save[dolzhn]=$_GET[26],
$save[strana]=$_GET[27],
$save[adress]=$_GET[28],
$save[phone]=$_GET[29],
$save[id_post]=NULL);
echo $save;
$r2=$tt->ins($save);
echo"<script> location.replace('postav.php');   </script>;" ;
}
if($_GET['del'])
{
if($rr=$tt->del($_GET['del'])!='problem')
echo"<script> location.replace('postav.php');   </script>;" ;
}
//���� ������ ������ ��������
if($_GET['chn'])
{
$r=$tt->get_number_by_id($_GET['chn']);	

echo"
<form  >
��������: 
<input type=text  name=1 value=".$r['name']."><br/>
�������������:
<input type=text  name=2 value=".$r['predstav']."><br/> 
���������:
<input type=text  name=3 value=".$r['dolzhn']."><br/>
������:
<input type=text  name=4 value=".$r['strana']."><br/>
�����:
<input type=text  name=5 value=".$r['adress']."><br/>
�������:
<input type=text  name=6 value=".$r['phone']."><br/>
<input type= hidden value='".$_GET[chn]."' name=edddd>
<input type=submit value='��������' name=okk >
</form>
";


}

if($_GET['okk'])
{
	$mas=array(
$mass[name]=$_GET[1],
$mass[predstav]=$_GET[2],
$mass[dolzhn]=$_GET[3],
$mass[strana]=$_GET[4],
$mass[adress]=$_GET[5],
$mass[phone]=$_GET[6],
$mass[id_post]=$_GET[edddd]

);
$tt->chn($mass);
echo"<script> location.replace('postav.php');   </script>;" ;
}
$page->footer();
?>