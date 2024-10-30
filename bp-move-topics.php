<?php
/*
Plugin Name: BuddyPress Move Topics
Plugin URI: http://wordpress.org/extend/plugins/bp-move-topics/
Donate Link: https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=X7SZG3SM4JYGY
Description: Lets you move forum topics from one forum to another.
Version: 0.8.0
Requires at least: WP 2.9.2, BuddyPress 1.2.3
Tested up to: WP 3.0, BuddyPress 1.2.5
License: GPL
Author: Normen Hansen
Author URI: http://www.bitwaves.de/
Site Wide Only: true
*/

require ( dirname( __FILE__ ) . '/include/bp-move-topics-functions.php' );

function bpmvtpc_core_add_admin_menu() {
    global $bp;
    add_submenu_page( 'bp-general-settings', 'Move Forum Topics', 'Move Forum Topics', 'manage_options', 'bpmvtpc_admin_settings', 'bpmvtpc_admin_settings' );
}
add_action('admin_menu', 'bpmvtpc_core_add_admin_menu',25);

function bpmvtpc_admin_settings() {
    include( 'include/bp-move-topics-admin.php');
}

?>