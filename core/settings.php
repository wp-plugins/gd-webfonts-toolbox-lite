<?php

if (!defined('ABSPATH')) exit;

class gdwft_core_settings {
    public $info;
    public $current = array();
    public $settings = array(
        'core' => array(
            'activated' => 0,
            'trigger_scanner' => false
        ),
        'rules' => array(
            'id' => 1, 
            'list' => array(), 
            'order' => array()
        ),
        'fonts' => array(
            'include' => array(), 
            'scanned' => array(),
            'last_check_google' => 0,
            'last_check_adobe' => 0
        ),
        'settings' => array(
            'upgrade_to_pro_100' => 1,
            'cache_styles_active' => true,
            'cache_styles_days' => 7,
            'important_font' => true,
            'important_settings' => true,
            'google_active' => true,
            'google_subsets' => array('latin', 'latin-ext'),
            'google_webfont_loader' => true,
            'adobe_active' => true,
            'adobe_subsets' => array('default')
        )
    );

    public function __construct() {
        $this->info = new gdwft_core_info();

        add_action('gdwft_plugin_core_ready', array(&$this, 'init'));
        add_filter('gdwft_settings_get', array(&$this, 'override_get'), 10, 3);
    }

    public function __get($name) {
        $get = explode('_', $name, 2);

        return $this->get($get[1], $get[0]);
    }
    
    private function _name($name) {
        return 'dev4press_'.$this->info->code.'_'.$name;
    }

    private function _install() {
        $this->current = $this->_merge();

        $this->current['info'] = $this->info->to_array();
        $this->current['info']['install'] = true;
        $this->current['info']['update'] = false;

        $this->current['core']['activated'] = time();

        foreach ($this->current as $key => $data) {
            update_option($this->_name($key), $data);
        }
    }

    private function _update() {
        $old_build = $this->current['info']['build'];

        $this->current['info'] = $this->info->to_array();
        $this->current['info']['install'] = false;
        $this->current['info']['update'] = true;
        $this->current['info']['previous'] = $old_build;

        update_option($this->_name('info'), $this->current['info']);

        $settings = $this->_merge();

        if ($this->current['core']['activated'] == 0) {
            $this->current['core']['activated'] = time();

            update_option($this->_name('core'), $this->current['core']);
        }

        foreach ($settings as $key => $data) {
            $now = get_option($this->_name($key));

            if (!is_array($now)) {
                $now = $data;
            } else {
                $now = $this->_upgrade($now, $data);
            }

            $this->current[$key] = $now;

            update_option($this->_name($key), $now);
        }

        delete_transient('webfonts-toolbox-styles');
    }

    private function _upgrade($old, $new) {
        foreach ($new as $key => $value) {
            if (!isset($old[$key])) {
                $old[$key] = $value;
            }
        }

        $unset = array();
        foreach ($old as $key => $value) {
            if (!isset($new[$key])) {
                $unset[] = $key;
            }
        }

        if (!empty($unset)) {
            foreach ($unset as $key) {
                unset($old[$key]);
            }
        }

        return $old;
    }

    private function _groups() {
        return array_keys($this->settings);
    }

    private function _merge() {
        $merged = array();

        foreach ($this->settings as $key => $data) {
            $merged[$key] = array();

            foreach ($data as $name => $value) {
                $merged[$key][$name] = $value;
            }
        }

        return $merged;
    }

    public function init() {
        $this->current['info'] = get_option($this->_name('info'));
        $this->current['core'] = get_option($this->_name('core'));

        $installed = is_array($this->current['info']) && isset($this->current['info']['build']);

        if (!$installed) {
            $this->_install();
        } else {
            $update = $this->current['info']['build'] != $this->info->build;

            if ($update) {
                $this->_update();
            } else {
                $groups = $this->_groups();

                foreach ($groups as $key) {
                    $this->current[$key] = get_option($this->_name($key));

                    if (!is_array($this->current[$key])) {
                        $data = $this->group($key);

                        if (!is_null($data)) {
                            $this->current[$key] = $data;

                            update_option($this->_name($key), $data);
                        }
                    }
                }
            }
        }

        do_action('gdwft_plugin_settings_loaded');
    }

    public function group($group) {
        if (isset($this->settings[$group])) {
            return $this->settings[$group];
        } else {
            return null;
        }
    }

    public function exists($name, $group = 'settings') {
        if (isset($this->current[$group][$name])) {
            return true;
        } else if (isset($this->settings[$group][$name])) {
            return true;
        } else {
            return false;
        }
    }

    public function prefix_get($prefix, $group = 'settings') {
        $settings = array_keys($this->group($group));

        $results = array();

        foreach ($settings as $key) {
            if (substr($key, 0, strlen($prefix)) == $prefix) {
                $results[substr($key, strlen($prefix))] = $this->get($key, $group);
            }
        }

        return $results;
    }

