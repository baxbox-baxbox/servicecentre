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
     <?
	 $upd=$_REQUEST["upd"];

	 if ($upd==1)
		{
	 $Arr=$_REQUEST["Arrrequest"];
	 $idrequest=$Arr[0];
	 $r=mysql_query("select * from request where  idrequest=$idrequest");
	 $f=mysql_fetch_array($r);
     ?>
   <div  style="font-size:22px; color:#000" align="center">�������������� ������ "<? echo $f['name']?>"</div>
   <?
		}
		else
		{
   ?>
      <div  style="font-size:22px; color:#000" align="center">���������� ������</div>
   <?
		}
   ?>
      <br>  
<?

date_default_timezone_set("Europe/Moscow");
$date=date("Y")."-".date("m")."-".date("d");   
?>
<form name="form2" method="post"  >
				  <table width="526" border="0">
                    <tr>
                      <td width="172"><font color="#000000" >   ��������: </font> </td>
                      <td width="240"><input  readonly  name="name"   type="text"  value="<? if ($upd==1) echo $f['name']; else echo(""); ?>" size="40" ></td>
                    </tr>  	
                    <tr>
                      <td><font color="#000000" >  ����: </font> </td>
                      <td><input  size="8"  readonly name="date"  value="<? if ($upd==1) echo $f['date']; else echo("$date"); ?>"   type="text" ></td>
                    </tr>    
                    <tr>
                      <td><font color="#000000" >  �����: </font> </td>
                      <td><input  size="8" readonly name="term"  value="<? if ($upd==1) echo $f['term']; else echo("$date"); ?>"   type="text" ></td>
                    </tr>                                                                                                                                         

                                 <tr>
                      <td><font color="#000000" >   ������: </font></td>
                      <td>
                 <select  name="status"  style="height:22; width:auto"    >
					<option   value="�� ������������"  <?	if (($upd==1)&& ($f['status']=="�� ������������")) echo "selected"; ?> > �� ������������ </option>	   
                    <option  value="����� �������" <?	if (($upd==1)&& ($f['status']=="����� �������")) echo "selected"; ?> >����� ������� </option>
                    <option  value="����� ��������" <?	if (($upd==1)&& ($f['status']=="����� ��������")) echo "selected"; ?> >����� �������� </option>                         
                    <option  value="�����������" <?	if (($upd==1)&& ($f['status']=="�����������")) echo "selected"; ?> >����������� </option>             	         																				                    
				</select>                    
				      </td> 
                      </tr>   

                
 
                      
                  </table>
<br>
				<input  type="button"  name="button"   onclick="this.form.action='updreqwrk.php?step=2&upd=<? echo"$upd";?>&id=<? echo"$Arr[0]";?>'; this.form.submit();"   value="���������" width="500">
				<input  type="button"  name="button"  onClick="javascript:history.back();"  value="������">

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


	
	
if ($upd==1)
  {  
     $id=$_REQUEST["id"];
	 mysql_query("Update request set status='$status'  WHERE idrequest=$id");
  } 
  
  ?>
	 <script language="javascript">
	 location.href='reqwrk.php?filter=0';
	 </script>
	 <?
}
	?>






