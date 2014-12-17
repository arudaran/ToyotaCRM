<?php
/**
 * Handles the admin setup and functions for the plugin.
 *
 * @package Members
 * @subpackage Admin
 */

/* Set up the administration functionality. */
add_action ( 'admin_menu', 'crm_admin_setup' );

/**
 * Sets up any functionality needed in the admin.
 *
 * @since 0.2.0
 */
function crm_admin_setup()
{
    
    /* Create the Manage Roles page. */
    add_menu_page ( esc_attr__ ( 'CRM', 'members' ), esc_attr__ ( 'CRM', 'members' ), 'read', 'crm', 'crm_list_customers' );
}
?>