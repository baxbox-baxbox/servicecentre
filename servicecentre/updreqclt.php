<?
$step=$_REQUEST["step"];
if ($step==1)
{
setcookie ('file', '');

}
if ($step==3)
setcookie ( 'file', basename($_FILES["file"]["name"]));

require "option.php";//файл с параметрами подключения к БД

$file=$_COOKIE["file"];
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
	 $Arr=$_REQUEST["Arrrequest"];
	 $idrequest=$Arr[0];
	 $r=mysql_query("select * from request where  idrequest=$idrequest");
	 $f=mysql_fetch_array($r);
     ?>
   <div  style="font-size:22px; color:#000" align="center">Редактирование заявки "<? echo $f['name']?>"</div>
   <?
		}
		else
		{
   ?>
      <div  style="font-size:22px; color:#000" align="center">Добавление заявки</div>
   <?
		}
   ?>
      <br>  
<?

date_default_timezone_set("Europe/Moscow");
$date=date("Y")."-".date("m")."-".date("d");   
?>
<form name="form2" method="post" enctype="multipart/form-data" >
				  <table width="526" border="0">
                    
                    <tr>
                      <td width="172"><font color="#000000" >   Название: </font> </td>
                      <td width="240"><input   name="name"   type="text"  value="<? if ($upd==1) echo $f['name']; else echo(""); ?>" size="40" ></td>
                    </tr>  	
                    <tr>
                      <td><font color="#000000" >  Дата: </font> </td>
                      <td><input  size="8"  name="date"  value="<? if ($upd==1) echo $f['date']; else echo("$date"); ?>"   type="text" ></td>
                    </tr>    
                    <tr>
                      <td><font color="#000000" >  Сроки: </font> </td>
                      <td><input  size="8" name="term"  value="<? if ($upd==1) echo $f['term']; else echo("$date"); ?>"   type="text" ></td>
                    </tr>                                                                                                                                         

                    <tr>
                      <td width="172"><font color="#000000" >   Описание: </font> </td>
                      <td width="240"><input   name="discr"   type="text"  value="<? if ($upd==1) echo $f['discr']; else echo(""); ?>" size="40" ></td>
                    </tr>  	 
  
                  
 
                      
                  </table>
<br>
				<input  type="button"  name="button"   onclick="this.form.action='updreqclt.php?step=2&upd=<? echo"$upd";?>&id=<? echo"$Arr[0]";?>'; this.form.submit();"   value="Сохранить" width="500">
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

$status =  "На рассмотрении";
$name =  $_POST["name"];
$term =  $_POST["term"];
$date =  $_POST["date"];
$discr =  $_POST["discr"];



	if ((strlen($name)>50) or (strlen($name)==0)) 
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

			mysql_query("Update request set name='$name', date='$date', term='$term', discr='$discr'  WHERE idrequest=$id");

  }  else
  {//формирование SQL-запроса на добавление данных

	 		mysql_query("INSERT INTO request (name, status, idclient, date, term, discr, paid) VALUES ('$name', '$status', $idclient, '$date', '$term',  '$discr',  'Не оплачено')");

  }	
  
  ?>
	 <script language="javascript">
	 location.href='reqclt.php?filter=0';
	 </script>
	 <?
}
	


	?>