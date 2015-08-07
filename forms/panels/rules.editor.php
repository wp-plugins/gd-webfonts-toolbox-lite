<?php

function gdwft_css_style_names() {
    return array(
        'none' => __("None", "gd-webfonts-toolbox-lite"),
        'solid' => __("Solid", "gd-webfonts-toolbox-lite"),
        'dotted' => __("Dotted", "gd-webfonts-toolbox-lite"),
        'dashed' => __("Dashed", "gd-webfonts-toolbox-lite"),
        'double' => __("Double", "gd-webfonts-toolbox-lite"),
        'groove' => __("Groove", "gd-webfonts-toolbox-lite"),
        'ridge' => __("Ridge", "gd-webfonts-toolbox-lite"),
        'inset' => __("Inset", "gd-webfonts-toolbox-lite"),
        'outset' => __("Outset", "gd-webfonts-toolbox-lite")
    );
}

function gdwft_css_size_units() {
    return array(
        'px' => 'px',
        'pt' => 'pt',
        'pc' => 'pc',
        'em' => 'em',
        'ex' => 'ex',
        'in' => 'in',
        'mm' => 'mm',
        'cm' => 'cm',
        'csh' => 'ch',
        'rem' => 'rem',
        '%' => '%'
    );
}

function gdwft_draw_size_unit($id, $name, $negative = true, $compact = false) {
    $class = $negative ? 'gdwft-numeric-input' : 'gdwft-positive-input';

    echo '<div class="gdwft-size-block'.($compact ? ' gdwft-size-compact' : '').'">';
        echo '<input type="text" name="'.$name.'[custom]" id="'.$id.'-custom" value="0" class="gdwft-editor-settings-custom '.$class.'" />';
        d4p_render_select(gdwft_css_size_units(), array('class' => 'gdwft-editor-settings-unit', 'name' => $name.'[unit]', 'id' => $id.'-unit'));
    echo '</div>';
}

$_rule = new gdwft_rule();
$gdwft_data = $_rule->data();

$gdwft_data['font']['extra'] = array_merge($gdwft_data['font']['extra'], $gdwft_data['font']['generic']);

if (gdwft_plugin()->is_provider_active('google')) {
    $gdwft_data['font']['types']['google'] = __("Google Web Font", "gd-webfonts-toolbox-lite");
}

if (gdwft_plugin()->is_provider_active('adobe')) {
    $gdwft_data['font']['types']['adobe'] = __("Adobe Web Font", "gd-webfonts-toolbox-lite");
}

if (gdwft_plugin()->is_provider_active('typekit') && gdwft_get_fonts_list_count('typekit') > 0) {
    $gdwft_data['font']['types']['typekit'] = __("TypeKit Font", "gd-webfonts-toolbox-lite");
}

if (gdwft_plugin()->is_provider_active('fontface') && gdwft_get_fonts_list_count('fontface') > 0) {
    $gdwft_data['font']['types']['fontface'] = __("FontFace Font", "gd-webfonts-toolbox-lite");
}

