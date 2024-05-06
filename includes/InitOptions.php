<?php

namespace App;

class InitOptions
{
    /**
     * Initialize the parent options page.
     *
     * @return void
     */
    public static function initialize()
    {
        acf_add_options_page([
            'page_title' => __('Theme Options'),
            'menu_title' => __('Theme Options'),
            'menu_slug' => 'theme-options',
            'position' => PHP_INT_MAX,
            'redirection' => true,
        ]);
    }
}
