<?php

if (!defined('ABSPATH')) exit;

class gdwft_ajax_core {
    public function __construct() {
        add_action('wp_ajax_gdwft_reorder_rules', array(&$this, 'reorder_rules'));
        add_action('wp_ajax_gdwft_preview_include', array(&$this, 'preview_include'));
    }

    public function reorder_rules() {
        check_ajax_referer('gd-webfonts-toolbox');

        $list = array_map('intval', (array)$_POST['list']);

        gdwft_settings()->change_rules_order($list);

        die("");
    }

    public function preview_include() {
        check_ajax_referer('gd-webfonts-toolbox');

        $operation = $_POST['include'] == 'add';
        $provider = $_POST['provider'];
        $name = $_POST['font'];

        if ($operation) {
            $include = array('provider' => $provider, 'name' => $name, 'editor' => $provider != 'adobe');

            if (!gdwft_settings()->is_included_already($include)) {
                gdwft_settings()->include_font($include);
                gdwft_settings()->save('fonts');
            }
        } else {
            gdwft_settings()->include_font_removal($provider, $name);
            gdwft_settings()->save('fonts');
        }

        die("");
    }
}

$_gdwft_core_ajax = new gdwft_ajax_core();

?>