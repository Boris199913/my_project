<?php
//header ('Content-type:text/html; charset=utf-8');
?>
<?php
session_start(); 
if(isset($_SESSION['admin']))
  unset($_SESSION['admin']);
 
	if(isset($_POST['ok']))
{
  if(( $_POST['nm']=='admin'))
  {
	  if(md5($_POST['pas'])=='202cb962ac59075b964b07152d234b70' )
  	{
	    $_SESSION['admin']='admin';
	    header("location:main.php");
  	}	
  	else
  echo "�������� ������";}
	else
            echo "�������� �����";	
		
}

echo "<html><head><link rel='stylesheet' type='text/css' href='..\for16.css'></head>";
echo "<body><div class='ts'><br><br><form method=post><div class='tabss'><IMG  alt='�����' src='img\poly.png'></div>
<div class='tabs-content'> </br><h1><b><p style='margin-left:35px;'><br>B��� �������������</p></b></h1>
<p style='margin-left:65px;'>
<b>����� &nbsp</b> <BR> <input type=text name=nm><BR>
<br><b>������</b>  <BR><input type=password name=pas><BR><BR><BR>
<input id=button_main type=submit name=ok value='&nbsp�����&nbsp' class='b1'/></p>
<p><a href='http://localhost/Bor/kursovik/' >&nbsp����� ��� �����</a></p>
</div>

<div class='ta3'><IMG  alt='niz' src='img\kont.png'></div>
</form>";
?>
<br><br>