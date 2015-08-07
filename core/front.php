<?php

if (!defined('ABSPATH')) exit;

class gdwft_front {
    public $loader_google = false;

    public $loader_version = '1.5.18';
    public $loader_timeout = 3000;

    public $fonts = array(
        'adobe' => array(),
        'google' => array()
    );

    public $webfont_google = array();

    public $styles = array();

    function __construct() {
        add_action('wp', array(&$this, 'init'));
    }

    private function prepare() {
        $data = array('fonts' => array(
                'adobe' => array(), 
                'google' => array()
            ), 
            'loader' => array(), 
            'styles' => array()
        );

        $order = gdwft_settings()->get('order', 'rules');
        $list = gdwft_settings()->get('list', 'rules');
        $fonts = gdwft_settings()->get('include', 'fonts');

        foreach ($order as $key) {
            if ($list[$key]['active']) {
                $rule = new gdwft_selector();
                $rule->from_array($list[$key]);

                $loader = false;
                if ($rule->font['type'] == 'adobe') {
                    $data['fonts']['adobe'][] = $rule->font['value'];
                } else if ($rule->font['type'] == 'google') {
                    if ($this->loader_google) {
                        $loader = true;

                        $data['loader'][] = $rule->font['value'];
                    } else {
                        $data['fonts']['google'][] = $rule->font['value'];
                    }
                }

                $data['styles'] = array_merge($data['styles'], $rule->build($loader));
            }
        }

        foreach ($fonts as $inc) {
            $name = $inc['name'];

            if ($inc['provider'] == 'adobe') {
                if (!in_array($name, $data['fonts']['adobe'])) {
                    $data['fonts']['adobe'][] = $name;
                }
            } else if ($inc['provider'] == 'google') {
                if ($this->loader_google) {
                    if (!in_array($name, $data['loader'])) {
                        $data['loader'][] = $name;
                    }
                } else {
                    if (!in_array($name, $data['fonts']['google'])) {
                        $data['fonts']['google'][] = $name;
                    }
                }
            }
        }

        return $data;
    }

    public function init() {
        $this->loader_google = gdwft_settings()->get('google_webfont_loader');

        $load = apply_filters('gdwft_load_control', true);
        $cache = apply_filters('gdwft_cache_control', gdwft_settings()->get('cache_styles_active'));

        if ($load) {
            add_action('wp_enqueue_scripts', array(&$this, 'enqueue'));
            add_action('wp_head', array(&$this, 'header'), 10000);

            if ($cache) {
                $data = get_transient('webfonts-toolbox-styles');

                if ($data === false) {
                    $data = $this->prepare();

                    set_transient('webfonts-toolbox-styles', $data, gdwft_settings()->get('cache_styles_days') * 24 * 3600);
                }
            } else {
                $data = $this->prepare();
            }
        }

        $this->fonts = $data['fonts'];
        $this->webfont_google = $data['loader'];
        $this->styles = $data['styles'];

        define('GDWFT_GOOGLE_WEBFONTS_LOADER_ACTIVE', !empty($this->webfont_google));
    }

    public function enqueue() {
        if (!empty($this->fonts['google'])) {
            gdwft_plugin()->providers['google']->init_fonts();
            gdwft_plugin()->providers['google']->enqueue_files($this->fonts['google']);
        }

        if (!empty($this->fonts['adobe'])) {
            gdwft_plugin()->providers['adobe']->init_fonts();
            gdwft_plugin()->providers['adobe']->enqueue_files($this->fonts['adobe']);
        }
    }

    public function header() {
        if ($this->loader_google) {
            $this->loader();
        }

        if (!empty($this->styles)) {
            echo '<style type="text/css">'.D4P_EOL;

            foreach ($this->styles as $style) {
                echo '/* '.$style['label'].' */'.D4P_EOL;
                echo $style['selector'].'{'.D4P_EOL;
                echo D4P_TAB.$style['properties'].D4P_EOL;
                echo '}'.D4P_EOL;
            }

            echo '</style>'.D4P_EOL;
        }
    }

    public function loader() {
        $script = array(
            'timeout: '.$this->loader_timeout,
            'classes: true'
        );

        if (!empty($this->webfont_google)) {
            $google = apply_filters('gdwft_google_loader_webfonts', $this->webfont_google);

            gdwft_plugin()->providers['google']->init_fonts();
            $fonts = gdwft_plugin()->providers['google']->build_loader($google);

            $final = apply_filters('gdwft_google_loader_webfonts_prepared', $fonts);

            $script[] = 'google: { families: '.json_encode($final).' }';
        }

        ?>
<script type="text/javascript">
WebFontConfig = {<?php echo D4P_EOL.join(', '.D4P_EOL.D4P_TAB, $script); ?>};

(function() {
    var wf = document.createElement('script');
    wf.src = ('https:' == document.location.protocol ? 'https' : 'http') +
              '://ajax.googleapis.com/ajax/libs/webfont/<?php echo $this->loader_version; ?>/webfont.js';
    wf.type = 'text/javascript';
    wf.async = 'true';
    var s = document.getElementsByTagName('script')[0];
    s.parentNode.insertBefore(wf, s);
})();
</script>
        <?php
    }
}

?>