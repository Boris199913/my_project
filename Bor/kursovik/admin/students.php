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

$page->menu(6);
$t=new baza;
echo "<div id=content> <div id=tbl> ";
$tt=new students;

$sort=array(4);

 for($i=0;$i<4;$i++)
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
	 
 $sort[$i]="<a href='students.php?ord=".$i."&DESC=".$DESC."'> <img src='img\\".$img[$i].".png' style= ' width:15px; height:15px;'> </a>";
 }
 if($_GET['ok']==null)
 if(!isset($_GET['ord']))
{
	
 $list=$tt->show('','');
}
 else{
$list=$tt->show($_GET['ord'],$_GET['DESC']);
}







echo "<table border=1 align='center'>";
echo "<tr id=tr>
		<td>Поставщик $sort[0] </td>
	<td>Сотрудник $sort[1]</td>
	<td>Дата $sort[2]</td>
	<td>Аптека $sort[3]</td>
	<td colspan=2>Редактирование </td>
	</tr>";
	
 for($i=0; $i<count($list); $i++){
   $el=$list[$i];
   echo "<tr>         
	   <td>".$el[id_post]."
           </td>
		   <td>".$el[id_sot]."
           </td>
		   <td>".$el['data']."
           </td>
		   <td>". $el[id_ap]."
           </td>
		   <td><a href=?del=$el[id] onclick = 'return(conf())' > удалить  </a>
           </td>
		   <td><a href=?chn=$el[id] )' > изменить  </a>
           </td>
         </tr>";
 }//for 	   
echo "</table>	
	<br><form>


</form> <br><br></div>


";
if($_GET['del'])
{
	$el=$tt->del($_GET['del']);
	
}

if($_GET['chn'])
{
	   
	$r=$tt->get_info($_GET['chn']);
	
	echo"
<form  >
Поставщик <select name=11>
";
$nkt=$tt->verni_post();
 for($i=0; $i<count($nkt); $i++){
	 $kl=$nkt[$i];
echo" <option value='$kl[id]' ";
if($kl['name']==$r['id_post']) echo"selected";
echo" >".$kl['name']."  </option> ";
 }
 echo"
</select>

Сотрудник <select name=22>
";
$nkt=$tt->verni_str();
 for($i=0; $i<count($nkt); $i++){
	 $kl=$nkt[$i];
echo" <option value='$kl[id]' ";
if($kl['name']==$r['id_sot']) echo"selected";
echo" >".$kl['name']."  </option> ";
 }
 echo"
</select>
Дата
<input type=text  name=33 value=".$r['data']."><br/>

аптека <select name=44>
";
$nkt=$tt->verni_ap();
 for($i=0; $i<count($nkt); $i++){
	 $kl=$nkt[$i];
echo" <option value='$kl[id]' ";
if($kl['name']==$r['id_ap']) echo"selected";
echo" >".$kl['name']."  </option> ";
 }
 echo"
</select>



<input type=submit value='изменить' name='okkk' ><br/>
<input type= hidden value='".$_GET['chn']."' name=edddd>

</form>	
";

}



if($_GET['okkk'])	{
$mas=array(
$mass[id_post]=$_GET[1],
$mass[id_sot]=$_GET[2],
$mass[data]=$_GET[3],
$mass[id_ap]=$_GET[4],
$mass[id]=$_GET[edddd]
);
$tt->chn($mass);
echo"<script> location.replace('students.php');   </script>;" ;
}

$page->footer();


?>