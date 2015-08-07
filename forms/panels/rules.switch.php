<?php $default_type = 'default'; ?>
<form method="POST">
    <?php settings_fields('gd-webfonts-toolbox-newrule'); ?>

    <label for="gdwft-rule-type"><span><?php _e("Select Rule Type", "gd-webfonts-toolbox-lite"); ?>:</span>
        <?php d4p_render_select($rule_types, array('selected' => $default_type, 'name' => 'rule[type]', 'id' => 'gdwft-rule-type')); ?>
    </label>
    <div class="gdwft-rule-box gdwft-rule-custom" style="display: <?php echo $default_type == 'custom' ? 'block' : 'none'; ?>;">
        <label for="gdwft-rule-custom-label"><span><?php _e("Label", "gd-webfonts-toolbox-lite"); ?>:</span>
            <input id="gdwft-rule-custom-label" name="rule[custom][label]" type="text" value="" maxlength="128" />
        </label>
        <label for="gdwft-rule-custom-selector"><span><?php _e("Selector", "gd-webfonts-toolbox-lite"); ?>:</span>
            <textarea id="gdwft-rule-custom-selector" name="rule[custom][selector]"></textarea>
        </label>
        <em><?php _e("Both Label and Selector are required.", "gd-webfonts-toolbox-lite"); ?></em>
    </div>
    <div class="gdwft-rule-box gdwft-rule-editor" style="display: <?php echo $default_type == 'editor' ? 'block' : 'none'; ?>;">
        <label for="gdwft-rule-editor-label"><span><?php _e("Label", "gd-webfonts-toolbox-lite"); ?>:</span>
            <input id="gdwft-rule-editor-label" name="rule[editor][label]" type="text" value="" maxlength="128" />
        </label>
        <label for="gdwft-rule-editor-class"><span><?php _e("Class Name", "gd-webfonts-toolbox-lite"); ?>:</span>
            <input id="gdwft-rule-editor-class" name="rule[editor][class]" type="text" value="" maxlength="512" />
        </label>
        <label for="gdwft-rule-editor-method"><span><?php _e("Method", "gd-webfonts-toolbox-lite"); ?>:</span>
            <?php d4p_render_select($editor_methods, array('selected' => 'inline', 'name' => 'rule[editor][method]', 'id' => 'gdwft-rule-editor-method')); ?>
        </label>
        <div class="gdwft-rule-method gdwft-rule-method-inline" style="display: block;">
            <label for="gdwft-rule-editor-inline"><span><?php _e("Inline Tag", "gd-webfonts-toolbox-lite"); ?>:</span>
                <input id="gdwft-rule-editor-inline" name="rule[editor][inline]" type="text" value="span" maxlength="128" />
            </label>
        </div>
        <div class="gdwft-rule-method gdwft-rule-method-block" style="display: none;">
            <label for="gdwft-rule-editor-block"><span><?php _e("Block Tag", "gd-webfonts-toolbox-lite"); ?>:</span>
                <input id="gdwft-rule-editor-block" name="rule[editor][block]" type="text" value="div" maxlength="128" />
            </label>
        </div>
        <div class="gdwft-rule-method gdwft-rule-method-selector" style="display: none;">
            <label for="gdwft-rule-editor-selector"><span><?php _e("Selector", "gd-webfonts-toolbox-lite"); ?>:</span>
                <input id="gdwft-rule-editor-selector" name="rule[editor][selector]" type="text" value="" />
            </label>
        </div>
        <em><?php _e("Label and Class Name are required.", "gd-webfonts-toolbox-lite"); ?> <?php _e("Class name consists of alphanumeric characters, underscore and hyphen.", "gd-webfonts-toolbox-lite"); ?> <?php _e("More on the different methods you can find in documentation.", "gd-webfonts-toolbox-lite"); ?></em>
    </div>
    <div class="gdwft-rule-box gdwft-rule-default" style="display: <?php echo $default_type == 'default' ? 'block' : 'none'; ?>;">
        <label for="gdwft-rule-default-rule"><span><?php _e("Default Rules", "gd-webfonts-toolbox-lite"); ?>:</span>
            <?php d4p_render_select($gdwft_rules['default'], array('selected' => '', 'name' => 'rule[default][rule]'), $gdwft_defaults['default']); ?>
        </label>
    </div>
    <div class="gdwft-rule-box gdwft-rule-themes" style="display: <?php echo $default_type == 'themes' ? 'block' : 'none'; ?>;">
        <label for="gdwft-rule-themes-rule"><span><?php _e("Current Theme Rules", "gd-webfonts-toolbox-lite"); ?>:</span>
            <?php d4p_render_select($gdwft_rules['themes'], array('selected' => '', 'name' => 'rule[themes][rule]'), $gdwft_defaults['themes']); ?>
        </label>
    </div>
    <div class="gdwft-rule-box gdwft-rule-plugins" style="display: <?php echo $default_type == 'plugins' ? 'block' : 'none'; ?>;">
        <label for="gdwft-rule-plugins-rule"><span><?php _e("Active Plugins Rules", "gd-webfonts-toolbox-lite"); ?>:</span>
            <?php d4p_render_select($gdwft_rules['plugins'], array('selected' => '', 'name' => 'rule[plugins][rule]'), $gdwft_defaults['plugins']); ?>
        </label>
    </div>

    <div class="gdwft-rule-box gdwft-copy-rules-box">
        <label for="gdwft-rule-copy-from"><span><?php _e("Copy Settings From", "gd-webfonts-toolbox-lite"); ?>:</span>
            <?php d4p_render_select($copy_from, array('selected' => '0', 'name' => 'rule[copy]')); ?>
        </label>
    </div>
    <input class="button-primary" type="submit" value="<?php _e("Add New Rule", "gd-webfonts-toolbox-lite"); ?>" />
</form>
