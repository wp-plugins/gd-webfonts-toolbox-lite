<div style="display: none;">
    <div title="<?php _e("Preview CSS", "gd-webfonts-toolbox-lite"); ?>" id="gdwft-preview-css">
        <div id="gdwft-css-block">

        </div>
    </div>

    <div title="<?php _e("Preview Font, Settings, Shadows and Custom CSS", "gd-webfonts-toolbox-lite"); ?>" id="gdwft-preview-full">
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

        <div id="gdwft-preview-full-box" class="gdwft-preview-box"><p><?php echo esc_attr(gdwft_plugin()->get('preview_text')); ?></p></div>
    </div>

    <div title="<?php _e("Edit Rule Selector", "gd-webfonts-toolbox-lite"); ?>" id="gdwft-editor-selector">
        <form id="gdwft-form-edit-selector" method="POST">
            <?php settings_fields('gd-webfonts-toolbox-edit-selector'); ?>

            <input id="gdwft-selector-id" name="rule[id]" type="hidden" value="" />

            <div class="gdwft-editor-label">
                <label for="gdwft-selector-label"><span><?php _e("Label", "gd-webfonts-toolbox-lite"); ?>:</span>
                    <input id="gdwft-selector-label" name="rule[label]" type="text" value="" maxlength="128" />
                </label>
            </div>
            <div id="gdwft-editor-selector-block" class="gdwft-editor-selector">
                <label for="gdwft-selector-selector"><span><?php _e("Selector", "gd-webfonts-toolbox-lite"); ?>:</span>
                    <textarea id="gdwft-selector-selector" name="rule[selector]"></textarea>
                </label>
                <em><?php _e("Both Label and Selector are required.", "gd-webfonts-toolbox-lite"); ?></em>
            </div>
            <div id="gdwft-editor-integrate-block" class="gdwft-editor-integrate" style="display: none;">
                <label for="gdwft-selector-editor-class"><span><?php _e("Class Name", "gd-webfonts-toolbox-lite"); ?>:</span>
                    <input id="gdwft-selector-editor-class" name="rule[class]" type="text" value="" />
                </label>
                <label for="gdwft-selector-editor-method"><span><?php _e("Method", "gd-webfonts-toolbox-lite"); ?>:</span>
                    <?php d4p_render_select($editor_methods, array('selected' => 'inline', 'name' => 'rule[method]', 'id' => 'gdwft-selector-editor-method')); ?>
                </label>
                <div class="gdwft-selector-method gdwft-selector-method-inline" style="display: block;">
                    <label for="gdwft-selector-editor-inline"><span><?php _e("Inline Tag", "gd-webfonts-toolbox-lite"); ?>:</span>
                        <input id="gdwft-selector-editor-inline" name="rule[editor][inline]" type="text" value="span" maxlength="128" />
                    </label>
                </div>
                <div class="gdwft-selector-method gdwft-selector-method-block" style="display: none;">
                    <label for="gdwft-selector-editor-block"><span><?php _e("Block Tag", "gd-webfonts-toolbox-lite"); ?>:</span>
                        <input id="gdwft-selector-editor-block" name="rule[editor][block]" type="text" value="div" maxlength="128" />
                    </label>
                </div>
                <div class="gdwft-selector-method gdwft-selector-method-selector" style="display: none;">
                    <label for="gdwft-selector-editor-selector"><span><?php _e("Selector", "gd-webfonts-toolbox-lite"); ?>:</span>
                        <input id="gdwft-selector-editor-selector" name="rule[editor][selector]" type="text" value="" />
                    </label>
                </div>
                <em><?php _e("If you change class name and / or method used, previously used selectors in posts will loose their styles.", "gd-webfonts-toolbox-lite"); ?></em><br/>
            </div>
        </form>
    </div>
</div>