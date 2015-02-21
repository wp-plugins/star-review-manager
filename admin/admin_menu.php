<?php
add_action( 'admin_menu', 'plugin_admin_pages' );

function plugin_admin_pages() {
	add_menu_page( 'manage_reviewcontainers',  __('Manage review instances', 'star-review-manager'), 'manage_options', 'manage_reviewcontainers', 'manage_reviewcontainers', '', 56);
	add_submenu_page('options-general.php', __('Star Manager Review Settings', 'star-review-manager'), __('Star Manager Review Settings', 'star-review-manager'), 'manage_options', 'settings', 'settings');
	add_submenu_page(null, 'Create new review', __('Create new review', 'star-review-manager'), 'manage_options', 'new_review', 'new_review');
	add_submenu_page(null, 'Manage reviews', __('Manage reviews', 'star-review-manager'), 'manage_options', 'manage_reviews', 'manage_reviews');
	add_submenu_page('manage_reviewcontainers', __('Help', 'star-review-manager'), __('Help', 'star-review-manager'), 'manage_options', 'help', 'help');
}


function manage_reviewcontainers() {
	if ( !current_user_can( 'manage_options' ) )  {
		wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
	}
	include("manage_reviewcontainers.php");
}

function new_review() {
	include("new_review.php");
}	

function manage_reviews() {
	include ("manage_reviews.php");
}

function settings() {
	include ("settings.php");
}

function help() {
	include ("help.php");
}
?>