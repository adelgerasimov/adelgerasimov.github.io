<h1>НОВОСТИ</h1>
<div class="news_page">
<?php
defined('ACCESS') or die();

$mmm = mysql_query("SELECT * FROM news");
$o = 0;
while ( $mm = mysql_fetch_array($mmm)){
$o+=1;
$id = $mm['id'];
$date = $mm['date'];
$text = $mm['msg'];
$subj = $mm['subject'];
        echo "<div class='news_block'><h2>$subj";
	if ($status == 1 || $status == 2)
	{
		print " <a href=\"/adminpanel/adminstation.php?a=edit_news&id=".$id."\"><img src=\"/adminpanel/images/edit_small.gif\" width=\"12\" height=\"12\" border=\"0\" alt=\"Редактировать новость\" /></a> ";
		print "<img style=\"cursor: hand;\" onclick=\"if(confirm('Вы уверены?')) top.location.href='/adminpanel/del/news.php?id=".$id."'\";  width=\"12\" height=\"12\" border=\"0\" src=\"/adminpanel/images/del.gif\" alt=\"Удалить новость\" />";
	}
        echo "</h2><div>$date</div><div class='text_news'>$text</div><div style='text-align: right;'></div></div>";
}
if ($o <= "0"){
echo "<center><font>Новости не обнаружены!</font></center>";
}
?>
</div>