<?php

if (!defined('ABSPATH')) exit;

class gdwft_admin_core {
    public $debug;

    public $page = false;
    public $panel = false;
    public $action = false;

    public $menu_items;

    function __construct() {
        add_action('gdwft_plugin_core_ready', array(&$this, 'core'));

        add_filter('plugin_action_links', array(&$this, 'plugin_actions'), 10, 2);
        add_filter('plugin_row_meta', array(&$this, 'plugin_links'), 10, 2);
    }

    public function plugin_actions($links, $file) {
        if ($file == 'gd-webfonts-toolbox-lite/gd-webfonts-toolbox-lite.php' ){
            $settings_link = '<a href="admin.php?page=gd-webfonts-toolbox-front">'.__("Plugin", "gd-webfonts-toolbox-lite").'</a>';
            array_unshift($links, $settings_link);
        }

        return $links;
    }

    function plugin_links($links, $file) {
        if ($file == 'gd-webfonts-toolbox-lite/gd-webfonts-toolbox-lite.php' ){
            $links[] = '<a target="_blank" style="color: #cc0000; font-weight: bold;" href="https://plugins.dev4press.com/gd-webfonts-toolbox/">'.__("Upgrade to GD WebFonts Toolbox Pro", "gd-webfonts-toolbox-lite").'</a>';
        }

        return $links;
    }

    function upgrade_notice() {
        if (gdwft_settings()->get('upgrade_to_pro_100') == 1 && !gdwft_settings()->is_install()) {
            $no_thanks = add_query_arg('proupgradewft', 'hide');

            echo '<div class="updated d4p-updated">';
                echo __("Thank you for using this plugin. Please, take a few minutes and check out the GD WebFonts Toolbox Pro plugin with many new and improved features.", "gd-webfonts-toolbox-lite");
                echo ' '.__("Buy GD WebFonts Toolbox Pro version or Dev4Press Plugins Pack and get 15% discount using this coupon", "gd-webfonts-toolbox-lite");
                echo ': <strong style="color: #c00;">GDWFTLITETOPRO</strong>.<br/>';
                echo '<strong><a href="https://plugins.dev4press.com/gd-webfonts-toolbox/" target="_blank">'.__("Plugin Official Page", "gd-webfonts-toolbox-lite")."</a></strong> | ";
                echo '<strong><a href="https://plugins.dev4press.com/plugins-pack/" target="_blank">'.__("Dev4Press Plugins Pack", "gd-webfonts-toolbox-lite")."</a></strong> | ";
                echo '<a href="'.$no_thanks.'">'.__("Don't display this message anymore", "gd-webfonts-toolbox-lite")."</a>.";
            echo '</div>';
        }
    }

    private function file($type, $name) {
        $get = GDWFT_URL;

        if ($name == 'admin' || $name == 'font' || $name == 'widgets') {
            $get.= 'd4plib/resources/';
        }

        if ($name == 'font') {
            $get.= 'font/styles.css';
        } else {
            $get.= $type.'/'.$name;

            if (!$this->debug && $type != 'font') {
                $get.= '.min';
            }

            $get.= '.'.$type;
        }

        return $get;
    }

    public function core() {
        $this->debug = defined('SCRIPT_DEBUG') && SCRIPT_DEBUG;

        $this->init();

        add_action('admin_init', array(&$this, 'admin_init'));
        add_action('admin_menu', array(&$this, 'admin_menu'));
        add_action('admin_enqueue_scripts', array(&$this, 'enqueue_scripts'));

        if (gdwft_settings()->is_install()) {
            add_action('admin_notices', array(&$this, 'install_notice'));
        }
    }

    public function install_notice() {
        if (current_user_can('install_plugins') && $this->page === false) {
            echo '<div class="updated"><p>';
            echo __("GD WebFonts Toolbox is activated and it needs to finish installation.", "gd-webfonts-toolbox-lite");
            echo ' <a href="admin.php?page=gd-webfonts-toolbox-front">'.__("Click Here", "gd-webfonts-toolbox-lite").'</a>.';
            echo '</p></div>';
        }
    }

