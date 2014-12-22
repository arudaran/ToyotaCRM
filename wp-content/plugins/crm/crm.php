<?php
/**
 * Plugin Name: CRM
 * Description: A plugin was meaned to be support CRM management inside WordPress Dashboard.
 * Version: 0.1
 *
 * This program is free software; you can redistribute it and/or modify it under the terms of the GNU 
 * General Public License version 2, as published by the Free Software Foundation.  You may NOT assume 
 * that you can use any other version of the GPL.
 *
 * This program is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without 
 * even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 *
 * @package CRM
 * @version 0.1
 */

/**
 *
 * @since 0.1
 */
class Crm_Load
{
    
    /**
     * PHP5 constructor method.
     *
     * @since 0.2.0
     */
    function __construct()
    {
        global $crm;
        
        /* Set up an empty class for the global $members object. */
        $crm = new stdClass ();
        
        /* Set the constants needed by the plugin. */
        add_action ( 'plugins_loaded', array(
            &$this,
            'constants'
        ), 1 );
        
        /* Internationalize the text strings used. */
        add_action ( 'plugins_loaded', array(
            &$this,
            'i18n'
        ), 2 );
        
        /* Load the functions files. */
        add_action ( 'plugins_loaded', array(
            &$this,
            'includes'
        ), 3 );
        
        /* Load the admin files. */
        add_action ( 'plugins_loaded', array(
            &$this,
            'admin'
        ), 4 );
        
        /* Register activation hook. */
        register_activation_hook ( __FILE__, array(
            &$this,
            'activation'
        ) );
    }
    
    /**
     * Defines constants used by the plugin.
     *
     * @since 0.2.0
     */
    function constants()
    {
        
        /* Set constant path to the members plugin directory. */
        define ( 'CRM_DIR', trailingslashit ( plugin_dir_path ( __FILE__ ) ) );
        
        /* Set constant path to the members plugin URL. */
        define ( 'CRM_URI', trailingslashit ( plugin_dir_url ( __FILE__ ) ) );
        
        /* Set the constant path to the members includes directory. */
        define ( 'CRM_INCLUDES', CRM_DIR . trailingslashit ( 'includes' ) );
        
        /* Set the constant path to the members admin directory. */
        define ( 'CRM_ADMIN', CRM_DIR . trailingslashit ( 'admin' ) );
    }
    
    /**
     * Loads the initial files needed by the plugin.
     *
     * @since 0.2.0
     */
    function includes()
    {
        
        /* Load the plugin functions file. */
        require_once (CRM_INCLUDES . 'functions.php');
    }
    
    /**
     * Loads the translation files.
     *
     * @since 0.2.0
     */
    function i18n()
    {
        
        /* Load the translation of the plugin. */
        load_plugin_textdomain ( 'crm', false, 'crm/languages' );
    }
    
    /**
     * Loads the admin functions and files.
     *
     * @since 0.2.0
     */
    function admin()
    {
        
        /* Only load files if in the WordPress admin. */
        if (is_admin ()) {
            
            /* Load the main admin file. */
            require_once (CRM_ADMIN . 'admin.php');
        }
    }
    
    /**
     * Method that runs only when the plugin is activated.
     *
     * @since 0.2.0
     */
    function activation()
    {
    }
}

$crm_load = new Crm_Load ();

?>