<?php if ($sidebar_width): ?>
<style type="text/css">
     #header #mainTabs{width: <?php echo $sidebar_width; ?>px;}
     #main{padding-left: <?php echo $sidebar_width; ?>px;}
	 #footer{margin-left: <?php echo $sidebar_width; ?>px;}
	 #header #site-title a{width: <?php echo $sidebar_width; ?>px;}
	 div.message#error, div.message#success{left: <?php echo $sidebar_width; ?>px;}
	</style>
<?php endif; ?>
<?php if ($color): ?>
<link href="<?php echo URL_PUBLIC; ?>wolf/admin/themes/wordpress-3.8/css/colors/<?php echo $color; ?>" id="css_color" media="screen" rel="Stylesheet" type="text/css" />
<?php endif; ?>

