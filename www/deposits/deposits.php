<h1>History of deposits</h1>
<?php
defined('ACCESS') or die();
if($login) {

	if($_GET['close']) {

		$result	= mysql_query("SELECT * FROM deposits WHERE id = ".intval($_GET['close'])." AND user_id = ".$user_id." AND status = 0 LIMIT 1");
		$row	= mysql_fetch_array($result);

		$result2	= mysql_query("SELECT * FROM plans WHERE id = ".$row['plan']." LIMIT 1");
		$row2		= mysql_fetch_array($result2);

		if(!$row['id'] || !$row2['id']) {
			print '<p class="er">An error occurred while closing the deposit</p>';
		} elseif($row2['back'] != 1 || $row2['close'] != 1) {
			print '<p class="er">This deposit can not be closed prematurely</p>';
		} else {
			$sum = sprintf("%01.2f", $row['sum'] - $row['sum'] / 100 * $row2['close_percent']);
			mysql_query('UPDATE users SET pm_balance = pm_balance + '.$sum.' WHERE id = '.$row['user_id'].' LIMIT 1');
			mysql_query("DELETE FROM deposits WHERE id = ".$row['id']." LIMIT 1");
			print '<p class="erok">DEPOSIT CLOSED IN ADVANCE!</p>';
		}

	}
?>
<?php
$s = 0;
$result	= mysql_query("SELECT * FROM deposits WHERE user_id = ".$user_id." ORDER BY id ASC");
while($row = mysql_fetch_array($result)) {
	$result2	= mysql_query("SELECT * FROM plans WHERE id = ".$row['plan']." LIMIT 1");
	$row2		= mysql_fetch_array($result2);
$s = $s + $row['sum'];
$sevenairlines = date("H:i:s d.m.Y", $row['nextdate']);
}
?>
	<div class="ref_page"><form method="post" name="refsys_frm"><fieldset><table class="formatTable">				<tbody><tr>							<td>Total deposits in the amount of </td><td><span class="value">$<?php echo $s; ?></span></td></tr>				<tr>							
<td>Next in enrollment%</td><td><span class="value"><a href="#" target="_blank"><span id="deptimer"><?php echo $row['id']; ?></span></b> <?php echo $sevenairlines; ?></a></span></td></tr>				<tr>				<td colspan="5"><table class="FormatTable" border="1"><tbody><tr><th>Sum</th><th>Percent</th><th>The period of enrollment</th><th>Time</th><th>Opening date</th></tr><tr></tr>

	<script language=\"JavaScript\">
		<!--
			CalcTimePercent(".$row['id'].", ".$row['lastdate'].", ".$row['nextdate'].", ".time().", ".$row2['period'].");
		//-->
		</script>
	
<?php
$s = 0;
$result	= mysql_query("SELECT * FROM deposits WHERE user_id = ".$user_id." ORDER BY id ASC");
while($row = mysql_fetch_array($result)) {
	$result2	= mysql_query("SELECT * FROM plans WHERE id = ".$row['plan']." LIMIT 1");
	$row2		= mysql_fetch_array($result2);
?>
<tr><td colspan="0" align="center">$<?php echo $row['sum']; ?></td><td colspan="0" align="center"><?php echo $row2['percent']; ?>%</td><td colspan="0" align="center">daily</td><td colspan="0" align="center"><?php echo $row2['days']; ?> day(s)</td><td colspan="0" align="center"><?php echo date("d.m.Y H:i", $row['date']); ?></td></tr>
<?php } ?>


</tbody></table></td></tr></tbody></table></fieldset><input name="__Cert" value="b534a668" type="hidden"><br></form><br>



</div>
<?php
} else {
	print "<center><p class=\"er\">You must be authorized to access this page</p></center>";
}
?>