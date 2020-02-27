	<?
require "option.php";
phpinfo(32);
$Arr=$_POST['Arr'];
$id=$Arr[0];
mysql_query("DELETE FROM worker  WHERE idworker=$id");

?>
 <script language="javascript">
 location.href='user.php';
 </script>
