<?php

if (!defined('ABSPATH')) exit;

class gdwft_grid_include extends WP_List_Table {
    public $url = '';
    public $fonts = array();

    function __construct($args = array()) {
        $this->url = 'admin.php?page=gd-webfonts-toolbox-include&_nonce='.wp_create_nonce('gdwft-action-nonce');

        parent::__construct(array(
            'singular'=> 'include',
            'plural' => 'includes',
            'ajax' => false
        ));
    }

    function rows_per_page() {
        return 25;
    }

    function get_columns() {
	return array(
            'provider' => __("Provider", "gd-webfonts-toolbox-lite"),
            'font' => __("Font Family", "gd-webfonts-toolbox-lite"),
            'font_preview' => __("Font Preview", "gd-webfonts-toolbox-lite"),
            'weights' => __("Weights", "gd-webfonts-toolbox-lite"),
            'css' => __("CSS Property", "gd-webfonts-toolbox-lite")
	);
    }

    function get_sortable_columns() {
        return array();
    }

    function column_provider($item){
        return gdwft_plugin()->provider_name($item['provider']);
    }

    function column_font($item){
        $actions = array(
            'remove' => '<a href="'.$this->url.'&action=remove-font&provider='.$item['provider'].'&font='.urlencode($item['name']).'">'.__("Remove", "gd-webfonts-toolbox-lite").'</a>'
        );

        return $this->fonts[$item['provider']][$item['name']]->name.$this->row_actions($actions);
    }

    function column_font_preview($item){
        return '<p class="gdwft-font-preview-grid" style="font-family: \''.$item['name'].'\';">'.$item['name'].'</p>';
    }

    function column_css($item){
        return 'font-family: <strong>'.$this->fonts[$item['provider']][$item['name']]->full_family().'</strong>';
    }

    function column_weights($item){
        $font = $this->fonts[$item['provider']][$item['name']];
        $variants = $font->list_variants();

        $render = '<strong>'.__("Normal", "gd-webfonts-toolbox-lite").'</strong>: '.(empty($variants['normal']) ? '/' : join(', ', $variants['normal']));
        if (!empty($variants['italic'])) {
            $render.= '<br/><strong>'.__("Italic", "gd-webfonts-toolbox-lite").'</strong>: '.join(', ', $variants['italic']);
        }
        if (!empty($variants['oblique'])) {
            $render.= '<br/><strong>'.__("Oblique", "gd-webfonts-toolbox-lite").'</strong>: '.join(', ', $variants['oblique']);
        }

        return $render;
    }

    function column_default($item, $column_name){
        return '';
    }

    function prepare_items() {
        $this->_column_headers = array($this->get_columns(), array(), $this->get_sortable_columns());

        $paged = !empty($_GET['paged']) ? intval($_GET['paged']) : '';
        if (empty($paged) || !is_numeric($paged) || $paged <= 0) {
            $paged = 1;
        }

        $per_page = $this->rows_per_page();
        $offset = ($paged - 1) * $per_page;

        $all_fonts = gdwft_settings()->get('include', 'fonts');
        $this->items = array_slice($all_fonts, $offset, $per_page);

        foreach ($this->items as $font) {
            $this->fonts[$font['provider']][$font['name']] = gdwft_get_font($font['provider'], $font['name']);
        }

        $total_rows = count($all_fonts);

        $this->set_pagination_args(array(
            'total_items' => $total_rows,
            'total_pages' => ceil($total_rows / $per_page),
            'per_page' => $per_page,
        ));
    }
}

?>