    public function init() {
        $this->menu_items = array(
            'front' => array('title' => __("Overview", "gd-webfonts-toolbox-lite"), 'icon' => 'home'),
            'about' => array('title' => __("About", "gd-webfonts-toolbox-lite"), 'icon' => 'info-circle'),
            'rules' => array('title' => __("Selector Rules", "gd-webfonts-toolbox-lite"), 'icon' => 'italic'),
            'include' => array('title' => __("Fonts Include", "gd-webfonts-toolbox-lite"), 'icon' => 'edit'),
            'preview' => array('title' => __("Fonts Preview", "gd-webfonts-toolbox-lite"), 'icon' => 'search'),
            'settings' => array('title' => __("Settings", "gd-webfonts-toolbox-lite"), 'icon' => 'cogs'),
            'tools' => array('title' => __("Tools", "gd-webfonts-toolbox-lite"), 'icon' => 'wrench'),

            'typekit' => array('title' => __("TypeKit Kits (Pro)", "gd-webfonts-toolbox-lite"), 'icon' => 'font'),
            'editor' => array('title' => __("WP Integration (Pro)", "gd-webfonts-toolbox-lite"), 'icon' => 'wordpress'),
            'upload' => array('title' => __("Fonts Upload (Pro)", "gd-webfonts-toolbox-lite"), 'icon' => 'cloud')
        );
    }

