<?php

if (!defined('ABSPATH')) exit;

class gdwft_theme_twentyfourteen extends gdwft_theme {
    public $name = '2014';

    public function selectors() {
        $this->selector('site_title', __("Site Title", "gd-webfonts-toolbox-lite"), '.site-title');
        $this->selector('site_description', __("Site Description", "gd-webfonts-toolbox-lite"), '.site-description');
        $this->selector('entry_title', __("Entry Title", "gd-webfonts-toolbox-lite"), '.entry-title');
        $this->selector('primary_widget_title', __("Primary Widget Title", "gd-webfonts-toolbox-lite"), '#primary-sidebar .widget-title');
        $this->selector('content_widget_title', __("Content Widget Title", "gd-webfonts-toolbox-lite"), '#content-sidebar .widget-title');
    }

    public function fonts() {
        // $this->font('google', 'Open Sans');
    }
}

$gdwft_theme_load_twentyfourteen = new gdwft_theme_twentyfourteen();

?>