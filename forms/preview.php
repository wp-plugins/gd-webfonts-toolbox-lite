<?php

include(GDWFT_PATH.'forms/shared/top.php');

require_once(GDWFT_D4PLIB.'admin/d4p.functions.php');

$gdwft_types = array();

if (gdwft_plugin()->is_provider_active('google')) {
    $gdwft_types['google'] = __("Google Web Font", "gd-webfonts-toolbox-lite");
}

if (gdwft_plugin()->is_provider_active('adobe')) {
    $gdwft_types['adobe'] = __("Adobe Web Font", "gd-webfonts-toolbox-lite");
}

$included = array('google' => array(), 'adobe' => array());
$fonts = array('google' => array(), 'adobe' => array());
$variants = array('google' => array(), 'adobe' => array());
$categories = array('google' => array(), 'adobe' => array());
$versions = array('google' => array(), 'adobe' => array());
$modified = array('google' => array(), 'adobe' => array());
$urls = array();

$google = gdwft_get_fonts_list('google');

foreach ($google as $font => $data) {
    $f = new gdwft_google_font($font);

    $fonts['google'][$font] = $f->list_variants();
    $variants['google'][$font] = join(',', $f->variants);

    if (isset($f->category)) {
        $categories['google'][$font] = ucfirst($f->category);
    }

    if (isset($f->version)) {
        $versions['google'][$font] = $f->version;
    }

    if (isset($f->lastModified)) {
        $modified['google'][$font] = $f->lastModified;
    }
}

$adobe = gdwft_get_fonts_list('adobe');

foreach ($adobe as $font => $data) {
    $f = new gdwft_adobe_font($font);

    $fonts['adobe'][$font] = $f->list_variants();
    $variants['adobe'][$font] = join(',', $f->variants);
}

$typekit = gdwft_get_fonts_list('typekit');

$included_fonts = gdwft_settings()->get('include', 'fonts');

foreach ($included_fonts as $font) {
    $included[$font['provider']][] = $font['name'];
}

?>

<div class="d4p-content-left">
    <div class="d4p-panel-title">
        <i class="fa fa-search"></i>
        <h3><?php _e("Preview", "gd-webfonts-toolbox-lite"); ?></h3>
    </div>
    <div class="d4p-panel-info">
        <?php _e("You can easily preview every font plugin currently has.", "gd-webfonts-toolbox-lite"); ?>
    </div>
    <div class="d4p-panel-buttons">
        <?php include(GDWFT_PATH.'forms/panels/preview.switch.php'); ?>
    </div>
</div>
<div class="d4p-content-right">
    <?php include(GDWFT_PATH.'forms/panels/preview.display.php'); ?>
</div>

<?php 

include(GDWFT_PATH.'forms/shared/bottom.php');

?>
<script type="text/javascript">
jQuery(document).ready(function() {
    gdwft_editor.tmp.included = <?php echo json_encode($included); ?>;
    gdwft_editor.tmp.preview = <?php echo json_encode($fonts); ?>;
    gdwft_editor.tmp.variants = <?php echo json_encode($variants); ?>;
    gdwft_editor.tmp.categories = <?php echo json_encode($categories); ?>;
    gdwft_editor.tmp.versions = <?php echo json_encode($versions); ?>;
    gdwft_editor.tmp.modified = <?php echo json_encode($modified); ?>;
    gdwft_editor.tmp.urls = <?php echo json_encode($urls); ?>;

    gdwft_editor.fonts_preview.init();
});
</script>

<?php // require_once(GDWFT_PATH.'fonts/google/print.php'); ?>