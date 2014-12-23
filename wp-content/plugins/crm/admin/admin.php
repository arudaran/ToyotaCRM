<?php
/**
 * Handles the admin setup and functions for the plugin.
 *
 * @package CRM
 * @subpackage Admin
 */

/* Set up the administration functionality. */
add_action('admin_menu', 'crm_admin_setup');

/**
 * Sets up any functionality needed in the admin.
 *
 * @since 0.2.0
 */
function crm_admin_setup()
{
    
    /* Create the Manage Roles page. */
    add_menu_page(esc_attr__('CRM', 'wordpress-crm'), esc_attr__('CRM', 'wordpress-crm'), 'read', 'crm/customer/edit.php', 'crm_customer_edit', '', '30');
    add_submenu_page('crm/customer/edit.php', esc_attr__('All customers', 'wordpress-crm'), esc_attr__('All customers', 'wordpress-crm'), 'read', 'crm/customer/edit.php', 'crm_customer_edit');
    add_submenu_page('crm/customer/edit.php', esc_attr__('New customer', 'wordpress-crm'), esc_attr__('New customer', 'wordpress-crm'), 'read', 'crm/customer/new.php', 'crm_customer_new');
}

function crm_list_customers()
{
}
?>
