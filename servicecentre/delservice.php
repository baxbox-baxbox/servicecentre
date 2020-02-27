 	<?
require "option.php";

$Arr=$_POST['Arr'];
$id=$Arr[0];
mysql_query("DELETE FROM service  WHERE idservice=$id");

?>
 <script language="javascript">
 location.href='service.php';
 </script>
