<?php
defined('ACCESS') or die();
if($_GET['action'] == "edit") {

	$fakeusers			= intval($_POST['fakeusers']);
	$fakeactiveusers	= intval($_POST['fakeactiveusers']);
	$fakeonline			= intval($_POST['fakeonline']);
	$fakedeposits		= sprintf("%01.2f", $_POST['fakedeposits']);
	$fakewithdraws		= sprintf("%01.2f", $_POST['fakewithdraws']);
$zi = time();
        $fakeenterlogin = $_POST['fakeenterlogin'];
        $fakeentersum = $_POST['fakeentersum'];
$imxo = rand(111111, 999999);
        if ( $fakeenterlogin == "" ){ }else{ mysql_query("INSERT INTO enter VALUES ('$imxo', '$fakeenterlogin', '$fakeentersum', '$zi', '2', 'non', 'non', 'non')"); }

        $fakewithlogin = $_POST['fakewithlogin'];
        $fakewithsum = $_POST['fakewithsum'];

        if ( $fakewithlogin == "" ){ }else{ mysql_query("INSERT INTO output VALUES ('$imxo', '$fakewithlogin', '$fakewithsum', 'non', 'non', '$zi', '2')"); }

	mysql_query('UPDATE `settings` SET `data` = "'.$fakeusers.'" WHERE cfgname = "fakeusers" LIMIT 1');
	mysql_query('UPDATE `settings` SET `data` = "'.$fakeactiveusers.'" WHERE cfgname = "fakeactiveusers" LIMIT 1');
	mysql_query('UPDATE `settings` SET `data` = "'.$fakeonline.'" WHERE cfgname = "fakeonline" LIMIT 1');

	print '<p class="erok">������ ���������!</p>';

}

?>
<FIELDSET style="border: solid #666666 1px; padding: 10px;">
<LEGEND><b>�������� ���������� *:</b></LEGEND>
<form action="?a=fake&action=edit" method="post">
<table align="center" width="612" border="0" cellpadding="3" cellspacing="0" style="border: solid #cccccc 1px;">
<tr bgcolor="#dddddd">
	<td><b>�������� �������� �������������</b>:</td>
	<td align="right"><input style="width: 280px;" type="text" name="fakeusers" size="70" maxlength="30" value="<?php print cfgSET('fakeusers'); ?>" /></td>
</tr>
<tr bgcolor="#eeeeee">
	<td><b>�������� �������� �������������</b>:</td>
	<td align="right"><input style="width: 280px;" type="text" name="fakeactiveusers" size="70" maxlength="30" value="<?php print cfgSET('fakeactiveusers'); ?>" /></td>
</tr>
<tr bgcolor="#dddddd">
	<td><b>�������� ������������� ������</b>:</td>
	<td align="right"><input style="width: 280px;" type="text" name="fakeonline" size="70" maxlength="30" value="<?php print cfgSET('fakeonline'); ?>" /></td>
</tr>
<tr bgcolor="#dddddd">
	<td><b>�������� ����� � ����������</b> **:</td>
	<td align="right"><input style="width: 200px;" type="text" name="fakeenterlogin" size="70" maxlength="30" value="" /></td>
        <td align="right"><input style="width: 75px;" type="text" name="fakeentersum" placeholder='�����' size="70" maxlength="30" value="" /></td>
</tr>
<tr bgcolor="#dddddd">
	<td><b>�������� ����� � ������</b> **:</td>
	<td align="right"><input style="width: 200px;" type="text" name="fakewithlogin" size="70" maxlength="30" value="" /></td>
        <td align="right"><input style="width: 75px;" type="text" name="fakewithsum" placeholder='�����' size="70" maxlength="30" value="" /></td>
</tr>

</table>
<table align="center" width="624" border="0">
	<tr>
		<td align="right"><input type="image" src="images/save.gif" width="28" height="29" border="0" title="���������!" /></td>
	</tr>
</table>
</form>
</FIELDSET>
<p>* ������ ����� ����� ����������� � ��������� ������������</p>
<p>* �� ������ ��� �������� � ����� ������ �������, ��� � ��������� �. ��� ���������� �����, ������� ����� ������ ������ "-" (�����)</p>