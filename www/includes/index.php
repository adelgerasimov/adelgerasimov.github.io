<div id='656' style='display: table; width: 955px; margin: auto; position: relative;'>
<div style="float: left; width: 345px; height: 100%; padding-top: 19px;">
<font size="5" style="
    padding-left: 120px;
">Статистика</font>
<div class="stata" align="left"><div style="height: 39px; padding-top: 22px;font-size: 20px;padding-left: 25px;/* width: 10px; *//* display: block; */" color="#ffffff">
<table style="width: 310px;">
    <tbody><tr>
             <td style="width: 250px;">Работаем</td>
             <td><button class="stat_table">
<?php
$ddm = time() - cfgSET('datestart');
$mmg =  round($ddm / 86400);

//Я кодер от бога)
$ds=array(2,3,4,22,23,24,32,33,34,42,43,44,52,53,54,62,63,64,72,73,74,82,83,84,92,93,94,102,103,104,112,113,114);
$ds2=array(1,21,31,41,51,61,71,81,91,101,111,121);
$zbs='дней.'; if(in_array($mmg,$ds)){ $zbs='дня.'; }elseif(in_array($mmg,$ds2)){ $zbs='день.'; }

echo "$mmg $zbs";
?>
</button></td>
    </tr>
</tbody></table>
</div>
  </div>
<div class="stata" align="left"><div style="height: 39px; padding-top: 22px;font-size: 20px;padding-left: 25px;/* width: 10px; *//* display: block; */" color="#ffffff">
<table style="width: 310px;">
    <tbody><tr>
<?php
$cusers		= mysql_num_rows(mysql_query("SELECT id FROM users")) + cfgSET('fakeusers');
?>
             <td style="width: 250px;">Всего участников</td>
             <td><button class="stat_table"><?php echo $cusers; ?></button></td>
    </tr>
</tbody></table>
</div>
  </div>
<div class="stata" align="left"><div style="height: 39px; padding-top: 22px;font-size: 20px;padding-left: 25px;/* width: 10px; *//* display: block; */" color="#ffffff">
<table style="width: 310px;">
    <tbody><tr>
             <td style="width: 250px;">Участников онлайн</td>
             <td><button class="stat_table"><?php print intval(mysql_num_rows(mysql_query("SELECT id FROM users WHERE go_time > ".intval(time() - 1200))) + cfgSET('fakeonline')); ?></button></td>
    </tr>
</tbody></table>
</div>
  </div>
<div class="stata" align="left"><div style="height: 39px; padding-top: 22px;font-size: 20px;padding-left: 25px;/* width: 10px; *//* display: block; */" color="#ffffff">
<table style="width: 310px;">
    <tbody><tr>
<?php
$money	= cfgSET('fakewithdraws');
$query	= "SELECT sum FROM output WHERE status = 2";
$result	= mysql_query($query);
while($row = mysql_fetch_array($result)) {
	$money = $money + $row['sum'];
}
?>
             <td style="width: 250px;">Всего выведено</td>
             <td><button class="stat_table"><?php print $money; ?>$</button></td>
    </tr>
</tbody></table>
</div>
  </div>
</div>
<div style="/* position: absolute; */ /* padding-left: 550px; *//* position: fixed; *//* display: block; */float: left;  width: 285px;  height: 260px;  padding-top: 3px;/* border: solid 1px green; */padding-left: 10px;">
<font size="5" style="
    padding-left: 82px;
">Пополнения</font>
<font size="2" style="
    padding-left: 108px;
">10 последних</font>
<div style='height: 260px;' class="t_stata" align="right">
<table id='lastdeposits'>
 <tbody>
<?php
$mq1 = mysql_query("SELECT * FROM enter WHERE status='2' ORDER BY date DESC LIMIT 10  ");

if ( mysql_num_rows($mq1) <= 0 ){
?>
<tr>
<td style="padding-left: 20%;
  padding-top: 30%;" class="td_table_stat1">Нет информации</td>
</tr>
<?php
}

while( $row1 = mysql_fetch_array($mq1)){
?>
  <tr>
   <td class="td_table_stat1"><?php echo $row1['login']; ?></td>
   <td class="td_table_stat2"><?php echo $row1['sum']; ?>$</td>
  </tr>
<?php } ?>
 </tbody>
</table>
</div></div>
<div style="/* position: absolute; */ /* padding-left: 550px; *//* position: fixed; *//* display: block; */float: left;  width: 285px;  height: 260px;  padding-top: 3px;/* border: solid 1px green; */padding-left: 8px;">
<font size="5" style="
    padding-left: 100px;
">Выводы</font>
<font size="2" style="
    padding-left: 105px;
">10 последних</font>
<div style='height: 260px;' class="t_stata" align="right">
<table id='lastdeposits'>
 <tbody>
  <?php
$mq1 = mysql_query("SELECT * FROM output WHERE status='2' ORDER BY date DESC LIMIT 10");

if ( mysql_num_rows($mq1) <= 0 ){
?>
<tr>
<td style="padding-left: 20%;
  padding-top: 30%;" class="td_table_stat1">Нет информации</td>
</tr>
<?php
}

while( $row1 = mysql_fetch_array($mq1)){
?>
  <tr>
   <td class="td_table_stat1"><?php echo $row1['login']; ?></td>
   <td class="td_table_stat2"><?php echo $row1['sum']; ?>$</td>
  </tr>
<?php } ?>
 </tbody>
</table>
</div></div>

</div>
      </div>
   </div>
</div>