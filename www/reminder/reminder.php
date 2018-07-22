<?php
defined('ACCESS') or die();
function generator($case1, $case2, $case3, $case4, $num1) {
	$password = "";

	$small="abcdefghijklmnopqrstuvwxyz";
	$large="ABCDEFGHIJKLMNOPQRSTUVWXYZ";
	$numbers="1234567890";
	$symbols="~!#$%^&*()_+-=,./<>?|:;@";
	mt_srand((double)microtime()*1000000);

for ($i=0; $i<$num1; $i++) {

		$type = mt_rand(1,4);
		switch ($type) {
		case 1:
			if ($case1 == "on") { $password .= $large[mt_rand(0,25)]; } else { $i--; }
			break;
		case 2:
			if ($case2 == "on") { $password .= $small[mt_rand(0,25)]; } else { $i--; }
			break;
		case 3:
			if ($case3 == "on") { $password .= $numbers[mt_rand(0,9)]; } else { $i--; }
			break;
		case 4:
			if ($case4 == "on") { $password .= $symbols[mt_rand(0,24)]; } else { $i--; }
			break;
		}
	}
	return $password;
}

if(isset($_POST['uemail']) AND isset($_POST['ulogin'])) {
	$email	= htmlspecialchars($_POST['uemail'], ENT_QUOTES, '');
	$ulogin = htmlspecialchars($_POST['ulogin'], ENT_QUOTES, '');
	$code	= htmlspecialchars(str_replace("'","",$_POST["code"]), ENT_QUOTES, '');
	if(!mysql_num_rows(mysql_query("SELECT * FROM captcha WHERE sid = '".$sid."' AND ip = '".getip()."' AND code = '".$code."'"))) {
			print "<p class=\"er\">Не правильно введён код!</b></font></center></p>";
	}  elseif(preg_match("/^[a-z0-9_.-]{1,20}@(([a-z0-9-]+\.)+(ru|com|net|org|mil|edu|gov|arpa|info|biz|[a-z]{2})|[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3})$/is", $email)) {
		$sql	= 'SELECT login, pass, status FROM users WHERE mail = "'.$email.'" AND login = "'.$ulogin.'" LIMIT 1';
		$rs		= mysql_query($sql);
		$a		= mysql_fetch_array($rs);
		$s		= $a['status'];

		if (!$a) {
			print '<p class="er">Введённый Вами e-mail не найден в базе!</p>';
		} else {

			$case1	= on;
			$case2	= on;
			$case3	= on;
			$case4	= off;
			$num1	= 8;
			$num2	= 1;

			$newpass = generator($case1, $case2, $case3, $case4, $num1);

			$text = "<p>Hi! <b>".$a['login']."</b>!</p><p>Please get new text ".$a['login']."<br /><p>New password: <b>".$newpass."</b></p> ".$cfgURL;

			$subject	 = "New password ".$a['login'];
			$headers = "From: ".$adminmail."\n";
			$headers .= "Reply-to: ".$adminmail."\n";
			$headers .= "X-Sender: < http://".$cfgURL." >\n";
			$headers .= "Content-Type: text/html; charset=windows-1251\n";

			mysql_query("UPDATE users SET pass = '".as_md5($key, $newpass)."' WHERE login = '".$a['login']."' LIMIT 1");
			if (mail($email,$subject,$text,$headers)) {
				print '<p class="erok">New password was sended on your E-mail! Letters may fall into the spam folder.</p>';
			} else {
				print '<p class="er">Error!</p>';
			}
		}
	} else {
		print '<p class="er">Please correct E-mail!</p>';
	}
}
?>


<h1>Forgot password</h1><form method="post" action="index.php" name="login_frm"><fieldset><table class="formatTable">				<tbody><tr>							<td><label for="login_frm_Login"><span class="descr_req">Login<span class="descr_star">*</span></span></label></td><td><input name="ulogin" id="login_frm_Login" value="" size="20" type="text" class="string_small"></td></tr><td><label for="login_frm_Login"><span class="descr_req">E-mail<span class="descr_star">*</span></span></label></td><td><input name="uemail" id="login_frm_Login" value="" size="20" type="text" class="string_small"></td></tr>				<tr>										<td><label for="login_frm_Pass"><span class="descr_req">Code from image <img src="/captcha.php" width="70" height="25" border="0"><span class="descr_star"></span></span></label></td><td><input name="code" id="login_frm_Pass" value="" size="20" type="text" class="password"></td></tr>								</tbody></table></fieldset><input name="grgr" value="e08373d6" type="hidden"><br><input name="gtt" value="Remind" type="submit" class="button-blue"></form><br>