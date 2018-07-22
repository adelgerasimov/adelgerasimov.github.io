<?php
defined('ACCESS') or die();
if(cfgSET('cfgOnOff') == "off" && $status != 1) {
	include "includes/errors/tehwork.php";
	exit();
} elseif(cfgSET('cfgOnOff') == "off" && $status == 1) {
	print '<p align="center" class="warn">Сайт отключен и недоступен для остальных пользователей!</p>';
}
?>

<!DOCTYPE html>
<html>
  <head>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js" type="text/javascript"></script>
    <meta charset="windows-1251" />
<title>
<?php
if (!$page){
echo "$title_en | Welcome!";
}
if ($page == "contacts"){
echo "$title_en | Support";
}
if ($page == "deposit"){
echo "$title_en | Make deposit";
}
if ($page == "deposits"){
echo "$title_en | List your of deposits";
}
if ($page == "enter"){
echo "$title_en | Add money to your balance";
}
if ($page == "faq"){
echo "$title_en | F.A.Q";
}
if ($page == "login"){
echo "$title_en | Login";
}
if ($page == "news"){
echo "$title_en | News";
}
if ($page == "profile"){
echo "$title_en | Your profile";
}
if ($page == "ref"){
echo "$title_en | Your referrals";
}
if ($page == "registration"){
echo "$title_en | Register";
}
if ($page == "reminder"){
echo "$title_en | Reminder password";
}
if ($page == "stat"){
echo "$title_en | History operations";
}
if ($page == "transfer"){
echo "$title_en | Transfer of funds to another user";
}
if ($page == "withdrawal"){
echo "$title_en | Withdrawal";
}
if ($page == "plans"){
echo "$title_en | Tarifs";
}
if ($page == "support"){
echo "$title_en | Support";
}
if ($page == "about"){
echo "$title_en | About The Company";
}
?>
</title>
<link rel="icon" type="image/png" href="/img/ic.png" />
<link rel="stylesheet" href="/css/style.css">
<link href="//fonts.googleapis.com/css?family=Cuprum:400,700&amp;subset=latin,latin-ext,cyrillic" rel="stylesheet" type="text/css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script type="text/javascript" src="/js/scripts.js"></script>
	<script>
		$(window).load(function(){
			$('.main_slider').flexslider({
				animation: "fade",
				animationSpeed: 500,
				controlNav: false,
				directionNav: true,
				pauseOnHover: true
			});
		});
	</script>
	<script type="text/javascript">
		var scrollSpeed = 30;
		var current = 0;
		var direction = 'h';
		function bgscroll(){
			current += 1;
			$('.main_wrap_after').css("backgroundPosition", (direction == 'h') ? current+"px 0" : "0 " + current+"px");
		}
		setInterval("bgscroll()", scrollSpeed);	
	</script>
	<style></style>
  </head>
  <body>

<!-- Начало див хидер -->
    <div class="header">
      <div class="line_top clearfix">
        <div class="container clearfix">
          <ul class="main_menu left f_left">
            <li><a href="/">Home</a></li>
            <li><a href="/news/">News</a></li>
            <li><a href="/plans/">Tarifs</a></li>
            <li><a href="/faq/">F.A.Q</a></li>
          </ul>
          <a href="https://forexup.org" class="logo"></a>
          <ul class="main_menu right f_right">
            <li><a href="/registration/">Register</a></li>
            <li><a href="/login/">Login</a></li>
            <li><a href="/support/">Support</a></li>
          </ul>
          <ul class="lang">
            <li><a href='/?lang=ru'><?php if($_COOKIE["lng"] == "ru"){ echo "<img src='/img/ru-active.png'>"; }else{ echo "<img src='/img/ru-not-active.png'>"; } ?></a></li>
            <li><a href='/?lang=en'><?php if($_COOKIE["lng"] == "en"){ echo "<img src='/img/gb-active.png'>"; }else{ echo "<img src='/img/gb-not-active.png'>"; } ?></a></li>          </ul>
        </div>
      </div>
      <div class="head_content">
        <p>The Forex market has become a popular method of ascending and financial trading.<br>
