<?php

if (!defined('ABSPATH')) exit;

class gdwft_google extends gdwft_fonts_provider {
    public $_name = 'google';
    public $_label = 'Google Web Fonts';

    public $api_key;
    public $webfont_loader;

    public function is_cacheable() {
        $is = parent::is_cacheable();

        return $is && $this->api_key != '';
    }

    public function download_list() {
        $url = 'https://www.googleapis.com/webfonts/v1/webfonts?key='.$this->api_key;

        $crl = curl_init();

        curl_setopt($crl, CURLOPT_URL, $url);
        curl_setopt($crl, CURLOPT_REFERER, $url);
        curl_setopt($crl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($crl, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($crl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($crl, CURLOPT_TIMEOUT, 3600);
        curl_setopt($crl, CURLOPT_CONNECTTIMEOUT, 240);

        $response = curl_exec($crl);

        if (!curl_errno($crl)) {
            $results = json_decode($response);
            $fonts = array();

            if (isset($results->items) && !empty($results->items)) {
                gdwft_settings()->set('last_check_google', time(), 'fonts', true);

                foreach ($results->items as $font) {
                    $font = (array)$font;

                    if (isset($font['kind'])) {
                        unset($font['kind']);
                    }

                    if (isset($font['files'])) {
                        unset($font['files']);
                    }

                    $font['slug'] = urlencode($font['family']);

                    $fonts[$font['family']] = $font;
                }
            }

            if (empty($fonts)) {
                return false;
            } else {
                return $fonts;
            }
        } else {
            return false;
        }
    }

    public function build_embed($fonts, $simple = false) {
        return '<link href="'.$this->build_url($fonts, $simple).'" type="text/css" />';
    }

    public function build_url($fonts, $simple = false) {
        $list = array();

        foreach ($fonts as $font) {
            if ($this->is_valid($font)) {
                $item = urlencode($font);

                if (!$simple) {
                    $item.= ':'.join(',', $this->_list[$font]['variants']);
                }

                $list[] = $item;
            }
        }

        $url = $this->url_prefix().'fonts.googleapis.com/css?family='.join('|', $list);

        if (!$simple) {
            $url.= '&subset='.join(',', $this->subsets);
        }

        return $url;
    }
    
    public function build_loader($fonts, $simple = false) {
        $list = array();

        foreach ($fonts as $font) {
            if ($this->is_valid($font)) {
                $item = $font;

                if (!$simple) {
                    $item.= ':'.join(',', $this->_list[$font]['variants']).':'.join(',', $this->subsets);
                }

                $list[] = $item;
            }
        }

        return $list;
    }

    public function enqueue_files($fonts, $simple = false) {
        $url = $this->build_url($fonts, $simple);

        wp_enqueue_style('gdwft_google_webfonts', $url);
    }
}

class gdwft_google_font extends gdwft_font {
    public $provider = 'google';

    public function list_variants() {
        $list = array('normal' => array(), 'italic' => array(), 'oblique' => array());

        foreach ($this->variants as $variant) {
            if ($variant == 'regular' || $variant == 'normal') {
                $list['normal'][] = 400;
            } else if ($variant == 'italic') {
                $list['italic'][] = 400;
            } else if ($variant == 'oblique') {
                $list['oblique'][] = 400;
            } else {
                $oblique = strpos($variant, 'oblique') !== false;
                $italic = strpos($variant, 'italic') !== false;

                $key = $oblique ? 'oblique' : ($italic ? 'italic' : 'normal');

                $list[$key][] = (int)$variant;
            }
        }

        return $list;
    }
}

?>