<?
require "option.php";//���� � ����������� ����������� � ��
date_default_timezone_set("Europe/Moscow");
$date=date("Y")."-".date("m")."-".date("d");   

	header('Content-Description: File Transfer');
    header('Content-Type: application/octet-stream');
    header('Content-Disposition: attachment; filename=������ �� '.$date.'.xls');
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
<title>��������� �����</title>
<link href="style.css" rel="stylesheet" type="text/css" media="screen" />
</head>
<body>


<br>

  <?

		$filter=$_REQUEST["filter"];//���������� ��������� �������
		$sort=$_REQUEST["sort"];//���������� ��������� �������		



if ($filter==0)/*���� �� ���������� ������*/
{
date_default_timezone_set("Europe/Moscow");
$date1=(date("Y")-1)."-".date("m")."-".date("d");    
$date2=(date("Y")+1)."-".date("m")."-".date("d");    
}
	
if ($filter==1)/*���� �� ���������� ������*/
{
$date1=$_POST['date1'];    
$date2=$_POST['date2'];    
 
$fieldfind = $_POST['findname'];//������ ����
$value1 = $_POST['FilterValue1'];//�������� ������� ����
$s="SELECT request.*, client.fio as clientfio, worker.fio as workerfio FROM client, request LEFT JOIN worker ON request.idworker=worker.idworker where request.idclient=client.idclient and $fieldfind" ;
if ($value1!="���")
$s=$s." LIKE '%$value1"."%' COLLATE cp1251_general_ci ";
Else
$s=$s."=$fieldfind ";

$s=$s." and date>='$date1' and date<='$date2' ";
}
else
		 $s="SELECT request.*, client.fio as clientfio, worker.fio as workerfio FROM client, request LEFT JOIN worker ON request.idworker=worker.idworker where request.idclient=client.idclient ";

if ($sort==1)/*���� �� ���������� ������*/
{
$fieldsort = $_POST['sortname'];//������ ����
$s=$s." order by $fieldsort";
}


 $r=mysql_query($s);

	 ?>
     
<font  size="+1" >   ��������� ������ �� <? echo $date;?>  </font> 

 
                 
  <table WIDTH=100% border=4  bordercolor="grey" cellspacing=0 cellpadding=3>
									<tr>
                          
		<td   align="center" valign="middle"><h5 style="color:#000">��������</h5></td> 
		<td   align="center" valign="middle"><h5 style="color:#000">������</h5></td>     
		<td   align="center" valign="middle"><h5 style="color:#000">����</h5></td>	  
		<td   align="center" valign="middle"><h5 style="color:#000">�����</h5></td>	                   
		<td   align="center" valign="middle"><h5 style="color:#000">������</h5></td>
		<td   align="center" valign="middle"><h5 style="color:#000">�����������</h5></td>                
		<td   align="center" valign="middle"><h5 style="color:#000">������ �������</h5></td>	                   
		<td   align="center" valign="middle"><h5 style="color:#000">��������</h5></td>
		<td   align="center" valign="middle"><h5 style="color:#000">��������</h5></td> 
                                       			        
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
				echo "<td> ".$f['cost']."</td>";
				echo "<td> ".$f['paid']." </td>";
				echo "<td> ".$f['discr']." </td>";													
				echo "</tr>";
			  }		 
		?>
      
  </table> 

       

</body>
</html>
