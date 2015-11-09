<?php
/*
 |	pawFramework
 |	@file		./index.php
 |	@author		svanlaere
 |	@version	1.0.0 [1.0.0] - Stable
 |
 |	@license	X11 / MIT License
 |	@copyright	Copyright © 2015 pytesNET
 */
	if(!defined("IN_CMS")){ exit(); }
	
	// SET PLUGIN INFOS
	Plugin::setInfos(array(
		"id"					=> "themer",
		"title"					=> "Themer",
		"description"			=> __("A WordPress AdminTheme configuration plugin."),
		"version"				=> "1.0.0",
		"license"				=> "GPL",
		"author"				=> "svanlaere",
		"website"				=> "http://www.wolfcms.org/forum/",
		"require_wolf_version"	=> "0.7.5",
		"type"					=> "backend"
	));
	Plugin::addController("themer", __("Wordpress admin theme"), "admin_view", false);
	
	
	if(Plugin::isEnabled("themer")){
		if(!defined("THEMER")){
			define("THEMER", 		PLUGINS_ROOT."/themer");
		}
		if(!defined("THEMER_VIEW")){
			define("THEMER_VIEW", 	"themer/views/");
		}
		
		function themer_customize_admin_theme($path){
			$admin_theme = Setting::get("theme");
			$settings = Plugin::getAllSettings("themer");
			
			if($admin_theme == "wordpress-3.8"){
				echo new View(THEMER.DS."views".DS."head", array(
					"color" 		=> $settings["color"],
					"sidebar_width" => $settings["sidebar_width"]
				));
			}
			return $path;
		}
		Observer::observe("view_backend_layout_head", "themer_customize_admin_theme");
	}
