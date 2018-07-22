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
    <meta charset="utf-8" />
<title>
<?php
if (!$page){
echo "$title_ru | Добро пожаловать!";
}
if ($page == "contacts"){
echo "$title_ru | Поддержка";
}
if ($page == "deposit"){
echo "$title_ru | Сделать депозит";
}
if ($page == "deposits"){
echo "$title_ru | Список ваших депозитов";
}
if ($page == "enter"){
echo "$title_ru | Пополнить баланс";
}
if ($page == "faq"){
echo "$title_ru | F.A.Q";
}
if ($page == "login"){
echo "$title_ru | Вход";
}
if ($page == "news"){
echo "$title_ru | Новости";
}
if ($page == "profile"){
echo "$title_ru | Профиль";
}
if ($page == "ref"){
echo "$title_ru | Реферралы";
}
if ($page == "registration"){
echo "$title_ru | Регистрация";
}
if ($page == "reminder"){
echo "$title_ru | Восстановление пароля";
}
if ($page == "stat"){
echo "$title_ru | История операций";
}
if ($page == "transfer"){
echo "$title_ru | Перевод денег другому участнику";
}
if ($page == "withdrawal"){
echo "$title_ru | Снятие денег";
}
if ($page == "plans"){
echo "$title_ru | Тарифы";
}
if ($page == "support"){
echo "$title_ru | Поддержка";
}
if ($page == "about"){
echo "$title_ru | О Компании";
}
?>

</title>
<link rel="stylesheet" href="/css/style.css">
<link href="//fonts.googleapis.com/css?family=Cuprum:400,700&amp;subset=latin,latin-ext,cyrillic" rel="stylesheet" type="text/css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script type="text/javascript" src="/js/scripts.js"></script>
<link rel="icon" type="image/png" href="/img/ic.png" />
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
            <li><a href="/">ГЛАВНАЯ</a></li>
            <li><a href="/news/">НОВОСТИ</a></li>
            <li><a href="/plans/">ТАРИФЫ</a></li>
            <li><a href="/faq/">F.A.Q</a></li>
          </ul>
          <a href="https://forexup.org" class="logo"></a>
          <ul class="main_menu right f_right">
            <li><a href="/registration/">РЕГИСТРАЦИЯ</a></li>
            <li><a href="/login/">ВХОД</a></li>
            <li><a href="/support/">ПОДДЕРЖКА</a></li>
          </ul>
          <ul class="lang">
            <li><a href='/?lang=ru'><?php if($_COOKIE["lng"] == "ru"){ echo "<img src='/img/ru-active.png'>"; }else{ echo "<img src='/img/ru-not-active.png'>"; } ?></a></li>
            <li><a href='/?lang=en'><?php if($_COOKIE["lng"] == "en"){ echo "<img src='/img/gb-active.png'>"; }else{ echo "<img src='/img/gb-not-active.png'>"; } ?></a></li>          </ul>
        </div>
      </div>
      <div class="head_content">
        <p>Рынок Форекс стал популярным и восходящим методом финансового трейдинга.<br>
Как новатор и инициатор в валютном онлайн-бизнесe,<br>
ForexUP является ведущим игроком на рынке интернет-трейдинга.<br>
<br>
Нашу команду возглавляют опытные специалисты,<br>
получившие должное образование и имеющие немалый опыт<br>
 финансовых операций на рынке Forex.<br>
При наличии желания и дальнейшего сотрудничества,<br> 
команда ForexUP может предложить инвесторам возможность <br>
самостоятельно построить свое собственное финансовое будущее.<br>
<br>
<font size="4">Компания дарит каждому бонус за регистрацию 2$</font></p>
        <div class="button">
          <?php if (!$login){ ?><a href="/login/">Войдите</a>или<a href="/registration/">Зарегистрируйтесь</a><?php } ?>
          <?php if ($login){ ?><a href="/enter/">Профиль</a>или<a href="/logout.php">Выход</a><?php } ?>
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
<div class="container clearfix"><ul class="navigation clearfix"><li><a href="/enter/"><span class="icon icon_1"><span></span></span>Пополнить баланс</a></li><li><a href="/withdrawal/"><span class="icon icon_2"><span></span></span>Вывод средств</a></li><li><a href="/deposit/"><span class="icon icon_3"><span></span></span>Открыть депозит</a></li><li><a href="/deposits/"><span class="icon icon_6"><span></span></span>История депозитов</a></li><li><a href="/ref/"><span class="icon icon_4"><span></span></span>Реф. Программа</a></li><li><a href="/profile/"><span class="icon icon_5"><span></span></span>Настройки</a></li></ul></div>
<?php } ?>
<?php
	defined('ACCESS') or die();
	if(!$page) {
		include "includes/index.php";
	} elseif(file_exists("../".$page."/index.php")) {
if ($page){ echo "<div class='container clearfix'>";  }
		include "../".$page."/".$page."_ru.php";
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
<li><span class="block"><span>E-mail поддержки:</span> info@forexup.org</span></li>
</ul>
<ul class="social f_right">
<li><a href="https://vk.com/forexup_org" target="_blank" class="vk">ВКонтакте</a></li>
<li><a href="skype:fxupsupport?add" class="skype">Skype</a></li>
</ul>
</div></div>
<div class="f_bottom"><div class="container">
<div class="partners clearfix">
<div class="accept clearfix">
<span>Наши партнеры:</span><img style='  float: left;
  margin: -5.9%;
  margin-left: -2.99%;' src="/img/partners.png"></div>
<div class="ref_comm clearfix"><span>Реферальная комиссия:</span>
<img src="/img/ref_comm.png"></div></div>
<div class="clearfix">
<ul class="foot_menu f_left">
<li><a href="/"><span></span>Главная</a></li>
<li><a href="/plans/"><span></span>Тарифы</a></li>
<li><a href="/news/"><span></span>Новости</a></li>
<li><a href="/faq/"><span></span>FAQ</a></li>
<li><a href="/about/"><span></span>О компании</a></li>
<li><a href="/support/"><span></span>Поддержка</a></li>
</ul>
<div class="copyright f_right">© 2015 ForexUP.org
</div></div></div></div></div>
 
  </body>
</html>