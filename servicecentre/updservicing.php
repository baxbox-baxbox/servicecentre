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
	 $r=mysql_query("select * from request where  idrequest=$idrequest ");
	 $f=mysql_fetch_array($r);
	 if ($upd==1)
		{
     ?>
   <div  style="font-size:22px; color:#000" align="center">Редактирования услуг заявки "<? echo $f['name']?>"</div>
   <?
		}
		else
		{
   ?>
      <div  style="font-size:22px; color:#000" align="center">Добавление услуг заявки "<? echo $f['name']?>"</div>
   <?
		}
   ?>
      <br>  
      
<?

if ($upd==1)
{
$Arr=$_REQUEST["Arrservicing"];
$idservicing=$Arr[0];
$s="SELECT servicing.*  FROM servicing where sidservicing=$idservicing ";

$f=mysql_fetch_array($r);//считывание текующей записи

}

?>
<form name="form2" method="post"  >
				  <table width="526" border="0">
              
                            
<tr> 
 <td><font color="#000000" >   Услуга: </font></td>
        <td width="305"><select name="idservice"  style="height:22; width:auto" >
  <?

$d=mysql_query( "select * from service");
for ($i=0;$i<mysql_num_rows($d);$i++)
  {
    $m=mysql_fetch_array($d);
	echo "<option value=".$m["idservice"];
	if (($upd==1)&&    ($m["idservice"]==$f["idservice"]))
	 echo " selected=selected";
	echo ">".$m["name"]." ".$m["cost"]."р";
	echo "</option>";	 		
  }
  
?>
					  
          </select></td>
                    </tr>                      			  

                      
                  </table>
<br>
				<input  type="button"  name="button"   onclick="this.form.action='updservicing.php?step=2&upd=<? echo"$upd";?>&id=<? echo"$Arr[0]";?>'; this.form.submit();"   value="Сохранить" width="500">
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


$idservice =  $_POST["idservice"];


	
	
if ($upd==1)
  {  
     $id=$_REQUEST["id"];
	 mysql_query("Update servicing set idservice=$idservice  WHERE idservicing=$id");
	 ?>
	 <script language="javascript">
	 location.href='servicing.php?filter=0';
	 </script>
	 <?
  }  else
  {//формирование SQL-запроса на добавление данных
	 mysql_query("INSERT INTO servicing (idrequest, idservice) VALUES ($idrequest,  $idservice)");
	 
	?>
	 <script language="javascript">
	 location.href='servicing.php?filter=0';
	 </script>
	 <?
  }
}
	?>
