<?
require "option.php";//файл с параметрами подключения к БД

if (isset ($_POST['Arrrequest']))
{
 $Arr=$_POST['Arrrequest'];
 $idrequest=$Arr[0];
 setcookie ( 'idrequest', $idrequest); 
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
	 $r=mysql_query("select * from request where  idrequest=$idrequest ");
	 $f=mysql_fetch_array($r);
	
     ?>
   <div  style="font-size:22px; color:#000" align="center">Услуги заявки "<? echo $f['name']?>"</div>
      <br>  


 <form name="form2"  method="post"  >
 
   <?

		$filter=$_GET["filter"];//считывание параметра фильтра
		$sort=$_GET["sort"];//считывание параметра фильтра		


	
if ($filter==1)/*есть ли фильтрация данных*/
{

 
$value1 = $_POST['FilterValue1'];//значение первого поля
$s="SELECT idservicing, name, cost FROM servicing, service where servicing.idrequest=$idrequest and servicing.idservice=service.idservice and name";
if ($value1!="Все")
$s=$s." LIKE '%$value1"."%' COLLATE cp1251_general_ci";
Else
$s=$s."=name ";

}
else
		 $s="SELECT idservicing, name, cost FROM servicing, service where servicing.idrequest=$idrequest and servicing.idservice=service.idservice ";

if ($sort==1)/*есть ли сортировка данных*/
{
$fieldsort = $_POST['sortname'];//первое поле
$s=$s." order by $fieldsort";
}


	 ?>
         
     		<div align="right">	
Сортировка:
				<select name="sortname"  style="height:22; width:auto" onChange="this.form.action='servicing.php?sort=1&filter=<? echo $filter;?>'; this.form.submit();" >
					<option value="name"  <? if ($fieldsort=="name") {?> selected="selected" <? }?>>Услуга </option>	                    
					<option value="cost"  <? if ($fieldsort=="cost") {?> selected="selected" <? }?>>Стоимость</option>	  
                                     
                                       
			  </select>  
                                        

    &nbsp;    &nbsp;    &nbsp;                      	
Услуга: 
                
				<input   name="FilterValue1"  onFocus="if (this.value=='Все') this.value=''"  value="<? if ($filter==1)/*есть ли фильтрация данных*/ echo "$value1"; else echo("Все"); ?>" onBlur="checkFilterValue1()"  type="text">

				<br>
				<input  type="button"  name="button1"  onclick="this.form.action='servicing.php?filter=1&sort=<? echo $sort;?>'; this.form.submit();"   value="Фильтр">
				<input  type="button"  name="button2"  onclick="this.form.action='servicing.php?filter=0&sort=<? echo $sort;?>'; this.form.submit();"   value="Очистить">
           <br>            
        </div>   
<?
		 $r=mysql_query($s);
?>
  <input  type="button"  name="button4"   onclick="this.form.action='updservicing.php?upd=0&step=1'; this.form.submit();" value="Добавить">
 <input  type="button"  name="button4" <? if (mysql_num_rows($r)==0) {?>    disabled="disabled"<? }?>   onclick="this.form.action='updservicing.php?upd=1&step=1'; this.form.submit();" value="Редактирование"> 
 <input  type="button"  name="button" <? if (mysql_num_rows($r)==0) {?>    disabled="disabled"<? }?>  onclick="qwest=window.confirm('Вы действительно хотите удалить запись?');  if (qwest) {this.form.action='delservicing.php'; this.form.submit();}" value="Удалить">    

	                    <?

						if ($Mode=="Менеджер")
						{
						?>
 <input  type="button"  name="button"  onClick="this.form.action='reqmng.php'; this.form.submit();"  value="Назад">     			
                        <?
						}
						?>    
                        
                        
                         <? 																
						if ($Mode=="Директор")
						{
						?>                                            
 <input  type="button"  name="button"  onClick="this.form.action='reqdir.php'; this.form.submit();"  value="Назад">     							
                        <?
						}
						?>  
																
                         <? 																
						if ($Mode=="Исполнитель")
						{
						?>                                            
 <input  type="button"  name="button"  onClick="this.form.action='reqwrk.php'; this.form.submit();"  value="Назад">     							
                        <?
						}
						?>  						

                         <? 																
						if ($Mode=="Клиент")
						{
						?>                                            
 <input  type="button"  name="button"  onClick="this.form.action='reqclt.php'; this.form.submit();"  value="Назад">     			
                        <?
						}
						?>  
                        

 
  <table WIDTH=100% border=4  bordercolor="grey" cellspacing=0 cellpadding=3>
									<tr>
		<td  ><font color=white>&nbsp;</font></td>                                      
		<td   align="center" valign="middle"><h5 style="color:#000">Услуга</h5></td>	
		<td   align="center" valign="middle"><h5 style="color:#000">Стоимость</h5></td>	   
             			
               			        
			</tr>
        
        
      <?
		 
	$sum=0;	

			for ($i=0;$i<mysql_num_rows($r);$i++)//вывод данных в цикле по количеству записей
			  {
				$f=mysql_fetch_array($r);//считывание текующей записи				
				echo "<tr>";

		
	if ($i==0)
    echo "<td><input type=radio checked=checked name=Arrservicing[] value=".$f['idservicing']."> </td>";
	else
    echo "<td><input type=radio name=Arrservicing[] value=".$f['idservicing']."> </td>";				
				echo "								
				<td> ".$f['name']."</td>					
				<td> ".$f['cost']."</td>												
				";								
$sum=$sum+	$f['cost'];			
				echo "</tr>";
			  }		 
		?>
    <tr> 
    <td colspan="3" align="right"> 
    Итого: <? echo $sum?>&nbsp;руб &nbsp; Скидка: 10% К оплате: <? $sum=$sum-$sum*0.10; echo ($sum)?>&nbsp;руб Предоплата: <? echo ($sum-$sum*0.70)?>&nbsp;руб
    </td>
    </tr>
  </table> 
</form>	

        </div>
	</div>
	<!-- end #page --> 
</div>

<!-- end #footer -->
</body>
</html>
