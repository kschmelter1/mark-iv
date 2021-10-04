<?php
//remove_role('client'); //Use this when updating permissions

/*** Define Client User ***/
$result = add_role( 'client', __(

'Client' ),

array(

'read' => true, // true allows this capability
'edit_posts' => true, // Allows user to edit their own posts
'edit_pages' => true, // Allows user to edit pages
'edit_others_posts' => true, // Allows user to edit others posts not just their own
'edit_others_pages' => true,
'edit_published_pages' => true,
'edit_published_posts' => true,
'create_posts' => true, // Allows user to create new posts
'delete_posts' => true,
'delete_pages' => true,
'delete_others_pages' => true,
'delete_others_posts' => true,
'manage_categories' => true, // Allows user to manage post categories
'publish_posts' => true, // Allows the user to publish, otherwise posts stays in draft mode
'edit_themes' => false, // false denies this capability. User can’t edit your theme
'switch_themes' => true,
'edit_theme_options' => true,
'customize' => true,
'manage_options' => true, // Displays Settings tab
'activate_plugins' => true,
'install_plugins' => true, // User cant add new plugins
'edit_plugins' => false,
'delete_plugins' => true,
'add_plugins' => true,
'update_plugin' => true, // User can’t update any plugins
'update_core' => true, // user cant perform core updates
'upload_files' => true,
'list_users' => true,
'edit_users' => true,
'remove_users' => true,
'create_users' => true,
'promote_users' => true

)

);

/*** Disable non admins from promoting users to or adding new users as admin ***/
class JPB_User_Caps {

  // Add our filters
	function __construct() {
	add_filter( 'editable_roles', array(&$this, 'editable_roles') );
	add_filter( 'map_meta_cap', array(&$this, 'map_meta_cap'), 10, 4 );
}

  // Remove 'Administrator' from the list of roles if the current user is not an admin
  function editable_roles( $roles ){
    if( isset( $roles['administrator'] ) && !current_user_can('administrator') ){
      unset( $roles['administrator']);
    }
    return $roles;
  }

  // If someone is trying to edit or delete and admin and that user isn't an admin, don't allow it
  function map_meta_cap( $caps, $cap, $user_id, $args ){

    switch( $cap ){
        case 'edit_user':
        case 'remove_user':
        case 'promote_user':
            if( isset($args[0]) && $args[0] == $user_id )
                break;
            elseif( !isset($args[0]) )
                $caps[] = 'do_not_allow';
            $other = new WP_User( absint($args[0]) );
            if( $other->has_cap( 'administrator' ) ){
                if(!current_user_can('administrator')){
                    $caps[] = 'do_not_allow';
                }
            }
            break;
        case 'delete_user':
        case 'delete_users':
            if( !isset($args[0]) )
                break;
            $other = new WP_User( absint($args[0]) );
            if( $other->has_cap( 'administrator' ) ){
                if(!current_user_can('administrator')){
                    $caps[] = 'do_not_allow';
                }
            }
            break;
        default:
            break;
    }
    return $caps;
  }

}

$jpb_user_caps = new JPB_User_Caps();

/*** Hide specific plugin pages from non-admin users ***/

// Hide ACF Menu
add_filter('acf/settings/show_admin', 'my_acf_show_admin');

function my_acf_show_admin( $show ) {

    return current_user_can('edit_themes');

}

// Removes Custom Post Type UI Menu and WPEngine. Additional custom plugin pages can be added here

add_action( 'admin_init', 'compulse_hide_menu' );

function compulse_hide_menu() {
   if( !current_user_can( 'administrator' ) ) {
    remove_action( 'admin_menu', 'cptui_plugin_menu' );
	  remove_menu_page( 'wpengine-common' );
	}
}

// Use the following code to find page slugs for plugin menu items.
// The [2] value should be placed in remove_menu_page()

/*add_action( 'admin_init', 'the_dramatist_debug_admin_menu' );
function the_dramatist_debug_admin_menu() {
    echo '<pre>' . print_r( $GLOBALS[ 'menu' ], TRUE) . '</pre>';
}*/
