<?php
/*
 |	pawFramework
 |	@file		./view/settings.php
 |	@author		svanlaere
 |	@version	1.0.0 [1.0.0] - Stable
 |
 |	@license	X11 / MIT License
 |	@copyright	Copyright © 2015 pytesNET
 */
	if(!defined("IN_CMS")){ exit(); }
?>
<h1><?php echo __("Settings for Wordpress admin theme"); ?></h1>
<form action="<?php echo get_url("plugin/themer/savesettings"); ?>" method="post">
	<table class="fieldset" cellpadding="0" cellspacing="0" border="0">
		<tr>
			<td class="label"><label for="settings-sidebar_width"><?php echo __("Sidebar width"); ?>:</label></td>
			<td class="field">
				<input type="number" max="260" min="160" step="10" id="settings-sidebar_width" name="settings[sidebar_width]" value="<?php echo $settings["sidebar_width"]; ?>" />
			</td>
			<td class="help"><?php echo __("Set your desired value in pixels. Default value: 180"); ?></td>
		</tr>
		
		<tr>
			<td class="label"><label for="settings-color"><?php echo __("Color scheme"); ?>:</label></td>
			<td class="field">
				<select name="settings[color]" id="settings-color">
				<?php foreach ($colors as $key => $color): ?>
				<option value="<?php echo $key; ?>" <?php if($settings["color"] == $key) echo 'selected="selected"'; ?>><?php echo $color; ?></option>
				<?php endforeach; ?>
			</select>
			</td>
			<td class="help"><?php echo __("Set your favorite colorscheme. Default value: Default"); ?></td>
		</tr>
	</table>

    <p class="buttons">
        <input class="button" name="settings[action]" type="submit" accesskey="s" value="<?php echo __("Save Settings"); ?>" />
		<button name="settings[action]" value="reset"><?php echo __("Reset Settings"); ?></button>
    </p>
</form>