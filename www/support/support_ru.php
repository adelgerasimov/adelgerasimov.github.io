<?php

defined('ACCESS') or die();
print $body;

	if(isset($_POST['iks'])) {
		$name		= htmlspecialchars(str_replace("'","",substr($_POST['name'],0,50)));
		$mail		= htmlspecialchars(str_replace("'","",substr($_POST['mail'],0,50)));
		$subj		= htmlspecialchars(str_replace("'","",substr($_POST['topic'],0,100)));
		$textform	= htmlspecialchars(str_replace("'","",substr($_POST['message'],0,10240)));
		$code		= htmlspecialchars(str_replace("'","",substr($_POST['code'],0,5)));

		    if(!$name) {
				print "<p class=\"er\">������� ���������� ���� ���!</p>";
		}
		elseif(!$mail) {
				print "<p class=\"er\">������� ���������� ��� e-mail!</p>";
		}
		elseif(!$subj) {
				print "<p class=\"er\">������� ���������� ���� ������ ���������!</p>";
		}
		elseif(!$textform) {
				print "<p class=\"er\">������� ���������� ����� ������ ���������!</p>";
		}
		elseif(!preg_match("/^[a-z0-9_.-]{1,20}@(([a-z0-9-]+\.)+(com|net|org|mil|edu|gov|arpa|info|biz|[a-z]{2})|[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3})$/is",$mail)) {
				print "<p class=\"er\">������� ���������� ��� e-mail �������!</p>";
		} elseif(!mysql_num_rows(mysql_query("SELECT * FROM captcha WHERE sid = '".$sid."' AND ip = '".getip()."' AND code = '".$code."'"))) {
			print "<p class=\"er\">�� ��������� ����� ���!</b></font></center></p>";
		} else {


$subjec = $subj;
$subject = iconv('windows-1251', 'utf-8', $subjec);

$message = "��� ������ � ������� $np, �� $name - ����������� $mail, ����� ������ ���������: $textform";

$headers  = "Content-type: text/html; charset=windows-1251 \r\n"; 
$headers .= "From: $np <robot@$np.com>\r\n"; 
$headers .= "Bcc: robot2@$np.com\r\n"; 

$send = mail($to, $subject, $message, $headers); 

			if(!$send) {
				print "<p class=\"er\">������ ��������� �������!<br />�������� ��������� �� ��������������� ����������.</p>";
			} else {

				print "<p class=\"erok\">���� ��������� ����������!</p>";

				$name		= "";
				$mail		= "";
				$subj		= "";
				$textform	= "";
			}
		}
	}
?>

<h1>������ � ���������</h1><div class="support_page"><form method="post" action="" name="message/support_frm"><fieldset><table class="formatTable">				<tbody><tr>							<td><label for="message/support_frm_Mail"><span class="descr_req">��� e-mail<span class="descr_star">*</span> <span class="descr_rem">(��� �����)</span></span><input name="mail" id="message/support_frm_Mail" value="" size="50" type="text" class="string_small"></label></td></tr>		<tr><td><label for="message/support_frm_Mail"><span class="descr_req">��� � ��� ����������?<span class="descr_star">*</span> <span class="descr_rem"></span></span><input name="name" id="message/support_frm_Mail" value="" size="50" type="text" class="string_small"></label></td>		<tr>							<td colspan="2"><label for="message/support_frm_Topic"><span class="descr_req">����<span class="descr_star">*</span></span></label><br><input name="topic" id="message/support_frm_Topic" value="" size="50" type="text" class="string"><br></td></tr>				<tr>							<td colspan="2"><label for="message/support_frm_Message"><span class="descr_req">�����<span class="descr_star">*</span></span></label><br><textarea name="message" id="message/support_frm_Message" cols="60" rows="6" wrap="off" class="text"></textarea><br></td></tr><tr>							<td><label for="message/support_frm_Mail"><span class="descr_req">��� � ��������<span class="descr_star">*</span> <span class="descr_rem"><img src="/captcha.php" width="70" height="25" border="0" alt="������� ��� ����������� �� �������" /></span></span><input name="code" id="message/support_frm_Mail" value="" size="50" type="text" class="string_small"></label></td></tr></tbody></table></fieldset><input name="__Cert" value="f028ad61" type="hidden"><br><input name="iks" value="���������" type="submit" class="button-blue"></form></div>