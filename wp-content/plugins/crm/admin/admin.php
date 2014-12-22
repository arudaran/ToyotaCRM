<?php
/**
 * Handles the admin setup and functions for the plugin.
 *
 * @package CRM
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
    add_menu_page ( esc_attr__ ( 'CRM', 'members' ), esc_attr__ ( 'CRM', 'members' ), 'read', 'crm', 'crm_list_customers', '', '72.5' );
}
function crm_list_customers()
{
    $title = __('CRM');
    $wp_list_table = _get_list_table('WP_Users_List_Table');
    ?>
<div class="wrap">
	<h2>
<?php
    echo esc_html ( $title );
    if (current_user_can ( 'create_users' )) {
        ?>
	<a href="user-new.php" class="add-new-h2"><?php echo esc_html_x( 'Add New', 'user' ); ?></a>
<?php } elseif ( is_multisite() && current_user_can( 'promote_users' ) ) { ?>
	<a href="user-new.php" class="add-new-h2"><?php echo esc_html_x( 'Add Existing', 'user' ); ?></a>
<?php
    
}
    
    if ($usersearch)
        printf ( '<span class="subtitle">' . __ ( 'Search results for &#8220;%s&#8221;' ) . '</span>', esc_html ( $usersearch ) );
    ?>
</h2>

<?php $wp_list_table->views(); ?>

<form action="" method="get">

<?php $wp_list_table->search_box( __( 'Search Users' ), 'user' ); ?>

<?php $wp_list_table->display(); ?>
</form>

	<br class="clear" />
</div>
<?php
}
?>
