<?php

defined('ACCESS') or die();
print $body;

	if(isset($_POST['message/support_frm_btn'])) {
		$name		= htmlspecialchars(str_replace("'","",substr($_POST['name'],0,50)));
		$mail		= htmlspecialchars(str_replace("'","",substr($_POST['mail'],0,50)));
		$subj		= htmlspecialchars(str_replace("'","",substr($_POST['topic'],0,100)));
		$textform	= htmlspecialchars(str_replace("'","",substr($_POST['message'],0,10240)));
		$code		= htmlspecialchars(str_replace("'","",substr($_POST['code'],0,5)));

		    if(!$name) {
				print "<p class=\"er\">Please enter your name!</p>";
		}
		elseif(!$mail) {
				print "<p class=\"er\">Please enter your E-mail!</p>";
		}
		elseif(!$subj) {
				print "<p class=\"er\">Please enter subject your mail!</p>";
		}
		elseif(!$textform) {
				print "<p class=\"er\">Please enter text your mail!</p>";
		}
		elseif(!preg_match("/^[a-z0-9_.-]{1,20}@(([a-z0-9-]+\.)+(ru|com|net|org|mil|edu|gov|arpa|info|biz|[a-z]{2})|[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3})$/is",$mail)) {
				print "<p class=\"er\">Please enter correct mail!</p>";
		} elseif(!mysql_num_rows(mysql_query("SELECT * FROM captcha WHERE sid = '".$sid."' AND ip = '".getip()."' AND code = '".$code."'"))) {
			print "<p class=\"er\">Code not valid!</b></font></center></p>";
		} else {


$subjec = $subj;
$subject = iconv('windows-1251', 'utf-8', $subjec);

$message = "¬ам письмо с проекта ForexUP, от $name - отправитель $mail, текст письма следующий: $textform";

$headers  = "Content-type: text/html; charset=windows-1251 \r\n"; 
$headers .= "From: <robot@fxup.org>\r\n"; 
$headers .= "Bcc: robot2@fxup.org\r\n"; 

$send = mail($to, $subject, $message, $headers); 

			if(!$send) {
				print "<center><p class=\"er\">Error mail server!<br />Please sorry.</p></center>";
			} else {

				print "<center><p class=\"erok\">Your mail is sended!</center>";

				$name		= "";
				$mail		= "";
				$subj		= "";
				$textform	= "";
			}
		}
	}
?>

<h1>SUPPORT</h1><div class="support_page"><form method="post" action="" name="message/support_frm"><fieldset><table class="formatTable">				<tbody><tr>							<td><label for="message/support_frm_Mail"><span class="descr_req">Your E-Mail<span class="descr_star">*</span> <span class="descr_rem">(for contact)</span></span><input name="mail" id="message/support_frm_Mail" value="" size="50" type="text" class="string_small"></label></td></tr>		<tr><td><label for="message/support_frm_Mail"><span class="descr_req">Your name?<span class="descr_star">*</span> <span class="descr_rem"></span></span><input name="name" id="message/support_frm_Mail" value="" size="50" type="text" class="string_small"></label></td>		<tr>							<td colspan="2"><label for="message/support_frm_Topic"><span class="descr_req">Subject<span class="descr_star">*</span></span></label><br><input name="topic" id="message/support_frm_Topic" value="" size="50" type="text" class="string"><br></td></tr>				<tr>							<td colspan="2"><label for="message/support_frm_Message"><span class="descr_req">Text<span class="descr_star">*</span></span></label><br><textarea name="message" id="message/support_frm_Message" cols="60" rows="6" wrap="off" class="text"></textarea><br></td></tr><tr>							<td><label for="message/support_frm_Mail"><span class="descr_req">Code<span class="descr_star">*</span> <span class="descr_rem"><img src="/captcha.php" width="70" height="25" border="0" alt="¬ведите код изображЄнный на рисунке" /></span></span><input name="code" id="message/support_frm_Mail" value="" size="50" type="text" class="string_small"></label></td></tr></tbody></table></fieldset><input name="__Cert" value="f028ad61" type="hidden"><br><input name="message/support_frm_btn" value="Send" type="submit" class="button-blue"></form></div>