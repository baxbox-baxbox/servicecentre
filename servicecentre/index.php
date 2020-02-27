<?
require "option.php";//файл с параметрами подключения к БД
$step=$_REQUEST["step"];
if ($step==2)//выход
{
setcookie ( 'Mode', ""); 
$Mode="";
$step=0;
}

if ($step==1)
{
$login=$_POST["login"];
$parol=$_POST["parol"];

$SET_client=mysql_query("select * from client where login='$login' and parol='$parol'");
$COUNT_client=mysql_num_rows($SET_client);
$SET_worker=mysql_query("select * from worker where login='$login' and parol='$parol'");
$COUNT_worker=mysql_num_rows($SET_worker);

if  (($COUNT_client==0)&&($COUNT_worker==0))
{
?>
<script language="javascript">
alert("Не верный ввод!");
history.back();
</script>
<?
exit();
} 


if ($COUNT_client>0)
{
		$f=mysql_fetch_array($SET_client);//считывание текующей записи
		$idclient=$f["idclient"];
		setcookie ( 'idclient', $idclient); 
		$Mode="Клиент";		
		setcookie ( 'Mode', 'Клиент'); 
		$fio=$f["fio"];
		setcookie ( 'fio', $fio); 

}


if ( $COUNT_worker>0)
{
	    $f=mysql_fetch_array($SET_worker);//считывание текующей записи
		$idworker=$f["idworker"];
		setcookie ( 'idworker', $idworker); 		
		$Mode=$f["post"];

		setcookie ( 'Mode', $Mode); 
		$fio=$f["fio"];
		setcookie ( 'fio', $fio); 		
	

}

if (($COUNT_worker<=0) &&($COUNT_client<=0))
{
?>
<script language="javascript">
alert("Не верный ввод!");
history.back();
</script>
<?
} 


}




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

	<div id="header-wrapper1"> 			
<div id="logo">
				<a href="index.php"> <img src="images/лого.jpg" width="120" height="100"> </a>
			</div>
 			

		<div id="header1" class="container">

<?
require "menu.php";
?>
		</div>

	</div>
	<!-- end #header -->
	


<br>
<table width="100%" height="83%">
<tr>
<td>
    
<?             
if ( $Mode=="")
{
?>
	<form name="form2" onaction="this.form.action='default.php?step=1'" method="post"  >		
							<table align="center">				
							<tr>
							<td>
							Авторизация:
							</td>
                                                        </tr>							
                                                        <tr>
							<td>
							Логин:
							</td>
                                                        </tr>
                            <tr>
							<td>
<input    name="login"   value=""  type="text" >
							</td>
							</tr>
							
							<tr>
							<td>
							Пароль:
							</td>
                            </tr>
                            <tr>
							<td>
<input    name="parol"    value=""  type="password" >							
							</td>
							</tr>	
	<tr>
		<td align="right"><input  name="button"  type="button"   onClick="this.form.action='index.php?step=1'; this.form.submit();" value="Вход" width="600">
        <input  name="button"  type="button"   onClick="this.form.action='reg.php?step=1'; this.form.submit();" value="Регистрация" width="600">
					</tr>
							</table>
</form>	
<?
}
else
{

		if ($Mode=="Клиент")
		{
	 ?>
			<script language="javascript">			
 			location.href='reqclt.php';
			</script>
	 <?
		}

		if ($Mode=="Менеджер")
		{
	 ?>
			<script language="javascript">
 			location.href='reqmng.php';
			</script>
	 <?
		}
		
		if ($Mode=="Директор")
		{
	 ?>
			<script language="javascript">
 			location.href='reqdir.php';
			</script>
	 <?
		}

	if ($Mode=="Исполнитель")
		{
	 ?>
			<script language="javascript">
 			location.href='reqwrk.php';
			</script>
	 <?
		}		

		if ($Mode=="Администратор")
{
?>
 <script language="javascript">
 location.href='user.php';
 </script>
<?
}

}
?>
</td>
</tr>
<tr>
<td valign="bottom">
<div id="footer">
	<p>Copyright (c) 2018. All rights reserved.</p>
</div>
</td>
</tr>
</table>
</body>
</html>


