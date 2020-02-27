 <?
require "option.php";
?>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1251">
<?
$Arr=$_POST['Arrrequest'];
$id=$Arr[0];
mysql_query("DELETE FROM request  WHERE idrequest=$id");

		
if ($Mode=="Клиент")
{

?>
 <script language="javascript">
 location.href='reqclt.php';
 </script>
<?
}
if ($Mode=="Менеджер")
{
?>
 <script language="javascript">
 location.href='reqmng.php';
 </script>
<?
}

?>