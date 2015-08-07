<?php

if (!defined('ABSPATH')) exit;

class gdwft_admin_settings {
    private $settings;

    function __construct() {
        $this->init();
    }

    public function get($panel, $group = '') {
        if ($group == '') {
            return $this->settings[$panel];
        } else {
            return $this->settings[$panel][$group];
        }
    }

    public function settings($panel) {
        $list = array();

        foreach ($this->settings[$panel] as $obj) {
            foreach ($obj['settings'] as $o) {
                $list[] = $o;
            }
        }

        return $list;
    }

    private function init() {
        $this->settings = array(
            'selectors' => array(
                'apply_important' => array('name' => __("Apply Important to styles", "gd-webfonts-toolbox-lite"), 'settings' => array(
                    new d4pSettingElement('settings', 'important_font', __("For Font Family", "gd-webfonts-toolbox-lite"), __("Font familiy for CSS selectors will get important property.", "gd-webfonts-toolbox-lite"), d4pSettingType::BOOLEAN, gdwft_settings()->get('important_font')),
                    new d4pSettingElement('settings', 'important_settings', __("For Style Settings", "gd-webfonts-toolbox-lite"), __("All properties for CSS selectors set through selector settings will get important property.", "gd-webfonts-toolbox-lite"), d4pSettingType::BOOLEAN, gdwft_settings()->get('important_settings'))
                ))
            ),
            'cache' => array(
                'style_cache' => array('name' => __("Generated styles cache", "gd-webfonts-toolbox-lite"), 'settings' => array(
                    new d4pSettingElement('settings', 'cache_styles_active', __("Transient Cache", "gd-webfonts-toolbox-lite"), __("Calculated styles and fonts for embedding will be stored in transient cache to speed up each page rendering.", "gd-webfonts-toolbox-lite"), d4pSettingType::BOOLEAN, gdwft_settings()->get('cache_styles_active')),
                    new d4pSettingElement('settings', 'cache_styles_days', __("Cache Period", "gd-webfonts-toolbox-lite"), __("Period to keep cached styles and used fonts lists.", "gd-webfonts-toolbox-lite"), d4pSettingType::INTEGER, gdwft_settings()->get('cache_styles_days'))
                ))
            ),
            'google' => array(
                'gg_status' => array('name' => __("Google Web Fonts", "gd-webfonts-toolbox-lite"), 'settings' => array(
                    new d4pSettingElement('settings', 'google_active', __("Status", "gd-webfonts-toolbox-lite"), __("This needs to be enabled so you can use Google Web Fonts.", "gd-webfonts-toolbox-lite"), d4pSettingType::BOOLEAN, gdwft_settings()->get('google_active'))
                )),
                'gg_subsets' => array('name' => __("Subsets to load", "gd-webfonts-toolbox-lite"), 'settings' => array(
                    new d4pSettingElement('settings', 'google_subsets', __("Subsets", "gd-webfonts-toolbox-lite"), '', d4pSettingType::CHECKBOXES, gdwft_settings()->get('google_subsets'), 'array', $this->get_google_subsets())
                )),
                'gg_advanced' => array('name' => __("Advanced", "gd-webfonts-toolbox-lite"), 'settings' => array(
                    new d4pSettingElement('settings', 'google_webfont_loader', __("WebFont Loader", "gd-webfonts-toolbox-lite"), __("Loader is provided for enhanced loading of selected fonts with asynchronious support.", "gd-webfonts-toolbox-lite"), d4pSettingType::BOOLEAN, gdwft_settings()->get('google_webfont_loader'))
                )),
                'gg_update' => array('name' => __("Fonts Auto Update", "gd-webfonts-toolbox-lite"), 'settings' => array(
                    new d4pSettingElement('settings', 'pro_update', __("Pro Version Only", "gd-webfonts-toolbox-lite"), __("Pro version of the plugin can auto update Google Fonts list and get latest fonts available. You need Google API key and to specifiy how often plugin will check for new fonts.", "gd-webfonts-toolbox-lite"), d4pSettingType::INFO)
                ))
            ),
            'adobe' => array(
                'ad_status' => array('name' => __("Adobe Edge Web Fonts", "gd-webfonts-toolbox-lite"), 'settings' => array(
                    new d4pSettingElement('settings', 'adobe_active', __("Status", "gd-webfonts-toolbox-lite"), __("This needs to be enabled so you can use Adobe Edge Web Fonts.", "gd-webfonts-toolbox-lite"), d4pSettingType::BOOLEAN, gdwft_settings()->get('adobe_active'))
                )),
                'ad_subsets' => array('name' => __("Subsets to load", "gd-webfonts-toolbox-lite"), 'settings' => array(
                    new d4pSettingElement('settings', 'adobe_subsets', __("Subsets", "gd-webfonts-toolbox-lite"), '', d4pSettingType::SELECT, gdwft_settings()->get('adobe_subsets'), 'array', $this->get_adobe_subsets())
                ))
            )
        );
    }

    public function get_google_subsets() {
        return array(
            'latin' => __("Latin", "gd-webfonts-toolbox-lite"),
            'latin-ext' => __("Latin Extended", "gd-webfonts-toolbox-lite"),
            'cyrillic' => __("Cyrillic", "gd-webfonts-toolbox-lite"),
            'cyrillic-ext' => __("Cyrillic Extended", "gd-webfonts-toolbox-lite"),
            'greek' => __("Greek", "gd-webfonts-toolbox-lite"),
            'greek-ext' => __("Greek Extended", "gd-webfonts-toolbox-lite"),
            'khmer' => __("Khmer", "gd-webfonts-toolbox-lite"),
            'vietnamese' => __("Vietnamese", "gd-webfonts-toolbox-lite"),
            'devanagari' => __("Devanagari", "gd-webfonts-toolbox-lite"),
            'telugu' => __("Telugu", "gd-webfonts-toolbox-lite")
        );
    }

    public function get_adobe_subsets() {
        return array(
            'default' => __("Default", "gd-webfonts-toolbox-lite"),
            'all' => __("All", "gd-webfonts-toolbox-lite")
        );
    }
}

?>