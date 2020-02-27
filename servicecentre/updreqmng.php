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
	 $Arr=$_REQUEST["Arrrequest"];
	 $idrequest=$Arr[0];
	 $r=mysql_query("select request.*, sum(service.cost) as sum from request, service, servicing where  request.idrequest=$idrequest and request.idrequest=servicing.idrequest and service.idservice=servicing.idservice");
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

    Итого: <? $sum=$f['sum']; echo $sum?>&nbsp;руб &nbsp; Скидка: 10% К оплате: <? $sum=$sum-$sum*0.10; echo ($sum)?>&nbsp;руб Предоплата: <? echo ($sum-$sum*0.70)?>&nbsp;руб
    <br><br>
<form name="form2" method="post"  >
				  <table width="526" border="0">
 	
                    <tr>
                      <td><font color="#000000" >  Дата: </font> </td>
                      <td><input  size="8"  name="date"  value="<? if ($upd==1) echo $f['date']; else echo("$date"); ?>"   type="text" ></td>
                    </tr>    
                    <tr>
                      <td><font color="#000000" >  Сроки: </font> </td>
                      <td><input  size="8" name="term"  value="<? if ($upd==1) echo $f['term']; else echo("$date"); ?>"   type="text" ></td>
                    </tr>                                                                                                                                         

                                 <tr>
                      <td><font color="#000000" >   Статус: </font></td>
                      <td>
                 <select  name="status"  style="height:22; width:auto"    >
					<option   value="На рассмотрении"  <?	if (($upd==1)&& ($f['status']=="На рассмотрении")) echo "selected"; ?> > На рассмотрении </option>	   
                    <option  value="Заказ отменен" <?	if (($upd==1)&& ($f['status']=="Заказ отменен")) echo "selected"; ?> >Заказ отменен </option>
                    <option  value="Заказ выполнен" <?	if (($upd==1)&& ($f['status']=="Заказ выполнен")) echo "selected"; ?> >Заказ выполнен </option>                         
                    <option  value="Выполняется" <?	if (($upd==1)&& ($f['status']=="Выполняется")) echo "selected"; ?> >Выполняется </option>             	         																				                    
				</select>                    
				      </td> 
                      </tr>   
   <tr> 
 <td><font color="#000000" >   Исполнитель: </font></td>
        <td width="305"><select name="idworker"  style="height:22; width:auto" >
  <?

$d=mysql_query( "select * from worker where post='Исполнитель' ");
for ($i=0;$i<mysql_num_rows($d);$i++)
  {
    $m=mysql_fetch_array($d);
	echo "<option value=".$m["idworker"];
	if (($upd==1)&&    ($m["idworker"]==$f["idworker"]))
	 echo " selected=selected";
	echo ">".$m["fio"];
	echo "</option>";	 		
  }
  
?>
					  
          </select></td>
                    </tr>  
                    <tr>
                      <td width="172"><font color="#000000" >   Клиент оплатил: </font> </td>
                      <td width="240"><input   name="cost"   type="text"  value="<? if ($upd==1) echo $f['cost']; else echo("0"); ?>" size="10" >
                      </td>
                    </tr>  	 
 <tr>
                      <td><font color="#000000" >   Оплачено: </font></td>
                      <td>
                 <select  name="paid"  style="height:22; width:auto"    >
					<option   value="Оплачено"  <?	if (($upd==1)&& ($f['paid']=="Оплачено")) echo "selected"; ?> > Оплачено</option>
 <option  value="Предоплата" <?	if (($upd==1)&& ($f['paid']=="Предоплата")) echo "selected"; ?> >Предоплата</option>	   
                    <option  value="Не оплачено" <?	if (($upd==1)&& ($f['paid']=="Не оплачено")) echo "selected"; ?> >Не оплачено</option>
       	         																				                    
				</select>                    
				      </td> 
                      </tr>                      
                    <tr>
                      <td width="172"><font color="#000000" >   Описание: </font> </td>
                      <td width="240"><input   name="discr"   type="text"  value="<? if ($upd==1) echo $f['discr']; else echo(""); ?>" size="40" ></td>
                    </tr>  	                   
 
                      
                  </table>
<br>
				<input  type="button"  name="button"   onclick="this.form.action='updreqmng.php?step=2&upd=<? echo"$upd";?>&id=<? echo"$Arr[0]";?>'; this.form.submit();"   value="Сохранить" width="500">
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

$status = $_POST["status"];
$term =  $_POST["term"];
$date =  $_POST["date"];
$idworker =  $_POST["idworker"];
$cost =  $_POST["cost"];
$paid =  $_POST["paid"];
$discr =  $_POST["discr"];


	
if ($upd==1)
  {  
     $id=$_REQUEST["id"];
	 mysql_query("Update request set  date='$date', term='$term', status='$status', idworker=$idworker , paid='$paid', discr='$discr', cost=$cost  WHERE idrequest=$id");
  }  else
  {//формирование SQL-запроса на добавление данных
	 mysql_query("INSERT INTO request ( status, idclient, date, term, status, idworker, paid, discr, cost) VALUES ( '$status', $idclient, '$date', '$term', '$status,  $idworker, '$paid', '$discr,  $cost)");

  }	
  
  ?>
	 <script language="javascript">
	 location.href='reqmng.php?filter=0';
	 </script>
	 <?
}
	?>






