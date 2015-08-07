<?php

if (!defined('ABSPATH')) exit;

class gdwft_rule {
    public $activity = array(
        'font',
        'settings',
        'box',
        'shadows',
        'box_shadows',
        'custom'
    );

    function __construct() { }

    public function parse($args, $rule) {
        $rule['activity'] = array();
        foreach ($this->activity as $key) {
            $rule['activity'][$key] = isset($args['activity'][$key]);
        }

        $rule['font']['type'] = $args['font']['type'];
        if ($args['font']['type'] == 'none') {
            $rule['font']['value'] = '';
        } else {
            $rule['font']['value'] = $args['font'][$args['font']['type']];
            $rule['font']['extra'] = $args['font']['extra'];
        }

        $_select = $this->data();

        $_styles = array_keys($this->styles());
        $_units = array_keys($this->units());

        $_settings = $this->post_settings();

        foreach ($_settings as $code => $list) {
            foreach ($list as $name) {
                $value = isset($args['settings'][$code][$name]) ? $args['settings'][$code][$name] : '';

                if ($value != '') {
                    switch ($name) {
                        case 'select':
                            $valid = array_keys($_select['settings'][$code]);

                            if (!in_array($value, $valid)) {
                                $value = '';
                            }
                            break;
                        case 'style':
                            if (!in_array($value, $_styles)) {
                                $value = 'none';
                            }
                            break;
                        case 'hex':
                            if (!preg_match('/^#[a-f0-9]{6}$/i', $value)) {
                                $value = '#ffffff';
                            }
                            break;
                        case 'opacity':
                            $value = $this->clean_opacity($value);
                            break;
                        case 'custom':
                            $value = $this->clean_custom($value);
                            break;
                        case 'unit':
                            if (!in_array($value, $_units)) {
                                $value = 'px';
                            }
                            break;
                    }
                }

                $rule['settings'][$code][$name] = $value;
            }
        }

        $_box = $this->post_box();

        foreach ($_box as $code => $list) {
            foreach ($list as $name) {
                $value = isset($args['box'][$code][$name]) ? $args['box'][$code][$name] : '';

                if ($value != '') {
                    switch ($name) {
                        case 'select':
                            $valid = array_keys($_select['box'][$code]);

                            if (!in_array($value, $valid)) {
                                $value = '';
                            }
                            break;
                        case 'style':
                            if (!in_array($value, $_styles)) {
                                $value = 'none';
                            }
                            break;
                        case 'hex':
                            if (!preg_match('/^#[a-f0-9]{6}$/i', $value)) {
                                $value = '#ffffff';
                            }
                            break;
                        case 'opacity':
                            $value = $this->clean_opacity($value);
                            break;
                        case 'custom':
                            $value = $this->clean_custom($value);
                            break;
                        case 'unit':
                            if (!in_array($value, $_units)) {
                                $value = 'px';
                            }
                            break;
                    }
                }

                $rule['box'][$code][$name] = $value;
            }
        }

        $rule['shadows'] = array();
        $rule['box_shadows'] = array();

        $styles = str_replace(array("\r\n", "\r", "\n"), '', $args['custom']);
        $custom_styles = array_map('trim', explode(';', $styles));
        $rule['custom'] = array_filter($custom_styles);

        return $rule;
    }

    public function post_settings() {
        return array(
            'color' => array('select', 'hex', 'opacity'),
            'vertical-align' => array('select', 'custom', 'unit'),
            'line-height' => array('select', 'custom', 'unit'),
            'word-spacing' => array('select', 'custom', 'unit'),
            'font-size' => array('select', 'custom', 'unit'),
            'text-indent' => array('select', 'custom', 'unit'),
            'letter-spacing' => array('select', 'custom', 'unit'),
            'direction' => array('select'),
            'word-break' => array('select'),
            'white-space' => array('select'),
            'font-style' => array('select'),
            'font-variant' => array('select'),
            'font-weight' => array('select'),
            'text-align' => array('select'),
            'text-decoration' => array('select'),
            'text-transform' => array('select')
        );
    }

