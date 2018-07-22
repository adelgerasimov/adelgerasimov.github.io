<h1>Вход</h1>
<?php


SetCookie("Test","Value");
$login = $_COOKIE['Test'];



if($er) {

	print '<div class="er" style="text-align: left; padding-left: 15px; margin-bottom: 25px;">
	<strong>Не удается войти.</strong><br />
	Пожалуйста, проверьте правильность написания <b>логина</b> и <b>пароля</b>.
	<ul>
		<li>Возможно, нажата клавиша CAPS-LOCK?</li>
		<li>Может быть, у вас включена неправильная <b>раскладка</b>? (русская или английская)</li>
		<li>Попробуйте набрать свой пароль в текстовом редакторе и <b>скопировать</b> в графу «Пароль»</li>
	</ul>
	Если вы всё внимательно проверили, но войти всё равно не удается, вы можете <b><a href="/reminder/">нажать сюда</a></b>.</div>';
}
?>
<div align="center">
<form name='login_frm' method="post" action="/login/">
<fieldset>
<table class="formatTable">
<tbody>
<tr>
<td><label for="login_frm_Login"><span class="descr_req">Логин<span class="descr_star">*</span></span></label></td>
<td><input name="user" placeholder="login" id="login_frm_Login" value="<? echo $login?>" size="20" type="text" class="string_small"></td>
</tr>
<tr>
<td><label for="login_frm_Login"><span class="descr_req">Пароль<span class="descr_star">*</span></span></label></td>
<td><input name="pass" placeholder="password" id="login_frm_Login" value="" size="20" type="text" class="string_small"></td>
</tr>
<tr>
<td><label for="login_frm_Login"><span class="descr_req">Запомнить?<span class="descr_star"></span></span></label></td>
<td><input name="il" id="login_frm_Login" value="1" size="20" type="checkbox" class="string_small"></td>
</tr>
</tbody>
</table>
</fieldset>
<input class="button-blue" type="submit" value="Войти" /></p>
	<Center><p><a href="/registration/">Регистрация</a> - <a href="/reminder/">Забыли пароль?</a></p></center>
</tbody>
</fieldset>
</form>
</div>