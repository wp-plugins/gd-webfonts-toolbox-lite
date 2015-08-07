<div class="d4p-group d4p-group-reset d4p-group-important">
    <h3><?php _e("Important", "gd-webfonts-toolbox-lite"); ?></h3>
    <div class="d4p-group-inner">
        <?php _e("This tool can remove plugin settings saved in the WordPress options table.", "gd-webfonts-toolbox-lite"); ?><br/><br/>
        <?php _e("Deletion operations are not reversible, and it is recommended to create database backup (or at least options table) before proceeding with this tool, if you later change your mind. You can also export plugin settings using own Export tools.", "gd-webfonts-toolbox-lite"); ?><br/><br/>
        <?php _e("If you choose to remove plugin settings, that will also reinitialize all plugin settings to default values.", "gd-webfonts-toolbox-lite"); ?>
    </div>
</div>
<div class="d4p-group d4p-group-tools d4p-group-reset">
    <h3><?php _e("Choose what you want to delete", "gd-webfonts-toolbox-lite"); ?></h3>
    <div class="d4p-group-inner">
        <label>
            <input type="checkbox" class="widefat" name="gdwfttools[remove][settings]" value="on" /> <?php _e("Plugin Settings", "gd-webfonts-toolbox-lite"); ?>
        </label>
        <label>
            <input type="checkbox" class="widefat" name="gdwfttools[remove][rules]" value="on" /> <?php _e("Selector Rules", "gd-webfonts-toolbox-lite"); ?>
        </label>
        <label>
            <input type="checkbox" class="widefat" name="gdwfttools[remove][fonts]" value="on" /> <?php _e("Fonts To Include", "gd-webfonts-toolbox-lite"); ?>
        </label>
    </div>
</div>