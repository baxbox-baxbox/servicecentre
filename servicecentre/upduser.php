<?
require "option.php";//файл с параметрами подключения к БД
?>
<html >
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
				<a href="project.php"> <img src="images/лого.jpg" width="120" height="100"> </a>
			</div>
		<div id="header1" class="container">

<?
require "menu.php";
?>
		</div>

	</div>
	<!-- end #header -->
	


		<div style="clear: both;">
        			<div class="post">

      <br>  
      
<?
$upd=$_REQUEST["upd"];
if ($upd==1)
{
$Arr=$_REQUEST["Arr"];
//phpinfo(32);
$r=mysql_query("select * from worker where idworker="."$Arr[0]");

$f=mysql_fetch_array($r);//считывание текующей записи
echo " <div  style=font-size:22px align=center>Редактирование пользователя</div>";
}
else
echo " <div  style=font-size:22px align=center>Добавление пользователя</div>";


  
  
      
	  
?>
 <br> 
<form name="form2" method="post"  >
				  <table width="526" border="0">
                    <tr>
                      <td><font color="#000000" >   ФИО: </font> </td>
                      <td><input   name="fio"   type="text"  value="<? if ($upd==1) echo $f['fio']; else echo(""); ?>"  ></td>
                    </tr>  	          
                    <tr>
                      <td><font color="#000000" >   Телефон: </font> </td>
                      <td><input   name="phone"   type="text"  value="<? if ($upd==1) echo $f['phone']; else echo(""); ?>"  ></td>
                    </tr>  	                                                                                     
                    <tr>
                      <td><font color="#000000" > Логин: </font> </td>
                      <td><input   name="login"  value="<? if ($upd==1) echo $f['login']; else echo(""); ?>"   type="text" ></td>
                    </tr>  				  
                    <tr>
                      <td><font color="#000000" >  Пароль: </font> </td>
                      <td><input   name="parol"  value="<? if ($upd==1) echo $f['parol']; else echo(""); ?>"   type="text" ></td>
                    </tr>      
                  
                                 <tr>
                      <td><font color="#000000" >   Права: </font></td>
                      <td>
                 <select  name="post"  style="height:22; width:auto"    >
					<option   value="Администратор"  <?	if (($upd==1)&& ($f['post']=="Администратор")) echo "selected"; ?> > Администратор </option>	   
                    <option  value="Менеджер" <?	if (($upd==1)&& ($f['post']=="Менеджер")) echo "selected"; ?> >Менеджер </option>
                    <option  value="Программист" <?	if (($upd==1)&& ($f['post']=="Программист")) echo "selected"; ?> >Программист </option>
                    <option  value="Дизайнер" <?	if (($upd==1)&& ($f['post']=="Дизайнер")) echo "selected"; ?> >Дизайнер </option>                    
                    <option  value="Директор" <?	if (($upd==1)&& ($f['post']=="Директор")) echo "selected"; ?> >Директор </option>                                        	         																				
				</select>                    
				      </td> 
                      </tr>   
                      
                  </table>
<br>
				<input  type="button"  name="button"   onclick="this.form.action='upduser.php?step=2&upd=<? echo"$upd";?>&id=<? echo"$Arr[0]";?>'; this.form.submit();"   value="Сохранить" width="500">
				<input  type="button"  name="button"  onClick="javascript:history.back();"  value="Отмена">

		</form>				
				</td>
			</tr>
		</table></td>



     
                



<!-- end #footer -->
</body>
</html>

<?
$step=$_REQUEST["step"];
if ($step==2)
{
$upd=$_REQUEST["upd"];

$fio =  $_POST["fio"];
$phone =  $_POST["phone"];
$login =  $_POST["login"];
$parol =  $_POST["parol"];
$post =  $_POST["post"];



	if ((strlen($login)>50) or (strlen($login)==0) or (strlen($parol)>50) or (strlen($parol)==0) or (strlen($phone)>50) or (strlen($phone)==0) or (strlen($fio)>50) or (strlen($fio)==0)) 
	{
	?>
		<script language="javascript">
		alert("Не верный ввод!");
		history.back();
		</script>

	<?
		exit();
	}	
	
	
if ($upd==1)
  {  
     $id=$_REQUEST["id"];
	 mysql_query("Update worker set login='$login', parol='$parol', post='$post', phone='$phone', fio='$fio'  WHERE idworker=$id");
	 ?>
	 <script language="javascript">
	 location.href='user.php?filter=0';
	 </script>
	 <?
  }  else
  {//формирование SQL-запроса на добавление данных
	 mysql_query("INSERT INTO worker (login, parol, phone, post, fio) VALUES ('$login', '$parol', '$phone', '$post', '$fio')");
	?>
	 <script language="javascript">
	 location.href='user.php?filter=0';
	 </script>
	 <?
  }
}
	?>
