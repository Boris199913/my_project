<?php
class hat_foot{//класс для вывода шапки, меня=ю и подвала сайта
  public $title="Дипломная";
  
  
  function adm_hat(){//функция вывода шапки для администратора 	
  echo "<html>\n<head>\n	
  
  <link rel='stylesheet' type='text/css' href='../for16.css' />
  <meta http-equiv='Content-Type' content='text/html; charset=utf-8'>";	
   echo "<title> $this->title </title>\n
</head>\n<body>";
  echo "<div id=div_head> <a id='blink1'> База данных аптек </a> </div>";
  }

  function hat(){//функция вывода шапки для пользователя 
  echo "<html>\n<head>\n	
  
  <link rel='stylesheet' type='text/css' href='user.css' />
  <meta http-equiv='Content-Type' content='text/html; charset=utf-8'>";	
   echo "<title> $this->title </title>\n
</head>\n<body>";
  echo "<div id=div_head> <a id='blink1'> База данных аптек </a> </div>";
 }

  function menu($num){//функция вывода меню
    echo '<div id="menu">
<a href="main.php"';
if($num==1) echo' class=there ';
echo'> Главная </a>
 <a href="apteki.php"';
if($num==2) echo' class=there ';
echo'>  Аптеки</a>
<a href="postav.php"';
if($num==3) echo' class=there ';
echo'> Поставщики </a> 
 <a href="naznn.php"';
if($num==4) echo' class=there ';
echo'>  Назначение </a>  
 <a href="sotrudn.php"';
if($num==5) echo' class=there ';
echo'> Сотрудники  </a> 
 <a href="students.php"';
if($num==6) echo' class=there ';
echo'>  Акт приема поставки </a>
 </div>
 <div id="m4"> 

 <div class="div-style">
        <img src="img\\main6.jpg" title="Image 1" class="img-style im-1">
        <img src="img\\main3.jpg" title="Image 2" class="img-style next im-2">
        <img src="img\\main1.jpg" title="Image 3" class="img-style next im-3">
        <img src="img\\main7.jpg" title="Image 4" class="img-style next im-4">
     </div>
  
  
</div>';
  }
  
   function u_menu($num){//функция вывода меню
    echo '
 </div>
 <div id="m4"> 

 <div class="div-style">
        <img src="admin\img\main6.jpg" title="Image 1" class="img-style im-1">
        <img src="admin\img\main3.jpg" title="Image 2" class="img-style next im-2">
        <img src="admin\img\main1.jpg" title="Image 3" class="img-style next im-3">
        <img src="admin\img\main7.jpg" title="Image 4" class="img-style next im-4">
     </div>
  
  
</div>';
  }
  
  function footer(){//функция вывода подвала
    echo "<div id=foot style='text-align:center'> <a id='blink1'>
	Для смены аккаунта нажмите >>>
	<a href='index.php'>выход</a> </div>
	</div>
          </body></html>";
  } 
}
?>
