<?php

if (!defined('ABSPATH')) exit;

function gdwft_font_exists($provider, $name) {
    return gdwft_plugin()->is_font_valid($provider, $name);
}

function gdwft_get_font($provider, $name) {
    if (gdwft_plugin()->is_provider_active($provider)) {
        switch ($provider) {
            case 'google':
                return new gdwft_google_font($name);
            case 'adobe':
                return new gdwft_adobe_font($name);
        }
    } else {
        return null;
    }
}

function gdwft_get_provider($provider = 'google') {
    if (gdwft_plugin()->is_provider_active($provider)) {
        return gdwft_plugin()->providers[$provider];
    } else {
        return null;
    }
}

function gdwft_get_fonts_list($provider = 'google', $return = 'full') {
    if (gdwft_plugin()->is_provider_active($provider)) {
        $list = gdwft_plugin()->providers[$provider]->fonts_list();

        if ($return == 'full') {
            return $list;
        } else if ($return == 'names') {
            return array_keys($list);
        } else if ($return == 'dropdown') {
            return wp_list_pluck($list, 'family');
        }
    } else {
        return array();
    }
}

function gdwft_get_fonts_for_dropdown($provider = 'google') {
    return gdwft_get_fonts_list($provider, 'dropdown');
}

/**
 * Get count of available fonts from selected provider.
 * 
 * @param string $provider code for the supported provider
 * @return int number of fonts
 */
function gdwft_get_fonts_list_count($provider = 'google') {
    if (gdwft_plugin()->is_provider_active($provider)) {
        return gdwft_plugin()->providers[$provider]->fonts_count();
    } else {
        return 0;
    }
}

function gdwft_hex_to_rgba($hex, $opacity = 1) {
   $hex = str_replace('#', '', $hex);

   if (strlen($hex) == 3) {
      $r = hexdec(substr($hex,0,1).substr($hex,0,1));
      $g = hexdec(substr($hex,1,1).substr($hex,1,1));
      $b = hexdec(substr($hex,2,1).substr($hex,2,1));
   } else {
      $r = hexdec(substr($hex,0,2));
      $g = hexdec(substr($hex,2,2));
      $b = hexdec(substr($hex,4,2));
   }

   $rgb = array($r, $g, $b);

   if ($opacity < 1) {
       $rgb[] = $opacity;
   }

   return 'rgba('.join(', ', $rgb).')';
}

/**
 * Register new selector for the theme.
 * 
 * @param string $code selector code, lowercase, no spaces or special characters
 * @param string $label display name for identification od the selector
 * @param string $selector CSS selector to apply styling to
 * @param string $theme folder name for the theme
 * @param array $font default font for the selector, needs two values: provider
 *                    and font name: array('google', 'Open Sans'). It can have
 *                    third value for generic font name.
 */
function gdwft_register_theme_selector($code, $label, $selector, $theme = '', $font = array()) {
    if (!is_array($font) || count($font) < 2 || $font[1] == '') {
        $font = array();
    }

    gdwft_plugin()->selectors->themes[$code] = array('type' => 'themes', 'code' => $code, 'label' => $label, 'selector' => $selector, 'source' => $theme, 'font' => $font);
}

/**
 * Register new selector for the plugin.
 * 
 * @param string $code selector code, lowercase, no spaces or special characters
 * @param string $label display name for identification od the selector
 * @param string $selector CSS selector to apply styling to
 * @param string $plugin folder name for the plugin
 * @param string $font default font for the selector
 */
function gdwft_register_plugin_selector($code, $label, $selector, $plugin = '', $font = array()) {
    if (!is_array($font) || count($font) < 2 || $font[1] == '') {
        $font = array();
    }

    gdwft_plugin()->selectors->plugins[$code] = array('type' => 'plugins', 'code' => $code, 'label' => $label, 'selector' => $selector, 'source' => $plugin, 'font' => $font);
}

/**
 * Register new default/standard font stack.
 * 
 * @param string $code stack code, lowercase, no spaces or special characters
 * @param string $generic generic font type: sans-serif, serif, monospace, fantasy, coursive
 * @param string $fonts fonts list formated for use in font-family
 */
function gdwft_register_font_stack($code, $generic, $fonts) {
    gdwft_plugin()->stacks->default[$generic]['values'][$code] = $fonts;
}

/**
 * Add extra font for loading.
 * 
 * @param string $provider font provider: google or adobe
 * @param string $name font name
 * @param book $editor should the font be used in WP Editor
 */
function gdwft_register_font_to_load($provider, $name, $editor = true) {
    gdwft_plugin()->fonts[] = array('provider' => $provider, 'name' => $name, 'editor' => $editor);
}

/**
 * Delete cached fonts and styles for front end rendering.
 */
function gdwft_clear_transient_cache() {
    delete_transient('webfonts-toolbox-styles');
}

?>