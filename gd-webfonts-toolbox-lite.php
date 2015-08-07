<?php

/*
Plugin Name: GD WebFonts Toolbox Lite
Plugin URI: http://www.dev4press.com/plugins/gd-webfonts-toolbox/
Description: Easy way to add Web Fonts (Google and Adobe) to standard and custom CSS selectors, with preview, extra styling builder, optional use of Google Webfont Loader.
Version: 1.0.1
Author: Milan Petrovic
Author URI: http://www.dev4press.com/

== Copyright ==
Copyright 2008 - 2015 Milan Petrovic (email: milan@gdragon.info)

This program is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 3 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program. If not, see <http://www.gnu.org/licenses/>
*/

$gdwft_dirname_basic = dirname(__FILE__).'/';
$gdwft_urlname_basic = plugins_url('/gd-webfonts-toolbox-lite/');

define('GDWFT_PATH', $gdwft_dirname_basic);
define('GDWFT_URL', $gdwft_urlname_basic);
define('GDWFT_D4PLIB', $gdwft_dirname_basic.'d4plib/');

global $_gdwft_plugin, $_gdwft_settings, $_gdwft_front;

require_once(GDWFT_PATH.'d4plib/d4p.core.php');

d4p_includes(array(
    array('name' => 'core', 'directory' => 'classes'),
    'wp',
    'functions'
), GDWFT_D4PLIB);

require_once(GDWFT_PATH.'core/functions.php');
require_once(GDWFT_PATH.'core/classes.php');
require_once(GDWFT_PATH.'core/selector.php');

require_once(GDWFT_PATH.'core/plugin.php');
require_once(GDWFT_PATH.'core/version.php');
require_once(GDWFT_PATH.'core/settings.php');

$_gdwft_plugin = new gdwft_core_plugin();
$_gdwft_settings = new gdwft_core_settings();

function gdwft_plugin() {
    global $_gdwft_plugin;
    return $_gdwft_plugin;
}

function gdwft_settings() {
    global $_gdwft_settings;
    return $_gdwft_settings;
}

if (D4P_ADMIN) {
    require_once(GDWFT_PATH.'core/admin.php');
} else {
    require_once(GDWFT_PATH.'core/front.php');

    $_gdwft_front = new gdwft_front();
}

if (D4P_AJAX) {
    require_once(GDWFT_PATH.'core/ajax.php');
}

?>