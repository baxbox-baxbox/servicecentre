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



 <form name="form2"  method="post"  >
 
 <?
 		 $s="select * from worker";
		 $r=mysql_query($s);
 ?>
       
   <div  style="font-size:22px; color:#000" align="center">������������</div>
      <br>  
 <input  type="button"  name="button4"   onclick="this.form.action='upduser.php?upd=0&step=1'; this.form.submit();" value="��������">
 <input  type="button"  name="button4" <? if (mysql_num_rows($r)==0) {?>    disabled="disabled"<? }?>   onclick="this.form.action='upduser.php?upd=1&step=1'; this.form.submit();" value="��������������"> 
<input  type="button"  name="button" <? if (mysql_num_rows($r)==0) {?>    disabled="disabled"<? }?>  onclick="qwest=window.confirm('�� ������������� ������ ������� ������?');  if (qwest) {this.form.action='delworker.php'; this.form.submit();}" value="�������">
  <table WIDTH=100% border=4  bordercolor="grey" cellspacing=0 cellpadding=3>
									<tr>
		<td  ><font color=white>&nbsp;</font></td>                                    
		<td   align="center" valign="middle"><h5 style="color:#000">���</h5></td>				
		<td   align="center" valign="middle"><h5 style="color:#000">�������</h5></td>			
		<td   align="center" valign="middle"><h5 style="color:#000">�����</h5></td>	
		<td   align="center" valign="middle"><h5 style="color:#000">������</h5></td>	        				
		<td   align="center" valign="middle"><h5 style="color:#000">�����</h5></td>	        				        
		
		</tr>
        
        
        <?


			for ($i=0;$i<mysql_num_rows($r);$i++)//����� ������ � ����� �� ���������� �������
			  {
				$f=mysql_fetch_array($r);//���������� �������� ������				
				echo "<tr>";

			
	if ($i==0)
    echo "<td><input type=radio checked=checked name=Arr[] value=".$f ['idworker']."> </td>";
	else
    echo "<td><input type=radio name=Arr[] value=".$f ['idworker']."> </td>";				
				echo "
				<td> ".$f['fio']."&nbsp; </td>
				<td> ".$f['phone']."&nbsp; </td>	
				<td> ".$f['login']."&nbsp; </td>					
				<td> ".$f['parol']."&nbsp; </td>	
				<td> ".$f['post']."&nbsp; </td>";			
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
