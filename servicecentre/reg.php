<?
$step=$_REQUEST["step"];



require "option.php";//файл с параметрами подключения к БД




?>
<html>
<head>
<meta name="keywords" content="" />
<meta name="description" content="" />
<meta http-equiv="content-type" content="text/html; charset=windows-1251" />
<title>Сервисный центр</title>
<link href="style.css" rel="stylesheet" type="text/css" media="screen" />
</head>
<body>
<div id="wrapper">
	<div id="header-wrapper1">
    <div id="logo">
				<a href="index.php"> <img src="images/лого.jpg" width="120" height="100"> </a>
			</div>
		<div id="header1" class="container">

<?
require "menu.php";




if ($step==1)
{
?>
		</div>

	</div>
	<!-- end #header -->
	


		<div style="clear: both;">
        			<div class="post">
<br>
   <div  style="font-size:18px; color:#000" align="center">Заполните данные для создания профиля</div>
<br>   

<form name="form2" method="post"  enctype="multipart/form-data" >
				  <table  border="0">
                    <tr>
                      <td><font color="#000000" > Организация: </font> </td>
                      <td><input   name="enterprise"  value="<? if ($upd==1) echo "$f[enterprise]"; else echo(""); ?>"   type="text" ></td>
                    </tr>  	
                    <tr>
                      <td ><font color="#000000" >   ФИО*: </font> </td>
                      <td><input   name="fio"   type="text"  value="<? if ($upd==1) echo "$f[fio]"; else echo(""); ?>" size="40" ></td>
                    </tr>   
                    <tr>
                      <td><font color="#000000" > email*: </font> </td>
                      <td><input   name="mail"  value="<? if ($upd==1) echo "$f[mail]"; else echo(""); ?>"   type="text" ></td>
                    </tr>  		  
                    <tr>
                      <td><font color="#000000" > Телефон*: </font> </td>
                      <td><input   name="phone"  value="<? if ($upd==1) echo "$f[phone]"; else echo(""); ?>"   type="text" ></td>
                    </tr>  	
                    <tr>
                      <td><font color="#000000" > Реквизиты: </font> </td>
                      <td><input   name="info"  value="<? if ($upd==1) echo "$f[info]"; else echo(""); ?>"   type="text" ></td>
                    </tr>                                                                                                
                    <tr>
                      <td ><font color="#000000" >   Логин*: </font> </td>
                      <td><input   name="login"   type="text"  value="<? if ($upd==1) echo "$f[login]"; else echo(""); ?>" size="40" ></td>
                    </tr>  	          		  
			         <tr>
                      <td><font color="#000000" >  Пароль*: </font> </td>
                      <td><input   name="newparol"   type="password" size="40" ></td>
                    </tr>  	    
                     <tr>
                      <td ><font color="#000000" >  Повторите пароль*: </font> </td>
                      <td><input   name="repparol"    type="password"   size="40" ></td>
                    </tr>  	
                                                               
                  </table>
				<br>
				<input  type="button"  name="button"   onclick="this.form.action='reg.php?step=2&upd=<? echo"$upd";?>&id=<? echo"$Arr[0]";?>'; this.form.submit();"   value="Сохранить" width="500">
				<input  type="button"  name="button"  onClick="location.href='index.php';"  value="Отмена">

		</form>				
				</td>
			</tr>
		</table></td>

<?
}
?>

     
                

        </div>
	</div>
	<!-- end #page --> 
</div>

<!-- end #footer -->
</body>
</html>

<?


if ($step==2)
{
$upd=$_REQUEST["upd"];

$login =  $_POST["login"];

$fio =  $_POST["fio"];
$mail =  $_POST["mail"];
$enterprise =  $_POST["enterprise"];
$phone =  $_POST["phone"];
$info =  $_POST["info"];

$newparol =  $_POST["newparol"];
$repparol =  $_POST["repparol"];

if ( ($login=="") or ($fio=="") or ($mail=="") or ($phone=="") or  ($newparol=="") or ($repparol=="") ) 
{

?>

	 <script language="javascript">
	 alert ('Введите обязательные для ввода даннные!');
 	 history.back();
	 </script>
<?
exit();
}

	
$SET_user=mysql_query("select * from client where login='$login'");
$COUNT_user=mysql_num_rows($SET_user);

if ($COUNT_user!=0)
{
?>
<script language="javascript">
alert("Пользователь с таким логином уже существует!");
history.back();
</script>
<?
exit();
} 


if ( ( strpos($mail, "@")==0)  or ( strpos($mail, ".")==0) )
{

?>

	 <script language="javascript">
	 alert ('Введите корректный адрес электронной почты!');
 	 history.back();
	 </script>
<?
exit();
}


if ($newparol!=$repparol) 
{
?>

	 <script language="javascript">
	 alert ('Повторите ввод пароля корректно!');
 	 history.back();
	 </script>
<?
exit();
}


	  	 mysql_query("insert into client (login, parol, fio, mail, enterprise, info, phone) values ('$login', '$newparol', '$fio', '$mail', '$enterprise', '$info', '$phone')");


?>

	 <script language="javascript">
	 alert ('Профиль сохранён.');
 	location.href='index.php';
	 </script>
<?



 
}




	?>