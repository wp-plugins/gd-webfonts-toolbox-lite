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

?>

<div class="d4p-content-left">
    <div class="d4p-panel-title">
        <i class="fa fa-edit"></i>
        <h3><?php _e("Include", "gd-webfonts-toolbox-lite"); ?></h3>
    </div>
    <div class="d4p-panel-info">
        <?php _e("You can also load web fonts without assigning them to selector rules. This way you can load web fonts that will be used in your own CSS files", "gd-webfonts-toolbox-lite"); ?>
    </div>
    <div class="d4p-panel-buttons">
        <?php include(GDWFT_PATH.'forms/panels/include.switch.php'); ?>
    </div>
</div>
<div class="d4p-content-right">
    <?php include(GDWFT_PATH.'forms/panels/include.display.php'); ?>
</div>

<?php 

include(GDWFT_PATH.'forms/shared/bottom.php');

?>
<script type="text/javascript">
jQuery(document).ready(function() {
    gdwft_editor.include.init();
});
</script>