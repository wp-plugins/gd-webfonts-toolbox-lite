<input type="hidden" value="<?php echo admin_url('admin.php?page=gd-webfonts-toolbox-tools&run=export&_ajax_nonce='.wp_create_nonce('dev4press-plugin-export')); ?>" id="gdwfttools-export-url" />

<div class="d4p-group d4p-group-export d4p-group-important">
    <h3><?php _e("Important", "gd-webfonts-toolbox-lite"); ?></h3>
    <div class="d4p-group-inner">
        <?php _e("With this tool you export all plugin settings (including rules and fonts to include) into plain text file (PHP serialized content). Do not modify export file, any change you make can make it unusable.", "gd-webfonts-toolbox-lite"); ?><br/><br/>
    </div>
</div>
<script type="text/javascript">
jQuery(document).ready(function() {
    gdwft_editor.export();
});
</script>