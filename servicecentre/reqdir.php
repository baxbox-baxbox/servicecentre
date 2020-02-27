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
   <div  style="font-size:22px; color:#000" align="center">Заявки клиентoв (режим директора)</div>
      <br>  


 <form name="form2"  method="post"  >
 
   <?

		$filter=$_GET["filter"];//считывание параметра фильтра
		$sort=$_GET["sort"];//считывание параметра фильтра		



if ($filter==0)/*есть ли фильтрация данных*/
{
date_default_timezone_set("Europe/Moscow");
$date1=(date("Y")-1)."-".date("m")."-".date("d");    
$date2=(date("Y")+1)."-".date("m")."-".date("d");    
}
	
if ($filter==1)/*есть ли фильтрация данных*/
{
$date1=$_POST['date1'];    
$date2=$_POST['date2'];    
 
$fieldfind = $_POST['findname'];//первое поле
$value1 = $_POST['FilterValue1'];//значение первого поля
$s="SELECT request.*, client.fio as clientfio, worker.fio as workerfio FROM client, request LEFT JOIN worker ON request.idworker=worker.idworker where request.idclient=client.idclient and $fieldfind" ;
if ($value1!="Все")
$s=$s." LIKE '%$value1"."%' COLLATE cp1251_general_ci ";
Else
$s=$s."=$fieldfind ";

$s=$s." and date>='$date1' and date<='$date2' ";
}
else
		 $s="SELECT request.*, client.fio as clientfio, worker.fio as workerfio FROM client, request LEFT JOIN worker ON request.idworker=worker.idworker where request.idclient=client.idclient ";

if ($sort==1)/*есть ли сортировка данных*/
{
$fieldsort = $_POST['sortname'];//первое поле
$s=$s." order by $fieldsort";
}



	 ?>
         
     		<div align="right">	
Сортировка:
				<select name="sortname"  style="height:22; width:auto" onChange="this.form.action='reqdir.php?sort=1&filter=<? echo $filter;?>'; this.form.submit();" >
					<option value="name"  <? if ($fieldsort=="name") {?> selected="selected" <? }?>>Название </option>	
					<option value="clientfio"  <? if ($fieldsort=="clientfio") {?> selected="selected" <? }?>>Клиент </option>	
					<option value="date"  <? if ($fieldsort=="date") {?> selected="selected" <? }?>>Дата</option>	  
					<option value="term"  <? if ($fieldsort=="term") {?> selected="selected" <? }?>>Сроки</option>	                      
					<option value="status"  <? if ($fieldsort=="status") {?> selected="selected" <? }?>>Статус </option>	
					<option value="workerfio"  <? if ($fieldsort=="workerfio") {?> selected="selected" <? }?>>Исполнитель </option>	                    
					<option value="cost"  <? if ($fieldsort=="cost") {?> selected="selected" <? }?>>Клиент оплатил</option>	                      
					<option value="paid"  <? if ($fieldsort=="paid") {?> selected="selected" <? }?>>Оплачено </option>	
					<option value="discr"  <? if ($fieldsort=="discr") {?> selected="selected" <? }?>>Описание </option>	            
                                        
                                      
                                       
			  </select>  
        &nbsp;    &nbsp;    &nbsp;                              
            С:
				<input   name="date1"  value="<? echo "$date1";?>"   size="10" type="text">
            По:
                <input   name="date2"   type="text"  value="<? echo "$date2";?>" size="10">
                                        

    &nbsp;                        	
по полю 
 &nbsp;  
				<select name="findname"  style="height:22; width:auto"  >
					<option value="name"  <? if ($fieldfind=="name") {?> selected="selected" <? }?>>Название </option>	              
					<option value="status"  <? if ($fieldfind=="status") {?> selected="selected" <? }?>>Статус </option>	 
					<option value="paid"  <? if ($fieldfind=="paid") {?> selected="selected" <? }?>>Оплачено </option>	                                                       
			  </select>  
                
				<input   name="FilterValue1"  onFocus="if (this.value=='Все') this.value=''"  value="<? if ($filter==1)/*есть ли фильтрация данных*/ echo "$value1"; else echo("Все"); ?>" onBlur="checkFilterValue1()"  type="text">

				<br>
				<input  type="button"  name="button1"  onclick="this.form.action='reqdir.php?filter=1&sort=<? echo $sort;?>'; this.form.submit();"   value="Фильтр">
				<input  type="button"  name="button2"  onclick="this.form.action='reqdir.php?filter=0&sort=<? echo $sort;?>'; this.form.submit();"   value="Очистить">
           <br>            
        </div>   
