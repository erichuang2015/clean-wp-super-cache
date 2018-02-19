<?php
/**
Plugin Name: WP Super Cache Cleaner 
Plugin URI: https://github.com/rajeshsingh520/wp-super-cache-cleaner
Description: Ajax based Clear cache for WP super cache, with this you can clear WP super cache from any place in WordPress dashboard without leaving the present page
Version: 1.1
Author: Rajesh singh
Author URI: https://100dollarswebsites.com
Text Domain: wp-super-cache-cleaner
*/
include_once( ABSPATH . 'wp-admin/includes/plugin.php' );

class wp_super_cache_cleaner{
    
     function __construct(){
         //add_action( 'wp_before_admin_bar_render', array($this,'clear_all_cached'), 999 );
         add_action( 'admin_bar_menu', array($this,'clear_all_cached'), 1000 );
         add_action('admin_enqueue_scripts', array($this,'css_js_enque'));
         add_action('wp_enqueue_scripts', array($this,'css_js_enque'));
        }
     
     function clear_all_cached() {
			global $wp_admin_bar;
			if ( !is_super_admin() || !is_admin_bar_showing() )
			return;
			$wp_admin_bar->add_menu( array(
						'parent' => 'top-secondary',
						'id' => 'delete-all-cache',                                               
						'title' => '<span class="ab-icon dashicons dashicons-trash"></span>' .__( 'Clear all Cache', 'wp-super-cache-cleaner' ),
						'meta' => array( 'title' => __( 'Clear all cached files of WP Super Cache', 'wp-super-cache-cleaner-menu' ) ),
						'href' => '#'
                         ));    
	}
        
     public function css_js_enque(){
       
        wp_enqueue_script( 'wp-super-cache-cleaner',plugin_dir_url( __FILE__ ) . 'script.js',array('wp-api'),null ,true);
        wp_enqueue_style( 'wp-super-cache-cleaner',plugin_dir_url( __FILE__ ) . 'style.css');
        
    }
}

function check_wp_super_cache(){
    if ( is_plugin_active( 'wp-super-cache/wp-cache.php' ) ) {
        new wp_super_cache_cleaner();
    }
}

//add_action( 'admin_init', 'check_wp_super_cache' );
add_action( 'init', 'check_wp_super_cache' );