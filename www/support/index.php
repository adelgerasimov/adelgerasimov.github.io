<?php
	$page = 'support';
	$file = 'support.php';
	$idpg = 17;
	include '../cfg.php';
	include '../ini.php';
        $to = "info@forexup.org";
	if($lng == "ru") {
		include "../template_ru.php";
	} else {
		include "../template.php";
	}
?>



