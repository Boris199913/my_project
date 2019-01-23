<?php
session_start(); 
if(isset($_SESSION['login'])){
	$nick= $_SESSION['login'];	
}
function __autoload($class){
  include("class_".$class.".php");
}
//вывод шапки и меню
$page=new hat_foot;
$page->hat();
$page->u_menu(1);

echo"<div id=content>";
$t=new baza;
$tt=new goods;

   echo "<div id=select> 
   <h2> Фильтры</h2>
   <form >
   <input type='radio' name=1 onclick='show(1)'> Антибиотики<br />
   <input type='radio' name=2 onclick='show(2)'> Витамины  <br />
   <input type='radio' name=7 onclick='show()'> Без фильтра<br />
   </form>
   </div>
   
   
   <script>
function show(num) {
        location.replace('index.php?sel='+num);
}
</script>
";
  
if($_GET['str']!=null)
	$tmp=$_GET['str'];
else $tmp=0;

$list=$tt->show($_GET[sel],$tmp);
   echo "<div id=boxes>";
 for($i=0; $i<count($list); $i++){
   $el=$list[$i];
   echo "

   <div href='' class=box >
   ".$el['name']."--".$el['price']."--".$el['strana']."--".$el['group']." --".$el['adress']." 

    </div>";
		 }
	echo "</div>
	<div id='pages'>";
	$li=$tt->c_show($_GET[sel]);
	
	for($i=0;$i<$li/12;$i++)
	{
	$tt= $i+1;
$ww=$_GET['sel'];
	
	echo "
	<a  href='index.php?str=$i&sel=$ww'";
if($tmp==$i) $qq='sel';
else $qq='pg'; 

echo"	class=$qq> $tt </a>
	";	
	}

	
	echo"
	</div>
	";
echo "</div>";
?>