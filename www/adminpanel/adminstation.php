<?php
/*
Данный скрипт разработан Михайленко Виктором Леонидовичем, далее автор.
Любое использование данного скрипта, разрешено только с письменного согласия автора.
Скрипт защещён законом: http://adminstation.ru/images/docs/doc1.jpg
Дата разработки: 14.10.2007 г. - Модернизирован 17.04.2009 г.

-> Главный файл программы AdminStation
*/

include "../cfg.php";
include "../ini.php";
if($status == 1 || $status == 2) {
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1251">
<title>AdminStation || Система управления проектом «<?php print $cfgURL; ?>»</title>
<link href="files/favicon.ico" type="image/x-icon" rel="shortcut icon">
<link href="files/styles.css" rel="stylesheet" type="text/css" />
<script src="files/jquery.js"></script>
<script language="JavaScript">
<!--
function popUP(url,width,height) {
	if(!width) { width = 780; }
	if(!height) { height = 450; }
	var posx = 200;
	var posy = 200;
	var w=window.open(url,'wind','left='+posx+',top='+posy+',width='+width+',height='+height+',status:no, help:no');
	return false;
}
//-->
</script>
</head>
<body>
<table align="center" width="990" height="100%" border="0" cellpadding="0" cellspacing="0">
	<tr height="65">
		<td>
			<table align="center" width="990" height="65" border="0" cellpadding="0" cellspacing="0">
				<tr valign="top">
					<td><a href="adminstation.php"><img src="images/logo.jpg" width="202" height="65" alt="CMS AdminStation" border="0" /></a></td>
					<td width="30"><a href="/" target="_blank"><img src="images/home.gif" width="30" height="48" border="0" alt="Перейти на главную страницу сайта" title="Перейти на главную страницу сайта" /></a></td>
					<td width="10"></td>
					<td width="30"><a href="adminstation.php"><img src="images/stat_menu.gif" width="30" height="48" border="0" alt="Статистика" title="Статистика" /></a></td>
					<td width="10"></td>
					<td width="30"><a href="?a=antivirus"><img src="images/antivirus.gif" width="30" height="48" border="0" alt="Антивирус" title="Антивирус" /></a></td>
					<td width="10"></td>
					<td width="30"><img style="cursor: pointer;" onclick="popUP('http://adminstation.ru/help/index.html',775,450);" src="images/help.gif" width="30" height="48" border="0" alt="Помощь" title="Помощь" /></td>
					<td width="10"></td>
					<td width="30"><img style="cursor: pointer;" onclick="if(confirm('Вы действительно хотите выйти?')) top.location.href='/exit.php';" src="images/exit.gif" width="30" height="48" border="0" alt="Выход" title="Выход" /></td>
				</tr>
			</table>
		</td>
	</tr>
	<tr>
		<td height="1">
			<table class="menu">
				<tr>
					<td width="25%"><a class="menutop" href="?a=news">Добавить новость</a></td>
					<td width="25%"><a class="menutop" href="?a=add_page">Создать страницу</a></td>
					<td width="25%"><a class="menutop" href="?a=pages">Созданные страницы</a></td>
					<td width="25%"><a class="menutop" href="?a=paysystems">Платежные системы</a></td>
				</tr>

				<tr>
					<td><a class="menutop" href="?a=deposits">Депозиты</a></td>
					<td><a class="menutop" href="?a=plans">Инвестиционные планы</a></td>
					<td><a class="menutop" href="?">Реферальные уровни</a></td>
					<td><a class="menutop" href="?a=fake">Накрутка статистики</a></td>
				</tr>
				<tr>
					<td><a class="menutop" href="?a=users">Управление пользователями</a></td>
					<td><a class="menutop" href="?a=mailto">Рассылка пользователям</a></td>
					<td><a class="menutop" href="?a=reftop">Рейтинг рефоводов</a></td>
					<td><a class="menutop" href="?a=change_pass">Сменить пароль</a></td>
				</tr>
				<tr>					
					<td><a class="menutop" href="?a=settings">Настройки проекта</a></td>
					<td><a class="menutop" href="?a=serverinf">Информация о сервере</a></td>
					<td><a class="menutop" href="?a=blacklist">Черный список IP</a></td>
					<td><a class="menutop" href="?a=logip">Мониторинг IP</a></td>
				</tr>
				<tr>					
					<td><a class="menutop" href="?a=accounting">Бухгалтерия</a></td>
					<td><a class="menutop" href="?a=edit&s=2">Пополнение счета</a></td>
					<td><a class="menutop" href="?a=edit">Вывод средств</a></td>
					<td><a class="menutop" href="?a=antivirus">Антивирус</a></td>
				</tr>
			</table>
		</td>
	</tr>
	<tr>
		<td height="5"></td>
	</tr>
	<tr>
		<td valign="top" style="border-radius: 4 4 0 0px; padding: 10 10 10 10px; border: 1px solid #547898; background:URL(images/logo_down.jpg) no-repeat bottom right;">
<?php
$a	= substr(addslashes(htmlspecialchars($_GET['a'], ENT_QUOTES, '')), 0, 15);

	if(!$a) {
		include "modules/index.php";
	} elseif(file_exists("modules/".$a.".php")) {
		include "modules/".$a.".php";
	} else {
		include "modules/error.php";
	}

?>&nbsp;
		</td>
	</tr>
	<tr height="33" bgcolor="#5e87a9">
		<td align="center" style="color: #ffffff;">&copy; 2007-<?php print date(Y); ?> CMS <a style="color: #ffffff;" href="http://adminstation.ru/" target="_blank">AdminStation</a> v4.0<br />
		Все права защищены!</td>
	</tr>
</table>



</body>
</html>
<?php
} else {
print "<html><head><script language=\"javascript\">top.location.href='index.php';</script></head><body><a href=\"index.php\"><b>Index</b></a></body></html>";
}
?>