    public function admin_init() {
        if (isset($_GET['panel']) && $_GET['panel'] != '') {
            $this->panel = trim(sanitize_key($_GET['panel']));
        }

        if (isset($_GET['proupgradewft']) && $_GET['proupgradewft'] == 'hide') {
            gdwft_settings()->set('upgrade_to_pro_100', 0);
            gdwft_settings()->save();

            wp_redirect(remove_query_arg('proupgradewft'));
            exit;
        }

        if (isset($_POST['option_page']) && $_POST['option_page'] == 'gd-webfonts-toolbox-uploader') {
            check_admin_referer('gd-webfonts-toolbox-uploader-options');

            $url = 'admin.php?page=gd-webfonts-toolbox-upload&panel=upload';

            $file = $this->process_file_array('gdwftupload', 'uploader', 'package');

            if (is_uploaded_file($file['tmp_name'])) {
                $name = $file['name'];
                $temp = $file['tmp_name'];

                $fle = pathinfo($name, PATHINFO_FILENAME);

                $directory = sanitize_file_name($_POST['gdwftupload']['uploader']['directory']);

                if ($directory == '') {
                    $directory = sanitize_file_name($fle);
                }

                $path = gdwft_upload_dir().$directory;
                WP_Filesystem();

                $result = unzip_file($temp, $path);

                if (is_wp_error($result)) {
                    $url.= '&message=upload-error&error='.urlencode($result->get_error_message());
                } else {
                    $url.= '&message=upload-done';

                    gdwft_settings()->set('trigger_scanner', true, 'core');
                    gdwft_settings()->save('core');
                }
            } else {
                $url.= '&message=upload-failed';
            }

            wp_redirect($url);
            exit;
        }

        if (isset($_POST['option_page']) && $_POST['option_page'] == 'gd-webfonts-toolbox-tools') {
            check_admin_referer('gd-webfonts-toolbox-tools-options');

            $post = $_POST['gdwfttools'];
            $action = $post['panel'];

            $url = 'admin.php?page=gd-webfonts-toolbox-tools&panel='.$action;

            if ($action == 'import') {
                if (is_uploaded_file($_FILES['import_file']['tmp_name'])) {
                    $raw = file_get_contents($_FILES['import_file']['tmp_name']);
                    $data = maybe_unserialize($raw);

                    if (is_object($data)) {
                        gdwft_settings()->import_from_object($data);

                        $message = 'imported';
                    }
                }
            } else if ($action == 'cache') {
                if (isset($post['cache']['clear']) && $post['cache']['clear'] == 'on') {
                    delete_transient('webfonts-toolbox-typekit');
                    delete_transient('webfonts-toolbox-google');
                    delete_transient('webfonts-toolbox-styles');

                    $message = 'cleared';
                }
            } else if ($action == 'remove') {
                $remove = isset($post['remove']) ? (array)$post['remove'] : array();

                if (empty($remove)) {
                    $message = 'nothing-removed';
                } else {
                    foreach ($remove as $key => $value) {
                        if ($value == "on") {
                            gdwft_settings()->remove_plugin_settings_by_name($key);
                        }
                    }

                    gdwft_settings()->set('trigger_scanner', true, 'core');
                    gdwft_settings()->save('core');

                    $message = 'removed';
                }
            }

            wp_redirect($url.'&message='.$message);
            exit;
        }

        if (isset($_POST['option_page']) && $_POST['option_page'] == 'gd-webfonts-toolbox-include') {
            check_admin_referer('gd-webfonts-toolbox-include-options');

            $url = 'admin.php?page=gd-webfonts-toolbox-include';

            $provider = $_POST['provider'];

            if (gdwft_plugin()->is_provider_valid($provider)) {
                $font = isset($_POST[$provider]) ? $_POST[$provider] : '';

                if ($font != '' && gdwft_plugin()->is_font_valid($provider, $font)) {
                    $include = array('provider' => $provider, 'name' => $font, 'editor' => $provider != 'adobe');

                    if (!gdwft_settings()->is_included_already($include)) {
                        gdwft_settings()->include_font($include);
                        gdwft_settings()->save('fonts');

                        $url.= '&message=font-included';
                    } else {
                        $url.= '&message=font-already-included';
                    }
                }
            }

            wp_redirect($url);
            exit;
        }

        if (isset($_POST['option_page']) && $_POST['option_page'] == 'gd-webfonts-toolbox-edit-selector') {
            check_admin_referer('gd-webfonts-toolbox-edit-selector-options');

            $url = 'admin.php?page=gd-webfonts-toolbox-rules';

            gdwft_settings()->edit_rule_selector($_POST['rule']);

            wp_redirect($url.'&message=rule-updated');
            exit;
        }

        if (isset($_POST['option_page']) && $_POST['option_page'] == 'gd-webfonts-toolbox-edit-style') {
            check_admin_referer('gd-webfonts-toolbox-edit-style-options');

            $url = 'admin.php?page=gd-webfonts-toolbox-rules';

            gdwft_settings()->edit_rule_style($_POST['editor']);

            wp_redirect($url.'&message=rule-updated');
            exit;
        }

        if (isset($_POST['option_page']) && $_POST['option_page'] == 'gd-webfonts-toolbox-newrule') {
            check_admin_referer('gd-webfonts-toolbox-newrule-options');

            $rule = $_POST['rule'];
            $type = $rule['type'];
            $copy = intval($rule['copy']);
            $args = array('copy' => $copy, 'type' => $type, 'args' => array());

            switch ($type) {
                case 'default':
                    $args['rule'] = $rule['default']['rule'];
                    break;
                case 'custom':
                    $args['label'] = $rule['custom']['label'];
                    $args['selector'] = $rule['custom']['selector'];
                    break;
                case 'editor':
                    $args['label'] = $rule['editor']['label'];
                    $args['selector'] = '.'.$rule['editor']['class'];

                    $args['args']['method'] = $rule['editor']['method'];
                    $args['args']['value'] = $rule['editor'][$rule['editor']['method']];
                    break;
                case 'themes':
                    $args['rule'] = $rule['themes']['rule'];
                    break;
                case 'plugins':
                    $args['rule'] = $rule['plugins']['rule'];
                    break;
            }

            gdwft_settings()->add_rule($args);

            $url = 'admin.php?page=gd-webfonts-toolbox-rules';

            wp_redirect($url.'&message=rule-added');
            exit;
        }

        if (isset($_POST['option_page']) && $_POST['option_page'] == 'gd-webfonts-toolbox-settings') {
            check_admin_referer('gd-webfonts-toolbox-settings-options');

            require_once(GDWFT_D4PLIB.'admin/d4p.functions.php');
            require_once(GDWFT_D4PLIB.'admin/d4p.settings.php');
            include(GDWFT_PATH.'core/internal.php');

            $options = new gdwft_admin_settings();
            $settings = $options->settings($this->panel);

            $processor = new d4pSettingsProcess($settings);
            $processor->base = 'gdwftvalue';

            $data = $processor->process();

            foreach ($data as $group => $values) {
                foreach ($values as $name => $value) {
                    gdwft_settings()->set($name, $value, $group);
                }

                gdwft_settings()->save($group);
            }

            $url = 'admin.php?page=gd-webfonts-toolbox-settings&panel='.$this->panel;

            wp_redirect($url.'&message=saved');
            exit;
        }
    }

    public function admin_menu() {
        $parent = 'gd-webfonts-toolbox-front';

        $icon = 'dashicons-editor-customchar';

        $this->page_ids[] = add_menu_page(
                        'GD WebFonts Toolbox Lite', 
                        'Fonts Toolbox', 
                        'activate_plugins', 
                        $parent, 
                        array(&$this, 'panel_front'), 
                        $icon);

        foreach($this->menu_items as $item => $data) {
            $this->page_ids[] = add_submenu_page($parent, 
                            'GD WebFonts Toolbox Lite: '.$data['title'], 
                            $data['title'], 
                            'activate_plugins', 
                            'gd-webfonts-toolbox-'.$item, 
                            array(&$this, 'panel_'.$item));
        }

        $this->admin_load_hooks();
    }

