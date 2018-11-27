<?php defined('_JEXEC') or die; ?>

<title><?php echo $this->meta->title; ?></title>

<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1">

<meta name="title" content="<?php echo $this->meta->title; ?>" />
<meta name="description" content="<?php echo $this->meta->desc; ?>" />
<link rel="image_src" href="<?php echo $this->meta->image; ?>" />

<meta property="og:locale" content="ru_RU"/>
<meta property="og:type" content="website"/>
<meta property="og:title" content="<?php echo $this->meta->title; ?>"/>
<meta property="og:description" content="<?php echo $this->meta->desc; ?>"/>
<meta property="og:image" content="<?php echo $this->meta->image; ?>"/>
<meta property="og:url" content="<?php echo $this->baseurl; ?>"/>
<meta property="og:site_name" content="<?php echo $this->meta->sitename; ?>"/>

<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="<?php echo $this->meta->title; ?>">
<meta name="twitter:description" content="<?php echo $this->meta->desc; ?>">
<meta name="twitter:image" content="<?php echo $this->meta->image; ?>">

<meta itemprop="name" content="<?php echo $this->meta->title; ?>"/>
<meta itemprop="description" content="<?php echo $this->meta->desc; ?>"/>
<meta itemprop="image" content="<?php echo $this->meta->image; ?>"/>

<link href="<?php echo $this->baseurl; ?>/assets/fonts/font-awesome/css/fontawesome-all.min.css" rel="stylesheet" type='text/css'>

<?php
	# Подключаем Css файлы
	echo $this->scripts->cssHtml;
?>