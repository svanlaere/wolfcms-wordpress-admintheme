<?php
/*
 |	pawFramework
 |	@file		./enable.php
 |	@author		svanlaere
 |	@version	1.0.0 [1.0.0] - Stable
 |
 |	@license	X11 / MIT License
 |	@copyright	Copyright © 2015 pytesNET
 */
	if(!defined("IN_CMS")){ exit(); }
	
	$themename   = "wordpress-3.8";
	$themes      = Setting::getThemes();
	
	if(!array_key_exists($themename, $themes)){
		Plugin::deactivate("themer");
		Flash::set("error", __("This plugin requires the :themename admin theme!"));	
	} else {
		$settings = array(
			"color" 		=> "default.css",
			"sidebar_width" => "180"
		);
		Plugin::setAllSettings($settings, "themer");	
	}
	
	if(version_compare(PHP_VERSION, "5.3.0") <= 0){
		Plugin::deactivate("themer");
		Flash::set("error", __("This plugin requires PHP 5.3 or higher!"));
	}
