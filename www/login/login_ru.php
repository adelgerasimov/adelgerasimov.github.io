<h1>����</h1>
<?php


SetCookie("Test","Value");
$login = $_COOKIE['Test'];



if($er) {

	print '<div class="er" style="text-align: left; padding-left: 15px; margin-bottom: 25px;">
	<strong>�� ������� �����.</strong><br />
	����������, ��������� ������������ ��������� <b>������</b> � <b>������</b>.
	<ul>
		<li>��������, ������ ������� CAPS-LOCK?</li>
		<li>����� ����, � ��� �������� ������������ <b>���������</b>? (������� ��� ����������)</li>
		<li>���������� ������� ���� ������ � ��������� ��������� � <b>�����������</b> � ����� ��������</li>
	</ul>
	���� �� �� ����������� ���������, �� ����� �� ����� �� �������, �� ������ <b><a href="/reminder/">������ ����</a></b>.</div>';
}
?>
<div align="center">
<form name='login_frm' method="post" action="/login/">
<fieldset>
<table class="formatTable">
<tbody>
<tr>
<td><label for="login_frm_Login"><span class="descr_req">�����<span class="descr_star">*</span></span></label></td>
<td><input name="user" placeholder="login" id="login_frm_Login" value="<? echo $login?>" size="20" type="text" class="string_small"></td>
</tr>
<tr>
<td><label for="login_frm_Login"><span class="descr_req">������<span class="descr_star">*</span></span></label></td>
<td><input name="pass" placeholder="password" id="login_frm_Login" value="" size="20" type="text" class="string_small"></td>
</tr>
<tr>
<td><label for="login_frm_Login"><span class="descr_req">���������?<span class="descr_star"></span></span></label></td>
<td><input name="il" id="login_frm_Login" value="1" size="20" type="checkbox" class="string_small"></td>
</tr>
</tbody>
</table>
</fieldset>
<input class="button-blue" type="submit" value="�����" /></p>
	<Center><p><a href="/registration/">�����������</a> - <a href="/reminder/">������ ������?</a></p></center>
</tbody>
</fieldset>
</form>
</div>