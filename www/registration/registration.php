<?php
print $body;
defined('ACCESS') or die();
if($_GET['action'] == "save") {
                $ulogin	= htmlspecialchars($_POST['ulogin'], ENT_QUOTES, '');
		$pass	= $_POST['pass'];
		$repass	= $_POST['repass'];
		$email	= htmlspecialchars($_POST['email'], ENT_QUOTES, '');
		$code	= htmlspecialchars($_POST["code"], ENT_QUOTES, '');
		$skype	= htmlspecialchars($_POST["skype"], ENT_QUOTES, '');
		$pm		= htmlspecialchars($_POST["pm"], ENT_QUOTES, '');
		$pe		= htmlspecialchars($_POST["pe"], ENT_QUOTES, '');

		if(!$ulogin || !$pass || !$repass || !$email) {
			//$error = "<center><p class=\"er\"><font color='red'><b>��������� ��� ���� ������������ ��� ����������.</b></font></p></center>";
		} elseif(strlen($ulogin) > 15 || strlen($ulogin) < 3) {
			//$error = "<center><p class=\"er\"><font color='red'><b>����� ������ ��������� �� 3-� �� 15 ��������.</b></font></p></center>";
		} elseif($pass != $repass) {
			//$error = "<center><p class=\"er\"><font color='red'><b>������ �� ���������.</b></font></p></center>";
		} elseif(strlen($email) > 30) {
			//$error = "<center><p class=\"er\"><font color='red'><b>E-mail ������ ��������� �� 30 ��������.</b></font></p></center>";
		} elseif(!mysql_num_rows(mysql_query("SELECT * FROM captcha WHERE sid = '".$sid."' AND ip = '".getip()."' AND code = '".$code."'"))) {
			//$error = "<center><p class=\"er\"><font color='red'><b>������� ��� � �������, �� ���������!</b></font></p></center>";
		} elseif(!preg_match("/^[a-z0-9_.-]{1,20}@(([a-z0-9-]+\.)+(com|net|org|mil|edu|gov|arpa|info|biz|[a-z]{2})|[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3})$/is", $email)) {
			//$error = "<center><p class=\"er\"><font color='red'><b>������� ������� e-mail!</b></font></p></center>";
		} elseif(mysql_num_rows(mysql_query("SELECT login FROM users WHERE login = '".$ulogin."'"))) {
			//$error = "<center><p class=\"er\"><font color='red'><b>����� ����� ��� ���� � ����! �������� ���������� ������.</b></font></p></center>";
		} elseif(mysql_num_rows(mysql_query("SELECT mail FROM users WHERE mail = '".$email."'"))) {
			//$error = "<center><p class=\"er\"><font color='red'><b>����� e-mail ��� ���� � ����!</b></font></p></center>";
		} else {
	                $time	 = time();
			$ip		 = getip();
			$pass	 = as_md5($key, $pass);
			if($referal) { 
				$get_user_info	= mysql_query("SELECT * FROM users WHERE login = '".$referal."' LIMIT 1");
				$row			= mysql_fetch_array($get_user_info);
				$ref_id			= intval($row['id']);
			} else { 
				$ref_id = 0; 
			}

			if(cfgSET('cfgMailConf') == "on") {
				$active		= 1;
				$actlink	= "Your link for activation account: http://".$cfgURL."/activate.php?m=".$email."&h=".as_md5($key, $ulogin.$email);
			} else {
				$active		= 0;
				$actlink	= "";
			}

			$sql = "INSERT INTO users (login, pass, mail, go_time, ip, reg_time, ref, pm, active, skype, pe) VALUES ('".$ulogin."', '".$pass."', '".$email."', ".$time.", '".$ip."', ".$time.", ".$ref_id.", '".$pm."', ".$active.", '".$skype."', '".$pe."')";
			mysql_query($sql);

		
			$error = 1;
		}
}
if($error == 1) {
$ppass = $_POST['pass'];
	print "<center><p class=\"erok\"><div align='center'>Congratulations! You registered. Please write your data!<br><table><tr><td>Your login: <b>$ulogin</b></td></tr><tr><td>Your password: <b>$ppass</b></td></tr><tr><td><a href='/login/'><input value='�����' type='submit' class='button_blue'></a></td></tr></table></p></div>";


$to  = $email; 
$subject = 'Congratulations! You registered ForexUp!'; 
$message = " You have been successfully registered in the system ForexUp! \r\r Your login: $ulogin \r Your password: $ppass \r thank you for registering!\r Login to your personal Cabinet: https://forexup.org/login/";

$subject	 = "Congratulations! You registered ForexUp!";
			$headers = "From: ".$adminmail."\n";
			$headers .= "Reply-to: ".$adminmail."\n";
			$headers .= "X-Sender: < http://".$cfgURL." >\n";
			$headers .= "Content-Type: text/html; charset=windows-1251\n";



	mail($to,$subject,$message,$headers);


} else {
	print $error;
?>
<h1>REGISTERING MORE THAN ONE ACCOUNT IS STRICTLY FORBIDDEN!</h1><form method="post" action="?action=save" name="register_frm"><fieldset><table class="formatTable">				<tbody><tr>							<td><label for="register_frm_uLogin"><span class="descr_req">Think login<span class="descr_star">*</span></span></label></td><td><input name="ulogin" id="register_frm_uLogin" value="" size="20" type="text" class="string_small"> <span id="login_check" class="err"><?php if(mysql_num_rows(mysql_query("SELECT login FROM users WHERE login = '".$ulogin."'")) AND $_GET['action'] == "save" ) {
 echo "This login is already in the database! Please select another."; } ?><?php if (!$ulogin AND $_GET['action'] == "save"){ echo "Please fill this field! "; } ?><?php if(strlen($ulogin) > 15 || strlen($ulogin) < 3 AND $_GET['action'] == "save") { echo "The login must be between 3 to 15 characters."; } ?></span></td></tr>				<tr>							<td><label for="register_frm_uMail"><span class="descr_req">E-mail<span class="descr_star">*</span></span></label></td><td><span class="err"></span><input name="email" id="register_frm_uMail" value="" size="20" type="text" class="string_small"> <span id="mail_check" class="err"><?php if(!preg_match("/^[a-z0-9_.-]{1,20}@(([a-z0-9-]+\.)+(com|net|ru|org|mil|edu|gov|arpa|info|biz|[a-z]{2})|[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3})$/is", $email) AND $_GET['action'] == "save") { echo "Please valid enter E-mail! "; } ?><?php if(mysql_num_rows(mysql_query("SELECT mail FROM users WHERE mail = '".$email."'")) AND $_GET['action'] == "save") {
 echo "This e-mail was already in the system! "; } ?><?php if(strlen($email) > 30 AND $_GET['action'] == "save"){ echo "E-mail should contain up to 30 characters."; } ?><?php if (!$email AND $_GET['action'] == "save"){ echo "Please fill this field!"; } ?></span></td></tr>				<tr>							<td><label for="register_frm_uPass"><span class="descr_req">Think password<span class="descr_star">*</span></span></label></td><td><span class="err"></span><input name="pass" id="register_frm_uPass" value="" size="20" type="password" class="password"><span id="login_check" class="err"><?php if(!$pass AND $_GET['action'] == "save"){ echo "Please fill this field!"; } ?><?php if($pass != $repass AND $_GET['action'] == "save") { echo "The passwords do not match."; } ?></span></td></tr>				<tr>							<td><label for="register_frm_Pass2"><span class="descr_req">Repeat password<span class="descr_star">*</span></span></label></td><td><span class="err"></span><input name="repass" id="register_frm_Pass2" value="" size="20" type="password" class="password"><span id="login_check" class="err"><?php if($pass != $repass AND $_GET['action'] == "save") { echo "The passwords do not match."; } ?><?php if(!$pass AND $_GET['action'] == "save"){ echo "Please fill this field!"; } ?></span></td></tr>				<tr>							


<td>Your invited by</td><td><span class="err"></span><input id="register_frm_uRef" value="<?php if($referal){ echo $referal; } ?>" name="ref" size="20" type="text" class="string_small"></td></tr>		<tr>							<td>PAYEER account</td><td><span class="err"></span><input placeholder="P1234567" id="register_frm_uRef" value="" size="12" type="text" name="pe" class="string_small"></td></tr>		<tr>							<td>Perfect Money account</td><td><span class="err"></span><input id="register_frm_uRef" placeholder='U1234567' value="" size="20" type="text" name="pm" class="string_small"></td></tr>	<tr>							<td>Code from the image <img src="/captcha.php" width="70" height="25" border="0" /></td><td><span class="err"></span><input id="register_frm_uRef" value="" size="20" type="text" name="code" class="string_small"><span id="mail_check" class="err"><?php if(!mysql_num_rows(mysql_query("SELECT * FROM captcha WHERE sid = '".$sid."' AND ip = '".getip()."' AND code = '".$code."'")) AND $_GET['action'] == "save") {
 echo "Entered the code in the picture is don't match!"; } ?></span></td></tr></tbody></table></fieldset><span class="err"></span><br><input name="bitn" value="Registration" type="submit" class="button-blue"></form><?php } ?>