    public function enqueue_scripts($hook) {
        if ($this->page !== false) {
            wp_enqueue_script('jquery');
            wp_enqueue_script('wpdialogs');

            wp_enqueue_style('wp-color-picker');
            wp_enqueue_style('wp-jquery-ui-dialog');

            $depend_js = array('d4plib-admin', 'wpdialogs');
            $depend_css = array('d4plib-admin', 'wp-jquery-ui-dialog');

            if ($this->page == 'rules') {
                $depend_js[] = 'jquery-ui-sortable';

                wp_enqueue_script('jquery-ui-sortable');
            }

            if ($this->page == 'preview' || $this->page == 'rules') {
                $depend_js[] = 'gdwft-minicolors';
                $depend_css[] = 'gdwft-minicolors';

                wp_enqueue_script('gdwft-minicolors', GDWFT_URL.'libs/minicolors/jquery.minicolors.min.js', array('jquery'), gdwft_settings()->info_version, true);
                wp_enqueue_style('gdwft-minicolors', GDWFT_URL.'libs/minicolors/jquery.minicolors.css', array(), gdwft_settings()->info_version);
            }

            wp_enqueue_style('gdwft-fontawesome', GDWFT_URL.'css/fontawesome/css/font-awesome.min.css');

            wp_enqueue_style('d4plib-font', $this->file('css', 'font'), array(), gdwft_settings()->info_version);
            wp_enqueue_style('d4plib-admin', $this->file('css', 'admin'), array(), gdwft_settings()->info_version);
            wp_enqueue_style('gdwft-plugin', $this->file('css', 'plugin'), $depend_css, gdwft_settings()->info_version);

            wp_enqueue_script('d4plib-admin', $this->file('js', 'admin'), array('jquery', 'wp-color-picker'), gdwft_settings()->info_version, true);
            wp_enqueue_script('gdwft-plugin', $this->file('js', 'plugin'), $depend_js, gdwft_settings()->info_version, true);

            wp_localize_script('gdwft-plugin', 'gdwft_data', array(
                'nonce' => wp_create_nonce('gd-webfonts-toolbox'),
                'wp_version' => GDWFT_WPV,
                'url_prefix' => is_ssl() ? 'https://' : 'http://',
                'preview_text' => gdwft_plugin()->get('preview_text'),
                'dialog_title_please_wait' => __("Please Wait...", "gd-webfonts-toolbox-lite"),
                'dialog_title_areyousure' => __("Are you sure that you want to do this? Operation is not reversable.", "gd-webfonts-toolbox-lite"),
                'preview_in_include_list' => __("Font is in Include list.", "gd-webfonts-toolbox-lite"),
                'preview_not_in_include_list' => __("Font is not in Include list.", "gd-webfonts-toolbox-lite"),
                'important_font' => gdwft_settings()->get('important_font') ? ' !important' : '',
                'important_settings' => gdwft_settings()->get('important_settings') ? ' !important' : ''
            ));
        }
    }

    public function admin_load_hooks() {
        foreach ($this->page_ids as $id) {
            add_action('load-'.$id, array(&$this, 'load_admin_page'));
        }
    }

    public function load_admin_page() {
        $screen = get_current_screen();
        $id = $screen->id;

        if ($id == 'toplevel_page_gd-webfonts-toolbox-front') {
            $this->page = 'front';
        } else if (substr($id, 0, 39) == 'fonts-toolbox_page_gd-webfonts-toolbox-') {
            $this->page = substr($id, 39);
        }

        if ($this->page) {
            $this->process_actions();
        }
    }

