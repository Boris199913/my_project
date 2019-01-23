<?php
//страница  кураторы
session_start(); 
if(!isset($_SESSION['admin'])){
      echo "<script>
    location.replace('index.php');
    </script>";
}


function __autoload($class){
  include("../class_".$class.".php");
}
//вывода шапки и меню
$page=new hat_foot;
$page->adm_hat();
$page->menu(5);

//вывод таблицы
//mysql_set_charset( 'utf8' );
echo"<div id=content>
 <h2> Сотрудники</h2> <br> <div id=tbl> ";
$t=new baza;
$tt=new sot;

$scr= '?ud=down&rw=id_sot';
$mg= 'up';

$scr2= '?ud=down&rw=FIO';
$mg2= 'up';

if($_GET[ud]=='down')
	if($_GET[rw]=='FIO'){
	$list=$tt->show('FIO','DESC');	
	$scr2= '?ud=up&rw=FIO';
$mg2= 'down';
	}
else{
	$list=$tt->show('id_sot','DESC');
$scr= '?ud=up&rw=id_sot';
$mg= 'down';
}	
else
if($_GET[rw]=='FIO')
{
	$list=$tt->show('FIO',' ');
$scr2= '?ud=down&rw=FIO';
$mg2= 'up';
}	
else
{$list=$tt->show('id_sot',' ');
$scr= '?ud=down&rw=id_sot';
$mg= 'up';
}




echo "<table border=1 align='center'>";
echo "<tr id=tr>
	<td>ФИО<a href=".$scr2." ><img src='img\\".$mg2.".png' style= ' width:15px; height:15px;'> </a></td>
	<td>Должность</td>
	<td>Дата рождения</td>
	<td>Телефон</td>
	<td>Зарплата</td>
	<td>Место р-ты(Аптека)</td>
	<td>Фото</td>
	<td colspan=2>Редактирование</td>

	</td>
	</tr>";
 for($i=0; $i<count($list); $i++){
   $el=$list[$i];
   echo "<tr>
           
	   <td>".$el[FIO]."
	   </td>
	   <td>".$el[dolzhn]."</td>
	   <td>".$el[data]."</td>
	   <td>".$el[phone]."</td>
	   <td>".$el[zp]."</td>
	    <td>".$tt->get_cur_by_id($el['id_ap'])."
           </td>   
		   <td>";
		if( $el['photo']===NULL)  echo"Нет фотографии";
		else{
			echo"<img src= img\\".$el['photo']." width= 100, hight= 80 /> ";
		}	   
		   
		   echo"
           </td>
		   <td><a href=?chn=$el[id_sot]  > изменить   </a>
           </td>
		   <td><a href=?del=$el[id_sot]  > удалить  </a>
           </td>
         </tr>";
 }//for 	   
echo "</table>";
//если нажата ссылка изменить
if($_GET['chn'])
{
$r=$tt->get_number_by_id($_GET['chn']);	

echo"
<form  method=POST enctype='multipart/form-data'>
ФИО: 
<input type=text  name=1 value=".$r['FIO']."><br/>
Должность:
<input type=text  name=2 value=".$r['dolzhn']."><br/> 
Дата рождения:
<input type=date  name=3 value=".$r['data']."><br/>
Телефон:
<input type=text  name=4 value=".$r['phone']."><br/>
Зарплата:
<input type=text  name=5 value=".$r['zp']."><br/>";

$nkt=$tt->verni_apt();
echo "
Место работы: <select name=sel>";
 for($i=0; $i<count($nkt); $i++){
	 $el=$nkt[$i];
echo" <option value='$el[id_ap]'";
if($el['id_ap']==$r['id_ap']) echo " selected";

echo"  >".$el['name']."  </option> ";
 }
 echo"
</select>
<br/>
Фото:
<input type=file  name=7 value=".$r['photo']."><br/>
<input type= hidden value='".$_GET[chn]."' name=edddd>
<input type=submit value='ИЗМЕНИТЬ' name=okk >
</form>
";


}

if($_POST['okk'])
{
	$mas=array(
$mass[FIO]=$_POST[1],
$mass[dolzhn]=$_POST[2],
$mass[data]=$_POST[3],
$mass[phone]=$_POST[4],
$mass[zp]=$_POST[5],
$mass[id_ap]=$_POST[6],
$mass[id_sot]=$_POST[edddd]

);
$tt->chn($mass);

if($_FILES[7]===NULL)
{
echo"нет изображения";
}
else{
	if($_FILES['7']['size']<2*1024*1024){
		$tmpname= $_FILES['7']['tmp_name'];
		list($type, $ext)=explode("/",$_FILES['7']['type']);
		
		 if($ext=="pjpeg")
             $ext="jpeg";
		 
		 $ret=$_POST[edddd];
		 $name1= $ret.".".$ext;
		
	
       	    
	    move_uploaded_file($tmpname,"img/$name1");
		
		$tt->update_img($name1,$ret);
		
		
	}
}
echo"<script> location.replace('sotrudn.php');   </script>;" ;

}
//если нажата ссылка удалить
if(isset($_GET[del]))
 {
	if($rr=$tt->del($_GET['del'])){
	echo"<script> location.replace('sotrudn.php');   </script>;" ;	}
 }
 
 
  $page->footer();
 
 
 
 

?>