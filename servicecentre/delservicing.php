 	<?
require "option.php";//файл с параметрами подключения к БД
phpinfo(32);
$Arr=$_POST['Arrservicing'];
$id=$Arr[0];
mysql_query("DELETE FROM servicing  WHERE idservicing=$id");

?>
 <script language="javascript">
 location.href='servicing.php';
 </script>