    public function process_actions() {
        if ($this->page === 'tools' && isset($_GET['run']) && $_GET['run'] == 'export') {
            @ini_set('memory_limit', '128M');
            @set_time_limit(360);

            check_ajax_referer('dev4press-plugin-export');

            if (!d4p_is_current_user_admin()) {
                wp_die(__("Only administrators can use export features.", "gd-webfonts-toolbox-lite"));
            }

            $export_date = date('Y-m-d-H-m-s');

            header('Content-type: application/force-download');
            header('Content-Disposition: attachment; filename="gd_webfonts_toolbox_lite_settings_'.$export_date.'.set"');

            die(gdwft_settings()->serialized_export());
        }

        if (isset($_GET['action']) && $_GET['action'] != '') {
            if (wp_verify_nonce($_GET['_nonce'], 'gdwft-action-nonce')) {
                switch ($_GET['action']) {
                    case 'scan-fonts':
                        gdwft_plugin()->fonts_scanner();

                        wp_redirect('admin.php?page=gd-webfonts-toolbox-upload&message=scan-done');
                        exit;
                    case 'reset-rule':
                        $id = intval($_GET['rule']);

                        gdwft_settings()->reset_rule($id);

                        wp_redirect('admin.php?page=gd-webfonts-toolbox-rules&message=rule-reseted');
                        exit;
                    case 'disable-rule':
                        $id = intval($_GET['rule']);

                        gdwft_settings()->activity_rule($id, false);

                        wp_redirect('admin.php?page=gd-webfonts-toolbox-rules&message=rule-disabled');
                        exit;
                    case 'enable-rule':
                        $id = intval($_GET['rule']);

                        gdwft_settings()->activity_rule($id, true);

                        wp_redirect('admin.php?page=gd-webfonts-toolbox-rules&message=rule-enabled');
                        exit;
                    case 'copy-rule':
                        $id = intval($_GET['rule']);

                        gdwft_settings()->copy_rule($id);

                        wp_redirect('admin.php?page=gd-webfonts-toolbox-rules&message=rule-added');
                        exit;
                    case 'delete-rule':
                        $id = intval($_GET['rule']);

                        gdwft_settings()->delete_rule($id);

                        wp_redirect('admin.php?page=gd-webfonts-toolbox-rules&message=rule-deleted');
                        exit;
                    case 'remove-font':
                        gdwft_settings()->include_font_removal($_GET['provider'], urldecode($_GET['font']));
                        gdwft_settings()->save('fonts');

                        wp_redirect('admin.php?page=gd-webfonts-toolbox-include&message=font-removed');
                        exit;
                    case 'font-editor-off':
                        gdwft_settings()->include_font_editor($_GET['provider'], urldecode($_GET['font']), false);
                        gdwft_settings()->save('fonts');

                        wp_redirect('admin.php?page=gd-webfonts-toolbox-include&message=font-updated');
                        exit;
                    case 'font-editor-on':
                        gdwft_settings()->include_font_editor($_GET['provider'], urldecode($_GET['font']), true);
                        gdwft_settings()->save('fonts');

                        wp_redirect('admin.php?page=gd-webfonts-toolbox-include&message=font-updated');
                        exit;
                }
            }
        }
    }

    public function install_or_update() {
        $this->upgrade_notice();

        $install = gdwft_settings()->is_install();
        $update = gdwft_settings()->is_update();

        if ($install) {
            include(GDWFT_PATH.'forms/install.php');
        } else if ($update) {
            include(GDWFT_PATH.'forms/update.php');
        }

        return $install || $update;
    }

    public function panel_front() {
        if (!$this->install_or_update()) {
            include(GDWFT_PATH.'forms/front.php');
        }
    }

    public function panel_about() {
        if (!$this->install_or_update()) {
            include(GDWFT_PATH.'forms/about.php');
        }
    }

    public function panel_rules() {
        if (!$this->install_or_update()) {
            include(GDWFT_PATH.'forms/rules.php');
        }
    }

    public function panel_include() {
        if (!$this->install_or_update()) {
            include(GDWFT_PATH.'forms/include.php');
        }
    }

    public function panel_preview() {
        if (!$this->install_or_update()) {
            include(GDWFT_PATH.'forms/preview.php');
        }
    }

    public function panel_typekit() {
        if (!$this->install_or_update()) {
            include(GDWFT_PATH.'forms/typekit.php');
        }
    }

    public function panel_editor() {
        if (!$this->install_or_update()) {
            include(GDWFT_PATH.'forms/editor.php');
        }
    }

    public function panel_upload() {
        if (!$this->install_or_update()) {
            include(GDWFT_PATH.'forms/upload.php');
        }
    }

    public function panel_settings() {
        if (!$this->install_or_update()) {
            include(GDWFT_PATH.'forms/settings.php');
        }
    }

    public function panel_tools() {
        if (!$this->install_or_update()) {
            include(GDWFT_PATH.'forms/tools.php');
        }
    }
}

global $_gdwft_core_admin;
$_gdwft_core_admin = new gdwft_admin_core();

function gdwft_admin() {
    global $_gdwft_core_admin;
    return $_gdwft_core_admin;
}

?>