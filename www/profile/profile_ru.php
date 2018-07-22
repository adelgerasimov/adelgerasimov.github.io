<h1>Настройки профиля</h1>
<?php
defined('ACCESS') or die();
if ($login) {
	if ($_GET['action'] == 'save') {
		$get_user_info = mysql_query("SELECT pe FROM users WHERE id = ".$user_id." LIMIT 1");
		$row = mysql_fetch_array($get_user_info);
		$upe		= $_POST['pe'];

		$pass_1 = $_POST['pass_1'];
		$pass_2 = $_POST['pass_2'];
		$email	= addslashes(htmlspecialchars($_POST['email'], ENT_QUOTES, ''));
		$icq	= addslashes(htmlspecialchars($_POST['icq'], ENT_QUOTES, ''));
		$pm		= addslashes(htmlspecialchars($_POST['pm'], ENT_QUOTES, ''));
		$pe		= addslashes(htmlspecialchars($_POST['pe'], ENT_QUOTES, ''));
		$skype	= addslashes(htmlspecialchars($_POST['skype'], ENT_QUOTES, ''));

		//if($upm) { $pm = $upm; } 
		//if($upe) { $pe = $upe; } 

		if (!$email) {
			echo '<p class="er">Следует ввести E-mail!</p>';
		} else {
			if ($pass_1 != $pass_2) {
				echo '<p class="er">Пароль и подтверждение не совпадают!</p>';
			} else {
				if (!preg_match("/^[a-z0-9_.-]{1,20}@(([a-z0-9-]+\.)+(com|net|org|mil|edu|gov|arpa|info|biz|[a-z]{2})|[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3})$/is", $email)) {
					print '<center><p class="er">Введите правильно e-mail!</p></center>';
				} elseif (strlen($pm) != 9 && $pm) {
					print '<center><p class="er">Введите корректный PM кошелёк!</p></center>';
				} elseif ($pm[0] != 'U' && $pm) {
					print '<center><p class="er">Введите корректный PM кошелёк!</p></center>';
				} elseif(mysql_num_rows(mysql_query("SELECT pm FROM users WHERE pm = '".$pm."' AND id != ".$user_id)) && $pm) {
					print "<center><p class=\"er\">Такой PM уже есть в базе!</p></center>";
				} elseif(mysql_num_rows(mysql_query("SELECT mail FROM users WHERE mail = '".$email."' AND id != ".$user_id))) {
					print "<center><p class=\"er\">Такой e-mail уже есть в базе!</p></center>";
				} else {
					$sql = 'UPDATE users SET ';
					if($pass_1) { $sql .= 'pass = "'.as_md5($key, $pass_1).'", '; }

					$sql .= 'mail = "'.$email.'", icq = "'.$icq.'", pm = "'.$pm.'", pe = "'.$pe.'", skype = "'.$skype.'" WHERE id = '.$user_id.' LIMIT 1';
					if (mysql_query($sql)) {
						print '<center><p class="erok">Данные были успешно обновлены!</p></center>';
					} else {
						print '<center><p class="er">Не удаётся изменить данные!</p></center>';
					}
			}
		}
	}
}

$sql	= 'SELECT * FROM users WHERE login = "'.$login.'" LIMIT 1';
$rs		= mysql_query($sql);
$a		= mysql_fetch_array($rs);
?>
<form method="post" action="?action=save" name="balance/wallets_frm"><fieldset><table class="formatTable"> 							<tbody><?php if(cfgSET('cfgPEsid') && cfgSET('cfgPEkey')) {	?><tr><th colspan="2" align="center"><hr><a name="PAYEER"></a>- PAYEER -</th></tr>				<tr>							<td><label for="">Account number</label></td><td><input name="pe" id="balance/wallets_frm_PM[acc]" value="<?php print $a['pe']; ?>" size="20" type="text" class="string_small">&nbsp;<small>[P12345678]</small></td></tr> 	<?php } ?>					<?php if($cfgPerfect) { ?>	<tr><th colspan="2" align="center"><hr><a name="PM"></a>- PerfectMoney -</th></tr>				<tr>							<td><label for="balance/wallets_frm_PY[acc]">Account number</label></td><td><input name="pm" id="balance/wallets_frm_PY[acc]" value="<?php print $a['pm']; ?>" size="20" type="text" class="string_small">&nbsp;<small>[U12345678]</small></td></tr> <?php } ?>							<tr><th colspan="2" align="center"><hr><a name="email"></a>- E-MAIL -</th></tr>				<tr>							<td><label for="balance/wallets_frm_EP[acc]">E-MAIL Adress</label></td><td><input name="email" id="balance/wallets_frm_EP[acc]" value="<?php print $a['mail']; ?>" size="20" type="text" class="string_small">&nbsp;<small>[sample@domain.zn]</small></td></tr> 							<tr><th colspan="2" align="center"><hr><a name="changepass"></a>- Изменение пароля -</th></tr>				<tr>							<td><label for="balance/wallets_frm_BC[acc]">Новый пароль</label></td><td><input name="pass_1" id="balance/wallets_frm_BC[acc]" value="" size="20" type="text" class="string_small"></td></tr> 							<tr><th colspan="2" align="center"><hr><a name="pass_2"></a></th></tr>				<tr>							<td><label for="balance/wallets_frm_OK[acc]">Повтор пароля</label></td><td><input name="pass_2" id="balance/wallets_frm_OK[acc]" value="" size="20" type="text" class="string_small">&nbsp;<small></small></td></tr> 							</tbody></table></fieldset><input name="aaa" value="acba65a0" type="hidden"><br><input name="balance/wallets_frm_btn" value="Сохранить" type="submit" class="button-blue"></form>
<?php
} else {
	print "<center><p class=\"er\">Вы должны быть авторизованным для доступа к этой странице!</p></center>";
}
?>