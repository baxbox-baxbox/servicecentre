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
   <div  style="font-size:22px; color:#000" align="center">������ ������o� (����� ���������)</div>
      <br>  


 <form name="form2"  method="post"  >
 
   <?

		$filter=$_GET["filter"];//���������� ��������� �������
		$sort=$_GET["sort"];//���������� ��������� �������		



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



	 ?>
         
     		<div align="right">	
����������:
				<select name="sortname"  style="height:22; width:auto" onChange="this.form.action='reqdir.php?sort=1&filter=<? echo $filter;?>'; this.form.submit();" >
					<option value="name"  <? if ($fieldsort=="name") {?> selected="selected" <? }?>>�������� </option>	
					<option value="clientfio"  <? if ($fieldsort=="clientfio") {?> selected="selected" <? }?>>������ </option>	
					<option value="date"  <? if ($fieldsort=="date") {?> selected="selected" <? }?>>����</option>	  
					<option value="term"  <? if ($fieldsort=="term") {?> selected="selected" <? }?>>�����</option>	                      
					<option value="status"  <? if ($fieldsort=="status") {?> selected="selected" <? }?>>������ </option>	
					<option value="workerfio"  <? if ($fieldsort=="workerfio") {?> selected="selected" <? }?>>����������� </option>	                    
					<option value="cost"  <? if ($fieldsort=="cost") {?> selected="selected" <? }?>>������ �������</option>	                      
					<option value="paid"  <? if ($fieldsort=="paid") {?> selected="selected" <? }?>>�������� </option>	
					<option value="discr"  <? if ($fieldsort=="discr") {?> selected="selected" <? }?>>�������� </option>	            
                                        
                                      
                                       
			  </select>  
        &nbsp;    &nbsp;    &nbsp;                              
            �:
				<input   name="date1"  value="<? echo "$date1";?>"   size="10" type="text">
            ��:
                <input   name="date2"   type="text"  value="<? echo "$date2";?>" size="10">
                                        

    &nbsp;                        	
�� ���� 
 &nbsp;  
				<select name="findname"  style="height:22; width:auto"  >
					<option value="name"  <? if ($fieldfind=="name") {?> selected="selected" <? }?>>�������� </option>	              
					<option value="status"  <? if ($fieldfind=="status") {?> selected="selected" <? }?>>������ </option>	 
					<option value="paid"  <? if ($fieldfind=="paid") {?> selected="selected" <? }?>>�������� </option>	                                                       
			  </select>  
                
				<input   name="FilterValue1"  onFocus="if (this.value=='���') this.value=''"  value="<? if ($filter==1)/*���� �� ���������� ������*/ echo "$value1"; else echo("���"); ?>" onBlur="checkFilterValue1()"  type="text">

				<br>
				<input  type="button"  name="button1"  onclick="this.form.action='reqdir.php?filter=1&sort=<? echo $sort;?>'; this.form.submit();"   value="������">
				<input  type="button"  name="button2"  onclick="this.form.action='reqdir.php?filter=0&sort=<? echo $sort;?>'; this.form.submit();"   value="��������">
           <br>            
        </div>   
<?
 $r=mysql_query($s);
?>
<input  type="button"  name="button3" <? if (mysql_num_rows($r)==0) {?>    disabled="disabled"<? }?>   onclick="this.form.action='client.php'; this.form.submit();" value="���������� � �������">
<input  type="button"  name="button3" <? if (mysql_num_rows($r)==0) {?>    disabled="disabled"<? }?>   onclick="this.form.action='worker.php'; this.form.submit();" value="���������� � �����������">
<input  type="button"  name="button4" <? if (mysql_num_rows($r)==0) {?>    disabled="disabled"<? }?>   onclick="this.form.action='expreq.php'; this.form.submit();" value="������ ������"> 
    <input  type="button"  name="button4" <? if (mysql_num_rows($r)==0) {?>    disabled="disabled"<? }?>   onclick="this.form.action='explst.php?sort=<? echo $sort;?>&filter=<? echo $filter;?>'; this.form.submit();" value="������ ���������">

  <table WIDTH=100% border=4  bordercolor="grey" cellspacing=0 cellpadding=3>
									<tr>
		<td  ><font color=white>&nbsp;</font></td> 
		<td   align="center" valign="middle"><h5 style="color:#000">�����</h5></td>                                            
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
				if ($f['status']=="�� ������������")	echo "<tr bgcolor=LightCoral>";
				if ($f['status']=="����� �������")	echo "<tr >";
				if ($f['status']=="����� ��������")	echo "<tr bgcolor=LimeGreen>";
				if ($f['status']=="�����������" )	echo "<tr bgcolor=DeepSkyBlue>";	

			
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

</form>	

        </div>
	</div>
	<!-- end #page --> 
</div>

<!-- end #footer -->
</body>
</html>
