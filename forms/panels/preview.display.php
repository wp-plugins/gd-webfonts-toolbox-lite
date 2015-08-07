<div class="gdwft-preview-panel-controls">
    <table>
        <tr>
            <td>
                <?php _e("Back", "gd-webfonts-toolbox-lite"); ?>: 
                <input type="text" value="#ffffff" class="gdwft-preview-ctrl-background" />
            </td>
            <td>
                <?php _e("Front", "gd-webfonts-toolbox-lite"); ?>: 
                <input type="text" value="#000000" class="gdwft-preview-ctrl-color" />
            </td>
            <td style="border-right: 1px solid #dddddd; padding-left: 8px;"></td>
            <td style="padding-left: 12px;">
                <?php _e("Text", "gd-webfonts-toolbox-lite"); ?>: 
                <input style="width: 400px" type="text" id="gdwft-preview-ctrl-text" value="<?php echo esc_attr(gdwft_plugin()->get('preview_text')); ?>" />
            </td>
        </tr>
    </table>
</div>
<div class="gdwft-preview-panel-font">
    <div class="gdwft-preview-panel-info">
        <div class="gdwft-preview-included">
            <span class="gdwft-include-status-in"><i class="fa fa-check-square"></i> <?php _e("In Include list", "gd-webfonts-toolbox-lite") ?></span>
            <span class="gdwft-include-status-not-in"><i class="fa fa-square"></i> <?php _e("Not in Include list", "gd-webfonts-toolbox-lite") ?></span>
            <div>
                <a href="#" class="gdwft-include-add"><?php _e("Add to List", "gd-webfonts-toolbox-lite"); ?></a>
                <a href="#" class="gdwft-include-remove"><?php _e("Remove from list", "gd-webfonts-toolbox-lite"); ?></a>
            </div>
        </div>
        <span class="gdwft-preview-font-type"></span>: <span class="gdwft-preview-font-name"></span>
        <span class="gdwft-preview-font-extra"></span><br/>
        <span style="font-size: .8em;"><?php _e("Font Family Name", "gd-webfonts-toolbox-lite"); ?>: </span><span style="font-size: .8em; font-weight: bold;" class="gdwft-preview-font-family"></span>
        <div class="gdwft-preview-font-category" style="display: none; font-size: .8em;"><?php _e("Font Category", "gd-webfonts-toolbox-lite"); ?>: <span style="font-weight: bold;"></span></div>
    </div>
    <table class="gdwft-preview-font-variant">
        <tr>
            <td><?php _e("Normal", "gd-webfonts-toolbox-lite"); ?>:</td>
            <td>
                <a class="gdwft-variant-normal gdwft-variant-normal-100" href="#100">100</a>
                <a class="gdwft-variant-normal gdwft-variant-normal-200" href="#200">200</a>
                <a class="gdwft-variant-normal gdwft-variant-normal-300" href="#300">300</a>
                <a class="gdwft-variant-normal gdwft-variant-normal-400" href="#400">400</a>
                <a class="gdwft-variant-normal gdwft-variant-normal-500" href="#500">500</a>
                <a class="gdwft-variant-normal gdwft-variant-normal-600" href="#600">600</a>
                <a class="gdwft-variant-normal gdwft-variant-normal-700" href="#700">700</a>
                <a class="gdwft-variant-normal gdwft-variant-normal-800" href="#800">800</a>
                <a class="gdwft-variant-normal gdwft-variant-normal-900" href="#900">900</a>
            </td>
            <td style="border-right: 1px solid #dddddd; padding-left: 4px;"></td>
            <td style="padding-left: 4px;">
            <td><?php _e("Italic", "gd-webfonts-toolbox-lite"); ?>:</td>
            <td>
                <a class="gdwft-variant-italic gdwft-variant-italic-100" href="#100">100</a>
                <a class="gdwft-variant-italic gdwft-variant-italic-200" href="#200">200</a>
                <a class="gdwft-variant-italic gdwft-variant-italic-300" href="#300">300</a>
                <a class="gdwft-variant-italic gdwft-variant-italic-400" href="#400">400</a>
                <a class="gdwft-variant-italic gdwft-variant-italic-500" href="#500">500</a>
                <a class="gdwft-variant-italic gdwft-variant-italic-600" href="#600">600</a>
                <a class="gdwft-variant-italic gdwft-variant-italic-700" href="#700">700</a>
                <a class="gdwft-variant-italic gdwft-variant-italic-800" href="#800">800</a>
                <a class="gdwft-variant-italic gdwft-variant-italic-900" href="#900">900</a>
            </td>
            <td style="border-right: 1px solid #dddddd; padding-left: 4px;"></td>
            <td style="padding-left: 4px;">
            <td><?php _e("Oblique", "gd-webfonts-toolbox-lite"); ?>:</td>
            <td>
                <a class="gdwft-variant-oblique gdwft-variant-oblique-100" href="#100">100</a>
                <a class="gdwft-variant-oblique gdwft-variant-oblique-200" href="#200">200</a>
                <a class="gdwft-variant-oblique gdwft-variant-oblique-300" href="#300">300</a>
                <a class="gdwft-variant-oblique gdwft-variant-oblique-400" href="#400">400</a>
                <a class="gdwft-variant-oblique gdwft-variant-oblique-500" href="#500">500</a>
                <a class="gdwft-variant-oblique gdwft-variant-oblique-600" href="#600">600</a>
                <a class="gdwft-variant-oblique gdwft-variant-oblique-700" href="#700">700</a>
                <a class="gdwft-variant-oblique gdwft-variant-oblique-800" href="#800">800</a>
                <a class="gdwft-variant-oblique gdwft-variant-oblique-900" href="#900">900</a>
            </td>
        </tr>
    </table>
</div>
<div class="gdwft-preview-panel-preview">
    <p style="font-size: 64px"></p>
    <p style="font-size: 40px"></p>
    <p style="font-size: 32px"></p>
    <p style="font-size: 24px"></p>
    <p style="font-size: 20px"></p>
    <p style="font-size: 16px"></p>
    <p style="font-size: 12px"></p>
    <p style="font-size: 8px"></p>
</div>
<div class="gdwft-preview-panel-usage">
    <span class="gdwft-preview-usage-title"><?php _e("Usage Example", "gd-webfonts-toolbox-lite"); ?>:</span>
    <span class="gdwft-preview-usage-example">
        font-family: "<span class="gdwft-preview-usage-example-name"></span>";<br/>
        font-weight: <span class="gdwft-preview-usage-example-weight"></span>;<br/>
        font-style: <span class="gdwft-preview-usage-example-style"></span>;
    </span>
</div>