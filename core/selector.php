<?php

if (!defined('ABSPATH')) exit;

class gdwft_selector {
    public $id;

    public $code = '';
    public $label = '';
    public $type = 'default';
    public $source = '';
    public $args = array();

    public $active = true;

    public $selector = '';

    public $activity = array();

    public $custom = array();
    public $settings = array();
    public $shadows = array();
    public $box = array();
    public $box_shadows = array();

    public $font = array(
        'type' => 'none', 
        'value' => '', 
        'extra' => ''
    );

    function __construct() {
        $this->reset_rule();
    }

    public function to_array() {
        return (array)$this;
    }

    public function is_active($name) {
        $main = $this->activity[$name];

        if ($main) {
            switch ($name) {
                case 'font':
                    $main = $this->font['type'] != 'none';
                    break;
                case 'settings':
                    $main = !empty($this->settings);
                    break;
                case 'box':
                    $main = !empty($this->box);
                    break;
                case 'shadows':
                    $main = false;
                    break;
                case 'box_shadows':
                    $main = false;
                    break;
                case 'custom':
                    $main = !empty($this->custom);
                    break;
            }
        }
        
        return $main;
    }
    
    public function from_array($rule) {
        foreach ($rule as $key => $value) {
            $this->$key = $value;
        }
    }

    public function reset_rule() {
        $this->activity = array(
            'font' => true,
            'settings' => true,
            'box' => true,
            'shadows' => true,
            'box_shadows' => true,
            'custom' => true
        );

        $this->font = array(
            'type' => 'none', 
            'value' => '', 
            'extra' => ''
        );

        $this->custom = array();
        $this->settings = array();
        $this->shadows = array();
        $this->box = array();
        $this->box_shadows = array();
    }

    public function default_font($default) {
        $this->font['type'] = $default[0];
        $this->font['value'] = $default[1];

        if (isset($default[2])) {
            $this->font['extra'] = $default[2];
        }
    }

    public function create_code() {
        if ($this->code == '') {
            $this->code = $this->type.'-'.$this->source.'-'.sanitize_title_with_dashes($this->label);
        }
    }

    public function editor_style() {
        $style = array(
            'title' => $this->label,
            'classes' => substr($this->selector, 1)
        );

        if (!empty($this->args)) {
            $style[$this->args['method']] = $this->args['value'];
        } else {
            $style['inline'] = 'span';
        }

        return $style;
    }

    public function build($loader = false) {
        $styles = array();

        $font = $this->build_font();
        $style = array_merge($this->build_settings(false), 
                             $this->build_settings(true),
                             $this->build_box());

        if (!empty($style) && gdwft_settings()->get('important_settings')) {
            for ($i = 0; $i < count($style); $i++) {
                $style[$i].= ' !important';
            }
        }

        if (!empty($this->custom) && $this->is_active('custom')) {
            $style = array_merge($style, $this->custom);
        }

        $properties = join(';', $style);

        if ($font != '') {
            if ($loader && $this->font['type'] == 'google') {
                $styles[] = array('selector' => $this->wf_active(), 'properties' => $font, 'label' => $this->label.' --- '.__("Font with Loader", "gd-webfonts-toolbox-lite"));
            } else {
                $styles[] = array('selector' => $this->selector, 'properties' => $font, 'label' => $this->label.' --- '.__("Font", "gd-webfonts-toolbox-lite"));
            }
        }

        if (!empty($properties)) {
            $styles[] = array('selector' => $this->selector, 'properties' => $properties.';', 'label' => $this->label.' --- '.__("Styles", "gd-webfonts-toolbox-lite"));
        }

        return $styles;
    }

    public function wf_active() {
        $selectors = array_map('trim', explode(',', $this->selector));

        $selector = array();
        foreach ($selectors as $sel) {
            $selector[] = '.wf-active '.$sel;
        }

        return join(',', $selector);
    }