    public function post_box() {
        return array(
            'background' => array('select', 'hex', 'opacity'),
            'display' => array('select'),
            'clear' => array('select'),
            'box-sizing' => array('select'),
            'width' => array('select', 'custom', 'unit'),
            'height' => array('select', 'custom', 'unit'),
            'min-width' => array('select', 'custom', 'unit'),
            'min-height' => array('select', 'custom', 'unit'),
            'max-width' => array('select', 'custom', 'unit'),
            'max-height' => array('select', 'custom', 'unit'),
            'border-radius' => array('select', 'custom', 'unit'),
            'border-top-left-radius' => array('custom', 'unit'),
            'border-top-right-radius' => array('custom', 'unit'),
            'border-bottom-right-radius' => array('custom', 'unit'),
            'border-bottom-left-radius' => array('custom', 'unit'),
            'margin' => array('select', 'custom', 'unit'),
            'margin-topbottom' => array('custom', 'unit'),
            'margin-leftright' => array('custom', 'unit'),
            'margin-top' => array('custom', 'unit'),
            'margin-right' => array('custom', 'unit'),
            'margin-bottom' => array('custom', 'unit'),
            'margin-left' => array('custom', 'unit'),
            'padding' => array('select', 'custom', 'unit'),
            'padding-topbottom' => array('custom', 'unit'),
            'padding-leftright' => array('custom', 'unit'),
            'padding-top' => array('custom', 'unit'),
            'padding-right' => array('custom', 'unit'),
            'padding-bottom' => array('custom', 'unit'),
            'padding-left' => array('custom', 'unit'),
            'border' => array('select', 'custom', 'unit', 'hex', 'opacity', 'style'),
            'border-topbottom' => array('custom', 'unit', 'hex', 'opacity', 'style'),
            'border-leftright' => array('custom', 'unit', 'hex', 'opacity', 'style'),
            'border-top' => array('custom', 'unit', 'hex', 'opacity', 'style'),
            'border-right' => array('custom', 'unit', 'hex', 'opacity', 'style'),
            'border-bottom' => array('custom', 'unit', 'hex', 'opacity', 'style'),
            'border-left' => array('custom', 'unit', 'hex', 'opacity', 'style'),
            'outline' => array('select', 'custom', 'unit', 'hex', 'opacity', 'style')
        );
    }

