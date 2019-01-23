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
$page->menu(2);

echo"<script>
function conf(){
 return(confirm('Удалить?!'));}
</script>";


echo"<div id=content>
 <h2>Аптеки</h2> <br> <div id=tbl> ";
$t=new baza;
$tt=new apt;

$sort=array(3);

 for($i=0;$i<3;$i++)
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
	 
 $sort[$i]="<a href='apteki.php?ord=".$i."&DESC=".$DESC."'> <img src='img\\".$img[$i].".png' style= ' width:15px; height:15px;'> </a>";
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
	<td>Название аптеки$sort[0] </td>
	<td>Адрес $sort[1] </td>
	<td>Телефон $sort[2] </td>
	<td colspan=2>Редактирование</td>

	</td>
	</tr>";
 for($i=0; $i<count($list); $i++){
   $el=$list[$i];
   echo "<tr>
         
	   <td>".$el[name]."
           </td>
		    <td>".$el[adress]."
           </td>
		    <td>".$el[phone]."
           </td>
		  
		   <td><a href=?del=$el[id_ap] onclick = 'return(conf())' > удалить  </a>
           </td>
		   <td><a href=?chn=$el[id_ap] )' > изменить  </a>
           </td>
         </tr>";
 }//for 	   
echo "</table>
<br>
<form>
<input type=submit value='ДОБАВИТЬ НОВУЮ АПТЕКУ' name=crr class='octava'>
</form>";
if($_GET['crr'])
{
echo "
<br>
<form>
Аптека: 
<input type=text  name=24 value=".$r2['name']."><br/>
Адрес:
<input type=text  name=25 value=".$r2['adress']."><br/> 
Телефон:
<input type=text  name=26 value=".$r2['phone']."><br/>
<input type=submit value='ДОБАВИТЬ' name=ok>
</form>
</div>";}
if($_GET['ok'])
{
	$mas2=array(
$save[name]=$_GET[24],
$save[adress]=$_GET[25],
$save[phone]=$_GET[26],
$mass[id_ap]=NULL);
echo $save;
$r2=$tt->ins($save);
echo"<script> location.replace('apteki.php');   </script>;" ;
}
if($_GET['del'])
{
if($rr=$tt->del($_GET['del'])!='problem')
echo"<script> location.replace('apteki.php');   </script>;" ;
}
//если нажата ссылка изменить
if($_GET['chn'])
{
$r=$tt->get_number_by_id($_GET['chn']);	

echo"
<form >
Аптека: 
<input type=text  name=1 value=".$r['name']."><br/>
Адрес:
<input type=text  name=2 value=".$r['adress']."><br/> 
Телефон:
<input type=text  name=3 value=".$r['phone']."><br/>
<input type= hidden value='".$_GET[chn]."' name=edddd>
<input type=submit value='ИЗМЕНИТЬ' name=okk >
</form>
";


}

if($_GET['okk'])
{
	$mas=array(
$mass[name]=$_GET[1],
$mass[adress]=$_GET[2],
$mass[phone]=$_GET[3],
$mass[id_ap]=$_GET[edddd]

);
$tt->chn($mass);



echo"<script> location.replace('apteki.php');   </script>;" ;

}
$page->footer();

?>