    public function build_font() {
        $style = '';

        if (!$this->is_active('font')) return $style;

        switch ($this->font['type']) {
            case 'inherit':
                $style = 'font-family: inherit';
                break;
            case 'generic':
                $style = 'font-family: '.$this->font['value'];
                break;
            case 'stack':
                $style = 'font-family: '.gdwft_plugin()->stacks->get($this->font['value']);
                break;
            case 'google':
            case 'adobe':
            case 'typekit':
            case 'fontface':
                $style = 'font-family: "'.$this->font['value'].'"';

                if ($this->font['extra'] != '') {
                    $style.= ','.$this->font['extra'];
                }
                break;
        }

        if ($style != '') {
            if (gdwft_settings()->get('important_font')) {
                $style.= ' !important;';
            } else {
                $style.= ';';
            }
        }

        return $style;
    }

    public function build_settings($settings = true) {
        $style = array();

        $_get = $settings ? 'settings' : 'font';
        $font_settings = array('font-style', 'font-variant', 'font-weight', 'font-size');
        
        if (!$this->is_active($_get)) return $style;

        foreach ($this->settings as $key => $data) {
            if (($settings && !in_array($key, $font_settings)) || (!$settings && in_array($key, $font_settings))) {
                if ($data['select'] != '') {
                    if ($data['select'] != 'value') {
                        $style[] = $key.': '.$data['select'];
                    } else {
                        if ($key == 'color') {
                            $style[] = $key.': '.$this->build_color($data['hex'], $data['opacity']);
                        } else {
                            $style[] = $key.': '.$data['custom'].$data['unit'];
                        }
                    }
                }
            }
        }

        return $style;
    }
    
    public function build_box() {
        $style = array();

        if (!$this->is_active('box')) return $style;

        $_done = array();

        $_parents = array(
            'border-top-left-radius' => array('border-radius', 'all'),
            'border-top-right-radius' => array('border-radius', 'all'),
            'border-bottom-right-radius' => array('border-radius', 'all'),
            'border-bottom-left-radius' => array('border-radius', 'all'),
            'margin-topbottom' => array('margin', 'pair'),
            'margin-leftright' => array('margin', 'pair'),
            'margin-top' => array('margin', 'all'),
            'margin-right' => array('margin', 'all'),
            'margin-bottom' => array('margin', 'all'),
            'margin-left' => array('margin', 'all'),
            'padding-topbottom' => array('padding', 'pair'),
            'padding-leftright' => array('padding', 'pair'),
            'padding-top' => array('padding', 'all'),
            'padding-right' => array('padding', 'all'),
            'padding-bottom' => array('padding', 'all'),
            'padding-left' => array('padding', 'all'),
            'border-topbottom' => array('border', 'pair'),
            'border-leftright' => array('border', 'pair'),
            'border-top' => array('border', 'all'),
            'border-right' => array('border', 'all'),
            'border-bottom' => array('border', 'all'),
            'border-left' => array('border', 'all')
        );

        foreach ($this->box as $key => $data) {
            $real_key = $key;
            $real_data = $data;
            $real_custom = '';

            if (isset($_parents[$key])) {
                $real_key = $_parents[$key][0];
                $real_custom = $_parents[$key][1];
                $real_data = $this->box[$real_key];
            }

            if (!in_array($real_key, $_done)) {
                $style = array_merge($style, $this->build_box_single($real_key, $real_data, $real_custom));
                $_done[] = $real_key;
            }
        }

        return $style;
    }
    
