<?php

if (!defined('ABSPATH')) exit;

class gdwft_adobe extends gdwft_fonts_provider {
    public $_name = 'adobe';
    public $_label = 'Adobe Edge Web Fonts';

    public function download_list() {
        return false;
    }

    public function build_embed($fonts, $simple = false) {
        return '<script src="'.$this->build_url($fonts, $simple).'"></script>';
    }

    public function build_url($fonts, $simple = false) {
        $list = array();

        $subset = $this->subsets[0];

        foreach ($fonts as $font) {
            if ($this->is_valid($font)) {
                $item = $font;

                if (!$simple) {
                    $item.= ':'.join(',', $this->_list[$font]['variants']).':'.$subset;
                }

                $list[] = $item;
            }
        }

        return $this->url_prefix().'use.edgefonts.net/'.join(';', $list).'.js';
    }

    public function build_loader($fonts, $simple = false) {
        return '';
    }

    public function enqueue_files($fonts, $simple = false) {
        $url = $this->build_url($fonts, $simple);

        wp_enqueue_script('gdwft_adobe_webfonts', $url);
    }
}

class gdwft_adobe_font extends gdwft_font {
    public $provider = 'adobe';

    public function family_name() {
        return $this->slug;
    }

    public function list_variants() {
        $list = array('normal' => array(), 'italic' => array(), 'oblique' => array());

        foreach ($this->variants as $variant) {
            $parts = str_split($variant);

            $type = $parts[0] == 'i' ? 'italic' : 'normal';
            $list[$type][] = (int)$parts[1] * 100;
        }

        return $list;
    }
}

?>