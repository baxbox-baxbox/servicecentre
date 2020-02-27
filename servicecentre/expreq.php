<?
require "option.php";//файл с параметрами подключения к БД
$Arr=$_POST['Arrrequest'];
$idrequest=$Arr[0];

$r=mysql_query("SELECT request.*, client.fio as clientfio, worker.fio as workerfio, enterprise, mail, client.phone as clientphone, info, worker.fio as workerfio, post, worker.phone as workerphone FROM client, request LEFT JOIN worker ON request.idworker=worker.idworker where request.idclient=client.idclient and idrequest=$idrequest");
$req=mysql_fetch_array($r);
$name=$req['name'].'.xls';

	header('Content-Description: File Transfer');
    header('Content-Type: application/octet-stream');
    header('Content-Disposition: attachment; filename=' . $name);
    header('Content-Transfer-Encoding: binary');
    header('Expires: 0'); 
    header('Cache-Control: must-revalidate');
    header('Pragma: public');   


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


<br>

<font  size="+1" >   Сведения о заявке: </font> 

                 
                                       
                    
  <table WIDTH=100% border=4  bordercolor="grey" cellspacing=0 cellpadding=3>


                      <tr>
                      <td><font  >   Клиент: </font></td>
                      <td width="240"><?  echo $req['clientfio'];?> </td>
                      </tr>      
                      <tr>
                      <td><font  >   Организация клиента: </font></td>
                      <td width="240"><?  echo $req['enterprise'];?> </td>
                      </tr>
                      <tr>
                      <td><font  >   Телефон клиента: </font></td>
                      <td width="240"><?  echo $req['clientphone'];?> </td>
                      </tr>         
                      <tr>
                      <td><font  >   Реквизиты клиента: </font></td>
                      <td width="240"><?  echo $req['info'];?> </td>
                      </tr>                                                    
                                                          
                    <tr>
                      <td width="172"><font  >   Название заявки: </font> </td>
                      <td width="240"><?  echo $req['name'];?> </td>
                    </tr>  	                                                                                             
              
                      <tr>
                      <td><font  >   Дата заявки: </font></td>
                      <td width="240"><?  echo $req['date'];?> </td>
                      </tr>   

                      <tr>
                      <td><font  >   Сроки заявки: </font></td>
                      <td width="240"><?  echo $req['term'];?> </td>
                      </tr>  
                      <tr>
                      <td><font  >   Исполнитель: </font></td>
                      <td width="240"><?  echo $req['workerfio'];?> </td>
                      </tr>          
                      <tr>
                      <td><font  >   Телефон исполнителя: </font></td>
                      <td width="240"><?  echo $req['workerphone'];?> </td>
                      </tr>
                      <tr>
                      <td><font  >   Права исполнителя: </font></td>
                      <td width="240"><?  echo $req['post'];?> </td>
                      </tr>                                             
                      <tr>
                      <td><font  >   Статус заявки: </font></td>
                      <td width="240"><?  echo $req['status'];?> </td>
                      </tr>            
                      <tr>
                      <td><font  >   Клиент оплатил: </font></td>
                      <td width="240"><?  echo $req['cost'];?> </td>
                      </tr>
                      <tr>
                      <td><font  >   Оплачено: </font></td>
                      <td width="240"><?  echo $req['paid'];?> </td>
                      </tr>                                             
                      <tr>
                      <td><font  >   Описание: </font></td>
                      <td width="240"><?  echo $req['discr'];?> </td>
                      </tr>                                  
                                                                       
                  </table>
<br>
        

                  <?
		 $s="SELECT idservicing, name, cost FROM servicing, service where servicing.idrequest=$idrequest and servicing.idservice=service.idservice ";
				  ?>
      
<font  size="+1" >   Корзина: </font> 
 
  <table WIDTH=100% border=4  bordercolor="grey" cellspacing=0 cellpadding=3>
                   
                    <tr>
                    		<td ><h5>Услуга</h5></td>	   			
		<td ><h5>Клиент оплатил</h5></td>	 
   

                    </tr>
 <?
 $r=mysql_query($s);
 	$sum=0;	
 			for ($i=0;$i<mysql_num_rows($r);$i++)//вывод данных в цикле по количеству записей
			  {
				$f=mysql_fetch_array($r);//считывание текующей записи				
				echo "<tr>";

			
				echo "								
				<td> ".$f['name']."</td>					
				<td> ".$f['cost']."&nbsp; </td>											
				";		
				$sum=$sum+	$f['cost'];								
				echo "</tr>";
			  }		 
		?>                   
    <tr> 
    <td colspan="2" align="right"> 
    Итого: <? echo $sum?>&nbsp;руб &nbsp; Скидка: 10% К оплате: <? echo ($sum-$sum*0.10)?>&nbsp;руб
    </td>
    </tr>                    
                    
                    </table>
		

       

</body>
</html>
