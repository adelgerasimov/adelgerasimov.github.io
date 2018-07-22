<h1>Login</h1>
<?php
if($er) {
	print '<div class="er" style="text-align: left; padding-left: 15px; margin-bottom: 25px;">
	<strong>Unable to enter.</strong><br />
	Please check the spelling of your <b>login</b> è <b>password</b>.
	<ul>
		<li>Perhaps you press CAPS-LOCK?</li>
		<li>Maybe you have enabled the wrong keyboard <b>layout</b>? (russian or english)</li>
		<li>Try typing your password in a text editor and <b>copy</b> in the column "Password".</li>
	</ul>
	If you have checked everything carefully, but still enter fails, you can <b><a href="/reminder/">click here</a></b>.</div>';
}
?>
<div align="center">
<form name='login_frm' method="post" action="/login/">
<fieldset>
<table class="formatTable">
<tbody>
<tr>
<td><label for="login_frm_Login"><span class="descr_req">Login<span class="descr_star">*</span></span></label></td>
<td><input name="user" placeholder="login" id="login_frm_Login" value="" size="20" type="text" class="string_small"></td>
</tr>
<tr>
<td><label for="login_frm_Login"><span class="descr_req">Password<span class="descr_star">*</span></span></label></td>
<td><input name="pass" placeholder="password" id="login_frm_Login" value="" size="20" type="text" class="string_small"></td>
</tr>
<tr>
<td><label for="login_frm_Login"><span class="descr_req">Remember?<span class="descr_star"></span></span></label></td>
<td><input name="il" id="login_frm_Login" value="1" size="20" type="checkbox" class="string_small"></td>
</tr>
</tbody>
</table>
</fieldset>
<input class="button-blue" type="submit" value="Login" /></p>
	<Center><p><a href="/registration/">Sign up</a> - <a href="/reminder/">Forgot password?</a></p></center>
</tbody>
</fieldset>
</form>
</div>