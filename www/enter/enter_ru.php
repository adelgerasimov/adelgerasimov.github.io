
<?php
defined('ACCESS') or die();
if ($login) {

	if($_GET['pay'] == "no") {
		print '<p class="er">�� ������� ��������� ������</p>';
	}
		if($_GET['pay'] == "yeska") {
		print '<p class="er">������ ��������!</p>';
	}

	if($_GET['conf']) {

		print '<p class="erok">���� ������ ���������� ��������������� �� ��������</p>';

		$conf		= intval($_GET['conf']);
		$purse		= addslashes(htmlspecialchars($_POST["purse"], ENT_QUOTES, ''));

		mysql_query("UPDATE enter SET status = 1, purse = '".$purse."' WHERE id = ".$conf." LIMIT 1");

	} elseif ($_GET['action'] == 'save') {
		$sum	= sprintf ("%01.2f", str_replace(',', '.', $_POST['sum']));
		$ps		= intval($_POST['PSys']);

		if ($sum <= 0) {
			print '<p class="er">������� ���������� ����� (�� $0.10 �� $10 000)!</p>';
		} elseif ($sum < 0.10 || $sum > 10000) {
			print '<p class="er">�� ���� ��� ��������� �������� �� $0.10 �� $10 000!</p>';
		} elseif($ps < 1) {
			print '<p class="er">������� ��������� �������!</p>';
		} else {

				// ����� ����������
					if($ps == 1) {

					// PM

					$sql = 'INSERT INTO enter (sum, date, login, paysys, service) VALUES ('.$sum.', '.time().', "'.$login.'", "PerfectMoney", "bal")';
					mysql_query($sql);
					$lid = mysql_insert_id();

					if(cfgSET('cfgSSL') == "on") {
						$http = "https";
					} else {
						$http = "http";
					}

					print '<h1>������������� �������</h1>
					<form action="https://perfectmoney.is/api/step1.asp" method="POST">
					<input type="hidden" name="PAYEE_ACCOUNT" value="'.$cfgPerfect.'">
					<input type="hidden" name="PAYEE_NAME" value="'.$cfgPAYEE_NAME.'">
					<input type="hidden" name="PAYMENT_ID" value="'.$lid.'">
					<input type="hidden" name="PAYMENT_AMOUNT" value="'.$sum.'">
					<input type="hidden" name="PAYMENT_UNITS" value="USD">
					<input type="hidden" name="STATUS_URL" value="'.$http.'://'.$cfgURL.'/pmresult.php">
					<input type="hidden" name="PAYMENT_URL" value="'.$http.'://'.$cfgURL.'/deposit/?pay=yes">
					<input type="hidden" name="PAYMENT_URL_METHOD" value="POST">
					<input type="hidden" name="NOPAYMENT_URL" value="'.$http.'://'.$cfgURL.'/enter/?pay=no">
					<input type="hidden" name="NOPAYMENT_URL_METHOD" value="POST">
					<input type="hidden" name="BAGGAGE_FIELDS" value="">
					<input type="hidden" name="SUGGESTED_MEMO" value="'.$cfgURL.'">
					<center>
					�� ���������� <strong>'.$sum.'</strong> USD �� ���� <strong>'.$cfgPerfect.'</strong> PerfectMoney<br />���������� ������� �� ����� '.$cfgURL.'<br />
					<p align="center"><input class="subm" name="PAYMENT_METHOD" type="submit" value="�����������" /></p>
					</center>
					</form>';

					} else {


					$get_ps	= mysql_query("SELECT * FROM paysystems WHERE id = ".intval($ps)." LIMIT 1");
					$rowps	= mysql_fetch_array($get_ps);

					$sum2 = sprintf("%01.2f", $sum * $rowps['percent']);

					$sql = 'INSERT INTO enter (sum, date, login, paysys, service) VALUES ('.$sum.', '.time().', "'.$login.'", "'.$rowps['name'].'", "bal")';

						if(mysql_query($sql)) {

						$m_orderid = mysql_insert_id();

							if($rowps['name'] == "PAYEER.com") {

								$desc = base64_encode($cfgURL);

								$cu = 'USD';

								$cid	= cfgSET('cfgPEsid');
								$m_key	= cfgSET('cfgPEkey');

								$arHash = array(
									$cid,
									$m_orderid,
									$sum,
									$cu,
									$desc,
									$m_key
								);

								$sign = strtoupper(hash('sha256', implode(":", $arHash)));

								print '<h1>������������� �������</h1>
								<form method="GET" action="//payeer.com/api/merchant/m.php" accept-charset="utf-8">
								<input type="hidden" name="m_shop" value="'.$cid.'">
								<input type="hidden" name="m_orderid" value="'.$m_orderid.'">
								<input type="hidden" name="m_amount" value="'.$sum.'">
								<input type="hidden" name="m_curr" value="USD">
								<input type="hidden" name="m_desc" value="'.$desc.'">
								<input type="hidden" name="m_sign" value="'.$sign.'">

								<center>
								�� ���������� <strong>'.$sum.'</strong> USD<br />���������� ������� �� ����� '.$cfgURL.'<br /><br />
								<p align="center"><input class="subm" type="submit" name="m_process" value="�����������" /></p>
								</center>
								</form>';

							} else {

								print '<h1>������������� �������</h1>
								<form method="POST" action="?conf='.$m_orderid.'">
								<center>��� ���������� ��������� <b>'.$sum2.'</b> '.$rowps['abr'].' �� ���� <b>'.$rowps['purse'].'</b> � ���������� � �������, ������� ��� �����: <b>'.$login.'</b>.  ����� ������, ������� ��� ����� �����, � �������� �� ��������� ������ � ����� ���� � ������� ������ ������������� �������.

								<input type="text" name="purse" size="20" />
								<br /><br />
								<p align="center"><input class="subm" type="submit" value="� �������� ������" /></p>
								</center>
								</form>';
							}

						} else {
							print '<p class="er">�� ������ ��������� ������!</p>';
						}

				
				
					}
		}
	} else {
	?>
		<h1>���������� �������</h1>
<font>��� ������ <?php echo $pmbalance; ?> <b>$</b></font>
<form action="?action=save" method="post" name='add'><fieldset><table class="formatTable">									<input name="Oper" id="add_Oper" value="CASHIN" type="hidden">				<tbody><tr>							<td><label for="add_PSys"><span class="descr_req">� ��������� �������<span class="descr_star">*</span></span></label></td><td><select name="PSys" id="add_PSys" class="select">
<?php if($cfgPerfect) { ?><option value="1">PerfectMoney</option> <?php } ?>
<?php if(cfgSET('cfgPEsid') && cfgSET('cfgPEkey')) { ?><option value="2">PAYEER</option> <?php } ?>
</select></td></tr>				<tr>							<td><label for="add_Sum"><span class="descr_req">����� $<span class="descr_star">*</span></span></label></td><td><input name="sum" id="add_Sum" value="" size="10" type="text" class="float"> <i><span id="ccurr"></span></i></td></tr></tbody></table></fieldset><input name="__Cert" value="a8aeaf6f" type="hidden"><br><input name="add_btn" value="���������" type="submit" class="button-blue"></form>
      

<h1>������� ����������</h1>
<table class="formatTable">
<tbody>
<tr>
<td colspan='5'>

<table class="FormatTable" border="1">
<tbody>
<tr><th>#</th><th>����</th><th>�����</th><th>����</th><th>���</th><th>������</th></tr>
<?php
                $result = mysql_query("SELECT * FROM enter WHERE login='$login'");
                if ( mysql_num_rows($result) == 0 ){ echo "<td colspan='0' align='center'>������� ����� ���������� �����!</td>"; }
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
			print '<span class="tool"><span class="tip"><b>�� ��������� ������ � ����� �������.</b></span></span>';
		} elseif($row['status'] == 1) {
			print '<span class="tool"><span class="tip"><b>������ ��������� �� ������������.</b></span></span>';
		} elseif($row['status'] == 2) {
			print '<span class="tool"><span class="tip"><b>������ ���������!</b></span></span>';
		} else {
			print '<span class="tool"><span class="tip"><b>������ ���������.</b></span></span>';
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
<?php
}
} else {
	print "<center>�� ������ ���� �������������� ��� ������� � ���� ��������!</center>";
}


?>