    public function data() {
        return array(
            'shadows' => array(),
            'box_shadows' => array(),
            'font' => array(
                'types' => array(
                    'none' => __("None", "gd-webfonts-toolbox-lite"),
                    'inherit' => __("Inherit", "gd-webfonts-toolbox-lite"),
                    'generic' => __("Generic", "gd-webfonts-toolbox-lite"),
                    'stack' => __("Stack", "gd-webfonts-toolbox-lite")
                ),
                'extra' => array(
                    'none' => __("None", "gd-webfonts-toolbox-lite"),
                ),
                'generic' => gdwft_plugin()->stacks->generic
            ),
            'settings' => array(
                'vertical-align' => array(
                    '' => __("Not Set", "gd-webfonts-toolbox-lite"),
                    'value' => __("Custom", "gd-webfonts-toolbox-lite"),
                    'inherit' => __("Inherit", "gd-webfonts-toolbox-lite"),
                    'auto' => __("Auto", "gd-webfonts-toolbox-lite"),
                    'baseline' => __("Baseline", "gd-webfonts-toolbox-lite"),
                    'sub' => __("Sup", "gd-webfonts-toolbox-lite"),
                    'super' => __("Super", "gd-webfonts-toolbox-lite"),
                    'top' => __("Top", "gd-webfonts-toolbox-lite"),
                    'text-top' => __("Text Top", "gd-webfonts-toolbox-lite"),
                    'middle' => __("Middle", "gd-webfonts-toolbox-lite"),
                    'bottom' => __("Bottom", "gd-webfonts-toolbox-lite"),
                    'text-bottom' => __("Text Bottom", "gd-webfonts-toolbox-lite")
                ),
                'color' => array(
                    '' => __("Not Set", "gd-webfonts-toolbox-lite"),
                    'value' => __("Custom", "gd-webfonts-toolbox-lite"),
                    'inherit' => __("Inherit", "gd-webfonts-toolbox-lite")
                ),
                'word-spacing' => array(
                    '' => __("Not Set", "gd-webfonts-toolbox-lite"),
                    'value' => __("Custom", "gd-webfonts-toolbox-lite"),
                    'inherit' => __("Inherit", "gd-webfonts-toolbox-lite"),
                    'normal' => __("Normal", "gd-webfonts-toolbox-lite")
                ),
                'word-break' => array(
                    '' => __("Not Set", "gd-webfonts-toolbox-lite"),
                    'inherit' => __("Inherit", "gd-webfonts-toolbox-lite"),
                    'initial' => __("Initial", "gd-webfonts-toolbox-lite"),
                    'normal' => __("Normal", "gd-webfonts-toolbox-lite"),
                    'break-all' => __("Break All", "gd-webfonts-toolbox-lite"),
                    'keep-all' => __("Keep All", "gd-webfonts-toolbox-lite")
                ),
                'letter-spacing' => array(
                    '' => __("Not Set", "gd-webfonts-toolbox-lite"),
                    'value' => __("Custom", "gd-webfonts-toolbox-lite"),
                    'inherit' => __("Inherit", "gd-webfonts-toolbox-lite"),
                    'normal' => __("Normal", "gd-webfonts-toolbox-lite")
                ),
                'line-height' => array(
                    '' => __("Not Set", "gd-webfonts-toolbox-lite"),
                    'value' => __("Custom", "gd-webfonts-toolbox-lite"),
                    'inherit' => __("Inherit", "gd-webfonts-toolbox-lite"),
                    'normal' => __("Normal", "gd-webfonts-toolbox-lite")
                ),
                'text-indent' => array(
                    '' => __("Not Set", "gd-webfonts-toolbox-lite"),
                    'value' => __("Custom", "gd-webfonts-toolbox-lite"),
                    'inherit' => __("Inherit", "gd-webfonts-toolbox-lite")
                ),
                'font-size' => array(
                    '' => __("Not Set", "gd-webfonts-toolbox-lite"),
                    'value' => __("Custom", "gd-webfonts-toolbox-lite"),
                    'inherit' => __("Inherit", "gd-webfonts-toolbox-lite"),
                    'xx-small' => __("XX Small", "gd-webfonts-toolbox-lite"),
                    'x-small' => __("X Small", "gd-webfonts-toolbox-lite"),
                    'small' => __("Small", "gd-webfonts-toolbox-lite"),
                    'medium' => __("Medium", "gd-webfonts-toolbox-lite"),
                    'large' => __("Large", "gd-webfonts-toolbox-lite"),
                    'x-large' => __("X Large", "gd-webfonts-toolbox-lite"),
                    'xx-large' => __("XX Large", "gd-webfonts-toolbox-lite")
                ),
                'font-style' => array(
                    '' => __("Not Set", "gd-webfonts-toolbox-lite"),
                    'inherit' => __("Inherit", "gd-webfonts-toolbox-lite"),
                    'normal' => __("Normal", "gd-webfonts-toolbox-lite"),
                    'italic' => __("Italic", "gd-webfonts-toolbox-lite"),
                    'oblique' => __("Oblique", "gd-webfonts-toolbox-lite")
                ),
                'white-space' => array(
                    '' => __("Not Set", "gd-webfonts-toolbox-lite"),
                    'inherit' => __("Inherit", "gd-webfonts-toolbox-lite"),
                    'normal' => __("Normal", "gd-webfonts-toolbox-lite"),
                    'pre' => __("Pre", "gd-webfonts-toolbox-lite"),
                    'pre-wrap' => __("Pre Warp", "gd-webfonts-toolbox-lite"),
                    'pre-line' => __("Pre Line", "gd-webfonts-toolbox-lite"),
                    'nowrap' => __("No Wrap", "gd-webfonts-toolbox-lite")
                ),
                'direction' => array(
                    '' => __("Not Set", "gd-webfonts-toolbox-lite"),
                    'ltr' => __("Left To Right", "gd-webfonts-toolbox-lite"),
                    'rtl' => __("Right To Left", "gd-webfonts-toolbox-lite"),
                    'inherit' => __("Inherit", "gd-webfonts-toolbox-lite")
                ),
                'font-variant' => array(
                    '' => __("Not Set", "gd-webfonts-toolbox-lite"),
                    'inherit' => __("Inherit", "gd-webfonts-toolbox-lite"),
                    'normal' => __("Normal", "gd-webfonts-toolbox-lite"),
                    'small-caps' => __("Small Caps", "gd-webfonts-toolbox-lite")
                ),
                'font-weight' => array(
                    '' => __("Not Set", "gd-webfonts-toolbox-lite"),
                    'inherit' => __("Inherit", "gd-webfonts-toolbox-lite"),
                    'normal' => __("Normal", "gd-webfonts-toolbox-lite"),
                    'bolder' => __("Bolder", "gd-webfonts-toolbox-lite"),
                    'lighter' => __("Lighter", "gd-webfonts-toolbox-lite"),
                    'bold' => __("Bold", "gd-webfonts-toolbox-lite"),
                    '100' => __("Bold: 100", "gd-webfonts-toolbox-lite"),
                    '200' => __("Bold: 200", "gd-webfonts-toolbox-lite"),
                    '300' => __("Bold: 300", "gd-webfonts-toolbox-lite"),
                    '400' => __("Bold: 400", "gd-webfonts-toolbox-lite"),
                    '500' => __("Bold: 500", "gd-webfonts-toolbox-lite"),
                    '600' => __("Bold: 600", "gd-webfonts-toolbox-lite"),
                    '700' => __("Bold: 700", "gd-webfonts-toolbox-lite"),
                    '800' => __("Bold: 800", "gd-webfonts-toolbox-lite"),
                    '900' => __("Bold: 900", "gd-webfonts-toolbox-lite")
                ),
                'text-align' => array(
                    '' => __("Not Set", "gd-webfonts-toolbox-lite"),
                    'inherit' => __("Inherit", "gd-webfonts-toolbox-lite"),
                    'left' => __("Left", "gd-webfonts-toolbox-lite"),
                    'right' => __("Right", "gd-webfonts-toolbox-lite"),
                    'center' => __("Center", "gd-webfonts-toolbox-lite"),
                    'justify' => __("Justify", "gd-webfonts-toolbox-lite")
                ),
                'text-decoration' => array(
                    '' => __("Not Set", "gd-webfonts-toolbox-lite"),
                    'inherit' => __("Inherit", "gd-webfonts-toolbox-lite"),
                    'none' => __("None", "gd-webfonts-toolbox-lite"),
                    'underline' => __("Underline", "gd-webfonts-toolbox-lite"),
                    'overline' => __("Overline", "gd-webfonts-toolbox-lite"),
                    'line-through' => __("Line Through", "gd-webfonts-toolbox-lite"),
                    'blink' => __("Blink", "gd-webfonts-toolbox-lite")
                ),
                'text-transform' => array(
                    '' => __("Not Set", "gd-webfonts-toolbox-lite"),
                    'inherit' => __("Inherit", "gd-webfonts-toolbox-lite"),
                    'none' => __("None", "gd-webfonts-toolbox-lite"),
                    'capitalize' => __("Capitalize", "gd-webfonts-toolbox-lite"),
                    'uppercase' => __("Upper Case", "gd-webfonts-toolbox-lite"),
                    'lowercase' => __("Lower Case", "gd-webfonts-toolbox-lite")
                )
            ),
            'box' => array(
                'background' => array(
                    '' => __("Not Set", "gd-webfonts-toolbox-lite"),
                    'value' => __("Custom", "gd-webfonts-toolbox-lite"),
                    'inherit' => __("Inherit", "gd-webfonts-toolbox-lite")
                ),
                'box-sizing' => array(
                    '' => __("Not Set", "gd-webfonts-toolbox-lite"),
                    'inherit' => __("Inherit", "gd-webfonts-toolbox-lite"),
                    'initial' => __("Initial", "gd-webfonts-toolbox-lite"),
                    'content-box' => __("Content Box", "gd-webfonts-toolbox-lite"), 
                    'border-box' => __("Border Box", "gd-webfonts-toolbox-lite")
                ),
                'clear' => array(
                    '' => __("Not Set", "gd-webfonts-toolbox-lite"),
                    'inherit' => __("Inherit", "gd-webfonts-toolbox-lite"),
                    'initial' => __("Initial", "gd-webfonts-toolbox-lite"),
                    'left' => __("Left", "gd-webfonts-toolbox-lite"), 
                    'right' => __("Right", "gd-webfonts-toolbox-lite"), 
                    'both' => __("Both", "gd-webfonts-toolbox-lite")
                ),
                'display' => array(
                    '' => __("Not Set", "gd-webfonts-toolbox-lite"),
                    'inherit' => __("Inherit", "gd-webfonts-toolbox-lite"),
                    'block' => __("Block", "gd-webfonts-toolbox-lite"), 
                    'inline' => __("Inline", "gd-webfonts-toolbox-lite"), 
                    'inline-block' => __("Inline Block", "gd-webfonts-toolbox-lite"), 
                    'none' => __("None", "gd-webfonts-toolbox-lite"), 
                    'list-item' => __("List Item", "gd-webfonts-toolbox-lite"), 
                    'run-in' => __("Run In", "gd-webfonts-toolbox-lite"), 
                    'table' => __("Table", "gd-webfonts-toolbox-lite"), 
                    'inline-table' => __("Inline Table", "gd-webfonts-toolbox-lite"), 
                    'table-row-group' => __("Table Row Group", "gd-webfonts-toolbox-lite"), 
                    'table-header-group' => __("Table Header Group", "gd-webfonts-toolbox-lite"), 
                    'table-footer-group' => __("Table Footer Group", "gd-webfonts-toolbox-lite"), 
                    'table-row' => __("Table Row", "gd-webfonts-toolbox-lite"), 
                    'table-column-group' => __("Table Column Group", "gd-webfonts-toolbox-lite"), 
                    'table-column' => __("Table Column", "gd-webfonts-toolbox-lite"), 
                    'table-cell' => __("Table Cell", "gd-webfonts-toolbox-lite"), 
                    'table-caption' => __("Table Caption", "gd-webfonts-toolbox-lite")
                ),
                'width' => array(
                    '' => __("Not Set", "gd-webfonts-toolbox-lite"),
                    'value' => __("Custom", "gd-webfonts-toolbox-lite"),
                    'inherit' => __("Inherit", "gd-webfonts-toolbox-lite"),
                    'auto' => __("Auto", "gd-webfonts-toolbox-lite")
                ),
                'height' => array(
                    '' => __("Not Set", "gd-webfonts-toolbox-lite"),
                    'value' => __("Custom", "gd-webfonts-toolbox-lite"),
                    'inherit' => __("Inherit", "gd-webfonts-toolbox-lite"),
                    'auto' => __("Auto", "gd-webfonts-toolbox-lite")
                ),
                'min-width' => array(
                    '' => __("Not Set", "gd-webfonts-toolbox-lite"),
                    'value' => __("Custom", "gd-webfonts-toolbox-lite"),
                    'inherit' => __("Inherit", "gd-webfonts-toolbox-lite"),
                    'none' => __("None", "gd-webfonts-toolbox-lite")
                ),
                'max-width' => array(
                    '' => __("Not Set", "gd-webfonts-toolbox-lite"),
                    'value' => __("Custom", "gd-webfonts-toolbox-lite"),
                    'inherit' => __("Inherit", "gd-webfonts-toolbox-lite"),
                    'none' => __("None", "gd-webfonts-toolbox-lite")
                ),
                'min-height' => array(
                    '' => __("Not Set", "gd-webfonts-toolbox-lite"),
                    'value' => __("Custom", "gd-webfonts-toolbox-lite"),
                    'inherit' => __("Inherit", "gd-webfonts-toolbox-lite"),
                    'none' => __("None", "gd-webfonts-toolbox-lite")
                ),
                'max-height' => array(
                    '' => __("Not Set", "gd-webfonts-toolbox-lite"),
                    'value' => __("Custom", "gd-webfonts-toolbox-lite"),
                    'inherit' => __("Inherit", "gd-webfonts-toolbox-lite"),
                    'none' => __("None", "gd-webfonts-toolbox-lite")
                ),
                'outline' => array(
                    '' => __("Not Set", "gd-webfonts-toolbox-lite"),
                    'value' => __("Custom", "gd-webfonts-toolbox-lite"),
                    'inherit' => __("Inherit", "gd-webfonts-toolbox-lite"),
                    'none' => __("None", "gd-webfonts-toolbox-lite")
                ),
                'padding' => array(
                    '' => __("Not Set", "gd-webfonts-toolbox-lite"),
                    'value' => __("Custom", "gd-webfonts-toolbox-lite"),
                    'value_pair' => __("Custom, Pairs", "gd-webfonts-toolbox-lite"),
                    'value_all' => __("Custom, All", "gd-webfonts-toolbox-lite"),
                    'inherit' => __("Inherit", "gd-webfonts-toolbox-lite")
                ),
                'margin' => array(
                    '' => __("Not Set", "gd-webfonts-toolbox-lite"),
                    'value' => __("Custom", "gd-webfonts-toolbox-lite"),
                    'value_pair' => __("Custom, Pairs", "gd-webfonts-toolbox-lite"),
                    'value_all' => __("Custom, All", "gd-webfonts-toolbox-lite"),
                    'inherit' => __("Inherit", "gd-webfonts-toolbox-lite")
                ),
                'border-radius' => array(
                    '' => __("Not Set", "gd-webfonts-toolbox-lite"),
                    'value' => __("Custom", "gd-webfonts-toolbox-lite"),
                    'value_all' => __("Custom, Each", "gd-webfonts-toolbox-lite"),
                    'inherit' => __("Inherit", "gd-webfonts-toolbox-lite")
                ),
                'border' => array(
                    '' => __("Not Set", "gd-webfonts-toolbox-lite"),
                    'value' => __("Custom", "gd-webfonts-toolbox-lite"),
                    'value_pair' => __("Custom, Pairs", "gd-webfonts-toolbox-lite"),
                    'value_all' => __("Custom, Each", "gd-webfonts-toolbox-lite"),
                    'inherit' => __("Inherit", "gd-webfonts-toolbox-lite")
                )
            )
        );
    }

