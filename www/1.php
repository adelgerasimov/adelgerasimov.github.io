<?
session_start();
echo '1 - '.$_SESSION['ddd'];
$_SESSION['ddd']='�������� ���������';
echo '2 - '.$_SESSION['ddd'];
?>