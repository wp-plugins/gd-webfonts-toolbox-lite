<?php

$panels = array(
    'index' => array(
        'title' => __("Tools Index", "gd-webfonts-toolbox-lite"), 'icon' => 'wrench', 
        'info' => __("All plugin tools are split into several panels, and you access each starting from the right.", "gd-webfonts-toolbox-lite")),
    'cache' => array(
        'title' => __("Clear Cache", "gd-webfonts-toolbox-lite"), 'icon' => 'trash', 
        'button' => 'submit', 'button_text' => __("Clear", "gd-webfonts-toolbox-lite"),
        'info' => __("Remove all cached data including built styles and fonts.", "gd-webfonts-toolbox-lite")),
    'export' => array(
        'title' => __("Export Settings", "gd-webfonts-toolbox-lite"), 'icon' => 'download', 
        'button' => 'button', 'button_text' => __("Export", "gd-webfonts-toolbox-lite"),
        'info' => __("Export all plugin settings into file.", "gd-webfonts-toolbox-lite")),
    'import' => array(
        'title' => __("Import Settings", "gd-webfonts-toolbox-lite"), 'icon' => 'upload', 
        'button' => 'submit', 'button_text' => __("Import", "gd-webfonts-toolbox-lite"),
        'info' => __("Import all plugin settings from export file.", "gd-webfonts-toolbox-lite")),
    'remove' => array(
        'title' => __("Remove Settings", "gd-webfonts-toolbox-lite"), 'icon' => 'refresh', 
        'button' => 'submit', 'button_text' => __("Remove", "gd-webfonts-toolbox-lite"),
        'info' => __("Remove selected plugin settings and information.", "gd-webfonts-toolbox-lite"))
);

include(GDWFT_PATH.'forms/shared/top.php');

?>

<form method="post" action="" enctype="multipart/form-data">
    <?php settings_fields('gd-webfonts-toolbox-tools'); ?>
    <input type="hidden" value="<?php echo $_panel; ?>" name="gdwfttools[panel]" />

    <div class="d4p-content-left">
        <div class="d4p-panel-title">
            <i class="fa fa-wrench"></i>
            <h3><?php _e("Tools", "gd-webfonts-toolbox-lite"); ?></h3>
            <?php if ($_panel != 'index') { ?>
            <h4><i class="fa fa-<?php echo $panels[$_panel]['icon']; ?>"></i> <?php echo $panels[$_panel]['title']; ?></h4>
            <?php } ?>
        </div>
        <div class="d4p-panel-info">
            <?php echo $panels[$_panel]['info']; ?>
        </div>
        <?php if ($_panel != 'index') { ?>
            <div class="d4p-panel-buttons">
                <input id="gdwft-tool-<?php echo $_panel; ?>" class="button-primary" type="<?php echo $panels[$_panel]['button']; ?>" value="<?php echo $panels[$_panel]['button_text']; ?>" />
            </div>
        <?php } ?>
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
                        <a class="button-primary" href="<?php echo $url; ?>"><?php _e("Tools Panel", "gd-webfonts-toolbox-lite"); ?></a>
                    </div>
                </div>

                <?php
            }
        } else {
            include(GDWFT_PATH.'forms/panels/'.$_panel.'.php');
        }

        ?>
    </div>
</form>

<?php 

include(GDWFT_PATH.'forms/shared/bottom.php');

?>