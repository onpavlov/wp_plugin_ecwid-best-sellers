<?php
if (is_admin()) {
    wp_enqueue_script('ecwid-bs-fancybox', ECWID_BS_PLUGIN_URL . 'assets/js/jquery.fancybox.min.js', [], get_option('ecwid_bs_plugin_version'));
    wp_enqueue_script('ecwid-bs-popup', ECWID_BS_PLUGIN_URL . 'assets/js/popup.js', [], get_option('ecwid_bs_plugin_version'));
    wp_enqueue_style('ecwid-bs-popup-fancybox', ECWID_BS_PLUGIN_URL . 'assets/css/jquery.fancybox.min.css', [], get_option('ecwid_bs_plugin_version'));
}