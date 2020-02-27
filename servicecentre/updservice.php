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
$r=mysql_query("select * from service where idservice="."$Arr[0]");

$f=mysql_fetch_array($r);//считывание текующей записи
echo " <div  style=font-size:22px align=center>Редактирование услуги</div>";
}
else
echo " <div  style=font-size:22px align=center>Добавление услуги</div>";
   
	  
?>
 <br> 
<form name="form2" method="post"  >
				  <table  border="0">
                    <tr>
                      <td><font color="#000000" >   Наименование: </font> </td>
                      <td><input   size="80" name="name"   type="text"  value="<? if ($upd==1) echo $f['name']; else echo(""); ?>"  ></td>
                    </tr>  	          
                    <tr>
                      <td><font color="#000000" >   Стоимость: </font> </td>
                      <td><input   name="cost"   type="text"  value="<? if ($upd==1) echo $f['cost']; else echo(""); ?>"  ></td>
                    </tr>  	                                                                                     

                      
                  </table>
<br>
				<input  type="button"  name="button"   onclick="this.form.action='updservice.php?step=2&upd=<? echo"$upd";?>&id=<? echo"$Arr[0]";?>'; this.form.submit();"   value="Сохранить" width="500">
				<input  type="button"  name="button"  onClick="javascript:history.back();"  value="Отмена">

		</form>				
				</td>
			</tr>
		</table></td>



     
                

        </div>
	</div>
	<!-- end #page --> 
</div>

<!-- end #footer -->
</body>
</html>

<?
$step=$_REQUEST["step"];
if ($step==2)
{
$upd=$_REQUEST["upd"];

$name =  $_POST["name"];
$cost =  $_POST["cost"];




	if ((strlen($name)>250) or (strlen($name)==0) ) 
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
	 mysql_query("Update service set name='$name', cost=$cost  WHERE idservice=$id");
	 ?>
	 <script language="javascript">
	 location.href='service.php?filter=0';
	 </script>
	 <?
  }  else
  {//формирование SQL-запроса на добавление данных
	 mysql_query("INSERT INTO service (name, cost) VALUES ('$name', $cost)");
	?>
	 <script language="javascript">
	 location.href='service.php?filter=0';
	 </script>
	 <?
  }
}
	?>