    public function group_get($group) {
        return $this->current[$group];
    }

    public function get($name, $group = 'settings') {
        $exit = null;

        if (isset($this->current[$group][$name])) {
            $exit = $this->current[$group][$name];
        } else if (isset($this->settings[$group][$name])) {
            $exit = $this->settings[$group][$name];
        }

        return apply_filters('gdwft_settings_get', $exit, $name, $group);
    }

    public function set($name, $value, $group = 'settings', $save = false) {
        $this->current[$group][$name] = $value;

        if ($save) {
            $this->save($group);
        }
    }

    public function save($group = 'settings') {
        update_option($this->_name($group), $this->current[$group]);
    }

    public function is_install() {
        return $this->get('install', 'info');
    }

    public function is_update() {
        return $this->get('update', 'info');
    }

    public function override_get($value, $name, $group) {
        return $value;
    }

    public function remove_plugin_settings() {
        foreach ($this->_groups() as $group) {
            delete_option($this->_name($group));
        }
    }

    public function remove_plugin_settings_by_name($name) {
        delete_option($this->_name($name));
    }

    public function import_from_object($import, $list = array()) {
        if (empty($list)) {
            $list = $this->_groups();
        }

        foreach ($import as $key => $data) {
            if (in_array($key, $list)) {
                $this->current[$key] = (array)$data;

                $this->save($key);
            }
        }
    }

    public function serialized_export($list = array()) {
        if (empty($list)) {
            $list = $this->_groups();
        }

        $data = new stdClass();
        $data->info = $this->current['info'];

        foreach ($list as $name) {
            $data->$name = $this->current[$name];
        }

        return serialize($data);
    }

    public function is_included_already($include) {
        foreach ($this->current['fonts']['include'] as $inc) {
            if ($inc['provider'] == $include['provider'] && $inc['name'] == $include['name']) {
                return true;
            }
        }

        return false;
    }

    public function include_font($include) {
        $this->current['fonts']['include'][] = $include;

        gdwft_clear_transient_cache();
    }

    public function include_font_editor($provider, $font, $editor = true) {
        foreach ($this->current['fonts']['include'] as &$obj) {
            if ($obj['provider'] == $provider && $obj['name'] == $font) {
                $obj['editor'] = $editor;
                break;
            }
        }

        gdwft_clear_transient_cache();
    }

    public function include_font_removal($provider, $font) {
        foreach ($this->current['fonts']['include'] as $id => $obj) {
            if ($obj['provider'] == $provider && $obj['name'] == $font) {
                unset($this->current['fonts']['include'][$id]);

                $this->current['fonts']['include'] = array_values($this->current['fonts']['include']);
                break;
            }
        }

        gdwft_clear_transient_cache();
    }

    public function get_scanned_fontface($name) {
        if (isset($this->current['fonts']['scanned'][$name])) {
            return $this->current['fonts']['scanned'][$name];
        }
    }

    public function get_rule($id) {
        if (isset($this->current['rules']['list'][$id])) {
            return $this->current['rules']['list'][$id];
        } else {
            return new WP_Error('rule_missing', __("Rule with provided ID is missing.", "gd-webfonts-toolbox-lite"));
        }
    }

    public function style_file($force_recreate = false) {
        $editor_styles = false;

        foreach ($this->current['rules']['list'] as $rule) {
            if ($rule['active'] && $rule['type'] == 'editor') {
                $editor_styles = true;
                break;
            }
        }

        if ($editor_styles) {
            $upload = wp_upload_dir();

            if (!defined('GDWFT_STYLE_FILE_URL')) {
                define('GDWFT_STYLE_FILE_PATH', $upload['basedir'].'/gdwft/editor_styles.css');
                define('GDWFT_STYLE_FILE_URL', $upload['baseurl'].'/gdwft/editor_styles.css');
            }

            if ($force_recreate || !file_exists(GDWFT_STYLE_FILE_PATH)) {
                wp_mkdir_p($upload['basedir'].'/gdwft');

                $content_styles = '';

                foreach ($this->current['rules']['list'] as $r) {
                    if ($r['active'] && $r['type'] == 'editor') {
                        $rule = new gdwft_selector();
                        $rule->from_array($r);
                        $styles = $rule->build(false);

                        $content_styles.= '/* '.$rule->label.' */'.D4P_EOL;
                        foreach ($styles as $style) {
                            $content_styles.= $style['selector'].'{'.D4P_EOL;
                            $content_styles.= D4P_TAB.$style['properties'].D4P_EOL;
                            $content_styles.= '}'.D4P_EOL.D4P_EOL;
                        }
                    }
                }

                file_put_contents(GDWFT_STYLE_FILE_PATH, $content_styles);
            }
        }
    }

