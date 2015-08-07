<?php

$panels = array(
    'index' => array(
        'title' => __("About Plugin", "gd-webfonts-toolbox-lite"), 'icon' => 'info-circle', 
        'info' => __("Get more information about this plugin.", "gd-webfonts-toolbox-lite")),
    'changelog' => array(
        'title' => __("Changelog", "gd-webfonts-toolbox-lite"), 'icon' => 'file-text',
        'info' => __("Check out full changelog for this plugin.", "gd-webfonts-toolbox-lite")),
    'dev4press' => array(
        'title' => __("Dev4Press", "gd-webfonts-toolbox-lite"), 'icon' => 'd4p-dev4press',
        'info' => __("Check out other Dev4Press products.", "gd-webfonts-toolbox-lite"))
);

include(GDWFT_PATH.'forms/shared/top.php');

?>

<div class="d4p-content-left">
    <div class="d4p-panel-title">
        <i class="fa fa-info-circle"></i>
        <h3><?php _e("About", "gd-webfonts-toolbox-lite"); ?></h3>
        <?php if ($_panel != 'index') { ?>
            <h4><i class="<?php echo d4p_icon_class($panels[$_panel]['icon']); ?>"></i> <?php echo $panels[$_panel]['title']; ?></h4>
        <?php } ?>
    </div>
    <div class="d4p-panel-info">
        <?php echo $panels[$_panel]['info']; ?>
    </div>
    <?php if ($_panel == 'index') { ?>
    <div class="d4p-panel-links">
        <a href="admin.php?page=gd-webfonts-toolbox-about&panel=changelog"><i class="fa fa-file-text fa-fw"></i> Changelog</a>
        <a href="admin.php?page=gd-webfonts-toolbox-about&panel=dev4press"><i class="d4pi d4p-dev4press d4pi-fw"></i> Dev4Press</a>
    </div>
    <?php } ?>
</div>
<div class="d4p-content-right">
    <?php

        if ($_panel == 'index') {
            include(GDWFT_PATH.'forms/panels/about.php');
        } else {
            include(GDWFT_PATH.'forms/panels/'.$_panel.'.php');
        }

    ?>
</div>

<?php 

include(GDWFT_PATH.'forms/shared/bottom.php');

?>