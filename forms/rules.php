<?php

include(GDWFT_PATH.'forms/shared/top.php');

require_once(GDWFT_D4PLIB.'admin/d4p.functions.php');
require_once(GDWFT_PATH.'core/rule.php');

$urls = array();

$gdwft_rules = array('default' => array(), 'themes' => array(), 'plugins' => array());
$gdwft_defaults = array('default' => array(), 'themes' => array(), 'plugins' => array());

$load_fonts = array('google' => array(), 'adobe' => array());
$variants = array('google' => array(), 'adobe' => array());

foreach (gdwft_plugin()->selectors->all() as $type => $list) {
    foreach ($list as $key => $data) {
        $gdwft_rules[$type][$key] = $data['label'];

        if (isset($data['font']) && !empty($data['font'])) {
            if ($data['font'][0] != '' && $data['font'][1] != '') {
                $gdwft_defaults[$type][$key] = array('data-provider' => $data['font'][0], 'data-font' => $data['font'][1]);

                if (isset($data['font'][2]) && $data['font'][2] != '') {
                    $gdwft_defaults[$type][$key]['data-extra'] = $data['font'][2];
                }
            }
        }
    }
}

$rules = array(
    'list' => gdwft_settings()->get('list', 'rules'), 
    'id' => gdwft_settings()->get('id', 'rules'), 
    'order' => gdwft_settings()->get('order', 'rules'));

$editor_methods = array(
    'inline' => __("Inline", "gd-webfonts-toolbox-lite"),
    'block' => __("Block", "gd-webfonts-toolbox-lite"),
    'selector' => __("Selector", "gd-webfonts-toolbox-lite")
);

$rule_types = array(
    'default' => __("Default Selector", "gd-webfonts-toolbox-lite"),
    'custom' => __("Custom Selector", "gd-webfonts-toolbox-lite")
);

if (!empty($gdwft_rules['themes'])) {
    $rule_types['themes'] = __("From Current Theme", "gd-webfonts-toolbox-lite");
}

if (!empty($gdwft_rules['plugins'])) {
    $rule_types['plugins'] = __("From Active Plugins", "gd-webfonts-toolbox-lite");
}

$default_type = apply_filters('gdwft_admin_default_rule_type', gdwft_plugin()->get('default_rule_type'));

$copy_from = array(
    "0" => __("Add with empty settings", "gd-webfonts-toolbox-lite")
);

foreach ($rules['order'] as $id) {
    $rule = $rules['list'][$id];
    $copy_from[$id] = $rule['label'];
}

$google = gdwft_get_fonts_list('google');

foreach ($google as $font => $data) {
    $f = new gdwft_google_font($font);

    $variants['google'][$font] = join(',', $f->variants);
}

$adobe = gdwft_get_fonts_list('adobe');

foreach ($adobe as $font => $data) {
    $f = new gdwft_adobe_font($font);

    $variants['adobe'][$font] = join(',', $f->variants);
}

?>

<div class="d4p-content-left">
    <div class="d4p-panel-title">
        <i class="fa fa-font"></i>
        <h3><?php _e("Selector Rules", "gd-webfonts-toolbox-lite"); ?></h3>
    </div>
    <div class="d4p-panel-info">
        <?php _e("Here you can add new rule and control all the selector styles.", "gd-webfonts-toolbox-lite"); ?>
    </div>
    <div class="d4p-panel-buttons">
        <?php include(GDWFT_PATH.'forms/panels/rules.switch.php'); ?>
    </div>
</div>
<div class="d4p-content-right">
    <?php include(GDWFT_PATH.'forms/panels/rules.display.php'); ?>
</div>

<?php 

include(GDWFT_PATH.'forms/shared/bottom.php');
include(GDWFT_PATH.'forms/panels/rules.dialogs.php');
include(GDWFT_PATH.'forms/panels/rules.editor.php');

?>
<script type="text/javascript">
jQuery(document).ready(function() {
    gdwft_editor.tmp.rules = <?php echo json_encode($rules['list']); ?>;
    gdwft_editor.tmp.variants = <?php echo json_encode($variants); ?>;
    gdwft_editor.tmp.urls = <?php echo json_encode($urls); ?>;

    gdwft_editor.fonts.init(<?php echo json_encode($load_fonts); ?>);

    gdwft_editor.rules.init();
});
</script>