    public function styles() {
        return array(
            'none' => __("None", "gd-webfonts-toolbox-lite"),
            'solid' => __("Solid", "gd-webfonts-toolbox-lite"),
            'dotted' => __("Dotted", "gd-webfonts-toolbox-lite"),
            'dashed' => __("Dashed", "gd-webfonts-toolbox-lite"),
            'double' => __("Double", "gd-webfonts-toolbox-lite"),
            'groove' => __("Groove", "gd-webfonts-toolbox-lite"),
            'ridge' => __("Ridge", "gd-webfonts-toolbox-lite"),
            'inset' => __("Inset", "gd-webfonts-toolbox-lite"),
            'outset' => __("Outset", "gd-webfonts-toolbox-lite")
        );
    }

    public function units() {
        return array(
            'px' => 'px',
            'pt' => 'pt',
            'pc' => 'pc',
            'em' => 'em',
            'ex' => 'ex',
            'in' => 'in',
            'mm' => 'mm',
            'cm' => 'cm',
            'csh' => 'ch',
            'rem' => 'rem',
            '%' => '%'
        );
    }

    public function prefixed() {
        return array(
            'box-sizing'
        );
    }

    private function clean_opacity($value) {
        $value = floatval($value);

        if ($value < 0) { $value = 0; }
        if ($value > 1) { $value = 1; }

        $value = sprintf('%.2f', $value);

        if (substr($value, -2) == '00') {
            $value = intval($value);
        }

        return $value;
    }

    private function clean_custom($value) {
        $value = floatval($value);

        $value = sprintf('%.2f', $value);

        if (substr($value, -2) == '00') {
            $value = intval($value);
        }

        return $value;
    }
}

?>