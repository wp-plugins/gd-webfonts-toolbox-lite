<?php if (GDWFT_WPV < 39) { ?>
<script type="text/javascript">
    tinyMCEPopup = 0;
</script>    
<?php }

$pages = gdwft_admin()->menu_items;
$_page = gdwft_admin()->page;
$_panel = gdwft_admin()->panel;

if (!empty($panels) && $_panel === false) {
    $_panel = 'index';
}

$_classes = array('d4p-wrap', 'wpv-'.GDWFT_WPV, 'd4p-page-'.$_page);

if (GDWFT_WPV < 39) {
    $_classes[] = 'wpv-pre-39';
}

if ($_panel !== false) {
    $_classes[] = 'd4p-panel';
    $_classes[] = 'd4p-panel-'.$_panel;
}

$_message = '';

if (isset($_GET['message']) && $_GET['message'] != '') {
    switch ($_GET['message']) {
        case 'rule-updated':
            $_message = __("Rule is updated.", "gd-webfonts-toolbox-lite");
            break;
        case 'rule-added':
            $_message = __("New rule added.", "gd-webfonts-toolbox-lite");
            break;
        case 'rule-reseted':
            $_message = __("Rule reset completed.", "gd-webfonts-toolbox-lite");
            break;
        case 'rule-disabled':
            $_message = __("Rule is now disabled.", "gd-webfonts-toolbox-lite");
            break;
        case 'rule-enabled':
            $_message = __("Rule is now enabled.", "gd-webfonts-toolbox-lite");
            break;
        case 'rule-deleted':
            $_message = __("Rule is now deleted.", "gd-webfonts-toolbox-lite");
            break;
        case 'typekit-reload':
            $_message = __("TypeKit kits data is reloaded.", "gd-webfonts-toolbox-lite");
            break;
        case 'remove-font':
            $_message = __("Font removed from include list.", "gd-webfonts-toolbox-lite");
            break;
        case 'font-updated':
            $_message = __("Included font editor status updated.", "gd-webfonts-toolbox-lite");
            break;
        case 'font-included':
            $_message = __("Font added to include list.", "gd-webfonts-toolbox-lite");
            break;
        case 'font-already-included':
            $_message = __("Font is already on include list.", "gd-webfonts-toolbox-lite");
            break;
        case 'upload-failed':
            $_message = __("File upload failed.", "gd-webfonts-toolbox-lite");
            break;
        case 'upload-done':
            $_message = __("File upload is uploaded and unpacked.", "gd-webfonts-toolbox-lite");
            break;
        case 'upload-error':
            $_message = __("File upload failed.", "gd-webfonts-toolbox-lite").' '.urldecode($_GET['error']);
            break;
        case 'scan-done':
            $_message = __("Fonts directory scan completed.", "gd-webfonts-toolbox-lite");
            break;
        case 'saved':
            $_message = __("Settings are saved.", "gd-webfonts-toolbox-lite");
            break;
        case 'removed':
            $_message = __("Removal operation completed.", "gd-webfonts-toolbox-lite");
            break;
        case 'cleared':
            $_message = __("All cache is cleared.", "gd-webfonts-toolbox-lite");
            break;
        case 'nothing-removed':
            $_message = __("Nothing was selected for removal.", "gd-webfonts-toolbox-lite");
            break;
        case 'imported':
            $_message = __("Import operation completed.", "gd-webfonts-toolbox-lite");
            break;
        case 'nothing':
            $_message = __("Nothing done.", "gd-webfonts-toolbox-lite");
            break;
    }
}

?>
<div class="<?php echo join(' ', $_classes); ?>">
    <div class="d4p-header">
        <div class="d4p-navigator">
            <ul>
                <li class="d4p-nav-button">
                    <a href="#"><i class="fa fa-<?php echo $pages[$_page]['icon']; ?>"></i> <?php echo $pages[$_page]['title']; ?></a>
                    <ul>
                        <?php

                        foreach ($pages as $page => $obj) {
                            if ($page != $_page) {
                                echo '<li><a href="admin.php?page=gd-webfonts-toolbox-'.$page.'"><i class="'.(d4p_icon_class($obj['icon'], 'fw')).'"></i> '.$obj['title'].'</a></li>';
                            } else {
                                echo '<li class="d4p-nav-current"><i class="'.(d4p_icon_class($obj['icon'], 'fw')).'"></i> '.$obj['title'].'</li>';
                            }
                        }

                        ?>
                    </ul>
                </li>
                <?php if (!empty($panels)) { ?>
                <li class="d4p-nav-button">
                    <a href="#"><i class="<?php echo d4p_icon_class($panels[$_panel]['icon']); ?>"></i> <?php echo $panels[$_panel]['title']; ?></a>
                    <ul>
                        <?php

                        foreach ($panels as $panel => $obj) {
                            if ($panel != $_panel) {
                                echo '<li><a href="admin.php?page=gd-webfonts-toolbox-'.$_page.'&panel='.$panel.'"><i class="'.(d4p_icon_class($obj['icon'], 'fw')).'"></i> '.$obj['title'].'</a></li>';
                            } else {
                                echo '<li class="d4p-nav-current"><i class="'.(d4p_icon_class($obj['icon'], 'fw')).'"></i> '.$obj['title'].'</li>';
                            }
                        }

                        ?>
                    </ul>
                </li>
                <?php } ?>
            </ul>
        </div>
        <div class="d4p-plugin">
            GD WebFonts Toolbox
        </div>
    </div>
    <?php

    if ($_message != '') {
        echo '<div class="updated">'.$_message.'</div>';
    }

    ?>
    <div class="d4p-content">
