<?php
	defined('_JEXEC') or die;
	
	global $app;
?>

<title><?php echo $app->meta->title; ?></title>

<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1">

<meta name="title" content="<?php echo $app->meta->title; ?>" />
<meta name="description" content="<?php echo $app->meta->desc; ?>" />
<link rel="image_src" href="<?php echo $app->meta->image; ?>" />

<meta property="og:locale" content="ru_RU"/>
<meta property="og:type" content="website"/>
<meta property="og:title" content="<?php echo $app->meta->title; ?>"/>
<meta property="og:description" content="<?php echo $app->meta->desc; ?>"/>
<meta property="og:image" content="<?php echo $app->meta->image; ?>"/>
<meta property="og:url" content="<?php echo $app->baseurl; ?>"/>
<meta property="og:site_name" content="<?php echo $app->meta->sitename; ?>"/>

<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="<?php echo $app->meta->title; ?>">
<meta name="twitter:description" content="<?php echo $app->meta->desc; ?>">
<meta name="twitter:image" content="<?php echo $app->meta->image; ?>">

<meta itemprop="name" content="<?php echo $app->meta->title; ?>"/>
<meta itemprop="description" content="<?php echo $app->meta->desc; ?>"/>
<meta itemprop="image" content="<?php echo $app->meta->image; ?>"/>

<link href="<?php echo $app->baseurl; ?>/assets/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet">

<?php
	# Подключаем Css файлы
	echo $app->scripts->cssHtml;
?>