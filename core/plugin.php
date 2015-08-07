<?php

if (!defined('ABSPATH')) exit;

class gdwft_core_plugin extends d4pCORE {
    public $fonts = array();

    public $fonts_folder_name = 'webfonts';
    public $stacks;
    public $selectors;
    public $overrides;

    public $providers = array(
        'google' => null, 
        'adobe' => null
    );

    public function core() {
        parent::core();

        define('GDWFT_WPV', intval($this->wp_version));

        add_action('init', array(&$this, 'init_language'));
        add_action('gdwft_plugin_settings_loaded', array(&$this, 'init_settings'));

        do_action('gdwft_plugin_core_ready');
    }

    public function enqueue_scripts() { }

    public function init() {
        parent::init();

        $this->init_themes();

        $this->stacks = new gdwft_core_stacks();
        $this->selectors = new gdwft_core_selectors();

        foreach (array_keys($this->providers) as $provider) {
            if ($this->is_provider_active($provider)) {
                require_once(GDWFT_PATH.'fonts/'.$provider.'/init.php');

                $class = 'gdwft_'.$provider;
                $this->providers[$provider] = new $class();
            }
        }

        $this->overrides = apply_filters('gdwft_override_defaults', array(
            'default_rule_type' => 'default',
            'preview_text' => 'GD WebFonts Toolbox Lite '.gdwft_settings()->get('version', 'info')
        ));

        do_action('gdwft_init_selectors');
        do_action('gdwft_init_extra_fonts');

        gdwft_settings()->style_file();

        do_action('gdwft_plugin_init_ready');
    }

    public function init_language() {
        $language = get_locale();

        if(!empty($language)) {
            load_plugin_textdomain('gd-webfonts-toolbox', false, 'gd-webfonts-toolbox-lite/languages');
        }
    }

    public function init_settings() {
        
    }

    public function init_themes() {
        $files = array(
            STYLESHEETPATH.'/fonts-box.php',
            GDWFT_PATH.'themes/'.get_stylesheet().'/fonts-box.php',
            TEMPLATEPATH.'/fonts-box.php',
            GDWFT_PATH.'themes/'.$this->current_template().'/fonts-box.php'
        );

        if (defined('XSCAPE_FRAMEWORK_VERSION')) {
            $files[] = XSCAPE_PATH.'/fonts-box.php';
        }

        foreach ($files as $file) {
            if (file_exists($file)) {
                require_once($file);
                break;
            }
        }
    }

    public function current_template() {
        return wp_get_theme()->get_template();
    }

    public function provider_name($provider) {
        return $this->providers[$provider]->_label;
    }
    
    public function is_provider_valid($provider) {
        return isset($this->providers[$provider]);
    }

    public function is_provider_active($provider) {
        return gdwft_settings()->get($provider.'_active');
    }

    public function is_font_valid($provider, $font) {
        if ($this->is_provider_active($provider)) {
            return $this->providers[$provider]->is_valid($font);
        } else {
            return false;
        }
    }

    public function fonts_scanner() {
        require_once(GDWFT_PATH.'core/scanner.php');

        gdwft_scan_for_webfonts();

        gdwft_settings()->set('trigger_scanner', false, 'core');
        gdwft_settings()->save('core');
    }

    public function get_font($provider, $name) {
        if ($this->is_provider_active($provider)) {
            $this->providers[$provider]->init_fonts();

            if (isset($this->providers[$provider]->_list[$name])) {
                return $this->providers[$provider]->_list[$name];
            } else {
                return new WP_Error('font_not_found', __("Font Not Found", "gd-webfonts-toolbox-lite"));
            }
        }

        return null;
    }

    public function get($name) {
        return $this->overrides[$name];
    }
}

class gdwft_core_stacks {
    public $generic = array();
    public $default = array();

