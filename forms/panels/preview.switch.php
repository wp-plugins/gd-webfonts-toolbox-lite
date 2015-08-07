<label for="gdwft-rule-type"><?php _e("Select Provider", "gd-webfonts-toolbox-lite"); ?>:
    <?php d4p_render_select($gdwft_types, array('id' => 'gdwft-font-type')); ?>
</label>

<?php if (isset($gdwft_types['google'])) { ?>
<div class="gdwft-rule-box gdwft-font-type-google">
    <label for="gdwft-font-google">
        <?php

        _e("Google Web Fonts", "gd-webfonts-toolbox-lite");

        ?>:
        <?php d4p_render_select(gdwft_get_fonts_list('google', 'dropdown'), array('selected' => 'Open Sans', 'id' => 'gdwft-font-google', 'class' => 'gdwft-fonts-list'), array('size' => 10)); ?>
    </label>
    <div class="gdwft-fonts-info">
        <?php _e("Total Fonts", "gd-webfonts-toolbox-lite"); ?>: <strong><?php echo gdwft_get_fonts_list_count('google'); ?></strong>
        <?php

            if (gdwft_settings()->get('google_api_key') != '') {
                if (gdwft_settings()->get('last_check_google', 'fonts') != '') {
                    echo '<br/>'.__("Last Update", "gd-webfonts-toolbox-lite");
                    echo ': <strong>'.date(get_option('date_format'), gdwft_settings()->get('last_check_google', 'fonts')).'</strong>';
                }
            } else {
                echo '<br/><strong>'.__("Auto update available in Pro version.", "gd-webfonts-toolbox-lite").'</strong>';
            }

        ?>
    </div>
</div>
<?php } if (isset($gdwft_types['adobe'])) { ?>
<div class="gdwft-rule-box gdwft-font-type-adobe" style="display: none;">
    <label for="gdwft-font-adobe">
        <?php

        _e("Adobe Web Fonts", "gd-webfonts-toolbox-lite");

        ?>:
        <?php d4p_render_select(gdwft_get_fonts_list('adobe', 'dropdown'), array('selected' => 'open-sans', 'id' => 'gdwft-font-adobe', 'class' => 'gdwft-fonts-list'), array('size' => 10)); ?>
    </label>
    <div class="gdwft-fonts-info">
        <?php _e("Total Fonts", "gd-webfonts-toolbox-lite"); ?>: <strong><?php echo gdwft_get_fonts_list_count('adobe'); ?></strong>
    </div>
</div>
<?php } if (isset($gdwft_types['typekit'])) { ?>
<div class="gdwft-rule-box gdwft-font-type-typekit" style="display: none;">
    <label for="gdwft-font-typekit">
        <?php

        _e("TypeKit Fonts", "gd-webfonts-toolbox-lite");

        ?>:
        <?php d4p_render_select(gdwft_get_fonts_list('typekit', 'dropdown'), array('selected' => '', 'id' => 'gdwft-font-typekit', 'class' => 'gdwft-fonts-list'), array('size' => 10)); ?>
    </label>
    <div class="gdwft-fonts-info">
        <?php _e("Total Fonts", "gd-webfonts-toolbox-lite"); ?>: <strong><?php echo gdwft_get_fonts_list_count('typekit'); ?></strong>
    </div>
</div>
<?php } if (isset($gdwft_types['fontface'])) { ?>
<div class="gdwft-rule-box gdwft-font-type-fontface" style="display: none;">
    <label for="gdwft-font-fontface">
        <?php

        _e("FontFace Fonts", "gd-webfonts-toolbox-lite");

        ?>:
        <?php d4p_render_select(gdwft_get_fonts_list('fontface', 'dropdown'), array('selected' => '', 'id' => 'gdwft-font-fontface', 'class' => 'gdwft-fonts-list'), array('size' => 10)); ?>
    </label>
    <div class="gdwft-fonts-info">
        <?php _e("Total Fonts", "gd-webfonts-toolbox-lite"); ?>: <strong><?php echo gdwft_get_fonts_list_count('fontface'); ?></strong>
    </div>
</div>
<?php } ?>