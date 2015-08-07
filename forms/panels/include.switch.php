<form method="POST">
    <?php settings_fields('gd-webfonts-toolbox-include'); ?>

    <label for="gdwft-rule-type"><?php _e("Select Provider", "gd-webfonts-toolbox-lite"); ?>:
        <?php d4p_render_select($gdwft_types, array('name' => 'provider', 'id' => 'gdwft-include-font-type')); ?>
    </label>

    <div class="gdwft-rule-box gdwft-include-type-google">
        <label for="gdwft-include-font-google"><?php _e("Google Web Font", "gd-webfonts-toolbox-lite"); ?>:
            <?php d4p_render_select(gdwft_get_fonts_list('google', 'dropdown'), array('name' => 'google')); ?>
        </label>
    </div>
    <div class="gdwft-rule-box gdwft-include-type-adobe" style="display: none;">
        <label for="gdwft-include-font-adobe"><?php _e("Adobe Web Font", "gd-webfonts-toolbox-lite"); ?>:
            <?php d4p_render_select(gdwft_get_fonts_list('adobe', 'dropdown'), array('name' => 'adobe')); ?>
        </label>
    </div>
    <div class="gdwft-rule-box gdwft-include-type-typekit" style="display: none;">
        <label for="gdwft-include-font-typekit"><?php _e("TypeKit Fonts", "gd-webfonts-toolbox-lite"); ?>:
            <?php d4p_render_select(gdwft_get_fonts_list('typekit', 'dropdown'), array('name' => 'typekit')); ?>
        </label>
    </div>
    <div class="gdwft-rule-box gdwft-include-type-fontface" style="display: none;">
        <label for="gdwft-include-font-fontface"><?php _e("FontFace Font", "gd-webfonts-toolbox-lite"); ?>:
            <?php d4p_render_select(gdwft_get_fonts_list('fontface', 'dropdown'), array('name' => 'fontface')); ?>
        </label>
    </div>

    <input class="button-primary" type="submit" value="<?php _e("Add New Font", "gd-webfonts-toolbox-lite"); ?>" />
</form>