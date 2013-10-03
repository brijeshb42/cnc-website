<!DOCTYPE HTML>
<!--[if IEMobile 7 ]><html class="no-js iem7" manifest="default.appcache?v=1"><![endif]--> 
<!--[if lt IE 7 ]><html class="no-js ie6" lang="en"><![endif]--> 
<!--[if IE 7 ]><html class="no-js ie7" lang="en"><![endif]--> 
<!--[if IE 8 ]><html class="no-js ie8" lang="en"><![endif]--> 
<!--[if (gte IE 9)|(gt IEMobile 7)|!(IEMobile)|!(IE)]><!-->
<html class="no-js" lang="en"><!--<![endif]-->
<head>
	<base href="<?php echo $SCHEME.'://'.$HOST.$BASE.'/'; ?>" />
	<title><?php echo $title; ?></title>
	<meta charset="UTF-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="shortcut icon" href="img/favicon.ico"/>
	<link rel='stylesheet' id='contact-form-7-css'  href='css/styles5589.css?ver=3.4.1' type='text/css' media='all' />
	<link rel='stylesheet' id='bootstrap-css'  href='css/bootstrap.min49eb.css?ver=3.5.2' type='text/css' media='screen' />
	<link rel='stylesheet' id='bootstrap-responsive-css'  href='css/bootstrap-responsive.min.css' type='text/css' media='screen' />
	<link rel='stylesheet' id='open-sans-css'  href='css/font.css' type='text/css' media='screen' />
	<link rel='stylesheet' id='screen-css'  href='style.min.css' type='text/css' media='screen' />
	<link rel='stylesheet' id='swipebox-css'  href='css/swipebox.css' type='text/css' media='screen' />
	<style>
		.color, h1 > span, h2 > span, .description-text a, .description-text a:hover {
		color:#01a3b2!important;
		}
		/*.circle-menu, .nav-tabs li a, #portfolio a.link-portfolio, input[type="submit"] {
		background:#01a3b2;
		}*/
			</style>
	</head>
<body class="home blog">
	<?php if ($boy==true): ?>
	
		<div id="for-girls"><a class="btn btn-primary" href="girls" target="_blank">For Girls</a></div>
	
	<?php else: ?>
		<div id="for-girls"><a class="btn btn-primary" href="/">Home</a></div>
	
	<?php endif; ?>
	<?php if ($boy==true) echo $this->render('header.html',$this->mime,get_defined_vars()); ?>
	<?php if ($boy==true) echo $this->render('links.html',$this->mime,get_defined_vars()); ?>
	<?php if ($boy==true) echo $this->render('games/games.html',$this->mime,get_defined_vars()); ?>
	<?php if ($boy==true) echo $this->render('games/contact.html',$this->mime,get_defined_vars()); ?>
	<?php if ($boy==true) echo $this->render('games/rules.html',$this->mime,get_defined_vars()); ?>
	<?php if ($boy==true) echo $this->render('games/gallery.html',$this->mime,get_defined_vars()); ?>
	<?php if ($boy==false) echo $this->render('games/girls.html',$this->mime,get_defined_vars()); ?>
	<?php echo $this->render('footer.html',$this->mime,get_defined_vars()); ?>
</body>
</html>
