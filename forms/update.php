<?php

$_classes = array('d4p-wrap', 'wpv-'.GDWFT_WPV, 'd4p-page-update');

?>
<div class="<?php echo join(' ', $_classes); ?>">
    <div class="d4p-header">
        <div class="d4p-plugin">
            GD WebFonts Toolbox
        </div>
    </div>
    <div class="d4p-content">
        <div class="d4p-content-left">
            <div class="d4p-panel-title">
                <i class="fa fa-magic"></i>
                <h3><?php _e("Update", "gd-webfonts-toolbox-lite"); ?></h3>
            </div>
            <div class="d4p-panel-info">
                <?php _e("Before you continue, make sure plugin was successfully updated.", "gd-webfonts-toolbox-lite"); ?>
            </div>
        </div>
        <div class="d4p-content-right">
            <?php

                gdwft_settings()->set('install', false, 'info');
                gdwft_settings()->set('update', false, 'info', true);

            ?>

            <h3><?php _e("All Done", "gd-webfonts-toolbox-lite"); ?></h3>
            <?php
            
                _e("Update completed.", "gd-webfonts-toolbox-lite");
    
            ?>
            <br/><a href="<?php echo d4p_current_url(); ?>"><?php _e("Click here to continue.", "gd-webfonts-toolbox-lite"); ?></a>
        </div>
    </div>
</div>