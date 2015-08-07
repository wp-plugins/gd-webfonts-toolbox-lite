<?php

if (!defined('ABSPATH')) exit;

class gdwft_theme_twentyeleven extends gdwft_theme {
    public $name = '2011';

    public function selectors() {
        $this->selector('site_title', __("Site Title", "gd-webfonts-toolbox-lite"), '#site-title a');
        $this->selector('site_description', __("Site Description", "gd-webfonts-toolbox-lite"), '#site-description');
        $this->selector('entry_title', __("Entry Title", "gd-webfonts-toolbox-lite"), '.entry-title');
        $this->selector('widget_title', __("Widget Title", "gd-webfonts-toolbox-lite"), '.widget-title');
    }

    public function fonts() {
        // $this->font('google', 'Open Sans');
    }
}

$gdwft_theme_load_twentyeleven = new gdwft_theme_twentyeleven();

?>