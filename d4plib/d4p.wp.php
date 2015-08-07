<?php

/*
Name:    d4pLib_WP_Functions
Version: v1.4
Author:  Milan Petrovic
Email:   milan@gdragon.info
Website: https://www.dev4press.com/libs/d4plib/

== Copyright ==
Copyright 2008 - 2015 Milan Petrovic (email: milan@gdragon.info)

This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation; either version 2 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

if (!function_exists('wp_redirect_self')) {
    /**
     * Redirects back to the same page.
     */
    function wp_redirect_self() {
        wp_redirect($_SERVER['REQUEST_URI']);
    }
}

if (!function_exists('wp_flush_rewrite_rules')) {
    /**
     * Flush WordPress rewrite rules
     */
    function wp_flush_rewrite_rules() {
        global $wp_rewrite;

        $wp_rewrite->flush_rules();
    }
}

if (!function_exists('is_wpsignup_page')) {
    /**
     * Check if current page is wp-signup.php page.
     */
    function is_wpsignup_page() {
        global $pagenow;

        return $pagenow == 'wp-signup.php';
    }
}

if (!function_exists('is_posts_page')) {
    /**
     * Check if current page is posts page.
     */
    function is_posts_page() {
        global $wp_query;

        return $wp_query->is_posts_page;
    }
}

if (!function_exists('d4p_cache_flush')) {
    /**
     * Flush WordPress caching entities
     *
     * @param bool $cache wp objects cache
     * @param bool $queries wp db logged queries
     */
    function d4p_cache_flush($cache = true, $queries = true) {
        if ($cache) {
            wp_cache_flush();
        }

        if ($queries) {
            global $wpdb;

            if (is_array($wpdb->queries) && !empty($wpdb->queries)) {
                unset($wpdb->queries);
                $wpdb->queries = array();
            }
        }
    }
}

if (!function_exists('d4p_is_current_user_roles')) {
    /**
     * Checks to see if the currently logged user has one of given roles.
     *
     * @param array $roles list of roles
     * @return bool is user has any of given roles or not
     */
    function d4p_is_current_user_roles($roles = array()) {
        global $current_user;
        $roles = (array)$roles;

        if (is_array($current_user->roles) && !empty($roles)) {
            $match = array_intersect($roles, $current_user->roles);

            return !empty($match);
        } else {
            return false;
        }
    }
}

if (!function_exists('d4p_is_current_user_admin')) {
    /**
     * Checks to see if the currently logged user is admin.
     *
     * @return bool is user admin or not
     */
    function d4p_is_current_user_admin() {
        return d4p_is_current_user_roles('administrator');
    }
}

if (!function_exists('d4p_switch_to_default_theme')) {
    /**
     * Switch from current theme to default theme.
     */
    function d4p_switch_to_default_theme() {
        switch_theme(WP_DEFAULT_THEME, WP_DEFAULT_THEME);
    }
}

if (!function_exists('d4p_delete_user_transient')) {
    function d4p_delete_user_transient($user_id, $transient) {
        $transient_option = '_transient_'.$transient;
        $transient_timeout = '_transient_timeout_'.$transient;

        delete_user_meta($user_id, $transient_option);
        delete_user_meta($user_id, $transient_timeout);
    }
}

if (!function_exists('d4p_get_user_transient')) {
    function d4p_get_user_transient($user_id, $transient) {
        $transient_option = '_transient_'.$transient;
        $transient_timeout = '_transient_timeout_'.$transient;

        if (get_user_meta($user_id, $transient_timeout, true) < time()) {
            delete_user_meta($user_id, $transient_option);
            delete_user_meta($user_id, $transient_timeout);
            return false;
        }

        return get_user_meta($user_id, $transient_option, true);
    }
}

if (!function_exists('d4p_set_user_transient')) {
    function d4p_set_user_transient($user_id, $transient, $value, $expiration = 86400) {
        $transient_option = '_transient_'.$transient;
        $transient_timeout = '_transient_timeout_'.$transient;

        if (get_user_meta($user_id, $transient_option, true) != '') {
            delete_user_meta($user_id, $transient_option);
            delete_user_meta($user_id, $transient_timeout);
        }

        add_user_meta($user_id, $transient_timeout, time() + $expiration, true);
        add_user_meta($user_id, $transient_option, $value, true);
    }
}

if (!function_exists('d4p_get_post_excerpt')) {
    function d4p_get_post_excerpt($post, $word_limit = 50) {
        $content = $post->post_excerpt == '' ? $post->post_content : $post->post_excerpt;

        $content = strip_shortcodes($content);
        $content = str_replace(']]>', ']]&gt;', $content);
        $content = strip_tags($content);

        $words = explode(' ', $content, $word_limit + 1);

        if (count($words) > $word_limit) {
            array_pop($words);
            $content = implode(' ', $words);
            $content.= '...';
        }

        return $content;
    }
}

if (!function_exists('d4p_get_post_content')) {
    function d4p_get_post_content($post) {
        $content = $post->post_content;

        if (post_password_required($post)) {
            $content = get_the_password_form($post);
        }

        $content = apply_filters('the_content', $content);
	$content = str_replace(']]>', ']]&gt;', $content);

        return $content;
    }
}

if (!function_exists('d4p_get_thumbnail_url')) {
    function d4p_get_thumbnail_url($post_id, $size = 'full') {
        if (has_post_thumbnail($post_id)) {
            $image = wp_get_attachment_image_src(get_post_thumbnail_id($post_id), $size);

            return $image[0];
        } else {
            return '';
        }
    }
}

if (!function_exists('get_the_slug')) {
    function get_the_slug() {
        $post = get_post();
        return !empty($post) ? $post->post_name : false;
    }
}

if (!function_exists('d4p_remove_cron')) {
    function d4p_remove_cron($hook) {
        $crons = _get_cron_array();

        if (!empty($crons)) {
            $save = false;

            foreach ($crons as $timestamp => $cron) {
                if (isset($cron[$hook])) {
                    unset($crons[$timestamp][$hook]);
                    $save = true;

                    if (empty($crons[$timestamp])) {
                        unset($crons[$timestamp]);
                    }
                }
            }

            if ($save) {
                _set_cron_array($crons);
            }
        }
    }
}

?>