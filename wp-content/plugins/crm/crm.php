<?php
/**
 * Plugin Name: WordPress CRM
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
 * @package WordPress_CRM
 * @version 0.1
 */

/**
 *
 * @since 0.1
 */
class WordPress_Crm_Load
{
    
    /**
     * PHP5 constructor method.
     *
     * @since 0.2.0
     */
    function __construct()
    {
        global $wp_crm;
        
        /* Set up an empty class for the global $members object. */
        $crm = new stdClass();
        
        /* Set the constants needed by the plugin. */
        add_action('plugins_loaded', array(&$this,'constants'), 1);
        
        /* Internationalize the text strings used. */
        add_action('plugins_loaded', array(&$this,'i18n'), 2);
        
        /* Load the functions files. */
        add_action('plugins_loaded', array(&$this,'includes'), 3);
        
        /* Load the admin files. */
        add_action('plugins_loaded', array(&$this,'admin'), 4);
        
        /* Register customer type */
        add_action('init', array(&$this,'init'), 1);
        
        /* Register activation hook. */
        register_activation_hook(__FILE__, array(&$this,'activation'));
        
        /* Register uninstall hook */
        register_uninstall_hook(__FILE__, array(&$this,'uninstall'));
    }
    
    /**
     * Register customer post type
     */
    function init()
    {
        $args = array(
                'description' => 'Post type to store customer of CRM',
                'public' => false,
                'exclude_from_search' => true,
                'publicly_queryable' => false,
                'show_ui' => false,
                'show_in_nav_menus' => false,
                'show_in_menu' => false,
                'show_in_admin_bar' => false,
                'supports' => array(
                        'author',
                        'custom-fields'),
                'query_var' => false);
        register_post_type('customer', $args);
    }
    
    /**
     * Defines constants used by the plugin.
     *
     * @since 0.2.0
     */
    function constants()
    {
        
        /* Set constant path to the members plugin directory. */
        define('CRM_DIR', trailingslashit(plugin_dir_path(__FILE__)));
        
        /* Set constant path to the members plugin URL. */
        define('CRM_URI', trailingslashit(plugin_dir_url(__FILE__)));
        
        /* Set the constant path to the members includes directory. */
        define('CRM_INCLUDES', CRM_DIR . trailingslashit('includes'));
        
        /* Set the constant path to the members admin directory. */
        define('CRM_ADMIN', CRM_DIR . trailingslashit('admin'));
    }
    
    /**
     * Loads the initial files needed by the plugin.
     *
     * @since 0.2.0
     */
    function includes()
    {
        
        /* Load the plugin functions file. */
        require_once (CRM_INCLUDES . 'class-crm-list-table.php');
        require_once (CRM_INCLUDES . 'class-crm-users-list-table.php');
        require_once (CRM_INCLUDES . 'class-crm-car.php');
        require_once (CRM_INCLUDES . 'class-crm-customer.php');
    }
    
    /**
     * Loads the translation files.
     *
     * @since 0.2.0
     */
    function i18n()
    {
        
        /* Load the translation of the plugin. */
        load_plugin_textdomain('crm', false, 'crm/languages');
    }
    
    /**
     * Loads the admin functions and files.
     *
     * @since 0.2.0
     */
    function admin()
    {
        
        /* Only load files if in the WordPress admin. */
        if (is_admin()) {
            
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
        $staff_role = add_role('department_staff', 'Department Staff');
        $staff_caps = array(
                'read_customers',
                'edit_customers'
        );
        foreach ($staff_caps as $cap) {
            $department_role->add_cap($cap);
        }
        
        $head_caps = array(
                'read_customers',
                'read_others_customers',
                'edit_customers',
                'edit_others_customers'
        );
        $head_role = add_role('head_of_department', 'Head of Department');
        foreach ($head_caps as $cap) {
            $head_role->add_cap($cap);
        }
        
        $manager_caps = array(
                'read_customers',
                'read_others_customers',
                'edit_customers',
                'edit_others_customers',
                'create_users',
                'edit_users',
                'list_users',
                'add_users',
                'remove_users',
                'promote_users'
        );
        $manager_role = add_role('management_board', 'Management Board');
        foreach ($manager_caps as $cap) {
            $manager_role = $head_role->add_cap($cap);
        }
    }
    
    /**
     * Method that runs only when the plugin is uninstalled.
     *
     * @since 0.2.0
     */
    function uninstall()
    {
        remove_role('department_staff', 'Department Staff');
        remove_role('head_of_department', 'Head of Department');
        remove_role('management_board', 'Management Board');
    }
}

$wp_crm_load = new WordPress_Crm_Load();

?>