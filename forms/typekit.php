<?php

include(GDWFT_PATH.'forms/shared/top.php');

?>

<div class="d4p-content-left">
    <div class="d4p-panel-title">
        <i class="fa fa-font"></i>
        <h3><?php _e("TypeKit Kits", "gd-webfonts-toolbox-lite"); ?></h3>
    </div>
    <div class="d4p-panel-info">
        <?php _e("You can list available TypeKit kits and configure them for embedding.", "gd-webfonts-toolbox-lite"); ?>
    </div>
    <div class="d4p-panel-buttons">
        <a href="https://plugins.dev4press.com/gd-webfonts-toolbox/buy/" target="_blank" class="button-primary"><?php _e("Upgrade To Pro", "gd-webfonts-toolbox-lite"); ?></a>

        <table class="d4p-plugin-upgrade-prices">
            <tr>
                <th>Personal (1 site)</th>
                <td>$30.00</td>
            </tr>
            <tr>
                <th>Business (5 sites)</th>
                <td>$75.00</td>
            </tr>
            <tr>
                <th>Developer (50 sites)</th>
                <td>$150.00</td>
            </tr>
        </table>

        Get 15% discount for upgrading to Pro: <strong>GDWFTLITETOPRO</strong>. Coupon is valid for GD WebFonts Toolbox Pro and Dev4Press Plugins Pack licenses. Licenses are valid for 1 year and include support, documentation and updates.
    </div>
</div>
<div class="d4p-content-right d4p-pro-promotion">
    <h3 style="margin-top: 0;">Pro plugin TypeKit information</h3>
    GD WebFonts Toolbox Pro includes support for Adobe TypeKit font kits. It can work with free or paid TypeKit accounts. You need TypeKit API key and at least one kit created. Once you include the kit, fonts in that kit can be used in all areas of the plugin, much like the Google Fonts. You can also load them together with Google Fonts through WebFont Loader.

    <h3>Pro plugin panel for TypeKit loading</h3>
    <img src="<?php echo GDWFT_URL; ?>gfx/typekit_panel.png" alt="TypeKit Kits Panel" />

    <h3>Pro plugin settings for TypeKit</h3>
    <img src="<?php echo GDWFT_URL; ?>gfx/typekit_settings.png" alt="TypeKit Kits Settings" />
</div>

<?php 

include(GDWFT_PATH.'forms/shared/bottom.php');

?>