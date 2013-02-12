<?php
function remove_dashboard_widgets() {
	global $wp_meta_boxes;
	unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_quick_press']); // Removes QuickPress
	unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_incoming_links']); // Incoming Links
	unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_right_now']); // Removes Right Now
	unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_plugins']); // Removes Plugins
	unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_recent_drafts']); // Removes Recent Drafts
	unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_recent_comments']); // Removes Recent Comments
	unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_primary']); // Removes the WordPress Developer Blog
	unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_secondary']); // Removes the WordPress Blog Updates
}
add_action('wp_dashboard_setup', 'remove_dashboard_widgets' );

function remove_menus(){
	global $submenu;

	remove_menu_page( 'edit.php' ); // Posts
	remove_menu_page( 'upload.php' ); // Media
	remove_menu_page( 'link-manager.php' ); // Links
	remove_menu_page( 'edit-comments.php' ); // Comments
	//remove_menu_page( 'edit.php?post_type=page' ); // Pages
	remove_menu_page( 'plugins.php' ); // Plugins
	//remove_menu_page( 'themes.php' ); // Appearance
	//remove_menu_page( 'users.php' ); // Users
	remove_menu_page( 'tools.php' ); // Tools
  //remove_menu_page('options-general.php'); // Settings

	remove_submenu_page ( 'index.php', 'update-core.php' );    //Dashboard->Updates
	remove_submenu_page ( 'themes.php', 'themes.php' ); // Appearance-->Themes
	remove_submenu_page ( 'themes.php', 'widgets.php' ); // Appearance-->Widgets
	remove_submenu_page ( 'themes.php', 'theme-editor.php' ); // Appearance-->Editor
	remove_submenu_page ( 'options-general.php', 'options-general.php' ); // Settings->General
	remove_submenu_page ( 'options-general.php', 'options-writing.php' ); // Settings->writing //SETS DEFAULT POST CATEGORY
	remove_submenu_page ( 'options-general.php', 'options-reading.php' ); // Settings->Reading
	remove_submenu_page ( 'options-general.php', 'options-discussion.php' ); // Settings->Discussion
	remove_submenu_page ( 'options-general.php', 'options-media.php' ); // Settings->Media
	remove_submenu_page ( 'options-general.php', 'options-privacy.php' ); // Settings->Privacy
  //remove_submenu_page ( 'options-general.php', 'options-permalink.php' ); // Settings->Permalink
}
add_action('admin_menu', 'remove_menus', 999 );

function remove_submenus() {
  global $submenu;
  unset($submenu['edit.php?post_type=example'][15]);
}
//add_action('admin_menu', 'remove_submenus', 999);

add_action( 'wp_before_admin_bar_render', 'wps_admin_bar' );
function wps_admin_bar() {
    global $wp_admin_bar;
    $wp_admin_bar->remove_menu('wp-logo');
    $wp_admin_bar->remove_menu('about');
    $wp_admin_bar->remove_menu('wporg');
    $wp_admin_bar->remove_menu('documentation');
    $wp_admin_bar->remove_menu('support-forums');
    $wp_admin_bar->remove_menu('feedback');
    $wp_admin_bar->remove_menu('view-site');
    $wp_admin_bar->remove_menu('comments');
    $wp_admin_bar->remove_menu('new-user');
    $wp_admin_bar->remove_menu('new-media');
    $wp_admin_bar->remove_menu('new-link');
    $wp_admin_bar->remove_menu('themes');
    $wp_admin_bar->remove_menu('menus');
    $wp_admin_bar->remove_menu('new-content');
}

// Add Credits on Footer
add_filter( 'admin_footer_text', 'my_admin_footer_text' );
function my_admin_footer_text( $default_text ) {
    return 'Powered by <a href="http://www.wordpress.org">WordPress</a>';
}

// Setup dashboard widgets
add_action('wp_dashboard_setup', 'my_dashboard_widgets');
function my_dashboard_widgets() {
    wp_add_dashboard_widget( 'dashboard_furniture_feed', 'Example Feed', 'dashboard_example_feed' );
}

function dashboard_example_feed() {
     echo '<div class="rss-widget">';
     wp_widget_rss_output(array(
          'url' => 'http://wordpress.com/rss',
          'title' => 'Recently Added Furnitures',
          'items' => 5,
          'show_summary' => 0,
          'show_author' => 0,
          'show_date' => 1
     ));
     echo "</div>";
}