As an innovator and initiator in the foreign exchange online business,<br>
ForexUP is a leading player in online trading.<br>
<br>
Our team is headed by experienced professionals,<br>
receive proper education and have a lot of experience<br>
financial operations in the Forex market.<br>
If you have any wish for further cooperation,<br> 
ForexUP team can offer investors the opportunity to<br>
independently build their own financial future.<br>
<br>
<font size="4">The company gives each sign-up bonus $ 2</font></p>
        <div class="button">
          <?php if (!$login){ ?><a href="/login/">Login</a>or<a href="/registration/">Register</a><?php } ?>
          <?php if ($login){ ?><a href="/enter/">Profile</a>or<a href="/logout.php">Logout</a><?php } ?>
        </div>
      </div>
      <div class="main_slider">
        <ul class="slides clearfix">
          <li class="" style="width: 100%; position: absolute; opacity: 0; display: block; z-index: 1;"><div style="background: transparent url(/img/slide1.png) no-repeat top center; height: 390px;"></div></li>
          <li class="" style="width: 100%; position: absolute; opacity: 1; display: block; z-index: 2;"><div style="background: transparent url(/img/slide2.png) no-repeat top center; height: 390px;"></div></li>
		  <li class="" style="width: 100%; position: absolute; opacity: 1; display: block; z-index: 2;"><div style="background: transparent url(/img/slide3.png) no-repeat top center; height: 390px;"></div></li>
        </ul>
        <ul class="flex-direction-nav">
          <li><a class="flex-prev" href="#">Previous</a></li>
          <li><a class="flex-next" href="#">Next</a></li>
        </ul>
      </div>
    </div>
<!-- Конец див хидер -->
<!-- МаинВрап1 -->
<div class="main_wrap">
<div class="main_wrap_after" style="background-position: 390px 0px;"></div>
<div class="container clearfix"></div></div>
<!-- МаинВрап1 -->
<!-- МаинВрап2 -->
<div class="main_wrap">
<?php if($login AND $page){ ?>
<div class="container clearfix"><ul class="navigation clearfix"><li><a href="/enter/"><span class="icon icon_1"><span></span></span>Add money</a></li><li><a href="/withdrawal/"><span class="icon icon_2"><span></span></span>Withdrawal</a></li><li><a href="/deposit/"><span class="icon icon_3"><span></span></span>Make deposit</a></li><li><a href="/deposits/"><span class="icon icon_6"><span></span></span>List your deposits</a></li><li><a href="/ref/"><span class="icon icon_4"><span></span></span>Referral programm</a></li><li><a href="/profile/"><span class="icon icon_5"><span></span></span>Settings</a></li></ul></div>
<?php } ?>

<?php
	defined('ACCESS') or die();
	if(!$page) {
		include "includes/index_en.php";
	} elseif(file_exists("../".$page."/index.php")) {
 if ($page){ echo "<div class='container clearfix'>";  }
		include "../".$page."/".$page.".php";
	} else {
		include "includes/errors/404.php";
	}
?>
<?php if ($page){ echo "</div>"; } ?>
</div>
<!-- МаинВрап2 -->

<!-- Начало футер -->
<div class="footer">
<div class="f_top">
<div class="container clearfix">
<ul class="contacts f_left">
<li><span class="block"><span>Support E-mail:</span> info@forexup.org</span></li>
</ul>
<ul class="social f_right">
<li><a href="https://vk.com/forexup_org" target="_blank" class="vk">VKontakte</a></li>
<li><a href="skype:fxupsupport?add" class="skype">Skype</a></li>
</ul></div></div>
<div class="f_bottom"><div class="container">
<div class="partners clearfix">
<div class="accept clearfix">
<span>OUR PARTNERS:</span><img style='  float: left;
  margin: -5.9%;
  margin-left: -2.99%;' src="/img/partners.png"></div>
<div class="ref_comm clearfix"><span>Referral kommision:</span>
<img src="/img/ref_comm.png"></div></div>
<div class="clearfix">
<ul class="foot_menu f_left">
<li><a href="/"><span></span>Home</a></li>
<li><a href="/plans/"><span></span>Tarifs</a></li>
<li><a href="/news/"><span></span>News</a></li>
<li><a href="/faq/"><span></span>FAQ</a></li>
<li><a href="/about/"><span></span>About company</a></li>
<li><a href="/support/"><span></span>Support</a></li>
</ul>
<div class="copyright f_right">© 2015 ForexUP.org
</div></div></div></div></div>
 
  </body>
</html>