    public function build_box_single($key, $data, $custom) {
        $prefixed = array('box-sizing');
        $style = array();

        $_map = array(
            'border' => array(
                'value_pair' => array('border-topbottom', 'border-leftright'),
                'value_all' => array('border-top', 'border-right', 'border-bottom', 'border-left')
            ),
            'border-radius' => array(
                'value_all' => array('border-top-left-radius', 'border-top-right-radius', 'border-bottom-right-radius', 'border-bottom-left-radius')
            ),
            'margin' => array(
                'value_pair' => array('margin-topbottom', 'margin-leftright'),
                'value_all' => array('margin-top', 'margin-right', 'margin-bottom', 'margin-left')
            ),
            'padding' => array(
                'value_pair' => array('padding-topbottom', 'padding-leftright'),
                'value_all' => array('padding-top', 'padding-right', 'padding-bottom', 'padding-left')
            )
        );

        $_pairs = array(
            'border-topbottom' => array('border-top', 'border-bottom'),
            'border-leftright' => array('border-right', 'border-left')
        );

        if (substr($data['select'], 0, 5) == 'value') {
            if ($data['select'] == 'value') {
                if ($key == 'background') {
                    $style[] = $key.': '.$this->build_color($data['hex'], $data['opacity']);
                } else if (isset($data['hex'])) {
                    $style[] = $key.': '.$data['custom'].$data['unit'].' '.$data['style'].' '.$this->build_color($data['hex'], $data['opacity']);
                } else {
                    $style[] = $key.': '.$data['custom'].$data['unit'];
                }
            } else if ($data['select'] == 'value_pair' || $data['select'] == 'value_all') {
                $minor = array();

                for ($i = 0; $i < count($_map[$key][$data['select']]); $i++) {
                    $t = $_map[$key][$data['select']][$i];
                    $minor[$t] = $this->box[$t];
                }

                if (isset($data['hex'])) {
                    if ($data['select'] == 'value_pair') {
                        foreach ($minor as $t => $pair) {
                            $z = $_pairs[$t];

                            for ($j = 0; $j < 2; $j++) {
                                $style[] = $z[$j].': '.$pair['custom'].$pair['unit'].' '.$pair['style'].' '.$this->build_color($pair['hex'], $pair['opacity']);
                            }
                        }
                    } else if ($data['select'] == 'value_all') {
                        foreach ($minor as $t => $pair) {
                            $style[] = $t.': '.$pair['custom'].$pair['unit'].' '.$pair['style'].' '.$this->build_color($pair['hex'], $pair['opacity']);
                        }
                    }
                } else {
                    $_style = $key.': ';

                    foreach ($minor as $m) {
                        $_style.= $m['custom'].$m['unit'].' ';
                    }

                    $style[] = trim($_style);
                }
            }
        } else if ($data['select'] != '') {
            $style[] = $key.': '.$data['select'];

            if ($key == 'box-sizing') {
                $style[] = '-moz-'.$key.': '.$data['select'];
                $style[] = '-webkit-'.$key.': '.$data['select'];
            }
        }

        return $style;
    }

    public function build_custom() {
        return $this->custom;
    }

    public function build_color($hex, $opacity) {
        if (floatval($opacity) == 1) {
            return $hex;
        } else {
            return gdwft_hex_to_rgba($hex, $opacity);
        }
    }

    public function display_source() {
        $render = '';

        switch ($this->type) {
            case 'default':
                $render = __("Default Selector", "gd-webfonts-toolbox-lite");
                break;
            case 'custom':
                $render = __("Custom Selector", "gd-webfonts-toolbox-lite");
                break;
            case 'editor':
                $render = __("For Editor Integration", "gd-webfonts-toolbox-lite");

                if (!empty($this->args)) {
                    $render.= ' | '.__(ucfirst($this->args['method']), "smart-web-fonts-control");
                    $render.= ': '.$this->args['value'];
                }
                break;
            case 'themes':
                $render = __("Theme Specific", "gd-webfonts-toolbox-lite");
                $render.= ' | '.$this->source;
                break;
            case 'plugins':
                $render = __("Plugin Specific", "gd-webfonts-toolbox-lite");
                $render.= ' | '.$this->source;
                break;
        }

        return $render;
    }

