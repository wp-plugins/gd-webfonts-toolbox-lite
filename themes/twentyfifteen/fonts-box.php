<?php

if (!defined('ABSPATH')) exit;

class gdwft_theme_twentyfifteen extends gdwft_theme {
    public $name = '2015';

    public function selectors() {
        $this->selector('site_title', __("Site Title", "gd-webfonts-toolbox-lite"), '.site-title');
        $this->selector('site_description', __("Site Description", "gd-webfonts-toolbox-lite"), '.site-description');
        $this->selector('entry_title', __("Entry Title", "gd-webfonts-toolbox-lite"), '.entry-title');
        $this->selector('widget_title', __("Widget Title", "gd-webfonts-toolbox-lite"), '.widget-title');
        $this->selector('entry_footer', __("Entry Footer", "gd-webfonts-toolbox-lite"), '.entry-footer span');
    }

    public function fonts() {
        // $this->font('google', 'Open Sans');
    }
}

$gdwft_theme_load_twentyfifteen = new gdwft_theme_twentyfifteen();

?>