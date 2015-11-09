<?php
/*
 |	pawFramework
 |	@file		./ThemerController.php
 |	@author		svanlaere
 |	@version	1.0.0 [1.0.0] - Stable
 |
 |	@license	X11 / MIT License
 |	@copyright	Copyright © 2015 pytesNET
 */
	if(!defined("IN_CMS")){ exit(); }
	if(!isset($_SESSION)) { session_start(); }
	
	error_reporting(E_ALL);

	class ThemerController extends PluginController{
		/*
		 |	CHECK PERMISSIONS
		 |	@since	1.0.0
		 */
		private static function _checkPermission(){
			AuthUser::load();
			if(!AuthUser::isLoggedIn()){
				redirect(get_url("login")); die();
			}
		}
		
		/*
		 |	CONSTRUCTOR
		 |	@since	1.0.0
		 */
		public function __construct(){
			// This allows us to check if we're being called in the front or the back.
			if(defined("CMS_BACKEND")){
				$this->setLayout('backend');
				$this->assignToLayout("sidebar", new View("../../plugins/themer/views/sidebar"));
			} else {
				$settings = Plugin::getAllSettings("themer");
				$layout   = Layout::findById($settings["layout"]);
				$this->setLayout($layout->name);
			}  
		}
		
		/*
		 |	GET COLORS
		 |	@since	1.0.0
		 */
		public function getColors(){
			$themes = array();
			$dir    = CORE_ROOT . "/admin/themes/wordpress-3.8/css/colors/";
			if(file_exists($dir)){
				if($handle = opendir($dir)){
					while(($file = readdir($handle)) !== false){
						if(strpos($file, ".") !== 0){
							$themes[$file] = Inflector::humanize($file);
						}
					}
				}
				closedir($handle);
			}
			asort($themes);
			
			$themes = array_map(function($e){
				return pathinfo($e, PATHINFO_FILENAME);
			}, $themes);
			return $themes;
		}
		
		/*
		 |	INDEX PAGE
		 |	@since	1.0.0
		 */
		public function index(){
			//$this->display("themer/views/index");
		}
		
		/*
		 |	SETTINGS PAGE
		 |	@since	1.0.0
		 */
		public function settings(){
			$settings = Plugin::getAllSettings("themer");
			$this->display("themer/views/settings", array(
				"colors"	=> $this->getColors(),
				"settings"	=> Plugin::getAllSettings("themer")
			));
		}
		
		/*
		 |	SAVE SETTINGS
		 |	@since	1.0.0
		 */
		function savesettings(){
			if(isset($_POST["settings"]) && isset($_POST["settings"]["action"])){
				$settings = array(
					"color"			=> "default.css",
					"sidebar_width"	=> "180"
				);
				if($_POST["settings"]["action"] != "reset"){
					foreach($_POST["settings"] as $key => $value) {
						if(in_array($key, array("color", "sidebar_width"))){
							$settings[$key] = mysql_escape_string($value);
						}
					}
				}
				
				if(Plugin::setAllSettings($settings, "themer")){
					Flash::set("success", __("The settings have been saved."));
				} else {
					Flash::set("error", __("An error occured trying to save the settings."));
				}
			} else {
				Flash::set("error", __("Could not save settings, no settings found."));
			}
			redirect(get_url("plugin/themer/settings")); die();
		}
	}
