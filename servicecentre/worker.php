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
   <div  style="font-size:22px; color:#000" align="center">Сведения о Исполнителье</div>
      <br>  


<br>
<?

$Arr=$_REQUEST["Arrrequest"];
//phpinfo(32);
$r=mysql_query("select * from worker, request where request.idworker=worker.idworker and request.idrequest=$Arr[0]");

$f=mysql_fetch_array($r);//считывание текующей записи




  
  
      
	  
?>
 <br> 
<form name="form2" method="post"  >
				  <table width="526" border="0">
                    <tr>
                      <td><font color="#000000" >   ФИО: </font> </td>
                      <td><input  readonly name="fio"   type="text"  value="<? echo $f['fio'] ?>"  ></td>
                    </tr>  	          
                    <tr>
                      <td><font color="#000000" >   Телефон: </font> </td>
                      <td><input readonly name="phone"   type="text"  value="<? echo $f['phone'] ?>"  ></td>
                    </tr>  	                                                                                     
  
                  
                                 <tr>
                      <td><font color="#000000" >   Права: </font></td>

                     <td><input readonly  name="post"  value="<? echo $f['post'] ?>"   type="text" ></td>           

                      </tr>   
                      
                  </table>
<br>
				<input  type="button"  name="button"  onClick="javascript:history.back();"  value="Назад">

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