    public function display_font() {
        $render = '';

        switch ($this->font['type']) {
            default:
            case '':
                $render = '<strong>-</strong>';
                break;
            case 'inherit':
                $render = '<strong>'.__("Inherit", "gd-webfonts-toolbox-lite").'</strong>';
                break;
            case 'generic':
                $render = '<strong>'.__("Generic", "gd-webfonts-toolbox-lite").'</strong> '.gdwft_plugin()->stacks->generic[$this->font['value']];
                break;
            case 'stack':
                $render = '<strong>'.__("Standard", "gd-webfonts-toolbox-lite").':</strong> '.ucwords(str_replace('-', ' ', $this->font['value']));
                break;
            case 'google':
                $render = '<strong>'.__("Google Web Font", "gd-webfonts-toolbox-lite").':</strong> '.$this->font['value'];

                if (!gdwft_font_exists('google', $this->font['value'])) {
                    $render.= ' <strong style="color: #990000">('.__("missing", "gd-webfonts-toolbox-lite").')</strong>';
                }

                if ($this->font['extra'] != '' && $this->font['extra'] != 'none') {
                    $render.= ' ('.gdwft_plugin()->stacks->generic[$this->font['extra']].')';
                }
                break;
            case 'adobe':
                $font = gdwft_get_font('adobe', $this->font['value']);
                $render = '<strong>'.__("Adobe Web Font", "gd-webfonts-toolbox-lite").':</strong> '.$font->family;

                if (!gdwft_font_exists('adobe', $this->font['value'])) {
                    $render.= ' <strong style="color: #990000">('.__("missing", "gd-webfonts-toolbox-lite").')</strong>';
                }

                if ($this->font['extra'] != '' && $this->font['extra'] != 'none') {
                    $render.= ' ('.gdwft_plugin()->stacks->generic[$this->font['extra']].')';
                }
                break;
            case 'typekit':
                $font = gdwft_get_font('typekit', $this->font['value']);
                $render = '<strong>'.__("TypeKit Font", "gd-webfonts-toolbox-lite").':</strong> '.$font->family;

                if (!gdwft_font_exists('typekit', $this->font['value'])) {
                    $render.= ' <strong style="color: #990000">('.__("missing", "gd-webfonts-toolbox-lite").')</strong>';
                }

                if ($this->font['extra'] != '' && $this->font['extra'] != 'none') {
                    $render.= ' ('.gdwft_plugin()->stacks->generic[$this->font['extra']].')';
                }
                break;
            case 'fontface':
                $font = gdwft_get_font('fontface', $this->font['value']);
                $render = '<strong>'.__("FontFace Font", "gd-webfonts-toolbox-lite").':</strong> '.$font->family;

                if (!gdwft_font_exists('fontface', $this->font['value'])) {
                    $render.= ' <strong style="color: #990000">('.__("missing", "gd-webfonts-toolbox-lite").')</strong>';
                }

                if ($this->font['extra'] != '' && $this->font['extra'] != 'none') {
                    $render.= ' ('.gdwft_plugin()->stacks->generic[$this->font['extra']].')';
                }
                break;
        }

        return $render;
    }

    public function display_rule() {
        $render = '<ul><li class="'.($this->is_active('font') ? '' : 'disabled').'"><i class="fa fa-'.($this->is_active('font') ? 'check-' : '').'square-o"></i> <span class="text">Font Styles</span></li>';
        $render.= '<li class="'.($this->is_active('settings') ? '' : 'disabled').'"><i class="fa fa-'.($this->is_active('settings') ? 'check-' : '').'square-o"></i> <span class="text">Text Styles</span></li>';
        $render.= '<li class="'.($this->is_active('shadows') ? '' : 'disabled').'"><i class="fa fa-'.($this->is_active('shadows') ? 'check-' : '').'square-o"></i> <span class="text">Text Shadows</span></li>';
        $render.= '<li class="'.($this->is_active('box_shadows') ? '' : 'disabled').'"><i class="fa fa-'.($this->is_active('box_shadows') ? 'check-' : '').'square-o"></i> <span class="text">Box Shadows</span></li>';
        $render.= '<li class="'.($this->is_active('box') ? '' : 'disabled').'"><i class="fa fa-'.($this->is_active('box') ? 'check-' : '').'square-o"></i> <span class="text">Box Model</span></li>';
        $render.= '<li class="'.($this->is_active('custom') ? '' : 'disabled').'"><i class="fa fa-'.($this->is_active('custom') ? 'check-' : '').'square-o"></i> <span class="text">Custom Styles</span></li></ul>';

        return $render;
    }
}

?>