?>
<div style="display: none">
    <div title="<?php _e("Selector Rule Editor", "gd-webfonts-toolbox-lite"); ?>" id="gdwft-editor-block">
        <form id="gdwft-form-edit-styler" method="POST">
            <?php settings_fields('gd-webfonts-toolbox-edit-style'); ?>

            <input id="gdwft-editor-id" name="editor[id]" type="hidden" value="" />

            <div id="gdwft-editor-block-tabs">
                <ul class="wp-tab-bar">
                    <li class="wp-tab-active"><a href="#tab-font"><?php _e("Font", "gd-webfonts-toolbox-lite"); ?></a></li>
                    <li><a href="#tab-text"><?php _e("Text", "gd-webfonts-toolbox-lite"); ?></a></li>
                    <li><a href="#tab-position"><?php _e("Text Position", "gd-webfonts-toolbox-lite"); ?></a></li>
                    <li><a href="#tab-box"><?php _e("Box", "gd-webfonts-toolbox-lite"); ?></a></li>
                    <li><a href="#tab-size"><?php _e("Box Size", "gd-webfonts-toolbox-lite"); ?></a></li>
                    <li><a href="#tab-text-shadow"><?php _e("Text Shadow", "gd-webfonts-toolbox-lite"); ?></a></li>
                    <li><a href="#tab-box-shadow"><?php _e("Box Shadow", "gd-webfonts-toolbox-lite"); ?></a></li>
                    <li><a href="#tab-custom"><?php _e("Custom", "gd-webfonts-toolbox-lite"); ?></a></li>
                    <li class="wp-tab-right"><a href="#tab-settings"><?php _e("Settings", "gd-webfonts-toolbox-lite"); ?></a></li>
                </ul>
                <div id="tab-font" class="wp-tab-panel">
                    <div class="gdwft-editor-options" id="gdwft-editor-block-font">
                        <table class="gdwft-block-table" cellpadding="0" cellspacing="0">
                            <tr>
                                <td class="gdwft-block-left">
                                    <label for="gdwft-editor-block-font-type">
                                        <h4 style="margin-top: 0"><?php _e("Font Family", "gd-webfonts-toolbox-lite"); ?>:</h4>
                                        <?php d4p_render_select($gdwft_data['font']['types'], array('name' => 'editor[font][type]', 'id' => 'gdwft-editor-block-font-type')); ?>
                                    </label>

                                    <div class="gdwft-editor-block-font" id="gdwft-editor-block-font-type-none">
                                        <h5><?php _e("Nothing Set", "gd-webfonts-toolbox-lite"); ?>:</h5>
                                        <p><?php _e("Font familiy will not be set for this selector.", "gd-webfonts-toolbox-lite"); ?></p>
                                    </div>
                                    <div class="gdwft-editor-block-font" id="gdwft-editor-block-font-type-inherit">
                                        <h5><?php _e("Inherit", "gd-webfonts-toolbox-lite"); ?>:</h5>
                                        <p><?php _e("Set font family value to inherit.", "gd-webfonts-toolbox-lite"); ?></p>
                                    </div>
                                    <div class="gdwft-editor-block-font" id="gdwft-editor-block-font-type-stack">
                                        <h5><?php _e("Standard Stack", "gd-webfonts-toolbox-lite"); ?>:</h5>
                                        <?php d4p_render_grouped_select(gdwft_plugin()->stacks->default, array('name' => 'editor[font][stack]', 'id' => 'gdwft-editor-block-font-stack')); ?>

                                        <em>
                                            <?php _e("These fonts combinations should work with most browsers on most operating systems.", "gd-webfonts-toolbox-lite"); ?>
                                        </em>
                                    </div>
                                    <div class="gdwft-editor-block-font" id="gdwft-editor-block-font-type-google">
                                        <h5><?php _e("Google Web Font", "gd-webfonts-toolbox-lite"); ?>:</h5>
                                        <?php d4p_render_select(gdwft_get_fonts_list('google', 'dropdown'), array('name' => 'editor[font][google]', 'id' => 'gdwft-editor-block-font-google')); ?>
                                    </div>
                                    <div class="gdwft-editor-block-font" id="gdwft-editor-block-font-type-adobe">
                                        <h5><?php _e("Adobe Web Font", "gd-webfonts-toolbox-lite"); ?>:</h5>
                                        <?php d4p_render_select(gdwft_get_fonts_list('adobe', 'dropdown'), array('name' => 'editor[font][adobe]', 'id' => 'gdwft-editor-block-font-adobe')); ?>
                                    </div>
                                    <div class="gdwft-editor-block-font" id="gdwft-editor-block-font-type-typekit">
                                        <h5><?php _e("TypeKit Font", "gd-webfonts-toolbox-lite"); ?>:</h5>
                                        <?php d4p_render_select(gdwft_get_fonts_list('typekit', 'dropdown'), array('name' => 'editor[font][typekit]', 'id' => 'gdwft-editor-block-font-typekit')); ?>
                                    </div>
                                    <div class="gdwft-editor-block-font" id="gdwft-editor-block-font-type-fontface">
                                        <h5><?php _e("FontFace Font", "gd-webfonts-toolbox-lite"); ?>:</h5>
                                        <?php d4p_render_select(gdwft_get_fonts_list('fontface', 'dropdown'), array('name' => 'editor[font][fontface]', 'id' => 'gdwft-editor-block-font-fontface')); ?>
                                    </div>
                                    <div class="gdwft-editor-block-font" id="gdwft-editor-block-font-type-generic">
                                        <h5><?php _e("Generic Familiy", "gd-webfonts-toolbox-lite"); ?>:</h5>
                                        <?php d4p_render_select($gdwft_data['font']['generic'], array('name' => 'editor[font][generic]', 'id' => 'gdwft-editor-block-font-generic')); ?>
                                    </div>
                                    <div class="gdwft-editor-block-font" id="gdwft-editor-block-font-type-extras">
                                        <h5><?php _e("Generic Familiy", "gd-webfonts-toolbox-lite"); ?>:</h5>
                                        <?php d4p_render_select($gdwft_data['font']['extra'], array('name' => 'editor[font][extra]', 'id' => 'gdwft-editor-block-font-extra')); ?>
                                    </div>
                                </td>
                                <td class="gdwft-block-divider">&nbsp;</td><td class="gdwft-block-divider-line">&nbsp;</td>
                                <td class="gdwft-block-right">
                                    <div class="gdwft-values-main" style="margin-top: 0">
                                        <h4><?php _e("Font Style", "gd-webfonts-toolbox-lite"); ?></h4>
                                        <?php d4p_render_select($gdwft_data['settings']['font-style'], array('name' => 'editor[settings][font-style][select]', 'id' => 'gdwft-editor-settings-font-style-select', 'class' => 'gdwft-editor-settings-select')); ?>
                                        <div class="clear"></div>
                                    </div>

                                    <div class="gdwft-values-main">
                                        <h4><?php _e("Font Variant", "gd-webfonts-toolbox-lite"); ?></h4>
                                        <?php d4p_render_select($gdwft_data['settings']['font-variant'], array('name' => 'editor[settings][font-variant][select]', 'id' => 'gdwft-editor-settings-font-variant-select', 'class' => 'gdwft-editor-settings-select')); ?>
                                        <div class="clear"></div>
                                    </div>

                                    <div class="gdwft-values-main">
                                        <h4><?php _e("Font Weight", "gd-webfonts-toolbox-lite"); ?></h4>
                                        <?php d4p_render_select($gdwft_data['settings']['font-weight'], array('name' => 'editor[settings][font-weight][select]', 'id' => 'gdwft-editor-settings-font-weight-select', 'class' => 'gdwft-editor-settings-select')); ?>
                                        <div class="clear"></div>
                                    </div>

                                    <div class="gdwft-values-main">
                                        <h4><?php _e("Font Size", "gd-webfonts-toolbox-lite"); ?></h4>
                                        <?php d4p_render_select($gdwft_data['settings']['font-size'], array('name' => 'editor[settings][font-size][select]', 'id' => 'gdwft-editor-settings-font-size-select', 'class' => 'gdwft-editor-settings-select gdwft-settings-with-value')); ?>
                                        <div class="clear"></div>
                                    </div>
                                    <div class="gdwft-values-block gdwft-editor-settings-font-size-div" id="gdwft-editor-settings-font-size-div-value">
                                        <h6><?php _e("Custom Value", "gd-webfonts-toolbox-lite"); ?></h6>
                                        <div class="gdwft-values-block-actual">
                                            <?php gdwft_draw_size_unit('gdwft-editor-settings-font-size', 'editor[settings][font-size]'); ?>
                                        </div>
                                        <div class="clear"></div>
                                    </div>
                                </td>
                            </tr>
                        </table>
                    </div>
                    <div class="gdwft-editor-controls">
                        <table class="gdwft-block-table" cellpadding="0" cellspacing="0">
                            <tr>
                                <td class="gdwft-block-left">
                                    <label for="gdwft-editor-activity-font">
                                        <input type="checkbox" name="editor[activity][font]" id="gdwft-editor-activity-font" value="font" class="gdwft-editor-activity-item" /> <?php _e("Font Styles Active", "gd-webfonts-toolbox-lite"); ?>
                                    </label>
                                </td>
                                <td class="gdwft-block-divider">&nbsp;</td><td class="gdwft-block-divider-line">&nbsp;</td>
                                <td class="gdwft-block-right">
                                    <a class="gdwft-editor-button gdwft-editor-activity-reset" href="#font"><?php _e("Reset Font Settings", "gd-webfonts-toolbox-lite"); ?></a>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
                <div id="tab-text" class="wp-tab-panel" style="display: none">
                    <div class="gdwft-editor-options" id="gdwft-editor-block-text">
                        <table class="gdwft-block-table" cellpadding="0" cellspacing="0">
                            <tr>
                                <td class="gdwft-block-left">
                                    <div class="gdwft-values-main" style="margin-top: 0">
                                        <h4><?php _e("Color", "gd-webfonts-toolbox-lite"); ?></h4>
                                        <?php d4p_render_select($gdwft_data['settings']['color'], array('name' => 'editor[settings][color][select]', 'id' => 'gdwft-editor-settings-color-select', 'class' => 'gdwft-editor-settings-select gdwft-settings-with-value')); ?>
                                        <div class="clear"></div>
                                    </div>
                                    <div class="gdwft-values-block gdwft-editor-settings-color-div" id="gdwft-editor-settings-color-div-value">
                                        <h6><?php _e("Custom Value", "gd-webfonts-toolbox-lite"); ?></h6>
                                        <div class="gdwft-values-block-actual">
                                            <input title="rgba(0, 0, 0, 1)" name="editor[settings][color][hex]" class="gdwft-editor-settings-hex" id="gdwft-editor-settings-color-hex" type="text" value="#000000" data-opacity="1" data-default-value="#000000" />
                                            <input name="editor[settings][color][opacity]" class="gdwft-editor-settings-opacity" id="gdwft-editor-settings-color-opacity" type="number" min="0" max="1" step="0.01" value="1" />
                                        </div>
                                        <div class="clear"></div>
                                    </div>

                                    <div class="gdwft-values-main">
                                        <h4><?php _e("Line Height", "gd-webfonts-toolbox-lite"); ?></h4>
                                        <?php d4p_render_select($gdwft_data['settings']['line-height'], array('name' => 'editor[settings][line-height][select]', 'id' => 'gdwft-editor-settings-line-height-select', 'class' => 'gdwft-editor-settings-select gdwft-settings-with-value')); ?>
                                        <div class="clear"></div>
                                    </div>
                                    <div class="gdwft-values-block gdwft-editor-settings-line-height-div" id="gdwft-editor-settings-line-height-div-value">
                                        <h6><?php _e("Custom Value", "gd-webfonts-toolbox-lite"); ?></h6>
                                        <div class="gdwft-values-block-actual">
                                            <?php gdwft_draw_size_unit('gdwft-editor-settings-line-height', 'editor[settings][line-height]'); ?>
                                        </div>
                                        <div class="clear"></div>
                                    </div>

                                    <div class="gdwft-values-main">
                                        <h4><?php _e("Word Spacing", "gd-webfonts-toolbox-lite"); ?></h4>
                                        <?php d4p_render_select($gdwft_data['settings']['word-spacing'], array('name' => 'editor[settings][word-spacing][select]', 'id' => 'gdwft-editor-settings-word-spacing-select', 'class' => 'gdwft-editor-settings-select gdwft-settings-with-value')); ?>
                                        <div class="clear"></div>
                                    </div>
                                    <div class="gdwft-values-block gdwft-editor-settings-word-spacing-div" id="gdwft-editor-settings-word-spacing-div-value">
                                        <h6><?php _e("Custom Value", "gd-webfonts-toolbox-lite"); ?></h6>
                                        <div class="gdwft-values-block-actual">
                                            <?php gdwft_draw_size_unit('gdwft-editor-settings-word-spacing', 'editor[settings][word-spacing]'); ?>
                                        </div>
                                        <div class="clear"></div>
                                    </div>
                                </td>
                                <td class="gdwft-block-divider">&nbsp;</td><td class="gdwft-block-divider-line">&nbsp;</td>
                                <td class="gdwft-block-right">
                                    <div class="gdwft-values-main">
                                        <h4><?php _e("Letter Spacing", "gd-webfonts-toolbox-lite"); ?></h4>
                                        <?php d4p_render_select($gdwft_data['settings']['letter-spacing'], array('name' => 'editor[settings][letter-spacing][select]', 'id' => 'gdwft-editor-settings-letter-spacing-select', 'class' => 'gdwft-editor-settings-select gdwft-settings-with-value')); ?>
                                        <div class="clear"></div>
                                    </div>
                                    <div class="gdwft-values-block gdwft-editor-settings-letter-spacing-div" id="gdwft-editor-settings-letter-spacing-div-value">
                                        <h6><?php _e("Custom Value", "gd-webfonts-toolbox-lite"); ?></h6>
                                        <div class="gdwft-values-block-actual">
                                            <?php gdwft_draw_size_unit('gdwft-editor-settings-letter-spacing', 'editor[settings][letter-spacing]'); ?>
                                        </div>
                                        <div class="clear"></div>
                                    </div>

                                    <div class="gdwft-values-main">
                                        <h4><?php _e("White Space", "gd-webfonts-toolbox-lite"); ?></h4>
                                        <?php d4p_render_select($gdwft_data['settings']['white-space'], array('name' => 'editor[settings][white-space][select]', 'id' => 'gdwft-editor-settings-white-space-select', 'class' => 'gdwft-editor-settings-select')); ?>
                                        <div class="clear"></div>
                                    </div>

                                    <div class="gdwft-values-main">
                                        <h4><?php _e("Text Decoration", "gd-webfonts-toolbox-lite"); ?></h4>
                                        <?php d4p_render_select($gdwft_data['settings']['text-decoration'], array('name' => 'editor[settings][text-decoration][select]', 'id' => 'gdwft-editor-settings-text-decoration-select', 'class' => 'gdwft-editor-settings-select')); ?>
                                        <div class="clear"></div>
                                    </div>

                                    <div class="gdwft-values-main">
                                        <h4><?php _e("Text Transform", "gd-webfonts-toolbox-lite"); ?></h4>
                                        <?php d4p_render_select($gdwft_data['settings']['text-transform'], array('name' => 'editor[settings][text-transform][select]', 'id' => 'gdwft-editor-settings-text-transform-select', 'class' => 'gdwft-editor-settings-select')); ?>
                                        <div class="clear"></div>
                                    </div>

                                    <div class="gdwft-values-main">
                                        <h4><?php _e("Word Break", "gd-webfonts-toolbox-lite"); ?></h4>
                                        <?php d4p_render_select($gdwft_data['settings']['word-break'], array('name' => 'editor[settings][word-break][select]', 'id' => 'gdwft-editor-settings-word-break-select', 'class' => 'gdwft-editor-settings-select')); ?>
                                        <div class="clear"></div>
                                    </div>
                                </td>
                            </tr>
                        </table>
                    </div>
                    <div class="gdwft-editor-controls">
                        <table class="gdwft-block-table" cellpadding="0" cellspacing="0">
                            <tr>
                                <td class="gdwft-block-left">
                                    <label for="gdwft-editor-activity-settings">
                                        <input type="checkbox" name="editor[activity][settings]"  id="gdwft-editor-activity-settings" value="settings" class="gdwft-editor-activity-item" /> <?php _e("Text and Text Position Active", "gd-webfonts-toolbox-lite"); ?>
                                    </label>
                                </td>
                                <td class="gdwft-block-divider">&nbsp;</td><td class="gdwft-block-divider-line">&nbsp;</td>
                                <td class="gdwft-block-right">
                                    <a class="gdwft-editor-button gdwft-editor-activity-reset" href="#text"><?php _e("Reset Text Settings", "gd-webfonts-toolbox-lite"); ?></a>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
                <div id="tab-position" class="wp-tab-panel" style="display: none">
                    <div class="gdwft-editor-options" id="gdwft-editor-block-text">
                        <table class="gdwft-block-table" cellpadding="0" cellspacing="0">
                            <tr>
                                <td class="gdwft-block-left">
                                    <div class="gdwft-values-main">
                                        <h4><?php _e("Text Align", "gd-webfonts-toolbox-lite"); ?></h4>
                                        <?php d4p_render_select($gdwft_data['settings']['text-align'], array('name' => 'editor[settings][text-align][select]', 'id' => 'gdwft-editor-settings-text-align-select', 'class' => 'gdwft-editor-settings-select')); ?>
                                        <div class="clear"></div>
                                    </div>

                                    <div class="gdwft-values-main" style="margin-top: 0">
                                        <h4><?php _e("Vertical Align", "gd-webfonts-toolbox-lite"); ?></h4>
                                        <?php d4p_render_select($gdwft_data['settings']['vertical-align'], array('name' => 'editor[settings][vertical-align][select]', 'id' => 'gdwft-editor-settings-vertical-align-select', 'class' => 'gdwft-editor-settings-select gdwft-settings-with-value')); ?>
                                        <div class="clear"></div>
                                    </div>
                                    <div class="gdwft-values-block gdwft-editor-settings-vertical-align-div" id="gdwft-editor-settings-vertical-align-div-value">
                                        <h6><?php _e("Custom Value", "gd-webfonts-toolbox-lite"); ?></h6>
                                        <div class="gdwft-values-block-actual">
                                            <?php gdwft_draw_size_unit('gdwft-editor-settings-vertical-align', 'editor[settings][vertical-align]'); ?>
                                        </div>
                                        <div class="clear"></div>
                                    </div>
                                </td>
                                <td class="gdwft-block-divider">&nbsp;</td><td class="gdwft-block-divider-line">&nbsp;</td>
                                <td class="gdwft-block-right">
                                    <div class="gdwft-values-main">
                                        <h4><?php _e("Direction", "gd-webfonts-toolbox-lite"); ?></h4>
                                        <?php d4p_render_select($gdwft_data['settings']['direction'], array('name' => 'editor[settings][direction][select]', 'id' => 'gdwft-editor-settings-direction-select', 'class' => 'gdwft-editor-settings-select')); ?>
                                        <div class="clear"></div>
                                    </div>

                                    <div class="gdwft-values-main">
                                        <h4><?php _e("Indent", "gd-webfonts-toolbox-lite"); ?></h4>
                                        <?php d4p_render_select($gdwft_data['settings']['text-indent'], array('name' => 'editor[settings][text-indent][select]', 'id' => 'gdwft-editor-settings-text-indent-select', 'class' => 'gdwft-editor-settings-select gdwft-settings-with-value')); ?>
                                        <div class="clear"></div>
                                    </div>
                                    <div class="gdwft-values-block gdwft-editor-settings-text-indent-div" id="gdwft-editor-settings-text-indent-div-value">
                                        <h6><?php _e("Custom Value", "gd-webfonts-toolbox-lite"); ?></h6>
                                        <div class="gdwft-values-block-actual">
                                            <?php gdwft_draw_size_unit('gdwft-editor-settings-text-indent', 'editor[settings][text-indent]'); ?>
                                        </div>
                                        <div class="clear"></div>
                                    </div>
                                </td>
                            </tr>
                        </table>
                    </div>
                    <div class="gdwft-editor-controls">
                        <table class="gdwft-block-table" cellpadding="0" cellspacing="0">
                            <tr>
                                <td class="gdwft-block-left">&nbsp;</td>
                                <td class="gdwft-block-divider">&nbsp;</td><td class="gdwft-block-divider-line">&nbsp;</td>
                                <td class="gdwft-block-right">
                                    <a class="gdwft-editor-button gdwft-editor-activity-reset" href="#text"><?php _e("Reset Text Position Settings", "gd-webfonts-toolbox-lite"); ?></a>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
                <div id="tab-box" class="wp-tab-panel" style="display: none">
                    <div class="gdwft-editor-options" id="gdwft-editor-block-box">
                        <table class="gdwft-block-table" cellpadding="0" cellspacing="0">
                            <tr>
                                <td class="gdwft-block-left">
                                    <div class="gdwft-values-main" style="margin-top: 0">
                                        <h4><?php _e("Background", "gd-webfonts-toolbox-lite"); ?></h4>
                                        <?php d4p_render_select($gdwft_data['box']['background'], array('name' => 'editor[box][background][select]', 'id' => 'gdwft-editor-box-background-select', 'class' => 'gdwft-editor-settings-select gdwft-settings-with-value')); ?>
                                        <div class="clear"></div>
                                    </div>
                                    <div class="gdwft-values-block gdwft-editor-box-background-div" id="gdwft-editor-box-background-div-value">
                                        <h6><?php _e("Custom Value", "gd-webfonts-toolbox-lite"); ?></h6>
                                        <div class="gdwft-values-block-actual">
                                            <input title="rgba(255, 255, 255, 1)" name="editor[box][background][hex]" class="gdwft-editor-settings-hex" id="gdwft-editor-box-background-hex" type="text" value="#ffffff" data-opacity="1" data-default-value="#ffffff" />
                                            <input name="editor[box][background][opacity]" class="gdwft-editor-settings-opacity" id="gdwft-editor-box-background-opacity" type="number" min="0" max="1" step="0.01" value="1" />
                                        </div>
                                        <div class="clear"></div>
                                    </div>

                                    <div class="gdwft-values-main">
                                        <h4><?php _e("Outline", "gd-webfonts-toolbox-lite"); ?></h4>
                                        <?php d4p_render_select($gdwft_data['box']['outline'], array('name' => 'editor[box][outline][select]', 'id' => 'gdwft-editor-box-outline-select', 'class' => 'gdwft-editor-settings-select gdwft-settings-with-value')); ?>
                                        <div class="clear"></div>
                                    </div>
                                    <div class="gdwft-values-block gdwft-editor-box-outline-div" id="gdwft-editor-box-outline-div-value">
                                        <h6><?php _e("Custom Value", "gd-webfonts-toolbox-lite"); ?></h6>
                                        <div class="gdwft-values-block-actual">
                                            <input title="rgba(255, 255, 255, 1)" name="editor[box][outline][hex]" class="gdwft-editor-settings-hex" id="gdwft-editor-box-background-hex" type="text" value="#000000" data-opacity="1" data-default-value="#000000" />
                                            <input name="editor[box][outline][opacity]" class="gdwft-editor-settings-opacity" id="gdwft-editor-box-outline-opacity" type="number" min="0" max="1" step="0.01" value="1" />
                                            
                                            <?php gdwft_draw_size_unit('gdwft-editor-box-outline', 'editor[box][outline]', false, true); ?>
                                            <?php d4p_render_select(gdwft_css_style_names(), array('name' => 'editor[box][outline][style]', 'id' => 'gdwft-editor-box-outline-style', 'class' => 'gdwft-editor-settings-select gdwft-settings-style')); ?>
                                        </div>
                                        <div class="clear"></div>
                                    </div>

                                    <div class="gdwft-values-main">
                                        <h4><?php _e("Border", "gd-webfonts-toolbox-lite"); ?></h4>
                                        <?php d4p_render_select($gdwft_data['box']['border'], array('name' => 'editor[box][border][select]', 'id' => 'gdwft-editor-box-border-select', 'class' => 'gdwft-editor-settings-select gdwft-settings-with-value')); ?>
                                        <div class="clear"></div>
                                    </div>
                                    <div class="gdwft-values-block gdwft-editor-box-border-div" id="gdwft-editor-box-border-div-value">
                                        <h6><?php _e("Border Value", "gd-webfonts-toolbox-lite"); ?></h6>
                                        <div class="gdwft-values-block-actual">
                                            <input title="rgba(255, 255, 255, 1)" name="editor[box][border][hex]" class="gdwft-editor-settings-hex" id="gdwft-editor-box-border-hex" type="text" value="#ffffff" data-opacity="1" data-default-value="#ffffff" />
                                            <input name="editor[box][border][opacity]" class="gdwft-editor-settings-opacity" id="gdwft-editor-box-border-opacity" type="number" min="0" max="1" step="0.01" value="1" />
                                            
                                            <?php gdwft_draw_size_unit('gdwft-editor-box-border', 'editor[box][border]', false, true); ?>
                                            <?php d4p_render_select(gdwft_css_style_names(), array('name' => 'editor[box][border][style]', 'id' => 'gdwft-editor-box-border-style', 'class' => 'gdwft-editor-settings-select gdwft-settings-style')); ?>
                                        </div>
                                        <div class="clear"></div>
                                    </div>
                                    <div class="gdwft-values-block gdwft-editor-box-border-div" id="gdwft-editor-box-border-div-value_pair">
                                        <h6><?php _e("Top/Bottom Value", "gd-webfonts-toolbox-lite"); ?></h6>
                                        <div class="gdwft-values-block-actual">
                                            <input title="rgba(255, 255, 255, 1)" name="editor[box][border-topbottom][hex]" class="gdwft-editor-settings-hex" id="gdwft-editor-box-border-topbottom-hex" type="text" value="#ffffff" data-opacity="1" data-default-value="#ffffff" />
                                            <input name="editor[box][border-topbottom][opacity]" class="gdwft-editor-settings-opacity" id="gdwft-editor-box-border-topbottom-opacity" type="number" min="0" max="1" step="0.01" value="1" />
                                            <?php gdwft_draw_size_unit('gdwft-editor-box-border-topbottom', 'editor[box][border-topbottom]', false, true); ?>
                                            <?php d4p_render_select(gdwft_css_style_names(), array('name' => 'editor[box][border-topbottom][style]', 'id' => 'gdwft-editor-box-topbottom-style', 'class' => 'gdwft-editor-settings-select gdwft-settings-style')); ?>
                                        </div>
                                        <div class="clear" style="height: 2px"></div>
                                        <h6><?php _e("Left/Right Value", "gd-webfonts-toolbox-lite"); ?></h6>
                                        <div class="gdwft-values-block-actual">
                                            <input title="rgba(255, 255, 255, 1)" name="editor[box][border-leftright][hex]" class="gdwft-editor-settings-hex" id="gdwft-editor-box-border-leftright-hex" type="text" value="#ffffff" data-opacity="1" data-default-value="#ffffff" />
                                            <input name="editor[box][border-leftright][opacity]" class="gdwft-editor-settings-opacity" id="gdwft-editor-box-border-leftright-opacity" type="number" min="0" max="1" step="0.01" value="1" />
                                            <?php gdwft_draw_size_unit('gdwft-editor-box-border-leftright', 'editor[box][border-leftright]', false, true); ?>
                                            <?php d4p_render_select(gdwft_css_style_names(), array('name' => 'editor[box][border-leftright][style]', 'id' => 'gdwft-editor-box-leftright-style', 'class' => 'gdwft-editor-settings-select gdwft-settings-style')); ?>
                                        </div>
                                        <div class="clear"></div>
                                    </div>
                                    <div class="gdwft-values-block gdwft-editor-box-border-div" id="gdwft-editor-box-border-div-value_all">
                                        <h6><?php _e("Top Value", "gd-webfonts-toolbox-lite"); ?></h6>
                                        <div class="gdwft-values-block-actual">
                                            <input title="rgba(255, 255, 255, 1)" name="editor[box][border-top][hex]" class="gdwft-editor-settings-hex" id="gdwft-editor-box-border-top-hex" type="text" value="#ffffff" data-opacity="1" data-default-value="#ffffff" />
                                            <input name="editor[box][border-top][opacity]" class="gdwft-editor-settings-opacity" id="gdwft-editor-box-border-top-opacity" type="number" min="0" max="1" step="0.01" value="1" />
                                            <?php gdwft_draw_size_unit('gdwft-editor-box-border-top', 'editor[box][border-top]', false, true); ?>
                                            <?php d4p_render_select(gdwft_css_style_names(), array('name' => 'editor[box][border-top][style]', 'id' => 'gdwft-editor-box-border-top-style', 'class' => 'gdwft-editor-settings-select gdwft-settings-style')); ?>
                                        </div>
                                        <div class="clear" style="height: 2px"></div>
                                        <h6><?php _e("Right Value", "gd-webfonts-toolbox-lite"); ?></h6>
                                        <div class="gdwft-values-block-actual">
                                            <input title="rgba(255, 255, 255, 1)" name="editor[box][border-right][hex]" class="gdwft-editor-settings-hex" id="gdwft-editor-box-border-right-hex" type="text" value="#ffffff" data-opacity="1" data-default-value="#ffffff" />
                                            <input name="editor[box][border-right][opacity]" class="gdwft-editor-settings-opacity" id="gdwft-editor-box-border-right-opacity" type="number" min="0" max="1" step="0.01" value="1" />
                                            <?php gdwft_draw_size_unit('gdwft-editor-box-border-right', 'editor[box][border-right]', false, true); ?>
                                            <?php d4p_render_select(gdwft_css_style_names(), array('name' => 'editor[box][border-right][style]', 'id' => 'gdwft-editor-box-border-right-style', 'class' => 'gdwft-editor-settings-select gdwft-settings-style')); ?>
                                        </div>
                                        <div class="clear" style="height: 2px"></div>
                                        <h6><?php _e("Bottom Value", "gd-webfonts-toolbox-lite"); ?></h6>
                                        <div class="gdwft-values-block-actual">
                                            <input title="rgba(255, 255, 255, 1)" name="editor[box][border-bottom][hex]" class="gdwft-editor-settings-hex" id="gdwft-editor-box-border-bottom-hex" type="text" value="#ffffff" data-opacity="1" data-default-value="#ffffff" />
                                            <input name="editor[box][border-bottom][opacity]" class="gdwft-editor-settings-opacity" id="gdwft-editor-box-border-bottom-opacity" type="number" min="0" max="1" step="0.01" value="1" />
                                            <?php gdwft_draw_size_unit('gdwft-editor-box-border-bottom', 'editor[box][border-bottom]', false, true); ?>
                                            <?php d4p_render_select(gdwft_css_style_names(), array('name' => 'editor[box][border-bottom][style]', 'id' => 'gdwft-editor-box-border-bottom-style', 'class' => 'gdwft-editor-settings-select gdwft-settings-style')); ?>
                                        </div>
                                        <div class="clear" style="height: 2px"></div>
                                        <h6><?php _e("Left Value", "gd-webfonts-toolbox-lite"); ?></h6>
                                        <div class="gdwft-values-block-actual">
                                            <input title="rgba(255, 255, 255, 1)" name="editor[box][border-left][hex]" class="gdwft-editor-settings-hex" id="gdwft-editor-box-border-left-hex" type="text" value="#ffffff" data-opacity="1" data-default-value="#ffffff" />
                                            <input name="editor[box][border-left][opacity]" class="gdwft-editor-settings-opacity" id="gdwft-editor-box-border-left-opacity" type="number" min="0" max="1" step="0.01" value="1" />
                                            <?php gdwft_draw_size_unit('gdwft-editor-box-border-left', 'editor[box][border-left]', false, true); ?>
                                            <?php d4p_render_select(gdwft_css_style_names(), array('name' => 'editor[box][border-left][style]', 'id' => 'gdwft-editor-box-border-left-style', 'class' => 'gdwft-editor-settings-select gdwft-settings-style')); ?>
                                        </div>
                                        <div class="clear"></div>
                                    </div>

                                    <div class="gdwft-values-main">
                                        <h4><?php _e("Display", "gd-webfonts-toolbox-lite"); ?></h4>
                                        <?php d4p_render_select($gdwft_data['box']['display'], array('name' => 'editor[box][display][select]', 'id' => 'gdwft-editor-box-display-select', 'class' => 'gdwft-editor-settings-select')); ?>
                                        <div class="clear"></div>
                                    </div>

                                    <div class="gdwft-values-main">
                                        <h4><?php _e("Clear", "gd-webfonts-toolbox-lite"); ?></h4>
                                        <?php d4p_render_select($gdwft_data['box']['clear'], array('name' => 'editor[box][clear][select]', 'id' => 'gdwft-editor-box-clear-select', 'class' => 'gdwft-editor-settings-select')); ?>
                                        <div class="clear"></div>
                                    </div>
                                </td>
                                <td class="gdwft-block-divider">&nbsp;</td><td class="gdwft-block-divider-line">&nbsp;</td>
                                <td class="gdwft-block-right">
                                    <div class="gdwft-values-main">
                                        <h4><?php _e("Margin", "gd-webfonts-toolbox-lite"); ?></h4>
                                        <?php d4p_render_select($gdwft_data['box']['margin'], array('name' => 'editor[box][margin][select]', 'id' => 'gdwft-editor-box-margin-select', 'class' => 'gdwft-editor-settings-select gdwft-settings-with-value')); ?>
                                        <div class="clear"></div>
                                    </div>
                                    <div class="gdwft-values-block gdwft-editor-box-margin-div" id="gdwft-editor-box-margin-div-value">
                                        <h6><?php _e("Margin Value", "gd-webfonts-toolbox-lite"); ?></h6>
                                        <div class="gdwft-values-block-actual">
                                            <?php gdwft_draw_size_unit('gdwft-editor-box-margin', 'editor[box][margin]'); ?>
                                        </div>
                                        <div class="clear"></div>
                                    </div>
                                    <div class="gdwft-values-block gdwft-editor-box-margin-div" id="gdwft-editor-box-margin-div-value_pair">
                                        <h6><?php _e("Top/Bottom Value", "gd-webfonts-toolbox-lite"); ?></h6>
                                        <div class="gdwft-values-block-actual">
                                            <?php gdwft_draw_size_unit('gdwft-editor-box-margin-topbottom', 'editor[box][margin-topbottom]'); ?>
                                        </div>
                                        <div class="clear" style="height: 2px"></div>
                                        <h6><?php _e("Left/Right Value", "gd-webfonts-toolbox-lite"); ?></h6>
                                        <div class="gdwft-values-block-actual">
                                            <?php gdwft_draw_size_unit('gdwft-editor-box-margin-leftright', 'editor[box][margin-leftright]'); ?>
                                        </div>
                                        <div class="clear"></div>
                                    </div>
                                    <div class="gdwft-values-block gdwft-editor-box-margin-div" id="gdwft-editor-box-margin-div-value_all">
                                        <h6><?php _e("Top Value", "gd-webfonts-toolbox-lite"); ?></h6>
                                        <div class="gdwft-values-block-actual">
                                            <?php gdwft_draw_size_unit('gdwft-editor-box-margin-top', 'editor[box][margin-top]'); ?>
                                        </div>
                                        <div class="clear" style="height: 2px"></div>
                                        <h6><?php _e("Right Value", "gd-webfonts-toolbox-lite"); ?></h6>
                                        <div class="gdwft-values-block-actual">
                                            <?php gdwft_draw_size_unit('gdwft-editor-box-margin-right', 'editor[box][margin-right]'); ?>
                                        </div>
                                        <div class="clear" style="height: 2px"></div>
                                        <h6><?php _e("Bottom Value", "gd-webfonts-toolbox-lite"); ?></h6>
                                        <div class="gdwft-values-block-actual">
                                            <?php gdwft_draw_size_unit('gdwft-editor-box-margin-bottom', 'editor[box][margin-bottom]'); ?>
                                        </div>
                                        <div class="clear" style="height: 2px"></div>
                                        <h6><?php _e("Left Value", "gd-webfonts-toolbox-lite"); ?></h6>
                                        <div class="gdwft-values-block-actual">
                                            <?php gdwft_draw_size_unit('gdwft-editor-box-margin-left', 'editor[box][margin-left]'); ?>
                                        </div>
                                        <div class="clear"></div>
                                    </div>

                                    <div class="gdwft-values-main">
                                        <h4><?php _e("Padding", "gd-webfonts-toolbox-lite"); ?></h4>
                                        <?php d4p_render_select($gdwft_data['box']['padding'], array('name' => 'editor[box][padding][select]', 'id' => 'gdwft-editor-box-padding-select', 'class' => 'gdwft-editor-settings-select gdwft-settings-with-value')); ?>
                                        <div class="clear"></div>
                                    </div>
                                    <div class="gdwft-values-block gdwft-editor-box-padding-div" id="gdwft-editor-box-padding-div-value">
                                        <h6><?php _e("Padding Value", "gd-webfonts-toolbox-lite"); ?></h6>
                                        <div class="gdwft-values-block-actual">
                                            <?php gdwft_draw_size_unit('gdwft-editor-box-padding', 'editor[box][padding]'); ?>
                                        </div>
                                        <div class="clear"></div>
                                    </div>
                                    <div class="gdwft-values-block gdwft-editor-box-padding-div" id="gdwft-editor-box-padding-div-value_pair">
                                        <h6><?php _e("Top/Bottom Value", "gd-webfonts-toolbox-lite"); ?></h6>
                                        <div class="gdwft-values-block-actual">
                                            <?php gdwft_draw_size_unit('gdwft-editor-box-padding-topbottom', 'editor[box][padding-topbottom]'); ?>
                                        </div>
                                        <div class="clear" style="height: 2px"></div>
                                        <h6><?php _e("Left/Right Value", "gd-webfonts-toolbox-lite"); ?></h6>
                                        <div class="gdwft-values-block-actual">
                                            <?php gdwft_draw_size_unit('gdwft-editor-box-padding-leftright', 'editor[box][padding-leftright]'); ?>
                                        </div>
                                        <div class="clear"></div>
                                    </div>
                                    <div class="gdwft-values-block gdwft-editor-box-padding-div" id="gdwft-editor-box-padding-div-value_all">
                                        <h6><?php _e("Top Value", "gd-webfonts-toolbox-lite"); ?></h6>
                                        <div class="gdwft-values-block-actual">
                                            <?php gdwft_draw_size_unit('gdwft-editor-box-padding-top', 'editor[box][padding-top]'); ?>
                                        </div>
                                        <div class="clear" style="height: 2px"></div>
                                        <h6><?php _e("Right Value", "gd-webfonts-toolbox-lite"); ?></h6>
                                        <div class="gdwft-values-block-actual">
                                            <?php gdwft_draw_size_unit('gdwft-editor-box-padding-right', 'editor[box][padding-right]'); ?>
                                        </div>
                                        <div class="clear" style="height: 2px"></div>
                                        <h6><?php _e("Bottom Value", "gd-webfonts-toolbox-lite"); ?></h6>
                                        <div class="gdwft-values-block-actual">
                                            <?php gdwft_draw_size_unit('gdwft-editor-box-padding-bottom', 'editor[box][padding-bottom]'); ?>
                                        </div>
                                        <div class="clear" style="height: 2px"></div>
                                        <h6><?php _e("Left Value", "gd-webfonts-toolbox-lite"); ?></h6>
                                        <div class="gdwft-values-block-actual">
                                            <?php gdwft_draw_size_unit('gdwft-editor-box-padding-left', 'editor[box][padding-left]'); ?>
                                        </div>
                                        <div class="clear"></div>
                                    </div>

                                    <div class="gdwft-values-main">
                                        <h4><?php _e("Border Radius", "gd-webfonts-toolbox-lite"); ?></h4>
                                        <?php d4p_render_select($gdwft_data['box']['border-radius'], array('name' => 'editor[box][border-radius][select]', 'id' => 'gdwft-editor-box-border-radius-select', 'class' => 'gdwft-editor-settings-select gdwft-settings-with-value')); ?>
                                        <div class="clear"></div>
                                    </div>
                                    <div class="gdwft-values-block gdwft-editor-box-border-radius-div" id="gdwft-editor-box-border-radius-div-value">
                                        <h6><?php _e("Radius Value", "gd-webfonts-toolbox-lite"); ?></h6>
                                        <div class="gdwft-values-block-actual">
                                            <?php gdwft_draw_size_unit('gdwft-editor-box-border-radius', 'editor[box][border-radius]'); ?>
                                        </div>
                                        <div class="clear"></div>
                                    </div>
                                    <div class="gdwft-values-block gdwft-editor-box-border-radius-div" id="gdwft-editor-box-border-radius-div-value_all">
                                        <h6><?php _e("Top-Left Value", "gd-webfonts-toolbox-lite"); ?></h6>
                                        <div class="gdwft-values-block-actual">
                                            <?php gdwft_draw_size_unit('gdwft-editor-box-border-top-left-radius', 'editor[box][border-top-left-radius]'); ?>
                                        </div>
                                        <div class="clear" style="height: 2px"></div>
                                        <h6><?php _e("Top-Right Value", "gd-webfonts-toolbox-lite"); ?></h6>
                                        <div class="gdwft-values-block-actual">
                                            <?php gdwft_draw_size_unit('gdwft-editor-box-border-top-right-radius', 'editor[box][border-top-right-radius]'); ?>
                                        </div>
                                        <div class="clear" style="height: 2px"></div>
                                        <h6><?php _e("Bottom-Right Value", "gd-webfonts-toolbox-lite"); ?></h6>
                                        <div class="gdwft-values-block-actual">
                                            <?php gdwft_draw_size_unit('gdwft-editor-box-border-bottom-right-radius', 'editor[box][border-bottom-right-radius]'); ?>
                                        </div>
                                        <div class="clear" style="height: 2px"></div>
                                        <h6><?php _e("Bottom-Left Value", "gd-webfonts-toolbox-lite"); ?></h6>
                                        <div class="gdwft-values-block-actual">
                                            <?php gdwft_draw_size_unit('gdwft-editor-box-border-bottom-left-radius', 'editor[box][border-bottom-left-radius]'); ?>
                                        </div>
                                        <div class="clear"></div>
                                    </div>
                                </td>
                            </tr>
                        </table>
                    </div>
                    <div class="gdwft-editor-controls">
                        <table class="gdwft-block-table" cellpadding="0" cellspacing="0">
                            <tr>
                                <td class="gdwft-block-left">
                                    <label for="gdwft-editor-activity-box">
                                        <input type="checkbox" name="editor[activity][box]" id="gdwft-editor-activity-box" value="box" class="gdwft-editor-activity-item" /> <?php _e("Box and Box Size Active", "gd-webfonts-toolbox-lite"); ?>
                                    </label>
                                </td>
                                <td class="gdwft-block-divider">&nbsp;</td><td class="gdwft-block-divider-line">&nbsp;</td>
                                <td class="gdwft-block-right">
                                    <a class="gdwft-editor-button gdwft-editor-activity-reset" href="#box"><?php _e("Reset Box Model Settings", "gd-webfonts-toolbox-lite"); ?></a>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
                <div id="tab-size" class="wp-tab-panel" style="display: none">
                    <div class="gdwft-editor-options" id="gdwft-editor-block-size">
                        <table class="gdwft-block-table" cellpadding="0" cellspacing="0">
                            <tr>
                                <td class="gdwft-block-left">
                                    <div class="gdwft-values-main">
                                        <h4><?php _e("Box Sizing", "gd-webfonts-toolbox-lite"); ?></h4>
                                        <?php d4p_render_select($gdwft_data['box']['box-sizing'], array('name' => 'editor[box][box-sizing][select]', 'id' => 'gdwft-editor-box-box-sizing-select', 'class' => 'gdwft-editor-settings-select')); ?>
                                        <div class="clear"></div>
                                    </div>

                                    <div class="gdwft-values-main" style="margin-top: 0">
                                        <h4><?php _e("Width", "gd-webfonts-toolbox-lite"); ?></h4>
                                        <?php d4p_render_select($gdwft_data['box']['width'], array('name' => 'editor[box][width][select]', 'id' => 'gdwft-editor-box-width-select', 'class' => 'gdwft-editor-settings-select gdwft-settings-with-value')); ?>
                                        <div class="clear"></div>
                                    </div>
                                    <div class="gdwft-values-block gdwft-editor-box-width-div" id="gdwft-editor-box-width-div-value">
                                        <h6><?php _e("Custom Value", "gd-webfonts-toolbox-lite"); ?></h6>
                                        <div class="gdwft-values-block-actual">
                                            <?php gdwft_draw_size_unit('gdwft-editor-box-width', 'editor[box][width]'); ?>
                                        </div>
                                        <div class="clear"></div>
                                    </div>

                                    <div class="gdwft-values-main">
                                        <h4><?php _e("Min Width", "gd-webfonts-toolbox-lite"); ?></h4>
                                        <?php d4p_render_select($gdwft_data['box']['min-width'], array('name' => 'editor[box][min-width][select]', 'id' => 'gdwft-editor-box-min-width-select', 'class' => 'gdwft-editor-settings-select gdwft-settings-with-value')); ?>
                                        <div class="clear"></div>
                                    </div>
                                    <div class="gdwft-values-block gdwft-editor-box-min-width-div" id="gdwft-editor-box-min-width-div-value">
                                        <h6><?php _e("Custom Value", "gd-webfonts-toolbox-lite"); ?></h6>
                                        <div class="gdwft-values-block-actual">
                                            <?php gdwft_draw_size_unit('gdwft-editor-box-min-width', 'editor[box][min-width]'); ?>
                                        </div>
                                        <div class="clear"></div>
                                    </div>

                                    <div class="gdwft-values-main">
                                        <h4><?php _e("Max Width", "gd-webfonts-toolbox-lite"); ?></h4>
                                        <?php d4p_render_select($gdwft_data['box']['max-width'], array('name' => 'editor[box][max-width][select]', 'id' => 'gdwft-editor-box-max-width-select', 'class' => 'gdwft-editor-settings-select gdwft-settings-with-value')); ?>
                                        <div class="clear"></div>
                                    </div>
                                    <div class="gdwft-values-block gdwft-editor-box-max-width-div" id="gdwft-editor-box-max-width-div-value">
                                        <h6><?php _e("Custom Value", "gd-webfonts-toolbox-lite"); ?></h6>
                                        <div class="gdwft-values-block-actual">
                                            <?php gdwft_draw_size_unit('gdwft-editor-box-max-width', 'editor[box][max-width]'); ?>
                                        </div>
                                        <div class="clear"></div>
                                    </div>
                                </td>
                                <td class="gdwft-block-divider">&nbsp;</td><td class="gdwft-block-divider-line">&nbsp;</td>
                                <td class="gdwft-block-right">
                                    <div class="gdwft-values-main">
                                        <h4><?php _e("Height", "gd-webfonts-toolbox-lite"); ?></h4>
                                        <?php d4p_render_select($gdwft_data['box']['height'], array('name' => 'editor[box][height][select]', 'id' => 'gdwft-editor-box-height-select', 'class' => 'gdwft-editor-settings-select gdwft-settings-with-value')); ?>
                                        <div class="clear"></div>
                                    </div>
                                    <div class="gdwft-values-block gdwft-editor-box-height-div" id="gdwft-editor-box-height-div-value">
                                        <h6><?php _e("Custom Value", "gd-webfonts-toolbox-lite"); ?></h6>
                                        <div class="gdwft-values-block-actual">
                                            <?php gdwft_draw_size_unit('gdwft-editor-box-height', ''); ?>
                                        </div>
                                        <div class="clear"></div>
                                    </div>

                                    <div class="gdwft-values-main">
                                        <h4><?php _e("Min Height", "gd-webfonts-toolbox-lite"); ?></h4>
                                        <?php d4p_render_select($gdwft_data['box']['min-height'], array('name' => 'editor[box][min-height][select]', 'id' => 'gdwft-editor-box-min-height-select', 'class' => 'gdwft-editor-settings-select gdwft-settings-with-value')); ?>
                                        <div class="clear"></div>
                                    </div>
                                    <div class="gdwft-values-block gdwft-editor-box-min-height-div" id="gdwft-editor-box-min-height-div-value">
                                        <h6><?php _e("Custom Value", "gd-webfonts-toolbox-lite"); ?></h6>
                                        <div class="gdwft-values-block-actual">
                                            <?php gdwft_draw_size_unit('gdwft-editor-box-min-height', 'editor[box][min-height]'); ?>
                                        </div>
                                        <div class="clear"></div>
                                    </div>

                                    <div class="gdwft-values-main">
                                        <h4><?php _e("Max Height", "gd-webfonts-toolbox-lite"); ?></h4>
                                        <?php d4p_render_select($gdwft_data['box']['max-height'], array('name' => 'editor[box][max-height][select]', 'id' => 'gdwft-editor-box-max-height-select', 'class' => 'gdwft-editor-settings-select gdwft-settings-with-value')); ?>
                                        <div class="clear"></div>
                                    </div>
                                    <div class="gdwft-values-block gdwft-editor-box-max-height-div" id="gdwft-editor-box-max-height-div-value">
                                        <h6><?php _e("Custom Value", "gd-webfonts-toolbox-lite"); ?></h6>
                                        <div class="gdwft-values-block-actual">
                                            <?php gdwft_draw_size_unit('gdwft-editor-box-max-height', 'editor[box][max-height]'); ?>
                                        </div>
                                        <div class="clear"></div>
                                    </div>
                                    
                                </td>
                            </tr>
                        </table>
                    </div>
                    <div class="gdwft-editor-controls">
                        <table class="gdwft-block-table" cellpadding="0" cellspacing="0">
                            <tr>
                                <td class="gdwft-block-left">&nbsp;</td>
                                <td class="gdwft-block-divider">&nbsp;</td><td class="gdwft-block-divider-line">&nbsp;</td>
                                <td class="gdwft-block-right">
                                    <a class="gdwft-editor-button gdwft-editor-activity-reset" href="#size"><?php _e("Reset Box Size Settings", "gd-webfonts-toolbox-lite"); ?></a>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
                <div id="tab-text-shadow" class="wp-tab-panel" style="display: none">
                    <div id="gdwft-editor-block-shadows" class="gdwft-editor-options gdwft-table-editor gdwft-table-editor-shadows" style="text-align: center;">
                        Text Shadows styling is available only in Pro version. You can add one or more text shadows to each selector, and plugin has number of predefined shadows you can load and use. Plugin uses color picker with transparency support.

                        <img style="border: 1px solid #ccc; display: block; height: auto; margin-top: 15px; max-width: 796px;" src="<?php echo GDWFT_URL; ?>gfx/rules_shadows.png" alt="Selector Shadows Rules" />
                    </div>
                    <div class="gdwft-editor-controls">
                        
                    </div>
                </div>
                <div id="tab-box-shadow" class="wp-tab-panel" style="display: none">
                    <div id="gdwft-editor-block-box_shadows" class="gdwft-editor-options gdwft-table-editor gdwft-table-editor-box_shadows" style="text-align: center;">
                        Box Shadows styling is available only in Pro version. You can add one or more box shadows to each selector, and plugin has number of predefined shadows you can load and use. Plugin uses color picker with transparency support.

                        <img style="border: 1px solid #ccc; display: block; height: auto; margin-top: 15px; max-width: 796px;" src="<?php echo GDWFT_URL; ?>gfx/rules_shadows.png" alt="Selector Shadows Rules" />
                    </div>
                    <div class="gdwft-editor-controls">
                        
                    </div>
                </div>
                <div id="tab-custom" class="wp-tab-panel" style="display: none">
                    <div class="gdwft-editor-options" id="gdwft-editor-block-custom">
                        <table class="gdwft-block-table" cellpadding="0" cellspacing="0">
                            <tr>
                                <td class="gdwft-block-left">
                                    <em>
                                        <?php _e("You can add any number of CSS style properties. These properties will be added to the rule for the selector. Each property must end with semi-colon (;) just like in the real CSS file.", "gd-webfonts-toolbox-lite"); ?>
                                    </em>
                                </td>
                                <td class="gdwft-block-divider">&nbsp;</td><td class="gdwft-block-divider-line">&nbsp;</td>
                                <td class="gdwft-block-right">
                                    <textarea name="editor[custom]" id="gdwft-editor-custom-styles"></textarea>
                                </td>
                            </tr>
                        </table>
                    </div>
                    <div class="gdwft-editor-controls">
                        <table class="gdwft-block-table" cellpadding="0" cellspacing="0">
                            <tr>
                                <td class="gdwft-block-left">
                                    <label for="gdwft-editor-activity-custom">
                                        <input type="checkbox" name="editor[activity][custom]" id="gdwft-editor-activity-custom" value="custom" class="gdwft-editor-activity-item" /> <?php _e("Custom Styles Active", "gd-webfonts-toolbox-lite"); ?>
                                    </label>
                                </td>
                                <td class="gdwft-block-divider">&nbsp;</td><td class="gdwft-block-divider-line">&nbsp;</td>
                                <td class="gdwft-block-right">
                                    <a class="gdwft-editor-button gdwft-editor-activity-reset" href="#custom"><?php _e("Reset Custom CSS", "gd-webfonts-toolbox-lite"); ?></a>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
                <div id="tab-settings" class="wp-tab-panel" style="display: none">
                    <div class="gdwft-rules-settings">
                        <table class="gdwft-table-editor gdwft-table-preview-full" cellspacing="0" cellpadding="0">
                            <tr>
                                <td class="gdwft-left">
                                    <?php _e("Text for preview", "gd-webfonts-toolbox-lite"); ?>:
                                </td>
                                <td class="gdwft-right">
                                    <input type="text" class="gdwft-preview-full-text" value="<?php echo esc_attr(gdwft_plugin()->get('preview_text')); ?>" />
                                    <em><?php echo sprintf(__("You can use %s inside the text for preview to break text into lines.", "gd-webfonts-toolbox-lite"), "<strong>&lt;br /&gt;</strong>"); ?></em>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>

            <div id="gdwft-preview-full-box" class="gdwft-preview-box" style="margin-top: 10px;">
                <p>
                    <?php echo esc_attr(gdwft_plugin()->get('preview_text')); ?>
                </p>
            </div>
        </form>
    </div>
</div>