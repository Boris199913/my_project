<?php
class hat_foot{//����� ��� ������ �����, ����=� � ������� �����
  public $title="���������";
  
  
  function adm_hat(){//������� ������ ����� ��� �������������� 	
  echo "<html>\n<head>\n	
  
  <link rel='stylesheet' type='text/css' href='../for16.css' />
  <meta http-equiv='Content-Type' content='text/html; charset=utf-8'>";	
   echo "<title> $this->title </title>\n
</head>\n<body>";
  echo "<div id=div_head> <a id='blink1'> ���� ������ ����� </a> </div>";
  }

  function hat(){//������� ������ ����� ��� ������������ 
  echo "<html>\n<head>\n	
  
  <link rel='stylesheet' type='text/css' href='user.css' />
  <meta http-equiv='Content-Type' content='text/html; charset=utf-8'>";	
   echo "<title> $this->title </title>\n
</head>\n<body>";
  echo "<div id=div_head> <a id='blink1'> ���� ������ ����� </a> </div>";
 }

  function menu($num){//������� ������ ����
    echo '<div id="menu">
<a href="main.php"';
if($num==1) echo' class=there ';
echo'> ������� </a>
 <a href="apteki.php"';
if($num==2) echo' class=there ';
echo'>  ������</a>
<a href="postav.php"';
if($num==3) echo' class=there ';
echo'> ���������� </a> 
 <a href="naznn.php"';
if($num==4) echo' class=there ';
echo'>  ���������� </a>  
 <a href="sotrudn.php"';
if($num==5) echo' class=there ';
echo'> ����������  </a> 
 <a href="students.php"';
if($num==6) echo' class=there ';
echo'>  ��� ������ �������� </a>
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
  
   function u_menu($num){//������� ������ ����
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
  
  function footer(){//������� ������ �������
    echo "<div id=foot style='text-align:center'> <a id='blink1'>
	��� ����� �������� ������� >>>
	<a href='index.php'>�����</a> </div>
	</div>
          </body></html>";
  } 
}
?>