    public function save_rules() {
        foreach (array_keys($this->current['rules']['list']) as $id) {
            if (!in_array($id, $this->current['rules']['order'])) {
                $this->current['rules']['order'][] = $id;
            }
        }

        $this->save('rules');
        $this->style_file(true);

        gdwft_clear_transient_cache();
    }

    public function activity_rule($id, $active = true) {
        if (isset($this->current['rules']['list'][$id])) {
            $this->current['rules']['list'][$id]['active'] = $active;

            $this->save_rules();
        }
    }

    public function delete_rule($id) {
        if (isset($this->current['rules']['list'][$id])) {
            unset($this->current['rules']['list'][$id]);

            $key = array_search($id, $this->current['rules']['order']);
            if (false !== $key) {
                unset($this->current['rules']['order'][$key]);

                $this->current['rules']['order'] = array_values($this->current['rules']['order']);
            }

            $this->save_rules();
        }
    }

    public function copy_rule($id) {
        if (isset($this->current['rules']['list'][$id])) {
            $rule = $this->current['rules']['list'][$id];
            $rule['id'] = $this->get('id', 'rules');

            $this->current['rules']['id'] = $rule['id'] + 1;
            $this->current['rules']['list'][$rule['id']] = $rule;
            $this->current['rules']['order'][] = $rule['id'];

            $this->save_rules();
        }
    }

    public function change_rules_order($order) {
        $this->current['rules']['order'] = $order;

        $this->save_rules();
    }
    
    public function edit_rule_style($args) {
        $id = $args['id'];

        if (isset($this->current['rules']['list'][$id])) {
            require_once(GDWFT_PATH.'core/rule.php');

            $_rule = new gdwft_rule();
            $rule = $_rule->parse($args, $this->current['rules']['list'][$id]);

            $this->current['rules']['list'][$id] = $rule;

            $this->save_rules();
        }
    }

    public function edit_rule_selector($args) {
        $id = $args['id'];

        if (isset($this->current['rules']['list'][$id])) {
            $rule = $this->current['rules']['list'][$id];
            $type = $rule['type'];

            $rule['label'] = $args['label'];
            if ($type == "editor") {
                $rule['selector'] = '.'.$args['class'];
                $rule['args'] = array(
                    'method' => $args['method'],
                    'value' => $args['editor'][$args['method']]
                );
            } else {
                $rule['selector'] = $args['selector'];
            }

            $this->current['rules']['list'][$id] = $rule;

            $this->save_rules();
        }
    }

    public function reset_rule($id) {
        if (isset($this->current['rules']['list'][$id])) {
            $raw = $this->current['rules']['list'][$id];

            $rule = new gdwft_selector();
            $rule->from_array($raw);
            $rule->reset_rule();

            $this->current['rules']['list'][$id] = $rule->to_array();

            $this->save_rules();
        }
    }

    public function add_rule($args) {
        $defaults = array('copy' => 0, 'type' => '', 'rule' => '', 'label' => '', 'selector' => '', 'args' => array());
        $args = wp_parse_args($args, $defaults);

        $default = array();

        $rule = new gdwft_selector();
        $rule->type = $args['type'];
        $rule->args = $args['args'];

        switch ($args['type']) {
            case 'default':
            case 'themes':
            case 'plugins':
                $data = gdwft_plugin()->selectors->get($args['type'], $args['rule']);

                $rule->code = $data['code'];
                $rule->label = $data['label'];
                $rule->source = $data['source'];
                $rule->selector = $data['selector'];

                $default = isset($data['font']) && is_array($data['font']) && count($data['font']) > 1 && $data['font'][1] != '' ? $data['font'] : array();
                break;
            case 'editor':
            case 'custom':
                $rule->label = $args['label'];
                $rule->source = $args['type'];
                $rule->selector = $args['selector'];
                break;
        }

        $rule->id = $this->get('id', 'rules');
        $rule->create_code();

        if (!empty($default)) {
            $rule->default_font($default);
        }

        if ($args['copy'] > 0) {
            $to_copy = $this->get_rule($args['copy']);

            if (!is_wp_error($to_copy)) {
                foreach (array('activity', 'font', 'settings', 'box', 'shadows', 'box_shadows', 'custom') as $key) {
                    $rule->$key = $to_copy[$key];
                }
            }
        }

        $this->current['rules']['id'] = $rule->id + 1;
        $this->current['rules']['list'][$rule->id] = $rule->to_array();
        $this->current['rules']['order'][] = $rule->id;

        $this->save_rules();

        return $rule;
    }
}

?>