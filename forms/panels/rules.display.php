<?php

function gdwft_draw_rule_row($id, $rule) {
    $render = '<tr id="gdwft-row-rule-'.$id.'" class="gdwft-rule gdwft-rule-type-'.$rule->type.' gdwft-rule-'.$id.' gdwft-rule-is-'.($rule->active ? 'active' : 'inactive').'" gdwft-rule="'.$id.'">';
        $render.= '<td class="gdwft-rules-dragdrop"><i class="fa fa-bars"></i></td>';
        $render.= '<td class="gdwft-rules-movicons">';
        $render.= '<i class="gdwft-move-rule-top fa fa-step-backward fa-rotate-90"></i><i class="gdwft-move-rule-up fa fa-caret-up"></i>';
        $render.= '<i class="gdwft-move-rule-down fa fa-caret-down"></i><i class="gdwft-move-rule-bottom fa fa-step-backward fa-rotate-270"></i>';
        $render.= '</td>';
        $render.= '<td>';
            $render.= '<span class="gdwft-rule-label">'.$rule->label.'</span>';
            $render.= '<span class="gdwft-rule-source">'.$rule->display_source().'</span>';
            $render.= '<div class="gdwft-row-controls row-actions">';
                $render.= '<a class="gdwft-rule-edit" href="#'.$id.'">'.__("Edit", "gd-webfonts-toolbox-lite").'</a> | ';
                $render.= '<a href="admin.php?page=gd-webfonts-toolbox-rules&action=copy-rule&_nonce='.wp_create_nonce('gdwft-action-nonce').'&rule='.$id.'">'.__("Copy", "gd-webfonts-toolbox-lite").'</a> | ';

                if ($rule->active) {
                    $render.= '<a href="admin.php?page=gd-webfonts-toolbox-rules&action=disable-rule&_nonce='.wp_create_nonce('gdwft-action-nonce').'&rule='.$id.'">'.__("Disable", "gd-webfonts-toolbox-lite").'</a> | ';
                } else {
                    $render.= '<a href="admin.php?page=gd-webfonts-toolbox-rules&action=enable-rule&_nonce='.wp_create_nonce('gdwft-action-nonce').'&rule='.$id.'">'.__("Enable", "gd-webfonts-toolbox-lite").'</a> | ';
                }

                $render.= '<a class="gdwft-rule-delete" href="admin.php?page=gd-webfonts-toolbox-rules&action=delete-rule&_nonce='.wp_create_nonce('gdwft-action-nonce').'&rule='.$id.'">'.__("Delete", "gd-webfonts-toolbox-lite").'</a>';
            $render.= '</div>';
        $render.= '</td>';
        $render.= '<td class="gdwft-rule-td-settings">';
            $render.= '<span class="gdwft-rule-selector">'.$rule->selector.'</span>';
            $render.= '<div class="row-actions">';
                $render.= '<a class="gdwft-rule-settings-edit" href="#'.$id.'">'.__("Style", "gd-webfonts-toolbox-lite").'</a> | ';
                $render.= '<a class="gdwft-rule-preview" href="#'.$id.'">'.__("Preview", "gd-webfonts-toolbox-lite").'</a> | ';
                $render.= '<a class="gdwft-rule-css" href="#'.$id.'">'.__("CSS", "gd-webfonts-toolbox-lite").'</a> | ';
                $render.= '<a class="gdwft-rule-reset" href="admin.php?page=gd-webfonts-toolbox-rules&action=reset-rule&_nonce='.wp_create_nonce('gdwft-action-nonce').'&rule='.$id.'">'.__("Reset", "gd-webfonts-toolbox-lite").'</a>';
            $render.= '</div>';
        $render.= '</td>';
        $render.= '<td class="gdwft-rule-td-settings">';
            $render.= $rule->display_font();
        $render.= '</td>';
        $render.= '<td class="gdwft-rule-td-controls">';
            $render.= $rule->display_rule();
        $render.= '</td>';
    $render.= '</tr>';

    return $render;
}

if (count($rules['list']) > 1) {

?>
<div class="gdwft-grid-controls">
    <a class="gdwft-grid-ctrl-dragdrop" href="#"><i class="fa fa-bars fa-fw"></i> <?php _e("Drag'n'Drop Reorder", "gd-webfonts-toolbox-lite"); ?></a>
    <a class="gdwft-grid-ctrl-movicons" href="#"><i class="fa fa-arrows-v fa-fw"></i> <?php _e("Arrows Reorder", "gd-webfonts-toolbox-lite"); ?></a>
</div>
<?php

}

?>
<table class="widefat gdwft-rules-grid">
    <thead>
        <tr>
            <th class="gdwft-rules-dragdrop" style="width: 46px;">&nbsp;</th>
            <th class="gdwft-rules-movicons" style="width: 36px;">&nbsp;</th>
            <th style="min-width: 200px;"><?php _e("Selector", "gd-webfonts-toolbox-lite"); ?></th>
            <th style="min-width: 200px;">&nbsp;</th>
            <th style="min-width: 120px;"><?php _e("Font", "gd-webfonts-toolbox-lite"); ?></th>
            <th style="width: 210px;"><?php _e("Active Styles", "gd-webfonts-toolbox-lite"); ?></th>
        </tr>
    </thead>
    <tbody>
        <?php

        if (empty($rules['list'])) {
            echo '<tr id="gdwft-empty-row"><td colspan="5">';
            _e("There are no rules created yet.", "gd-webfonts-toolbox-lite");
            echo '<br/>';
            _e("Use controls on the left to add new rules.", "gd-webfonts-toolbox-lite");
            echo '</td></tr>';
        } else {
            foreach ($rules['order'] as $id) {
                $rule = new gdwft_selector();
                $rule->from_array($rules['list'][$id]);

                echo gdwft_draw_rule_row($id, $rule);

                if ($rule->font['type'] == 'google') {
                    if (gdwft_font_exists('google', $rule->font['value'])) {
                        $load_fonts['google'][] = $rule->font['value'];
                    }
                }

                if ($rule->font['type'] == 'adobe') {
                    if (gdwft_font_exists('adobe', $rule->font['value'])) {
                        $load_fonts['adobe'][] = $rule->font['value'];
                    }
                }

                if ($rule->font['type'] == 'typekit') {
                    if (gdwft_font_exists('typekit', $rule->font['value'])) {
                        $load_fonts['typekit'][] = $rule->font['value'];
                    }
                }

                if ($rule->font['type'] == 'fontface') {
                    if (gdwft_font_exists('fontface', $rule->font['value'])) {
                        $load_fonts['fontface'][] = $rule->font['value'];
                    }
                }
            }
        }

        ?>
    </tbody>
</table>