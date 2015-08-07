<?php

$panels = array(
    'index' => array(
        'title' => __("Settings Index", "gd-webfonts-toolbox-lite"), 'icon' => 'cogs', 
        'info' => __("All plugin settings are split into several panels, and you access each starting from the right.", "gd-webfonts-toolbox-lite")),
    'selectors' => array(
        'title' => __("Selectors", "gd-webfonts-toolbox-lite"), 'icon' => 'paragraph', 
        'info' => __("With these settings you can control how the selectors styles are built.", "gd-webfonts-toolbox-lite")),
    'cache' => array(
        'title' => __("Cache", "gd-webfonts-toolbox-lite"), 'icon' => 'database', 
        'info' => __("These are settings for control over built styles as embeded transient records.", "gd-webfonts-toolbox-lite")),
    'google' => array(
        'title' => __("Google Web Fonts", "gd-webfonts-toolbox-lite"), 'icon' => 'google', 
        'info' => __("These are settings for control over Google Web Fonts.", "gd-webfonts-toolbox-lite")),
    'adobe' => array(
        'title' => __("Adobe Edge Web Fonts", "gd-webfonts-toolbox-lite"), 'icon' => 'font', 
        'info' => __("These are settings for control over Adobe Edge Web Fonts.", "gd-webfonts-toolbox-lite"))
);

include(GDWFT_PATH.'forms/shared/top.php');

?>

<form method="post" action="">
    <?php settings_fields('gd-webfonts-toolbox-settings'); ?>

    <div class="d4p-content-left">
        <div class="d4p-panel-scroller d4p-scroll-active">
            <div class="d4p-panel-title">
                <i class="fa fa-cogs"></i>
                <h3><?php _e("Settings", "gd-webfonts-toolbox-lite"); ?></h3>
                <?php if ($_panel != 'index') { ?>
                <h4><i class="fa fa-<?php echo $panels[$_panel]['icon']; ?>"></i> <?php echo $panels[$_panel]['title']; ?></h4>
                <?php } ?>
            </div>
            <div class="d4p-panel-info">
                <?php echo $panels[$_panel]['info']; ?>
            </div>
            <?php if ($_panel != 'index') { ?>
                <div class="d4p-panel-buttons">
                    <input type="submit" value="<?php _e("Save Settings", "gd-webfonts-toolbox-lite"); ?>" class="button-primary" />
                </div>
                <div class="d4p-return-to-top">
                    <a href="#wpwrap"><?php _e("Return to top", "gd-webfonts-toolbox-lite"); ?></a>
                </div>
            <?php } ?>
        </div>
    </div>
    <div class="d4p-content-right">
        <?php

        if ($_panel == 'index') {
            foreach ($panels as $panel => $obj) {
                if ($panel == 'index') continue;

                $url = 'admin.php?page=gd-webfonts-toolbox-'.$_page.'&panel='.$panel;
                
                ?>

                <div class="d4p-options-panel">
                    <i class="fa fa-<?php echo $obj['icon']; ?>"></i>
                    <h5><?php echo $obj['title']; ?></h5>
                    <div>
                        <a class="button-primary" href="<?php echo $url; ?>"><?php _e("Settings Panel", "gd-webfonts-toolbox-lite"); ?></a>
                    </div>
                </div>
        
                <?php
            }
        } else {
            require_once(GDWFT_D4PLIB.'admin/d4p.functions.php');
            require_once(GDWFT_D4PLIB.'admin/d4p.settings.php');

            include(GDWFT_PATH.'core/internal.php');

            $options = new gdwft_admin_settings();

            $panel = gdwft_admin()->panel;
            $groups = $options->get($panel);

            $render = new d4pSettingsRender($panel, $groups);
            $render->base = 'gdwftvalue';
            $render->render();
        }

        ?>
    </div>
</form>

<?php 

include(GDWFT_PATH.'forms/shared/bottom.php');

?>