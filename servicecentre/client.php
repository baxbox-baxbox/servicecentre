<?
require "option.php";//���� � ����������� ����������� � ��
?>
<html >
<head>
<meta name="keywords" content="" />
<meta name="description" content="" />
<meta http-equiv="content-type" content="text/html; charset=windows-1251" />
<title>��������� �����</title>
<link href="style.css" rel="stylesheet" type="text/css" media="screen" />
</head>
<body>
<div id="wrapper">
	<div id="header-wrapper1">
 			<div id="logo">
				<a href="project.php"> <img src="images/����.jpg" width="120" height="100"> </a>
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
   <div  style="font-size:22px; color:#000" align="center">�������� � �������</div>
      <br>  


<br>
<?

$Arr=$_REQUEST["Arrrequest"];
//phpinfo(32);
$r=mysql_query("select * from client, request where request.idclient=client.idclient and request.idrequest=$Arr[0]");

$f=mysql_fetch_array($r);//���������� �������� ������




  
  
      
	  
?>
 <br> 
<form name="form2" method="post"  >
				  <table width="526" border="0">
                    <tr>
                      <td><font color="#000000" >   �����������: </font> </td>
                      <td><input  readonly name="enterprise"   type="text"  value="<? echo $f['enterprise'] ?>"  ></td>
                    </tr>  	                   
                    <tr>
                      <td><font color="#000000" >   ���: </font> </td>
                      <td><input  readonly name="fio"   type="text"  value="<? echo $f['fio'] ?>"  ></td>
                    </tr>  	          
                    <tr>
                      <td><font color="#000000" >   �������: </font> </td>
                      <td><input readonly name="phone"   type="text"  value="<? echo $f['phone'] ?>"  ></td>
                    </tr>  	                                                                                     

                                      
                                 <tr>
                      <td><font color="#000000" >   ���������: </font></td>

                     <td><input readonly  name="info"  value="<? echo $f['info'] ?>"   type="text" ></td>           

                      </tr>   
                      
                  </table>
<br>
<?
 $s="SELECT request.*, client.fio as clientfio, worker.fio as workerfio FROM client, request LEFT JOIN worker ON request.idworker=worker.idworker where request.idclient=client.idclient and request.idclient=".$f['idclient']." order by date";
  $r=mysql_query($s);
 ?>
<font color="#000000" >������� �������� � ��������:</font>
<br>

   <table WIDTH=100% border=4  bordercolor="grey" cellspacing=0 cellpadding=3>
									<tr>
                             
		<td   align="center" valign="middle"><h5 style="color:#000">��������</h5></td> 
		<td   align="center" valign="middle"><h5 style="color:#000">������</h5></td>     
		<td   align="center" valign="middle"><h5 style="color:#000">����</h5></td>	  
		<td   align="center" valign="middle"><h5 style="color:#000">�����</h5></td>	                   
		<td   align="center" valign="middle"><h5 style="color:#000">������</h5></td>
		<td   align="center" valign="middle"><h5 style="color:#000">�����������</h5></td>                

                                       			        
			</tr>
        
        
      <?
		 
		

			for ($i=0;$i<mysql_num_rows($r);$i++)//����� ������ � ����� �� ���������� �������
			  {
				$f=mysql_fetch_array($r);//���������� �������� ������				
				echo "<tr>";
	
				echo "
				<td> ".$f['name']."</td>
				<td> ".$f['clientfio']."</td>				

				<td> ".$f['date']."</td>													
				<td> ".$f['term']."</td>
				<td> ".$f['status']."</td>";

				if 	($f['workerfio']==null)																	
					echo "<td>�� ��������</td>";
				else
					echo "<td> ".$f['workerfio']."</td>";
											
				echo "</tr>";
			  }		 
		?>
      
  </table> 
  <br>
				<input  type="button"  name="button"  onClick="javascript:history.back();"  value="�����">

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