<?
 $r=mysql_query($s);
?>
<input  type="button"  name="button3" <? if (mysql_num_rows($r)==0) {?>    disabled="disabled"<? }?>   onclick="this.form.action='client.php'; this.form.submit();" value="Информация о клиенте">
<input  type="button"  name="button3" <? if (mysql_num_rows($r)==0) {?>    disabled="disabled"<? }?>   onclick="this.form.action='worker.php'; this.form.submit();" value="Информация о исполнителе">
<input  type="button"  name="button4" <? if (mysql_num_rows($r)==0) {?>    disabled="disabled"<? }?>   onclick="this.form.action='expreq.php'; this.form.submit();" value="Печать заявки"> 
    <input  type="button"  name="button4" <? if (mysql_num_rows($r)==0) {?>    disabled="disabled"<? }?>   onclick="this.form.action='explst.php?sort=<? echo $sort;?>&filter=<? echo $filter;?>'; this.form.submit();" value="Печать ведомости">

  <table WIDTH=100% border=4  bordercolor="grey" cellspacing=0 cellpadding=3>
									<tr>
		<td  ><font color=white>&nbsp;</font></td> 
		<td   align="center" valign="middle"><h5 style="color:#000">Номер</h5></td>                                            
		<td   align="center" valign="middle"><h5 style="color:#000">Название</h5></td> 
		<td   align="center" valign="middle"><h5 style="color:#000">Клиент</h5></td>     
		<td   align="center" valign="middle"><h5 style="color:#000">Дата</h5></td>	  
		<td   align="center" valign="middle"><h5 style="color:#000">Сроки</h5></td>	                   
		<td   align="center" valign="middle"><h5 style="color:#000">Статус</h5></td>
		<td   align="center" valign="middle"><h5 style="color:#000">Исполнитель</h5></td>                
		<td   align="center" valign="middle"><h5 style="color:#000">Клиент оплатил</h5></td>	                   
		<td   align="center" valign="middle"><h5 style="color:#000">Оплачено</h5></td>
		<td   align="center" valign="middle"><h5 style="color:#000">Описание</h5></td>                                        			        
			</tr>
        
        
      <?
		 
		

			for ($i=0;$i<mysql_num_rows($r);$i++)//вывод данных в цикле по количеству записей
			  {
				$f=mysql_fetch_array($r);//считывание текующей записи				
				if ($f['status']=="На рассмотрении")	echo "<tr bgcolor=LightCoral>";
				if ($f['status']=="Заказ отменен")	echo "<tr >";
				if ($f['status']=="Заказ выполнен")	echo "<tr bgcolor=LimeGreen>";
				if ($f['status']=="Выполняется" )	echo "<tr bgcolor=DeepSkyBlue>";	

			
	if ($i==0)
    echo "<td><input type=radio checked=checked name=Arrrequest[] value=".$f['idrequest']."></td>";
	else
    echo "<td><input type=radio name=Arrrequest[] value=".$f['idrequest']."></td>";				
				echo "
				<td> ".$f['idrequest']."</td>				
				<td> ".$f['name']."</td>
				<td> ".$f['clientfio']."</td>				

				<td> ".$f['date']."</td>													
				<td> ".$f['term']."</td>
				<td> ".$f['status']."</td>";

				if 	($f['workerfio']==null)																	
					echo "<td>Не назначен</td>";
				else
					echo "<td> ".$f['workerfio']."</td>";
				echo "<td> ".$f['cost']."</td>";
				echo "<td> ".$f['paid']." </td>";
				echo "<td> ".$f['discr']." </td>";																	
				echo "</tr>";
			  }		 
		?>
      
  </table> 

</form>	

        </div>
	</div>
	<!-- end #page --> 
</div>

<!-- end #footer -->
</body>
</html>