    public function __construct() {
        $this->generic = apply_filters('gdwft_fontstacks_generic', array(
            'sans-serif' => __("Sans Serif", "gd-webfonts-toolbox-lite"),
            'serif' => __("Serif", "gd-webfonts-toolbox-lite"),
            'monospace' => __("Monospace", "gd-webfonts-toolbox-lite"),
            'fantasy' => __("Fantasy", "gd-webfonts-toolbox-lite"),
            'cursive' => __("Cursive", "gd-webfonts-toolbox-lite")
        ));

        $this->default = apply_filters('gdwft_fontstacks_stacks', array(
            'sans-serif' => array('title' => __("Sans Serif", "gd-webfonts-toolbox-lite"), 'values' => array(
                'arial' => 'Arial, "Helvetica Neue", Helvetica, sans-serif',
                'arial-black' => '"Arial Black", "Arial Bold", Gadget, sans-serif',
                'century-gothic' => '"Century Gothic", CenturyGothic, AppleGothic, sans-serif',
                'helvetica' => '"Helvetica Neue", Helvetica, Arial, sans-serif',
                'tahoma' => 'Tahoma, Verdana, Segoe, sans-serif',
                'trebuchet-ms' => '"Trebuchet MS", "Lucida Grande", "Lucida Sans Unicode", "Lucida Sans", Tahoma, sans-serif',
                'verdana' => 'Verdana, Geneva, sans-serif'
            )),
            'serif' => array('title' => __("Serif", "gd-webfonts-toolbox-lite"), 'values' => array(
                'garmond' => 'Garamond, Baskerville, "Baskerville Old Face", "Hoefler Text", "Times New Roman", serif',
                'georgia' => 'Georgia, Times, "Times New Roman", serif',
                'palatino' => 'Palatino, "Palatino Linotype", "Palatino LT STD", "Book Antiqua", Georgia, serif',
                'times-new-roman' => 'TimesNewRoman, "Times New Roman", Times, Baskerville, Georgia, serif',
            )),
            'monospace' => array('title' => __("Monospace", "gd-webfonts-toolbox-lite"), 'values' => array(
                'courier-new' => '"Courier New", Courier, "Lucida Sans Typewriter", "Lucida Typewriter", monospace',
                'lucida-sans-typewriter' => '"Lucida Sans Typewriter", "Lucida Console", Monaco, "Bitstream Vera Sans Mono", monospace;',
            )),
            'fantasy' => array('title' => __("Fantasy", "gd-webfonts-toolbox-lite"), 'values' => array(
                'copperplate' => 'Copperplate, "Copperplate Gothic Light", fantasy',
                'papyrus' => 'Papyrus, fantasy'
            )),
            'cursive' => array('title' => __("Cursive", "gd-webfonts-toolbox-lite"), 'values' => array(
                'brush-script-mt' => '"Brush Script MT", cursive'
            ))
        ));
    }

    public function get($name) {
        foreach ($this->default as $data) {
            foreach ($data['values'] as $key => $style) {
                if ($name == $key) {
                    return $style;
                }
            }
        }

        return '';
    }
}

class gdwft_core_selectors {
    public $default = array();
    public $plugins = array();
    public $themes = array();

    public function __construct() {
        $this->default = apply_filters('gdwft_selectors_generic', array(
            'body' => array('type' => 'default', 'code' => 'body', 'label' => __("Body", "gd-webfonts-toolbox-lite"), 'selector' => 'body', 'source' => '', 'font' => array('google', 'Open Sans', 'sans-serif')),
            'paragraph' => array('type' => 'default', 'code' => 'paragraph', 'label' => __("Paragraphs", "gd-webfonts-toolbox-lite"), 'selector' => 'p', 'source' => '', 'font' => array()),
            'blockquote' => array('type' => 'default', 'code' => 'blockquote', 'label' => __("Blockquote", "gd-webfonts-toolbox-lite"), 'selector' => 'blockquote', 'source' => '', 'font' => array()),
            'headings' => array('type' => 'default', 'code' => 'headings', 'label' => __("All Headings", "gd-webfonts-toolbox-lite"), 'selector' => 'h1,h2,h3,h4,h5,h6', 'source' => '', 'font' => array()),
            'heading_h1' => array('type' => 'default', 'code' => 'heading_h1', 'label' => __("Heading: H1", "gd-webfonts-toolbox-lite"), 'selector' => 'h1', 'source' => '', 'font' => array()),
            'heading_h2' => array('type' => 'default', 'code' => 'heading_h2', 'label' => __("Heading: H2", "gd-webfonts-toolbox-lite"), 'selector' => 'h2', 'source' => '', 'font' => array()),
            'heading_h3' => array('type' => 'default', 'code' => 'heading_h3', 'label' => __("Heading: H3", "gd-webfonts-toolbox-lite"), 'selector' => 'h3', 'source' => '', 'font' => array()),
            'heading_h4' => array('type' => 'default', 'code' => 'heading_h4', 'label' => __("Heading: H4", "gd-webfonts-toolbox-lite"), 'selector' => 'h4', 'source' => '', 'font' => array()),
            'heading_h5' => array('type' => 'default', 'code' => 'heading_h5', 'label' => __("Heading: H5", "gd-webfonts-toolbox-lite"), 'selector' => 'h5', 'source' => '', 'font' => array()),
            'heading_h6' => array('type' => 'default', 'code' => 'heading_h6', 'label' => __("Heading: H6", "gd-webfonts-toolbox-lite"), 'selector' => 'h6', 'source' => '', 'font' => array()),
            'headings_high' => array('type' => 'default', 'code' => 'headings_high', 'label' => __("Headings: H1/2/3", "gd-webfonts-toolbox-lite"), 'selector' => 'h1,h2,h3', 'source' => '', 'font' => array()),
            'headings_low' => array('type' => 'default', 'code' => 'headings_low', 'label' => __("Headings: H4/5/6", "gd-webfonts-toolbox-lite"), 'selector' => 'h4,h5,h6', 'source' => '', 'font' => array())
        ));
    }

    public function all() {
        return array(
            'default' => $this->default, 
            'plugins' => $this->plugins, 
            'themes' => $this->themes
        );
    }

    public function get($type, $name) {
        return $this->{$type}[$name];
    }
}

?>