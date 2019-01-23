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

echo"<script>
function conf(){
 return(confirm('Удалить?!'));}
</script>";

$page=new hat_foot;
$page->adm_hat();
$page->menu(1);

$t=new baza;
$tt=new events;

if($_GET['ok'])	{
	$list=$tt->show_drugs2($_GET['1'],$_GET['2'],$_GET['3'],$_GET['4'],$_GET['5']);
}
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
	 
 $sort[$i]="<a href='main.php?ord=".$i."&DESC=".$DESC."'> <img src='img\\".$img[$i].".png' style= ' width:15px; height:15px;'> </a>";
 }
 if($_GET['ok']==null)
 if(!isset($_GET['ord']))
{
	
 $list=$tt->show_drugs('','');
}
 else{
$list=$tt->show_drugs($_GET['ord'],$_GET['DESC']);
}
 $tm=$tt->godn();
echo"<div id=content>

<h2> ВНИМАНИЕ!!! ПОРА ПРОВЕСТИ ИНВЕНТАРИЗАЦИЮ В АПТЕКЕ -> $tm </h2>
 <h2>Лекарства</h2> 
 <div id=tbl>
 <form>
 Название<input type=text  name=1 > 
 цена  <input type=text  name=2 > 
тип <select name=3>
 <option value='' ></option>
";
$nkt=$tt->verni_gr();
 for($i=0; $i<count($nkt); $i++){
	 $el=$nkt[$i];
echo" <option value='$el[name]'  >".$el['name']."  </option> ";
 }
 echo"
</select>

аптека <select name=4>
 <option value='' ></option>
";
$nkt=$tt->verni_ap();
 for($i=0; $i<count($nkt); $i++){
	 $el=$nkt[$i];
echo" <option value='$el[name]'  >".$el['name']."  </option> ";
 }
 echo"
</select>
страна <select name=5>
 <option value='' ></option>
";
$nkt=$tt->verni_str();
 for($i=0; $i<count($nkt); $i++){
	 $el=$nkt[$i];
echo" <option value='$el[name]'  >".$el['name']."  </option> ";
 }
 echo"
</select>

<input type=submit value='найти' name=ok >
</form>
 
 ";
 
 

echo "<table border=1 align='center'><tr id=tr>
	
	<td>Название $sort[0] </td>
	<td>Цена $sort[1]</td>
	<td>Срок годности $sort[2]</td>
	<td>Тип $sort[3]</td>
	<td>Аптека $sort[4] </td>
	<td>Страна-производитель $sort[5] </td>
	<td colspan=2>Редактирование </td>
	</tr>";
 for($i=0; $i<count($list); $i++){

   $el=$list[$i];
   echo "<tr>	
		<td>".$el['name']." </td>
		<td>".$el['price']."</td>
		<td>".$el['goden']." </td>
		<td>". $el['group']."   </td>
		<td>". $el['adress']."   </td>
		<td>". $el['strana']."   </td>
		 <td><a href=?del=$el[id_lekar] onclick = 'return(conf())' > удалить  </a>
           </td>
		   <td><a href=?chn=$el[id_lekar] )' > изменить  </a>
           </td>
         </tr>";
	
 }//for 
echo "</table> <br><br>";	


if($_GET['del'])
{
	$el=$tt->del($_GET['del']);
	
}
if($_GET['chn'])
{
	$el=$tt->get_info($_GET['chn']);
	echo"
<form  >
название<input type=text  name=11 value=".$el[name]."><br/>
цена<input type=text  name=22 value=".$el[price]."><br/>
название<input type=text  name=33 value=".$el[goden]."><br/>
тип <select name=44>
";
$nkt=$tt->verni_gr();
 for($i=0; $i<count($nkt); $i++){
	 $kl=$nkt[$i];
echo" <option value='$kl[id]' ";
if($kl['name']==$el['group']) echo"selected";
echo" >".$kl['name']."  </option> ";
 }
 echo"
</select>

аптека <select name=55>
 <option value='' ></option>
";
$nkt=$tt->verni_ap();
 for($i=0; $i<count($nkt); $i++){
	 $kl=$nkt[$i];
echo" <option value='$kl[id]' ";
if($kl['name']==$el['adress']) echo"selected";
echo" >".$kl['name']."  </option> ";
 }
 echo"
</select>

страна <select name=66>
 <option value='' ></option>
";
$nkt=$tt->verni_str();
 for($i=0; $i<count($nkt); $i++){
	 $kl=$nkt[$i];
echo" <option value='$kl[id]' ";
if($kl['name']==$el['strana']) echo"selected";
echo" >".$kl['name']."  </option> ";
 }
 echo"
</select>

<br/>
<input type= hidden value='".$_GET[1]."' name=1>
<input type= hidden value='".$_GET[2]."' name=2>
<input type= hidden value='".$_GET[3]."' name=3>
<input type= hidden value='".$_GET[4]."' name=4>
<input type= hidden value='".$_GET[5]."' name=5>
<input type= hidden value='".$_GET['ord']."' name=ord>
<input type= hidden value='".$_GET['chn']."' name=cchn>
<input type= hidden value='".$_GET['DESC']."' name=DESC>
<input type= hidden value='".$_GET['ok']."' name=ok>
<input type=submit value='Изменить' name=okk ><br/>
</form>	
";	
}

if($_GET['okk'])
{
	$tt->chn($_GET[11],$_GET[22],$_GET[33],$_GET[44],$_GET[55],$_GET[66],$_GET['cchn']);
	echo"<script> location.replace('main.php?ord=$_GET[ord]&DESC=$_GET[DESC]&1=$_GET[1]&2=$_GET[2]&3=$_GET[3]&4=$_GET[4]&5=$_GET[5]');   </script>;" ;
}


if($_GET['del'])
{
if($rr=$tt->del($_GET['del'])!='problem')
echo"<script> location.replace('main.php');   </script>;" ;
}
echo"
</div>

";
$page->footer();









?>