<?php
$Mode=$_COOKIE["Mode"];  
$idrequest=$_COOKIE["idrequest"]; 
$idclient=$_COOKIE["idclient"];  
$fio=$_COOKIE["fio"];  
$idworker=$_COOKIE["idworker"];  
$dblocation = "localhost";
$dbname = "servicecentre";
$dbuser = "root";
$dbpasswd = "";
$dbcnx = @mysql_connect($dblocation,$dbuser,$dbpasswd);

if (!$dbcnx) 
{
  echo( "<P>¬ насто€щий момент сервер базы данных не доступен, поэтому корректное отображение страницы невозможно.</P>" );
  exit();
}
if (!@mysql_select_db($dbname, $dbcnx)) 
{
  echo( "<P>¬ насто€щий момент сервер базы данных не доступен, поэтому корректное отображение страницы невозможно.</P>" );
  exit();
}
	mysql_set_charset("cp1251", $dbcnx);

?>
