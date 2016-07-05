<?php
/*
Plugin Name: Unsemantic Grid
Plugin URI: http://doppos.com/
Version: 0.1.0
Description: Easely use grid stylesheets from unsemantic.com with proper WordPress shortcodes.
Author: Emanuel Poletto
Author URI: http://emanuelpoletto.com/
Text Domain: unsemantic-grid
License: GPLv2 or later
*/

/*
Copyright 2015-2016 Emanuel Poletto / Doppos (email: contato@doppos.com)

This file is part of Unsemantic Grid.

Unsemantic Grid is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 3 of the License, or
(at your option) any later version.

Unsemantic Grid is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with Unsemantic Grid.  If not, see <http://www.gnu.org/licenses/>.
*/

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Plugin init
 */
/*function doppos_admin_init() {
    load_plugin_textdomain( 'doppos-admin', false, dirname( plugin_basename( __FILE__ ) ) . '/languages' );
}
add_action( 'plugins_loaded', 'doppos_admin_init' );*/

/**
 * Load scripts
 */
function unsemantic_grid_scripts() {
    if ( ! is_admin() ) {
        wp_enqueue_style( 'unsemantic-grid', plugins_url( '/css/unsemantic-grid-responsive-no-ie7.css', __FILE__ ), array(), '0.1.0' );
    }
}
add_action( 'wp_enqueue_scripts', 'unsemantic_grid_scripts' );

/**
 * Load shortcodes
 */
require plugin_dir_path( __FILE__ ) . 'inc/shortcodes.php';
