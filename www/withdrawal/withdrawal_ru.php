<?php
defined('ACCESS') or die();
if ($login) {

	$sql	= 'SELECT `pe`, `pm`, `pm_balance`, `ref` FROM `users` WHERE `id` = '.$user_id.' LIMIT 1';
	$rs		= mysql_query($sql);
	$r		= mysql_fetch_array($rs);






	$depos	= 'SELECT * FROM `deposits` WHERE `user_id` = '.$user_id.' LIMIT 1';
	$dep		= mysql_query($depos);
	$de		= mysql_fetch_array($dep);
	$dd=$de['user_id'];



	if($_GET['cancel']) {
			$sql2	= 'SELECT * FROM `output` WHERE `id` = '.intval($_GET['cancel']).' AND status = 0 AND login = "'.$login.'" LIMIT 1';
			$rs2	= mysql_query($sql2);
			$r2		= mysql_fetch_array($rs2);

			if($r2['sum']) {

				if($cfgPercentOut) {
					$sum = sprintf("%01.2f", $r2['sum'] + ($r2['sum'] / (100 - $cfgPercentOut) * $cfgPercentOut));
				} else {
					$sum = $r2['sum'];
				}

				mysql_query('UPDATE `users` SET pm_balance = pm_balance + '.$sum.' WHERE id = '.$user_id.' LIMIT 1');
				mysql_query('UPDATE `output` SET status = 6 WHERE id = '.intval($_GET['cancel']).' LIMIT 1');
				print '<center><p class="erok">������ ��������, �������� ���������� �� ������</p></center>';
			} else {
				print '<center><p class="er">���������� �������� ������</p></center>';
			}
	}

	if ($_GET['action'] == 'save') {
		$sum	= sprintf ("%01.2f", str_replace(',', '.', $_POST['sum']));
		$ps		= intval($_POST['ps']);
		$purse	= htmlspecialchars($_POST['purse'], ENT_QUOTES, '');

                if(!$purse) {
			$purse = $r['pm'];
		}
				if(!$purse) {
			$purse = $r['pe'];
		}
		
		
		///��� �� ������� �������///
		$min_insert = "1.99"; /* ����������� ����� �������� ��� ������� ������������ ����� ������� ������.
		                         (���� �� ������ ����� ��� ����� ���� 5 000, �� ������ �������� �������,
								 ���������� 4 999.99(����� �����). */
		
//		$counted_one = mysql_query("SELECT sum FROM enter WHERE login='$login' AND status='2'");
		$counted_one = mysql_query("SELECT sum FROM enter WHERE login='$login' ");
		$history_insert = 2;
		while( $counted_two = mysql_fetch_row($counted_one) ){
		  $history_insert+=$counted_two[0];
		}
		////////////////////////////

		if ($sum <= 0) {
			print '<center><p class="er">������� ���������� ����� (�� $'.$cfgMinOut.' �� $'.cfgSET('cfgMaxOut').')!</p></center>';
		} elseif ($sum < $cfgMinOut || $sum > cfgSET('cfgMaxOut')) {
			print '<center><p class="er">�� ���� ��� ��������� �������� �� $'.$cfgMinOut.' �� $'.cfgSET('cfgMaxOut').'!</p></center>';
		} elseif ($r['pm_balance'] < $sum) {
			print '<center><p class="er">� ��� ��� ������� ����� �� �����!</p></center>';
		//		} elseif(cfgSET('cfgCountOut') != 0 && cfgSET('cfgCountOut') <= mysql_num_rows(mysql_query("SELECT * FROM output WHERE login = '".$login."' AND (status = 2 OR status = 0)"))) {
               //	print '<center><p class="er">�� �� ������� ��������� ���� ����� ������ �� ����� �������. ���������� ���������� ������.</p></center>';	
               } elseif($ps < 1) {
			print '<center><p class="er">������� ��������� �������! ����� ����� ������� � ����� �������.</p></center>';
               } elseif(!$purse) {
					print '<center><p class="er">������� ����� �����</p>';
		} elseif($history_insert <= $min_insert) {
		    $error_log = true;
		} else {

			$minus = $sum;

			if($cfgPercentOut) {
				$sum = sprintf("%01.2f", $sum - $sum / 100 * $cfgPercentOut);
			}

			$sql	= 'UPDATE `users` SET pm_balance = pm_balance - '.$minus.' WHERE id = '.$user_id.' LIMIT 1';
			mysql_query($sql);

			if(($cfgAutoPay == "on" && $ps == 1) || (cfgSET('cfgAutoPayPE') == "on" && $ps == 2)) { 
				$st	= 2; 
			} else { 
				$st = 0; 


			}

			if($ps == 1) { $purse = $r['pm']; }
			if($ps == 2) { $purse = $r['pe']; }

			$sql = 'INSERT INTO `output` (`sum`, `date`, `login`, `paysys`, `purse`, `status`) VALUES("'.$sum.'", "'.time().'", "'.$login.'", '.$ps.', "'.$purse.'", '.$st.')';

			if (mysql_query($sql)) {

					$lid = mysql_insert_id();

					// �����������
						if($ps == 1 && $cfgAutoPay == "on") {
							$f = fopen('https://perfectmoney.com/acct/confirm.asp?AccountID='.$cfgPMID.'&PassPhrase='.$cfgPMpass.'&Payer_Account='.$cfgPerfect.'&Payee_Account='.$purse.'&Amount='.$sum.'&PAY_IN=1&PAYMENT_ID='.$lid.'&Memo='.$cfgURL, 'rb');

							if($f===false){
								mysql_query('UPDATE `users` SET pm_balance = pm_balance + '.$minus.' WHERE id = '.$user_id.' LIMIT 1');
								mysql_query('UPDATE `output` SET status = 6 WHERE id = '.$lid.' LIMIT 1');

								print '<center><p class="er">���������� �������� ���� PerfectMoney. ���������� ���������� �����.</p></center>';
							} else {
								// getting data
								$out=array(); $out="";
								while(!feof($f)) $out.=fgets($f);

								fclose($f);

								// searching for hidden fields
								if(!preg_match_all("/<input name='(.*)' type='hidden' value='(.*)'>/", $out, $result, PREG_SET_ORDER)){

									mysql_query('UPDATE `users` SET pm_balance = pm_balance + '.$minus.' WHERE id = '.$user_id.' LIMIT 1');
									mysql_query('UPDATE `output` SET status = 6 WHERE id = '.$lid.' LIMIT 1');

									print '<center><p class="er">������� �������� �� ������� Perfect Money</p></center>';

								}
							}

						} elseif($ps == 2 && cfgSET('cfgAutoPayPE') == "on") {

							require_once('../includes/cpayeer.php');
							$accountNumber	= cfgSET('cfgPEAcc');
							$apiId			= cfgSET('cfgPEidAPI');
							$apiKey			= cfgSET('cfgPEapiKey');
							$payeer = new CPayeer($accountNumber, $apiId, $apiKey);
							if ($payeer->isAuth()) {
								$arTransfer = $payeer->transfer(array(
								'curIn' => 'USD',	// ���� �������� 
								'sum' => $sum,		// ����� ��������� 
								'curOut' => 'USD',	// ������ ���������  
								'to' => $purse,		// ����������
								'comment' => 'API '.$cfgURL,
							));

								if(!empty($arTransfer["historyId"])) {
									print "<center><p class=\"erok\">������� �".$arTransfer["historyId"]." ������� ��������</p></center>";
								} else {
									mysql_query('UPDATE `output` SET status = 0 WHERE id = '.$lid.' LIMIT 1');
									print '<center><p class=\"er\">������! ������ ����� ��������� � ������ ������</p></center>';		
								}
							} else {
								mysql_query('UPDATE `output` SET status = 0 WHERE id = '.$lid.' LIMIT 1');
								print "<center><p class=\"er\">������! ������ ����� ��������� � ������ ������.</p></center>";
							}

						}

					print '<center><p class="erok">���� ������ ���������� � ���������!</p></center>';

			} else {
				print '<center><p class="er">�� ������ ��������� ������ �� ������ �����!</p></center>';
			}
		}
	}
	?>
<script language="JavaScript">
<!--
	function CheBal() {

		document.getElementById("sum").value = "<?php print $r['pm_balance']; ?>"

		if(document.getElementById('ps').value == 1) {
			document.getElementById("purse").value = '<?php print $r['pm']; ?>';
			document.getElementById("purse").disabled = true;
		} else if(document.getElementById('ps').value == 2) {
			document.getElementById("purse").value = '<?php print $r['pe']; ?>';
			document.getElementById("purse").disabled = true;
		} else {
			document.getElementById("purse").value = '';
			document.getElementById("purse").disabled = false;
		}
	}
//-->
</script>





















<h1>����� �������</h1>




<?

if($dd>0)
{
?>




<br>
<center>


<?php if ( $error_log == true ){ ?>
<br>
<font size="4" color="red">���-�� ����� �� ���...</font>
<br>
<?php } ?>

</center>
<br>

<font>��� ������ <?php echo $pmbalance; ?> <b>$</b></font>
	<form method="post" action="?action=save" name="add"><fieldset><table class="formatTable">									<input name="Oper" id="add_Oper" value="CASHOUT" type="hidden">				<tbody><tr>							<td><label for="add_PSys"><span class="descr_req">�� ��������� �������<span class="descr_star">*</span></span></label></td><td><select name="ps" id="add_PSys" onChange="CheBal();" class="select">

<?php


if($r['pm']) {
	print '<option value="1">PerfectMoney</option>';
}
if($r['pe']) {
	print '<option value="2">Payeer</option>';
}


$result	= mysql_query("SELECT * FROM `paysystems` WHERE id != 1 ORDER BY id ASC");
while($row = mysql_fetch_array($result)) {

}
?>




</select><font size='2'>�����: ������� ���� ��������� � ��������� �������, ��� �������� ������ ��������� ������ ��� ������.</font></td></tr>				<tr>							<td><label for="add_Sum"><span class="descr_req">����� $<span class="descr_star">*</span></span></label></td><td><input name="sum" id="add_Sum" value="" size="10" type="text" class="float"> <i><span id="ccurr"></span></i></td></tr></tbody></table></fieldset><input name="__Cert" value="0eea8f1e" type="hidden"><br><input name="add_btn" value="������� ������" type="submit" class="button-blue"></form>
</tbody></table>





<?
}
else
{
	?>
	<center>
	<span style="font-family: 'arial black', 'avant garde'; font-size: medium;"><span style="color: #333333;">����� ����� �������� ������ ����� �������� ��������.</span><p></p>
	</center>
	<br><br>
	<?
}

?>





<h1>������� �������</h1>
<table class="formatTable">
<tbody>
<tr>
<td colspan='5'>

<table class="FormatTable" border="1">
<tbody>
<tr><th>#</th><th>����</th><th>�����</th><th>����</th><th>���</th><th>������</th></tr>
<?php
                $result = mysql_query("SELECT * FROM output WHERE login='$login'");
                if ( mysql_num_rows($result) == 0 ){ echo "<td colspan='0' align='center'>������� ����� ������� �����!</td>"; }
		while ($row = mysql_fetch_array($result)) {
?>
<tr>
<td colspan="0" align="center"><?php echo $row['id']; ?></td>
<td colspan="0" align="center"><?php echo date("d.m.Y H:i", $row['date']); ?></td>
<td colspan="0" align="center"><?php echo $row['sum']; ?> $</td>
<td colspan="0" align="center"><?php echo $row['purse']; ?></td>
<td colspan="0" align="center"><?php echo $row['paysys']; ?></td>
<td colspan="0" align="center">
		<?php if($row['status'] == 0) {
			print '<span class="tool"><span class="tip"><b>������ ��������� � ���������.</b></span></span>';
		} elseif($row['status'] == 2) {
			print '<span class="tool"><span class="tip"><b>������ ���������!</b></span></span>';
		} elseif($row['status'] == 6) {
			print '<span class="tool"><span class="tip"><b>������ ��������.</b></span></span>';
		} else {
			print '<span class="tool"><span class="tip"><b>������ ���������!</b></span></span>';
		} ?>
</td>

</tr>
<?php } ?>
</tbody>
</table>

</td>
</tr>
</tbody>
</table>


<?php } else {
	print "<center><p class=\"er\">�� ������ ���� �������������� ��� ������� � ���� ��������!</p></center>";
}
?>