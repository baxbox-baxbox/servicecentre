<?
require "option.php";//���� � ����������� ����������� � ��

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
     <?
	 $r=mysql_query("select * from request where  idrequest=$idrequest ");
	 $f=mysql_fetch_array($r);
	
     ?>
   <div  style="font-size:22px; color:#000" align="center">������ ������ "<? echo $f['name']?>"</div>
      <br>  


 <form name="form2"  method="post"  >
 
   <?

		$filter=$_GET["filter"];//���������� ��������� �������
		$sort=$_GET["sort"];//���������� ��������� �������		


	
if ($filter==1)/*���� �� ���������� ������*/
{

 
$value1 = $_POST['FilterValue1'];//�������� ������� ����
$s="SELECT idservicing, name, cost FROM servicing, service where servicing.idrequest=$idrequest and servicing.idservice=service.idservice and name";
if ($value1!="���")
$s=$s." LIKE '%$value1"."%' COLLATE cp1251_general_ci";
Else
$s=$s."=name ";

}
else
		 $s="SELECT idservicing, name, cost FROM servicing, service where servicing.idrequest=$idrequest and servicing.idservice=service.idservice ";

if ($sort==1)/*���� �� ���������� ������*/
{
$fieldsort = $_POST['sortname'];//������ ����
$s=$s." order by $fieldsort";
}


	 ?>
         
     		<div align="right">	
����������:
				<select name="sortname"  style="height:22; width:auto" onChange="this.form.action='servicing.php?sort=1&filter=<? echo $filter;?>'; this.form.submit();" >
					<option value="name"  <? if ($fieldsort=="name") {?> selected="selected" <? }?>>������ </option>	                    
					<option value="cost"  <? if ($fieldsort=="cost") {?> selected="selected" <? }?>>���������</option>	  
                                     
                                       
			  </select>  
                                        

    &nbsp;    &nbsp;    &nbsp;                      	
������: 
                
				<input   name="FilterValue1"  onFocus="if (this.value=='���') this.value=''"  value="<? if ($filter==1)/*���� �� ���������� ������*/ echo "$value1"; else echo("���"); ?>" onBlur="checkFilterValue1()"  type="text">

				<br>
				<input  type="button"  name="button1"  onclick="this.form.action='servicing.php?filter=1&sort=<? echo $sort;?>'; this.form.submit();"   value="������">
				<input  type="button"  name="button2"  onclick="this.form.action='servicing.php?filter=0&sort=<? echo $sort;?>'; this.form.submit();"   value="��������">
           <br>            
        </div>   
<?
		 $r=mysql_query($s);
?>
  <input  type="button"  name="button4"   onclick="this.form.action='updservicing.php?upd=0&step=1'; this.form.submit();" value="��������">
 <input  type="button"  name="button4" <? if (mysql_num_rows($r)==0) {?>    disabled="disabled"<? }?>   onclick="this.form.action='updservicing.php?upd=1&step=1'; this.form.submit();" value="��������������"> 
 <input  type="button"  name="button" <? if (mysql_num_rows($r)==0) {?>    disabled="disabled"<? }?>  onclick="qwest=window.confirm('�� ������������� ������ ������� ������?');  if (qwest) {this.form.action='delservicing.php'; this.form.submit();}" value="�������">    

	                    <?

						if ($Mode=="��������")
						{
						?>
 <input  type="button"  name="button"  onClick="this.form.action='reqmng.php'; this.form.submit();"  value="�����">     			
                        <?
						}
						?>    
                        
                        
                         <? 																
						if ($Mode=="��������")
						{
						?>                                            
 <input  type="button"  name="button"  onClick="this.form.action='reqdir.php'; this.form.submit();"  value="�����">     							
                        <?
						}
						?>  
																
                         <? 																
						if ($Mode=="�����������")
						{
						?>                                            
 <input  type="button"  name="button"  onClick="this.form.action='reqwrk.php'; this.form.submit();"  value="�����">     							
                        <?
						}
						?>  						

                         <? 																
						if ($Mode=="������")
						{
						?>                                            
 <input  type="button"  name="button"  onClick="this.form.action='reqclt.php'; this.form.submit();"  value="�����">     			
                        <?
						}
						?>  
                        

 
  <table WIDTH=100% border=4  bordercolor="grey" cellspacing=0 cellpadding=3>
									<tr>
		<td  ><font color=white>&nbsp;</font></td>                                      
		<td   align="center" valign="middle"><h5 style="color:#000">������</h5></td>	
		<td   align="center" valign="middle"><h5 style="color:#000">���������</h5></td>	   
             			
               			        
			</tr>
        
        
      <?
		 
	$sum=0;	

			for ($i=0;$i<mysql_num_rows($r);$i++)//����� ������ � ����� �� ���������� �������
			  {
				$f=mysql_fetch_array($r);//���������� �������� ������				
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
    �����: <? echo $sum?>&nbsp;��� &nbsp; ������: 10% � ������: <? $sum=$sum-$sum*0.10; echo ($sum)?>&nbsp;��� ����������: <? echo ($sum-$sum*0.70)?>&nbsp;���
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
