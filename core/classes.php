<?php

if (!defined('ABSPATH')) exit;

abstract class gdwft_fonts_provider {
    public $_list = false;
    public $_loaded = array();

    public $_name = '';
    public $_label = '';

    public $variants = array();

    public $active;
    public $cache_days;
    public $subsets;

    function __construct() {
        $settings = gdwft_settings()->prefix_get($this->_name.'_');

        foreach ($settings as $key => $value) {
            $this->$key = $value;
        }
    }

    public function init_fonts() {
        if ($this->_list === false) {
            if ($this->is_cacheable()) {
                $this->_list = get_transient('webfonts-toolbox-'.$this->_name);

                if ($this->_list === false) {
                    $this->_list = $this->download_list();

                    if ($this->_list !== false) {
                        set_transient('webfonts-toolbox-'.$this->_name, $this->_list, $this->cache_days * 24 * 3600);
                    }
                }
            }

            if ($this->_list === false) {
                include(GDWFT_PATH.'fonts/'.$this->_name.'/list.php');

                $this->_list = $gdwft_fonts_list;
            }
        }
    }

    public function is_valid($font) {
        $this->init_fonts();

        return isset($this->_list[$font]);
    }

    public function is_cacheable() {
        return function_exists('curl_init');
    }

    public function fonts_list() {
        $this->init_fonts();

        return $this->_list;
    }

    public function fonts_count() {
        $this->init_fonts();

        return count($this->_list);
    }

    public function url_prefix() {
        return is_ssl() ? 'https://' : 'http://';
    }

    abstract public function download_list();

    abstract public function build_embed($fonts, $simple = false);
    abstract public function build_url($fonts, $simple = false);
    abstract public function build_loader($fonts, $simple = false);

    abstract public function enqueue_files($fonts, $simple = false);
}

abstract class gdwft_font {
    public $provider;

    public $name;

    public $family = '';
    public $slug = '';
    public $category = '';
    public $variants = array();
    public $subsets = array();

    public $error = false;

    function __construct($name) {
        $this->name = $name;

        $font = gdwft_plugin()->get_font($this->provider, $this->name);

        if (is_wp_error($font)) {
            $this->error = $font;
            $this->family = $name;
        } else {
            foreach ($font as $key => $value) {
                $this->$key = $value;
            }
        }
    }

    public function family_name() {
        return $this->family;
    }

    public function generic_name() {
        if ($this->category != '') {
            if ($this->category == 'display') {
                return 'fantasy';
            } else if ($this->category == 'handwriting') {
                return 'cursive';
            }
        }

        return $this->category;
    }

    public function full_family() {
        $family = '"'.$this->family_name().'"';

        $generic = $this->generic_name();

        if ($generic != '') {
            $family.= ', '.$generic;
        }

        return $family.';';
    }
    
    abstract public function list_variants();
}

abstract class gdwft_theme {
    public $name = '';
    public $defaults = array();

    function __construct() {
        add_action('gdwft_init_selectors', array(&$this, 'selectors'));
        add_action('gdwft_init_extra_fonts', array(&$this, 'fonts'));

        if (is_array($this->defaults) && !empty($this->defaults)) {
            add_filter('gdwft_override_defaults', array(&$this, 'overrides'));
        }
    }

    private function overrides($list) {
        foreach ($this->defaults as $key => $value) {
            $list[$key] = $value;
        }

        return $list;
    }

    /**
     * Add new selector.
     * 
     * @param string $code unique selecter identifier
     * @param string $label selector label used for admin side display
     * @param string $selector CSS selector for styling
     * @param string $font_provider provider for default font for selector
     *               supported values: 'google', 'adobe', 'typekit', 'fontface'
     * @param string $font_name name of the default font family for selector
     * @param string $font_generic generic font family for selector
     */
    protected function selector($code, $label, $selector, $font_provider = 'google', $font_name = '', $font_generic = '') {
        $font = array($font_provider, $font_name);

        if ($font_generic != '') {
            $font[] = $font_generic;
        }

        gdwft_register_theme_selector($code, $label, $selector, $this->name, $font);
    }

    /**
     * Add font for direct loading.
     * 
     * @param string $provider supported values: 'google', 'adobe', 'typekit', 'fontface'
     * @param string $name font name for specified provider
     * @param bool $editor should the font be used in Editor
     */
    protected function font($provider, $name, $editor = true) {
        gdwft_register_font_to_load($provider, $name, $editor);
    }

    /**
     * Add selecters inside this method.
     */
    public function selectors() { }

    /**
     * Add direct loading fonts inside this method.
     */
    public function fonts() { }
}

?>