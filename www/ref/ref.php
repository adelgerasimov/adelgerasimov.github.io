<?php
defined('ACCESS') or die();
if($login) {

	print $body;

	$get_user_info = mysql_query("SELECT ref, ref_money FROM users WHERE id = ".$user_id." LIMIT 1");
	$row = mysql_fetch_array($get_user_info);
	 $ref			= $row['ref'];
	 $ref_money		= $row['ref_money'];	

	if($ref) {

		$get_user_info2	= mysql_query("SELECT login FROM users WHERE id = ".$ref." LIMIT 1");
		$row2 			= mysql_fetch_array($get_user_info2);
		 $uplogin	= $row2['login'];

		print "<p>Your Upline: <b>".$uplogin."</b>;</p>";

	}
?>
<h1>Your affiliate link</h1>
<table width="100%">
	<tr align="center">
		<td><input type="text" name="refurl" style="width: 100%;" value="https://<?php print $cfgURL; ?>/?ref=<?php print $login; ?>" /></td>
	</tr>
</table>
<br>
<a href="https://<?php print $cfgURL; ?>/?ref=<?php print $login; ?>" "target="_blank"><img src="https://forexup.org/img/fuen-100.gif" border="0" title=""></a>
<textarea name="allowed_ip" style="width:100%;" rows="3" class="f_textarea"><a href="https://<?php print $cfgURL; ?>/?ref=<?php print $login; ?>" "target=_blank"><img src="https://forexup.org/img/fuen-100.gif" border="0"></a>
</textarea><br>

<br>
<a href="https://<?php print $cfgURL; ?>/?ref=<?php print $login; ?>" "target="_blank"><img src="https://forexup.org/img/fuen-125.gif" border="0" title=""></a>
<textarea name="allowed_ip" style="width:100%;" rows="3" class="f_textarea"><a href="https://<?php print $cfgURL; ?>/?ref=<?php print $login; ?>" "target=_blank"><img src="https://forexup.org/img/fuen-125.gif" border="0"></a>
</textarea><br>

<br>
<a href="https://<?php print $cfgURL; ?>/?ref=<?php print $login; ?>" "target="_blank"><img src="https://forexup.org/img/fuen-200.gif" border="0" title=""></a>
<textarea name="allowed_ip" style="width:100%;" rows="3" class="f_textarea"><a href="https://<?php print $cfgURL; ?>/?ref=<?php print $login; ?>" "target=_blank"><img src="https://forexup.org/img/fuen-200.gif" border="0"></a>
</textarea><br>

<br>
<a href="https://<?php print $cfgURL; ?>/?ref=<?php print $login; ?>" "target="_blank"><img src="https://forexup.org/img/fuen-468.gif" border="0" title=""></a>
<textarea name="allowed_ip" style="width:100%;" rows="3" class="f_textarea"><a href="https://<?php print $cfgURL; ?>/?ref=<?php print $login; ?>" "target=_blank"><img src="https://forexup.org/img/fuen-468.gif" border="0"></a>
</textarea><br>

<br>
<a href="https://<?php print $cfgURL; ?>/?ref=<?php print $login; ?>" "target="_blank"><img src="https://forexup.org/img/fuen-728.gif" border="0" title=""></a>
<textarea name="allowed_ip" style="width:100%;" rows="3" class="f_textarea"><a href="https://<?php print $cfgURL; ?>/?ref=<?php print $login; ?>" "target=_blank"><img src="https://forexup.org/img/fuen-728.gif" border="0"></a>
</textarea><br>
<hr color="#cccccc" size="2"><br><br>
<h1>Your referrals</h1>
<table width="100%" border="0" cellpadding="2" cellspacing="1" bgcolor="#eeeeee">
<tr align="center" bgcolor="#00aad2">
	<td width="50" style="padding: 3px;"><b style='color: #ffffff;'>#</b></td>
	<td align="left"><b style='color: #ffffff;'>Login:</b></td>
	<td width="150"><b style='color: #ffffff;'>Income $:</b></td>
</tr>
<?php

function PrintRef($refid, $i, $c) {

	$sql	= 'SELECT id, login, ref_money FROM users WHERE ref = '.$refid;
	$rs		= mysql_query($sql);
		$n 	= 1;
		while($a = mysql_fetch_array($rs)) {

			if($i == 1) {

				print "<tr bgcolor=\"#ffffff\" align=\"center\"><td>".$n."</td><td align=\"left\">".$a['login']."</font></td><td>".$a['ref_money']."</td></tr>";

				if($i <= $c) {
					PrintRef($a['id'], intval($i + 1), $c);
				}

			} else {

				print "<tr bgcolor=\"#ffffff\" align=\"center\"><td></td><td align=\"left\" style=\"padding-left: ".$i."0px;\"><font color=\"#999999\">» ".$a['login']."</font></td><td>-</td></tr>";

				if($i <= $c) {
					PrintRef($a['id'], intval($i + 1), $c);
				}

			}
		$n++;
		}
		
}

	$countlvl = mysql_num_rows(mysql_query("SELECT * FROM reflevels"));

	PrintRef($user_id, 1, $countlvl);

	$sql	= 'SELECT login, ref_money FROM users WHERE ref = '.$user_id;
	$rs		= mysql_query($sql);

	if(mysql_num_rows($rs)) {

		$m = 0;
		while($a = mysql_fetch_array($rs)) {
			$m = $m + $a['ref_money'];
		}

		print "<tr align=\"center\" bgcolor=\"#dddddd\"><td align=\"right\" colspan=\"2\" style=\"padding: 3px;\"><b>Total:</b></td><td><b>".sprintf("%01.2f", $m)."</b></td></tr>";

	} else {
		print "<tr bgcolor=\"#ffffff\"><td colspan=\"3\" align=\"center\">You have not invited anyone!</td></tr>";
	}

print '</table>';

} else {
	print '<center><p class="er">You must login to access this page</p></center>';
}
?>